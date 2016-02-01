<?php

class notice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notice');
		$this->load->library("pagination");
		$this->load->helper('base');
	}

	function index()
	{
        if($_POST) 
        {
			if($this->model_notice->add()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Notice saved successfully.</div>');
				redirect('administrator/notice');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/notice');
			}
		} else {
			$data['title']="Notice";
			$config = array();
	        $config["base_url"] = base_url() . "index.php/administrator/notice/index";
	        $config["total_rows"] = $this->model_notice->record_count();
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 4;
	 
	        $this->pagination->initialize($config);
			
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(4) : 0;
	        
	        $dv["records"] = $this->model_notice->getData($config["per_page"], $page);
	        $dv["links"] = $this->pagination->create_links();
	        $dv['branches']=$this->model_notice->getall_branch();
	 		$data['content'] = $this->load->view('administrator/notice/index', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function del($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('notice');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Notice Deleted Successfully.</div>');
		redirect('administrator/notice/index');
	}

	function update()
	{
		$id=$_POST['edit_id'];
		$fdt=$_POST['from_date'];
		$tdt=$_POST['to_date'];
		$branch=$_POST['branch'];
		$notice=$_POST['notice'];
		$notice=strip_tags($notice, '<a><strong><em>');
		$this->db->where('id',$id);
		$data=array('from_date'=>$fdt,'to_date'=>$tdt,'member_group'=>$branch,'notice'=>$notice);
		$this->db->update('notice',$data);
		$this->session->set_flashdata('message',"<div class='alert alert-success'>Notice Updated Successfully</div>");
		redirect('administrator/notice');
	}
	
}


           
