<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "filetracking_pension.csv";
        $this->db->select('*');

        $this->db->select_max('entry_time');
        $this->db->group_by('file_no');
        $this->db->order_by('file_no', 'desc');

        $this->db->from('file_tracking_details');

        $result = $this->db->get();

        $results=$result->result();

        $this->db->truncate('file_tracking_temp');


        foreach ($results as $res) {

            $this->db->insert('file_tracking_temp',$res);

        }


        /*$this->db->select('file_tracking_temp.file_no, file_tracking_temp.branch, file_tracking_temp.file_status, file_tracking_temp.entry_time, pensioner_treasury_details.phone_no as mobile_no, pensioner_personal_details.salutation, pensioner_personal_details.name, pensioner_personal_details.dob, pensioner_personal_details.class_of_pension as pension, pensioner_personal_details.ppo_no as ppo, pensioner_personal_details.gpo_no as gpo, pensioner_personal_details.cpo_no as cpo, pensioner_personal_details.sex as gender, pensioner_personal_details.religion, pensioner_personal_details.designation, master_department.dept_name as department, pen_members.member_name, file_status.reg_no,file_status.reg_dt,file_status.po_no,file_status.po_date');*/

        $this->db->select('file_tracking_temp.file_no, file_tracking_temp.branch, file_tracking_temp.file_status, file_tracking_temp.entry_time, pensioner_treasury_details.phone_no as mobile_no, pensioner_personal_details.salutation, pensioner_personal_details.name, pensioner_personal_details.dob, pensioner_personal_details.class_of_pension as pension, pensioner_personal_details.ppo_no as ppo, pensioner_personal_details.gpo_no as gpo, pensioner_personal_details.cpo_no as cpo, pensioner_personal_details.sex as gender, pensioner_personal_details.religion, pensioner_personal_details.designation, master_department.dept_name as department, pen_members.member_name, issue.reg_no,issue.reg_dt,issue.po_no,issue.po_date,issue.po_idcard,issue.po_iddate,issue.po_personal,issue.po_personal_date');

        $this->db->from('file_tracking_temp');

        $this->db->join('pensioner_personal_details', 'pensioner_personal_details.case_no = file_tracking_temp.file_no');

        $this->db->join('pensioner_treasury_details', 'pensioner_treasury_details.serial_no = pensioner_personal_details.serial_no');

        $this->db->join('pen_members', 'pen_members.member_code = file_tracking_temp.member_code');

        $this->db->join('master_department', 'master_department.dept_code = pensioner_personal_details.department');

        $this->db->join('file_status', 'file_status.file_no = file_tracking_temp.file_no');
        $this->db->join('issue', 'file_tracking_temp.file_no = issue.file_no','left') ;
        $result = $this->db->get();

         


        //$result=$query->result_array();
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
               
    }

}