<?php

class transfer extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('base', 'designation'));
		$this->load->model(array('administrator/model_pension', 'administrator/model_transfer'));
	}

	function index()
	{
		if($this->input->post('search')) :
			$data['files'] = $this->model_transfer->get_all_transfer($this->input->post('type'));
		else :
			$data['files'] = $this->model_transfer->get_all_transfer();
		endif;
		$data['title'] = 'Transfer';
		$data['content'] = $this->load->view('administrator/transfer/index', $data, true);
		$this->load->view('administrator/default_template', $data);
	}

	function inside($file_no = '')
	{
		if($this->input->post('search')) :

			$file_no = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$row = $this->model_pension->check_file_no($file_no);
			if($row) :
				$this->load->library('Pensioner', array('case_no'=>$file_no));
				$index['service_details'] = $this->pensioner;
				//$index['service_details'] = $this->model_pension->get_pensioner_details($file_no);
				$index['transfer_details'] = $this->model_transfer->get_transfer_details($file_no);
				$data['title'] = 'Transfer';
				$data['content'] = $this->load->view('administrator/transfer/search_inside', $index, true);
				$this->load->view('administrator/default_template', $data);
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/transfer'));
			endif;

		elseif($this->input->post('save_transfer')) :

			if($this->model_transfer->save_transfer()) :
				$this->session->set_flashdata('message', '<div class="alert alert-success">File transfer successfully.</div>');
				redirect(site_url('administrator/transfer'));
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Something wrong while transfer.</div>');
				redirect(site_url('administrator/transfer'));
			endif;

    	elseif($this->input->post('file_no') != '' || $this->uri->segment(4)) :

			$file_no = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$row = $this->model_pension->check_file_no($file_no);
			if($row) :
				$this->load->library('Pensioner', array('case_no'=>$file_no));
				$index['pensioner'] = $this->pensioner;
				$check_revision = $this->model_pension->check_revision($file_no);

				$sd['address_after_retirement'] = $index['pensioner']->address_after_retirement;
				if($check_revision) :
					$details = $this->model_pension->get_revision_details($file_no);
					$rd = $details[0];
					$index['basic_pension'] 		= $rd['revised_amount_of_pension'];
					$index['reduced_pension']		= $rd['revised_reduced_pension'];
					$index['reduced_pension_wef']	= '';
					$index['da_percent']			= $rd['revision_da'];
					$index['medical_allowance']		= '';
					$index['enhance_rate']			= $rd['revised_enhance_rate'];
					$index['ordinary_rate']			= $rd['revised_ordinary_rate'];
				else :
					$sd = $index['pensioner'];
					$index['basic_pension'] 		= $sd->getAmountofPension();
					$index['reduced_pension']		= $sd->getReducePension();
					$index['reduced_pension_wef']	= '';
					$index['da_percent']			= $sd->da_percentage();
					$index['medical_allowance']		= '';
					$index['enhance_rate']			= $sd->getEnhanceRate(false);
					$index['ordinary_rate']			= $sd->getOrdinaryRate();
				endif;
				$index['case_type'] = "inside";
				$data['title'] = 'Transfer';
				$data['content'] = $this->load->view('administrator/transfer/form_inside', $index, true);
				$this->load->view('administrator/default_template', $data);
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/transfer'));
			endif;

		else :
			$data['title'] = 'Transfer';
			$data['content'] = $this->load->view('administrator/transfer/search_inside', '', true);
			$this->load->view('administrator/default_template', $data);
		endif;
	}

	function edit_inside($id)
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) :
			$this->session->set_flashdata('message', '<div class="alert alert-danger">File not found.</div>');
			redirect(site_url('administrator/transfer'));
		else :
			if($this->input->post('update_transfer')) :

				if($this->model_transfer->update_transfer($id)) :
					$this->session->set_flashdata('message', '<div class="alert alert-success">File update successfully.</div>');
					redirect(site_url('administrator/transfer'));
				else :
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Something wrong while update.</div>');
					redirect(site_url('administrator/transfer'));
				endif;
			else :
				$pensioner = PTransfer::where('id', $id)->first();
				$case_type = "inside";
				$data['title'] = 'Transfer';
				$data['content'] = $this->load->view('administrator/transfer/edit_inside', compact('case_type', 'pensioner'), true);
				$this->load->view('administrator/default_template', $data);
			endif;
		endif;
	}

	function report_inside($id)
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) :
			$this->session->set_flashdata('message', '<div class="alert alert-danger">No report found.</div>');
			redirect(site_url('administrator/transfer'));
		else :
			$this->load->library('Transfer', array('id'=>$id));
			$transfer = $this->transfer;
			if($transfer->numOfRows > 0) :
				if($transfer->type == 'inside') :
					$data['result'] = $transfer;
					$this->load->library('Pensioner', array('case_no'=>$data['result']->case_no));
					$data['pensioner'] = $this->pensioner;
					$data['title'] = 'Transfer report';
					$data['content'] = $this->load->view('administrator/transfer/report_inside', $data, true);
					$this->load->view('administrator/default_template', $data);
				else :
					die('File no. not exists.');
				endif;
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/transfer'));
			endif;
		endif;
	}

	function outside($file_no = '')
	{
		if($this->input->post('search')) :

			$file_no = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$index['transfer_details'] = $this->model_transfer->get_transfer_details($file_no);
			$data['title'] = 'Transfer';
			$data['content'] = $this->load->view('administrator/transfer/search_outside', $index, true);
			$this->load->view('administrator/default_template', $data);

		elseif($this->input->post('save_transfer')) :

			if($this->model_transfer->save_transfer()) :
				$this->session->set_flashdata('message', '<div class="alert alert-success">File transfer successfully.</div>');
				redirect(site_url('administrator/transfer'));
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Something wrong while transfer.</div>');
				redirect(site_url('administrator/transfer'));
			endif;

    	elseif($this->input->post('file_no') != '' || $this->uri->segment(4)) :

			$index['file_no'] = ($this->input->post('file_no') != '') ? $this->input->post('file_no') : base64_decode($file_no);
			$index['case_type'] = "outside";
			$data['title'] = 'Transfer';
			$data['content'] = $this->load->view('administrator/transfer/form_outside', $index, true);
			$this->load->view('administrator/default_template', $data);

		else :
			$data['title'] = 'Transfer';
			$data['content'] = $this->load->view('administrator/transfer/search_outside', '', true);
			$this->load->view('administrator/default_template', $data);
		endif;
	}

	function edit_outside($id)
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) :
			$this->session->set_flashdata('message', '<div class="alert alert-danger">File not found.</div>');
			redirect(site_url('administrator/transfer'));
		else :
			if($this->input->post('update_transfer')) :

				if($this->model_transfer->update_transfer($id)) :
					$this->session->set_flashdata('message', '<div class="alert alert-success">File update successfully.</div>');
					redirect(site_url('administrator/transfer'));
				else :
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Something wrong while update.</div>');
					redirect(site_url('administrator/transfer'));
				endif;
			else :
				$pensioner = PTransfer::where('id', $id)->first();
				$case_type = "outside";
				$data['title'] = 'Transfer';
				$data['content'] = $this->load->view('administrator/transfer/edit_outside', compact('case_type', 'pensioner'), true);
				$this->load->view('administrator/default_template', $data);
			endif;
		endif;
	}

	function report_outside($id)
	{
		$id = $this->uri->segment(4, 0);
		if($id == 0) :
			$this->session->set_flashdata('message', '<div class="alert alert-danger">No report found.</div>');
			redirect(site_url('administrator/transfer'));
		else :
			$this->load->library('Transfer', array('id'=>$id));
			$transfer = $this->transfer;
			if($transfer->numOfRows > 0) :
				if($transfer->type == 'outside') :
					$data['result'] = $transfer;
					$data['title'] = 'Transfer report';
					$data['content'] = $this->load->view('administrator/transfer/report_outside', $data, true);
					$this->load->view('administrator/default_template', $data);
				else :
					die('File no. not exists.');
				endif;
			else :
				$this->session->set_flashdata('message', '<div class="alert alert-danger">File no not exists.</div>');
				redirect(site_url('administrator/transfer'));
			endif;
		endif;
	}
}