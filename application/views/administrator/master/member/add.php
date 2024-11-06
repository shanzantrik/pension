<h3>Add Member &raquo; <small style="color:darkgrey;">Use the panel below to add a new member to operate on the system</small></h3>                             
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/member_index'); ?>" method="post" parsley-validate="" novalidate="" autocomplete="off">
    <div class="row-fluid sortable">
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Member Name</label></td>
                        <td><input title="Please enter member name" name="member_name" type="text" value="<?php echo set_value('member_name'); ?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('member_name', '<div class="error">', '</div>'); ?></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Branch</label></td>
                        <td>
                        <select title="Please select a branch" class="form-control parsley-validated parsley-success" name="Branch_Code">
                            <option value="0">--Select Branch--</option>
                            <?php foreach (getAllBranch_master() as $branch) { ?>
                                <option value="<?php echo $branch['Branch_Code']; ?>"><?php echo $branch['Branch_Name']; ?></option>
                            <?php } ?>
                        </select><?php echo form_error('Branch_Code', '<div class="error">', '</div>'); ?>
                        </td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Email</label></td>
                        <td><input title="Please enter a valid email" name="email" type="text" value="<?php echo set_value('email'); ?>" class="form-control parsley-validated" placeholder="Please Enter Email"><?php echo form_error('email', '<div class="error">', '</div>'); ?></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Designation</label></td>
                        <td>
                        <select title="Please select a designation code" class="form-control parsley-validated parsley-success" name="desg_code">
                            <option value="0">--Select Designation--</option>
                            <?php foreach (getAllDesignation() as $desg) { ?>
                                <option value="<?php echo $desg['desg_code']; ?>"><?php echo $desg['desg_name']; ?></option>
                            <?php } ?>
                        </select><?php echo form_error('desg_code', '<div class="error">', '</div>'); ?>
                        </td>                                                      
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Password</label></td>
                        <td><input title="Please set a password" name="passwrd" type="password" value="<?php echo set_value('passwrd'); ?>" class="form-control parsley-validated" placeholder="Please Enter Password"><?php echo form_error('passwrd', '<div class="error">', '</div>'); ?></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Member Type</label></td>
                        <td>
                            <select title="Please select member type" class="form-control parsley-validated parsley-success" id="member_type_code" name="member_type_code">
                                <option value="0">--Select Member Type--</option>
                                <?php foreach (getAllMember_type() as $member) { ?>
                                    <option value="<?php echo $member['member_type_code']; ?>"><?php echo $member['member_type_name']; ?></option>
                                <?php } ?>
                            </select><?php echo form_error('member_type_code', '<div class="error">', '</div>'); ?>
                            <div id="sec" style="display:none">
                                <br/>
                                <strong>Section:</strong> <select title="Select a section"  style="width:167px" title="Please select section" class="form-control parsley-validated parsley-success" name="section" id="section">
                                    <option id="selected" selected="selected" value="No">--Select section--</option>
                                    <?php foreach (getAllSection() as $section) { ?>
                                        <option value="<?php echo $section['section']; ?>"><?php echo $section['section']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>                                                 
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Re Type Password</label></td>
                        <td><input title="Please retype and confirm the set password" name="copasswrd" type="password" value="" class="form-control parsley-validated" placeholder="Please Enter Password"><?php echo form_error('copasswrd', '<div class="error">', '</div>'); ?></td>
                        <div class="radio">
                             <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Gender</label></td>
                             <td><input type="radio" name="gender" value="Male" class="form-control parsley-validated"checked="checked"> Male<br/><br/><input type="radio" name="gender" value="Female" class="form-control parsley-validated"> Female</td>
                        </div>                                                  
                    </tr>                                                                               
                    <tr>  
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Landline Number</label></td>
                        <td style="width:30%"><input title="Provide a landline number(optional)" name="mobile_no1" type="text" value="<?php echo set_value('mobile_no1'); ?>" class="form-control parsley-validated" placeholder="Please Enter Landline Number"><?php echo form_error('mobile_no1', '<div class="error">', '</div>'); ?></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Mobile Number</label></td>
                        <td style="width:30%"><input title="Please provide a mobile number" name="mobile_no2" type="text" value="<?php echo set_value('mobile_no2'); ?>" class="form-control parsley-validated" placeholder="Please Enter Mobile Number"><?php echo form_error('mobile_no2', '<div class="error">', '</div>'); ?></td>
                    </tr>
                    <tr style="height:40%">
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Permanent Address</label></td>
                        <td>
                            <textarea style="resize:none" title="Provide permanent address" name="per_address" placeholder="Please Permanent Address" class="form-control parsley-validated"><?php echo set_value('per_address'); ?></textarea><?php echo form_error('per_address', '<div class="error">', '</div>'); ?><br/>
                            <input type="checkbox" id="addresstoo" name="addresstoo" onclick="FillAddress(this.form)">
                            <small style="color:darkgrey;font-weight:bold;  font-size:12px" onclick="$('#addresstoo').click();FillAddress(this.form)">Check this box if Permanent Address and Correspondence Address are same.</small>
                        </td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Correspondence Address</label></td>
                        <td><textarea style="resize:none" title="Provide correspondence address" name="cor_address" placeholder="Please Enter Correspondence Address" class="form-control parsley-validated"><?php echo set_value('cor_address'); ?></textarea><?php echo form_error('cor_address', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Member Status</label></td>
                        <td>
                            <select title="Select a member type" class="form-control parsley-validated parsley-success" name="member_status">
                                <option selected value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="block">Blocked</option>
                            </select><?php echo form_error('member_status', '<div class="error">', '</div>'); ?>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
    <button type="submit" name="submit_val" class="btn btn-primary">Add Member</button>
    <input type="reset" class="btn btn-warning" value="Cancel">
     <small style="color:darkgrey;"> If you are not sure on this or want to learn more, contact software provider. </small>
                         
</form>                 
<script type="text/javascript">
    $(document).ready(function() {
        $("#member_type_code").change(function() {
            var id=$("#member_type_code").val();
            if(id!='' && id!="No"){
                if(id=="1001" || id=="1004"){
                    $("div#sec").fadeIn();
                    $("option#selected").hide();
                    $('#section').val('A').trigger('change');
                    //$("#section").prop('disabled',false);
                } else {
                    $("div#sec").fadeOut();
                    $("option#selected").show();
                    $('#section').val('No').trigger('change');
                    //$("#section").prop('disabled',true);
                } 
            } else {
                $("div#sec").fadeOut();
                $("option#selected").show();
                $('#section').val('No').trigger('change');
                //$("#section").prop('disabled',true);
            }
        });
    });

    function FillAddress(f) {
        if(f.addresstoo.checked == true) {
            f.cor_address.value = f.per_address.value;
        }
    }  
</script>