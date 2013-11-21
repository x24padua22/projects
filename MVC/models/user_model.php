<?php
	class User_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_user($user)
		{
			return $this->db->where("email", $user["email"])
						->where("password", $user["password"])
						->get("users")
						->row();
		}
		
		public function register_user($user)
		{
			return $this->db->insert("users", $user);
		}
	
	}

//end of file