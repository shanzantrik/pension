<?php

class Model_member extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function add() {
		extract($_POST);
		$data = array(
			'member_code'=>$this->getMax_member_code(),
			'member_name'=>ucwords($member_name),
			'gender'=>$gender,
			'mobile_no1'=>$mobile_no1,
			'mobile_no2'=>$mobile_no2,
			'cor_address'=>ucwords($cor_address),
			'per_address'=>ucwords($per_address),			
			'email'=>$email,
			'passwrd'=>md5($passwrd),
			'Branch_Code'=>$Branch_Code,
			'member_type_code'=>$member_type_code,
			'desg_code'=>$desg_code,			
			'member_status'=>$member_status,
			'logged_in'=>'no',
			'section'=>$section
		);
		if($this->db->insert('pen_members', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getAll() {
	    $result = $this->db->get('pen_members');
	    return $result->result_array();
	}

	function del($member_code) {
		$q = $this->db->delete('pen_members', array('member_code' => $member_code));
		if($q) {
			return true;
		}else{
			return false;
		}
	}

	function getMax_member_code() {
		$this->db->select_max('member_code');
	    $result = $this->db->get(' pen_members');
	    $row = $result->result();
	    if($row[0]->member_code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->member_code+1;
	    }
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('pen_members');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($member_code) {
 		$query = $this->db->get_where('pen_members', array('member_code' => $member_code));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("pen_members");
    }

    function update(){
    	extract($_POST);
		$data = array(
			'member_name'=>ucwords($member_name),
			'gender'=>$gender,
			'mobile_no1'=>$mobile_no1,
			'mobile_no2'=>$mobile_no2,
			'cor_address'=>ucwords($cor_address),
			'per_address'=>ucwords($per_address),			
			'email'=>$email,
			'Branch_Code'=>$Branch_Code,
			'member_type_code'=>$member_type_code,
			'desg_code'=>$desg_code,			
			'member_status'=>$member_status,
			'section'=>$section
		);
		$this->db->where('member_code', $member_code);
		$up = $this->db->update('pen_members', $data);
		if($up) {
			return true;
		} else {
			return false;
		}
    }
}