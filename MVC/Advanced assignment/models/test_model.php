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
								->where("password", $user_info["password"])
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
			$this->db->where("id", $user_info["id"])
					 ->update("users", $user_info);
			
			return $this->db->where("id", $user_info["id"])
							->get("users")
							->row();
		}
		
		public function get_all_users()
		{
			return $this->db->select("users.id, 
				users.first_name, 
				users.last_name, 
				users.email, 
				users.created_at, 
				user_levels.user_level
			")
							->join("user_levels", "users.user_level_id = user_levels.id")
							->get("users");
		}
		
		public function delete_user($user_id)
		{
			return $this->db->delete("users", array("id" => $user_id));
			
		}
		
		public function get_messages($user_id)
		{
			return $this->db->select("messages.message,
									  messages.created_at,
									  messages.user_id,
									  users.first_name,
									  users.last_name,
									  ")
							->where("posted_to", $user_id)
							->join("users", "messages.user_id = users.id")
							->get("messages");
		}
		
		public function insert_message($message)
		{
			return $this->db->insert("messages", $message);
		}
	}

//end of file