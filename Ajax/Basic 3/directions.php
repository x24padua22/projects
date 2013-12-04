<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Directions extends CI_Controller {
	
	public $view_data;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view("google_directions");
	}
}
//eof