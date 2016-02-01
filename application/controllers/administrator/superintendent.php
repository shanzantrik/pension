<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class superintendent extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('base');
		$this->load->model('superandant/model_superandant');
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
	}
	
	public function index()
	{
		$data['title'] = "Allocate Token";
		$data['content'] = $this->load->view('administrator/superintendent/index', '',true);
		$this->load->view('administrator/default_template',$data);
	}

    function file_allocate()
	{
        $dv['records']=$this->model_notification->getPension_file();
		$dv['records1']=$this->model_notification->getIPS_file();
		$dv['records2']=$this->model_notification->getGIS_file();
		$dv['da']=$this->model_notification->getDA();
		$data['title']= "All Files";
		$data['content'] = $this->load->view('administrator/superintendent/view',$dv, true);
		$this->load->view('administrator/default_template',$data);
	}

	//Function For Ajax Search
	public function search(){
		$data['records'] =$this->model_superandant->getData();
		if($data['records']=='')
		{
			echo "<br/>";
			echo "<div style='margin-top:30px;text-align:center' class='alert alert-danger'>No Records Found</div>";
			exit();
		}
		$data['branch'] =$this->model_superandant->getBranch();
		$this->load->view('administrator/superintendent/ajax_view',$data);
	}
	function get_dealing_assist()
	{
		$branch=$_GET['bcode'];
		$data['records']=$this->model_superandant->getDealAsst($branch);
		echo "<label>Dealing Assistant</label>";
		echo "<select name='da' id='da' required='true'> title='Please Select Dealing Assistant'";
		echo "<option value=''>--Please Select--</option>";
		foreach ($data['records'] as $key) {
			echo "<option value='$key->member_code'>".$key->member_name."</option>";
		}
		echo "</select>";
	}
	function get_dealing_assist_allocate(){
		$branch=$_GET['bcode'];
		$data['records']=$this->model_superandant->getDealAsst($branch);
		echo "<select name='da' id='da' required='true'> title='Please Select Dealing Assistant'";
		echo "<option value=''>--Please Select--</option>";
		foreach ($data['records'] as $key) {
			echo "<option value='$key->member_code'>".$key->member_name."</option>";
		}
		 echo "</select>";
	}
	//Function for Forward 
	public function save_frwd(){
		$result=$this->model_superandant->save_forwarding();
		if($result=='Success'){
			$this->session->set_flashdata('message', '<div class="alert alert-success">File Allocated Successfully</div>');
			redirect('administrator/superintendent');
		}
		else if($result=='Validate'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Select Case</div>');
			redirect('administrator/superintendent');
		}
	}
	public function save_fwd_to_ipsda(){
		$result=$this->model_superandant->save_fwd_to_ipsda();
		if($result=='Success'){
			$this->session->set_flashdata('message', '<div class="alert alert-success">File Allocated Successfully</div>');
			redirect('administrator/superintendent/file_allocate');
		}
		else if($result=='Validate'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Select Case</div>');
			redirect('administrator/superintendent/file_allocate');
		}
	}
	public function save_fwd_to_gisda(){
		$result=$this->model_superandant->save_fwd_to_gisda();
		if($result=='Success'){
			$this->session->set_flashdata('message', '<div class="alert alert-success">File Allocated Successfully</div>');
			redirect('administrator/superintendent/file_allocate');
		}
		else if($result=='Validate'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Select Case</div>');
			redirect('administrator/superintendent/file_allocate');
		}
	}

	function save_fwd_to_Pensionda(){
		//$forward_to = (get_member_name($_POST['member_code']) != '') ? get_member_name($_POST['member_code']) : 'Superiendantant';
		$ret=$this->model_superandant->save_fwd_to_Pensionda();
		 if($ret=='validate'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
		 	redirect('administrator/superintendent/file_allocate');			 }
		 else if($ret=='RollBack'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
		 	redirect('administrator/superintendent/file_allocate');
		 }
		 else{
		 	//$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to ".$forward_to."</div>");
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated</div>");
		 	redirect('administrator/superintendent/file_allocate');
		 }
	}

	public function allocate()
	{
		$data['title'] = "Allocation";
		$da['branch']=$this->model_superandant->getBranch();
		$data['content'] = $this->load->view('administrator/superintendent/allocate', $da, true);
		$this->load->view('administrator/default_template', $data);
	}

	//ajax function for allocatiom
	public function search_allocate()
	{
		$data['records'] =$this->model_superandant->getAllocateData();
		if($data['records']==''){
			echo "<br/>";
			echo "<div style='margin-top:30px;text-align:center' class='alert alert-danger'>No Records Found</div>";
			exit();
		} else {
			$this->load->view('administrator/superintendent/search_view',$data);
		}
	}

	public function report(){
		$data['title'] = "Allocation";
		$data['content'] = $this->load->view('Report/index', '', true);
		$this->load->view('administrator/default_template', $data);
	}

}
