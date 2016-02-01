<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Pensioner {


	//call this library like this
	/*$this->load->library('Pensioner', array('serial_no'=>'1001'));
	$pensioner = $this->pensioner;

	echo $pensioner->name."<br />";*/


	//pensioner_personal_details
	var $serial_no 					= '';
	var $cash_received 				= '';
	var $class_of_pension 			= '';
	var $case_no					= '';
	var $ppo_no						= '';
	var $gpo_no						= '';
	var $cpo_no						= '';
	var $pension_category			= '';
	var $pension_for				= '';
	var $pension_scheme				= '';
	var $com_pension_rate			= '';
	var $dis_category				= '';
	var $dis_percent				= '';
	var $salutation					= '';
	var $name						= '';
	var $dob						= '';
	var $religion					= '';
	var $nationality				= '';
	var $category					= '';
	var $sex						= '';
	var $designation				= '';
	var $pension_attained_age		= '';
	var $pensioner_pronoun			= '';
	var $department					= '';
	var $submitted_form				= '';
	var $submitted_document			= '';
	var $photo						= '';
	var $created_at					= '';

	//pensioner_service_details
	var $appoint_as					= '';
	var $dojac						= '0000-00-00';
	var $doj						= '0000-00-00';
	var $dor						= '0000-00-00';
	var $dod						= '0000-00-00';
	var $total_service				= '';
	var $non_qualifying_service		= '';
	var $net_qualifying_service		= '';
	var $service_verification		= '';
	var $probation_period			= '';
	var $smp						= '';
	var $office_address				= '';

	//pensioner_pay_details
	var $provisional_pension		= '';
	var $provisional_gratuity		= '';
	var $excess_pay_and_allowances	= '';
	var $others						= '';
	var $com_applied				= '';
	var $pay_commission				= '';
	var $dr							= '';
	var $ma							= '';
	var $pay_info					= array();

	//pensioner_family_details
	var $family_info				= array();


	//pensioner_treasury_details
	var $effect_of_pension 			= '';
	var $name_of_accountant_general	= '';
	var $sub_to 					= '';
	var $treasury_officer 			= '';
	var $bank_name 					= '';
	var $account_no 				= '';
	var $address_after_retirement 	= '';
	var $pin 						= '';
	var $phone_no 					= '';
	var $code_no 					= '';

	//master_department
	var $department_code			= '';
	var $department_name			= '';
	var $department_address			= '';
	var $department_short_code		= '';

	//master_pay_scale
	var $pay_scale_id				= '';
	var $pay_scale_grade			= '';
	var $pay_scale 					= '';

	//master_pay_comm
	var $pay_commission_id			= '';
	var $pay_commission_name		= '';

	//master_accountant_general
	var $accountant_general_id		= '';
	var $accountant_general_name	= '';
	var $accountant_general_state	= '';

	//master_treasury
	var $treasury_id				= '';
	var $treasury_name				= '';

	var $dateFormat					= 'd-m-Y';
	var $lp 						= array();
	var $ip 						= array();
	var $earn_leave					= '';
	var $half_leave					= '';
	var $doc_details				= '';

	public function __construct($params = array())
	{
		//search by serial_no or case_no
		if(isset($params['serial_no'])) :
			$this->serial_no = $params['serial_no'];
		else :
			$this->case_no = $params['case_no'];
		endif;

		$CI =& get_instance();
		//$CI->db->select('ppd.serial_no, ppd.cash_received, ppd.class_of_pension, ppd.case_no, ppd.ppo_no, ppd.gpo_no, ppd.cpo_no, ppd.pension_category, ppd.pension_for, ppd.pension_scheme, ppd.com_pension_rate, ppd.dis_category, ppd.dis_percent, ppd.salutation, ppd.name, ppd.dob, ppd.religion, ppd.nationality, ppd.category, ppd.sex, ppd.designation, ppd.department, ppd.submitted_form, ppd.submitted_document, ppd.photo, ppd.created_at, psd.appoint_as, psd.dojac, psd.doj, psd.dor, psd.dod, psd.total_service, psd.non_qualifying_service, psd.net_qualifying_service, psd.service_verification, psd.probation_period, psd.smp, psd.office_address, ppayd.provisional_pension, ppayd.provisional_gratuity, ppayd.excess_pay_and_allowances, ppayd.others, ppayd.com_applied, ppayd.pay_commission, ppayd.pay_info, pfd.family_info, ptd.effect_of_pension, ptd.name_of_accountant_general, ptd.sub_to, ptd.treasury_officer, ptd.bank_name, ptd.account_no, ptd.address_after_retirement, ptd.pin, ptd.phone_no,master_department.dept_code as department_code, master_department.dept_name as department_name, master_department.address as department_address, master_department.dept_short_code as department_short_code, master_pay_scale.id as pay_scale_id, master_pay_scale.grade as pay_scale_grade, master_pay_scale.pay_scale as pay_scale, master_pay_comm.id as pay_commission_id, master_pay_comm.name as pay_commission_name, master_accountant_general.id as accountant_general_id, master_accountant_general.name as accountant_general_name, master_treasury.id as treasury_id, master_treasury.title as treasury_name');
		$CI->db->select('ppd.serial_no, ppd.cash_received, ppd.class_of_pension, ppd.case_no, ppd.ppo_no, ppd.gpo_no, ppd.cpo_no, ppd.pension_category, ppd.pension_for, ppd.pension_scheme, ppd.com_pension_rate, ppd.dis_category, ppd.dis_percent, ppd.salutation, ppd.name, ppd.dob, ppd.religion, ppd.nationality, ppd.category, ppd.sex, ppd.designation, ppd.department, ppd.submitted_form, ppd.submitted_document, ppd.photo, ppd.created_at, psd.appoint_as, psd.dojac, psd.doj, psd.dor, psd.dod, psd.total_service, psd.non_qualifying_service, psd.net_qualifying_service, psd.service_verification, psd.probation_period, psd.smp, psd.office_address, ppayd.provisional_pension, ppayd.provisional_gratuity, ppayd.excess_pay_and_allowances, ppayd.others, ppayd.com_applied, ppayd.pay_commission, ppayd.dr, ppayd.ma, ppayd.pay_info, pfd.family_info, ptd.effect_of_pension, ptd.name_of_accountant_general, ptd.sub_to, ptd.treasury_officer, ptd.bank_name, ptd.account_no, ptd.code_no, ptd.address_after_retirement, ptd.pin, ptd.phone_no,master_department.dept_code as department_code, master_department.dept_name as department_name, master_department.address as department_address, master_department.dept_short_code as department_short_code, master_pay_scale.id as pay_scale_id, master_pay_scale.grade as pay_scale_grade, master_pay_scale.pay_scale as pay_scale, master_pay_comm.id as pay_commission_id, master_pay_comm.name as pay_commission_name, master_accountant_general.id as accountant_general_id, master_accountant_general.name as accountant_general_name, master_treasury.id as treasury_id, master_treasury.title as treasury_name');
		$CI->db->from('pensioner_personal_details as ppd');
		if(isset($params['serial_no'])) :
			$CI->db->where('ppd.serial_no', $this->serial_no);
		else :
			$CI->db->where('ppd.case_no', $this->case_no);
		endif;
		$CI->db->join('pensioner_service_details as psd', 'psd.serial_no = ppd.serial_no', 'left');
		$CI->db->join('pensioner_pay_details as ppayd', 'ppayd.serial_no = ppd.serial_no', 'left');
		$CI->db->join('pensioner_family_details as pfd', 'pfd.serial_no = ppd.serial_no', 'left');
        $CI->db->join('pensioner_treasury_details as ptd', 'ptd.serial_no = ppd.serial_no', 'left');
        $CI->db->join('master_department', 'master_department.dept_code = ppd.department', 'left');
        $CI->db->join('master_pay_scale', 'master_pay_scale.id = ppayd.pay_scale', 'left');
        $CI->db->join('master_pay_comm', 'master_pay_comm.id = ppayd.pay_commission', 'left');
        $CI->db->join('master_accountant_general', 'master_accountant_general.id = ptd.name_of_accountant_general', 'left');
        $CI->db->join('master_treasury', 'master_treasury.id = ptd.treasury_officer', 'left');

		$result = $CI->db->get()->row();

		$CI->db->select('pfild.ftype as doc_type, pfild.files as doc_path, pfild.status as doc_status, master_document.doc_no, master_document.doc_name');
		$CI->db->from('pensioner_files_details as pfild');
		if(isset($params['serial_no'])) :
			$CI->db->where(array('pfild.serial_no'=>$this->serial_no));
		else :
			$CI->db->where(array('pfild.case_no'=>$this->case_no));
		endif;
		$CI->db->join('master_document', 'master_document.doc_no = pfild.doc_code', 'left');
		$doc_details = $CI->db->get();

		if (count($result) > 0)
		{
			$this->initialize($result);

			$this->doc_details = $doc_details->result_array();
		}
	}


	public function initialize($result = array())
	{
		foreach ($result as $key => $val)
		{
			if($key == 'created_at') :

				$this->$key = $this->dateTimeToDate($val);

			elseif ($key == 'pay_info' || $key == 'family_info') :

				$this->$key = unserialize($val);

			else :

				$this->$key = $val;

			endif;
		}

		foreach ($this->pay_info[0] as $key => $value) :

			if($key != 'post_DA') :

				$this->lp[$key] = $value;

			endif;

		endforeach;

		foreach ($this->pay_info[1] as $key => $value) :

			if($key != 'increament_DA') :

				$this->ip[$key] = $value;

			endif;

		endforeach;

		$this->dor = ($this->dor == '0000-00-00') ? $this->dod : $this->dor;
		$this->earn_leave = $this->pay_info[3]['earn_leave'];
		$this->half_leave = $this->pay_info[4]['half_pay'];

		$this->pension_attained_age = ($this->designation == "Teacher" || $this->designation == "MTF(group D)" || $this->designation =="The Principal Chief Conservator of Forests & Secretary (Enr & Forest)" || $this->designation =="The Principal Chief Conservator of Forest" || $this->designation =="Chief Residence Commissioner" || $this->designation=="The Principal Chief Conservator of Forests (WL & BD), C.W.L.W" || $this->designation=="The Addl. Chief Conservator of Forests" || $this->designation=="The Chief Conservator of Forest" || $this->designation=="The Conservator of Forest" || $this->designation=="Dak Runner") ? '67' : '65';
		$this->pensioner_pronoun = ($this->salutation == "Mr" || $this->salutation == "Shri" || $this->salutation == "Md" || $this->salutation == "Dr") ? 'he' : 'she';
	}

	public function getLastPay($detail = true)
	{
		if($detail) :
			return implode("+", $this->lp)." = ".array_sum($this->lp)." (".implode("+", str_replace("post_", "", array_keys($this->lp))).") ";
		else :
			return array_sum($this->lp);
		endif;
	}

	public function getLastIncreamentPay($detail = true)
	{
		$return = '';

		if($detail) :
			$return .= implode("+", $this->ip)." = ".array_sum($this->ip)." (".implode("+", str_replace("increament_", "", array_keys($this->ip))).") ";
			$return .= (!empty($this->pay_info[2]['last_increament_date'])) ? "<div class='inc-details'>Increament Date ".$this->dateTimeToDate($this->pay_info[2]['last_increament_date'])."</div>" : '';
			return $return;
		else :
			return array_sum($this->ip);
		endif;
	}

	public function getLastPayWithDa()
	{
		return round((array_sum($this->lp)*$this->da_percentage())/100);
	}

	public function da_percentage()
	{
		if($this->pay_info[1]['increament_DA'] == '' || $this->pay_info[1]['increament_DA'] == 0) :
            return $this->pay_info[0]['post_DA'];
        else :
            return $this->pay_info[1]['increament_DA'];
        endif;
	}

	public function getEnhanceRate($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		if($years < 7) {
			return 'N/A';
		} else {
			$total = $this->getLastPay(false);
			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		$return = round($total*50/100);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension') {
					$return = round($total*50/100);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							return 'N/A';
							break;
						default:
							$return = round($total*50/100);
			          		if($detail == true) :
			          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						$return = round($total*50/100);
		          		if($detail == true) :
		          			$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						$return = round($total*50/100);
		          		if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dod);
					//$upto->modify('+10 years +1 day');
					$upto->modify('+10 years');

					$return = round($total*50/100);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				}
			endif;
		}
	}

	public function getNormalFamilyEnhanceRate()
	{
		$from = new DateTime($this->dor);
		$from->modify('+1 day');

		return $this->getEnhanceRate(false). ' from '.$from->format('d-m-Y')." to ".$this->dateTimeToDate($this->dod);
	}

	public function getOrdinaryRate()
	{
		$output = '';
		$total = round($this->getLastPay(false)*30/100);
		list($year, $month, $date) = explode("-", $this->dor);

		if($year >= 2006) :  //pay commission 6
			switch($this->class_of_pension) :
				case 'Extraordinary_Pension':
					$output = $total;
					break;
				case 'Absorption_in_autonomous_body_pension':
					$output = 'N/A';
					break;
				default :
					$output = $total;
					break;
			endswitch;

			if($output != 'N/A' && $output < 3500) :
				return '3500';
			else :
				return $output;
			endif;
		elseif ($year >= 1996) :  //pay commission 5
			switch($this->class_of_pension) :
				case 'Extraordinary_Pension':
					$output = $total;
					break;
				case 'Absorption_in_autonomous_body_pension':
					$output = 'N/A';
					break;
				default :
					$output = $total;
					break;
			endswitch;

			if($output != 'N/A' && $output < 1275) :
				return '1275';
			else :
				return $output;
			endif;
		endif;
	}

	public function getCommutedValue()
	{
		return ceil (($this->getAmountofPension()*40)/100);
	}

	public function getNameOfLegalHeir($detail = true)
	{
		$other_info = $this->family_info;
	    array_pop($other_info);
		$legal_heir = $this->family_info;
		$lharray = end($this->family_info);
		$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));
		if($detail) :
			$return = '';
		else :
			$return = array();
		endif;

		//print_r($other_info);
		foreach ($other_info as $key => $value) {
			$main_key = $key;
			$main_key++;
			if(empty($value['spouse_dod'])) {
				if($detail) :
					if(count($other_info) == 1) :
						$return.=$value['spouse_name']." - ".ucfirst($value['relation'])."<br />";
					else :
						$return.=$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")<br />";
					endif;
				else :
					array_push($return, $value['spouse_name']);
				endif;
			} else {
				$child_info = $value['child'];
				foreach ($child_info as $key => $ci) {
					if(in_array($value['spouse_name'].">".$ci['name'], $list)) {
						if(empty($ci['dod'])) {
							$income = (empty($ci['income'])) ? 0 : $ci['income'];
							if($income < '3000') {
								//check his income
								if($ci['salutation'] == 'mr') {
									$age = calculateDateDifference($ci['dob'], date('Y-m-d'));
									$array = explode(" ", $age);
									if($array[0] >= "18" && $array[0] < "25") {
										if($detail) :
											$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
										else :
											array_push($return, $ci['name']);
										endif;
									} else {
										$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
									}
								} else if($ci['salutation'] == 'miss') {
									if($detail) :
										$return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
									else :
										array_push($return, $ci['name']);
									endif;
								} else if($ci['salutation'] == 'mrs') {
									$return.="Not eligible for the pension because ".$ci['name']." is married<br />";
								} else {}
							} else {
								$return.="Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
							}
						} else {
							$return.=$ci['name']." has expired<br />";
						}
					}
				}
			}
		}

		if($detail) :
			return $return;
		else :
			return implode(", ", $return);
		endif;
	}

	public function getRelationofChild()
	{
		
         $other_info = $this->family_info;
	    array_pop($other_info);
		$return = '';
		foreach ($other_info as $key => $value) {
		//$main_key = $key;
		//$main_key++;
		$child_info = $value['child'];
		foreach ($child_info as $key => $ci) {
			$main_key = $key;
			$main_key++;
			//if(empty($ci['dod'])) {
			if($ci['salutation'] == 'mr') {
			
		//$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
		$return.="Son <br />";


		//$return.=$ci['name']."<br/";

	    } else if($ci['salutation'] == 'miss') {
       // $return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
        $return.="Daughter <br />";


	}
				//}
			//} else {
				//$return.="Late. ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
			//}
		}
	}
		return substr($return, 0, -2);
	}
     public function getNameofChild()
	{
		
        $other_info = $this->family_info;
	    array_pop($other_info);
		$return = '';
		foreach ($other_info as $key => $value) {
		//$main_key = $key;
		//$main_key++;
		$child_info = $value['child'];
		foreach ($child_info as $key => $ci) {
			$main_key = $key;
			$main_key++;
			//if(empty($ci['dod'])) {
			if($ci['salutation'] == 'mr') {
			
		//$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
		$return.=$ci['name']."<br />";


		//$return.=$ci['name']."<br/";

	    } else if($ci['salutation'] == 'miss') {
       // $return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
        $return.=$ci['name']."<br />";


	}
				//}
			//} else {
				//$return.="Late. ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
			//}
		}
	}
		return substr($return, 0, -2);
	}

	public function dobofChild()
	{
      $other_info = $this->family_info;
	    array_pop($other_info);
		$return = '';
		foreach ($other_info as $key => $value) {
		//$main_key = $key;
		//$main_key++;
		$child_info = $value['child'];
		foreach ($child_info as $key => $ci) {
			$main_key = $key;
			$main_key++;
			//if(empty($ci['dod'])) {
			if($ci['salutation'] == 'mr') {
			
		//$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
		//$return.=$ci['dob']."<br />";
		$return.=date_format(date_create($ci['dob']), "d-m-Y")."<br/>";
		//$return.=date_format(date_create($ci['dob']), "d-m-Y").", ";




		//$return.=$ci['name']."<br/";

	    } else if($ci['salutation'] == 'miss') {
       // $return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
        //$return.=$ci['dob']."<br />";
        $return.=date_format(date_create($ci['dob']), "d-m-Y")."<br/>";
        //$return.=date_format(date_create($ci['dob']), "d-m-Y").", ";



	}
				//}
			//} else {
				//$return.="Late. ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
			//}
		}
	}
		return substr($return, 0, -2);
	}


	public function getNameofSpouse()
	{
		$other_info = $this->family_info;
		array_pop($other_info);
		$legal_heir = $this->family_info;
		$lharray = end($this->family_info);
		$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));

		$return = '';
		$total_wife = count($other_info);
		foreach ($other_info as $key => $value) {
			$main_key = $key;
			$main_key++;
			$naration = ($total_wife > 1) ? "(".ordSuffix($main_key)." ".$value['relation']."), " : '';
			if(empty($value['spouse_dod'])) {
				if($value['relation']=="wife") {
					$return.="Smti ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				} else {
					$return.="Shri".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				}
			} else {
				$return.="Late. ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
			}
		}
		if($total_wife > 1) :
			return substr($return, 0, -2);
		else :
			return $return;
		endif;
	}


	public function getDOBofSpouse()
	{
		$other_info = $this->family_info;
		array_pop($other_info);
		$legal_heir = $this->family_info;
		$lharray = end($this->family_info);
		$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));

		$return = '';
		foreach ($other_info as $key => $value) {
			$main_key = $key;
			$main_key++;
			if(empty($value['spouse_dod'])) {
				if($value['relation']=="wife") {
					$return.=date_format(date_create($value['spouse_dob']), "d-m-Y").", ";
				} else {
					$return.=date_format(date_create($value['spouse_dob']), "d-m-Y").", ";
				}
			} else {
				$return.=date_format(date_create($value['spouse_dob']), "d-m-Y").", ";
			}
		}
		return substr($return, 0, -2);
	}


	public function getCommutationofPension()
	{
		if($this->com_applied == 1 && $this->cpo_no != 0) :
		//if($this->com_applied == 1) :

			$amountofPension = $this->getAmountofPension();
			$age_at_retirement = $this->age_at_retirement(false, true);
			switch($this->class_of_pension) :
				case 'Absorption_in_autonomous_body_pension':
				case 'Compulsory_Retirement_Pension':
				case 'Disability_Pension':
				case 'Superannuation_Pension':
				case 'Voluntary_Retirement_Pension':
				case 'Invalid_Retirement_Pension':
					return ceil((($amountofPension*40/100)*12)*check_age_at_next_birth($this->pay_commission, $age_at_retirement+1));
					break;
				default:
					return "N/A";
					break;
			endswitch;
		else :
			return "N/A";
		endif;
	}

	public function getReducePension()
	{
		switch($this->class_of_pension) :
			case 'Absorption_in_autonomous_body_pension':
			case 'Compulsory_Retirement_Pension':
			case 'Disability_Pension':
			case 'Superannuation_Pension':
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
				return round($this->getAmountofPension()-($this->getAmountofPension()*40/100));
				break;
			default:
				return 'N/A';
				break;
		endswitch;
	}

	public function getAmountofPension()
	{
		$amountofPension = 0;

		$lastPay 			= $this->getPay($this->lp);
		$averageEmolument 	= $this->getAverageEmolument();

		if($this->class_of_pension == 'Superannuation_Pension' || $this->class_of_pension == 'Compulsory_Retirement_Pension' || $this->class_of_pension == 'Voluntary_Retirement_Pension' || $this->class_of_pension == 'Invalid_Retirement_Pension' || $this->class_of_pension == 'Absorption_in_autonomous_body_pension' || $this->class_of_pension == 'Disability_Pension') :
			list($year, $month, $date) = explode("-", $this->dor);
			switch($this->class_of_pension) :
				case 'Superannuation_Pension':
				case 'Voluntary_Retirement_Pension':
				case 'Disability_Pension':
					if($year >= 2006) :
						//echo "after 1-1-2006";
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
					else :
						//echo "before 1-1-2006";
						$amountofPension = ceil(($averageEmolument*1/2)*($this->year_of_service()/66));
					endif;
					break;
				case 'Invalid_Retirement_Pension':
				case 'Absorption_in_autonomous_body_pension':
					if($year >= 2006) :
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
					else :
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
					endif;
					break;
				case 'Compulsory_Retirement_Pension':
					if($year >= 2006) :
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
						if($this->com_pension_rate=="pension" || $this->com_pension_rate=="both") {
							$amountofPension = ceil($amountofPension*2/3);
						} else {}
					else :
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
						if($this->com_pension_rate=="pension" || $this->com_pension_rate=="both") {
							$amountofPension = ceil($amountofPension*2/3);
						} else {}
					endif;
					break;
			endswitch;

		else :
			//all family pension come here..
			switch($this->class_of_pension) :
				case 'Liberalised_Pension':
					$amountofPension = ceil($lastPay*100/100);
					break;
				case 'Dependent_Pension':
					$amountofPension = ceil($lastPay*60/100);
					break;
				case 'Parents_Pension':
					$amountofPension = ceil($lastPay*30/100);
					break;
				case 'Extraordinary_Pension':
					$bp = $this->lp['post_BP'];
					if($this->pension_category=="A") {
						$amountofPension = ceil($lastPay*60/100);
					} elseif ($this->pension_category=="B" || $this->pension_category=="C") {
						if($this->pension_scheme=="no") {
							$val = (($bp*40)/100);
							if($val<4550) {
								$amountofPension = 4550;
							} else {
								$amountofPension = ceil($val);
							}
						} elseif ($this->pension_scheme=="yes") {
							$val = (($bp*60)/100);
							if($val<7000) {
								$amountofPension = 7000;
							} else {
								$amountofPension = ceil($val);
							}
						}
					} elseif ($this->pension_category=="D" || $this->pension_category=="E") {
						if($this->pension_for=="widow") {
							$amountofPension = ceil($lastPay);
						} elseif ($this->pension_for=="widow_remarriage") {
							$amountofPension = ceil($lastPay*60/100);
						} elseif ($this->pension_for=="no_widow_but_survived_by_children") {
							$val = (($bp*60)/100);
							if($val<7000) {
								$amountofPension = 7000;
							} else {
								$amountofPension = ceil($val);
							}
						} elseif ($this->pension_for=="both_parents_are_alive") {
							$amountofPension = ceil($lastPay*75/100);
						} elseif ($this->pension_for=="only_one_of_them_is_alive") {
							$amountofPension = ceil($lastPay*60/100);
						} else {
							$amountofPension = 0;
						}
					}
					break;
				case 'Normal_Family_Pension':
					return 0;
					break;
			endswitch;
		endif;

		list($year, $month, $date) = explode("-", $this->dor);
		if($year >= 2006) :
			if($amountofPension != 'N/A' && $amountofPension < 3500) :
				return '3500';
			else :
				return $amountofPension;
			endif;
		elseif ($year >= 1996) :
			if($amountofPension != 'N/A' && $amountofPension < 1275) :
				return '1275';
			else :
				return $amountofPension;
			endif;
		endif;
	}

	function getDRMA()
	{
		$str = '';
		if($this->dr == 'yes') :
			$str .= '+DR';
		endif;
		if($this->ma == 'yes') :
			$str .= '+MA';
		endif;
		return $str;
	}


	function getDisabilityPension()
	{
		$disability_pension = 0;

		$last_BP = $this->lp['post_BP'];

		if($this->dis_category == "B")
		{
			if($this->dis_percent == "100") :
				$disability_pension = (($last_BP)*30)/100;
			elseif ($this->dis_percent == "90") :
				$disability_pension = (($last_BP)*27)/100;
			elseif($this->dis_percent == "80") :
				$disability_pension = (($last_BP)*24)/100;
			endif;

		} elseif($this->dis_category == "C") {

			

		}

		$disability_pension = ($disability_pension < 7000) ? 7000 : $disability_pension;

		return $disability_pension;
	}

	public function getDCRG()
	{
		$dcrg = 0;

		$lastPay 			= $this->getPay($this->lp);
		$year_of_service	= $this->year_of_service();
		$latestDaAmount		= $this->getLastPayWithDa();

		list($year, $month, $date) = explode("-", $this->dor);
		list($nYear, $nMonth, $nDays) = explode("-", $this->net_qualifying_service);

		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 20) :
			$times = 12;
		elseif ($nYear >= 20) :
			$times = 1/2;
		endif;

		switch($this->class_of_pension) :
			case 'Dependent_Pension':
			case 'Liberalised_Pension':
			case 'Parents_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*1/2)*$year_of_service;
				break;
			case 'Extraordinary_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*12);
				break;
			case 'Superannuation_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
				endif;
				break;
			case 'Compulsory_Retirement_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
					if($this->com_pension_rate=="gratuity" || $this->com_pension_rate=="both") :
						$dcrg = ($dcrg*2)/3;
					endif;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
				endif;
				break;
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
				else :
					$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
				endif;
				break;
			case 'Absorption_in_autonomous_body_pension':
				if($year >= 2006) :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						//$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
						$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
					}
				else :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						$dcrg = (($lastPay+$latestDaAmount)*1/4)*$year_of_service;
					}
				endif;
				break;
			case 'Disability_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay)*1/4)*$year_of_service;
				else :
					$dcrg = (($lastPay)*1/4)*$year_of_service;
				endif;
				break;
			case 'Normal_Family_Pension':
				if($nYear >= 20) :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times);
				endif;
				break;
		endswitch;

		if($dcrg > 1000000) :
			return "1000000";
		else :
			return ceil($dcrg);
		endif;
	}

	/*public function getAverageEmolument()
	{
		if(count($this->pay_info) > 0) :
			$doi = $this->pay_info[2]['last_increament_date'];
		else :
			$doi = '0000-00-00';
		endif;
		$pay = $this->getPay($this->lp);
		if($doi=="0000-00-00" || $doi=='') {
			return round(($pay*10)/10);
		} else {
			$monthsDiff = getDiffInMonth($this->dor, $doi);
			if($monthsDiff == 0) {
				return round(($pay*10)/10);
			} elseif($monthsDiff >= 10) {
				return round(($pay*10)/10);
			} else {
				$lastPay = $pay-$this->getPay($this->ip);
				$monthForPrev = 10-$monthsDiff;
				return round((($lastPay*$monthForPrev)+($pay*$monthsDiff))/10);
			}
		}
	}*/

	public function getAverageEmolument()
	{
		//in Absorption_in_autonomous_body_pension and voluntary case break calculation
		$doi = (count($this->pay_info) > 0) ? $this->pay_info[2]['last_increament_date'] : '0000-00-00';
		$pay = $this->getPay($this->lp);
		if($doi=="0000-00-00" || $doi=='') {
			return round(($pay*10)/10);
		} else {

			switch ($this->class_of_pension) :
				case 'Dependent_Pension':
				case 'Liberalised_Pension':
				case 'Parents_Pension':
				case 'Extraordinary_Pension':
					return 'N/A';
					break;
				//case 'Voluntary_Retirement_Pension':
				case 'Absorption_in_autonomous_body_pension':
					$forDay = new DateTime($this->dor);
					$forDay->modify('first day of this month');

					$month 	= $this->dateDiff($this->dor, $doi)->format('%m');
					$day 	= $this->dateDiff($this->dor, $forDay->format('Y-m-d'), 'false')->format('%d');

					if($month != 0 || $day != 0) :
						$lastPay = $pay-$this->getPay($this->ip);

						$lpBDtotal = ($lastPay*(30-$day)/30);
						if($month != 0) :
							$lpBMtotal = ($lastPay*(10-($month+1)));
						else :
							$lpBMtotal = ($pay*(10-($month+1)));
						endif;
						$lpFMtotal = ($pay*$month);
						$lpFDtotal = (($pay*$day)/30);

						/*echo "lpBDtotal = (".$lastPay."*(30-".$day."/30)) = ".$lpBDtotal."<br />";
						echo "lpBMtotal = (".$lastPay."*(10-(".$month."+1))) = ".$lpBMtotal."<br />";
						echo "lpFMtotal = (".$pay."*".$month.") = ".$lpFMtotal."<br />";
						echo "lpFDtotal = ((".$pay."*".$day.")/30) = ".$lpFDtotal."<br />";*/

						return round(($lpFDtotal+$lpFMtotal+$lpBMtotal+$lpBDtotal)/10, 2);
					endif;

					break;
				default:
					$monthsDiff = getDiffInMonth($this->dor, $doi);
					//return $monthsDiff;
					if($monthsDiff == 0) :
						return round(($pay*10)/10);
					elseif($monthsDiff >= 10) :
						return round(($pay*10)/10);
					else :
						$lastPay = $pay-$this->getPay($this->ip);
						$monthForPrev = 10-$monthsDiff;
						return round((($lastPay*$monthForPrev)+($pay*$monthsDiff))/10);
					endif;
					break;
			endswitch;
		}
	}

	public function getServiceGratuity()
	{
		switch ($this->class_of_pension) :
			case 'Invalid_Retirement_Pension':
				$nqs = explode("-", $this->net_qualifying_service);
				if($nqs[0] < 10) :
					$total = $this->getLastPay(false) + $this->getLastPayWithDa();
					return ceil(($total*1/2)*$this->year_of_service());
				else :
					return 0;
				endif;
				break;
			case 'Absorption_in_autonomous_body_pension':
				if($this->pension_scheme == "no") :
					$nqs = explode("-", $this->net_qualifying_service);
					if($nqs[0] < 10) :
						$total = $this->getLastPay(false) + $this->getLastPayWithDa();
						return ceil(($total*1/2)*$this->year_of_service());
					else :
						return 0;
					endif;
				else :
					$total = $this->getLastPay(false) + $this->getLastPayWithDa();
					return ceil(($total*1/2)*$this->year_of_service());
				endif;
				break;
			default:
				return 0;
				break;
		endswitch;
	}

	public function checkForm23()
	{
		//$form_Submit, $net_qualifing_service
		$nqs = explode("-", $this->net_qualifying_service);
		if($nqs[0] < 10) {
			return "";
		} else {
			if(is_array($this->getSubmittedDocument())) :
				if(in_array("23", $this->getSubmittedDocument())) {
					return "";
				} else {
					return "<div class='error'>Form 23 has to be submitted.</div>";
				}
			else :
				return "<div class='error'>Form 23 has to be submitted.</div>";
			endif;
		}
	}

	public function getGratuity()
	{
		return ceil(($this->getLastPay(false)*$this->year_of_service())/4);
	}

	public function getTerminalGratuity()
	{
		if($this->pension_scheme == "no"){
			return 0;
		} else {
			return ceil(($this->getAmountofPension()-$this->getReducePension())*12*check_age_at_next_birth($this->pay_commission, $this->age_at_retirement(true, true)+1));
		}
	}

	function getAllGratuityStatus()
	{
		//have to work
		$return = '';
		if($this->provisional_pension!="0" && !empty($this->provisional_pension)) {
			$return.="<b>Pension Rs. ".$this->provisional_pension."/-</b><br />";
		} else {
			$return.="<b>Pension Rs. Not Paid/-</b><br />";
		}
		if($this->provisional_gratuity!="0" && !empty($this->provisional_gratuity)) {
			$return.="<b>Gratuity Rs. ".$this->provisional_gratuity."/-</b><br />";
		} else {
			$return.="<b>Gratuity Rs. Not Paid/-</b><br />";
		}
		if($this->excess_pay_and_allowances!="0" && !empty($this->excess_pay_and_allowances)) {
			$return.="<b>Excess pay and allowances Rs. ".$this->excess_pay_and_allowances."-/</b><br />";
		} else {
			$return.="<b>Excess pay and allowances Rs. Not Paid/-</b><br />";
		}
		if($this->others!="0" && !empty($this->others)) {
			$return.="<b>If any Rs. ".$this->others."-/</b><br />";
		} else {
			$return.="<b>If any Rs. Not Paid-/</b><br />";
		}
		return $return;
	}


	public function getEarnMoney()
	{
		return ceil((round($this->getLastPay(false)*$this->da_percentage()/100)+$this->getLastPay(false))*$this->earn_leave/30);
	}

	public function getHalfMoney()
	{
		$da_amount = $this->getLastPay(false)*$this->da_percentage()/100;
		return ceil(round(($this->getLastPay(false)+$da_amount)/2)*(300-$this->earn_leave)/30);
	}

	public function getTotalLeaveEncashment()
	{
		return $this->getEarnMoney()+$this->getHalfMoney();
	}


	public function getEnhanceRateReautho()
	{
		return round($this->getLastPay(false)*50/100);
	}

	public function getOrdinaryRateReautho()
	{
		return round($this->getLastPay(false)*30/100);
	}


	public function age_at_joining($detail = true)
	{
		$result = $this->dateDiff($this->doj, $this->dob);
		//print_r($result);
		if($detail) :
			$year = ($result->y > 1) ? ' years ' : ' year ';
			$month= ($result->m > 1) ? ' months ' : ' month ';
			$day  = ($result->d > 1) ? ' days ' : ' day ';
			return $result->y.$year.$result->m.$month.$result->d.$day;
		else :
			return $result->y.'-'.$result->m.'-'.$result->d;
		endif;
	}

	public function age_at_retirement($detail = true, $returnYear = false)
	{
		$result = $this->dateDiff($this->dor, $this->dob);
		if($detail) :
			$year = ($result->y > 1) ? ' years ' : ' year ';
			$month= ($result->m > 1) ? ' months ' : ' month ';
			$day  = ($result->d > 1) ? ' days ' : ' day ';
			if($returnYear) :
				return $result->y;
			else :
				return $result->y.$year.$result->m.$month.$result->d.$day;
			endif;
		else :
			if($returnYear) :
				return $result->y;
			else :
				return $result->y.'-'.$result->m.'-'.$result->d;
			endif;
		endif;
	}

	public function non_qualifying_service($detail = true)
	{
		$data = explode("-", $this->non_qualifying_service);
		if($detail) :
			$year = ($data[0] > 1) ? ' years ' : ' year ';
			$month= ($data[1] > 1) ? ' months ' : ' month ';
			$day  = ($data[2] > 1) ? ' days ' : ' day ';
			return $data[0].$year.$data[1].$month.$data[2].$day;
		else :
			return $data[0].'-'.$data[1].'-'.$data[2];
		endif;
	}

	public function net_qualifying_service($detail = true)
	{
		$data = explode("-", $this->net_qualifying_service);
		if($detail) :
			$year = ($data[0] > 1) ? ' years ' : ' year ';
			$month= ($data[1] > 1) ? ' months ' : ' month ';
			$day  = ($data[2] > 1) ? ' days ' : ' day ';
			return $data[0].$year.$data[1].$month.$data[2].$day;
		else :
			return $data[0].'-'.$data[1].'-'.$data[2];
		endif;
	}

	public function getSubmittedDocument($detail = '')
	{
		if( count($this->doc_details) > 0 ) :
			if( $detail != '' ) :
				$return = array();
				foreach($this->doc_details as $i => $rows) :
					foreach($rows as $key => $value) :
						if( $detail == $key ) :
							array_push($return, $value);
						endif;
					endforeach;
				endforeach;
				return trim(implode(", ", $return));
			else :
				return $this->doc_details;
			endif;
		else :
			return '';
		endif;
	}

	public function dateTimeToDate($date)
	{
		$date = new DateTime($date);
		return $date->format($this->dateFormat);
	}

	public function dateDiff($date1, $date2, $include = 'true')
	{
		$date1 = new DateTime($date1);
		$date2 = new DateTime($date2);
		if($include == 'true') :
			$date1->modify('+1 day');
		endif;
		return $date1->diff($date2);
	}

	public function year_of_service()
	{
		$array = explode('-', $this->net_qualifying_service);
		$years = $array[0];
		$months = $array[1];
		if($years >= 33) :
			$years = 33;
			$months = 0;
		endif;
		$total = $years*2;
		if($months > 3 && $months <= 8) :
			$total+=1;
		elseif($months >= 9 && $months <= 11) :
			$total+=2;
		endif;
		return $total;
	}

	public function getPay($data, $da_post = '')
	{
		if(is_array($data)) :
			return round(array_sum($data));
		else :
			return round($data);
		endif;
	}

	public function treasuryOfficer()
	{
		if($this->name_of_accountant_general == NULL || $this->name_of_accountant_general == '') :

			return $this->treasury_name;

		else :

			return $this->sub_to;

		endif;
	}

	public function pensionRule()
	{
		$rule = '';

		switch ($this->class_of_pension) {
			case 'Voluntary_Retirement_Pension':
				$rule = '48(A)';
				break;
			case 'Superannuation_Pension':
				$rule = '35';
				break;
			case 'Normal_Family_Pension':
				$rule = '54';
				break;
			case 'Invalid_Retirement_Pension':
				$rule = '38';
				break;
			case 'Compulsory_Retirement_Pension':
				$rule = '40';
				break;
			case 'Extraordinary_Pension':
			case 'Disability_Pension':
			case 'Liberalised_Pension':
				$rule = 'EOP';
				break;
			case 'Absorption_in_autonomous_body_pension':
				$rule = '37(A)';
			default:
				$rule = '';
				break;
		}

		return 'Under rule '.$rule.' of CCS Pension 1972';
	}
}