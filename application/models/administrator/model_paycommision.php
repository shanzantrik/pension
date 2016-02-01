<?php 
/**
* Pay Commision Master Entry Model Class  Creation Date: 15/5/2014
*/
class model_paycommision extends CI_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function getPayComn(){
		 $result = $this->db->get('master_pay_comm');
	     return $result->result_array();
	}

	function getSpecific($id){
		/*$this->db->get_where('master_pay_comm_param', array('pay_comm_id'=>$id));
	    return $result->result_array();*/
    	$this->db->from('master_pay_comm_param');
    	$this->db->where(array('pay_comm_id' => $id));
    	$this->db->order_by('sort_order', 'asc');
		$result = $this->db->get();
		/*$result = $this->db->query('SELECT * FROM `master_pay_comm_param` WHERE `pay_comm_id`='.$id.' ORDER BY sort_order asc');*/
	    return $result->result_array();
	}

	function update_ajax(){
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];

        $update_column='';
       
        switch ($column) {
            case '1':
                $update_column='name';
                break;
            case '2':
            	$update_column='alias_name';
            	break;
            case '3':
            	$update_column='sort_order';
            	break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        $this->db->where('id', $row_id);
        $this->db->update('master_pay_comm_param', $data);
        echo $value;
	}

	function save_pay_comn(){
		$data=array(
			'pay_comm_id'=>$_GET['id'],
			'name'=>$_GET['name'],
			'alias_name'=>$_GET['alias_name'],
			'da'=>$_GET['dearness_allowance'],
			'sort_order'=>$_GET['sort_order']
		);
		$data2=array(
			'pay_comm_id'=>$_GET['id'],
			'name'=>$_GET['name']
		);
		$q=$this->db->get_where('master_pay_comm_param',$data2);
		//pk error
		if($q->num_rows()>0){
			$arr=array('message'=>'PK');
		}
		else
		{
			$this->db->insert('master_pay_comm_param',$data);
			$insert_id = $this->db->insert_id();
			$anchor="<a href='#delete' id='del_but' class='open-dialog btn btn-danger btn-rad' data-toggle='modal' data-id=$insert_id><i class='icon-trash'></i></a>";
			$arr=array(
				'message'=>'success',
				'pay_comm_id'=>$_GET['id'],
				'name'=>$_GET['name'],
				'alias_name'=>$_GET['alias_name'],
				'sort_order'=>$_GET['sort_order'],
				'anchor'=>$anchor
			);
		}
		echo json_encode($arr);
	}

	function delete($id){
		$q=$this->db->delete('master_pay_comm_param',array('id'=>$id));
		if($q){
			return true;
		}
		return false;
	}
}