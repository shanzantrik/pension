<h2>Edit Dearness Allowance</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/da_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">						
	<div class="form-group">
		<label class="col-sm-3 control-label">From Date</label>
		<div class="col-sm-6">
			<input name="from" id="from" type="text" value="<?php echo $record['from']; ?>" class="form-control parsley-validated" placeholder="Please Enter From Date"><?php echo form_error('from', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Percentage</label>
		<div class="col-sm-6">
			<input name="percentage" type="text" value="<?php echo $record['percentage']; ?>" class="form-control parsley-validated" placeholder="Please Enter Percentage"><?php echo form_error('percentage', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save DA</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(function() {
  		$("#from").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
  	});
</script>