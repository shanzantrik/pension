<!-- Ajax URL  -->
<input type="hidden" id="url" value="<?php echo site_url('administrator/superintendent/search_allocate')?>">
<script>
   /*$(document).ready(function() {
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
    });*/
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn1").click(function(){
			var dept=$("#dept").val();
			var code=$("#code").val();
			var name=$("#name").val();
			if(dept=='' && code=='' && name==''){
				alert('Please Enter some input');
			}else{
				$.ajax({
				url: "<?php echo site_url('administrator/search_file/search_all_file') ?>"+'?dept='+dept+'&code='+code+'&name='+name,
			    type: 'GET',
			    dataType: 'html',
			    beforeSend: function(){
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
    <td width="12%"><b>Dept.No:</b></td>
    <td><input placeholder="Dept Forwarding no" type="text" class="form-control" name="fdt" id="dept" autocomplete="off"></td>
    <td width="11%"><b>Emp Code:</b></td>
    <td width="14%"><input placeholder="Emp Code" type="text" class="form-control" name="tdt" id="code" autocomplete="off"></td>
    <td width="9%"><b>Emp Name:</b></td>
 <td width="14%"><input placeholder="" type="Emp Name" class="form-control" name="tdt" id="name" autocomplete="off"></td>
    <td width="5%">&nbsp;&nbsp;<b>:</b></td>
    <td width="11%"><button id="btn1" class="btn btn-primary"><i class="icon-search"></i><span id="img" style="display:none;"><img style="height:20px;width:20px;" src="http://localhost/pension_ui/includes/images/ajax_loader_blue_512.gif"></span>Search</button></td>
  </tr>
  </table>
<div style="background-color:white; border-radius:5px;min-height:130px;margin-top:10px" id="details">
	
</div>
