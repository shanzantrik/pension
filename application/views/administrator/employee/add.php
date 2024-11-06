<script src="<?php echo base_url('includes/js/jQuery-validate/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('includes/js/jQuery-validate/additional-methods.js'); ?>"></script>
<script src="<?php echo base_url('includes/js/bootstrap.file-input.js'); ?>"></script>
<form name="add_employee_form" id="add_employee_form" enctype="multipart/form-data" method="post" action="<?php echo site_url('administrator/employee/add'); ?>">
    <div class="tab-pane active" id="employee_details">
        <legend style="font-size:15px; color:#3b5999; font-weight:700">Employee Details Panel » <small style="font-size:11px"> Please enter employee information.</small></legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="Please Enter Employee Name">
                <?php echo form_error('name', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of Father/Husband</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="fhname" id="fhname" value="<?php echo set_value('fhname'); ?>">
                <?php echo form_error('fhname', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>
            <div class="col-sm-6">
                <select id="bc" required="required" class="form-control parsley-validated parsley-success" name="branch_code">
                    <option value="">--Please Select--</option>
                    <?php foreach (getAllDepartment() as $dept) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department Address</label>
            <div class="col-sm-6">
                <textarea placeholder="Address of the Department" class="form-control" id="address_department" name="address_department"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Designation</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="designation" id="designation" type="text">
                <?php echo form_error('designation', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dob" id="dob" value="<?php echo set_value('dob'); ?>" type="text" placeholder="Please Enter Date of Birth">
                <?php echo form_error('dob', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Joining</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="doj" id="doj" value="<?php echo set_value('doj'); ?>" type="text" placeholder="Appointment as permanent">
                <?php echo form_error('doj', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Retirement</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dor" id="dor" value="<?php echo set_value('dor'); ?>" type="text" placeholder="Please Enter Date of Retirement">
                <?php echo form_error('dor', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group" style="min-height: 54px;">
            <label class="col-sm-3 control-label">Sex</label>
            <div class="col-sm-6">
                <input type="radio" name="sex" class="sex" value="M">Male <input type="radio" name="sex" class="sex" value="F">Female
                <div id="error-label-for-sex"></div>
                <?php echo form_error('sex', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <?php $category = array('A', 'B', 'C'); ?>
                <select name="category" id="category" class="multiselect">
                    <option value="0">Select</option>
                    <?php foreach ($category as $value) {
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    } ?>
                </select>
                <?php echo form_error('category', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Appoint as</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="appointas" id="appointas" type="text">
                <!-- <select class="appointas" name="appointas">
                    <option value="0">Select</option>
                    <option value="Temporary">Temporary</option>
                    <option value="Permanent">Permanent</option>
                </select> -->
                <?php echo form_error('appointas', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pay Band</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="pay_band" value="<?php echo set_value('pay_band'); ?>">
                <?php echo form_error('pay_band', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Grade Pay</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="grade_pay" value="<?php echo set_value('grade_pay'); ?>">
                <?php echo form_error('grade_pay', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Increament Amount</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="increament_amount" value="<?php echo set_value('increament_amount'); ?>">
                <?php echo form_error('increament_amount', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total Pay</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_pay" value="<?php echo set_value('total_pay'); ?>">
                <?php echo form_error('total_pay', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">SCA</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="sca" value="<?php echo set_value('sca'); ?>">
                <?php echo form_error('sca', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Other allowance</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="other_allowance" value="<?php echo set_value('other_allowance'); ?>">
                <?php echo form_error('other_allowance', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">DA</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="da" value="<?php echo set_value('da'); ?>">
                <?php echo form_error('da', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total allowance</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_allowance" value="<?php echo set_value('total_allowance'); ?>">
                <?php echo form_error('total_allowance', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total emolument</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_emolument" value="<?php echo set_value('total_emolument'); ?>">
                <?php echo form_error('total_emolument', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Account no</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="account_no" value="<?php echo set_value('account_no'); ?>">
                <?php echo form_error('account_no', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Bank Name</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="bank_name" value="<?php echo set_value('bank_name'); ?>">
                <?php echo form_error('bank_name', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Branch</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="branch" value="<?php echo set_value('branch'); ?>">
                <?php echo form_error('branch', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of DDO with address</label>
            <div class="col-sm-6">
                <textarea name="ddo_address"><?php echo set_value('ddo_address'); ?></textarea>
                <?php echo form_error('ddo_address', '<label class="error">', '</label>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Photograph</label>
            <div class="col-sm-6">
                <output id="list"></output>
                <a class="file-input-wrapper btn btn-default ">
                    <span>Browse</span>
                    <input type="file" name="photograph" id="photograph" style="left: -155.9375px; top: 3px;">
                </a>
                <div id="error-label"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Remarks</label>
            <div class="col-sm-6">
                <textarea name="remarks"></textarea>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <input type="submit" name="add_employee" class="btn btn-success" style="margin-top: 10px;" value="ADD Employee">
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        $('#doj').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        $('#dor').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50'});

        $("#add_employee_form").validate({
            rules: {name: "required", fhname: "required", branch_code: "required", designation: {selectcheck: true}, dob: {required: true, dateISO: true}, doj: {required: true, dateISO: true}, dor: {required: true, dateISO: true}, sex: {required: true}, category: {selectcheck: true}, appointas: {selectcheck: true}, pay_band: {required: true, number: true, minlength: 3}, grade_pay: {required: true, number: true, minlength: 3}, increament_amount: {required: true, number: true, minlength: 3}, total_pay: {required: true, number: true, minlength: 3}, sca: {required: true, number: true, minlength: 3}, other_allowance: {required: true, number: true, minlength: 3}, da: {required: true, number: true, minlength: 3}, total_allowance: {required: true, number: true, minlength: 3}, total_emolument: {required: true, number: true, minlength: 3}, account_no: {required: true, digits: true, minlength: 10}, bank_name: {required: true}, branch: "required", ddo_address: "required", photograph: {required: true, extension: 'jpg|jpeg|png'}},
            messages: {dob: {dateISO: 'Date should be in this format 2012-06-23.'}, doj: {dateISO: 'Date should be in this format 2012-06-23.'}, dor: {dateISO: 'Date should be in this format 2012-06-23.'}, photograph: {extension: 'Please select jpg, jpeg, png or gif files.'}},
            invalidHandler: function(event, validator) {
                $('.form-group').css('height', '77px');
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "sex") {
                    error.insertAfter("#error-label-for-sex");
                } else if (element.attr("name") == "photograph") {
                    error.insertAfter("#error-label");
                } else {
                    error.insertAfter(element);
                }
            },
        });

        $("#bc").change(function(){
            var dept=$("#bc").val();
            $.ajax({
                url:"<?php echo site_url('administrator/receipt/get_address') ?>?dept="+dept,
                method:'GET',
                dataType:'JSON',
                success:function(data){
                    $("#address_department").val(data.address);
                }
            });
        });

        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        }, "Please select.");
    });

    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        var f = files[0];
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                '" title="', escape(theFile.name), '"/>'].join('');
                $('#list').html(span);
            };
        })(f);
        reader.readAsDataURL(f);
    }
    $('#photograph').live('change', function(e){
        handleFileSelect(e);
    })
    //document.getElementById('photograph').addEventListener('change', handleFileSelect, false);
</script>


<style type="text/css">
.form-group {
    width: 23%;
    float: left;
    margin-bottom: 9px;
}
#list .thumb{width: 60px;-webkit-border-radius: 5px 5px;-moz-border-radius: 5px / 5px;border-radius: 5px / 5px;}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {margin-bottom: 3px;}
</style>