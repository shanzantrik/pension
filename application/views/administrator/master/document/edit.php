<h2>Edit Document</h2>
<?php $record = $records[0]; ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/document_edit/'.$this->uri->segment(4)); ?>" method="post" parsley-validate="" novalidate="">
	<div class="form-group">
		<label class="col-sm-3 control-label">Doc Number</label>
		<div class="col-sm-6">
			<input name="doc_no" type="text" value="<?php echo $record['doc_no']; ?>" class="form-control parsley-validated" readonly="readonly"><?php echo form_error('doc_no', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Name</label>
		<div class="col-sm-6">
			<input name="doc_name" type="text" value="<?php echo $record['doc_name']; ?>" class="form-control parsley-validated" placeholder="Please Enter Document Name"><?php echo form_error('doc_name', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Description</label>
		<div class="col-sm-6">
			<textarea name="descrp" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"><?php echo $record['descrp']; ?></textarea><?php echo form_error('descrp', '<div class="error">', '</div>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Document</button>
		</div>
	</div>
</form>