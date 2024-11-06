<?php

class gis_superintendent extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/model_gis_superintendent');
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_Gis');
		$this->load->model('administrator/model_notification');
		$this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
			$dp['lists'] =  $this->model_gis_superintendent->getFilterDA($department);
			$dp['lists2'] = $this->model_gis_superintendent->getFiletrJD_after_approval($department);
			$dp['lists3'] = $this->model_gis_superintendent->getFilterGISDAFinal($department);
			$dp['lists4'] = $this->model_gis_superintendent->getFilterJD_after_final($department);
			$dp['lists5'] = $this->model_gis_superintendent->getFilterObj($department);
			$data['title'] = "GIS Superintendent";
			$data['content'] = $this->load->view('administrator/gis_superintendent/view',  $dp, true);
			$this->load->view('administrator/filtered', $data);
		}
		else{
			$dp['lists'] =  $this->model_gis_superintendent->getAll_file_DA();
			$dp['lists2'] = $this->model_gis_superintendent->getfile_from_jdap_after_approval();
			$dp['lists3'] = $this->model_gis_superintendent->getfile_from_gisda_for_final();
			$dp['lists4'] = $this->model_gis_superintendent->getfile_from_jdap_after_final();
			$dp['lists5'] = $this->model_gis_superintendent->getAll_file_DA_has_obj();
			$data['title'] = "GIS Superintendent";
			$data['content'] = $this->load->view('administrator/gis_superintendent/view',  $dp, true);
			$this->load->view('administrator/default_template', $data);
		}

	}

	function objection_report($file_no)
	{
		$file_no=base64_decode($file_no);
		$pid['values'] = $this->model_Gis->get_objection_details($file_no);
		$pid['obj']=$this->model_Gis->get_objection_master($file_no);
		$data['title'] = "Checklist detail Report";
		$data['content'] = $this->load->view('administrator/pension/report/gis/return-form', $pid, true);
		$this->load->view('administrator/default_template', $data);
	}

	function gis_superintendent_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_superintendent_confirm($file);
		echo json_encode($json);
	}

	function view_checklist($file_no)
	{
		$file_no=base64_decode($file_no);
        $pid['values'] = $this->model_Gis->get_checklist_details($file_no);
        $data['title'] = "Checklist detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
	    $this->load->view('administrator/default_template', $data);
	}

	function gis_superintendent_confirm_after_approval()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_superintendent_confirm_after_approval($file);
		echo json_encode($json);
	}

	function gis_superintendent_confirm_form_gis_Da()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_superintendent_confirm_form_gis_Da($file);
		echo json_encode($json);
	}

	function gis_superintendent_confirm_after_final()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_superintendent_confirm_after_final($file);
		echo json_encode($json);
	}

	function gis_superintendent_confirm_form_gis_Da_obj()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_superintendent_confirm_form_gis_Da_obj($file);
		echo json_encode($json);
	}

	function attach_authority($file_no)
	{
		$file_no=base64_decode($file_no);
		$dept_forwading_no = $this->model_Gis->get_dept_forwarding_no($file_no);
		$get_district_id= $this->model_Gis->get_district_id($dept_forwading_no);
		$pid['district_id']=$get_district_id;
		$group=$this->model_Gis->get_group_of_employee($file_no);
		$pid['values'] = $this->model_Gis->get_checklist_details($file_no);
		$group_status=unserialize($group);
		
		$a='e';
		if( in_array($a, $group_status) ) : 
		    $data['title'] = "Checklist detail Report";
		    $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_a', $pid, true);
			$this->load->view('administrator/default_template', $data);
		else :
			$data['title'] = "Checklist detail Report";
			$data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_other', $pid, true);
			$this->load->view('administrator/default_template', $data);
        endif;
	}

	function save_fwd_to_jdap()
	{
		$ret=$this->model_gis_superintendent->save_fwd_to_jdap();
		if($ret=='validate') {
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=='RollBack') {
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=="Not_All") {
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/gis_superintendent');	
		} else {
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated </div>");
			redirect('administrator/gis_superintendent');
		}
	}

	function save_fwd_to_jdap_fr_final()
	{
		$ret=$this->model_gis_superintendent->save_fwd_to_jdap_fr_final();
		if($ret=='validate')
		{
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=='RollBack') {
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis_superintendent');
		} else {
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to JDAP</div>");
			redirect('administrator/gis_superintendent');
		}
	}

	function save_forwrd_to_GIS_da_after_approval()
	{
		$ret=$this->model_gis_superintendent->save_forwrd_to_GIS_da_after_approval();
		if($ret=='validate') {
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=='RollBack') {
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis_superintendent');
		} else {
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
			redirect('administrator/gis_superintendent');
		}
	}

	function save_fwd_to_gisda_obj()
	{
		$ret=$this->model_gis_superintendent->save_fwd_to_gisda_obj();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=='RollBack') {
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis_superintendent');
		} else {
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
			redirect('administrator/gis_superintendent');
		}
	}

	function save_fwd_to_gisda_after_final()
	{
		$ret=$this->model_gis_superintendent->save_fwd_to_gisda_after_final();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis_superintendent');
		} else if($ret=='RollBack') {
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis_superintendent');
		} else {
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
			redirect('administrator/gis_superintendent');
		}
	}
}