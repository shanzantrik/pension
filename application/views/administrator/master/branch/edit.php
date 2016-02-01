<h2>Edit Branch</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/branch_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">
	<div class="form-group">
		<label class="col-sm-3 control-label">Branch Code</label>
		<div class="col-sm-6">
			<input name="Branch_Code" type="text" value="<?php echo $record['Branch_Code']; ?>" class="form-control parsley-validated" readonly="readonly"><?php echo form_error('Branch_Code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Name</label>
		<div class="col-sm-6">
			<input name="Branch_Name" type="text" value="<?php echo $record['Branch_Name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Branch Name"><?php echo form_error('Branch_Name', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Description</label>
		<div class="col-sm-6">
			<textarea name="Description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"><?php echo $record['Description']; ?></textarea><?php echo form_error('Description', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Department</label>
		<div class="col-sm-6">
			<select class="form-control parsley-validated parsley-success" name="department_code">
				<option value="0">--Please Select--</option>
				<?php
					foreach (getAllDepartment() as $dept) {
						if($record['dept_code'] == $dept['dept_code']) { ?>
							<option value="<?php echo $dept['dept_code']; ?>" selected><?php echo $dept['dept_name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
						<?php }
					}
				?>
			</select><?php echo form_error('department_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Branch</button>
		</div>
	</div>
</form>