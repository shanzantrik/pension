<div class="control-group">
<label class="control-label" for="appendedInputButton">Department Forwarding No.</label>
<div class="controls">
  <div class="input-append">
	 <input id="dfno"  size="16" type="text">
	 <button id="btn" class="btn" type="button">
	 <span id="img" style="display:none;"><img style="height:20px;width:20px;" src="<?php echo base_url() ?>includes/images/ajax_loader_blue_512.gif"></span>Search
	 </button>
	 <!-- <span id="img" style="display:none;"><img style="height:20px;width:20px;margin-top:5px" src="<?php echo base_url() ?>includes/images/ajax_loader_blue_512.gif"></span>Search -->
  	</div>
  	<div id="lastFive">
  		<h3><small style="font-size:12px"> Last five department forwading number.</small></h3>
  		<?php foreach($lastFiveDFN as $lf) : ?>
  			<a href="#" data-val="<?php echo $lf['dept_forw_no']; ?>" class="lastFive"><?php echo $lf['dept_forw_no']; ?></a><br />
  		<?php endforeach; ?>
  	</div>
</div>
</div>
<div id="details">
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn").click(function(){
			var name=$("#dfno").val();
			$.ajax({
				url: 'df_search_view?dfno='+name,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        $("#img").show();
				},
			    success: function(data) {
			        $("#img").hide();
			        $('#lastFive').hide();
					$("#details").html(data);
			    }
			});
		});

		$('.lastFive').click(function(e) {
			e.preventDefault();
			var me = $(this);
			$('#dfno').val(me.attr('data-val'));
		});

		$('#dfno').bind('keypress', function(event) {
            var me = $(this);
            var regex = new RegExp("^[a-zA-Z0-9-&/]+$");
            var key = String.fromCharCode(! event.charCode ? event.which : event.charCode);
            if(!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
	});
</script>
	
