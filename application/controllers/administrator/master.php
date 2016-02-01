<?php 

class master extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('member_type') != 'Administrator') {
			redirect(site_url('home'));
		}
		$this->load->helper('base');
		$this->load->helper('department');
		$this->load->helper('branch_master');
		$this->load->helper('designation');
		$this->load->helper('member_type');
		$this->load->helper('section');
		$this->load->model(array('administrator/model_department', 'administrator/model_designation', 'administrator/model_branch', 'administrator/model_document', 'administrator/model_commutation', 'administrator/model_da', 'administrator/model_paycommision', 'administrator/model_payscale', 'administrator/model_member_type', 'administrator/model_Gis', 'administrator/model_District', 'administrator/model_member'));
	}

	//department
	function department_index()
    {
		$dp['lists'] = $this->model_department->getAll();
		$data['title'] = "Department";
		$data['content'] = $this->load->view('administrator/master/department/view', $dp, true);
		$this->load->view('administrator/default_template', $data);
	}

	function department_save(){
		if($_POST) :
			if($this->model_department->add()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Department saved successfully.</div>');
				redirect('administrator/master/department_index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/master/department_index');
			}
		else :
			redirect(site_url('administrator/master/department_index'));
		endif;
	}

	function department_edit($dept_code=''){
		if($dept_code=='') {
			redirect(site_url('administrator/master/department_index'));
		} elseif($_POST) {
			$this->form_validation->set_rules('dept_name', 'name', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			if($this->form_validation->run() == FALSE) {
				$dv['records']=$this->model_department->fetchData($dept_code);
				$data['title'] = "Edit Department";
				$data['content'] = $this->load->view('administrator/master/department/edit', $dv, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_department->update()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Department Updated successfully.</div>');
					redirect('administrator/master/department_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
					redirect('administrator/master/department_edit/'.$dept_code);
				}
			}
		} else {
			$dv['records']=$this->model_department->fetchData($dept_code);
			$data['title'] = "Edit Department";
			$data['content'] = $this->load->view('administrator/master/department/edit', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function department_del($dept_code)
	{
		$this->model_department->del($dept_code);
		$this->session->set_flashdata('message', '<div class="alert alert-danger">Department Deleted Successfully.</div>');
		redirect('administrator/master/department_index');
	}

	function department_update_ajax(){
		$this->model_department->update_ajax();
	}


	//designation
	function designation_index() {
		if($_POST) {
			$this->form_validation->set_rules('designation_name', 'designation name', 'required');
			//$this->form_validation->set_rules('description', 'description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$desg['lists'] = $this->model_designation->getAll();
				$data['title'] = "Designation";
				$data['content'] = $this->load->view('administrator/master/designation/view', $desg, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_designation->add()=='true') {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Designation saved successfully.</div>');
					redirect('administrator/master/designation_index');
				} else if($this->model_designation->add()=='PK')  {
					$this->session->set_flashdata('message', '<div class="alert alert-warning">Designation Already Exists ! Please Enter a different Designation</div>');
					redirect('administrator/master/designation_index');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some Error Occures During Insertion</div>');
					redirect('administrator/master/designation_index');
				}
			}
		} else {
			$desg['lists'] = $this->model_designation->getAll();
			$data['title'] = "Designation";
			$data['content'] = $this->load->view('administrator/master/designation/view', $desg, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function designation_del($desg_code) {
		$this->model_designation->del($desg_code);
		$this->session->set_flashdata('message', '<div class="alert alert-danger">Designation Deleted Successfully.</div>');
		redirect('administrator/master/designation_index');
	}

	function designation_update_ajax(){
		$this->model_designation->update_ajax();
	}


	//branch
	function branch_index() {
		if($_POST) {
			$this->form_validation->set_rules('branch_name', 'branch name', 'required');
			if ($this->form_validation->run() == FALSE) {
				$branch['lists'] = $this->model_branch->getAll();
				$data['title'] = "Branch";
				$data['content'] = $this->load->view('administrator/master/branch/view', $branch, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_branch->add()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Branch saved successfully.</div>');
					redirect('administrator/master/branch_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/master/branch_index');
				}
			}
		} else {
			$branch['lists'] = $this->model_branch->getAll();
			$data['title'] = "Branch";
			$data['content'] = $this->load->view('administrator/master/branch/view', $branch, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function branch_edit(){
		if($_POST) :
			if($this->model_branch->update()==true) :
				$this->session->set_flashdata('message', '<div class="alert alert-success">Branch Updated Successfully</div>');
				redirect('administrator/master/branch_index');
			endif;
		else :
			redirect('administrator/master/branch_index');
		endif;
	}

	function branch_del($Branch_Code) {
		$this->model_branch->del($Branch_Code);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Branch Deleted Successfully.</div>');
		redirect('administrator/master/branch_index');
	}

	function branch_update_ajax(){
		$this->model_branch->update_ajax();
	}


	//document
	function document_index() {
		if($_POST) {
			$this->form_validation->set_rules('document_name', 'name', 'required');
			$this->form_validation->set_rules('document_for', 'document_for', 'required');
			if ($this->form_validation->run() == FALSE) {
				$doc['lists'] = $this->model_document->getAll();
				$data['title'] = "Department";
				$data['content'] = $this->load->view('administrator/master/document/view', $doc, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_document->add()=='true') {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Document saved successfully.</div>');
					redirect('administrator/master/document_index');
				} 
				else if($this->model_document->add()=='PK'){
					$this->session->set_flashdata('message', '<div class="alert alert-error">Document Already Exists!. Please Enter a Diffeent Document Name.</div>');
					redirect('administrator/master/document_index');
				}
				else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during insertion.</div>');
					redirect('administrator/master/document_index');
				}
			}
		} else {
			$doc['lists'] = $this->model_document->getAll();
			$data['title'] = "Document";
			$data['content'] = $this->load->view('administrator/master/document/view', $doc, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function document_edit($doc_no=''){
		if($doc_no=='') {
			redirect(site_url('administrator/master/document_index'));
		} elseif($_POST) {
			$this->form_validation->set_rules('doc_name', 'name', 'required');
			$this->form_validation->set_rules('descrp', 'description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$doc['records']=$this->model_document->fetchData($doc_no);
				$data['title'] = "Edit Document";
				$data['content'] = $this->load->view('administrator/master/document/edit', $doc, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_document->update()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Document updated successfully.</div>');
					redirect('administrator/master/document_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during insertion.</div>');
					redirect('administrator/master/document_edit/'.$doc_no);
				}
			}
		} else {
			$doc['records']=$this->model_document->fetchData($doc_no);
			$data['title'] = "Edit Document";
			$data['content'] = $this->load->view('administrator/master/document/edit', $doc, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function document_del($doc_no) {
		$this->model_document->del($doc_no);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Document Deleted Successfully.</div>');
		redirect('administrator/master/document_index');
	}

	function document_update_ajax(){
		$this->model_document->update_ajax();
	}



	//commutation
	function commutation_index() {
		if($_POST) {
			$this->form_validation->set_rules('age_next', 'age at next birth', 'required|integer');
			$this->form_validation->set_rules('col_value', 'commutation', 'required|decimal');
			if ($this->form_validation->run() == FALSE) {
				$comm['lists'] = $this->model_commutation->getAll();
				$data['title'] = "Commutation";
				$data['content'] = $this->load->view('administrator/master/commutation/view', $comm, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_commutation->add() == "true") {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Commutation saved successfully.</div>');
					redirect('administrator/master/commutation_index');
				} elseif ($this->model_commutation->add() == 'exists') {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Age at next birth already exists.</div>');
					redirect('administrator/master/commutation_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/master/commutation_index');
				}
			}
		} else {
			$comm['lists'] = $this->model_commutation->getAll();
			$data['title'] = "Commutation";
			$data['content'] = $this->load->view('administrator/master/commutation/view', $comm, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function commutation_edit($srl=''){
		if($srl=='') {
			redirect(site_url('administrator/master/commutation_index'));
		} elseif($_POST) {
			$this->form_validation->set_rules('age_next', 'age at next birth', 'required|integer');
			$this->form_validation->set_rules('col_value', 'commutation', 'required|decimal');
			if ($this->form_validation->run() == FALSE) {
				$cv['records']=$this->model_commutation->fetchData($srl);
				$data['title'] = "Edit Commutation Value";
				$data['content'] = $this->load->view('administrator/master/commutation/edit', $cv, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_commutation->update($srl)) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Commutation value Updated successfully.</div>');
					redirect('administrator/master/commutation_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
					redirect('administrator/master/commutation_edit/'.$srl);
				}
			}
		} else {
			$cv['records']=$this->model_commutation->fetchData($srl);
			$data['title'] = "Edit Commutation Value";
			$data['content'] = $this->load->view('administrator/master/commutation/edit', $cv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function commutation_del($srl) {
		$this->model_commutation->del($srl);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Commutation value Deleted Successfully.</div>');
		redirect('administrator/master/commutation_index');
	}

	function commutation_update_ajax(){
		$this->model_commutation->update_ajax();
	}



	//da
	function da_index() {
		if($_POST) {
			$this->form_validation->set_rules('from', 'from date', 'required');
			$this->form_validation->set_rules('percentage', 'percentage', 'required');
			if ($this->form_validation->run() == FALSE) {
				$da['lists'] = $this->model_da->getAll();
				$data['title'] = "Dearness Allowance";
				$data['content'] = $this->load->view('administrator/master/da/view', $da, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_da->add() == 'true') {
					$this->session->set_flashdata('message', '<div class="alert alert-success">DA added successfully.</div>');
					redirect('administrator/master/da_index');
				} elseif ($this->model_da->add() == 'exists') {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">DA percentage already exists.</div>');
					redirect('administrator/master/da_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/master/da_index');
				}
			}
		} else {
			$da['lists'] = $this->model_da->getAll();
			$data['title'] = "Dearness Allowance";
			$data['content'] = $this->load->view('administrator/master/da/view', $da, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function da_edit($srl=''){
		if($srl=='') {
			redirect(site_url('administrator/master/da_index'));
		} elseif($_POST) {
			$this->form_validation->set_rules('from', 'from date', 'required');
			$this->form_validation->set_rules('percentage', 'percentage', 'required');
			if ($this->form_validation->run() == FALSE) {
				$da['records']=$this->model_da->fetchData($srl);
				$data['title'] = "Edit Dearness Allowance";
				$data['content'] = $this->load->view('administrator/master/da/edit', $da, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_da->update($srl)) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Dearness Allowance percentage Updated successfully.</div>');
					redirect('administrator/master/da_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Update.</div>');
					redirect('administrator/master/da_edit/'.$srl);
				}
			}
		} else {
			$da['records']=$this->model_da->fetchData($srl);
			$data['title'] = "Edit Dearness Allowance";
			$data['content'] = $this->load->view('administrator/master/da/edit', $da, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function da_del($srl) {
		$this->model_da->del($srl);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Dearness Allowance percentage Deleted Successfully.</div>');
		redirect('administrator/master/da_index');
	}

	function da_update_ajax(){
		$this->model_da->update_ajax();
	}

	/*function get_latest_da_percent() {
		$data = $this->model_da->get_latest_da_percent();
		echo $data->percentage;
	}*/


	//paycommission
	function paycommission_index(){
		$data['title']='Pay Commision Entry';
		$dv['records']=$this->model_paycommision->getPayComn();
		$data['content'] = $this->load->view('administrator/master/paycommision/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function paycommission_get_textbox(){
		$id=$_GET['id'];
		$data['records']=$this->model_paycommision->getSpecific($id);
		$datas = array_filter($data);
		//if no results
		
		if(empty($datas)){
			$data['flag']=0;
		} else {
			$data['flag']=1;
		}
		$data['id']=$id;
		$this->load->view('administrator/master/paycommision/ajax_view', $data);
	}

	function paycommission_update_ajax(){
		$this->model_paycommision->update_ajax();
	}

	function paycommission_save_pay_comn(){
		$this->model_paycommision->save_pay_comn();
	}

	function paycommission_delete($id){
		if($this->model_paycommision->delete($id)==true){
			$this->session->set_flashdata('message',"<div class='alert alert-success'>Perameter Deleted Successfully</div>");
			redirect('administrator/paycommision');
		}
	}



	//payscale
	function payscale_index($id = '')
	{
		if($id != '')
		{
			$d['payscale'] = $this->model_payscale->getPayScale(array('id'=>$id));
			$data['title']='Pay Scale Entry';
			$data['content'] = $this->load->view('administrator/master/payscale/index', $d, true);
			$this->load->view('administrator/default_template', $data);
		} else {
			$data['title']='Pay Scale Entry';
			$data['content'] = $this->load->view('administrator/master/payscale/index', '', true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function payscale_save()
	{
		if($_POST['save_pay_scale'])
		{
			if($_POST['pay_scale_id'] != '' || $_POST['pay_scale_id'] != NULL) :
				//update
				$id= $this->security->xss_clean($this->input->post('pay_scale_id'));
				$grade = $this->security->xss_clean($this->input->post('grade'));
				$pay_scale = $this->security->xss_clean($this->input->post('pay_scale'));
				$pay_commission = $this->security->xss_clean($this->input->post('pay_commission'));
				$related = $this->security->xss_clean($this->input->post('related'));

				$data = array('grade'=>$grade, 'pay_scale'=>$pay_scale, 'pay_commission'=>$pay_commission, 'related'=>$related);

				$this->db->where('id', $this->security->xss_clean($this->input->post('pay_scale_id')));
				if($this->db->update('master_pay_scale', $data)) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Pay scale saved successfully.</div>');
					redirect('administrator/master/payscale_index/'.$id);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/master/payscale_index/'.$id);
				}
			else :
				//insert
				$grade = $this->security->xss_clean($this->input->post('grade'));
				$pay_scale = $this->security->xss_clean($this->input->post('pay_scale'));
				$pay_commission = $this->security->xss_clean($this->input->post('pay_commission'));
				$related = $this->security->xss_clean($this->input->post('related'));

				$data = array('grade'=>$grade, 'pay_scale'=>$pay_scale, 'pay_commission'=>$pay_commission, 'related'=>$related);

				if($this->db->insert('master_pay_scale', $data)) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Pay scale saved successfully.</div>');
					redirect('administrator/master/payscale_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
					redirect('administrator/master/payscale_index');
				}
			endif;
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">You can\'t access this page directly.</div>');
			redirect(site_url('administrator/master/payscale_index'));
		}
	}

	function payscale_saveFitmentTable() {
		$rows = $_POST['data'];
		$error = '';
		$values = '';
		foreach ($rows as $row) {
			if(isset($row['scale']) == '' || isset($row['pre_revised_basic_pay']) == '' || isset($row['pay_band']) == '' || isset($row['grade_pay']) == '' || isset($row['revised_basic_pay']) == '') :
				if(!isset($row['scale']) || $row['scale'] == '') :
					$error .= 'Scale value should not be blank. \n ';
				endif;
				if(!isset($row['pre_revised_basic_pay']) || $row['pre_revised_basic_pay'] == '') :
					$error .= 'Pre revised basic pay value should not be blank. \n ';
				endif;
				if(!isset($row['pay_band']) || $row['pay_band'] == '') :
					$error .= 'Pay band value should not be blank. \n ';
				endif;
				if(!isset($row['grade_pay']) || $row['grade_pay'] == '') :
					$error .= 'Grade pay value should not be blank. \n ';
				endif;
				if(!isset($row['revised_basic_pay']) || $row['revised_basic_pay'] == '' || strlen($row['revised_basic_pay']) <= 0) :
					$error .= 'Revised basic pay value should not be blank. \n ';
				endif;
			else :
				$values.="('".mysql_real_escape_string($row['scale'])."', '".mysql_real_escape_string($row['pre_revised_basic_pay'])."', '".mysql_real_escape_string($row['pay_band'])."', '".mysql_real_escape_string($row['grade_pay'])."', '".mysql_real_escape_string($row['revised_basic_pay'])."'), ";
			endif;

			if($error != '') :
				break;
			endif;
		}

		if($error != '') :
			echo $error;
		else :
			$values = substr($values, 0, -2);
			$query = $this->db->query("INSERT INTO master_fitment_table (`scale`, `pre_revised_basic_pay`, `pay_band`, `grade_pay`, `revised_basic_pay`) VALUES $values");
			if($query) {
				echo "Added successfully";
			} else {
				echo "Error Occured.";
			}
		endif;
	}



	//member_type
	function member_type_index()
	{
		if($_POST) {
			if($this->model_member_type->add()=='true') {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Member Type saved successfully.</div>');
				redirect('administrator/master/member_type_index');
			} else if($this->model_member_type->add()=='pk') {
				$this->session->set_flashdata('message', '<div class="alert alert-warning">Member Type Name Already Exist Please Enter another Member Type Name</div>');
				redirect('administrator/master/member_type_index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/master/member_type_index');
			}
		} else {
			$mt['lists'] = $this->model_member_type->getAll();
			$data['title'] = "Member Type";
			$data['content'] = $this->load->view('administrator/master/member_type/view', $mt, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function member_type_edit($member_type_code='')
	{
		if($member_type_code=='') {
			redirect(site_url('administrator/master/member_type_index'));
		} elseif($_POST) {
			$this->form_validation->set_rules('member_type_name', 'name', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$mt['records']=$this->model_member_type->fetchData($member_type_code);
				$data['title'] = "Edit Member Type";
				$data['content'] = $this->load->view('administrator/master/member_type/view', $mt, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_member_type->update()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Member Type Updated successfully.</div>');
					redirect('administrator/master/member_type_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update.</div>');
					redirect('administrator/master/member_type_edit/'.$member_type_code);
				}
			}
		} else {
			$mt['records']=$this->model_member_type->fetchData($member_type_code);
			$data['title'] = "Edit Member Type";
			$data['content'] = $this->load->view('administrator/master/member_type/edit', $mt, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function member_type_del($member_type_code)
	{
		$this->model_member_type->del($member_type_code);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Member Type Deleted Successfuly</div>');
		redirect('administrator/member_type');
	}

	function member_type_update_ajax()
	{
		$this->model_member_type->update_ajax();
	}






	//gis
	function gis_index()
	{
		$gc['chart'] = $this->model_Gis->get_gis_chart();
		$data['title']='Gis Chart';
		$data['content'] = $this->load->view('administrator/gis/chart', $gc, true);
		$this->load->view('administrator/default_template', $data);
	}

	function gis_chart_save()
	{
		$rows = $_POST['data'];
		$error = '';
		$values = '';
		foreach ($rows as $row) :

			if(isset($row['for_year']) && isset($row['entry'])) :
				$check_av = $this->db->query("SELECT * FROM master_gis_chart WHERE `for_year`='".$row['for_year']."' and `year_of_entry`='".$row['entry']."'");
				if($check_av->num_rows() > 0) {
					$error .= 'Chart available for year '.$row['for_year'].' and year of entry '.$row['entry'].".<br />";
				}
			endif;

			if(isset($row['for_year']) == '' || strlen($row['for_year']) > 4 || isset($row['entry']) == '' || strlen($row['entry']) > 4 || isset($row['jan']) == '' || isset($row['feb']) == '' || isset($row['mar']) == '' || isset($row['apr']) == '' || isset($row['may']) == '' || isset($row['jun']) == '' || isset($row['jul']) == '' || isset($row['aug']) == '' || isset($row['sep']) == '' || isset($row['oct']) == '' || isset($row['nov']) == '' || isset($row['dec']) == '') :
				
				if(!isset($row['for_year']) || $row['for_year'] == '') :
					$error .= 'For year should not be blank.<br />';
				else :
					if(strlen($row['for_year']) > 4) :
						$error .= 'For year is not in correct format.<br />';
					endif;
				endif;

				if(!isset($row['entry']) || $row['entry'] == '') :
					$error .= 'Entry should not be blank.<br />';
				else :
					if(strlen($row['entry']) > 4) :
						$error .= 'Entry is not in correct format.<br />';
					endif;
				endif;

				if(!isset($row['jan']) || $row['jan'] == '') :
					$error .= 'January value should not be blank. \n ';
				endif;
				if(!isset($row['feb']) || $row['feb'] == '') :
					$error .= 'February value should not be blank.<br />';
				endif;
				if(!isset($row['mar']) || $row['mar'] == '') :
					$error .= 'March value should not be blank.<br />';
				endif;
				if(!isset($row['apr']) || $row['apr'] == '') :
					$error .= 'April value should not be blank.<br />';
				endif;
				if(!isset($row['may']) || $row['may'] == '') :
					$error .= 'May value should not be blank.<br />';
				endif;
				if(!isset($row['jun']) || $row['jun'] == '') :
					$error .= 'June value should not be blank.<br />';
				endif;
				if(!isset($row['jul']) || $row['jul'] == '') :
					$error .= 'July value should not be blank.<br />';
				endif;
				if(!isset($row['aug']) || $row['aug'] == '') :
					$error .= 'August value should not be blank.<br />';
				endif;
				if(!isset($row['sep']) || $row['sep'] == '') :
					$error .= 'September value should not be blank.<br />';
				endif;
				if(!isset($row['oct']) || $row['oct'] == '') :
					$error .= 'October value should not be blank.<br />';
				endif;
				if(!isset($row['nov']) || $row['nov'] == '') :
					$error .= 'November value should not be blank.<br />';
				endif;
				if(!isset($row['dec']) || $row['dec'] == '') :
					$error .= 'December value should not be blank.<br />';
				endif;
			else :
				$values.="('".mysql_real_escape_string($row['for_year'])."', '".mysql_real_escape_string($row['entry'])."', '".mysql_real_escape_string($row['jan'])."', '".mysql_real_escape_string($row['feb'])."', '".mysql_real_escape_string($row['mar'])."', '".mysql_real_escape_string($row['apr'])."', '".mysql_real_escape_string($row['may'])."', '".mysql_real_escape_string($row['jun'])."', '".mysql_real_escape_string($row['jul'])."', '".mysql_real_escape_string($row['aug'])."', '".mysql_real_escape_string($row['sep'])."', '".mysql_real_escape_string($row['oct'])."', '".mysql_real_escape_string($row['nov'])."', '".mysql_real_escape_string($row['dec'])."'), ";
			endif;

			if($error != '') :
				break;
			endif;
		endforeach;

		if($error != '') :
			echo $error;
		else :
			$values = substr($values, 0, -2);
			$query = $this->db->query("INSERT INTO master_gis_chart (`for_year`, `year_of_entry`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`) VALUES $values");
			if($query) {
				echo "Added successfully";
			} else {
				echo "Error Occured.";
			}
		endif;
	}

	function gis_chart_update()
	{
		$value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];

        switch ($column) {
            case '2':
                $update_column='jan';
                break;
            case '3':
                $update_column='feb';
                break;
            case '4':
                $update_column='mar';
                break;
            case '5':
                $update_column='apr';
                break;
            case '6':
                $update_column='may';
                break;
            case '7':
                $update_column='jun';
                break;
            case '8':
                $update_column='jul';
                break;
            case '9':
                $update_column='aug';
                break;
            case '10':
                $update_column='sep';
                break;
            case '11':
                $update_column='oct';
                break;
            case '12':
                $update_column='nov';
                break;
            case '13':
                $update_column='dec';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
           $update_column => $value
        );
        if(!empty($value)){
    	 	$this->db->where('id', $row_id);
	        $this->db->update('master_gis_chart', $data);
	        echo $value;
        } else {
        	$arr=$this->fetchData($row_id);
        	echo $arr[0][$update_column];
        }
	}

	function fetchData($id) {
 		$query = $this->db->get_where('master_gis_chart', array('id' => $id));
 		return $query->result_array();
 	}

 	//district
 	function district_index()
	{
		$data['title'] = "Districts";
		$data['content'] = $this->load->view('administrator/master/district/index', '', true);
		$this->load->view('administrator/default_template', $data);
	}

	function district_save()
	{
		if($_POST) {
			$ret=$this->model_District->add();
			if($ret=='true') {
				$this->session->set_flashdata('message', '<div class="alert alert-success">District saved successfully.</div>');
				redirect('administrator/master/district_index');
			}else if($ret=='PK') {
				$this->session->set_flashdata('message', '<div class="alert alert-warning">District Already Exists.</div>');
				redirect('administrator/master/district_index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/master/district_index');
			}
		} else {
			redirect('administrator/master/district_index');
		}
	}

	function district_del($district_code) {
		$this->model_District->del($district_code);
		$this->session->set_flashdata('message', '<div class="alert alert-danger">District Deleted Successfully</div>');
		redirect('administrator/master/district_index');
	}

	function district_update_ajax(){
		$this->model_District->update_ajax();
	}


	//member
	function member_index() {
		if($_POST) {			
			if ($this->form_validation->run('member_add_form') == FALSE) {
				$dp['lists'] = $this->model_member->getAll();
				$data['title'] = "Member";
				$data['content'] = $this->load->view('administrator/master/member/add', $dp, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_member->add()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Member added successfully.</div>');
					redirect('administrator/master/member_index');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during insertion.</div>');
					redirect('administrator/master/member_index');
				}
			}
		} else {
			$dp['lists'] = $this->model_member->getAll();
			$data['title'] = "Add Member";
			$data['content'] = $this->load->view('administrator/master/member/add', $dp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function member_view() {
		$dp['lists'] = $this->model_member->getAll();
		$data['title'] = "Members Legend";
		$data['content'] = $this->load->view('administrator/master/member/view', $dp, true);
		$this->load->view('administrator/default_template', $data);
	}

	function member_del($member_code) {
		$this->model_member->del($member_code);
		$this->session->set_flashdata('message', '<div class="alert alert-danger">Member Deleted Successfully</div>');
		redirect('administrator/master/member_index');
	}

	function member_edit($member_code='') {
		if($member_code=='') {
			redirect(site_url('administrator/master/member_index'));
		} elseif($_POST) {	
			if ($this->form_validation->run('member_edit_form') == FALSE) {
				$member['records']=$this->model_member->fetchData($member_code);
				$data['title'] = "Edit Member";
				$data['content'] = $this->load->view('administrator/master/member/edit', $member, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_member->update()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Member details have been modified successfully.</div>');
					redirect('administrator/master/member_edit/'.$member_code);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update. Please try again.</div>');
					redirect('administrator/master/member_edit/'.$member_code);
				}
			}
		} else {
			$member['records']=$this->model_member->fetchData($member_code);
			$data['title'] = "Edit Member";
			$data['content'] = $this->load->view('administrator/master/member/edit', $member, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function member_update() {
		if($_POST) {
			$this->form_validation->set_rules('member_name', 'member name', 'required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('mobile_no1', 'mobile no1', 'required');
			$this->form_validation->set_rules('mobile_no2', 'mobile no2', 'required');
			$this->form_validation->set_rules('cor_address', 'cor address', 'required');				
			$this->form_validation->set_rules('per_address', 'per address', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
			$this->form_validation->set_rules('passwrd', 'passwrd', 'required|matches[copasswrd]');
			$this->form_validation->set_rules('copasswrd','copasswrd', 'required');
			$this->form_validation->set_rules('Branch_Code', 'Branch Code', 'required|callback_check_default');
			$this->form_validation->set_rules('member_type_code', 'member type code', 'callback_check_default');
			$this->form_validation->set_rules('desg_code', 'department code', 'callback_check_default');
			$this->form_validation->set_rules('member_status', 'member status', 'callback_check_default');	
			if ($this->form_validation->run() == FALSE) {
				$dp['lists'] = $this->model_member->getAll();
				$data['title'] = "Member";
				$data['content'] = $this->load->view('administrator/member/view', $dp, true);
				$this->load->view('administrator/default_template', $data);
			} else {
				if($this->model_member->update()) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Member Updated successfully.</div>');
					redirect('administrator/master/member_view');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during update.</div>');
					redirect('administrator/master/member_view');
				}
			}
		} else {
			$dp['lists'] = $this->model_member->getAll();
			$data['title'] = "Member";
			$data['content'] = $this->load->view('administrator/master/member/view', $dp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function settings()
	{
		$this->load->model('administrator/model_master');
		if($_POST) :
			foreach ($_POST as $key => $value) {
				update_option($key, $value);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success">Settings Updated successfully.</div>');
			redirect('administrator/master/settings');
		else :
			$data['title'] = "Settings";
			$data['content'] = $this->load->view('administrator/master/settings/index', '', true);
			$this->load->view('administrator/default_template', $data);
		endif;
	}

	function check_default($str) {
		if ($str == "0") {
			$this->form_validation->set_message('check_default', 'The %s field must be selected.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}