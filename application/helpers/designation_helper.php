<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllDesignation() {
	$CI =& get_instance();
	$CI->db->select('desg_code, desg_name');
	$designation = $CI->db->get('master_designation');
	return $designation->result_array();
}