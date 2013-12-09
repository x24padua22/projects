<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");
class Friends extends Main {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("login");
	}
	
	public function process_registration()
	{
		$this->view_data["title"] = "Register";
		$this->load->library("form_validation");
		$this->form_validation->set_rules("full_name", "Full Name", "trim|required|min_lenght[5]");
		$this->form_validation->set_rules("alias", "Alias", "trim|required|min_length[3]");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[6]|required|matches[confirm_password]|md5");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$data["status"] = FALSE;
			$data["errors"] = validation_errors();
		}
		else{
			$user_input = $this->input->post();
			unset($user_input["confirm_password"]);
			$user_input["created_at"] = date("Y-m-d H:i:s");
			$this->load->model("user_model");
			$insert_user = $this->user_model->insert_user($user_input);
			
			if($insert_user)
			{
				$user_info = array(
					"id" => $insert_user->id,
					"is_logged_in" => TRUE
				);
				$this->session->set_userdata("user_session", $user_info);
				$data["status"] = TRUE;
			}
			else
			{
				$data["status"] = FALSE;
				$data["errors"] = "Sorry, but your information cannot be registered.";
			}
		}
		
		echo json_encode($data);
	}
	
	public function process_login()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|md5");
		
		if($this->form_validation->run() === FALSE)
		{
			$data["status"] = FALSE;
			$data["errors"] = validation_errors();
		}
		else
		{
			$this->load->model("user_model");
			$get_user = $this->user_model->get_user($this->input->post());
			
			if($get_user)
			{
				$user_info = array(
					"id" => $get_user->id,
					"is_logged_in" => TRUE
				);
				$this->session->set_userdata("user_session", $user_info);
				$data["status"] = TRUE;
			}
			else
			{
				$data["status"] = FALSE;
				$data["error"] = "Sorry, but your information cannot be registered.";
			}
		}
		
		echo json_encode($data);
	}
	
	public function view_friends()
	{
		$this->load->view("view_friends");
	}
	
	public function get_friends()
	{
		$this->load->model("user_model");
		$get_friends = $this->user_model->get_all_friends();
		
		if($get_friends)
		{
			foreach($get_friends as $friend)
			{
				$friend_option[] = "<option value='{$friend['id']}'>{$friend['full_name']}</option>";
			}
			
			$data["friends"] = $friend_option;
			$data["status"] = TRUE;
		}
		else
		{
			$data["status"] = FALSE;
			$data["error"] = "Sorry, no friends found.";
		}
		
		echo json_encode($data);
	}
	
	public function process_friend_info()
	{
		$this->load->model("user_model");
		$friend_info = $this->user_model->get_friend_info($this->input->post());
		$friends_of_friend = $this->user_model->get_friends_of_friend($this->input->post());
		
		if($friend_info)
		{
			$data["friend_info"] = "<p>A.K.A: {$friend_info->alias}</p><p>Email: {$friend_info->email}</p>";
				
			if($friends_of_friend)
			{
				$friends_table = "
					<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Alias</th>
							</tr>
						</thead>
						<tbody>";
						
				
				foreach($friends_of_friend as $friend)
				{
					$friends_table .= "<tr><td>{$friend["full_name"]}</td>
									   <td>{$friend["email"]}</td>
									   <td>{$friend["alias"]}</td></tr>";
				}
				
				$friends_table .= "</tbody></table>";
				
				$data["friends_of_friend"] = $friends_table;
				$data["status"] = TRUE;
			}
			else
			{
				$data["status"] = FALSE;
				$data["error"] = "Sorry, no information for this user to be shown.";
			}
		}
		
		echo json_encode($data);
	}
}
//eof