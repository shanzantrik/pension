<?php

class searchpanel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('base'));
	}

	function index()
	{
		if($this->input->post('search_btn')) :

			$search_by = $this->input->post('by');
			$search_input = ($this->input->post('search_input') != '') ? $this->input->post('search_input') : '';

			switch($search_by) :
				case 'no_of_pensioner':
				case 'no_of_family_pensioner':
				case 'total_basic_pension_of_pensioner':
				case 'total_basic_pension_of_family_pensioner':

					$query = PPERSONALD::with('pensioner_service_details', 'pensioner_pay_details', 'pensioner_family_details', 'pensioner_files_details');
					$family_tag = array('no_of_family_pensioner', 'total_basic_pension_of_family_pensioner');
					if(in_array($search_by, $family_tag)) :
						$query->whereIn('class_of_pension', ['Normal_Family_Pension', 'Extraordinary_Pension', 'Liberalised_Pension', 'Dependent_Pension', 'Parents_Pension']);
					endif;

					if($search_input != '') :
						$query->whereYear('created_at', '=', $search_input);
					endif;
					break;

				case 'gratuity_commutation':
				case 'leave_encashment':

					$query = PPERSONALD::with('pensioner_details');
					if($search_input != '') :
						$query->whereYear('created_at', '=', $search_input);
					endif;
					break;

				case 'no_of_pensioner_state_wise':

					$query = PTransfer::with('insideRecieveFrom', 'insideSendTo')->ofType('inside');
					if($search_input != '') :
						$query->whereYear('created_at', '=', $search_input);
					endif;
					break;

				case 'no_of_pension_receive_from_other_state':

					$query = PTransfer::with('outsideReceiveFrom', 'outsideSendTo')->ofType('outside');
					if($search_input != '') :
						$query->whereYear('created_at', '=', $search_input);
					endif;
					break;

			endswitch;

			$sp['result'] = $query;
			$data['title'] = "Search Panel";
			$data['content'] =$this->load->view('administrator/search/panel/index', $sp, true);
			$this->load->view('administrator/default_template', $data);

		else :
			$sp['result'] = array();
			$data['title'] = "Search Panel";
			$data['content'] =$this->load->view('administrator/search/panel/index', $sp, true);
			$this->load->view('administrator/default_template', $data);
		endif;
	}

	function searchReportByDA(){
		if($this->input->post('search_btn')){
			$search_input_query = ($this->input->post('search_input_from') != '') ? "WHERE a.created_at BETWEEN '".$this->input->post('search_input_from')."' AND '".$this->input->post('search_input_to')."'" : '';
			$query=$this->db->query("select * from master_dearness_allowance order by da asc")->result();
			
			$sp['result'] = $query;
			$sp['datas']=$this->db->query("SELECT a.*,b.`serial_no`, b.`pay_scale`, b.`provisional_pension`, b.`provisional_gratuity`, b.`excess_pay_and_allowances`, b.`others`, b.`com_applied`, b.`com_per`, b.`dr`, b.`ma`, b.`pay_commission`, b.`pay_info`, b.`total_amount`, b.`age_retire`, b.`sixgratu`, b.`case_file_no`, b.`six_pay_band`, b.`bf_increamnet`, b.`npa`, b.`consolidated`, b.`childDOB`, b.`child_Date_of_marriage_employment` FROM `pensioner_personal_details` a LEFT JOIN pensioner_pay_details b ON a.case_no=b.case_file_no $search_input_query ORDER BY a.case_no DESC")->result();
			$sp["search_input_das"]=$this->input->post('search_input_da');
			$data['title'] = "Search Report By DA";
			$data['content'] =$this->load->view('administrator/search/panel/search_by_da', $sp, true);
			$this->load->view('administrator/default_template', $data);
		}else{
			$query=$this->db->query("select * from master_dearness_allowance order by da asc")->result();
			$sp['result'] = $query;
			$data['title'] = "Search Report By DA";
			$data['content'] =$this->load->view('administrator/search/panel/search_by_da', $sp, true);
			$this->load->view('administrator/default_template', $data);
		}
	}
}