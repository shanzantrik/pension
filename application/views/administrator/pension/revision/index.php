<?php $file_no = (isset($_POST['file_no'])) ? $_POST['file_no'] : ''; ?>

<form method="POST" action="<?php echo site_url('administrator/pension/revision_index'); ?>" accept-charset="UTF-8">   
    <div class="form-group" style="float: left; width: 60%">
        <label for="name_of_pensionser" class="control-label">File No</label>
        <input class="form-control" id="file_no" required="required" autocomplete="off" name="file_no" type="text" value="<?php echo $file_no; ?>" placeholder="File No">
        <button class="form-control btn btn-success" id="Search" type="submit">Search</button>
    </div>
</form>
<hr />

<?php if(isset($_POST['file_no'])):?>
    <div style="float: left; width: 40%; text-align: right;">
	   <a href="<?php echo site_url('administrator/pension/revision_add/'.base64_encode($_POST['file_no'])); ?>" class="btn btn-info">Add New Revision</a>
    </div>
	<?php $case_details = (array) $service_details; ?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <tr>
            <th width="25%">File No</th>
            <td width="25%"><?php echo $case_details['case_no']; ?></td>
            <th width="25%">Pensioner Name</th>
            <td width="25%"><?php echo $case_details['name']; ?></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><?php echo $case_details['dob']; ?></td>
            <th>Date of retirement</th>
            <td><?php echo ($case_details['dor'] != '0000-00-00') ? $case_details['dor'] : $case_details['dod']; ?></td>
        </tr>
        <tr>
            <th>Net Qualifying Service</th>
            <td>
            	<?php list($year, $month, $day) = explode("-", $case_details['net_qualifying_service']); ?>
	            <?php echo $year." years ".$month." month ".$day." days"; ?>
            </td>
            <th>Designation</th>
            <td><?php echo $case_details['designation']; ?></td>
        </tr>
    </table>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    	<tr>
    		<th width="20%">Pay Scale</th>
    		<th width="15%">Pay Commission</th>
    		<th width="15%">Amount of Pension</th>
    		<th width="10%">Created</th>
    		<th width="40%">Actions</th>
    	</tr>
    	<?php foreach ($revision_details as $rd) : 
        //print_r($rd);
        ?>
    		<?php $pay_scale_details = getPayScale(array('id'=>$rd['revised_scale_pay'])); ?>
    		<?php $psd = $pay_scale_details[0];?>
	    	<tr>
	            <td><?php echo $psd['grade']."-".$psd['pay_scale']; ?></td>
	            <td><?php echo $psd['pay_commission']; ?></td>
	            <td><?php echo $rd['revised_amount_of_pension'];?></td>
	            <td><?php echo dateTimeToDate($rd['pr_created_at']);?></td>
	            <td>
                    <a href="<?php echo site_url('/administrator/pension/revised_worksheet/'.$rd['id']);?>" class="btn btn-default btn-rad link" data-id=""><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                    <?php if($rd['revision_type']=="revised_gratuity"){?>
 <a href="<?php echo site_url('/administrator/pension/revised_gratuity/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report</a>

                       <?php  }else{?>
                    <?php if($rd['dor']=="0000-00-00" && $rd['dod']!="0000-00-00"){
                        //family  pension because death before retirement
                        if($rd['treasury_officer']==""){
                             print_r("outside");?>
            <a href="<?php echo site_url('/administrator/pension/family_revised_authority_report_outside/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report</a>

                            <?php }else{
                             print_r("inside");
                             ?>
        <a href="<?php echo site_url('/administrator/pension/family_revised_authority_report_inside/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report</a>

                           <?php 
                            }
                            ?>



                       <?php  }else if($rd['dor']!="0000-00-00" && $rd['dod']=="0000-00-00"){
                        //pension because only retirement
                        ?>      
            <a href="<?php echo site_url('/administrator/pension/revised_authority_report/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report3</a>

                        
                     <?php }else if($rd['dor']!="0000-00-00" && $rd['dod']!="0000-00-00"){
                         //family death after retirement

//$ac = ($pensioner->treasury_officer!='') ? getTreasury($pensioner->treasury_officer): str_replace(", ", ",<br />", $pensioner->accountant_general_name) ;
                    if($rd['treasury_officer']==""){
                             print_r("outside");?>
            <a href="<?php echo site_url('/administrator/pension/family_revised_authority_report_outside/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report1</a>

                            <?php }else{
                             print_r("inside");
                             ?>
        <a href="<?php echo site_url('/administrator/pension/family_revised_authority_report_inside/'.$rd['id'].'/'.base64_encode($rd['case_no']));?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>Authority Report</a>

                        <?php 
                         }
                     }
                }
                        ?>


    	        </td>
	        </tr>
	    <?php endforeach; ?>
	    <?php if(count($service_details) > 0) : ?>
		    <?php $sd = $service_details; ?>
		    <?php $pay_scale_details = getPayScale(array('id'=>$sd->pay_scale)); ?>
    		<?php $psd = $pay_scale_details[0];?>
	    	<tr>
	            <td><?php echo $psd['grade']."-".$psd['pay_scale'];?></td>
	            <td><?php echo $psd['pay_commission']; ?></td>
	            <td><?php echo getAmountofPension($sd->serial_no); ?></td>
	            <td><?php echo dateTimeToDate($sd->created_at); ?></td>
	            <td>
	            	<a href="<?php echo site_url('/administrator/pension/'.strtolower($sd->class_of_pension).'/'.$sd->serial_no)?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-eye-open"></i>View</a>
	            	<a href="<?php echo site_url('/administrator/service_book/edit/'.$sd->serial_no); ?>" class="btn btn-default btn-rad link" data-id="1000"><i class="icon-pencil"></i> Edit</a>
	            	<select class="action-list">
                        <option value="0">--Select Report--</option>
                        <option value="<?php echo site_url('/administrator/report/'.strtolower($sd->class_of_pension).'/'.$sd->serial_no)?>">Worksheet</option>
                        <!-- <option value="<?php echo site_url('/administrator/disburser/'.strtolower($sd->class_of_pension).'/'.$sd->serial_no); ?>">Disburser</option> -->
                        <option value="<?php echo site_url('/administrator/service_book/reportIO/'.strtolower($sd->class_of_pension).'/'.$sd->serial_no); ?>">Report</option>
                    </select>
	            </td>
	        </tr>
	    <?php endif; ?>
   	</table>
<?php endif; ?>

<style type="text/css">
	form {margin-bottom: 3px;}
	hr {margin: 0px;}
    .form-group {}
    .form-group label {font-weight: bold; float: left; margin-top: 15px;}
    .form-group input {margin-left: 10px;  margin-top: 10px;}
    .btn {padding: 6px;}
    .action-list {width: 150px;  margin: 0px;}
</style>
<script>
    $(document).ready(function() {
        $('.action-list').live('change', function(){
            var url = $(this).val();
            if(url!=0) window.location.href=url;
        });
    });
</script>