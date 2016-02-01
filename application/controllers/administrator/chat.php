<?php 
 
class chat extends CI_Controller {

	//Global variable  
    public $outputData;		//Holds the output data for each view
	public $loggedInUser;

	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->helper('base');
	}

	public function index()
    {
		//Load the users model 
		$this->load->model('administrator/users_model');
		
		//Load the session library
		$this->load->library('session');	
		
		// Redirect if not logged
		$sessionUserID = $this->session->userdata('member_code');
		
		//Get all users
		$this->outputData['listOfUsers']	= $this->users_model->getUsers();

		$userdata  = $this->session->all_userdata();
		$this->outputData['session_dataa'] = $userdata;

		$data['title'] = "PEN-AP | Chat Window";
		$data['content'] = $this->load->view('administrator/chat/userList',$this->outputData,true);
		$this->load->view('administrator/default_template', $data);	 
    }
}