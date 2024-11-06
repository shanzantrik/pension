<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class disburser extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->model(array('administrator/model_pension'));
		$this->load->helper(array('base'));
	}

	function superannuation_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Superannuation_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Superannuation pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}
	
	function compulsory_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Compulsory_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Superannuation pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function voluntary_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Voluntary_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Voluntary retirement pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function invalid_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Invalid_Retirement_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Invalid retirement pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function absorption_in_autonomous_body_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Absorption_in_autonomous_body_pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Absorption in autonomous body pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function disability_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Disability_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Disability pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function extraordinary_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Extraordinary_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Extraordinary pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function liberalised_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Liberalised_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Liberalised pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function dependent_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Dependent_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Dependent pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function parents_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Parents_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Parents pension";
			$data['content'] = $this->load->view('administrator/pension/report/disburser', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}
}