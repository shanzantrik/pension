<?php

class alerts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_Alerts');
	}

	function index()
	{
		$data['title'] = "File Alerts";
		$dv['records']=$this->model_Alerts->getNotification();
		$data['content'] = $this->load->view('administrator/alert/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}
}