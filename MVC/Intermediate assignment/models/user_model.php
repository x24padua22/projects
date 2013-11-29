<?php
	class User_Model extends CI_Model
	{
		public $user;
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function get_user($user_info)
		{
			return $this->db->where("email", $user_info["email"])
								->where("password", $user_info["password"])
								->get("users")
								->row();
		}
		
		public function insert_user($user_info)
		{
			$this->db->insert("users", $user_info);
			return $this->db->where("email", $user_info["email"])
							->get("users")
							->row();
		}
	
	}

//end of file