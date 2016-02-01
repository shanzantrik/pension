<?php

class SearchPanel1 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{

		/*$query = PPERSONALD::with('pensioner_service_details', 'pensioner_pay_details', 'pensioner_family_details', 'pensioner_files_details');
		
		$query->where('serial_no', 1001);

		$ppd = $query->first();

		echo "ppd<br />";
		print_r($ppd->toArray());
		echo "<br /><br />";

		echo "psd<br />";
		print_r($ppd->pensioner_service_details->toArray());
		echo "<br /><br />";

		echo "ppayd<br />";
		print_r($ppd->pensioner_pay_details->toArray());
		echo "<br /><br />";

		echo "pfamilyd<br />";
		print_r($ppd->pensioner_family_details->toArray());
		echo "<br /><br />";

		echo "pfilesd<br />";
		print_r($ppd->pensioner_files_details);
		echo "<br /><br />";*/

		if($this->input->post('search_btn')) :

			$search_by = $this->input->post('by');
			$search_input = ($this->input->post('search_input') != '') ? $this->input->post('search_input') : '';

			$query = PPERSONALD::with('pensioner_service_details', 'pensioner_pay_details', 'pensioner_family_details', 'pensioner_files_details');

			switch($search_by) :
				case 'no_of_pensioner':
				case 'no_of_family_pensioner':
				case 'total_basic_pension_of_pensioner':
				case 'total_basic_pension_of_family_pensioner':

					$family_tag = array('no_of_family_pensioner', 'total_basic_pension_of_family_pensioner');
					if(in_array($search_by, $family_tag)) :
						$query->whereIn('class_of_pension', ['Normal_Family_Pension', 'Extraordinary_Pension', 'Liberalised_Pension', 'Dependent_Pension', 'Parents_Pension']);
					endif;

					if($search_input != '') :
						if(in_array($search_by, $family_tag)) :
							$query->whereHas('pensioner_service_details', function($q) use ($search_input)
							{
							    $q->whereYear('dod', '=', $search_input)/*->orWhere(function($nest) use($search_input) {
							    	$nest->whereBetween('dor', [$search_input.'-01-01', $search_input.'-12-31']);
							    })*/;
							});
						else :
							$query->whereHas('pensioner_service_details', function($q) use ($search_input)
							{
							    $q->whereYear('dor', '=', $search_input)/*->orWhere(function($nest) use($search_input) {
							    	$nest->whereBetween('dod', [$search_input.'-01-01', $search_input.'-12-31']);
							    })*/;
							});
						endif;
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
}