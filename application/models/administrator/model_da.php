<?php

class Model_da extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function add() {
		extract($_POST);
		$query = $this->db->get_where('dearness_allowance_master', array('from'=>$from));
		if($query->num_rows() > 0) :
			return 'exists';
		else :
			$data = array(
				'from'=>$from,
				'percentage'=>$percentage,
				'member_code'=>$this->session->userdata('member_code')
			);
			if($this->db->insert('dearness_allowance_master', $data)) {
				return true;
			} else {
				return false;
			}
		endif;
	}

	function getAll() {
	    $result = $this->db->get('dearness_allowance_master');
	    return $result->result_array();
	}

	function del($srl){
		$q = $this->db->delete('dearness_allowance_master', array('serial_no' => $srl));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('dearness_allowance_master');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($srl){
 		$query = $this->db->get_where('dearness_allowance_master', array('serial_no' => $srl));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("dearness_allowance_master");
    }

    function update($srl){
    	extract($_POST);
		$data = array(
			'from'=>$from,
			'percentage'=>$percentage,
			'member_code'=>$this->session->userdata('member_code')
		);
		$this->db->where('serial_no', $srl);
		$up = $this->db->update('dearness_allowance_master', $data); 
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function get_latest_da_percent() {
		$query = $this->db->query("SELECT `serial_no`, `percentage` from dearness_allowance_master where serial_no=(select max(serial_no) from dearness_allowance_master)");
		return $query->row();
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '0':
                $update_column='from';
                break;
            case '1':
                $update_column='percentage';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
           $update_column => $value
        );
        if(!empty($value)){
    		if($update_column=='percentage'){
    			//if($value<=100){
    				$this->db->where('serial_no', $row_id);
			        $this->db->update('dearness_allowance_master', $data);
			        echo $value;
    			/*} else {
    				$arr=$this->fetchData($row_id);
    				echo $arr[0][$update_column];
    			}*/
    		} else {
    			$this->db->where('serial_no', $row_id);
		        $this->db->update('dearness_allowance_master', $data);
		        echo $value;
    		}
        } else {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}
}