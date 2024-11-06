<?php 
class Model_FAO extends CI_Model
{

	function __construct()
	{
	
		parent::__construct();
	}
	function getAll_file_gissuperintendent()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where a.file_no=b.file_No and c.file_No=b.file_No and a.status='gis_Forwarded to FAO'");
    	$result = $q->result();
 		return $result;
	 }
	 	function getAll_file_from_ips()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where b.file_No=c.file_No and  a.file_no=b.file_No and a.status='ips_Forwarded to FAO'");
    	$result = $q->result();
 		return $result;
	 }
	 
	 function getAll_file_from_pension_superintendent()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c,pensioner_personal_details d where d.case_no=b.file_No and c.file_No=b.file_No and a.file_no=b.file_No and a.status='pension_Forwarded to FAO'");
    	$result = $q->result();
 		return $result;
	 }

	 
	 function ips_save_forwrd_by_fao()
	 {
	    $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		$to=$_POST['to'];
		###############   director  #####################
		if($to=='director'){
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to Director by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'ips_Forwarded to Director','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
					
			}
			#################IPS DA###############
					if($to=='ipsda'){
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'IPS', //1004 means director
								'file_status'=>'Forwarded to IPS DA by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'ips_Forwarded to IPS DA','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
					
			}
	}
	function pension_save_fwd_by_fao()
	{
	 $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		$to=$_POST['to'];
		#########Director################
		if($to=='director'){
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'Pension', //1004 means director
								'file_status'=>'Forwarded to Director by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'pension_Forwarded to Director','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
					
			}
			###################Pension DA#################
			else if($to=='pension_da')
			{
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'Pension', //1004 means director
								'file_status'=>'Forwarded to Pension DA by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'pension_Forwarded to Pension DA','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
			}
	}
	 function save_fwd_by_fao()
	 {
	    $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();
		$to=$_POST['to'];
		###############   director  #####################
		if($to=='director'){
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to Director by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'gis_Forwarded to Director','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
					
			}
			#################Gis DA###############
					if($to=='gisda'){
			$chk=@$_POST['chk_receipt'];
					if(empty($chk)){
					return 'validate';
					}else{
					$flag=0;
			    if(isset($_POST['chk_receipt'])==true){
					$chk=$_POST['chk_receipt'];
					$this->db->trans_begin();
					foreach($chk as $a => $b)
					{
						//if($this->checklist_entry($chk[$a])=='entered')
					   //{
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to GIS DA by FAO',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'gis_Forwarded to GIS DA','notification'=>'pending','allocated_date'=>$allocated_date);
							$this->db->insert('file_tracking_details',$file_tracking);
							$this->db->where('file_no',$chk[$a]);
							$this->db->update('file_status',$data);
							//$x=$this->db->get_where('concern_superintendent',array('file_no'=>$chk[$a]));
							//if($x->num_rows()==0){
								//$this->db->insert('concern_superintendent',array('file_no'=>$chk[$a],'superandant'=>$this->predict_super($chk[$a])));	
							//}
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
					
			}
	}
	function getBranch_forwrd($branch_code)
	{
		$q=$this->db->get_where('master_branch',array('branch_code'=>$branch_code));
		$result=$q->result();
		return $result[0]->Branch_Name;
	}
		function get_director()
	{
		$q=$this->db->get_where('pen_members',array('desg_code'=>1004));
		$result=$q->result();
		return $result[0]->member_code;
	}
	    function get_ips_detail2($file_no)
	 {       
      $this->db->select('*');
      $this->db->from('pensioner_ips_details');
      $this->db->where(array('pensioner_ips_details.file_no' =>$file_no));
      $this->db->join('file_status', 'file_status.file_no = pensioner_ips_details.file_no', 'left');
      $query = $this->db->get();
      return $query->result_array();
    }

}