<!-- Make url -->
<?php 
	$url="";$id="";
	foreach ($records as $rec) {
		$url=$url.$rec['name'].",";
		$id=$id.$rec['id'].",";
	}
	$url=rtrim($url, ",");
	$id=rtrim($id, ",");
	$hidden=array('url' => $url,'id'=>$id);
?>

<div class="form-group">
    <fieldset>
        <legend>Pre-Revised</legend>
        <div class="form-group-inside">
            <?php foreach ($records as $rec): ?>
				<label class="col-sm-3 control-label"><?php echo $rec['alias_name'] ?></label>
				<div class="col-sm-6">
		            <input required type="text" autocomplete="off" title="<?php echo $rec['alias_name'] ?>" onblur="findTotal()" class="pre_xx" name="pre_<?php echo $rec['name'] ?>" id="<?php echo $rec['name'] ?>" placeholder="<?php echo $rec['alias_name'] ?>" >
		        </div>
			<?php endforeach ?>	
			<label class="col-sm-3 control-label">Total</label>
			<input autocomplete="off" placeholder="Total Amont" disabled="true" type="text" id="total_pre" name="total_pre">
        </div>
    </fieldset>
</div>
<div class="form-group">
    <fieldset>
        <legend>Revised</legend>
        <div class="form-group-inside">
            <?php foreach ($records as $rec): ?>
				<label class="col-sm-3 control-label"><?php echo $rec['alias_name'] ?></label>
				<div class="col-sm-6">
		            <input type="text" autocomplete="off" title="<?php echo $rec['alias_name'] ?>" onblur="findTotal_rev()" class="rev_xx" name="post_<?php echo $rec['name'] ?>" id="<?php echo $rec['name'] ?>" placeholder="<?php echo $rec['alias_name'] ?>" >
		        </div>
			<?php endforeach ?>
			<div class="form-group-inside">
				<label class="col-sm-3 control-label">Last Increament Date</label>
				<div class="col-sm-6">
	                <input readonly autocomplete="off" name="last_increament_date" id="last_increament_date" type="text" placeholder="Please Enter Last Increament Date">
	            </div>
	        </div>
			<label class="col-sm-3 control-label">Total</label>
			<input autocomplete="off" placeholder="Total Amont" readonly type="text" id="total_rev" name="total_rev">
        </div>
    </fieldset>
</div>
<script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByClassName("pre_xx");
    
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
   $("#total_pre").val(tot);
}
</script>
<script type="text/javascript">
function findTotal_rev(){
    var arr = document.getElementsByClassName("rev_xx");
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
   $("#total_rev").val(tot);
}

$(document).ready(function(){
	$('.rev_xx:eq(0)').change(function(){
		if($(this).val() > 0) {
			$('#last_increament_date').removeAttr('readonly').attr('required', 'true');
		} else {
			$('#last_increament_date').attr('readonly', 'true').removeAttr('required');
		}
	});

	$("#last_increament_date").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
});
</script>
