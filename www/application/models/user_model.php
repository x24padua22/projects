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
			$this->user_info = $user_info;
			$this->db->select("first_name", "last_name", "email");
			$this->db->from("users");
			$this->db->where("email", $user_info["email"]);
			$this->db->where("password", md5($user_info["password"]));
			$user = $this->db->get();
			var_dump($user);
			die();
		}
		
		public function insert_user($user_info)
		{
			$this->user_info = $user_info;
			return $this->db->insert("users", $user_info);
		}
	
	}

//end of file