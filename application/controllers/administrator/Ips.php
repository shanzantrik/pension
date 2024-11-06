<?php

class ips extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
		$this->load->model('administrator/model_ips');
		$this->load->helper('base');
	}

	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
			$dp['file_no']=$this->model_ips->checkFile();
			//$dp['file_no_observation']=$this->model_ips->checkFile_observation();
			$dp['lists'] = $this->model_ips->getFilterReceipt($department);
			$dp['lists2'] = $this->model_ips->getFilterDirector($department);
			$dp['lists3'] = $this->model_ips->getFilterPension($department);
			$data['title'] = "IPS";
			$data['content'] = $this->load->view('administrator/ips/view',  $dp, true);
			$this->load->view('administrator/filtered', $data);
	   }
	   else{
	   		$dp['file_no']=$this->model_ips->checkFile();
	   		//$dp['file_no_observation']=$this->model_ips->checkFile_observation();
	   		$dp['lists'] = $this->model_ips->getAll();
			$dp['lists2'] = $this->model_ips->getAll2();
			$dp['lists3'] = $this->model_ips->getAll_from_pension();
			$data['title'] = "IPS";
			$data['content'] = $this->load->view('administrator/ips/view',  $dp, true);
			$this->load->view('administrator/default_template', $data);
	   }
	}

	function load_editremarks($file_No='')
    {
            $file_No=base64_decode($file_No);
                    
            $data['title']   = "Check IPS Observations";
            $dv['receipt']   =$this->model_ips->get_record($file_No);

            $data['content'] = $this->load->view('administrator/ips/edit_remarks',$dv, true);
            $this->load->view('administrator/default_template', $data);
        
            
     }

     function edit_remarks_controller()
    {
        
        if($_POST) {
            $ret=$this->model_ips->edit_ips_observation();
            $this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
            redirect('administrator/ips/index');
            $this->load->view('administrator/default_template', $data);
            
            } else {
            //$dv['receipt']=$this->model_ips->get_receipt($file_No);
            redirect('administrator/ips/load_editremarks');
            $this->load->view('administrator/default_template', $data);
        }
    }

    function print_ips_observation($file_no)
    {
        $file_No=base64_decode($file_no);
        
        $q=$this->db->query("select a.remarks,b.dept_forw_no,b.receipt_date,b.pensionee_name,b.designation,c.address_department from observation a, pension_receipt_file_master b, pension_receipt_register_master c where a.case_no=b.file_no and c.dept_forw_no=b.dept_forw_no and a.case_no='$file_No'");
        $result = $q->result();
        $res['resu'] = $result;
      
        $data['title'] = "IPS detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/ips/ips_observations', $res, true);
        $this->load->view('administrator/default_template', $data);
    }

	function view_ips()
	{
		$dp['lists'] = $this->model_ips->getips_viewfrom_receipt();
		$dp['lists1'] = $this->model_ips->getips_viewfrom_pension();
		$data['title'] = "IPS";
		$data['content'] = $this->load->view('administrator/ips/view_ips',  $dp, true);
		$this->load->view('administrator/default_template', $data);
	}

	function ips_confirm()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->ips_confirm($file);
		echo json_encode($json);
	}

	function ips_confirm_from_pension()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->ips_confirm_from_pension($file);
		echo json_encode($json);
	}

	function save_fwd()
	{
		$ret=$this->model_ips->save_fwd();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/ips');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/ips');
		}
		else if($ret=="Not_All"){
			$this->session->set_flashdata('message',"<div class='alert alert-warning' style='color:#000000'>Cannot Forwarded All the Files Since You have not Enter their Details</div>");
			redirect('administrator/ips');	
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated  </div>");
			redirect('administrator/ips');
		}
	}

	function save_forwrd_dynamic()
	{
		$ret=$this->model_notification->save_forwrd_dynamic();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/ips');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/ips');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated to Superiendantant</div>");
			redirect('administrator/ips');
		}
	}
	
	function save_forwrd_to()
	{
		$ret=$this->model_notification->save_forwrd_to();
		if($ret=='validate'){
			$this->session->set_flashdata('message',"<div class='alert alert-warning'>Please Select a Case First</div>");
			redirect('administrator/ips');
		}
		else if($ret=='RollBack'){
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
			redirect('administrator/ips');
		}
		else{
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Successfully Allocated </div>");
			redirect('administrator/ips');
		}
	}

	function edit_ips($file_No='')
	{
    	$file_No=base64_decode($file_No);
      	if($file_No=='')
      	{
     		redirect(site_url('administrator/member'));
      	} 
     	elseif($_POST)
	    {
            if($this->model_ips->ips_update($file_No))
            {
             	$this->session->set_flashdata('message', '<div class="alert alert-success">IPS details have been modified successfully.</div>');
             	redirect('administrator/ips/view_ips');
            }
           	else
            {
	           $this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update. Please try again.</div>');
	           redirect('administrator/ips/edit_ips/'.$file_No);
            }
	    }
	  	else
	   	{    
		    $ips['departments'] =$this->model_ips->getall_department();
			$ips['records']     =$this->model_ips->get_ips_detail2($file_No);
			$pre_revised_id     =$this->model_ips->get_ips_pre_revised($file_No);
			$ips['pres']        =$this->model_ips->getpre_revised_value($pre_revised_id);

			$data['title']      = "Edit IPS";
			$data['content']    = $this->load->view('administrator/ips/edit', $ips, true);
			$this->load->view('administrator/default_template', $data);
		}
	}


  //  add_ips_checklist

    function add_ips_checklist($file_No='')
	{
    	$file_No=base64_decode($file_No);
      	if($file_No=='')
      	{
     		redirect(site_url('administrator/member'));
      	} 
     	elseif($_POST)
	    {
            if($this->model_ips->ips_update($file_No))
            {
             	$this->session->set_flashdata('message', '<div class="alert alert-success">IPS details have been modified successfully.</div>');
             	redirect('administrator/ips/add_ips_checklist/'.base64_encode(file_No));
            }
           	else
            {
	           $this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update. Please try again.</div>');
	           redirect('administrator/ips/add_ips_checklist/'.$file_No);
            }
	    }
	  	else
	   	{    
		    $ips['departments']=$this->model_ips->getall_department();
			$ips['records']=$this->model_ips->get_ips_detail2($file_No);
			$pre_revised_id=$this->model_ips->get_ips_pre_revised($file_No);
			$ips['pres']=$this->model_ips->getpre_revised_value($pre_revised_id);

			$data['title'] = "Edit IPS";
			$data['content'] = $this->load->view('administrator/ips/edit', $ips, true);
			$this->load->view('administrator/default_template', $data);
		}
	}


	function view_report($file_No)
	{
		$file_No=base64_decode($file_No);
		$abc['values'] =get_ips_detail2($file_No);
		$data['title'] = "IPS detail Report";
		$abc['status'] = $this->model_ips->get_file_from($file_No);
		$data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $abc, true);
		$this->load->view('administrator/default_template', $data);
	}

	function check_file_no($file_No)
	{

	}

	/*function edit($file_No='',$type)
	{
       	if($type=='Pension') {
			$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no($file_No);
	   	} else {
		   	$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no1($file_No);
	   	}
  	    if($_POST) {
			
			$this->form_validation->set_rules('dob', 'Date of birth', 'required');
			$this->form_validation->set_rules('dor', 'Date of Retirement', 'required');
			$this->form_validation->set_rules('exist_bp', 'Basic pay', 'required');
			$this->form_validation->set_rules('revised', 'revised', 'required');
			$this->form_validation->set_rules('fixed_pay', 'Fixed Pay', 'required');
			$this->form_validation->set_rules('effect_from', 'Effect From', 'required');
			$this->form_validation->set_rules('DNI_on', 'DNI', 'required');
			if($this->form_validation->run() == FALSE) {
				$branch_code = $this->model_ips->get_branch_code($file_No);
			    $serial_no = $this->model_ips->get_serial_no($file_No);
			     $dv['receipt']=$this->model_ips->get_receipt($file_No);
			    $dv['departments']=$this->model_ips->getall_department();
			    $dv['records']=$this->model_ips->fetchData($branch_code, $serial_no,$file_No);
			    $dv['file_no']=$file_No;
				$dv['id']=$serial_no;
			    $dv['branch_code'] = $branch_code;
			    $dv['type']=$type;
				$data['title'] = "dd IPS";
				$data['content'] = $this->load->view('administrator/ips/viewform', $dv, true);
				$this->load->view('administrator/default_template', $data);
		 	} else {
				$check_serial_no = $this->model_ips->check_serial_no($serial_no);
		 	  	         
				if($check_serial_no=='') {
					if($this->model_ips->add_ips($file_No)) {
						$serial_no = $this->model_ips->get_serial_no($file_No);
						$pid['values'] = $this->model_ips->get_ips_detail2($file_No);
						$pid['status'] = $this->model_ips->get_file_from($file_No);
						$data['title'] = "IPS detail Report";
						$data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $pid, true);
						$this->load->view('administrator/default_template', $data);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
						redirect('administrator/ips/edit/'.$file_No);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-success">This File Number already exists.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
				}
			}
        } else {
            $branch_code = $this->model_ips->get_branch_code($file_No);
		    $serial_no = $this->model_ips->get_serial_no($file_No);
		    $dv['departments']=$this->model_ips->getall_department();
		    $dv['receipt']=$this->model_ips->get_receipt($file_No);
		    $dv['records']=$this->model_ips->fetchData($branch_code, $serial_no,$file_No);
		    $dv['file_no']=$file_No;
			$dv['id']=$serial_no;
		    $dv['branch_code'] = $branch_code;
		    $dv['type']=$type;
			$data['title'] = "Add IPS";
			$data['content'] = $this->load->view('administrator/ips/viewform', $dv, true);
			$this->load->view('administrator/default_template', $data);
       	}
	}*/

	//attach ips  details pensioner from receipt module
	function edit($file_No='',$type)
	{
       	if($type=='Pension') {
			$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no($file_No);
	   	} else {
		   	$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no1($file_No);
	   	}
  	    if($_POST) {
			
			   
				$check_serial_no = $this->model_ips->check_serial_no($serial_no);
		 	  	         
				if($check_serial_no=='') {
					if($this->model_ips->add_ips($file_No)) {
						
						$serial_no = $this->model_ips->get_serial_no($file_No);
						$pid['values'] = $this->model_ips->get_ips_detail2($file_No);
						$pid['status'] = $this->model_ips->get_file_from($file_No);
						$data['title'] = "IPS detail Report";

						//$data['content'] = $this->load->view('administrator/ips/viewform', $pid, true);
				  $this->session->set_flashdata('message', '<div class="alert alert-success">File has been added successfully.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
						redirect('administrator/ips/edit/'.$file_No);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-success">This File Number already exists.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
				}
			
        } else {
            $branch_code = $this->model_ips->get_branch_code($file_No);
		   $serial_no = $this->model_ips->get_serial_no($file_No);
		    
		    $dv['departments']=$this->model_ips->getall_department();
		    $dv['receipt']=$this->model_ips->get_receipt($file_No);
		   // $dv['records']=$this->model_ips->fetchData1($branch_code, $serial_no,$file_No);
		    $dv['file_no']=$file_No;
			$dv['id']=$serial_no;
		    $dv['branch_code'] = $branch_code;
		    $dv['type']=$type;
			$data['title'] = "Add IPS";
			$data['content'] = $this->load->view('administrator/ips/viewform', $dv, true);
			$this->load->view('administrator/default_template', $data);
       	}
	}


	function update_IPS($file_No='',$type)
	{
       	if($type=='Pension') {
			$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no($file_No);
	   	} else {
		   	$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no1($file_No);
	   	}
  	    if($_POST) {
			
			   
				$check_serial_no = $this->model_ips->check_serial_no($serial_no);
		 	  	         
				if($check_serial_no=='') {
					if($this->model_ips->add_ips($file_No)) {
						
						$serial_no = $this->model_ips->get_serial_no($file_No);
						$pid['values'] = $this->model_ips->get_ips_detail2($file_No);
						$pid['status'] = $this->model_ips->get_file_from($file_No);
						$data['title'] = "IPS detail Report";

						//$data['content'] = $this->load->view('administrator/ips/viewform', $pid, true);
				  $this->session->set_flashdata('message', '<div class="alert alert-success">File has been added successfully.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
						redirect('administrator/ips/edit/'.$file_No);
					}
				} else {
					if($this->model_ips->ips_update($file_No)) {
						$serial_no = $this->model_ips->get_serial_no($file_No);
						$pid['values'] = $this->model_ips->get_ips_detail2($file_No);
						$pid['status'] = $this->model_ips->get_file_from($file_No);
						$data['title'] = "IPS detail Report";

						$this->session->set_flashdata('message', '<div class="alert alert-success">File has been updated successfully.</div>');
					//redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
						redirect('administrator/ips/edit/'.$file_No);
					}
					//$this->session->set_flashdata('message', '<div class="alert alert-success">This File Number already exists.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
				}
			
        } else {
            $branch_code = $this->model_ips->get_branch_code($file_No);
		    $serial_no = $this->model_ips->get_serial_no($file_No);
		    
		    $dv['departments']=$this->model_ips->getall_department();
		    $dv['receipt']=$this->model_ips->get_receipt($file_No);
		    $dv['records']=$this->model_ips->fetchData1($branch_code, $serial_no,$file_No);
		    $dv['file_no']=$file_No;
			$dv['id']=$serial_no;
		    $dv['branch_code'] = $branch_code;
		    $dv['type']=$type;
			$data['title'] = "Add IPS";
			$data['content'] = $this->load->view('administrator/ips/edit', $dv, true);
			$this->load->view('administrator/default_template', $data);
       	}
	}

	 // function load_remarks($file_No=''){
		// 	$file_No=base64_decode($file_No);
		// 	$dv['file_No']=$file_No;
		// 	$data['title']   = "Check IPS Observations";
			
		// 	$data['content'] = $this->load->view('administrator/ips/add_remarks',$dv, true);
		// 	$this->load->view('administrator/default_template', $data);

			
	 // }

	function add_remarks_controller()
	{
		
		if($_POST) {
			//$file_No = ($this->uri->segment('4') != '') ? base64_decode($this->uri->segment(4)) : '';

			// $file_No=base64_decode($file_No);
			// $dv['receipt']=$this->model_ips->get_receipt($file_No);
			$ret=$this->model_ips->add_ips_observation();
			$this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation saved successfully.</div>');
			//redirect('administrator/Ips/load_remarks');//,$dv, true);
			redirect('administrator/Ips/index');
			//$data['content'] = $this->load->view('administrator/ips/add_remarks',$dv, true);
			$this->load->view('administrator/default_template', $data);
			
			} else {
			//$dv['receipt']=$this->model_ips->get_receipt($file_No);
			redirect('administrator/Ips/load_remarks');
			$this->load->view('administrator/default_template', $data);
		}
	}


	// function edit_remarks_controller()
	// {
		
	// 	if($_POST) {
	// 		$ret=$this->model_ips->edit_ips_observation();
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success">IPS observation updated successfully.</div>');
	// 		//redirect('administrator/Ips/load_remarks');//,$dv, true);
	// 		redirect('administrator/Ips/index');
	// 		//$data['content'] = $this->load->view('administrator/ips/add_remarks',$dv, true);
	// 		$this->load->view('administrator/default_template', $data);
			
	// 		} else {
	// 		//$dv['receipt']=$this->model_ips->get_receipt($file_No);
	// 		redirect('administrator/Ips/load_editremarks');
	// 		$this->load->view('administrator/default_template', $data);
	// 	}
	// }

	
	function load_remarks($file_No='')//,$type
	{
		// $ret=$this->model_ips->get_record($file_No);
		// if($ret=='exist')
		// {
			
		// 	$file_No=base64_decode($file_No);
					
		// 	$data['title']   = "Check IPS Observations";
		// 	$dv['receipt']   =$this->model_ips->get_record($file_No);

		// 	$data['content'] = $this->load->view('administrator/ips/edit_remarks',$dv, true);
		// 	$this->load->view('administrator/default_template', $data);
		// }
		// else if($ret=='not_exist')
		{
			
			$file_No=base64_decode($file_No);
					
			$data['title']   = "Check IPS Observations";
			$dv['receipt']   =$this->model_ips->get_receipt($file_No);

			$data['content'] = $this->load->view('administrator/ips/add_remarks',$dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	  //   	$file_No=base64_decode($file_No);
					
			// $data['title']   = "Check IPS Observations";
			// $dv['receipt']   =$this->model_ips->get_receipt($file_No);

			// $data['content'] = $this->load->view('administrator/ips/add_remarks',$dv, true);
			// $this->load->view('administrator/default_template', $data);
	    			
	 }

	 

     //attach ips details pensioner from pension module
    function add_ips_from($file_No='',$type)
	{
       	if($type=='Pension') {
			$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no1($file_No);//get_serial_no($file_No)
	   	} else {
		   	$file_No=base64_decode($file_No);
			$serial_no = $this->model_ips->get_serial_no1($file_No);
	   	}
  	    if($_POST) {
			
			 
				$check_serial_no = $this->model_ips->check_serial_no($serial_no);
		 	  	         
				if($check_serial_no =='') {
					if($this->model_ips->add_ips($file_No)) {
						$serial_no       = $this->model_ips->get_serial_no($file_No);
						$pid['values']   = $this->model_ips->get_ips_detail2($file_No);
						$pid['status']   = $this->model_ips->get_file_from($file_No);
						$data['title']   = "IPS detail Report";
						//$data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $pid, true);
				        $this->session->set_flashdata('message', '<div class="alert alert-success">File has been added successfully.</div>');
					   redirect('administrator/ips/add_ips_from/'.base64_encode($file_No).'/'.$type);
						$this->load->view('administrator/default_template', $data);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
						redirect('administrator/ips/edit/'.$file_No);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-success">This File Number already exists.</div>');
					redirect('administrator/ips/edit/'.base64_encode($file_No).'/'.$type);
				}
			
        } else {
            $branch_code = $this->model_ips->get_branch_code($file_No);
		    $serial_no = $this->model_ips->get_serial_no($file_No);
		    $dv['receipt']=$this->model_ips->get_receipt($file_No);
		    $dv['departments']=$this->model_ips->getall_department();
		    $dv['records']=$this->model_ips->fetchData1($serial_no,$file_No);
		    $dv['file_no']=$file_No;
			$dv['id']=$serial_no;
		    $dv['branch_code'] = $branch_code;
		    $dv['type']=$type;
			$data['title'] = "Add IPS";
			$data['content'] = $this->load->view('administrator/ips/viewpension', $dv, true);
			$this->load->view('administrator/default_template', $data);
       	}
	}

	function print_ips($file_no)
 	{
		$file_No=base64_decode($file_no);
		$serial_no = $this->model_ips->get_serial_no($file_No);
		$pid['values'] = $this->model_ips->get_ips_detail2($file_No);
		$pid['status'] = $this->model_ips->get_file_from($file_No);
		$data['title'] = "IPS detail Report";
		$data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $pid, true);
		$this->load->view('administrator/default_template', $data);
 	}

 	// function print_ips_observation($file_no)
 	// {
		// $file_No=base64_decode($file_no);
		// //dd($file_No);
		// $q=$this->db->query("select a.remarks,b.dept_forw_no,b.receipt_date,b.pensionee_name,b.designation,c.address_department from observation a, pension_receipt_file_master b, pension_receipt_register_master c where a.case_no=b.file_no and c.dept_forw_no=b.dept_forw_no and a.case_no='$file_No'");
		// $result = $q->result();
 	// 	 //dd($result);
		// $res['resu'] = $result;

		// // $p=$this->db->query("select dept_forw_no from pension_receipt_file_master where file_no='$file_No'");
		// // $resultp = $p->result();
 	// // 	 //dd($p);
		// // $resp['resup'] = $resultp;
		// //dd($resp);
		// // $serial_no = $this->model_ips->get_serial_no($file_No);
		// // $pid['values'] = $this->model_ips->get_ips_detail2($file_No);
		// // $pid['status'] = $this->model_ips->get_file_from($file_No);
		// // $this->load->library('Pensioner');//, array('serial_no'=>$serial_no));
		// // $vrp['values'] = $this->pensioner;
		// $data['title'] = "IPS detail Report";
		// $data['content'] = $this->load->view('administrator/pension/report/ips/ips_observations', $res, true);
		// $this->load->view('administrator/default_template', $data);
 	// }

 	
//all employess with same dept_forw_no 
 	function print_ips_all($dept_forw_no)
	{
        $dept=base64_decode($dept_forw_no);
       
        if($_POST)
	          {

                     
	          	        //  var_dump($_POST);
	          	         $pid['records'] = $_POST;
                        //$pid['values']  = $this->model_ips->get_ips_detail2($file_No);
						//$pid['status']  = $this->model_ips->get_file_from($file_No);
						 $pid['values'] = $this->model_ips->get_ips_observation($dept);
		                 $dept = $pid['values'][0]->department;
						 $data['title']  = "IPS detail Report";

						//$data['content'] = $this->load->view('administrator/ips/viewform', $pid, true);
						 $data['content'] = $this->load->view('administrator/pension/report/ips/ips_report_all', $pid, true);
						 $this->load->view('administrator/default_template', $data);
           
	           }
	         else
	       	{    
		     $ips['departments'] = $this->model_ips->getall_department();
			//$ips['records']    =$this->model_ips->get_ips_detail2($file_No);
			 $ips['values'] = $this->model_ips->get_ips_observation($dept);
		     $dept = $ips['values'][0]->department;
			//$pre_revised_id	 =$this->model_ips->get_ips_pre_revised($file_No);
			//$ips['pres']       =$this->model_ips->getpre_revised_value($pre_revised_id);

			$data['title']   = "Check IPS Observations";
			$data['content'] = $this->load->view('administrator/ips/ips_observation1', $ips, true);
			$this->load->view('administrator/default_template', $data);
		}
		
		
	}

    
 //individual print observation ...

  /* function print_ips_all($file_No='')
	{
    	$file_No=base64_decode($file_No);
      	if($file_No=='')
      	    {
     		  redirect(site_url('administrator/member'));
         	} 
     	    elseif($_POST)
	          {

                     
	          	    //  var_dump($_POST);
	          	        $pid['records'] = $_POST;
                        $pid['values']  = $this->model_ips->get_ips_detail2($file_No);
                        $pid['vals'] = $this->model_ips->get_ips_observation1($file_No);
						$pid['status']  = $this->model_ips->get_file_from($file_No);
						$data['title']  = "IPS detail Report";

						//$data['content'] = $this->load->view('administrator/ips/viewform', $pid, true);
						$data['content'] = $this->load->view('administrator/pension/report/ips/ips_observations', $pid, true);
						$this->load->view('administrator/default_template', $data);
           
	       }
	    	else
	       	{    
		    $ips['departments']=$this->model_ips->getall_department();
			$ips['records']    =$this->model_ips->get_ips_detail2($file_No);

			$pre_revised_id	   =$this->model_ips->get_ips_pre_revised($file_No);
			$ips['pres']       =$this->model_ips->getpre_revised_value($pre_revised_id);

			$data['title'] = "Check IPS Observations";
			$data['content'] = $this->load->view('administrator/ips/ips_observation', $ips, true);
			$this->load->view('administrator/default_template', $data);
		}
	}*/
	function getPreRevisedPayScale()
	{
		$payCommission = $this->input->post('payCommission');
		$this->db->select('id, grade, pay_scale');
    	$this->db->from('master_pay_scale');
    	$this->db->where(array('pay_commission'=>$payCommission));
    	$result = $this->db->get();

    	echo '<option value="0">--Select--</option>';
    	foreach ($result->result_array() as $value) {
    		echo '<option value="'.$value['id'].'">'.$value['grade']." - ".$value['pay_scale'].'</option>';
    	}
	}

	function getRevisedPayScale()
	{
		$related = $this->input->post('related');
		$payCommission = $this->input->post('payCommission');
    	$result = $this->db->query("SELECT id, pay_scale FROM master_pay_scale WHERE pay_commission='".$payCommission."' AND related='".$related."'");
    	$row = $result->row();
    	echo '<option value="'.$row->id.'" selected>'.$row->pay_scale.'</option>';
	}

	function getRevisedBasicPay()
	{
		$pre_revised_id = $this->security->xss_clean($this->input->post('pre_revised'));
		$existing_basic_pay = $this->security->xss_clean($this->input->post('existing_basic_pay'));
		
		$grade = getPayScaleGradeById($pre_revised_id);

		$query = $this->db->query('SELECT revised_basic_pay FROM master_fitment_table WHERE scale="'.$grade.'" AND pre_revised_basic_pay="'.$existing_basic_pay.'"');
		if($query->num_rows() > 0) {
			$row = $query->row();
			echo $row->revised_basic_pay;
		} else {
			echo "error";
		}
	}
	
	function getPreRevisedPayScaleSelect()
	{
		$payCommission = $this->input->post('payCommission');
		$select = $this->input->post('select');
		$this->db->select('id, grade, pay_scale');
    	$this->db->from('master_pay_scale');
    	$this->db->where(array('pay_commission'=>$payCommission));
    	$result = $this->db->get();
    	echo '<option value="0">--Select--</option>';
    	foreach ($result->result_array() as $value) {
    		if($value['id'] == $select) {
    			echo '<option value="'.$value['id'].'" selected>'.$value['grade']." - ".$value['pay_scale'].'</option>';
    		} else {
    			echo '<option value="'.$value['id'].'">'.$value['grade']." - ".$value['pay_scale'].'</option>';
    		}
    	}
	}

	function getRevisedPayScaleById()
	{
		$id = $this->input->post('id');
    	$result = $this->db->query("SELECT id, pay_scale FROM master_pay_scale WHERE id='".$id."'");
    	$row = $result->row();
    	echo '<option value="'.$row->id.'" selected>'.$row->pay_scale.'</option>';
	}
}