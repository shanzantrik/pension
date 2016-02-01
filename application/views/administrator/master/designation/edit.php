<h2>Edit Designation</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/designation_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">						
	<div class="form-group">
		<label class="col-sm-3 control-label">Designation Code</label>
		<div class="col-sm-6">
			<input name="desg_code" type="text" value="<?php echo $record['desg_code']; ?>" class="form-control parsley-validated" readonly="readonly"><?php echo form_error('desg_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Name</label>
		<div class="col-sm-6">
			<input name="desg_name" type="text" value="<?php echo $record['desg_name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Designation Name"><?php echo form_error('desg_name', '<div class="error">', '</div>'); ?>
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
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Designation</button>
		</div>
	</div>
</form>