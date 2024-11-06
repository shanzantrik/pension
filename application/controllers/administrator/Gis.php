<?php

class gis extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_gis');
		$this->load->model('administrator/model_notification');
		$this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
	        $dp['lists']= $this->model_gis->getFilterReceipt($department);
	        $dp['file_no']= $this->model_gis->getfile_no_from_checklist_for_check();
			$dp['lists2'] = $this->model_gis->getFilterDirector($department);
			$dp['lists3'] = $this->model_gis->getFilterPension($department);
			$dp['lists4'] = $this->model_gis->getFilterObjection($department);
			$data['title'] = "GIS DA";
			$data['content'] = $this->load->view('administrator/gis/view',  $dp, true);
			$this->load->view('administrator/filtered', $data);
		}
		else{
			$dp['lists']= $this->model_gis->getAll();
	        $dp['file_no']= $this->model_gis->getfile_no_from_checklist_for_check();
			$dp['lists2'] = $this->model_gis->getfile_from_Director();
			$dp['lists3'] = $this->model_gis->getFileFromPensionDA();
			$dp['lists4'] = $this->model_gis->getfile_from_gis_superintendent_for_obj();
			$data['title'] = "GIS DA";
			$data['content'] = $this->load->view('administrator/gis/view',  $dp, true);
			$this->load->view('administrator/default_template', $data);

		}
	}

	function gis_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_confirm($file);
		echo json_encode($json);
	}

	function gis_confirm_after_approval()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_confirm_after_approval($file);
		echo json_encode($json);
	}

	function gis_confirm_after_final()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->gis_confirm_after_final($file);
		echo json_encode($json);
	}

	function view_checklist($file_no)
	{
		$file_no=base64_decode($file_no);
        $pid['values'] = $this->model_gis->get_checklist_details($file_no);
        $data['title'] = "Checklist detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
	    $this->load->view('administrator/default_template', $data);
	}

	function view_fr_edit_checklist()
	{
	    $gis['lists']=$this->model_gis->view_checklist_details();
		$data['title'] = "view Checklist";
		$data['content'] = $this->load->view('administrator/gis/view_checklist', $gis, true);
		$this->load->view('administrator/default_template', $data);
	}

	function print_checklist($file_no)
	{
		$file_no=base64_decode($file_no);
		$pid['values'] = $this->model_gis->get_checklist_details($file_no);
		$data['title'] = "Checklist detail Report";
		$data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
		$this->load->view('administrator/default_template', $data);
	}

	function objection_report($file_no)
	{
		$file_no=base64_decode($file_no);
		$pid['values'] = $this->model_gis->get_objection_details($file_no);
		$pid['obj']=$this->model_gis->get_objection_master($file_no);
		//print_r($pid['obj']);
		//exit();
		$data['title'] = "Checklist detail Report";
		$data['content'] = $this->load->view('administrator/pension/report/gis/return-form', $pid, true);
		$this->load->view('administrator/default_template', $data);
	}

	function edit_checklist($file_no)
	{
	  	$file_no=base64_decode($file_no);
      	if($file_no=='')
      	{
     		redirect(site_url('fcvadministrator/gis'));
      	} 
     	elseif($_POST)
	  	{	
			if($this->model_gis->update_checklist($file_no))
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Checklist Details have been modified successfully.</div>');
				redirect('administrator/gis/edit_checklist/'.base64_encode($file_no));
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update. Please try again.</div>');
				redirect('administrator/ips/edit_ips/'.$file_No);
			}
	 	}
	  	else
	   	{
			$gis['records']=$this->model_gis->get_checklist_details($file_no);
			$gis['obj']=$this->model_gis->get_objection_master($file_no);
			$gis['file_no']=$file_no;
			$data['title'] = "Edit Checklist";
			$data['content'] = $this->load->view('administrator/gis/edit_checklist', $gis, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function save_fwd()
	{
		$ret=$this->model_gis->save_forwrd_gis_Superintendent_file();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS Superintendent</div>");
			redirect('administrator/gis');
		}
	}

	function save_fwd_after_approval()
	{
		$ret=$this->model_gis->save_forwrd_gis_Superintendent_after_approval();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/gis');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/gis');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to GIS Superintendent</div>");
			redirect('administrator/gis');
		}
	}

	function attach_authority($file_no)
	{
		$file_no=base64_decode($file_no);
		$dept_forwading_no = $this->model_gis->get_dept_forwarding_no($file_no);
		$get_district_id= $this->model_gis->get_district_id($dept_forwading_no);
		$pid['district_id']=$get_district_id;
		$group=$this->model_gis->get_group_of_employee($file_no);
		$pid['values'] = $this->model_gis->get_checklist_details($file_no);
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

	function calculateDateDifference()
	{
		$date1 = new DateTime($_POST['date1']);
		$date2 = new DateTime($_POST['date2']);
		$date1->modify('+1 day');
		$result = $date1->diff($date2);
		$date = array('year'=>$result->y, 'month'=>$result->m, 'day'=>$result->d);
		if($_POST['jsonData']=="true") {
			echo json_encode($date);
		} else {
			echo $result->y.' years '.$result->m.' months '.$result->d.' days';
		}
	}

	function attach_checklist($file_no='')
	{
	    if($_POST)
  	    {
			$this->form_validation->set_rules('vill_town', 'Village/Town','required');
			$this->form_validation->set_rules('po', 'Post Office', 'required');
			$this->form_validation->set_rules('district', 'District ','required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('doj', 'Date of Entry', 'required');
			$this->form_validation->set_rules('office_address', 'office address', 'required');
			$this->form_validation->set_rules('dor', 'Date of Retirement', 'required');
			$this->form_validation->set_rules('dom', 'Date of membership', 'required');
			$this->form_validation->set_rules('d_of_settlement', 'Date of Settlement of pension', 'required');
			$this->form_validation->set_rules('date_of_cessation', 'Date of cessation of pension', 'required');
			$this->form_validation->set_rules('dom_group', 'Date of membership', 'required');
			$this->form_validation->set_rules('doc_group', 'Date of membership', 'required');
			$this->form_validation->set_rules('TO','TO/STO', 'required');

			if($this->form_validation->run() == FALSE)
			{
			    $file_no=base64_decode($file_no);
				$branch_code = $this->model_gis->get_branch_code($file_no);
				$serial_no = $this->model_gis->get_serial_no($file_no);
		    	$dv['records']=$this->model_gis->fetchData($file_no,$serial_no);
				$dv['branch_code']=$branch_code;
			    $dv['obj']=$this->model_gis->get_objection_master($file_no);
			    $dv['file_no']=$file_no;
				$data['title'] = "Add GIS";
				$data['content'] = $this->load->view('administrator/gis/viewform', $dv, true);
				$this->load->view('administrator/default_template', $data);
		 	} else {
		 	  	$file_no=base64_decode($file_no);
		 	  	$check_file_no = $this->model_gis->check_file_no($file_no);
				if($check_file_no=='')
				{
		 	  		if($this->model_gis->add_checklist($file_no))
		 	        { 
						$pid['values'] = $this->model_gis->get_checklist_details($file_no);
						$data['title'] = "Checklist detail Report";
						$data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
						$this->load->view('administrator/default_template', $data);
				    } else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Insertion.</div>');
						redirect('administrator/gis/');
		 		    }
                } else {
                  	$this->session->set_flashdata('message', '<div class="alert alert-success">This File Number already exists.</div>');
					redirect('administrator/gis/attach_checklist/'.base64_encode($file_no));
                }
            }
        } else {
            $file_no=base64_decode($file_no);
			$branch_code = $this->model_gis->get_branch_code($file_no);
			$serial_no = $this->model_gis->get_serial_no($file_no);
		    $dv['records']=$this->model_gis->fetchData($file_no,$serial_no);
			$dv['branch_code']=$branch_code;
		    $dv['obj']=$this->model_gis->get_objection_master($file_no);
		    $dv['file_no']=$file_no;
			$data['title'] = "Add GIS";
			$data['content'] = $this->load->view('administrator/gis/viewform',$dv,true);
			$this->load->view('administrator/default_template',$data);
       	}
	}

	function get_gis_chart()
	{
		$from 	= $_POST['from'];
		$to 	= $_POST['to'];

		list($for_year, $for_month, $for_day) = explode("-", $to);
		list($to_year, $to_month, $to_day) = explode("-", $from);

		switch($for_month) :
			case 1:
				$select = 'jan';
				break;
			case 2:
				$select = 'feb';
				break;
			case 3:
				$select = 'mar';
				break;
			case 4:
				$select = 'apr';
				break;
			case 5:
				$select = 'may';
				break;
			case 6:
				$select = 'jun';
				break;
			case 7:
				$select = 'jul';
				break;
			case 8:
				$select = 'aug';
				break;
			case 9:
				$select = 'sep';
				break;
			case 10:
				$select = 'oct';
				break;
			case 11:
				$select = 'nov';
				break;
			case 12:
				$select = 'dec';
				break;
		endswitch;

		$query = $this->db->query("SELECT `$select` FROM master_gis_chart where for_year=$for_year and year_of_entry=$to_year");

		if($query->num_rows() > 0) :
			$data = $query->result_array();
			$data1 = $data[0];
			echo $data1[$select];
		else :
			echo '';
		endif;
	}
}