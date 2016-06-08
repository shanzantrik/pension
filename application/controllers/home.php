<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent:: __construct();
		$this->load->model(array('model_home'));
		$this->load->model('administrator/model_page_manager');
	}

	function index() {
		if($this->session->userdata('logged_in') != TRUE) {
			$page=$this->model_page_manager->getPageDetails_byId('Home');
			$data['title'] = $page['page_title'];
			$dv['content']=$page['codebase'];
			$data['content'] = $this->load->view('Home/index', $dv, true);
			$this->load->view('administrator/home_template', $data);
		} else {
			redirect('administrator/home');
		}
	}

	function login(){
		$this->load->view('login_view');
	}

	function doLogin() {
		$username = $this->input->post('username');
		$pass  = $this->input->post('password');
		$md5_pass = md5($pass);	
			if($this->model_home->login($username,$md5_pass)) {
				$this->member_type_redirection();
			} else {
				$this->session->set_flashdata("message", "<div class='alert alert-danger'>Member code or password doesn't match.</div>");
				$err=base64_encode('error');
				redirect(site_url('home/login').'?msg='.$err);
			}

	}

	function member_type_redirection() {

		redirect('administrator/home');
	}

	function logout() {
		$datas=array('logged_in'=>'no');
	  	$this->db->where('member_code',$this->session->userdata('member_code'));
	  	$this->db->update('pen_members',$datas);
		$login_data = array('member_code'=>'', 'member_name'=>'', 'branch_code'=>'', 'member_type'=>'', 'logged_in'=>'FALSE','member_type_code'=>'','theme'=>'');
		$this->session->unset_userdata($login_data);
		$this->session->set_flashdata("message", "<div class='alert alert-success'>Logout Successfully.</div>");
		redirect(site_url('home/login'));
	}
	function view($page_title){
		$page_title=str_replace('_', ' ', $page_title);
		$page=$this->model_page_manager->getPageDetails_byId($page_title);
		$data['title'] = $page['page_title'];
		$dv['content']=$page['codebase'];
		$data['content'] = $this->load->view('Home/index', $dv, true);
		$this->load->view('administrator/home_template', $data);
	}
	
	
}