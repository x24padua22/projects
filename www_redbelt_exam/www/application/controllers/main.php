<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	var $user_session = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->user_session = $this->session->userdata("user_session");
	}
	
	public function is_logged_in()
	{
		if($this->user_session["is_logged_in"] == TRUE)
			return TRUE;
		else 
			return FALSE;
	}
}
//eof