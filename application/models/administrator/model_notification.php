<?php

class model_notification extends CI_Model{

	function __construct() {
		parent:: __construct();
		$this->load->model('superandant/model_superandant');
	}
	function getNotifiction(){
		
		$member_code=$this->session->userdata('member_code');
		$sql="SELECT * from file_status a,pension_receipt_file_master b,token_reciept c,pensioner_personal_details d where d.case_no=b.file_No and c.file_No=b.file_No and a.status='Forwarded to Superintendent of Pension' and a.file_no=b.file_no";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}

	function getNotifiction_filter($department){
		
		$member_code=$this->session->userdata('member_code');
		$sql="SELECT * from file_status a,pension_receipt_file_master b,token_reciept c,pensioner_personal_details d, pension_receipt_register_master e where d.case_no=b.file_No and c.file_No=b.file_No and a.status='Forwarded to Superintendent of Pension' and a.file_no=b.file_no and b.dept_forw_no=e.dept_forw_no and e.branch_code=$department";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}

	function getNotificationfromDirector(){
		//$bc=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Superintendent of Pension from Director' and a.file_no=b.file_No and a.member_code=$member_code";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;	
	}
	function getIssueNotification(){
	   $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to issue by IPS' and a.file_no=b.file_No";
	   
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}

	function getFilterIpsIssue($department){
	   $sql="SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where  a.status='Forwarded to issue by IPS' and a.file_no=b.file_No and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}

	function getIssueNotification_fromgis(){
	    $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to issue by GIS' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}

	function getFilterGisIssue($department){
	    $sql="SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where  a.status='Forwarded to issue by GIS' and a.file_no=b.file_No and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}
	function getIssueNotification_frompension(){
	    $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to issue by pensionda from pension' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}

	function getFilterPensionIssue($department){
	    $sql="SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where  a.status='Forwarded to issue by pensionda from pension' and a.file_no=b.file_No and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}
	//		IPS NOTIFICATION
	function getIpsNotification(){
		$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to IPS' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}
	//		NDC NOTIFICATION
	function getNdcNotification(){
		$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to NDC' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;		
	}

	function getfile_no_from_pensioner_personal_details()
	{
		$q=$this->db->query("SELECT case_no from pensioner_personal_details");
	    $array = array();
	    foreach($q->result() as $key=>$row) :
	    	array_push($array, $row->case_no);
	    endforeach;
	  	return $array;
	}

	function getDirectorNotifiction_signature(){
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Director of Audit & Pension for Signature' and a.file_no=b.file_no and a.file_no";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	//Superandant IPS NOtification
	function getNotifiction_SUPER_IPS(){
		$member_code=$this->session->userdata('member_code');
    $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Superandant From IPS' and a.file_no=b.file_No and a.member_code=$member_code";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	//Superandant NDC NOtification
	function getNotifiction_SUPER_NDC(){
		$member_code=$this->session->userdata('member_code');
       $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Superandant From NDC' and a.file_no=b.file_No and a.member_code=$member_code";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
     function getPension_file()
	{
	    $sql="SELECT * from pension_receipt_file_master a,token_reciept b,pension_receipt_register_master c where a.file_No=b.file_No and a.dept_forw_no=c.dept_forw_no and  a.branch_code=1001 and a.file_No NOT IN (select file_no from file_status)";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	function getIPS_file()
	{
	 $sql="SELECT * from pension_receipt_file_master a,token_reciept b,pension_receipt_register_master c where a.file_No=b.file_No and a.dept_forw_no=c.dept_forw_no and  a.branch_code=1003 and a.file_No NOT IN (select file_no from file_status)";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	 }
	function getGIS_file()
	{
	 $sql="SELECT * from pension_receipt_file_master a,token_reciept b,pension_receipt_register_master c where a.file_No=b.file_No and a.dept_forw_no=c.dept_forw_no and  a.branch_code=1004 and a.file_No NOT IN (select file_no from file_status)";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	
	function confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Superintendent of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	//	###### IPS COnfirmation
	
	function ips_confirm_from_pension($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by IPS DA from Pension',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function confirm_from_superintendent($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Director from Gis Superintendent',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function ips_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by IPS DA from Receipt',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	//############### GIS Confirmation############//
	function gis_confirm($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS DA',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	function gis_confirm_after_approval($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS DA after Approval from JDAP',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;
		}
	}

	function gis_confirm_after_final($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS DA after Fianl from JDAP',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;
		}
	}

	   function get_group_of_employee($file_no)
      {
      	$this->db->select('file_status');
    	$this->db->from('file_tracking_details');
    	$this->db->where(array('file_no' => $file_no));
		$query = $this->db->get();
		if($query->num_rows()>0) 
		{
			$row = $query->row(); 
			if($row->file_status!="") 
			{
				return $row->file_status ;
			} 
			else 
			{
				return "not_exists";
			}

	    }
      }
	  ############### FAO ##################
		 function fao_confirm_for_approval($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		//$status=$this->model_notification->get_file_status($file);
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by FAO from Gis Superintendent',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			//$array=array('msg'=>'ok');
			return true;	
		}
		else{
			//$array=array('msg'=>'error');
			return false;	
		}
	}
	function confirm_by_fao_from_ips($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			//'file_status'=>'Received by Superintendent of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by FAO from IPS DA',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}



	//###########Joint Director##########//
	 function joint_director_confirm_for_approval($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		//$status=$this->model_notification->get_file_status($file);
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Joint Director from Gis Superintendent',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	
	 function jd_confirm_from_ips($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		//$status=$this->model_notification->get_file_status($file);
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Joint Director from IPS DA',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	//	###### GIS Superintendent Confirmation #########
	    function gis_superintendent_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS Superintendent From GIS DA',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	
	  function gis_superintendent_confirm_after_approval($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS Superintendent From JDAP After Approval',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function gis_superintendent_confirm_form_gis_Da($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS Superintendent From GISDA For Final',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	 function gis_superintendent_confirm_after_final($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS Superintendent From JDAP After Final',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	 function gis_superintendent_confirm_form_gis_Da_obj($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by GIS Superintendent From Gis Da For Objection File',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	
	//	###### NDC COnfirmation
	function ndc_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by NDC',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function confirm_tab3($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Superintendent of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function da_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by DA of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'member_code'=>$this->session->userdata('member_code')
			);

		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function save_fwd_to_gisda_bypension_da()
	 {
        $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
	    $member_code=$this->session->userdata('member_code');

		//$member_code=$this->get_director();
		$to=$_POST['to'];
		
					###############   pension DA  #####################
		if($to=='gis'){


		$chk=@$_POST['chk_receipt'];
				if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_receipt'])==true){
			$chk=$_POST['chk_receipt'];
			

			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					// 'file_no'=>$chk[$a],
					// 'branch'=>'IPS', //1004 means director
					// 'file_status'=>'Forwarded to Pension DA by IPS DA',
					// 'member_code'=>$this->session->userdata('member_code')

					'file_no'=>$chk[$a],
				    'branch'=>'GIS',
		            'file_status'=>'Forwarded to GIS DA By Pension DA',
		         	'member_code'=>$this->session->userdata('member_code')
					);
				
				$this->db->insert('file_tracking_details',$file_tracking);
		      	$this->db->where('file_no',$chk[$a]);
		        $this->db->update('file_status',array('status'=>'Forwarded to GIS DA By Pension DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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
	#################### ISSUE ##################
	else if($to=='issue')
			{
           
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
					'branch'=>'Pension', //
					'file_status'=>'Forwarded to issue by pensionda from pension',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to issue by pensionda from pension','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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
	


	 // 	$allocated_date=date('Y-m-d');
		// $branch_code=$this->session->userdata('branch_code');
		// $member_code=$this->session->userdata('member_code');
		// $chk=@$_POST['chk_receipt'];
		// if(empty($chk)){
		// 	return 'validate';
		// }else{
		// 	if(isset($_POST['chk_receipt'])==true){
		// 	$chk=$_POST['chk_receipt'];
		// 	$this->db->trans_begin();
		// 	foreach($chk as $a => $b){
		// 		$file_tracking=array(
		// 			'file_no'=>$chk[$a],
		// 			'branch'=>'GIS',
		// 			'file_status'=>'Forwarded to GIS DA By Pension DA',
		// 			'member_code'=>$this->session->userdata('member_code')
		// 			);
		// 		$this->db->insert('file_tracking_details',$file_tracking);
		// 		$this->db->where('file_no',$chk[$a]);
		// 		$this->db->update('file_status',array('status'=>'Forwarded to GIS DA By Pension DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
		// 	}
			
		// 	}
		// 	if ($this->db->trans_status() === FALSE)
		// 	{
		// 	    $this->db->trans_rollback();
		// 	    return 'RollBack';
		// 	}
		// 	else
		// 	{
		// 	    $this->db->trans_commit();
		// 	    return 'Success';
		// 	}
		// }

	 }
	function da_confirm_from_director($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by DA of pension from Director',
			'member_code'=>$this->session->userdata('member_code')
			);

		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function da_confirm_from_ips($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			//'file_status'=>'Received by DA of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by DA of pension from IPS',
			'member_code'=>$this->session->userdata('member_code')
			);

		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	//function that retrives dealing assistant of PENSION
	function getDA(){
		$bc=$this->session->userdata('branch_code');
		$q=$this->db->get_where('pen_members',array('member_type_code'=>1004));
		$result=$q->result();
		return $result;
	}
	//function that retrives dealing assistant of PENSION
	function getDA_PPO(){
		$q=$this->db->get_where('pen_members',array('member_type_code'=>1007));
		$result=$q->result();
		return $result;
	}
	################# Director #############
	function ips_confirm_by_director($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Director From IPS',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		   }
	}
	function confirm_from_joint_director($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Director From Joint Director',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function joint_director_confirm_for_pension($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Joint Director From Pension Superintendent',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	
	function pen_confirm_from_jd_fao_superintendent($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by  Director',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		}
	}
      
	  
	  function confirm_fao_from_pension_superintendent($file)
	{
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by FAO from pension superintendent',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{ 
			$array=array('msg'=>'error');
			return $array;	
		}
	}

	//function that saves forwarding to the DA of perticular Branch
	function save_forwrd(){
		$member_code=@$_POST['member_code'];
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>$this->getBranch_forwrd($branch_code),
					'file_status'=>'Forwarded to Dealing Assistant of '.$this->getBranch_forwrd($branch_code),
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'To DA','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
				$this->db->insert('concern_da',array('file_no'=>$chk[$a],'da'=>$member_code));				
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
	function getBranch_forwrd($branch_code)
	{
		$q=$this->db->get_where('master_branch',array('branch_code'=>$branch_code));
		$result=$q->result();
		return $result[0]->Branch_Name;
	}

	function getDANotifiction(){
		$bc=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b,token_reciept c, pension_receipt_register_master d  where c.file_No=b.file_No and a.status='Forwarded to Concern Dealing Assistant' and a.file_no=b.file_No and a.member_code=$member_code and b.dept_forw_no=d.dept_forw_no order by b.modified_date desc";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}

	function getDA_filter($department){

		$bc=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b,token_reciept c, pension_receipt_register_master d  where c.file_No=b.file_No and a.status='Forwarded to Concern Dealing Assistant' and a.file_no=b.file_No and a.member_code=$member_code and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department order by b.modified_date desc";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	
	function getfile_Director()
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details c where a.file_no=c.file_no");
		  $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where b.file_No=c.file_No and a.file_no=b.file_No and a.status='pension_Forwarded to Pension DA'");
		
    	$result = $q->result();
 		return $result;
	 }

	 function getDirector_filter($department)
	 {
		  $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c, pension_receipt_register_master d where b.file_No=c.file_No and a.file_no=b.file_No and a.status='pension_Forwarded to Pension DA' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
		
    	$result = $q->result();
 		return $result;
	 }

	 function getfile_ips()
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details c where a.file_no=c.file_no");
		  $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to Pension DA by IPS DA'");
		
    	$result = $q->result();
 		return $result;
	 }

	 function getIps_filter($department)
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details c where a.file_no=c.file_no");
		  $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master d where a.file_no=b.file_No and a.status='Forwarded to Pension DA by IPS DA' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
		
    	$result = $q->result();
 		return $result;
	 }

	function getDANotifiction2(){
		$bc=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Dealing Assistant of Pension from Superintendent' and a.file_no=b.file_No and a.member_code=$member_code";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	
	function get_superandant($branch_code){
		$q=$this->db->get_where('pen_members',array('desg_code'=>1002,'branch_code'=>$branch_code));
		$result=$q->result();
		return $result[0]->member_code;
	}
	function get_director(){
		$q=$this->db->get_where('pen_members',array('desg_code'=>1004));
		$result=$q->result();
		return $result[0]->member_code;
	}
	function save_fwd_to_pen_superintendent()
	{

	    $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
	
			$chk=@$_POST['chk_receipt'];
				if(empty($chk)){
					return 'validate';
					}
					else{
			$flag=0;
			if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->check_service_entry($chk[$a])=='entered')
					   //{
							$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'Pension', //1004 means director
								'file_status'=>'Forwarded to Superintendent of Pension',
								'member_code'=>$this->session->userdata('member_code')
							);
							$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to Superintendent of Pension','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
						//}
						//else
						//{
							//$flag=$flag+1;
						//}
					}//for each complete
					
					}
					
					//if($flag>0){
						//return "Not_All";
					//}
					//else{
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
					//}
				}
		//}
	}

	function save_forwrd_dynamic_ndc(){
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		if(isset($_POST['chk'])==true){
					$chk=$_POST['chk'];
					$this->db->trans_begin();
					foreach($chk as $a => $b){
			
						$file_tracking=array(
							'file_no'=>$chk[$a],
							'branch'=>'NDC', //1004 means director
							'file_status'=>'Forwarded to Superintendent From NDC',
							'member_code'=>$this->session->userdata('member_code')
							);
						$data=array('status'=>'Forwarded to Superandant From NDC','notification'=>'pending','allocated_date'=>$allocated_date,'member_code'=>$this->predict_super($chk[$a]));
						$this->db->insert('file_tracking_details',$file_tracking);
						$this->db->where('file_no',$chk[$a]);
						$this->db->update('file_status',$data);
						$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
						if($x->num_rows()==0){
							$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
						}
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
	function check_service_entry($file_no){
		$q=$this->db->get_where('pensioner_personal_details',array('case_no'=>$file_no));
		if($q->num_rows()>0){
			return 'entered';
		}
		else{
			return 'not_entered';
		}
	}
	

	function save_forwrd_dynamic(){
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();

		if(!empty($_POST['to']))
		{
			$to=$_POST['to'];
		//#################### IF IPS THEN #################
		if($to=='ips'){
			$chk=@$_POST['chk'];
				if(empty($chk)){
					return 'validate';
					}
					else{
			$flag=0;
			if(isset($_POST['chk'])==true){
					$chk=$_POST['chk'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						if($this->check_service_entry($chk[$a])=='entered')
					   {
							$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'Pension', //1004 means director
								'file_status'=>'Forwarded to IPS',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'Forwarded to IPS','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
					//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
						}
						else
						{
							$flag=$flag+1;
						}
					}//for each complete
					
					}
					
					if($flag>0){
						return "Not_All";
					}
					else{
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
		//###################	NDC    ###########################
		else if($to=='nda'){
				$flag=0;
				$chk=@$_POST['chk'];
				if(empty($chk)){
					return 'validate';
					}else{
							if(isset($_POST['chk'])==true){
							$chk=$_POST['chk'];
							$this->db->trans_begin();
							foreach($chk as $a => $b){
								if($this->check_service_entry($chk[$a])=='entered'){
									$file_tracking=array(
										'file_no'=>$chk[$a],
										'branch'=>'Pension', //1004 means director
										'file_status'=>'Forwarded to NDC',
										'member_code'=>$this->session->userdata('member_code')
									);
								
									$data=array('status'=>'Forwarded to NDC','notification'=>'pending','member_code'=>$this->predict_super($chk[$a]),'allocated_date'=>$allocated_date);
									$this->db->insert('file_tracking_details',$file_tracking);
									$this->db->where('file_no',$chk[$a]);
									$this->db->update('file_status',$data);
									$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
									if($x->num_rows()==0){
										$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
									}
								}
								else{
									$flag=$flag+1;
								}
								
							}
							
							}
							if($flag>0){
								return "Not_All";
							}
							else{
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
		
		else if($to=='superintendent_ips'){
			//echo $to;
			
				$chk=@$_POST['chk'];
				if(empty($chk)){
					return 'validate';
					}else{
							if(isset($_POST['chk'])==true){
							$chk=$_POST['chk'];
							$this->db->trans_begin();
							foreach($chk as $a => $b){
								$file_tracking=array(
									'file_no'=>$chk[$a],
									'branch'=>'IPS', //1004 means director
									'file_status'=>'Forwarded to Superintendent of Pension from IPS',
									'member_code'=>$this->session->userdata('member_code')
									);
								

								$this->db->insert('file_tracking_details',$file_tracking);
								$this->db->where('file_no',$chk[$a]);
								$this->db->update('file_status',array('status'=>'Forwarded to Superandant From IPS','notification'=>'pending','member_code'=>$this->predict_super($chk[$a]),'allocated_date'=>$allocated_date));
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));
								$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
								if($x->num_rows()==0){
									$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
								}
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
			//TO SUPERNDANTANT
			else{
				$flag=0;
				$chk=@$_POST['chk'];
				if(empty($chk)){
					return 'validate';
					}else{
							if(isset($_POST['chk'])==true){
							$chk=$_POST['chk'];
							$this->db->trans_begin();
							foreach($chk as $a => $b){
								if($this->check_service_entry($chk[$a])=='entered'){
									$file_tracking=array(
										'file_no'=>$chk[$a],
										'branch'=>'Director', //1004 means director
										'file_status'=>'Forwarded to Superintendent of Pension',
										'member_code'=>$this->session->userdata('member_code')
									);
									$this->db->insert('file_tracking_details',$file_tracking);
									$this->db->where('file_no',$chk[$a]);
									//$this->db->update('file_status',array('status'=>'Forwarded to Superandant of Pension','notification'=>'pending','member_code'=>$this->predict_super($chk[$a]),'allocated_date'=>$allocated_date));
									//$this->db->update('file_status'=>'Forwarded to Superintendent of Pension','notification'=>'pending','member_code'=>'100001','allocated_date'=>$allocated_date));
									$this->db->update('file_status',array('status'=>'Forwarded to Superintendent of Pension','notification'=>'pending','member_code'=>'100001','allocated_date'=>$allocated_date));
									$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
									//print_r($x);
									//exit();
									if($x->num_rows()==0){
									//print_r($chk[$a]);
									//exit();
					//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));
					$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>'100001'));	
									}
								}
								else{
									$flag=$flag+1;
								}
							}
							
							}
							if($flag>0){
								return "Not_All";
							}else{
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

	}
	elseif(!empty($_POST['send_back']))
	{
	
	$send_back=$_POST['send_back'];

	if($send_back=='receipt'){
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Send back to receipt',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->delete('file_status',array('file_no'=>$chk[$a]));
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
	//Get the predict Superandantant 
	function predict_super($file){
		$sql="SELECT * from pen_members where section in(SELECT a.section as section from pen_members a,concern_da b where a.member_code=b.da and b.file_no='$file') and member_type_code=1001";
		$q=$this->db->query($sql);
		$res=$q->result();
		return $res[0]->member_code;
	}

	function forwrd_to_superintendent(){
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
			}else{
					if(isset($_POST['chk'])==true){
					$chk=$_POST['chk'];
					$this->db->trans_begin();
					foreach($chk as $a => $b){
						$file_tracking=array(
							'file_no'=>$chk[$a],
							'branch'=>'Pension', //1004 means director
							'file_status'=>'Forwarded to Superintendent of Pension from concern Dealing Assistant',
							'member_code'=>$this->session->userdata('member_code')
							);						
						$data=array('status'=>'Forwarded to Superintendent of Pension from concern Dealing Assistant','notification'=>'pending','member_code'=>$this->getAssociateSuperendintent($chk[$a]),'allocated_date'=>$allocated_date);
						$this->db->insert('file_tracking_details',$file_tracking);
						$this->db->where('file_no',$chk[$a]);
						$this->db->update('file_status',$data);
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
	function save_forwrd_director(){
		
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		if(!empty($_POST['to']))
		{	

		$to=$_POST['to'];
			###############   director  #####################
		if($to=='director'){
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Forwarded to Director by Pension Suprintendent',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'pension_Forwarded to Director','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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
	#################### joint director ##################
	else if($to=='jd')
			{
			$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Forwarded to joint Director by pension superintendent',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'pension_Forwarded to joint Director','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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
	#################### FAO ##################
			else if($to=='fao')
			{
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Forwarded to FAO by pension superintendent',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'pension_Forwarded to FAO','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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

elseif(!empty($_POST['send_back']))
{
	$send_back=$_POST['send_back'];

	if($send_back=='pension_da'){
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$member_code=100002;//member code of Pension DA
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Send back to Pension DA',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to Concern Dealing Assistant','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date));
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
	function save_forwrd_to(){
		
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		$to=$_POST['to'];
			###############   pension DA  #####################
		if($to=='pensionda'){
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'IPS', //1004 means director
					'file_status'=>'Forwarded to Pension DA by IPS DA',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to Pension DA by IPS DA','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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
	#################### ISSUE ##################
	else if($to=='issue')
			{
			$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'IPS', //1004 means director
					'file_status'=>'Forwarded to issue by IPS',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to issue by IPS','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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

	function save_forwrd3(){
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Pension', //1004 means director
					'file_status'=>'Forwarded to Director of Audit & Pension for Signature',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to Director of Audit & Pension for Signature','notification'=>'pending','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$allocated_date));
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
	//####################functions for Director Notifcation##########################
	function getDirectorNotifiction(){
        $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Director of Audit & Pension' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	function director_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>'Director',
			'file_status'=>'Received by Director of Audit & Pension',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function getAssociateSuperendintent($file){
		$q=$this->db->get_where('concern_superintendent',array('file_no'=>$file));
		$res=$q->result();
		return $res[0]->superandant;
	}
	function get_branch_code($member_code){
		$q=$this->db->get_where('pen_members',array('member_code'=>$member_code));
		$result=$q->result();
		$x=$result[0]->Branch_Code;
		return $x;
	}
	function get_branch_name($branch_code){
		$this->db->where('Branch_Code',$branch_code);
		$q=$this->db->get_where('master_branch');
		$x=$q->result();
		return $x[0]->Branch_Name;
	}
	function save_forwrd_PPO(){
		$member_code=$this->session->userdata('member_code');
		$branch_code=$this->session->userdata('branch_code');
		$allocated_date=date('Y-m-d');
		

		if(empty($_POST['chk'])){
			return 'Validate';
		}
		if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				
				$file_tracking=array(
					'file_no'=>$chk[$a],
					/*'branch'=>$this->get_branch_name($this->get_branch_code($this->getAssociateSuperendintent($chk[$a]))),*/
					'branch'=>'Director',
					'file_status'=>'Forwarded to Superintendent of '.$this->get_branch_name($this->get_branch_code($this->getAssociateSuperendintent($chk[$a]))),
					'member_code'=>$member_code
					);
				$data=array('status'=>'Forwarded to Superintendent of '.$this->get_branch_name($this->get_branch_code($this->getAssociateSuperendintent($chk[$a]))).' from Director','notification'=>'pending','member_code'=>$this->getAssociateSuperendintent($chk[$a]),'allocated_date'=>$allocated_date,'branch_code'=>$branch_code);				
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',$data);
				$this->db->insert('file_tracking_details',$file_tracking);
				//Director Digital Signature
				$sig=array(
					'signature_id'=>$this->getMax_signature(),
					'file_no'=>$chk[$a],
					'date'=>date('Y-m-d'),
					'purpose'=>'approval',
					'remarks'=>'File Approved'
				);
				$this->db->insert('director_ds',$sig);
				
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
	function getMax_signature() {
		$this->db->select_max('signature_id');
	    $result = $this->db->get('director_ds');
	    $row = $result->result();
	    if($row[0]->signature_id == '') {
	    	return 2000;
	    } else {
	    	return $row[0]->signature_id+1;
	    }
	}
	function getAssociateDA($file){
		$q=$this->db->get_where('concern_da',array('file_no'=>$file));
		$res=$q->result();
		return $res[0]->da;
	}
	function fwd_to_concern_da(){
		$member_code=$this->session->userdata('member_code');
		$branch_code=$this->session->userdata('branch_code');
		$allocated_date=date('Y-m-d');
		if(empty($_POST['chk'])){
			return 'validate';
		}

		if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>$this->get_branch_name($this->get_branch_code($this->getAssociateDA($chk[$a]))),
					'file_status'=>'Forwarded to Dealing Assistant of '.$this->get_branch_name($this->get_branch_code($this->getAssociateDA($chk[$a]))),
					'member_code'=>$member_code
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$data=array(
					'status'=>'Forwarded to Dealing Assistant of Pension from Superintendent',
					'notification'=>'pending',
					'member_code'=>$this->getAssociateDA($chk[$a]),
					'allocated_date'=>$allocated_date,
					'branch_code'=>$branch_code
				);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',$data);
				
				
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
	function getBranchPPO(){
		$q=$this->db->get_where('pen_members',array('member_type_code'=>1005));
		$result=$q->result();
		return $result;
	}
	//#####################MARKING #########################

	function getMarkingNotifiction(){
        //$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Marking Superintendent' and a.file_no=b.file_No";      
        $sql="SELECT a.*,b.*,c.branch_code as dept
		from file_status a,pension_receipt_file_master b,pension_receipt_register_master c
		where a.status='Forwarded to Marking Superintendent' and a.file_no=b.file_No and b.dept_forw_no=c.dept_forw_no";
	    $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	function marking_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received Marking Superintendent of '.$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	//##################################################################################################################
	
	function forward_to_Da(){
		$member_code=@$_POST['member_code'];
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>$this->getBranch_forwrd($branch_code),
					'file_status'=>'Forwarded to Concern Dealing Assistant',
					'member_code'=>$this->session->userdata('member_code')
					);
				$x=$this->get_branch_code($member_code);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'To DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$x));
				$this->db->insert('concern_da',array('file_no'=>$chk[$a],'da'=>$member_code));	
				$reg=$this->registration_generation($chk[$a]);
				$this->db->where('file_No',$chk[$a]);
				$this->db->update('pension_receipt_file_master',array('registration_no'=>$reg));
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
	//###############################################################################################################
	function registration_generation($file){
		$x=$this->getMax_registration();
		$curent_year=mysql_real_escape_string(date('y'));
		$prev_year=mysql_real_escape_string(date('y')-1);
		$reg="Pen/AP/".$x."/".$curent_year."-".$prev_year;
		$this->db->insert('registration',array('auto_increment'=>$x,'file_no'=>$file,'registration_no'=>$reg));
		return $reg;
	}
	function getMax_registration(){
		$this->db->select_max('auto_increment');
	    $result = $this->db->get('registration');
	    $row = $result->result();
	    if($row[0]->auto_increment == '') {
	    	return "22984";
	    } else {
	    	return $row[0]->auto_increment+1;
	    }
	}
	
	//###############################################################################################################
	function to_director_files(){
		$bc=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
        $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.member_code=$member_code and a.status='Forwarded to Superintendent of Pension from concern Dealing Assistant' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	function forward_to_issue(){
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'Director',
					'file_status'=>'Forwarded to Issue By Director of Audit & Pension',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'To Issue','notification'=>'pending','member_code'=>0,'allocated_date'=>$allocated_date,'branch_code'=>0));
				$sig=array(
					'signature_id'=>$this->getMax_signature(),
					'file_no'=>$chk[$a],
					'date'=>date('Y-m-d'),
					'purpose'=>'signature',
					'remarks'=>'Final Approval'
				);
				$this->db->insert('director_ds',$sig);

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
	//################################### ISSUE BRANCH  ###################################

	function confirm_issue($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today,'branch_code'=>$this->session->userdata('branch_code')));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received by Issue Branch',
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	//RETRIVE PENSIONEE INFO 
	function pensionee_info($file_no){
	
		function details($file_no){
			$sql="SELECT a.*,b.*,c.*,d.dept_name as department_name from pension_receipt_file_master a,pension_receipt_register_master b,registration c,master_department d where a.file_No=c.file_no and a.dept_forw_no=b.dept_forw_no and a.file_No='$file_no' and b.branch_code=d.dept_code";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			return $row;
		}
		function get_receipt_date($file_no){
			$sql="Select * from file_tracking_details where file_no='$file_no' order by serial_no asc";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$entry_time= $row['entry_time'];
			return $entry_time;
		}
		function get_last_date($file_no){
			$sql="Select * from file_tracking_details where file_no='$file_no' order by serial_no desc";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$entry_time= $row['entry_time'];
			return $entry_time;
		}
		$result=array('receipt_date'=>get_receipt_date($file_no),'dispatch_date'=>get_last_date($file_no),'details'=>details($file_no));
		return $result;
		

	}

	//######################################################################################

	function get_last_member($file_no){
		$sql="Select * from file_tracking_details where file_no='$file_no' order by serial_no desc";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$member_code= $row['member_code'];
		$x=mysql_query("SELECT member_code,member_name from pen_members where member_code=$member_code");
		$y=mysql_fetch_array($x);
		return $y;
	}
	 function getAll_issued_file()
	 {
	    $sql="select * from issue a,pension_receipt_file_master b,token_reciept c where c.file_no=b.file_No and a.file_no=b.file_No";
	$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;	 }
}
