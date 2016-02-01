<?php 
class Model_transfer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_all_transfer($type = 'all')
	{
		$this->db->select('pt.*');
		$this->db->from('pensioner_transfer as pt');
		$this->db->order_by("id", "desc");
		if($type != 'all') :
			$this->db->where(array('type'=>$type));
		endif;
		$this->db->group_by('case_no');
		$query = $this->db->get();

		if($query->num_rows() > 0) :
			return $query->result_array();
		else :
			return array();
		endif;
	}

	function get_transfer_details($case_no, $id = false)
	{
		//$this->db->select('pt.*, mag.name as agname, mt.title as treasury_title');
		$this->db->select('pt.*');
		$this->db->from('pensioner_transfer as pt');
		//$this->db->join('master_accountant_general as mag', 'pt.ist = mag.id');
		//$this->db->join('master_treasury as mt', 'pt.irf = mt.id', 'left');
		if($id == true) :
			$this->db->where(array('pt.id'=>$case_no));
		else :
			$this->db->where(array('pt.case_no'=>$case_no));
		endif;
		$this->db->order_by("id", "desc");
		$query = $this->db->get();

		if($query->num_rows() > 0) :
			return $query->result_array();
		else :
			return array();
		endif;
	}

	function save_transfer()
	{
		$data = $_POST;
		unset($data['save_transfer']);
		$data['dearness_relief'] = str_replace("%", "", $data['dearness_relief']);
		$data = array_map('mysql_real_escape_string', $data);

		if($this->input->post('irf') != null) :
			if($this->input->post('send_to') == null) :
				$data['send_to'] = "outside";
			endif;
		endif;

		$data['cpo'] = ($this->input->post('cpo') != '') ? $this->input->post('cpo') : NULL;
		$data['draw_from'] = ($this->input->post('draw_from') != '') ? $this->input->post('draw_from') : NULL;
		$data['dearness_relief'] = ($this->input->post('dearness_relief') != '') ? $this->input->post('dearness_relief') : NULL;
		$data['letter_no'] = ($this->input->post('letter_no') != '') ? $this->input->post('letter_no') : NULL;

		if($this->db->insert('pensioner_transfer', $data)) :
			return true;
		else :
			return false;
		endif;
	}

	function update_transfer($id)
	{
		$data = $_POST;
		unset($data['update_transfer']);
		$data['dearness_relief'] = str_replace("%", "", $data['dearness_relief']);
		$data = array_map('mysql_real_escape_string', $data);

		if($this->input->post('irf') != null) :
			if($this->input->post('send_to') == null) :
				$data['send_to'] = "outside";
			endif;
		endif;

		$data['cpo'] = ($this->input->post('cpo') != '') ? $this->input->post('cpo') : NULL;
		$data['draw_from'] = ($this->input->post('draw_from') != '') ? $this->input->post('draw_from') : NULL;
		$data['dearness_relief'] = ($this->input->post('dearness_relief') != '') ? $this->input->post('dearness_relief') : NULL;
		$data['letter_no'] = ($this->input->post('letter_no') != '') ? $this->input->post('letter_no') : NULL;

		$this->db->where('id', $id);
		if($this->db->update('pensioner_transfer', $data)) :
			return true;
		else :
			return false;
		endif;
	}

	/*function getTreasuryByCaseNo($case_no)
	{
		$this->db->select('pensioner_treasury_details.treasury_officer');
		$this->db->from('pensioner_personal_details');
		$this->db->where(array('pensioner_personal_details.case_no'=>$case_no));
		$this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no', 'left');
		$query = $this->db->get();
		if($query->num_rows() > 0) :
			$row = $query->row();
			return $row->treasury_officer;
		else :
			return '';
		endif;
	}*/
}