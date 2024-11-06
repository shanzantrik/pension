<script src="<?php echo base_url() ?>includes/js/jquery.cleditor.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.cleditor').cleditor();
	})
</script>
<form method="POST" action="<?php echo site_url('administrator/page_manager/update') ?>">
	<label for="Page Title">Page Title</label>
	<input type="hidden" name="id" value="<?php echo $records['id'] ?>">
	<input type="text" name='page_title' value="<?php echo $records['page_title'] ?>">
	<div class="control-group">
		  <label class="control-label" for="textarea2">Page Content</label>
		  <div class="controls">
			<textarea class="cleditor" name="codebase" id="textarea2" rows="10"><?php echo $records['codebase'] ?></textarea>
		  </div>
	</div>
	<button class="btn btn-success" type="submit">Save</button>
</form>