<?php

// Second level Authentication Class for Session tracking and Module Previlige

class Model_auth extends CI_Model {
	function __construct() {
		parent:: __construct();
		$ret=$this->check_login();
		if($ret=='false'){
			redirect(site_url('home'));
		}
		else
		{
			$this->check_authentication();
		}
	}

	//first check the user is logged in or not
	function check_login(){
		if($this->session->userdata('logged_in') != TRUE) {
			return 'false';
		}
		else
		{
			return 'true';
		}
	}

	//check wheather the module is allocated to the specific user or not
	function check_authentication()
	{
		$member_type_code=$this->session->userdata('member_type_code');
		$main_module=$this->uri->segment(2);
		$sub_module=($this->uri->segment(3)) ? $this->uri->segment(3) : 'index';

		//First check main module;
		$sql="SELECT a.member_type_code as member_type_code,b.module_name as module_name,b.module_code as module_code from privilege_module a,master_module b where a.member_type_code=$member_type_code and b.module_code=a.module_code and b.module_name='$main_module'";

		$q=$this->db->query($sql);
		
		if($q->num_rows()>0)	//module found in privilige
		{
			//main module
			$row = $q->result();
			$mm=$row[0]->module_code;
			//check sub module
			$sql="select * from auth_view where main_module_code=$mm and member_type_code=$member_type_code and sub_module_name='$sub_module'";
			
			//$sql="SELECT a.*,b.sub_module_name from privilege_sub_module a,master_sub_module b
			//where a.module_code=b.sub_module_code and a.member_type_code=$member_type_code and b.sub_module_name='$sub_module'";
				$q=$this->db->query($sql);
				
				/*if($q->num_rows()>0){

				}
				else{
					redirect(site_url('404/error'));
				}*/

		}
		else
		{
			
			redirect(site_url('404/error'));
		}

		
		//die($sub_module);

	}
}