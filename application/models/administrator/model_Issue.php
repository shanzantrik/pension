<?php 
class Model_Issue extends CI_Model
{

	function __constract()
	{
		parent::__construct();
	}

	function getData($file_no){
		//$q=$this->db->query('pension_receipt_file_master',array('file_No'=>$file_no));
		$sql="SELECT * from pension_receipt_file_master a,pension_receipt_register_master b,master_department c where a.dept_forw_no=b.dept_forw_no and a.file_No='$file_no' and b.branch_code=c.dept_code";

		$q=$this->db->query($sql);
		$x=$q->result_array();
		// print_r($x[0]['srl_No']);
		return $x[0];
	}

	function update_ajax()
    {
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];		
        $column=$_POST['column'];
	
        $update_column='';
        switch ($column) {
            case '5':
                $update_column='reg_dt';
                break;
            case '4':
                $update_column='reg_no';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        if(!empty($value)){
        	 	$this->db->where('file_no', $row_id);
		        $this->db->update('issue', $data);
		        echo $value;
        }
        else
        {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
       
	}

    function fetchData($file_no)
    {
        $query = $this->db->get_where('issue', array('file_no' => $file_no));
        return $query->result_array();
    }
}