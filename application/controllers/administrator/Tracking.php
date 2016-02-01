<?php 

class tracking extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->model(array('administrator/model_tracking'));
		$this->load->helper(array('branch_master', 'department'));
	}

	function index()
	{
		$recent_file = FTracking::distinct('file_no')
									->select('file_no')
									->limit(10)
									->orderBy('entry_time', 'desc')
									->get();

		$data['title'] = "File Tracking";
		$data['content'] = $this->load->view('administrator/tracking/index', compact('recent_file'), true);
		$this->load->view('administrator/default_template', $data);
	}

	function track_details()
	{
		$file=trim($_GET['file_no']);
		$no=$this->model_tracking->check_existance($file);
		if($no==0) {
			echo "<div class='alert alert-danger'>No record</div>";
		} else {
		        $data['reg']=$this->model_tracking->reg_no($file);
				$data['records']=$this->model_tracking->search_file($file);
				$this->load->view('administrator/tracking/traking_details',$data);
		}

	}
}
?>
