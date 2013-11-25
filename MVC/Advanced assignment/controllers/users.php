<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("test.php");

class Users extends Test {
	
	public $view_data = array();
	
	public function __construct()
	{
		parent:: __construct();
	}
	
	public function dashboard()
	{
		$this->load->model("test_model");
		$view_data["user_data"] = $this->test_model->get_all_users();
		$this->load->view("user_dashboard", $view_data);
	}
	
	public function show($user_id)
	{
		$this->load->model("test_model");
		$user_info = $this->test_model->get_user(NULL, $user_id);
		
		$view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"created_at" => $user_info->created_at,
			"id" => $user_info->id,
			"email" => $user_info->email,
			"description" => $user_info->description
		);
		
		$this->load->view("user_info", $view_data);
	}
	
	public function edit($user_id)
	{
		$this->load->model("test_model");
		$user_info = $this->test_model->get_user(NULL, $user_id);
		
		$view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"email" => $user_info->email,
			"description" => $user_info->description
		);
		
		$this->load->view("edit_profile", $view_data);
	}
	
	public function process_edit_profile($user_id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->model("test_model");
			$user_info = $this->test_model->get_user(NULL, $user_id);
			
			$view_data["user_data"] = array(
				"id" => $user_info->id,
				"first_name" => $user_info->first_name,
				"last_name" => $user_info->last_name,
				"email" => $user_info->email,
				"description" => $user_info->description
			);
			
			$data["registration_errors"] = validation_errors();
			$this->load->view("edit_profile", $view_data);
			echo "<div style='height:50;'></div>" . $data["registration_errors"];
		}
		else
		{
			$user = $this->input->post();
			$user_info = array(
				"id" => $user_id,
				"first_name" => $user["first_name"],
				"last_name" => $user["last_name"],
				"email" => $user["email"]
			);
							   
			$this->load->model("test_model");
			$new_user_info = $this->test_model->edit_user($user_info);
			
			$view_data["user_data"] = array( 
				"id" => $new_user_info->id,
				"first_name" => $new_user_info->first_name,
				"last_name" => $new_user_info->last_name,
				"email" => $new_user_info->email,
				"description" => $new_user_info->description
			);
			
			$this->load->view("edit_profile", $view_data);
			echo "Your information was successfully changed!";
		}
	}
	
	public function process_change_password($user_id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->model("test_model");
			$user_info = $this->test_model->get_user(NULL, $user_id);
			
			$view_data["user_data"] = array(
				"id" => $user_info->id,
				"first_name" => $user_info->first_name,
				"last_name" => $user_info->last_name,
				"email" => $user_info->email,
				"description" => $user_info->description
			);
			
			$data["registration_errors"] = validation_errors();
			$this->load->view("edit_profile", $view_data);
			echo "<div style='height:50;'></div>" . $data["registration_errors"];
		}
		else
		{
			$user = $this->input->post();
			$user_info = array(
				"id" => $user_id,
				"password" => $user["password"]
			);
							   
			$this->load->model("test_model");
			$new_user_info = $this->test_model->edit_user($user_info);
			
			$view_data["user_data"] = array( 
				"id" => $new_user_info->id,
				"first_name" => $new_user_info->first_name,
				"last_name" => $new_user_info->last_name,
				"email" => $new_user_info->email,
				"description" => $new_user_info->description
			);
			
			$this->load->view("edit_profile", $view_data);
			echo "Your information was successfully changed!";
		}
	}
	
	public function process_edit_description($user_id)
	{
		$user = $this->input->post();
		$user_info = array(
			"id" => $user_id,
			"description" => $user["description"]
		);
						   
		$this->load->model("test_model");
		$new_user_info = $this->test_model->edit_user($user_info);
		
		$view_data["user_data"] = array( 
			"id" => $new_user_info->id,
			"first_name" => $new_user_info->first_name,
			"last_name" => $new_user_info->last_name,
			"email" => $new_user_info->email,
			"description" => $new_user_info->description
		);
		
		$this->load->view("edit_profile", $view_data);
		echo "Your information was successfully changed!";
	}
}