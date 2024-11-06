<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class da_notification extends CI_Controller
{
    function __construct()
    {
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->helper('base');
		$this->load->model('administrator/model_notification');
		$this->load->model('administrator/model_ips');
	}

	function index()
	{
		$dv['file_no']=$this->model_notification->getfile_no_from_pensioner_personal_details();
		$dv['records']=$this->model_notification->getDANotifiction();
		$dv['records1']=$this->model_notification->getfile_Director();
		$dv['records2']=$this->model_notification->getfile_ips();
		$data['title']="All Files";
		$data['content'] =$this->load->view('administrator/notification/da_index', $dv, true);
		$this->load->view('administrator/default_template',$data);
	}

  function add()
	{
		//$file_No=base64_decode($file_no);
		//var_dump($file_No);
		if($_POST){
			     
				if($this->model_notification->addObservation()) {
					$file_no = $_POST['file_no'];
					//var_dump($file_no);
					
					$pid['values'] = $this->model_notification->get_details($file_no);
					$data['title'] = "IPS detail Report";
					//var_dump($pid);
					$data['content'] = $this->load->view('administrator/pension/report/ips/pension_report', $pid, true);
		            $this->load->view('administrator/default_template', $data);
					//$this->session->set_flashdata('message','<div class="alert alert-success">Data saved successfully.</div>');
					//redirect('administrator/DA_Notification/add');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/DA_Notification/add');
				}
			
		} else {
			
			$data['title'] = "Pension Observation Entry";
			//$data['content'] = $this->load->view('administrator/notification/add',true);
			$this->load->view('administrator/da_default', $data);
		}
	}
	function da_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->da_confirm($file);
		echo json_encode($json);
	}

	function da_confirm_from_director(){
		$file=$_GET['file'];
		//print_r($file);
		$json=$this->model_notification->da_confirm_from_director($file);
		echo json_encode($json);
	}

	function da_confirm_from_ips(){
		$file=$_GET['file'];
		$json=$this->model_notification->da_confirm_from_ips($file);
		echo json_encode($json);
	}

	function save_forwrd_dynamic(){
		 $ret=$this->model_notification->save_forwrd_dynamic();
		 if($ret=='validate'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
		 	redirect('administrator/da_notification');
		 }
		 else if($ret=='RollBack'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
		 	redirect('administrator/da_notification');
		 }
		 else if($ret=="Not_All"){
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Service Details</div>");
		 	redirect('administrator/da_notification');	
		 }
		 else{
		 	$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated</div>");
		 	redirect('administrator/da_notification');
		 }
	}

	function save_fwd_to_gisda_bypension_da()
	{
	   	$ret=$this->model_notification->save_fwd_to_gisda_bypension_da();
		if($ret=='validate'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		} else if($ret=='RollBack') {
		 	$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		} else {
		 	$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated</div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		}
	}

	function save_fwd_to_pen_superintendent(){
	   	$ret=$this->model_notification->save_fwd_to_pen_superintendent();
		if($ret=='validate'){
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		} else if($ret=='RollBack') {
		 	$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		} else {
		 	$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated </div>");
		 	//redirect('administrator/Gis');
			redirect('administrator/da_notification');
		}
	}

	function from_superintendent(){
		$dv['records'] = $this->model_notification->getDANotifiction2();
		$data['title'] = "Files Allocated from Superiendantant";
		$data['content'] = $this->load->view('administrator/notification/from_superintendent', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function confirm_from_superandant()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->da_confirm($file);
		echo json_encode($json);
	}

	function forwrd_to_superintendent(){
		$ret=$this->model_notification->forwrd_to_superintendent();
		if($ret=='validate') {
		 	$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
		 	redirect('administrator/da_notification/from_superintendent');
		} else if($ret=='RollBack') {
		 	$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
		 	redirect('administrator/da_notification/from_superintendent');
		} else {
		 	$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Superiendantant</div>");
		 	redirect('administrator/da_notification/from_superintendent');
		}
	}


	function load_remarks($file_No='')//,$type
	{
		
		{
			
			$file_No=base64_decode($file_No);
					
			$data['title']   = "Check IPS Observations";
			$dv['receipt']   =$this->model_ips->get_receipt($file_No);

			$data['content'] = $this->load->view('administrator/notification/add_remarks',$dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	  
	    			
	 }	


	 function add_remarks_controller()
	{
		
		if($_POST) {
			
			$ret=$this->model_notification->add_ips_observation();
			$this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation saved successfully.</div>');
			redirect('administrator/da_notification');
			$this->load->view('administrator/default_template', $data);
			
			} else {
			redirect('administrator/notification/load_remarks');
			$this->load->view('administrator/default_template', $data);
		}
	}

	function load_editremarks($file_No='')
    {
            $file_No=base64_decode($file_No);
                    
            $data['title']   = "Check IPS Observations";
            $dv['receipt']   =$this->model_ips->get_record($file_No);

            $data['content'] = $this->load->view('administrator/notification/edit_remarks',$dv, true);
            $this->load->view('administrator/default_template', $data);
        
            
     }


     function edit_remarks_controller()
    {
        
        if($_POST) {
            $ret=$this->model_ips->edit_ips_observation();
            $this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
            redirect('administrator/da_notification');
            $this->load->view('administrator/default_template', $data);
            
            } else {
            //$dv['receipt']=$this->model_ips->get_receipt($file_No);
            redirect('administrator/ips/load_editremarks');
            $this->load->view('administrator/default_template', $data);
        }
    }
}