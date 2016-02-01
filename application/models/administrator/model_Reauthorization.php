<?php 
class Model_Reauthorization extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function get_family($serial_no)
	{
		$this->db->select('*');
    	$this->db->from('pensioner_family_details');
    	$this->db->where(array('pensioner_family_details.serial_no'=>$serial_no));
		$query = $this->db->get();
 		return $query->result_array();
 		
	}
	
		function get_file_no($serial_no)
	  {
	    $this->db->select('case_no');
		$this->db->where('serial_no', $serial_no);
		$query = $this->db->get('pensioner_personal_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->case_no;
		} else {
			return "";
		}
 		
	}
	
		function add_reautho($file_no,$enhanrate_from,$age_25,$enhanrate_upto,$enhanrate_upto_for_child,$ordrate_from){		
		extract($_POST);

     /*  		$obj=array();
			if(!empty($_POST['objection']))
			{
				for($k=0; $k<count($_POST['objection']); $k++)
				{
					$obj_info = array();
					$obj_info['objection'] = $_POST['objection'][$k];
					array_push($obj, $obj_info);
			   	}
			   
			}*/

		$data = array(
			'file_no'=>$file_no,
			'claiment_name'=>$claiment_name,
			'claiment_dob'=>$child_dob,
			'pensioner_dod'=>$dod_pensioner,
			'pensioner_husbandwife_dod'=>$dod_pensioner_wife_husband,
			'enhanrate_from'=>$enhanrate_from,
		    'age_25'=>$age_25,
			'enhanrate_upto'=>$enhanrate_upto,
			'enhanrate_upto_for_child'=>$enhanrate_upto_for_child,
			'ordrate_from'=>$ordrate_from

			
			
		);
          

		if($this->db->insert('reauthorization', $data))
		{
			return true;
		} else {
			return false;
		}
	}
	 	function get_file_no_from_reautho($file_no) 
	{
		$this->db->select('file_no');
		$this->db->where('file_no', $file_no);
		$query = $this->db->get('reauthorization');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->file_no;
		} else {
			return "";
		}
	}
		 	function get_payscale($pay_scale) 
	{
		$this->db->select('pay_scale');
		$this->db->where('id', $pay_scale);
		$query = $this->db->get('master_pay_scale');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->pay_scale;
		} else {
			return "";
		}
	}
	
	 function get_reauthorization_details($file_id)
	 {
		$this->db->select ('*');
    	$this->db->from('reauthorization');
    	$this->db->where(array('reauthorization.id'=>$file_id));
    	$this->db->join('pensioner_personal_details', 'pensioner_personal_details.case_no=reauthorization.file_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();

/*		$query = $this->db->get();
 		return $query->result_array();*/
	 }
	 
	 function get_reauthorization_details_by_file_no($file_no)
	 {
		$this->db->select ('*');
    	$this->db->from('reauthorization');
    	$this->db->where(array('reauthorization.file_no'=>$file_no));
    	$this->db->join('pensioner_personal_details', 'pensioner_personal_details.case_no=reauthorization.file_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	 }
	 
	 function get_pensioner_dod($serial_no)
	{
/*		
	    $this->db->select('dod');
		$this->db->where('serial_no', $serial_no);
		$query = $this->db->get('pensioner_service_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->dod;
		} else {
			return "";
		}
*/		
        $this->db->select ('*');
    	$this->db->from('pensioner_service_details');
    	$this->db->where(array('pensioner_service_details.serial_no'=>$serial_no));
    	//$this->db->join('pensioner_personal_details', 'pensioner_personal_details.case_no=reauthorization.file_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();

	}

     	function get_child($serial_no)
	{
		$this->db->select('*');
    	$this->db->from('pensioner_family_details');
    	$this->db->where(array('pensioner_family_details.serial_no'=>$serial_no));
		$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_family_details.serial_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();

	}
	
}