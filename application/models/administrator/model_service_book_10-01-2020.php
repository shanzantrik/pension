<?php

class Model_service_book extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function getIdCardSerialNo() {
		$this->db->select_max('idcard_serial_no');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->idcard_serial_no == '') {
	    	return "9285";//8803
	    } else {
	    	return $row[0]->idcard_serial_no+1;
	    }
	}

	function getPensionMaxSerialNo() {
		$this->db->select_max('srl_No');
	    $result = $this->db->get('pension_receipt_file_master');
	    $row = $result->result();
	    if($row[0]->srl_No == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->srl_No;
	    }
	}

	/*function getPPONo() {
		$this->db->select_max('ppo_no');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->ppo_no == '') 
		{
	    	return "23098";//22533
	    } 
		else 
		{
	    	return $row[0]->ppo_no+1;
	    }
	}

	function getGPONo() {
		$this->db->select_max('gpo_no');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->gpo_no == '') 
		{
	    	return "30131";//29566
	    } 
		
		else 
		{
	    	return $row[0]->gpo_no+1;
	    }
	}

	function getCPONo() {
		$this->db->select_max('cpo_no');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->cpo_no == '') {
	    	return "17405";//16840
	    } else {
	    	return $row[0]->cpo_no+1;
	    }
	}*/
	
	function getPPONo() {
		$this->db->select_max('ppo_no');
		$this->db->where('designation !=', 'IAS');
		$this->db->where('designation !=', 'IPS');
		$this->db->where('designation !=', 'IFS');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->ppo_no == '') {
	    	return "23098";//22533
	    } else {
	    	return $row[0]->ppo_no+1;
	    }
	}

	function getGPONo() {
		$this->db->select_max('gpo_no');
		$this->db->where('designation not like', 'IAS%');
		$this->db->where('designation not like', 'IPS%');
		$this->db->where('designation not like', 'IFS%');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->gpo_no == '') {
	    	return "30131";//29566
	    } else {
	    	return $row[0]->gpo_no+1;
	    }
	}

	function getCPONo() {
		$this->db->select_max('cpo_no');
		$this->db->where('designation not like', 'IAS%');
		$this->db->where('designation not like', 'IPS%');
		$this->db->where('designation not like', 'IFS%');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->cpo_no == '') {
	    	return "18064";//16840 / 17405
	    } else {
	    	return $row[0]->cpo_no+1;
	    }
	}

	function add() {
		// $ppo_no = get_increamented_option_value('ppo_number');
		// $gpo_no = get_increamented_option_value('gpo_number');
		// $cpo_no = get_increamented_option_value('cpo_number');

		$serial_no			= $this->model_service_book->getPensionerpdMaxSerialNo();
		$cash_received		= $this->security->xss_clean($this->input->post('cash_received'));
		$class_of_pension	= $this->security->xss_clean($this->input->post('class_of_pension'));
		$case_no			= $this->security->xss_clean($this->input->post('case_no'));

		// $ppo_no				= $ppo_no;
		// $gpo_no				= $gpo_no;
		$ppo_no				= $this->security->xss_clean($this->input->post('ppo_file_no'));
		$gpo_no				= $this->security->xss_clean($this->input->post('gpo_file_no'));
		//$cpo_no				= ($this->input->post('com_applied') == 1) ? $cpo_no : 'N/A';
        $cpo_no				= $this->security->xss_clean($this->input->post('cpo_file_no'));
        
		
			if($ppo_no==NULL or $ppo_no==''){
			$ppo_no = get_increamented_option_value('ppo_number');
			}
			
			if($gpo_no==NULL or $gpo_no==''){
			$gpo_no = get_increamented_option_value('gpo_number');
			}
			
			if($cpo_no==NULL or $cpo_no==''){
			$cpo_no = get_increamented_option_value('cpo_number');
			}
		
		$salutation 		= $this->security->xss_clean($this->input->post('salutation'));
		$name 				= $this->security->xss_clean($this->input->post('name'));
		$dob 				= $this->security->xss_clean($this->input->post('dob'));
		$religion 			= $this->security->xss_clean($this->input->post('religion'));
		$nationality 		= $this->security->xss_clean($this->input->post('nationality'));
		$category 			= $this->security->xss_clean($this->input->post('category'));
		$sex 				= $this->security->xss_clean($this->input->post('sex'));
		$designation 		= $this->security->xss_clean($this->input->post('designation'));
		$department	 		= $this->security->xss_clean($this->input->post('department'));
		$blood_group 		= $this->security->xss_clean($this->input->post('blood_group'));
		$idcard_serial_no	= $this->model_service_book->getIdCardSerialNo();
		$pensioner_personal_details = array('serial_no'=>$serial_no, 'cash_received'=>$cash_received, 'class_of_pension'=>$class_of_pension, 'case_no'=>$case_no, 'ppo_no'=>$ppo_no, 'gpo_no'=>$gpo_no, 'cpo_no'=>$cpo_no, 'salutation'=>$salutation, 'name'=>$name, 'dob'=>$dob, 'religion'=>$religion, 'nationality'=>$nationality, 'category'=>$category, 'sex'=>$sex, 'designation'=>$designation, 'department'=>$department, 'blood_group'=>$blood_group, 'idcard_serial_no'=>$idcard_serial_no);

		$pension_category 	= $this->security->xss_clean($this->input->post('pension_category'));
		$pension_for 		= $this->security->xss_clean($this->input->post('pension_for'));
		$pension_scheme 	= $this->security->xss_clean($this->input->post('pension_scheme'));
		$com_pension_rate	= $this->security->xss_clean($this->input->post('com_pension_rate'));
		
		if(isset($pension_category) && ($pension_category!='')) {$pensioner_personal_details['pension_category']=$pension_category;}
		if(isset($pension_for) && ($pension_for!='')) {$pensioner_personal_details['pension_for']=$pension_for;}
		if(isset($pension_scheme) && $pension_scheme!='') {$pensioner_personal_details['pension_scheme']=$pension_scheme;}
		if(isset($com_pension_rate) && ($com_pension_rate!='')) {$pensioner_personal_details['com_pension_rate']=$com_pension_rate;}

		$family_info = array();

		$wife_count=0;
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

			if($_POST['relation'][$i]=="wife"){
				$wife_count++;
			}
	 	}

	 	if($wife_count==0)
	 	{
	 		$wife_count==1;
	 	}

	 	$bracketes = array('[', ']');
	 	$name_of_legal_heir = str_replace($bracketes, "", $_POST['name_of_legal_heir']);
	 	$legal_heir = array();
	 	$legal_heir['legal_heir'] = $name_of_legal_heir;
	 	array_push($family_info, $legal_heir);

	 	// $more_wives=$this->security->xss_clean($this->input->post('more_wives'));
	 	// $no_of_wives=$this->security->xss_clean($this->input->post('no_of_wives'));

	 	$family_details = "('".$serial_no."', '".serialize($family_info)."')";//, '".$more_wives."', '".$no_of_wives."'

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
			case 'NPS':
				$dor = $this->security->xss_clean($this->input->post('dor'));
				$dod = $this->security->xss_clean($this->input->post('dod'));
				if($dor=='' || empty($dor)) :
					$dor='0000-00-00';
				endif;
				break;
			case 'Death_Gratuity':
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

		$weightage_year=$this->security->xss_clean($this->input->post('weightage_year'));
		$weightage_month=$this->security->xss_clean($this->input->post('weightage_month'));
		$weightage_day=$this->security->xss_clean($this->input->post('weightage_day'));
		$weightage=$weightage_year."-".$weightage_month."-".$weightage_day;

		$netqsyear				= $this->security->xss_clean($this->input->post('netqsyear'));
		$netqsmonth				= $this->security->xss_clean($this->input->post('netqsmonth'));
		$netqsday				= $this->security->xss_clean($this->input->post('netqsday'));
		$net_qualifying_service	= $netqsyear."-".$netqsmonth."-".$netqsday;
		$service_verification	= $this->security->xss_clean($this->input->post('service_verification'));
		//$probation_period=$this->security->xss_clean($this->input->post('probation_period'));
		$smp 					= $this->security->xss_clean($this->input->post('smp'));
		$office_address			= $this->security->xss_clean($this->input->post('office_address'));
		$pensioner_service_details = array('appoint_as'=>$appointas, 'serial_no'=>$serial_no, 'dojac'=>$dojac, 'doj'=>$doj, 'dor'=>$dor, 'dod'=>$dod, 'total_service'=>$total_service, 'non_qualifying_service'=>$non_qualifying_service, 'weightage'=>$weightage, 'net_qualifying_service'=>$net_qualifying_service, 'service_verification'=>$service_verification, 'smp'=>$smp, 'office_address'=>$office_address);

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
		$total_amount=$this->security->xss_clean($this->input->post('total_pres'));
		$age_retire=$this->security->xss_clean($this->input->post('aryear'));
		$case_file_no=$this->security->xss_clean($this->input->post('case_file_no'));
		$bf_increamnet=$this->security->xss_clean($this->input->post('bf_increamnet'));
		$npa=$this->security->xss_clean($this->input->post('npa'));
		//$npa1=$this->security->xss_clean($this->input->post('npa1'));
        //$npa2=$this->security->xss_clean($this->input->post('npa2'));
        $consolidated = $this->security->xss_clean($this->input->post('consolidated'));
        $childDOB = $this->security->xss_clean($this->input->post('childDOB'));
        $child_Date_of_marriage_employment = $this->security->xss_clean($this->input->post('child_Date_of_marriage_employment'));
        		
		$pensioner_pay_details = array('serial_no'=>$serial_no, 'pay_commission'=>$pay_commission,'total_amount'=>$total_amount,'age_retire'=>$age_retire, 'pay_scale'=>$pay_scale, 'provisional_pension'=>$provisional_pension, 'provisional_gratuity'=>$provisional_gratuity, 'excess_pay_and_allowances'=>$excess_pay_and_allowances, 'others'=>$others_if_any,'com_applied'=>$com_applied, 'dr'=>$dr, 'ma'=>$ma, 'pay_info'=>serialize($pay), 'case_file_no'=>$case_file_no, 'bf_increamnet'=>$bf_increamnet,'npa'=>$npa,'consolidated'=>$consolidated,'childDOB'=>$childDOB,'child_Date_of_marriage_employment'=>$child_Date_of_marriage_employment); //, 'npa_six_pay_before_incre'=>$npa1, 'npa_six_pay_after_incre'=>$npa2);

		$effect_of_pension			= $this->security->xss_clean($this->input->post('effect_of_pension'));
		
		$bank_name					= $this->security->xss_clean($this->input->post('bank_name'));
		$account_no					= $this->security->xss_clean($this->input->post('account_no'));
		$address_after_retirement	= $this->security->xss_clean($this->input->post('address_after_retirement'));
		$pin 						= $this->security->xss_clean($this->input->post('pin'));
		$phone_no					= $this->security->xss_clean($this->input->post('phone_no'));
		$code_no                    = $this->security->xss_clean($this->input->post('code_no'));


		$name_of_accountant_general	= ($this->input->post('name_of_accountant_general') != NULL) ? $this->security->xss_clean($this->input->post('name_of_accountant_general')) : NULL;

			$treasury_officer			= ($this->input->post('treasury_officer') != NULL) ? $this->security->xss_clean($this->input->post('treasury_officer')) : NULL;
			$sub_to						= ($this->input->post('sub_to') != NULL) ? $this->security->xss_clean($this->input->post('sub_to')) : NULL;



		if($class_of_pension=='Normal_Family_Pension'){


			if(is_array($address_after_retirement)){
				$address_after=array();

				for ($i=0; $i < count($_POST['address_after_retirement']); $i++) { 

					$address=array();

					$address['address_after_retirement']=$_POST['address_after_retirement'][$i];

					array_push($address_after, $address);
				}


				$address_after_retirement = array('address_after_retirement'=>serialize($address_after));

			}else{

				$address_after_retirement = array('address_after_retirement'=>$address_after_retirement);

			}


			if(is_array($sub_to)){
				$sub=array();

				for ($i=0; $i < count($_POST['sub_to']); $i++) { 

					$sub_to=array();

					$sub_to['sub_to']=$_POST['sub_to'][$i];

					array_push($sub, $sub_to);
				}


				$sub_to = array('sub_to'=>serialize($sub));

			}else{

				$sub_to = array('sub_to'=>$sub_to);

			}


			if(is_array($name_of_accountant_general)){

				$name_of_ag=array();

				for ($i=0; $i < count($_POST['name_of_accountant_general']); $i++) { 

					$ag=array();

					$ag['name_of_accountant_general']=$_POST['name_of_accountant_general'][$i];

					array_push($name_of_ag, $ag);
				}

				$name_of_accountant_general = array('name_of_ag'=>serialize($name_of_ag));

			}else{

				$name_of_accountant_general = array('name_of_accountant_general'=>$name_of_accountant_general);

			}
			

			if(is_array($treasury_officer)){

			$name_of_treasury=array();

			for ($i=0; $i < count($_POST['treasury_officer']); $i++) { 

				$treasury=array();

				$treasury['treasury_officer']=$_POST['treasury_officer'][$i];

				array_push($name_of_treasury, $treasury);
			}

				$treasury_officer = array('name_of_treasury'=>serialize($name_of_treasury));

			}else{

				$treasury_officer = array('treasury_officer'=>$treasury_officer);

			}


			$pensioner_treasury_details = array('serial_no'=>$serial_no, 'effect_of_pension'=>$effect_of_pension, 'bank_name'=>$bank_name, 'account_no'=>$account_no, 'pin'=>$pin, 'phone_no'=>$phone_no, 'code_no'=>$code_no);

		}
		else
		{

			$pensioner_treasury_details = array('serial_no'=>$serial_no, 'effect_of_pension'=>$effect_of_pension, 'name_of_accountant_general'=>$name_of_accountant_general, 'sub_to'=>$sub_to, 'treasury_officer'=>$treasury_officer, 'bank_name'=>$bank_name, 'account_no'=>$account_no, 'address_after_retirement'=>$address_after_retirement, 'pin'=>$pin, 'phone_no'=>$phone_no, 'code_no'=>$code_no);

		}
			


		//var_dump($treasury_officer);
		//exit();

		$this->db->trans_begin();
		$this->db->insert('pensioner_personal_details', $pensioner_personal_details);
		$this->db->query("INSERT INTO pensioner_family_details (`serial_no`, `family_info`) VALUES ".trim($family_details));
		$this->db->insert('pensioner_service_details', $pensioner_service_details);
		$this->db->insert('pensioner_pay_details', $pensioner_pay_details);
		$this->db->insert('pensioner_treasury_details', $pensioner_treasury_details);

		if($class_of_pension=='Normal_Family_Pension'){
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $address_after_retirement);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $name_of_accountant_general);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $sub_to);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $treasury_officer);
		}
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
		    return false;
		} else {

			$this->load->library('Pensioner', array('serial_no'=>PPERSONALD::max('serial_no')));
			$pensioner = $this->pensioner;
			$comm = ($pensioner->getCommutationofPension() == 'N/A') ? 0 : $pensioner->getCommutationofPension();
			pdupdate($pensioner->case_no, ['gratuity'=>$pensioner->getDCRG(), 'commutation'=>$comm, 'leave_encashment'=>$pensioner->getEarnMoney()]);

						
			$pension_max_serial_no	= $this->model_service_book->getPensionMaxSerialNo();
			update_option('total_no_of_pension_case', $pension_max_serial_no);
			//update_option('total_no_of_gis_case', $ppo_no);
			//update_option('total_no_of_ips_case', $ppo_no);
			update_option('ppo_number', $ppo_no);
			update_option('gpo_number', $gpo_no);
			update_option('cpo_number', $cpo_no);


			//===========increment value
				$fidate=$this->input->post('fidate');
				$toidate=$this->input->post('toidate');
				$irate=$this->input->post('irate');
				$iamount=$this->input->post('iamount');
				$case=$this->input->post('case_no');
			$ictr=count($fidate);
			for($i=0;$i<$ictr;$i++){

				if($iamount[$i]!=NULL or $iamount[$i]!=0){
$this->db->query("INSERT INTO increment_detail (case_no, from_date,to_date,rate_of_pay,amount) VALUES ('$case','$fidate[$i]','$toidate[$i]','$irate[$i]','$iamount[$i]')");
						}

					}

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
		$sub_designation=$this->security->xss_clean($this->input->post('sub_designation'));
		
		// $ppo_no=$this->security->xss_clean($this->input->post('ppo_file_no'));
		$ppo_no=$this->security->xss_clean($this->input->post('ppo_file_no_hidden')); //Dani Rika 11'Dec 2018

		$gpo_no=$this->security->xss_clean($this->input->post('gpo_file_no'));
		$cpo_no=$this->security->xss_clean($this->input->post('cpo_file_no')); 
		$department=$this->security->xss_clean($this->input->post('department'));
		$blood_group=$this->security->xss_clean($this->input->post('blood_group'));
		$pensioner_personal_details = array('cash_received'=>$cash_received, 'class_of_pension'=>$class_of_pension, 'case_no'=>$case_no, 'salutation'=>$salutation, 'name'=>$name, 'dob'=>$dob, 'religion'=>$religion, 'nationality'=>$nationality, 'category'=>$category, 'sex'=>$sex, 'designation'=>$designation,'sub_designation'=>$sub_designation,'ppo_no'=>$ppo_no, 'gpo_no'=>$gpo_no, 'cpo_no'=>$cpo_no, 'department'=>$department, 'blood_group'=>$blood_group);

		$pension_category 	= $this->security->xss_clean($this->input->post('pension_category'));
		$pension_for 		= $this->security->xss_clean($this->input->post('pension_for'));
		$pension_scheme 	= $this->security->xss_clean($this->input->post('pension_scheme'));
		$com_pension_rate	= $this->security->xss_clean($this->input->post('com_pension_rate'));
		
		if(isset($pension_category) && ($pension_category!='')) {$pensioner_personal_details['pension_category']=$pension_category;}
		if(isset($pension_for) && ($pension_for!='')) {$pensioner_personal_details['pension_for']=$pension_for;}
		if(isset($pension_scheme) && $pension_scheme!='') {$pensioner_personal_details['pension_scheme']=$pension_scheme;}
		if(isset($com_pension_rate) && ($com_pension_rate!='')) {$pensioner_personal_details['com_pension_rate']=$com_pension_rate;}

		$family_info = array();
		$wife_count=0;
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

			if($_POST['relation'][$i]=="wife"){
				$wife_count++;
			}
	 	}

	 	if($wife_count==0){
            $wife_count=1;
        }

	 	$bracketes = array('[', ']');
	 	$name_of_legal_heir = str_replace($bracketes, "", $_POST['name_of_legal_heir']);
	 	$legal_heir = array();
	 	$legal_heir['legal_heir'] = $name_of_legal_heir;
	 	array_push($family_info, $legal_heir);
	 	
	 	// $more_wives=$this->security->xss_clean($this->input->post('more_wives'));
	 	// $no_of_wives=$this->security->xss_clean($this->input->post('no_of_wives'));
	 	
	 	$pensioner_family_details = array('family_info'=>serialize($family_info));//,'more_wives'=>$more_wives,'no_of_wives'=>$no_of_wives

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
			case 'NPS':
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

		$weightage_year=$this->security->xss_clean($this->input->post('weightage_year'));
		$weightage_month=$this->security->xss_clean($this->input->post('weightage_month'));
		$weightage_day=$this->security->xss_clean($this->input->post('weightage_day'));
		$weightage=$weightage_year."-".$weightage_month."-".$weightage_day;

		$netqsyear=$this->security->xss_clean($this->input->post('netqsyear'));
		$netqsmonth=$this->security->xss_clean($this->input->post('netqsmonth'));
		$netqsday=$this->security->xss_clean($this->input->post('netqsday'));
		$net_qualifying_service=$netqsyear."-".$netqsmonth."-".$netqsday;
		$service_verification=$this->security->xss_clean($this->input->post('service_verification'));
		//$probation_period=$this->security->xss_clean($this->input->post('probation_period'));
		$smp=$this->security->xss_clean($this->input->post('smp'));
		$office_address=$this->security->xss_clean($this->input->post('office_address'));
		$pensioner_service_details = array('appoint_as'=>$appointas, 'dojac'=>$dojac, 'doj'=>$doj, 'dor'=>$dor, 'dod'=>$dod, 'total_service'=>$total_service, 'non_qualifying_service'=>$non_qualifying_service, 'weightage'=>$weightage,'net_qualifying_service'=>$net_qualifying_service, 'service_verification'=>$service_verification, 'smp'=>$smp, 'office_address'=>$office_address);

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
		//echo $pay_commission;
		$pay_scale = $this->security->xss_clean($this->input->post('pay_scale'));
		$provisional_pension = $this->security->xss_clean($this->input->post('provisional_pension'));
		$provisional_gratuity = $this->security->xss_clean($this->input->post('provisional_gratuity'));
		$excess_pay_and_allowances = $this->security->xss_clean($this->input->post('excess_pay_and_allowances'));
		$others_if_any = $this->security->xss_clean($this->input->post('others_if_any'));
		$com_applied = $this->security->xss_clean($this->input->post('com_applied'));

		$com_per = $this->security->xss_clean($this->input->post('com_per'));

		if($com_applied==1){

			if($com_per>=100){

			$com_per=40;

			}elseif(!is_numeric($com_per)){

				$com_per=40;

			}

			elseif($com_per==0)
			{
				$com_per=40;
			}

		}else{
			$com_per=0;
		}
		

		$dr = ($this->input->post('dr') != '') ? $this->security->xss_clean($this->input->post('dr')) : 'no';
		$ma = ($this->input->post('ma') != '') ? $this->security->xss_clean($this->input->post('ma')) : 'no';
		$total_amount=$this->security->xss_clean($this->input->post('total_pres'));
		$age_retire=$this->security->xss_clean($this->input->post('aryear'));
		$case_file_no=$this->security->xss_clean($this->input->post('case_file_no'));
		$six_pay_band=$this->security->xss_clean($this->input->post('six_pay_band'));
		$bf_increamnet=$this->security->xss_clean($this->input->post('bf_increamnet'));
		$npa=$this->security->xss_clean($this->input->post('npa'));
		// $npa1=$this->security->xss_clean($this->input->post('npa1'));
		// $npa2=$this->security->xss_clean($this->input->post('npa2'));
		$consolidated = $this->security->xss_clean($this->input->post('consolidated'));
		$childDOB = $this->security->xss_clean($this->input->post('childDOB'));
		$child_Date_of_marriage_employment = $this->security->xss_clean($this->input->post('child_Date_of_marriage_employment'));

		if($pay_commission==7 && $npa!=0 && $dor>="2015-07-01")
		{
			$total_amount= $total_amount+$npa;
		}

		//var_dump($total_amount);

		//exit();
				
		//echo $total_pre;
		$pensioner_pay_details = array('pay_commission'=>$pay_commission,'total_amount'=>$total_amount,'age_retire'=>$age_retire,'case_file_no'=>$case_file_no,'six_pay_band'=>$six_pay_band,'bf_increamnet'=>$bf_increamnet, 'pay_scale'=>$pay_scale, 'provisional_pension'=>$provisional_pension, 'provisional_gratuity'=>$provisional_gratuity, 'excess_pay_and_allowances'=>$excess_pay_and_allowances, 'others'=>$others_if_any,'com_applied'=>$com_applied, 'com_per'=>$com_per, 'dr'=>$dr, 'ma'=>$ma, 'pay_info'=>serialize($pay), 'npa'=>$npa, 'consolidated'=>$consolidated, 'childDOB'=>$childDOB, 'child_Date_of_marriage_employment'=>$child_Date_of_marriage_employment);//, 'npa_six_pay_before_incre'=>$npa1, 'npa_six_pay_after_incre'=>$npa2);

		//print_r($pensioner_pay_details);
		//exit();

		$effect_of_pension=$this->security->xss_clean($this->input->post('effect_of_pension'));

		$bank_name=$this->security->xss_clean($this->input->post('bank_name'));
		$account_no=$this->security->xss_clean($this->input->post('account_no'));

		$pin=$this->security->xss_clean($this->input->post('pin'));
		$phone_no=$this->security->xss_clean($this->input->post('phone_no'));
		$code_no = $this->security->xss_clean($this->input->post('code_no'));

		if($class_of_pension!='Normal_Family_Pension'){

			$name_of_accountant_general	= ($this->input->post('name_of_accountant_general') != NULL) ? $this->security->xss_clean($this->input->post('name_of_accountant_general')) : NULL;

			$treasury_officer			= ($this->input->post('treasury_officer') != NULL) ? $this->security->xss_clean($this->input->post('treasury_officer')) : NULL;
			$sub_to						= ($this->input->post('sub_to') != NULL) ? $this->security->xss_clean($this->input->post('sub_to')) : NULL;


		}



		if($class_of_pension=='Normal_Family_Pension'  && $wife_count>1){


			if(!empty($_POST['address_after_retirement'])){
				$address_after=array();

				for ($i=0; $i < count($_POST['address_after_retirement']); $i++) { 

					$address=array();

					$address['address_after_retirement']=$_POST['address_after_retirement'][$i];

					array_push($address_after, $address);
				}


				$address_after_retirement = array('address_after_retirement'=>serialize($address_after));

			}else{
				$address_after_retirement = array('address_after_retirement'=>Null);
			}


			if(!empty($_POST['sub_to'])){
				$sub=array();

				for ($i=0; $i < count($_POST['sub_to']); $i++) { 

					$sub_to=array();

					$sub_to['sub_to']=$_POST['sub_to'][$i];

					array_push($sub, $sub_to);
				}


				$sub_to = array('sub_to'=>serialize($sub));

			}else{
				$sub_to = array('sub_to'=>Null);
			}


			if(!empty($_POST['name_of_accountant_general'])){

				$name_of_ag=array();

				for ($i=0; $i < count($_POST['name_of_accountant_general']); $i++) { 

					$ag=array();

					$ag['name_of_accountant_general']=$_POST['name_of_accountant_general'][$i];

					array_push($name_of_ag, $ag);
				}

				$name_of_accountant_general = array('name_of_ag'=>serialize($name_of_ag));

			}else{
				$name_of_accountant_general = array('name_of_ag'=>Null, 'name_of_accountant_general'=>Null);
			}
			

			if(!empty($_POST['treasury_officer'])){

			$name_of_treasury=array();

			for ($i=0; $i < count($_POST['treasury_officer']); $i++) { 

				$treasury=array();

				$treasury['treasury_officer']=$_POST['treasury_officer'][$i];

				array_push($name_of_treasury, $treasury);
			}

				$treasury_officer = array('name_of_treasury'=>serialize($name_of_treasury));

			}else{
				$treasury_officer = array('name_of_treasury'=>Null, 'treasury_officer'=>Null);
			}

		}
		else
		{
			if(!empty($_POST['address_after_retirement'])){

			$address_after=$this->security->xss_clean($this->input->post('address_after_retirement'));

			if(is_array($address_after)){
				$address_after=Null;
			}

			$address_after_retirement=array('address_after_retirement'=>$address_after);

			}else{
				$address_after_retirement=array('address_after_retirement'=>Null);
			}


			if(!empty($_POST['sub_to'])){

			$sub_to=$this->security->xss_clean($this->input->post('sub_to'));

			if(is_array($sub_to)){
				$sub_to=Null;
			}

			$sub_to=array('sub_to'=>$sub_to);

			}else{
				$sub_to=array('sub_to'=>Null);
			}


			if(!empty($_POST['name_of_accountant_general'])){

			$name_of_ag=$this->security->xss_clean($this->input->post('name_of_accountant_general'));

			if(is_array($name_of_ag)){
				$name_of_ag=Null;
			}

			$name_of_accountant_general=array('name_of_accountant_general'=>$name_of_ag, 'name_of_ag'=>Null);


			}else{
				$name_of_accountant_general=array('name_of_accountant_general'=>Null, 'name_of_ag'=>Null);
			}

			if(!empty($_POST['treasury_officer'])){

			$name_of_treasury=$this->security->xss_clean($this->input->post('treasury_officer'));

			if(is_array($name_of_treasury)){
				$name_of_treasury=Null;
			}

			$treasury_officer=array('treasury_officer'=>$name_of_treasury, 'name_of_treasury'=>Null);

			}else{
				$treasury_officer=array('treasury_officer'=>Null, 'name_of_treasury'=>Null);
			}

		}

		//var_dump($address_after_retirement);
		//var_dump($treasury_officer);
		//exit();

		$pensioner_treasury_details = array('effect_of_pension'=>$effect_of_pension, 'bank_name'=>$bank_name, 'account_no'=>$account_no, 'pin'=>$pin, 'phone_no'=>$phone_no, 'code_no'=>$code_no);
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
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $address_after_retirement);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $name_of_accountant_general);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $treasury_officer);
		$this->db->where('serial_no', $serial_no)->update('pensioner_treasury_details', $sub_to);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
		    return false;
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$pensioner = $this->pensioner;
			$comm = ($pensioner->getCommutationofPension() == 'N/A') ? 0 : $pensioner->getCommutationofPension();
			pdupdate($pensioner->case_no, ['gratuity'=>$pensioner->getDCRG(), 'commutation'=>$comm, 'leave_encashment'=>$pensioner->getEarnMoney()]);

				$fidate=$this->input->post('fidate');
				$toidate=$this->input->post('toidate');
				$irate=$this->input->post('irate');
				$iamount=$this->input->post('iamount');
				$case=$this->input->post('case_no');

				$this->db->query("Delete from increment_detail where case_no='$case'");

			$ictr=count($fidate);
			for($i=0;$i<$ictr;$i++){

				if($iamount[$i]!=NULL or $iamount[$i]!=0){
$this->db->query("INSERT INTO increment_detail (case_no, from_date,to_date,rate_of_pay,amount) VALUES ('$case','$fidate[$i]','$toidate[$i]','$irate[$i]','$iamount[$i]')");
						}

					}





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
		$ctr=$this->db->query("Select * from master_dearness_allowance where da=".$this->input->post('DA_value'));
		if($ctr->num_rows()==0){
			if($this->db->insert('master_dearness_allowance',$data)) {
			return true;
			} else {
				return false;
			}
		}else{
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