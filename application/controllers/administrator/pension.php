<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pension extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->helper('base');
		$this->load->model(array('administrator/model_pension', 'administrator/model_notification'));
	}

	function index()
	{
		redirect(site_url('administrator/pension/file'));
	}

	function view_file()
	{
		if (!empty($_GET['id'])) {
		$department=$_GET['id'];

		$data['file_no']=$this->model_notification->getfile_no_from_pensioner_personal_details();
        $data['records']=$this->model_notification->getDA_filter($department);
		$data['records1']=$this->model_notification->getDirector_filter($department);
		$data['records2']=$this->model_notification->getIps_filter($department);
		$data['title']="Filtered Files";

		//echo json_encode($data);
		$data['content'] =$this->load->view('administrator/notification/da_index',$data, true);
		$this->load->view('administrator/filtered',$data);
		}
		else{
		$dv['file_no']=$this->model_notification->getfile_no_from_pensioner_personal_details();
        $dv['records']=$this->model_notification->getDANotifiction();
		$dv['records1']=$this->model_notification->getfile_Director();
		$dv['records2']=$this->model_notification->getfile_ips();
		$data['title']="All Files";
		$data['content'] =$this->load->view('administrator/notification/da_index',$dv, true);
		$this->load->view('administrator/default_template',$data);
		}
		
	    
	}

	function search_family()
	{
	  $serial_no = $this->model_pension->get_serial_no($this->input->post('file_no'));
	  $vrp['values'] = $this->model_pension->get_servicebook($serial_no);
	  $data['title'] = "Reauthorization";
	  $data['content'] = $this->load->view('administrator/pension/superannuation_after/superannuation_pension', $vrp, true);
	  $this->load->view('administrator/default_template', $data);
	}
	
	function file()
	{
		if($_POST) {
			if ($this->form_validation->run('pension_file_search_form')== FALSE){
				$data['title'] = "Search File No";
				$data['content'] = $this->load->view('administrator/pension/search_file', '', true);
				$this->load->view('administrator/default_template',$data);
			} else {
				//check file no class of pension...
				$class_of_pension = $this->model_pension->get_pension_class_by_case_no($this->input->post('file_no'));
				$serial_no = $this->model_pension->get_serial_no($this->input->post('file_no'));
				switch($class_of_pension){
					case 'Superannuation_Pension':
						redirect(site_url('administrator/pension/superannuation_pension/'.$serial_no));
						break;
					case 'Voluntary_Retirement_Pension':
						redirect(site_url('administrator/pension/voluntary_retirement_pension/'.$serial_no));
						break;
					case 'Invalid_Retirement_Pension':
						redirect(site_url('administrator/pension/invalid_retirement_pension/'.$serial_no));
						break;
					case 'Absorption_in_autonomous_body_pension':
						redirect(site_url('administrator/pension/absorption_in_autonomous_body_pension/'.$serial_no));
						break;
					case 'Disability_Pension':
						redirect(site_url('administrator/pension/disability_pension/'.$serial_no));
						break;
					case 'Extraordinary_Pension':
						redirect(site_url('administrator/pension/extraordinary_pension/'.$serial_no));
						break;
					case 'Liberalised_Pension':
						redirect(site_url('administrator/pension/liberalised_pension/'.$serial_no));
						break;
					case 'Dependent_Pension':
						redirect(site_url('administrator/pension/dependent_pension/'.$serial_no));
						break;
					case 'Parents_Pension':
						redirect(site_url('administrator/pension/parents_pension/'.$serial_no));
						break;
					case 'Compulsory_Retirement_Pension':
						redirect(site_url('administrator/pension/compulsory_retirement_pension/'.$serial_no));
						break;
					case 'Normal_Family_Pension':
						redirect(site_url('administrator/pension/normal_family_pension/'.$serial_no));
						break;
					default:
						$this->session->set_flashdata('message', 'File no. is not matched.');
						redirect(site_url('administrator/pension/file'));
						break;
				}
			}
		} else {
			$data['title'] = "Pension Department";
			$data['content'] = $this->load->view('administrator/pension/search_file', '', true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function superannuation_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Superannuation_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Superannuation pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/superannuation_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function compulsory_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Compulsory_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Compulsory Retirement Pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/compulsory_retirement_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function voluntary_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Voluntary_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Voluntary retirement pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/voluntary_retirement_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function invalid_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Invalid_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Invalid retirement pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/invalid_retirement_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function absorption_in_autonomous_body_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Absorption_in_autonomous_body_pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Absorption in autonomous body pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/absorption_in_autonomous_body_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function disability_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Disability_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Disability pension";
			$data['content'] = $this->load->view('administrator/pension/superannuation_after/disability_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function normal_family_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Normal_Family_Pension'){
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Sanjay', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->sanjay;
			$data['title'] = "Normal Family Pension";
			$data['content'] = $this->load->view('administrator/pension/family/normal_family_pension', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function extraordinary_pension($serial_no)
	{
		$this->load->helper('pension/family/extraordinary_pension');
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Extraordinary_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$ep['values'] = $this->pensioner;
			$data['title'] = "Extraordinary pension";
			$data['content'] = $this->load->view('administrator/pension/family/extraordinary_pension', $ep, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function liberalised_pension($serial_no)
	{
		$this->load->helper('pension/family/liberalised_pension');
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Liberalised_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$ep['values'] = $this->pensioner;
			$data['title'] = "Liberalised pension";
			$data['content'] = $this->load->view('administrator/pension/family/liberalised_pension', $ep, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function dependent_pension($serial_no)
	{
		$this->load->helper('pension/family/dependent_pension');
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Dependent_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$ep['values'] = $this->pensioner;
			$data['title'] = "Dependent pension";
			$data['content'] = $this->load->view('administrator/pension/family/dependent_pension', $ep, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function parents_pension($serial_no)
	{
		$this->load->helper('pension/family/parents_pension');
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Parents_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$ep['values'] = $this->pensioner;
			$data['title'] = "Parents pension";
			$data['content'] = $this->load->view('administrator/pension/family/parents_pension', $ep, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function _check_file_no($case_no)
	{
		if (!$this->model_pension->check_file_no($case_no)) {
			$this->form_validation->set_message('check_file_no', 'The %s is not matched.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function get_pensioner_info() {
		$status = array();
		$this->db->select('case_no, name, class_of_pension');
		$this->db->where('case_no', $_POST['file_no']);
		$query = $this->db->get('pensioner_personal_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			$status['status'] = 'ok';
			$status['message'] = 'File No : '.$row->case_no.'<br />Name : '.$row->name.'<br />Class of Pension : '.str_replace("_", " ", $row->class_of_pension);
		} else {
			$status['status'] = 'not_ok';
			$status['message'] = 'File Number do not Exist';
		}
		echo json_encode($status);
	}


	//revision start from here.. add module and permission
	function revision_index()
	{
		if($this->input->post('file_no') != '' || $this->uri->segment(4)) :
			$file_no = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$row = $this->model_pension->check_file_no($file_no);
			if($row) :
				$index['service_details'] = $this->model_pension->get_pensioner_details($file_no);
				$index['revision_details'] = $this->model_pension->get_revision_details($file_no);
				$data['title'] = 'Revision';
				$data['content'] = $this->load->view('administrator/pension/revision/index', $index, true);
				$this->load->view('administrator/default_template', $data);
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/pension/revision_index'));
			endif;
		else :
			$data['title'] = 'Revision';
			$data['content'] = $this->load->view('administrator/pension/revision/index', '', true);
			$this->load->view('administrator/default_template', $data);
		endif;
	}

	function revision_add($file_no = '')
	{
		if($this->input->post('file_no') != '' || $file_no != '') :
			$file_no = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$row = $this->model_pension->check_file_no($file_no);
			if($row) :
				$revisionDetails = $this->model_pension->checkInRevision($file_no);

				if( $revisionDetails->num_rows() > 0 ) :
					$data = $this->model_pension->get_revision_details($file_no);
					$data[0]['amountofpension'] = $data[0]['revised_amount_of_pension'];
					$data[0]['prerevised_dcrg'] = $data[0]['revised_dcrg'];
					$data[0]['revision_da']		= $data[0]['revision_da'];
					$data[0]['created_at'] 		= $data[0]['ppd_created_at'];
					$form['data'] 				= (object) $data[0];
				else :
					$form['data'] = $this->model_pension->get_pensioner_details($file_no);
				endif;
				
				$data['title'] = 'Revision Form';
				$data['content'] = $this->load->view('administrator/pension/revision/form', $form, true);
				$this->load->view('administrator/default_template', $data);
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/pension/revision_index'));
			endif;
		else :
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please fill the file number field and press search button.</div>');
			redirect(site_url('administrator/pension/revision_index'));
		endif;
	}

	function revision_save()
	{
		if($_POST) :
            if($this->model_pension->add_revision()) {
				$this->session->set_flashdata('message','<div class="alert alert-success">Details saved successfully.</div>');
				redirect('administrator/pension/revision_index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/pension/revision_index');
			}
		else :
			redirect(site_url('administrator/pension/revision_index'));
		endif;
	}

	function revision_save_rg()
	{
		if($_POST) :
            if($this->model_pension->add_revision_rg()) {
				$this->session->set_flashdata('message','<div class="alert alert-success">Details saved successfully.</div>');
				redirect('administrator/pension/revision_index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/pension/revision_index');
			}
		else :
			redirect(site_url('administrator/pension/revision_index'));
		endif;
	}

    function revised_worksheet($id)
    {
		$pv['getDetails_revision']=$this->model_pension->get_revision_details($id, true);
		$pay_commission=$pv['getDetails_revision']['0']['pay_commission'];
		if($pv['getDetails_revision'][0]['revision_type']=="revised_gratuity") :
			$data['title']="Revised Worksheet";
			$data['content'] = $this->load->view('administrator/pension/revision/worksheet_gratuity', $pv, true);
			$this->load->view('administrator/default_template', $data);
		else :
			if(count($pv['getDetails_revision']) > 0) :
				if($pay_commission=="6") :
					$data['title']="Revised Worksheet";
					$data['content'] = $this->load->view('administrator/pension/revision/worksheet_5', $pv, true);
					$this->load->view('administrator/default_template', $data);
				else :
					$data['title']="Revised Worksheet";
					$data['content'] = $this->load->view('administrator/pension/revision/worksheet_5', $pv, true);
					$this->load->view('administrator/default_template', $data);
				endif;
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File number not found in our records.</div>');
				redirect(site_url('administrator/pension/revision_index'));
			endif;
		endif;
	}

    function revised_authority_report($id,$case_no)
    {
    	//$file_no=base64_decode($case_no);
    	$file_no=base64_decode($case_no);
    	$data['title'] = "Authority Report";
    	$pv['pensioner_details'] = $this->model_pension->get_pensioner_details($file_no);
    	//print_r($pv['pensioner_details']);
		$pv['getDetails_revision']=$this->model_pension->get_revision_details($id, true);
    	$data['content'] = $this->load->view('administrator/pension/revision/authority_report', $pv, true);
    	$this->load->view('administrator/default_template', $data);
    }

    function family_revised_authority_report_inside($id,$case_no)
    {
    	//$file_no=base64_decode($case_no);
    	$file_no=base64_decode($case_no);
    	$data['title'] = "Authority Report";
    	$pv['pensioner_details'] = $this->model_pension->get_pensioner_details($file_no);
    	//print_r($pv['pensioner_details']);
		$pv['getDetails_revision']=$this->model_pension->get_revision_details($id, true);
    	$data['content'] = $this->load->view('administrator/pension/revision/family_authority_report_inside', $pv, true);
    	$this->load->view('administrator/default_template', $data);
    }

    function family_revised_authority_report_outside($id,$case_no)
    {
    	//$file_no=base64_decode($case_no);
    	$file_no=base64_decode($case_no);
    	$data['title'] = "Authority Report";
    	$pv['pensioner_details'] = $this->model_pension->get_pensioner_details($file_no);
    	//print_r($pv['pensioner_details']);
		$pv['getDetails_revision']=$this->model_pension->get_revision_details($id, true);
    	$data['content'] = $this->load->view('administrator/pension/revision/family_authority_report_outside', $pv, true);
    	$this->load->view('administrator/default_template', $data);
    }

    function revised_gratuity($id,$case_no)
    {
    	//$file_no=base64_decode($case_no);
    	$file_no=base64_decode($case_no);
    	$data['title'] = "Authority Report";
    	$pv['pensioner_details'] = $this->model_pension->get_pensioner_details($file_no);
    	//print_r($pv['pensioner_details']);
		$pv['getDetails_revision']=$this->model_pension->get_revision_details($id, true);
    	$data['content'] = $this->load->view('administrator/pension/revision/gratuity_report', $pv, true);
    	$this->load->view('administrator/default_template', $data);
    }

	function get_enhance_rate()
	{
		if($_POST) :
			$last_pay 	= $this->input->post('last_pay');
			$case_no 	= $this->input->post('case_no');
			if(!empty($last_pay) && !empty($case_no)) :

				$row = $this->model_pension->get_pensioner_details($case_no);

				$nqs = $row->net_qualifying_service;
				$dor = $row->dor;
				$dod = $row->dod;
				$class_of_pension = $row->class_of_pension;
				echo getEnhanceRate($last_pay, $nqs, $dor, $dod, $class_of_pension, false);

			else :
				echo '0';
			endif;
		else :
			echo 'redirect';
		endif;
	}

	////from bikram file
	/*function get_revision_average_emolument()
	{
		if($_POST) :
			$re_last_pay 	= $this->input->post('re_last_pay');
			$re_grade_pay 	= $this->input->post('re_grade_pay');
			$post_BP 		= $this->input->post('post_BP');
			$post_GP 		= $this->input->post('post_GP');
			$dor 			= $this->input->post('dor');
			$doi 			= $this->input->post('doi');
			if(!empty($re_last_pay) && !empty($re_grade_pay)) :
				$increament_BP = $re_last_pay - $post_BP;
				$increament_GP = $re_grade_pay - $post_GP;
				$lp = array('post_BP'=>$re_last_pay, 'post_GP'=>$re_grade_pay);
				$ip = array('increament_BP'=>$increament_BP, 'increament_GP'=>$increament_GP);
				echo getAverageEmolument($lp, $ip, $dor, $doi);
			else :
				echo '0';
			endif;
		else :
			echo '0';
		endif;
	}*/

	//from sanjay file
	function get_revision_average_emolument()
	{
		if($_POST) :
			$re_last_pay 	= $this->input->post('re_last_pay');
			$re_grade_pay 	= $this->input->post('re_grade_pay');
			$post_BP 		= $this->input->post('post_BP');
			$post_GP 		= $this->input->post('post_GP');
			$increament_BP  = $this->input->post('increament_BP');
			$increament_GP  = $this->input->post('increament_GP');

			$dor 			= $this->input->post('dor');
			$doi 			= $this->input->post('doi');

			$incr_BP 		= $post_BP-$increament_BP;
			$incr_GP 		= $post_GP-$increament_GP;
			if(!empty($re_last_pay) && !empty($re_grade_pay)) :
				$increament_BP = $re_last_pay - $post_BP;
				$increament_GP = $re_grade_pay - $post_GP;
				$lp = array('post_BP'=>$re_last_pay, 'post_GP'=>$re_grade_pay);
				$ip = array('increament_BP'=>$increament_BP,'increament_GP'=>$increament_GP);
				
				echo getAverageEmolument($lp, $ip, $dor, $doi, $incr_BP, $incr_GP, $post_BP, $post_GP);
			else :
				echo '0';
			endif;
		else :
			echo '0';
		endif;
	}

	/*function get_revision_commutation_of_pension()
	{
		if($_POST) :
			$amountofPension 	= $this->input->post('amountofPension');
			$age_at_retirement 	= $this->input->post('age_at_retirement');
			$class_of_pension 	= $this->input->post('class_of_pension');
			if(!empty($amountofPension) && !empty($age_at_retirement) && !empty($class_of_pension)) :
				echo getCommutationofPension($amountofPension, $age_at_retirement, $class_of_pension);
			else :
				echo '0';
			endif;
		else :
			echo '0';
		endif;
	}*/
	function get_revision_commutation_of_pension()
	{
        if($_POST) :
			$amountofPension 	= $this->input->post('amountofPension');
			$age_at_retirement 	= $this->input->post('age_at_retirement');
			$class_of_pension 	= $this->input->post('class_of_pension');
			$pay_commission 	= $this->input->post('pay_commission');
			echo getCommutationofPension($pay_commission,$amountofPension, $age_at_retirement, $class_of_pension);
		else :
			echo '0';
		endif;
	}

	function get_revision_dcrg()
	{
		if($_POST) :
			$serial_no 	= ($this->input->post('serial_no') != '') ? $this->input->post('serial_no') : '' ;
			$basic_pay 	= ($this->input->post('basic_pay') != '') ? $this->input->post('basic_pay') : '' ;
			$grade_pay 	= ($this->input->post('grade_pay') != '') ? $this->input->post('grade_pay') : '' ;
			$revision_da= ($this->input->post('revision_da') != '') ? $this->input->post('revision_da') : '' ;
             // return $serial_no;
			$array = array('post_BP'=>$basic_pay, 'post_GP'=>$grade_pay, 'revision_da'=>$revision_da);
			echo getDCRG($serial_no, true, $array);
		else :
			echo '0';
		endif;
	}
}