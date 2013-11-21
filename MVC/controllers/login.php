<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function login_page()
	{		
		$this->load->view("user_login");
	}
	
	public function process_login()
	{		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email_login", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password_login", "Password", "trim|min_length[8]|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$data["login_errors"] = validation_errors();
			$this->load->view("user_login", $data);
		}
		else
		{
			$user = $this->input->post();
						
			$this->session->set_userdata("user_session", $user);
			redirect(base_url("/login/user_model/get_user"));
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
			$this->load->view("user_login", $data);
		}
		else
		{
			$user = $this->input->post();
			
			$this->session->set_userdata("user_session", $user);
			redirect(base_url("/login/user_model/register_user"));
		}
	}
	
	public function profile()
	{
		echo $this->user_session["email"];
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("/login/login_page"));
	}
	
}

//* End of file