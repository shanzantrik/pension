<h3>Search</h3>
<div class="">
	<div class="" style="margin-top:10px">
       	<div class="control-group">
			<label class="control-label" for="appendedInputButton">Department Forwarding No.</label>
			<div class="controls">
			  	<div class="input-append" style="float: left;">
					<input id="dfno"  size="16" type="text">
					<button id="btn" class="btn" type="button">Search </button>
					<span id="img" style="display:none;"><img style="height:20px;width:20px;margin-top:5px" src="<?php echo base_url() ?>includes/images/ajax_loader_blue_512.gif"></span>
			  	</div>
			  	<div id="edit_register_btn" style="float: right;">
			  		
			  	</div>
			</div>
		</div>
	</div>
</div>
<div id="details">
</div>
<input type="hidden" id="urls" value="<?php echo base_url(); ?>">
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#btn").live('click', function(){
			var name=$("#dfno").val();
			$.ajax({
				url: '<?php echo site_url("administrator/receipt/search_result?dfno="); ?>'+name,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        $("#img").show();
				},
			    success: function(data) {
			    	if(data == '<br /><br />No record') {
			    		$("#img").hide();
			    		$('#edit_register_btn').html('');
			    		$("#details").html(data);
			    	} else {
			    		//var forw_no = '<?php echo base64_encode('+name+'); ?>';
				        $("#img").hide();
				        $('#edit_register_btn').html('<a href="<?php echo site_url("administrator/receipt/edit_register/"); ?>/'+name+'" class="btn btn-info">Edit Receipt Register </a>');
						$("#details").html(data);
			    	}
			    }
			});
		});
	});
</script>