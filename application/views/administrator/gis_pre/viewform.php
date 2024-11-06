<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>
<link rel="stylesheet" href="<?php echo base_url()?>includes/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>includes/css/prettify.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url()?>includes/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/prettify.js"></script>
<script type="text/javascript">
	$('body').on('focus', "#dob, #dor, #dom, #DNI_on, #doj, #doc, #pom_group_d_from, #pom_group_d_to,#savings_add_from,#savings_add_to,#savings_less_from,#savings_less_to, #pom_group_c_from, #pom_group_c_to, #pom_group_b_from, #pom_group_b_to, #pom_group_a_from, #pom_group_a_to, #cal_sav_amt_group_d_from, #cal_sav_amt_group_c_from, #cal_sav_amt_group_b_from, #cal_sav_amt_group_a_from, #d_of_settlement", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
</script>
<h3>Attach Checklist Details &raquo;</h3> 
<br/>
<small style="font-size:12px; font-weight:bold;color:darkgrey">Use this panel to attach Checklist detail entry for this claimant</small>                  
<?php
    $record = @$records[0];
    if($branch_code == '1001') {
        $name = @$record['name'];
    	$dor = @$record['dor']; 
    	$salutation = @$record['salutation'];    
        $designation=@$record['designation'];
    	$doj=@$record['doj'];
    	$office_address=@$record['office_address'];
    	$dob ='';
    }else if($branch_code == '1004'){
       $name = @$record['pensionee_name'];
       $dor = @$record['dor'];
       $salutation = @$record['salutation'];
       $doj='';
       $designation=@$record['designation'];
       $office_address='';
    }
?>
<?php echo $file_no; ?>
<form  action="<?php echo site_url('administrator/Gis/attach_checklist/'.base64_encode($file_no)); ?>" method="post" autocomplete="off">
    <div>
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td class="width25"><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Name</label></td>
                        <td class="width25"><input title="Name" readonly name="name" value="<?php echo $salutation;?>&nbsp;<?php echo $name;?>" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td class="width25"><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Designation</label></td>
                        <td class="width25"><input title="Designation" readonly name="designation" type="text" value="<?php echo $designation;?>" class="form-control parsley-validated" placeholder=""><?php echo form_error('designation', '<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Claiment<?php echo nbs(2);?><input title="Provide Fixed Pay" id="self" name="claiment" type="radio" value="self"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Self</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><input title="" name="claiment" type="radio" id="other_claiment"  value="other_claiment"  class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Others</b><?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr style="display:none" id="if_claiment">
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Name of the Claimant</label></td>
                        <td><input title="Name"  name="claiment_name" value="" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">his/her relationship with
The employee (in case of Death of Govt. Servant)
</label></td>
                        <td><select name="claiment_relation"><option value="">Select</option><option>Wife</option><option>Son</option><option>Daughter</option><option>Father</option><option>Mother</option></select></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Village/Town</label></td>
                        <td><input title="Name"  name="vill_town" value="" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Village/Town"><?php echo form_error('vill_town', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Post Office</label></td>
                        <td><input title="Designation"  name="po" type="text" value="" class="form-control parsley-validated" placeholder=""><?php echo form_error('po', '<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                        <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">District</label></td>
                        <td><input title="Name"  name="district" value="" type="text" class="form-control parsley-validated" placeholder="Please Enter District"><?php echo form_error('district', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">State</label></td>
                        <td><input title="Designation"  name="state" type="text"  class="form-control parsley-validated" placeholder=""><?php echo form_error('state','<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                    <tr>
                        <td><strong>Date of Entry into Service</strong></td>
                        <td><input title="joining Date" name="doj" id="doj" type="text" value="<?php echo $doj; ?>" class="form-control parsley-validated" placeholder="Provide Date of Entry into Service"><?php echo form_error('doj', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Office in which last served</label></td>
                        <td><textarea name="office_address" placeholder="Please Enter Office in which last served" class="form-control parsley-validated"><?php echo $office_address;?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?><br/></td></td>                           
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of death/retirement/resignation/absorption
to Autonomous Body/PSUs from service & designation</label></td>
                        <td><input title="Date of Retirement" name="dor" id="dor" value="<?php echo $dor;?>" type="text" class="form-control parsley-validated" placeholder=""><?php echo form_error('dor', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of settlement of Pension (Signing date of PPO)</label></td>
                        <td><input title="Designation" name="d_of_settlement" id="d_of_settlement" type="text" value="" class="form-control parsley-validated" placeholder=""><?php echo form_error('d_of_settlement', '<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of membership in the Scheme </label></td>
                        <td><input title="Name" name="dom" id="dom" value="" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Date of membership in the Scheme"><?php echo form_error('dom', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Group Status</label></td>
                        <td><select name="dom_group"><option>Select</option><option>A</option><option>B</option><option>C</option><option>D</option></select><?php echo form_error('dom_group', '<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                        <tr><td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of cessation from membership</label></td>
                        <td><input title="Name" name="date_of_cessation" id="doc" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Date of cessation from membership"><?php echo form_error('date_of_cessation', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Group Status</label></td>
                        <td><select name="doc_group"><option>Select</option><option>A</option><option>B</option><option>C</option><option>D</option></select><?php echo form_error('doc_group', '<div class="error">', '</div>'); ?></td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Group-wise period of membership and rate of subscription</label></td> 
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(a)<?php echo nbs(2);?>Group "D" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_d_from" id="pom_group_d_from" type="text" value=""   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_d_to" id="pom_group_d_to" style="width:15%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>=</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_d_years" style="width:13%;" id="pom_group_d_years" type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Years<?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_d_amt_1sthalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <input title="Provide date from which the fixed pay has got effect" name="group_d_amt_2ndhalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(b)<?php echo nbs(2);?>Group "C" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_c_from" id="pom_group_c_from" type="text" value=""   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_c_to" id="pom_group_c_to" style="width:15%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>=</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_c_years" style="width:13%;" id="pom_group_c_years" type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Years<?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_c_amt_1sthalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <input title="Provide date from which the fixed pay has got effect" name="group_c_amt_2ndhalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(c)<?php echo nbs(2);?>Group "B" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_b_from" id="pom_group_b_from" type="text" value=""   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_b_to" id="pom_group_b_to" style="width:15%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>=</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_b_years" style="width:13%;" id="pom_group_b_years" type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Years<?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_b_amt_1sthalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <input title="Provide date from which the fixed pay has got effect" name="group_b_amt_2ndhalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(d)<?php echo nbs(2);?>Group "A" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_a_from" id="pom_group_a_from" type="text" value=""   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_a_to" id="pom_group_a_to" style="width:15%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>=</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_a_years" style="width:13%;" id="pom_group_a_years" type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Years<?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_a"  style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                            <input title="Provide date from which the fixed pay has got effect" name="group_a_amt_2ndhalf" style="width:13%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Status of Forms(Check the form furnished):-</label></td> 
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(i)<?php echo nbs(2);?><input title="" name="form_status" type="radio" value="Application in form-4"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Application inForm-4</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="" name="form_status" type="radio" value="Application in form-6"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Application inForm-6</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(ii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="form_9" type="checkbox" value="form-9"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Application inForm-9</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="form_13" type="checkbox" value="form-13"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Application inForm-13</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="4"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Whether Pre-receipted Bill/Bills received for:-</label></td> 
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center">
                            <b>(a)<?php echo nbs(2);?>Savings fund-<?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="savings_fund" type="radio" value="1"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Yes</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="savings_fund" type="radio" value="0"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>No</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center">
                            <b>(b)<?php echo nbs(2);?>Insurance fund(incase of deceased employee)-<?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="insurance_fund" type="radio" value="1"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Yes</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="insurance_fund" type="radio" value="0"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>No</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Whether Pre-receipted Bill/Bills are signed by the Claimant-<?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_claiment" type="radio" value="yes"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Yes</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_claiment" type="radio" value="no"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>No</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Whether Pre-receipted Bill/Bills are countersigned by the HoO-<?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_HoO" type="radio" value="yes"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Yes</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_HoO" type="radio" value="no"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>No</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">
 Sanction from Head of Office exists/does not exist, ( if exists the amount):-</label></td> 
                    </tr>
                    <tr>
                        <td><strong>Savings Fund:-Rs</strong></td>
                        <td><input title="joining Date" name="savings_amt" id="" type="text" value="" class="form-control parsley-validated" placeholder="Provide Savings fund amount"><?php echo form_error('', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Insurance Fund:-Rs</label></td>
                        <td><input name="insurance_amt" type="text" title="Office" class="form-control parsley-validated" placeholder="Provide Insurance"><?php echo form_error('exist_bp', '<div class="error">', '</div>'); ?></td>                           
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center">
                            <b><?php echo nbs(2);?>The Claim is:-<?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="claim_status" type="radio" value="complete" id="complete"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Complete</b><?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="claim_status" type="radio" value="incomplete" id="incomplete"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Incomplete</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr style="display:none" id="objection">
                        <td colspan="5">
                            <select name="objection[]" id="example32" multiple="multiple" tabindex="1">
                            <?php foreach ($obj as $value) {?>
                                <option value="<?php echo $value['s_no']?>"><?php echo $value['desc'];?></option>
                            <?php } ?>
                            </select>
                        </td>                                                  
                    </tr>
                    <tr>
                        <td colspan="5"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Calculation of amount admissible from Savings and Insurance Fund as per Table 2014-07-24</label></td> 
                    </tr>
                    <tr id="groupD">
                        <td colspan="5">
                            <b>(a)<?php echo nbs(2);?>Group "D" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_d_from" type="text" value="" id="cal_sav_amt_group_d_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="cal_sav_amt_group_d_to" name="cal_sav_amt_group_d_to" style="width:15%" type="text"  value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_d" style="width:13%;"  type="text" id="amount1" value="" class="form-control parsley-validated gis_amount" placeholder="">
                            <?php echo nbs(2);?><b>x 1 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_d" style="width:13%" type="text" id="total1" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    <tr id="groupC">
                        <td colspan="5">
                            <b>(b)<?php echo nbs(2);?>Group "C" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_c_from" type="text" value="" id="cal_sav_amt_group_c_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="cal_sav_amt_group_c_to" name="cal_sav_amt_group_c_to" style="width:15%" type="text" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_c" style="width:13%;"  type="text" id="amount2" value="" class="form-control parsley-validated gis_amount" placeholder="">
                            <?php echo nbs(2);?><b>x 2 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_c" style="width:13%" type="text" id="total2" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>  
                    </tr>
                    <tr id="groupB">
                        <td colspan="5">
                            <b>(c)<?php echo nbs(2);?>Group "B" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_b_from" type="text" value="" id="cal_sav_amt_group_b_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="cal_sav_amt_group_b_to" name="cal_sav_amt_group_b_to" style="width:15%" type="text" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_b" style="width:13%;"  type="text" id="amount3" value="" class="form-control parsley-validated gis_amount" placeholder="">
                            <?php echo nbs(2);?><b>x 4 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_b" style="width:13%" type="text" id="total3" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    <tr id="groupA">
                        <td colspan="5">
                            <b>(d)<?php echo nbs(2);?>Group "A" from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_a_from" type="text" value="" id="cal_sav_amt_group_a_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="cal_sav_amt_group_a_to" name="cal_sav_amt_group_a_to" style="width:15%" type="text" value="" class="form-control parsley-validated" placeholder=""> 
                            <?php echo nbs(2);?><b>Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_a" style="width:13%;"  type="text" id="amount4" value="" class="form-control parsley-validated gis_amount" placeholder="">
                            <?php echo nbs(2);?><b>x 8 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_a" style="width:13%" type="text" id="total4" value="" class="form-control parsley-validated" placeholder=""> 
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Refund of unauthorized/excess subscription from</b><?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="savings_add_from" type="text" value="" id="savings_add_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="savings_add_to" name="savings_add_to" style="width:15%" type="text" value="" class="form-control parsley-vali dated" placeholder=""> 
                            <?php echo nbs(2);?><b>@Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="savings_add" style="width:13%;"  type="text" id="savings_add" value="" class="form-control parsley-validated gis_amount" placeholder="">
                        </td>
                    </tr>
                     <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Shorts subscription <?php echo nbs(50);?>from<?php echo nbs(2)?></b>
                            <input title="Provide Fixed Pay" style="width:13%;" name="savings_less_from" type="text" value="" id="savings_less_from"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b><?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="savings_less_to" name="savings_less_to" style="width:15%" type="text" value="" class="form-control parsley-vali dated" placeholder=""> 
                            <?php echo nbs(2);?><b>@Rs</b><?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="savings_less" style="width:13%;"  type="text" id="savings_less" value="" class="form-control parsley-validated gis_amount" placeholder="">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="5"><label style="width:100%;font-weight:bold" class="col-sm-3 control-label">INSURANCE FUND</label></td> 
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(i)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="1,20,000"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Group ‘A’ ---- Rs 1, 20,000/-</b><?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(ii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="60,000"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Group ‘B’ ---- Rs 60,000/-</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="30,000"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Group ‘C’ ---- Rs 30,000/-</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iv)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="15,000"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Group ‘D’ ---- Rs 15,000/-</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iv)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="0"   class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?>Not Eligible</b><?php echo nbs(2);?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">The T.O/S.T.O to be authorized for payment : </label></td>
                        <td><input title="Name" name="TO" value="" type="text"  class="form-control parsley-validated" placeholder="Please Enter TO/STO name"><?php echo form_error('TO', '<div class="error">', '</div>'); ?></td>
                     </tr>
                </tbody>
            </table> 
            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
    </div> 
    <button type="submit" name="submit_val" class="btn btn-primary">Save and Print</button>
    <input type="reset" class="btn btn-warning" value="Cancel"> 
    <br/><small style="font-size:12px; font-weight:bold;color:darkgrey">If you are not sure on this or want to learn more, contact software provider</small>                  
</form>                 
<style type="text/css">
    .width25 {width: 25%;}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#other_claiment").click(function(){
            $('#if_claiment').show('slow');
        });

        $("#self").click(function(){
            $('#if_claiment').hide('slow');
        });

        $("#incomplete").click(function(){
            $('#objection').show('slow');
        });

        window.prettyPrint() && prettyPrint();
        $('#example32').multiselect();

        $("#complete").click(function(){
            $('#objection').hide('slow');
        });
    });
  $(document).ready(function(){
    $("#pom_group_d_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_d_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_d_years').val(result.year);
        });
    }});
	

    $("#pom_group_c_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_c_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_c_years').val(result.year);
        });
    }});

    $("#pom_group_b_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_b_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_b_years').val(result.year);
        });
    }});

    $("#pom_group_a_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_a_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_a_years').val(result.year);
        });
    }});
	
});
    function FillAddress(f) {
        if(f.addresstoo.checked == true) {
            f.cor_address.value = f.per_address.value;
        }
    }

    $(function() {
        $('textarea.ckeditor_standard').ckeditor({
            height: '150px',
            width:'500px',
            toolbar: [
                {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                {name: 'basicstyles', items: ['Bold', 'Italic']}
            ]
        });
    });
	
	/*$("#pom_group_b_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
    console.log(date);
    $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_b_from').val(), jsonData: "true"}, function(data){
       var result = JSON.parse(data);
       $('#aryear').val(result.year);
       $('#armonth').val(result.month);
       $('#arday').val(result.day);
    });
	}});
*/	
	
	
	

    $('body').on('focus', '#cal_sav_amt_group_d_to', function() {
        if($('#cal_sav_amt_group_d_from').val() == '') {
            alert('please select from date');
            $('#cal_sav_amt_group_d_from').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'}).focus();
        } else {
            $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                $.post('<?php echo site_url("administrator/Gis/get_gis_chart"); ?>', {from: $('#cal_sav_amt_group_d_from').val(), to: $('#cal_sav_amt_group_d_to').val()}, function(result) {
                    $('#amount1').val(result);
                    amount1KeyUp();
                });
            }});
        }
    });
    $('body').on('focus', '#cal_sav_amt_group_c_to', function() {
        if($('#cal_sav_amt_group_c_from').val() == '') {
            alert('please select from date');
            $('#cal_sav_amt_group_c_from').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'}).focus();
        } else {
            $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                $.post('<?php echo site_url("administrator/Gis/get_gis_chart"); ?>', {from: $('#cal_sav_amt_group_c_from').val(), to: $('#cal_sav_amt_group_c_to').val()}, function(result) {
                    $('#amount2').val(result);
                    amount2KeyUp();
                });
            }});
        }
    });
    $('body').on('focus', '#cal_sav_amt_group_b_to', function() {
        if($('#cal_sav_amt_group_b_from').val() == '') {
            alert('please select from date');
            $('#cal_sav_amt_group_b_from').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'}).focus();
        } else {
            $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                $.post('<?php echo site_url("administrator/Gis/get_gis_chart"); ?>', {from: $('#cal_sav_amt_group_b_from').val(), to: $('#cal_sav_amt_group_b_to').val()}, function(result) {
                    $('#amount3').val(result);
                    amount3KeyUp();
                });
            }});
        }
    });
    $('body').on('focus', '#cal_sav_amt_group_a_to', function() {
       if($('#cal_sav_amt_group_a_from').val() == '') {
            alert('please select from date');
            $('#cal_sav_amt_group_a_from').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'}).focus();
        } else {
            $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                $.post('<?php echo site_url("administrator/Gis/get_gis_chart"); ?>', {from: $('#cal_sav_amt_group_a_from').val(), to: $('#cal_sav_amt_group_a_to').val()}, function(result) {
                    $('#amount4').val(result);
                    amount4KeyUp();
                });
            }});
        }
    });



    $(document).ready(function(){
        $('#amount1').live('keyup', function() {
            amount1KeyUp();
        });
        $('#amount2').live('keyup', function() {
            amount2KeyUp();
        });
        $('#amount3').live('keyup', function() {
            amount3KeyUp();
        });
        $('#amount4').live('keyup', function() {
            amount4KeyUp();              
        });
    });

    var amount1KeyUp = function() {
        $a = $('#amount1').val();
        $b = $a*1;
        $("#total1").val($b);
    }

    var amount2KeyUp = function() {
        if($("#amount1").val() == "") {
            $a = $('#amount2').val();
            $b = $a*2;
            $("#total2").val($b);
        } else {
            $a = $('#amount2').val();
            $b = $a*1;
            $("#total2").val($b);
        }
    }

    var amount3KeyUp = function() {
        if($("#amount1").val() == "" && $("#amount2").val() == "") {
            $a = $('#amount3').val();
            $b = $a*4;
            $("#total3").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() !== "") {
            $a = $('#amount3').val();
            $b = $a*1;
            $("#total3").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "") {
            $a = $('#amount3').val();
            $b = $a*2;
            $("#total3").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() == "") {
            $a = $('#amount3').val();
            $b = $a*3;
            $("#total3").val($b);
        }
    }

    var amount4KeyUp = function() {
        if($("#amount1").val() == "" && $("#amount2").val() == "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*8;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*1;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() == "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*7;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*5;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() == "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*4;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() !== "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*5;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() == "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*3;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*2;
            $("#total4").val($b);
        }  
    }
</script>