<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		//$this->load->model('auth/model_auth');
		$this->load->model(array('model_home'));
		$this->load->model('administrator/model_notification');
	}

	function index()
	{
		$data['title'] = "Dashboard";
		$wd['records']=$this->model_home->getAllWoid();
		$wd['woid']=$this->model_home->getWoid();
		$data['content'] = $this->load->view('administrator/home_view', $wd, true);
		$this->load->view('administrator/default_template', $data);
	}

	function save_weather()
	{
		$q=$this->model_home->save_weather();
		if($q==true){
			$this->session->set_flashdata('message','<div class="alert alert-success">Weather Place Changed Successfully</div>');
			redirect('administrator/home');
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-warning">Error Occures Durrig Saving,Please Try again</div>');
			redirect('administrator/home');	
		}
	}

	function change_theme($theme)
	{
		$this->model_home->change_theme($theme);
		redirect($_GET['path']);
	}
	
}