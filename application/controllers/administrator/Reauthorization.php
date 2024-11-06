<?php

class reauthorization extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/model_Reauthorization');
        $this->load->helper('base');
        $this->load->model(array(
            'administrator/model_pension'
        ));
    }
    
    function index()
    {
        $data['title']   = "Reauthorization";
        $data['content'] = $this->load->view('administrator/reauthorization/view', $data, true);
        $this->load->view('administrator/default_template', $data);
    }
    
    function get_report($serial_no, $file_id, $sal)
    {
        
        $file_id       = base64_decode($file_id);
        $this->load->helper('pension/superannuation_after/superannuation_pension');
        $pid['sal']    = $sal;
        $pid['values'] = $this->model_Reauthorization->get_reauthorization_details($file_id);
        
        $this->load->library('Pensioner', array(
            'serial_no' => $serial_no
        ));
        $pid['records'] = $this->pensioner;
        
        $data['title']   = "Reauthorization detail Report";
        $data['content'] = $this->load->view('administrator/pension/report/reauthorization/disburser', $pid, true);
        $this->load->view('administrator/default_template', $data);
    }
    
    function search_family()
    {
        $serial_no            = $this->model_pension->get_serial_no($this->input->post('file_no'));
        $file_no              = $this->model_Reauthorization->get_file_no($serial_no);
        $check_file_no        = $this->model_Reauthorization->get_file_no_from_reautho($file_no);
        $vrp['check_file_no'] = $check_file_no;
        
        $vrp['reautho_details'] = $this->model_Reauthorization->get_reauthorization_details_by_file_no($file_no);
        $vrp['values']          = $this->model_Reauthorization->get_family($serial_no);
        $data['title']          = "Reauthorization";
        $data['content']        = $this->load->view('administrator/pension/reauthorization/reautho', $vrp, true);
        $this->load->view('administrator/default_template', $data);
    }
    
    function open_reautho_form($serial_no, $dob, $name, $sal)
    {
        if ($_POST) {
            $this->form_validation->set_rules('dod_pensioner', 'date of death of pensioner', 'required');
            $this->form_validation->set_rules('dod_pensioner_wife_husband', 'date of death of pensioner wife/husband', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['serial_no'] = $serial_no;
                $data['dob']       = $dob;
                $data['name']      = $this->security->xss_clean($name);
                //$data['salutation']=$salutation;
                $data['values']    = $this->model_Reauthorization->get_child($serial_no);
                $data['title']     = "Reauthorization";
                $data['content']   = $this->load->view('administrator/reauthorization/open_reautho_form', $data, true);
                $this->load->view('administrator/default_template', $data);
            } else {
                $dod_pensioner            = $this->input->post('dod_pensioner');
                $dod_husband_wife         = $this->input->post('dod_pensioner_wife_husband');
                $dob_child                = $this->input->post('child_dob');
                $file_no                  = $this->model_Reauthorization->get_file_no($serial_no);
                $enhanrate_from           = '';
                $age_25                   = '';
                $enhanrate_upto           = '';
                $enhanrate_upto_for_child = '';
                $ordrate_from             = '';
                
                $pid['pensioner_details'] = $this->model_Reauthorization->get_pensioner_dod($serial_no);
                $pensioner_dod            = $pid['pensioner_details'][0]['dod'];
                $pensioner_dor            = $pid['pensioner_details'][0]['dor'];
                
                
                $date = date_create($pensioner_dor);
                date_modify($date, '+1 day');
                $enhanrate_start = date_format($date, 'Y-m-d');
                //echo "enhan rate start from";
                //print_r($enhanrate_start);
                
                //child wil get enhan_rate from
                
                if (strtotime($dod_pensioner) < strtotime($dod_husband_wife)) {
                    //echo "wife_dod is greater than husband_dod";
                    $date1 = date_create($dod_husband_wife);
                    date_modify($date1, '+1 day');
                    $enhanrate_from = date_format($date1, 'Y-m-d');
                    //echo "enhanrate_child_from";
                    //print_r($enhanrate_from);
                } else {
                    $date = date_create($dod_pensioner);
                    date_modify($date, '+1 day');
                    $enhanrate_start = date_format($date, 'Y-m-d');
                    //echo "enhanrate_child_from";
                    $enhanrate_from = $enhanrate_start;
                    //print_r($enhanrate_from);
                }
                
                //child age will be 25 
                $d_child = date_create($dob_child);
                date_modify($d_child, '+25 year');
                $age_25 = date_format($d_child, 'Y-m-d');
                //echo "age wil be 25 on";
                //print_r($age_25);
                
                $d_child = new DateTime($dob_child);
                $today   = new DateTime($dod_husband_wife);
                $age     = $d_child->diff($today)->y;
                
                if ($pensioner_dod == "0000-00-00") //7 years enhance rate
                {
                    $enhanrate = date_create($enhanrate_start);
                    date_modify($enhanrate, '+7 year');
                    $enhanrate_upto = date_format($enhanrate, 'Y-m-d');
                    //echo "upto";
                    //print_r($enhanrate_upto);
                } else { //10 years enhance rate
                    $enhanrate = date_create($enhanrate_start);
                    date_modify($enhanrate, '+10 year');
                    $enhanrate_upto = date_format($enhanrate, 'Y-m-d');
                    //echo "upto";
                    //print_r($enhanrate_upto);
                }
                if ($sal = 'mr' || $sal = 'miss') {
                    if ($age < 25) {
                        if (strtotime($enhanrate_from) < strtotime($enhanrate_upto)) {
                            //echo "inside a";
                            if (strtotime($age_25) < strtotime($enhanrate_upto)) {
                                //echo "enhanrate_upto:";
                                $enhanrate_upto_for_child = $age_25;
                                $ordrate_from             = '';
                                //echo "no ordinary rate here";
                            } else {
                                //echo "age_25_greater";
                                $enhanrate_upto_for_child = $enhanrate_upto;
                                //ordinary_rate
                                $enhanrate_upto1          = date_create($enhanrate_upto);
                                date_modify($enhanrate_upto1, '+1 day');
                                $ordrate_from = date_format($enhanrate_upto1, 'Y-m-d');
                                //echo "ordrate_child_from";
                                //print_r($ordrate_from);
                                //echo "upto";
                                //print_r($age_25);
                                //ordinary rate
                            }
                        } else {
                            // $ordrate_from=$enhanrate_from;
                            $ordrate_from   = $enhanrate_upto;
                            $enhanrate_from = '';
                            //till 25 or married
                            //echo "enhance rate over";
                        }
                    } else {
                        //echo "age more then 25";
                    } //for ordinary rate
                } //salutation
                else {
                    //for girls
                }
                
                // echo date('Y-m-d', $otherdate);
                //  }else{
                //     echo "husband_dod is greater than wife_dod";}
                //   }
                
                //} else
                //{
                //pensioner dod is not o
                //}
                /*     $pid['enhanrate_from']=$enhanrate_from;
                $pid['age_25']=$age_25;
                $pid['enhanrate_upto']=$enhanrate_upto;
                $pid['enhanrate_upto_for_child']=$enhanrate_upto_for_child;
                $pid['ordrate_from']=$ordrate_from;*/
                $pid['sal'] = $sal;
 $claiment_name= $this->input->post('claiment_name');    
 $son_daughter= $this->input->post('son_daughter');         
$qryx=$this->db->query("select * from reauthorization where file_no='$file_no' and claiment_name='$claiment_name'");
$ctrx= $qryx->num_rows();
if($ctrx==0){
                if ($this->model_Reauthorization->add_reautho($file_no, $enhanrate_from, $age_25, $enhanrate_upto, $enhanrate_upto_for_child, $ordrate_from,$son_daughter)) {

                    $this->load->helper('pension/superannuation_after/superannuation_pension');
                    $pid['values'] = $this->model_Reauthorization->get_reauthorization_details_by_file_no($file_no);
                    //$pid['records'] = $this->model_pension->get_servicebook($serial_no);
                    //$pay_scale = $pid['records'][0]['pay_scale'];
                    
                    $this->load->library('Pensioner', array('serial_no' => $serial_no));
                    $pid['records'] = $this->pensioner;
                    $pay_scale      = $pid['records']->pay_scale;
                    
                    $pid['pay_scale'] = $this->model_Reauthorization->get_payscale($pay_scale);
                    $data['title']    = "Reauthorization detail Report";
                    $data['content']  = $this->load->view('administrator/pension/report/reauthorization/disburser', $pid, true);
                    $this->load->view('administrator/default_template', $data);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Insertion.</div>');
                    redirect('administrator/Gis/');
                }
 }  
 else{

 $child_dob= $this->input->post('child_dob');
 $dod_pensioner= $this->input->post('dod_pensioner');
 $dod_pensioner_wife_husband= $this->input->post('dod_pensioner_wife_husband');
 $benificery_type= $this->input->post('benificery_type');
 


   if($this->db->query("Update reauthorization set claiment_dob='$child_dob',pensioner_dod='$dod_pensioner',pensioner_husbandwife_dod='$dod_pensioner_wife_husband',benificery_type='$benificery_type',son_daughter='$son_daughter'  where file_no='$file_no' and claiment_name='$claiment_name'")){
$this->load->helper('pension/superannuation_after/superannuation_pension');
                    $pid['values'] = $this->model_Reauthorization->get_reauthorization_details_by_file_no($file_no);
                    //$pid['records'] = $this->model_pension->get_servicebook($serial_no);
                    //$pay_scale = $pid['records'][0]['pay_scale'];
                    
                    $this->load->library('Pensioner', array('serial_no' => $serial_no));
                    $pid['records'] = $this->pensioner;
                    $pay_scale      = $pid['records']->pay_scale;
                    
                    $pid['pay_scale'] = $this->model_Reauthorization->get_payscale($pay_scale);
                    $data['title']    = "Reauthorization detail Report";
                    $data['content']  = $this->load->view('administrator/pension/report/reauthorization/disburser', $pid, true);
                    $this->load->view('administrator/default_template', $data);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-error">Some error occured during Insertion.</div>');
                    redirect('administrator/Gis/');
                }
    


 }     

                // }
                
                
                
                /*    if($this->model_branch->add()) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Branch saved successfully.</div>');
                redirect('administrator/branch');
                } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
                redirect('administrator/branch');
                }*/
            }
        } else {
            $data['serial_no'] = $serial_no;
            $data['dob']       = $dob;
            $data['name']      = $this->security->xss_clean($name);
            $data['values']    = $this->model_Reauthorization->get_child($serial_no);
            $data['title']     = "Reauthorization";
            $data['content']   = $this->load->view('administrator/reauthorization/open_reautho_form', $data, true);
            $this->load->view('administrator/default_template', $data);
        }
    }
    
    function superannuation_pension($serial_no, $dod_pensioner, $dod_husband_wife, $dob_child)
    {
        $cop = $this->model_pension->get_pension_class($serial_no);
        if ($cop != 'Superannuation_Pension') {
            redirect(site_url('administrator/pension/file'));
        } else {
            //get date of retirement for calculation after and before 1-1-2006
            $dor     = $this->model_pension->get_date_of_retirement($serial_no);
            $file_no = $this->model_Reauthorization->get_file_no($serial_no);
            
            list($year, $month, $date) = explode("-", $dor);
            if ($year >= 2006) {
                //echo "after 1-1-2006";
                $this->load->helper('pension/superannuation_after/superannuation_pension');

                $enhanrate_from           = '';
                $age_25                   = '';
                $enhanrate_upto           = '';
                $enhanrate_upto_for_child = '';
                
                $pid['pensioner_dod'] = $this->model_Reauthorization->get_pensioner_dod($serial_no);
                
                if ($pid['pensioner_dod'] == "0000-00-00") //7 years enhance rate
                    {
                    if (strtotime($dod_pensioner) < strtotime($dod_husband_wife)) {
                        echo "wife_dod is greater than husband_dod";
                        //$somedate = $dod_pensioner;
                        
                        $date = date_create($dod_pensioner);
                        // $date_format=date_format($date, 'Y-m-d');
                        date_modify($date, '+1 day');
                        $enhanrate_start = date_format($date, 'Y-m-d');
                        echo "enhan rate start from";
                        print_r($enhanrate_start);
                        
                        //child wil get enhan_rate from
                        $date1 = date_create($dod_husband_wife);
                        date_modify($date1, '+1 day');
                        $enhanrate_from = date_format($date1, 'Y-m-d');
                        echo "enhanrate_child_from";
                        print_r($enhanrate_from);
                        
                        //child age will be 25 
                        $d_child = date_create($dob_child);
                        date_modify($d_child, '+25 year');
                        $age_25 = date_format($d_child, 'Y-m-d');
                        //
                        echo "age wil be 25 on";
                        print_r($age_25);
                        
                        // echo date_diff(date_create($dod_husband_wife),date_create($dob_child))->y, "\n";
                        //$enhanrate_upto = strtotime('+7 year', strtotime($abc));
                        
                        $enhanrate = date_create($enhanrate_start);
                        date_modify($enhanrate, '+7 year');
                        $enhanrate_upto = date_format($enhanrate, 'Y-m-d');
                        
                        echo "upto";
                        print_r($enhanrate_upto);
                        if (strtotime($age_25) < strtotime($enhanrate_upto)) {
                            echo "enhanrate_upro:";
                            $enhanrate_upto_for_child = $age_25;
                        } else {
                            echo "age_25_greater";
                            $enhanrate_upto_for_child = $enhanrate_upto;
                        }
                        // echo date('Y-m-d', $otherdate);
                    } else {
                        echo "husband_dod is greater than wife_dod";
                    }
                    //exit();
                } else {
                }
                
                $vrp['val']     = $this->model_pension->get_servicebook($serial_no);
                $pid['records'] = $this->model_Reauthorization->get_reauthorization_details($file_no);
                
                $data['title']   = "Superannuation pension";
                //$data['content'] = $this->load->view('administrator/pension/superannuation_after/superannuation_pension', $vrp, true);
                $data['content'] = $this->load->view('administrator/pension/report/reauthorization/disburser', $pid, true);
                
                $this->load->view('administrator/default_template', $data);
            } else {
                //echo "before 1-1-2006";
                $this->load->helper('pension/superannuation_before/superannuation_pension');
                $vrp['values']   = $this->model_pension->get_servicebook($serial_no);
                $data['title']   = "Superannuation pension";
                $data['content'] = $this->load->view('administrator/pension/superannuation_before/superannuation_pension', $vrp, true);
                $this->load->view('administrator/default_template', $data);
            }
        }
    }

    function reauthorize($serial_no, $dob, $name)
    {
        if ($_POST) {
            $this->form_validation->set_rules('branch_name', 'branch name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $branch['lists'] = $this->model_branch->getAll();
                $data['title']   = "Branch";
                $data['content'] = $this->load->view('administrator/branch/view', $branch, true);
                $this->load->view('administrator/default_template', $data);
            } else {
                if ($this->model_branch->add()) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Branch saved successfully.</div>');
                    redirect('administrator/branch');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Some error occured during insertion.</div>');
                    redirect('administrator/branch');
                }
            }
        } else {
            $branch['lists'] = $this->model_branch->getAll();
            $data['title']   = "Branch";
            $data['content'] = $this->load->view('administrator/branch/view', $branch, true);
            $this->load->view('administrator/default_template', $data);
        }
    }
}