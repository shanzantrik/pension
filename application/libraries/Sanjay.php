<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Pensioner.php');

class CI_Sanjay extends CI_Pensioner
{
	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	function getEnhanceRate_sanjay($detail = true)
	{
		//$lastPay, $net_qualifying_service, $dor, $dod, $class_of_pension, $detail = true
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
	          	if ($class_of_pension=='Normal_Family_Pension' || $class_of_pension=='Extraordinary_Pension' || $class_of_pension=='Liberalised_Pension' || $class_of_pension=='Dependent_Pension' || $class_of_pension=='Parents_Pension'){
	          		$return = round($total*50/100);
	          		//if($detail == true) :
	          			//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		//endif;
					return $return;
				} else {
					switch ($class_of_pension) {
						case 'Absorption_in_autonomous_body_pension':
							return 'N/A';
							break;
						default:
							return round($total*50/100);
							break;
					}
				}
			else :
				if($this->dod > $this->dor) {
					//after retirement - after service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dor);
					$upto->modify('+7 years +1 day');
					$return = round($total*50/100);
	          		if($detail == true) :
	          		$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				} else {
					//before retirement - during service
					$from = new DateTime($this->dor);
					$from->modify('+1 day');
					$upto = new DateTime($this->dod);
					$upto->modify('+10 years +1 day');
					$return = round($total*50/100);
	          		if($detail == true) :
	          			$return.= "<b> from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')."</b>";
	          		endif;
					return $return;
				}
			endif;
		}
	}

	public function age_at_death($detail = true, $returnYear = false)
	{
		$result = $this->dateDiff($this->dod, $this->dob);
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
}