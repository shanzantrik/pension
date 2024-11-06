<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inside extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		//$this->load->model('auth/model_auth');
		$this->load->model(array('administrator/model_pension'));
		$this->load->helper(array('base'));
	}

	function index()
	{
		redirect(site_url('administrator/pension/file'));
	}

	function superannuation_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Superannuation_Pension') {
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] =$this->pensioner;
			$data['title'] ="Superannuation Pension";
			$data['content'] =$this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function compulsory_retirement_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Compulsory_Retirement_Pension'){
			redirect(site_url('administrator/pension/file'));
		} else {
			$this->load->library('Pensioner', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->pensioner;
			$data['title'] = "Superannuation Pension";
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function normal_family_pension($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Normal_Family_Pension') {
			redirect(site_url('administrator/pension/file'));
		}else{
			$this->load->library('Sanjay', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->sanjay;
			//print_r($vrp['values']->dor);
			$dor_y=explode('-',$vrp['values']->dor);
			if($dor_y[0]>2006){
           //6th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "Normal Family Pension";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/normal_family_pension_06_inside', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}elseif($dor_y[0]<2006){
           //5th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "Normal Family Pension";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/normal_family_pension_05_inside', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}
        }
	}

	function nps($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='NPS') {
			redirect(site_url('administrator/pension/file'));
		}else{
			$this->load->library('Sanjay', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->sanjay;
			$dor_y=explode('-',$vrp['values']->dor);
			if($dor_y[0]>2006){
           //6th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "NPS";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/nps_06', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}elseif($dor_y[0]<2006){
           //5th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "NPS";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/nps_05', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}
        }
	}

	function death_gratuity($serial_no)
	{
		$cop = $this->model_pension->get_pension_class($serial_no);
		if($cop!='Death_Gratuity') {
			redirect(site_url('administrator/pension/file'));
		}else{
			$this->load->library('Sanjay', array('serial_no'=>$serial_no));
			$vrp['values'] = $this->sanjay;
			$dor_y=explode('-',$vrp['values']->dor);
			if($dor_y[0]>2006){
           //6th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "death_gratuity";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/death_gratuity_06', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}elseif($dor_y[0]<2006){
           //5th pay commission
            $vrp['account_enfacement'] ="false";
			$data['title'] = "Death_Gratuity";
			$data['content'] = $this->load->view('administrator/pension/report/family/inside/death_gratuity_05', $vrp, true);
			$this->load->view('administrator/default_template', $data);
			}
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
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
			$data['content'] = $this->load->view('administrator/pension/report/inside_ap', $vrp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}
}