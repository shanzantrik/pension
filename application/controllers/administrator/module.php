<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class module extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->model('module/model_module');
		$this->load->model('administrator/model_member_type');
	}

	function index()
	{
		$dv['records']=$this->model_module->getModules();
		$data['title'] = "Modules";
		$dv['icons']=$this->model_module->getIcons();
		$data['content'] = $this->load->view('administrator/module/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function add_module()
	{
		$data=$this->model_module->saveModule();
		echo json_encode($data);
	}

	function add_module_from_sub()
	{
		$data=$this->model_module->saveModule_frm_sub();
		if($data=='true'){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Module Added Successfully!</div>');
			redirect('administrator/module/sub_module');
		}
		if($data='false'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Last Saving was unsuccessfully,please try again!</div>');
			redirect('administrator/module/sub_module');
		}
		if($data='PK'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Module Already Exist, Please try different name!</div>');
			redirect('administrator/module/sub_module');
		}
	}

	function update_ajax()
	{
		$this->model_module->update_ajax();
	}

	function delete($id)
	{
		$q=$this->model_module->delete($id);
		if($q){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Module Deleted Successfully!</div>');
			redirect('administrator/module');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Could Not delete the module!</div>');
			redirect('administrator/module');
		}
	}

	function sub_module()
	{
		$dv['records']=$this->model_module->get_sub_Modules();
		$data['title'] = "Sub Module";
		$dv['icons']=$this->model_module->getIcons();
		$data['content'] = $this->load->view('administrator/module/sub_module', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function save_sub_module()
	{
		if($_POST) :
			$q=$this->model_module->save_sub_module();
			if($q==true){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Sub Module Created Successfully!</div>');
				redirect('administrator/module/sub_module');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Sub Module Already Exists in this module!</div>');
				redirect('administrator/module/sub_module');
			}
		else :
			redirect('administrator/module/sub_module');
		endif;
	}

	function update_sub_module()
	{
		if($this->model_module->update_sub_module()==true){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Sub Module Updated Successfully!</div>');
			redirect('administrator/module/sub_module');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured in Updating sub module!</div>');
			redirect('administrator/module/sub_module');
		}
	}

	function delete_sub($sub_module_code)
	{
		$q=$this->model_module->delete_sub($sub_module_code);
		if($q){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Sub Module Deleted Successfully!</div>');
			redirect('administrator/module/sub_module');
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"Could Not Delete Sub module!</div>');
			redirect('administrator/module/sub_module');
		}
	}

	function assign()
	{
		$dv['records']=$this->model_member_type->getMtype();
		$dv['modules']=$this->model_module->getModules($for_assign = true);
		$data['title'] = "Assign Rules";
		$data['content'] = $this->load->view('administrator/module/assign', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function get_mod()
	{
		$mod_code=$_GET['mcode'];
		$member_type_code=$_GET['member_type_code'];

		$data['records']=$this->model_module->get_sub_modules_specific($mod_code,$member_type_code);
		$data['dv']=$this->model_module->get_sub_modules_saved($mod_code,$member_type_code);

		$data['module_code']=$mod_code;
		$data['member_type_code']=$member_type_code;
		$this->load->view('administrator/module/ajax_data_sub_module', $data);
	}

	function save_auth()
	{
		$ret=$this->model_module->save_auth();
		if($ret==true){
			redirect('administrator/module/assign?msg='.base64_encode('Module Allocated Successfully')."&alert=".base64_encode('success')."&display=".base64_encode('block'));
		} else {
			//redirect('administrator/module/assign?msg='.base64_encode('Please Select Modules first')."&alert=".base64_encode('danger')."&display=".base64_encode('block'));
			redirect('administrator/module/assign?msg='.base64_encode('Module Allocated Successfully')."&alert=".base64_encode('success')."&display=".base64_encode('block'));
		}
	}

	function get_modules()
	{
		$member_type=$_GET['member_type'];
	}

	//AJAX METHOD FOR SUB-SUB MODULES
	function get_sub_modules()
	{
		$module_id=$_GET['module_id'];
		echo json_encode($this->model_module->get_sub_modules_json($module_id));
	}
}