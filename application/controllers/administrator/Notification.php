<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notification extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();			
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');	
		$this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];

	        $data['records']=$this->model_notification->getNotifiction_filter($department);
			$data['da']=$this->model_notification->getDA();
			$data['title']="Filtered Files";
			$data['content'] =$this->load->view('administrator/notification/index',$data, true);
			$this->load->view('administrator/filtered',$data);
		}
		else{
			$dv['records'] = $this->model_notification->getNotifiction();
			$data['title'] = "All Files";
			$dv['da']=$this->model_notification->getDA();
			$data['content'] = $this->load->view('administrator/notification/index', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
		
	}

	function load_editremarks($file_No='')
    {
            $file_No=base64_decode($file_No);
                    
            $data['title']   = "Check IPS Observations";
            $dv['receipt']   = $this->model_notification->get_record($file_No);

            $data['content'] = $this->load->view('administrator/pension_superintendent/edit_remarks',$dv, true);
            $this->load->view('administrator/default_template', $data);
        
            
     }

     function edit_remarks_controller()
    {
        
        if($_POST) {
            $ret=$this->model_notification->edit_ips_observation();
            $this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
            redirect('administrator/notification/index');
            $this->load->view('administrator/default_template', $data);
            
            } else {
            //$dv['receipt']=$this->model_ips->get_receipt($file_No);
            redirect('administrator/notification/load_editremarks');
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

	//FILES RECEIVED FROM IPS
	function index2()
	{
		$dv['records'] = $this->model_notification->getNotifiction_SUPER_IPS();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	// FILES FROM NDC
	function index_ndc()
	{
		$dv['records'] = $this->model_notification->getNotifiction_SUPER_NDC();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->confirm($file);
		echo json_encode($json);
	}

	function da_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->da_confirm($file);
		echo json_encode($json);
	}

	function save_forwrd()
	{
		$url=$_POST['uri_val'];
		$ret=$this->model_notification->save_forwrd_director();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/notification/'.$url);
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/notification/'.$url);
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Done</div>");
			redirect('administrator/notification/'.$url);
		}
	}

	function from_director()
	{
		$dv['records'] = $this->model_notification->getNotificationfromDirector();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/from_director', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function save_forwrd_DA()
	{
		$ret=$this->model_notification->fwd_to_concern_da();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/notification/from_director');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/notification/from_director');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Dealing Assistant</div>");
			redirect('administrator/notification/from_director');
		}
	}

	function to_director_files()
	{
		$dv['records'] = $this->model_notification->to_director_files();
		$data['title'] = "Files from Dealing Assistant afrer Generation of PPO";
		$data['content'] = $this->load->view('administrator/notification/get_notifiction_tab3', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function confirm_tab3()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->confirm_tab3($file);
		echo json_encode($json);
	}

	function save_forwrd3()
	{
		$ret=$this->model_notification->save_forwrd3();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/notification/to_director_files');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/notification/to_director_files');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Director of Audit & Pension for Signature</div>");
			redirect('administrator/notification/to_director_files');
		}
	}
}