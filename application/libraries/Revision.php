<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Pensioner.php');

class CI_Revision extends CI_Pensioner
{

	var $revision = array();

	public function __construct($params = array())
	{
		parent::__construct($params);

		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('pensioner_revision');
		$CI->db->where('pensioner_revision.case_no', $this->case_no);
		$result = $CI->db->get();

		$this->revision = $result->result_array();
	}
	
}