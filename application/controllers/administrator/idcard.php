<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed.');

class idcard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->model('administrator/model_idcard');
		$this->load->helper(array('base'));
	}

	function index()
	{
		$i['design'] = $this->model_idcard->getIdCardDesign();
		$data['title'] = "ID Card";
		$data['content'] = $this->load->view('administrator/idcard/index', $i, true);
		$this->load->view('administrator/default_template', $data);
	}

	function issue()
	{
		$i['design'] = $this->model_idcard->getIdCardDesign();
		$data['title'] = "Issue ID Card";
		$data['content'] = $this->load->view('administrator/idcard/issue', $i, true);
		$this->load->view('administrator/default_template', $data);
	}

	function uploadBackgroundDesign()
	{
		$targetFolder = realpath('uploads/idcard');
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile, $targetFile);
				echo '1';
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	function saveTemplateforIDcard()
	{
		$data = array('setting_value'=>$this->input->post('content'));
		$this->db->where('setting_name', 'idcardDesign');
		if($this->db->update('settings', $data)) {
			echo "ok";
		} else {
			echo "failure";
		}
	}

	function checkFileNo()
	{
		$fileNo = $this->input->post('fileNo');
		$result = $this->db->query('SELECT serial_no FROM pensioner_personal_details WHERE case_no="'.$fileNo.'"');
		if($result->num_rows() <= 0){
			echo "";
		} else {
			$row = $result->row();
			echo $row->serial_no;
		}
	}

	function getValue()
	{
		$serial_no = $this->input->post('serial_no');
		$result = $this->model_idcard->getValue($serial_no);

		$array = array();
		foreach ($result[0] as $key => $value) {
			if($key == "class_of_pension") {
				$array[$key] = str_replace("_", " ", $value);
			} elseif ($key == "family_info") {
				$array[$key] = getNameofSpouse($value);
			} elseif ($key == "pay_info") {
				$pay_info = unserialize($value);

				$lp = array();
				foreach ($pay_info[0] as $k => $val) {
					$lp[$k] = $val;
				}
				$da_post=$pay_info[0]['post_DA'];
	            $da_incr=$pay_info[1]['increament_DA'];
	            $lastPay = getPay($lp, $da_post);

				$array[$key."1"] = getPay($lp,$da_post);
				$array[$key] = getPay($lp,$da_post);
				
			} elseif ($key == "net_qualifying_service") {
				list($years, $months, $days) = explode("-", $value);
				$array[$key] = $years." years ".$months." months ".$days." days";
			} else {
				$array[$key] = $value;
			}
		}
		//$array['ae1'] = $this->model_idcard->getAE($serial_no);
		$array['ae'] = $this->model_idcard->getAE($serial_no);
		$array['amount_of_pension'] = getAmountofPension($serial_no);
		$a['details'] = array($array);
		echo json_encode($a);
	}
}