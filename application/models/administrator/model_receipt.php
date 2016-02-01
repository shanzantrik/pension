<?php
class Model_receipt extends CI_Model {
	function __construct() {
		parent:: __construct();
	}

	function add_receipt() {
		//pension_receipt_register_master entry
		$member_code=$this->session->userdata('member_code');
		$dfno=$this->security->xss_clean($this->input->post('dfno'));
		$branchcode=$this->security->xss_clean($this->input->post('branch_code'));
		$aloc_date=$this->security->xss_clean(date('Y-m-d'));
		$subject=$this->security->xss_clean($this->input->post('subject'));
		$rdate=$this->security->xss_clean($this->input->post('rdate'));
		$address_department=$this->security->xss_clean($this->input->post('address_department'));
		$district=$this->security->xss_clean($this->input->post('district'));
		$prrm=array('slno'=>$this->model_receipt->getMax_dfno(), 'dept_forw_no'=>$dfno, 'receipt_date'=>$rdate, 'subject'=>$subject, 'branch_code'=>$branchcode, 'allocated_date'=>$aloc_date, 'member_code'=>$this->session->userdata('member_code'),'address_department'=>$address_department,'district'=>$district);

		//pension_receipt_file_master entry
		$emp=$this->security->xss_clean($this->input->post('emp'));
		$b_code=$this->security->xss_clean($this->input->post('b_code'));
		$fname=$this->security->xss_clean($this->input->post('fname'));
		$designation=$this->security->xss_clean($this->input->post('des'));
		$salutation=$this->security->xss_clean($this->input->post('sal'));
		$remarks=$this->security->xss_clean($this->input->post('remarks'));
		$date=date('y-m-d'); //keeping the date in yy-mm-dd format
		$prfm = '';
		$token = '';
		$p=0;
		$file_tracking_details ='';

		for($i=0; $i<count($emp); $i++){
			if($i==0) {
				$fmsn = $this->model_receipt->getMax_no($b_code[$i])+$i;
			}else{
				$fmsn = $this->model_receipt->getMax_no($b_code[$i]);
			}
			###################
			$abd=$this->model_receipt->getTotal($b_code[$i]);//14
		    $lst_no=$this->model_receipt->getLastNo($b_code[$i]);//last no
            $file1 =$this->model_receipt->getfile_format($fmsn,$b_code[$i]);

		    $v=explode("/",$file1);//
			$b=(explode("-",$v[3]));
			if(!empty($abd)) {
			  	if($abd==$b[0]) {
			 		$lst_no++;
			 	} else {
			 		$lst_no=1;
			 	}
		    } else {
		   		$lst_no=1;
	        }

			$file = $this->model_receipt->getfinal_file_format($file1,$lst_no);
			##########
			$trtn = $this->model_receipt->getMaxToken()+$i;
			
			$token_format=$this->model_receipt->Token_format($trtn);
			
			//$file=mysql_real_escape_string($b_code[$i]).'/'.mysql_real_escape_string($this->model_receipt->getMax_no($b_code[$i])+$i);
			$auto=$this->get_dept_short_code($branchcode).'-'.$date.'/'.$fmsn;
			$prfm.= '("'.$fmsn.'", "'.$auto.'", "'.$designation[$i].'", "'.$salutation[$i].'", "'.$remarks[$i].'", "'.$file.'", "'.$dfno.'", "'.$emp[$i].'", "'.$fname[$i].'", "'.$this->session->userdata('member_code').'", "processing", "'.$rdate.'","'.$b_code[$i].'"),';
			$token.= '("'.$token_format.'", "'.$file.'", "Received"), ';
			$file_tracking_details.= '("'.$file.'", "Receipt","Received at Receipt","'.$member_code.'"), ';
			$this->db->query("INSERT INTO pension_receipt_file_master (`srl_No`, `auto_file_no`, `designation`, `salutation`, `remarks`, `file_No`, `dept_forw_no`, `emp_code`, `pensionee_name`,  `member_code`, `file_status`,`receipt_date`,`branch_code`) VALUES ".substr(trim('("'.$fmsn.'", "'.$auto.'", "'.$designation[$i].'", "'.$salutation[$i].'", "'.$remarks[$i].'", "'.$file.'", "'.$dfno.'", "'.$emp[$i].'", "'.$fname[$i].'", "'.$this->session->userdata('member_code').'", "processing", "'.$rdate.'","'.$b_code[$i].'"),'), 0, -1)).";";
		}

		if($this->check($dfno)>0) {
			return 'PK';
		} else {
			$this->db->trans_begin();
			//$this->db->query("INSERT INTO pension_receipt_file_master (`srl_No`, `auto_file_no`, `designation`, `salutation`, `remarks`, `file_No`, `dept_forw_no`, `emp_code`, `pensionee_name`,  `member_code`, `file_status`,`receipt_date`,`branch_code`) VALUES ".substr(trim($prfm), 0, -1)).";";
			$this->db->query("INSERT INTO token_reciept (`token_no`, `file_No`, `token_status`) VALUES ".substr(trim($token), 0, -1)).";";
			$this->db->query("INSERT INTO file_tracking_details (`file_no`, `branch`, `file_status`,`member_code`) VALUES ".substr(trim($file_tracking_details), 0, -1)).";";
			$this->db->insert('pension_receipt_register_master',$prrm);
			$this->db->trans_complete();
		}

		/*if($this->check($dfno)>0) {
			return 'PK';
		} else {
			$this->db->trans_begin();
			$this->db->insert('pension_receipt_register_master',$prrm);
			$this->db->query("INSERT INTO pension_receipt_file_master (`srl_No`, `auto_file_no`, `designation`, `salutation`, `remarks`, `file_No`, `dept_forw_no`, `emp_code`, `pensionee_name`,  `member_code`, `file_status`,`receipt_date`,`branch_code`) VALUES ".substr(trim($prfm), 0, -1)).";";
			$this->db->query("INSERT INTO token_reciept (`token_no`, `file_No`, `token_status`) VALUES ".substr(trim($token), 0, -1)).";";
			$this->db->query("INSERT INTO file_tracking_details (`file_no`, `branch`, `file_status`,`member_code`) VALUES ".substr(trim($file_tracking_details), 0, -1)).";";
			$this->db->trans_complete();
		}*/

		if ($this->db->trans_status() === FALSE) {
		    return 'false';
		} else {
		    return 'true';
		}
	}

	function getfinal_file_format($file1,$file_no)
	{
		$reg1=$file1."/".$file_no;
		return $reg1;
	}

	function get_dept_short_code($dept_code){
		$q=$this->db->get_where('master_department',array('dept_code'=>$dept_code));
		$result=$q->result();
		$x=$result[0]->dept_short_code;
		return $x;
	}

	function lastFiveDFN()
	{
		$this->db->select('dept_forw_no');
		$this->db->order_by("modified_date", "desc");
		$q = $this->db->get('pension_receipt_register_master', 5);
		return $q->result_array();
	}

	function saveFileDetails($data){
		if($this->db->insert('pension_receipt_file_master',$data)) {
			return true;
		} else {
			return false;
		}
	}

	function saveToken($token){
		$this->db->insert('token_reciept', $token);
	}
	
	/*function getMax_no()
	{
		$this->db->select_max('srl_No');
	    $result = $this->db->get('pension_receipt_file_master');
	    $row = $result->result();
	    if($row[0]->srl_No == ''){
	    	return "1000";
	    } else {
	    	return $row[0]->srl_No+1;
	    }
	 }
*/	
     function Token_format($trtn)
	 {
	 $current_month=mysql_real_escape_string(date('m'));
	 $last_month=3;
	 if($current_month>$last_month)
	    { 
		$yr=date('y')+1;
		$yr1=date('y');
		$token=$trtn."/".$yr1."-".$yr;
		return $token;
		}
		else if($current_month<=$last_month)
		{
		$yr=date('y')-1;
		$yr1=date('y');
		$token=$trtn."/".$yr."-".$yr1;
		return $token;
		}
	 }
	function getfile_format($fmsn,$branch_code)
	{  
		$current_month=mysql_real_escape_string(date('m'));
		$last_month=3;
		if($branch_code==1001)//pension
	  {
		if($current_month>$last_month)
	    { 
		$yr=date('y')+1;
		$yr1=date('y');
		$reg="Pen/AP/".$fmsn."/".$yr1."-".$yr;
		return $reg;
		}
		else if($current_month<=$last_month)
		{
		$yr=date('y')-1;
		$yr1=date('y');
		$reg="Pen/AP/".$fmsn."/".$yr."-".$yr1;
		return $reg;
		}

	}else if($branch_code==1003){//ips
	  if($current_month>$last_month)
	    { 
		$yr=date('y')+1;
		$yr1=date('y');
		$reg="DAP/IPS/".$fmsn."/".$yr1."-".$yr;
		return $reg;
		}
		else if($current_month<=$last_month)
		{
		$yr=date('y')-1;
		$yr1=date('y');
		$reg="DAP/IPS/".$fmsn."/".$yr."-".$yr1;
		return $reg;
		}
	}else if($branch_code==1004)//gis)
	{
	 if($current_month>$last_month)
	    {		
		$yr=date('y')+1;
		$yr1=date('y');
		$reg="Pen/GIS/".$fmsn."/".$yr1."-".$yr;
		return $reg;
		}
		else if($current_month<=$last_month)
		{
		$yr=date('y')-1;
		$yr1=date('y');
		$reg="Pen/GIS/".$fmsn."/".$yr."-".$yr1;
		return $reg;
		}

	}
				
    }
	  function getLastNo($branch_code){
	    if($branch_code==1001)//pension
	  {
		$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "1";
			}else{
		$ab=explode("/",$row[0]->file_No);
		return $ab[4];
		}
      
      }else if($branch_code==1003){
	  $this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "1";
			}else{
		$ab=explode("/",$row[0]->file_No);
		return $ab[4];
		}
	  }else if($branch_code==1004){
	  $this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "1";
			}else{
		$ab=explode("/",$row[0]->file_No);
		return $ab[4];
		}
	  }
	  }
     function getTotal($branch_code)
	{         
		if($branch_code==1001)//pension
	  {
		/*$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code[0]));
	    $row = $result->result();
	    return $row;*/
		$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "";
			}else{
		$ab=explode("/",$row[0]->file_No);
		$a=explode("-",$ab[3]);
		return $a[0];
     }
	 }
	  else if($branch_code==1003)
	  {
		/*$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code[0]));
	    $row = $result->result();
	    return $row;*/
		$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "";
			}else{
		$ab=explode("/",$row[0]->file_No);
		$a=explode("-",$ab[3]);
		return $a[0];
     }
	  }
	  else if($branch_code==1004)
	  {
		/*$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code[0]));
	    $row = $result->result();
	    return $row;*/
		$this->db->select_max('file_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
		if($row[0]->file_No == '') {
	    	return "";
			}else{
		$ab=explode("/",$row[0]->file_No);
		$a=explode("-",$ab[3]);
		return $a[0];
     }

	  }
	  //return "76776";
	  }
 function getMax_no($branch_code)
	{          
		if($branch_code==1001)//pension
	  {
	    $this->db->select_max('srl_No');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
	    if($row[0]->srl_No == ''){
	    	return "34778";
	    } else {
	    	return $row[0]->srl_No+1;
	    }
      }
	  else if($branch_code==1003)//ips
	  {
	     $this->db->select_max('srl_No');
	    //$result = $this->db->get('pension_receipt_file_master');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
	    if($row[0]->srl_No =='') {
	    	return "24778";
	    } else {
	    	return $row[0]->srl_No+1;
	    }
	  }
	  else if($branch_code==1004)//gis
	  {
	     $this->db->select_max('srl_No');
	    //$result = $this->db->get('pension_receipt_file_master');
		$result=$this->db->get_where('pension_receipt_file_master',array('branch_code'=>$branch_code));
	    $row = $result->result();
	    if($row[0]->srl_No == '') {
	    	return "14778";
	    } else {
	    	return $row[0]->srl_No+1;
	    }
	  }
	}


	function getMax_dfno() {
		$this->db->select_max('slno');
	    $result = $this->db->get('pension_receipt_register_master');
	    $row = $result->result();
	    if($row[0]->slno == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->slno+1;
	    }
	}

	function getMaxToken() {
		$this->db->select_max('srl_No');
	    $result = $this->db->get('token_reciept');
	    $row = $result->result();
	    if($row[0]->srl_No == '') {
	    	return "1";
	    } else {
	    	return $row[0]->srl_No+1;
	    }
	}

	function saveDfnoMaster($data,$dfno){
    	if($this->check($dfno)>=1) {
    		return "PK_ERROR";
    	} else {
    		$this->db->insert('pension_receipt_register_master',$data);
    	}

	}

	function check($dfno){
		$result=$this->db->query("SELECT count(dept_forw_no) as nos from pension_receipt_register_master where dept_forw_no='$dfno'");
	    $row = $result->result();
	    return $row[0]->nos;
	}
	
	function search($dfno){
		$sql="select a.dept_forw_no as dfno, a.receipt_date as receipt_date,a.subject as subject,a.branch_code as branch_code,a.allocated_date as allocated_date, b.dept_name as branch_name,a.address_department as address_department,a.district as district from pension_receipt_register_master a,master_department b where a.branch_code=b.dept_Code and a.dept_forw_no='$dfno'";
		
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function search_file($dfno){
		$this->db->where('dept_forw_no', $dfno);
		$query=$this->db->get('pension_receipt_file_master');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function update($srl,$data){
		$this->db->where('srl_No',$srl);
		$this->db->update('pension_receipt_file_master', $data);
	}
	
	function edit($srl){
		$this->db->where('srl_No', $srl);
		$query=$this->db->get('pension_receipt_file_master');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function getTokenNo($file_no){
		$this->db->where('file_No', $file_no);
		$query=$this->db->get('token_reciept');
		$row = $query->result();
	    return $row;
		/*$token=0;
		foreach($query ->result() as $key)
		{
			$token=$key->token_no;
		}*/
		//return $token;
	}
	function getDept($file_no){
	    $this->db->select('*');
        $this->db->from('pension_receipt_file_master');
	    //$this->db->where(array('status' => $status));
    	$query = $this->db->get();
    	return $query->result_array();
	}
	
	function update_token($file_No,$token){
		$this->db->where('token_no', $token);
		$this->db->update('token_reciept', array('file_No'=>$file_No));
	}

	function getBranch(){
		$data=array('1001','1003','1004','1008','1009','1010','1005');
		$this->db->where_in('branch_code',$data);
		$q=$this->db->get('master_branch');
		return $q->result();
	}
	// function getFileDetail($file_no) {
	// 	$this->db->select('*');
 //    	$this->db->from('pension_receipt_file_master');
 //    	$this->db->where(array('pension_receipt_file_master.file_No' => $file_no));
	// 	$this->db->join('pensioner_files_details', 'pensioner_files_details.case_no = pension_receipt_file_master.file_No', 'left');
	// 	$query = $this->db->get();
 // 		return $query->result_array();
	// }


	function getFileDetail($file_no) {
		$q=$this->db->get_where('pension_receipt_file_master',array('file_No'=>$file_no));
    	$result = $q->result_array();
    	return $result;
		//$this->db->join('pensioner_files_details', 'pensioner_files_details.case_no = pension_receipt_file_master.file_No', 'inner');
	}

	function getFiles($file_no) {
		$this->db->select('*');
    	$this->db->from('pensioner_files_details');
    	$this->db->where(array('case_no' => $file_no));
    	$query = $this->db->get();
    	return $query->result_array();
	}
	function all_file($status)
	{
	$this->db->select('*');
    $this->db->from('master_document');
	$this->db->where(array('status' => $status));
    	$query = $this->db->get();
    	return $query->result_array();
	}

	function getFileByForwNo($forw_no)
	{
		
	}
	
}