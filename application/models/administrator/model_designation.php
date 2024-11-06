<?php

class Model_designation extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	//check unique
	function check($designation_name){
		$q=$this->db->query("Select desg_name from master_designation where desg_name='$designation_name'");
		if($q->num_rows()>0){
			return true;
		}
		return false;
	}

	function add() {
		extract($_POST);
		$data = array(
			'desg_code'=>$this->getMax_designation_code(),
			'desg_name'=>$designation_name,
			'description'=>$description,
			'member_code'=>$this->session->userdata('member_code')
		);
		if($this->check($designation_name)==false){
			if($this->db->insert('master_designation', $data)) {
			return 'true';
			} else {
				return 'false';
			}
		}
		else{
			return 'PK';
		}
		
	}

	function getAll() {
	    $result = $this->db->get('master_designation');
	    return $result->result_array();
	}

	function del($desg_code){
		$q = $this->db->delete('master_designation', array('desg_code' => $desg_code));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_designation');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($desg_code) {
 		$query = $this->db->get_where('master_designation', array('desg_code' => $desg_code));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("master_designation");
    }

    function update() {
    	extract($_POST);
		$data = array(
			'desg_code'=>$desg_code,
			'desg_name'=>$desg_name,
			'description'=>$description
		);
		$this->db->where('desg_code', $desg_code);
		$up = $this->db->update('master_designation', $data);
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function getMax_designation_code() {
		$this->db->select_max('desg_code');
	    $result = $this->db->get('master_designation');
	    $row = $result->result();
	    if($row[0]->desg_code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->desg_code+1;
	    }
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='desg_name';
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
        	
        	 	$this->db->where('desg_code', $row_id);
		        $this->db->update('master_designation', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}
}