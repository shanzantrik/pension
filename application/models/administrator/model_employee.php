<?php

class Model_employee extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function index() {
		$this->db->select('id, name, role, user_id, designation, doj, dor, total_pay, account_no, photograph');
		$this->db->from('employees');
		$query = $this->db->get();
		return $query->result_array();
	}

	function add($filePath) {
		$name=$this->security->xss_clean($this->input->post('name'));
		$fhname=$this->security->xss_clean($this->input->post('fhname'));
		$dep=$this->security->xss_clean($this->input->post('branch_code'));
		$designation=$this->security->xss_clean($this->input->post('designation'));
		$dob=$this->security->xss_clean($this->input->post('dob'));
		$doj=$this->security->xss_clean($this->input->post('doj'));
		$dor=$this->security->xss_clean($this->input->post('dor'));
		$sex=$this->security->xss_clean($this->input->post('sex'));
		$category=$this->security->xss_clean($this->input->post('category'));
		$appointas=$this->security->xss_clean($this->input->post('appointas'));
		$pay_band=$this->security->xss_clean($this->input->post('pay_band'));
		$grade_pay=$this->security->xss_clean($this->input->post('grade_pay'));
		$increament_amount=$this->security->xss_clean($this->input->post('increament_amount'));
		$total_pay=$this->security->xss_clean($this->input->post('total_pay'));
		$sca=$this->security->xss_clean($this->input->post('sca'));
		$other_allowance=$this->security->xss_clean($this->input->post('other_allowance'));
		$da=$this->security->xss_clean($this->input->post('da'));
		$total_allowance=$this->security->xss_clean($this->input->post('total_allowance'));
		$total_emolument=$this->security->xss_clean($this->input->post('total_emolument'));
		$account_no=$this->security->xss_clean($this->input->post('account_no'));
		$bank_name=$this->security->xss_clean($this->input->post('bank_name'));
		$branch=$this->security->xss_clean($this->input->post('branch'));
		$ddo_address=$this->security->xss_clean($this->input->post('ddo_address'));
		$photograph=$filePath;
		$remarks=$this->security->xss_clean($this->input->post('remarks'));
		$employees_details = array('name'=>$name, 'fhname'=>$fhname, 'dep'=>$dep, 'designation'=>$designation, 'dob'=>$dob, 'doj'=>$doj, 'dor'=>$dor, 'sex'=>$sex, 'category'=>$category, 'appoint_as'=>$appointas, 'pay_band'=>$pay_band, 'grade_pay'=>$grade_pay, 'increament_amount'=>$increament_amount, 'total_pay'=>$total_pay, 'sca'=>$sca, 'other_allowance'=>$other_allowance, 'da'=>$da, 'total_allowance'=>$total_allowance, 'total_emolument'=>$total_emolument, 'account_no'=>$account_no, 'bank_name'=>$bank_name, 'branch'=>$branch, 'ddo_address'=>$ddo_address, 'photograph'=>$photograph, 'remarks'=>$remarks);

		if($this->db->insert('employees', $employees_details)) {
			return true;
		} else {
			return false;
		}
	}

	function update($id, $filePath) {

		$name=$this->security->xss_clean($this->input->post('name'));
		$user_id=$this->security->xss_clean($this->input->post('id'));
		$rand=rand(1000, 9000);
		$user_id='pen'.$rand;
		//dd($user_id);
		$role=$this->security->xss_clean($this->input->post('role'));
		
		$mobile_no=$this->security->xss_clean($this->input->post('mobile_no'));
		$fhname=$this->security->xss_clean($this->input->post('fhname'));
		$dep=$this->security->xss_clean($this->input->post('branch_code'));
		$designation=$this->security->xss_clean($this->input->post('designation'));
		$dob=$this->security->xss_clean($this->input->post('dob'));
		$doj=$this->security->xss_clean($this->input->post('doj'));
		$dor=$this->security->xss_clean($this->input->post('dor'));
		$sex=$this->security->xss_clean($this->input->post('sex'));
		$category=$this->security->xss_clean($this->input->post('category'));
		$appointas=$this->security->xss_clean($this->input->post('appointas'));
		$pay_band=$this->security->xss_clean($this->input->post('pay_band'));
		$grade_pay=$this->security->xss_clean($this->input->post('grade_pay'));
		$increament_amount=$this->security->xss_clean($this->input->post('increament_amount'));
		$total_pay=$this->security->xss_clean($this->input->post('total_pay'));
		$sca=$this->security->xss_clean($this->input->post('sca'));
		$other_allowance=$this->security->xss_clean($this->input->post('other_allowance'));
		$da=$this->security->xss_clean($this->input->post('da'));
		$total_allowance=$this->security->xss_clean($this->input->post('total_allowance'));
		$total_emolument=$this->security->xss_clean($this->input->post('total_emolument'));
		$account_no=$this->security->xss_clean($this->input->post('account_no'));
		$bank_name=$this->security->xss_clean($this->input->post('bank_name'));
		$branch=$this->security->xss_clean($this->input->post('branch'));
		$ddo_address=$this->security->xss_clean($this->input->post('ddo_address'));
		$remarks=$this->security->xss_clean($this->input->post('remarks'));
		if($this->input->post('password')!=''){
			$password=md5($this->input->post('password'));
			$employees_details = array('name'=>$name, 'role'=>$role, 'user_id'=>$user_id, 'mobile_no'=>$mobile_no, 'password'=>$password,  'fhname'=>$fhname, 'dep'=>$dep, 'designation'=>$designation, 'dob'=>$dob, 'doj'=>$doj, 'dor'=>$dor, 'sex'=>$sex, 'category'=>$category, 'appoint_as'=>$appointas, 'pay_band'=>$pay_band, 'grade_pay'=>$grade_pay, 'increament_amount'=>$increament_amount, 'total_pay'=>$total_pay, 'sca'=>$sca, 'other_allowance'=>$other_allowance, 'da'=>$da, 'total_allowance'=>$total_allowance, 'total_emolument'=>$total_emolument, 'account_no'=>$account_no, 'bank_name'=>$bank_name, 'branch'=>$branch, 'ddo_address'=>$ddo_address, 'remarks'=>$remarks);
	    }
	    else{
	    	$employees_details = array('name'=>$name, 'role'=>$role, 'user_id'=>$user_id, 'mobile_no'=>$mobile_no,  'fhname'=>$fhname, 'dep'=>$dep, 'designation'=>$designation, 'dob'=>$dob, 'doj'=>$doj, 'dor'=>$dor, 'sex'=>$sex, 'category'=>$category, 'appoint_as'=>$appointas, 'pay_band'=>$pay_band, 'grade_pay'=>$grade_pay, 'increament_amount'=>$increament_amount, 'total_pay'=>$total_pay, 'sca'=>$sca, 'other_allowance'=>$other_allowance, 'da'=>$da, 'total_allowance'=>$total_allowance, 'total_emolument'=>$total_emolument, 'account_no'=>$account_no, 'bank_name'=>$bank_name, 'branch'=>$branch, 'ddo_address'=>$ddo_address, 'remarks'=>$remarks);
	    }
		if(!empty($filePath)) { $employees_details['photograph'] = $filePath; }

		$this->db->where('id', $id);
		if($this->db->update('employees', $employees_details)) {
			return true;
		} else {
			return false;
		}
	}

	function add_budget() {
		$dep = $this->security->xss_clean($this->input->post('department'));
		$from = $this->security->xss_clean($this->input->post('budget_from'));
		$to = $this->security->xss_clean($this->input->post('budget_to'));
		$desc = $this->security->xss_clean($this->input->post('description'));
		$amount = $this->security->xss_clean($this->input->post('amount'));
		if($this->db->insert('employees_budget', array('dep'=>$dep, 'from'=>$from, 'to'=>$to, 'description'=>$desc, 'amount'=>$amount))) {
			return true;
		} else {
			return false;
		}
	}

	function getEmployeeDetails($id) {
		$result = $this->db->query('SELECT * FROM employees WHERE id="'.$id.'"');
		return $result->result_array();
	}

	function getImagePath($id) {
		$result = $this->db->query('SELECT photograph FROM employees WHERE id="'.$id.'"');
		$row = $result->row_array();
		return $row['photograph'];
	}

	function getRetirement() {
		$date = new DateTime(date('Y-m-d'));
		if($date->format("m") > 3) {
			$prevY = $date->format("Y");
			$p = $prevY."-4-1";

			$current = new DateTime(date('Y-m-d'));
			$current->modify("+1 year");
			$currentY = $current->format("Y");
			$c = $currentY."-3-31";
		} else {
			$date->modify("-1 year");
			$prevY = $date->format("Y");
			$p = $prevY."-4-1";

			$current = new DateTime(date('Y-m-d'));
			$currentY = $current->format("Y");
			$c = $currentY."-3-31";
		}
		$result = $this->db->query("SELECT name, DATE_FORMAT(dor, '%d-%m-%Y') as dor FROM `employees` where `dor` between '".$p."' and '".$c."' and `dor`>'".date('Y-m-d')."'");
		return $result->result_array();
	}

	function getTotalEmolument() {
		if(isset($_POST['search'])) {
			if($_POST['branch_code'] != 'all') {
				$result = $this->db->query('SELECT SUM( total_emolument ) AS total_emolument FROM `employees` Where `dep`="'.$_POST['branch_code'].'"');
			} else {
				$result = $this->db->query('SELECT SUM( total_emolument ) AS total_emolument FROM `employees`');
			}
		} else {
			$result = $this->db->query('SELECT SUM( total_emolument ) AS total_emolument FROM `employees`');
		}
		$row = $result->row_array();
		return $row['total_emolument'];
	}

	function getExtraBudget() {
		if(isset($_POST['search'])) {
			$p = $_POST['from'];
			$c = $_POST['to'];
			$dep = $_POST['branch_code'];
			if($_POST['branch_code'] != 'all') {
				$result = $this->db->query("SELECT dep, description, amount FROM `employees_budget` where `dep`='".$dep."' and `from`='".$p."' and `to`='".$c."'");
			} else {
				$result = $this->db->query("SELECT dep, description, amount FROM `employees_budget` where `from`='".$p."' and `to`='".$c."'");
			}
		} else {
			$date = new DateTime(date('Y-m-d'));
			if($date->format("m") > 3) {
				$prevY = $date->format("Y");
				$p = $prevY;

				$current = new DateTime(date('Y-m-d'));
				$current->modify("+1 year");
				$currentY = $current->format("Y");
				$c = $currentY;
			} else {
				$date->modify("-1 year");
				$prevY = $date->format("Y");
				$p = $prevY;

				$current = new DateTime(date('Y-m-d'));
				$currentY = $current->format("Y");
				$c = $currentY;
			}
			$result = $this->db->query("SELECT dep, description, amount FROM `employees_budget` where `from`='".$p."' and `to`='".$c."'");
		}
		return $result->result_array();
	}

	/*function getExtraBudget() {
		if(isset($_POST['search'])) {
			$p = $_POST['from']."-4-1";
			$c = $_POST['to']."-3-31";
		} else {
			$prev = new DateTime(date('Y-m-d'));
			$prev->modify("-1 year");
			$prevY = $prev->format("Y");
			$p = $prevY."-4-1";

			$current = new DateTime(date('Y-m-d'));
			$currentY = $current->format("Y");
			$c = $currentY."-3-31";
		}
		$result = $this->db->query("SELECT description, amount FROM `employees_budget` where `create` between '".$p."' and '".$c."'");
		return $result->result_array();
	}*/

	
}