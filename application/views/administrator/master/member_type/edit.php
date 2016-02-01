<h2>Edit Member Type</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/member_type_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">						
	<div class="form-group">
		<label class="col-sm-3 control-label">Member Type Code</label>
		<div class="col-sm-6">
			<input name="member_type_code" type="text" value="<?php echo $record['member_type_code']; ?>" class="form-control parsley-validated"readonly="readonly"><?php echo form_error('member_type_code', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Name</label>
		<div class="col-sm-6">
			<input name="member_type_name" type="text" value="<?php echo $record['member_type_name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('member_type_name', '<div class="error">', '</div>'); ?>
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
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Member Type</button>
		</div>
	</div>
</form>