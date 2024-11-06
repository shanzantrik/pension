<?php

class Model_idcard extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function getIdCardDesign() {
		$this->db->select('setting_value');
		$this->db->where('setting_name', 'idcardDesign');
		$this->db->from('settings');
		$result = $this->db->get();
		$row = $result->row();
		return $row->setting_value;
	}

	function getValue($serial_no) {
		$this->db->select('pensioner_personal_details.name, pensioner_family_details.family_info, pensioner_treasury_details.address_after_retirement, pensioner_treasury_details.phone_no, pensioner_personal_details.dob, pensioner_personal_details.class_of_pension, pensioner_personal_details.designation, pensioner_pay_details.pay_scale, pensioner_pay_details.pay_info, pensioner_service_details.net_qualifying_service');
    	$this->db->from('pensioner_personal_details');
    	$this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
    	$this->db->join('pensioner_family_details', 'pensioner_family_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	}

	function getAE($serial_no) {
		$data = $this->getServiceDetails($serial_no);
		$var = (object) $data[0];
		$pay_info = unserialize($var->pay_info);
		$lp = array();
		foreach ($pay_info[0] as $key => $value) {
			$lp[$key] = $value;
		}
		$ip = array();
		foreach ($pay_info[1] as $key => $value) {
			$ip[$key] = $value;
		}

		$averageEmolument = getAverageEmolument($lp, $ip, $var->dor, $pay_info[2]['last_increament_date']);
		return $averageEmolument;
	}

	function getServiceDetails($serial_no) {
    	//$this->db->select('pensioner_personal_details.class_of_pension, pensioner_personal_details.pension_category, pensioner_personal_details.pension_for, pensioner_personal_details.pension_scheme, pensioner_pay_details.pay_info, pensioner_service_details.dor, pensioner_service_details.net_qualifying_service');
		$this->db->select('pensioner_personal_details.class_of_pension, pensioner_personal_details.pension_category, pensioner_personal_details.pension_for, pensioner_personal_details.pension_scheme,pensioner_pay_details.pay_commission,pensioner_pay_details.pay_info, pensioner_service_details.dor, pensioner_service_details.net_qualifying_service');
    	$this->db->from('pensioner_personal_details');
    	$this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
		//$this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
    }
}