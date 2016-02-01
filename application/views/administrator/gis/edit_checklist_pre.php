<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>

<link rel="stylesheet" href="<?php echo base_url()?>includes/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>includes/css/prettify.css" type="text/css">

<script type="text/javascript" src="<?php echo base_url()?>includes/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/prettify.js"></script>

<script type="text/javascript">
    $('body').on('focus', "#dob, #dor, #dom, #DNI_on, #doj, #doc, #pom_group_d_from, #pom_group_d_to, #pom_group_c_from, #pom_group_c_to, #pom_group_b_from, #pom_group_b_to, #pom_group_a_from, #pom_group_a_to, #cal_sav_amt_group_d_from, #cal_sav_amt_group_d_to, #cal_sav_amt_group_c_from, #cal_sav_amt_group_c_to, #cal_sav_amt_group_b_from, #cal_sav_amt_group_b_to, #cal_sav_amt_group_a_from, #cal_sav_amt_group_a_to, #d_of_settlement", function() {
        $(this).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:+0'
        });
    });
</script>
<h3>Edit Checklist Details &raquo;</h3>
<br/>

<small style="font-size:12px; font-weight:bold;color:darkgrey">
Use this panel to attach Checklist detail entry for this claimant</small>
<?php $record=@ $records[0];?>
<?php $name=@ $record[ 'pensionee_name']; $designation=@$record[ 'designation']; $claiment_name=$record[ 'claiment_name']; $claiment_relation=$record[ 'claiment_relation']; $claiment=@$record[ 'claiment']; $office_address=$record[ 'office_address']; $doc_group=@$record[ 'doc_group']; $dom_group=@$record[ 'dom_group']; $pom_group_d_from=$record[ 'pom_group_d_from']; $pom_group_d_to=$record[ 'pom_group_d_to']; $pom_group_d_years=$record[ 'pom_group_d_years']; $group_d_amt_1sthalf=$record[ 'group_d_amt_1sthalf']; $group_d_amt_2ndhalf=$record[ 'group_d_amt_2ndhalf']; $pom_group_c_from=$record[ 'pom_group_c_from']; $pom_group_c_to=$record[ 'pom_group_c_to']; $pom_group_c_years=$record[ 'pom_group_c_years']; $group_c_amt_1sthalf=$record[ 'group_c_amt_1sthalf']; $group_c_amt_2ndhalf=$record[ 'group_c_amt_2ndhalf']; $pom_group_b_from=$record[ 'pom_group_b_from']; $pom_group_b_to=$record[ 'pom_group_b_to']; $pom_group_b_years=$record[ 'pom_group_b_years']; $group_b_amt_1sthalf=$record[ 'group_b_amt_1sthalf']; $group_b_amt_2ndhalf=$record[ 'group_b_amt_2ndhalf']; $pom_group_a_from=$record[ 'pom_group_a_from']; $pom_group_a_to=$record[ 'pom_group_a_to']; $pom_group_a_years=$record[ 'pom_group_a_years']; $group_a_amt_1sthalf=$record[ 'group_a_amt_1sthalf']; $group_a_amt_2ndhalf=$record[ 'group_a_amt_2ndhalf']; $form_status=$record[ 'form_status']; $form_9=$record[ 'form_9']; $form_13=$record[ 'form_13']; $savings_fund=$record[ 'savings_fund']; $insurance_fund=$record[ 'insurance_fund']; $bill_signed_by_claiment=$record[ 'bill_signed_by_claiment']; $bill_signed_by_HoO=$record[ 'bill_signed_by_HoO']; $savings_amt=$record[ 'savings_amt']; $insurance_amt=$record[ 'insurance_amt']; $claim_status=$record[ 'claim_status']; $objection=unserialize($record[ 'objection']); $cal_sav_amt_group_d_from=$record[ 'cal_sav_amt_group_d_from']; $cal_sav_amt_group_d_to=$record[ 'cal_sav_amt_group_d_to']; $cal_sav_amt_group_d=$record[ 'cal_sav_amt_group_d']; $total_cal_sav_amt_group_d=$record[ 'total_cal_sav_amt_group_d']; $cal_sav_amt_group_c_from=$record[ 'cal_sav_amt_group_c_from']; $cal_sav_amt_group_c_to=$record[ 'cal_sav_amt_group_c_to']; $cal_sav_amt_group_c=$record[ 'cal_sav_amt_group_c']; $total_cal_sav_amt_group_c=$record[ 'total_cal_sav_amt_group_c']; $cal_sav_amt_group_b_from=$record[ 'cal_sav_amt_group_b_from']; $cal_sav_amt_group_b_to=$record[ 'cal_sav_amt_group_b_to']; $cal_sav_amt_group_b=$record[ 'cal_sav_amt_group_b']; $total_cal_sav_amt_group_b=$record[ 'total_cal_sav_amt_group_b']; $cal_sav_amt_group_a_from=$record[ 'cal_sav_amt_group_a_from']; $cal_sav_amt_group_a_to=$record[ 'cal_sav_amt_group_a_to']; $cal_sav_amt_group_a=$record[ 'cal_sav_amt_group_a']; $total_cal_sav_amt_group_a=$record[ 'total_cal_sav_amt_group_a']; $final_insurance_amt=$record[ 'final_insurance_amt']; $TO=$record[ 'TO']; $savings_add_from=$record[ 'savings_add_from']; $savings_add_to=$record[ 'savings_add_to']; $savings_add=$record[ 'savings_add']; $savings_less_from=$record[ 'savings_less_from']; $savings_less_to=$record[ 'savings_less_to']; $savings_less=$record[ 'savings_less']; ?>
<form action="<?php echo site_url('administrator/Gis/edit_checklist/'.base64_encode($file_no));?>" method="post" autocomplete="off">
    <div>
        <div class="box span12">
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td width="25%">
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Name</label>
                        </td>
                        <td width="25%">
                            <input title="Name" readonly name="name" value="<?php echo $name;?>" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'name', '<div class="error">', '</div>'); ?>
                        </td>
                        <td width="25%">
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Designation</label>
                        </td>
                        <td width="25%">
                            <input title="Designation" readonly name="designation" type="text" value="<?php echo $designation;?>" class="form-control parsley-validated" placeholder="">
                            <?php echo form_error( 'designation', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Claiment<?php echo nbs(2);?><input title="Provide Fixed Pay" id="self" name="claiment" type="radio" value="self"  <?php if($claiment=="self"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Self</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><input title="" name="claiment" type="radio" id="other_claiment"  value="other_claiment" <?php if($claiment=="other_claiment") {?>checked <?php }?>  class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Others</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr <?php if($claiment=="other_claiment") { ?>style="visibility:visible"<?php } else { ?>style="display:none"<?php } ?> id="if_claiment">
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Name of the Claimant</label>
                        </td>
                        <td>
                            <input title="Name" name="claiment_name" type="text" value="<?php echo $claiment_name;?>" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'name', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">his/her relationship with The employee (in case of Death of Govt. Servant)
                            </label>
                        </td>
                        <td>
                            <select name="claiment_relation">
                                <?php if(!$claiment_relation==''){ echo "<option value=$claiment_relation>$claiment_relation</option>"; } ?>
                                <option value="">Select</option>
                                <option>Wife</option>
                                <option>Son</option>
                                <option>Daughter</option>
                                <option>Father</option>
                                <option>Mother</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Village/Town</label>
                        </td>
                        <td>
                            <input title="Name" name="vill_town" value="<?php echo $record['village_town']?>" type="text" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'vill_town', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Post Office</label>
                        </td>
                        <td>
                            <input title="Designation" name="po" type="text" value="<?php echo $record['po']?>" class="form-control parsley-validated" placeholder="">
                            <?php echo form_error( 'po', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">District</label>
                        </td>
                        <td>
                            <input title="Name" name="district" value="<?php echo $record['district']?>" type="text" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'district', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">State</label>
                        </td>
                        <td>
                            <input title="Designation" name="state" type="text" value="<?php echo $record['state']?>" class="form-control parsley-validated" placeholder="">
                            <?php echo form_error( 'state', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Date of Entry into Service</strong></td>
                        <td>
                            <input title="joining Date" name="doj" id="doj" type="text" value="<?php echo $record['doj']?>" class="form-control parsley-validated" placeholder="Provide Date of Retirement">
                            <?php echo form_error( 'doj', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Office in which last served</label>
                        </td>
                        <td>
                            <textarea name="office_address" placeholder="Please Enter Remarks" class="form-control parsley-validated"><?php echo $office_address; ?><?php //echo set_value( 'office_address'); ?></textarea>
                            <?php echo form_error( 'office_address', '<div class="error">', '</div>'); ?>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of death/retirement/resignation/absorption to Autonomous Body/PSUs from service & designation
                            </label>
                        </td>
                        <td>
                            <input title="Date of Retirement" name="dor" id="dor" value="<?php echo $record['dor']?>" type="text" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'dor', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of settlement of Pension (Signing date of PPO)</label>
                        </td>
                        <td>
                            <input title="Designation" name="d_of_settlement" id="d_of_settlement" type="text" value="<?php echo $record['date_of_settlement']?>" class="form-control parsley-validated" placeholder="">
                            <?php echo form_error( 'd_of_settlement', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of membership in the Scheme
                            </label>
                        </td>
                        <td>
                            <input title="Name" name="dom" id="dom" type="text" value="<?php echo $record['date_of_membership']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'dom', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Group Status</label>
                        </td>

                        <td>
                            <select name="dom_group[]" multiple>
                                <option value="">--Select--</option>
                                <?php $dom_group_array = ['A', 'B', 'C', 'D']; ?>
                                <?php $dom_group_unserel = unserialize($dom_group); ?>
                                <?php foreach($dom_group_array as $a) : ?>
                                    <?php if( in_array($a, $dom_group_unserel) ) : ?>
                                        <option value="<?php echo $a; ?>" selected><?php echo $a; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php //echo form_error( 'dom_group', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of cessation from membership
                            </label>
                        </td>
                        <td>
                            <input title="Name" name="date_of_cessation" id="doc" type="text" value="<?php echo $record['date_of_cessation']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name">
                            <?php echo form_error( 'date_of_cessation', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Group Status</label>
                        </td>
                        <td>
                            <select name="doc_group[]" multiple>
                            <option value="">--Select--</option>
                            <?php $doc_group_array = ['A', 'B', 'C', 'D']; ?>
                            <?php $doc_group_unserel = unserialize($doc_group); ?>
                                <?php foreach($doc_group_array as $a) : ?>
                                    <?php if( in_array($a, $doc_group_unserel) ) : ?>
                                        <option value="<?php echo $a; ?>" selected><?php echo $a; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error( 'doc_group', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Group-wise period of membership and rate of subscription</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(a)<?php echo nbs(2);?>Group "D" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_d_from" id="pom_group_d_from" type="text" <?php if(!$pom_group_d_from=="0" ){?> value="<?php echo $pom_group_d_from?>" <?php }else{?>value="" <?php } ?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_d_to" <?php if(!$pom_group_d_from=="0" ){?> value="<?php echo $pom_group_d_to?>" <?php }else{?>value="" <?php } ?> id="pom_group_d_to" style="width:15%" type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>=</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_d_years" style="width:13%;" id="" type="text" <?php if(!$pom_group_d_years=="0" ){?> value="<?php echo $pom_group_d_years?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b><?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_d_amt_1sthalf" style="width:13%" type="text" id="effect_from" <?php if(!$group_d_amt_1sthalf=="0" ){?> value="<?php echo $group_d_amt_1sthalf?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                            <input title="Provide date from which the fixed pay has got effect" name="group_d_amt_2ndhalf" style="width:13%" type="text" id="effect_from" <?php if(!$group_d_amt_2ndhalf=="0" ){?> value="<?php echo $group_d_amt_2ndhalf?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(b)<?php echo nbs(2);?>Group "C" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_c_from" id="pom_group_c_from" type="text" <?php if(!$pom_group_c_from=="0" ){?> value="<?php echo $pom_group_c_from?>" <?php }else{?>value="" <?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_c_to" id="pom_group_c_to" <?php if(!$pom_group_c_to=="0" ){?> value="<?php echo $pom_group_c_to?>" <?php }else{?>value="" <?php } ?> style="width:15%" type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>=</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_c_years" style="width:13%;" id="" type="text" <?php if(!$pom_group_c_years=="0" ){?> value="<?php echo $pom_group_c_years?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b><?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_c_amt_1sthalf" style="width:13%" type="text" <?php if(!$group_c_amt_1sthalf=="0" ){?> value="<?php echo $group_c_amt_1sthalf?>" <?php }else{?>value="0" <?php }?> id="effect_from" class="form-control parsley-validated" placeholder="">
                            <input title="Provide date from which the fixed pay has got effect" name="group_c_amt_2ndhalf" style="width:13%" type="text" id="effect_from" <?php if(!$group_c_amt_2ndhalf=="0" ){?> value="<?php echo $group_c_amt_2ndhalf?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(c)<?php echo nbs(2);?>Group "B" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_b_from" id="pom_group_b_from" type="text" <?php if(!$pom_group_b_from=="0" ){?> value="<?php echo $pom_group_b_from?>" <?php }else{?>value="" <?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_b_to" <?php if(!$pom_group_b_to=="0" ){?> value="<?php echo $pom_group_b_to?>"<?php }else{?>value=""<?php } ?> id="pom_group_b_to" style="width:15%" type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>=</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_b_years" style="width:13%;" id="" type="text" <?php if(!$pom_group_b_years=="0" ){?> value="<?php echo $pom_group_b_years?>"<?php }else{?>value="0"<?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b><?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_b_amt_1sthalf" style="width:13%" type="text" id="effect_from" <?php if(!$group_b_amt_1sthalf=="0" ){?> value="<?php echo $group_b_amt_1sthalf?>"<?php }else{?>value="0"<?php }?> class="form-control parsley-validated" placeholder="">
                            <input title="Provide date from which the fixed pay has got effect" name="group_b_amt_2ndhalf" style="width:13%" type="text" id="effect_from" <?php if(!$group_b_amt_2ndhalf=="0" ){?> value="<?php echo $group_b_amt_2ndhalf?>" <?php }else{?>value="0" <?php }?> class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(d)<?php echo nbs(2);?>Group "A" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="pom_group_a_from" id="pom_group_a_from" type="text" <?php if(!$pom_group_a_from=="0" ){?> value="<?php echo $pom_group_a_from?>"<?php }else{?>value=""<?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" name="pom_group_a_to" <?php if(!$pom_group_a_to=="0" ){?> value="<?php echo $pom_group_a_to?>"<?php }else{?>value=""<?php } ?> id="pom_group_a_to" style="width:15%" type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>=</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="pom_group_a_years" style="width:13%;" id="" type="text" <?php if(!$pom_group_a_years=="0" ){?> value="<?php echo $pom_group_a_years?>"<?php }else{?>value="0"<?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b><?php echo nbs(2);?>@Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="group_a" style="width:13%" type="text" id="effect_from" <?php if(!$group_a_amt_1sthalf=="0" ){?> value="<?php echo $group_a_amt_1sthalf?>"<?php }else{?>value="0"<?php }?> class="form-control parsley-validated" placeholder="">
                            <input title="Provide date from which the fixed pay has got effect" name="group_a_amt_2ndhalf" style="width:13%" <?php if(!$group_a_amt_2ndhalf=="0" ){?> value="<?php echo $group_a_amt_2ndhalf?>"<?php }else{?>value="0"<?php }?> type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Status of Forms(Check the form furnished):-</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(i)<?php echo nbs(2);?><input title="" name="form_status" type="radio" value="Application in form-4" <?php if($form_status=="Application in form-4"){?>checked <?php }?>     class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Application inForm-4</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="" name="form_status" type="radio" value="Application in form-6" <?php if($form_status=="Application in form-6"){?>checked <?php }?>    class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Application inForm-6</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(ii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="form_9" type="checkbox" value="form-9" <?php if($form_9=="1"){ ?>checked<?php } ?> class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Application inForm-9</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="form_13" type="checkbox" value="form-13" <?php if($form_13=="1"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Application inForm-13</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Whether Pre-receipted Bill/Bills received for:-</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center"><b>(a)<?php echo nbs(2);?>Savings fund-<?php echo nbs(2);?>
                    <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="savings_fund" type="radio" value="1"  <?php if($savings_fund=="1"){?>checked <?php }?> class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Yes</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="savings_fund" type="radio" value="0" <?php if($savings_fund=="0"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>No</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center"><b>(b)<?php echo nbs(2);?>Insurance fund(incase of deceased employee)-<?php echo nbs(2);?>
                    <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="insurance_fund" type="radio" value="1" <?php if($insurance_fund=="1"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Yes</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="insurance_fund" type="radio" value="0" <?php if($insurance_fund=="0"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>No</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><b><?php echo nbs(2);?>Whether Pre-receipted Bill/Bills are signed by the Claimant-<?php echo nbs(2);?>
                    <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_claiment" type="radio" value="yes" <?php if($bill_signed_by_claiment=="yes"){?>checked <?php }?>    class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Yes</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_claiment" type="radio" value="no" <?php if($bill_signed_by_claiment=="no"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>No</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><b><?php echo nbs(2);?>Whether Pre-receipted Bill/Bills are countersigned by the HoO-<?php echo nbs(2);?>
                    <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_HoO" type="radio" value="yes" <?php if($bill_signed_by_HoO=="yes"){?>checked <?php }?>     class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Yes</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="bill_signed_by_HoO" type="radio" value="no"  <?php if($bill_signed_by_HoO=="no"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>No</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">
                                Sanction from Head of Office exists/does not exist, ( if exists the amount) :-
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Savings Fund:-Rs</strong></td>
                        <td>
                            <input title="joining Date" name="savings_amt" id="" type="text" value="<?php echo $savings_amt?>" class="form-control parsley-validated" placeholder="Provide Savings fund amount">
                            <?php echo form_error( '', '<div class="error">', '</div>'); ?>
                        </td>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Insurance Fund:-Rs</label>
                        </td>
                        <td>
                            <input name="insurance_amt" type="text" title="Office" value="<?php echo $insurance_amt?>" class="form-control parsley-validated" placeholder="Provide Insurance">
                            <?php echo form_error( 'exist_bp', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align:center"><b><?php echo nbs(2);?>The Claim is:-<?php echo nbs(2);?>
                        <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="claim_status" type="radio" value="complete" id="complete" <?php if($claim_status=="complete"){?>checked <?php }?>  3.    Form-9 & 13 with normal rate of subscription upto 31/12/89 and enhanced rate 01-01-1990.
                        Duly authenticated by Head of Office.
                        class="form-control parsley-validated" placeholder="">
                        <?php echo nbs(2);?>Complete</b>
                            <?php echo nbs(2);?>
                            <b><?php echo nbs(2);?><?php echo nbs(2);?><input title="Provide Fixed Pay" name="claim_status" type="radio" value="incomplete" id="incomplete" <?php if($claim_status=="incomplete"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                        <?php echo nbs(2);?>Incomplete</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr <?php if($claim_status=="complete" ){?>style="display:none"
                        <?php }?> id="objection">
                        <td colspan="5">
                            <?php $old=array();?>
                            <?php foreach ($obj as $value) { $old[$value[ 's_no']]=$value[ 'desc']; } ?>
                            <?php //$array=a rray( '1'=>'1.Application in Form-4 under UTGEGIS 1984.', '2'=>'2. Application in Form-6 under UTGEGIS 1984 (In case of death of Govt. servant).','3'=>'3. Form-9 & 13 with normal rate of subscription upto 31/12/89 and enhanced rate 01-01-1990. //Duly authenticated by Head of Office.','4'=>'4. Death certificate (in case of Death of Govt. servant).','5'=>'5.Succession certificate/Legal heir certificate (in case of death of Govt. servant).','6'=>'6. Pre-receipted bill in duplicate (Saving fund & Insurance fund separately).', '7'=>'7.Sanction order for saving fund.','8'=>'8.Sanction order for Insurance fund, if applicable.','9(i)'=>'9i.Date of membership.','9(ii)'=>'9(ii) Change of group and rare of subscription.','9(iii)'=>'9(iii)Enhanced rate of subscription from 1990.','9(iv)'=>'9(iv) Month of last subscription.','9(v)'=>'9(v)Date of retirement/death/resignation.');?>
                            <?php //print_r($array); //exit(); ?>

                            <?php $new=array(); for($i=0;$i<count($objection);$i++){ array_push($new, $objection[$i][ 'objection']); } //print_r($new); // exit(); ?>
                            <select name="objection[]" id="example32" multiple="multiple" tabindex="1">
                                <?php foreach ($old as $key=> $value) { ?>
                                <?php if(in_array($key, $new)) { ?>
                                <option value="<?php echo $key; ?>" selected>
                                    <?php echo $value;?>
                                </option>
                                <?php } else { ?>
                                <option value="<?php echo $key; ?>">
                                    <?php echo $value; ?>
                                </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">Calculation of amount admissible from Savings and Insurance Fund as per Table 2014-07-24</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(a)<?php echo nbs(2);?>Group "D" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_d_from" type="text" <?php if(!$cal_sav_amt_group_d_from=="0" ){?> value="<?php echo $cal_sav_amt_group_d_from?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_d_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="cal_sav_amt_group_d_to" <?php if(!$cal_sav_amt_group_d_to=="0" ){?> value="<?php echo $cal_sav_amt_group_d_to?>"<?php }else{?>value=""<?php }?> name="cal_sav_amt_group_d_to" style="width:15%" type="text" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_d" style="width:13%;" type="text" <?php if(!$cal_sav_amt_group_d=="0" ){?> value="<?php echo $cal_sav_amt_group_d?>"<?php }else{?>value=""<?php }?> class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>x 1 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_d" style="width:13%" type="text" id="effect_from" <?php if(!$total_cal_sav_amt_group_d=="0" ){?> value="<?php echo $total_cal_sav_amt_group_d?>"<?php }else{?>value=""<?php }?> class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <b>(b)<?php echo nbs(2);?>Group "C" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_c_from" type="text" <?php if(!$cal_sav_amt_group_c_from=="0" ){?> value="<?php echo $cal_sav_amt_group_c_from?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_c_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" <?php if(!$cal_sav_amt_group_c_to=="0" ){?> value="<?php echo $cal_sav_amt_group_c_to?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_c_to" name="cal_sav_amt_group_c_to" style="width:15%" type="text" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_c" style="width:13%;" <?php if(!$cal_sav_amt_group_c=="0" ){?> value="<?php echo $cal_sav_amt_group_c?>"<?php }else{?>value=""<?php }?> type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>x 2 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_c" style="width:13%" <?php if(!$total_cal_sav_amt_group_c=="0" ){?> value="<?php echo $total_cal_sav_amt_group_c?>"<?php }else{?>value=""<?php }?> type="text" id="effect_from" class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(c)<?php echo nbs(2);?>Group "B" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_b_from" type="text" <?php if(!$cal_sav_amt_group_b_from=="0" ){?> value="<?php echo $cal_sav_amt_group_b_from?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_b_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" <?php if(!$cal_sav_amt_group_b_to=="0" ){?> value="<?php echo $cal_sav_amt_group_b_to?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_b_to" name="cal_sav_amt_group_b_to" style="width:15%" type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_b" style="width:13%;" <?php if(!$cal_sav_amt_group_b=="0" ){?> value="<?php echo $cal_sav_amt_group_b?>"<?php }else{?>value=""<?php }?> type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>x 4 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_b" style="width:13%" <?php if(!$total_cal_sav_amt_group_b=="0" ){?> value="<?php echo $total_cal_sav_amt_group_b?>"<?php }else{?>value=""<?php }?> type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>(d)<?php echo nbs(2);?>Group "A" from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="cal_sav_amt_group_a_from" type="text" <?php if(!$cal_sav_amt_group_a_from=="0" ){?> value="<?php echo $cal_sav_amt_group_a_from?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_a_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" <?php if(!$cal_sav_amt_group_a_to=="0" ){?> value="<?php echo $cal_sav_amt_group_a_to?>"<?php }else{?>value=""<?php }?> id="cal_sav_amt_group_a_from" name="cal_sav_amt_group_a_to" style="width:15%" type="text" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="cal_sav_amt_group_a" style="width:13%;" <?php if(!$cal_sav_amt_group_a=="0" ){?> value="<?php echo $cal_sav_amt_group_a?>"<?php }else{?>value=""<?php }?> type="text" value="" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>x 8 Unit<?php echo nbs(2);?>=Rs.</b>
                            <input title="Provide date from which the fixed pay has got effect" name="total_cal_sav_amt_group_a" style="width:13%" <?php if(!$total_cal_sav_amt_group_a=="0" ){?> value="<?php echo $total_cal_sav_amt_group_a?>"<?php }else{?>value=""<?php }?> type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Refund of unauthorized/excess subscription from</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Fixed Pay" style="width:13%;" name="savings_add_from" type="text" value="<?php echo $savings_add_from;?>" id="savings_add_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="savings_add_to" name="savings_add_to" style="width:15%" type="text" value="<?php echo $savings_add_to;?>" class="form-control parsley-vali dated" placeholder="">
                            <?php echo nbs(2);?><b>@Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="savings_add" style="width:13%;" type="text" id="savings_add" value="<?php echo $savings_add;?>" class="form-control parsley-validated gis_amount" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>Shorts subscription <?php echo nbs(50);?>from<?php echo nbs(2)?></b>
                            <input title="Provide Fixed Pay" style="width:13%;" name="savings_less_from" type="text" value="<?php echo $savings_less_from;?>" id="savings_less_from" class="form-control parsley-validated" placeholder="">
                            <?php echo nbs(2);?><b>to</b>
                            <?php echo nbs(2);?>
                            <input title="Provide date from which the fixed pay has got effect" style="width:13%;" id="savings_less_to" name="savings_less_to" style="width:15%" type="text" value="<?php echo $savings_less_to;?>" class="form-control parsley-vali dated" placeholder="">
                            <?php echo nbs(2);?><b>@Rs</b>
                            <?php echo nbs(2);?>
                            <input title="Provide Date of Next Increment" name="savings_less" style="width:13%;" type="text" id="savings_less" value="<?php echo $savings_less;?>" class="form-control parsley-validated gis_amount" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label style="width:100%;font-weight:bold" class="col-sm-3 control-label">INSURANCE FUND</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(i)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="120000" <?php if($final_insurance_amt=="120000"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Group ‘A’ ---- Rs 120000/-</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(ii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="60000"  <?php if($final_insurance_amt=="60000"){?>checked <?php }?>    class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Group ‘B’ ---- Rs 60000/-</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iii)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="30000" <?php if($final_insurance_amt=="30000"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Group ‘C’ ---- Rs 30000/-</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(iv)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="15000" <?php if($final_insurance_amt=="15000"){?>checked <?php }?>   class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Group ‘D’ ---- Rs 15000/-</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b><?php echo nbs(2);?>(v)<?php echo nbs(2);?><input title="Provide Fixed Pay" name="final_insurance_amt" type="radio" value="0" <?php if($final_insurance_amt=="0"){?>checked <?php }?>     class="form-control parsley-validated" placeholder="">
                    <?php echo nbs(2);?>Not Eligible</b>
                            <?php echo nbs(2);?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">The T.O/S.T.O to be authorized for payment : </label>
                        </td>
                        <td>
                            <input title="Name" name="TO" value="<?php echo $TO;?>" type="text" class="form-control parsley-validated" placeholder="Please Enter TO/STO name">
                            <?php echo form_error( 'TO', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
    </div>

    <button type="submit" name="submit_val" class="btn btn-primary">Update</button>

    <input type="reset" class="btn btn-warning" value="Cancel">
    <br/>
    <small style="font-size:12px; font-weight:bold;color:darkgrey">If you are not sure on this or want to learn more, contact software provider</small>
</form>

<script type="text/javascript">
 $(document).ready(function(){
    $("#pom_group_d_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
            $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_d_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_d_years').val(result.year+" years "+result.month+" months ");
        });
    }});
    

    $("#pom_group_c_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_c_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_c_years').val(result.year+" years "+result.month+" months ");
        });
    }});

    $("#pom_group_b_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_b_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_b_years').val(result.year+" years "+result.month+" months ");
        });
    }});

    $("#pom_group_a_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
        $.post("<?php echo site_url('administrator/Gis/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#pom_group_a_from').val(), jsonData: "true"}, function(data) {
            var result = JSON.parse(data);
            $('#pom_group_a_years').val(result.year+" years "+result.month+" months ");
        });
    }});
});
    $(document).ready(function() {
        $("#other_claiment").click(function() {
            $('#if_claiment').show('slow');
        });

        $("#self").click(function() {
            $('#if_claiment').hide('slow');
        });

        $("#incomplete").click(function() {
            $('#objection').show('slow');
        });

        $("#complete").click(function() {
            $('#objection').hide('slow');
        });

        window.prettyPrint() && prettyPrint();
        $('#example32').multiselect();
    });

    function FillAddress(f) {
        if (f.addresstoo.checked == true) {
            f.cor_address.value = f.per_address.value;
        }
    }

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
            $b = $a*2;
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
            $b = $a*4;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() == "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*7;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*6;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() == "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*4;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() !== "" && $("#amount3").val() == "") {
            $a = $('#amount4').val();
            $b = $a*6;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() == "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*4;
            $("#total4").val($b);
        } else if($("#amount1").val() == "" && $("#amount2").val() !== "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*4;
            $("#total4").val($b);
        } else if($("#amount1").val() !== "" && $("#amount2").val() !== "" && $("#amount3").val() !== "") {
            $a = $('#amount4').val();
            $b = $a*4;
            $("#total4").val($b);

        }
    }



    $(function() {
        // CKEditor Standard
        $('textarea.ckeditor_standard')
            .ckeditor({
                height: '150px',
                width: '500px',
                toolbar: [
                    {
                        name: 'document',
                        items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']
                    }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic']
                    }
                    ]
            });
    });
</script>