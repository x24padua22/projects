<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();
	protected $user_session = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->view_data['user_session'] = $this->user_session = $this->session->userdata("user_session");
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
	
	public function check_user_id($user_id = NULL)
	{
		if($this->user_session["user_level_id"] == 1)
		{
			if($user_id == NULL)
			{
				$user_id_info = $this->user_session["id"];
			}
			else
			{
				$user_id_info = $user_id;
			}
		}
		else
		{
			$user_id_info = $this->user_session["id"];
		}
		
		return $user_id_info;
	}
}