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
			var url=$("#url").val();
			var branch=$("#branch").val();
			if(branch==''){
				alert('Please Select Branch');
			}else{
				$.ajax({
				url: url+'?fdt='+fdt+'&tdt='+tdt+'&branch='+branch,
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
			}
			
		});
	});
</script>
<table width="100%">
  <tr>
    <td width="21%">Branch</td>
    <td width="20%">
    	<select id="branch" name="branch">
    				<option value="">--Please Select--</option>
                	<?php foreach ($branch as $d) {
                		echo "<option value=".$d->Branch_Code.">".$d->Branch_Name."</option>";
                	} ?>
            </select>
    </td>
    <td width="8%">&nbsp;</td>
    <td width="20%"><!-- Dealing Assistant --></td>
    <td width="31%"><!-- <div id="dx">Please Select Branch First</div> --></td>
  </tr>
  <tr>
    <td>From Date</td>
    <td><input placeholder="From Date" type="text" class="form-control" name="fdt" id="fdt" autocomplete="off"></td>
    <td>&nbsp;</td>
    <td>To Date</td>
    <td><input placeholder="To Date" type="text" class="form-control" name="tdt" id="tdt" autocomplete="off"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><button id="btn" class="btn btn-primary"><i class="icon-search"></i>Search</button></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
        /*$("#branch").change(function(){
            var val=$("#branch").val();
            $.ajax({
                url:"<?php echo site_url('administrator/superintendent/get_dealing_assist_allocate?bcode=') ?>"+val,
                method:'GET',
                dataType:'html',
                success:function(data){
                    $("#dx").html(data);
                }
            })
        });*/
    });
</script>
<div style="background-color:white; border-radius:5px;min-height:130px;margin-top:10px" id="details">
	
</div>