<h1>Entry</h1>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#personal_details" data-toggle="tab"><b>Personal Details</b></a></li>
    <li><a href="#service_details" data-toggle="tab"><b>Service Details</b></a></li>
    <li><a href="#treausry_details" data-toggle="tab"><b>AG/ BANK/ TREASURY DETAILS</b></a></li>
</ul>

<form action="<?php echo site_url('administrator/receipt/new_form'); ?>" method="post">
<div class="tab-content">
    <!-- Personal Details -->
    <div class="tab-pane active" id="personal_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Case Received on</label>
            <div class="col-sm-6">
                <input type="text" name="cash_received" id="cash_received" placeholder="Please Enter Cash Received date" /><?php echo form_error('cash_received', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Class of Pension</label>
            <div class="col-sm-6">
                <select name="class_of_pension" id="class_of_pension" class="multiselect">
                    <option value="0" selected="">Select</option>
                    <optgroup label="Superannuation Pension">
                        <option value="Voluntary_Retirement_Pension">Voluntary Retirement</option>
                        <option value="Invalid_Retirement_Pension">Invalid Retirement Pension</option>
                        <option value="Absorption_in_autonomous_body_pension">Absorption in autonomus body pension</option>
                        <option value="Disability_Pension">Disability pension</option>
                    </optgroup>
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
                <input autocomplete="off" name="case_no" id="case_no" type="text" placeholder="Please Enter File No"><?php echo form_error('case_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Salutation</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="salutation" id="salutation" type="text" value="" placeholder="Please Enter Salutation"><?php echo form_error('salutation', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of The Govt. Servent</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="name" id="name" type="text" value="" placeholder="Please Enter Name of The Govt. Servent"><?php echo form_error('name', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dob" id="dob" type="text" placeholder="Please Enter Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?>
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
                <select name="designation" id="designation" class="multiselect">
                    <option value="0">Select</option>
                    <?php foreach (getAllDesignation() as $desg) { ?>
                        <option value="<?php echo $desg['desg_code']; ?>"><?php echo $desg['desg_name']; ?></option>
                    <?php } ?>
                </select><?php echo form_error('designation', '<div class="error">', '</div>'); ?>
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
    </div>
    <!-- Personal Details -->

    <!-- Service Details -->
    <div class="tab-pane" id="service_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Appointment</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="doj" id="doj" type="text" value="" placeholder="Please Enter Date of Appointment"><?php echo form_error('doj', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Age at Entry</label>
            <div class="col-sm-6">
                <input readonly type="text" id="aeyear" class="width50" placeholder="year"/>&nbsp;<input readonly type="text" id="aemonth" class="width50" placeholder="month"/>&nbsp;<input readonly type="text" id="aeday" class="width50" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Retirement/Death</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dor" id="dor" type="text" value="" placeholder="Please Enter Date of Retirement/Death"><?php echo form_error('dor', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Age at Retirement/Death</label>
            <div class="col-sm-6">
                <input readonly type="text" id="aryear" class="width50" placeholder="year"/>&nbsp;<input readonly type="text" id="armonth" class="width50" placeholder="month"/>&nbsp;<input readonly type="text" id="arday" class="width50" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total Service</label>
            <div class="col-sm-6">
                <input readonly name="total_service" id="total_service" type="text" value="" placeholder="Total Service">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Non Qualifying Service</label>
            <div class="col-sm-6">
                <input type="text" name="nonqsyear" id="nonqsyear" class="width50" placeholder="year"/>&nbsp;<input type="text" name="nonqsmonth" id="nonqsmonth" class="width50" placeholder="month"/>&nbsp;<input type="text" name="nonqsday" id="nonqsday" class="width50" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Net Qualifying Service</label>
            <div class="col-sm-6">
                <input readonly type="text" name="netqsyear" id="netqsyear" class="width50" placeholder="year"/>&nbsp;<input readonly type="text" name="netqsmonth" id="netqsmonth" class="width50" placeholder="month"/>&nbsp;<input readonly type="text" name="netqsday" id="netqsday" class="width50" placeholder="day"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">SMP</label>
            <div class="col-sm-6">
                <input name="smp" id="smp" type="text" value="" placeholder="SMP"><?php echo form_error('smp', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Office Address</label>
            <div class="col-sm-6">
                <textarea name="office_address" placeholder="Please enter Office Address"></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
            </div>
        </div>
    </div>
    <!-- Service Details -->

    <!-- Treausry Details -->
    <div class="tab-pane" id="treausry_details">
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Effect of Pension</label>
            <div class="col-sm-6">
                <input name="effect_of_pension" id="effect_of_pension" type="text"><?php echo form_error('effect_of_pension', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of Accountant General</label>
            <div class="col-sm-6">
                <select name="name_of_accountant_general" id="name_of_accountant_general" class="multiselect">
                    <option value="0">Select</option>
                    <option value="1">Demo</option>
                </select><!--&nbsp;<input type="button" value="+" class="open-dialog btn btn-success">--><?php echo form_error('name_of_accountant_general', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">TO/ Sub TO(Outside)</label>
            <div class="col-sm-6">
                <input name="sub_to" id="sub_to" type="text"><?php echo form_error('sub_to', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Treasury/ Sub Treasury Officer</label>
            <div class="col-sm-6">
                <select name="treasury_officer" id="treasury_officer" class="multiselect">
                    <option value="0">Select</option>
                    <option value="1">Demo</option>
                </select><!--&nbsp;<input type="button" value="+" class="open-dialog btn btn-success">--><?php echo form_error('treasury_officer', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name Bank</label>
            <div class="col-sm-6">
                <input name="bank_name" id="bank_name" type="text"><?php echo form_error('bank_name', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Account No.</label>
            <div class="col-sm-6">
                <input name="account_no" id="account_no" type="text"><?php echo form_error('account_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Address after Retirement</label>
            <div class="col-sm-6">
                <textarea name="address_after_retirement" placeholder="Please enter Address after Retirement" style="height: 60px;"></textarea><?php echo form_error('address_after_retirement', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">State - PIN</label>
            <div class="col-sm-6">
                <input name="pin" id="pin" type="text"><?php echo form_error('pin', '<div class="error">', '</div>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Cell Phone No. Incl(+91)</label>
            <div class="col-sm-6">
                <input name="phone_no" id="phone_no" type="text"><?php echo form_error('phone_no', '<div class="error">', '</div>'); ?>
            </div>
        </div>
    </div>
    <!-- Treausry Details -->
</div>
<input type="submit" name="submit" value="Save" class="btn btn-primary" />
</form>
<style type="text/css">
    .form-group {float: left;width: 50%;margin-bottom: 10px;}
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
</style>
<?php if(validation_errors() != false) { echo '<style type="text/css">.form-group{min-height: 60px;margin-bottom: 0px;}</style>'; } ?>
<script type="text/javascript">
    $(function() {
        $("#cash_received, #dob, #effect_of_pension").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        $("#doj").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
            $.post("<?php echo site_url('administrator/receipt/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
               var result = JSON.parse(data);
               $('#aeyear').val(result.year);
               $('#aemonth').val(result.month);
               $('#aeday').val(result.day);
            });
        }});
        $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
            $.post("<?php echo site_url('administrator/receipt/calculateDateDifference'); ?>", {date1: $(this).val(), date2: $('#dob').val(), jsonData: "true"}, function(data) {
               var result = JSON.parse(data);
               $('#aryear').val(result.year);
               $('#armonth').val(result.month);
               $('#arday').val(result.day);
            });
            $.post("<?php echo site_url('administrator/receipt/calculateDateDifference'); ?>", {date1: $('#dor').val(), date2: $('#doj').val(), jsonData: "false"}, function(data) {
               $('#total_service').val(data);
            });
        }});
        $('#nonqsday').blur(function(){
            var total_service = $('#total_service').val();
            var nonqs = $('#nonqsyear').val()+" years "+$('#nonqsmonth').val()+" months "+$('#nonqsday').val()+" days";
            $.post("<?php echo site_url('administrator/receipt/calculateNetQualifyingService'); ?>", {total_service: total_service, nonqs: nonqs}, function(data) {
                console.log(data);
                var result = JSON.parse(data);
                $('#netqsyear').val(result.year);
                $('#netqsmonth').val(result.month);
                $('#netqsday').val(result.day);

                var total = result.year*2;
                if(result.month > 3 && result.month <= 8) {
                    console.log('add 1');
                    total+=1;
                } else if (result.month >= 9) {
                    console.log('add 2');
                    total+=2;
                } else {}
                $('#smp').val(total);
            });
        });
    });
</script>