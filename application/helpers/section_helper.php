<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAllSection() {
	$CI =& get_instance();
	$CI->db->select('id, section');
	$section = $CI->db->get('section');
	return $section->result_array();
}