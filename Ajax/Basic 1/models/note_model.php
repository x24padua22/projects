<?php
class Note_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_posts()
	{
		return $this->db->get("posts");
	}
	
	function insert_post($note)
	{
		return $this->db->insert("posts", $note);
	}
}
//eof