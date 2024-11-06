<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class service_book extends CI_Controller {
                 
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->model(array('administrator/model_service_book'));
		$this->load->helper(array('base', 'da', 'branch_master', 'designation', 'department'));
	}
	
	function index()
	{
		$sb['lists'] = $this->model_service_book->getAll();
		$data['title'] = "Service Book";
		$data['content'] = $this->load->view('administrator/service_book/view',$sb,true);
		$this->load->view('administrator/default_template',$data);
	}

	function add()
	{
		if($_POST){
			if ($this->form_validation->run('service_book_add_form') == FALSE){
				$dv['records']=$this->model_service_book->getPayComn();
				$data['title'] = "Service Book Entry";
				$data['content'] = $this->load->view('administrator/service_book/add', $dv, true);
				$this->load->view('administrator/default_template', $data);
			} else {

				//call model to insert data
				if($this->model_service_book->add()) {
					$this->session->set_flashdata('message','<div class="alert alert-success">Details saved successfully.</div>');
					redirect('administrator/service_book/add');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/service_book/add');
				}
			}
		} else {
			$dv['ppo']=$this->model_service_book->getPPONo();
			$dv['gpo']=$this->model_service_book->getGPONo();
			$dv['cpo']=$this->model_service_book->getCPONo();
			$dv['records']=$this->model_service_book->getPayComn();
			$data['title'] = "Service Book Entry";
			$data['content'] = $this->load->view('administrator/service_book/add', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function edit($serial_no='')
	{
		if($serial_no=='') {
			redirect(site_url('administrator/service_book'));
		} elseif($_POST) {
			if($this->model_service_book->update()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Details updated successfully.</div>');
				redirect('administrator/service_book/edit/'.$serial_no);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during updation.</div>');
				redirect('administrator/service_book/edit/'.$serial_no);
			}
		} else {
			$sb['records']=$this->model_service_book->getDataBySerialNo($serial_no);
			$sb['payComn']=$this->model_service_book->getPayComn();
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$sb['values'] = $this->pensioner;
			$data['title'] = "Edit Service Book";
			$data['content'] = $this->load->view('administrator/service_book/edit', $sb, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

    function add_file()
	{
		$dv['records']=$this->model_service_book->getPayComn();
		$data['title'] = "Service Book Entry";
		$data['content'] = $this->load->view('administrator/service_book/add',$dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function reportIO($cop, $serial_no) {
		$result = $this->model_service_book->reportIO(trim($serial_no));

		if($result == "exists") {
			$outside = site_url("administrator/outside/".strtolower(trim($cop))."/".$serial_no);
			redirect($outside);
		} else {
			$inside = site_url("administrator/inside/".strtolower(trim($cop))."/".$serial_no);
			redirect($inside);
		}
	}

	function saveAccountantName() {
		if($this->model_service_book->saveAccountantName()) {
			echo $this->db->insert_id();
		} else {
			echo "Error occured while insertion.";
		}
	}

	function saveTreasuryTitle() {
		if($this->model_service_book->saveTreasuryTitle()) {
			echo $this->db->insert_id();
		} else {
			echo "Error occured while insertion.";
		}
	}
	function save_DA() {
		if($this->model_service_book->save_DA()) {
			echo $this->db->insert_id();
		} else {
			echo "Error occured while insertion.";
		}
	}

	function check_file_no($file_no) {
		if($this->model_service_book->check_file_no($file_no)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_file_no', 'The %s not exists.');
			return FALSE;
		}
	}

	function check_default($str) {
		if ($str == "0") {
			$this->form_validation->set_message('check_default', 'The %s field must be selected.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function getFileDetails()
	{
		$result = $this->model_service_book->getFileDetails();
		if(count($result) > 0) :
			$file_no = $result[0]['file_No'];
			$salutation=$result[0]['salutation'];
			if($salutation=="Shri" || $salutation=="Late") {
				$sex="Male";
			} else {
				$sex = "Female";
			}
			$allFiles = $this->model_service_book->getFiles($file_no);
			$files = array();
			if(!empty($allFiles)){
				foreach ($allFiles as $key => $value) {
					array_push($files, getDocumentName($value['doc_code']));
				}
			}

			$retire_age = getRetireAge($result[0]['designation']);

			$returnArr = array('receipt_date'=>$result[0]['receipt_date'], 'pensionee_name'=>$result[0]['pensionee_name'],'sex'=>$sex,'salutation'=>$result[0]['salutation'], 'designation'=>$result[0]['designation'], 'retire_age'=>$retire_age, 'files'=>implode(", ", $files), 'address_department'=>$result[0]['address_department']);
			echo json_encode($returnArr);
		else :
			echo '';
		endif;
	}

	function calculateDateDifference() {
		$date1 = new DateTime($_POST['date1']);
		$date2 = new DateTime($_POST['date2']);
		//$date2->modify('+1 day');
		$result = $date1->diff($date2);
		$date = array('year'=>$result->y, 'month'=>$result->m, 'day'=>$result->d);
		if($_POST['jsonData']=="true") {
			echo json_encode($date);
		} else {
			echo $result->y.' years '.$result->m.' months '.$result->d.' days';
		}
	}

	function calculate_dor()
	{
	    $date1 = new DateTime($_POST['date1']);
		$designation = $_POST['desig'];
		if($designation=="Teacher" || $designation=="MTF(group D)"){
			$date1->modify('+60 year');
		} else {
			$date1->modify('+58 year');
		}
		$dor = date_format($date1, "Y-m-d");
		$dor_arr = explode("-", $dor);
		$dor_y=$dor_arr[0];
		$dor_m=$dor_arr[0];
		$dor_d=$dor_arr[0];

		if($_POST['jsonData']=="true")
		{
			echo json_encode();
		} else{
			echo $dor;
		}
	}

	function calculateNetQualifyingService() {
		$explodeTotalService = explode(" ", $_POST['total_service']);
		$ty = $explodeTotalService[0];
		$tm = $explodeTotalService[2];
		$td = $explodeTotalService[4];
		$explodeNonqs = explode(" ", $_POST['nonqs']);
		$ny = $explodeNonqs[0];
		$nm = $explodeNonqs[2];
		$nd = $explodeNonqs[4];
		$total_service = new DateTime();
		$total_service->modify('+'.$ty.' year'.' +'.$tm.' month'.' +'.$td.' day');
		$nonqs = new DateTime();
		$nonqs->modify('+'.$ny.' year'.' +'.$nm.' month'.' +'.$nd.' day');
		$result = $total_service->diff($nonqs);
		$date = array('year'=>$result->y, 'month'=>$result->m, 'day'=>$result->d);
		echo json_encode($date);
	}

	function pre_revised(){
		$id=$_GET['id'];
		$data['pay_id']=$id;
		//echo $id;
		$data['records']=$this->model_service_book->get_text_boxes($id);
		//if($id==6){
		$this->load->view('administrator/service_book/ajax_data_pre', $data);
		//}
		
	}
	
	function pre_revised_edit(){
		$id=$_GET['id'];
		$data['pay_id']=$id;
		//echo $id;
		$data['records']=$this->model_service_book->get_text_boxes($id);
		//if($id==6){
		$this->load->view('administrator/service_book/ajax_data_pre_edit', $data);
		//}
		
	}
	
	

	function revised(){
		$id=$_GET['id'];
		$data['records']=$this->model_service_book->get_text_boxes($id);
		$this->load->view('administrator/service_book/ajax_data', $data);
	}

	function save_vals(){
		$this->model_service_book->save_vals();
	}

	function getSevenpay()
    {
        //$payseven= $this->input->post('payCommission');
        $countryid=$_GET['country_id'];
        $select = $this->input->post('seven_pol');
        $this->db->select('id, grade,pay_slot');
        $this->db->from('master_pay_scale_seven');
        $this->db->where(array('grade'=>$countryid));
        $qry = $this->db->get();

        foreach ($qry->result_array() as $value) {
            if($value['id'] == $select) {
                echo '<option value="'.$value['pay_slot'].'" selected>'.$value['pay_slot'].'</option>';
            } else {
                echo '<option value="'.$value['pay_slot'].'">'.$value['pay_slot'].'</option>';
            }
        }
        
    }

    function SaveGraturity()
    {
    	$savegr=$_POST['savegr'];
    	$srno=$_POST['srno'];
    	$this->db->set('sixgratu', $savegr);
		$this->db->where('serial_no', $srno);
		$this->db->update('pensioner_pay_details');


    }

}