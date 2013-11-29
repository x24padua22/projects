<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	protected $view_data = array();
	protected $user_session = NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->view_data['user_session'] = $this->user_session = $this->session->userdata("user_session");
	}
	
	public function index()
	{
	
	}
	
	public function login_page()
	{		
		$this->load->view("user_login");
	}
	
	public function process_login()
	{		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["login_errors"] = validation_errors();
			$this->load->view("user_login", $this->view_data);
		}
		else
		{
			$this->load->model("user_model");							   
			$get_user = $this->user_model->get_user($this->input->post());
			
			if ($get_user)
			{
				$user_info = array(
					"id" => $get_user->id,
					"first_name" => $get_user->first_name, 
					"last_name" => $get_user->last_name, 
					"email" => $get_user->email, 
					"password" => $get_user->password, 
					"is_logged_in" => TRUE
				);

				$this->session->set_userdata("user_session", $user_info);
				redirect(base_url("login/profile"));
			}
			else
			{
				$this->view_data["login_errors"] = "Invalid email and password";
				$this->load->view("user_login", $this->view_data);
			}
		}
	}
	
	public function process_registration()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["registration_errors"] = validation_errors();
			$this->load->view("user_login", $this->view_data);
		}
		else
		{
			$this->load->helper(date);
			$this->load->model("user_model");
			$user = $this->input->post();
			$user_input = array("first_name" => $user["first_name"],
							   "last_name" => $user["last_name"],
							   "email" => $user["email"],
							   "password" => $user["password"],
							   "user_level_id" => 2,
							   "created_at" => date('Y-m-d H:i:s'),
							   );
							   
			$insert_user = $this->user_model->insert_user($user_input);
			
			if($insert_user)
			{
				$user_info = array(
					"id" => $insert_user->id,
					"first_name" => $insert_user->first_name, 
					"last_name" => $insert_user->last_name, 
					"email" => $insert_user->email, 
					"password" => $insert_user->password, 
					"is_logged_in" => TRUE
				);
				
				$this->session->set_userdata("user_session", $user_info);
				redirect(base_url("login/profile"));
			}
			else
			{
				$this->view_data["registration_errors"] = "Sorry but your info were not registered please try again.";
				$this->load->view("user_login", $this->view_data);
			}
		}
	}
	
	public function profile()
	{
		$this->load->view("user_profile", $this->view_data);
	}
	
	public function logout()
	{
		$user_session_data = $this->session->all_userdata();
		
		foreach($user_session_data as $key)
		{
			$this->session->unset_userdata($key);
		}
		
		$this->session->sess_destroy();
		redirect(base_url("login/login_page"));
	}
	
}

//* End of file