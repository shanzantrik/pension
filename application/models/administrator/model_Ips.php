<?php 
class Model_Ips extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function add_ips($file_no) {
		extract($_POST);
		$data = array(
			
			'file_no'=>$file_no,
			'date'   =>$entry,
			'receipt_date' =>$receipt_date,
			'name'=>$name,
			'designation'=>$designation,
			'appointment_date'=>$appointment,
			'appoint_as' =>$appoint_as,
			'pay_scale' =>$scale,
			'regularization_date' =>$regularization,
			'department'=>$dept,
			'dob'=>$dob,
			'dor'=>$dor,
			'pre_revised_pay_commission'=>$pre_revised_pay_commission,
			'exist_bp'=>$exist_bp,
			'pre_revised'=>$pre_revised,
			'revised'=>$revised,
			'pay_fixed'=>$fixed_pay,
			'effect_from'=>$effect_from,
			'dni_on'=>$DNI_on,
			//'remark1'=>$remark1,
			'remark2'=>$earlier,
			'remark3' =>$observation,
			'remark4'=>$additional,
			'remark5'=>$ips,
			'remarks6'=>$higher,
			'remarks7'=>$identical,
			'remarks8'=>$pay_fixed,
			'remarks9'=>$stepping,
			'remarks10'=>$time_bound,
			'remarks11'=>$upgradation,
			'remarks12'=>$acps,
			'remarks13'=>$macps,
			'remarks14'=>$family_planning,
			'remarks15'=>$suspension,
			'remarks16'=>$break,
			'remarks17'=>$dies_non,
			'remarks18'=>$withholding,
			'remarks19'=>$eol,
			'remarks20'=>$increments,
			'remarks21'=>$information,
			'remarks22'=>$last_pay,
			'remarks23'=>$remarks




		);
        $scale_details = array();
       	for($i=0;$i<count($_POST['particulars']);$i++) {
		
			
			$particulars_info = array();
			$particulars_info['date'] = $_POST['date'][$i];
			$particulars_info['particulars'] = $_POST['particulars'][$i];
			$particulars_info['scale_pay'] = $_POST['scale_pay'][$i];
			$particulars_info['identical'] = $_POST['identical'][$i];
			
		
			array_push($scale_details, $particulars_info);
	 	}
	 	$scale_info = "('".$file_no."', '".serialize($scale_details)."')";
	 	$this->db->trans_begin();
		$this->db->insert('pensioner_ips_details', $data);
		$this->db->query("INSERT INTO ips_scale_info (`file_no`, `scale_info`) VALUES ".trim($scale_info));
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    return false;
		    } else {
			return true;
		}
		
	}
	
	function get_file_from($file_No) {
		$this->db->select('*');
    	$this->db->from('file_tracking_details');
    	$this->db->where(array('file_no'=>$file_No));
    	$result = $this->db->get();
		$status = false;
		if(count($result->result_array()) > 0) {
			foreach($result->result_array() as $row) {
				if($row['file_status'] == 'Received by IPS DA from Pension') :
					$status = true;
					break;
				endif;
			}
		} else {
			$status = false;
		}
		return $status;
	}

	 function ips_update($file_No){
	 	
    	extract($_POST);
		$data = array(
            'file_no'=>$file_no,
			'date'   =>$entry,
			'receipt_date' =>$receipt_date,
			'name'=>$name,
			'designation'=>$designation,
			'appointment_date'=>$appointment,
			'appoint_as' =>$appoint_as,
			'pay_scale' =>$scale,
			'regularization_date' =>$regularization,
			'department'=>$dept,
			'dob'=>$dob,
			'dor'=>$dor,
			'pre_revised_pay_commission'=>$pre_revised_pay_commission,
			'exist_bp'=>$exist_bp,
			'pre_revised'=>$pre_revised,
			'revised'=>$revised,
			'pay_fixed'=>$fixed_pay,
			'effect_from'=>$effect_from,
			'dni_on'=>$DNI_on,
			//'remark1'=>$remark1,
			'remark2'=>$earlier,
			'remark3' =>$observation,
			'remark4'=>$additional,
			'remark5'=>$ips,
			'remarks6'=>$higher,
			'remarks7'=>$identical,
			'remarks8'=>$pay_fixed,
			'remarks9'=>$stepping,
			'remarks10'=>$time_bound,
			'remarks11'=>$upgradation,
			'remarks12'=>$acps,
			'remarks13'=>$macps,
			'remarks14'=>$family_planning,
			'remarks15'=>$suspension,
			'remarks16'=>$break,
			'remarks17'=>$dies_non,
			'remarks18'=>$withholding,
			'remarks19'=>$eol,
			'remarks20'=>$increments,
			'remarks21'=>$information,
			'remarks22'=>$last_pay,
			'remarks23'=>$remark23
		
		);
		 $scale_details = array();
       	for($i=0;$i<count($_POST['particulars']);$i++) {
		
			
			$particulars_info = array();
			$particulars_info['date'] = $_POST['date'][$i];
			$particulars_info['particulars'] = $_POST['particulars'][$i];
			$particulars_info['scale_pay'] = $_POST['scale_pay'][$i];
			$particulars_info['identical'] = $_POST['identical'][$i];
			
		
			array_push($scale_details, $particulars_info);
	 	}
	 	$scale_info = array('scale_info'=>serialize($scale_details));
	 	//$scale_info = mysql_real_escap_string(serialize($scale_details),$dbhandle);
	 	//$scale_info = "('".$file_no."', '".serialize($scale_info)."')";
	 	
	 	$this->db->trans_begin();
		$this->db->where('file_no', $file_No);
	    $this->db->update('pensioner_ips_details', $data);
	    $this->db->where('file_no', $file_No);
	    $this->db->update('ips_scale_info', $scale_info);
		//$this->db->query("INSERT INTO ips_scale_info (`file_no`, `scale_info`) VALUES ".trim($scale_info));
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    return false;
		    } else {
			return true;
		}
		
		
    }
	function getall_department()
	 {
	    $this->db->select('*');
    	$this->db->from('master_department');
    	//$this->db->join('master_branch', 'pension_receipt_file_master.Branch_Code = master_branch.Branch_Code', 'inner');
    	//$this->db->where(array('pension_receipt_file_master.Branch_Code' =>1004));
    	$result = $this->db->get();
 		return $result->result_array();
	 }

	 function getips_viewfrom_receipt()
	 {
 		$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details b,pension_receipt_file_master c where a.file_No=b.file_no and c.file_No=b.file_no and c.branch_code='1003'");
    	$result = $q->result();
 		return $result;
	 }
	 function get_department($dept)
	 {
	$q=$this->db->query("SELECT * from master_department a,pensioner_ips_details b where a.dept_code=b.department and b.department='$dept'");
    	$result = $q->result();
 		return $result;
	 }
	 function get_ips_observation($dept)
	 {
//$q=$this->db->query("SELECT * from pensioner_ips_details a,pension_receipt_file_master b where a.file_no=b.file_No and b.dept_forw_no='$dept'");
        $q=$this->db->query("SELECT * from pensioner_ips_details a,pension_receipt_file_master b,master_department c where a.file_no=b.file_No and c.dept_code=a.department and b.dept_forw_no='$dept'");
    	$result = $q->result();
 		return $result;;
	 }
	  function get_ips_observation1($file_No)
	 {
//$q=$this->db->query("SELECT * from pensioner_ips_details a,pension_receipt_file_master b where a.file_no=b.file_No and b.dept_forw_no='$dept'");
        $q=$this->db->query("SELECT * from pensioner_ips_details a,pension_receipt_file_master b,master_department c where a.file_no=b.file_No and c.dept_code=a.department and b.file_no='$file_No'");
    	$result = $q->result();
 		return $result;;
	 }
	  function getips_viewfrom_pension()
	 {
 		//$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details b where a.file_No=b.file_no and a.branch_code='1001'");
		$q=$this->db->query("SELECT * from file_status a,pensioner_ips_details b,pension_receipt_file_master c where a.file_No=b.file_no and c.file_No=b.file_no and   a.branch_code='1001'");
    	$result = $q->result();
 		return $result;
	 }
	 function get_director(){
		$q=$this->db->get_where('pen_members',array('desg_code'=>1004));
		$result=$q->result();
		return $result[0]->member_code;
	}


	function getAll()
	 {
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where a.file_no=b.file_No and a.file_no=c.file_No and a.status='Forwarded to IPS From Receipt'");
    	$result = $q->result();
 		return $result;
	 }

	 function getFilterReceipt($department)
	 {
		$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c, pension_receipt_register_master d where a.file_no=b.file_No and a.file_no=c.file_No and a.status='Forwarded to IPS From Receipt' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	 function getAll2()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where a.file_no=b.file_No and a.file_no=c.file_No and a.status='ips_Forwarded to IPS DA'");
    	$result = $q->result();
 		return $result;
	 }
	 function getFilterDirector($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c, pension_receipt_register_master d where a.file_no=b.file_No and a.file_no=c.file_No and a.status='ips_Forwarded to IPS DA' and b.dept_forw_no=d.dept_forw_no and d.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	  function getAll_from_pension()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to IPS'");
    	$result = $q->result();
 		return $result;
	 }

	 function getFilterPension($department)
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b, pension_receipt_register_master c where a.file_no=b.file_No and a.status='Forwarded to IPS'  and b.dept_forw_no=c.dept_forw_no and c.branch_code=$department");
    	$result = $q->result();
 		return $result;
	 }
	 
	 function get_receipt($file_no)
	 {
		$this->db->select('*');
		$this->db->where('file_no', $file_no);
		$query = $this->db->get('pension_receipt_file_master');
		if($query) {
		 return $query->result_array();
		} else {
			return false;
		}
		
    }
	 function get_ips_detail($serial_no)
	 {
		$this->db->select('*');
		$this->db->where('serial_no', $serial_no);
		$query = $this->db->get('pensioner_ips_details');
		if($query) {
		 return $query->result_array();
		} else {
			return false;
		}
		
    }
	function save_fwd()
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
						if($this->ips_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'IPS', //1004 means director
								'file_status'=>'Forwarded to Director By IPS DA',
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
						if($this->ips_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'IPS', //1004 means director
								'file_status'=>'Forwarded to joint Director by IPS DA',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'ips_Forwarded to joint Director','notification'=>'pending','allocated_date'=>$allocated_date);
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
						if($this->ips_entry($chk[$a])=='entered')
					   {
					   	$file_tracking=array(
								'file_no'=>$chk[$a],
								'branch'=>'GIS', //1004 means director
								'file_status'=>'Forwarded to FAO by IPS DA',
								'member_code'=>$this->session->userdata('member_code')
							);
							$data=array('status'=>'ips_Forwarded to FAO','notification'=>'pending','allocated_date'=>$allocated_date);
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
   function ips_entry($file_no){
		$q=$this->db->get_where('pensioner_ips_details',array('file_no'=>$file_no));
		if($q->num_rows()>0){
			return 'entered';
		}
		else{
			return 'not_entered';
		}
	}

    function get_ips_detail2($file_no)
	 {       
      $this->db->select('*');
      $this->db->from('pensioner_ips_details');
      $this->db->where(array('pensioner_ips_details.file_no' =>$file_no));
      $this->db->join('file_status','file_status.file_no = pensioner_ips_details.file_no', 'left');
      $this->db->join('ips_scale_info','ips_scale_info.file_no = file_status.file_no', 'left');
      $query = $this->db->get();
      return $query->result_array();
    }
	  function get_ips_pre_revised($file_no)
	 {
 	    $this->db->select('pre_revised');
		$this->db->where('file_No', $file_no);
		$query = $this->db->get('pensioner_ips_details');
		if($query->num_rows() > 0)
	    {
		 $row = $query->row();
			return $row->pre_revised;
		} else {
			return "";
		}
    }
	  function getpre_revised_value($pre_revised_id)
	 {
        //$payCommission = $this->input->post('payCommission');
		
		$this->db->select('*');
    	$this->db->from('master_pay_scale');
    	$this->db->where(array('id'=>$pre_revised_id));
    	$result = $this->db->get();
		return $result->result_array();
		
		
		
	 /* $this->db->select('*');
      $this->db->from('pensioner_ips_details');
      $this->db->where(array('pensioner_ips_details.file_no' =>$file_no));
      $this->db->join('file_status', 'file_status.file_no = pensioner_ips_details.file_no', 'left');
      $query = $this->db->get();
      return $query->result_array();*/
    	
    }
	
       function get_ips_report($file_no)
	 {

	 	//echo "SELECT * FROM pensioner_ips_details where file_no='".$file_no."'";
	     
		$this->db->select('*');
		$this->db->where('file_no',$file_no);
		$query = $this->db->get('pensioner_ips_details');
		if($query)
		{
		return $query->result_array();
		}
		else
		{
		return false;
		}
       
    }
	function del($dept_code)
	{
		$q = $this->db->delete('master_department', array('dept_code' => $dept_code));
		if($q)
		{
		   return true;
		} else {
		  return false;
		}
	}

	function fetchData($Branch_Code, $serial_no,$file_No){

		if ($serial_no==0){ 
			//receipt
	 		$query = $this->db->get_where('pension_receipt_file_master', array('file_No'=>$file_No));
	 		return $query->result_array();
 	    } 
 	    else
 	    {
 	    	//pension
          $this->db->select('*');
          $this->db->from('pensioner_personal_details');
          $this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
          $this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
          $this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_service_details.serial_no', 'left');
          $this->db->join('master_pay_scale', 'master_pay_scale.id = pensioner_pay_details.pay_scale', 'left');
          //$this->db->join('master_department', 'master_department.dept_code = pensioner_personal_details.department', 'left');
         //$this->db->join('pensioner_pay_details`', 'pensioner_pay_details`.serial_no = pensioner_personal_details.serial_no', 'left');
            
			$query = $this->db->get();
 			return $query->result_array();
 	    } 
 	}
 	
function fetchData1($Branch_Code, $serial_no,$file_No){

		if ($serial_no==0){ 
			//receipt
	 		$query = $this->db->get_where('pension_receipt_file_master', array('file_No'=>$file_No));
	 		return $query->result_array();
 	    } 
 	    else
 	    {
 	    	//pension
          $this->db->select('*');
          $this->db->from('pensioner_personal_details');
          $this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
          $this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no', 'left');
          $this->db->join('pensioner_pay_details', 'pensioner_pay_details.serial_no = pensioner_service_details.serial_no', 'left');
          $this->db->join('master_pay_scale', 'master_pay_scale.id = pensioner_pay_details.pay_scale', 'left');
         // $this->db->join('master_department', 'master_department.dept_code = pensioner_personal_details.department', 'left');
          //$this->db->join('pensioner_pay_details`', 'pensioner_pay_details`.serial_no = pensioner_personal_details.serial_no', 'left');
            
			$query = $this->db->get();
 			return $query->result_array();
 	    } 
 	}


 	function get_branch_code($file_No) {
		$this->db->select('branch_code');
		$this->db->where('file_no', $file_No);
		$query = $this->db->get('file_status');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->branch_code;
		} else {
			return "";
		}
	}
	function get_dept($serial_no) {
		$this->db->select('');
		$this->db->where('file_No', $file_No);
		$query = $this->db->get('pension_receipt_file_master');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->Branch_Code;
		} else {
			return "";
		}
	}
	function get_serial_no($file_No) 
	{
		$file_No=trim($file_No);
		$sql="SELECT * from pensioner_personal_details where case_no='$file_No'";
		//echo $sql;
		$sqls=$this->db->query($sql);
		$x=$sqls->result_array();
		if($sqls->num_rows()>0){
			return $x[0]['serial_no'];
		}else{
			return 0;
		}
		
	}
	function get_serial_no1($file_No) 
	{
		$this->db->select('');
		$this->db->where('file_No', $file_No);
		$query = $this->db->get('pension_receipt_file_master');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->file_No;
			//return $row->srl_No;
		} else {
			return "";
		}
		
	}
	function check_serial_no($serial_no) 
	{
		$this->db->select('file_no');
		$this->db->where('file_no', $serial_no);
		$query = $this->db->get('pensioner_ips_details');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->file_no;
		} else {
			return "";
		}
	}
	
	function getData($limit, $start)	{
		$this->db->limit($limit, $start);
		$query=$this->db->get('master_department');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

 	//function fetchData($dept_code) {
 		//$query = $this->db->get_where('master_department', array('dept_code' => $dept_code));
 		//return $query->result_array();
 	//}
 
 	function record_count() {
        return $this->db->count_all("master_department");
    }

    function update(){
    	extract($_POST);
		$data = array(
			'dept_code'=>$dept_code,
			'dept_name'=>$dept_name,
			'description'=>$description,
			'member_code'=>$this->session->userdata('member_code')
		);
		$this->db->where('dept_code', $dept_code);
		$up = $this->db->update('master_department', $data); 
		if($up) {
			return true;
		} else {
			return false;
		}
    }

	function getMax_dept_code() {
		$this->db->select_max('dept_code');
	    $result = $this->db->get('master_department');
	    $row = $result->result();
	    if($row[0]->dept_code == '') {
	    	return "1000";
	    } else {
	    	return $row[0]->dept_code+1;
	    }
	}
	function save_forwrd_issue_file(){
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
					'branch'=>'IPS',
					'file_status'=>'Forwarded to Issue By IPS',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'To Issue from IPS','notification'=>'pending','member_code'=>0,'allocated_date'=>$allocated_date,'branch_code'=>0));
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