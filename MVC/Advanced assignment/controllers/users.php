<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");
class Users extends Main {
		
	public function __construct()
	{
		parent:: __construct();
		
		if(! $this->is_logged_in())
		{
			redirect(base_url("/test/signin"));
		}
	}
	
	public function dashboard($user_level_info = NULL)
	{
		if($user_level_info == "admin")
		{
			$this->view_data["title"] = "Admin Dashboard";
		}
		else
		{
			$this->view_data["title"] = "Dashboard";
		}
		
		$this->load->model("user_model");
		$user_info = $this->user_model->get_all_users();
		
		$counter = 0;
		
		foreach($user_info->result() as $key)
		{
			$id[] = $key->id;
			$name[] = $key->first_name . " " . $key->last_name;
			$email[] = $key->email;
			$created_at[] = $key->created_at;
			$user_level[] = $key->user_level;
			$counter++;
		}
		
		$this->view_data["user_data"] = array(
			"id" => $id,
			"name" => $name,
			"email" => $email,
			"created_at" => $created_at,
			"user_level" => $user_level
		);
		
		if($user_level_info != NULL && $user_level_info != "admin")
		{
			$this->user_model->delete_user($user_level_info);
			$this->view_data["delete_success"] = "User has been successfully deleted.";
		}
		
		$this->view_data["row_counter"] = $counter;
		$this->view_data["administrator"] = $this->is_admin();
		$this->load->view("user_dashboard", $this->view_data);
	}
	
	public function show($user_id)
	{
		$this->view_data["title"] = "User Information";
		$this->load->model("user_model");
		$user_info = $this->user_model->get_user(NULL, $user_id);
		$messages = $this->user_model->get_messages($user_id);
		
		$this->view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"created_at" => $user_info->created_at,
			"email" => $user_info->email,
			"description" => $user_info->description
		);
		
		$counter = 0;
		
		foreach($messages->result() as $key)
		{
			$posted_by_id[] = $key->user_id;
			$posted_by[] = $key->first_name . " " . $key->last_name;
			$message[] = $key->message;
			$created_at[] = $key->created_at;
			$counter++;
		}
		
		$this->view_data["messages_info"] = array(
			"posted_by_id" => $posted_by_id,
			"posted_by" => $posted_by,
			"message" => $message,
			"posted_at" => $created_at
		);
		
		$this->view_data["row_counter"] = $counter;
		$this->view_data["administrator"] = $this->is_admin();
		$this->load->view("user_info", $this->view_data);
	}
	
	public function post_message($user_id)
	{
		$this->view_data["title"] = "User Information";
		$user_input = $this->input->post();
		$user_input["created_at"] = date('Y-m-d H:i:s');
		$user_input["user_id"] = $this->user_session["id"];
		$user_input["posted_to"] = $user_id;
		
		$this->load->model("user_model");
		$message_posted = $this->user_model->insert_message($user_input);
		$user_info = $this->user_model->get_user(NULL, $user_id);
		$messages = $this->user_model->get_messages($user_id);
		
		$this->view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"created_at" => $user_info->created_at,
			"email" => $user_info->email,
			"description" => $user_info->description
		);
		
		$counter = 0;
		foreach($messages->result() as $key)
		{
			$posted_by_id[] = $key->user_id;
			$posted_by[] = $key->first_name . " " . $key->last_name;
			$message[] = $key->message;
			$created_at[] = $key->created_at;
			$counter++;
		}
		
		$this->view_data["messages_info"] = array(
			"posted_by_id" => $posted_by_id,
			"posted_by" => $posted_by,
			"message" => $message,
			"posted_at" => $created_at
		);
		
		$this->view_data["row_counter"] = $counter;
		
		$this->view_data["administrator"] = $this->is_admin();
		$this->load->view("user_info", $this->view_data);
	}
	
	public function edit($user_id = NULL)
	{
		$this->load->model("user_model");
		
		if($user_id != NULL)
		{
			$this->view_data["title"] = "Edit User";
			$this->view_data["edit_other"] = $user_id;
		}
		else
		{
			$this->view_data["title"] = "Edit Profile";
		}
		
		$user_id_info = $this->check_user_id($user_id);
		$user_info = $this->user_model->get_user(NULL, $user_id_info);
		
		$this->view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"email" => $user_info->email,
			"description" => $user_info->description
		);
		
		$this->load->view("edit_profile", $this->view_data);
	}
	
	public function process_edit_profile($user_id = NULL)
	{
		$this->load->model("user_model");
		
		if($user_id != NULL)
		{
			$this->view_data["title"] = "Edit User";
			$this->view_data["edit_other"] = $user_id;
			$level = $this->input->post("user_level");
		}
		else
		{
			$this->view_data["title"] = "Edit Profile";
			$level = ADMIN;
		}
		
		$user_id_info = $this->check_user_id($user_id);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		
		if($this->form_validation->run() === FALSE)
		{
			$user_info = $this->user_model->get_user(NULL, $user_id_info);
			
			$this->view_data["info_errors"] = validation_errors();
		}
		else
		{
			$user = $this->input->post();
			$user_input = array(
				"id" => $user_id_info,
				"first_name" => $user["first_name"],
				"last_name" => $user["last_name"],
				"email" => $user["email"],
				"updated_at" => date('Y-m-d H:i:s'),
				"user_level_id" => $level
			);
			
			$user_info = $this->user_model->edit_user($user_input);
			
			if($user_info)
			{				
				$this->view_data["info_success"] = "Your information was successfully changed!";
			}
		}
		$this->view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"email" => $user_info->email,
			"description" => $user_info->description
		);

		$this->load->view("edit_profile", $this->view_data);
	}
	
	public function process_change_password($user_id = NULL)
	{
		$this->load->model("user_model");
		
		if($user_id != NULL)
		{
			$this->view_data["title"] = "Edit User";
			$this->view_data["edit_other"] = $user_id;
		}
		else
		{
			$this->view_data["title"] = "Edit Profile";
		}
		
		$user_id_info = $this->check_user_id($user_id);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$user_info = $this->user_model->get_user(NULL, $user_id_info);
						
			$this->view_data["password_errors"] = validation_errors();
		}
		else
		{
			$user = $this->input->post();
			$user_input = array(
				"id" => $user_id_info,
				"password" => $user["password"],
				"updated_at" => date('Y-m-d H:i:s')
			);
			
			$user_info = $this->user_model->edit_user($user_input);
			
			if($user_info)
			{			
				$this->view_data["password_success"] = "Your password was successfully changed!";
			}
		}
		$this->view_data["user_data"] = array(
			"id" => $user_info->id,
			"first_name" => $user_info->first_name,
			"last_name" => $user_info->last_name,
			"email" => $user_info->email,
			"description" => $user_info->description
		);

		$this->load->view("edit_profile", $this->view_data);
	}
	
	public function process_edit_description($user_id = NULL)
	{
		$this->load->model("user_model");
		
		if($user_id != NULL)
		{
			$this->view_data["title"] = "Edit User";
			$this->view_data["edit_other"] = $user_id;
		}
		else
		{
			$this->view_data["title"] = "Edit Profile";
		}
		
		$user_id_info = $this->check_user_id($user_id);
		$user = $this->input->post();
		$user_input = array(
			"id" => $user_id_info,
			"description" => $user["description"],
			"updated_at" => date('Y-m-d H:i:s')
		);
		
		$user_info = $this->user_model->edit_user($user_input);
		
		if($user_info)
		{
			$this->view_data["user_data"] = array(
				"id" => $user_info->id,
				"first_name" => $user_info->first_name,
				"last_name" => $user_info->last_name,
				"email" => $user_info->email,
				"description" => $user_info->description
			);
			
			$this->view_data["description_success"] = "Your profile description was successfully changed!";
			$this->load->view("edit_profile", $this->view_data);
		}
	}
	
	public function create_new()
	{
		$this->view_data["title"] = "New User";
		$this->load->view("register_new_user", $this->view_data);
	}
	
	public function process_create_new()
	{
		$this->view_data["title"] = "New User";
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["registration_errors"] = validation_errors();
		}
		else
		{
			$user = $this->input->post();
			unset($user["password"]);
			$user["created_at"] = date('Y-m-d H:i:s');
			$user["user_level_id"] = USER;
			
			$this->load->model("user_model");
			$user_register = $this->user_model->insert_user($user);
			
			if($user_register)
			{
				$this->view_data["create_success"] = "You have successfully registered a new user";
			}
			else
			{
				$this->view_data["create_failed"] = "Sorry, but your info has not been registered. Please try again.";
			}
		}
		$this->load->view("register_new_user", $this->view_data);
	}
	
	public function logout()
	{
		$this->view_data["title"] = "Home Page";
		$user_session_data = $this->session->all_userdata();
		
		foreach($user_session_data as $key)
		{
			$this->session->unset_userdata($key);
		}
		
		$this->session->sess_destroy();
		redirect(base_url("/test"));
	}
}