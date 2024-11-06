<?php $row = $records[0]; $pensioner = $values; 

$NumberOfWives=$pensioner->getNumberOfWives();

        if($NumberOfWives==0){
            $NumberOfWives=1;
        }


?>



<h3 id="service-book-heading">Edit Service Book <span>(Fields mark with (*) are mandatory fields.)</span></h3>

<form action="<?php echo site_url('administrator/service_book/edit/'.$row['serial_no']); ?>" method="post" id="service-book-form">
<div class="tab-pane active" id="personal_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Personal Details Panel » <small style="font-size:11px"> Please enter personal information.</small></legend>
    <input type="hidden" name="action_type" id="action_type" value="edit" />
    <div class="form-group">
        <label class="col-sm-3 control-label">File No <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input autocomplete="off" name="case_no" id="case_no" type="text" value="<?php echo $case=$row['case_no']; ?>" placeholder="Please Enter File No"><?php echo form_error('case_no', '<div class="error">', '</div>'); ?>
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
                <?php $family = array('Normal_Family_Pension', 'Extraordinary_Pension', 'Liberalised_Pension', 'Dependent_Pension', 'Parents_Pension', 'NPS', 'Death_Gratuity'); ?>
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
            <input style="width: 68%; float: left; border-radius: 0px;" name="name" id="name" type="text" value="<?php echo $row['name']; ?>" placeholder="Please Enter Name of The Govt. Servent"><?php echo form_error('name', '<div class="error">', '</div>'); ?>
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
                <?php $religion = array('Hindu', 'Muslim', 'Sikh', 'Christian', 'Buddhism', 'Donyi-Polo', 'Others'); ?>
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
            <input autocomplete="off" name="designation" id="designation" type="text" value="<?php echo $row['designation']; ?>">
            <?php $retire_age = getRetireAge($row['designation']); ?>
            <input type="hidden" name="retire_age" id="retire_age" value="<?php echo $retire_age; ?>" />
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label">Sub Designation <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <input  autocomplete="off" name="sub_designation" id="sub_designation" type="text" value="<?php echo $row['sub_designation']; ?>">
            
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
    
    <?php if($row['class_of_pension']=='Normal_Family_Pension' ){ ?>
            <div class="form-group input_fields_wrap">
                <nobr><label class="col-sm-3 control-label">Address after Retirement <span class="required-field">*</span> <button class="add_field_button btn btn-success" id="address_btn">Add</button></label></nobr>
                <?php 

                $check_address=explode('s:', $row['address_after_retirement']);

                if(!empty($check_address[1])){

                $address_after_retirement = unserialize($row['address_after_retirement']);

                if(is_array($address_after_retirement))
                {  

                foreach ($address_after_retirement as $key => $value) { ?>

                <div class="col-sm-6">
                    <textarea name="address_after_retirement[]" placeholder="Please enter Address after Retirement" rows="4" columns="40"><?php echo $value['address_after_retirement']; ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
                    <a href="#" style="margin-bottom:10px;" class="remove_field btn btn-danger">Remove</a>
                </div>

                <?php } } }else{  ?>

                <div class="col-sm-6">
                    <textarea name="address_after_retirement[]" placeholder="Please enter Address after Retirement" rows="4" columns="40"><?php echo $row['address_after_retirement']; ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
                </div>

            <?php } ?>
                
            </div>
        <?php } else { ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Address after Retirement <span class="required-field">*</span></label>
                <div class="col-sm-6">
                    <textarea name="address_after_retirement" placeholder="Please enter Address after Retirement" rows="4" columns="40"><?php echo $row['address_after_retirement']; ?></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
                </div>

                <!-- <input type="button" onclick="addInput()"/> -->
                <!-- <input type="button" onclick="textareaFunction()"/>
                <span id="response"></span> -->
            </div>

        <?php } ?>    
    
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
    <div class="form-group">
        <label class="col-sm-3 control-label">Blood Group </label>
        <div class="col-sm-6">
            <input name="blood_group" id="blood_group" type="text" value="<?php echo $row['blood_group']; ?>">
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
            <input  type="text" name="aryear" id="aryear" class="width50" value="<?php echo set_value('aryear'); ?>" placeholder="year"/>&nbsp;<input readonly type="text" name="armonth" id="armonth" class="width50" value="<?php echo set_value('armonth'); ?>" placeholder="month"/>&nbsp;<input readonly type="text" name="arday" id="arday" class="width50" value="<?php echo set_value('arday'); ?>" placeholder="day"/>
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
        <label class="col-sm-3 control-label">Weightage <span class="required-field">*</span></label>
        <div class="col-sm-6">
            <?php list($year, $month, $day) = explode("-", $row['weightage']); ?>
            <input required autocomplete="off" type="number" name="weightage_year" id="weightage_year" class="width50" value="<?php echo $year; ?>" placeholder="year" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="weightage_month" id="weightage_month" class="width50" value="<?php echo $month; ?>" placeholder="month" min="0"/>&nbsp;<input required autocomplete="off" type="number" name="weightage_day" id="weightage_day" class="width50" value="<?php echo $day; ?>" placeholder="day" min="0"/>
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
<div class="tab-pane" id="lapdetails">
    <div class="row-fluid sortable">
    <div class="span12">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">If Life time arrear Pension/Family is applicable » <small style="font-size:11px">&nbsp;</small></legend>
    <table width="100%">
        <tr>
    <td>
    <div class="form-group">
        <label class="col-sm-3 control-label">LAP From </label>
        <div class="col-sm-9">
            <input name="lapfrom" id="lapfrom" type="text" value="<?php echo $row['lap_from']; ?>" placeholder="yyyy-mm-dd">
        </div>
    </div>
    </td>
    <td>
    <div class="form-group">
        <label class="col-sm-3 control-label">LAP To </label>
        <div class="col-sm-9">
            <input name="lapto" id="lapto" type="text" value="<?php echo $row['lap_to']; ?>" placeholder="yyyy-mm-dd">
        </div>
    </div>
    </td>
    <td>
    <div class="form-group">
        <label class="col-sm-3 control-label">LAP Amount </label>
        <div class="col-sm-9">
            <input name="lapamount" id="lapamount" value="<?php echo $row['lap_amount']; ?>" type="text" placeholder="0">
        </div>
    </div>
    </td>
    </tr>
</table>
</div>
</div>
</div>

 <div class="tab-pane" id="family_details">
    <div class="row-fluid sortable">
        <div class="span12">
            <legend style="font-size:15px; color:#3b5999; font-weight:700">Family Information Panel » <small style="font-size:11px"> Use the below panel to enter basic information about family.</small></legend>

            <!-- <div class="form-group" style="min-height:60px;min-width: 220px;">
                <label class="col-sm-3 control-label">No. of wives is 2 or more than 2</label>
                <div class="col-sm-6">
                <input type="radio" name="more_wives" id="more_wives" value="1" <?php if($row['more_wives']=='1'){?>checked<?php } ?>>Yes
                <input type="radio" name="more_wives" id="more_wives" value="0"  <?php if($row['more_wives'] == '0') { ?>checked<?php } ?>>No
                </div>

            <label class="col-sm-3 control-label">Enter No. of wives</label>
            <div class="col-sm-6">
            <input autocomplete="off" name="no_of_wives" id="no_of_wives" type="text" value="<?php echo $row['no_of_wives']; ?>" placeholder="">
            </div>

            </div> -->

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
                                <?php $spouse_sal = array('mr'=>'Mr', 'mrs'=>'Mrs', 'miss'=>'Miss','Md'=>'Md'); ?>
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
                                <?php $relation = array('wife'=>'Wife', 'husband'=>'Husband', 'father'=>'Father', 'mother'=>'Mother', 'legal_guardian'=>'Legal Guardian', 'legal heir'=>'Legal heir'); ?>
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
                            <td><input type="button" name="cmdAddRow" value="Add Child/Legal Guardian" class="addChild" id="addParentChild-<?php echo $count; ?>"></td>
                        </tr>
                        <?php
                            if(count($value['child']) != '0') {
                                $marital_status = ['married'=>'Married', 'unmarried'=>'Unmarried', 'divorcee'=>'Divorcee', 'widow'=>'Widow','legal_guardian'=>'Legal Guardian'];
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
        <input type="hidden" name="six_pay_band" id="six_pay_band">
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
            <input type="radio" name="com_applied" id="com_applied" value="0"  <?php if($row['com_applied'] == '0') { ?>checked<?php } ?>>No &emsp;

            <input type="number" maxlength="2" name="com_per" value="<?php echo $row['com_per'] ?>" placeholder="Percentage of Commutation(if any)">
        </div>
    </div>

    <div class="form-group" style="min-height:60px;">
        <label class="col-sm-3 control-label">Uncheck this if not applicable.</label>
        <div class="col-sm-6">
            <input type="checkbox" name="dr" id="dr" value="yes" <?php if($row['dr']=='yes'){?>checked<?php } ?>> DR
            <input type="checkbox" name="ma" id="ma" value="yes"  <?php if($row['ma'] == 'yes') { ?>checked<?php } ?>> MA
        </div>
    </div>

    <div class="form-group" style="min-height:60px;min-width: 220px;">
        <label class="col-sm-3 control-label">Consolidated Pay</label>
        <div class="col-sm-6">
            <input type="radio" name="consolidated" id="consolidated" value="1" <?php if($row['consolidated']=='1'){?>checked<?php } ?>>Yes
            <input type="radio" name="consolidated" id="consolidated" value="0"  <?php 
            if($row['consolidated'] == '0') 
            { 
            ?>checked<?php 
            } 
            elseif($row['consolidated'] == NULL)
            {
            ?>checked<?php
            }
            ?>>No
        </div>

        <label class="col-sm-3 control-label">Date of Birth of son or daughter</label>
        <div class="col-sm-6">
              <input autocomplete="off" name="childDOB" id="childDOB" type="text" value="<?php //echo $row['childDOB']; 
              if($row['childDOB']== NULL)
                {echo '0000-00-00';}
              else
              {echo $row['childDOB'];}
              ?>" placeholder="">
        </div>

         <label class="col-sm-3 control-label">Date of marriage/ Date of employment of son or daughter</label>
        <div class="col-sm-6">
              <input autocomplete="off" name="child_Date_of_marriage_employment" id="child_Date_of_marriage_employment" type="text" value="<?php //echo $row['child_Date_of_marriage_employment']; 
              if($row['child_Date_of_marriage_employment']== NULL)
                {echo '0000-00-00';}
              else
              {echo $row['child_Date_of_marriage_employment'];}
              ?>" placeholder="">
        </div>
    </div>

    <div id="form_dis"></div>
    <div class="clear"></div>



</div>
<div class="clear"></div>
<div class="ais_details" style="margin-top: 20px;">

   
<legend>AIS Report Customization</legend>
<!--<div class="form-group-inside">-->
<div class="form-group" style="float:left; margin: 0px 20px;">
    <div class="col-sm-6">
        <label class="col-sm-3 control-label">Name of Pensioner</label>
        <input autocomplete="off" placeholder="Name of Pensioner"  type="text" name="ais_report_name" value="<?php if(!isset($row['name_ais'])):echo $row['name']; else: echo $row['name_ais']; endif; ?>">
        
    </div>
</div>

<div class="form-group" style="float:left; margin: 0px 20px;">
    <div class="col-sm-6">
        <label class="col-sm-3 control-label">Designation</label>
        <input autocomplete="off" placeholder="Designation"  type="text" name="ais_report_designation" value="<?php if(!isset($row['designation_ais'])):echo $row['designation_ais']; else: echo $row['designation']; endif; ?>">
        
    </div>
</div>

<div class="form-group" style="float:left; margin: 0px 20px;">
    <div class="col-sm-6">
        <label class="col-sm-3 control-label">Service Belong</label>
        <input autocomplete="off" placeholder="Service Belong"  type="text" name="ais_report_servicebelong" value="<?php if(!isset($row['department_ais'])):echo $row['department_ais']; else: echo $row['sub_designation']; endif; ?>">
       
    </div>
</div>

<div class="form-group" style="float:left; margin: 0px 20px;">
    <div class="col-sm-6">
        <label class="col-sm-3 control-label">Batch</label>
        <input autocomplete="off" placeholder="Batch"  type="text" name="ais_report_batch" value="<?php echo $row['batch_ais']; ?>">
        
    </div>
</div>
</div>


<div class="pay_details" id="7th1" style="margin-top: 20px;">

   
<legend>Pension Calculation</legend>
<!--<div class="form-group-inside">-->



    <h4>Before Increment</h4><hr style="margin: 0 0 15px 0;" />

     <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
    <label class="col-sm-3 control-label">Total</label>
    <input autocomplete="off" placeholder="Total Amont"  type="text" id="total_pres" name="total_pres" value="<?php echo $row['total_amount']; ?>">
    </div>
    </div>
    
     <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
    <label class="col-sm-3 control-label">Case/File No</label>
    <input autocomplete="off" placeholder="case no"  type="text" id="case_file_no" name="case_file_no" value="<?php echo $row['case_file_no']; ?>">
    </div></div>
    
    
         <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">PPO No</label>
    <input autocomplete="off" placeholder="ppo no"  type="text" id="ppo_file_no" name="ppo_file_no" value="<?php echo $row['ppo_no']; ?>">
    <input type="hidden" id="ppo_file_no_hidden" name="ppo_file_no_hidden" value="<?php echo $row['ppo_no']; ?>"> <!-- Dani Rika 11'Dec 2018-->
    </div>
    </div>

    <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
            <label class="col-sm-3 control-label">PPO No (In AIS Case)</label>
    <input autocomplete="off" placeholder="ppo no"  type="text" id="ppo_file_no_ais" name="ppo_file_no_ais" value="<?php echo $row['ppo_ais']; ?>">
        </div>
    </div>
<!--</div>-->
 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
    <label class="col-sm-3 control-label">GPO No</label>
    <input autocomplete="off" placeholder="gpo no"  type="text" id="gpo_file_no" name="gpo_file_no" value="<?php echo $row['gpo_no']; ?>">
</div>
</div>

 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
    <label class="col-sm-3 control-label">CPO No</label>
    <input autocomplete="off" placeholder="cpo no"  type="text" id="cpo_file_no" name="cpo_file_no" value="<?php echo $row['cpo_no']; ?>">
</div></div>


 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
    <label class="col-sm-3 control-label">Before Increment Value(Family Pension)</label>
    <input autocomplete="off" placeholder="before increament amount"  type="text" id="bf_increamnet" name="bf_increamnet" value="<?php echo $row['bf_increamnet']; ?>">
    </div></div>
<!--</div>-->



<div id="scale_seven" style="margin-left:0px;"> 
 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
<label>Pay Level <span class="required-field">*</span></label>

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
    <option value="11ugc">Level-11-UGC</option>
    <option value="12">Level-12</option>
    <option value="13">Level-13</option>
    <option value="13a">Level-13a</option>
    <option value="13augc">Level-13augc</option>
    <option value="14">Level-14</option>
    <option value="15">Level-15</option>
    <option value="16">Level-16</option>
    <option value="17">Level-17</option>
    <option value="18">Level-18</option>

</select>
</div></div>

 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
<label class="col-sm-3 control-label"> <input id="clp" style="border: none; font: 10px; padding: 0; height: 12px; color: red;" value="0"></label>
<select name="sc_seven" id="sc_seven">
    <option value="0">--SELECT--</option>
    
</select>
</div></div>



 <div class="form-group" style="left; margin: 0px 20px;">
        <div class="col-sm-6">
 <label class="col-sm-3 control-label">Non Practising Allowance</label><!--onblur="calculateRevised()"-->
    <input autocomplete="off" placeholder="Non Practising Allowance"  type="text" id="npa" name="npa" value="<?php echo $row['npa']; ?>"  class="npa">
</div></div>
</div>

</div>
<!-- seven pay-->

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
<?php
$query=$this->db->query("select * from increment_detail where case_no='$case'");
$result=$query->result();
?>

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
                    <?php 
                    $xx=10;
                    foreach ($result as $r) {?>
                        <tr id="parent-1" class="parent">
                        <td><input class="dod form-control fdate" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="<?php echo $r->from_date;?>" id="fidate_<?php echo $xx;?>">
                          <label style="font-size:12px; color:red"></label>                      </td>
                        <td><input class="dod form-control tdate" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="<?php echo $r->to_date;?>" id="toidate_<?php echo $xx;?>">
                        <label style="font-size:12px; color:red"></label></td>
                        <td><input  class=" form-control rate_amt" name="irate[]" placeholder="Rate" size="16" type="text" value="<?php echo $r->rate_of_pay;?>" id="irate_<?php echo $xx;?>">
                        <label style="font-size:12px; color:red"></label></td>
                        <td><input  class=" form-control item_amt" name="iamount[]" placeholder="Amount" size="16" type="text" value="<?php echo $r->amount;?>" id="iamount_<?php echo $xx;?>">
                        <label style="font-size:12px; color:red"></label></td>
                    </tr> <?php  $xx=$xx+1; }

                    for($ctr=2;$ctr<=5;$ctr++){
                    ?>
                    <tr class="parent">
                      <td><input class="dod form-control fdate" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate_<?php echo $ctr; ?>"></td>
                      <td><input class="dod form-control tdate" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate_<?php echo $ctr; ?>"></td>
                      <td><input  class=" form-control rate_amt" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate_<?php echo $ctr; ?>"></td>
                      <td><input  class=" form-control item_amt" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount_<?php echo $ctr; ?>"></td>
                    </tr>
                <?php } ?>
                   <!--  <tr class="parent">
                     <td><input class="dod form-control fdate" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate3[]"></td>
                     <td><input class="dod form-control tdate" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate3[]"></td>
                     <td><input  class=" form-control rate_amt" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                     <td><input  class=" form-control item_amt" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                   </tr>
                   <tr class="parent">
                     <td><input class="dod form-control fdate" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate4[]"></td>
                     <td><input class="dod form-control tdate" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate4[]"></td>
                     <td><input  class=" form-control rate_amt" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                     <td><input  class=" form-control item_amt" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                   </tr>
                   <tr class="parent">
                     <td><input class="dod form-control fdate" name="fidate[]" placeholder="From Increment Date" size="16" type="text" value="" id="fidate5[]"></td>
                     <td><input class="dod form-control tdate" name="toidate[]" placeholder="To Increment Date" size="16" type="text" value="" id="toidate5[]"></td>
                     <td><input  class=" form-control rate_amt" name="irate[]" placeholder="Rate" size="16" type="text" value="" id="irate[]"></td>
                     <td><input  class=" form-control item_amt" name="iamount[]" placeholder="Amount" size="16" type="text" value="" id="iamount[]"></td>
                   </tr> -->
                    
                </tbody>
            </table>


<?php 
                $temp_result=getRecordsByTableID('pensioner_pay_details','case_file_no',$case);
                $list_items=unserialize($temp_result[0]["pay_info"]);
                                ?>

<div class="tab-pane" id="treausry_details">
    <legend style="font-size:15px; color:#3b5999; font-weight:700">Treasury/<?php echo $list_items[0]["post_DA"]; ?>AG Office/Bank Details Information Panel » <small style="font-size:11px"> Use the below panel to enter relevant details.</small></legend>
    <div class="form-group full-form-group">
        <label class="col-sm-3">Name of Accountant General: </label>
        <div class="col-sm-12"><strong><span style="color: red;"><?php echo $pensioner->getAG_Name(($row['name_of_ag'])); ?></span></strong></div>

        <!-- <input type="hidden" name="name_of_ag" value="$row['name_of_ag']"> -->
    </div>
    <div class="form-group full-form-group">
    <label class="col-sm-3">&nbsp;</label>    
        <div class="col-sm-12">
            <?php if($row['class_of_pension']=="Normal_Family_Pension"  ) { ?>
            <select name="name_of_accountant_general[]" multiple="true">
                <option value="">Select</option>
                <?php foreach (getAllAccountantGeneral() as $ag) { ?>

                    <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name']; ?></option>
                        
                <?php } ?>
            </select>

        <?php } else { ?>

            <select name="name_of_accountant_general" id="name_of_accountant_general" <?php if($row['treasury_officer'] != NULL) { ?> disabled="disabled"<?php } ?>>
                <option value="">Select</option>
                <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                    <?php if($ag['id'] == $row['name_of_accountant_general']) { ?>
                        <option value="<?php echo $ag['id']; ?>" selected><?php echo $ag['name']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>

        <?php } ?>    


            &nbsp;<a href="#addAccountantGeneral" id="addAccountantGeneralModal" class="btn btn-success" data-toggle="modal">+</a><?php echo form_error('name_of_accountant_general', '<div class="error">', '</div>'); ?>
        </div>
    </div>

    <?php if($row['class_of_pension']=='Normal_Family_Pension' ){ ?>

    <div class="form-group input_fields_wrap_subto full-form-group">
        <nobr><label class="col-sm-3 control-label">TO/ Sub TO(Outside)
        <button class="add_field_button_subto btn btn-success" id="sub_to_btn">Add</button></label></nobr>
                <?php 

                $check_sub_to=explode('s:', $row['sub_to']);

                if(!empty($check_sub_to[1])){

                $sub_to = unserialize($row['sub_to']);

                if(is_array($sub_to))
                {  

                foreach ($sub_to as $key => $value) { ?>
                <div class="col-sm-6">
                    <input name="sub_to[]" id="sub_to" type="text" value="<?php echo $value['sub_to']; ?>" <?php if($row['treasury_officer'] != NULL) { ?>disabled="disabled"<?php } ?>><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
                    <a href="#" style="margin-bottom:10px;" class="remove_field_subto btn btn-danger">Remove</a>
                </div>
                <?php } } }else{  ?>

                <div class="col-sm-6">
                    <input name="sub_to[]" id="sub_to" type="text" value="<?php echo $row['sub_to']; ?>" <?php if($row['treasury_officer'] != NULL) { ?>disabled="disabled"<?php } ?>><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
                </div>
            <?php } ?>        
    </div>

    <?php } else{ ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">TO/ Sub TO(Outside)</label>
            <div class="col-sm-6">
                <input name="sub_to" id="sub_to" type="text" value="<?php echo $row['sub_to']; ?>" <?php if($row['treasury_officer'] != NULL) { ?>disabled="disabled"<?php } ?>><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
            </div>
        </div>
    <?php } ?>    

        <div class="form-group full-form-group">
            <label class="col-sm-3">Treasury/ Sub Treasury Officer(Inside): </label>
            <div class="col-sm-12"><strong><span style="color: red;"><?php echo $pensioner->getTreasury_Name(($row['name_of_treasury'])); ?></span></strong></div>
        </div>
    <div class="form-group full-form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-12">

            <?php if($row['class_of_pension']=="Normal_Family_Pension" ) { ?>
            <select name="treasury_officer[]" multiple="true">
                <option value="">Select</option>

                <?php foreach (getAllTreasury() as $treasury) { ?>

                    <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                        
                <?php } ?>
            </select>

        <?php } else { ?>


            <select name="treasury_officer" id="treasury_officer" <?php if($row['name_of_accountant_general'] != NULL) { ?>disabled="disabled"<?php } ?>>
                <option value="">Select</option>
                <?php foreach (getAllTreasury() as $treasury) { ?>
                    <?php if($treasury['id'] == $row['treasury_officer']) { ?>
                        <option value="<?php echo $treasury['id']; ?>" selected><?php echo $treasury['title']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                    <?php } ?>
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
            tot = 0;
            $.each($('.pre_xx'), function() {
                tot += parseFloat($(this).val()) || 0;
            });
            
            npa = $('#npa').val() || 0 ;
            tot_npa=(tot/100*npa);
            
            tot1 =  $("#total_pres").val() || 0;
            final_tot = 0;
            //final_tot = (parseInt(tot)*parseInt(npa)/100)+parseInt(tot);
            final_tot = parseInt(tot_npa)+parseInt(tot1);
            $("#total_pres").val(Math.round(final_tot));
            delete npa;
            delete tot;
            delete tot1;
            delete final_tot;
          });  

    $("#pay_commission").change(function(){
            alert($(this).val());
            $("#chpaycom").val($(this).val());
          });
        

    //seven pay



    $(function() {
        $("#cash_received, #dod,#lapfrom,#lapto").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        
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

            weightage_year   = $('#weightage_year').val() || 0;
            weightage_month  = $('#weightage_month').val() || 0;
            weightage_day    = $('#weightage_day').val() || 0;

            total_service1 = total_service.split(" ");
            total_service2 = moment().add(parseInt(total_service1[0])+parseInt(weightage_year), 'years').add(parseInt(total_service1[2])+parseInt(weightage_month), 'months').add(parseInt(total_service1[4])+parseInt(weightage_day), 'days');
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

        $('#weightage_year, #weightage_month, #weightage_day').blur(function(){
            if($('.form-group-dojac').hasClass('show')) {
                var total_service = $('#total_service_from_casual_date').val()
            } else {
                var total_service = $('#total_service').val();
            }

            //------------------------------
            /*weightage_year   = $('#weightage_year').val() || 0;
            weightage_month  = $('#weightage_month').val() || 0;
            weightage_day    = $('#weightage_day').val() || 0;

            total_service1 = total_service.split(" ");

            year=parseInt(total_service1[0])+parseInt(weightage_year);
            month=parseInt(total_service1[2])+parseInt(weightage_month);
            day=parseInt(total_service1[4])+parseInt(weightage_day);
            
            $('#netqsyear').val(year);
            $('#netqsmonth').val(month);
            $('#netqsday').val(day);*/
            //---------------------------

            nonqsyear   = $('#nonqsyear').val() || 0;
            nonqsmonth  = $('#nonqsmonth').val() || 0;
            nonqsday    = $('#nonqsday').val() || 0;

            weightage_year   = $('#weightage_year').val() || 0;
            weightage_month  = $('#weightage_month').val() || 0;
            weightage_day    = $('#weightage_day').val() || 0;

            total_service1 = total_service.split(" ");
            total_service2 = moment().add(parseInt(total_service1[0])+parseInt(weightage_year), 'years').add(parseInt(total_service1[2])+parseInt(weightage_month), 'months').add(parseInt(total_service1[4])+parseInt(weightage_day), 'days');
            nonqs = moment().add(nonqsyear, "years").add(nonqsmonth, "months").add(nonqsday, "days");
            var result = dateDiff(nonqs, total_service2, 'false', 'true');
            $('#netqsyear').val(result.year);
            $('#netqsmonth').val(result.month);
            $('#netqsday').val(result.day);
            
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

     var x=$("#pay-commission").val();
               if(x==7){

                    $("#7th").show();
               } 
               else
               {
                    $("#7th").hide();
               }
    
    
        onPayCommissionLoad();
        getPensionCalc();
        $('#pay-commission').on('change', function() {
        
         var x=$("#pay-commission").val();
               if(x==7){

                    $("#7th").show();
               } 
               else
               {
                    $("#7th").hide();
               }
               
            onPayCommissionChange('<?php echo site_url("RestService/getPreRevisedPayScale/"); ?>');
            getPensionCalc();
        });

        $('#earn_leave').val('<?php echo $pay_info[3]["earn_leave"]; ?>');
        $('#half_pay').val('<?php echo $pay_info[4]["half_pay"]; ?>');
    });

    $("#pay_scale").change(function(){
            
            $("#six_pay_band").val($(this).val());
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
            url: '<?php echo site_url("administrator/service_book"); ?>/pre_revised_edit?id='+x+'&fileno=<?php echo $case; ?>',
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
                        /*var selected_before_da='';
        var selected_after_da='';*/
                            /*$('#pre_da option:contains("<?php echo $list_items[1]["increament_DA"]; ?>")').prop('selected', true);
                            $('#post_da option:contains("<?php echo $list_items[0]["post_DA"]; ?>")').prop('selected', true);*/
                            $("#pre_da").val(<?php echo $list_items[1]["increament_DA"]; ?>);
                            $("#post_da").val(<?php echo $list_items[0]["post_DA"]; ?>);
                        <?php else : ?>
                            <?php $pre = $value-$increment; ?>
                            <?php $pre = ($pre == '') ? 0 : $pre; ?>
                            $('input[name="<?php echo "pre_".$pay_type; ?>"]').val('<?php echo $pre; ?>');
                            $('input[name="<?php echo $key; ?>"]').val('<?php echo $value; ?>');
                        <?php endif; ?>
                <?php } ?>
                
                $('#last_increament_date').val('<?php echo $pay_info[2]["last_increament_date"]; ?>');

                // var pre_sum = 0;
                // var pre_da = $('#pre_da').val() || 0;
                // for(var i=0; i<$('.pre_xx').length; i++) {
                //     pre_sum+=parseInt($('.pre_xx:eq('+i+')').val()) || 0;
                //     //pre_sum = pre_sum+parseInt($('.pre_xx:eq('+i+')').val());
                // }
                // pre_sum=(pre_sum*parseInt(pre_da)/100)+pre_sum;
                // $('#total_pre').val(parseInt(pre_sum));
                // var post_sum = 0;
                // var post_da = $('#post_da').val() || 0;
                // for(var j=0; j<$('.rev_xx').length; j++) {
                //     post_sum+=parseInt($('.rev_xx:eq('+j+')').val()) || 0;
                // }
                // post_sum=(post_sum*parseInt(post_da)/100)+post_sum;
                // $('#total_rev').val(post_sum);


                da  = $('#pre_da').val() || 0;
                tot = 0;
                final_tot = 0;
                $.each($('.pre_xx'), function() {
                    tot += parseFloat($(this).val()) || 0;
                });
                var npa=$('.pre_yy').val();
                tot=parseInt(tot+(tot/100*npa));
                final_tot = (tot*parseInt(da)/100)+tot;
                $("#total_pre").val(Math.round(final_tot));
                delete da;
                delete tot;
                delete final_tot;

                da = $('#post_da').val() || 0;
                tot = 0;
                final_tot = 0;
                $.each($('.rev_xx'), function() {
                    tot += parseFloat($(this).val()) || 0;
                });
                var npa=$('.rev_yy').val();
                tot=parseInt(tot+(tot/100*npa));
                final_tot = (tot*parseInt(da)/100)+tot;
                $("#total_rev").val(Math.round(final_tot));
                delete da;
                delete tot;
                delete final_tot;

                 var gpv=$('input[name="pre_GP"]').val();
                 var bpv=$('input[name="pre_BP"]').val();

                 gpv=parseInt(gpv);
                 bpv=parseInt(bpv);

                 var lpv=parseInt((gpv+bpv)*2.57);

                 $('#clp').val('Calculated Last Pay is: '+lpv);
                 
            },
            complete(res){
               
            }
        });
    }

    var countBox =1;
    var boxName = 0;
    function addInput()
    {
         var boxName="textarea"+countBox; 
    document.getElementById('response').innerHTML+='<br/><input type="textarea" id="'+boxName+'" value="'+boxName+'" "  /><br/>';
         countBox += 1;
    }
    
    var i = 0; /* Set Global Variable i */
    function increment(){
    i += 1; /* Function for automatic increment of field's "Name" attribute. */
    }

    function textareaFunction(){
    var r = document.createElement('span');
    var y = document.createElement("TEXTAREA");
    var g = document.createElement("IMG");
    y.setAttribute("cols", "17");
    y.setAttribute("placeholder", "message..");
    g.setAttribute("src", "delete.png");
    increment();
    y.setAttribute("Name", "textelement_" + i);
    r.appendChild(y);
    g.setAttribute("onclick", "removeElement('myForm','id_" + i + "')");
    r.appendChild(g);
    r.setAttribute("id", "id_" + i);
    document.getElementById("response").appendChild(r);
    }

    /* Dani Rika, 11'Dec 2018 */
    var dojap = document.getElementById('dojap');
    if(dojap.value >= '2008-01-01') {
        var ppoNumber = document.getElementById('ppo_file_no');
        ppoNumber.value = 0;
    } 
    /*  Dani Rika, 11'Dec 2018 */
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
                    $(wrapper).append('<div><textarea placeholder="Please enter Address after Retirement" rows="4" columns="40" name="address_after_retirement[]"/><a href="#" style="margin-bottom:10px;" class="remove_field btn btn-danger">Remove</a></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })


            var max_fields_subto      = 10; //maximum input boxes allowed
            var wrapper_sub         = $(".input_fields_wrap_subto"); //Fields wrapper
            var add_button_sub      = $(".add_field_button_subto"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button_sub).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields_subto){ //max input box allowed
                    x++; //text box increment
                    $(wrapper_sub).append('<div><input type="text" placeholder="TO/ Sub TO(Outside)" rows="4" columns="40" name="sub_to[]"/><a href="#" style="margin-bottom:10px;" class="remove_field_subto btn btn-danger"> Remove</a></div>'); //add input box
                }
            });

            $(wrapper_sub).on("click",".remove_field_subto", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });


        //08-01-2020---------------------
        $(document).on("change",".tdate",function(){
            var key=$(this).attr("id").split("_");
            var to_date=$("#toidate_"+key[1]).val().split("-");
            var month_stat=1;


            var start = moment($("#fidate_"+key[1]).val(), "YYYY-MM-DD");
            var end = moment($("#toidate_"+key[1]).val(), "YYYY-MM-DD");
            var days = end.diff(start, 'month');

            days+=1;
            var months = end.diff(start, 'month');
            months=parseInt(months)+1;

            if(to_date[2]){
                if(parseInt(to_date[2])<15){
                months=parseInt(months)-1;                    
                }
            }

            console.log(months);

            var rate=(isNaN($("#irate_"+key[1]).val()) || $("#irate_"+key[1]).val()=="") ? 0 : $("#irate_"+key[1]).val();
            $("#iamount_"+key[1]).val(Math.round(parseInt(rate)*parseInt(months)));
        });

        $(document).on("blur",".rate_amt",function(){
            var key=$(this).attr("id").split("_");
            $("#toidate_"+key[1]).trigger("change");
        });

        $(document).on("change",".fdate",function(){
            var key=$(this).attr("id").split("_");
            $("#toidate_"+key[1]).trigger("change");
        });

        $(document).on("change","#pre_da",function(){
            $("#post_da").val($(this).val());
        });

        $(document).on("change","#post_da",function(){
            $("#pre_da").val($(this).val());
        });

        $(document).ready(function(){
            $("#address_btn").hide();
            $("#sub_to_btn").hide();

            var two_more_wives = $('#two_more_wives');
            $(two_more_wives).click(function(e){
                
            var class_of_pension=$("#class_of_pension").val();    
                if(class_of_pension=="Normal_Family_Pension"){
                    $("#address_btn").show();
                    $("#sub_to_btn").show();
                    /*$("#single_address").hide();
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
                    $("#treasury_multiple").prop("disabled", false);*/

                }
                
            });


            var two_more_wives_hide = $('#two_more_wives_hide');
            $(two_more_wives_hide).click(function(e){


                    /*$("#single_address").show();
                    $("#single_address").prop("disabled", false);*/
                    $("#address_btn").hide();
                    $("#sub_to_btn").hide();
                    /*$("#multiple_address").prop("disabled", true);
                    $("#multiple_address").hide();*/


                    /*$("#name_of_accountant_general").show();
                    $("#name_of_accountant_general").prop("disabled", false);
                    $("#ag_multiple").hide();
                    $("#ag_multiple").prop("disabled", true);*/


                    /*$("#sub_to_single").show();
                    $("#sub_to_single").prop("disabled", false);*/
                    
                    /*$("#sub_to_multiple").hide();
                    $("#sub_to_multiple").prop("disabled", true);*/


                    /*$("#treasury_officer").show();
                    $("#treasury_officer").prop("disabled", false);
                    $("#treasury_multiple").hide();
                    $("#treasury_multiple").prop("disabled", true);*/



            });
        });
    </script>
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>

