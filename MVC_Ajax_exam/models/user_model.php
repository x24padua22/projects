<?php
class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function insert_user($user_info)
	{
		return $this->db->insert("users", $user_info);
	}
	
	function get_user($user_info)
	{
		return $this->db->where("email", $user_info["email"])
						->where("password", $user_info["password"])
						->get("users")
						->row();
	}
	
	function get_all_friends()
	{
		return $this->db->select("users.full_name, users.email, users.alias, users.id")
						->where("user_id", $this->user_session["id"])
						->join("users", "users.id = friends.friend_id")
						->get("friends")
						->result_array();
	}
	
	function get_friend_info($friend_id)
	{
		return $this->db->where("id", $friend_id["user_id"])
						->get("users")
						->row();
	}
	
	function get_friends_of_friend($friend_id)
	{
		return $this->db->select("users.full_name, users.email, users.alias")
						->where("user_id", $friend_id["user_id"])
						->join("users", "users.id = friends.friend_id")
						->get("friends")
						->result_array();
	}
}
//eof