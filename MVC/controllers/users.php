<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("test.php");

class Users extends Test {
	public function __construct()
	{
		parent:: __construct();
	}
	
	public function dashboard()
	{
		$this->load->model("test_model");
		$this->test_model->get_all_users();
		$data["user_data"] = $user_data;
		$this->load->view("user_dashboard", $user_data);
	}
	
	public function show()
	{
		$this->load->view("user_info");
	}
	
	public function edit()
	{
		$this->load->view("edit_profile");
	}
}