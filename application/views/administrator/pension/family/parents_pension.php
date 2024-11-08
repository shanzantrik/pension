<?php $pensioner = $values; ?>
<h4>Pension -> Family -> <?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></h4>

<table align="center" border="1" class="table table-striped table-bordered table-condensed">
	<tr>
		<td width="20%"><b>File No</b></td>
		<td width="30%"><?php echo $pensioner->case_no; ?></td>
		<td width="18%"><b>Name of Pensioner</b></td>
		<td width="32%"><?php echo $pensioner->name; ?></td>
	</tr>
	<tr>
		<td><b>Date Of Birth</b></td>
		<td><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></td>
		<td><b>Date of Joining</b></td>
		<td><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></td>
	</tr>
	<tr>
		<td><b>Age at Joining</b></td>
		<td><?php echo $pensioner->age_at_joining(); ?></td>
		<td><b>Date of Retirement</b></td>
		<td><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></td>
	</tr>
	<tr>
		<td><b>Age at retirement</b></td>
		<td><?php echo $pensioner->age_at_retirement(); ?></td>
		<td><b>Total Service</b></td>
		<td><?php echo $pensioner->total_service; ?></td>
	</tr>
	<tr>
		<td><b>Less non qualifying service</b></td>
		<td><?php echo $pensioner->non_qualifying_service(); ?></td>
		<td><b>Net qualifying Service</b></td>
		<td><?php echo $pensioner->net_qualifying_service(); ?></td>
	</tr>
	<tr>
		<td><b>Service Verification</b></td>
		<td><?php echo ($pensioner->service_verification==0) ? "Not Verified" : 'Verified'; ?></td>
		<td><b>Regularization of Adhoc Service</b></td>
		<td><?php echo $pensioner->probation_period; ?></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><b>Leave Account(No of Days)</b></td>
	</tr>
	<tr>
		<td><b>Earn leave</b></td>
		<td><?php echo $pensioner->earn_leave;?></td>
		<td><b>Half pay leave</b></td>
		<td><?php echo $pensioner->half_leave;?></td>
	</tr>
	<tr>
		<td><b>Last Pay</b></td>
		<td colspan="3">
			<?php echo $pensioner->getLastPay(); ?>
		</td>
	</tr>
	<tr>
		<td><b>Last Incremented Pay:</td>
		<td colspan="3">
			<?php echo $pensioner->getLastIncreamentPay(); ?>
		</td>
	</tr>
	<tr>
		<td><b>Average Emoluments</b></td>
		<td><?php echo $pensioner->getAverageEmolument(); ?></td>
		<td><b>Amount of Pension</b></td>
		<td><?php echo $pensioner->getAmountofPension(); ?></td>
	</tr>
	<tr>
		<td><b>Amount of DCR</b></td>
		<td><?php echo $pensioner->getDCRG(); ?></td>
		<td><b>DA</b></td>
		<td><?php echo $pensioner->da_percentage();?></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><b>Family Pension</b></td>
	</tr>
	<tr>
		<td><b>Enhanced Rate</b></td>
		<td><?php echo $pensioner->getEnhanceRate(); ?></td>
		<td><b>Ordinary Rate</b></td>
		<td><?php echo $pensioner->getOrdinaryRate(); ?></td>
	</tr>
	<tr>
		<td><b>Place of Payment (under which Treasury/Bank)</b></td>
		<td><?php echo $pensioner->bank_name; ?></td>
		<td><b>Address after Retirement</b></td>
		<td><?php echo $pensioner->address_after_retirement; ?></td>
	</tr>
	<tr>
		<td><b>Class of Pension</b></td>
		<td><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></td>
		<td><b>Name of Legal Heir</b></td>
		<td><?php echo $pensioner->getNameOfLegalHeir(); ?></td>
	</tr>
	<tr>
		<!-- <td><b>Form Submitted</b></td>
		<td><?php echo $form_Submit; ?></td> -->
		<td><b>Document</b></td>
		<td colspan="3"><?php echo $pensioner->getSubmittedDocument('doc_name'); ?></td>
	</tr>
	<tr>
		<td><b>Provisional Gratuity Status</b></td>
		<td><?php echo $pensioner->provisional_gratuity; ?></td>
		<td><b>Provisional Pension Status</b></td>
		<td><?php echo $pensioner->provisional_pension; ?></td>
	</tr>
	<tr>
		<td colspan="100%"><b>TRANSFER HISTORY </b></td>
	</tr>
	<tr>
<?php
$ag = array();
$treasury = array();
foreach(getAllAccountantGeneral() as $value) :
$ag[$value['id']] = $value['name'];
endforeach;
foreach (getAllTreasury() as $value) :
$treasury[$value['id']] = $value['title'];
endforeach;
?>
<?php
/*print_r($files);
die();*/
 foreach ($files as $file) { ?>
		<?php
            if($file['type'] == 'inside') :
                $recieved_from 	= str_replace(", ", ",<br />", $treasury[$file['irf']]);
            	$sent_to 		= str_replace(", ", ",<br />", $ag[$file['ist']]);
            	$ppo 			= $file['case_no']."/".$file['ppo'];
            	$url 			= 'administrator/transfer/inside';
            elseif($file['type'] == 'outside') :
                $recieved_from 	= str_replace(", ", ",<br />", $ag[$file['orf']]);
            	$sent_to 		= str_replace(", ", ",<br />", $treasury[$file['ost']]);
            	$ppo 			= $file['ppo'];
            	$url 			= 'administrator/transfer/outside';
            endif;
        ?>
		<tr>
            <td>Received From</td>
            <td><?php echo $recieved_from; ?></td>
            <td>Sent To</td>
            <td><?php echo $sent_to; ?></td>
        </tr>
	<?php } ?>
</tr>
</table>
<style type="text/css">
	.table td {padding: 10px;}
	.da{font-size: 12px;}
	.inc-details {font-size: 12px;color: #191699;display: inline;}
</style>