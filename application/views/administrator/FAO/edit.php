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
<h3>Edit IPS Details &raquo; <?php //echo $type ?></h3> 
<br/>

 <small style="font-size:12px; font-weight:bold;color:darkgrey">
 Use this panel to attach IPS detail entry for this claimant</small>                  
<?php $record = @$records[0];
//print_r($record);
 $file_no=@$record['file_no'];
 echo $file_no;
 $dept_code=@$record['department'];
 $dept_name=@getDepartmentName($dept_code);

  $status=@$record['status'];
  echo $status;
 
?>
<form  action="<?php echo site_url('administrator/ips/edit_ips/'.base64_encode($file_no).'/'.base64_encode($file_no)); ?>" method="post" autocomplete="off">
    <div>
        <div class="box span12">                
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr>
                      <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Name</label></td>
<td><input title="Name" readonly name="name" type="text" value="<?php echo $record['name']?>" class="form-control parsley-validated" placeholder="Please Enter Member Name"><?php echo form_error('name', '<div class="error">', '</div>'); ?></td>
                      <td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Designation</label></td>
                        <td><input title="Designation" readonly name="designation" value="<?php echo $record['designation']?>" type="text" class="form-control parsley-validated" placeholder=""><?php echo form_error('member_name', '<div class="error">', '</div>');?></td>                                                    
                     </tr>
                     <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Department</label></td>
                        <td> 
                        <select title="Choose Department" 
                        <?php if($status=='Forwarded to IPS')
                        {
                        ?>
                         readonly 
                        <?
                        }
                        ?> 
                        class="form-control parsley-validated parsley-success" name="dept">
                        <?php if(!$dept_code=='')
                        {
                    echo"<option value=$dept_code>$dept_name</option>";
                        }
                        ?>
                        <?php foreach ($departments as $dept) { ?>
                       <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name'];?></option>
                      <?php } ?>
                       </select><?php echo form_error('dept', '<div class="error">', '</div>'); ?>      

                       </td>
                        
  <td><td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Date of Birth</label></td>
  <td><input name="dob"<?php if($status=='Forwarded to IPS')
                        {
                        ?>
                         readonly 
                        <?
                        }
                        ?>


   value="<?php echo $record['dob']?>" id="dob" type="text" class="form-control parsley-validated" title="Provide DOB" placeholder="Date of Birth"><?php echo form_error('dob', '<div class="error">', '</div>'); ?></td>                                                 
                    </tr>
                    <tr>

     


    
<td><strong>Retirement Date on Superannuation/Voluntary/Death</strong></td>
<td><input title="Retirement Date" name="dor" <?php if($status=='Forwarded to IPS')
                        {
                        ?>
                         readonly 
                        <?
                        }
                        ?> value="<?php echo $record['dor']?>" id="dor" type="text" value="" class="form-control parsley-validated" placeholder="Provide Date of Retirement"><?php echo form_error('dor', '<div class="error">', '</div>'); ?></td>
                        
                        <td>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Existing Basic Pay on 1st January 2006</label></td>
                        <td><input name="exist_bp" type="text" value="<?php echo $record['exist_bp']?>" title="Provide Basic Pay" class="form-control parsley-validated" placeholder="Enter Basic Pay "><?php echo form_error('exist_bp', '<div class="error">', '</div>'); ?></td>                           
                    </tr>
                   <!--  <tr>
                        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Scale of &raquo;</label> 

                         </td>
                        

                        <td>Pre-revised<input name="pre_revised" type="text" value=""  class="form-control parsley-validated" placeholder="Please Enter Pre-revised"><?php echo form_error('pre_revised', '<div class="error">', '</div>'); ?></td>
                        
                        <td>
                       
                         
                        <td>Revised</td>
                        <td>
<input autocomplete="off" name="revised"   class="form-control parsley-validated" type="text" value="" placeholder="Please Enter Revised"><?php echo form_error('revised', '<div class="error">', '</div>'); ?>
                        </td>
                        </td>                                                    
                    </tr> -->
                    <tr>
<td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Scale of &raquo;</label> 

                         </td>

                         <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">
                         Pre-revised &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">E.g:12500-20500</small></label>
                         <input title="Pre-revised Scale" name="pre_revised" value="<?php echo $record['pre_revised']?>" type="text" value=""  class="form-control parsley-validated" placeholder="Please Enter Pre-revised"><?php echo form_error('pre_revised', '<div class="error">', '</div>'); ?></td>
                         </td>
<td></td>
                         <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">
                         Revised &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">E.g:12500-20500</small></label> 
                         <input title="Revised Pay" autocomplete="off" name="revised" value="<?php echo $record['revised']?>"   class="form-control parsley-validated" type="text" value="" placeholder="Please Enter Revised"><?php echo form_error('revised', '<div class="error">', '</div>'); ?>
    

                         </td>

                    </tr>
                    <tr>
                        <td colspan="5">
    <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Pay Fixed of Rs.</label>
                        <?php echo nbs(3);?><input title="Provide Fixed Pay" name="fixed_pay" type="text" value="<?php echo $record['pay_fixed']?>"   class="form-control parsley-validated" placeholder="Provide amount of fixed pay">
                       <?php echo nbs(2);?><b>w.e.f</b>
                        <input title="Provide date from which the fixed pay has got effect" name="effect_from" value="<?php echo $record['effect_from']?>" style="width:15%" type="text" id="effect_from"  class="form-control parsley-validated" placeholder="w.e.f date">
                        <?php echo nbs(2);?><b>with DNI &raquo; <small style="font-size:11px; font-weight:bold;color:darkgrey">[Date of Next Increment]</small> on</b>
                        <input title="Provide Date of Next Increment" name="DNI_on" id="DNI_on" value="<?php echo $record['dni_on']?>" type="text" value="" class="form-control parsley-validated" placeholder="Enter DNI">
                     </td>                                                    
                    </tr>

                       <tr>
                        <td colspan="5"><?php echo form_error('fixed_pay', '<div class="error">', '</div>'); ?><?php echo form_error('effect_from', '<div class="error">', '</div>'); ?><?php echo form_error('DNI_on', '<div class="error">', '</div>'); ?></td>

                      </tr>

                    <tr style="height:50%">

                        
<td colspan="2">
 <strong>Remark#1:</strong><textarea class="ckeditor_standard"   name="remark1" value="<?php echo $record['remark1']?>" placeholder="Please Enter Remarks" class="form-control parsley-validated"><?php echo $record['remark1']?></textarea><?php echo form_error('remark1', '<div class="error">', '</div>'); ?><br/></td>
                         

              <td></td>          
<td colspan="2"><strong>Remark#2:</strong> <textarea class="ckeditor_standard"   name="remark2" placeholder="Please Enter Remark2" class="form-control parsley-validated"><?php echo $record['remark2']?></textarea><?php echo form_error('remark2', '<div class="error">', '</div>'); ?></td>
                        
                    </tr>
                    <tr style="height:50%">
                        
                        <td colspan="2"><strong>Remark#3:</strong> <textarea class="ckeditor_standard"   name="remark3" placeholder="Please Enter Remarks 3" class="form-control parsley-validated"><?php echo $record['remark3']?></textarea><?php echo form_error('remark3', '<div class="error">', '</div>'); ?><br/></td>
                        
                        <td></td>  
                        <td colspan="2"><strong>Remark#4:</strong> <textarea class="ckeditor_standard"   name="remark4" placeholder="Please Enter Remarks 4" class="form-control parsley-validated"><?php echo $record['remark4']?></textarea><?php echo form_error('remark4', '<div class="error">', '</div>'); ?></td>
                        
                    </tr>
                </tbody>
            </table> 
             
    <input name="serial_no" type="hidden" value="" class="form-control parsley-validated" placeholder="Please Enter Member Name">
        </div>
    </div>
      
    <button type="submit" name="submit_val" class="btn btn-primary">Save and Print</button>

    <input type="reset" class="btn btn-warning" value="Cancel"> 
<br/>
           <small style="font-size:12px; font-weight:bold;color:darkgrey">If you are not sure on this or want to learn more, contact software provider</small>                  
</form>                 









<script type="text/javascript">
    function FillAddress(f) {
        if(f.addresstoo.checked == true) {
            f.cor_address.value = f.per_address.value;
        }
    }  
$(function() {
                // CKEditor Standard
                $('textarea.ckeditor_standard').ckeditor({
                    height: '150px',
                    width:'500px',
                    toolbar: [
                        {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                        {name: 'basicstyles', items: ['Bold', 'Italic']}
                    ]
                });
                 });

      
</script>