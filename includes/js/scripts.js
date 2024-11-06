$(document).ready(function() {


    $('.spouse_salutation').live('change', function()
    {
        trID = $(this).closest('tr').attr('id');
        if($(this).val() == 'mr' || $(this).val() == 'Md')
        {
            html = '<option value="">--Please Select--</option><option value="husband">Husband</option><option value="father">Father</option><option value="legal heir">Legal Heir</option>';
        } else {
            html = '<option value="">--Please Select--</option><option value="wife">Wife</option><option value="mother">Mother</option><option value="legal heir">Legal Heir</option>';
        }
        $('#'+trID+' .family_relation').html(html);
    });

    $('#cash_received, #dob, #dojac, #dojap, #dor, #dod, .dob, .dod').bind('paste', function(e) {
        e.preventDefault();
        return false;
    });

    $('#class_of_pension').change(function() {
        checkPensionCase();
    });

    $('#pension_category').change(function() {
        if($(this).val() == 'B' || $(this).val() == 'C') {
            hidePensionFor();
            showPensionScheme();
        } else if ($(this).val() == 'D' || $(this).val() == 'E') {
            hidePensionScheme();
            showPensionFor();
        } else {
            hidePensionScheme();
            hidePensionFor();
        }
    });

    addChild();
    changeLegalHeir();

    $('#treasury_officer').change(function() {
        if($(this).val() != '') {
            $('#name_of_accountant_general').val(0).attr('disabled', true);
            $('#sub_to').attr('disabled', true);
        } else {
            $('#name_of_accountant_general').attr('disabled', false);
            $('#sub_to').attr('disabled', false);
        }
    });

    $('#name_of_accountant_general').change(function() {
        if($(this).val() != '') {
            $('#sub_to').attr('required', true);
            $('#treasury_officer').attr('disabled', true);
        } else {
            $('#sub_to').val('').attr('required', false);
            $('#treasury_officer').attr('disabled', false);
        }
    });

    $('#revise_type').change(function(){
        if($(this).val()=="revised") {
            $('.dearness_pay_group').show();
            $('#aepd').css('min-height', '210px');
        } else {
            $('.dearness_pay_group').hide();
            $('#aepd').css('min-height', '0px');
        }
    });

    $('.appointas').change(function(){
        checkAppointAs();
    });

    $('#service-book-form').submit(function() {
        var percentageTotal = 0;
        $('#myTable .percentage').each(function() {
            var c = parseFloat($(this).val()) || 0;
            percentageTotal=percentageTotal+c;
        });
        if(percentageTotal > 100 || percentageTotal < 100) {
            alert('Percentage for amount of pension should not be less then or more then 100%.');
            $('#myTable .percentage:first').focus();
            return false;
        } else {
            return true;
        }
    });

    $( "#aloc_date" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth:true,
        yearRange:'2012:2020'
    });
});

$('#increament_bp').keyup(function(){
    if($(this).val() > 0) {
        $('#increament_gp, #increament_npa, #last_increament_date').removeAttr('readonly');
    } else {
        $('#increament_gp, #increament_npa, #last_increament_date').attr('readonly', 'true');
    }
});

$(document).on('click','.scrollToTop', function(event) {
    event.preventDefault();
    var target = "#" + this.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 500);
});

//function start from here //bikram
var dateDiff = function(d1, d2, includeCurrentDate, isObject) {
    //d1 and d2 in YYYY-MM-DD format to use this function
    includeCurrentDate  = includeCurrentDate || 'true';
    isObject            = isObject || 'false';
    a = moment(d1, "YYYY-MM-DD").format('YYYY-MM-DD');
    if(includeCurrentDate == 'true') {
        b = moment(d2, "YYYY-MM-DD").add(1, 'day').format('YYYY-MM-DD');
    } else {
        b = moment(d2, "YYYY-MM-DD").format('YYYY-MM-DD');
    }
    var result = '';
    if(isObject == 'true') {
        result = moment.preciseDiff(a, b, true);
    } else {
        result = moment.preciseDiff(a, b);
    }
    delete a;
    delete b;
    return result;
}

var ageAtJoining = function(dob, d2) {
    result = dateDiff(dob, d2, 'true', 'true');
    $('#aeyear').val(result.year);
    $('#aemonth').val(result.month);
    $('#aeday').val(result.day);
    delete result;
}

var ageAtRetirement = function() {
    dor = '';
    dob = $('#dob').val();
    cop = $('#class_of_pension').val();

    switch($('#class_of_pension').val()) {
        case 'Superannuation_Pension':
        case 'Voluntary_Retirement_Pension':
        case 'Invalid_Retirement_Pension':
        case 'Absorption_in_autonomous_body_pension':
        case 'Disability_Pension':
        case 'Compulsory_Retirement_Pension':
            dor = $('#dor').val();
            result = dateDiff(dob, dor, 'true', 'true');
            break;
        case 'Normal_Family_Pension':
            dor = $('#dor').val();
            if(dor == '' || dor == '0000-00-00') {
                dor = $('#dod').val();
                if(dor != '') {
                    result = dateDiff(dob, dor, 'true', 'true');
                } else {
                    result = {year: '', month: '', day: ''};
                }
            } else {
                dor = $('#dor').val();
                result = dateDiff(dob, dor, 'true', 'true');
            }
            break;

        case 'NPS':
            dor = $('#dor').val();
            if(dor == '' || dor == '0000-00-00') {
                dor = $('#dod').val();
                if(dor != '') {
                    result = dateDiff(dob, dor, 'true', 'true');
                } else {
                    result = {year: '', month: '', day: ''};
                }
            } else {
                dor = $('#dor').val();
                result = dateDiff(dob, dor, 'true', 'true');
            }
            break;    
        default:
            dor = $('#dod').val();
            if(dor != '') {
                result = dateDiff(dob, dor, 'true', 'true');
            } else {
                result = {year: '', month: '', day: ''};
            }
            break;
    }

    $('#aryear').val(result.year);
    $('#armonth').val(result.month);
    $('#arday').val(result.day);
    delete result;
    delete dor;
}

var effectOfPension = function(date) {
    var eop = moment(date, "YYYY-MM-DD").add(1, 'day').format('YYYY-MM-DD');
    $('#effect_of_pension').val(eop);
}

var showPensionScheme = function() {
    $('#pension_scheme').show();
    $('#pension_scheme input[type="radio"]').attr('required', true);
}

var showPensionCategory = function() {
    $('#form-group-pension-category').show();
    $('#pension_category').attr('required', true);
}

var showPensionFor = function() {
    $('#form-group-pension-for').show();
    $('#pension_for').attr('required', true);
}

var showCompulsoryRate = function() {
    $('#compulsory_rate').show();
    $('#compulsory_rate input[type="radio"]').attr('required', true);
}

var showDisability = function() {
    $('#disability_catagory, #disability_percent').show();
    $('#disability_catagory select, #disability_percent select').attr('required', true);
}

var showDOR = function() {
    $('.label-dor').html('Date of retirement <span class="required-field">*</span>');
    $('.label-aor').html('Age at retirement');
    $('#dor').attr('required', 'required').attr('placeholder', 'Please Enter Date of retirement');
    $('#dor').parent('.col-sm-6').parent('.form-group').show();
}

var showDOD = function() {
    $('.label-dod').html('Date of death <span class="required-field">*</span>');
    $('#dod').attr('required', 'required').attr('placeholder', 'Please Enter Date of death');
    $('#dod').parent('.col-sm-6').parent('.form-group').show();
}

var showAbsorption = function() {
    $('.label-dor').html('Date of absorption <span class="required-field">*</span>');
    $('.label-aor').html('Age at absorption');
    $('#dor').attr('placeholder', 'Please Enter Date of absorption');
    $('#dor').parent('.col-sm-6').parent('.form-group').show();
}

var enableDOR = function() {
    $('#dor').attr('readonly', false);
    changeDOR();
}

var hidePensionScheme = function() {
    $('#pension_scheme').hide();
    $('#pension_scheme input[type="radio"]').attr('required', false).attr('checked', false);
}

var hidePensionCategory = function() {
    $('#form-group-pension-category').hide();
    $('#pension_category').val('').attr('required', false);
}

var hidePensionFor = function() {
    $('#form-group-pension-for').hide();
    $('#pension_for').val('').attr('required', false);
}

var hideCompulsoryRate = function() {
    $('#compulsory_rate').hide();
    $('#compulsory_rate input[type="radio"]').attr('required', false).attr('checked', false);
}

var hideDisability = function() {
    $('#disability_catagory, #disability_percent').hide();
    $('#disability_catagory select, #disability_percent select').val('').attr('required', false);
}

var hideDOR = function() {
    $('#dor').removeAttr('required').attr('placeholder', 'Please Enter Date of retirement');
    $('#dor').parent('.col-sm-6').parent('.form-group').hide();
}

var hideDOD = function() {
    $('#dod').removeAttr('required').attr('placeholder', 'Please Enter Date of death');
    $('#dod').parent('.col-sm-6').parent('.form-group').hide();
}

var disableDOR = function() {
    if($('#action_type').val() == "edit") {
        $('#dor').attr('readonly', true).datepicker("destroy");
    } else {
        $('#dor').val('').attr('readonly', true).datepicker("destroy");
    }
}


var checkPensionCase = function() {
    var cop = $('#class_of_pension').val();

    if(cop == "Absorption_in_autonomous_body_pension") {
        hidePensionFor();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        showAbsorption();
        showPensionScheme();
        enableDOR();
        hideDOD();
    } else if(cop == "Extraordinary_Pension") {
        hidePensionScheme();
        hideCompulsoryRate();
        hideDisability();
        showPensionCategory();
        showDOR();
        disableDOR();
        hideDOR();
        showDOD();
    } else if(cop == "Compulsory_Retirement_Pension") {
        hidePensionCategory();
        hidePensionScheme();
        hidePensionFor();
        hideDisability();
        showCompulsoryRate();
        showDOR();
        hideDOD();
    } else if(cop == "Disability_Pension") {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        showDisability();
        showDOR();
        hideDOD();
    } else if(cop == 'Voluntary_Retirement_Pension' || cop == 'Invalid_Retirement_Pension') {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        enableDOR();
        showDOR();
        hideDOD();
    } else if(cop == 'Normal_Family_Pension') {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        enableDOR();
        showDOR();
        showDOD();
        $('#dor').removeAttr('required');
        $('.label-dor').html('Date of retirement');
    } 

    else if(cop == 'NPS') {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        enableDOR();
        showDOR();
        showDOD();
        $('#dor').removeAttr('required');
        $('.label-dor').html('Date of retirement');
    } 
    else if(cop == 'Superannuation_Pension') {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        hideDOD();
        showDOR();
        disableDOR();
    } else if(cop == 'Liberalised_Pension' || cop == 'Dependent_Pension' || cop == 'Parents_Pension') {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        hideDOR();
        showDOD();
    } else {
        hidePensionFor();
        hidePensionScheme();
        hidePensionCategory();
        hideCompulsoryRate();
        hideDisability();
        disableDOR();
        showDOR();
        showDOD();
    }
    
    switch(cop) {
        case 'Superannuation_Pension':
        case 'Voluntary_Retirement_Pension':
        case 'Invalid_Retirement_Pension':
        case 'Absorption_in_autonomous_body_pension':
        case 'Disability_Pension':
        case 'Compulsory_Retirement_Pension':
            $('#dod').attr('disabled', 'disabled');
            break;
        default:
            $('#dod').removeAttr('disabled');
            break;
    }
}

var appointasChange = function() {
    if($('.form-group-dojac').hasClass('show')) {
        return 'dojac';
    } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
        $('#dojac').datepicker("enable");
        return 'dojap';
    } else {}
}

var onPayCommissionChange = function(url) {
    var me = $('#pay-commission');
    $.post(url, {payCommission: parseInt(me.val())}, function(data) {
        $('#pay_scale').html(data);
    });
}

var getFileDetails = function(url) {
    case_no = $('#case_no').val();
    if(case_no != '') {
        $.post(url, {case_no: case_no}, function(data) {
            if(data!="") {
                var result = JSON.parse(data);
                //console.log(result);

                $('#cash_received').val(result.receipt_date);
                $('#name').val(result.pensionee_name);
                $('#salutation').val(result.salutation);
                if(result.salutation == 'Late') {
                    changeSexBox('select');
                } else {
                    changeSexBox('input');
                }
                $('#sex').val(result.sex);
                $('#designation').val(result.designation);
                $('#retire_age').val(result.retire_age)
                $('#submitted_document').val(result.files);
                $('#office_address').val(result.address_department);
            } else {
                alert('File number not matched.');
                $('#case_no').val('');
            }
        });
        delete case_no;
    }
}

var changeSexBox = function(input) {
    me = $('#sex');
    parent = me.parent('.col-sm-6');
    if(input == 'select') {
        me.remove();
        html = '<select id="sex" name="sex"><option value="Male">Male</option><option value="Female">Female</option></select>';
        parent.html(html);
    } else {
        me.remove();
        html = '<input type="text" id="sex" name="sex" readonly="readonly">';
        parent.html(html);
    }
    delete me;
    delete parent;
    delete html;
}

var addAccountantGeneral = function(url) {
    $('.saveAccountantName').click(function(){
        if($('#modalAccountantName').val()=='') {
            $('#modalAccountantMessage').html('Name is required.');
        } else {
            $.post(url, {accountantName: $('#modalAccountantName').val()}, function(data) {
                $('#addAccountantGeneral').modal('hide');
                $('#name_of_accountant_general').append('<option value='+data+' selected>'+$('#modalAccountantName').val()+'</option>');
                $('#modalAccountantName').val('');
            });
        }
    });
}

var addTreasuryOfficer = function(url) {
    $('.saveTreasuryTitle').click(function(){
        if($('#modalTreasuryTitle').val()=='') {
            $('#modalTreasuryMessage').html('Title is required.');
        } else {
            $.post(url, {treasuryTitle: $('#modalTreasuryTitle').val()}, function(data) {
                $('#addTreasuryOfficer').modal('hide');
                $('#treasury_officer').append('<option value='+data+' selected>'+$('#modalTreasuryTitle').val()+'</option>');
                $('#modalTreasuryTitle').val('');
            });
        }
    });
}


var checkAppointAs = function() {
    var me = $('.appointas');
    if(me.val()=="Adhoc" || me.val()=="Officiating" || me.val()=="WC" || me.val()=="Contract") {
        $('.form-group-dojac').css('display', 'block').removeClass('show hide').addClass('show');
        $('.form-group-dojap').css('display', 'block').removeClass('show hide').addClass('show');
    } else if(me.val()=="Temporary" || me.val()=="Permanent") {
        $('.form-group-dojac').css('display', 'none').removeClass('show hide').addClass('hide');
        $('.form-group-dojap').css('display', 'block').removeClass('show hide').addClass('show');
    } else {
        $('.form-group-dojac').css('display', 'none').removeClass('show hide').addClass('hide');
        $('.form-group-dojap').css('display', 'none').removeClass('show hide').addClass('hide');
    }

    if(appointasChange() == 'dojac') {
        $("#dojap").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
            if($(this).val() < $('#dojac').val()) {
                alert('Date of appointment as permanent should be greater than date of appointment as casual.');
                $(this).val('');
            } else {
                result = dateDiff($('#dojac').val(), date, 'false', 'true');
                var years, months, days, halfY, totalMonths, totalDays;
                halfY = result.year/2;
                totalMonths = halfY*12;
                totalDays = result.month/2*30;
                if(halfY < 1) {
                    years = 0;
                    months = Math.floor(totalDays/30)+totalMonths;
                    days = Math.floor(result.day/2)+totalDays%30;
                    //alert(years+"-"+months+"-"+days);
                } else {
                    years = Math.floor(totalMonths/12);
                    months = totalMonths%12;
                    days = Math.floor(result.day/2)+totalDays;
                    if(days==30) {months+=1; days=0;}
                    else if(days > 30) {months+=1; days=days%30}
                    //alert(years+"-"+months+"-"+days);
                }
                $('#diff_appoint_as_casual').val(years+"-"+months+"-"+days);
                delete result;
            }
        }});
        $("#dojac").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date) {
            if($('#dob').val() != '') {
                if($(this).val() <= $('#dob').val()) {
                    alert('Date of joining should be greater than date of birth.');
                    $(this).val('');
                } else {
                    ageAtJoining($('#dob').val(), date);
                }
            } else {
                alert('Please select date of birth field first.');
                $(this).val('');
                $('#dob').focus();
            }
        }});
    } else {
        $("#dojac").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
            if($('#dob').val() != '') {
                ageAtJoining($('#dob').val(), date);
            } else {
                alert('Please select date of birth field first.');
                $(this).val('');
                $('#dob').focus();
            }
        }});
        $("#dojap").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0', onSelect: function(date){
            if($('#dob').val() != '') {
                ageAtJoining($('#dob').val(), date);

                var h = dateDiff($(this).val(), $('#dob').val(), 'true', 'true');
                if(h.year < 16) {
                    alert('Date of appointment as permanent should be greater than 16 years from date of birth.');
                    $(this).val('');
                }
                delete h;
            } else {
                alert('Please select date of birth field first.');
                $(this).val('');
                $('#dob').focus();
            }
        }});
    }
}

var changeLegalHeir = function() {
    var obj = [];
    $('.legal_heir').live('change', function() {
        var me = $(this);
        var rowIndex = $(this).closest('tr').index();
        var childName = $('#myTable tr:eq('+rowIndex+') .name').val();

        var rowClass = $('#myTable tr:eq('+rowIndex+')').attr('class');
        var rowIndex = rowClass.split("-");
        var parentName = $('#parent-'+rowIndex[1]+' .name').val();
        var name = parentName+">"+childName;

        if(me.is(':checked')) {
            //alert('checked');
            if($('#parent-'+rowIndex[1]+' .dod').val() == "") {
                alert("Spouse is alive so child is not eligible to get pension.");
                me.prop('checked', false);
                $('#parent-'+rowIndex[1]+' .dod').focus();
            } else {
                var count = 0, error = 'false';
                $.each($('.'+rowClass+' .legal_heir'), function( index, value ){
                    if($(this).is(':checked')) {
                        if(count != 0) {
                            alert('More than one child not get pension.');
                            me.prop('checked', false);
                            error = 'true';
                            return false;
                        }
                        count++;
                    } else {
                        for(var i=0; i<obj.length; i++) {
                            if(obj[i] == "") {
                                obj.splice(i, 1);
                            }
                        }
                    }
                });
                if(error == 'false') {
                    obj.push(name);
                }
            }
        } else {
            for(var i=0; i<obj.length; i++) {
                if(obj[i] == name) {
                    obj.splice(i, 1);
                    break;
                } else if(obj[i] == "") {
                    obj.splice(i, 1);
                } else {}
            }
        }
        $('#name_of_legal_heir').val(JSON.stringify(obj));
    });
}

var addChild = function() {
    $('.addChild').live('click', function(){
        var parentID = $(this).closest('tr').attr('id');
        var ID = parentID.split('-');
        //var html = '<tr class="child-'+ID[1]+'"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" /></td><td><select class="form-control" name="child_salutation'+ID[1]+'[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select></td><td><input type="text" name="parentchild_name'+ID[1]+'[]" class="form-control name" placeholder="Name of Child"/></td><td><input type="text" class="dob form-control" name="child_dob'+ID[1]+'[]" placeholder="Child\'s date of birth"/></td><td><input type="text" class="dod form-control" name="child_dod'+ID[1]+'[]" placeholder="Child\'s date of death"/></td><td><input type="text" class="form-control" name="child_income'+ID[1]+'[]" placeholder="Child\'s income per month"/></td><td colspan="3"><input type="checkbox" name="legal_heir[]" class="legal_heir" /><label style="font-size:12px; color:red; margin-left: 18px;">Check this if spouse is not alive.</label></td></tr>';
        var html = '<tr class="child-'+ID[1]+'"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" /></td><td><select class="form-control" name="child_salutation'+ID[1]+'[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select></td><td><input type="text" name="parentchild_name'+ID[1]+'[]" class="form-control name" placeholder="Name of Child"/></td><td><input type="text" class="dob form-control" name="child_dob'+ID[1]+'[]" placeholder="Child\'s date of birth"/></td><td><input type="text" class="form-control" name="child_income'+ID[1]+'[]" placeholder="Child\'s income per month"/></td><td><select class="marital_status form-control" name="marital_status'+ID[1]+'[]" required><option value="">--Marital Status--</option><option value="married">Married</option><option value="unmarried">Unmarried</option><option value="divorcee">Divorcee</option><option value="widow">Widow</option><option value="legal_guardian">Legal Guardian</option></select></td><td colspan="3"><input type="checkbox" name="legal_heir[]" class="legal_heir" /><label style="font-size:12px; color:red; margin-left: 18px;">Check this if spouse is not alive.</label><div style="float: left; margin: 4px;">Handicapped</div><select name="handicapped'+ID[1]+'[]" style="float: left; width: 25%"><option value="yes">Yes</option><option value="no" selected>No</option></select></td></tr>';
        var parentID = $(this).closest('tr').attr('id');            
        $(html).insertAfter("#"+parentID);
        $('.dob').datepicker({dateFormat: 'yy-mm-dd', changeYear: true, changeMonth:true, yearRange: '1900:+0'});

        $('#cash_received, #dob, #dojac, #dojap, #dor, #dod, .dob, .dod').bind('paste', function(e) {
            e.preventDefault();
            return false;
        });
    });
}

var deleteRow = function(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;

    if($('.chk:checked').length == 0) {
        alert('Please select atleast one spouse to delete.');
    } else {
        if(rowCount<=1) {
            alert("Can't delete this row");
        } else {
            $.each($('.chk:checked'), function() {
                var currentID = $(this).closest('tr').attr('id').split('-');
                if($('.parent').length==1) {
                    alert("Can't delete this row"); 
                } else {
                    $(this).closest('tr').remove();
                    $('.child-'+currentID[1]).remove();
                }
            });
        }
    }
}

var validate = function() {
    var frm = document.getElementById("receipt_form");
    for (var i=0; frm.elements[i]; i++) {
        if (frm.elements[i].tagName=="INPUT" && frm.elements[i].getAttribute("type")=="text" && frm.elements[i].getAttribute("id")!="mname") {
            if(frm.elements[i].value=='') {
                alert("Please Fill up Complete Details First");
                frm.elements[i].focus();
                return false;
            }
        }
    }
    return true;
}

var addRow = function(tableID) {
    var rowID = $('#myTable').find('.parent:last').attr('id').split('-');
    var currentID = parseInt(rowID[1])+1;
    /*var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select class="form-control" name="spouse_salutation[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation</label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name</label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth</label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select class="form-control" name="relation[]"><option value="0">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation</label></td><td><input class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text" value=""><label style="font-size:12px; color:red">Percentage</label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';*/
    //var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select required class="spouse_salutation form-control" name="spouse_salutation[]"><option value="">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation <span class="required-field">*</span></label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name <span class="required-field">*</span></label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text"><label style="font-size:12px; color:red">Date of birth <span class="required-field">*</span></label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select required class="family_relation form-control" name="relation[]"><option value="">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation <span class="required-field">*</span></label></td><td><input required class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text"><label style="font-size:12px; color:red">Percentage <span class="required-field">*</span></label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';
    var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select required class="spouse_salutation form-control" name="spouse_salutation[]"><option value="">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation <span class="required-field">*</span></label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name <span class="required-field">*</span></label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text"><label style="font-size:12px; color:red">Date of birth <span class="required-field">*</span></label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select required class="family_relation form-control" name="relation[]"><option value="">--Please Select--</option></select><label style="font-size:12px; color:red">Relation <span class="required-field">*</span></label></td><td><input required class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text"><label style="font-size:12px; color:red">Percentage <span class="required-field">*</span></label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';
    $('#myTable').find('tr:last').after(data);
    $('#myTable').find('tr:last.parent input[type="text"]').val('');
    $('.dob, .dod').bind('paste', function(e) {
        e.preventDefault();
        return false;
    });
}
var addRow1 = function(tableID) {
    var rowID = $('#myTable').find('.parent:last').attr('id').split('-');
    var currentID = parseInt(rowID[1])+1;
    /*var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select class="form-control" name="spouse_salutation[]"><option value="0">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation</label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name</label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of birth</label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select class="form-control" name="relation[]"><option value="0">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation</label></td><td><input class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text" value=""><label style="font-size:12px; color:red">Percentage</label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';*/
    //var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><select required class="spouse_salutation form-control" name="spouse_salutation[]"><option value="">--Please Select--</option><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="miss">Miss</option></select><label style="font-size:12px; color:red">Salutation <span class="required-field">*</span></label></td><td><input required autocomplete="off" placeholder="Name of Spouse" type="text" id="0" name="spouse_name[]" class="form-control name" /><label style="font-size:12px; color:red">Spouse Name <span class="required-field">*</span></label></td><td><input required class="dob form-control" name="spouse_dob[]" placeholder="Date of Birth" size="16" type="text"><label style="font-size:12px; color:red">Date of birth <span class="required-field">*</span></label></td><td><input class="dod form-control" name="spouse_dod[]" placeholder="Date of Death" size="16" type="text" value=""><label style="font-size:12px; color:red">Date of death if available</label></td><td><select required class="family_relation form-control" name="relation[]"><option value="">--Please Select--</option><option value="wife">Wife</option><option value="husband">Husband</option><option value="father">Father</option><option value="mother">Mother</option></select><label style="font-size:12px; color:red">Relation <span class="required-field">*</span></label></td><td><input required class="percentage form-control" name="percentage[]" placeholder="Percentage" size="5" type="text"><label style="font-size:12px; color:red">Percentage <span class="required-field">*</span></label></td><td></td><td><input type="button" name="cmdAddRow" value="Add Child" class="addChild" id="addParentChild-'+currentID+'"></td></tr>';
    var data = '<tr id="parent-'+currentID+'" class="parent"><td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td><td><input required class="dob form-control" name="date[]" placeholder="Date" size="16" type="text" value=""><label style="font-size:12px; color:red">Date<span class="required-field">*</span></label></td><td><input required autocomplete="off" placeholder="Particulars" type="text" id="0" name="particulars[]" class="form-control name" /><label style="font-size:12px; color:red">Particulars <span class="required-field">*</span></label></td><td><input required autocomplete="off" placeholder="Scale Pay" type="text" id="0" name="scale_pay[]" class="form-control name" /><label style="font-size:12px; color:red">Pay Fixed at in the scale pay of.. <span class="required-field">*</span></label></td><td><textarea rows="4" cols="10" name="identical" id="identical" class="form-control"></textarea><label style="font-size:12px; color:red">Remarks</label></td></tr>';
    $('#myTable').find('tr:last').after(data);
    $('#myTable').find('tr:last.parent input[type="text"]').val('');
    $('.dob, .dod').bind('paste', function(e) {
        e.preventDefault();
        return false;
    });
}
var changeDOB = function() {
    $("#dob").datepicker({dateFormat: 'yy-mm-dd',changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){
        if($('#class_of_pension').val() == '') {
            alert('Please select class of pension first.');
            $("#dob").val('');
            $('#class_of_pension').focus();
        } else if($('#case_no').val() == '') {
            alert('File number field is required.');
            $("#dob").val('');
            $('#case_no').focus();
        } else if($('#class_of_pension').val()!="Voluntary_Retirement_Pension") {
            var dor, data, add_year = '';

            switch($('#designation').val()) {
                case 'Teacher':
                case 'AIS':
                case 'MTF(group D)':
                    add_year = 60;
                    break;
                default :
                    add_year = 60;
                    break;
            }

            if($('#retire_age').val() != '') {
                add_year = $('#retire_age').val();
            }
            add_year='60';
            data = moment($(this).val(), "YYYY-MM-DD").add({year: add_year}).format('YYYY-MM-DD');
            //alert(add_year);
            dor = new Date(data);

            if(dor.getMonth() == '0' || dor.getMonth() == '00') {
                if(dor.getDate() > 1) {
                    dor = moment(data, "YYYY-MM-DD").endOf('month').format('YYYY-MM-DD');
                } else {
                    dor = moment(data, "YYYY-MM-DD").subtract({days: 1}).format('YYYY-MM-DD');
                }
            } else {
                if(dor.getDate() > 1) {
                    dor = moment(data, "YYYY-MM-DD").endOf('month').format('YYYY-MM-DD');
                } else {
                    dor = moment(data, "YYYY-MM-DD").subtract({days: 1}).format('YYYY-MM-DD');
                }
            }
            $('#dor').val(dor);
            effectOfPension(dor);
            ageAtRetirement();
        } else if($('#class_of_pension').val()=="Voluntary_Retirement_Pension") {
           $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        }
    }});
}

/*var checkCaseNo = function(url) {
    $.post(url, {case_no: parseInt(me.val())}, function(data) {
        //$('#pay_scale').html(data);
        console.log(data);
    });
}*/

var changeDOR = function() {
    $("#dor").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date){

        ageAtRetirement();
        var doj = '';
        if($('.form-group-dojac').hasClass('show')) {
            doj = '#dojac';
        } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
            doj = '#dojap';
        } else {}

        console.log(doj);

        if($(doj).val() == '') {
            alert('Please select date of appointment.');
            $('#dor').val('');
            $(doj).val('').focus();
            return false;
        }

        if($(doj).val() > $('#dor').val()) {
            alert('Date of retirement should be greater than date of joining.');
            $('#dor').val('');
            return false;
        }

        total_service = dateDiff($(doj).val(), $('#dor').val());
        $('#total_service').val(total_service);
        delete total_service;

        if(appointasChange() == 'dojac') {

            result = dateDiff($('#dojac').val(), $("#dojap").val(), 'false', 'true');
            var years, months, days, halfY, totalMonths, totalDays;
            halfY = result.year/2;
            totalMonths = halfY*12;
            totalDays = result.month/2*30;
            if(halfY < 1) {
                years = 0;
                months = Math.floor(totalDays/30)+totalMonths;
                days = Math.floor(result.day/2)+totalDays%30;
                //alert(years+"-"+months+"-"+days);
            } else {
                years = Math.floor(totalMonths/12);
                months = totalMonths%12;
                days = Math.floor(result.day/2)+totalDays;
                if(days==30) {months+=1; days=0;}
                else if(days > 30) {months+=1; days=days%30}
                //alert(years+"-"+months+"-"+days);
            }
            $('#diff_appoint_as_casual').val(years+"-"+months+"-"+days);
            delete result;

            var result = dateDiff($('#dojap').val(), $('#dor').val(), 'true', 'true');
            var splitDiff = $('#diff_appoint_as_casual').val().split('-');
            //console.log("splitDiff :"+splitDiff);
            var years = parseInt(result.year)+parseInt(splitDiff[0]);
            var months = parseInt(result.month)+parseInt(splitDiff[1]);
            var days = parseInt(result.day)+parseInt(splitDiff[2]);

            if(days >= 30) {
                months+=1;
                days=days%30;
            }
            if(months >= 12) {
                years+=1;
                months=months%12;
            }
            //console.log(years+" years "+months+" months "+days+" days");
            $('#total_service_from_casual_date').val(years+" years "+months+" months "+days+" days");
            $('#total_service').val(years+" years "+months+" months "+days+" days");
        }

        effectOfPension(date);
    }});
}


/*var changeDOA = function() {
    $("#dojac, #dojap").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date) {
        var doj = '';
        $dor = $('#dor').val();
        if($('.form-group-dojac').hasClass('show')){
            doj = '#dojac';
        } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
            doj = '#dojap';
        } else {}

        var a = moment($(doj).val(), 'YYYY-MM-DD');
        var b = moment($dor, 'YYYY-MM-DD').add({days: 1});
        $('#total_service').val(moment(a).preciseDiff(b));

        if(appointasChange() == 'dojac') {
            $.post("<?php echo site_url('administrator/service_book/calculateDateDifference'); ?>",{date1:$('#dor').val(), date2: $('#dojap').val(), jsonData: "true"}, function(data) {
                var result =JSON.parse(data);
                var splitDiff =$('#diff_appoint_as_casual').val().split('-');
                var years = parseInt(result.year)+parseInt(splitDiff[0]);
                var months = parseInt(result.month)+parseInt(splitDiff[1]);
                var days = parseInt(result.day)+parseInt(splitDiff[2]);
                
                if(days >= 30){
                    months+=1;
                    days=days%30;
                }
                if(months >= 12){
                    years+=1;
                    months=months%12;
                }
                $('#total_service_from_casual_date').val(years+" years "+months+" months "+days+" days");
            });
        }
    }});
}*/


var changeDOD = function() {
    $("#dod").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+50', onSelect: function(date) {

        if($('#dor').val() != '') {
            if($('#dod').val() < $('#dor').val()) {
                alert('Date of death should be greater than or equal to date of retirement.');
                $('#dod').val('');
            }
        } else {

            ageAtRetirement();
            var doj = '';
            if($('.form-group-dojac').hasClass('show')) {
                doj = '#dojac';
            } else if($('.form-group-dojap').hasClass('show') && $('.form-group-dojac').hasClass('hide')) {
                doj = '#dojap';
            } else {}

            if($('#dor').val() == '' || $('#dor').val() == '0000-00-00') {
                total_service = dateDiff($(doj).val(), $('#dod').val());
                $('#total_service').val(total_service);
                delete total_service;
            }

            if(appointasChange() == 'dojac') {
                result = dateDiff($('#dojac').val(), $("#dojap").val(), 'false', 'true');
                var years, months, days, halfY, totalMonths, totalDays;
                halfY = result.year/2;
                totalMonths = halfY*12;
                totalDays = result.month/2*30;
                if(halfY < 1) {
                    years = 0;
                    months = Math.floor(totalDays/30)+totalMonths;
                    days = Math.floor(result.day/2)+totalDays%30;
                    //alert(years+"-"+months+"-"+days);
                } else {
                    years = Math.floor(totalMonths/12);
                    months = totalMonths%12;
                    days = Math.floor(result.day/2)+totalDays;
                    if(days==30) {months+=1; days=0;}
                    else if(days > 30) {months+=1; days=days%30}
                    //alert(years+"-"+months+"-"+days);
                }
                $('#diff_appoint_as_casual').val(years+"-"+months+"-"+days);
                delete result;

                retirement = $('#dor').val();
                if($('#dor').val() == '' || $('#dor').val() == '0000-00-00') {
                    retirement = $('#dod').val();
                }
                var result = dateDiff($('#dojap').val(), retirement, 'true', 'true');
                var splitDiff = $('#diff_appoint_as_casual').val().split('-');
                //console.log("splitDiff :"+splitDiff);
                var years = parseInt(result.year)+parseInt(splitDiff[0]);
                var months = parseInt(result.month)+parseInt(splitDiff[1]);
                var days = parseInt(result.day)+parseInt(splitDiff[2]);

                if(days >= 30) {
                    months+=1;
                    days=days%30;
                }
                if(months >= 12) {
                    years+=1;
                    months=months%12;
                }
                //console.log(years+" years "+months+" months "+days+" days");
                $('#total_service_from_casual_date').val(years+" years "+months+" months "+days+" days");
                $('#total_service').val(years+" years "+months+" months "+days+" days");
            }

            effectOfPension(date);
        }
    }});
}

var calculateSMP = function(result) {

    var total = result.year*2;
    console.log(total);
    if(result.month >= 3 && result.month <= 8) {
        total+=1;
    } else if (result.month >= 9) {
        total+=2;
    } else {}

    if(total > 66) {
        $('#smp').val('66');
    } else {
        $('#smp').val(total);
    }
}