<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function calculateDateDifference($date2, $date1, $withInfo = false)
{
	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
	$result = $date1->diff($date2);
	if($withInfo) :
		return $result->y.' years '.$result->m.' months '.$result->d.' days';
	else :
		return $result->y.'-'.$result->m.'-'.$result->d;
	endif;
}

function getCommuted_value($amountofPension)
{
	return ceil((($amountofPension*40/100)));
}

function get_checklist_details($file_no)
{   
    $CI =& get_instance();
	$CI->db->select('*');
	$CI->db->from('checklist');
	$CI->db->where(array('checklist.file_no'=>$file_no));
	$CI->db->join('pension_receipt_file_master', 'pension_receipt_file_master.file_No=checklist.file_no', 'left');
	$query = $CI->db->get();
	return $query->result_array();
}

function get_group_of_employee($file_no)
{
	$CI =& get_instance();
	$CI->db->select('dom_group');
	$CI->db->from('checklist');
	$CI->db->where(array('file_no' => $file_no));
	$query = $CI->db->get();
	if($query->num_rows()>0) 
	{
		$row = $query->row(); 
		if($row->dom_group!="") 
		{
			return $row->dom_group ;
		} else {
			return "not_exists";
		}
	}
}
	  
function get_ips_detail2($file_no)
{       
	$CI =& get_instance();
	$CI->db->select('*');
	$CI->db->from('pensioner_ips_details');
	$CI->db->where(array('pensioner_ips_details.file_no' =>$file_no));
	$CI->db->join('file_status', 'file_status.file_no = pensioner_ips_details.file_no', 'left');
	$query = $CI->db->get();
	return $query->result_array();
}

function getLatestDaPercent() {
	$CI =& get_instance();
	$CI->db->select_max('serial_no');
	$result = $CI->db->get('dearness_allowance_master');
	$row = $result->row();

	$CI->db->select('percentage');
	$CI->db->where('serial_no', $row->serial_no);
	$result1 = $CI->db->get('dearness_allowance_master');
	$row1 = $result1->row();
	return $row1->percentage;
}

function getBranchName($BranchCode) {
	$CI =& get_instance();
	$CI->db->select('Branch_Name');
	$CI->db->where('Branch_Code', $BranchCode);
	$result = $CI->db->get('master_branch');
	$row = $result->row();
	return $row->Branch_Name;
}

function getSerialNoByCaseNo($case_no) {
	$CI =& get_instance();
	$CI->db->select('serial_no');
	$CI->db->where('case_no', $case_no);
	$result = $CI->db->get('pensioner_personal_details');
	$row = $result->row();
	return $row->serial_no;
}

function getMemberType($memberTypeCode) {
	$CI =& get_instance();
	$CI->db->select('member_type_name');
	$CI->db->where('member_type_code', $memberTypeCode);
	$result = $CI->db->get('master_member_type');
	$row = $result->row();
	return $row->member_type_name;
}

function getDesignation($desgCode) {
	$CI =& get_instance();
	$CI->db->select('desg_name');
	$CI->db->where('desg_code', $desgCode);
	$result = $CI->db->get('master_designation');
	$row = $result->row();
	return $row->desg_name;
}

function getAllDepartment() {
	$CI =& get_instance();
	$CI->db->select('dept_code, dept_name, dept_short_code');
	$CI->db->order_by('dept_name', 'asc');
	$department = $CI->db->get('master_department');
	return $department->result_array();
}

function getDepartmentName($departmentCode) {
	$CI =& get_instance();
	$CI->db->select('dept_name');
	$CI->db->where('dept_code', $departmentCode);
	$result = $CI->db->get('master_department');
	$row = $result->row();
	return $row->dept_name;
}

function getAllAccountantGeneral() {
	$CI =& get_instance();
	$CI->db->select('*');
	$CI->db->order_by("state", "asc");
	$result = $CI->db->get('master_accountant_general');
	return $result->result_array();
}

function getAllTreasury()
{
	$CI =& get_instance();
	$CI->db->select('*');
	$result = $CI->db->get('master_treasury');
	return $result->result_array();
}

function getall_DA()
 {
	$CI =& get_instance();
	$CI->db->select('*');
	$CI->db->order_by('da', 'asc');
	$result = $CI->db->get('master_dearness_allowance');
	return $result->result_array();
}

function getClearFrom($serial_no) {
	$CI =& get_instance();
	$CI->db->select('serial_no');
	$CI->db->where('serial_no', $serial_no);
	$result1 = $CI->db->get('pensioner_personal_details');
	$return = '';
	if($result1->num_rows()>0) {
		$return.="Receipt Branch<br />";
	}
	$CI->db->select('serial_no');
	$CI->db->where('serial_no', $serial_no);
	$result2 = $CI->db->get('pensioner_service_details');
	$CI->db->select('serial_no');
	$CI->db->where('serial_no', $serial_no);
	$result3 = $CI->db->get('pensioner_treasury_details');
	if($result2->num_rows()>0 && $result3->num_rows()>0) {
		$return.="Pension Branch<br />";
	}
	return $return;
}

function getAllDocument() 
{
	$CI =& get_instance();
	$CI->db->select('*');
	$result = $CI->db->get('master_document');
	return $result->result_array();
}

function getDocNotSubmitted($array,$status) 
{
	$CI =& get_instance();
	$CI->db->select('doc_no, doc_name');
	$CI->db->where('status',$status);
	$CI->db->where_not_in('doc_no',$array);
	$query = $CI->db->get('master_document');
	return $query->result_array();
}

function getDocumentName($doc_no) {
	$CI =& get_instance();
	$CI->db->select('doc_name');
	$CI->db->where('doc_no',$doc_no);
	$result = $CI->db->get('master_document');
	$row = $result->row();
	return $row->doc_name;
}

function getFullTreasuryDetails($serial_no) {
	$CI =& get_instance();
	$CI->db->select('name_of_accountant_general');
	$CI->db->where('serial_no', $serial_no);
	$result = $CI->db->get('pensioner_treasury_details');
	$row = $result->row();
	return getNameOfAccountantGeneral($row->name_of_accountant_general);
}

function getNameOfAccountantGeneral($id) {
	if($id == '') :
		return '';
	else :
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id', $id);
		$result = $CI->db->get('master_accountant_general');
		$row = $result->row();
		return $row->name;
	endif;
}

function getTreasury($id) {
	$CI =& get_instance();
	$CI->db->select('title');
	$CI->db->where('id', $id);
	$result = $CI->db->get('master_treasury');
	$row = $result->row();
	return $row->title;
}

function get_last_member($file_no){
	$sql="Select * from file_tracking_details where file_no='$file_no' order by serial_no desc";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$member_code= $row['member_code'];
	$x=mysql_query("SELECT member_code,member_name from pen_members where member_code=$member_code");
	$y=mysql_fetch_array($x);
	return $y;
}

function getAllGratuityStatus($serial_no) {
	//have to work
	$CI =& get_instance();
	$CI->db->select('provisional_pension, provisional_gratuity, excess_pay_and_allowances, others');
	$CI->db->where('serial_no', $serial_no);
	$query = $CI->db->get('pensioner_pay_details');
	$result = $query->result_array();
	$data = $result[0];
	$return = '';
	if($data['provisional_pension']!="0" && !empty($data['provisional_pension'])) {
		$return.="<b>Pension Rs. ".$data['provisional_pension']."/-</b><br />";
	} else {
		$return.="<b>Pension Rs. Not Paid</b><br />";
	}
	if($data['provisional_gratuity']!="0" && !empty($data['provisional_gratuity'])) {
		$return.="<b>Gratuity Rs. ".$data['provisional_gratuity']."/-</b><br />";
	} else {
		$return.="<b>Gratuity Rs. Not Paid</b><br />";
	}
	if($data['excess_pay_and_allowances']!="0" && !empty($data['excess_pay_and_allowances'])) {
		$return.="<b>Excess pay and allowances Rs. ".$data['excess_pay_and_allowances']."-/</b><br />";
	} else {
		$return.="<b>Excess pay and allowances Rs. Not Paid/-</b><br />";
	}
	if($data['others']!="0" && !empty($data['others'])) {
		$return.="<b>If any Rs. ".$data['others']."-/</b><br />";
	} else {
		$return.="<b>If any Rs. Not Paid-/</b><br />";
	}
	return $return;
}

function dateTimeToDate($date, $format = 'Y-m-d') {
	$date = new DateTime($date);
	return $date->format($format);
}	

/* worksheet function */
function getAverageEmolument($lp, $ip, $dor, $doi='', $incr_BP='', $incr_GP='', $post_BP='', $incr_GP='') {
	$pay = getPay($lp);
	if($doi=="0000-00-00" || $doi=='') {
		return round(($pay*10)/10);
	} else {
		if($dor > "1996-01-01" && $dor < "1996-09-30") :

			if($doi >="1996-01-01") {
		        $dop="1995-12-31";
		        $after_january=getDiffInMonth($dor, $dop);
		        $before_january= 10 - $after_january;

		        $da_pre=$incr_BP*148/100;
		        $ir_pre=($incr_BP*10/100)+100;
		        $fitment_weightage_pre=$incr_BP*40/100;
		        $total_pre=$da_pre+$ir_pre+$fitment_weightage_pre+$incr_BP;
		        $total_amoulments_pre=$total_pre*$before_january;

		        $total_amoulments_after_january=$lp['post_BP']*$after_january;
		        return $total_amoulments_pre+$total_amoulments_after_january;

			} else {
		       	 //return "400";
			    $monthsDiff_dor_doi =8;
				if($monthsDiff_dor_doi>10) {
				    $dop="1995-12-31";
			        $after_january=getDiffInMonth($dor,$dop);
			        $before_january=10-$after_january;

			        $da_pre=$post_BP*148/100;
			        $ir_pre=($post_BP*10/100)+100;
			        $fitment_weightage_pre=$post_BP*40/100;
			        $total_pre=$da_pre+$ir_pre+$fitment_weightage_pre+$post_BP;
			        $total_amoulments_pre=$total_pre*$before_january;
			      

			        $total_amoulments_after_january=$lp['post_BP']*$after_january;
			        return $total_amoulments_pre+$total_amoulments_after_january;
				} else {
			        $dop="1995-12-31";
			        $after_january=getDiffInMonth($dor,$dop);//1*revised pay
			        $months_pre=10-$monthsDiff_dor_doi;//2 
			        $aftr_incr=10-($months_pre+$after_january);//7

			        $da_pre=$incr_BP*148/100;
			        $ir_pre=($incr_BP*10/100)+100;
			        $fitment_weightage_pre=$incr_BP*40/100;
			        $total_pre=$da_pre+$ir_pre+$fitment_weightage_pre+$incr_BP;
			        $total_amoulments_pre=$total_pre*$months_pre;
			        //return $total_amoulments_pre;
			        
			        $da_after=$post_BP*148/100;
			        $ir_after=($post_BP*10/100)+100;
			        $fitment_weightage_after=$post_BP*40/100;
			        $total_after=$da_after+$ir_after+$fitment_weightage_after+$post_BP;
			        $total_amoulments_after=$total_after*$aftr_incr;
			        //return $total_amoulments_after;
			        $total_amoulments_after_january=$lp['post_BP']*$after_january;
			        return round((($total_amoulments_pre+$total_amoulments_after+$total_amoulments_after_january)/10
			   //return round((($total_amoulments_pre+$total_amoulments_after+$total_amoulments_after_january)/10
			        	));
		        }
			}

		else :
			$monthsDiff = getDiffInMonth($dor, $doi);
			if($monthsDiff == 0) {
				return round(($pay*10)/10);
			} elseif($monthsDiff >= 10) {
				$lastPay = $pay;
				return round(($lastPay*10)/10);
			} else {
				$lastPay = $pay-getPay($ip);
				$monthForPrev = 10-$monthsDiff;
				return round((($lastPay*$monthForPrev)+($pay*$monthsDiff))/10);
			}
		endif;
	}
}


function getOrdinaryRate($lastPay) {
	return round($lastPay*30/100);
}

function get_percentage_of_da($da, $percent) {
	return $da*$percent/100;
}

function getPay($salary, $da_post = '') {
	if(is_array($salary)) {
		$sum = '';
		foreach($salary as $value) {
			$sum+=$value;
		}
		//return round($sum+$da_post);
		return round($sum);
	} else {
		return round($salary);
	}
}

function get_pecentage_of_da($da, $percent)
{
	return round(($da*$percent)/100);
}

function getEnhanceRate($lastPay, $net_qualifying_service, $dor, $dod, $class_of_pension, $returnWithInfo = true) {
	list($years, $months, $day) = explode("-", $net_qualifying_service);
	if($years < 7) {
		return 0;
	} else {
		$total = $lastPay;
		if($dod == '0000-00-00' || is_null($dod)){
		    $from = new DateTime($dor);
			$from->modify('+1 day');
			$upto = new DateTime($dor);
			$upto->modify('+7 years');
          	if ($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
          		$return = round($total*50/100);
          		if($returnWithInfo == true) :
          			$return.= " <b>from ".$from->format('Y-m-d')." upto ".$upto->format('Y-m-d')."</b>";
          		endif;
				return $return;
			} else {	
				return round($total*50/100);
			}
			//return 0;
		} else {
			if($dod > $dor) {
				//after retirement - after service
				$from = new DateTime($dor);
				$from->modify('+1 day');
				$upto = new DateTime($dor);
				$upto->modify('+7 years +1 day');

				$return = round($total*50/100);
          		if($returnWithInfo == true) :
          			$return.= " <b>from ".$from->format('Y-m-d')." upto ".$upto->format('Y-m-d')."</b>";
          		endif;
				return $return;
			} else {
				//before retirement - during service
				$from = new DateTime($dor);
				$from->modify('+1 day');
				$upto = new DateTime($dod);
				$upto->modify('+10 years +1 day');

				$return = round($total*50/100);
          		if($returnWithInfo == true) :
          			$return.= " <b>from ".$from->format('Y-m-d')." upto ".$upto->format('Y-m-d')."</b>";
          		endif;
				return $return;
			}
		}
	}
}


function getAmountofPension($serial_no = '')
{
	$amountofPension = 0;
	$CI =& get_instance();

	if( empty($serial_no) || $serial_no == '' ) :
		return $amountofPension;
	endif;

	$CI->load->model('administrator/model_pension');
	$vrp = $CI->model_pension->get_servicebook($serial_no);
	if(count($vrp) > 0) :
		$var = (object) $vrp[0];
		$pay_info = unserialize($var->pay_info);
		$lp = array();
		foreach ($pay_info[0] as $key => $value) :
			if($key != 'post_DA') :
				$lp[$key] = $value;
			endif;
		endforeach;
		$ip = array();
		foreach ($pay_info[1] as $key => $value) :
			if($key != 'increament_DA') :
				$ip[$key] = $value;
			endif;
		endforeach;

		$cop 				= $var->class_of_pension;
		$com_pension_rate	= $var->com_pension_rate;
		$pensionCategory 	= $var->pension_category;
		$pensionFor			= $var->pension_for;
		$pensionScheme		= $var->pension_scheme;
		$year_of_service  	= year_of_service($var->net_qualifying_service);
		$da_post 			= $pay_info[0]['post_DA'];
		$lastPay 			= getPay($lp, $da_post);
		$averageEmolument 	= getAverageEmolument($lp, $ip, $var->dor, $pay_info[2]['last_increament_date']);
		
		if($cop == 'Superannuation_Pension' || $cop == 'Compulsory_Retirement_Pension' || $cop == 'Voluntary_Retirement_Pension' || $cop == 'Invalid_Retirement_Pension' || $cop == 'Absorption_in_autonomous_body_pension' || $cop == 'Disability_Pension') :
			$dor = $var->dor;
			list($year, $month, $date) = explode("-", $dor);
			switch($cop) :
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
						$amountofPension = ceil(($averageEmolument*1/2)*($year_of_service/66));
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
						if($com_pension_rate=="pension" || $com_pension_rate=="both") {
							$amountofPension = ceil($amountofPension*2/3);
						} else {}
					else :
						if($lastPay>$averageEmolument) {
							$amountofPension = ceil($lastPay*50/100);
						} else {
							$amountofPension = ceil($averageEmolument*50/100);
						}
						if($com_pension_rate=="pension" || $com_pension_rate=="both") {
							$amountofPension = ceil($amountofPension*2/3);
						} else {}
					endif;
					break;
			endswitch;

		else :
			//all family pension come here..
			switch($cop) :
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
					$bp = $lp['post_BP'];
					if($pensionCategory=="A") {
						$amountofPension = ceil($lastPay*60/100);
					} elseif ($pensionCategory=="B" || $pensionCategory=="C") {
						if($pensionScheme=="no") {
							$val = (($bp*40)/100);
							if($val<4550) {
								$amountofPension = 4550;
							} else {
								$amountofPension = ceil($val);
							}
						} elseif ($pensionScheme=="yes") {
							$val = (($bp*60)/100);
							if($val<7000) {
								$amountofPension = 7000;
							} else {
								$amountofPension = ceil($val);
							}
						}
					} elseif ($pensionCategory=="D" || $pensionCategory=="E") {
						if($pensionFor=="widow") {
							$amountofPension = ceil($lastPay);
						} elseif ($pensionFor=="widow_remarriage") {
							$amountofPension = ceil($lastPay*60/100);
						} elseif ($pensionFor=="no_widow_but_survived_by_children") {
							$val = (($bp*60)/100);
							if($val<7000) {
								$amountofPension = 7000;
							} else {
								$amountofPension = ceil($val);
							}
						} elseif ($pensionFor=="both_parents_are_alive") {
							$amountofPension = ceil($lastPay*75/100);
						} elseif ($pensionFor=="only_one_of_them_is_alive") {
							$amountofPension = ceil($lastPay*60/100);
						} else {
							$amountofPension = 0;
						}
					}
					break;
			endswitch;
		endif;
	endif;

	if($amountofPension < 3500) :
		return '3500';
	else :
		return $amountofPension;
	endif;
}

function getDCRG($serial_no, $revision = false, $data = array())
{
	$dcrg = 0;
	$CI =& get_instance();

	$vrp = $CI->model_pension->get_servicebook($serial_no);
	if(count($vrp) > 0) :
		$var = (object) $vrp[0];

		$lp = array();
		if($revision == true) :
			$lp['post_BP'] 	= $data['post_BP'];
			$lp['post_GP'] 	= $data['post_GP'];
			$da_post 		= $data['revision_da'];
		else :
			$pay_info = unserialize($var->pay_info);
			foreach ($pay_info[0] as $key => $value) :
				if($key != 'post_DA') :
					$lp[$key] = $value;
				endif;
			endforeach;
			if($pay_info[1]['increament_DA'] == '' || $pay_info[1]['increament_DA'] == 0) :
	            $da_post = $pay_info[0]['post_DA'];
	        else :
	            $da_post = $pay_info[1]['increament_DA'];
	        endif;
		endif;

		$cop 				= $var->class_of_pension;
		$com_pension_rate	= $var->com_pension_rate;
		$pensionScheme		= $var->pension_scheme;
	
		$lastPay 			= getPay($lp, $da_post);
		//return $lastPay;
		$year_of_service  	= year_of_service($var->net_qualifying_service);
		$latestDaAmount		= (($lastPay*$da_post)/100);
		$dor 				= $var->dor;
		$net_qualifying_service = $var->net_qualifying_service;
		list($year, $month, $date) = explode("-", $dor);
		list($nYear, $nMonth, $nDays) = explode("-", $var->net_qualifying_service);

		if($nYear == 0) :
			$times = 2;
		elseif($nYear >= 1 && $nYear < 5) :
			$times = 6;
		elseif($nYear >= 5 && $nYear < 20) :
			$times = 12;
		elseif ($nYear >= 20) :
			$times = 1/2;
		endif;

		switch($cop) :
			case 'Dependent_Pension':
			case 'Extraordinary_Pension':
			case 'Liberalised_Pension':
			case 'Parents_Pension':
				$dcrg = (($lastPay)*1/2)*$year_of_service;
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
					if($com_pension_rate=="gratuity" || $com_pension_rate=="both") :
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
					if($pensionScheme == "no") {
						$nqs = explode("-", $net_qualifying_service);
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
					}
				else :
					if($pensionScheme == "no") {
						$nqs = explode("-", $net_qualifying_service);
						if($nqs[0] < 10) {
							//If qualifying service(QS) is less than 10 years then service gratuity(SG) and retirementgratuity( RG) is not admissible.
							$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
						} else {
							//If net qualifying service(QS) is less than 10 years.
							$dcrg = 0;
						}
					} else {
						$dcrg = (($lastPay+(($latestDaAmount*72)/100))*1/4)*$year_of_service;
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
				else :
					$dcrg = (($lastPay+$latestDaAmount)*$times);
				endif;
				break;
		endswitch;
	endif;

	if($dcrg > 1000000) :
		return "1000000";
	else :
		return ceil($dcrg);
	endif;
}

function getasDCRG()
{
	return "hi";
}

/*function getCommutationofPension($amountofPension, $age_at_retirement, $class_of_pension) {
	$cop = $class_of_pension;
	switch($cop) :
		case 'Dependent_Pension':
		case 'Extraordinary_Pension':
		case 'Liberalised_Pension':
		case 'Parents_Pension':
			return 0;
			break;
		case 'Absorption_in_autonomous_body_pension':
		case 'Compulsory_Retirement_Pension':
		case 'Disability_Pension':
		case 'Superannuation_Pension':
		case 'Voluntary_Retirement_Pension':
			return ceil((($amountofPension*40/100)*12)*check_age_at_next_birth($age_at_retirement+1));
			break;
		case 'Invalid_Retirement_Pension':
			return ceil(($amountofPension*40/100)*check_age_at_next_birth($age_at_retirement+1));
			break;
		default:
			return 0;
	endswitch;
}*/

function getCommutationofPension($pay_commission,$amountofPension, $age_at_retirement, $class_of_pension) {
	$cop = $class_of_pension;
	switch($cop) :
		case 'Dependent_Pension':
		case 'Extraordinary_Pension':
		case 'Liberalised_Pension':
		case 'Parents_Pension':
			return 0;
			break;
		case 'Absorption_in_autonomous_body_pension':
		case 'Compulsory_Retirement_Pension':
		case 'Disability_Pension':
		case 'Superannuation_Pension':
		case 'Voluntary_Retirement_Pension':
            //return $pay_commission;
			//return ceil(floor(($amountofPension*40/100)*12)*check_age_at_next_birth($age_at_retirement+1));
		     $fourty_percnt_pensn=floor(($amountofPension*40)/100);
		     //return ceil(($fourty_percnt_pensn*12)*(check_age_at_next_birth($age_at_retirement)));
			 $com_value=check_age_at_next_birth($pay_commission,$age_at_retirement);
			 return round(($fourty_percnt_pensn*$com_value)*12);

			 //return check_age_at_next_birth($pay_commission,$age_at_retirement);
			break;
		case 'Invalid_Retirement_Pension':
			//return ceil(($amountofPension*40/100)*check_age_at_next_birth($age_at_retirement+1));

			$fourty_percnt_pensn=floor(($amountofPension*40)/100);
		    $com_value=check_age_at_next_birth($pay_commission,$age_at_retirement+1);
			 return round(($fourty_percnt_pensn*$com_value)*12);
			break;
		default:
			return 0;
	endswitch;
}

function getReducePension($amountofPension, $class_of_pension) {
	$cop = $class_of_pension;
	switch($cop) :
		case 'Dependent_Pension':
		case 'Extraordinary_Pension':
		case 'Liberalised_Pension':
		case 'Parents_Pension':
			return 0;
			break;
		case 'Absorption_in_autonomous_body_pension':
		case 'Compulsory_Retirement_Pension':
		case 'Disability_Pension':
		case 'Superannuation_Pension':
		case 'Voluntary_Retirement_Pension':
		case 'Invalid_Retirement_Pension':
			return round($amountofPension-($amountofPension*40/100));
			break;
		default:
			return 0;
	endswitch;
}



function getEnhanceRate_reautho($lastPay, $net_qualifying_service, $dor, $dod) {
    $total=$lastPay;
	return round($total*50/100);
}

function getOrdRate_reautho($lastPay, $net_qualifying_service, $dor, $dod) {
    $total=$lastPay;
	return round($total*30/100);
}

function get_Earn_money($earn,$salry)
{
	return($earn*$salry/30);
}

function get_half_money($half,$salry)
{
	return($half*($salry/2)/30);
}

function getDA($lastPay, $dor) {
	$CI =& get_instance();
	$CI->db->select('serial_no');
	$CI->db->where('from >=', $dor);
	$result1 = $CI->db->get('dearness_allowance_master');
	$current = $result1->previous_row('array');
	if(!empty($current)) {
		$result2 = $CI->db->query("SELECT `serial_no` FROM dearness_allowance_master WHERE serial_no < ".$current['serial_no']." ORDER BY serial_no DESC LIMIT 1");
	} else {
		$CI->db->select('*');
		$CI->db->select_max('serial_no');
		$result2 = $CI->db->get('dearness_allowance_master');
	}
	$arr = $result2->row_array();
	$CI->db->select('serial_no, from, percentage');
	$CI->db->where('serial_no >=', $arr['serial_no']);
	$result3 = $CI->db->get('dearness_allowance_master');
	$array = $result3->result_array();
	$str = '';
	$count = 0;
	for($i=0; $i<count($array); $i++) {
		if($count == 0) {
			$from = (count($array) == 1) ? date('Y-m-d') : $array[$i+1]['from'];
			$str.="<div class='da'>".$array[$i]['percentage'].'% of '.$lastPay.' from '.$dor." to ".$from." = ".round(($lastPay*$array[$i]['percentage'])/100)."</div>";
			$count++;
		} else {
			for($j=0; $j<count($array); $j++) {
				if(isset($array[$i+1]['from'])) {
					$str.="<div class='da'>".$array[$i]['percentage'].'% of '.$lastPay.' from '.$array[$i]['from']." to ".$array[$i+1]['from']." = ".round(($lastPay*$array[$i]['percentage'])/100)."</div>";
					break;
				} else {
					$str.="<div class='da'>".$array[$i]['percentage'].'% of '.$lastPay.' from '.$array[$i]['from']." to ".date('Y-m-d')." = ".round(($lastPay*$array[$i]['percentage'])/100)."</div>";
					break;
				}
			}
		}
	}
	return $str;
}

function year_of_service($data) {
	$array = explode('-', $data);
	$years = $array[0];
	$months = $array[1];
	if($years >= 33) {
		$years = 33;
		$months = 0;
	}
	$total = $years*2;
	if($months > 3 && $months <= 8) {
		$total+=1;
	} elseif($months >= 9 && $months <= 11) {
		$total+=2;
	} else {}
	return $total;
}

function getDiffInMonth($firstDate, $secondDate) {
	$first = new DateTime($firstDate);
	$second = new DateTime($secondDate);
	$diff = $first->diff($second);
	return $diff->format('%m');
}

function getDiffInMonths($firstDate, $secondDate) {
	$first = new DateTime($firstDate);
	$second = new DateTime($secondDate);
	$diff = $first->diff($second);
	$d1=$diff->format('%m');
	$d2=$diff->format('%d');
	if($d2>0){
		$d2=1;
	}
	return $diff=($d1+$d2);
}

/*function check_age_at_next_birth($age_at_retirement) {
	$CI =& get_instance();
	$CI->db->select('comm_value');
	$CI->db->where('Age_Next_Birth', $age_at_retirement);
	$result = $CI->db->get('master_comm_value_tb');
	$row = $result->row();
	return $row->comm_value;
}*/
function check_age_at_next_birth($pay_commission, $age_at_retirement)
{
	$CI =& get_instance();
	$CI->db->select('comm_value');
	$CI->db->where('Age_Next_Birth', $age_at_retirement);
	$CI->db->where('pay_com', $pay_commission);
	$result = $CI->db->get('master_comm_value_tb');
	if($result->num_rows() > 0) :
		$row = $result->row();
		return $row->comm_value;
	else :
		return 0;
	endif;
}

/*function getNameOfLegalHeir($fi) {
	$family_info = unserialize($fi);
	$other_info = $family_info;
    array_pop($other_info);
	$legal_heir = $family_info;
	$lharray = end($family_info);
	$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));
	$return = '';
	
	foreach ($other_info as $key => $value) {
		$main_key = $key;
		$main_key++;
		if(empty($value['spouse_dod'])) {
			$return.=$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." wife)<br />";
		} else {
			$child_info = $value['child'];
			foreach ($child_info as $key => $ci) {
				if(in_array($ci['name'], $list)) {
					if(empty($ci['dod'])) {
						$income = (empty($ci['income'])) ? 0 : $ci['income'];
						if($income < '3000') {
							//check his income
							if($ci['salutation'] == 'mr') {
								$age = calculateDateDifference($ci['dob'], date('Y-m-d'));
								$array = explode(" ", $age);
								if($array[0] >= "18" && $array[0] < "25") {
									$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." wife)<br />";
								} else {
									$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age;
								}
							} else if($ci['salutation'] == 'miss') {
								$return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." wife)<br />";
							} else if($ci['salutation'] == 'mrs') {
								$return.="Not eligible for the pension because ".$ci['name']." is married";
							} else {}
						} else {
							$return.="Not eligible for the pension because income of ".$ci['name']." is ".$income." per month";
						}
					} else {
						$return.=$ci['name']." has expired";
					}
				}
			}
		}
	}
	return $return;
}*/

function getNameOfLegalHeir($fi) {
	$family_info = unserialize($fi);
	$other_info = $family_info;
    array_pop($other_info);
	$legal_heir = $family_info;
	$lharray = end($family_info);
	$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));
	$return = '';
	
	foreach ($other_info as $key => $value) {
		$main_key = $key;
		$main_key++;
		if(empty($value['spouse_dod'])) {
			$return.=$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")<br />";
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
									$return.=$ci['name']." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
								} else {
									$return.="Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
								}
							} else if($ci['salutation'] == 'miss') {
								$return.=$ci['name']." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
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
	return $return;
}

function getNameOfLegalHeirWithoutInfo($fi)
{
	$family_info = unserialize($fi);
	$other_info = $family_info;
    array_pop($other_info);
	$legal_heir = $family_info;
	$lharray = end($family_info);
	$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));
	$return = array();
	
	foreach ($other_info as $key => $value) {
		$main_key = $key;
		$main_key++;
		if(empty($value['spouse_dod'])) {
			//$return.=$value['spouse_name'];//." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")<br />";
			array_push($return, $value['spouse_name']);
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
									//$return.=$ci['name'];//." - Son (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
									array_push($return, $ci['name']);
								} else {
									//$return.='';//"Not eligible for the pension because the age of ".$ci['name']." is ".$age."<br />";
								}
							} else if($ci['salutation'] == 'miss') {
								//$return.=$ci['name'];//." - Daughter (from ".ordSuffix($main_key)." ".$value['relation'].")<br />";
								array_push($return, $ci['name']);
							} else if($ci['salutation'] == 'mrs') {
								//$return.='';//"Not eligible for the pension because ".$ci['name']." is married<br />";
							} else {}
						} else {
							//$return.='';//"Not eligible for the pension because income of ".$ci['name']." is ".$income." per month<br />";
						}
					} else {
						//$return.='';//$ci['name']." has expired<br />";
					}
				}
			}
		}
	}
	return implode(", ", $return);
}

function getNameofSpouse($fi) {
	$family_info = unserialize($fi);
	$other_info = $family_info;
	array_pop($other_info);
	$legal_heir = $family_info;
	$lharray = end($family_info);
	$list = array_map('check_legal_heir_value', explode(",", $lharray['legal_heir']));

	$return = '';
	foreach ($other_info as $key => $value) {
		$main_key = $key;
		$main_key++;
		if(empty($value['spouse_dod'])) {
			if($value['relation']=="wife") {
				$return.="Smti ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
			} else {
				$return.=" ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
			}
		} else {
			$return.="Late. ".$value['spouse_name']." - ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation']."), ";
		}
	}
	return substr($return, 0, -2);
}

function getDOBofSpouse($fi) {
	$family_info = unserialize($fi);
	$other_info = $family_info;
	array_pop($other_info);
	$legal_heir = $family_info;
	$lharray = end($family_info);
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

function check_legal_heir_value($value) {
	return str_replace("\"", "", $value);
}

function ordSuffix($n) {
	$str = $n;
    $t = $n > 9 ? substr($str, -2, 1) : 0;
    $u = substr($str, -1);
    if ($t==1) return $str . 'th';
    else switch ($u) {
        case 1: return $str . 'st';
        case 2: return $str . 'nd';
        case 3: return $str . 'rd';
        default: return $str . 'th';
    }
}
/* worksheet function */

/*pay scale*/

function getPayScale($where = '') {
	$CI =& get_instance();
	$CI->db->select('id, grade, pay_scale, pay_commission');
	if(!empty($where)) $CI->db->where($where);
	$CI->db->order_by("id", "asc");
	$result = $CI->db->get('master_pay_scale');
	return $result->result_array();
}

function getPayScaleGradeById($id) {
	$CI =& get_instance();
	$CI->db->select('grade');
	$CI->db->where('id', $id);
	$result = $CI->db->get('master_pay_scale');
	$row = $result->row();
	return $row->grade;
}

function getPayScaleById($id) {
	$CI =& get_instance();
	$CI->db->select('pay_scale');
	$CI->db->where('id', $id);
	$result = $CI->db->get('master_pay_scale');
	$row = $result->row();
	return $row->pay_scale;
}


/*pay scale*/

function getSubmittedDocument($case_no) {
	$CI =& get_instance();
	$CI->db->select('doc_code');
	$CI->db->where('case_no', $case_no);
	$result = $CI->db->get('pensioner_files_details');
	$result = $result->result_array();
	return $result;
}


function get_member_name($mCode) {
	$CI =& get_instance();
	$CI->db->select('member_name');
	$CI->db->where('member_code', $mCode);
	$result = $CI->db->get('pen_members');
	$row = $result->row();
	if(count($row) > 0) {
		return $row->member_name;
	} else {
		return '';
	}
}

function getEntryTimeFromFTD($file_no, $branch='Receipt', $member_code) {
	$CI =& get_instance();
	$CI->db->select('serial_no, entry_time');
	//$CI->db->where(array('file_no' => $file_no, 'branch' => $branch, 'member_code' => $member_code));
	if($member_code!='100005'){
	$CI->db->where(array('file_no' => $file_no, 'member_code' => $member_code));
	}
	else
	{
			$CI->db->where(array('file_no' => $file_no));
	}

	$CI->db->order_by("entry_time", "asc"); 
	$result = $CI->db->get('file_tracking_details');
	$row = $result->result_array();
	return $row;
}

function getPayComm()
{
	$CI =& get_instance();
	$CI->db->select('*');
	$CI->db->order_by("id", "asc"); 
	$result = $CI->db->get('master_pay_comm');
	return $result->result_array();
}

function getPayCommission($select, $where = array())
{
	$CI =& get_instance();
	$CI->db->select($select);
	$CI->db->from('master_pay_scale');
	if(count($where) > 0) :
		$CI->db->where($where);
	endif;
	$CI->db->order_by("id", "asc"); 
	$result = $CI->db->get();
	return $result->result_array();
}

function getAllDistrict() {
	$CI =& get_instance();
	$CI->db->select('district_code, district_name,state');
	$dam = $CI->db->get('master_districts');
	return $dam->result_array();
}

function getDistrictById($id)
{
	$CI =& get_instance();
	$CI->db->select('district_name');
	$CI->db->where(array('district_code'=>$id));
	$dam = $CI->db->get('master_districts');
	return $dam->row()->district_name;
}

function getEnumValues($table, $column)
{
	$CI =& get_instance();
	$result = $CI->db->query("SHOW COLUMNS FROM `$table` WHERE Field = '$column'");
	$type1 = $result->result_array();
	$type = $type1[0]['Type'];
	preg_match('/^enum\((.*)\)$/', $type, $matches);
	$enum = [''=> '--Choose--'];
	foreach( explode(',', $matches[1]) as $value )
	{
		$v = trim( $value, "'" );
		$enum[$v] = $v;
	}
	return $enum;
}




//settings function
function get_option($setting_name) {
	$CI =& get_instance();
	$query = $CI->db->get_where('settings', array('setting_name' => $setting_name));
	if ($query->num_rows() > 0) :
		return $query->row()->setting_value;
	else :
        return '';
    endif;
}

function update_option($key, $value)
{
	$CI =& get_instance();
	$query = $CI->db->get_where('settings', array('setting_name' => $key));
	if ($query->num_rows() > 0) :
		$data = array('setting_value'=>$value);
		$CI->db->where('setting_name', $key);
		$CI->db->update('settings', $data); 
	else :
		$data = array(
			'setting_name'=>$key,
			'setting_value'=>$value
		);
		$CI->db->insert('settings', $data);
	endif;
}

//increamented value for settings e.g., (+1)
function get_increamented_option_value($option_name)
{
	$value = get_option($option_name);
	if($value == '') :
		return 1;
	else :
		return $value+1;
	endif; 
}



function no_to_words($no)
{   
 	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fourteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'forty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0) :
        return ' ';
    else :
		$novalue='';
		$highno=$no;
		$remainno=0;
		$value=100;
		$value1=1000;
        while($no>=100)    {
            if(($value <= $no) &&($no  < $value1))    {
            $novalue=$words["$value"];
            $highno = (int)($no/$value);
            $remainno = $no % $value;
            break;
            }
            $value= $value1;
            $value1 = $value * 100;
        }
		if(array_key_exists("$highno",$words))
		  	return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
		else {
			$unit=$highno%10;
			$ten =(int)($highno/10)*10;
			return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
		}
    endif;
}

function get_file_review($file_no, $status)
{
	$CI =& get_instance();
	$CI->db->select('review');
	$CI->db->where(array('file_no'=>$file_no, 'status'=>$status));
	$dam = $CI->db->get('file_review');
	if($dam->num_rows() > 0) :
		return $dam->row()->review;
	else :
		return '';
	endif;
}

function getRetireAge($designation)
{
	switch ($designation) :
		case stripos($designation, "teacher") !== FALSE:
		return 60;
		case 'MTS'://MTS(group D)
		case 'Mate':
		case 'Mazdoor':
		case 'W/C MAZDOOR':
		case 'Mali':
		case 'Chowkidar':
		case 'Sweeper':
		case 'Handyman':
		case 'Jugali':
		case 'Peon':
		case 'Khalasi':
		case 'AIS':
		case 'Chainman':
		case 'Oderly Peon':
		case 'Orderly Peon':
		case 'W/C KHALASI':
		case 'Chowkidar-Cum- Mali':
		case 'Principal':
		case 'IAS Commissioner':
		case 'Cook':
		case 'Duftry':
		case 'PGT':
		case 'Senior Teacher':
		case 'TGT':
		case 'Junior Teacher':
		case 'PRT':
		case 'Homeo Attendent':
		case 'W/C Mate':
		case 'Sanitary Assistant':
		case 'Stretcher Bearer':
		case 'Dak Runner':
		case 'Lecturer (DIET)':
		case 'PET':
		case 'Forest Watcher':
		case 'IAS':
		case 'Dispensary Attendent':
		case 'Superior Field Worker':
		case 'Associate Professor':
		case 'Barber':
		case 'Lab Assistant':
		case 'T.G.T Music':
		case 'Follower':
		case 'Nursing Assistant':
		case 'Washerman':
		case 'W/C Handyman':
		case 'W/C Fitter Helper':
		case 'W/C Assistant Fitter':
		case 'Commissioner':
		case 'IAS Secretary (Agri./IPR)':
        case 'W/C (R) Electric Jugali':
		case 'Messenger':
		case 'Water Carrier':
		case 'W/C':
		case 'Vice Principal':
		case 'Assistant Painter':
		case 'Junior Librarian':
		case 'Helper':
		case 'Barkandaz':
		case 'W/C Chowkidar':
		case 'W/C Mazdoor':
		case 'Work Shop Attendent':
		case 'Chowkidar cum Mali':
		case 'Peon':
		case 'Female Attendant':
		case 'Chowkidar Cum Mali':
		case 'W/C MAJDOOR':
		case 'LDC':
		case 'Fitter':
		case 'Ayah':
		case 'Mason':
		case 'Forest Guard':
		case 'Coach':
		case 'Attendent':
		case 'Gestener Operator':
		case 'Lineman':
		case 'PCCF& Prl.Secy. (E&F)':
		case 'PCCF':
		case 'Fisherman':
		case 'W/C Wireman':
		
		
        return 60;
		break;
		default:
			return 58;
			break;
	endswitch;
}


function pdupdate($case_no, $data = [])
{
	$record = PDetail::find($case_no);

	if($record) {
        // record exists, update data
        foreach($data as $k => $v) :
        	$record->$k = $v;
        endforeach;
        $record->save();
    } else {
        // no match found, insert data
        $record = new PDetail;
        $record->case_no = $case_no;
        foreach($data as $k => $v) :
        	$record->$k = $v;
        endforeach;
        $record->save();
    }
}

function getConsolidatedPension($type, $value)
{

	$CI =& get_instance();
	$CI->db->select('revised_consolidated_pension');
	$CI->db->where(array($type=>$value));
	$dam = $CI->db->get('consolidated_value');
	return $dam->row()->revised_consolidated_pension;
	// if($type == 'bp_without_dp') :
	// 	return 'bp_without_dp'.$value;
	// else :
	// 	return 'bp_with_dp';
	// endif;
	//print_r($dam->row());
}

function getRecordsByTableID($table_name,$column_name,$data){
	$CI =& get_instance();
	$CI->db->select("*");
	$CI->db->where($column_name,$data);
	$result = $CI->db->get($table_name);
	return $result->result_array();
}