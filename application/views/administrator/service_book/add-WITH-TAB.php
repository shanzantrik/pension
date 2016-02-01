<h3 style="margin-bottom: 20px;">Service Book Entry</h3>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#personal_details" data-toggle="tab"><b>Personal Details</b></a></li>
    <li><a href="#family_details" data-toggle="tab"><b>Family Details</b></a></li>
    <li><a href="#service_details" data-toggle="tab"><b>Service Details</b></a></li>
    <li><a href="#pay_details" data-toggle="tab"><b>Pay Details</b></a></li>
    <li><a href="#treausry_details" data-toggle="tab"><b>AG/ BANK/ TREASURY DETAILS</b></a></li>
</ul>

<form action="<?php echo site_url('administrator/service_book/add'); ?>" method="post">
<div class="tab-content" style="overflow: visible;">
    <!-- Personal Details -->
    <div class="tab-pane active" id="personal_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Case Received on</label>
            <div class="col-sm-6">
                <input type="text" name="cash_received" id="cash_received" value="<?php echo set_value('cash_received'); ?>" placeholder="Please Enter Case Received date" /><?php echo form_error('cash_received', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Class of Pension</label>
            <div class="col-sm-6">
                <select name="class_of_pension" id="class_of_pension" class="multiselect">
                    <option value="0" selected="">Select</option>
                    <!-- <optgroup label="Superannuation Pension"> -->
                        <option value="Superannuation_Pension">Superannuation Pension</option>
                        <option value="Voluntary_Retirement_Pension">Voluntary Retirement</option>
                        <option value="Invalid_Retirement_Pension">Invalid Retirement Pension</option>
                        <option value="Absorption_in_autonomous_body_pension">Absorption in autonomus body pension</option>
                        <option value="Disability_Pension">Disability pension</option>
                    <!-- </optgroup> -->
                    <optgroup label="Family">
                        <option value="Extraordinary_Pension">Extraordinary Pension</option>
                        <option value="Liberalised_Pension">Liberalised Pension</option>
                        <option value="Dependent_Pension">Dependent Pension</option>
                        <option value="Parents_Pension">Parents Pension</option>
                    </optgroup>
                </select><?php echo form_error('class_of_pension', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">File No</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="case_no" id="case_no" type="text" value="<?php echo set_value('case_no'); ?>" placeholder="Please Enter File No"><?php echo form_error('case_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group" id="form-group-pension-category" style="display: none;">
            <label class="col-sm-3 control-label">Pension Category</label>
            <div class="col-sm-6">
                <select name="pension_category" id="pension_category">
                    <option value="0" selected="">Select</option>
                    <option value="A">Category A (Death due to natural causes)</option>
                    <option value="B">Category B (Death or disability accepted by govt as attributed to or by aggravated govt service)</option>
                    <option value="C">Category C (Death or disability due to accident while performing duties)</option>
                    <option value="D">Category D (Death or disability due to acts of violence by terrorists,anti social elements while performing duties or otherwise)</option>
                    <option value="E">Category E (Death or disability due to aatack by enemies,enemy action,extremist acts etc)</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="form-group-pension-for" style="display: none;">
            <label class="col-sm-3 control-label">Pension For</label>
            <div class="col-sm-6">
                <select name="pension_for" id="pension_for" class="multiselect">
                    <option value="0" selected="">Select</option>
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
        <div class="form-group" id="pension_scheme" style="display:none;">
            <label class="col-sm-3 control-label">Pension Scheme</label>
            <div class="col-sm-6">
                <input type="radio" name="pension_scheme" value="yes" checked=""> Yes
                <input type="radio" name="pension_scheme" value="no"> No
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Salutation</label>
            <div class="col-sm-6">
                <input readonly autocomplete="off" name="salutation" id="salutation" type="text" value="<?php echo set_value('salutation'); ?>" placeholder="Please Enter Salutation"><?php echo form_error('salutation', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of The Govt. Servent</label>
            <div class="col-sm-6">
                <input readonly name="name" id="name" type="text" value="<?php echo set_value('name'); ?>" placeholder="Please Enter Name of The Govt. Servent"><?php echo form_error('name', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dob" id="dob" type="text" value="<?php echo set_value('dob'); ?>" placeholder="Please Enter Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Religion</label>
            <div class="col-sm-6">
                <select name="religion" id="religion" class="multiselect">
                    <option value="0">Select</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Sikh">Sikh</option>
                    <option value="Christian">Christian</option>
                </select><?php echo form_error('religion', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nationality</label>
            <div class="col-sm-6">
                <select name="nationality" id="nationality" class="multiselect">
                    <option value="0">Select</option>
                    <option value="Indian">Indian</option>
                    <option value="Others">Others</option>
                </select><?php echo form_error('nationality', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <select name="category" id="category" class="multiselect">
                    <option value="0">Select</option>
                    <option value="ap">APST</option>
                    <option value="nonap">NON APST</option>
                </select><?php echo form_error('category', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sex</label>
            <div class="col-sm-6">
                <select name="sex" id="sex" class="multiselect">
                    <option value="0">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><?php echo form_error('sex', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Designation</label>
            <div class="col-sm-6">
                <input readonly autocomplete="off" name="designation" id="designation" type="text" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>
            <div class="col-sm-6">
                <select name="department" id="department" class="multiselect">
                    <option value="0">Select</option>
                    <?php foreach (getAllDepartment() as $dept) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                    <?php } ?>
                </select><?php echo form_error('department', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Form Submitted</label>
            <div class="col-sm-6">
                <textarea disabled="disabled" name="submitted_form" id="submitted_form" rows="4" columns="40"></textarea>
                <!-- <select class="multiselect" multiple="multiple" name="submitted_form[]">
                    <option value="0">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="24">24</option>
                    <option value="1-A">1-A</option>
                </select><?php //echo form_error('submitted_form[]', '<div class="error">', '</div>'); ?> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Document Submitted</label>
            <div class="col-sm-6">
                <textarea disabled="disabled" name="submitted_document" id="submitted_document" rows="4" columns="40"></textarea>
            </div>
        </div>
    </div>
    <!-- Personal Details -->





    <!-- Family Details -->
    <div class="tab-pane" id="family_details">
        <div class="row-fluid sortable">
            <div class="span12">
                <legend style="font-size:15px; color:#3b5999; font-weight:700">Family Information Panel » <small style="font-size:11px"> Use the below panel to enter basic information about family.</small></legend>
                <p style="font-size:12px; color:red">Fields labelled in red are mandatory</p>
                <table class="table" id="myTable" style="margin-top: 10px;">
                    <tbody>
                        <tr id="parent-1" class="parent">
                            <td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td>
                            <td>
                                <select class="form-control" name="spouse_salutation[]">
                                    <option value="0">--Please Select--</option>
                                    <option value="mr">Mr</option>
                                    <option value="mrs">Mrs</option>
                                    <option value="miss">Miss</option>
                                </select><label style="font-size:12px; color:red">Salutation</label>
                            </td>
                            <td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name</label></td>
                            <td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth</label></td>
                            <td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td>
                            <td>
                                <select class="form-control" name="relation[]">
                                    <option value="0">--Please Select--</option>
                                    <option value="wife">Wife</option>
                                    <option value="husband">Husband</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                </select><label style="font-size:12px; color:red">Relation</label>
                            </td>
                            <!-- <td><input type="radio" name="legal_heir[]" class="legal_heir" /><input type="hidden" name="name_of_legal_heir" id="name_of_legal_heir" /></td> -->
                            <td><input type="hidden" name="name_of_legal_heir" id="name_of_legal_heir" /></td>
                            <td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-1"></td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-success" onClick="addRow('myTable')" href="#">Add More</a>
                <a class="btn btn-danger" onClick="deleteRow('myTable')" href="#">Delete</a>
            </div>
        </div>
    </div>
    <!-- Family Details -->

    <!-- Service Details -->
    <div class="tab-pane" id="service_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Appoint as</label>
            <div class="col-sm-6">
                <input class="appointas" type="radio" name="appointas" value="casual" /> Casual  <input class="appointas" type="radio" name="appointas" value="permanent" /> Permanent 
            </div>
        </div><div class="form-group"></div>

        <div class="form-group form-group-dojac" style="display: none;">
            <label class="col-sm-3 control-label">Date of Appointment as Casual</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dojac" id="dojac" type="text" value="<?php echo set_value('dojac'); ?>" placeholder="Appointment as casual">
                <input type="hidden" name="diff_appoint_as_casual" id="diff_appoint_as_casual" />
                <input type="hidden" name="total_service_from_casual_date" id="total_service_from_casual_date" />
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
            <label class="col-sm-3 control-label">Date of Retirement/Death</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dor" id="dor" type="text" value="<?php echo set_value('dor'); ?>" placeholder="Please Enter Date of Retirement/Death"><?php echo form_error('dor', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Age at Retirement/Death</label>
            <div class="col-sm-6">
                <input readonly type="text" name="aryear" id="aryear" class="width50" value="<?php echo set_value('aryear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="armonth" id="armonth" class="width50" value="<?php echo set_value('armonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="arday" id="arday" class="width50" value="<?php echo set_value('arday'); ?>" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Death</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dod" id="dod" type="text" value="<?php echo set_value('dod'); ?>" placeholder="Please Enter Date of Death">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total Service</label>
            <div class="col-sm-6">
                <input readonly name="total_service" id="total_service" type="text" value="<?php echo set_value('total_service'); ?>" placeholder="Total Service">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Non Qualifying Service</label>
            <div class="col-sm-6">
                <input required type="text" name="nonqsyear" id="nonqsyear" class="width50" value="<?php echo set_value('nonqsyear'); ?>" placeholder="year"/>&nbsp;<input required type="text" name="nonqsmonth" id="nonqsmonth" class="width50" value="<?php echo set_value('nonqsmonth'); ?>" placeholder="month"/>&nbsp;<input required type="text" name="nonqsday" id="nonqsday" class="width50" value="<?php echo set_value('nonqsday'); ?>" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Net Qualifying Service</label>
            <div class="col-sm-6">
                <input readonly type="text" name="netqsyear" id="netqsyear" class="width50" value="<?php echo set_value('netqsyear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="netqsmonth" id="netqsmonth" class="width50" value="<?php echo set_value('netqsmonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="netqsday" id="netqsday" class="width50" value="<?php echo set_value('netqsday'); ?>" placeholder="day"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Service Verification</label>
            <div class="col-sm-6">
                <input type="radio" name="service_verification" id="service_verification" value="1" checked="">Yes
                <input type="radio" name="service_verification" id="service_verification" value="0">No
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Regularization of Ad-Hoc Service</label>
            <div class="col-sm-6">
                <input name="probation_period" id="probation_period" type="text" placeholder="Please Enter Probation period">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">SMP</label>
            <div class="col-sm-6">
                <input readonly name="smp" id="smp" type="text" value="<?php echo set_value('smp'); ?>" placeholder="SMP"><?php echo form_error('smp', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Office Address</label>
            <div class="col-sm-6">
                <textarea name="office_address" placeholder="Please enter Office Address"><?php echo set_value('office_address'); ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
            </div>
        </div>
    </div>
    <!-- Service Details -->


    <!-- Pay Details -->
    <div class="tab-pane" id="pay_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Pay Commission</label>
            <div class="col-sm-6">
                <select id="pay-commission" name="pay_commission">
                    <option value="0">--Select--</option>
                    <?php foreach ($records as $rec): ?>
                        <option value="<?php echo $rec['id']  ?>"><?php echo $rec['name']  ?></option>
                    <?php endforeach ?>
                </select> 
            </div>
            <div class="col-sm-6">
                <img id="load_gif" style="display:none" src="<?php echo base_url() ?>/includes/img/ajax-loader.gif">
            </div>           
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label class="col-sm-3 control-label">Pay Scale</label>
                <input required type="text" name="pay_scale" id="pay_scale" placeholder="9300-34800+4200" />
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
        <div id="form_dis"></div>
    </div>
    <!-- Pay Details -->


    <!-- Treausry Details -->
    <div class="tab-pane" id="treausry_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Effect of Pension</label>
            <div class="col-sm-6">
                <input name="effect_of_pension" id="effect_of_pension" type="text" value="<?php echo set_value('effect_of_pension'); ?>"><?php echo form_error('effect_of_pension', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of Accountant General</label>
            <div class="col-sm-6">
                <select name="name_of_accountant_general" id="name_of_accountant_general">
                    <option value="0">Select</option>
                    <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                        <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name']; ?></option>
                    <?php } ?>
                </select>&nbsp;<a href="#addAccountantGeneral" id="addAccountantGeneralModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('name_of_accountant_general', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">TO/ Sub TO(Outside)</label>
            <div class="col-sm-6">
                <input name="sub_to" id="sub_to" type="text" value="<?php echo set_value('sub_to'); ?>"><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Treasury/ Sub Treasury Officer</label>
            <div class="col-sm-6">
                <select name="treasury_officer" id="treasury_officer">
                    <option value="0">Select</option>
                    <?php foreach (getAllTreasury() as $treasury) { ?>
                        <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                    <?php } ?>
                </select>&nbsp;<a href="#addTreasuryOfficer" id="addTreasuryOfficerModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('treasury_officer', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name Bank</label>
            <div class="col-sm-6">
                <input name="bank_name" id="bank_name" type="text" value="<?php echo set_value('bank_name'); ?>"><?php echo form_error('bank_name', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Account No.</label>
            <div class="col-sm-6">
                <input name="account_no" id="account_no" type="text" value="<?php echo set_value('account_no'); ?>"><?php echo form_error('account_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Address after Retirement</label>
            <div class="col-sm-6">
                <textarea name="address_after_retirement" placeholder="Please enter Address after Retirement" style="height: 60px;"><?php echo set_value('address_after_retirement'); ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">State - PIN</label>
            <div class="col-sm-6">
                <input name="pin" id="pin" type="text"value="<?php echo set_value('pin'); ?>"><?php echo form_error('pin', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Cell Phone No. Incl(+91)</label>
            <div class="col-sm-6">
                <input name="phone_no" id="phone_no" type="text" value="<?php echo set_value('phone_no'); ?>"><?php echo form_error('phone_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <input type="submit" name="submit" value="Save" class="btn btn-primary" />
    </div>
    <!-- Treausry Details -->
</div>
</form>
<div id="addAccountantGeneral" class="modal hide fade">
    <div class="modal-header"><h1>Add Accountant General</h1></div>
    <div class="modal-body">
        <label style="float: left;"><b>Name</b></label>&nbsp;&nbsp;&nbsp;
        <textarea name="modalAccountantName" id="modalAccountantName"></textarea>
        <div id="modalAccountantMessage" class="modalMessage"></div>
    </div>
    <div class="modal-footer"><small class="btn btn-danger" data-dismiss="modal">Close</small>&nbsp;<small class="btn btn-primary saveAccountantName">Save</small></div>
</div>
<div id="addTreasuryOfficer" class="modal hide fade">
    <div class="modal-header"><h1>Add Treasury</h1></div>
    <div class="modal-body">
        <label style="float: left;"><b>Title</b></label>&nbsp;
        <textarea name="modalTreasuryTitle" id="modalTreasuryTitle"></textarea>
        <div id="modalTreasuryMessage" class="modalMessage"></div>
    </div>
    <div class="modal-footer"><small class="btn btn-danger" data-dismiss="modal">Close</small>&nbsp;<small class="btn btn-primary saveTreasuryTitle">Save</small></div>
</div>

<style type="text/css">
    .form-group {float: left;width: 50%;margin-bottom: 10px;min-height: 30px;}
    .form-control {width: 80%!important;}
    .width50 {width: 50px;}
    .col-sm-3 {width: 42%; float: left;}
    .ui-datepicker .ui-datepicker-prev span:after,
    .ui-datepicker .ui-datepicker-next span:after {content: "";}
    .ui-datepicker .ui-datepicker-next span:after {content: "";}
    #errors {background: red; padding: 10px;}
    #errors .error {display: block; color: #fff; margin-left: 230px;}
    .error {margin-left: 230px;}
    select.error, textarea.error, input.error {border: 1px solid red;}
    select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
        margin-bottom: 0px;
    }
    #modalAccountantName {float: left;}
    #modalAccountantMessage {margin: 13px 0 0 0;}
    #modalTreasuryTitle {float: left;}
    #modalTreasuryMessage {margin: 13px 0 0 0;}
    .form-group-inside {margin-bottom: 5px;}
</style>
<?php if(validation_errors() != false) { echo '<style type="text/css">.form-group{min-height: 60px;margin-bottom: 0px;}</style>'; } ?>
<script type="text/javascript">

    $(document).ready(function(){
        $('.multiselect').multiselect();

        $('.saveAccountantName').click(function(){
            if($('#modalAccountantName').val()=='') {
                $('#modalAccountantMessage').html('Name is required.');
            } else {
                $.post("<?php echo site_url('administrator/service_book/saveAccountantName'); ?>", {accountantName: $('#modalAccountantName').val()}, function(data) {
                    $('#addAccountantGeneral').modal('hide');
                    $('#name_of_accountant_general').append('<option value='+data+' selected>'+$('#modalAccountantName').val()+'</option>');
                    $('#modalAccountantName').val('');
                });
            }
        });
        $('.saveTreasuryTitle').click(function(){
            if($('#modalTreasuryTitle').val()=='') {
                $('#modalTreasuryMessage').html('Title is required.');
            } else {
                $.post("<?php echo site_url('administrator/service_book/saveTreasuryTitle'); ?>", {treasuryTitle: $('#modalTreasuryTitle').val()}, function(data) {
                    $('#addTreasuryOfficer').modal('hide');
                    $('#treasury_officer').append('<option value='+data+' selected>'+$('#modalTreasuryTitle').val()+'</option>');
                     $('#modalTreasuryTitle').val('');
                });
            }
        });

        $('#class_of_pension').change(function(){
            if($(this).val() == "Absorption_in_autonomous_body_pension") {
                $('#pension_for').hide();
                $('#form-group-pension-category').hide();
                $('#pension_scheme').show();
            } else if($(this).val() == "Extraordinary_Pension") {
                $('#pension_scheme').hide();
                $('#form-group-pension-category').show();
            } else {
                $('#pension_for').hide();
                $('#pension_scheme').hide();
                $('#form-group-pension-category').hide();
            }

            var val = $(this).val();
            if(val=='Superannuation_Pension' || val=='Voluntary_Retirement_Pension' || val=='Invalid_Retirement_Pension' || val=='Absorption_in_autonomous_body_pension' || val=='Disability_Pension') {
                $('#dod').attr('disabled', 'disabled');
            } else {
                $('#dod').removeAttr('disabled');
            }
        });

        $('#pension_category').change(function() {
            if($(this).val() == 'B' || $(this).val() == 'C') {
                $('#form-group-pension-for').hide();
                $('#pension_scheme').show();
            } else if ($(this).val() == 'D' || $(this).val() == 'E') {
                $('#pension_scheme').hide();
                $('#form-group-pension-for').show();
            } else {
                $('#pension_scheme').hide();
                $('#form-group-pension-for').hide();
            }
        });

        $('#revise_type').change(function(){
            if($(this).val()=="revised") {
                $('.dearness_pay_group').show();
                $('#aepd').css('min-height', '210px');
            } else {
                $('.dearness_pay_group').hide();
                $('#aepd').css('min-height', '0px');
            }
        });
    });

    $('#increament_bp').keyup(function(){
        if($(this).val() > 0) {
            $('#increament_gp, #increament_npa, #last_increament_date').removeAttr('readonly');
        } else {
            $('#increament_gp, #increament_npa, #last_increament_date').attr('readonly', 'true');
        }
    });

    $(function() {
        $('#case_no').blur(function(){
            $.post("<?php echo site_url('administrator/service_book/getFileDetails'); ?>", {case_no: $(this).val()}, function(data) {
                var result = JSON.parse(data);
                alert(result);
                if(result=="") {

                } else {
                    $('#name').val(result.pensionee_name);
                    $('#salutation').val(result.salutation);
                    $('#designation').val(result.designation);
                    $('#submitted_document').val(result.files);
                }
            });
        });

        $('.appointas').change(function(){
            var me = $(this);
            if(me.val()=="casual") {
                $('.form-group-dojac').css('display', 'block').removeClass('show hide').addClass('show');
                $('.form-group-dojap').css('display', 'block').removeClass('show hide').addClass('show');
            } else if(me.val()=="permanent") {
                $('.form-group-dojac').css('display', 'none').removeClass('show hide').addClass('hide');
                $('.form-group-dojap').css('display', 'block').removeClass('show hide').addClass('show');
            } else {
                $('.form-group-dojac').css('display', 'none').removeClass('show hide').addClass('hide');
                $('.form-group-dojap').css('display', 'none').removeClass('show hide').addClass('hide');
            }

            //var appointment = appointasChange();
            //alert(appointasChange());
            if(appointasChange() == 'dojac') {
                $("#dojap").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                    if($(this).val() < $('#dojac').val()) {
                        alert('Date of appointment as permanent should be greater than date of appointment as casual.');
                        $(this).val('');
                    } else {
                        $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dojac').val(), jsonData: "true"}, function(data) {
                            var result = JSON.parse(data);
                            var years, months, days, halfY, totalMonths, totalDays;
                            halfY = result.year/2;
                            totalMonths = halfY*12;
                            totalDays = result.month/2*30;
                            if(halfY < 1) {
                                years = 0;
                                months = Math.floor(totalDays/30)+totalMonths;
                                days = Math.floor(result.day/2)+totalDays%30;
                                //alert(years+"-"+months+"-"+days);
                            } else {
                                years = Math.floor(totalMonths/12);
                                months = totalMonths%12;
                                days = Math.floor(result.day/2)+totalDays;
                                if(days==30) {months+=1; days=0;}
                                else if(days > 30) {months+=1; days=days%30}
                                //alert(years+"-"+months+"-"+days);
                            }
                            $('#diff_appoint_as_casual').val(years+"-"+months+"-"+days);
                        });
                    }
                }});
                $("#dojac").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
                    if($(this).val() <= $('#dob').val()) {
                        alert('Date of joining should be greater than date of birth.');
                        $(this).val('');
                    } else {
                        $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
                            var result = JSON.parse(data);
                            $('#aeyear').val(result.year);
                            $('#aemonth').val(result.month);
                            $('#aeday').val(result.day);
                        });
                    }
                }});
            } else {
                $("#dojac").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
                    $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
                        var result = JSON.parse(data);
                        $('#aeyear').val(result.year);
                        $('#aemonth').val(result.month);
                        $('#aeday').val(result.day);
                    });
                }});
                $("#dojap").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
                    $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
                        var result = JSON.parse(data);
                        $('#aeyear').val(result.year);
                        $('#aemonth').val(result.month);
                        $('#aeday').val(result.day);
                    });
                }});
            }
        });

        var appointasChange = function() {
            if($('.form-group-dojac').hasClass('show')) {
                return 'dojac';
            } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
                $('#dojac').datepicker("enable");
                return 'dojap';
            } else {}
        };

        $("#cash_received, #dob, #dod, #effect_of_pension").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        
        $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
            $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
               var result = JSON.parse(data);
               $('#aryear').val(result.year);
               $('#armonth').val(result.month);
               $('#arday').val(result.day);
            });
            var doj = '';
            if($('.form-group-dojac').hasClass('show')) {
                doj = '#dojac';
            } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
                doj = '#dojap';
            } else {}

            $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $('#dor').val(), date2: $(doj).val(), jsonData: "false"}, function(data) {
               $('#total_service').val(data);
            });

            if(appointasChange() == 'dojac') {
                $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>", {date1: $('#dor').val(), date2: $('#dojap').val(), jsonData: "true"}, function(data) {
                    var result = JSON.parse(data);
                    var splitDiff = $('#diff_appoint_as_casual').val().split('-');
                    var years = parseInt(result.year)+parseInt(splitDiff[0]);
                    var months = parseInt(result.month)+parseInt(splitDiff[1]);
                    var days = parseInt(result.day)+parseInt(splitDiff[2]);

                    if(days >= 30) {
                        months+=1;
                        days=days%30;
                    }
                    if(months >= 12) {
                        years+=1;
                        months=months%12;
                    }
                    $('#total_service_from_casual_date').val(years+" years "+months+" months "+days+" days");
                });
            }
        }});
        $('#nonqsday').blur(function(){
            if($('.form-group-dojac').hasClass('show')) {
                var total_service = $('#total_service_from_casual_date').val()
            } else {
                var total_service = $('#total_service').val();
            }
            var nonqs = $('#nonqsyear').val()+" years "+$('#nonqsmonth').val()+" months "+$('#nonqsday').val()+" days";
            $.post("<?php echo site_url('administrator/service_book/calculateNetQualifyingService'); ?>", {total_service: total_service, nonqs: nonqs}, function(data) {
                var result = JSON.parse(data);
                $('#netqsyear').val(result.year);
                $('#netqsmonth').val(result.month);
                $('#netqsday').val(result.day);

                var total = result.year*2;
                if(result.month > 3 && result.month <= 8) {
                    total+=1;
                } else if (result.month >= 9) {
                    total+=2;
                } else {}
                $('#smp').val(total);
            });
        });
    });

    $('body').on('focus',".dob", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',".dod", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

    function addRow(tableID) {
        var rowID = $('#myTable').find('.parent:last').attr('id').split('-');
        var currentID = parseInt(rowID[1])+1;
        //var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select class="form-control" name="spouse_salutation[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation</label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name</label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth</label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select class="form-control" name="relation[]"><option value="0">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation</label></td><td><input type="radio" name="legal_heir[]" class="legal_heir" /></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';
        var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select class="form-control" name="spouse_salutation[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation</label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name</label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth</label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select class="form-control" name="relation[]"><option value="0">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation</label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';
        $('#myTable').find('tr:last').after(data);
        $('#myTable').find('tr:last.parent input[type="text"]').val('');
    }

    function deleteRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        if($('.chk:checked').length == 0) {
            alert('Please select atleast one spouse to delete.');
        } else {
            if(rowCount<=1) {
                alert("Can't delete this row");
            } else {
                $.each($('.chk:checked'), function() {
                    var currentID = $(this).closest('tr').attr('id').split('-');
                    if($('.parent').length==1) {
                        alert("Can't delete this row"); 
                    } else {
                        $(this).closest('tr').remove();
                        $('.child-'+currentID[1]).remove();
                    }
                });
            }
        }
    }

    function validate(){
        var frm = document.getElementById("receipt_form");
        for (var i=0; frm.elements[i]; i++) {
            if (frm.elements[i].tagName=="INPUT" && frm.elements[i].getAttribute("type")=="text" && frm.elements[i].getAttribute("id")!="mname") {
                if(frm.elements[i].value=='') {
                    alert("Please Fill up Complete Details First");
                    frm.elements[i].focus();
                    return false;
                }
            }
        }
        return true;
    }

    $(document).ready(function() {
        $( "#aloc_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2012:2020'
        });
    });

    $(document).ready(function() {
        $(".dob").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange: '1900:+0'
        });
    });

    $(document).ready(function() {
        var obj = [];
        $('.legal_heir').live('change', function() {
            var me = $(this);
            var rowIndex = $(this).closest('tr').index();
            var name = $('#myTable tr:eq('+rowIndex+') .name').val();
            if(me.is(':checked')) {
                //alert('checked');
                var rowClass = $('#myTable tr:eq('+rowIndex+')').attr('class');
                var rowIndex = rowClass.split("-");

                if($('#parent-'+rowIndex[1]+' .dod').val() == "") {
                    alert("Wife is alive so child is not eligible to get pension.");
                    me.prop('checked', false);
                    $('#parent-'+rowIndex[1]+' .dod').focus();
                } else {
                    var count = 0, error = 'false';
                    $.each($('.'+rowClass+' .legal_heir'), function( index, value ){
                        if($(this).is(':checked')) {
                            if(count != 0) {
                                alert('More than one child not get pension.');
                                me.prop('checked', false);
                                error = 'true';
                                return false;
                            }
                            count++;
                        } else {
                            for(var i=0; i<obj.length; i++) {
                                if(obj[i] == "") {
                                    obj.splice(i, 1);
                                }
                            }
                        }
                    });
                    if(error == 'false') {
                        obj.push(name);
                    }
                }
            } else {
                //alert('not checked');
                for(var i=0; i<obj.length; i++) {
                    if(obj[i] == name) {
                        obj.splice(i, 1);
                        break;
                    } else if(obj[i] == "") {
                        obj.splice(i, 1);
                    } else {}
                }
            }
            console.log(JSON.stringify(obj));
            $('#name_of_legal_heir').val(JSON.stringify(obj));
        });

        /*$('.legal_heir').live('change', function(){
            var rowIndex = $(this).closest('tr').index();
            $('#name_of_legal_heir').val($('#myTable tr:eq('+rowIndex+') .name').val());
        });*/

        $('.addChild').live('click', function(){
            var parentID = $(this).closest('tr').attr('id');
            var ID = parentID.split('-');
            var html = '<tr class="child-'+ID[1]+'"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" /></td><td><select class="form-control" name="child_salutation'+ID[1]+'[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select></td><td><input type="text" name="parentchild_name'+ID[1]+'[]" class="form-control name" placeholder="Name of Child"/></td><td><input type="text" class="dob form-control" name="child_dob'+ID[1]+'[]" placeholder="Child\'s date of birth"/></td><td><input type="text" class="dod form-control" name="child_dod'+ID[1]+'[]" placeholder="Child\'s date of death"/></td><td><input type="text" class="form-control" name="child_income'+ID[1]+'[]" placeholder="Child\'s income per month"/></td><td><input type="checkbox" name="legal_heir[]" class="legal_heir" /></td></tr>';
            var parentID = $(this).closest('tr').attr('id');            
            $(html).insertAfter("#"+parentID);
            $('.dob').datepicker({dateFormat: 'yy-mm-dd', changeYear: true, changeMonth:true, yearRange: '1900:+0'});
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#pay-commission").change(function(){
            var x=$("#pay-commission").val();
            //$("#load_gif").show();
            $.ajax({
                url:'pre_revised?id='+x,
                dataType:'html',
                method:'GET',
                success:function(data){
                    $("#form_dis").html(data);
                    //$("#load_gif").fadeOut('slow');
                }
            });
        })
    });
</script>