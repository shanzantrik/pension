<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<label style="float: left; margin: 4px 10px 0 0;">File No.</label><input type="text" id="case_no" name="case_no" /><input type="button" class="btn" id="generate" value="Generate ID Card" style="margin: 0 0 9px 10px;" />
<div id="print" style="display: none;">
	<?php echo $design; ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#generate').click(function() {
			if($('#case_no').val()=="") {
				$('#print').hide();
				alert("Please enter a file number.");
				$('#case_no').focus();
			}else{
				$.post('<?php echo site_url("administrator/idcard/checkFileNo"); ?>', {fileNo: $('#case_no').val()}, function(result){
					if(result==""){
						$('#print').hide();
						alert("File number not exists.");
						$('#case_no').val('').focus();
					} else {
						callback($.trim(result));
					}
				});
			}
		});

		var callback = function(serial_no) {
			$.post('<?php echo site_url("administrator/idcard/getValue"); ?>', {serial_no: serial_no}, function(result) {
				console.log(result);
				var res = JSON.parse(result);
				var data = res.details[0];
				var spanStyle = '';
				spanStyle = $('#span_pensioner_name').attr('style');
				$('<span style="'+spanStyle+'">'+data.name+'</span>').insertAfter($('#span_pensioner_name')).next('span').remove();
				spanStyle = $('#span_spouse_name').attr('style');
				$('<span style="'+spanStyle+'">'+data.family_info+'</span>').insertAfter($('#span_spouse_name')).next('span').remove();
				spanStyle = $('#span_residential_address').attr('style');
				$('<span style="'+spanStyle+'">'+data.address_after_retirement+'</span>').insertAfter($('#span_residential_address')).next('span').remove();
				spanStyle = $('#span_telephone').attr('style');
				$('<span style="'+spanStyle+'">'+data.phone_no+'</span>').insertAfter($('#span_telephone')).next('span').remove();
				spanStyle = $('#span_dob').attr('style');
				$('<span style="'+spanStyle+'">'+data.dob+'</span>').insertAfter($('#span_dob')).next('span').remove();
				spanStyle = $('#span_cop').attr('style');
				$('<span style="'+spanStyle+'">'+data.class_of_pension+'</span>').insertAfter($('#span_cop')).next('span').remove();
				spanStyle = $('#span_designation').attr('style');
				$('<span style="'+spanStyle+'">'+data.designation+'</span>').insertAfter($('#span_designation')).next('span').remove();
				spanStyle = $('#span_pay_scale').attr('style');
				$('<span style="'+spanStyle+'">'+data.pay_scale+'</span>').insertAfter($('#span_pay_scale')).next('span').remove();
				spanStyle = $('#span_last_pay').attr('style');
				$('<span style="'+spanStyle+'">'+data.pay_info+'</span>').insertAfter($('#span_last_pay')).next('span').remove();
				spanStyle = $('#span_ae').attr('style');
				$('<span style="'+spanStyle+'">'+data.ae+'</span>').insertAfter($('#span_ae')).next('span').remove();
				spanStyle = $('#span_qualifying_service').attr('style');
				$('<span style="'+spanStyle+'">'+data.net_qualifying_service+'</span>').insertAfter($('#span_qualifying_service')).next('span').remove();
				spanStyle = $('#span_pension_originally_sanctioned').attr('style');
				$('<span style="'+spanStyle+'">'+data.amount_of_pension+'</span>').insertAfter($('#span_pension_originally_sanctioned')).next('span').remove();
			});
			$('#print').show();
		}
	});
</script>