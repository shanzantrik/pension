<?php 
class Model_payscale extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getPayScale($where = array(), $order_by='id', $order='desc')
	{
		$this->db->select('*');
		$this->db->from('master_pay_scale');
		if(count($where) > 0) :
			$this->db->where($where);
		endif;
		$this->db->order_by($order_by, $order);
		$result = $this->db->get();
		return $result->result_array();
	}
}