<label>Pay Commision</label>
<select id="pay_comn">
	<?php foreach ($records as $rec): ?>
		<option value="<?php echo $rec['id'] ?>"><?php echo $rec['name'] ?></option>
	<?php endforeach ?>
</select>
<img id="indicator" style="margin-top:-10px;display:none" src="<?php echo base_url().'includes/img/ajax-loader.gif' ?>" />

<script type="text/javascript">
	$(document).ready(function(){
		$("#pay_comn").change(function(){
			var x=$("#pay_comn").val();
			$("#indicator").show();
			$.ajax({
				url:'<?php echo site_url(); ?>/administrator/master/paycommission_get_textbox?id='+x,
				type:'GET',
				dataType:'html',
				success:function(data){
					$("#indicator").hide();
					$("#results").html(data);
				}
			});
		});
	});
</script>
<div id="results">
	
</div>
