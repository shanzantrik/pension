<?php

class ndc extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
	}

	function index()
	{
		$dv['records'] = $this->model_notification->getNdcNotification();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/ndc_index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function ndc_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->ndc_confirm($file);
		echo json_encode($json);
	}

	function save_forwrd_dynamic()
	{
		$ret=$this->model_notification->save_forwrd_dynamic_ndc();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/ndc');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/ndc');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Superiendantant</div>");
			redirect('administrator/ndc');
		}
	}
}