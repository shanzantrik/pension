<?php

class Model_document extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}

	function check($doc_name, $status){
		$q=$this->db->query("Select doc_name from master_document where doc_name='$doc_name' and status='$status'");
		if($q->num_rows()>0){
			return true;
		}
		return false;
	}

	function add() {
		extract($_POST);
		$data = array(
			'doc_no'=>$this->getMax_doc_no(),
			'doc_name'=>$document_name,
			'status'=>$document_for,
			'descrp'=>$description,
			'member_code'=>$this->session->userdata('member_code')
		);
		if($this->check($document_name, $status)==false){
			if($this->db->insert('master_document', $data)) {
				return true;
			} else {
				return false;
			}
		}
		else{
			return "PK";
		}
	}

	function getAll() {
	    $result = $this->db->get('master_document');
	    return $result->result_array();
	}

	function del($doc_no){
		$q = $this->db->delete('master_document', array('doc_no' => $doc_no));
		if($q) {
			return true;
		} else {
			return false;
		}
	}

	function getData($limit, $start) {
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_document');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	function fetchData($doc_no) {
 		$query = $this->db->get_where('master_document', array('doc_no' => $doc_no));
 		return $query->result_array();
 	}
 
 	function record_count() {
        return $this->db->count_all("master_document");
    }

   function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='doc_name';
                break;
            case '2':
                $update_column='descrp';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
           $update_column => $value
        );
        if(!empty($value)){
        	 	$this->db->where('doc_no', $row_id);
		        $this->db->update('master_document', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}

	function getMax_doc_no() {
		$this->db->select_max('doc_no');
	    $result = $this->db->get('master_document');
	    $row = $result->result();
	    if($row[0]->doc_no == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->doc_no+1;
	    }
	}
}