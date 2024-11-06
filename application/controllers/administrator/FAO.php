<?php

class fao extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/model_fao');
	    $this->load->model('administrator/model_notification');
	    $this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
			$dp['lists'] = $this->model_fao->getFilterGis($department);
			$dp['lists2'] = $this->model_fao->getFilterIps($department);
			$dp['lists3'] = $this->model_fao->getFilterPension($department);
			$data['title'] = "FAO";
			$data['content'] = $this->load->view('administrator/fao/view',$dp, true);
			$this->load->view('administrator/filtered', $data);
	    }
	    else{
		    $dp['lists'] = $this->model_fao->getAll_file_gissuperintendent();
			$dp['lists2'] = $this->model_fao->getAll_file_from_ips();
			$dp['lists3'] = $this->model_fao->getAll_file_from_pension_superintendent();
			$data['title'] = "FAO";
			$data['content'] = $this->load->view('administrator/fao/view',$dp, true);
			$this->load->view('administrator/default_template', $data);	
	    }
	    	
    }

    function load_editremarks($file_No='')
    {
            $file_No=base64_decode($file_No);
                    
            $data['title']   = "Check IPS Observations";
            $dv['receipt']   =$this->model_fao->get_record($file_No);

            $data['content'] = $this->load->view('administrator/fao/edit_remarks',$dv, true);
            $this->load->view('administrator/default_template', $data);
        
            
     }

     function edit_remarks_controller()
    {
        
        if($_POST) {
            $ret=$this->model_fao->edit_ips_observation();
            $this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
            redirect('administrator/fao/index');
            $this->load->view('administrator/default_template', $data);
            
            } else {
            //$dv['receipt']=$this->model_ips->get_receipt($file_No);
            redirect('administrator/fao/load_editremarks');
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

    function print_pension_observation($file_no)
    {
        $file_No=base64_decode($file_no);
        
        $q=$this->db->query("select a.case_no,a.remarks,b.dept_forw_no,b.receipt_date,b.pensionee_name,b.designation,c.address_department,d.salutation from observation a, pension_receipt_file_master b, pension_receipt_register_master c,pension_receipt_file_master d where a.case_no=b.file_no and c.dept_forw_no=b.dept_forw_no and a.case_no='$file_No'");
        $result = $q->result();
        $res['resu'] = $result;
      
        $data['title'] = "IPS detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/ips/pension_observations', $res, true);
        $this->load->view('administrator/default_template', $data);
    }

	function fao_confirm_for_approval()
	{
		$file=base64_decode($_GET['file']);
		$result=$this->model_notification->fao_confirm_for_approval($file);
		if($result) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	function confirm_by_fao_from_ips()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->confirm_by_fao_from_ips($file);
		echo json_encode($json);
	}
	
	function confirm_fao_from_pension_superintendent()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->confirm_fao_from_pension_superintendent($file);
		echo json_encode($json);
	}

    function view_report($file_No)
	{
		$file_No=base64_decode($file_No);
		$abc['values'] =get_ips_detail2($file_No);
		$data['title'] = "IPS detail Report";
		$data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $abc, true);
		$this->load->view('administrator/default_template', $data);
	}

	function view_checklist($file_no)
	{
		$file_no=base64_decode($file_no);
        $pid['values'] =get_checklist_details($file_no);
        $data['title'] = "Checklist detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
	    $this->load->view('administrator/default_template', $data);
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
		    $pid['values'] = get_checklist_details($file_no);
			$data['title'] = "Checklist detail Report";
		    $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_other', $pid, true);
			$this->load->view('administrator/default_template', $data);
	    }
	}
	
	function save_fwd_by_fao()
	{
		$ret=$this->model_fao->save_fwd_by_fao();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/fao');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/fao');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/fao');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated  </div>");
			redirect('administrator/fao');
		}
   	}
   
   	function pension_save_fwd_by_fao()
	{
		$ret=$this->model_fao->pension_save_fwd_by_fao();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/fao');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/fao');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/fao');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated  </div>");
			redirect('administrator/fao');
		}
   	}

   	function  ips_save_forwrd_by_fao()
	{
		$ret=$this->model_fao->ips_save_forwrd_by_fao();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/fao');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/fao');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/fao');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated  </div>");
			redirect('administrator/fao');
		}
   	}
}