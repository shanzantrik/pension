<?php 

class error extends CI_Controller
{
	public function index()
	{
		$data['title'] = "404 Not Found";
		$data['content'] = $this->load->view('404/error', '', true);
		$this->load->view('administrator/default_template', $data);
	}
}