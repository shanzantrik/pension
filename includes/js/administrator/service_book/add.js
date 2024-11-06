$(document).ready(function(){
	$('.multiselect').multiselect();
	$('#employee_type').change(function(){
		var emp_type = $(this).val();
		if(emp_type == 'Doctor') {
			$('#npa, #increament_npa').removeAttr('readonly');
		} else if(emp_type == 'Non_Doctor') {
			$('#npa, #increament_npa').attr('readonly', 'true');
			$('#npa, #increament_npa').val(0);
		} else {}
	});
	$('#gross_pay').blur(function(){
		calculateDA($('#basic_salary').val(), $('#gross_pay').val(), $('#npa').val());
	});
	$('#npa').blur(function(){
		calculateDA($('#basic_salary').val(), $('#gross_pay').val(), $('#npa').val());
	});
	$('#increament_bp').keyup(function(){
		if($(this).val() > 0) {
			$('#last_increament_date').removeAttr('disabled');
		} else {
			$('#last_increament_date').attr('disabled', 'true');
		}
	});
	$('#class_of_pension').change(function(){
		console.log($(this).val());
		if($(this).val()=="Absorption_in_autonomous_body_pension") {
			$('#pension_scheme').remove();
			var pension_scheme = '<div class="form-group" id="pension_scheme"><label class="col-sm-3 control-label">Pension Scheme</label><div class="col-sm-6"><input type="radio" name="pension_scheme" value="yes" checked> Yes <input type="radio" name="pension_scheme" value="no"> No</div></div>';
			$('#form-group-cop').after(pension_scheme);
			$('#form-group-pension-category').hide();
			$('#form-group-pension-for').hide();
		} else if ($(this).val()=="Extraordinary_Pension") {
			$('#pension_scheme').remove();
			$('#form-group-pension-category').show();
		} else {
			$('#pension_scheme').remove();
			$('#form-group-pension-category').hide();
			$('#form-group-pension-for').hide();
		}
	});
	$('#pension_category').change(function(){
		if($(this).val() == 'B' || $(this).val() == 'C') {
			$('#pension_scheme').remove();
			$('#space-for-pension-group').remove();
			$('#form-group-pension-for').hide();
			var pension_scheme = '<div id="pension_scheme"><div class="form-group" style="height: 30px;"></div><div class="form-group"><label class="col-sm-3 control-label">Pension Scheme</label><div class="col-sm-6"><input type="radio" name="pension_scheme" value="yes" checked> Yes <input type="radio" name="pension_scheme" value="no"> No</div></div></div>';
			$('#form-group-pension-category').after(pension_scheme);
		} else if ($(this).val() == 'D' || $(this).val() == 'E') {
			$('#pension_scheme').remove();
			$('#space-for-pension-group').remove();
			$('#form-group-pension-for').before('<div class="form-group" id="space-for-pension-group" style="height: 30px;"></div>').show();
		} else {
			$('#pension_scheme').remove();
			$('#space-for-pension-group').remove();
			$('#form-group-pension-for').hide();
		}
	});
});

$(function() {
	$("#dob").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
	$("#doj").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
		var age_at_joining = calculateAge($("#dob").val(), date);
		$('#age_at_joining').val(parseInt(age_at_joining));
    }});
    $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
		var age_at_retirement = calculateAge($("#dob").val(), date);
		$('#age_at_retirement').val(age_at_retirement);
		$('#total_service').val(calculateTotalService($("#doj").val(), $("#dor").val()));
    }});
    $("#dod").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    $("#last_increament_date").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    $('#less_non_qaulifing_service').blur(function() {
    	$('#net_qualifing_service').val(calculateNQS($('#total_service').val(), $('#less_non_qaulifing_service').val()));
    });
});

function calculateAge (birthDate, otherDate) {
    birthDate = new Date(birthDate);
    otherDate = new Date(otherDate);

    var years = (otherDate.getFullYear() - birthDate.getFullYear());

    if (otherDate.getMonth() < birthDate.getMonth() || 
        otherDate.getMonth() == birthDate.getMonth() && otherDate.getDate() < birthDate.getDate()) {
        years--;
    }
    return years;
}

function calculateTotalService(date1, date2) {
	var d1 = new Date(date1);
	var d2 = new Date(date2);
	var month_diff = (d2.getFullYear() - d1.getFullYear()) * 12 + d2.getMonth() - d1.getMonth();
	var years = Math.floor(month_diff / 12);
	var months = month_diff % 12;
	return years + ' years ' + months + ' months';
}

function calculateNQS(total_service, less_non_qaulifing_service) {
	var tsy, tsm, lnqsy, lnqsm, difference, years, months;
	data1 = total_service.split(" ");
	data2 = less_non_qaulifing_service.split(" ");
	tsy = data1[0];
	tsm = data1[2];
	lnqsy = data2[0];
	lnqsm = data2[2];
	tstotal = parseInt(tsy) * 12 + parseInt(tsm);
    nqstotal = parseInt(lnqsy) * 12 + parseInt(lnqsm);
    difference = tstotal - nqstotal;
    years = Math.floor(parseInt(difference)/12);
    months = parseInt(difference%12);
    return years + ' years ' + months + ' months';
}