<?php

class Model_commutation extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function add() {
		extract($_POST);
		$query = $this->db->get_where('master_comm_value_tb', array('Age_Next_Birth'=>$age_next));
		if($query->num_rows() > 0) :
			return 'exists';
		else :
			$data = array(
				'Age_Next_Birth'=>$age_next,
				'comm_value'=>$col_value,
				'member_code'=>$this->session->userdata('member_code')
			);
			if($this->db->insert('master_comm_value_tb', $data)) {
				return true;
			} else {
				return false;
			}
		endif;
	}

	function getAll() {
	    $result = $this->db->get('master_comm_value_tb');
	    return $result->result_array();
	}

	function del($srl){
		$q = $this->db->delete('master_comm_value_tb', array('srl' => $srl));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function fetchData($srl){
 		$query = $this->db->get_where('master_comm_value_tb', array('srl' => $srl));
 		return $query->result_array();
 	}

 	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '0':
                $update_column='Age_Next_Birth';
                break;
            case '1':
                $update_column='comm_value';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        if(!empty($value)){
        	 	$this->db->where('srl', $row_id);
		        $this->db->update('master_comm_value_tb', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}
	
}