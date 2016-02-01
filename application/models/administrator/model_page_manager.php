<?php 
class Model_page_manager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function getData(){
		$result=$this->db->get('content_manager');
		return $result->result_array();
	}
	function save($title,$index,$icon_name){
		$ret=$this->count($title);
		if($ret=='PK'){
			return 'PK';
		}
		else{
			$this->db->insert('content_manager',array('page_title'=>$title,'index'=>$index,'icon'=>$icon_name));
			return 'true';
		}
	}
	function count($title){
		$query = $this->db->get_where('content_manager', array('page_title'=>$title));
		$count = $query->num_rows(); 
		if($count>0){
			return 'PK';
		}else{
			return 'OK';
		}
	}
	function getPageDetails($id){
		$result=$this->db->get_where('content_manager', array('id'=>$id));
		$vals=$result->result_array();
		return $vals[0];
	}
	function getPageDetails_byId($page_title){
		$result=$this->db->get_where('content_manager', array('page_title'=>$page_title));
		$vals=$result->result_array();
		return $vals[0];
	}
	function update($id,$codebase,$page_title){
		$this->db->where('id',$id);
		$q=$this->db->update('content_manager',array('codebase'=>$codebase,'page_title'=>$page_title));
		if($q){
			return true;
		}else{
			return false;
		}
	}
	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';
       
        switch ($column) {
            case '1':
                $update_column='page_title';
                break;
            case '2':
            	$update_column='index';
            	break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        $this->db->where('id', $row_id);
        $this->db->update('content_manager', $data);
        echo $value;
	}
}