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
<h3>Edit IPS Details</h3><br/>

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
<form  action="<?php echo site_url('administrator/ips/edit_ips/'.base64_encode($file_no).'/'.base64_encode($file_no)); ?>" method="post" autocomplete="off">
  
    <div class="row-fluid sortable">
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">1.File No:</label></td>
                        <td><input title="file_no" readonly name="file_no" id="file_no" type="text"  class="form-control parsley-validated" value="<?php echo $row1['file_no']; ?>"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">2.Date:</label></td>
                        <td><input name="entry" id="entry" type="text" value="<?php echo $row1['date']; ?>" ><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                     <tr>
                         <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Department</label></td>
                        <td> 
                            <select title="Choose Department" class="form-control parsley-validated parsley-success" name="dept">
                            <?php if(!$dept_code=='') {
                                echo"<option value=$dept_code>$dept_name</option>";
                            }
                            if($branch_code == '1010') {   ?>
                                <option selected>-- Select Department --</option>
                            <?php } ?>
                            <?php foreach ($departments as $dept) { ?>
                                <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                            <?php } ?>
                            </select><?php echo form_error('dept', '<div class="error">', '</div>'); ?>      
                        </td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">4.Receipt Date:</label></td>
                        <td><input title="Receipt date" readonly name="receipt_date"  type="date" class="form-control parsley-validated" value="<?php echo $row1['receipt_date']; ?>"><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">5.Name</label></td>
                        <td><input title="Name" readonly name="name" type="text"  class="form-control parsley-validated" value="<?php echo $row1['name']; ?>"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">6.Date of 1st appointment</label></td>
                        <td><input title="appointment" readonly name="appointment" id="appointment" value="<?php echo $row1['appointment_date']; ?>"type="text" ><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">7.Designation:</label></td>
                        <td><input title="designation" readonly name="designation" type="text" value="<?php echo $row1['designation']; ?>"  class="form-control parsley-validated"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">7.Regular/Ad hoc/officiating/WC/Contact:</label></td>
                        <td><div class="col-sm-6">
                           <select class="appoint_as" name="appoint_as">
                             <option value="0">Select</option>
                             <option value="Adhoc">Adhoc</option>
                             <option value="Officiating">Officiating</option>
                             <option value="WC">WC</option>
                             <option value="Temporary">Temporary</option>
                             <option value="Permanent">Permanent</option>
                          </select>
                       </div></td>
                        
                                                                       
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">8.Scale of Pay:</label></td>
                        <td><input title="Scale"  name="scale" value="<?php echo $row1['pay_scale']; ?>"  type="text" class="form-control parsley-validated"><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">9.Date of regularization if appointment on ad hoc/officiating/WC:</label></td>

                        <td><input name="regularization" id="regularization" value="<?php echo $row1['regularization_date']; ?>" type="text"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                        
                                                                       
                    </tr>
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">10.Earlier Checked Upto...if any:</label></td>
                        <td><textarea name="earlier" id="earlier" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remark2']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td>  
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">11.Earlier observations...if any:</label></td>
                       <td><textarea name="observation" id="observation" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remark3']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
                       </td>                         <td></td>
                                                                        
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">12.One additional increment for falling between Feb' to June'2006 and shall be re-fixed pay w.e.f 01-01-2006 in revised pay vide order No.10/2/2011-E-III(A) dated 19-03-2012 and communicated by Govt.of A.P order No.FIN/E-II/22/2008 dated 21-11-2012:</label></td>
                        <td><textarea name="additional" id="additional" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remark4']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
                            </td>  
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">13.IPS 1973/1986/1996/2006 :passed/observations:</label></td>
                        <td><textarea name="ips" id="ips" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remark5']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
                           </td> 
                       
                                                                        
                    </tr>
                     
                   
                    <tr>
                        <td><strong>14.Retirement Date on Superannuation/Voluntary/Death</strong></td>
                        <td><input title="Retirement Date" name="dor" id="dor" value="<?php echo $row1['dor']; ?>" type="text"  class="form-control parsley-validated" placeholder="Provide Date of Retirement"><?php echo form_error('dor', '<div class="error">', '</div>'); ?></td>
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">15.Date of Birth</label></td>
                        <td><input name="dob" id="dob" type="text" value="<?php echo $row1['dob']; ?>" class="form-control parsley-validated" title="Provide DOB" placeholder="Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?></td>
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Scale of &raquo;</label></td>
                        <td colspan="4">
                            <div style="float: left; width: 31%;">
                                <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Pre-revised Pay Commssion</label>
                                <?php $array = array('5', '6', '7'); ?>
                                <select id="pre-revised-pay-commission" name="pre_revised_pay_commission" class="form-control">
                                    <option value="0">Select</option>
                                    <?php foreach ($array as $arr) { ?>
                                        <?php if($arr == $record['pre_revised_pay_commission']) { ?>
                                            <option value="<?php echo $arr; ?>" selected><?php echo $arr; ?>th</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $arr; ?>"><?php echo $arr; ?>th</option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div style="float: left; width: 31%;">
                                <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Pre-revised &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">E.g:12500-20500</small></label>
                                <select name="pre_revised" id="pre_revised" class="form-control">
                                    <option value="<?php echo $id;?>"><?php echo $grade;?></option>

                                    <option value="0">--Select--</option>
                                </select>
                            </div>
                            <div style="float: left; width: 31%;">
                                <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Revised &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">E.g:12500-20500</small></label>
                                <select name="revised" id="revised" class="form-control" readonly="readonly">
                                    <option value="0">--Select--</option>
                                </select>
                                <!-- <input readonly="readonly" title="Revised Pay" autocomplete="off" name="revised" id="revised" class="form-control parsley-validated" type="text" value="<?php echo $record['revised']?>" placeholder="Please Enter Revised"><?php echo form_error('revised', '<div class="error">', '</div>'); ?> -->
                            </div>
                            <div style="clear: both;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Existing Basic Pay on 1st January 2006</label></td>
                        <td><input name="exist_bp" id='exist_bp' type="text" value="<?php echo $record['exist_bp']?>" title="Provide Basic Pay" class="form-control parsley-validated" placeholder="Enter Basic Pay "><?php echo form_error('exist_bp', '<div class="error">', '</div>'); ?></td>
                        <td colspan="3" id="existing_basic_pay_error" style="color: red;"></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">21.Pay Fixed of Rs.</label>
                            <?php echo nbs(3);?><input title="Provide Fixed Pay" name="fixed_pay" id="fixed_pay" type="text" class="form-control parsley-validated" placeholder="Provide amount of fixed pay">
                            <?php echo nbs(2);?><b>w.e.f</b>
                            <input title="Provide date from which the fixed pay has got effect" name="effect_from" style="width:15%" type="text" id="effect_from" value="" class="form-control parsley-validated" placeholder="w.e.f date">
                            <?php echo nbs(2);?><b>with DNI &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">[Date of Next Increment]</small> on</b>
                            <input title="Provide Date of Next Increment" name="DNI_on" id="DNI_on" type="text" value="" class="form-control parsley-validated" placeholder="Enter DNI">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><?php echo form_error('fixed_pay', '<div class="error">', '</div>'); ?><?php echo form_error('effect_from', '<div class="error">', '</div>'); ?><?php echo form_error('DNI_on', '<div class="error">', '</div>'); ?></td>
                    </tr>
                    
                </tbody>
            </table>

            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
      </div>
<div class="tab-pane" id="family_details">
    <div class="row-fluid sortable">
        <div class="span12">
            <legend style="font-size:15px; color:#3b5999; font-weight:700">IPS CHECK LIST » <small style="font-size:11px"> </small></legend>
             <?php $scale_info = unserialize($row1['scale_info']); ?>
            <table class="table" id="myTable" style="margin-top: 10px;">
                <tbody>
                   
                     <?php foreach ($scale_info as $key => $value) {  ?>
                    <tr id="parent-1" class="parent">
                        <td><input style="opacity:4!important;" type="checkbox" name="chk[]" class="chk" /></td>
                        <td><input required class="dob form-control" value="<?php echo $value['date']; ?>" name="date[]" placeholder="Date" size="16" type="text" value=""><label style="font-size:12px; color:red">Date<span class="required-field">*</span></label></td>
                        <td><input required autocomplete="off" placeholder="Pay Fixed At" type="text" id="0" value="<?php echo $value['particulars']; ?>" name="particulars[]" class="form-control name" /><label style="font-size:12px; color:red">Particulars <span class="required-field">*</span></label></td>
                        <td><input required autocomplete="off" placeholder="Pay Scale" type="text" id="0" value="<?php echo $value['scale_pay']; ?>" name="scale_pay[]" class="form-control name" /><label style="font-size:12px; color:red">Pay Fixed at in the scale pay of.. <span class="required-field">*</span></label></td>
                        <td><textarea rows="4" cols="4"  name="identical[]" id="identical" class="form-control"><?php echo $value['identical']; ?></textarea><label style="font-size:12px; color:red">Remarks</label></td>
                        
                        
                    </tr>
                     <?php } ?>
                </tbody>
            </table>
          <a class="btn btn-success scrollToTop" onClick="addRow1('myTable')" data-target="family_details">Add More</a>
            <a class="btn btn-danger scrollToTop" onClick="deleteRow('myTable')" data-target="family_details">Delete</a>
        </div>
    </div>
</div>
<div class="row-fluid sortable">
  <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                    <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">20.Promotion in higher scale under FR 22(i)(a)(1):</label></td>
                        <td><textarea name="higher" id="higher" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks6']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?>
                            </td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">21.Promotion in identical scale under FR 22(i)(a)(1)/Rule 13 of RP Rules 2008 vide Govt.of India order No.10/02/2011-E.III/A dated 07-01-2013 and communicated vide Govt.of A.P order No.FIN/E-II/13/2009 dated 05-04-2013:</label></td>
                        <td><textarea name="identical" id="identical" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks7']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td>  
                    </tr>
                     <tr>
                        
                        
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">22.Pay fixed under FR 23 by exercising of options:</label></td>
                       <td><textarea name="pay_fixed" id="pay_fixed" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks8']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td>                     </tr>
                   
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">23.Stepping up of pay due to Juniors/seniors or Revision of pay under 6th CPC(vide order No.FIN/E-II/22/2008 dated 12-01-2012)if any:</label></td>
                        <td><textarea name="stepping" id="stepping" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks9']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">24.Time Bound Pay Scale under FR 22(i)(a)(2):</label></td>
                        <td><textarea name="time_bound" id="time_bound" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks10']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td>                                                  
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">25.Pay Upgradation under FR 22(i)(a)(2):</label></td>
                        <td><textarea name="upgradation" id="upgradation" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks11']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">26.ACPS under FR22(i)(a)(1) and ACPS Clarification w.e.f 21-11-2003 to 31-08-2008 vide No.35034/1/97-Estt(I) dated 9-8-1999 and communicated by Govt.of A.P order No. OM.25/2002 dated 21-11-2003:</label></td>
                        <td><textarea name="acps" id="acps" placeholder="Please enter Office Address" rows="4" columns="40"><?php echo $row1['remarks12']; ?></textarea><?php echo form_error('office_address', '<div class="error">', '</div>'); ?></td>                                                  
                    </tr>
                    <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">27.MACPS under FR22(i)(a)(1) for Group A,B,C and D w.e.f 01-09-2008 vide GOI No 35034/3/2008-Estt(D) dated 19-05-2009 and communicated vide Govt. of A.p order No. AR-56/2009 dated 31-07-2009:</label></td>
                        <td><textarea rows="4" cols="20" name="macps" id="macps" class="form-control"><?php echo $row1['remarks13']; ?></textarea></td>                         <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">28.Family Planning Allowance/Personal Pay if any:</label></td>
                        <td><textarea rows="4" cols="20" name="family_planning" id="family_planning"  class="form-control"><?php echo $row1['remarks14']; ?></textarea></td>                     </tr>
                      <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">29.Suspension period if any:</label></td>
                        <td><textarea rows="4" cols="20" name="suspension" id="suspension" class="form-control"><?php echo $row1['remarks15']; ?></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">30.Break in service if any (treated not spent on duties):</label></td>
                        <td><textarea rows="4" cols="20" name="break" id="break" class="form-control"><?php echo $row1['remarks16']; ?></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">31.Dies Non:</label></td>
                        <td><textarea rows="4" cols="20" name="dies_non" id="dies_non" class="form-control"><?php echo $row1['remarks17']; ?></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">32.Withholding of increments if any(comulative/without cumulative):</label></td>
                        <td><textarea rows="4" cols="20" name="withholding" id="withholding" class="form-control"><?php echo $row1['remarks18']; ?></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">33.EOL if any (with or without medical certificate):</label></td>
                        <td><textarea rows="4" cols="20" name="eol" id="eol" class="form-control"><?php echo $row1['remarks19']; ?></textarea></td> 
                        <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">34.Increments/Deferred increment if any:</label></td>
                       <td><textarea rows="4" cols="20" name="increments" id="increments"  class="form-control"><?php echo $row1['remarks20']; ?></textarea></td>                                                  
                    </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">35.Any other Informations:</label></td>
                        <td><textarea rows="4" cols="20" name="information" id="information" class="form-control"><?php echo $row1['remarks21']; ?></textarea></td>                         <td></td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">36.Last pay checked upto..at PB+GP:</label></td>
                        <td><textarea rows="4" cols="20" name="last_pay" id="last_pay" class="form-control"><?php echo $row1['remarks22']; ?></textarea></td>                                                  
                    </tr>
                    <tr style="height:50%">
                        <td colspan="2">
                        <strong>37.Remark#1:</strong>  <textarea class="ckeditor_standard"   name="remark23"  ><?php echo $record['remarks23']?></textarea><?php echo form_error('remark23', '<div class="error">', '</div>'); ?><br/>
                        <td></td>          
                       
                    </tr>
                   
                    </tbody>
            </table>

            <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>     
                   
    </div>       
    
  
    <button type="submit" name="submit_val" class="btn btn-primary">Save and Print</button>
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
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>