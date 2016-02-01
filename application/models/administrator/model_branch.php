<?php

class Model_branch extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function add() {
		extract($_POST);
		$data = array(
			'Branch_Code'=>$this->getMax_branch_code(),
			'Branch_Name'=>$branch_name,
			'Description'=>$description,
			'member_code'=>$this->session->userdata('member_code')
		);
		if($this->db->insert('master_branch', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getAll() {
	    $result = $this->db->get('master_branch');
	    return $result->result_array();
	}

	function del($Branch_Code){
		$q = $this->db->delete('master_branch', array('Branch_Code' => $Branch_Code));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_branch');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($Branch_Code){
 		$query = $this->db->get_where('master_branch', array('Branch_Code' => $Branch_Code));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("master_branch");
    }

    function update(){
    	
		$Branch_Code=$this->security->xss_clean($_POST['branch_code']);
		$Branch_Name=$this->security->xss_clean($_POST['branch_name']);
		$Description=$this->security->xss_clean($_POST['description']);
		$department_code=$this->security->xss_clean($_POST['department_code']);
		$data = array(
			'Branch_Name'=>$Branch_Name,
			'Description'=>$Description,
			'dept_code'=>$department_code
		);
		$this->db->where('Branch_Code', $Branch_Code);
		$up = $this->db->update('master_branch', $data); 
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function getMax_branch_code() {
		$this->db->select_max('Branch_Code');
	    $result = $this->db->get('master_branch');
	    $row = $result->result();
	    if($row[0]->Branch_Code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->Branch_Code+1;
	    }
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='Branch_Name';
                break;
            case '2':
                $update_column='Description';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        $this->db->where('Branch_Code', $row_id);
        $this->db->update('master_branch', $data);
        echo $value;
	}
}