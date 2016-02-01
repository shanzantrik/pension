<?php

class Model_service_book extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function add() {
		$ppo_no = get_increamented_option_value('ppo_number');
		$gpo_no = get_increamented_option_value('gpo_number');
		$cpo_no = get_increamented_option_value('cpo_number');

		$serial_no			= $this->model_service_book->getPensionerpdMaxSerialNo();
		$cash_received		= $this->security->xss_clean($this->input->post('cash_received'));
		$class_of_pension	= $this->security->xss_clean($this->input->post('class_of_pension'));
		$case_no			= $this->security->xss_clean($this->input->post('case_no'));

		$ppo_no				= $ppo_no;
		$gpo_no				= $gpo_no;
		$cpo_no				= ($this->input->post('com_applied') == 1) ? $cpo_no : 'N/A';

		$salutation 		= $this->security->xss_clean($this->input->post('salutation'));
		$name 				= $this->security->xss_clean($this->input->post('name'));
		$dob 				= $this->security->xss_clean($this->input->post('dob'));
		$religion 			= $this->security->xss_clean($this->input->post('religion'));
		$nationality 		= $this->security->xss_clean($this->input->post('nationality'));
		$category 			= $this->security->xss_clean($this->input->post('category'));
		$sex 				= $this->security->xss_clean($this->input->post('sex'));
		$designation 		= $this->security->xss_clean($this->input->post('designation'));
		$department	 		= $this->security->xss_clean($this->input->post('department'));
		$pensioner_personal_details = array('serial_no'=>$serial_no, 'cash_received'=>$cash_received, 'class_of_pension'=>$class_of_pension, 'case_no'=>$case_no, 'ppo_no'=>$ppo_no, 'gpo_no'=>$gpo_no, 'cpo_no'=>$cpo_no, 'salutation'=>$salutation, 'name'=>$name, 'dob'=>$dob, 'religion'=>$religion, 'nationality'=>$nationality, 'category'=>$category, 'sex'=>$sex, 'designation'=>$designation, 'department'=>$department);

		$pension_category 	= $this->security->xss_clean($this->input->post('pension_category'));
		$pension_for 		= $this->security->xss_clean($this->input->post('pension_for'));
		$pension_scheme 	= $this->security->xss_clean($this->input->post('pension_scheme'));
		$com_pension_rate	= $this->security->xss_clean($this->input->post('com_pension_rate'));
		
		if(isset($pension_category) && ($pension_category!='')) {$pensioner_personal_details['pension_category']=$pension_category;}
		if(isset($pension_for) && ($pension_for!='')) {$pensioner_personal_details['pension_for']=$pension_for;}
		if(isset($pension_scheme) && $pension_scheme!='') {$pensioner_personal_details['pension_scheme']=$pension_scheme;}
		if(isset($com_pension_rate) && ($com_pension_rate!='')) {$pensioner_personal_details['com_pension_rate']=$com_pension_rate;}

		$family_info = array();
       	for($i=0;$i<count($_POST['spouse_name']);$i++) {
			$p=$i+1;
			$child=array();
			if(!empty($_POST['parentchild_name'.$p])) {
				for($k=0; $k<count($_POST['parentchild_name'.$p]); $k++) {
					$child_info = array();
					$child_info['salutation'] = $_POST['child_salutation'.$p][$k];
					$child_info['name'] = $_POST['parentchild_name'.$p][$k];
					$child_info['dob'] = $_POST['child_dob'.$p][$k];
					$child_info['income'] = $_POST['child_income'.$p][$k];
					$child_info['marital_status'] = $_POST['marital_status'.$p][$k];
					$child_info['handicapped'] = isset($_POST['handicapped'.$p][$k]) ? $_POST['handicapped'.$p][$k] : 'no';
					array_push($child, $child_info);
			   	}
			}
			$spouse_info = array();
			$spouse_info['spouse_salutation'] = $_POST['spouse_salutation'][$i];
			$spouse_info['spouse_name'] = $_POST['spouse_name'][$i];
			$spouse_info['spouse_dob'] = $_POST['spouse_dob'][$i];
			$spouse_info['spouse_dod'] = $_POST['spouse_dod'][$i];
			$spouse_info['relation'] = $_POST['relation'][$i];
			$spouse_info['percentage'] = $_POST['percentage'][$i];
			$spouse_info['child'] = $child;
			array_push($family_info, $spouse_info);
	 	}
	 	$bracketes = array('[', ']');
	 	$name_of_legal_heir = str_replace($bracketes, "", $_POST['name_of_legal_heir']);
	 	$legal_heir = array();
	 	$legal_heir['legal_heir'] = $name_of_legal_heir;
	 	array_push($family_info, $legal_heir);
	 	$family_details = "('".$serial_no."', '".serialize($family_info)."')";

	 	$appointas=$this->security->xss_clean($this->input->post('appointas'));
	 	$dojac=$this->security->xss_clean($this->input->post('dojac'));
	 	if($dojac=='' || empty($dojac)){
	 		$dojac='0000-00-00';
	 	}
		$doj=$this->security->xss_clean($this->input->post('dojap'));
		if($doj=='' || empty($doj)){
			$doj='0000-00-00';
		}

		switch($class_of_pension) :
			case 'Superannuation_Pension':
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
			case 'Absorption_in_autonomous_body_pension':
			case 'Disability_Pension':
			case 'Compulsory_Retirement_Pension':
				$dor = $this->security->xss_clean($this->input->post('dor'));
				$dod = '0000-00-00';
				break;
			case 'Normal_Family_Pension':
				$dor = $this->security->xss_clean($this->input->post('dor'));
				$dod = $this->security->xss_clean($this->input->post('dod'));
				if($dor=='' || empty($dor)) :
					$dor='0000-00-00';
				endif;
				break;
			default:
				$dor = '0000-00-00';
				$dod = $this->security->xss_clean($this->input->post('dod'));
				break;
		endswitch;

		$total_service			= $this->security->xss_clean($this->input->post('total_service'));
		$nonqsyear				= $this->security->xss_clean($this->input->post('nonqsyear'));
		$nonqsmonth				= $this->security->xss_clean($this->input->post('nonqsmonth'));
		$nonqsday				= $this->security->xss_clean($this->input->post('nonqsday'));
		$non_qualifying_service	= $nonqsyear."-".$nonqsmonth."-".$nonqsday;
		$netqsyear				= $this->security->xss_clean($this->input->post('netqsyear'));
		$netqsmonth				= $this->security->xss_clean($this->input->post('netqsmonth'));
		$netqsday				= $this->security->xss_clean($this->input->post('netqsday'));
		$net_qualifying_service	= $netqsyear."-".$netqsmonth."-".$netqsday;
		$service_verification	= $this->security->xss_clean($this->input->post('service_verification'));
		//$probation_period=$this->security->xss_clean($this->input->post('probation_period'));
		$smp 					= $this->security->xss_clean($this->input->post('smp'));
		$office_address			= $this->security->xss_clean($this->input->post('office_address'));
		$pensioner_service_details = array('appoint_as'=>$appointas, 'serial_no'=>$serial_no, 'dojac'=>$dojac, 'doj'=>$doj, 'dor'=>$dor, 'dod'=>$dod, 'total_service'=>$total_service, 'non_qualifying_service'=>$non_qualifying_service, 'net_qualifying_service'=>$net_qualifying_service, 'service_verification'=>$service_verification, 'smp'=>$smp, 'office_address'=>$office_address);

		$pay = array();
		$post = array();
		$increament = array();
		/*foreach($_POST as $key => $value){
		 	if(preg_match('@^post_@',$key)){
		    	$pre = str_replace("post", "pre", $key);
		    	$inc = str_replace("post", "increament", $key);
		    	if($_POST[$key] == ''){
		    		$post[$key] = $_POST[$pre];
		    		$increament[$inc] = 0;
		    	}else{
		    		if($pre == 'pre_DA' || $inc == 'increament_DA') :
			    		$post[$key] = $_POST[$pre];
		    			$increament[$inc] = $_POST[$key];
			    	else :
			    		$post[$key] = $_POST[$key];
		    			$increament[$inc] = $_POST[$key]-$_POST[$pre];
			    	endif;

		    	}
		    }
		}*/
		foreach($_POST as $key => $value) {
			if(isset($_POST['post_BP'])) {
			    if(preg_match('@^post_@', $key)) {
			    	$pre = str_replace("post", "pre", $key);
			    	$inc = str_replace("post", "increament", $key);
			    	if($_POST[$key] == '') {
			    		$post[$key] = $_POST[$pre];
			    		$increament[$inc] = 0;
			    	} else {
				    	if($pre == 'pre_DA' || $inc == 'increament_DA') :
				    		$post[$key] = $_POST[$pre];
			    			$increament[$inc] = $_POST[$key];
				    	else :
				    		$post[$key] = $_POST[$key];
			    			$increament[$inc] = $_POST[$key]-$_POST[$pre];
				    	endif;
			    	}
			    }
			} else {
				if(preg_match('@^pre_@', $key)) {
			    	$pre = $key;
			    	$p = str_replace("pre", "post", $key);
			    	$inc = str_replace("pre", "increament", $key);
			    	if($_POST[$key] == '') {
			    		$post[$p] = $_POST[$pre];
			    		$increament[$inc] = 0;
			    	} else {
				    	if($pre == 'post_DA') :
				    		$post[$p] = $_POST[$pre];
			    			$increament[$inc] = $_POST[$key];
				    	else :
				    		$post[$p] = $_POST[$key];
			    			$increament[$inc] = $_POST[$key]-$_POST[$pre];
				    	endif;
			    	}
			    }
			}
		}
        array_push($pay, $post);
		array_push($pay, $increament);
		array_push($pay, array('last_increament_date'=>$this->security->xss_clean($this->input->post('last_increament_date'))));
		array_push($pay, array('earn_leave'=>$this->security->xss_clean($this->input->post('earn_leave'))));
		array_push($pay, array('half_pay'=>$this->security->xss_clean($this->input->post('half_pay'))));
		
		$pay_commission = $this->security->xss_clean($this->input->post('pay_commission'));
		$pay_scale = $this->security->xss_clean($this->input->post('pay_scale'));
		$provisional_pension = $this->security->xss_clean($this->input->post('provisional_pension'));
		$provisional_gratuity = $this->security->xss_clean($this->input->post('provisional_gratuity'));
		$excess_pay_and_allowances = $this->security->xss_clean($this->input->post('excess_pay_and_allowances'));
		$others_if_any = $this->security->xss_clean($this->input->post('others_if_any'));
		$com_applied = $this->security->xss_clean($this->input->post('com_applied'));
		$dr = ($this->input->post('dr') != '') ? $this->security->xss_clean($this->input->post('dr')) : 'no';
		$ma = ($this->input->post('ma') != '') ? $this->security->xss_clean($this->input->post('ma')) : 'no';
		
		$pensioner_pay_details = array('serial_no'=>$serial_no, 'pay_commission'=>$pay_commission, 'pay_scale'=>$pay_scale, 'provisional_pension'=>$provisional_pension, 'provisional_gratuity'=>$provisional_gratuity, 'excess_pay_and_allowances'=>$excess_pay_and_allowances, 'others'=>$others_if_any,'com_applied'=>$com_applied, 'dr'=>$dr, 'ma'=>$ma, 'pay_info'=>serialize($pay));

		$effect_of_pension			= $this->security->xss_clean($this->input->post('effect_of_pension'));
		$name_of_accountant_general	= ($this->input->post('name_of_accountant_general') != NULL) ? $this->security->xss_clean($this->input->post('name_of_accountant_general')) : NULL;
		$sub_to						= ($this->input->post('sub_to') != NULL) ? $this->security->xss_clean($this->input->post('sub_to')) : NULL;
		$treasury_officer			= ($this->input->post('treasury_officer') != NULL) ? $this->security->xss_clean($this->input->post('treasury_officer')) : NULL;
		$bank_name					= $this->security->xss_clean($this->input->post('bank_name'));
		$account_no					= $this->security->xss_clean($this->input->post('account_no'));
		$address_after_retirement	= $this->security->xss_clean($this->input->post('address_after_retirement'));
		$pin 						= $this->security->xss_clean($this->input->post('pin'));
		$phone_no					= $this->security->xss_clean($this->input->post('phone_no'));
		$code_no                    = $this->security->xss_clean($this->input->post('code_no'));
		$pensioner_treasury_details = array('serial_no'=>$serial_no, 'effect_of_pension'=>$effect_of_pension, 'name_of_accountant_general'=>$name_of_accountant_general, 'sub_to'=>$sub_to, 'treasury_officer'=>$treasury_officer, 'bank_name'=>$bank_name, 'account_no'=>$account_no, 'address_after_retirement'=>$address_after_retirement, 'pin'=>$pin, 'phone_no'=>$phone_no, 'code_no'=>$code_no);

		$this->db->trans_begin();
		$this->db->insert('pensioner_personal_details', $pensioner_personal_details);
		$this->db->query("INSERT INTO pensioner_family_details (`serial_no`, `family_info`) VALUES ".trim($family_details));
		$this->db->insert('pensioner_service_details', $pensioner_service_details);
		$this->db->insert('pensioner_pay_details', $pensioner_pay_details);
		$this->db->insert('pensioner_treasury_details', $pensioner_treasury_details);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
		    return false;
		} else {

			$this->load->library('Pensioner', array('serial_no'=>PPERSONALD::max('serial_no')));
			$pensioner = $this->pensioner;
			$comm = ($pensioner->getCommutationofPension() == 'N/A') ? 0 : $pensioner->getCommutationofPension();
			pdupdate($pensioner->case_no, ['gratuity'=>$pensioner->getDCRG(), 'commutation'=>$comm, 'leave_encashment'=>$pensioner->getEarnMoney()]);

			update_option('ppo_number', $ppo_no);
			update_option('gpo_number', $gpo_no);
			update_option('cpo_number', $cpo_no);
		    return true;
		}
	}

	function update() {
    	$serial_no=$this->security->xss_clean($this->input->post('serial_no'));
		$cash_received=$this->security->xss_clean($this->input->post('cash_received'));
		$class_of_pension=$this->security->xss_clean($this->input->post('class_of_pension'));
		$case_no=$this->security->xss_clean($this->input->post('case_no'));
		$salutation=$this->security->xss_clean($this->input->post('salutation'));
		$name=$this->security->xss_clean($this->input->post('name'));
		$dob=$this->security->xss_clean($this->input->post('dob'));
		$religion=$this->security->xss_clean($this->input->post('religion'));
		$nationality=$this->security->xss_clean($this->input->post('nationality'));
		$category=$this->security->xss_clean($this->input->post('category'));
		$sex=$this->security->xss_clean($this->input->post('sex'));
		$designation=$this->security->xss_clean($this->input->post('designation'));
		$department=$this->security->xss_clean($this->input->post('department'));
		$pensioner_personal_details = array('cash_received'=>$cash_received, 'class_of_pension'=>$class_of_pension, 'case_no'=>$case_no, 'salutation'=>$salutation, 'name'=>$name, 'dob'=>$dob, 'religion'=>$religion, 'nationality'=>$nationality, 'category'=>$category, 'sex'=>$sex, 'designation'=>$designation, 'department'=>$department);

		$pension_category 	= $this->security->xss_clean($this->input->post('pension_category'));
		$pension_for 		= $this->security->xss_clean($this->input->post('pension_for'));
		$pension_scheme 	= $this->security->xss_clean($this->input->post('pension_scheme'));
		$com_pension_rate	= $this->security->xss_clean($this->input->post('com_pension_rate'));
		
		if(isset($pension_category) && ($pension_category!='')) {$pensioner_personal_details['pension_category']=$pension_category;}
		if(isset($pension_for) && ($pension_for!='')) {$pensioner_personal_details['pension_for']=$pension_for;}
		if(isset($pension_scheme) && $pension_scheme!='') {$pensioner_personal_details['pension_scheme']=$pension_scheme;}
		if(isset($com_pension_rate) && ($com_pension_rate!='')) {$pensioner_personal_details['com_pension_rate']=$com_pension_rate;}

		$family_info = array();
       	for($i=0;$i<count($_POST['spouse_name']);$i++) {
			$p=$i+1;
			$child=array();
			if(!empty($_POST['parentchild_name'.$p])) {
				for($k=0; $k<count($_POST['parentchild_name'.$p]); $k++) {
					$child_info = array();
					$child_info['salutation'] = $_POST['child_salutation'.$p][$k];
					$child_info['name'] = $_POST['parentchild_name'.$p][$k];
					$child_info['dob'] = $_POST['child_dob'.$p][$k];
					$child_info['income'] = $_POST['child_income'.$p][$k];
					$child_info['marital_status'] = $_POST['marital_status'.$p][$k];
					$child_info['handicapped'] = isset($_POST['handicapped'.$p][$k]) ? $_POST['handicapped'.$p][$k] : 'no';
					array_push($child, $child_info);
			   	}
			}
			$spouse_info = array();
			$spouse_info['spouse_salutation'] = $_POST['spouse_salutation'][$i];
			$spouse_info['spouse_name'] = $_POST['spouse_name'][$i];
			$spouse_info['spouse_dob'] = $_POST['spouse_dob'][$i];
			$spouse_info['spouse_dod'] = $_POST['spouse_dod'][$i];
			$spouse_info['relation'] = $_POST['relation'][$i];
			$spouse_info['percentage'] = $_POST['percentage'][$i];
			$spouse_info['child'] = $child;
			array_push($family_info, $spouse_info);
	 	}

	 	$bracketes = array('[', ']');
	 	$name_of_legal_heir = str_replace($bracketes, "", $_POST['name_of_legal_heir']);
	 	$legal_heir = array();
	 	$legal_heir['legal_heir'] = $name_of_legal_heir;
	 	array_push($family_info, $legal_heir);
	 	$pensioner_family_details = array('family_info'=>serialize($family_info));

	 	$appointas=$this->security->xss_clean($this->input->post('appointas'));
		$dojac=$this->security->xss_clean($this->input->post('dojac'));
	 	if($dojac=='' || empty($dojac)){
	 		$dojac='0000-00-00';
	 	}
		$doj=$this->security->xss_clean($this->input->post('dojap'));
		if($doj=='' || empty($doj)){
			$doj='0000-00-00';
		}

		switch($class_of_pension) :
			case 'Superannuation_Pension':
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
			case 'Absorption_in_autonomous_body_pension':
			case 'Disability_Pension':
			case 'Compulsory_Retirement_Pension':
				$dor = $this->security->xss_clean($this->input->post('dor'));
				$dod = '0000-00-00';
				break;
			case 'Normal_Family_Pension':
				$dor = $this->security->xss_clean($this->input->post('dor'));
				$dod = $this->security->xss_clean($this->input->post('dod'));
				if($dor=='' || empty($dor)) :
					$dor='0000-00-00';
				endif;
				break;
			default:
				$dor = '0000-00-00';
				$dod = $this->security->xss_clean($this->input->post('dod'));
				break;
		endswitch;

		$total_service=$this->security->xss_clean($this->input->post('total_service'));
		$nonqsyear=$this->security->xss_clean($this->input->post('nonqsyear'));
		$nonqsmonth=$this->security->xss_clean($this->input->post('nonqsmonth'));
		$nonqsday=$this->security->xss_clean($this->input->post('nonqsday'));
		$non_qualifying_service=$nonqsyear."-".$nonqsmonth."-".$nonqsday;
		$netqsyear=$this->security->xss_clean($this->input->post('netqsyear'));
		$netqsmonth=$this->security->xss_clean($this->input->post('netqsmonth'));
		$netqsday=$this->security->xss_clean($this->input->post('netqsday'));
		$net_qualifying_service=$netqsyear."-".$netqsmonth."-".$netqsday;
		$service_verification=$this->security->xss_clean($this->input->post('service_verification'));
		//$probation_period=$this->security->xss_clean($this->input->post('probation_period'));
		$smp=$this->security->xss_clean($this->input->post('smp'));
		$office_address=$this->security->xss_clean($this->input->post('office_address'));
		$pensioner_service_details = array('appoint_as'=>$appointas, 'dojac'=>$dojac, 'doj'=>$doj, 'dor'=>$dor, 'dod'=>$dod, 'total_service'=>$total_service, 'non_qualifying_service'=>$non_qualifying_service, 'net_qualifying_service'=>$net_qualifying_service, 'service_verification'=>$service_verification, 'smp'=>$smp, 'office_address'=>$office_address);

		$pay = array();
		$post = array();
		$increament = array();
		foreach($_POST as $key => $value) {
			if(isset($_POST['post_BP'])) {
			    if(preg_match('@^post_@', $key)) {
			    	$pre = str_replace("post", "pre", $key);
			    	$inc = str_replace("post", "increament", $key);
			    	if($_POST[$key] == '') {
			    		$post[$key] = $_POST[$pre];
			    		$increament[$inc] = 0;
			    	} else {
				    	if($pre == 'pre_DA' || $inc == 'increament_DA') :
				    		$post[$key] = $_POST[$pre];
			    			$increament[$inc] = $_POST[$key];
				    	else :
				    		$post[$key] = $_POST[$key];
			    			$increament[$inc] = $_POST[$key]-$_POST[$pre];
				    	endif;
			    	}
			    }
			} else {
				if(preg_match('@^pre_@', $key)) {
			    	$pre = $key;
			    	$p = str_replace("pre", "post", $key);
			    	$inc = str_replace("pre", "increament", $key);
			    	if($_POST[$key] == '') {
			    		$post[$p] = $_POST[$pre];
			    		$increament[$inc] = 0;
			    	} else {
				    	if($pre == 'post_DA') :
				    		$post[$p] = $_POST[$pre];
			    			$increament[$inc] = $_POST[$key];
				    	else :
				    		$post[$p] = $_POST[$key];
			    			$increament[$inc] = $_POST[$key]-$_POST[$pre];
				    	endif;
			    	}
			    }
			}
		}

		array_push($pay, $post);
		array_push($pay, $increament);
		array_push($pay, array('last_increament_date'=>$this->security->xss_clean($this->input->post('last_increament_date'))));
		array_push($pay, array('earn_leave'=>$this->security->xss_clean($this->input->post('earn_leave'))));
		array_push($pay, array('half_pay'=>$this->security->xss_clean($this->input->post('half_pay'))));

		$pay_commission = $this->security->xss_clean($this->input->post('pay_commission'));
		$pay_scale = $this->security->xss_clean($this->input->post('pay_scale'));
		$provisional_pension = $this->security->xss_clean($this->input->post('provisional_pension'));
		$provisional_gratuity = $this->security->xss_clean($this->input->post('provisional_gratuity'));
		$excess_pay_and_allowances = $this->security->xss_clean($this->input->post('excess_pay_and_allowances'));
		$others_if_any = $this->security->xss_clean($this->input->post('others_if_any'));
		$com_applied = $this->security->xss_clean($this->input->post('com_applied'));
		$dr = ($this->input->post('dr') != '') ? $this->security->xss_clean($this->input->post('dr')) : 'no';
		$ma = ($this->input->post('ma') != '') ? $this->security->xss_clean($this->input->post('ma')) : 'no';
		$pensioner_pay_details = array('pay_commission'=>$pay_commission, 'pay_scale'=>$pay_scale, 'provisional_pension'=>$provisional_pension, 'provisional_gratuity'=>$provisional_gratuity, 'excess_pay_and_allowances'=>$excess_pay_and_allowances, 'others'=>$others_if_any,'com_applied'=>$com_applied, 'dr'=>$dr, 'ma'=>$ma, 'pay_info'=>serialize($pay));

		$effect_of_pension=$this->security->xss_clean($this->input->post('effect_of_pension'));

		$name_of_accountant_general	= ($this->input->post('name_of_accountant_general') != NULL) ? $this->security->xss_clean($this->input->post('name_of_accountant_general')) : NULL;
		$sub_to						= ($this->input->post('sub_to') != NULL) ? $this->security->xss_clean($this->input->post('sub_to')) : NULL;
		$treasury_officer			= ($this->input->post('treasury_officer') != NULL) ? $this->security->xss_clean($this->input->post('treasury_officer')) : NULL;

		$bank_name=$this->security->xss_clean($this->input->post('bank_name'));
		$account_no=$this->security->xss_clean($this->input->post('account_no'));
		$address_after_retirement=$this->security->xss_clean($this->input->post('address_after_retirement'));
		$pin=$this->security->xss_clean($this->input->post('pin'));
		$phone_no=$this->security->xss_clean($this->input->post('phone_no'));
		$code_no = $this->security->xss_clean($this->input->post('code_no'));

		$pensioner_treasury_details = array('effect_of_pension'=>$effect_of_pension, 'name_of_accountant_general'=>$name_of_accountant_general, 'sub_to'=>$sub_to, 'treasury_officer'=>$treasury_officer, 'bank_name'=>$bank_name, 'account_no'=>$account_no, 'address_after_retirement'=>$address_after_retirement, 'pin'=>$pin, 'phone_no'=>$phone_no, 'code_no'=>$code_no);
        //print_r($pensioner_treasury_details);
        //exit();
		$this->db->trans_begin();
		$this->db->where('serial_no', $serial_no);
		$this->db->update('pensioner_personal_details', $pensioner_personal_details);
		$this->db->where('serial_no', $serial_no);
		$this->db->update('pensioner_family_details', $pensioner_family_details);
		$this->db->where('serial_no', $serial_no);
		$this->db->update('pensioner_service_details', $pensioner_service_details);
		$this->db->where('serial_no', $serial_no);
		$this->db->update('pensioner_pay_details', $pensioner_pay_details);
		$this->db->where('serial_no', $serial_no);
		$this->db->update('pensioner_treasury_details', $pensioner_treasury_details);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
		    return false;
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$pensioner = $this->pensioner;
			$comm = ($pensioner->getCommutationofPension() == 'N/A') ? 0 : $pensioner->getCommutationofPension();
			pdupdate($pensioner->case_no, ['gratuity'=>$pensioner->getDCRG(), 'commutation'=>$comm, 'leave_encashment'=>$pensioner->getEarnMoney()]);
		    return true;
		}
    }

	function reportIO($serial_no) {
		$this->db->select('sub_to');
    	$this->db->from('pensioner_treasury_details');
    	$this->db->where(array('serial_no' => $serial_no));
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$row = $query->row(); 
			if($row->sub_to!="") {
				return "exists";
			} else {
				return "not_exists";
			}
		} else {
			return "not_exists";
		}
	}

    function getDataBySerialNo($serial_no) {
    	$this->db->select('*');
    	$this->db->from('pensioner_personal_details');
    	$this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$this->db->join('pensioner_family_details', 'pensioner_family_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
    }

    function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('pens_servicebook_entry_master');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function record_count() {
        return $this->db->count_all("pens_servicebook_entry_master");
    }

    function fetchData($service_no){
 		$query = $this->db->get_where('pens_servicebook_entry_master', array('service_no' => $service_no));
 		return $query->result_array();
 	}

	function getAll() {
	    $result = $this->db->get('pensioner_personal_details');
	    return $result->result_array();
	}

	function getMax_service_no() {
		$this->db->select_max('service_no');
	    $result = $this->db->get('pens_servicebook_entry_master');
	    $row = $result->result();
	    if($row[0]->service_no == '') {
	    	return "1";
	    } else {
	    	return $row[0]->service_no+1;
	    }
	}

	function getPensionerpdMaxSerialNo() {
		$this->db->select_max('serial_no');
	    $result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->serial_no == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->serial_no+1;
	    }
	}

	function check_file_no($file_no) {
		$this->db->select('srl_No');
		$this->db->where('file_No', $file_no);
	    $result = $this->db->get('pension_receipt_file_master');
	    if($result->num_rows() > 0) {
	    	return true;
	    } else {
	    	return false;
	    }
	}
	function getPensioner_Document($chk) {
		$this->db->select('doc_no');
		$this->db->where('member_code',$chk);
	    $result = $this->db->get('master_document');
	    if($result->num_rows()> 0) {
	    	return true;
	    } else {
	    	return "898";
	    }
	}

	function getFileDetails() {
	    $case_no = $this->security->xss_clean($this->input->post('case_no'));
	    $this->db->select('*');
    	$this->db->from('pension_receipt_file_master');
    	$this->db->where('file_status', 'processing');
    	$this->db->where(array('pension_receipt_file_master.file_status' => 'processing', 'pension_receipt_file_master.file_No' => $case_no));
		$this->db->join('pensioner_files_details', 'pensioner_files_details.case_no = pension_receipt_file_master.file_No', 'left');
		$this->db->join('pension_receipt_register_master', 'pension_receipt_register_master.dept_forw_no = pension_receipt_file_master.dept_forw_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	}

	function getFiles($file_No) {
		$this->db->select('*');
    	$this->db->from('pensioner_files_details');
    	$this->db->where(array('pensioner_files_details.case_no' => $file_No));
		$query = $this->db->get();
 		return $query->result_array();
	}

	function saveAccountantName() {
		$data = array('name'=>$this->security->xss_clean($this->input->post('accountantName')));
		if($this->db->insert('master_accountant_general', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function saveTreasuryTitle() {
		$data = array('title'=>$this->security->xss_clean($this->input->post('treasuryTitle')));
		if($this->db->insert('master_treasury', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getall_DA()
	{
	    $this->db->select('*');
    	$this->db->from('master_dearness_allowance');
    	//$this->db->where(array('pensioner_files_details.case_no' => $file_No));
		$query = $this->db->get();
 		return $query->result_array();
	}

	function save_DA() {
		$data = array('da'=>$this->security->xss_clean($this->input->post('DA_value')));
		//return "100";
		if($this->db->insert('master_dearness_allowance',$data)) {
			return true;
		} else {
			return false;
		}
	}
	
	function getPayComn(){
		 $result = $this->db->get('master_pay_comm');
	     return $result->result_array();
	}
	
	function get_text_boxes($id)
	{
		$this->db->order_by('sort_order','asc');
		$result = $this->db->get_where('master_pay_comm_param',array('pay_comm_id'=>$id));
	    return $result->result_array();
	}

	function save_vals() {
		$url=$this->security->xss_clean($_POST['url']);
		$arr=explode(',', $url);
		$str="";
		//pre data
		foreach ($arr as $a)
		{
			$str=$str."'$a'=>".$_POST["pre_$a"].',';
		}
		$str=rtrim($str,",");
		$data_pre=array($str);
		//post data
		$str="";
		foreach ($arr as $a) {
			$str=$str."'$a'=>".$_POST["post_$a"].',';
		}
		$str=rtrim($str,",");
		$data_post=array($str);
		//SERIALIZE DATA
		$serialize_pre=serialize($data_pre);
		$serialize_post=serialize($data_post);
		echo $serialize_post;
	}

	function getFile_detail($file_no)
	{
		$q=$this->db->get_where('pension_receipt_file_master',array('file_No'=>$file_no));
	    $x=$q->result();
		return $x;
	}
}