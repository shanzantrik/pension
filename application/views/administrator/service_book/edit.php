<?php $row = $records[0]; ?>


<h3 id="service-book-heading">Edit Service Book <span>(Fields mark with (*) are mandatory fields.)</span></h3>

<form action="<?php echo site_url('administrator/service_book/edit/'.$row['serial_no']); ?>" method="post" id="service-book-form">
<div class="tab-pane active" id="personal_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Personal Details Panel » <small style="font-size:11px"> Please enter personal information.</small></legend>
    <input type="hidden" name="action_type" id="action_type" value="edit" />
    <div class="form-group">
        <label class="col-sm-3 control-label">File No <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="case_no" id="case_no" type="text" value="<?php echo $row['case_no']; ?>" placeholder="Please Enter File No"><?php echo form_error('case_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Case Received on <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input type="text" name="cash_received" id="cash_received" value="<?php echo $row['cash_received']; ?>" placeholder="Please Enter Case Received date" /><?php echo form_error('cash_received', '<div class="error">', '</div>'); ?>
            <input type="hidden" name="serial_no" value="<?php echo $row['serial_no']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Class of Pension <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select required name="class_of_pension" id="class_of_pension">
                <option value="">Select</option>
                <?php $normal = array('Superannuation_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension', 'Compulsory_Retirement_Pension'); ?>
                <?php $family = array('Normal_Family_Pension', 'Extraordinary_Pension', 'Liberalised_Pension', 'Dependent_Pension', 'Parents_Pension'); ?>
                <?php
                    foreach ($normal as $key => $c) {
                        if($c==$row['class_of_pension']) {
                            echo '<option value="'.$c.'" selected>'.str_replace("_", " ", $c).'</option>';
                        } else {
                            echo '<option value="'.$c.'">'.str_replace("_", " ", $c).'</option>';
                        }
                    }
                ?>
                <optgroup label="Family">
                    <?php
                        foreach ($family as $key => $c) {
                            if($c==$row['class_of_pension']) {
                                echo '<option value="'.$c.'" selected>'.str_replace("_", " ", $c).'</option>';
                            } else {
                                echo '<option value="'.$c.'">'.str_replace("_", " ", $c).'</option>';
                            }
                        }
                    ?>
                </optgroup>
            </select><?php echo form_error('class_of_pension', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group" id="form-group-pension-category" <?php if($row['class_of_pension'] != "Extraordinary_Pension") { ?>style="display: none; height: 60px"<?php } ?>>
        <label class="col-sm-3 control-label">Pension Category</label>
        <div class="col-sm-6">
            <select name="pension_category" id="pension_category">
                <option value="">Select</option>
                <?php $pension_category = array('A'=>'Category A (Death due to natural causes)', 'B'=>'Category B (Death or disability accepted by govt as attributed to or by aggravated govt service)', 'C'=>'Category C (Death or disability due to accident while performing duties)', 'D'=>'Category D (Death or disability due to acts of violence by terrorists,anti social elements while performing duties or otherwise)', 'E'=>'Category E (Death or disability due to aatack by enemies,enemy action,extremist acts etc)'); ?>
                <?php
                    foreach ($pension_category as $key => $pc) {
                        if($key==$row['pension_category']) {
                            echo '<option value="'.$key.'" selected>'.$pc.'</option>';
                        } else {
                            echo '<option value="'.$key.'">'.$pc.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group" id="form-group-pension-for" <?php if($row['class_of_pension'] == "Extraordinary_Pension" && ($row['pension_category'] == "D" || $row['pension_category'] == "E")) { ?>style="height: 60px"<?php } else { ?>style="display: none; height: 60px;"<?php } ?>>
        <label class="col-sm-3 control-label">Pension For</label>
        <div class="col-sm-6">
            <select name="pension_for" id="pension_for">
                <option value="" selected="">Select</option>
                <?php $normal = array('widow', 'widow_remarriage', 'no_widow_but_survived_by_children'); ?>
                <?php $bachelor = array('both_parents_are_alive', 'only_one_of_them_is_alive'); ?>
                <?php
                    foreach ($normal as $key => $c) {
                        if($c==$row['pension_for']) {
                            echo '<option value="'.$c.'" selected>'.ucfirst(str_replace("_", " ", $c)).'</option>';
                        } else {
                            echo '<option value="'.$c.'">'.ucfirst(str_replace("_", " ", $c)).'</option>';
                        }
                    }
                ?>
                <optgroup label="Employee dies a bachelor">
                    <?php
                        foreach ($bachelor as $key => $c) {
                            if($c==$row['pension_for']) {
                                echo '<option value="'.$c.'" selected>'.ucfirst(str_replace("_", " ", $c)).'</option>';
                            } else {
                                echo '<option value="'.$c.'">'.ucfirst(str_replace("_", " ", $c)).'</option>';
                            }
                        }
                    ?>
                </optgroup>
            </select>
        </div>
    </div>

    <?php
        $style = '';
        if($row['class_of_pension'] == "Extraordinary_Pension" && ($row['pension_category'] == "B" || $row['pension_category'] == "C")) :
            $style = "height: 60px";
        elseif ($row['class_of_pension'] == "Absorption_in_autonomous_body_pension") :
            $style = "height: 60px";
        else :
            $style = "display: none; height: 60px";
        endif;
    ?>
    <div class="form-group" id="pension_scheme" style="<?php echo $style; ?>">
        <label class="col-sm-3 control-label">Pension Scheme</label>
        <div class="col-sm-6">
            <input type="radio" name="pension_scheme" value="yes" <?php if($row['pension_scheme'] == 'yes') { ?>checked<?php } ?>> Yes
            <input type="radio" name="pension_scheme" value="no" <?php if($row['pension_scheme'] == 'no') { ?>checked<?php } ?>> No
        </div>
    </div>

    <div class="form-group" id="disability_catagory" <?php if($row['class_of_pension'] != "Disability_Pension") { ?>style="display:none"<?php } ?>>
        <label class="col-sm-3 control-label">Disability Category</label>
        <div class="col-sm-6">
            <select name="disability_catagory">
                <option value="">Select</option>
                <?php
                    $disability_catagory = array('A', 'B', 'C');
                    foreach ($disability_catagory as $dc) {
                        if($dc==$row['dis_category']) {
                            echo '<option value="'.$dc.'" selected>'.$dc.'</option>';
                        } else {
                            echo '<option value="'.$dc.'">'.$dc.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group" id="disability_percent" <?php if($row['class_of_pension'] != "Disability_Pension") { ?>style="display:none"<?php } ?>>
        <label class="col-sm-3 control-label">Disability Percentage</label>
        <div class="col-sm-6">
            <select name="disability_percent">
                <option value="">Select</option>
                <?php
                    $dis_percent = array('100', '90', '80');
                    foreach ($dis_percent as $dp) {
                        if($dp==$row['dis_percent']) {
                            echo '<option value="'.$dp.'" selected>'.$dp.'</option>';
                        } else {
                            echo '<option value="'.$dp.'">'.$dp.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label">Name of The Govt. Servent <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input style="width: 15%; float: left; border-radius: 0px;" readonly autocomplete="off" name="salutation" id="salutation" type="text" value="<?php echo $row['salutation']; ?>">
            <input style="width: 68%; float: left; border-radius: 0px;" readonly name="name" id="name" type="text" value="<?php echo $row['name']; ?>" placeholder="Please Enter Name of The Govt. Servent"><?php echo form_error('name', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Date of Birth <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dob" id="dob" type="text" value="<?php echo $row['dob']; ?>" placeholder="Please Enter Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Religion <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="religion" id="religion" class="multiselect">
                <option value="0">Select</option>
                <?php $religion = array('Hindu', 'Muslim', 'Sikh', 'Christian', 'Others'); ?>
                <?php
                    foreach ($religion as $key => $rl) {
                        if($rl==$row['religion']) {
                            echo '<option value="'.$rl.'" selected>'.$rl.'</option>';
                        } else {
                            echo '<option value="'.$rl.'">'.$rl.'</option>';
                        }
                    }
                ?>
            </select><?php echo form_error('religion', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nationality <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="nationality" id="nationality" class="multiselect">
                <option value="0">Select</option>
                <?php $nationality = array('Indian', 'Others'); ?>
                <?php
                    foreach ($nationality as $key => $nl) {
                        if($nl==$row['nationality']) {
                            echo '<option value="'.$nl.'" selected>'.$nl.'</option>';
                        } else {
                            echo '<option value="'.$nl.'">'.$nl.'</option>';
                        }
                    }
                ?>
            </select><?php echo form_error('nationality', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Category <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="category" id="category" class="multiselect">
                <option value="0">Select</option>
                <?php $category = array('ap'=>'APST', 'nonap'=>'NON APST'); ?>
                <?php
                    foreach ($category as $key => $cat) {
                        if($key==$row['category']) {
                            echo '<option value="'.$key.'" selected>'.$cat.'</option>';
                        } else {
                            echo '<option value="'.$key.'">'.$cat.'</option>';
                        }
                    }
                ?>
            </select><?php echo form_error('category', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Gender <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input type="text" id="sex" name="sex" readonly="readonly" value="<?php echo $row['sex']; ?>" /><?php echo form_error('sex', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Designation <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input readonly autocomplete="off" name="designation" id="designation" type="text" value="<?php echo $row['designation']; ?>">
            <?php $retire_age = getRetireAge($row['designation']); ?>
            <input type="hidden" name="retire_age" id="retire_age" value="<?php echo $retire_age; ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Department <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select name="department" id="department" class="multiselect">
                <option value="0">Select</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                    <?php if($dept['dept_code'] == $row['department']) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>" selected><?php echo $dept['dept_name']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select><?php echo form_error('department', '<div class="error">', '</div>'); ?>
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
            <?php
                $document = '';
                if(count(getSubmittedDocument($row['case_no'])) >= 1) {
                    foreach (getSubmittedDocument($row['case_no']) as $value) {
                        $document .= getDocumentName($value['doc_code']).", ";
                    }
                }
            ?>
            <textarea disabled="disabled" name="submitted_document" id="submitted_document" rows="4" columns="40">
                <?php echo $doc = (!empty($document)) ? substr($document, 0, strlen($document)-2) : ''; ?>
            </textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Address after Retirement <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <textarea name="address_after_retirement" placeholder="Please enter Address after Retirement" rows="4" columns="40"><?php echo $row['address_after_retirement']; ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">PIN Code </label>
        <div class="col-sm-6">
            <input name="pin" id="pin" type="text"value="<?php echo $row['pin']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Cell Phone No. Incl(+91) </label>
        <div class="col-sm-6">
            <input name="phone_no" id="phone_no" type="text" value="<?php echo $row['phone_no']; ?>">
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
                <?php $appointas = array('Adhoc', 'Officiating', 'WC', 'Temporary', 'Permanent'); ?>
                <?php
                    foreach ($appointas as $key => $c) {
                        if($c==$row['appoint_as']) {
                            echo '<option value="'.$c.'" selected>'.$c.'</option>';
                        } else {
                            echo '<option value="'.$c.'">'.$c.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group form-group-dojac" <?php if($row['dojac']=="0000-00-00") { ?>style="display: none;" <?php } ?>>
        <label class="col-sm-3 control-label">Date of Appointment as Casual</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dojac" id="dojac" type="text" value="<?php echo ($row['dojac'] != "0000-00-00") ? $row['dojac'] : ''; ?>" placeholder="Appointment as casual">
            <input type="hidden" name="diff_appoint_as_casual" id="diff_appoint_as_casual" />
            <input type="hidden" name="total_service_from_casual_date" id="total_service_from_casual_date" />
        </div>
    </div>
    <div class="form-group form-group-dojap">
        <label class="col-sm-3 control-label">Date of Appointment as Permanent</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dojap" id="dojap" type="text" value="<?php echo $row['doj']; ?>" placeholder="Appointment as permanent">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Age at Entry</label>
        <div class="col-sm-6">
            <input readonly type="text" name="aeyear" id="aeyear" class="width50" value="<?php echo set_value('aeyear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="aemonth" id="aemonth" class="width50" value="<?php echo set_value('aemonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="aeday" id="aeday" class="width50" value="<?php echo set_value('aeday'); ?>" placeholder="day"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label label-dor">Date of Retirement <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input required autocomplete="off" name="dor" id="dor" type="text" value="<?php echo $row['dor']; ?>" placeholder="Please Enter Date of Retirement/Death"><?php echo form_error('dor', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label label-dod">Date of death</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="dod" id="dod" type="text" value="<?php echo ($row['dod'] != "0000-00-00") ? $row['dod'] : ''; ?>" placeholder="Please Enter Date of Death">
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
            <input readonly name="total_service" id="total_service" type="text" value="<?php echo $row['total_service']; ?>" placeholder="Total Service">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Non Qualifying Service <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <?php list($year, $month, $day) = explode("-", $row['non_qualifying_service']); ?>
            <input required autocomplete="off" type="number" name="nonqsyear" id="nonqsyear" class="width50" value="<?php echo $year; ?>" placeholder="year" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="nonqsmonth" id="nonqsmonth" class="width50" value="<?php echo $month; ?>" placeholder="month" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="nonqsday" id="nonqsday" class="width50" value="<?php echo $day; ?>" placeholder="day" min="0"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Net Qualifying Service</label>
        <div class="col-sm-6">
            <?php list($year, $month, $day) = explode("-", $row['net_qualifying_service']); ?>
            <input readonly type="text" name="netqsyear" id="netqsyear" class="width50" value="<?php echo $year; ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="netqsmonth" id="netqsmonth" class="width50" value="<?php echo $month; ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="netqsday" id="netqsday" class="width50" value="<?php echo $day; ?>" placeholder="day"/>
        </div>
    </div>

    <div class="form-group" style="min-height:60px;">
        <label class="col-sm-3 control-label">Service Verification</label>
        <div class="col-sm-6">
            <input type="radio" name="service_verification" id="service_verification" value="1" checked="">Yes
            <input type="radio" name="service_verification" id="service_verification" value="0">No
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">SMP</label>
        <div class="col-sm-6">
            <input readonly name="smp" id="smp" type="text" value="<?php echo $row['smp']; ?>" placeholder="SMP"><?php echo form_error('smp', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Office Address <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <textarea name="office_address" id="office_address" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row['office_address']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group" id="compulsory_rate" <?php if($row['class_of_pension'] != 'Compulsory_Retirement_Pension') { ?>style="display: none;"<?php } ?>>
        <label class="col-sm-3 control-label">2/3</label>
        <div class="col-sm-6">
            <input type="radio" name="com_pension_rate" value="pension" <?php if($row['com_pension_rate'] == 'pension') { ?>checked="checked"<?php } ?>>Pension
            <input type="radio" name="com_pension_rate" value="gratuity" <?php if($row['com_pension_rate'] == 'gratuity') { ?>checked="checked"<?php } ?>>Gratuity
            <input type="radio" name="com_pension_rate" value="both" <?php if($row['com_pension_rate'] == 'both') { ?>checked="checked"<?php } ?>>Both
        </div>
    </div>
</div>
<div class="clear"></div>

 <div class="tab-pane" id="family_details">
    <div class="row-fluid sortable">
        <div class="span12">
            <legend style="font-size:15px; color:#3b5999; font-weight:700">Family Information Panel » <small style="font-size:11px"> Use the below panel to enter basic information about family.</small></legend>
            <p style="font-size:12px; color:red">Fields labelled in red are mandatory</p>
            <?php $family = unserialize($row['family_info']); ?>
            <table class="table" id="myTable" style="margin-top: 10px;">
                <tbody>
                    <?php $count = 1; ?>
                    <?php $legal_heir = array_pop($family); ?>
                    <?php
                        $array = array();
                        $lh = explode(",", $legal_heir['legal_heir']);
                        foreach ($lh as $value) {
                            if(!empty($value)) :
                                list($sn, $cn) = explode(">", str_replace("\"", "", $value));
                                $array[$sn] = $cn;
                            endif;
                        }
                    ?>
                    <?php foreach ($family as $key => $value) {  ?>
                        <tr id="parent-<?php echo $count; ?>" class="parent">
                            <td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk"></td>
                            <td>
                                <?php $spouse_sal = array('mr'=>'Mr', 'mrs'=>'Mrs', 'miss'=>'Miss'); ?>
                                <select required class="spouse_salutation form-control" name="spouse_salutation[]">
                                    <option value="0">--Please Select--</option>
                                    <?php foreach ($spouse_sal as $key => $ss) {
                                        if($value['spouse_salutation'] == $key) :
                                            echo '<option value="'.$key.'" selected>'.$ss.'</option>';
                                        else :
                                            echo '<option value="'.$key.'">'.$ss.'</option>';
                                        endif;
                                    } ?>
                                </select><label style="font-size:12px; color:red">Salutation <span class="required-field">*</span></label>
                            </td>
                            <td><input required autocomplete="off" value="<?php echo $value['spouse_name']; ?>" type="text" name="spouse_name[]" class="form-control name"><label style="font-size:12px; color:red">Spouse Name <span class="required-field">*</span></label></td>
                            <td><input required value="<?php echo $value['spouse_dob']; ?>" class="dob form-control" name="spouse_dob[]" size="16" type="text"><label style="font-size:12px; color:red">Date of birth <span class="required-field">*</span></label></td>
                            <td><input value="<?php echo $value['spouse_dod']; ?>" class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text"><label style="font-size:12px; color:red">Date of death if available</label></td>
                            <td>
                                <?php $relation = array('wife'=>'Wife', 'husband'=>'Husband', 'father'=>'Father', 'mother'=>'Mother'); ?>
                                <select required class="family_relation form-control" name="relation[]">
                                    <option value="">--Please Select--</option>
                                    <?php foreach ($relation as $key => $r) {
                                        if($value['relation'] == $key) :
                                            echo '<option value="'.$key.'" selected>'.$r.'</option>';
                                        else :
                                            echo '<option value="'.$key.'">'.$r.'</option>';
                                        endif;
                                    } ?>
                                </select><label style="font-size:12px; color:red">Relation <span class="required-field">*</span></label>
                            </td>
                            <td><input required class="percentage form-control" name="percentage[]" size="5" type="text" value="<?php echo $value['percentage']; ?>"><label style="font-size:12px; color:red">Percentage <span class="required-field">*</span></label></td>
                            <td></td>
                            <td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-<?php echo $count; ?>"></td>
                        </tr>
                        <?php
                            if(count($value['child']) != '0') {
                                $marital_status = ['married'=>'Married', 'unmarried'=>'Unmarried', 'divorcee'=>'Divorcee', 'widow'=>'Widow'];
                                $handicapped = ['yes'=>'Yes', 'no'=>'No'];
                                foreach ($value['child'] as $child_key => $child) { ?>
                                    <tr class="child-<?php echo $count; ?>">
                                        <td><input style="opacity:4!important;" type="checkbox" name="chk[]"></td>
                                        <td>
                                            <?php $child_sal = array('mr'=>'Mr', 'mrs'=>'Mrs', 'miss'=>'Miss'); ?>
                                            <select class="form-control" name="child_salutation<?php echo $count; ?>[]">
                                                <option value="0">--Please Select--</option>
                                                <?php foreach ($child_sal as $key => $ss) {
                                                    if($child['salutation'] == $key) :
                                                        echo '<option value="'.$key.'" selected>'.$ss.'</option>';
                                                    else :
                                                        echo '<option value="'.$key.'">'.$ss.'</option>';
                                                    endif;
                                                } ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="parentchild_name<?php echo $count; ?>[]" class="form-control name" value="<?php echo $child['name']; ?>" placeholder="Name of Child"></td>
                                        <td><input type="text" class="dob form-control" name="child_dob<?php echo $count; ?>[]" value="<?php echo $child['dob']; ?>" placeholder="Child's date of birth"></td>
                                        <td><input type="text" class="form-control" name="child_income<?php echo $count; ?>[]" value="<?php echo $child['income']; ?>" placeholder="Child's income per month"></td>
                                        <td>
                                            <select class="marital_status form-control" name="marital_status<?php echo $count; ?>[]" required>
                                                <option value="">--Marital Status--</option>
                                                <?php foreach($marital_status as $key=>$ms) : ?>
                                                    <?php if($key == $child['marital_status']) : ?>
                                                        <option value="<?php echo $key; ?>" selected><?php echo $ms; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $ms; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>

                                        <td colspan="3">
                                            <?php if(array_key_exists($value['spouse_name'], $array)) { ?>
                                                <?php if($array[$value['spouse_name']] == $child['name']) { ?>
                                                    <input type="checkbox" name="legal_heir[]" class="legal_heir" checked><label style="font-size:12px; color:red; margin-left: 18px;">Check this if spouse is not alive.</label>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="legal_heir[]" class="legal_heir"><label style="font-size:12px; color:red; margin-left: 18px;">Check this if spouse is not alive.</label>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="checkbox" name="legal_heir[]" class="legal_heir"><label style="font-size:12px; color:red; margin-left: 18px;">Check this if spouse is not alive.</label>
                                            <?php } ?>


                                            <div style="float: left; margin: 4px;">Handicapped</div>
                                            <select name="handicapped<?php echo $count; ?>[]" style="float: left; width: 25%">
                                                <?php foreach($handicapped as $key=>$hc) : ?>
                                                    <?php if($key == $child['handicapped']) : ?>
                                                        <option value="<?php echo $key; ?>" selected><?php echo $hc; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $hc; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php }
                            }
                        ?>
                        <?php $count++; ?>
                    <?php } ?>
                    <input type="hidden" name="name_of_legal_heir" id="name_of_legal_heir" />
                </tbody>
            </table>
            <a class="btn btn-success scrollToTop" onClick="addRow('myTable')" data-target="family_details">Add More</a>
            <a class="btn btn-danger scrollToTop" onClick="deleteRow('myTable')" data-target="family_details">Delete</a>
        </div>
    </div>
</div>

<div class="tab-pane" id="pay_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Pay Details Information Panel » <small style="font-size:11px"> Use the below panel to enter payment information.</small></legend>
    <div class="form-group">
        <label class="col-sm-3 control-label">Pay Commission <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <select id="pay-commission" name="pay_commission">
                <option value="0">--Select--</option>
                <?php foreach ($payComn as $rec): ?>
                    <?php if($rec['id'] == $row['pay_commission']) { ?>
                        <option value="<?php echo $rec['id']; ?>" selected><?php echo $rec['name']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $rec['id']; ?>"><?php echo $rec['name']; ?></option>
                    <?php } ?>
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
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Provisional Pension</label>
            <input required type="text" name="provisional_pension" id="provisional_pension" value="<?php echo $row['provisional_pension']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Provisional Gratuity</label>
            <input required type="text" name="provisional_gratuity" id="provisional_gratuity" value="<?php echo $row['provisional_gratuity']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Excess Pay and Allowances</label>
            <input required type="text" name="excess_pay_and_allowances" id="excess_pay_and_allowances" value="<?php echo $row['excess_pay_and_allowances']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">Others if Any</label>
            <input required type="text" name="others_if_any" id="others_if_any" value="<?php echo $row['others']; ?>" />
        </div>
    </div>
    <div class="form-group" style="min-height:60px;min-width: 220px;">
        <label class="col-sm-3 control-label">Commutation Applied</label>
        <div class="col-sm-6">
            <input type="radio" name="com_applied" id="com_applied" value="1" <?php if($row['com_applied']=='1'){?>checked<?php } ?>>Yes
            <input type="radio" name="com_applied" id="com_applied" value="0"  <?php if($row['com_applied'] == '0') { ?>checked<?php } ?>>No
        </div>
    </div>

    <div class="form-group" style="min-height:60px;">
        <label class="col-sm-3 control-label">Uncheck this if not applicable.</label>
        <div class="col-sm-6">
            <input type="checkbox" name="dr" id="dr" value="yes" <?php if($row['dr']=='yes'){?>checked<?php } ?>> DR
            <input type="checkbox" name="ma" id="ma" value="yes"  <?php if($row['ma'] == 'yes') { ?>checked<?php } ?>> MA
        </div>
    </div>

    <div id="form_dis"></div>
    <div class="clear"></div>
</div>
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

<!-- Treausry Details -->
<div class="tab-pane" id="treausry_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Treasury/AG Office/Bank Details Information Panel » <small style="font-size:11px"> Use the below panel to enter relevant details.</small></legend>
    <div class="form-group full-form-group">
        <label class="col-sm-3 control-label">Name of Accountant General</label>
        <div class="col-sm-12">
            <select name="name_of_accountant_general" id="name_of_accountant_general" <?php if($row['treasury_officer'] != NULL) { ?>disabled="disabled"<?php } ?>>
                <option value="">Select</option>
                <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                    <?php if($ag['id'] == $row['name_of_accountant_general']) { ?>
                        <option value="<?php echo $ag['id']; ?>" selected><?php echo $ag['name']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>&nbsp;<a href="#addAccountantGeneral" id="addAccountantGeneralModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('name_of_accountant_general', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">TO/ Sub TO(Outside)</label>
        <div class="col-sm-6">
            <input name="sub_to" id="sub_to" type="text" value="<?php echo $row['sub_to']; ?>" <?php if($row['treasury_officer'] != NULL) { ?>disabled="disabled"<?php } ?>><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Treasury/ Sub Treasury Officer</label>
        <div class="col-sm-6">
            <select name="treasury_officer" id="treasury_officer" <?php if($row['name_of_accountant_general'] != NULL) { ?>disabled="disabled"<?php } ?>>
                <option value="">Select</option>
                <?php foreach (getAllTreasury() as $treasury) { ?>
                    <?php if($treasury['id'] == $row['treasury_officer']) { ?>
                        <option value="<?php echo $treasury['id']; ?>" selected><?php echo $treasury['title']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>&nbsp;<a href="#addTreasuryOfficer" id="addTreasuryOfficerModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('treasury_officer', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Date of Effect of Pension <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input readonly name="effect_of_pension" id="effect_of_pension" type="text" value="<?php echo $row['effect_of_pension']; ?>"><?php echo form_error('effect_of_pension', '<div class="error">', '</div>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Name Bank</label>
        <div class="col-sm-6">
            <textarea name="bank_name" id="bank_name" placeholder="Bank Details" style="height: 60px;"><?php echo $row['bank_name']; ?></textarea>
            <!--<input name="bank_name" id="bank_name" type="text" value="<?php //echo $row['bank_name']; ?>"><?php //echo form_error('bank_name', '<div class="error">', '</div>'); ?>-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Bank Account No.</label>
        <div class="col-sm-6">
            <input name="account_no" id="account_no" type="text" value="<?php echo $row['account_no']; ?>"><?php echo form_error('account_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Bank Code No.</label>
        <div class="col-sm-6">
            <input name="code_no" id="code_no" type="text" value="<?php echo set_value('code_no'); ?>"><?php echo form_error('code_no', '<div class="error">', '</div>'); ?>
        </div>
    </div>

</div>
<!-- Treausry Details -->
<div class="clear"></div>
<input type="submit" name="submit" value="Update" class="btn btn-primary" />
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
#family_details table .form-control{ width: 132px;}
#pay_details {margin-top: 20px;}
#pay_details .form-group{float: left; margin: 0px 20px;}
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
.error {margin-left: 230px;}
#modalAccountantName {float: left;}
#modalAccountantMessage {margin: 13px 0 0 0;}
#modalTreasuryTitle {float: left;}
#modalTreasuryMessage {margin: 13px 0 0 0;}
.form-group-inside {margin-bottom: 5px;}
.legal_heir {float: left;}
</style>
<?php if(validation_errors() != false) { echo '<style type="text/css">.form-group{min-height: 60px;margin-bottom: 0px;}</style>'; } ?>
<script type="text/javascript">
    $(document).ready(function() {

        addAccountantGeneral("<?php echo site_url('administrator/service_book/saveAccountantName'); ?>");
        addTreasuryOfficer("<?php echo site_url('administrator/service_book/saveTreasuryTitle'); ?>");
        checkPensionCase();

        $('#case_no').blur(function() {
            getFileDetails("<?php echo site_url('administrator/service_book/getFileDetails'); ?>");
        });

        changeDOB();
        changeDOR();
        changeDOD();
        ageAtJoining($('#dob').val(), $('#dojap').val());
        checkAppointAs();
    });

    $(function() {
        $("#cash_received, #dod").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        
        ageAtRetirement();
        $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
            ageAtRetirement();
        }});

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
    });

    $('body').on('focus',".dob", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',".dod", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

    $(document).ready(function() {
        var obj = [];
        $('.legal_heir').each(function(){
            var me = $(this);
            var rowIndex = $(this).closest('tr').index();
            var childName = $('#myTable tr:eq('+rowIndex+') .name').val();

            var rowClass = $('#myTable tr:eq('+rowIndex+')').attr('class');
            var rowIndex = rowClass.split("-");
            var parentName = $('#parent-'+rowIndex[1]+' .name').val();
            var name = parentName+">"+childName;

            if(me.is(':checked')) {
                //alert('checked');
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
            $('#name_of_legal_heir').val(JSON.stringify(obj));
        });
    });
</script>

<?php $pay_info = unserialize($row['pay_info']); ?>

<script type="text/javascript">
    $(document).ready(function() {
        onPayCommissionLoad();
        getPensionCalc();
        $('#pay-commission').on('change', function() {
            onPayCommissionChange('<?php echo site_url("RestService/getPreRevisedPayScale/"); ?>');
            getPensionCalc();
        });

        $('#earn_leave').val('<?php echo $pay_info[3]["earn_leave"]; ?>');
        $('#half_pay').val('<?php echo $pay_info[4]["half_pay"]; ?>');
    });

    var onPayCommissionLoad = function() {
        var me = $('#pay-commission');
        $.post('<?php echo site_url("RestService/getPreRevisedPayScaleSelect/"); ?>', {payCommission: parseInt(me.val()), select: '<?php echo $row["pay_scale"]; ?>'}, function(data) {
            $('#pay_scale').html(data);
        });
    };

    var getPensionCalc = function() {
        var x=$("#pay-commission").val();
        $.ajax({
            url: '<?php echo site_url("administrator/service_book"); ?>/pre_revised?id='+x,
            dataType:'html',
            method:'GET',
            success:function(data) {
                $("#form_dis").html(data);
                <?php foreach($pay_info[0] as $key => $value) { ?>
                    <?php
                        $value = ($value == '') ? 0 : $value;
                        $pay_type = str_replace("post_", "", $key);
                        $increment = $pay_info[1]['increament_'.$pay_type];
                        if($pay_type == 'DA') :
                            $pre = $value;
                            $post = $increment;
                        ?>
                            $('#pre_da option:contains("<?php echo $pre; ?>")').prop('selected', true);
                            $('#post_da option:contains("<?php echo $post; ?>")').prop('selected', true);
                        <?php else : ?>
                            <?php $pre = $value-$increment; ?>
                            <?php $pre = ($pre == '') ? 0 : $pre; ?>
                            $('input[name="<?php echo "pre_".$pay_type; ?>"]').val('<?php echo $pre; ?>');
                            $('input[name="<?php echo $key; ?>"]').val('<?php echo $value; ?>');
                        <?php endif; ?>
                <?php } ?>
                $('#last_increament_date').val('<?php echo $pay_info[2]["last_increament_date"]; ?>');

                var pre_sum = 0;
                var pre_da = $('#pre_da').val() || 0;
                for(var i=0; i<$('.pre_xx').length; i++) {
                    pre_sum+=parseInt($('.pre_xx:eq('+i+')').val()) || 0;
                    //pre_sum = pre_sum+parseInt($('.pre_xx:eq('+i+')').val());
                }
                pre_sum=(pre_sum*parseInt(pre_da)/100)+pre_sum;
                $('#total_pre').val(parseInt(pre_sum));
                var post_sum = 0;
                var post_da = $('#post_da').val() || 0;
                for(var j=0; j<$('.rev_xx').length; j++) {
                    post_sum+=parseInt($('.rev_xx:eq('+j+')').val()) || 0;
                }
                post_sum=(post_sum*parseInt(post_da)/100)+post_sum;
                $('#total_rev').val(post_sum);
            }
        });
    }
</script>
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>