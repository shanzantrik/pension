<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class receipt extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/model_auth');
		$this->load->model(array('administrator/model_receipt'));
		$this->load->helper(array('branch_master', 'department', 'base', 'designation'));
	}

	function index()
	{
		$dfno=$this->security->xss_clean($this->input->post('dfno'));
		if($_POST) {
			$ret=$this->model_receipt->add_receipt();
			if($ret=='true') {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Receipt saved successfully.</div>');
				$data['title'] = "Confirm View";
				$dv['dfno']=$dfno;
				$dv['records']= $this->model_receipt->search($dfno);
				$dv['file']=$this->model_receipt->search_file($dfno);
				$data['content'] = $this->load->view('administrator/receipt/confirm_view', $dv, true);
				$this->load->view('administrator/default_template', $data);
			} else if($ret=='PK'){
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Department Forwarding Number Already Exists.</div>');
				redirect('administrator/receipt');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some Error Occures Please Try Again.</div>');
				redirect('administrator/receipt');
			}
		} else {
			$data['title'] = "Add Receipt";
			$dv['branch']=$this->model_receipt->getBranch();
			$data['content'] = $this->load->view('administrator/receipt/add', $dv, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function search()
	{
		$data['title'] = "Receipt Search";
		$data['content'] = $this->load->view('administrator/receipt/search', '', true);
		$this->load->view('administrator/default_template', $data);
	}

	function search_result()
	{
		$dfno=$_GET['dfno'];
		$no=$this->model_receipt->check($dfno);
		if($no==0) {
			echo "<br /><br />No record";
		} else {
			$data['records']= $this->model_receipt->search($dfno);
			$data['file']=$this->model_receipt->search_file($dfno);
			$this->load->view('administrator/receipt/view', $data);
		}
	}

	function getDeptName()
	{
		$val = getDepartmentName($_POST['deptCode']);
		$arr = explode(" ", $val);
		$return = '';
		foreach ($arr as $key => $value) {
			$return.=substr($value, 0, 1);
		}
		echo $return;
	}

	function update()
	{
		$srl=$_GET['srl'];
		$file_no=$_GET['file_no'];
		$data=array(
				'emp_code'=>$_GET['emp_code'],
				'pensionee_name'=>$_GET['name'],
				'designation'=>$_GET['designation'],
			);
		$this->model_receipt->update($srl,$data);
		//$this->model_receipt->update_token($file_no,$this->model_receipt->getTokenNo($file_no));

		$q=$this->db->query("select * from pension_receipt_file_master where srl_No=$srl");
		foreach($q->result() as $key){
			$ecode=$key->emp_code;
			$name=$key->pensionee_name;
		}
		$json=array('ecode'=>$ecode,'pensionee_name'=>$name);
		echo json_encode($json);
	}

	function edit($srl){
		$dv['records']=$this->model_receipt->edit($srl);
		$data['title'] = "Edit File Details";
		$data['content'] = $this->load->view('administrator/receipt/edit', $dv, true);
		$this->load->view('administrator/default_template', $data);
	}

	function update_data(){
		$srl=$this->security->xss_clean($this->input->post('srl'));
	}

	function check_default($str) {
		if ($str == "0") {
			$this->form_validation->set_message('check_default', 'The %s field must be selected.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_employee_code() {
		$dept=$this->input->post('branch_code');
		$empcode=$this->input->post('empcode');
		$status = array();
		$sql="SELECT emp_code from pension_receipt_file_master WHERE   emp_code='$empcode' and branch_code=$dept";
		$q=$this->db->query($sql);

		if($q->num_rows() > 0) {
			$json=array('message'=>'Problem');
		}
		else{
			$json=array('message'=>'ok');
		}
		echo json_encode(@$json);
	}

	function check_file_no() {
		$dforwardno=$this->input->post('df');
		$fileno=$this->input->post('fileno');
		$status = array();
		$q=$this->db->query("select dept_forw_no,emp_code from  pension_receipt_file_master where file_No='$fileno'");
		if($q->num_rows() > 0) {
			$json=array('message'=>'Problem');
		}
		echo json_encode(@$json);
	}
	function getPensioner_Document()
	{
	    $chk = $_POST['chk'];
		//$payCommission = $this->input->post('payCommission');
		$this->db->select('doc_no,doc_name');
    	$this->db->from('master_document');
    	$this->db->where(array('status'=>$chk));
    	$result = $this->db->get();
    	echo '<option value="0">--Select Document--</option>';
    	foreach ($result->result_array() as $value) {
    		echo '<option value="'.$value['doc_no'].'">'.$value['doc_name'].'</option>';
    	}
//console.log($chk);
		/*$this->load->model('administrator/model_service_book');
		if($this->model_service_book->getPensioner_Document($chk)) {
			echo "ok";
		} else {
			echo "problem";
		}
*/		
		
/*$bkid=$_POST["chk"];
$result=mysql_query("select doc_no FROM master_document where member_code ='$bkid'"); 
while($row=mysql_fetch_array($result))
  {
	 echo"<option>$row[doc_no]</option>";
    }*/

		
		
	}
	function search_report(){
		$view['lastFiveDFN'] = $this->model_receipt->lastFiveDFN();
		$data['title'] = "Search By Department Forwarding No";
		$data['content'] = $this->load->view('administrator/receipt/search_report', $view, true);
		$this->load->view('administrator/default_template',$data);
	}

	function df_search_view(){
		$dfno=$_GET['dfno'];
		$no=$this->model_receipt->check($dfno);
		if($no==0) {
			echo "<div class='alert alert-danger'>No record</div>";
		} else {
				$data['dfno']=$dfno;
				$data['records']= $this->model_receipt->search($dfno);
				$data['file']=$this->model_receipt->search_file($dfno);
				$this->load->view('administrator/receipt/confirm_view', $data);
		}
	}
	function get_address(){
		$d=$_GET['dept'];
		$q=$this->db->get_where('master_department',array('dept_code'=>$d));
		$x=$q->result();
		$json=array('address'=>$x[0]->address);
		echo json_encode($json);
	}
	//################## BIKRAM ############################
	function print_challan($file_no)
	{
		$file_no=base64_decode($file_no);
		$pid['values'] = $this->model_receipt->getTokenNo($file_no);
		$pid['token_no']=$pid['values'][0]->token_no;

		$pid['values1'] = $this->model_receipt->getDept($file_no);
		//$pid['values1']['0']['dept_forw_no']);

		$data['title'] = "Challan Report";
	    $data['content'] = $this->load->view('administrator/receipt/print_challan_report',$pid, true);
	    $this->load->view('administrator/default_template', $data);
	}

	function pensionser_file_upload($file_no='') {
        $file_no=base64_decode($file_no);
		if (isset($_POST['submit'])){
			$array = array('/');
			$folderName = str_replace($array, "-", $_POST['file_no']);
			$pathToUpload = 'uploads/pensioner_file/'.$folderName."/";
		    if (! file_exists($pathToUpload) ){
		        $create = mkdir($pathToUpload, 0777, TRUE);
		    }
            $this->load->library('upload');
            $chk = $this->input->post('check');
 			//$files = array();
            foreach($_FILES as $field => $file) {
            	$fileRow = str_replace("file_", "", $field);				
            	$fileDesc = $this->input->post('file_desc_'.$fileRow);
				//print_r($fileDesc);
            	$typical = $this->input->post('typical'.$fileRow); 
            	$array = array(' ', '/', '-', '\'', '@');
            	$fileName = str_replace($array, "_", $fileDesc);
            	//echo $fileName;
            	$config['upload_path'] =$pathToUpload;
	            $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|jpeg';
	            $config['max_size'] ='0';
	            $config['max_width']  = '5120';
	            $config['max_height']  = '3840';
	            $config['file_name'] = $fileName;
				//print_r($config['file_name']);
			
                $f = array();
	            $f['file_desc'] = $fileDesc;
                $this->upload->initialize($config);
                if($file['error'] == 0) {
                    if ($this->upload->do_upload($field)) {
                        $data = $this->upload->data();
                        $uploadPath= $pathToUpload.$data['file_name'];
                        $sql=$this->db->query("select * from pensioner_files_details where case_no='".$_POST['file_no']."' 
                        	and doc_code= '$fileDesc'");
                   		if($sql->num_rows()==1){
                   		   	foreach($sql->result() as $fileBase){
	                           	$filePath=$fileBase->files;
	                           	$r=@unlink($filePath);
                   			}
	               			$data=array('files'=>$uploadPath,'ftype'=>$typical);
	               			$this->db->query("update pensioner_files_details set files='".$uploadPath."' where case_no='".$_POST['file_no']."'");
						} else {
  							$serial_no = $this->db->query('SELECT serial_no FROM pensioner_personal_details WHERE case_no="'.$_POST['file_no'].'"')->row();
							$data=array('files'=>$uploadPath, 'serial_no'=>$serial_no->serial_no, 'case_no'=>$_POST['file_no'],'doc_code'=>$fileDesc,'ftype'=>$typical,'status'=>$chk);
							print($data);
							exit();
  							$this->db->insert('pensioner_files_details',$data);
                        }
                    }
            	}
            }
            $msg=base64_encode("Files have been uploaded successfully");
            echo $msg;
            //exit();
          	redirect(site_url('administrator/receipt/pensionser_file_upload?msg='.$msg));   
        } else {
        	if(!empty($file_no)) 
			{
			    $f_no['f'] =$file_no;
        		//$f_no['f'] = str_replace("-", "/", $file_no);
				//print_r($f_no['f']);
				//exit();
        	} else {
        		$f_no['f'] = '';
        	}
        	//print_r($file_no);
		    //exit();
		 	$data['title'] = "Upload Pensioner Files";
		 	$data['content'] = $this->load->view('administrator/receipt/pensioner_file_upload', $f_no, true);
			$this->load->view('administrator/default_template', $data);
		}
              
              
	}


	function file_view($file_no) {
		$file_no=base64_decode($file_no);
		$this->load->library('image_lib');
		//$file_no = str_replace("-", "/", $file_no);
		//$file_no="Pen/AP/34779/14-15/2";
		$fd['data'] = $this->model_receipt->getFileDetail($file_no);
		$fd['files'] = $this->model_receipt->getFiles($file_no);
        if(empty($fd['files'])){
		//print_r("hellooo");
		$status=2;
		$fd['all_files']=$this->model_receipt->all_file($status);
		}else
		{
	     $status=$fd['files'][0]['status'];
		 $fd['all_files']=$this->model_receipt->all_file($status);
		}
		//exit();
		//$status=$fd['files'][0]['status'];
		//$fd['selected_file']=$this->model_receipt->selected_file();
		$data['title'] = "File View";
		$data['content'] = $this->load->view('administrator/receipt/file_view', $fd, true);
		$this->load->view('administrator/default_template', $data);
	}
	function checkFileNo() 
	{
		$case_no = $_POST['file_no'];
		$this->load->model('administrator/model_service_book');
		if($this->model_service_book->check_file_no($case_no)) {
			//echo "ok";
			$result = PPERSONALD::select('salutation')->where('case_no', $case_no)->first();
			echo $result->salutation;
		} else {
			echo "problem";
		}
	}

	public function downloads($file){
		$files=base64_decode($file);
		echo $files;
		force_download($files,file_get_contents(base_url().$files));
	}

	public function edit_register($forw_no)
	{
		//$forw_no = base64_decode($forw_no);
		//echo $forw_no;
		//exit();
		$data['title'] = "File View";
		$data['content'] = $this->load->view('administrator/receipt/edit_register', '', true);
		$this->load->view('administrator/default_template', $data);
	}
}