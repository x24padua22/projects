<?php
	class Test_Model extends CI_Model
	{
		public $user_data;
		public $login_data;
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_user($user_info)
		{
			$login_data = $this->db->where("email", $user_info["email"])
								->where("password", $user_info["password"])
								->get("users")
								->row();
			$data["login_data"] = array(
				"first_name" => $login_data->first_name,
				"last_name" => $login_data->last_name,
				"created_at" => $login_data->created_at,
				"id" => $login_data->id,
				"email" => $login_data->email,
				"description" => $login_data->description
			);
			redirect(base_url("/users/show", $login_data));
		}
		
		public function insert_user($user_info)
		{
			$this->db->insert("users", $user_info);
			$user_info = array($data["first_name"], $data["last_name"], $data["email"]);
			redirect(base_url("users/edit", $user_info));
		}
		
		public function edit_user($user_info)
		{
			$user = $this->db->where("email", $user_info["previous_email"]);
					$this->db->update("users", $user_info);
			
			if($user->num_rows() > 0)
			{
				$data["first_name"] = $row->first_name;
				$data["last_name"] = $row->last_name;
				$data["email"] = $row->email;
			}
			
			$data["user_data"] = array($data["first_name"], $data["last_name"], $data["email"]);
			return $data;
		}
		
		public function get_all_users()
		{
			$all_users = $this->db->get("users");
			
			foreach($all_users->result() as $row)
			{
				$data["first_name"] = $row->first_name;
				$data["last_name"] = $row->last_name;
				$data["email"] = $row->email;
				$data["created_at"] =  $row->created_at;
			}
			
			$data["user_data"] = array($data["first_name"], $data["last_name"], $data["email"], $data["created_at"]);
			return $data;
		}
	
	}

//end of file