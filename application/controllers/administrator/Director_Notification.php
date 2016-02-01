<?php 
/**
* Director Notifications Controller 
*/
class director_notification extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
	}

	//Notification Index Page
	function index()
	{
		$dv['records'] = $this->model_notification->getDirectorNotifiction();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/director_index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	//Aknowledge File Receive Ajax Handler
	function director_confirm()
	{			
		$file=$_GET['file'];
		$json=$this->model_notification->director_confirm($file);
		echo json_encode($json);
	}

	function save_forwrd_PPO()
	{
		$ret=$this->model_notification->save_forwrd_PPO();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/director_notification/index');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/director_notification/index');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Superiendantant</div>");
			redirect('administrator/director_notification/index');
		}
	}

	function for_signature()
	{
		$dv['records'] = $this->model_notification->getDirectorNotifiction_signature();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/director_index_signature', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function forward_to_issue()
	{
		$ret=$this->model_notification->forward_to_issue();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/director_notification/for_signature');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/director_notification/for_signature');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Issue Branch</div>");
			redirect('administrator/director_notification/for_signature');
		}
	}

	function save_forwrd_dynamic()
	{
		$ret=$this->model_notification->save_forwrd_dynamic();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/da_notification');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/da_notification');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Superiendantant</div>");
			redirect('administrator/da_notification');
		}
	}
}