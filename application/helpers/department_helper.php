<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllDepartments() {
	$CI =& get_instance();
	$CI->db->select('dept_code, dept_name, dept_short_code');
	$CI->db->order_by('dept_name', 'asc');
	$department = $CI->db->get('master_department');
	return $department->result_array();
}
