<!-- Ajax URL  -->
<input type="hidden" id="url" value="<?php echo site_url('administrator/superintendent/search_allocate')?>">
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn").click(function(){
			var fdt=$("#fdt").val();
			var tdt=$("#tdt").val();
			var radio=$("#sel").val();
			if(fdt=='' || tdt=='' ||(fdt=='' && tdt=='')){
				alert('Please Enter From Date And To Date');
			}else{
				$.ajax({
				url: "<?php echo site_url('administrator/search_file/search') ?>"+'?fdt='+fdt+'&tdt='+tdt+'&radio='+radio,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function() {
			        $("#img").show();
                    $(".icon-search").hide();
				},
			    success: function(data) {
			        $("#img").hide();
                    $(".icon-search").show();
					$("#details").html(data);
			    }
			});
			}
			
		});
	});
</script>
<style type="text/css">
    .form-control{
        margin-top: 4px;
    }
</style>
<table>
  <tr>
    <td width="12%"><b>From Date:</b></td>
    <td width="17%"><input placeholder="From Date" type="text" class="form-control" name="fdt" id="fdt" autocomplete="off"></td>
    <td width="11%">&nbsp;&nbsp;<b>To Date:</b></td>
    <td width="14%"><input placeholder="To Date" type="text" class="form-control" name="tdt" id="tdt" autocomplete="off"></td>
    <td width="5%">&nbsp;&nbsp;<b>Type:</b></td>
    <td width="30%">
         <select name="sel" class="form-control" id="sel">
            <option value="All">All</option>
            <!--<option value="Received">Received</option>
            <option value="Forwarded">Forwarded</option>-->
         </select>

    </td>
    <td width="11%"><button id="btn" class="btn btn-primary"><i class="icon-search"></i><span id="img" style="display:none;"><img style="height:20px;width:20px;" src="<?php echo base_url(); ?>/includes/images/ajax_loader_blue_512.gif"></span>Search</button></td>
  </tr>
  </table>
<div style="background-color:white; border-radius:5px;min-height:130px;margin-top:10px" id="details">
	
</div>
