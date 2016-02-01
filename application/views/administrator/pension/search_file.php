<h2>Pensioner File Search</h2>
<form class="form-horizontal" action="<?php echo site_url('administrator/pension/file'); ?>" method="post">
  	<div class="form-group">
    	<label for="inp" class="col-sm-2 control-label" style="text-align: left; font-weight: bold;">File Number</label>
    	<div class="col-sm-6">
      		<input autocomplete="off" type="text" class="form-control" name="file_no" id="file_no" style="width:30%"><div class="error" style="margin-left: 140px;"></div><?php echo form_error('file_no', '<div class="error">', '</div>'); ?>
    	</div>
  	</div>
    <div class="form-group">
        <label for="inp" class="col-sm-2 control-label"></label>
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="create_worksheet" id="create_worksheet" class="btn btn-primary" disabled>Create Worksheet</button>
        </div>
    </div>
</form>

<div id="pensioner_info"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#file_no').keyup(function(e){
            $.post("<?php echo site_url('administrator/pension/get_pensioner_info'); ?>", {file_no: $('#file_no').val()}, function(data) {
                var obj = jQuery.parseJSON(data);
                if(obj.status == "ok"){
                    $('.error').html('');
                    $('#pensioner_info').html(obj.message);
                    $('#create_worksheet').removeAttr('disabled');
                } else {
                    $('.error').html(obj.message);
                    $('#pensioner_info').html('');
                    $('#create_worksheet').attr('disabled', 'true');
                }
            });
        });
    });
</script>