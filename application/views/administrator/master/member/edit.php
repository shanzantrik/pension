<h3>Edit Member
&raquo; <small style="color:darkgrey;">Use the below panel to edit the selected member operating on the system</small>

<?php echo nbs(2);?><a style="" class="label label-success" href="<?php echo site_url('administrator/master/member/view'); ?>">Back</a></h2><hr style="margin:5px 0;">
<?php $record = $records[0]; ?></h3>

<form class="form-horizontal group-border-dashed edit-member" action="<?php echo site_url('administrator/master/member_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">
	<div class="form-group">
		<label class="col-sm-3 control-label">Member Code</label>
		<div class="col-sm-6">
			<input name="member_code" type="text" value="<?php echo $record['member_code']; ?>" class="form-control parsley-validated" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Member Name</label>
		<div class="col-sm-6">
			<input title="Member Name" name="member_name" type="text" value="<?php echo $record['member_name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('member_name', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Gender</label>
		<div class="col-sm-6">
			<input type="radio" name="gender" value="Male" class="form-control parsley-validated" <?php if($record['gender'] == "Male") { ?>checked="checked"<?php } ?>> Male&nbsp;&nbsp;<input type="radio" name="gender" value="Female" class="form-control parsley-validated" <?php if($record['gender'] == "Female") { ?>checked="checked"<?php } ?>> Female
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Landline Number</label>
		<div class="col-sm-6">
			<input title="Landline Number" name="mobile_no1" type="text" value="<?php echo $record['mobile_no1']; ?>" class="form-control parsley-validated" placeholder="Please Enter Phone Number"><?php echo form_error('mobile_no1', '<div class="error">', '</div>'); ?>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-3 control-label">Mobile Number</label>
		<div class="col-sm-6">
			<input title="Mobile Number" name="mobile_no2" type="text" value="<?php echo $record['mobile_no2']; ?>" class="form-control parsley-validated" placeholder="Please Enter Mobile Number"><?php echo form_error('mobile_no2', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Permanent Address</label>
		<div class="col-sm-6">
			<textarea style="resize:none" title="Permanent Address" name="per_address" placeholder="Please Enter Your Permanent Address" class="form-control parsley-validated"><?php echo $record['per_address']; ?></textarea><?php echo form_error('per_address', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Correspondence Address</label>
		<div class="col-sm-6">
			<textarea style="resize:none" title="Correspondence Address" name="cor_address" placeholder="Please Enter Your Correspondence Address" class="form-control parsley-validated"><?php echo $record['cor_address']; ?></textarea><?php echo form_error('cor_address', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Email</label>
		<div class="col-sm-6">
			<input title="Email" name="email" type="text" value="<?php echo $record['email']; ?>" class="form-control parsley-validated" placeholder="Please Enter Your Email"><?php echo form_error('email', '<div class="error">', '</div>'); ?>
		</div>
	</div>		
	<div class="form-group">
		<label class="col-sm-3 control-label">Branch</label>
		<div class="col-sm-6">
			<select title="Select Branch" class="form-control parsley-validated parsley-success" name="Branch_Code">
				<?php
					foreach (getAllBranch_master() as $branch) {
						if($record['Branch_Code'] == $branch['Branch_Code']) { ?>
							<option value="<?php echo $branch['Branch_Code']; ?>" selected><?php echo $branch['Branch_Name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $branch['Branch_Code']; ?>"><?php echo $branch['Branch_Name']; ?></option>
						<?php }
					}
				?>
			</select><?php echo form_error('Branch_Code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Member Type</label>
		<div class="col-sm-6">
			<select title="Select Member Type" class="form-control parsley-validated parsley-success" id="member_type_code" name="member_type_code">
				<?php
					foreach (getAllMember_Type() as $member) {
						if($record['member_type_code'] == $member['member_type_code']) { ?>
							<option value="<?php echo $member['member_type_code']; ?>" selected><?php echo $member['member_type_name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $member['member_type_code']; ?>"><?php echo $member['member_type_name']; ?></option>
						<?php }
					}
				?>
			</select><?php echo form_error('member_type_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<?php if($record['section']!='No') { ?>
		<script>
			$(document).ready(function() {
				$("#member_type_code").change(function() {
					var id=$("#member_type_code").val();
					if(id=="1001" || id=="1004") {
						$('#section').val("<?php echo $record['section'];?>").trigger('change');
						$('div#sec').show();
					} else {
						$('div#sec').hide();
						$('#section').val("No").trigger('change');
					}
				});
			});
		</script>
		<div id="sec" class="form-group">
			<label class="col-sm-3 control-label">Section</label>
			<div class="col-sm-6">	
				<select title="Select Section" title="Please select section" class="form-control parsley-validated parsley-success" name="section" id="section">
                <?php foreach(getAllSection() as $section) { 
                    if($section['section'] == $record['section']) { ?>
						<option value="<?php echo $section['section']; ?>" selected><?php echo $section['section']; ?></option>
					<?php } else { ?>
						<option value="<?php echo $section['section']; ?>"><?php echo $section['section']; ?></option>
					<?php } 
				} ?>
                	<option style="display:none" value="No"><?php echo "No"; ?></option>
                </select>
			<?php echo form_error('section', '<div class="error">', '</div>'); ?>
		</div>
	</div>	
	<?php } else { ?>
		<script>
			$(document).ready(function() {
				$("#member_type_code").change(function() {
					var id=$("#member_type_code").val();
					if(id=="1001" || id=="1004"){
						$('#section').val("A").trigger('change');
						$('div#sec').show();
					} else {
						$('div#sec').hide();
						$('#section').val("No").trigger('change');
					}
				});
			});
		</script>
		<div id="sec" class="form-group" style="display:none">
			<label class="col-sm-3 control-label">Section</label>
			<div class="col-sm-6">
				<select title="Select Section" title="Please select section" class="form-control parsley-validated parsley-success" name="section" id="section">
	                <option style="display:none" value="No" selected><?php echo "No"; ?></option>
					<?php foreach (getAllSection() as $section) { ?>
						<option value="<?php echo $section['section']; ?>"><?php echo $section['section']; ?></option>
					<?php } ?>
	            </select>
				<?php echo form_error('section', '<div class="error">', '</div>'); ?>
			</div>
		</div>
	<?php } ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Designation</label>
		<div class="col-sm-6">
			<select title="Select Designation" class="form-control parsley-validated parsley-success" name="desg_code">
				<?php
					foreach (getAllDesignation() as $desg) {
						if($record['desg_code'] == $desg['desg_code']) { ?>
							<option value="<?php echo $desg['desg_code']; ?>" selected><?php echo $desg['desg_name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $desg['desg_code']; ?>"><?php echo $desg['desg_name']; ?></option>
						<?php }
					}
				?>
			</select><?php echo form_error('desg_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Member Status</label>
		<div class="col-sm-6">
			<?php $status = array('active'=>'Active', 'inactive'=>'Inactive', 'block'=>'Block'); ?>
			<select title="Select status" class="form-control parsley-validated parsley-success" name="member_status">
             	<?php
             		foreach ($status as $key => $value) {
             			if($key==trim($record['member_status'])) { ?>
             				<option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
             			<?php } else { ?>
             				<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
             			<?php }
             		}
             	?>
            </select><?php echo form_error('member_status', '<div class="error">', '</div>'); ?>
		</div>
	</div>

	<div class="form-group" style="height: 28px;"></div>		
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Changes</button>
			<input type="reset" class="btn btn-warning" value="Cancel"><br/><br/><small style="color:darkgrey;"> If you are not sure on this or want to learn more, contact software provider. </small>
		</div>
	</div>
</form>

<script type="text/javascript">
    function FillAddress(f) {
  		if(f.addresstoo.checked == true) {
    		f.cor_address.value = f.per_address.value;
  		}
	}    
</script>
<style type="text/css">
	.error {margin-left: 218px;}
</style>
