

<h3 id="service-book-heading">Service Book Entry <span>(Fields mark with (*) are mandatory fields.)</span></h3>
<?php 
$file_no = ($this->uri->segment('4') != '') ? base64_decode($this->uri->segment(4)) : ''; 
?>

<form action="<?php echo site_url('administrator/service_book/add'); ?>" method="post" name="service-book-form" id="service-book-form">
<div class="tab-pane active" id="personal_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Personal Details Panel » <small style="font-size:11px">Please enter personal information.</small></legend>
    <input type="hidden" name="action_type" id="action_type" value="add" />

    <div class="form-group">
        <label class="col-sm-3 control-label">File No <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="case_no" id="case_no" type="text" value="<?php echo $file_no; ?>" placeholder="Please Enter File No"><?php echo form_error('case_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Case Received on <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input type="text" name="cash_received" id="cash_received" value="<?php echo set_value('cash_received'); //echo $receipt_date?>" placeholder="Please Enter Case Received date" /><?php echo form_error('cash_received', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Class of Pension <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select required name="class_of_pension" id="class_of_pension">
                <option value="" selected="">Select</option>
                <option value="Superannuation_Pension">Superannuation Pension</option>
                <option value="Voluntary_Retirement_Pension">Voluntary Retirement</option>
                <option value="Invalid_Retirement_Pension">Invalid Retirement Pension</option>
                <option value="Absorption_in_autonomous_body_pension">Absorption in autonomus body pension</option>
                <option value="Disability_Pension">Disability Pension</option>
                <option value="Compulsory_Retirement_Pension">Compulsory retirement pension</option>
                <optgroup label="Family">
                    <option value="Normal_Family_Pension">Normal Family Pension</option>
                    <option value="Extraordinary_Pension">Extraordinary Pension</option>
                    <option value="Liberalised_Pension">Liberalised Pension</option>
                    <option value="Dependent_Pension">Dependent Pension</option>
                    <option value="Parents_Pension">Parents Pension</option>
                    <option value="NPS">NPS</option>
                    <option value="Death_Gratuity">Death Gratuity</option>
                </optgroup>
            </select><?php echo form_error('class_of_pension', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group" id="form-group-pension-category" style="display: none;">
        <label class="col-sm-3 control-label">Pension Category</label>
        <div class="col-sm-6">
            <select name="pension_category" id="pension_category">
                <option value="" selected="">Select</option>
                <option value="A">Category A (Death due to natural causes)</option>
                <option value="B">Category B (Death or disability accepted by govt as attributed to or by aggravated govt service)</option>
                <option value="C">Category C (Death or disability due to accident while performing duties)</option>
                <option value="D">Category D (Death or disability due to acts of violence by terrorists,anti social elements while performing duties or otherwise)</option>
                <option value="E">Category E (Death or disability due to aatack by enemies,enemy action,extremist acts etc)</option>
            </select>
        </div>
    </div>
    <div class="form-group" id="form-group-pension-for" style="display: none;height: 60px;">
        <label class="col-sm-3 control-label">Pension For</label>
        <div class="col-sm-6">
            <select name="pension_for" id="pension_for">
                <option value="" selected="">Select</option>
                <option value="widow">Widow</option>
                <option value="widow_remarriage">Widow remarriage</option>
                <option value="no_widow_but_survived_by_children">No widow but survived by children</option>
                <optgroup label="Employee dies a bachelor">
                    <option value="both_parents_are_alive">Both parents are alive</option>
                    <option value="only_one_of_them_is_alive">Only one of them is alive</option>
                </optgroup>
            </select>
        </div>
    </div>
    <div class="form-group" id="pension_scheme" style="display:none; height: 60px;">
        <label class="col-sm-3 control-label">Pension Scheme</label>
        <div class="col-sm-6">
            <input type="radio" name="pension_scheme" value="yes">Yes
            <input type="radio" name="pension_scheme" value="no"> No
        </div>
    </div>

    <div class="form-group" id="disability_catagory" style="display:none">
        <label class="col-sm-3 control-label">Disability Category</label>
        <div class="col-sm-6">
            <select name="disability_catagory"><option value="">Select</option><option value="A">A</option><option value="B">B</option><option value="C">C</option></select>
        </div>
    </div>
    <div class="form-group" id="disability_percent" style="display:none">
        <label class="col-sm-3 control-label">Disability Percentage</label>
        <div class="col-sm-6">
            <select name="disability_percent"><option value="">Select</option><option value="100">100</option><option value="90">90</option><option value="80">80</option></select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Name of The Govt. Servent <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input style="width: 15%; float: left; border-radius: 0px;" readonly autocomplete="off" name="salutation" id="salutation" type="text" value="<?php echo set_value('salutation'); ?>"/>
            <input style="width: 68%; float: left; border-radius: 0px;" readonly name="name" id="name" type="text" value="<?php echo set_value('name');//echo $pensionee_name// ?>" placeholder="Please Enter Name of The Govt. Servent"><?php echo form_error('name', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Date of Birth <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dob" id="dob" type="text" value="<?php echo set_value('dob'); ?>" placeholder="Please Enter Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Religion <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="religion" id="religion" class="multiselect">
                <option value="0">Select</option>
                <option value="Hindu">Hindu</option>
                <option value="Muslim">Muslim</option>
                <option value="Sikh">Sikh</option>
                <option value="Christian">Christian</option>
                <option value="Buddhism">Buddhism</option>
                <option value="Others">Others</option>
            </select><?php echo form_error('religion', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nationality <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="nationality" id="nationality" class="multiselect">
                <option value="0">Select</option>
                <option value="Indian">Indian</option>
                <option value="Others">Others</option>
            </select><?php echo form_error('nationality', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Category <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="category" id="category" class="multiselect">
                <option value="0">Select</option>
                <option value="ap">APST</option>
                <option value="nonap">NON APST</option>
            </select><?php echo form_error('category', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Gender <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input type="text" id="sex" name="sex" readonly="readonly"/><?php echo form_error('sex', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Designation <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input readonly autocomplete="off" name="designation" value="<?php echo set_value('designation');  //$designation; ?>" id="designation" type="text" value="">
            <input type="hidden" name="retire_age" id="retire_age" />
        </div>
    </div>
    <?php
        $sql = "select b.branch_code from pension_receipt_file_master as a INNER JOIN pension_receipt_register_master as b ON a.dept_forw_no=b.dept_forw_no WHERE a.file_No='".$file_no."'";
        $result = $this->db->query($sql);
        $row = $result->result_array();
        $sd = (count($row) > 0) ? $row[0]['branch_code'] : '';
    ?>
    <div class="form-group">
        <label class="col-sm-3 control-label">Department <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="department" id="department" class="multiselect">
                <option value="0">Select</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                    <?php if($sd == $dept['dept_code']) : ?>
                        <option value="<?php echo $dept['dept_code']; ?>" selected><?php echo $dept['dept_name']; ?></option>
                    <?php else : ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                    <?php endif; ?>
                <?php } ?>
            </select><?php echo form_error('department', '<div class="error">', '</div>');?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Form Submitted</label>
        <div class="col-sm-6">
            <textarea disabled="disabled" name="submitted_form" id="submitted_form" rows="4" columns="40"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Document Submitted</label>
        <div class="col-sm-6">
            <textarea disabled="disabled" name="submitted_document" id="submitted_document" rows="4" columns="40"></textarea>
        </div>
    </div>
    <div class="form-group input_fields_wrap">
        <nobr><label class="col-sm-3 control-label">Address after Retirement <span class="required-field">*</span><button class="add_field_button btn btn-success" id="address_btn">Add</button></label></nobr>
        <div class="col-sm-6">
            <textarea name="address_after_retirement" id="single_address" placeholder="Please enter Address after Retirement" rows="4" columns="40"><?php echo set_value('address_after_retirement'); ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
        </div>
        <div class="col-sm-6">
            <textarea name="address_after_retirement[]" id="multiple_address" placeholder="Please enter Address after Retirement." rows="4" columns="40"><?php echo set_value('address_after_retirement'); ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label">PIN Code </label>
        <div class="col-sm-6">
            <input name="pin" id="pin" type="text" value="0"><!-- value="<?php echo set_value('pin'); ?>" -->
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Cell Phone No. Incl(+91) </label>
        <div class="col-sm-6">
            <input name="phone_no" id="phone_no" type="text" value="0"><!-- value="<?php echo set_value('phone_no'); ?>" -->
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Blood Group </label>
        <div class="col-sm-6">
            <input name="blood_group" id="blood_group" type="text" value="<?php echo set_value('blood_group'); ?>">
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="tab-pane" id="service_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Service Details Panel » <small style="font-size:11px"> Use the below panel to enter service details.</small></legend>
    <div class="form-group">
        <label class="col-sm-3 control-label">Appointment as <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select class="appointas" name="appointas">
                <option value="0">Select</option>
                <option value="Adhoc">Adhoc</option>
                <option value="Officiating">Officiating</option>
                <option value="WC">WC</option>
                <option value="Temporary">Temporary</option>
                <option value="Permanent">Permanent</option>
            </select>
        </div>
    </div>

    <div class="form-group form-group-dojac" style="display: none;">
        <label class="col-sm-3 control-label">Date of Appointment as Casual</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dojac" id="dojac" type="text" value="<?php echo set_value('dojac');?>" placeholder="Appointment as casual">
            <input type="hidden" name="diff_appoint_as_casual" id="diff_appoint_as_casual" />
            <input type="hidden" name="total_service_from_casual_date" id="total_service_from_casual_date"/>
        </div>
    </div>
    <div class="form-group form-group-dojap" style="display: none;">
        <label class="col-sm-3 control-label">Date of Appointment as Permanent</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dojap" id="dojap" type="text" value="<?php echo set_value('dojap'); ?>" placeholder="Appointment as permanent">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Age at Entry</label>
        <div class="col-sm-6">
            <input readonly type="text" name="aeyear" id="aeyear" class="width50" value="<?php echo set_value('aeyear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="aemonth" id="aemonth" class="width50" value="<?php echo set_value('aemonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="aeday" id="aeday" class="width50" value="<?php echo set_value('aeday'); ?>" placeholder="day"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label label-dor">Date of retirement <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input required autocomplete="off" name="dor" id="dor" type="text" value="<?php echo set_value('dor'); ?>" placeholder="Please Enter Date of retirement"><?php echo form_error('dor', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label label-dod">Date of death</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dod" id="dod" type="text" value="<?php echo set_value('dod'); ?>" placeholder="Please Enter Date of Death">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label label-aor">Age at retirement</label>
        <div class="col-sm-6">
            <input readonly type="text" name="aryear" id="aryear" class="width50" value="<?php echo set_value('aryear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="armonth" id="armonth" class="width50" value="<?php echo set_value('armonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="arday" id="arday" class="width50" value="<?php echo set_value('arday'); ?>" placeholder="day"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Total Service <span style="font-size: 12px; color: red;">(Click in textbox)</span></label>
        <div class="col-sm-6">
            <input readonly name="total_service" id="total_service" type="text" value="<?php echo set_value('total_service'); ?>" placeholder="Total Service">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Non Qualifying Service <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input required autocomplete="off" type="number" name="nonqsyear" id="nonqsyear" class="width50" value="<?php echo set_value('nonqsyear'); ?>" placeholder="year" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="nonqsmonth" id="nonqsmonth" class="width50" value="<?php echo set_value('nonqsmonth'); ?>" placeholder="month" min="0"/>&nbsp;<input required type="number" autocomplete="off" name="nonqsday" id="nonqsday" class="width50" value="<?php echo set_value('nonqsday'); ?>" placeholder="day" min="0"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Weightage <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input required autocomplete="off" type="number" name="weightage_year" id="weightage_year" class="width50" value="<?php echo set_value('weightage_year'); ?>" placeholder="year" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="weightage_month" id="weightage_month" class="width50" value="<?php echo set_value('weightage_month'); ?>" placeholder="month" min="0"/>&nbsp;<input required type="number" autocomplete="off" name="weightage_day" id="weightage_day" class="width50" value="<?php echo set_value('weightage_day'); ?>" placeholder="day" min="0"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Net Qualifying Service</label>
        <div class="col-sm-6">
            <input readonly type="text" name="netqsyear" id="netqsyear" class="width50" value="<?php echo set_value('netqsyear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="netqsmonth" id="netqsmonth" class="width50" value="<?php echo set_value('netqsmonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="netqsday" id="netqsday" class="width50" value="<?php echo set_value('netqsday'); ?>" placeholder="day"/>
        </div>
    </div>

    <div class="form-group" style="min-height:60px;">
        <label class="col-sm-3 control-label">Service Verification</label>
        <div class="col-sm-6">
            <input type="radio" name="service_verification" id="service_verification" value="1" checked="">Yes
            <input type="radio" name="service_verification" id="service_verification" value="0">No
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-sm-3 control-label">Regularization of Ad-Hoc Service</label>
        <div class="col-sm-6">
            <input name="probation_period" id="probation_period" type="text" placeholder="Please Enter Probation period">
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-sm-3 control-label">SMP</label>
        <div class="col-sm-6">
            <input readonly name="smp" id="smp" type="text" value="<?php echo set_value('smp'); ?>" placeholder="SMP"><?php echo form_error('smp', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Office Address <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <textarea name="office_address" id="office_address" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo set_value('office_address'); ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    
    <div class="form-group" id="compulsory_rate" style="display:none">
        <label class="col-sm-3 control-label">2/3</label>
        <div class="col-sm-6">
            <input type="radio" name="com_pension_rate" value="pension">Pension
            <input type="radio" name="com_pension_rate" value="gratuity">Gratuity
            <input type="radio" name="com_pension_rate" value="both">Both
        </div>
    </div>
</div>
<div class="clear"></div>

<div class="tab-pane" id="family_details">
    <div class="row-fluid sortable">
        <div class="span12">
            <legend style="font-size:15px; color:#3b5999; font-weight:700">Family Information Panel » <small style="font-size:11px"> Use the below panel to enter basic information about family.</small></legend>

        <!-- <div class="form-group" style="min-height:60px;min-width: 220px;">
        <label class="col-sm-3 control-label">No. of wives is 2 or more than 2</label>
        <div class="col-sm-6">
             <input type="radio" name="more_wives" id="more_wives" value="1">Yes
            <input type="radio" name="more_wives" id="more_wives" value="0" checked="checked">No
        </div>

        <label class="col-sm-3 control-label">Enter No. of wives</label>
        <div class="col-sm-6">
              <input autocomplete="off" name="no_of_wives" id="no_of_wives" type="text" value="0" placeholder="">
        </div>

        </div> -->

            <p style="font-size:12px; color:red">Fields labelled in red are mandatory</p>
            <table class="table" id="myTable" style="margin-top: 10px;">
                <tbody>
                    <tr id="parent-1" class="parent">
                        <td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td>
                        <td>
                            <select required class="spouse_salutation form-control" name="spouse_salutation[]">
                                <option value="">--Please Select--</option>
                                <option value="mr">Mr</option>
                                <option value="mrs">Mrs</option>
                                <option value="miss">Miss</option>
                            </select><label style="font-size:12px; color:red">Salutation <span class="required-field">*</span></label>
                        </td>
                        <td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name <span class="required-field">*</span></label></td>
                        <td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth <span class="required-field">*</span></label></td>
                        <td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td>
                        <td>
                            <select required class="family_relation form-control" name="relation[]">
                                <option value="">--Please Select--</option>
                                <!-- <option value="wife">Wife</option>
                                <option value="husband">Husband</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option> -->
                            </select><label style="font-size:12px; color:red">Relation <span class="required-field">*</span></label>
                        </td>
                        <td><input required class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text" /><label style="font-size:12px; color:red">Percentage <span class="required-field">*</span></label></td>
                        <td><input type="hidden" name="name_of_legal_heir" id="name_of_legal_heir" /></td>
                        <td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-1"></td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-success scrollToTop" onClick="addRow('myTable')" data-target="family_details">Add More</a>
            <a class="btn btn-danger scrollToTop" onClick="deleteRow('myTable')" data-target="family_details">Delete</a>
            <a class="btn btn-success" id="two_more_wives">Two or More Wife</a>
            <a class="btn btn-danger" id="two_more_wives_hide">Remove Two or More Wife</a>
        </div>
    </div>
</div>





<div class="tab-pane" id="pay_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Pay Details Information Panel » <small style="font-size:11px"> Use the below panel to enter payment information.</small></legend>
    <div class="form-group">
        <label class="col-sm-3 control-label">Pay Commission <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select id="pay-commission" name="pay_commission">
                <option value="0" selected="selected">--Select--</option>
                <?php foreach ($records as $rec):?>
                    <option value="<?php echo $rec['id']?>"><?php echo $rec['name'];?></option>
                <?php endforeach ?>
            </select> 
        </div>
        <div class="col-sm-6">
            <img id="load_gif" style="display:none" src="<?php echo base_url() ?>/includes/img/ajax-loader.gif">
        </div>           
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Pay Scale <span class="required-field">*</span></label>
            <select name="pay_scale" id="pay_scale">
                <option value="0">--SELECT--</option>
            </select>
            <!-- <input required type="text" name="pay_scale" id="pay_scale" /> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Provisional Pension</label>
            <input required type="text" name="provisional_pension" id="provisional_pension" value="0" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Provisional Gratuity</label>
            <input required type="text" name="provisional_gratuity" id="provisional_gratuity" value="0" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Excess Pay and Allowances</label>
            <input required type="text" name="excess_pay_and_allowances" id="excess_pay_and_allowances" value="0" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Others if Any</label>
            <input required type="text" name="others_if_any" id="others_if_any" value="0" />
        </div>
    </div>
    <div class="form-group" style="min-height:60px;min-width: 220px;">
        <label class="col-sm-3 control-label">Commutation Applied</label>
        <div class="col-sm-6">
            <input type="radio" name="com_applied" id="com_applied" value="1" checked="">Yes
            <input type="radio" name="com_applied" id="com_applied" value="0">No &nbspp;

            <input type="number" maxlength="2" name="com_per" value="0" placeholder="Percentage of Commutation(if any)">
        </div>
    </div><!-- 
    <div class="form-group" style="width: 220px; height: 60px;">
    </div>
    <div class="form-group" style="width: 220px; height: 60px;">
        
    </div> -->
    <div class="form-group" style="min-height:60px;">
        <label class="col-sm-3 control-label">Uncheck this if not applicable.</label>
        <div class="col-sm-6">
            <input type="checkbox" name="dr" id="dr" value="yes" checked /> DR
            <input type="checkbox" name="ma" id="ma" value="yes" checked /> MA
        </div>
    </div>

    <div class="form-group" style="min-height:60px;min-width: 220px;">
        <label class="col-sm-3 control-label">Consolidated Pay</label>
        <div class="col-sm-6">
             <input type="radio" name="consolidated" id="consolidated" value="1">Yes
            <input type="radio" name="consolidated" id="consolidated" value="0" checked="checked">No
        </div>

        <label class="col-sm-3 control-label">Date of Birth of son or daughter</label>
        <div class="col-sm-6">
              <input autocomplete="off" name="childDOB" id="childDOB" type="text" value="0000-00-00" placeholder="">
        </div>

         <label class="col-sm-3 control-label">Date of marriage/ Date of employment of son or daughter</label>
        <div class="col-sm-6">
              <input autocomplete="off" name="child_Date_of_marriage_employment" id="child_Date_of_marriage_employment" type="text" value="0000-00-00" placeholder="">
        </div>
    </div>

    <div id="form_dis"></div>
</div>

<div class="clear"></div>
<!--seven pay-->


<div class="pay_details" id="7th1" style="margin-top: 20px;">
    <legend style="font-size:15px; color:#3b5999; font-weight:100%">Pension Calculation 7th Pay</legend>
    
    
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Total</label>
    <input autocomplete="off" placeholder="Total Amont"  type="text" id="total_pres" name="total_pres" value="0">
        </div>
    </div>
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Case/File No</label>
    <input autocomplete="off" placeholder="case no"  type="text" id="case_file_no" name="case_file_no" value="<?php echo $file_no; ?>">
        </div>
    </div>
   
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">PPO No</label>
    <input autocomplete="off" placeholder="ppo no"  type="text" id="ppo_file_no" name="ppo_file_no" value="<?php echo $ppo; ?>">
        </div>
    </div>
    
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">GPO No</label>
    <input autocomplete="off" placeholder="gpo no"  type="text" id="gpo_file_no" name="gpo_file_no" value="<?php echo $gpo; ?>">
        </div>
    </div>
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">CPO No</label>
    <input autocomplete="off" placeholder="cpo no"  type="text" id="cpo_file_no" name="cpo_file_no" value="<?php echo $cpo; ?>">
        </div>
    </div>
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Before Increment Value(Family Pension)</label>
    <input autocomplete="off" placeholder="before increament amount"  type="text" id="bf_increamnet" name="bf_increamnet" value="0">
        </div>
    </div>
    
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Pay Level *</label>
<select name="seven_pol" id="seven_pol">
    <option value="0">--SELECT--</option>
    <option value="1">Level-1</option>
    <option value="2">Level-2</option>
    <option value="3">Level-3</option>
    <option value="4">Level-4</option>
    <option value="5">Level-5</option>
    <option value="6">Level-6</option>
    <option value="7">Level-7</option>
    <option value="8">Level-8</option>
    <option value="9">Level-9</option>
    <option value="10">Level-10</option>
    <option value="11">Level-11</option>
    <option value="12">Level-12</option>
    <option value="13">Level-13</option>
    <option value="13a">Level-13a</option>
    <option value="13augc">Level-13augc</option>
    <option value="14">Level-14</option>
    <option value="15">Level-15</option>
    <option value="16">Level-16</option>
    <option value="17">Level-17</option>
    <option value="18">Level-18</option>

</select>        </div>
    </div>   



    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">&nbsp;</label>
<select name="sc_seven" id="sc_seven">
    <option value="0">--SELECT--</option>
    
</select>      </div>
    </div>
    .
    
    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Non Practising Allowance</label>
    <input autocomplete="off" placeholder="Non Practising Allowance"  type="text" id="npa" name="npa" value="0" onblur="calculateRevised()" class="npa">
     </div>
    </div>

    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Pre DA*</label>
<select name="pre_DA" id="pre_da">
    <option value="">--SELECT--</option>
<!--     <option value="0">0</option>
    <option value="2">2</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="7">7</option>
    <option value="9">9</option>
    <option value="12">12</option>
    <option value="17">17</option> -->
    <?php foreach (getall_DA() as $da) { ?>
        <option value="<?php echo $da['da'];?>"><?php echo $da['da']; ?></option>
    <?php } ?>
</select>
    
        </div>
    </div>  


    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Post DA *</label>
<select name="post_DA" id="post_da">
    <option value="">--SELECT--</option>
    <!-- <option value="0">0</option>
    <option value="2">2</option>
    <option value="4">4</option>
    <option value="5">5</option>
	<option value="7">7</option>
	<option value="9">9</option>
    <option value="12">12</option>
    <option value="17">17</option> -->
    <?php foreach (getall_DA() as $da) { ?>
        <option value="<?php echo $da['da'];?>"><?php echo $da['da']; ?></option>
    <?php } ?>
</select>

        </div>
    </div>  

    <div class="form-group">
        <label class="col-sm-3 control-label">Select Month before Last Increment Date * <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="last_increament_date" id="last_increament_date" type="text"  placeholder="Please Enter Last Increament Date">
        </div>
    </div>

    
    <div class="clear"></div>
</div>






<!-- seven pay-->
<div class="clear"></div>

<div class="clear"></div>
<div class="tab-pane" id="leave_encashment">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Leave Encashment </legend>
    <div class="form-group">
        <label class="col-sm-3 control-label">Earn Leave(in days) <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input name="earn_leave" id="earn_leave" type="text" value=""><?php echo form_error('earn_leave', '<div class="error">', '</div>');?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Half Pay Leave(in days) <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input name="half_pay" id="half_pay" type="text" value=""><?php echo form_error('half_pay', '<div class="error">', '</div>'); ?>
        </div>
    </div>
  </div>


<!-- Increment Details -->

<br/><br/>
<div style="font-size:15px; color:#3b5999; font-weight:700">Average Emolument »</div>
<table class="table" id="iTable" style="margin-top: 10px;">
                <tbody>
                 <tr id="parent-1" class="parent">
                        <td>
                          <label style="font-size:12px; color:red">From <span class="required-field">*</span></label>                      </td>
                        <td>
                        <label style="font-size:12px; color:red">To<span class="required-field">*</span></label></td>
                        <td>
                        <label style="font-size:12px; color:red">Rate of Pay  <span class="required-field">*</span></label></td>
                        <td>
                        <label style="font-size:12px; color:red">Amount</label></td>
                    </tr>
                    
                    <tr id="parent-1" class="parent">
                        <td><input class="dod form-control" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate[]">
                          <label style="font-size:12px; color:red"></label>                      </td>
                        <td><input class="dod form-control" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate[]">
                        <label style="font-size:12px; color:red"></label></td>
                        <td><input  class=" form-control" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]">
                        <label style="font-size:12px; color:red"></label></td>
                        <td><input  class=" form-control" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]">
                        <label style="font-size:12px; color:red"></label></td>
                    </tr>
                    <tr class="parent">
                      <td><input class="dod form-control" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate2[]"></td>
                      <td><input class="dod form-control" name="toidate2[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate2[]"></td>
                      <td><input  class=" form-control" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                      <td><input  class=" form-control" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                    </tr>
                    <tr class="parent">
                      <td><input class="dod form-control" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate3[]"></td>
                      <td><input class="dod form-control" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate3[]"></td>
                      <td><input  class=" form-control" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                      <td><input  class=" form-control" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                    </tr>
                    <tr class="parent">
                      <td><input class="dod form-control" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate4[]"></td>
                      <td><input class="dod form-control" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate4[]"></td>
                      <td><input  class=" form-control" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                      <td><input  class=" form-control" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                    </tr>
                    <tr class="parent">
                      <td><input class="dod form-control" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate5[]"></td>
                      <td><input class="dod form-control" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate5[]"></td>
                      <td><input  class=" form-control" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                      <td><input  class=" form-control" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                    </tr>
                </tbody>
            </table>


  
<!-- Treausry Details -->
<div class="tab-pane" id="treausry_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Treasury/AG Office/Bank Details Information Panel » <small style="font-size:11px"> Use the below panel to enter relevant details.</small></legend>
    <div class="form-group full-form-group">
        <label class="col-sm-3 control-label">Name of Accountant General</label>
        <div class="col-sm-12">
            <select name="name_of_accountant_general" id="name_of_accountant_general">
                <option value="">Select</option>
                <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                    <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name'];?></option>
                <?php } ?>
            </select>

            <select name="name_of_accountant_general[]" multiple="true" id="ag_multiple">
                <option value="">Select</option>
                <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                    <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name'];?></option>
                <?php } ?>
            </select>

            &nbsp;<a href="#addAccountantGeneral" id="addAccountantGeneralModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('name_of_accountant_general', '<div class="error">', '</div>');?>
        </div>
    </div>

    <div class="form-group full-form-group input_fields_wrap_subto">
        <nobr><label class="col-sm-3 control-label">TO/ Sub TO(Outside) <button class="add_field_button_subto btn btn-success" id="sub_to_btn">Add</button></label></nobr>
        <div class="col-sm-6">
            <input name="sub_to" id="sub_to_single" type="text" value="<?php echo set_value('sub_to'); ?>"><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>

            <input name="sub_to[]" id="sub_to_multiple" type="text" value="<?php echo set_value('sub_to'); ?>"><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Treasury/ Sub Treasury Officer(Inside)</label>
        <div class="col-sm-6">
            <select name="treasury_officer" id="treasury_officer">
                <option value="">Select</option>
                <?php foreach (getAllTreasury() as $treasury) { ?>
                    <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                <?php } ?>
            </select>

            <select name="treasury_officer[]" multiple="true" id="treasury_multiple">
                <option value="">Select</option>
                <?php foreach (getAllTreasury() as $treasury) { ?>
                    <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                <?php } ?>
            </select>

            &nbsp;<a href="#addTreasuryOfficer" id="addTreasuryOfficerModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('treasury_officer', '<div class="error">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Date of Effect of Pension <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input readonly name="effect_of_pension" id="effect_of_pension" type="text" value="<?php echo set_value('effect_of_pension'); ?>"><?php echo form_error('effect_of_pension', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Name Bank</label>
        <div class="col-sm-6">
            <textarea name="bank_name" id="bank_name" placeholder="Bank Details" style="height: 60px;"><?php echo set_value('bank_name'); ?></textarea>
            <!--<input name="bank_name" id="bank_name" type="text" value="<?php //echo set_value('bank_name'); ?>"><?php //echo form_error('bank_name', '<div class="error">', '</div>'); ?>-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Bank Account No.</label>
        <div class="col-sm-6">
            <input name="account_no" id="account_no" type="text" value="<?php echo set_value('account_no'); ?>"><?php echo form_error('account_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Bank Code No.</label>
        <div class="col-sm-6">
            <input name="code_no" id="code_no" type="text" value="<?php echo set_value('code_no'); ?>"><?php echo form_error('code_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>



<div class="clear"></div>
<input type="submit" name="submit" value="Save" id="saveServiceBook" class="btn btn-primary" />
<a class="scrollToTop" href="#" data-target="content">Move To Top</a>
</form>

<div id="addAccountantGeneral" class="modal hide fade">
    <div class="modal-header"><h3>Add Accountant General</h3></div>
    <div class="modal-body">
        <label style="float: left;"><b>Name</b></label>&nbsp;&nbsp;&nbsp;
        <textarea name="modalAccountantName" id="modalAccountantName"></textarea>
        <div id="modalAccountantMessage" class="modalMessage"></div>
    </div>
    <div class="modal-footer"><small class="btn btn-danger" data-dismiss="modal">Close</small>&nbsp;<small class="btn btn-primary saveAccountantName">Save</small></div>
</div>

<div id="addTreasuryOfficer" class="modal hide fade">
    <div class="modal-header"><h3>Add Treasury</h3></div>
    <div class="modal-body">
        <label style="float: left;"><b>Title</b></label>&nbsp;
       <textarea name="modalTreasuryTitle" id="modalTreasuryTitle"></textarea>
        <div id="modalTreasuryMessage" class="modalMessage"></div>
    </div>
    <div class="modal-footer"><small class="btn btn-danger" data-dismiss="modal">Close</small>&nbsp;<small class="btn btn-primary saveTreasuryTitle">Save</small></div>
</div>

<style type="text/css">
#service-book-heading {margin-bottom: 20px;}
#service-book-heading span{font-size: 12px; color: red; font-weight: 100;}
.clear {clear: both;}
.required-field {color: red; font-weight: bold;}
legend {margin-bottom: 10px;}
#personal_details {width: 48%; float: left;}
#personal_details .form-group {width: 45%; float: left; margin-left: 10px;}
#service_details {width: 50%; float: left;}
#service_details .form-group {width: 45%; float: left; margin-left: 10px;}
#family_details {width: 98%;}
#family_details table{width: 90%;}
#family_details table .form-control{width: 132px;}
#pay_details {margin-top: 20px;}
#pay_details .form-group{float: left; margin: 0px 20px;}


.pay_details {margin-top: 20px;}
.pay_details .form-group{float: left; margin: 0px 20px;}

#treausry_details {margin-top: 20px;}
#treausry_details .form-group{float: left; width: 46%; margin: 0px 20px;}
#treausry_details .form-group .col-sm-3 {float: left; width: 240px;}
#treausry_details .form-group .col-sm-6 {float: left;}
#treausry_details .full-form-group {width: 96%!important;}
.full-form-group select {width: 73%;}
.width50 {width: 50px;}

#form_dis .form-group {width: 46%;}
#form_dis .form-group .col-sm-3 {width: 40%; float: left;}
#form_dis .form-group .col-sm-6 {float: left;}

.ui-datepicker .ui-datepicker-prev span:after,
.ui-datepicker .ui-datepicker-next span:after {content: "";}
.ui-datepicker .ui-datepicker-next span:after {content: "";}
#errors {background: red; padding: 10px;}
#errors .error {display: block; color: #fff; margin-left: 230px;}
.error {/*margin-left: 230px;*/}
.error {width: 220px;}
#modalAccountantName {float: left;}
#modalAccountantMessage {margin: 13px 0 0 0;}
#modalTreasuryTitle {float: left;}
#modalTreasuryMessage {margin: 13px 0 0 0;}
.form-group-inside {margin-bottom: 5px;}
.legal_heir {float: left;}
</style>
<?php if(validation_errors() != false) { echo '<style type="text/css">.form-group{min-height: 78px;margin-bottom: 0px;}</style>'; } ?>

<script type="text/javascript">

    $(document).ready(function() {
        getFileDetails("<?php echo site_url('administrator/service_book/getFileDetails'); ?>");
        addAccountantGeneral("<?php echo site_url('administrator/service_book/saveAccountantName'); ?>");
        addTreasuryOfficer("<?php echo site_url('administrator/service_book/saveTreasuryTitle'); ?>");

        $('#case_no').blur(function() {
            getFileDetails("<?php echo site_url('administrator/service_book/getFileDetails'); ?>");
        });

        changeDOB();
        changeDOR();
        changeDOD();
    });


    //seven pay
    $("#seven_pol").change(function(){
            //alert("g");
            var x=$("#seven_pol").val();
            //$("#sex").val(x);
            $.ajax({
                url:'<?php echo site_url("administrator/service_book/getSevenpay/"); ?>',
                data:'country_id='+x,
                dataType:'html',
                method:'POST',
                success:function(html){
                    $("#sc_seven").html(html);
                    
                }
            });

          });

        $("#sc_seven").change(function(){
                //alert("g");
                $("#total_pres").val($(this).val());
              });  

       $("#npa").change(function(){
            //alert("g");
            npa = $('#npa').val() || 0;
            tot =  $("#total_pres").val() || 0;
            //final_tot = 0;
            //final_tot = (parseInt(tot)*parseInt(npa)/100)+parseInt(tot);
            //final_tot = parseInt(npa)+parseInt(tot);
            $("#total_pres").val(Math.round(final_tot));
            delete npa;
            delete tot;
            delete final_tot;
          });   
    //====================== OR =========================
    // var calculateRevised = function()
    // {
    //     //alert("g");
    //     npa  = $('#npa').val() || 0;
    //     tot =  $("#total_pres").val() || 0;
    //     final_tot = 0;
    //     final_tot = (parseInt(tot)*parseInt(npa)/100)+parseInt(tot);
    //     $("#total_pres").val(Math.round(final_tot));
    //     delete npa;
    //     delete tot;
    //     delete final_tot;
       
    // }

    //seven pay
    
    $(function() {
        $("#cash_received,#dod").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
	  
        $('#total_service').click(function(){
            var doj = '';
            $dor = $('#dor').val();
            if($('.form-group-dojac').hasClass('show')){
                doj = '#dojac';
            } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
                doj = '#dojap';
            } else {}

            var a = moment($(doj).val(), 'YYYY-MM-DD');
            var b = moment($dor, 'YYYY-MM-DD').add({days: 1});
            $('#total_service').val(moment(a).preciseDiff(b));

            if(appointasChange() == 'dojac') {
                $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>",{date1:$('#dor').val(), date2: $('#dojap').val(), jsonData: "true"}, function(data) {
                    var result =JSON.parse(data);
                    var splitDiff =$('#diff_appoint_as_casual').val().split('-');
                    var years = parseInt(result.year)+parseInt(splitDiff[0]);
                    var months = parseInt(result.month)+parseInt(splitDiff[1]);
                    var days = parseInt(result.day)+parseInt(splitDiff[2]);
        			
                    if(days >= 30){
                        months+=1;
                        days=days%30;
                    }
                    if(months >= 12){
                        years+=1;
                        months=months%12;
                    }
                    $('#total_service_from_casual_date').val(years+" years "+months+" months "+days+" days");
                });
            }
        });
		 
		$('#nonqsyear, #nonqsmonth, #nonqsday').blur(function(){
            if($('.form-group-dojac').hasClass('show')) {
                var total_service = $('#total_service_from_casual_date').val()
            } else {
                var total_service = $('#total_service').val();
            }

            nonqsyear   = $('#nonqsyear').val() || 0;
            nonqsmonth  = $('#nonqsmonth').val() || 0;
            nonqsday    = $('#nonqsday').val() || 0;

            total_service1 = total_service.split(" ");
            total_service2 = moment().add(total_service1[0], 'years').add(total_service1[2], 'months').add(total_service1[4], 'days');
            nonqs = moment().add(nonqsyear, "years").add(nonqsmonth, "months").add(nonqsday, "days");
            //console.log(dateDiff(nonqs, total_service2, 'false', 'true'));
            var result = dateDiff(nonqs, total_service2, 'false', 'true');
           $('#netqsyear').val(result.year);
           $('#netqsmonth').val(result.month);
           $('#netqsday').val(result.day);
            
            calculateSMP(result);

            delete total_service1;
            delete total_service2;
            delete nonqs;
            delete nonqsyear;
            delete nonqsmonth;
            delete nonqsday;
        });

        $('#weightage_year, #weightage_month, #weightage_day').blur(function(){
            if($('.form-group-dojac').hasClass('show')) {
                var total_service = $('#total_service_from_casual_date').val()
            } else {
                var total_service = $('#total_service').val();
            }

            weightage_year   = $('#weightage_year').val() || 0;
            weightage_month  = $('#weightage_month').val() || 0;
            weightage_day    = $('#weightage_day').val() || 0;

            total_service1 = total_service.split(" ");

            year=parseInt(total_service1[0])+parseInt(weightage_year);
            month=parseInt(total_service1[2])+parseInt(weightage_month);
            day=parseInt(total_service1[4])+parseInt(weightage_day);
            
            $('#netqsyear').val(year);
            $('#netqsmonth').val(month);
            $('#netqsday').val(day);
            
            calculateSMP(result);

            delete total_service1;
            delete weightage;
            delete weightage_year;
            delete weightage_month;
            delete weightage_day;
        });
    });
        
    $('body').on('focus',".dob", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',".dod", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

    $('body').on('focus',"#childDOB", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    
    $('body').on('focus',"#child_Date_of_marriage_employment", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

    $(document).ready(function(){

             $("#multiple_address").hide();
             $("#address_btn").hide();
             $("#multiple_address").prop("disabled", true);


             $("#ag_multiple").hide();
             $("#ag_multiple").prop("disabled", true);


             $("#treasury_multiple").hide();
             $("#treasury_multiple").prop("disabled", true);


             $("#sub_to_multiple").hide();
             $("#sub_to_btn").hide();
             $("#sub_to_multiple").prop("disabled", true);
             

            var two_more_wives = $('#two_more_wives');
            $(two_more_wives).click(function(e){
            var class_of_pension=$("#class_of_pension").val();    
                if(class_of_pension=="Normal_Family_Pension"){

                    $("#single_address").hide();
                    $("#single_address").prop("disabled", true);
                    $("#address_btn").show();
                    $("#multiple_address").prop("disabled", false);
                    $("#multiple_address").show();


                    $("#name_of_accountant_general").hide();
                    $("#name_of_accountant_general").prop("disabled", true);
                    $("#ag_multiple").show();
                    $("#ag_multiple").prop("disabled", false);


                    $("#sub_to_single").hide();
                    $("#sub_to_single").prop("disabled", true);
                    $("#sub_to_btn").show();
                    $("#sub_to_multiple").show();
                    $("#sub_to_multiple").prop("disabled", false);


                    $("#treasury_officer").hide();
                    $("#treasury_officer").prop("disabled", true);
                    $("#treasury_multiple").show();
                    $("#treasury_multiple").prop("disabled", false);

                }
                
            });


            var two_more_wives_hide = $('#two_more_wives_hide');
            $(two_more_wives_hide).click(function(e){


                    $("#single_address").show();
                    $("#single_address").prop("disabled", false);
                    $("#address_btn").hide();
                    $("#multiple_address").prop("disabled", true);
                    $("#multiple_address").hide();


                    $("#name_of_accountant_general").show();
                    $("#name_of_accountant_general").prop("disabled", false);
                    $("#ag_multiple").hide();
                    $("#ag_multiple").prop("disabled", true);


                    $("#sub_to_single").show();
                    $("#sub_to_single").prop("disabled", false);
                    $("#sub_to_btn").hide();
                    $("#sub_to_multiple").hide();
                    $("#sub_to_multiple").prop("disabled", true);


                    $("#treasury_officer").show();
                    $("#treasury_officer").prop("disabled", false);
                    $("#treasury_multiple").hide();
                    $("#treasury_multiple").prop("disabled", true);



            });

        $("#7th").hide();
        $("#pay-commission").change(function(){

            var x=$("#pay-commission").val();
               if(x==7){

                        $("#7th").show();
               } 
               else
               {
                    $("#7th").hide();
               }

            $.ajax({
                url:'<?php echo site_url("administrator/service_book/pre_revised?id="); ?>'+x,
                dataType:'html',
                method:'GET',
                success:function(data){
                    $("#form_dis").html(data);
                }
            });
        });
        
        $("#pay-commission").change(function(){
            onPayCommissionChange('<?php echo site_url("RestService/getPreRevisedPayScaleSelect/"); ?>');
        });



    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><textarea placeholder="Please enter Address after Retirement." rows="4" columns="40" name="address_after_retirement[]"/><a href="#" style="margin-bottom:10px;" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            var max_fields_subto      = 3; //maximum input boxes allowed
            var wrapper_sub         = $(".input_fields_wrap_subto"); //Fields wrapper
            var add_button_sub      = $(".add_field_button_subto"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button_sub).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields_subto){ //max input box allowed
                    x++; //text box increment
                    $(wrapper_sub).append('<div><input type="text" rows="4" columns="40" name="sub_to[]"/><a href="#" style="margin-bottom:10px;" class="remove_field_subto btn btn-danger"> Remove</a></div>'); //add input box
                }
            });

            $(wrapper_sub).on("click",".remove_field_subto", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

        });
    </script>
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>