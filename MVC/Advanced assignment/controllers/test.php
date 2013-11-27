<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");
class Test extends Main {
	public function __construct()
	{
		parent:: __construct();
	}
	
	public function index()
	{
		$this->load->view("home");
		$dbconnect = $this->load->database();
	}
	
	public function signin()
	{
		$this->load->view("sign_in");
	}
	
	public function register()
	{
		$this->load->view("registration");
	}
	
	public function process_signin()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$data["login_errors"] = validation_errors();
			$this->load->view("sign_in", $data);
		}
		else
		{
			$user = $this->input->post();
			$user_info = array("email" => $user["email"], "password" => $user["password"]);

			$this->load->model("test_model");				   
			$get_user = $this->test_model->get_user($user_info, NULL);
			
			if($get_user)
			{
				if($get_user->user_level_id == 1)
				{
					$this->session->set_userdata("user_session", $get_user);
					redirect(base_url("/users/dashboard/admin"));
				}
				else
				{
					$this->session->set_userdata("user_session", $get_user);
					redirect(base_url("/users/dashboard"));
				}
			}
			else
			{
				$data["login_errors"] = "Email not found in database or Incorrect password";
				$this->load->view("sign_in", $data);
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
			$data["registration_errors"] = validation_errors();
			$this->load->view("registration", $data);
		}
		else
		{
			$user = $this->input->post();
			$user_info = array("first_name" => $user["first_name"],
							   "last_name" => $user["last_name"],
							   "email" => $user["email"],
							   "password" => $user["password"],
							   "created_at" => date('Y-m-d H:i:s')
							   );
			
			$this->load->model("test_model");
			$user_register = $this->test_model->insert_user($user_info);
			
			if($user_register)
			{
				$this->session->set_userdata("user_session", $user_register);
				$this->is_login();
				redirect(base_url("/users/edit/" . $user_register->id));
			}
		}
	}
	
	public function logout()
	{
		$this->user_session = array();
		$this->session = array();
		$this->load->view("home");
	}
}