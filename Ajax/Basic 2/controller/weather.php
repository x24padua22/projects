<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends CI_Controller {
	
	public $view_data;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("weather_report");
	}
	
	public function report()
	{
		$this->input->post();
	}
}
//eof