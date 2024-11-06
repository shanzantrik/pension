<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Superandant extends CI_Model {
	function getData(){
		$fdt=trim($_GET['fdt']);
		$tdt=trim($_GET['tdt']);
	
		$sql="SELECT *,a.branch_code as bc from 
		pension_receipt_file_master a,token_reciept b,pension_receipt_register_master d 
		WHERE d.receipt_date between '$fdt' AND '$tdt' 
		AND a.file_No=b.file_No  
		AND a.dept_forw_no=d.dept_forw_no 
		AND a.file_No NOT IN (select file_no from file_status) order by d.receipt_date";
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function getAll(){
		$sql="SELECT * from 
		pension_receipt_file_master a,token_reciept b,pension_receipt_register_master d 
		WHERE a.file_No=b.file_No  
		AND a.dept_forw_no=d.dept_forw_no 
		AND a.file_No NOT IN (select file_no from file_status) order by d.receipt_date";
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

	}

	function getDealAsst($branch_code){
		$query=$this->db->get_where("pen_members",array('Branch_Code'=>$branch_code,'member_type_code'=>1004));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	function getBranch(){
		$b_code=$this->session->userdata("branch_code");
		$query=$this->db->query("SELECT * from master_branch where Branch_Code!=$b_code");
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	//this function will return Branch name according to the perameter
	function getBranch_forwrd($branch_code){
		$q=$this->db->get_where('master_branch',array('branch_code'=>$branch_code));
		$result=$q->result();
		return $result[0]->Branch_Name;
	}

	function getMax_file_status() {
		$this->db->select_max('id');
	    $result = $this->db->get('file_status');
	    $row = $result->result();
	    if($row[0]->id == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->id+1;
	    }
	}
	function getSuperandant($branch_code){

		$q=$this->db->get_where('pen_members',array('branch_code'=>$branch_code,'member_type_code'=>1001));
		$result=$q->result();

		return $result[0]->member_code;
		
	}
	function getBranch1($file_no){
		$q=$this->db->get_where('pension_receipt_file_master',array('file_No'=>$file_no));
		$result=$q->result();
		return $result;

	}
	function save_fwd_to_ipsda()
	{
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
						'branch'=>'IPS',
						'file_status'=>'Forwarded to IPS From Receipt',
						'member_code'=>$member_code
						);
				//$data=array('status'=>'Forwarded to IPS','notification'=>'pending','allocated_date'=>$allocated_date,'member_code'=>$member_code);
				$data=array(
					'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a],
						'branch_code'=>1003,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to IPS From Receipt'
						);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->insert('file_status',$data);
				//$this->db->update('file_status',array('status'=>'Forwarded to IPS From Receipt','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
				
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
	function save_fwd_to_gisda()
	{
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
						'branch'=>'GIS',
						'file_status'=>'Forwarded to GIS From Receipt',
						'member_code'=>$member_code
						);
				//$data=array('status'=>'Forwarded to IPS','notification'=>'pending','allocated_date'=>$allocated_date,'member_code'=>$member_code);
				$data=array(
					'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a],
						'branch_code'=>1004,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to GIS From Receipt'
						);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->insert('file_status',$data);
				//$this->db->update('file_status',array('status'=>'Forwarded to IPS From Receipt','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
				
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
	function save_fwd_to_Pensionda()
	{
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
				$data=array(
					    'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a],
						'branch_code'=>$x,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to Concern Dealing Assistant'
						);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->insert('file_status',$data);
//$this->db->update('file_status',array('status'=>'To DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$x));
				//$this->db->insert('concern_da',array('file_no'=>$chk[$a],'da'=>$member_code));	
				//$reg=$this->registration_generation($chk[$a]);
				//$this->db->where('file_No',$chk[$a]);
				//$this->db->update('pension_receipt_file_master',array('registration_no'=>$reg));
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
	function get_branch_code($member_code)
	{
		$q=$this->db->get_where('pen_members',array('member_code'=>$member_code));
		$result=$q->result();
		$x=$result[0]->Branch_Code;
		return $x;
	}
	function save_forwarding(){
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
				$x=$this->getBranch1($chk[$a]);
				$bcc=$x[0]->branch_code;
				if($bcc==1003){		//IPS CASE
					$data=array(
						'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a],
						'branch_code'=>1010,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to IPS From Receipt'
						);
					$file_tracking=array(
						'file_no'=>$chk[$a],
						'branch'=>'IPS',
						'file_status'=>'Forwarded to IPS From Receipt',
						'member_code'=>$member_code
						);
					$this->db->insert('file_status',$data);
					$this->db->insert('file_tracking_details',$file_tracking);
				}
				if($bcc==1001){		//PENSION and Will Forowarded To Marking Superintendent
					$data=array(
						'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a] ,
						'branch_code'=>0,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						//'status'=>'Forwarded to Pension DA'
						'status'=>'Forwarded to Marking Superintendent'
						);
					$file_tracking=array(
						'file_no'=>$chk[$a],
						'branch'=>$this->getBranch_forwrd($branch_code),
						//'file_status'=>'Forwarded to Pension DA',
						'file_status'=>'Forwarded to Marking Superintendent',
						'member_code'=>$member_code
						);
					$this->db->insert('file_status',$data);
					$this->db->insert('file_tracking_details',$file_tracking);
				}

				if($bcc==1004){ //GIS
					$data=array(
						'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a] ,
						'branch_code'=>1012,
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to GIS From Receipt'
						);
					$file_tracking=array(
						'file_no'=>$chk[$a],
						'branch'=>'IPS',
						'file_status'=>'Forwarded to GIS From Receipt',
						'member_code'=>$member_code
						);
					$this->db->insert('file_status',$data);
					$this->db->insert('file_tracking_details',$file_tracking);
				}
				if($bcc==1005){		//Others
					$data=array(
						'id'=>$this->getMax_file_status(),
						'file_no'=>$chk[$a] ,
						'branch_code'=> 5000, //MUST CHANGE
						'allocated_date'=>$allocated_date,
						'member_code'=>$member_code,
						'status'=>'Forwarded to Others From Receipt'
						);
					$file_tracking=array(
						'file_no'=>$chk[$a],
						'branch'=>'IPS',
						'file_status'=>'Forwarded to Others From Receipt',
						'member_code'=>$member_code
						);
					$this->db->insert('file_status',$data);
					$this->db->insert('file_tracking_details',$file_tracking);
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
	function is_terminated($file_no){
		$q=$this->db->get_where('file_status', array('file_no'=>$file_no));
		$result=$q->result();
		if(count($result) > 0) :
			return $result[0]->notification;
		else :
			return '';
		endif;
	}

	function getAllocateData(){
		$fdt=@$_GET['fdt'];
		$tdt=@$_GET['tdt'];
		//$da=@$_GET['da'];
		$branch=@$_GET['branch'];
			/*if(empty($fdt) || empty($tdt)){
				$sql="select a.*,b.timestamp as timestamp,c.token_no as token_no,d.branch_code from pension_receipt_file_master a,file_status b,token_reciept c,file_status d where a.file_No=b.file_no and a.file_No=c.file_No  and a.file_No = d.file_no AND a.branch_code=$branch";
			
			}else
			{
				$sql="select a.*,b.timestamp as timestamp,c.token_no as token_no from pension_receipt_file_master a,file_status b,token_reciept c,file_status d where a.file_No=b.file_no and a.file_No=c.file_No  and a.receipt_date between '$fdt' and '$tdt' and a.file_No = d.file_no AND a.branch_code=$branch";
			}*/
			if(empty($fdt) || empty($tdt)){
				$sql="select a.*,c.token_no as token_no from pension_receipt_file_master a,token_reciept c where a.file_No=c.file_No AND a.branch_code=$branch";
			} else {
				$sql="select a.*,c.token_no as token_no from pension_receipt_file_master a,token_reciept c where a.file_No=c.file_No and a.receipt_date between '$fdt' and '$tdt' AND a.branch_code=$branch";
			}
			$query=$this->db->query($sql);
			if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }
	        return false;
		
	}

}
	