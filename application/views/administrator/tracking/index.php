<div class="control-group">
<label class="control-label" for="appendedInputButton">File No</label>
<div class="controls">
  	<div class="input-append">
	 	<input id="file_no"  size="16" type="text">
	 	<button id="btn" class="btn" type="button">
	 	<span id="img" style="display:none;"><img style="height:20px;width:20px;" src="<?php echo base_url() ?>includes/images/ajax_loader_blue_512.gif"></span>Search
	 	</button>
  	</div>
  	<div id="lastTen">
  		<h3><small style="font-size:12px"> Recently used file number.</small></h3>
  		<?php foreach($recent_file as $rf) : ?>
  			<a href="#" data-val="<?php echo $rf->file_no; ?>" class="lastTen"><?php echo $rf->file_no; ?></a><br />
  		<?php endforeach; ?>
  	</div>
</div>
</div>
<div id="details">
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn").click(function(){
			var name=$("#file_no").val();
			$.ajax({
				url: 'track_details?file_no='+name,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        $("#img").show();
				},
			    success: function(data) {
			        $("#img").hide();
			        $('#lastTen').hide();
					$("#details").html(data);
			    }
			});
		});

		$('.lastTen').click(function(e) {
			e.preventDefault();
			var me = $(this);
			$('#file_no').val(me.attr('data-val'));
		});
	});
</script>
	
