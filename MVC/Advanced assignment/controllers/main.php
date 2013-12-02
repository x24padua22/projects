<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();
	protected $user_session = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->view_data['user_session'] = $this->user_session = $this->session->userdata("user_session");
		$this->view_data["is_admin"] = $this->is_admin();
	}
	
	function index()
	{

	}

	public function is_admin()
	{
		if($this->user_session["user_level_id"] == ADMIN)
			return TRUE;
		else 
			return FALSE;
	}

	public function is_logged_in()
	{
		if($this->user_session["is_logged_in"] == TRUE)
			return TRUE;
		else 
			return FALSE;
	}
}