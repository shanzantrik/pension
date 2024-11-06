<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Transfer {

	//pensioner_transfer
	var $id 						= '';
	var $type 						= '';
	var $case_no 					= '';
	var $case_dated					= '0000-00-00';
	var $salutation					= '';
	var $name						= '';
	var $designation				= '';
	var $send_to					= '';
	var $irf						= '';
	var $ist						= '';
	var $istti						= '';
	var $orf						= '';
	var $ost						= '';
	var $ppo						= '';
	var $cpo						= '';
	var $cpo_dated					= '0000-00-00';
	var $draw_from					= '';
	var $paid_upto					= '0000-00-00';
	var $comm_of_pension			= '0000-00-00';
	var $basic_pension				= '';
	var $reduced_pension			= '';
	var $dearness_relief			= '';
	var $medical_allowance			= '';
	var $enhance_rate				= '';
	var $ordinary_rate				= '';
	var $amount_of_gratuity			= '';
	var $commuted_value_of_pension	= '';
	var $amount_of_pension_commuted	= '';
	var $memo_no					= '';
	var $letter_no					= '';
	var $letter_date				= '0000-00-00';
	var $address					= '';
	var $created_at					= '0000-00-00';

	var $dateFormat					= 'd-m-Y';
	var $numOfRows					= '0';

	public function __construct($params = array())
	{
		//search by id or case_no
		if(isset($params['id'])) :
			$this->id 		= $params['id'];
		else :
			$this->case_no 	= $params['case_no'];
		endif;

		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('pensioner_transfer');
		if(isset($params['id'])) :
			$CI->db->where('id', $this->id);
		else :
			$CI->db->where('case_no', $this->case_no);
		endif;

		$result = $CI->db->get()->row();

		if (count($result) > 0)
		{
			$this->initialize($result);
		}
	}

	public function initialize($result = array())
	{
		$this->numOfRows = count($result);

		foreach ($result as $key => $val)
		{
			switch($key) :
				case 'case_dated':
				case 'cpo_dated':
				case 'paid_upto':
				case 'comm_of_pension':
				case 'letter_date':
				case 'created_at':
					$this->$key = $this->dateTimeToDate($val);
					break;
				default:
					$this->$key = $val;
					break;
			endswitch;
		}
	}

	public function dateTimeToDate($date)
	{
		$date = new DateTime($date);
		return $date->format($this->dateFormat);
	}
}