<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RestService extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
	}

	function getPreRevisedPayScale()
	{
		$payCommission = $this->input->post('payCommission');
		$this->db->select('id, grade, pay_scale');
    	$this->db->from('master_pay_scale');
    	$this->db->where(array('pay_commission'=>$payCommission));
    	$result = $this->db->get();

    	echo '<option value="0">--Select--</option>';
    	foreach ($result->result_array() as $value) {
    		echo '<option value="'.$value['id'].'">'.$value['grade']." - ".$value['pay_scale'].'</option>';
    	}
	}

    function da_confirm_from_director(){
        $file=$_GET['file'];
        //print_r($file);
        $json=$this->model_notification->da_confirm_from_director($file);
        echo json_encode($json);
    }

	function getPreRevisedPayScaleSelect()
	{
		$payCommission = $this->input->post('payCommission');
		$select = $this->input->post('select');
		$this->db->select('id, grade, pay_scale');
    	$this->db->from('master_pay_scale');
    	$this->db->where(array('pay_commission'=>$payCommission));
    	$result = $this->db->get();
    	echo '<option value="0">--Select--</option>';
    	foreach ($result->result_array() as $value) {
    		if($value['id'] == $select) {
    			echo '<option value="'.$value['id'].'" selected>'.$value['grade']." - ".$value['pay_scale'].'</option>';
    		} else {
    			echo '<option value="'.$value['id'].'">'.$value['grade']." - ".$value['pay_scale'].'</option>';
    		}
    	}
	}
}