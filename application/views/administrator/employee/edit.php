<?php $row = $lists[0]; ?>
<script src="<?php echo base_url('includes/js/jQuery-validate/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('includes/js/jQuery-validate/additional-methods.js'); ?>"></script>
<script src="<?php echo base_url('includes/js/bootstrap.file-input.js'); ?>"></script>
<form name="edit_employee_form" id="edit_employee_form" enctype="multipart/form-data" method="post" action="<?php echo site_url('administrator/employee/edit/'.$row['id']); ?>">
    <div class="tab-pane active" id="employee_details">
        <legend style="font-size:15px; color:#3b5999; font-weight:700">Employee Details Panel » <small style="font-size:11px"> Please enter employee information.</small></legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of Father/Husband</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="fhname" id="fhname" value="<?php echo $row['fhname']; ?>">
                <input autocomplete="off" type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>
            <div class="col-sm-6">
                <select id="bc" required="required" class="form-control" name="branch_code">
                    <option value="">--Please Select--</option>
                    <?php foreach (getAllDepartment() as $dept) { ?>
                        <?php if($dept['dept_code'] == $row['dep']) { ?>
                            <option value="<?php echo $dept['dept_code']; ?>" selected><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>';
                        <?php } else { ?>
                            <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>';
                        <?php } ?>
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
                <input autocomplete="off" name="designation" id="designation" type="text" value="<?php echo $row['designation']; ?>">
                <!-- <select class="form-control" name="designation">
                    <option value="0">--Select Designation--</option>
                    <?php foreach (getAllDesignation() as $desg) { ?>
                        <?php if($row['designation'] == $desg['desg_code']) { ?>
                            <option value="<?php echo $desg['desg_code']; ?>" selected><?php echo $desg['desg_name']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $desg['desg_code']; ?>"><?php echo $desg['desg_name']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dob" id="dob" type="text" value="<?php echo dateTimeToDate($row['dob']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Joining</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="doj" id="doj" type="text" value="<?php echo dateTimeToDate($row['doj']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Retirement</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="dor" id="dor" type="text" value="<?php echo dateTimeToDate($row['dor']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sex</label>
            <div class="col-sm-6">
                <input type="radio" name="sex" class="sex" value="M" <?php if($row['sex']=="M") { ?>checked<?php } ?>>Male <input type="radio" name="sex" class="sex" value="F" <?php if($row['sex']=="F") { ?>checked<?php } ?>>Female
                <div id="error-label-for-sex"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <?php $category = array('A', 'B', 'C'); ?>
                <select name="category" id="category" class="multiselect">
                    <option value="0">Select</option>
                    <?php foreach ($category as $value) { ?>
                        <?php if($row['category'] == $value) {
                            echo '<option value="'.$value.'" selected>'.$value.'</option>';
                        } else {
                            echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Appoint as</label>
            <div class="col-sm-6">
                <input autocomplete="off" name="appointas" id="appointas" type="text" value="<?php echo $row['appoint_as']; ?>">
                <?php //$appointas = array('Temporary', 'Permanent'); ?>
                <!-- <select class="appointas" name="appointas">
                    <option value="0">Select</option>
                    <?php foreach ($appointas as $value) { ?>
                        <?php if($row['appoint_as'] == $value) {
                            echo '<option value="'.$value.'" selected>'.$value.'</option>';
                        } else {
                            echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                    } ?>
                </select> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pay Band</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="pay_band" value="<?php echo $row['pay_band']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Grade Pay</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="grade_pay" value="<?php echo $row['grade_pay']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Increament Amount</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="increament_amount" value="<?php echo $row['increament_amount']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total Pay</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_pay" value="<?php echo $row['total_pay']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">SCA</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="sca" value="<?php echo $row['sca']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Other allowance</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="other_allowance" value="<?php echo $row['other_allowance']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">DA</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="da" value="<?php echo $row['da']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total allowance</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_allowance" value="<?php echo $row['total_allowance']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total emolument</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="total_emolument" value="<?php echo $row['total_emolument']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Account no</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="account_no" value="<?php echo $row['account_no']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Bank Name</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="bank_name" value="<?php echo $row['bank_name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Branch</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" name="branch" value="<?php echo $row['branch']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name of DDO with address</label>
            <div class="col-sm-6">
                <textarea name="ddo_address"><?php echo $row['ddo_address']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Photograph</label>
            <div class="col-sm-6">
                <output id="list"><img src="<?php echo base_url('uploads/employee/'.$row['photograph']); ?>" /></output>
                <!-- <input type="file" name="photograph" id="photograph"> -->
                <a class="file-input-wrapper btn btn-default">
                    <span>Browse</span>
                    <input type="file" name="photograph" id="photograph" style="left: -161.9375px; top: 5px;">
                </a>
                <div id="error-label"></div>
            </div>
        </div>
        <!--<div class="form-group">
            <label class="col-sm-3 control-label">Remarks</label>
            <div class="col-sm-6">
                <textarea name="remarks"><?php echo $row['remarks']; ?></textarea>
            </div>
        </div>-->
        <div class="form-group">
            <label class="col-sm-3 control-label">Mobile No.</label>
            <div class="col-sm-6">
                <input autocomplete="off" maxlength="10" type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
                <input autocomplete="off" type="password" name="password" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Role</label>
            <div class="col-sm-6">
                <select id="role" required="required" class="form-control" name="role">
                    <option value="">--Please Select--</option>
                    <?php foreach (getAllMember_Type() as $role) { ?>
                        <?php if($role['member_type_code'] == $row['role']) { ?>
                            <option value="<?php echo $role['member_type_code']; ?>" selected><?php echo $role['member_type_name']; ?></option>';
                        <?php } else { ?>
                            <option value="<?php echo $role['member_type_code']; ?>"><?php echo $role['member_type_name']; ?></option>';
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <input type="submit" name="edit_employee" class="btn btn-success" style="margin-top: 10px;" value="Update Employee">
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        $('#doj').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        $('#dor').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50'});

        $("#edit_employee_form").validate({
            rules: {name: "required", fhname: "required", branch_code: "required", designation: {selectcheck: true}, dob: {required: true, dateISO: true}, doj: {required: true, dateISO: true}, dor: {required: true, dateISO: true}, sex: {required: true}, category: {selectcheck: true}, appointas: {selectcheck: true}, pay_band: {required: true, number: true, minlength: 3}, grade_pay: {required: true, number: true, minlength: 3}, increament_amount: {required: true, number: true, minlength: 3}, total_pay: {required: true, number: true, minlength: 3}, sca: {required: true, number: true, minlength: 3}, other_allowance: {required: true, number: true, minlength: 3}, da: {required: true, number: true, minlength: 3}, total_allowance: {required: true, number: true, minlength: 3}, total_emolument: {required: true, number: true, minlength: 3}, bank_name: {required: true}, branch: "required", ddo_address: "required"/*, photograph: {required: true, extension: 'jpg|jpeg|png'}*/},
            messages: {dob: {dateISO: 'Date should be in this format 2012-06-23.'}, doj: {dateISO: 'Date should be in this format 2012-06-23.'}, dor: {dateISO: 'Date should be in this format 2012-06-23.'}/*, photograph: {extension: 'Please select jpg, jpeg, png or gif files.'}*/},
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

        getDepartmentAddress();
        $("#bc").change(function(){
            getDepartmentAddress();
        });

        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        }, "Please select.");

        //$('input[type=file]').bootstrapFileInput();
    });

    var getDepartmentAddress = function() {
        var dept=$("#bc").val();
        $.ajax({
            url:"<?php echo site_url('administrator/receipt/get_address') ?>?dept="+dept,
            method:'GET',
            dataType:'JSON',
            success:function(data){
                $("#address_department").val(data.address);
            }
        });
    }

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
</script>

<style type="text/css">
.form-group {
    width: 23%;
    float: left;
    margin-bottom: 9px;
}
.col-sm-6 img{width: 60px;-webkit-border-radius: 5px 5px;-moz-border-radius: 5px / 5px;border-radius: 5px / 5px;}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {margin-bottom: 3px;}
</style>