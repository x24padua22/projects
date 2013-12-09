<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time_recorder extends CI_Controller {

	protected $view_data = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("registration");
	}
	
	public function login()
	{
		$this->load->view("log_in");
	}
	
	public function process_registration()
	{
		$user = new User();
		$user->email = $this->input->post("email");
		$user->first_name = $this->input->post("first_name");
		$user->last_name = $this->input->post("last_name");
		$user->password = $this->input->post("password");
		$user->confirm_password = $this->input->post("confirm_password");
		$user->save();
		
		if(!$user->save)
		{
			$this->view_data["errors"] = $user->error->string;
			$this->load->view("registration", $this->view_data);
		}
		
		if(empty($this->view_data["errors"]))
			redirect(base_url("time_recorder/dashboard"));
	}
	
	public function process_login()
	{
        $user = new User();
        $user->email = $this->input->post("email");
        $user->password = $this->input->post("password");

        if ($user->login())
			redirect(base_url("time_recorder/dashboard"));
        else
        {
            $this->view_data["error"] = $user->error->login;
			$this->load->view("log_in", $this->view_data);
        }
	}
	
	public function dashboard()
	{
		$user = new User();
		$users = $user->include_related("time_record", array("log_in", "log_out", "notes"), TRUE, TRUE)->get();
		
		$this->view_data["users_clock_in_history"] = $users;
		$this->load->view("time_record", $this->view_data);
	}
}
//eof