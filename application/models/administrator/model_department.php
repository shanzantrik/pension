<?php

class Model_department extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function add() {
		extract($_POST);
		$data = array(
			'dept_code'=>$this->getMax_dept_code(),
			'dept_name'=>$dept_name,
			'dept_short_code'=>$dept_short_code,
			'address'=>$address,
			'member_code'=>$this->session->userdata('member_code')
		);
		if($this->db->insert('master_department', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getAll() {
	    $result = $this->db->get('master_department');
	    return $result->result_array();
	}

	function del($dept_code){
		$q = $this->db->delete('master_department', array('dept_code' => $dept_code));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start)	{
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_department');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($dept_code) {
 		$query = $this->db->get_where('master_department', array('dept_code' => $dept_code));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("master_department");
    }

    function update(){
    	extract($_POST);
		$data = array(
			'dept_code'=>$dept_code,
			'dept_name'=>$dept_name,
			'description'=>$description,
			'member_code'=>$this->session->userdata('member_code')
		);
		$this->db->where('dept_code', $dept_code);
		$up = $this->db->update('master_department', $data); 
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function getMax_dept_code() {
		$this->db->select_max('dept_code');
	    $result = $this->db->get('master_department');
	    $row = $result->result();
	    if($row[0]->dept_code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->dept_code+1;
	    }
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='dept_name';
                break;
            case '2':
                $update_column='address';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        if(!empty($value)){
        	
        	 	$this->db->where('dept_code', $row_id);
		        $this->db->update('master_department', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
	}
}