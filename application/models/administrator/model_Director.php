<?php

class model_Director extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
		
	function filefrom_gis_superintendent()
	{
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d where b.file_No=d.file_No and  a.file_no=b.file_No and b.file_No=c.file_no and a.status='gis_Forwarded to Director'");
    	$result = $q->result();
 		return $result;
	}

	function getFilterGIS($department)
	{
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d, pension_receipt_register_master e where b.file_No=d.file_No and  a.file_no=b.file_No and b.file_No=c.file_no and a.status='gis_Forwarded to Director' and b.dept_forw_no=e.dept_forw_no and e.branch_code=$department");
    	$result = $q->result();
 		return $result;
	}
	
	function getfile_from_joint_director()
	{
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c where a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to Director' and c.claim_status='complete'");
    	$result = $q->result();
 		return $result;
	}

	function getFilterJD($department)
	{
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c, pension_receipt_register_master d where a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to Director' and c.claim_status='complete' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
    	$result = $q->result();
 		return $result;
	}

	function getfile_from_ips()
	{
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,pensioner_ips_details c,token_reciept d where a.file_no=b.file_No and a.file_no=d.file_No and b.file_No=c.file_no and a.status='ips_Forwarded to Director'");
    	$result = $q->result();
 		return $result;
	}
	
	function getFilterIps($department)
	{
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,pensioner_ips_details c,token_reciept d, pension_receipt_register_master e where a.file_no=b.file_No and a.file_no=d.file_No and b.file_No=c.file_no and a.status='ips_Forwarded to Director' and b.dept_forw_no=e.dept_forw_no and e.branch_code=$department");
    	$result = $q->result();
 		return $result;
	}

	function getpensionfile_from_jd_fao()
	{
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c,pensioner_personal_details d where d.case_no=b.file_No and a.file_no=b.file_No and c.file_No=b.file_No and a.status='pension_Forwarded to Director'");
    	$result = $q->result();
 		return $result;
	}

	function getFilterPension($department)
	{
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c,pensioner_personal_details d, pension_receipt_register_master e where d.case_no=b.file_No and a.file_no=b.file_No and c.file_No=b.file_No and a.status='pension_Forwarded to Director' and b.dept_forw_no=e.dept_forw_no and e.branch_code=$department");
    	$result = $q->result();
 		return $result;
	}
	 
	function save_fwd_to_gisda()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>trim($chk[$a]),
					'branch'=>'GIS',
					'file_status'=>'Forwarded to GIS DA By Director',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',trim($chk[$a]));
				$this->db->update('file_status',array('status'=>'gis_Forwarded to GIS DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	 }
	 
	 	 function save_fwd_pension_da()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		
		if(!empty($_POST['to']))
		{
		$member_code=$this->session->userdata('member_code');	
		$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>trim($chk[$a]),
					'branch'=>'Pension',
					'file_status'=>'Forwarded to Pension DA By Director',
					'member_code'=>$this->session->userdata('member_code')
					);
				//print_r($file_tracking);
				//exit();
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',trim($chk[$a]));
				$this->db->update('file_status',array('status'=>'pension_Forwarded to Pension DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	 }
	 else if(!empty($_POST['send_back']))
	 {

	 	$send_back=$_POST['send_back'];
	 	
	    if($send_back=='superintendent')
	    {
	    	$member_code=100001;
	    	$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>trim($chk[$a]),
					'branch'=>'Pension',
					'file_status'=>'Send back to Superintendent of Pension',
					'member_code'=>$this->session->userdata('member_code')
					);
				//print_r($file_tracking);
				//exit();
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',trim($chk[$a]));
				$this->db->update('file_status',array('status'=>'Forwarded to Superintendent of Pension','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	    }

	    if($send_back=='fao')
	    {
	    	$member_code=100015;
	    	$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>trim($chk[$a]),
					'branch'=>'Pension',
					'file_status'=>'Send back to FAO of Pension',
					'member_code'=>$this->session->userdata('member_code')
					);
				//print_r($file_tracking);
				//exit();
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',trim($chk[$a]));
				$this->db->update('file_status',array('status'=>'pension_Forwarded to FAO','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	    }

	    if($send_back=='joint_director')
	    {
	    	$member_code=100014;
	    	$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>trim($chk[$a]),
					'branch'=>'Pension',
					'file_status'=>'Send back to Joint Director of Pension',
					'member_code'=>$this->session->userdata('member_code')
					);
				//print_r($file_tracking);
				//exit();
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',trim($chk[$a]));
				$this->db->update('file_status',array('status'=>'pension_Forwarded to joint Director','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	    }	
	 }

	 else{
	 	return 'validate';
	 }
}
	 	
	 function save_frwrd_to_ipsda_by_director()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();

			$file_review_query = '';
			foreach($_POST as $key => $value) {
	    		if(preg_match('@^review_for_@', $key)) {
	    			$file_no = str_replace("review_for_", "", $key);
	    			$file_review = $_POST[$key];
	    		
	    			$file_review_query.= '("'.$file_no.'", "'.$file_review.'", '.$this->session->userdata('member_code').', "Forwarded to IPS DA By Director"), ';
	    		}
	    	}
	    	//echo $file_review_query;
	    	//exit();

	    	$this->db->query("INSERT INTO file_review (`file_no`, `review`, `member_code`, `status`) VALUES ".substr(trim($file_review_query), 0, -1).";");

			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'GIS',
					'file_status'=>'Forwarded to IPS DA By Director',
					'member_code'=>$this->session->userdata('member_code')
					);
				//
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status', array('status'=>'ips_Forwarded to IPS DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	 }
	 	 function save_frwrd_to_gisda_by_director()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk_receipt'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'GIS',
					'file_status'=>'Forwarded to GIS DA By Director',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'ips_Forwarded to GIS DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
	 }
	  
	 

}