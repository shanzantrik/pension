<?php

class page_manager extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_page_manager');
	}

	function index()
	{
		$data['title'] = "Manage Content";
		$dv['records']=$this->model_page_manager->getData();
		$data['content'] = $this->load->view('pages/index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function save()
	{
		$title=$_POST['title'];
		$index=$_POST['index'];
		$icon_name=$_POST['icon_name'];
		$x=$this->model_page_manager->save($title,$index,$icon_name);
		if($x=='true'){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Page Created Successfully.</div>');
			redirect('administrator/page_manager');
		}else if($x=='PK'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Page with same title already exists!.</div>');
			redirect('administrator/page_manager');
		}
	}

	function del($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('content_manager');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Page Deleted Successfully!.</div>');
		redirect('administrator/page_manager');
	}

	function edit($id)
	{
		$data['title'] = "Edit Content";
		$dv['records']=$this->model_page_manager->getPageDetails($id);
		$data['content'] = $this->load->view('pages/edit', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function update()
	{
		$id=$_POST['id'];
		$codebase=$_POST['codebase'];
		$page_title=$_POST['page_title'];
		$ret=$this->model_page_manager->update($id,$codebase,$page_title);
		if($ret==true){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Content Updated Successfully!.</div>');
			redirect('administrator/page_manager');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occures Could not save you last savings!.</div>');
			redirect('administrator/page_manager');
		}
	}

	function update_ajax()
	{
		$this->model_page_manager->update_ajax();
	}
}