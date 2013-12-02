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
	
	public function dashboard($user_level = NULL)
	{
		if($user_level == "admin")
			$this->view_data["title"] = "Admin Dashboard";
		else
			$this->view_data["title"] = "Dashboard";
		
		$this->load->model("user_model");
		$user_info = $this->user_model->get_all_users();
		
		if(count($user_info) > 0)
			$this->view_data["users"] = $user_info;
		else
			$this->view_data["users"] = "No other users.";
		
		$this->load->view("user_dashboard", $this->view_data);
	}
	
	public function delete($user_id)
	{
		$this->load->model("user_model");
		$this->user_model->delete_user($user_id);
		$this->view_data["delete_success"] = "User has been successfully deleted.";
		$user_info = $this->user_model->get_all_users();
		
		if(count($user_info) > 0)
			$this->view_data["users"] = $user_info;
		else
			$this->view_data["users"] = "No other users.";
		
		$this->load->view("user_dashboard", $this->view_data);
	}
	
	public function show($user_id)
	{
		$this->view_data["title"] = "User Information";
		$this->load->model("user_model");
		$this->view_data["user_data"] = (array) $this->user_model->get_user(NULL, $user_id);
		$messages = $this->user_model->get_messages($user_id);
		
		if(count($messages) > 0)
			$this->view_data["messages_info"] = $messages;
		
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
		
		if(!$message_posted)
			$this->view_data["message_error"] = "Sorry, but you message cannot be posted.";
		
		$this->view_data["user_data"] = (array) $this->user_model->get_user(NULL, $user_id);
		$messages = (array) $this->user_model->get_messages($user_id);
		
		if(count($messages) > 0)
			$this->view_data["messages_info"] = $messages;
		
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
			$user_id = $this->user_session["id"];
		}
		
		$this->view_data["user_data"] = (array) $this->user_model->get_user(NULL, $user_id);
		
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
			$user_id = $this->user_session["id"];
			$level = ADMIN;
		}
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["info_errors"] = validation_errors();
			$this->view_data["user_data"] = (array) $this->user_model->get_user(NULL, $user_id);
		}
		else
		{
			$user_input = $this->input->post();
			unset($user_input["user_level"]);
			$user_input["id"] = $user_id;
			$user_input["updated_at"] = date('Y-m-d H:i:s');
			$user_input["user_level_id"] = $level;
			
			$this->view_data["user_data"] = (array) $this->user_model->edit_user($user_input);
			
			if($this->view_data["user_data"])
				$this->view_data["info_success"] = "User information was successfully changed!";
		}

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
			$user_id = $this->user_session["id"];
		}
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["user_data"] = (array) $this->user_model->get_user(NULL, $user_id);
			$this->view_data["password_errors"] = validation_errors();
		}
		else
		{
			$user_input = $this->input->post();
			unset($user_input["confirm_password"]);
			$user_input["id"] = $user_id;
			$user_input["updated_at"] = date('Y-m-d H:i:s');
			
			$this->view_data["user_data"] = (array) $this->user_model->edit_user($user_input);
			
			if($this->view_data["user_data"])
				$this->view_data["password_success"] = "Password was successfully changed!";
		}

		$this->load->view("edit_profile", $this->view_data);
	}
	
	public function process_edit_description()
	{
		$this->load->model("user_model");
		$this->view_data["title"] = "Edit Profile";
		
		$user_input = $this->input->post();
		$user_input["id"] = $this->user_session["id"];
		$user_input["updated_at"] = date('Y-m-d H:i:s');
		
		$this->view_data["user_data"] = $this->user_model->edit_user($user_input);
		
		if($this->view_data["user_data"])
			$this->view_data["description_success"] = "Your profile description was successfully changed!";
		else
			$this->view_data["description_success"] = "Sorry. Your profile description was not changed.";
		
		$this->load->view("edit_profile", $this->view_data);
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
			$this->view_data["registration_errors"] = validation_errors();
		else
		{
			$user_input = $this->input->post();
			unset($user_input["confirm_password"]);
			$user_input["created_at"] = date('Y-m-d H:i:s');
			$user_input["user_level_id"] = USER;
			
			$this->load->model("user_model");
			$user_register = (array) $this->user_model->insert_user($user_input);
			
			if($user_register)
			{
				$this->view_data["create_success"] = "You have successfully registered a new user: " . 
					$user_register["first_name"] . " " . $user_register["last_name"] . " with user id #" . $user_register["id"];
			}
			else
				$this->view_data["create_failed"] = "Sorry, but user info has not been registered. Please try again.";
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