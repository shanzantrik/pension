<input type="hidden" id="url" value="<?php echo site_url('administrator/superintendent/search')?>">

<script>
   $(document).ready(function() {
        $( "#fdt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2012:2020'
        });
    });
    $(document).ready(function() {
        $("#tdt").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2012:2020'
        });
    });
</script>
<div class="form-horizontal group-border-dashed">
	<div class="form-group" style="float:left;width:48%">
		<label class="col-sm-3 control-label">From Date</label>
		<div class="col-sm-4">
			<input placeholder="From Date" type="text" class="form-control" name="fdt" id="fdt" autocomplete="off">
		</div>
	</div>
	<div class="form-group" style="float:left;width:50%">
		<label class="col-sm-3 control-label">To Date</label>
		<div class="col-sm-4">
			<input placeholder="To Date" type="text" class="form-control" name="tdt" id="tdt" autocomplete="off">
			<input type="button" id="btn" value="Search" class="btn btn-primary" name="submit">
		</div>
	</div>
	<div class="form-group">

	</div>
</div>
<hr>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn").click(function(){
			var fdt=$("#fdt").val();
			var tdt=$("#tdt").val();
			var url=$("#url").val();
			$.ajax({
				url: url+'?fdt='+fdt+'&tdt='+tdt,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        //$("#img").show();
				},
			    success: function(data) {
			        //$("#img").hide();
					$("#details").html(data);
			    }
			});
		});
	});
</script>
<?php 
$fdt=date('Y-m').'-01';
$tdt=date('Y-m-d');
?>
<script type="text/javascript">
	$(document).ready(function(){
			var fdt='1900-01-01';
			var tdt='3000-01-01';
			var url=$("#url").val();
			$.ajax({
				url: url+'?fdt='+fdt+'&tdt='+tdt,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        //$("#img").show();
				},
			    success: function(data) {
			        //$("#img").hide();
					$("#details").html(data);
			    }
			});
	
	});
</script>
<div id="details">
	
</div>