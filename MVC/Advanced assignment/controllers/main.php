<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();
	protected $user_session = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->user_session = $this->session->userdata("user_session");
	}
	
	public function is_login()
	{
	//search how to use is_login also to logout and destroy session
		if($is_login)
		{
			echo "You don't have permission to access this page. Please sign in <a href='/test/signin'>here</a>.";
			echo " Or go back to <a href='/test'>Home page</a>.";
		}
	}
	
	public function set_user_data($user_info)
	{
		return array("id" => $user_info->id,
					 "first_name" => $user_info->first_name,
					 "last_name" => $user_info->last_name,
					 "created_at" => $user_info->created_at,
					 "id" => $user_info->id,
					 "email" => $user_info->email,
					 "description" => $user_info->description,
					 "user_level_id" => $user_info->user_level_id
					);
	}
	
	public function check_user_id($user_id = NULL)
	{
		if($this->user_session->user_level_id == 1)
		{
			if($user_id == NULL)
			{
				$user_id_info = $this->user_session->id;
			}
			else
			{
				$user_id_info = $user_id;
			}
		}
		else
		{
			$user_id_info = $this->user_session->id;
		}
		
		return $user_id_info;
	}
}