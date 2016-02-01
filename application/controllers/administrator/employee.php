<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/model_auth');
		$this->load->helper(array('designation', 'department', 'base'));
		$this->load->model(array('administrator/model_employee'));
	}

	function index()
	{
		$employees['lists'] = $this->model_employee->index();
		$employees['total_emolument'] = $this->model_employee->getTotalEmolument();
		$data['title'] = "Employee Management System";
		$data['content'] = $this->load->view('administrator/employee/index', $employees, true);
		$this->load->view('administrator/default_template', $data);
	}

	function add()
	{
		if($_POST) {
			if($this->form_validation->run('employee_add_form')==FALSE) {
				$data['title'] = "Add Employee";
				$data['content'] = $this->load->view('administrator/employee/add', '', true);
				$this->load->view('administrator/default_template', $data);
			} else {
				$doj = explode("-", $this->security->xss_clean($this->input->post('doj')));
				$yearOfJoining = $doj[0];
				$pathToUpload = 'uploads/employee/'.$yearOfJoining."/";
			    if ( ! file_exists($pathToUpload) ) {
			        $create = mkdir($pathToUpload, 0777, TRUE);
			    }

	            $this->load->library('upload');

            	$fileName = date('Y_m_d_h_i_s');

            	$config['upload_path'] = $pathToUpload;
	            $config['allowed_types'] = 'gif|jpg|png|pdf';
	            $config['max_size'] = '0';
	            $config['max_width']  = '5120';
	            $config['max_height']  = '3840';
	            $config['file_name'] = $fileName;

	            $this->upload->initialize($config);
                if ($this->upload->do_upload('photograph')) {
                    $data = $this->upload->data();
                } else {
                    $errors = $this->upload->display_errors();
                }

                if(!empty($errors)) {
	            	$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$errors.'</div>');
	            	redirect(site_url('administrator/receipt/add'));
	            } else {
	            	//call model to insert data
	            	 $filePath = $yearOfJoining."/".$data['file_name'];
					if($this->model_employee->add($filePath)) {
						$this->session->set_flashdata('message', '<div class="alert alert-success">Employee add successfully.</div>');
						redirect('administrator/employee/index');
					} else {
						@unlink($data['full_path']);
						$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
						redirect('administrator/employee/add');
					}
	            }
				
			}
		} else {
			$data['title'] = "Add Employee";
			$data['content'] = $this->load->view('administrator/employee/add', '', true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function edit()
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) {
			redirect(site_url('administrator/employee/index'));
		} else {
			if($_POST) {
				if($this->form_validation->run('employee_add_form')==FALSE) {
					$ee['lists'] = $this->model_employee->getEmployeeDetails($id);
					$data['title'] = "Edit Employee";
					$data['content'] = $this->load->view('administrator/employee/edit', $ee, true);
					$this->load->view('administrator/default_template', $data);
				} else {
					$filePath = '';
					if($_FILES['photograph']['name']) {
						//exists
						$filePathS = $this->model_employee->getImagePath($id);

						$doj = explode("-", $this->security->xss_clean($this->input->post('doj')));
						$yearOfJoining = $doj[0];
						$pathToUpload = 'uploads/employee/'.$yearOfJoining."/";
					    if ( ! file_exists($pathToUpload) ) {
					        $create = mkdir($pathToUpload, 0777, TRUE);
					    }

					    $this->load->library('upload');

		            	$fileName = date('Y_m_d_h_i_s');

		            	$config['upload_path'] = $pathToUpload;
			            $config['allowed_types'] = 'gif|jpg|png|pdf';
			            $config['max_size'] = '0';
			            $config['max_width']  = '5120';
			            $config['max_height']  = '3840';
			            $config['file_name'] = $fileName;

			            $this->upload->initialize($config);
			            if ($this->upload->do_upload('photograph')) {
		                    $data = $this->upload->data();
		                } else {
		                    $errors = $this->upload->display_errors();
		                }

		                if(!empty($errors)) {
			            	$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$errors.'</div>');
			            	redirect(site_url('administrator/receipt/add'));
			            } else {
			            	@unlink('uploads/employee/'.$filePathS);
			            }
			            $filePath = $yearOfJoining."/".$data['file_name'];
					} else {
						//not exists
						$filePath = '';
					}

					if($this->model_employee->update($id, $filePath)) {
						$this->session->set_flashdata('message', '<div class="alert alert-success">Employee Update successfully.</div>');
						redirect('administrator/employee/edit/'.$id);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
						redirect('administrator/employee/edit/'.$id);
					}
				}
			} else {
				$ee['lists'] = $this->model_employee->getEmployeeDetails($id);
				$data['title'] = "Edit Employee";
				$data['content'] = $this->load->view('administrator/employee/edit', $ee, true);
				$this->load->view('administrator/default_template', $data);
			}
		}
	}

	function view()
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) {
			redirect(site_url('administrator/employee/index'));
		} else {
			$ev['lists'] = $this->model_employee->getEmployeeDetails($id);
			$data['title'] = "View Employee";
			$data['content'] = $this->load->view('administrator/employee/view', $ev, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function budgetForYear()
	{
		if(isset($_POST['save'])) {
			if($this->model_employee->add_budget()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Budget added successfully.</div>');
				redirect('administrator/employee/budgetForYear');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
				redirect('administrator/employee/budgetForYear');
			}
		} elseif (isset($_POST['search'])) {
			//echo $_POST['from']."-".$_POST['to'];

			$bfy['totalEmolument'] = $this->model_employee->getTotalEmolument();
			$bfy['getExtraBudget'] = $this->model_employee->getExtraBudget();
			//$bfy['getTotal'] = $this->model_employee->getTotal();
			$data['title'] = "Budget for Year ".$_POST['from']."-".$_POST['to'];
			$data['content'] = $this->load->view('administrator/employee/budget', $bfy, true);
			$this->load->view('administrator/default_template', $data);

			
		} else {
			$bfy['getRetirementforYear'] = $this->model_employee->getRetirement();
			$bfy['totalEmolument'] = $this->model_employee->getTotalEmolument();
			$bfy['getExtraBudget'] = $this->model_employee->getExtraBudget();
			//$bfy['getTotal'] = $this->model_employee->getTotal();
			$data['title'] = "Budget for Year";
			$data['content'] = $this->load->view('administrator/employee/budget', $bfy, true);
			$this->load->view('administrator/default_template', $data);
		}
	}

	function getAllEmployee()
	{
		$query = $this->db->query("SELECT * FROM employees_new");
		$data['data'] = array();
		foreach ($query->result_array() as $row) {
		   	array_push($data['data'], $row);
		}
		echo json_encode($data);
	}

	function saveEmployee()
	{
		$rows = $_POST['data'];
		$values = '';
		foreach ($rows as $row) {
			$values.="('".$row['name']."', '".$row['fhname']."', '".$row['designation']."', '".$row['dob']."', '".$row['doj']."', '".$row['dor']."', '".$row['sex']."', '".$row['category']."', '".$row['appoint_as']."', '".$row['pay_band']."', '".$row['grade_pay']."', '".$row['increament_amount']."', '".$row['total_pay']."', '".$row['sca']."', '".$row['other_allowance']."', '".$row['da']."', '".$row['total_allowance']."', '".$row['total_emolument']."', '".$row['account_no']."', '".$row['bank_name']."', '".$row['branch']."', '".$row['ddo_address']."'), ";
		}

		$values = substr($values, 0, -2);
		$query = $this->db->query("INSERT INTO employees (`name`, `fhname`, `designation`, `dob`, `doj`, `dor`, `sex`, `category`, `appoint_as`, `pay_band`, `grade_pay`, `increament_amount`, `total_pay`, `sca`, `other_allowance`, `da`, `total_allowance`, `total_emolument`, `account_no`, `bank_name`, `branch`, `ddo_address`) VALUES $values");
		if($query) {
			echo "Added successfully";
		} else {
			echo "Error Occured.";
		}
	}

	function _check_default($str)
	{
		if ($str == "0") {
			$this->form_validation->set_message('_check_default', 'The %s field must be selected.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}