<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class marking_notification extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->helper('base');
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
		$this->load->model('administrator/model_marking');
	}

	function index()
	{
		$dv['records'] = $this->model_notification->getMarkingNotifiction();
		$data['title'] = "Files Allocated From Receipt";
		$dv['da']=$this->model_notification->getDA();
		$data['content'] = $this->load->view('administrator/notification/marking_index',$dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->marking_confirm($file);
		echo json_encode($json);
	}
	
	function save()
	{
		$forward_to = (get_member_name($_POST['member_code']) != '') ? get_member_name($_POST['member_code']) : 'Superiendantant';
		$ret=$this->model_notification->forward_to_Da();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/marking_notification');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/marking_notification');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to ".$forward_to."</div>");
			redirect('administrator/marking_notification');
		}
	}
}