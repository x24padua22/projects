<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	function validate()
	{
		$this->load->library('form_validation');
		//codes that validate the email or password fields
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors(); 
			$data['status'] = false;
		}
		else
		{
			$data['message'] = "Valid Email and Password!";
			$data['status'] = true;
		}
		echo json_encode($data);
	}
}
//eof