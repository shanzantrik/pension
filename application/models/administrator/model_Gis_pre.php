<?php 
class Model_Gis extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	
	function add_checklist($file_no1){		
		extract($_POST);

		$dom_group = serialize($dom_group);
		$doc_group = serialize($doc_group);

       		$obj=array();
			if(!empty($_POST['objection']))
			{
				for($k=0; $k<count($_POST['objection']);$k++)
				{
					$obj_info = array();
					$obj_info['objection']=$_POST['objection'][$k];
					array_push($obj, $obj_info);
			   	}
			   
			}
		$data = array(
			'file_no'=>$file_no1,
			'claiment'=>$claiment,
			'claiment_name'=>$claiment_name,
			'claiment_relation'=>$claiment_relation,
			'village_town'=>$vill_town,
			'po'=>$po,
			'district'=>$district,
			'state'=>$state,
			'doj'=>$doj,
			'office_address'=>$office_address,
			'dor'=>$dor,
			'date_of_settlement'=>$d_of_settlement,
		    'date_of_membership'=>$dom,
		    'dom_group'=>$dom_group,
		    'date_of_cessation'=>$date_of_cessation,
		    'doc_group'=>$doc_group,

		    'pom_group_d_from'=>$pom_group_d_from,
		    'pom_group_d_to'=>$pom_group_d_to,
		    'pom_group_d_years'=>$pom_group_d_years,
		    'group_d_amt_1sthalf'=>$group_d_amt_1sthalf,
		    'group_d_amt_2ndhalf'=>$group_d_amt_2ndhalf,

		    'pom_group_c_from'=>$pom_group_c_from,
		    'pom_group_c_to'=>$pom_group_c_to,
		    'pom_group_c_years'=>$pom_group_c_years,
		    'group_c_amt_1sthalf'=>$group_c_amt_1sthalf,
		    'group_c_amt_2ndhalf'=>$group_c_amt_2ndhalf,

		    'pom_group_b_from'=>$pom_group_b_from,
		    'pom_group_b_to'=>$pom_group_b_to,
		    'pom_group_b_years'=>$pom_group_b_years,
		    'group_b_amt_1sthalf'=>$group_b_amt_1sthalf,
		    'group_b_amt_2ndhalf'=>$group_b_amt_2ndhalf,

		    'pom_group_a_from'=>$pom_group_a_from,
		    'pom_group_a_to'=>$pom_group_a_to,
		    'pom_group_a_years'=>$pom_group_a_years,
		    'group_a_amt_1sthalf'=>$group_a,
		    'group_a_amt_2ndhalf'=>$group_a_amt_2ndhalf,

		     'form_status'=>$form_status,
              'form_9'=>isset($form_9),
               'form_13'=>isset($form_13),
               'savings_fund'=>$savings_fund,
                'insurance_fund'=>$insurance_fund,
                  'bill_signed_by_claiment'=>$bill_signed_by_claiment,
                    'bill_signed_by_HoO'=>$bill_signed_by_HoO,


             'savings_amt'=>$savings_amt,
             'insurance_amt'=>$insurance_amt,
             'claim_status'=>$claim_status,

             'objection'=>serialize($obj),


             //'objection'=>$objection,

              'cal_sav_amt_group_d_from'=>$cal_sav_amt_group_d_from,
                   'cal_sav_amt_group_d_to'=>$cal_sav_amt_group_d_to,
                      'cal_sav_amt_group_d'=>$cal_sav_amt_group_d,
                          'total_cal_sav_amt_group_d'=>$total_cal_sav_amt_group_d,

                'cal_sav_amt_group_c_from'=>$cal_sav_amt_group_c_from,
                   'cal_sav_amt_group_c_to'=>$cal_sav_amt_group_c_to,
                      'cal_sav_amt_group_c'=>$cal_sav_amt_group_c,
                          'total_cal_sav_amt_group_c'=>$total_cal_sav_amt_group_c,

                              'cal_sav_amt_group_b_from'=>$cal_sav_amt_group_b_from,
                   'cal_sav_amt_group_b_to'=>$cal_sav_amt_group_b_to,
                      'cal_sav_amt_group_b'=>$cal_sav_amt_group_b,
                          'total_cal_sav_amt_group_b'=>$total_cal_sav_amt_group_b,

                              'cal_sav_amt_group_a_from'=>$cal_sav_amt_group_a_from,
                   'cal_sav_amt_group_a_to'=>$cal_sav_amt_group_a_to,
                      'cal_sav_amt_group_a'=>$cal_sav_amt_group_a,
                          'total_cal_sav_amt_group_a'=>$total_cal_sav_amt_group_a,

                         'final_insurance_amt'=>$final_insurance_amt,
                          'TO'=>$TO,
						  
						  'savings_add_from'=>$savings_add_from,
						  'savings_add_to'=>$savings_add_to,
						  'savings_add'=>$savings_add,
						  'savings_less_from'=>$savings_less_from,
						  'savings_less_to'=>$savings_less_to,
						  'savings_less'=>$savings_less,

						  
						  
		);
  //print_r($data);
  //exit();
		if($this->db->insert('checklist', $data))
		{
			return true;
		} else {
			return false;
		}
	}
	function update_checklist($file_no1){		
		   extract($_POST);

		   $dom_group = serialize($dom_group);
		   $doc_group = serialize($doc_group);

			$obj=array();
			if(!empty($_POST['objection']))
			{
				for($k=0; $k<count($_POST['objection']); $k++)
				{
					$obj_info = array();
					$obj_info['objection'] = $_POST['objection'][$k];
					array_push($obj, $obj_info);
			   	}
				
			}

		$data = array(
			'file_no'=>$file_no1,
			'claiment'=>$claiment,
			'claiment_name'=>$claiment_name,
			'claiment_relation'=>$claiment_relation,
			'village_town'=>$vill_town,
			'po'=>$po,
			'district'=>$district,
			'state'=>$state,
			'doj'=>$doj,
			'office_address'=>$office_address,
			'dor'=>$dor,
			'date_of_settlement'=>$d_of_settlement,
		    'date_of_membership'=>$dom,
		    'dom_group'=>$dom_group,
		    'date_of_cessation'=>$date_of_cessation,
		    'doc_group'=>$doc_group,

		    'pom_group_d_from'=>$pom_group_d_from,
		    'pom_group_d_to'=>$pom_group_d_to,
		    'pom_group_d_years'=>$pom_group_d_years,
		    'group_d_amt_1sthalf'=>$group_d_amt_1sthalf,
		    'group_d_amt_2ndhalf'=>$group_d_amt_2ndhalf,

		    'pom_group_c_from'=>$pom_group_c_from,
		    'pom_group_c_to'=>$pom_group_c_to,
		    'pom_group_c_years'=>$pom_group_c_years,
		    'group_c_amt_1sthalf'=>$group_c_amt_1sthalf,
		    'group_c_amt_2ndhalf'=>$group_c_amt_2ndhalf,

		    'pom_group_b_from'=>$pom_group_b_from,
		    'pom_group_b_to'=>$pom_group_b_to,
		    'pom_group_b_years'=>$pom_group_b_years,
		    'group_b_amt_1sthalf'=>$group_b_amt_1sthalf,
		    'group_b_amt_2ndhalf'=>$group_b_amt_2ndhalf,

		    'pom_group_a_from'=>$pom_group_a_from,
		    'pom_group_a_to'=>$pom_group_a_to,
		    'pom_group_a_years'=>$pom_group_a_years,
		    'group_a_amt_1sthalf'=>$group_a,
		    'group_a_amt_2ndhalf'=>$group_a_amt_2ndhalf,

		     'form_status'=>$form_status,
              'form_9'=>isset($form_9),
               'form_13'=>isset($form_13),
               'savings_fund'=>$savings_fund,
                'insurance_fund'=>$insurance_fund,
                  'bill_signed_by_claiment'=>$bill_signed_by_claiment,
                    'bill_signed_by_HoO'=>$bill_signed_by_HoO,


             'savings_amt'=>$savings_amt,
             'insurance_amt'=>$insurance_amt,
             'claim_status'=>$claim_status,

              'objection'=>serialize($obj),
			  //'objection'=>$objection,


              'cal_sav_amt_group_d_from'=>$cal_sav_amt_group_d_from,
                   'cal_sav_amt_group_d_to'=>$cal_sav_amt_group_d_to,
                      'cal_sav_amt_group_d'=>$cal_sav_amt_group_d,
                          'total_cal_sav_amt_group_d'=>$total_cal_sav_amt_group_d,

                'cal_sav_amt_group_c_from'=>$cal_sav_amt_group_c_from,
                   'cal_sav_amt_group_c_to'=>$cal_sav_amt_group_c_to,
                      'cal_sav_amt_group_c'=>$cal_sav_amt_group_c,
                          'total_cal_sav_amt_group_c'=>$total_cal_sav_amt_group_c,

                              'cal_sav_amt_group_b_from'=>$cal_sav_amt_group_b_from,
                   'cal_sav_amt_group_b_to'=>$cal_sav_amt_group_b_to,
                      'cal_sav_amt_group_b'=>$cal_sav_amt_group_b,
                          'total_cal_sav_amt_group_b'=>$total_cal_sav_amt_group_b,

                              'cal_sav_amt_group_a_from'=>$cal_sav_amt_group_a_from,
                   'cal_sav_amt_group_a_to'=>$cal_sav_amt_group_a_to,
                      'cal_sav_amt_group_a'=>$cal_sav_amt_group_a,
                          'total_cal_sav_amt_group_a'=>$total_cal_sav_amt_group_a,

                         'final_insurance_amt'=>$final_insurance_amt,
                          'TO'=>$TO,

                          'savings_add_from'=>$savings_add_from,
						  'savings_add_to'=>$savings_add_to,
						  'savings_add'=>$savings_add,
						  'savings_less_from'=>$savings_less_from,
						  'savings_less_to'=>$savings_less_to,
						  'savings_less'=>$savings_less,


                  
		);
         	$this->db->where('file_no',$file_no1);
			$q=$this->db->update('checklist', $data);
		if($q){
			return true;
		} else {
			return false;
		}
	}
	function getAll()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where a.file_no=b.file_No and b.file_No=c.file_No and a.status='Forwarded to GIS From Receipt'");
    	$result = $q->result();
 		return $result;
	 }
	 function getfile_no_from_checklist()
	 {
	    $q=$this->db->query("SELECT file_no from checklist");
    	$result = $q->result();
 		return $result;
	 }

	 function getfile_no_from_checklist_for_check()
	 {
	    $q=$this->db->query("SELECT file_no from checklist");
	    $array = array();
	    foreach($q->result() as $key=>$row) :
	    	array_push($array, $row->file_no);
	    endforeach;
	  	return $array;
	 }

	 function getfile_from_Director()
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,token_reciept c where a.file_no=b.file_No and c.file_No=b.file_No and a.status='gis_Forwarded to GIS DA'");
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b,checklist c,token_reciept d where b.file_No=d.file_No and a.file_no=b.file_No and b.file_No=c.file_no and a.status='gis_Forwarded to GIS DA'");
    	$result = $q->result();
 		return $result;
	 }
	  function getfile_from_gis_superintendent_after_final()
	 {
	    //$q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to GIS DA By Pension DA'");
		$q=$this->db->query("SELECT * from file_tracking_details a,pension_receipt_file_master b,file_status c where a.file_no=b.file_No and c.file_no=b.file_No and a.file_status='Forwarded to GIS DA By Pension DA'");
    	$result = $q->result();
 		return $result;
	 }
	 function getfile_from_gis_superintendent_for_obj()
	 {
	    $q=$this->db->query("SELECT * from file_status a,pension_receipt_file_master b where a.file_no=b.file_No and a.status='Forwarded to GIS DA by GIS superintendent For Objection File'");
    	$result = $q->result();
 		return $result;
	 }


	 	function check_file_no($file_no) 
	{
		$this->db->select('file_no');
		$this->db->where('file_no', $file_no);
		$query = $this->db->get('checklist');
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->file_no;
		} else {
			return "";
		}
	}

	  function view_checklist_details()
	  {
      //$q=$this->db->query("SELECT * from checklist a,pension_receipt_file_master b, where a.file_no=b.file_No" );
      $q=$this->db->query("SELECT distinct * from checklist a,pension_receipt_file_master b,file_status c where a.file_no=b.file_No and c.file_no=a.file_no" );
       //$q=$this->db->query("SELECT * from checklist a,pension_receipt_file_master b where a.file_no=b.file_No" );
       $result = $q->result();
 	   return $result;
      }

	 function get_checklist_details($file_no)
	 {
		$this->db->select('*');
    	$this->db->from('checklist');
    	$this->db->where(array('checklist.file_no'=>$file_no));
    	$this->db->join('pension_receipt_file_master', 'pension_receipt_file_master.file_No=checklist.file_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	 }
	  function get_objection_details($file_no)
	 {
		$this->db->select('objection');
    	$this->db->from('checklist');
		$this->db->where(array('checklist.file_no'=>$file_no));
    	//$this->db->join('pension_receipt_file_master', 'pension_receipt_file_master.file_No=checklist.file_no', 'left');
		$query = $this->db->get();
 		return $query->result_array();
	 }
	 function get_objection_master($file_no)
	 {
		$this->db->select('*');
    	$this->db->from('master_objection');
		$query = $this->db->get();
 		return $query->result_array();
	 }
	 
	 

     function get_group_of_employee($file_no)
      {
      	$this->db->select('dom_group');
    	$this->db->from('checklist');
    	$this->db->where(array('file_no' => $file_no));
		$query = $this->db->get();
		if($query->num_rows()>0) 
		{
			$row = $query->row(); 
			if($row->dom_group!="") 
			{
				return $row->dom_group ;
			} 
			else 
			{
				return "not_exists";
			}

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
	 function fetchData($file_no,$serial_no)
	 {
      //$query = $this->db->get_where('pension_receipt_file_master', array('file_No'=>$file_no));
	  //return $query->result_array();
	  if ($serial_no==0){ 
			//receipt
	 		$query = $this->db->get_where('pension_receipt_file_master', array('file_No'=>$file_no));
	 		return $query->result_array();
 	    } 
 	    else
 	    {
 	    	//pension
			$this->db->select('*');
			$this->db->from('pensioner_personal_details');
			$this->db->where(array('pensioner_personal_details.serial_no' => $serial_no));
			$this->db->join('pensioner_service_details', 'pensioner_service_details.serial_no = pensioner_personal_details.serial_no','left');
			$this->db->join('pension_receipt_register_master', 'pension_receipt_register_master.slno = pensioner_personal_details.serial_no','left');
            $this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no','left');

			//$this->db->join('pensioner_pay_details`', 'pensioner_pay_details`.serial_no = pensioner_personal_details.serial_no', 'left');
			        
			$query = $this->db->get();
 			return $query->result_array();
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
	 function save_forwrd_gis_Superintendent_file()
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
					'branch'=>'GIS Superintendent',
					'file_status'=>'Forwarded to GIS_Superintendent By GIS DA',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to GIS_Superintendent By GIS DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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
	 	 function save_forwrd_gis_Superintendent_after_approval()
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
					'branch'=>'GIS',
					'file_status'=>'Forwarded to issue by GIS',
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'Forwarded to issue by GIS','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date,'branch_code'=>$branch_code));
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
	 
	 
	function get_gis_chart($where = array(), $order_by='for_year', $order='desc')
	{
		$this->db->select('*');
		$this->db->from('master_gis_chart');
		if(count($where) > 0) :
			$this->db->where($where);
		endif;
		$this->db->order_by($order_by, $order);
		$query = $this->db->get();
		return $query->result_array();
	}

}