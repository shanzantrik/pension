<h2>Edit Commutation Value</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/commutation_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">
	<div class="form-group">
		<label class="col-sm-3 control-label">Age at Next Birth</label>
		<div class="col-sm-6">
			<input name="age_next" type="text" value="<?php echo $record['Age_Next_Birth']; ?>" class="form-control parsley-validated" placeholder="Please Enter Age at next birth range(10-100)"><?php echo form_error('age_next', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Commutation Value</label>
		<div class="col-sm-6">
			<input name="col_value" type="text" value="<?php echo $record['comm_value']; ?>" class="form-control parsley-validated" placeholder="Please Enter Commutation Value"><?php echo form_error('col_value', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Commutation</button>
		</div>
	</div>
</form>