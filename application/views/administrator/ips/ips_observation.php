<?php $row1 = $records[0]; ?>

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
<h3>Check IPS Observation</h3><br/>

<small style="font-size:12px; font-weight:bold;color:darkgrey">Use this panel to attach IPS detail entry for this claimant</small>                  
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

<form  action="<?php echo site_url('administrator/ips/print_ips_all/'.base64_encode($file_no).'/'.base64_encode($file_no)); ?>" method="post" autocomplete="off">
  
    <div class="row-fluid sortable">
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                   
                   <tr>
                        <div class="form-group" style="min-height: 54px;">
                        <label class="col-sm-3 control-label">Select Observations</label>
                        
                         </div>                                              
                    </tr>
                  <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="eariler" class="eariler" value="<?php echo $row1['remark2']; ?>">1.Earlier Checked Upto...if any:
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('earlier', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="observation" class="observation" value="<?php echo $row1['remark3']; ?>">2.Earlier observations...if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('observation', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="additional" class="additional" value="<?php echo $row1['remark4']; ?>">3.One additional increment for falling between Feb' to June'2006 and shall be re-fixed pay w.e.f 01-01-2006 in revised pay vide order No.10/2/2011-E-III(A) dated 19-03-2012 and communicated by Govt.of A.P order No.FIN/E-II/22/2008 dated 21-11-2012
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('additional', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="ips" class="ips" value="<?php echo $row1['remark5']; ?>">4.IPS 1973/1986/1996/2006 :passed/observations
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('ips', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="higher" class="higher" value="<?php echo $row1['remarks6']; ?>">5.Promotion in higher scale under FR 22(i)(a)(1)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('higher', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="identical" class="identical" value="<?php echo $row1['remarks7']; ?>">6.Promotion in identical scale under FR 22(i)(a)(1)/Rule 13 of RP Rules 2008 vide Govt.of India order No.10/02/2011-E.III/A dated 07-01-2013 and communicated vide Govt.of A.P order No.FIN/E-II/13/2009 dated 05-04-2013
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('identical', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="pay_fixed" class="pay_fixed" value="<?php echo $row1['remarks8']; ?>">7.Pay fixed under FR 23 by exercising of options
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('pay_fixed', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="stepping" class="stepping" value="<?php echo $row1['remarks9']; ?>">8.Stepping up of pay due to Juniors/seniors or Revision of pay under 6th CPC(vide order No.FIN/E-II/22/2008 dated 12-01-2012)if any.
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('stepping', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="time_bound" class="time_bound" value="<?php echo $row1['remarks10']; ?>">9.Time Bound Pay Scale under FR 22(i)(a)(2)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('time_bound', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="upgradation" class="upgradation" value="<?php echo $row1['remarks11']; ?>">10.Pay Upgradation under FR 22(i)(a)(2)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('upgradation', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="acps" class="acps" value="<?php echo $row1['remarks12']; ?>">11.ACPS under FR22(i)(a)(1) and ACPS Clarification w.e.f 21-11-2003 to 31-08-2008 vide No.35034/1/97-Estt(I) dated 9-8-1999 and communicated by Govt.of A.P order No. OM.25/2002 dated 21-11-2003
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('acps', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="macps" class="macps" value="<?php echo $row1['remarks13']; ?>">12.MACPS under FR22(i)(a)(1) for Group A,B,C and D w.e.f 01-09-2008 vide GOI No 35034/3/2008-Estt(D) dated 19-05-2009 and communicated vide Govt. of A.p order No. AR-56/2009 dated 31-07-2009
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('macps', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="family" class="family" value="<?php echo $row1['remarks14']; ?>">13.Family Planning Allowance/Personal Pay if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('family', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="suspension" class="suspension" value="<?php echo $row1['remarks15']; ?>">14.Suspension period if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('suspension', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="break" class="break" value="<?php echo $row1['remarks16']; ?>">15.Break in service if any (treated not spent on duties)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('break', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                   
                    <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="dies_non" class="dies_non" value="<?php echo $row1['remarks17']; ?>">16.Dies Non
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('dies_non', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="withholding" class="withholding" value="<?php echo $row1['remarks18']; ?>">17.Withholding of increments if any(comulative/without cumulative)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('withholding', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="eol" class="eol" value="<?php echo $row1['remarks19']; ?>">18.EOL if any (with or without medical certificate)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('eol', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="increments" class="increments" value="<?php echo $row1['remarks20']; ?>">19.Increments/Deferred increment if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('increments', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                  <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="information" class="information" value="<?php echo $row1['remarks21']; ?>">20.Any other Informations
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('information', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="last_pay" class="last_pay" value="<?php echo $row1['remarks22']; ?>">21.Last pay checked upto..at PB+GP
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('last_pay', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input type="radio" name="remarks" class="remarks" value="<?php echo $row1['remarks23']; ?>">22.Remarks
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('remarks', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                    
                   
                   
                </tbody>
            </table>

            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
      </div>

<div class="row-fluid sortable">
        
    
  
    <button type="submit" name="submit_val" class="btn btn-primary">Print</button>
    <input type="reset" class="btn btn-warning" value="Cancel"> <br/>
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