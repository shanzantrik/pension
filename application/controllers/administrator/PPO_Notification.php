<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class ppo_notification extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_notification');
	}

	function index()
	{
		$data['title'] = "File Allocated From Director";
		$dv['da']=$this->model_notification->getDA_PPO();
		$dv['records']=$this->model_notification->getNotificationfromDirector();
		$data['content'] = $this->load->view('administrator/notification/from_director', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}
}
?>