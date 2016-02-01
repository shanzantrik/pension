<div>
<form onsubmit="sb()" id="frm" method="post" action="<?php echo site_url('administrator/module/save_auth') ?>">
	<input type="hidden" name="member_type_code" id="member_type_code" value="<?php echo $member_type_code ?>">
	<input type="hidden" name="module_code" id="module_code" value="<?php echo $module_code ?>">
	<div>
	 <select id='sub_mods' name='sub_mods' multiple class='fl' size="10">

	 		<?php foreach ($records as $rec): ?>
				<option value="<?php echo $rec->sub_module_code ?>"><?php echo $rec->alias_name ?></option>
			<?php endforeach ?>

	
	</select> 

	
		<input type='button' id='btnRight_code' class="btn btn-success" value='  >  ' />
	 	<input class="btn btn-danger" type='button' id='btnLeft_code' value='  <  ' />
	
	<?php   ?>
	<select id='selected_module' name='selected_module[]' size="10" multiple="multiple" class='fr' style="margin-left: 3px;">
		<?php foreach ($dv as $rec): ?>
			<option value="<?php echo $rec->sub_module ?>"><?php echo $rec->alias_name ?></option>
		<?php endforeach ?>	
	</select>
	</div>
	<br/>
	<button id="save" class="btn btn-primary" type="submit"><i class="icon-file"></i>Save</button>

</form>
</div>
<script type="text/javascript">
	function sb(){
		
			selectAll('selected_module',true);
			
	}
</script>
<script type="text/javascript">
	$('[id^=\"btnRight\"]').click(function (e) {
    
    $(this).prev('select').find('option:selected').remove().appendTo('#selected_module');
    
});

$('[id^=\"btnLeft\"]').click(function (e) {

    $(this).next('select').find('option:selected').remove().appendTo('#sub_mods');

});
function selectAll(selectBox,selectAll) { 
    // have we been passed an ID 
    if (typeof selectBox == "string") { 
        selectBox = document.getElementById(selectBox);
    } 
    // is the select box a multiple select box? 
    if (selectBox.type == "select-multiple") { 
        for (var i = 0; i < selectBox.options.length; i++) { 
             selectBox.options[i].selected = selectAll; 
        } 
    }
}
</script>



