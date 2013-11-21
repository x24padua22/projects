<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("test.php");

class Users extends Test {
	public function __construct()
	{
		parent:: __construct();
	}
	
	public function dashboard()
	{
		$this->load->model("test_model");
		$data["user_data"] = $this->test_model->get_all_users();
		$this->load->view("user_dashboard", $data);
	}
	
	public function show()
	{
		$this->load->view("user_info");
	}
	
	public function edit()
	{
		$this->load->view("edit_profile");
	}
	
	public function process_edit_profile()
	{
		$email = $this->session->userdata($user_info["email"]);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		
		if($this->form_validation->run() === FALSE)
		{
			$data["registration_errors"] = validation_errors();
			$this->load->view("edit_profile", $data);
			echo "<div style='height:50;'></div>" . $data["registration_errors"];
		}
		else
		{
			$user = $this->input->post();
			$user_info = array("previous_email" => $email,
							   "first_name" => $user["first_name"],
							   "last_name" => $user["last_name"],
							   "email" => $user["email"]
							   );
							   
			$this->load->model("test_model");
			$data["new_user_info"] = $this->test_model->edit_user($user_info);
			$this->load->view("edit_profile", $data);
		}
	}
}