<?php

class Model_Alerts extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getNotification(){
		$y=date('Y');
		$m=date('m');
		$d=date('d')-7;
		$dt=$y.'-'.$m.'-'.$d.' 01:00:00';
		$sql="select a.*,b.member_name from file_tracking_details a,pen_members b where file_status like '%Received%' and entry_time <= '$dt' and a.member_code=b.member_code";
		$q=$this->db->query($sql);
		$x=$q->result();
		return $x;
	}
}