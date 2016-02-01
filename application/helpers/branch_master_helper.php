<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllBranch_master() {
	$CI =& get_instance();
	$CI->db->select('Branch_Code, Branch_Name');
	$branch_master = $CI->db->get('master_branch');
	return $branch_master->result_array();
}