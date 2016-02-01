<?php 
class Model_notice extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function record_count(){
		return $this->db->count_all("notice");
	}


	function add() {
		extract($_POST);
		$notice=strip_tags($notice, '<a><strong><em>');
		$data = array(
			'from_date'=>$from_date,
			'to_date'=>$to_date,
			'member_group'=>$branch,
			'notice'=>$notice,
			
		);
		if($this->db->insert('notice', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function getData($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query=$this->db->get('notice');
		
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;


		//return $query->result();
	}


	function getall_branch()
	 {
	    $this->db->select('*');
    	$this->db->from('master_branch`');
    	//$this->db->join('master_branch', 'pension_receipt_file_master.Branch_Code = master_branch.Branch_Code', 'inner');
    	//$this->db->where(array('pension_receipt_file_master.Branch_Code' =>1004));
    	$result = $this->db->get();
 		return $result->result_array();
	 }
}