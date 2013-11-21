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
				$data["user_data"] = array($first_name, $last_name, $email, $created_at);
				return $data["user_data"];
			}
			else
			{
				echo "Email not found in the database";
			}
		}
		
		public function insert_user($user_info)
		{
			$this->user_info = $user_info;
			return $this->db->insert("users", $user_info);
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
			return $data["user_data"];
		}
	
	}

//end of file