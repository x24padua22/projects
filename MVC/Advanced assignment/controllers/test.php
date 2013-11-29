<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");
class Test extends Main {
	public function __construct()
	{
		parent:: __construct();
	}
	
	public function index()
	{
		$this->view_data["title"] = "Home Page";
		$this->load->view("home", $this->view_data);
	}
	
	public function signin()
	{
		$this->view_data["title"] = "Signin Page";
		$this->load->view("sign_in", $this->view_data);
	}
	
	public function register()
	{
		$this->view_data["title"] = "Register";
		$this->load->view("registration", $this->view_data);
	}

	public function process_signin()
	{
		$this->view_data["title"] = "Signin Page";
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["login_errors"] = validation_errors();
			$this->load->view("sign_in", $this->view_data);
		}
		else
		{
			$this->load->model("test_model");				   
			$get_user = $this->test_model->get_user($this->input->post(), NULL);

			if (!$get_user)
			{
				$this->view_data["login_errors"] = "Invalid email and password";
				$this->load->view("sign_in", $this->view_data);
			}
			else
			{
				$user_info = array(
					"id" => $get_user->id,
					"first_name" => $get_user->first_name, 
					"last_name" => $get_user->last_name, 
					"email" => $get_user->email, 
					"user_level_id" => $get_user->user_level_id, 
					"is_logged_in" => TRUE
				);

				$this->session->set_userdata("user_session", $user_info);

				if($get_user->user_level_id == ADMIN)
					redirect(base_url("/users/dashboard/admin"));
				else
					redirect(base_url("/users/dashboard"));
			}
		}
	}
	
	public function process_registration()
	{
		$this->view_data["title"] = "Register";
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["registration_errors"] = validation_errors();
			$this->load->view("registration", $this->view_data);
		}
		else
		{
			$user = $this->input->post();
			$user_input = array("first_name" => $user["first_name"],
				"last_name" => $user["last_name"],
				"email" => $user["email"],
				"password" => $user["password"],
				"created_at" => date('Y-m-d H:i:s'),
				"user_level_id" => USER
			);
			
			$this->load->model("test_model");
			$user_register = $this->test_model->insert_user($user_input);
			
			$this->load->model("test_model");
			$user_register = $this->test_model->insert_user($user_input);
			
			if($user_register)
			{
				$user_info = array(
					"id" => $user_register->id,
					"first_name" => $user_register->first_name, 
					"last_name" => $user_register->last_name, 
					"email" => $user_register->email, 
					"user_level_id" => $user_register->user_level_id, 
					"is_logged_in" => TRUE
				);
				
				$this->session->set_userdata("user_session", $user_info);
				redirect(base_url("/users/dashboard"));
			}
			else
			{
				$this->view_data["registration_errors"] = "Sorry, but your info has not been registered. Please try again.";
				$this->load->view("registration", $this->view_data);
			}
		}
	}
}