<h2>Edit Department</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/department_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">
	<div class="form-group">
		<label class="col-sm-3 control-label">Dept Code</label>
		<div class="col-sm-6">
			<input name="dept_code" type="text" value="<?php echo $record['dept_code']; ?>" class="form-control parsley-validated" placeholder="Please Enter Department Name" readonly="readonly"><?php echo form_error('dept_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Name</label>
		<div class="col-sm-6">
			<input name="dept_name" type="text" value="<?php echo $record['dept_name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Department Name"><?php echo form_error('dept_name', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Description</label>
		<div class="col-sm-6">
			<textarea name="description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"><?php echo $record['description']; ?></textarea><?php echo form_error('description', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Department</button>
		</div>
	</div>
</form>