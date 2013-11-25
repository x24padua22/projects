<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
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
			$login_errors = validation_errors();
			$this->load->view("sign_in");
			echo "<div style='height:50;'></div>" . $login_errors;
		}
		else
		{
			$user = $this->input->post();
			$user_info = array(
				"email" => $user["email"],
				"password" => $user["password"]
			);

			$this->load->model("test_model");				   
			$get_user = $this->test_model->get_user($user_info, NULL);
			
			if($get_user)
			{
				redirect(base_url("/users/show/" . $get_user->id));
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
			$registration_errors = validation_errors();
			$this->load->view("registration");
			echo "<div style='height:50;'></div>" . $registration_errors;
		}
		else
		{
			$user = $this->input->post();
			$user_info = array(
				"first_name" => $user["first_name"],
				"last_name" => $user["last_name"],
				"email" => $user["email"],
				"password" => $user["password"],
				"created_at" => date('Y-m-d H:i:s')
			);
			
			$this->load->model("test_model");
			$user_register = $this->test_model->insert_user($user_info);
			
			if($user_register)
			{
				redirect(base_url("/users/edit/" . $user_register->id));
			}
		}
	}
}