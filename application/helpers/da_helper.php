<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllDa() {
	$CI =& get_instance();
	$CI->db->select('serial_no, percentage');
	$dam = $CI->db->get('dearness_allowance_master');
	return $dam->result_array();
}