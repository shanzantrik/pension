

<?php
    $record = $values[0];
    $dept_forw_no=$record->dept_forw_no;
   
   
?>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>

<h3>Select IPS Observations</h3><br/>

<small style="font-size:12px; font-weight:bold;color:darkgrey">Use this panel to attach IPS detail entry for this claimant</small>                  




<form  action="<?php echo site_url('administrator/ips/print_ips_all/'.base64_encode($dept_forw_no).'/'.base64_encode($dept_forw_no)); ?>" method="post" autocomplete="off">
  
    <div class="row-fluid sortable">
        <div class="box span12">
         
                    
            <table class="table" id="example" aria-describedby="datatable_info" width="100%">
                <tbody role="alert" aria-live="polite" aria-relevant="all">
<?php 
    $i=0;
    foreach ($values as $val)
   {

$name=$val->name;
$designation=$val->designation;
$dept_forw_no=$val->dept_forw_no; 
$remark2=$val->remark2;
$remark3=$val->remark3;
$remark4=$val->remark4;
$remark5=$val->remark5;
$remark6=$val->remarks6;
$remark7=$val->remarks7;
$remark8=$val->remarks8;
$remark9=$val->remarks9;
$remark10=$val->remarks10;
$remark11=$val->remarks11;
$remark12=$val->remarks12;
$remark13=$val->remarks13;
$remark14=$val->remarks14;
$remark15=$val->remarks15;
$remark16=$val->remarks16;
$remark17=$val->remarks17;
$remark18=$val->remarks18;
$remark19=$val->remarks19;
$remark20=$val->remarks20;
$remark21=$val->remarks21;
$remark22=$val->remarks22;
$remark23=$val->remarks23;

?>     
                  <input id="chk_<?php echo $i ?>"  type="hidden" name="name[]" value="<?php echo $name; ?>"> 
                   <tr>
                        <div class="form-group" style="min-height: 54px;">
                        <label class="col-sm-3 control-label"><b><?php echo $name;?>--<?php echo $designation;?></b></label>
                        
                         </div>                                              
                    </tr>
                    <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="earlier[<?php echo $i ?>]" value="<?php echo $remark2; ?>">1.Earlier Checked Upto...if any:
                       
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('earlier', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                       <input id="chk_<?php echo $i ?>"  type="checkbox" name="observation[<?php echo $i ?>]" value="<?php echo $remark3; ?>">2.Earlier observations...if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('observation', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="additional[<?php echo $i ?>]" value="<?php echo $remark4; ?>">3.One additional increment for falling between Feb' to June'2006 and shall be re-fixed pay w.e.f 01-01-2006 in revised pay vide order No.10/2/2011-E-III(A) dated 19-03-2012 and communicated by Govt.of A.P order No.FIN/E-II/22/2008 dated 21-11-2012
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('additional', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="ips[<?php echo $i ?>]" value="<?php echo $remark5; ?>">4.IPS 1973/1986/1996/2006 :passed/observations
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('ips', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                       <input id="chk_<?php echo $i ?>"  type="checkbox" name="higher[<?php echo $i ?>]" value="<?php echo $remark6; ?>">5.Promotion in higher scale under FR 22(i)(a)(1)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('higher', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="identical[<?php echo $i ?>]" value="<?php echo $remark7; ?>">6.Promotion in identical scale under FR 22(i)(a)(1)/Rule 13 of RP Rules 2008 vide Govt.of India order No.10/02/2011-E.III/A dated 07-01-2013 and communicated vide Govt.of A.P order No.FIN/E-II/13/2009 dated 05-04-2013
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('identical', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="pay_fixed[<?php echo $i ?>]" value="<?php echo $remark8; ?>">7.Pay fixed under FR 23 by exercising of options
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('pay_fixed', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="stepping[<?php echo $i ?>]" value="<?php echo $remark9; ?>">8.Stepping up of pay due to Juniors/seniors or Revision of pay under 6th CPC(vide order No.FIN/E-II/22/2008 dated 12-01-2012)if any.
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('stepping', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="time_bound[<?php echo $i ?>]" value="<?php echo $remark10; ?>">9.Time Bound Pay Scale under FR 22(i)(a)(2)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('time_bound', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="upgradation[<?php echo $i ?>]" value="<?php echo $remark11; ?>">10.Pay Upgradation under FR 22(i)(a)(2)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('upgradation', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="acps[<?php echo $i ?>]" value="<?php echo $remark12; ?>">11.ACPS under FR22(i)(a)(1) and ACPS Clarification w.e.f 21-11-2003 to 31-08-2008 vide No.35034/1/97-Estt(I) dated 9-8-1999 and communicated by Govt.of A.P order No. OM.25/2002 dated 21-11-2003
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('acps', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="macps[<?php echo $i ?>]" value="<?php echo $remark13; ?>">12.MACPS under FR22(i)(a)(1) for Group A,B,C and D w.e.f 01-09-2008 vide GOI No 35034/3/2008-Estt(D) dated 19-05-2009 and communicated vide Govt. of A.p order No. AR-56/2009 dated 31-07-2009
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('macps', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="family[<?php echo $i ?>]" value="<?php echo $remark14; ?>">13.Family Planning Allowance/Personal Pay if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('family', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="suspension[<?php echo $i ?>]" value="<?php echo $remark15; ?>">14.Suspension period if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('suspension', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                       <input id="chk_<?php echo $i ?>"  type="checkbox" name="break[<?php echo $i ?>]" value="<?php echo $remark16; ?>">15.Break in service if any (treated not spent on duties)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('break', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                   
                    <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="dies_non[<?php echo $i ?>]" value="<?php echo $remark17; ?>">16.Dies Non
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('dies_non', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                        <input id="chk_<?php echo $i ?>"  type="checkbox" name="withholding[<?php echo $i ?>]" value="<?php echo $remark18; ?>">17.Withholding of increments if any(comulative/without cumulative)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('withholding', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                         <input id="chk_<?php echo $i ?>"  type="checkbox" name="eol[<?php echo $i ?>]" value="<?php echo $remark19; ?>">18.EOL if any (with or without medical certificate)
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('eol', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                         <input id="chk_<?php echo $i ?>"  type="checkbox" name="increments[<?php echo $i ?>]" value="<?php echo $remark20; ?>">19.Increments/Deferred increment if any
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('increments', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                  <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                         <input id="chk_<?php echo $i ?>"  type="checkbox" name="information[<?php echo $i ?>]" value="<?php echo $remark21; ?>">20.Any other Informations
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('information', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                         <input id="chk_<?php echo $i ?>"  type="checkbox" name="last_pay[<?php echo $i ?>]" value="<?php echo $remark22; ?>">21.Last pay checked upto..at PB+GP
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('last_pay', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                 <tr>
                        <div class="form-group" style="min-height: 54px;">
                        
                        <div class="col-sm-6">
                         <input id="chk_<?php echo $i ?>"  type="checkbox" name="remarks[<?php echo $i ?>]" value="<?php echo $remark23; ?>">22.Remarks
                        <div id="error-label-for-sex"></div>
                        <?php echo form_error('remarks', '<label class="error">', '</label>'); ?>
                       </div>
                   </div>                                              
                </tr>
                
               
   <?php
$i++;
}
?>             
                                                    
              
             
                    
                   
                   
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
