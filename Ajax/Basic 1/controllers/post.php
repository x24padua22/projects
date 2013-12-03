<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {
	
	public $view_data;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("notes");
	}
	
	public function notes()
	{
		$this->load->model("note_model");
		$posts = $this->note_model->get_posts();
		
		if($posts)
		{
			foreach($posts->result() as $key)
			{
				$note[] = "<div class='note'>{$key->description}</div>";
			}
			
			$data["notes"] = $note;
			$data["status"] = true;
		}
		else
		{
			$data["error"] = "No notes posted.";
			$data["status"] = false;
		}
		
		echo json_encode($data);
	}
	
	public function post_note()
	{
		$post = $this->input->post();
		$post["created_at"] = date("Y-m-d h:i:s");
		$this->load->model("note_model");
		$post_note = $this->note_model->insert_post($post);
		if($post_note)
		{
			$data["message"] = "<p>Note successfully added.</p>";
			$data["new_note"] = "<div class='note'>{$post['description']}</div>";
			$data["status"] = true;
		}
		else
		{
			$data["error"] = "<p>Sorry, but your note cannot be posted.</p>";
			$data["status"] = false;
		}	
		
		echo json_encode($data);
	}
}
//eof