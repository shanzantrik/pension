<?php 
class Model_joint_director extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function getAll_file_superintendent_for_approval()
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where c.file_No=b.file_No and a.file_no=b.file_No and a.status='gis_Forwarded to joint Director'");
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d where b.file_No=d.file_No and a.file_no=b.file_No and b.file_No=c.file_no and a.status='gis_Forwarded to joint Director'");

    	$result = $q->result();
 		return $result;
	 }
	 function getAll_file_superintendent_for_final()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where b.file_No=c.file_No and a.file_no=b.file_No and a.status='ips_Forwarded to joint Director'");
    	$result = $q->result();
 		return $result;
	 }
	 
	 function  getAll_file_from_pension_superintendent()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,pensioner_personal_details c where c.case_no=b.file_No and a.file_no=b.file_No and a.status='pension_Forwarded to joint Director'");
    	$result = $q->result();
 		return $result;
	 }

	 function  getPensionFilter($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,pensioner_personal_details c, pension_receipt_register_master d where c.case_no=b.file_No and a.file_no=b.file_No and a.status='pension_Forwarded to joint Director' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	  
	  function save_fwd_by_jd_from_ips()
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
								'branch'=>'IPS', //1004 means director
								'file_status'=>'Forwarded to Director by joint Director',
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
			#################Gis DA###############
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
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to IPS DA by joint Director',
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
	  function pension_save_fwd_by_jd()
	 {
        $allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->get_director();

		if(!empty($_POST['to']))
		{	
		$to=$_POST['to'];
		###############   director  #####################
		if($to=='director')
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
								'branch'=>'pension', //1004 means director
								'file_status'=>'Forwarded to Director by joint Director',
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
		 ################# Pension Da ########
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
								'branch'=>'pension', //1004 means director
								'file_status'=>'Forwarded to Pension DA by joint Director',
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

    else if(!empty($_POST['send_back']))
    {
  		$send_back=$_POST['send_back'];
  		$member_code=100001;
  		if($send_back=='superintendent')
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
								'branch'=>'pension', //1004 means director
								'file_status'=>'Send back to Superintendent of Pension',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'Forwarded to Superintendent of Pension','notification'=>'pending', 'member_code'=>$member_code,'allocated_date'=>$allocated_date);
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
	
	else{
		return 'validate';
	}

	}	
	 function save_fwd_to_gis_superintendent_after_approval()
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
								'file_status'=>'Forwarded to Director by joint Director',
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
								'file_status'=>'Forwarded to GIS DA by joint Director',
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

    function get_director(){
		$q=$this->db->get_where('pen_members',array('desg_code'=>1004));
		$result=$q->result();
		return $result[0]->member_code;
	}

	  function save_fwd_to_gis_superintendent_after_final()
	 {
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
					'branch'=>'GIS Superintendent',
					'file_status'=>'Forwarded to GIS Superintendent By JDAP After Final',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to GIS Superintendent By JDAP After Final','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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