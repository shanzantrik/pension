<?php

class Model_marking extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	//function that retrives dealing assistant of PENSION
	function get_section(){
		$q=$this->db->get('section');
		$result=$q->result();
		return $result;
	}
	function get_member(){
		
	}
}