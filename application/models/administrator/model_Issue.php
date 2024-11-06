<?php 
class Model_Issue extends CI_Model
{

	function __constract()
	{
		parent::__construct();
    
	}

	function getData($file_no){
		////$q=$this->db->query('pension_receipt_file_master',array('file_No'=>$file_no));
		//$sql="SELECT * from pension_receipt_file_master a,pension_receipt_register_master b,master_department c where a.dept_forw_no=b.dept_forw_no and a.file_No='$file_no' and b.branch_code=c.dept_code";
        $sql="SELECT * from pension_receipt_file_master a,pension_receipt_register_master b,master_department c, pensioner_personal_details d, pensioner_treasury_details e, pensioner_service_details f, master_treasury g where a.dept_forw_no=b.dept_forw_no and a.file_No='$file_no' and b.branch_code=c.dept_code and d.case_no=a.file_No and d.serial_no=e.serial_no and f.serial_no=d.serial_no and e.treasury_officer=g.id";

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
            case '12':
                $update_column='remarks';
                break;
            case '11':
                $update_column='po_personal_date';
                break;
            case '10':
                $update_column='po_personal';
                break;
            case '9':
                $update_column='po_iddate';
                break;
            case '8':
                $update_column='po_idcard';
                break;
            case '7':
                $update_column='po_date';
                break;

            case '6':
                $update_column='po_no';
                break;
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

                $query=$this->db->query("select * from issue where file_no='".$row_id."'");
                if($query->num_rows() > 0)
                {
                    $row=$query->row();
                    $reg_no=$row->reg_no;
                    $reg_dt=$row->reg_dt;
                    $po_no=$row->po_no;
                    $po_date=$row->po_date;

                    

                }
                $this->db->where('file_no', $row_id);
                //$this->db->update('file_status', ['reg_no'=>$value]);
                $this->db->update('file_status', ['reg_no'=>$reg_no,'reg_dt'=>$reg_dt,'po_no'=>$po_no,'po_date'=>$po_date]);
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