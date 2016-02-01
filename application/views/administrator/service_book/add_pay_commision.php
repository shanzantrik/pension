<style type="text/css">
	#div_m{
		width:46%;
		height:500px;
		float:left;
		border:1px solid #000;
		
	 }
	 #alerts{
	 	font-family: "Segoe UI";
	 	height: 20px;
	 	background-color: #5D6369;
	 	color:#FFF;
	 	text-align: center;
	 }
	 #pre{
	 	width: 47%;
	 	font-weight: bold;
	 	float: left;
	 	margin-left: 10px;
	 }
	 #form_dis2{
	 	width: 47%;
	 	font-weight: bold;
	 	float: left;
	 	margin-left: 10px;
	 }
	 #form_dis{
	 	width: 47%;
	 	font-weight: bold;
	 	float: left;
	 	margin-left: 10px;
	 }
	 #lbl{
	 	margin-left:30%;
	 	font-weight:bold;
	 	color:#000000;
	 	font-size: 12px;
	 }
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#pay-commission").change(function(){
			var x=$("#pay-commission").val();
			$.ajax({
				url:'pre_revised?id='+x,
				dataType:'html',
				method:'GET',
				success:function(data){
					$("#form_dis").html(data);
				}
			});
			

		})
	});
</script>
<div>
		<div class="form-group">
            <label class="col-sm-3 control-label">Pay Commision</label>
            <div class="col-sm-6">
              	<select id="pay-commission">
					<?php foreach ($records as $rec): ?>
						<option value="<?php echo $rec['id']  ?>"><?php echo $rec['name']  ?></option>
					<?php endforeach ?>
				</select>  
           	</div>
        </div>
</div>
<div style="background-color:#FFF">
	<div id="div_m">
		<div id="alerts">Pay Scale and Grade Pay</div>
		<div id="pre">
				<div class="form-group">
				    <label  id="lbl">Pre-Revised</label>
				    <!-- <select id="pr" class="form-control" style="border-radius:0px">
				    	<option value="">-Please Select-</option>
				    	<option value="applicable">Applicable</option>
				    	<option value="na">NA</option>
				    </select> -->
			    </div>
		</div>
		<div id="pre">
				<div class="form-group" >
				    <label id="lbl">Revised</label>
				    <!-- <select id="r" class="form-control" style="border-radius:0px">
				  	    <option value="">-Please Select-</option>
				    	<option value="applicable">Applicable</option>
				    	<option value="na">NA</option>
				    </select> -->
			    </div>
		</div>
		<div id="form_dis" style="width:100%">
			
		</div>
		

	</div>
	<div id="div_m" style="margin-left:2%">
		
	</div>
</div>