<?php
	class Test_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_user($user_info, $user_id = NULL)
		{
			if($user_id != NULL)
			{
				return $this->db->where("id", $user_id)
								->get("users")
								->row();
			}
			else
			{
				return $this->db->where("email", $user_info["email"])
								 //->where("password", $user_info["password"])
								 ->get("users")
								 ->row();
			}
		}
		
		public function insert_user($user_info)
		{
			$this->db->insert("users", $user_info);
			return $this->db->where("email", $user_info["email"])
							->get("users")
							->row();
		}
		
		public function edit_user($user_info)
		{
			$this->db->where("id", $user_info["id"]);
			$this->db->update("users", $user_info);
			
			return $this->db->where("id", $user_info["id"])
									  ->get("users")
									  ->row();
		}
		
		public function get_all_users()
		{
			$all_users = $this->db->get("users");
			
			foreach($all_users->result() as $row)
			{
				$data["name"] = $row->first_name . " " . $row->last_name;
				$data["email"] = $row->email;
				$data["created_at"] =  $row->created_at;
			}
			
			$data["user_data"] = array($data["name"], $data["email"], $data["created_at"]);
			return $data;
		}
		
		
	}

//end of file