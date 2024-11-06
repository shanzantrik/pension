<style type="text/css">
.lbltext{
    float: left;
    height: 20px;
    width: 190px;
    
}
.lbltext1{
    float: left;
    height: 20px;
    width: 50px;
}
</style>

<script>

    $(document).ready(function(){
        $('.emp_code').live('blur', function(){
            var me = $(this);
            for(var i=0; i<$('.emp_code').length-1; i++) {
                if($.trim($(this).val())==$('.emp_code:eq('+i+')').val()) {
                    me.val('');
                    me.focus();
                    alert("Cannot take same values for Employee Code");
                    break;
                }
                break;
            }

var df=$("#bc").val();
var empcode=$(this).val();
  // var this = $(this);
  if($.trim(empcode)!=''){
  
var dataString = {'branch_code':df,'empcode':empcode};
    $.ajax({
            url: '<?php echo site_url();?>/administrator/receipt/check_employee_code',
            type: 'POST',
            dataType: 'json',
            data: dataString,
            success: function(data)
            {
            if(data.message=="Problem"){ //succ
                me.val('');       
                //$('.emp_code').val('');
                     me.focus();
            alert("This employee code already exists");

            }   

            }
         });
}

             
        });
    });

    $(document).ready(function(){
        $('.fileno').live('blur', function(){
            var mes = $(this);
            for(var i=0; i<$('.fileno').length-1; i++) {
                //alert($('.emp_code:eq('+i+')').val());
                if($.trim(mes.val())==$('.fileno:eq('+i+')').val()) {
                    mes.val('');
                    mes.focus();
                    alert("Cannot take same values for file number");
                    break;
                }
                break;     
            }

            var df=$("#dfno").val();
            var fileno=$(this).val();
            // var this = $(this);
            if($.trim(fileno)!='') {
                var dataString = {'df':df,'fileno':fileno};
                $.ajax({
                    url: '<?php echo site_url();?>/administrator/receipt/check_file_no',
                    type: 'POST',
                    dataType: 'json',
                    data: dataString,
                    success: function(data) {
                        if(data.message=="Problem") { //succ
                            mes.val('');       
                            //$('.emp_code').val('');
                            mes.focus();
                            alert("This file number already exists");
                        }
                    }
                });
            }
        });
    });




function check_receipt_date(){
    
    if($.trim($("#aloc_date").val())!='' &&  $.trim($("#rdate").val())){ 
    var issue_date=$("#aloc_date").val(); 
 var r_date=$("#rdate").val();
    var issue = Date.parse(issue_date);
     var receipt=Date.parse(r_date);
     if(issue<receipt){

alert("Issue Date cannot be less than the receipt date");
$("#aloc_date").val('');
$("#aloc_date").focus();


     }

     }
     else {



     }

}

</script>
<script lang="javascript">
$(document).ready(function(){

$("#rdate").change(function(){
 

   if($.trim($("#rdate").val())!=''){ 
$("#aloc_date").prop('disabled',false);
 
 
 
}
else {
 
 
$("#aloc_date").prop('disabled',true);

 $("#aloc_date").val('');


}

 
 


})


})

$(document).ready(function(){

$("#bc").prop('disabled',false);
$("#rdate").prop('disabled',true);
$("#subject").prop('disabled',true);
$("#aloc_date").prop('disabled',true); 
$("#address_department").prop('disabled',true);
$("#district").prop('disabled',true);
$("#dfno").prop('disabled',true);
$("#claimant").hide();
var df=$("#dfno").val();

 
$("#bc").change(function(){
 

   if($.trim($("#bc").val())==''){ 
        $("#rdate").prop('disabled',true);
        $("#subject").prop('disabled',true);
        $("#aloc_date").prop('disabled',true); 
        $("#address_department").prop('disabled',true);
        $("#district").prop('disabled',true);
        $("#dfno").prop('disabled',true);
        $("#claimant").hide();
    }
    else {
    
        $("#rdate").prop('disabled',false);
        $("#subject").prop('disabled',false);
        $("#aloc_date").prop('disabled',false); 
        $("#address_department").prop('disabled',false);
        $("#district").prop('disabled',false);
        $("#dfno").prop('disabled',false);
        $("#claimant").show();

}

 
 


})






})
 
function showdel(){
 var table = document.getElementById("myTable");
        var rowCount = table.rows.length;
        
  var ln= $('[name="chk[]"]:checked').length;
   if(rowCount>1){     
if( ln>=1){
$('#del').show();


}
 


else {

    $('#del').hide();
}

}
 
 

}

    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
		//$('.pension').hide('slow');
        

        var ln= $('[name="chk[]"]:checked').length;
       if(rowCount>=1){
if(ln>=1){
$('#del').show();
}
else
{

    $('#del').hide();
}
//$('#del').show();
$('#chk').show();

       }
       else {

//$('#del').hide();
$('#chk').hide();

       }


        if(rowCount < 10000) {                           
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;
            for(var i=0; i<colCount; i++) {
                var newcell = row.insertCell(i);
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//$('.pension').hide('slow');
            }
        } else {
            //alert("Maximum Passenger per ticket is 5.");
        }
    }

    function deleteRow(tableID) {
        var table = document.getElementById(tableID);
       var ln= $('[name="chk[]"]:checked').length;
       
 


        var rowCount = table.rows.length;
         
          if(rowCount>1){     
if( ln>=1){
$('#del').hide();


}
 


else {

    $('#del').show();
}

}

//$('#del').show();
 
        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];

            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                 
                rowCount--;

                i--;


            }
        }
    }

    function validate(){
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

    $(document).ready(function() {
        $( "#aloc_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2012:2020'
        });
    });
    $(document).ready(function() {
        $("#rdate").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2012:2020'
        });
    });
    $(document).ready(function() {
        $("#bc").change(function(){
            var dept=$("#bc").val();
            $.ajax({
                url:"<?php echo site_url('administrator/receipt/get_address') ?>?dept="+dept,
                method:'GET',
                dataType:'JSON',
                success:function(data){
                    $("#address_department").val(data.address);
                }
            });
        })
    });
</script>

<h3>Receipt Register <small style="font-size:12px"> Use this area to enter details received from claimants against a unique department forwarding number</small></h3>
<?php 
    $msg=base64_decode(@$_GET['msg']);
    $cls=base64_decode(@$_GET['class']);
    if($msg!=''){?>
        <div class="<?php echo $cls ?>">
            <?php echo $msg; ?>
        </div>
    <?php }  ?>
<?php echo form_open('administrator/receipt',array('class'=>'form-horizontal group-border-dashed')) ?>
<hr>
<div class="">
    <div class="">
        <table class="" id="example" cellpadding="5" cellspacing="5">
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                <tr>
                    <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Department</label></td>
                    <td>
                        <select id="bc" title="Please select a department to where the department forwarding number is intended to be forwarded" required="required" class="form-control parsley-validated parsley-success" name="branch_code">
                            <option value="">--Please Select--</option>
                            <?php foreach (getAllDepartment() as $dept) { ?>
                                <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><strong>Department Forwarding Number</strong></td>
                  <td><input  title="Please provide a unique department forwarding number to proceed with the pension receipt register entries " required autocomplete="off"  name="dfno" id="dfno"  type="text" parsley-trigger="change" class="form-control parsley-validated" placeholder="Department Forwarding Number" />
                    </td>
                </tr>
                <tr>

                    <td><span class="col-sm-3 control-label" style="width:auto;font-weight:bold">Department Address</span></td>
                    <td style="width:30%"><textarea title="Address of the Department" placeholder="Address of the Department" required class="form-control" id="address_department" name="address_department"></textarea></td>
                    <td><span class="col-sm-3 control-label" style="width:auto;font-weight:bold">District</span></td>
                    <td><select name="district" id="district" required="true">
                      <option value="">--Please Select--</option>
                        <?php foreach (getAllDistrict() as $districts) { ?>
                        <option value="<?php echo $districts['district_code']; ?>"><?php echo $districts['district_name']; ?></option>
                        <?php } ?>
                    </select></td>

                </tr>
                <tr style="height:40%">
                    <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Subject</label>
                    </td>
                    <td>
                        <textarea placeholder="Please Enter a textual subject cause stating the reason of forwarding this number to the selected department" title="You may provide a textual subject cause stating the reason of forwarding this number to the selected department" class="form-control" id="subject" name="subject"></textarea>
                    </td>
                    <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label"><strong>Receipt Date</strong></label></td>
                    <td style="width:30%"><input autocomplete="off" placeholder="Please Enter Receipt Date" title="Please select the date in which the pension receipt is entered" required id="rdate"  name="rdate" class="form-control parsley-validated" size="16" type="text" value=""></td>
                </tr>
            </tbody>
        </table>
        <small style="color:red;font-size:12px">[Please Enter a textual subject cause stating the reason of forwarding this number to the selected department]</small>

<div id="claimant">
<legend style="font-size:15px; color:#3b5999; font-weight:700">Claimant Information Panel &raquo; <small style='font-size:11px'> Use the below panel to enter basic information about the claimants at an initial stage</small></legend>

<p style='font-size:12px; color:red'>Fields labelled in red are mandatory</p>
        
 
        <table class="table" id="myTable">
            
            <tbody>
                 
                <tr>
                    <td><input   onclick="showdel()"   id="chk" style="opacity:4!important; " class="form-control" type="checkbox"  name="chk[]" /></td>
                    <td><input title="Please enter the employee code provided by the claimant" style="width:70%;font-size:11px" autocomplete="off" placeholder="Employee Code" type="text" id="0" name="emp[]" class="form-control emp_code" />
                    <label style="font-size:12px; color:red">Employee Code</label>
                    </td>
                    <td>
                        <select required="true" style="width:90px;" name="des[]" class="form-control">
                            <option value="">Select</option>
                            <?php foreach(getAllDesignation() as $desg) : ?>
                                <option value="<?php echo $desg['desg_name']; ?>"><?php echo $desg['desg_name']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                        <label style="font-size:12px; color:red">Designation</label>
                    </td>
                    <td>
                        <select required="true" style="width:90px;" name="b_code[]" class="branch">
                            <option value="">Select</option>
                            <?php foreach ($branch as $key): ?>
                                <option value="<?php echo $key->Branch_Code; ?>"><?php echo $key->Branch_Name; ?></option>
                            <?php endforeach ?>
                        </select>                        
                        <label style="font-size:12px;color:red">Branch</label>
                    </td>
                   <td>
                    <select style="width:60px;font-size:11px" name="sal[]">
                        <option value="Shri">Shri</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Md">Md</option>
                        <option value="Dr">Dr</option>
                        <option value="Late">Late</option>
                    </select>   
                    <label style="font-size:12px;color:red">Salutation</label>
                   </td>
                    <td>
                        <input title="Please enter claimant's full name" style="width:90%;font-size:11px" required="required" autocomplete="off" placeholder="Full Name" type="text" id="0" name="fname[]" class="form-control fname" size="20" />
                        <label style="font-size:12px;color:red">Full Name</label>
                    </td>
                    <td>
                        <textarea placeholder="Remarks, if any" style="font-size:12px" name="remarks[]" title="Write down remarks regarding pension papers or service book against this file number, if any"></textarea>
                        <label style="font-size:12px; color:purple">Remarks</label>
                    </td>
                </tr>

            </tbody>
        </table>
        <a title="Add more pension claimants against the entered forwarding number" class="btn btn-success" onclick="addRow('myTable')" href="#">Add More Claimants</a>
        <a title="Select a checkbox and Remove pension claimants against the entered forwarding number" class="btn btn-danger" style="display:none" id="del" onclick="deleteRow('myTable')" href="#">Remove Claimants</a> 
        <button title="Save and register the pension receipt(s) received against the entered forwarding number" type="submit" name="submit_val" class="btn btn-primary">Save and Register</button>
       
  <a href="<?php echo current_url();?>"><button type="button" title="Refresh" type="submit" name="submit_val" class="btn btn-info">Refresh</button></a>
<script type="text/javascript">
    $("#bc").change(function(){
            if($.trim($('#bc').val())!=''){
                var deptName ='';
                $.post("<?php echo site_url('administrator/receipt/getDeptName'); ?>", {'deptCode': $('#bc').val()}, function(data) {
                    $("#dfno").val(data);
                });
            }
        });
		

        $('input, textarea').bind('keypress', function(event) {
            var me = $(this);
            var regex = '';
            if(me.hasClass('fname')) {
                regex = new RegExp("^[a-zA-Z]+$");
            } else {
                regex = new RegExp("^[a-zA-Z0-9-&/]+$");
            }
            var key = String.fromCharCode(! event.charCode ? event.which : event.charCode);
            if(!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $('#rdate').bind('paste', function(e) {
            e.preventDefault();
            return false;
        });



</script>
</div>
</div>
<?php echo form_close() ?>
</div>