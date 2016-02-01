<?php

class Model_member_type extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function add() {
		extract($_POST);
		if($this->check($member_type_name)==0){
			$data = array(
			'member_type_code'=>$this->getMax_member_type_code(),
			'member_type_name'=>$member_type_name,
			'description'=>$description
			);
			if($this->db->insert('master_member_type', $data)) {
				return 'true';
			} else {
				return 'false';
			}
		}
		else{
			return 'pk';
		}
		
	}

	function getAll() {
	    $result = $this->db->get('master_member_type');
	    return $result->result_array();
	}

	function del($member_type_code){
		$q = $this->db->delete('master_member_type', array('member_type_code' => $member_type_code));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_member_type');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	function getMtype(){
		$query=$this->db->get('master_member_type');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($member_type_code) {
 		$query = $this->db->get_where('master_member_type', array('member_type_code' => $member_type_code));
 		return $query->result_array();
 	}
 	function check($member_type_name) {
 		$query = $this->db->get_where('master_member_type', array('member_type_name' => $member_type_name));
 		return $query->num_rows();
 	}
 
 	function record_count() {
        return $this->db->count_all("master_member_type");
    }

    function update(){
    	extract($_POST);
		$data = array(
			'member_type_code'=>$member_type_code,
			'member_type_name'=>$member_type_name,
			'description'=>$description
		);
		$this->db->where('member_type_code', $member_type_code);
		$up = $this->db->update('master_member_type', $data); 
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function getMax_member_type_code() {
		$this->db->select_max('member_type_code');
	    $result = $this->db->get('master_member_type');
	    $row = $result->result();
	    if($row[0]->member_type_code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->member_type_code+1;
	    }
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='member_type_name';
                break;
            case '2':
                $update_column='description';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        if(!empty($value)){
        		$this->db->where('member_type_code', $row_id);
		        $this->db->update('master_member_type', $data);
		        echo $value;
        	 	
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}
}