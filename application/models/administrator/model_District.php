<?php 
class Model_District extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function add() {
		extract($_POST);
		$data = array(
			'district_name'=>$district_name,
			'state'=>$state
		);
		if($this->check($district_name)==false){
			if($this->db->insert('master_districts', $data)) {
			return 'true';
			} else {
				return 'false';
			}
		}
		else{
			return 'PK';
		}
		
	}
	function check($district_name){
		$q=$this->db->query("Select district_name from master_districts where district_name='$district_name'");
		if($q->num_rows()>0){
			return true;
		}
		return false;
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='district_name';
                break;
            case '2':
                $update_column='state';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        if(!empty($value)){
        	
        	 	$this->db->where('district_code', $row_id);
		        $this->db->update('master_districts', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}
	function fetchData($districts) {
 		$query = $this->db->get_where('master_districts', array('district_code' => $district_code));
 		return $query->result_array();
 	}
 	function del($district_code){
		$q = $this->db->delete('master_districts', array('district_code' => $district_code));
		if($q) {
			return true;
		} else {
			return false;
		}
	}
}