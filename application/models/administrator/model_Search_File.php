<?php 
class Model_Search_File extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function received_files(){
	}
	function search($from_date,$to_date,$type){
		//Format Dates
		$from_date=$from_date." 00:00:00";
		$to_date=$to_date." 23:59:59";
		$x=$this->model_Search_File->get_sessions();
		$member_code=$x['member_code'];
		if($type=='All'){
			/*$sql="SELECT *,a.file_status as stt from file_tracking_details a,pension_receipt_file_master b
			where a.entry_time between '$from_date' and '$to_date' 
			and a.member_code=$member_code
			and a.file_No=b.file_no order by a.entry_time desc";*/
			$sql="SELECT *,a.file_status as stt from file_tracking_details a,pension_receipt_file_master b
			where a.entry_time between '$from_date' and '$to_date' 
			and a.member_code=$member_code
			and a.file_No=b.file_no group by a.file_no order by a.entry_time desc";
			//echo $sql;
		}
		else if($type=="Forwarded"){
			$sql="SELECT *,a.file_status as stt from file_tracking_details a,pension_receipt_file_master b
			where a.entry_time between '$from_date' and '$to_date'
			and a.file_status like '%forwarded%' 
			and a.member_code=$member_code
			and a.file_No=b.file_no order by a.entry_time desc";
			$type="Forwarded";
		}
		else if($type=="Received"){
			$sql="SELECT *,a.file_status as stt from file_tracking_details a,pension_receipt_file_master b
			where entry_time between '$from_date' and '$to_date'
			and a.file_status like '%received%' 
			and a.member_code=$member_code
			and a.file_No=b.file_no order by a.entry_time desc";
			$type=="Received";
		}
		$q=$this->db->query($sql);
		$result[0]=$q->result();
		$result[1]=$type;
		return $result;
	}
	function search_all($dept,$code,$name)
	{
	 	//$sql="SELECT * FROM pension_receipt_file_master a, file_tracking_details b WHERE a.file_No = b.file_no AND a.dept_forw_no =  'PWD-1072' LIMIT 0 , 30";
        //print_r($dept);
		//exit();
		 /*if($dept!='' && $code!='' && $name!='')
		 {
		  print_r("dept and code and name");
		  exit();
		 }
		 else if($dept!='' && $code!='')
		 {
		 print_r("dept and code");
		 exit();
		 $sql="SELECT * FROM pension_receipt_file_master where dept_forw_no LIKE '$dept' and emp_code LIKE '$code'";
		 }
		 else if($dept!='' && $name!='')
		 {
		 print_r("dept and name");
		 exit();
		 $sql="SELECT * FROM pension_receipt_file_master where dept_forw_no LIKE '$dept' and emp_code LIKE '$code'";
		 }
		 else if($code!='' && $name!='')
		 {
		 print_r("code and name");
		 exit();
		 $sql="SELECT * FROM pension_receipt_file_master where dept_forw_no LIKE '$dept' and emp_code LIKE '$code'";
		 }
		 else if($dept!='')
		 {
		 print_r("dept");
		 exit();
		 $sql="SELECT * FROM pension_receipt_file_master where dept_forw_no LIKE '$dept' ";
		 }
		 else if($code!='')
		 {
		 print_r("emp code");
		 exit();
		  $sql="SELECT * FROM pension_receipt_file_master where emp_code LIKE '$code' ";
		 }
		 else if($name!='')
		 {
		 print_r("name");
		 exit();
		 $sql="SELECT * FROM pension_receipt_file_master where pensionee_name LIKE '$name' ";
		 }
		 
		 
		 if($dept!='' || !empty($dept))
   {
   $sql="and $sql.="emp_code LIKE '$code'";
   }
   else if
   {
   
   }
*/		 
//$and="and";
//$x='';
//$sql="SELECT p.file_No,p.pensionee_name,p.emp_code,p.dept_forw_no,p.designation,MAX(o.file_status) as file_status  FROM pension_receipt_file_master p,file_tracking_details o where";
//$sql="SELECT p.file_No,p.pensionee_name,p.emp_code,p.dept_forw_no,p.designation,o.file_status  FROM pension_receipt_file_master p,file_tracking_details o where";
$sql="SELECT p.file_No,p.pensionee_name,p.emp_code,p.dept_forw_no,p.designation,o.file_status,i.file_no  FROM pension_receipt_file_master p,issue i,file_tracking_details o where";

if($dept!='' || !empty($dept)){
$sql.=" p.dept_forw_no LIKE '$dept' and";
}

if($code!='' || !empty($code)){
$sql.=" p.emp_code LIKE '$code' and";
}

if($name!='' || !empty($name)){
$sql.=" p.pensionee_name='$name' and";
}

//$sql.=" p.salutation IN ('Mr','Mrs','Miss')";
$sql.=" p.file_No = o.file_no";

//print($sql);
//exit();
$q=$this->db->query($sql);
$result=$q->result();//$result[1]=$type;
return $result;
}
	//GET THE SESSIONS
	function get_sessions(){
		return $this->session->userdata;
	}
}