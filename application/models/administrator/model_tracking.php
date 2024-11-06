<?php

class Model_tracking extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	function check_existance($file){
		$result=$this->db->query("SELECT count(file_No) as nos from pension_receipt_file_master where file_No='$file'");
	    $row = $result->result();
	    return $row[0]->nos;
	}
	function search_file($file){
		$q=$this->db->get_where('file_tracking_details',array('file_no'=>$file));
		if($q->num_rows()>0){
			return $q->result();
		}
		else{
			return false;
		}
	}
	function reg_no($file)
	{
	//$result=$this->db->query("SELECT reg_no from issue where file_no='$file'");
	    //$row = $result->result();
	    //return $row[0]->reg_no;
		
		$q=$this->db->get_where('issue',array('file_no'=>$file));
		if($q->num_rows()>0){
			return $q->result();
		}
		else{
			return false;
		}
	}
	function get_name($table,$parm,$val,$ret){
		$q=$this->db->get_where($table, array($parm=>$val));
		$result=$q->result();
		return $result[0]->$ret;
	}
}