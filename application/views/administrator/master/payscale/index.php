<script src="<?php echo base_url('includes/js/jQuery-validate/jquery.validate.js'); ?>"></script>
<script data-jsfiddle="common" src="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.js" data-jsfiddle="common"></script>
<link href="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.css" data-jsfiddle="common" rel="stylesheet" media="screen">

<div id="main-container">



	<div>
		<p class="user-message"><i>(To add new pay scale to fitment table click on <span style="color:red">Add fitment table</span> Button)</i></p>
		<a href="#" class="open-dialog btn btn-primary add-fitment-table" style="float:right"><i class="icon-plus"></i>Add fitment table</a>

		<br /><br />
		<div id="add-fitment-table-form" style="display: none;">
			<div id="add-fitment-list-table"></div>
			<br />
			<input type="button" id="fitment-table-save-btn" name="fitment-table-save-btn" value="Save" disabled class="btn btn-primary" />
		</div>
	</div>

	<div class="left">
		<legend style="font-size:15px; color:#3b5999; font-weight:700">All Pay Scale</legend>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="pay-scale-table" width="100%">
		    <thead>
		        <tr>
		            <th width="25%">Grade</th>
		            <th width="25%">Pay Scale</th>
		            <th width="25%">Pay Commission</th>
		            <th width="25%">Actions</th>
		        </tr>
		    </thead>
		    <tbody>

		    	<?php foreach (getPayScale() as $list) { ?>

		    		<tr id="<?php echo $list['id']; ?>">
			            <td><?php echo $list['grade']; ?></td>
			            <td><?php echo $list['pay_scale']; ?></td>
			            <td><?php echo $list['pay_commission']; ?></td>
			            <td>
			            	<a title="Edit pay scale" href="<?php echo site_url('administrator/master/payscale_index/'.$list['id']); ?>"><i class="icon-pencil"></i></a>
			            </td>  
			        </tr>
		    	<?php } ?>
		    </tbody>
		</table>
	</div>

	<div class="right">

		<?php
			if(isset($payscale) && count($payscale) > 0) :
				$id = $payscale[0]['id'];
				$grade = $payscale[0]['grade'];
				$pay_scale = $payscale[0]['pay_scale'];
				$pay_commission = $payscale[0]['pay_commission'];
				$related = $payscale[0]['related'];
			else :
				$id = '';
				$grade = '';
				$pay_scale = '';
				$pay_commission = '';
				$related = '';
			endif;
		?>	

		<legend style="font-size:15px; color:#3b5999; font-weight:700">Pay Scale Panel » <small style="font-size:11px"> Please enter pay scale information.</small></legend>
		<form name="payscale_form" id="payscale_form" action="<?php echo site_url('administrator/master/payscale_save'); ?>" method="post">
			<table class="table table-striped table-bordered">
				<tr>
					<td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Grade</label></td>
					<td><input name="grade" type="text" value="<?php echo $grade; ?>" /><input type="hidden" name="pay_scale_id" value="<?php echo $id; ?>" /></td>
				</tr>
				<tr>
					<td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Pay Scale</label></td>
					<td><input name="pay_scale" type="text" value="<?php echo $pay_scale; ?>" /></td>
				</tr>
				<tr>
					<td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Pay Commission</label></td>
					<td>
						<select name="pay_commission" id="pay_commission">
							<option value="0">--SELECT--</option>
							<?php foreach(getPayComm() as $paycom) : ?>
								<?php if($paycom['id'] == $pay_commission) : ?>
									<option value="<?php echo $paycom['id']; ?>" selected><?php echo $paycom['name']; ?></option>
								<?php else : ?>
									<option value="<?php echo $paycom['id']; ?>"><?php echo $paycom['name']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Related To</label></td>
					<td>
						<?php
							$pc1 = array();
							if($related != '') :
								$pc = getPayCommission('pay_commission', array('id'=>$related));
								if(count($pc) > 0) :
									$pc1 = getPayCommission('id, grade, pay_scale, pay_commission', array('pay_commission'=>$pc[0]['pay_commission']));
								endif;
							endif;
						?>
						<select name="related" id="related">
							<option value="0">--SELECT--</option>
							<?php foreach($pc1 as $row) : ?>
								<?php if($row['id'] == $related) : ?>
									<option value="<?php echo $row['id']; ?>" selected><?php echo $row['grade']." - ".$row['pay_scale']; ?></option>
								<?php else : ?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['grade']." - ".$row['pay_scale']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;"><input type="submit" name="save_pay_scale" value="Save pay scale" class="btn btn-success" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
	var data = [];
	var $container = $("#add-fitment-list-table");
	$container.handsontable({
		data: data,
		minSpareRows: 1,
		contextMenu: true,
		afterChange: function(changes, source) {
			if(source === "loadData") {
				return;
			}
			if(source === "paste") {
				if($('.htCore td').hasClass('htInvalid')) {
					$('#fitment-table-save-btn').attr('disabled', 'true');
				} else {
					$('#fitment-table-save-btn').removeAttr('disabled');
				}
			}
			if(source === "edit") {
				if($('.htCore td').hasClass('htInvalid')) {
					$('#fitment-table-save-btn').attr('disabled', 'true');
				} else {
					$('#fitment-table-save-btn').removeAttr('disabled');
				}
			}
		},
		colHeaders: ['Scale', 'Pre revised basic pay', 'Pay band', 'Grade pay', 'Revised basic pay'],
		columns: [
	        { data: 'scale' },
	        { data: 'pre_revised_basic_pay', type: 'numeric', format: '0, 0.0' },
	        { data: 'pay_band', type: 'numeric', format: '0, 0.0' },
	        { data: 'grade_pay', type: 'numeric', format: '0, 0.0' },
	        { data: 'revised_basic_pay', type: 'numeric', format: '0, 0.0' }
	    ]
	});

	var handsontable = $container.data('handsontable');
	$(document).ready(function() {
		$('#pay-scale-table').dataTable();

		$("#payscale_form").validate({
            rules: {grade: {required: true, AZ09_: true}, pay_scale: {required: true, AZ09_: true}, pay_commission: {selectcheck: true}}
        });

        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        }, "Please select.");

		jQuery.validator.addMethod('AZ09_', function (value) { 
		    return /^[a-zA-Z0-9-+]+$/.test(value); 
		}, 'Only letters, numbers and - are allowed');

		$('.add-fitment-table').on('click', function(){
			$('#add-fitment-table-form').slideToggle();
			$('.htCore').width($('#add-fitment-list-table').width());
		});

		$('#fitment-table-save-btn').click(function() {
			$.post("<?php echo site_url('administrator/master/payscale_saveFitmentTable'); ?>", {data: handsontable.getData()}, function(result) {
				alert(result);
			});
		});

		$('#pay_commission').on('change', function() {
            var me = $(this);
            
            $.post('<?php echo site_url("administrator/ips/getPreRevisedPayScale/"); ?>', {payCommission: parseInt(me.val())-1}, function(data) {
                $('#related').html(data);
            });
        });
	});

</script>

<style type="text/css">
	#main-container {width: 100%;}
	#main-container .left {float: left; width: 63%; padding: 5px 10px 0px 0px;}
	#main-container .right {float: left; width: 36%; padding-top: 4px;}
	#main-container .right td {vertical-align: top;}
	.clear {clear: both;}
</style>