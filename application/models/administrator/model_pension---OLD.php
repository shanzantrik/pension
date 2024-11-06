<?php

class Model_pension extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function check_file_no($case_no) {
		$this->db->select('serial_no');
		$this->db->where('case_no', $case_no);
		$query = $this->db->get('pensioner_personal_details');

		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_pension_class($serial_no) {
		$this->db->select('class_of_pension');
		$this->db->where('serial_no', $serial_no);
		$query = $this->db->get('pensioner_personal_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->class_of_pension;
		} else {
			return "";
		}
	}

	function get_pension_class_by_case_no($case_no) {
		$this->db->select('class_of_pension');
		$this->db->where('case_no', $case_no);
		$query = $this->db->get('pensioner_personal_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->class_of_pension;
		} else {
			return "";
		}
	}

	function get_serial_no($case_no) {
		$this->db->select('serial_no');
		$this->db->where('case_no', $case_no);
		$query = $this->db->get('pensioner_personal_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->serial_no;
		} else {
			return "";
		}
	}

	function get_servicebook($serial_no) {
		$this->db->select('*');
    	$this->db->from('pensioner_personal_details');
    	$this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
    	$this->db->join('pensioner_family_details', 'pensioner_family_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	}

	function get_date_of_retirement($serial_no) {
		$this->db->select('dor');
		$this->db->where('serial_no', $serial_no);
		$query = $this->db->get('pensioner_service_details');
		$row = $query->row();
		return $row->dor;
	}

	function get_revision_details($case_no, $id = false)
	{
		//$this->db->select('pr.id, pr.case_no, pr.revision_type, pr.dod, pr.revised_scale_pay, pr.last_pay, pr.grade_pay, pr.revised_total, pr.revision_da, pr.average_emolument, pr.amount_of_pension_pre_revised, pr.fifty_of_ae, pr.fifty_of_last_pay, pr.pay_band_pay, pr.pay_band_grade_pay, pr.fifty_of_pay_band_plus_grade_pay, pr.revised_amount_of_pension, pr.revised_dcrg, pr.prerevised_dcrg, pr.total_payable, pr.revised_enhance_rate, pr.revised_ordinary_rate, pr.revised_cop, pr.revised_reduced_pension, pr.treasury, pr.pension_enhanced, pr.created_at as pr_created_at, ppd.serial_no, ppd.class_of_pension, ppd.ppo_no, ppd.gpo_no, ppd.cpo_no, ppd.salutation, ppd.name, ppd.dob, ppd.created_at as ppd_created_at, psd.dojac, psd.doj as doe, psd.dor, psd.dod as psddod, psd.total_service, psd.net_qualifying_service, psd.smp, psd.doj, pfd.family_info, ppds.pay_scale, ppds.pay_commission, ppds.pay_info, ppds.com_applied, ptd.sub_to');
		$this->db->select('pr.id, pr.case_no, pr.revision_type, pr.dod, pr.revised_scale_pay, pr.last_pay, pr.grade_pay, pr.revised_total, pr.revision_da, pr.average_emolument, pr.amount_of_pension_pre_revised, pr.fifty_of_ae, pr.fifty_of_last_pay, pr.pay_band_pay, pr.pay_band_grade_pay, pr.fifty_of_pay_band_plus_grade_pay, pr.revised_amount_of_pension, pr.revised_dcrg, pr.prerevised_dcrg, pr.total_payable, pr.revised_enhance_rate, pr.revised_ordinary_rate, pr.re_com_applied, pr.pre_revised_cop, pr.revised_cop, pr.revised_reduced_pension, pr.treasury, pr.pension_enhanced, pr.created_at as pr_created_at, ppd.serial_no, ppd.class_of_pension, ppd.ppo_no, ppd.gpo_no, ppd.cpo_no, ppd.salutation, ppd.name, ppd.dob, ppd.created_at as ppd_created_at, psd.dojac, psd.doj as doe, psd.dor as dor, psd.dod as psddod, psd.total_service, psd.net_qualifying_service, psd.smp, psd.doj, pfd.family_info, ppds.pay_scale, ppds.pay_commission, ppds.pay_info, ppds.com_applied, ptd.sub_to');
		$this->db->from('pensioner_revision as pr');
		$this->db->join('pensioner_personal_details as ppd', 'ppd.case_no = pr.case_no');
		$this->db->join('pensioner_service_details as psd', 'ppd.serial_no = psd.serial_no');
		$this->db->join('pensioner_family_details as pfd', 'ppd.serial_no = pfd.serial_no');
		$this->db->join('pensioner_pay_details as ppds', 'ppd.serial_no = ppds.serial_no');
		$this->db->join('pensioner_treasury_details as ptd', 'ppd.serial_no = ptd.serial_no');
		//if id true search with id otherwise search with case_no
		if($id == true) :
			$this->db->where(array('pr.id'=>$case_no));
		else :
			$this->db->where(array('pr.case_no'=>$case_no));
		endif;
		$this->db->order_by("pr.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	function check_revision($case_no)
	{
		$this->db->select('*');
		$this->db->from('pensioner_revision');
		$this->db->where(array('case_no'=>$case_no));
		$query = $this->db->get();
		if($query->num_rows() > 0) :
			return true;
		else :
			return false;
		endif;
	}

	function get_revision($id)
	{
		$this->db->select('*');
		$this->db->from('pensioner_revision');
		$this->db->where(array('id'=>$id));
		$query = $this->db->get();
		return $query->result_array();
	}
    function getToName($to_no)
    {
     	$this->db->select('title');
		$this->db->where('id', $to_no);
		$query = $this->db->get('master_treasury');
		$row = $query->row();
		return $row->title;
    }

	function get_pensioner_details($case_no)
	{
		//$this->db->select('ppd.serial_no, ppd.class_of_pension, ppd.case_no, ppd.name, ppd.dob, ppd.designation, ppd.created_at, psd.dojac, psd.doj, psd.dor, psd.dod, psd.net_qualifying_service, psd.smp, ppayd.pay_scale, ppayd.pay_commission');
		$this->db->select('*');
		$this->db->from('pensioner_personal_details');
		$this->db->where(array('pensioner_personal_details.case_no'=>$case_no));
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_family_details', 'pensioner_family_details.serial_no = pensioner_personal_details.serial_no', 'left');
        $this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');

		$query = $this->db->get();
 		return $query->row();
	}

	function add_revision() {
  		//$id			        			= $this->model_pension->getMaxId();
  		$case_no            				= $this->security->xss_clean($this->input->post('case_no'));
		$revision_type						= $this->security->xss_clean($this->input->post('revision_type'));
		$dod 								= $this->security->xss_clean($this->input->post('dod'));
		$revised_scale_pay 					= $this->security->xss_clean($this->input->post('revised_scale_pay'));
		$last_pay 							= $this->security->xss_clean($this->input->post('last_pay'));
		$grade_pay 		    				= $this->security->xss_clean($this->input->post('grade_pay'));
		$revised_total						= $this->security->xss_clean($this->input->post('revised_total'));
		$revision_da 						= $this->security->xss_clean($this->input->post('revision_da'));
		$average_emolument					= $this->security->xss_clean($this->input->post('average_emolument'));
		$amount_of_pension_pre_revised		= $this->security->xss_clean($this->input->post('amount_of_pension_pre_revised'));
		$fifty_of_ae 						= $this->security->xss_clean($this->input->post('fifty_of_ae'));
		$fifty_of_last_pay 					= $this->security->xss_clean($this->input->post('fifty_of_last_pay'));
		$pay_band_pay 						= $this->security->xss_clean($this->input->post('pay_band_pay'));
	 	$pay_band_grade_pay    				= $this->security->xss_clean($this->input->post('pay_band_grade_pay'));
	 	$fifty_of_pay_band_plus_grade_pay	= $this->security->xss_clean($this->input->post('fifty_of_pay_band_plus_grade_pay'));
  		$revised_amount_of_pension			= $this->security->xss_clean($this->input->post('revised_amount_of_pension'));
		$revised_dcrg 						= $this->security->xss_clean($this->input->post('revised_dcrg'));
		$prerevised_dcrg 					= $this->security->xss_clean($this->input->post('prerevised_dcrg'));
		$total_payable 						= $this->security->xss_clean($this->input->post('total_payable'));
	  	$revised_enhance_rate 				= $this->security->xss_clean($this->input->post('revised_enhance_rate'));
	  	$revised_ordinary_rate				= $this->security->xss_clean($this->input->post('revised_ordinary_rate'));
	  	$re_com_applied          			= $this->security->xss_clean($this->input->post('re_com_applied'));
	 	$pre_revised_cop          			= $this->security->xss_clean($this->input->post('pre_revised_cop'));
	  	$revised_cop          				= $this->security->xss_clean($this->input->post('revised_cop'));
		$revised_reduced_pension			= $this->security->xss_clean($this->input->post('revised_reduced_pension'));
        $treasury           				= $this->security->xss_clean($this->input->post('treasury'));
        $pension_enhanced   				= $this->security->xss_clean($this->input->post('pension_enhanced'));

		//$pensioner_revision = array('case_no'=>$case_no,'revision_type'=>$revision_type, 'dod'=>$dod, 'revised_scale_pay'=>$revised_scale_pay, 'last_pay'=>$last_pay, 'grade_pay'=>$grade_pay, 'revised_total'=>$revised_total, 'average_emolument'=>$average_emolument,'amount_of_pension_pre_revised'=>$amount_of_pension_pre_revised,'amount_of_pension_pre_revised'=>$amount_of_pension_pre_revised,'fifty_of_ae'=>$fifty_of_ae,'fifty_of_last_pay'=>$fifty_of_last_pay,'pay_band_pay'=>$pay_band_pay,'pay_band_grade_pay'=>$pay_band_grade_pay,'fifty_of_pay_band_plus_grade_pay'=>$fifty_of_pay_band_plus_grade_pay,'revised_amount_of_pension'=>$revised_amount_of_pension,'revised_dcrg'=>$revised_dcrg, 'prerevised_dcrg'=>$prerevised_dcrg, 'total_payable'=>$total_payable, 'revised_enhance_rate'=>$revised_enhance_rate,'revised_ordinary_rate'=>$revised_ordinary_rate,'revised_cop'=>$revised_cop,'revised_reduced_pension'=>$revised_reduced_pension,'treasury'=>$treasury,'pension_enhanced'=>$pension_enhanced);
		$pensioner_revision = array('case_no'=>$case_no,'revision_type'=>$revision_type, 'dod'=>$dod, 'revised_scale_pay'=>$revised_scale_pay, 'last_pay'=>$last_pay, 'grade_pay'=>$grade_pay, 'revised_total'=>$revised_total, 'average_emolument'=>$average_emolument,'amount_of_pension_pre_revised'=>$amount_of_pension_pre_revised,'amount_of_pension_pre_revised'=>$amount_of_pension_pre_revised,'fifty_of_ae'=>$fifty_of_ae,'fifty_of_last_pay'=>$fifty_of_last_pay,'pay_band_pay'=>$pay_band_pay,'pay_band_grade_pay'=>$pay_band_grade_pay,'fifty_of_pay_band_plus_grade_pay'=>$fifty_of_pay_band_plus_grade_pay,'revised_amount_of_pension'=>$revised_amount_of_pension,'revised_dcrg'=>$revised_dcrg, 'prerevised_dcrg'=>$prerevised_dcrg, 'total_payable'=>$total_payable, 'revised_enhance_rate'=>$revised_enhance_rate,'revised_ordinary_rate'=>$revised_ordinary_rate,'re_com_applied'=>$re_com_applied,'pre_revised_cop'=>$pre_revised_cop,'revised_cop'=>$revised_cop,'revised_reduced_pension'=>$revised_reduced_pension,'treasury'=>$treasury,'pension_enhanced'=>$pension_enhanced);
        if($this->db->insert('pensioner_revision', $pensioner_revision)) :
        	return true;
        else :
        	return false;
        endif;
	}

	/*function getMaxId()
	{
       	$this->db->select_max('id');
	    $result = $this->db->get('pensioner_revision');
	    $row = $result->result();
	    if($row[0]->id == '') {
	    	return "1";
	    } else {
	    	return $row[0]->id+1;
	    }
	}*/

	function checkInRevision($case_no)
	{
		$this->db->select('*');
		$query = $this->db->get_where('pensioner_revision', array('case_no' => $case_no));
		return $query;
	}

}