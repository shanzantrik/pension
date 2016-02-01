<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>
<script type="text/javascript">
    $('body').on('focus',"#dob", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',"#dor", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',"#effect_from", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
    $('body').on('focus',"#DNI_on", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
</script>
<h3>Add IPS Check List</h3><br/>
<small style="font-size:12px; font-weight:bold;color:darkgrey">Use this panel to attach Check List entry for this claimant</small>                  
<?php
    $record = @$records[0];
    $file_no=@$record['file_no'];
  $rev=@$record['pre_revised'];
    echo $file_no;
    $dept_code=@$record['department'];
    $dept_name=@getDepartmentName($dept_code);
    $status=@$record['status'];
    echo $status;
  
  $pre = @$pres[0];
  $id=@$pre['id'];
  $grade=@$pre['grade'];
  $payscale=@$pre['pay_scale'];

?>

<form  action="<?php echo site_url('administrator/ips/edit_ips/'.base64_encode($file_no).'/'.base64_encode($file_no)); ?>" method="post" autocomplete="off">
     <div class="box span12">
           <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">File No:</label></td>
                        <td><input title="Name" readonly name="file_no" type="text" value="<?php echo $record['file_no']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date:</label></td>
                        <td><input title="Designation" readonly name="designation"  type="text" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                  </tbody>
              </table>
         </div> 
    <div>
       
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">1.File No:</label></td>
                        <td><input title="Name" readonly name="file_no" type="text" value="<?php echo $record['file_no']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">2.Date:</label></td>
                        <td><input title="Designation" readonly name="designation" type="date" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">3.Name of Department:</label></td>
                        <td><input title="Name" readonly name="department" type="text" value="<?php echo $record['department']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">4.Ref No with Date:</label></td>
                        <td><input title="Designation" readonly name="ref_no"  type="date" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">5.Name</label></td>
                        <td><input title="Name" readonly name="name" type="text" value="<?php echo $record['name']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">6.Date of 1st appointment with designation:</label></td>
                        <td><input title="Designation" readonly name="date" type="text" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">7.Regular/Ad hoc/officiating/WC/Contact:</label></td>
                        <td><input title="Name" readonly name="regular" type="text"  class="form-control parsley-validated"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">8.Scale of Pay:</label></td>
                        <td><input title="Designation" readonly name="scale" value="<?php echo $record['exist_bp']?>" type="text" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                 
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">9.Date of regularization if appointment on ad hoc/officiating/WC:</label></td>
                        <td><input title="Name" readonly name="regularization" type="text" class="form-control parsley-validated" ><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">10.Earlier Checked Upto...if any:</label></td>
                        <td><textarea rows="4" cols="20" name="earlier" id="earlier" class="form-control"></textarea></td>                                                 
                    </tr>
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">11.Earlier observations...if any:</label></td>
                       <td><textarea rows="4" cols="20" name="observation" id="observation" class="form-control"></textarea></td>                         <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">12.One additional increment for falling between Feb' to June'2006 and shall be re-fixed pay w.e.f 01-01-2006 in revised pay vide order No.10/2/2011-E-III(A) dated 19-03-2012 and communicated by Govt.of A.P order No.FIN/E-II/22/2008 dated 21-11-2012:</label></td>
                       <td><textarea rows="4" cols="20" name="additional" id="additional" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">13.IPS 1973/1986/1996/2006 :passed/observations:</label></td>
                        <td><textarea rows="4" cols="20" name="ips" id="ips" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">14.Promotion in higher scale under FR 22(i)(a)(1):</label></td>
                        <td><textarea rows="4" cols="20" name="higher" id="higher" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">15.Promotion in identical scale under FR 22(i)(a)(1)/Rule 13 of RP Rules 2008 vide Govt.of India order No.10/02/2011-E.III/A dated 07-01-2013 and communicated vide Govt.of A.P order No.FIN/E-II/13/2009 dated 05-04-2013:</label></td>
                        <td><textarea rows="4" cols="20" name="identical" id="identical" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">16.Pay fixed under FR 23 by exercising of options:</label></td>
                       <td><textarea rows="4" cols="20" name="pay_fixed" id="pay_fixed" class="form-control"></textarea></td>                     </tr>
                   
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">17.Stepping up of pay due to Juniors/seniors or Revision of pay under 6th CPC(vide order No.FIN/E-II/22/2008 dated 12-01-2012)if any:</label></td>
                        <td><textarea rows="4" cols="20" name="stepping" id="stepping" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">18.Time Bound Pay Scale under FR 22(i)(a)(2):</label></td>
                        <td><textarea rows="4" cols="20" name="time_bound" id="time_bound" class="form-control"></textarea></td>                                                  
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">19.Pay Upgradation under FR 22(i)(a)(2):</label></td>
                        <td><textarea rows="4" cols="20" name="upgradation" id="upgradation" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">20.ACPS under FR22(i)(a)(1) and ACPS Clarification w.e.f 21-11-2003 to 31-08-2008 vide No.35034/1/97-Estt(I) dated 9-8-1999 and communicated by Govt.of A.P order No. OM.25/2002 dated 21-11-2003:</label></td>
                        <td><textarea rows="4" cols="20" name="acps" id="acps" class="form-control"></textarea></td>                                                  
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">21.MACPS under FR22(i)(a)(1) for Group A,B,C and D w.e.f 01-09-2008 vide GOI No 35034/3/2008-Estt(D) dated 19-05-2009 and communicated vide Govt. of A.p order No. AR-56/2009 dated 31-07-2009:</label></td>
                        <td><textarea rows="4" cols="20" name="macps" id="macps" class="form-control"></textarea></td>                         <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">22.Family Planning Allowance/Personal Pay if any:</label></td>
                        <td><textarea rows="4" cols="20" name="family_planning" id="family_planning" class="form-control"></textarea></td>                     </tr>
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">23.Suspension period if any:</label></td>
                        <td><textarea rows="4" cols="20" name="suspension" id="suspension" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">24.Break in service if any (treated not spent on duties):</label></td>
                        <td><textarea rows="4" cols="20" name="break" id="break" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">25.Dies Non:</label></td>
                        <td><textarea rows="4" cols="20" name="dies_non" id="dies_non" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">26.Withholding of increments if any(comulative/without cumulative):</label></td>
                        <td><textarea rows="4" cols="20" name="withholding" id="withholding" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">27.EOL if any (with or without medical certificate):</label></td>
                        <td><textarea rows="4" cols="20" name="eol" id="eol" class="form-control"></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">28.Increments/Deferred increment if any:</label></td>
                       <td><textarea rows="4" cols="20" name="increments" id="increments" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">29.Any other Informations:</label></td>
                        <td><textarea rows="4" cols="20" name="information" id="information" class="form-control"></textarea></td>                         <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">30.Last pay checked upto..at PB+GP:</label></td>
                        <td><textarea rows="4" cols="20" name="last_pay" id="last_pay" class="form-control"></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">31.Remarks:</label></td>
                        <td><textarea rows="4" cols="20" name="remarks" id="remarks" class="form-control"></textarea></td>                        
                    </tr>
                   
                   
                   
                </tbody>
            </table>

            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
    
    </div>
   
    <button type="submit" name="submit_val" class="btn btn-primary">Submit</button>
    <input type="reset" class="btn btn-warning" value="Cancel"><br/>
    <small style="font-size:12px; font-weight:bold;color:darkgrey">If you are not sure on this or want to learn more, contact software provider</small>                  
</form>

<script type="text/javascript">
    function FillAddress(f) {
        if(f.addresstoo.checked == true) {
            f.cor_address.value = f.per_address.value;
        }
    }  
    
    $(document).ready(function() {
        $('textarea.ckeditor_standard').ckeditor({
            height: '150px',
            width:'500px',
            toolbar: [
                {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                {name: 'basicstyles', items: ['Bold', 'Italic']}
            ]
        });
        onPayCommissionLoad();
        $('#pre-revised-pay-commission').on('change', function() {
            onPayCommissionChange();
        });
    
          $('#pre_revised').on('change', function() {
            var me = $(this);
            $.post('<?php echo site_url("administrator/ips/getRevisedPayScale/"); ?>', {related: me.val(), payCommission: parseInt($('#pre-revised-pay-commission').val())+1}, function(data) {
                $('#revised').html(data);
            });
        });

        $('#exist_bp').on('blur', function() {
            var me = $(this);
            if($('#pre_revised').val() == 0) {
                alert('Please select pre revised pay scale.');
            } else {
                $.post('<?php echo site_url("administrator/ips/getRevisedBasicPay/"); ?>', {pre_revised: $('#pre_revised').val(), existing_basic_pay: me.val()}, function(data) {
                    if(data == "error") {
                        $('#existing_basic_pay_error').html('You entered wrong value in existing basic pay.');
                    } else {
                        $('#existing_basic_pay_error').html('');
                        $('#fixed_pay').val(data);
                    }
                });
            }
        });
    });

    var onPayCommissionLoad = function() {
        var me = $('#pre-revised-pay-commission');
        $.post('<?php echo site_url("administrator/ips/getPreRevisedPayScaleSelect/"); ?>', {payCommission: parseInt(me.val()), select: '<?php echo $record["pre_revised"]; ?>'}, function(data) {
            $('#pre_revised').html(data);
        });
        $.post('<?php echo site_url("administrator/ips/getRevisedPayScaleById/"); ?>', {id: '<?php echo $record["revised"]; ?>'}, function(data) {
            $('#revised').html(data);
        });
    };
    
    var onPayCommissionChange = function() {
        var me = $('#pre-revised-pay-commission');
        $.post('<?php echo site_url("administrator/ips/getPreRevisedPayScale/"); ?>', {payCommission: parseInt(me.val())}, function(data) {
            $('#pre_revised').html(data);
        });
    };

  
</script>