<script type="text/javascript" src="<?php echo base_url('includes/js/jscolor/jscolor.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('includes/js/jquery.uploadify/jquery.uploadify.min.js'); ?>"></script>
<link href="<?php echo base_url('includes/css/jquery.uploadify/uploadify.css'); ?>" rel="stylesheet" type="text/css">
<div id="preference">
	<small style="font-family:'Segoe UI'; font-size:12px; border:1px thin white; color:#000; font-weight:800"> Please select custom fields to be populated on the ID Card</small><br /><br />
	<input type="checkbox" name="pensioner_name" id="pensioner_name" /> Pensioner's Name<br />
	<input type="checkbox" name="spouse_name" id="spouse_name" /> Spouse Name<br />
	<input type="checkbox" name="residential_address" id="residential_address" /> Residential Address<br />
	<input type="checkbox" name="telephone" id="telephone" /> Telephone<br />
	<input type="checkbox" name="blood_group" id="blood_group" /> Blood Group<br />
	<input type="checkbox" name="dob" id="dob" /> Date of Birth<br />
	<input type="checkbox" name="cop" id="cop" /> Class of Pension<br />
	<input type="checkbox" name="designation" id="designation" /> Designation<br />
	<input type="checkbox" name="pay_scale" id="pay_scale" /> Pay Scale<br />
	<input type="checkbox" name="last_pay" id="last_pay" /> Last Pay<br />
	<input type="checkbox" name="ae" id="ae" /> Average Emoluments<br />
	<input type="checkbox" name="qualifying_service" id="qualifying_service" /> Qualifying Service<br />
	<input type="checkbox" name="pension_originally_sanctioned" id="pension_originally_sanctioned" /> Pension Originally Sanctioned<br />
	<input type="checkbox" name="ppo" id="ppo" /> P.P.O. No. and Date<br />
</div>
<div id="idcontent">
	<?php
	if(!empty($design)) {
		echo $design;
	} else { ?>
		<h2>Front</h2>
		<div id="idcard-design-front" style="font-family: Georgia, Times New Roman, Times, serif; width: 340px; height: 220px; background: url('<?php echo base_url("includes/images/idcard/2.jpg"); ?>');">
			<div id="header" style="height: 60px; padding: 4px; background: #007D3B; color: #fff;">
				<div id="logo" style="position: relative; left: 9px; top: 7px;"><img src="<?php echo base_url("includes/images/idcard/logo1.png"); ?>" width="80" /></div>
				<div id="header-text" style="position: relative; left: 92px; top: -31px; font-size: 11px; font-weight: 700;">DEPARTMENT OF AUDIT & PENSION<br /><span style="font-size: 10px">Accounts & Treasuries, D-Sector, Naharlagun</span></div>
			</div>
			<div class="content" style="padding-right: 10px;">
				<span id="span_pensioner_name" rel="name" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Pensioner's Name: </a></span><br />
				<span id="span_spouse_name" rel="family_info" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Name of Spouse: </a></span><br />
				<span id="span_residential_address" rel="address_after_retirement" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Residential Address: </a></span><br />
				<span id="span_telephone" rel="phone_no" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Telephone: </a></span><br />
				<span id="span_blood_group" rel="blood_group" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Blood Group: </a></span><br />
			</div>
		</div>

		<h2>Back</h2>
		<div id="idcard-design-rear" style="font-family: Georgia, Times New Roman, Times, serif; width: 340px; height: 220px; background: url('<?php echo base_url("includes/images/idcard/2.jpg"); ?>');">
			<div class="content" style="padding-right: 10px;">
				<span id="span_dob" rel="dob" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Date of Birth: </a></span><br />
				<span id="span_cop" rel="class_of_pension" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Class of Pension: </a></span><br />
				<span id="span_designation" rel="designation" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Designation: </a></span><br />
				<span id="span_pay_scale" rel="pay_scale" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Pay Scale: </a></span><br />
				<span id="span_last_pay" rel="pay_info" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Last Pay: </a></span><br />
				<span id="span_ae" rel="ae" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Average Emoluments: </a></span><br />
				<span id="span_qualifying_service" rel="net_qualifying_service" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Qualifying Service: </a></span><br />
				<span id="span_pension_originally_sanctioned" rel="amount_of_pension" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">Pension Originally Sanctioned: </a></span><br />
				<span id="span_ppo" rel="dob" style="display: none;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;">P.P.O. No. and Date: </a></span><br />
				<div id="instruction" rel="instruction" style="font-size: 8px;line-height: 12px;margin: 12px 8px 5px 12px;"><a href="#test_modal" class="box-modal" data-toggle="modal" style="text-decoration: none; color: black;"><b>Instruction to the card holder</b> The card holder must keep this card under safe custody; any loss of the card should be reported to the Card Issuing Authority and the nearest Police Station.</a></div>
			</div>
		</div>
	<?php } ?>
</div>
<div id="idstyle">
	<small style="font-family:'Segoe UI'; font-size:12px; border:1px thin white; color:#000; font-weight:800"> Design your ID Card.</small>
	<div class="form-group">
	    <label class="col-sm-3 control-label">Background</label>
	    <div class="col-sm-6">
	    	<div id="queue"></div>
	        <input type="file" name="background" id="background" />
	    </div>
	</div>

	<div class="form-group">
	    <label class="col-sm-3 control-label">Font Family</label>
	    <div class="col-sm-6">
	    	<select name="font-family" id="font-family">
				<option value="Georgia, Times New Roman, Times, serif" selected="selected">Georgia, Times New Roman, Times, serif</option>
				<option value="Verdana, Geneva, sans serif">Verdana, Geneva, sans serif</option>
				<option value="Arial, Helvetica, sans serif">Arial, Helvetica, sans serif</option>
				<option value="Tahoma, Geneva, sans serif">Tahoma, Geneva, sans serif</option>
				<option value="Trebuchet MS, Arial, Helvetica, sans serif">Trebuchet MS, Arial, Helvetica, sans serif</option>
				<option value="Arial Black, Gadget, sans serif">Arial Black, Gadget, sans serif</option>
				<option value="Times New Roman, Times, serif">Times New Roman, Times, serif</option>
				<option value="Palatino Linotype, Book Antiqua, Palatino, serif">Palatino Linotype, Book Antiqua, Palatino, serif</option>
				<option value="Lucida Sans Unicode, Lucida Grande, sans serif">Lucida Sans Unicode, Lucida Grande, sans serif</option>
				<option value="MS Serif, New York, serif">MS Serif, New York, serif</option>
				<option value="Comic Sans MS, cursive">Comic Sans MS, cursive</option>
				<option value="Segoe UI">Segoe UI</option>
			</select>
		</div>
	</div>

	<div class="form-group">
	    <label class="col-sm-3 control-label">Header Background Colour</label>
	    <div class="col-sm-6">
	        <input class="color" name="header_background_colour" id="header_background_colour" type="text" value="007D3B">
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-sm-3 control-label">Header Font Colour</label>
	    <div class="col-sm-6">
	        <input class="color" name="header_font_colour" id="header_font_colour" type="text" value="fffff">
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-sm-3 control-label">Body Font Colour</label>
	    <div class="col-sm-6">
	        <input class="color" name="body_font_colour" id="body_font_colour" type="text" value="000000">
	    </div>
	</div>
</div>
<input type="submit" class="btn" id="save-settings" value="Save Settings">

<div class="modal fade" id="test_modal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Change Style</h3>
	</div>
	<div class="modal-body">
		<label>Font Size</label>
		<input type="number" name="text-font-size" id="text-font-size" />
		<input type="hidden" name="spanId" id="spanId" />
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
		<a href="#" id="save-modal" class="btn btn-primary">Save Changes</a>
	</div>
</div>


<style type="text/css">
	#preference, #idstyle {width: 25%; float: left;}
	#idcontent {width: 50%; float: left;}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('#background').uploadify({
			'formData'     : {
				'timestamp' : '1403257026',
				'token'     : '7d16dc29228859473587eb713e3a2ff3'
			},
			'swf'      : '<?php echo base_url("includes/js/jquery.uploadify/uploadify.swf"); ?>',
			'uploader' : '<?php echo site_url("administrator/idcard/uploadBackgroundDesign"); ?>',
			'onUploadComplete' : function(file, response, data) {
            	var path = "<?php echo base_url('uploads/idcard/'); ?>/"+file.name;
            	$('#idcard-design-front, #idcard-design-rear').css('background', 'url('+path+')');
            }
		});
		$('#font-family').live('change', function(){
			$('#idcard-design-front, #idcard-design-rear').css('font-family', $(this).val());
		});
		$('#header_background_colour').live('change', function(){
			$('#idcard-design-front #header').css('background', '#'+$(this).val());
		});
		$('#header_font_colour').live('change', function(){
			$('#idcard-design-front #header').css('color', '#'+$(this).val());
		});
		$('#body_font_colour').live('change', function(){
			$('#idcard-design-front .content a, #idcard-design-rear .content a').css('color', '#'+$(this).val());
		});

		$('#preference input:checkbox').each(function(){
			var id = $(this).attr('id');
			fieldsSelected(id);
		});
		$('.content span').draggable().css({'font-weight': 'bold'});
		<?php if(empty($design)) { ?>
			$('.content span').css({'font-size': '11px'});
		<?php } ?>
		$('#logo, #header-text, #header').draggable();

		$('.box-modal').live('click', function(){
			var me = $(this);
			var spanId = me.parent('span').attr('id');
			var fontSize = me.css('font-size');
			$('#test_modal').modal({
			  	keyboard: false
			});
			$('#text-font-size').val(parseInt(fontSize, 10));
			$('#spanId').val(spanId);
		});

		$('#save-modal').live('click', function(){
			var fontSize = $('#text-font-size').val();
			$('#test_modal').modal('hide');
			var currentSpan = $('#spanId').val();
			$('#'+currentSpan).css('font-size', fontSize+'px');
		});

		$('#save-settings').click(function(){
			var content = $('#idcontent').html();
			$.post("<?php echo site_url('administrator/idcard/saveTemplateforIDcard'); ?>", {content: content}, function(data) {
                if(data == "ok"){
                	alert("Template saved Successfully.");
                } else {
                	alert("Error occured while saving.");
                }
            });
		});

		$('#idcard-design-front .content span, #idcard-design-rear .content span').each(function(){
			if($(this).css('display') == "inline") {
				var id = $(this).attr('id').substring(5);
				$('#'+id).attr('checked', 'true');
			}
		});
	});

	var fieldsSelected = function(idName) {
		$('#'+idName).live('change', function(){
			if($(this).is(':checked')) {
				$('#span_'+idName).show();
			} else {
				$('#span_'+idName).hide();
			}
		});
	}

</script>