<?php 
class Model_gis_superintendent extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	 
	 function getAll_file_DA()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d where b.file_No=d.file_No and a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to GIS_Superintendent By GIS DA'");
    	$result = $q->result();
 		return $result;
	 }

	 function getFilterDA($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d, pension_receipt_register_master e where b.file_No=d.file_No and a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to GIS_Superintendent By GIS DA' and b.dept_forw_no=e.dept_forw_no and e.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	 function getfile_from_jdap_after_approval()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to GIS Superintendent By JDAP After Approval'");
    	$result = $q->result();
 		return $result;
	 }

	 function getFiletrJD_after_approval($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where a.file_no=b.file_No and a.status='Forwarded to GIS Superintendent By JDAP After Approval' and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	  function getfile_from_gisda_for_final()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to GIS_Superintendent By GIS DA After Approval'");
    	$result = $q->result();
 		return $result;
	 }

	 function getFilterGISDAFinal($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where a.file_no=b.file_No and a.status='Forwarded to GIS_Superintendent By GIS DA After Approval' and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }

	   function getfile_from_jdap_after_final()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to GIS Superintendent By JDAP After Final'");
    	$result = $q->result();
 		return $result;
	 }

	   function getFilterJD_after_final($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where a.file_no=b.file_No and a.status='Forwarded to GIS Superintendent By JDAP After Final' and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }

	  	function getAll_file_DA_has_obj()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c where a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to GIS_Superintendent By GIS DA' and c.claim_status='incomplete' ");
    	$result = $q->result();
 		return $result;
	 }

	 function getFilterObj($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c, pension_receipt_register_master d where a.file_no=b.file_No and b.file_No=c.file_no and a.status='Forwarded to GIS_Superintendent By GIS DA' and c.claim_status='incomplete' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	 

	 
	  function save_fwd_to_jdap_fr_final()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk1'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk1'])==true){
			$chk=$_POST['chk1'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'JDAP',
					'file_status'=>'Forwarded to JDAP By GIS Superintendent for Final',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to JDAP By GIS Superintendent for Final','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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

	 
	 function save_fwd_to_jdap()
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
						if($this->checklist_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to Director',
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
			#################### joint director ##################
			else if($to=='jd'){
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
						if($this->checklist_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to joint Director by Gis Superintendent',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'gis_Forwarded to joint Director','notification'=>'pending','allocated_date'=>$allocated_date);
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
      ############# FAO ###########################
	  			else if($to=='fao'){
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
						if($this->checklist_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to FAO by Gis Superintendent',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'gis_Forwarded to FAO','notification'=>'pending','allocated_date'=>$allocated_date);
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

			
			
}
			
	function get_director(){
		$q=$this->db->get_where('pen_members',array('desg_code'=>1004));
		$result=$q->result();
		return $result[0]->member_code;
	}

	 	/*$allocated_date=date('Y-m-d');
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
					'file_status'=>'Forwarded to JDAP By GIS Superintendent for Approval',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to JDAP By GIS Superintendent for Approval','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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
*/	// }

	function checklist_entry($file_no){
		$q=$this->db->get_where('checklist',array('file_no'=>$file_no));
		if($q->num_rows()>0){
			return 'entered';
		}
		else{
			return 'not_entered';
		}
	}

	 function save_forwrd_to_GIS_da_after_approval()
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
					'branch'=>'GIS DA',
					'file_status'=>'Forwarded to GIS DA by GIS superintendent after Approval',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to GIS DA by GIS superintendent after Approval','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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
         function save_fwd_to_gisda_obj()
	  {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk_obj'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk_obj'])==true){
			$chk=$_POST['chk_obj'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'GIS DA',
					'file_status'=>'Forwarded to GIS DA by GIS superintendent For Objection File',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to GIS DA by GIS superintendent For Objection File','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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

	 
	  function save_fwd_to_gisda_after_final()
	 {
	 	$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$member_code=$this->session->userdata('member_code');
		$chk=@$_POST['chk2'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk2'])==true){
			$chk=$_POST['chk2'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>'GIS DA',
					'file_status'=>'Forwarded to GIS DA by GIS superintendent after Final',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to GIS DA by GIS superintendent after Final','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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