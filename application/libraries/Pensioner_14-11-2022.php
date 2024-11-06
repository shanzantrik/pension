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
	var $sub_designation			= '';
	var $pension_attained_age		= '';
	var $pensioner_pronoun			= '';
	var $department					= '';
	var $submitted_form				= '';
	var $submitted_document			= '';
	var $photo						= '';
	var $created_at					= '';
	var $blood_group				= '';
	var $idcard_serial_no           = '';

	//pensioner_service_details
	var $appoint_as					= '';
	var $dojac						= '0000-00-00';
	var $doj						= '0000-00-00';
	var $dor						= '0000-00-00';
	var $dod						= '0000-00-00';
	var $dorcpt						= '0000-00-00';
	var $total_service				= '';
	var $non_qualifying_service		= '';
	var $net_qualifying_service		= '';
	var $Weightage					= '';
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
	var $total_amount				= '';
	var $age_retire					= '';
	var $sixgratu					='';
	var $case_file_no				='';
	var $six_pay_band				='';
	var $bf_increamnet				='';

	//pensioner_family_details
	var $family_info				= array();
	var $spouse_dod					= '';
	// var $more_wives					= '';
	// var $no_of_wives				= '';
	
	//pensioner_treasury_details
	var $effect_of_pension 			= '';
	var $name_of_accountant_general	= '';
	var $name_of_ag='';
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
	var $consolidated               = '';
    var $childDOB					= '0000-00-00';
	var $child_Date_of_marriage_employment= '0000-00-00';

	//master_accountant_general
	var $accountant_general_id		= '';
	var $accountant_general_name	= '';
	var $accountant_general_state	= '';

	//master_treasury
	var $treasury_id				= '';
	var $treasury_name				= '';
	var $name_of_treasury			= '';

	var $dateFormat					= 'd-m-Y';
	var $lp 						= array();
	var $ip 						= array();
	var $earn_leave					= '';
	var $half_leave					= '';
	var $doc_details				= '';
	//var $benificery_type			='';
	var $son_daughter				= '';
	var $com_per				= '';

	var $npa='';
	//var $observation_by             = '';
    

	
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
		$CI->db->select('ppd.serial_no, ppd.cash_received, ppd.class_of_pension, ppd.case_no, ppd.ppo_no, ppd.gpo_no, ppd.cpo_no, ppd.pension_category, ppd.pension_for, ppd.pension_scheme, ppd.com_pension_rate, ppd.dis_category, ppd.dis_percent, ppd.salutation, ppd.name, ppd.dob, ppd.religion, ppd.nationality, ppd.category, ppd.sex, ppd.designation,ppd.sub_designation, ppd.department, ppd.submitted_form, ppd.submitted_document, ppd.photo, ppd.created_at,ppd.name_ais,ppd.department_ais,ppd.designation_ais,ppd.batch_ais,psd.appoint_as, psd.dojac, psd.doj, psd.dor, psd.dod, psd.total_service, psd.non_qualifying_service, psd.net_qualifying_service, psd.Weightage, psd.service_verification, psd.probation_period, psd.smp, psd.office_address, ppayd.provisional_pension, ppayd.npa, ppayd.provisional_gratuity, ppayd.excess_pay_and_allowances, ppayd.others, ppayd.com_per, ppayd.com_applied, ppayd.pay_commission,ppayd.total_amount,ppayd.age_retire,ppayd.sixgratu,ppayd.case_file_no,ppayd.six_pay_band,ppayd.bf_increamnet, ppayd.dr, ppayd.ma, ppayd.pay_info, pfd.family_info, ptd.effect_of_pension, ptd.name_of_accountant_general,ptd.name_of_ag, ptd.name_of_treasury, ptd.sub_to, ptd.treasury_officer, ptd.bank_name, ptd.account_no, ptd.code_no, ptd.address_after_retirement, ptd.pin, ptd.phone_no,master_department.dept_code as department_code, master_department.dept_name as department_name, master_department.address as department_address, master_department.dept_short_code as department_short_code, master_pay_scale.id as pay_scale_id, master_pay_scale.grade as pay_scale_grade, master_pay_scale.pay_scale as pay_scale, master_pay_comm.id as pay_commission_id, master_pay_comm.name as pay_commission_name, master_accountant_general.id as accountant_general_id, master_accountant_general.name as accountant_general_name, master_treasury.id as treasury_id, master_treasury.title as treasury_name, pension_receipt_file_master.dept_forw_no,pension_receipt_file_master.receipt_date as dorcpt, reauth.pensioner_husbandwife_dod as dod_spouse, reauth.claiment_name, reauth.claiment_dob,reauth.benificery_type,reauth.son_daughter, ppd.blood_group, ppd.idcard_serial_no, ppayd.consolidated, ppayd.childDOB, ppayd.child_Date_of_marriage_employment');//, pfd.more_wives, pfd.no_of_wives

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
        $CI->db->join('pension_receipt_file_master', 'pension_receipt_file_master.file_No = ppd.case_no', 'left');
        //$CI->db->join('pension_receipt_register_master', 'pension_receipt_register_master.dept_forw_no = pension_receipt_file_master.dept_forw_no', 'inner');
        $CI->db->join('reauthorization as reauth', 'reauth.file_no = ppd.case_no', 'left');
		
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
			$return .= (!empty($this->pay_info[1]['last_increament_date'])) ? "<div class='inc-details'>Increament Date ".$this->dateTimeToDate($this->pay_info[1]['last_increament_date'])."</div>" : '';
			return $return;
			
			
		else :
			return array_sum($this->ip);
		endif;
	}


public function getLastPayWithDaSIX()
	{

		
		$pay = $this->getPay($this->lp);//var $lp = array();


		return round(($pay)*$this->da_percentageSIX()/100);


	}




	public function getLastPayWithDa()
	{

		if($this->pay_commission==7){
			$pay=$this->total_amount;
		}
		else{
		$pay = $this->getPay($this->lp);//var $lp = array();
			}

		return round(($pay)*$this->da_percentage()/100);


	}
	
	
	
	public function WifeDODCondition()
		{
		   return $spouse_dod	= $this->family_info[0]['spouse_dod'];
		}


	public function da_percentageSIX()
	{
				if($this->pay_info[1]['increament_DA'] == '' || $this->pay_info[1]['increament_DA'] == 0) :
					           $da_percentage= $this->pay_info[0]['post_DA'];
					      else :
					           $da_percentage= $this->pay_info[1]['increament_DA'];
					         endif;
					
				return $da_percentage;
	}


	public function da_percentage()
	{
		// if($this->pay_info[1]['increament_DA'] == '' || $this->pay_info[1]['increament_DA'] == 0) :
  //           return $this->pay_info[0]['post_DA'];
  //       else :
  //           return $this->pay_info[1]['increament_DA'];
  //       endif;

		// if($this->pay_commission==7 && $this->dor < '2016-06-30')
		// 			{ $da_percentage= 0;} 
		// 		 elseif($this->pay_commission==7 && $this->dor < '2016-12-31')
		// 		 	{ $da_percentage= 2;}
		// 		 elseif($this->pay_commission==7 && $this->dor < '2017-06-30')
		// 		 	{ $da_percentage= 4;} 
		// 		 elseif($this->pay_commission==7 && $this->dor > '2017-07-01')
		// 		 	{ $da_percentage= 5;} 
				
		// 		 elseif($this->pay_commission==6)
		// 			{

						if($this->pay_info[1]['increament_DA'] == '' || $this->pay_info[1]['increament_DA'] == 0) :
					           $da_percentage= $this->pay_info[0]['post_DA'];
					      else :
					           $da_percentage= $this->pay_info[1]['increament_DA'];
					         endif;

					// }
				return $da_percentage;
	}

	public function getEnhanceRate($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		//$hh=$this->net_qualifying_service;
		//return $hh;
		if($years < 7) {
			return 'N/A';
		} else {

						if($this->pay_commission==7){
						$total=$this->total_amount;
								}
					else{
						$total = $this->getLastPay(false);
						}




			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='NPS' || $class_of_pension=='Death_Gratuity') {
					$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							$return = round($total*50/100);
							return $return;
							break;
						default:
							$return = round($total*50/100);
			          		if($detail == true) :
			          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          			$return;
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension' || $class_of_pension == 'NPS' || $class_of_pension=='Death_Gratuity') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$normal_from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dod);
					//$upto->modify('+10 years +1 day');
					$upto->modify('+10 years');

					// $return = round($total*50/100);
	    //       		if($detail == true) :
	    //       			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	    //       		endif;

					if($this->consolidated=='1')
				    {
						$return = round($total*50/100);
		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		           		endif;
					}
					else
					{
						$upto = new DateTime($this->dor);
						$upto->modify('+10 years');	
						$return = round($total*50/100);


						// if($this->more_wives==1 && $this->no_of_wives>=2)
						// {
						// 	$return= $return/$this->no_of_wives.' (for each wife)';
						// }
						// else
						{$return;}


		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		           		endif;
					}
					return $return;
					
				}
			endif;
		}
	}

	public function getEnhanceRateX($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		//$hh=$this->net_qualifying_service;
		//return $hh;
		if($years < 7) {
			return 'N/A';
		} else {

						if($this->pay_commission==7){
						$total=$this->total_amount;
								}
					else{
						$total = $this->getLastPay(false);
						}




			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='NPS' || $class_of_pension=='Death_Gratuity') {
					$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							$return = round($total*50/100);
							return $return;
							break;
						default:
							$return = round($total*50/100);
			          		if($detail == true) :
			          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          			$return;
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension' || $class_of_pension == 'NPS' || $class_of_pension=='Death_Gratuity') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dod);
					//$upto->modify('+10 years +1 day');
					$upto->modify('+10 years');

					// $return = round($total*50/100);
	    //       		if($detail == true) :
	    //       			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	    //       		endif;

					if($this->consolidated=='1')
				    {
						$return = round($total*50/100);
		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		           		endif;
					}
					else
					{
						$upto = new DateTime($this->dor);
						$upto->modify('+10 years');	
						$return = (round($total*50/100))/$detail;


						// if($this->more_wives==1 && $this->no_of_wives>=2)
						// {
						// 	$return= $return/$this->no_of_wives.' (for each wife)';
						// }
						// else
						{$return;}


		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		           		endif;
					}
					return $return;
					
				}
			endif;
		}
	}
	
	public function getPensionCommencementDate()
	{
		$from = new DateTime($this->dor);
		$from->modify('+1 day');
		$fromdate= $from->format('d-m-Y');
		return $fromdate;
	}

	public function getPensionEndDate()
	{
		$upto = new DateTime($this->childDOB);
		$upto->modify('+25 years -1 days');
		$uptodate= $upto->format('d-m-Y');
		return $uptodate;
	}

	public function getEnhanceRate_ForLessThan25Child($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		//$hh=$this->net_qualifying_service;
		//return $hh;
		if($years < 7) {
			return 'N/A';
		} else {

						if($this->pay_commission==7){
						$total=$this->total_amount;
								}
					else{
						$total = $this->getLastPay(false);
						}




			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='NPS' || $class_of_pension=='Death_Gratuity') {
					$return = round($total*50/100);
	          		// if($detail == true) :
	          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		// endif;
	          		if($this->consolidated=='1')
	          		{
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
	          		    endif;
					} 
					else
					{
						$upto = new DateTime($this->dor);	
						if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          			endif;
					}
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							$return = round($total*50/100);
							return $return;
							break;
						default:
							$return = round($total*50/100);
			          		if($detail == true) :
			          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          			$return;
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension' || $class_of_pension == 'NPS' || $class_of_pension=='Death_Gratuity') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						$return = round($total*50/100);
		          		// if($detail == true) :
		          		// 	$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		// endif;
		          		if($this->consolidated=='1')
		          		{
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		          		    endif;
						} 
						else
						{
							$upto = new DateTime($this->dor);	
							if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          			endif;
						}
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dod);
					//$upto->modify('+10 years +1 day');
					$upto->modify('+10 years');

					// $return = round($total*50/100);
	    //       		if($detail == true) :
	    //       			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	    //       		endif;

					if($this->consolidated=='1')
				    {
						$return = round($total*50/100);
		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto 31-12-2015</b>";
		           		endif;
					}
					else
					{
						$upto = new DateTime($this->childDOB);
						$upto->modify('+25 years -1 days');
						$return = round($total*50/100);


						// if($this->more_wives==1 && $this->no_of_wives>=2)
						// {
						// 	$return= $return/$this->no_of_wives.' (for each wife)';
						// }
						// else
						//{$return;}


		           		if($detail == true) :
		           			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')." thereafter no family pension</b>";
		           		endif;
					}
					return $return;
					
				}
			endif;
		}
	}

	public function getEnhanceRateConsolidated_WorkingSheet($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		//$hh=$this->net_qualifying_service;
		//return $hh;
		if($years < 7) {
			return 'N/A';
		} else {

						if($this->pay_commission==7){
						$total=$this->total_amount;
								}
					else{
						$total = $this->getLastPay(false);
						}




			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		//$return = round($total*50/100);
	          		$return = ceil(($total*50/100)*2.57);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='NPS' || $class_of_pension=='Death_Gratuity') {
					//$return = round($total*50/100);
					$return = ceil(($total*50/100)*2.57);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
							return $return;
							break;
						default:
							//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
			          		if($detail == true) :
			          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          			$return;
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension' || $class_of_pension == 'NPS' || $class_of_pension=='Death_Gratuity') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
		          		if($detail == true) :
		          			$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
		          		if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					if($this->childDOB=='0000-00-00' || $this->childDOB==NULL)
					{
						$upto = new DateTime($this->child_Date_of_marriage_employment);
						$upto->modify('-1 day');
					}
					else
					{	
						$upto = new DateTime($this->childDOB);
						$upto->modify('+25 years -1 day');
					}					
					    //$upto = new DateTime($this->family_info[0]['dob']);	
						$return = ceil(($total*50/100)*2.57);
		           		if($detail == true) :
		           			$return.= " <b> from 01-01-2016 upto ".$upto->format('d-m-Y')." or until he/she gets married or starts earning livelihood whichever is earlier</b>";
		           		endif;
						
					return $return;
				}
			endif;
		}
	}

	public function getEnhanceRateConsolidated_PPOreport($detail = true)
	{
		$class_of_pension = $this->class_of_pension;
		list($years, $months, $day) = explode("-", $this->net_qualifying_service(false));
		//$hh=$this->net_qualifying_service;
		//return $hh;
		if($years < 7) {
			return 'N/A';
		} else {

						if($this->pay_commission==7){
						$total=$this->total_amount;
								}
					else{
						$total = $this->getLastPay(false);
						}




			if($this->dod == '0000-00-00' || is_null($this->dod)) :
			    $from = new DateTime($this->dor);
				$from->modify('+1 day');
				$upto = new DateTime($this->dor);
				$upto->modify('+7 years');
	          	if ($class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		//$return = round($total*50/100);
	          		$return = ceil(($total*50/100)*2.57);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} elseif($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='NPS' || $class_of_pension=='Death_Gratuity') {
					//$return = round($total*50/100);
					$return = ceil(($total*50/100)*2.57);
	          		if($detail == true) :
	          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
							return $return;
							break;
						default:
							//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
			          		if($detail == true) :
			          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
			          			$return;
			          		endif;
							return $return;
							//return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					if($class_of_pension == 'Normal_Family_Pension' || $class_of_pension == 'NPS' || $class_of_pension=='Death_Gratuity') :
						$normal_from = new DateTime($this->dod);
						$normal_from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');
						//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
		          		if($detail == true) :
		          			$return.= " <b>from ".$normal_from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					else :
						$from = new DateTime($this->dor);
						$from->modify('+1 day');
						$upto = new DateTime($this->dor);
						$upto->modify('+7 years +1 day');

						//$return = round($total*50/100);
						$return = ceil(($total*50/100)*2.57);
		          		if($detail == true) :
		          			$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
		          		endif;
						return $return;
					endif;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					if($this->childDOB=='0000-00-00' || $this->childDOB==NULL)
					{
						$upto = new DateTime($this->child_Date_of_marriage_employment);
						$upto->modify('-1 day');
					}
					else
					{	
						$upto = new DateTime($this->childDOB);
						$upto->modify('+25 years -1 day');
					}					
					    //$upto = new DateTime($this->family_info[0]['dob']);	
						$return = ceil(($total*50/100)*2.57);
		           		if($detail == true) :
		           			$return.= " <b>/- PM+DR+MA from 01-01-2016 to ".$upto->format('d-m-Y')." and thereafter no family pension.</b>";//or until he/she gets married or starts earning livelihood whichever is earlier
		           		endif;
						
					return $return;
				}
			endif;
		}
	}

	public function getNormalFamilyEnhanceRate()
	{
		//$from = new DateTime($this->dor);
		//$from->modify('+1 day');

		//return $this->getEnhanceRate(false). ' from '.$from->format('d-m-Y')." to ".$this->dateTimeToDate($this->dod);
		if ($this->class_of_pension != "Normal_Family_Pension" && $this->dod > $this->dor) {
		$from = new DateTime($this->dor);
		$from->modify('+1 day');
		return $this->getEnhanceRate(false). ' from '.$from->format('d-m-Y')." to ".$this->dateTimeToDate($this->dod);
		}
		elseif ($this->dod == $this->dor){
		echo "N/A";
		}
		else {
		echo "N/A";
		}

	}

	public function getOrdinaryRate()
	{
		$output = '';

		//$total = round($this->getLastPay(false)*30/100);
					if($this->pay_commission==7){


						$total=round($this->total_amount)*30/100;

		
//======new addition
						if($total<9000){ $total=9000;}
//====================================
						if(strpos($total,".") !== false)
						{
							return ceil($total);
						}else{
							return $total;
						}


					}
					else{
						 $total = round($this->getLastPay(false)*30/100);
						}


		list($year, $month, $date) = explode("-", $this->dor);

		if($year >= 2006) :  //pay commission 6
			switch($this->class_of_pension) :
				case 'Extraordinary_Pension':
					$output = $total;
					break;
				case 'Absorption_in_autonomous_body_pension':
					$output = $total;
					break;
				default :
					$output = $total;
					break;
			endswitch;



			if($output != 'N/A' && $output < 3500) :
				return '3500';
			elseif($output != 'N/A' && $output < 3500 && $this->class_of_pension!="Absorption_in_autonomous_body_pension") :
				return '3500';
			elseif($output != 'N/A' && $this->class_of_pension=="Absorption_in_autonomous_body_pension") :
				return $output;	
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
  


public function getCommutedValueSIX()
	{
		$amt=0;
		
		
			$amt= ceil (($this->getAmountofPensionSIX()*40)/100);
		
		return $amt;	
	}


	public function getCommutedValue()
	{
		// if($this->com_applied == 1 and $this->cpo_no != 0)
		// {
		// $amt=0;
		
		// if($this->pay_commission=='7' and $this->com_applied=='0'){
			 
		// 	$amt=$this->getAmountofPensionSix();
		// 	 $amt=$amt/100*40;
		// }
		// else
		// {
		// 	$amt= ceil (($this->getAmountofPension()*40)/100);
		// }

		// return $amt;
		// }

		// else
		// {$amt= ceil (($this->getAmountofPension()*40)/100);
		// 	return $amt;
		// }	

		if($this->com_applied=='1')
			{
				if(($this->com_per)>0){

					$amt= floor (($this->getAmountofPension()*($this->com_per))/100);

				}else{

					$amt= round(($this->getAmountofPension()*40)/100);

				}
				
				return $amt;
			}
			elseif($this->com_applied=='0')
			{
				echo 'N/A';
			}
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

		foreach ($other_info as $key => $value) {
			$main_key = $key;
			$main_key++;
			if(empty($value['spouse_dod'])) {
				if($detail) {
					if(count($other_info) == 1) 
					{	if($value['spouse_salutation']=='mr')
						{$return.="Mr. ".$value['spouse_name'].", ".ucfirst($value['relation'])."";}
						elseif($value['spouse_salutation']=='mrs')
						{$return.="Mrs. ".$value['spouse_name'].", ".ucfirst($value['relation'])."";}
					elseif($value['spouse_salutation']=='miss')
						{$return.="Miss. ".$value['spouse_name'].", ".ucfirst($value['relation'])."";}
						
					}else {
						if($value['spouse_salutation']=='mr')
						{$return.="Mr. ".$value['spouse_name'].", ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";}
						elseif($value['spouse_salutation']=='mrs')
						{$return.="Mrs. ".$value['spouse_name'].", ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";}
					}//endif;
				}else {
				array_push($return, $value['spouse_name']);}
				//endif;
			} else {
				$child_info = $value['child'];
				
				foreach ($child_info as $key => $ci) {
				//$return='';//newly added by ibad	
					//if(in_array($value['spouse_name'].">".$ci['name'], $list)) { // blocked by ibad
				//echo $ci['name'];

						if(empty($ci['dod'])) {
							$income = (empty($ci['income'])) ? 0 : $ci['income'];
							if($income < '3000') {
								//check his income
								if($ci['salutation'] == 'mr') {
									 $age = calculateDateDifference($ci['dob'], date('Y-m-d'));
									$array = explode("-", $age);
									//echo $array[0];
									//print_r($array);
									if($array[0] >= "18" && $array[0] < "25") {
										//print_r ($detail);
										if($detail) :
											 $return.="Mr. ".$ci['name'].", Son<br /> ";// (from ".ordSuffix($main_key)." ".$value['relation'].")";

										else :
											array_push($return, $ci['name']);
										endif;
									} else {
										//$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
										$return.="Mr. ".$ci['name'].", Son <br />";
									}
								} else if($ci['salutation'] == 'miss') {
									if($detail) :
										$return.="Miss ".$ci['name'].", Daughter<br />";// (from ".ordSuffix($main_key)." ".$value['relation'].")";
									else :
										array_push($return, $ci['name']);
									endif;
								} else if($ci['salutation'] == 'mrs') {
									$return.=" Not eligible for the pension because ".$ci['name']." is married<br />";
								} else { }
							} else {
								$return.=" Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
							}
						} else {
							$return.=$ci['name']." has expired<br />";
						}
					//}
				}
			}
		}

		if($detail) :
			return $return;
		else :
			return implode(", ", $return);

		endif;
	}
	
	public function getDOBOfLegalHeir($detail = true)//.$ci['dob']
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
						$return.=$value['spouse_dob'];//." of ".ucfirst($value['relation'])."";
					else :
						$return.=$value['spouse_dob'];//." of ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";
					endif;
				else :
					array_push($return, $value['spouse_dob']);
				endif;
			} else {
				$child_info = $value['child'];
				foreach ($child_info as $key => $ci) {
				$return='';//newly added by ibad	
					//if(in_array($value['spouse_name'].">".$ci['name'], $list)) { // blocked by ibad
						if(empty($ci['dod'])) {
							$income = (empty($ci['income'])) ? 0 : $ci['income'];
							if($income < '3000') {
								//check his income
								if($ci['salutation'] == 'mr') {
									$age = calculateDateDifference($ci['dob'], date('Y-m-d'));
									$array = explode("-", $age);
									if($array[0] >= "18" && $array[0] < "25") {
										if($detail) :
											$return.=$ci['dob'];// (from ".ordSuffix($main_key)." ".$value['relation'].")";

										else :
											array_push($return, $ci['dob']);
										endif;
									} else {
										//$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
										$return.=$ci['dob'];
									}
								} else if($ci['salutation'] == 'miss') {
									if($detail) :
										$return.=$ci['dob'];// (from ".ordSuffix($main_key)." ".$value['relation'].")";
									else :
										array_push($return, $ci['dob']);
									endif;
								} else if($ci['salutation'] == 'mrs') {
									$return.="Not eligible for the pension because ".$ci['spouse_dob']." is married<br />";
								} else { }
							} else {
								$return.="Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
							}
						} else {
							$return.=$ci['name']." has expired<br />";
						}
					//}
				}
			}
		}

		if($detail) :
			return $return;
		else :
			return implode(", ", $return);

		endif;
	}

	public function getDOBOfLegalHeirX($detail)//.$ci['dob']
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

		//print_r($detail)."<br/>";
		foreach ($other_info as $key => $value) {
			$main_key = $key;
			$main_key++;
			//print_r($value);

			if(empty($value['spouse_dod'])) {
				if($detail) :
					if(count($other_info) == 1) :
						$return.=$value['spouse_dob'];
					else :
							if($detail==$main_key)
							{
								$return.=$value['spouse_dob'];
							}
					endif;
				else :
					array_push($return, $value['spouse_dob']);
				endif;
			} else {
				$child_info = $value['child'];
				foreach ($child_info as $key => $ci) {
				$return='';//newly added by ibad	
					//if(in_array($value['spouse_name'].">".$ci['name'], $list)) { // blocked by ibad
						if(empty($ci['dod'])) {
							$income = (empty($ci['income'])) ? 0 : $ci['income'];
							if($income < '3000') {
								//check his income
								if($ci['salutation'] == 'mr') {
									$age = calculateDateDifference($ci['dob'], date('Y-m-d'));
									$array = explode("-", $age);
									if($array[0] >= "18" && $array[0] < "25") {
										if($detail) :
											$return.=$ci['dob'];// (from ".ordSuffix($main_key)." ".$value['relation'].")";

										else :
											array_push($return, $ci['dob']);
										endif;
									} else {
										//$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
										$return.=$ci['dob'];
									}
								} else if($ci['salutation'] == 'miss') {
									if($detail) :
										$return.=$ci['dob'];// (from ".ordSuffix($main_key)." ".$value['relation'].")";
									else :
										array_push($return, $ci['dob']);
									endif;
								} else if($ci['salutation'] == 'mrs') {
									$return.="Not eligible for the pension because ".$ci['spouse_dob']." is married<br />";
								} else { }
							} else {
								$return.="Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
							}
						} else {
							$return.=$ci['name']." has expired<br />";
						}
					//}
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
				if($value['relation']=="wife" || $value['relation']=="mother") {
					$return.="Smti. ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				} else {
					$return.="Shri ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				}
			} else {
				$return.="Late ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
			}
		}
		if($total_wife > 1) :
			return substr($return, 0, -2);
		else :
			return $return;
		endif;
	}

	public function getNameofSpouse2()
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
				if($value['relation']=="wife" || $value['relation']=="mother") {
					$return.="Smti. ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				} else {
					$return.="".$value['spouse_salutation']." ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				}
			} else {
				$return.="Late ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
			}
		}
		if($total_wife > 1) :
			return substr($return, 0, -2);
		else :
			return $return;
		endif;
	}

	public function getNameofSpouseD() //For Death Gratuity
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
					$return.="Smti. ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				} else {
					$return.="Shri ".$value['spouse_name']." - ".ucfirst($value['relation']).$naration;
				}
			} else {
				$child_info = $value['child'];
				foreach ($child_info as $key => $ci) {
				$return='';
						if(empty($ci['dod'])) {
								if($ci['salutation'] == 'mr') {

									$return.="Mr ".$ci['name']." - ".'Son ';

								} else if($ci['salutation'] == 'miss') {
										$return.="Miss ".$ci['name']." - ".'Daughter ';
								} 
						} else {
							$return.=$ci['name']." has expired<br />";
						}
				}
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
				if($value['spouse_dob']!='0000-00-00'){
					$return.=date_format(date_create($value['spouse_dob']), "d-m-Y").", ";
				}
				
			}
		}
		return substr($return, 0, -2);
	}



public function getCommutationofPensionSIX()
	{
		if($this->com_applied == 1 && $this->cpo_no != 0) :
		//if($this->com_applied == 1) :

			$amountofPension = $this->getAmountofPensionSIX();
			$age_at_retirement = $this->age_at_retirement(false, true);
			switch($this->class_of_pension) :
				case 'Absorption_in_autonomous_body_pension':
				case 'Compulsory_Retirement_Pension':
				case 'Disability_Pension':
				case 'Superannuation_Pension':
				case 'Voluntary_Retirement_Pension':
				case 'Invalid_Retirement_Pension':
				//return ceil(((39962.5*40/100)*12)*check_age_at_next_birth($this->
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




	public function getCommutationofPension()
	{
		if($this->com_applied == 1 and $this->cpo_no != '0') :
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
				//return ceil(((39962.5*40/100)*12)*check_age_at_next_birth($this->


				if(($this->com_per)>0)
				{
					$commutation=((floor($amountofPension*($this->com_per)/100))*check_age_at_next_birth($this->pay_commission, $age_at_retirement+1))*12;

				}else{
					$commutation=((floor($amountofPension*40/100))*check_age_at_next_birth($this->pay_commission, $age_at_retirement+1))*12;
				}
					

					if(strpos($commutation,".") !== false)
					{
						return ceil($commutation);
					}else{
						return $commutation;
					}
				//return $age_at_retirement;
					break;
				default:
					return "N/A";
					break;
			endswitch;
		else :

			return 'N/A';
		endif;
	}

	public function getReducePension()
	{
		if($this->com_applied == 1 && $this->cpo_no != 0) :
		switch($this->class_of_pension) :
			case 'Absorption_in_autonomous_body_pension':
			case 'Compulsory_Retirement_Pension':
			case 'Disability_Pension':
			case 'Superannuation_Pension':
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
				return round($this->getAmountofPension()-($this->getCommutedValue()));
				break;
			default:
				return 'N/A';
				break;
		endswitch;
		else :

			return 'N/A';
		endif;
	}

    
    public function getPay($data, $da_post = '')
	{
		if(is_array($data)) :
			return round(array_sum($data));
		else :
			return round($data);
		endif;
	}

	public function getAverageEmolument()
	{
		//in Absorption_in_autonomous_body_pension and voluntary case break calculation
		$doi = (count($this->pay_info) > 0) ? $this->pay_info[2]['last_increament_date'] : '0000-00-00';
		//$pay = $this->getPay($this->lp);

			$pbi=$this->bf_increamnet;
		if($this->pay_commission==7){
			$pay=$this->total_amount;
			}
		else{
		$pay = $this->getPay($this->lp);
		$pbi=$pay-$this->getLastIncreamentPay();
		//var $lp = array();
			}
		if($doi=="0000-00-00" || $doi=='') {
			return round(($pay*10)/10);
			//return round(($pay)/10);

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
					$monthsDiff=$monthsDiff+1;
					if($monthsDiff == 0) :
						return round(($pay)/10)*10;
						
					elseif($monthsDiff >= 10) :
						return round(($pay)/10)*10;
						
					else :


						@$mor=date('m',strtotime($this->dor));
						@$moi=date('m',strtotime($doi));

						$q2=$mor-$moi;
						$q1=10-$q2;

							$result_ae = round((($pbi*$q1)+($pay*$q2))/10);
							return $result_ae."= (".$pbi."x".$q1."+".$pay."x".$q2.")/10";

					endif;

// $case_no=$this->case_file_no;
// $query=$this->db->query("select * from increment_detail where case_no='$case'");
// $result=$query->result();
// foreach ($result as $r) {



// }


// 						return 

					break;
			endswitch;
		}
	}
//=====================================
	public function getAverageEmolumentNew()
	{
		$CI=& get_instance();
		$case=$this->case_no;

		$query =$CI->db->query("select * from  increment_detail where case_no='$case' order by to_date asc");
			$result = $query->result();
			$ctrx=0;
			$tot=0;
			$mm=0;
			$monthx;
			foreach($result as $r)
			{
				$tdate=$r->to_date;
				$fdate=$r->from_date;
				$monthx=0;
				$rate=0;
				


				if($fdate==NULL or $fdate=='0000-00-00')
				{
					// $time_stamp1 = strtotime($fdate);
					// $time_stamp2 = strtotime($tdate);

					// $year1 = date('Y', $time_stamp1);
					// $year2 = date('Y', $time_stamp2);

					// $month1 = date('m', $time_stamp1);
					// $month2 = date('m', $time_stamp2); 

					// $diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;

					$monthx=1;
					$rate=$r->rate_of_pay;
					$tot=$tot+($monthx*$rate);
					$mm=$mm.$monthx;
				}
				else
				{
				// $monthx=getDiffInMonth($tdate, $fdate);
				// $rate=$r->rate_of_pay;
				// $tot=$tot+(($monthx)*$rate);
				// $monthx= $monthx + 1;
				// $mm=$mm.$monthx;
				// // echo $tot;
				// // exit();
				

				$time_stamp1 = strtotime($fdate);
				$time_stamp2 = strtotime($tdate);

				$year1 = date('Y', $time_stamp1);
				$year2 = date('Y', $time_stamp2);

				$month1 = date('m', $time_stamp1);
				$month2 = date('m', $time_stamp2); 

				//echo $diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
				$diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;

				//$monthx=getDiffInMonth($tdate, $fdate);
				$monthx=$diff;
				$rate=$r->rate_of_pay;
				$tot=$tot+(($monthx)*$rate);
				$monthx= $monthx;
				$mm=$mm.$monthx;
				//echo $tot;
				//exit();
				}
			$ctrx=$ctrx+1;
			}
			return ($tot/10);
			
			//return ($tot/2);
		
	}
	//==============================

	public function getAverageEmolumentSix()
	{
		//in Absorption_in_autonomous_body_pension and voluntary case break calculation
		$doi = (count($this->pay_info) > 0) ? $this->pay_info[2]['last_increament_date'] : '0000-00-00';
		//$pay = $this->getPay($this->lp);


		
		$pay = $this->getPay($this->lp);//var $lp = array();




		if($doi=="0000-00-00" || $doi=='') {
			return round(($pay)/10);
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
						return round(($pay)/10);
					elseif($monthsDiff >= 10) :
						return round(($pay)/10);
					else :
						$lastPay = $pay-$this->getPay($this->ip);
						$monthForPrev = 10-$monthsDiff;
						return round((($lastPay*$monthForPrev)+($pay*$monthsDiff))/10);
						//return round(($lpFDtotal+$lpFMtotal+$lpBMtotal+$lpBDtotal)/10, 2);
					endif;
					break;
			endswitch;
		}
	}


	// NEW INITIALIZATION OF LP
	// public function lpv(){

	// if($this->pay_commission==7){
	// 		$lastPay=$total_amount;
	// 	}
	// 	else{
	// 	$lastPay = $this->getPay($this->lp);//var $lp = array();
	// 		}

	// 		return $lastPay;
	// }


	

	public function getAmountofPension()
	{
		$amountofPension = 0;
		//$lastPay=lpv();

		if($this->pay_commission==7){
			$lastPay=$this->total_amount;
		}
		else{
		$lastPay = $this->getPay($this->lp);//var $lp = array();
			}

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
					case 'Parents_Pension':
					$amountofPension='N/A';
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

			case 'Death_Gratuity':
				return 0;
				break;	

				case 'NPS':
					return 0;	
                    
    //==============================================================================================================
					//$amountofPension = ceil($lastPay*50/100);
    //==============================================================================================================
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



	public function getAmountofPensionSix()
	{
		$amountofPension = 0;		
		$lastPay = $this->getPay($this->lp);//var $lp = array();

		$averageEmolument 	= $this->getAverageEmolumentSix();

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
				case 'NPS':
					return 0;	
                    
    //==============================================================================================================
					//$amountofPension = ceil($lastPay*50/100);
    //==============================================================================================================
					break;

				case 'Death_Gratuity':
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

	function getGPONo() {
		$this->db->select_max('gpo_no');
		$result = $this->db->get('pensioner_personal_details');
	    $row = $result->result();
	    if($row[0]->gpo_no == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->gpo_no+1;
	    }
	}

	public function getDCRG()
	{
		$dcrg = 0;
		$latestDaAmount=0;

		//$lastPay 			= $this->getPay($this->lp);
		if($this->pay_commission==7){
			$lastPay=$this->total_amount;
		}
		else{
		$lastPay = $this->getPay($this->lp);//var $lp = array();
			}

		$year_of_service = $this->year_of_service();

		
			$latestDaAmount		= $this->getLastPayWithDa();
		

		list($year, $month, $date) = explode("-", $this->dor);
		list($nYear, $nMonth, $nDays) = explode("-", $this->net_qualifying_service);
			$death=$this->dod;
			$retire=$this->dor;

if(strtotime($death)>strtotime('2016-01-01')){
		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 11) :
			$times = 12;
		elseif($nYear >= 11 && $nYear < 20) :
			$times = 20;
		elseif ($nYear >= 20) :
				$times = 1/2;
			//to be discuss . it should be 1/2 or 1/4;
		endif;
}
else
{
		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 20) :
			$times = 12;
		elseif ($nYear >= 20) :
				$times = 1/2;
			//to be discuss . it should be 1/2 or 1/4;
		endif;
}

			if($death=='0000-00-00'){
				$times = 1/4;
			}

		switch($this->class_of_pension) :
			case 'Dependent_Pension':
			case 'Liberalised_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				break;
			case 'Parents_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times);
					
				break;
			case 'Extraordinary_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times);
				break;
			case 'Superannuation_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				endif;
				break;
			case 'Compulsory_Retirement_Pension':
				// if($year >= 2006) :
				// 	$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				// 	if($this->com_pension_rate=="gratuity" || $this->com_pension_rate=="both") :
				// 		$dcrg = ($dcrg*2)/3;

				// 	endif;
				// else :
				// 	$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				// endif;
				$dcrg = (($lastPay+$latestDaAmount)*$times)*$this->smp;
				//need to verify the condition
				break;
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
				if($year >= 2006) :
					$dcrg = ((($lastPay+$latestDaAmount)*$times))*($this->smp);
						//$dcrg=$this->smp;
				else :
					$dcrg = (($lastPay+(($latestDaAmount*72)/100))*$times)*$year_of_service;
				endif;
				break;
			case 'Absorption_in_autonomous_body_pension':
				if($year >= 2006) :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							//$dcrg = 0;
							$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						}
					} else {
						//$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					}
				else :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					}
				endif;
				break;
			case 'Disability_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay)*$times)*$year_of_service;
				else :
					$dcrg = (($lastPay)*$times)*$year_of_service;
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
			case 'NPS':
				if($this->doj>=2008){
					if($nYear >= 20) :
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
					else :
						$dcrg = $lastPay+$latestDaAmount;
						$dcrg = $dcrg*$times;
						$dcrg = $dcrg*$year_of_service;
					endif;
				}else{

					if($nYear >= 20) :
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
					else :
						$dcrg = (($lastPay+$latestDaAmount)*$times);
					endif;
				}
				break;
			case 'Death_Gratuity':
				if($nYear >= 20) :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times);
				endif;
				break;		
		endswitch;

		if($dcrg > 2000000) :
			return "2000000";
		else :
			return ceil($dcrg);
			//return round($dcrg);
		endif;
	}



	public function getDCRGSIX()
	{
			$dcrg = 0;
		$latestDaAmount=0;

		//$lastPay 			= $this->getPay($this->lp);
		
		$lastPay = $this->getPay($this->lp);//var $lp = array();

		$year_of_service = $this->year_of_service();

		
			$latestDaAmount		= $this->getLastPayWithDa();
		

		list($year, $month, $date) = explode("-", $this->dor);
		list($nYear, $nMonth, $nDays) = explode("-", $this->net_qualifying_service);
			$death=$this->dod;
			$retire=$this->dor;

if(strtotime($death)>strtotime('2016-01-01')){
		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 11) :
			$times = 12;
		elseif($nYear >= 11 && $nYear < 20) :
			$times = 20;
		elseif ($nYear >= 20) :
				$times = 1/2;
			//to be discuss . it should be 1/2 or 1/4;
		endif;
}
else
{
		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 20) :
			$times = 12;
		elseif ($nYear >= 20) :
				$times = 1/2;
			//to be discuss . it should be 1/2 or 1/4;
		endif;
}

			if($death=='0000-00-00'){
				$times = 1/4;
			}

		switch($this->class_of_pension) :
			case 'Dependent_Pension':
			case 'Liberalised_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				break;
			case 'Parents_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times);
				break;
			case 'Extraordinary_Pension':
				$dcrg = (($lastPay+$latestDaAmount)*$times);
				break;
			case 'Superannuation_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				endif;
				break;
			case 'Compulsory_Retirement_Pension':
				// if($year >= 2006) :
				// 	$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				// 	if($this->com_pension_rate=="gratuity" || $this->com_pension_rate=="both") :
				// 		$dcrg = ($dcrg*2)/3;

				// 	endif;
				// else :
				// 	$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
				// endif;
				$dcrg = (($lastPay+$latestDaAmount)*$times)*$this->smp;
				//need to verify the condition
				break;
			case 'Voluntary_Retirement_Pension':
			case 'Invalid_Retirement_Pension':
				if($year >= 2006) :
					$dcrg = ((($lastPay+$latestDaAmount)*$times))*($this->smp);
						//$dcrg=$this->smp;
				else :
					$dcrg = (($lastPay+(($latestDaAmount*72)/100))*$times)*$year_of_service;
				endif;
				break;
			case 'Absorption_in_autonomous_body_pension':
				if($year >= 2006) :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						//$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					}
				else :
					if($this->pension_scheme == "no") {
						$nqs = explode("-", $this->net_qualifying_service(false));
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					}
				endif;
				break;
			case 'Disability_Pension':
				if($year >= 2006) :
					$dcrg = (($lastPay)*$times)*$year_of_service;
				else :
					$dcrg = (($lastPay)*$times)*$year_of_service;
				endif;
				break;
			case 'Normal_Family_Pension':
				if($nYear >= 20) :
					//$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times);
				endif;
				break;
			case 'NPS':
				if($nYear >= 20) :
					//$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
						$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
					//echo "((".$lastPay."+".$latestDaAmount.")*".$times.")*".$year_of_service;
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times);
				endif;
				break;
			case 'Death_Gratuity':
				if($nYear >= 20) :
					//$dcrg = (($lastPay+$latestDaAmount)*$times)*$year_of_service;
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
			//return $this->pension_scheme;
				if($this->pension_scheme == "no") :
					$nqs = explode("-", $this->net_qualifying_service);
					if($nqs[0] < 10) :
						$total = $this->getLastPay(false) + $this->getLastPayWithDa();
						return ceil(($total*1/2)*$this->year_of_service());
					else :
						return 'N/A';
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
			return 'N/A';
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
			$return.="<b>If any Rs. Not Paid/-</b><br />";
		}
		return $return;
	}

	function getAllGratuityStatusX($i)
	{
		//For two or more wives
		$return = '';
		if($this->provisional_pension!="0" && !empty($this->provisional_pension)) {
			$return.="<b>Pension Rs. ".$this->provisional_pension/$i."/-</b><br />";
		} else {
			$return.="<b>Pension Rs. Not Paid/-</b><br />";
		}
		if($this->provisional_gratuity!="0" && !empty($this->provisional_gratuity)) {
			$return.="<b>Gratuity Rs. ".$this->provisional_gratuity/$i."/-</b><br />";
		} else {
			$return.="<b>Gratuity Rs. Not Paid/-</b><br />";
		}
		if($this->excess_pay_and_allowances!="0" && !empty($this->excess_pay_and_allowances)) {
			$return.="<b>Excess pay and allowances Rs. ".$this->excess_pay_and_allowances/$i."/-</b><br />";
		} else {
			$return.="<b>Excess pay and allowances Rs. Not Paid/-</b><br />";
		}
		if($this->others!="0" && !empty($this->others)) {
			$return.="<b>If any Rs. ".$this->others/$i."-/</b><br />";
		} else {
			$return.="<b>If any Rs. Not Paid/-</b><br />";
		}
		return $return;
	}


	public function getEarnMoney()
	{

		if($this->pay_commission==7){
			$pay=$this->total_amount;
		}
		else{
		$pay=$this->getLastPay(false);
			}

		//return ceil((round($pay*$this->da_percentage()/100)+$pay)*$this->earn_leave/30);
		return round((round($pay*$this->da_percentage()/100)+$pay)*$this->earn_leave/30);
	}

	public function getHalfMoney()
	{

		if($this->pay_commission==7){
			$pay=$this->total_amount;
		}
		else{
		$pay=$this->getLastPay(false);
			}

		$da_amount =$pay*$this->da_percentage()/100;
		//return ceil(round(($this->getLastPay(false)+$da_amount)/2)*(300-$this->earn_leave)/30);
		//return floor(round((($pay+$da_amount)/2)*($this->half_leave))/30);
		return round(round((($pay+$da_amount)/2)*($this->half_leave))/30);
	}

	public function getTotalLeaveEncashment()
	{
		return round($this->getEarnMoney()+$this->getHalfMoney());
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

//Added for View Weightage on 15/07/19 by SHantanu


	public function Weightage($detail = true)
	{
		$data = explode("-", $this->Weightage);
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
		if($months >= 3 && $months <= 8) :
			$total+=1;
		elseif($months >= 9 && $months <= 11) :
			$total+=2;
		endif;
		return $total;
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
			case 'NPS':
				$rule = '54';
				break;
			case 'Death_Gratuity':
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


	public function getNumberOfWives($detail = true)
	{
		$family_info = $this->family_info;

		array_pop($family_info);

		$count=0;

		foreach ($family_info as $key => $value) {

			if($value['relation']=='wife')
			{
				$count++;
			}
			
		}

		return $count;
		
	}



	public function getAddressAfterRetirement($i)
	{

		$check_address=explode('s:', $this->address_after_retirement);

		if(!empty($check_address[1])){

		$address_after_retirement = unserialize($this->address_after_retirement);

		if(is_array($address_after_retirement))
		{ 
		$address="";	
		$j=0;
		foreach ($address_after_retirement as $key => $value) {

			if($i==$j)
			{
			   $address=$value['address_after_retirement'];	
			}

		    $j++;
		}

			return $address;

		}

		}else{

		    $address=$this->address_after_retirement;

		    return $address;

		}

	}

	public function getAG($i)
	{
		$check_tg=explode('s:', $this->name_of_ag);

/*print_r($check_tg);
die();*/
		//var_dump($this->name_of_treasury);

		if(!empty($check_tg[1])){

		$treasury_officer = unserialize($this->name_of_ag);

		if(is_array($treasury_officer))
		{ 

		$treasury="";	

		$j=0;
		foreach ($treasury_officer as $key => $value) {

			if($i==$j)
			{
				if($value['name_of_accountant_general']!=""){
			   $treasury=getNameOfAccountantGeneral($value['name_of_accountant_general']);	
				}
			}

		    $j++;
		}

			return $treasury;

		}

		}else{

		    $treasury=$this->name_of_accountant_general;

		    return $treasury;

		}
	}

	public function getTg($i)
	{
		$check_tg=explode('s:', $this->name_of_treasury);

		//var_dump($this->name_of_treasury);

		if(!empty($check_tg[1])){

		$treasury_officer = unserialize($this->name_of_treasury);

		if(is_array($treasury_officer))
		{ 

		$treasury="";	

		$j=0;
		foreach ($treasury_officer as $key => $value) {

			if($i==$j)
			{
				if($value['treasury_officer']!=""){
			     $treasury=getTreasury($value['treasury_officer']);	
				}
			}

		    $j++;
		}

			return $treasury;

		}

		}else{
			
			//die();
		    $treasury=$this->treasury_officer;

		    return $treasury;

		}

	}



	public function getAGx($i)
	{
		$check_tg=explode('s:', $this->name_of_ag);

/*print_r($check_tg);
die();*/
		//var_dump($this->name_of_treasury);

		if(!empty($check_tg[1])){

		$treasury_officer = unserialize($this->name_of_ag);

		if(is_array($treasury_officer))
		{ 

		$treasury="";	

		$j=0;
		foreach ($treasury_officer as $key => $value) {

			if($i==$j)
			{
				if($value['name_of_accountant_general']!=""){
			   $treasury=getNameOfAccountantGeneral($value['name_of_accountant_general']);	
			  }
			}

		    $j++;
		}

			return $treasury;

		}

		}else{

		    $treasury=$this->name_of_accountant_general;

		    return $treasury;

		}

	}

	public function getSub_To($i)
	{
		$check_tg=explode('s:', $this->sub_to);
		if(!empty($check_tg[1])){
		$treasury_officer = unserialize($this->sub_to);
		if(is_array($treasury_officer))
		{ 
		$treasury="";	
		$j=0;
		foreach ($treasury_officer as $key => $value) {
			if($i==$j)
			{
				if($value['sub_to']!=""){
			   $treasury=$value['sub_to'];
			  }
			}
		    $j++;
		}
			return $treasury;
		}
		}
	}


	public function getNameOfLegalHeirX($detail)
	{
		$other_info = $this->family_info;
		//return $detail;
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
				if($detail) {
					if(count($other_info) == 1) 
					{	if($value['spouse_salutation']=='mr')
						{$return.="Mr. ".$value['spouse_name'].", ".ucfirst($value['relation'])."";}
						elseif($value['spouse_salutation']=='mrs')
						{$return.="Mrs. ".$value['spouse_name'].", ".ucfirst($value['relation'])."";}
						
					}else {
						if($value['spouse_salutation']=='mr')
						{$return.="Mr. ".$value['spouse_name'].", ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";}
						elseif($value['spouse_salutation']=='mrs')
						{
							if($detail==$main_key)
							{
								$return.="Mrs. ".$value['spouse_name'].", ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";}
							}
							
					}//endif;
				}else {
				array_push($return, $value['spouse_name']);}
				//endif;
			} else {
				$child_info = $value['child'];
				foreach ($child_info as $key => $ci) {
				$return='';//newly added by ibad	
					//if(in_array($value['spouse_name'].">".$ci['name'], $list)) { // blocked by ibad
						if(empty($ci['dod'])) {
							$income = (empty($ci['income'])) ? 0 : $ci['income'];
							if($income < '3000') {
								//check his income
								if($ci['salutation'] == 'mr') {
									$age = calculateDateDifference($ci['dob'], date('Y-m-d'));
									$array = explode("-", $age);
									if($array[0] >= "18" && $array[0] < "25") {
										if($detail) :
											$return.="Mr. ".$ci['name'].", Son";// (from ".ordSuffix($main_key)." ".$value['relation'].")";

										else :
											array_push($return, $ci['name']);
										endif;
									} else {
										//$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
										$return.="Mr. ".$ci['name'].", Son";
									}
								} else if($ci['salutation'] == 'miss') {
									if($detail) :
										$return.="Miss ".$ci['name'].", Daughter";// (from ".ordSuffix($main_key)." ".$value['relation'].")";
									else :
										array_push($return, $ci['name']);
									endif;
								} else if($ci['salutation'] == 'mrs') {
									$return.="Not eligible for the pension because ".$ci['name']." is married<br />";
								} else { }
							} else {
								$return.="Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
							}
						} else {
							$return.=$ci['name']." has expired<br />";
						}
					//}
				}
			}
		}

		if($detail) :
			return $return;
		else :
			return implode(", ", $return);

		endif;
	}


	public function get_LegalGuardian($detail=true)
	{
		$other_info = $this->family_info;
	    array_pop($other_info);

	    foreach ($other_info as $key => $value) {
	    	if($value['relation']=='legal_guardian')
	    	{
	    		return ' under the legal guardianship of '.ucfirst($value['spouse_salutation']).' '.$value['spouse_name'];
	    	}
	    }

	    


	}

	public function getAG_Name($ag_name)
	{
		$check_ag=explode('s:', $ag_name);

            if(!empty($check_ag[1])){

            $name_of_ag = unserialize($ag_name);

            if(is_array($name_of_ag))
            {  
            	$ag=array();
            	$i=1;

                foreach ($name_of_ag as $key => $value) { 

                $accountant_general=$value['name_of_accountant_general'];

                if(!empty($accountant_general)){

                	array_push($ag, '['.getNameOfAccountantGeneral($accountant_general).']');

                }

                $i++;
           	}

           	return implode(" ", $ag);
          }
        }
	}


	public function getTreasury_Name($treasury_name)
	{
		 $check_ag=explode('s:', $treasury_name);

             if(!empty($check_ag[1])){

             $treasury = unserialize($treasury_name);

             if(is_array($treasury))
             {  
             	$ag=array();
             	$i=1;

                 foreach ($treasury as $key => $value) { 

                 $treasury_officer=$value['treasury_officer'];

                 if(!empty($treasury_officer)){

                 	array_push($ag, '['.getTreasury($treasury_officer).']');

                 }

                 $i++;
            	}

            	return implode(" ", $ag);
           }
        }
	}

	
}