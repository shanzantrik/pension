<?php

class Model_home extends CI_Model {
	
	function __construct() {
		parent:: __construct();
	}
	
	function login() {
		//$mobile_no = $this->input->post('mobile_no');
		$user_id = $this->input->post('user_id');
		$pass  = $this->input->post('password');
		$md5_pass = md5($pass);	

		//$sql = "Select member_code, member_name, Branch_Code, member_type_code, desg_code from pen_members where member_code='$username' and passwrd='$md5_pass'";
		$sql = "Select m.member_code, m.member_name, m.Branch_Code, m.member_type_code, m.desg_code from pen_members as m join employees as e on m.member_type_code=e.role where e.user_id='$user_id' and e.password='$md5_pass'";
		if($this->db->affected_rows($this->db->query($sql)) == 1){
			$query = mysql_query($sql);
			while(list($member_code, $member_name, $branch_code, $member_type_code) = mysql_fetch_row($query)) {
				$user_session_data['member_code'] = $member_code;
				$user_session_data['member_name'] = $member_name;
				$user_session_data['branch_code'] = $branch_code;
				$user_session_data['member_type'] = $this->check_member_type($member_type_code);
				$user_session_data['member_type_code'] = $member_type_code;
				$user_session_data['logged_in']	= 'TRUE';
			}

			$this->session->set_userdata($user_session_data);
			$datas=array('logged_in'=>'yes');
	        $this->db->where('member_code',$this->session->userdata('member_code'));
	        $this->db->update('pen_members',$datas);
			return true;
		} else {
			return false;
		}
	}

	function check_member_type($member_type_code) {
		$this->db->select('member_type_name');
		$query = $this->db->get_where('master_member_type', array('member_type_code' => $member_type_code));
		if($query->num_rows() > 0) {
			$row = $query->row();
			return $row->member_type_name;
		} else {
			return 0;
		}
	}

	//function will retrive all Woid from woids table
	function getAllWoid(){
		 $result = $this->db->get('woids');
	     return $result->result_array();
	}
	
	//function will save Woid for the specific member
	function save_weather(){
		$woid=$this->security->xss_clean($_POST['woid']);
		$member_code=$this->session->userdata('member_code');
		$q=$this->db->get_where('weather_config',array('member_code'=>$member_code));
		if($q->num_rows()>0){
			$this->db->where('member_code',$member_code);
			$q=$this->db->update('weather_config',array('woid'=>$woid));
		}
		else{
			$q=$this->db->insert('weather_config',array('member_code'=>$member_code,'woid'=>$woid));
		}
		if($q)
			return true;
		else
			return false;
	}

	//function will retrive woid for a specif member if not default woid is for Itanagar arunachal pradesh
	function getWoid(){
		$member_code=$this->session->userdata('member_code');
		$sql="SELECT * from weather_config a,woids b where a.woid=b.id and a.member_code=$member_code";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$result = $query->row();
			$val=$result->value;
		}
		else{
			$val='2294848';
		}
		return $val;	
	}

	function change_theme($theme){
		$member_code=$this->session->userdata('member_code');
		$q=$this->db->get_where('theme',array('member_code'=>$member_code));
		if($q->num_rows()>0){
			$this->db->where('member_code',$member_code);
			$q=$this->db->update('theme',array('theme'=>$theme));
		} else {
			$q=$this->db->insert('theme',array('member_code'=>$member_code,'theme'=>$theme));
		}
		$user_session_data['theme']	= $theme;
		$this->session->set_userdata($user_session_data);
		if($q)
			return true;
		else
			return false;
	}

	function is_connected() {
	    $connected = @fsockopen("www.google.co.in", 80); 
	    //website, port  (try 80 or 443)
	    if ($connected) {
	        $is_conn = 1; //action when connected
	        fclose($connected);
	    } else {
	        $is_conn = 0; //action in connection failure
	    }
	    return $is_conn;
	}
}