<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller {
	
	public $view_data;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("leads_info");
	}
	
	public function get_leads()
	{
		$this->load->model("lead_model");
		$this->view_data["leads"] = $this->lead_model->get_all_leads($this->input->post);
	}
}
//eof