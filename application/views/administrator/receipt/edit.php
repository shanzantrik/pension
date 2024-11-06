<?php 
$file='';$emp_code='';$fname='';$mname='';$lname='';
foreach ($records as $rec) {
	$file=$rec->file_No;
	$emp_code=$rec->emp_code;
	$fname=$rec->pensionee_fname;
	$mname=$rec->pensionee_mname;
	$lname=$rec->pensionee_lname;
	$srl=$rec->srl_No;
}
echo form_open('administrator/receipt/update_data',array('class'=>'form-horizontal group-border-dashed'));
 ?>
 <div class="form-group">
		<label class="col-sm-3 control-label">Employee Code</label>
		<div class="col-sm-6">
			<input type="text" value="<?php echo $emp_code; ?>" name="empcode" />
			<input type="hidden" value="<?php echo $srl;?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">File No.</label>
		<div class="col-sm-6">
			<input type="text" value="<?php echo $file; ?>" name="file_no" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">First Name</label>
		<div class="col-sm-6">
			<input type="text" name="fname" value="<?php echo $fname; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Middle Name</label>
		<div class="col-sm-6">
			<input type="text" name="mname" value="<?php echo $mname; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Last Name</label>
		<div class="col-sm-6">
			<input type="text" name="lname" value="<?php echo $lname; ?>" />
		</div>
	</div>
 <div class="form-group">
		<div class="col-sm-6">
			<button class="btn">Update</button>
		</div>
	</div>
 <?php echo form_close() ?>

