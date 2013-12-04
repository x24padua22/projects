<?php
class Note_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_notes()
	{
		return $this->db->get("notes");
	}
	
	function insert_note($note)
	{
		return $this->db->insert("notes", $note);
	}
	
	function edit_note($note_info)
	{
		return $this->db->where("id", $note_info["id"])
						->update("notes", $note_info);
	}
	
	function delete_note($note_id)
	{
		return $this->db->where("id", $note_id)
						->delete("notes");
	}
}
//eof