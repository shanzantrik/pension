<?php 
/**
* Director Notifications Controller 
*/
class issue extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->helper('base');
		$this->load->model(array('administrator/model_notification','administrator/model_receipt','administrator/model_issue'));
	}

	//Notification Index Page
	function index()
	{
		if (!empty($_GET['id'])) {
			$department=$_GET['id'];
			$dv['records'] = $this->model_notification->getFilterIpsIssue($department);
			$dv['records1'] = $this->model_notification->getFilterGisIssue($department);
			$dv['records2'] = $this->model_notification->getFilterPensionIssue($department);
			$data['title'] = "All Files";
			$data['content'] = $this->load->view('administrator/notification/issue_index', $dv, true);
			$this->load->view('administrator/filtered', $data);
		}
		else{
			$dv['records'] = $this->model_notification->getIssueNotification();
			$dv['records1'] = $this->model_notification->getIssueNotification_fromgis();
			$dv['records2'] = $this->model_notification->getIssueNotification_frompension();
			$data['title'] = "All Files";
			$data['content'] = $this->load->view('administrator/notification/issue_index', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function confirm_issue()
	{
		$file=$_GET['file'];
		$json=$this->model_notification->confirm_issue($file);
		echo json_encode($json);
	}

	function dispatch_pre($file)
	{
		$file=base64_decode($file);
	    $file_no=$file;
		//$file_no = str_replace("-", "/", $file);
		$dv['data'] = $this->model_receipt->getFileDetail($file_no);
		$data['title'] = "File Details";
		$dv['records']=$this->model_notification->pensionee_info($file);
		if (empty($dv['records']['details'])) {
			
			$dv['records']=$this->model_issue->getData($file_no);
			// ====================================================================
			$this->load->library('Pensioner', array('case_no'=>$file_no));
			$dv['values'] = $this->pensioner;
			// ====================================================================
			$data['content'] = $this->load->view('administrator/issue/dispatch_pre_ips', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
		else{
			$data['content'] = $this->load->view('administrator/issue/dispatch_pre', $dv, true);
			$this->load->view('administrator/default_template',$data);
		}
	}

	function save_issue()
	{
		$srz= serialize($_POST['chk']);
		$file_no=$_POST['file_no'];
		$q=$this->db->get_where('issue',array('file_no'=>$file_no));
		if($q->num_rows()>0){
			$msg='File Already Issued';
		}
		else
		{
			$data=array('file_no'=>$file_no,'copies'=>$srz);
			$this->db->insert('issue',$data);	
			$this->db->where('file_no',$file_no);
			$this->db->update('file_status',array('notification'=>'terminated','status'=>'Issued on '.date('Y-m-d')));
			$this->db->insert('file_tracking_details',array('file_status'=>'Issued on '.date('Y-m-d'),'file_no'=>$file_no,'Branch'=>'To AG/Treasurey/Department','member_code'=>$this->session->userdata('member_code')));
			$msg='File Issued Successfully';	
		}
		$this->session->set_flashdata('message',"<div class='alert alert-success'>$msg</div>");
		redirect('administrator/issue/index');
	}

	function from_ips()
	{
		$dv['records'] = $this->model_notification->getIssueNotification_fromIps();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/notification/issue_index', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function view_issued_file()
	{
        $dv['lists'] = $this->model_notification->getAll_issued_file();
		$data['title'] = "All Files";
		$data['content'] = $this->load->view('administrator/issue/view_issued_file', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	

	function update_ajax()
	{
		$this->model_issue->update_ajax();
	}	
}