<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
			'service_book_add_form' => array(
					array('field'=>'cash_received', 'label'=>'cash received', 'rules'=>'required'),
					array('field'=>'class_of_pension', 'label'=>'class of pension', 'rules'=>'callback_check_default'),
					array('field'=>'case_no', 'label'=>'file no', 'rules'=>'required|callback_check_file_no'),
					array('field'=>'dob', 'label'=>'date of birth', 'rules'=>'required'),
					array('field'=>'religion', 'label'=>'religion', 'rules'=>'callback_check_default'),
					array('field'=>'nationality', 'label'=>'nationality', 'rules'=>'callback_check_default'),
					array('field'=>'category', 'label'=>'category', 'rules'=>'callback_check_default'),
					array('field'=>'sex', 'label'=>'sex', 'rules'=>'callback_check_default'),
					array('field'=>'department', 'label'=>'department', 'rules'=>'callback_check_default'),
					//array('field'=>'dor', 'label'=>'date of retirement', 'rules'=>'required'),
					array('field'=>'office_address', 'label'=>'office address', 'rules'=>'required'),
					array('field'=>'pay_commission', 'label'=>'pay commission', 'rules'=>'callback_check_default'),
					array('field'=>'pay_scale', 'label'=>'pay scale', 'rules'=>'required'),
					array('field'=>'effect_of_pension', 'label'=>'effect of pension', 'rules'=>'required'),
					array('field'=>'name_of_accountant_general', 'label'=>'name', 'rules'=>'callback_check_default'),
					/*array('field'=>'bank_name', 'label'=>'bank name', 'rules'=>'required'),
					array('field'=>'account_no', 'label'=>'account no', 'rules'=>'required'),*/
					array('field'=>'address_after_retirement', 'label'=>'address after retirement', 'rules'=>'required')
					/*array('field'=>'pin', 'label'=>'pin', 'rules'=>'required'),
					array('field'=>'phone_no', 'label'=>'phone no', 'rules'=>'required')*/
			),
			'member_add_form' => array(
					array('field'=>'member_name', 'label'=>'member name', 'rules'=>'required|min_length[5]|max_length[20]'),
					array('field'=>'mobile_no1', 'label'=>'mobile no1', 'rules'=>'required'),
					array('field'=>'mobile_no2', 'label'=>'mobile no2', 'rules'=>'required'),
					array('field'=>'cor_address', 'label'=>'cor address', 'rules'=>'required'),
					array('field'=>'per_address', 'label'=>'per address', 'rules'=>'required'),
					array('field'=>'email', 'label'=>'email', 'rules'=>'required|valid_email'),
					array('field'=>'passwrd', 'label'=>'passwrd', 'rules'=>'required|matches[copasswrd]'),
					array('field'=>'copasswrd', 'label'=>'copasswrd', 'rules'=>'required'),
					array('field'=>'Branch_Code', 'label'=>'Branch Code', 'rules'=>'required|callback_check_default'),
					array('field'=>'member_type_code', 'label'=>'member type code', 'rules'=>'callback_check_default'),
					array('field'=>'desg_code', 'label'=>'department code', 'rules'=>'callback_check_default'),
					array('field'=>'member_status', 'label'=>'member status', 'rules'=>'callback_check_default')
			),
			'member_edit_form' => array(
					array('field'=>'member_name', 'label'=>'member name', 'rules'=>'required|min_length[5]|max_length[12]'),
					array('field'=>'mobile_no1', 'label'=>'mobile no1', 'rules'=>'required'),
					array('field'=>'mobile_no2', 'label'=>'mobile no2', 'rules'=>'required'),
					array('field'=>'cor_address', 'label'=>'cor address', 'rules'=>'required'),
					array('field'=>'per_address', 'label'=>'per address', 'rules'=>'required'),
					array('field'=>'email', 'label'=>'email', 'rules'=>'required|valid_email'),
					array('field'=>'Branch_Code', 'label'=>'Branch Code', 'rules'=>'required|callback_check_default'),
					array('field'=>'member_type_code', 'label'=>'member type code', 'rules'=>'callback_check_default'),
					array('field'=>'desg_code', 'label'=>'department code', 'rules'=>'callback_check_default'),
					array('field'=>'member_status', 'label'=>'member status', 'rules'=>'callback_check_default')
			),
			'pension_file_search_form' => array(
					array('field'=>'file_no', 'label'=>'file no', 'rules'=>'required|callback__check_file_no')
			),
			'employee_add_form' => array(
					array('field'=>'name', 'label'=>'name', 'rules'=>'required'),
					array('field'=>'fhname', 'label'=>'father name', 'rules'=>'required'),
					array('field'=>'branch_code', 'label'=>'department', 'rules'=>'required'),
					array('field'=>'designation', 'label'=>'designation', 'rules'=>'callback__check_default'),
					array('field'=>'dob', 'label'=>'date of birth', 'rules'=>'required'),
					array('field'=>'doj', 'label'=>'date of joining', 'rules'=>'required'),
					array('field'=>'dor', 'label'=>'date of retirement', 'rules'=>'required'),
					array('field'=>'sex', 'label'=>'sex', 'rules'=>'required'),
					array('field'=>'category', 'label'=>'category', 'rules'=>'callback__check_default'),
					array('field'=>'appointas', 'label'=>'appointas', 'rules'=>'callback__check_default'),
					array('field'=>'pay_band', 'label'=>'pay band', 'rules'=>'required'),
					array('field'=>'grade_pay', 'label'=>'grade pay', 'rules'=>'required'),
					array('field'=>'increament_amount', 'label'=>'increament amount', 'rules'=>'required'),
					array('field'=>'total_pay', 'label'=>'total pay', 'rules'=>'required'),
					array('field'=>'sca', 'label'=>'sca', 'rules'=>'required'),
					array('field'=>'other_allowance', 'label'=>'other allowance', 'rules'=>'required'),
					array('field'=>'da', 'label'=>'da', 'rules'=>'required'),
					array('field'=>'total_allowance', 'label'=>'total allowance', 'rules'=>'required'),
					array('field'=>'total_emolument', 'label'=>'total emolument', 'rules'=>'required'),
					array('field'=>'account_no', 'label'=>'account no', 'rules'=>'required'),
					array('field'=>'bank_name', 'label'=>'bank name', 'rules'=>'required'),
					array('field'=>'branch', 'label'=>'branch', 'rules'=>'required'),
					array('field'=>'ddo_address', 'label'=>'ddo address', 'rules'=>'required')
			)
);