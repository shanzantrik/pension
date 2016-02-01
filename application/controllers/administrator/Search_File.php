<?php

class search_file extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('base');
		$this->load->model('administrator/model_Search_File');
		$this->load->model('auth/model_auth');
	}

	function search_files(){
		$data['title'] = "Search My Files";
		$data['content'] = $this->load->view('administrator/search/index', '', true);
		$this->load->view('administrator/default_template',$data);
	}
	
	function search_all(){
		$data['title'] = "Search My Files";
		$data['content'] = $this->load->view('administrator/search/search_all','', true);
		$this->load->view('administrator/default_template',$data);
	}

	function search_all_file(){
		$dept=@$_GET['dept'];
		$code=@$_GET['code'];
		$name=@$_GET['name'];
		//$data['records']=
		$data['records']=$this->model_Search_File->search_all($dept,$code,$name);
		$this->load->view('administrator/search/ajax_view_all', $data);
	}

	function search()
	{
		$from_date=@$_GET['fdt'];
		$to_date=@$_GET['tdt'];
		$type=@$_GET['radio'];
		$data['records']=$this->model_Search_File->search($from_date,$to_date,$type);
		$this->load->view('administrator/search/ajax_view', $data);
	}
	
}