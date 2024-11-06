<?php

class joint_director extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/model_joint_director');
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_Gis');
		$this->load->model('administrator/model_notification');
		$this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
			$dp['lists'] = $this->model_joint_director->getAll_file_superintendent_for_approval();
			$dp['lists2'] = $this->model_joint_director->getAll_file_superintendent_for_final();
			$dp['lists3'] = $this->model_joint_director->getPensionFilter($department);
			$data['title'] = "Joint Director";
			$data['content'] = $this->load->view('administrator/joint_director/view',  $dp, true);
			$this->load->view('administrator/filtered', $data);
		}
		else{
			$dp['lists'] = $this->model_joint_director->getAll_file_superintendent_for_approval();
			$dp['lists2'] = $this->model_joint_director->getAll_file_superintendent_for_final();
			$dp['lists3'] = $this->model_joint_director->getAll_file_from_pension_superintendent();
			$data['title'] = "Joint Director";
			$data['content'] = $this->load->view('administrator/joint_director/view',  $dp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function load_editremarks($file_No='')
    {
            $file_No=base64_decode($file_No);
                    
            $data['title']   = "Check IPS Observations";
            $dv['receipt']   =$this->model_joint_director->get_record($file_No);

            $data['content'] = $this->load->view('administrator/joint_director/edit_remarks',$dv, true);
            $this->load->view('administrator/default_template', $data);
        
            
     }

     function edit_remarks_controller()
    {
        
        if($_POST) {
            $ret=$this->model_joint_director->edit_ips_observation();
            $this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
            redirect('administrator/joint_director/index');
            $this->load->view('administrator/default_template', $data);
            
            } else {
            
            redirect('administrator/joint_director/load_editremarks');
            $this->load->view('administrator/default_template', $data);
        }
    }

    function print_ips_observation($file_no)
    {
        $file_No=base64_decode($file_no);
        
        $q=$this->db->query("select a.remarks,b.dept_forw_no,b.receipt_date,b.pensionee_name,b.designation,c.address_department from observation a, pension_receipt_file_master b, pension_receipt_register_master c where a.case_no=b.file_no and c.dept_forw_no=b.dept_forw_no and a.case_no='$file_No'");
        $result = $q->result();
         
        $res['resu'] = $result;
      
        $data['title'] = "IPS detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/ips/ips_observations', $res, true);
        $this->load->view('administrator/default_template', $data);
    }
       
	function joint_director_confirm_for_approval()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->joint_director_confirm_for_approval($file);
		echo json_encode($json);
	}

	function joint_director_confirm_for_pension()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->joint_director_confirm_for_pension($file);
		echo json_encode($json);
	}
	
	function jd_confirm_from_ips()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->jd_confirm_from_ips($file);
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

	function save_fwd_to_gis_superintendent_after_approval()
	{
		$ret=$this->model_joint_director->save_fwd_to_gis_superintendent_after_approval();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/joint_director');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to </div>");
			redirect('administrator/joint_director');
		}
	}

	function attach_authority($file_no)
	{
		$file_no=base64_decode($file_no);
		$group=get_group_of_employee($file_no);
		
		if($group=="A")
		{
			$pid['values'] =get_checklist_details($file_no);
			$data['title'] = "Checklist detail Report";
		    $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_a', $pid, true);
			$this->load->view('administrator/default_template', $data);
	    }
	    else
	    {
		    $pid['values'] = $this->model_Gis->get_checklist_details($file_no);
			$data['title'] = "Checklist detail Report";
			$dept_forwading_no = $this->model_Gis->get_dept_forwarding_no($file_no);
		    $get_district_id= $this->model_Gis->get_district_id($dept_forwading_no);
		    $pid['district_id']=$get_district_id;
		    $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_other', $pid, true);
			$this->load->view('administrator/default_template', $data);
	    }
	}
	
	function pension_save_fwd_by_jd()
	{
		$ret=$this->model_joint_director->pension_save_fwd_by_jd();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/joint_director');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated  </div>");
			redirect('administrator/joint_director');
		}
	}

	function save_fwd_to_gis_superintendent_after_final()
	{
		$ret=$this->model_joint_director->save_fwd_to_gis_superintendent_after_final();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/joint_director');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS Superintendent</div>");
			redirect('administrator/joint_director');
		}
	}

	function save_fwd_by_jd_from_ips()
	{
		$ret=$this->model_joint_director->save_fwd_by_jd_from_ips();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/joint_director');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/joint_director');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated </div>");
			redirect('administrator/joint_director');
		}
	}
}