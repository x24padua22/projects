<?php
	class Test_Model extends CI_Model
	{
		public $user_data;
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_user($user_info)
		{
			$this->db->select("first_name", "last_name", "email");
			$this->db->from("users");
			$this->db->where("email", $user_info["email"]);
			$this->db->where("password", md5($user_info["password"]));
			$user = $this->db->get();
			
			if($user->num_rows() > 0)
			{
				$row = $user->row();
				$id = $row->id;
				$first_name = $row->first_name;
				$last_name = $row->last_name;
				$email = $row->email;
				$description =  $row->description;
				$created_at =  $row->created_at;
				$data["user_data"] = array($id, $first_name, $last_name, $email, $description, $created_at);
				return $data;
			}
			else
			{
				echo "Email not found in the database";
			}
		}
		
		public function insert_user($user_info)
		{
			$this->user_info = $user_info;
			$this->db->insert("users", $user_info);
			return $data["user_info"] = array($data["first_name"], $data["last_name"], $data["email"]);
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