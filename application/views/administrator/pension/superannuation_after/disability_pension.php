<?php $pensioner = $values; ?>
<h4>Pension -> <?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></h4>

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
		<td><b>Retirement Gratuity</b></td>
		<td><?php echo $pensioner->getDCRG(); ?></td>
		<td><b>Commutation of Pension</b></td>
		<td>
			<?php if($pensioner->com_applied == 1) {
				echo $pensioner->getCommutationofPension();
			}else{
				echo "N/A";
			}
			?>
		</td>
	</tr>
	<tr>
		<td><b>Reduced pension</b></td>
		<td><?php echo $pensioner->getReducePension(); ?></td>
		<td><b>DA</b></td>
		<td><?php echo $pensioner->da_percentage();?></td>
	</tr>
    <tr>
		<td><b>Disabilty pension</b></td>
		<td><?php echo $pensioner->getDisabilityPension(); ?></td>
		<td></td>
		<td></td>
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

</table>
<style type="text/css">
	.table td {padding: 10px;}
	.da{font-size: 12px;}
	.inc-details {font-size: 12px;color: #191699;display: inline;}
</style>







































































