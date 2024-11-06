<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllMember_Type() {
	$CI =& get_instance();
	$CI->db->select('member_type_code, member_type_name');
	$member_type = $CI->db->get('master_member_type');
	return $member_type->result_array();
}