<?php

class director extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/model_auth');
        $this->load->model('administrator/model_director');
        $this->load->model('administrator/model_notification');
        $this->load->helper('base');
    }

    function index()
    {
        if (!empty($_GET['id'])) {
            $department=$_GET['id'];
            $dp['lists']     = $this->model_director->getFilterGIS();
            $dp['lists2']    = $this->model_director->getFilterJD($department);
            $dp['lists3']    = $this->model_director->getFilterIps($department);
            $dp['lists4']    = $this->model_director->getFilterPension($department);
            $data['title']   = "Director";
            $data['content'] = $this->load->view('administrator/director/view', $dp, true);
            $this->load->view('administrator/filtered', $data);
        }
        else{
            $dp['lists']     = $this->model_director->filefrom_gis_superintendent();
            $dp['lists2']    = $this->model_director->getfile_from_joint_director();
            $dp['lists3']    = $this->model_director->getfile_from_ips();
            $dp['lists4']    = $this->model_director->getpensionfile_from_jd_fao();
            $data['title']   = "Director";
            $data['content'] = $this->load->view('administrator/director/view', $dp, true);
            $this->load->view('administrator/default_template', $data);
        }
    }

    function confirm_from_superintendent()
    {
        $file = $_GET['file'];
        $json = $this->model_notification->confirm_from_superintendent($file);
        echo json_encode($json);
    }

    function pen_confirm_from_jd_fao_superintendent()
    {
        $file = $_GET['file'];
        $json = $this->model_notification->pen_confirm_from_jd_fao_superintendent($file);
        echo json_encode($json);
    }

    function ips_confirm_by_director()
    {
        $file = $_GET['file'];
        $json = $this->model_notification->ips_confirm_by_director($file);
        echo json_encode($json);
    }

    function view_report($file_No)
    {
        $file_No         = base64_decode($file_No);
        $abc['values']   = get_ips_detail2($file_No);
        $data['title']   = "IPS detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/ips/ips_report', $abc, true);
        $this->load->view('administrator/default_template', $data);
    }

    function view_checklist($file_no)
    {
        $file_no         = base64_decode($file_no);
        $pid['values']   = get_checklist_details($file_no);
        $data['title']   = "Checklist detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/gis/checklist-report', $pid, true);
        $this->load->view('administrator/default_template', $data);
    }

    function attach_authority($file_no)
    {
        $file_no = base64_decode($file_no);
        $group   = get_group_of_employee($file_no);
        if ($group == "A") {
            $pid['values']   = get_checklist_details($file_no);
            $data['title']   = "Checklist detail Report";
            $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_a', $pid, true);
            $this->load->view('administrator/default_template', $data);
        } else {
            $pid['values']   = $this->model_Gis->get_checklist_details($file_no);
            $data['title']   = "Checklist detail Report";
            $data['content'] = $this->load->view('administrator/pension/report/gis/authority_form_gr_other', $pid, true);
            $this->load->view('administrator/default_template', $data);
        }
    }

    function confirm_from_joint_director()
    {
        $file = $_GET['file'];
        $json = $this->model_notification->confirm_from_joint_director($file);
        echo json_encode($json);
    }

    function save_fwd_to_gisda()
    {
        $ret = $this->model_director->save_fwd_to_gisda();
        if ($ret == 'validate') {
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>Please Select a Case First</div>");
            redirect('administrator/director');
        } else if ($ret == 'RollBack') {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
            redirect('administrator/director');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
            redirect('administrator/director');
        }
    }

    function save_fwd_pension_da()
    {
        //$ret=$this->model_Gis->save_forwrd_gis_Superintendent_file();
        $ret = $this->model_director->save_fwd_pension_da();
        if ($ret == 'validate') {
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>Please Select a Case First</div>");
            redirect('administrator/director');
        } else if ($ret == 'RollBack') {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
            redirect('administrator/director');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>Successfully Done</div>");
            redirect('administrator/director');
        }
    }

    function save_frwrd_to_gisda_by_director()
    {
        //$ret=$this->model_Gis->save_forwrd_gis_Superintendent_file();
        $ret = $this->model_director->save_frwrd_to_gisda_by_director();
        if ($ret == 'validate') {
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>Please Select a Case First</div>");
            redirect('administrator/director');
        } else if ($ret == 'RollBack') {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
            redirect('administrator/director');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
            redirect('administrator/director');
        }
    }

    function save_frwrd_to_ipsda_by_director()
    {
        //$ret=$this->model_Gis->save_forwrd_gis_Superintendent_file();
        $ret = $this->model_director->save_frwrd_to_ipsda_by_director();
        if ($ret == 'validate') {
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>Please Select a Case First</div>");
            redirect('administrator/director');
        } else if ($ret == 'RollBack') {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
            redirect('administrator/director');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>Successfully Allocated to IPS DA</div>");
            redirect('administrator/director');
        }
    }

    function save_fwd_to_ipsda_bydirector()
    {
        //$ret=$this->model_Gis->save_forwrd_gis_Superintendent_file();
        $ret = $this->model_director->save_fwd_to_ipsda_bydirector();
        if ($ret == 'validate') {
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>Please Select a Case First</div>");
            redirect('administrator/director');
        } else if ($ret == 'RollBack') {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>Due to some technical Error File could not been allocated to DA</div>");
            redirect('administrator/director');
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>Successfully Allocated to GIS DA</div>");
            redirect('administrator/director');
        }
    }
}