<?php 
/**
* 
*/
class HomePage extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$data['title'] = "Title";
		$data['content'] = $this->load->view('Home/index', '', true);
		$this->load->view('administrator/default_template', $data);
	}
}