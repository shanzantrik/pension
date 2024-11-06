<?php $pensioner = $values; ?>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1" selected>Disburser Portion</option>
	<option value="form2">Pensioner Portion</option>
</select>
<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width:900px; margin: 0px auto; min-height:600px; color:#000000; background-color:#FFFFFF;">
		<table width="100%" cellpadding="3" id="report" border="0">
			<tr>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="3">
					<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
				        <div style="font-family: initial; margin-left: 200px;">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>DISBURSER'S PORTION</div>
				    </div>
				</td>
				<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="3">
					<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>
				</td>		
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="3">Charged:</td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></b></td>
			</tr>	
		 	<tr>
				<td style="vertical-align: top;" colspan="2">
					<div style="float: left;">Name of Pensioner: </div>
					<div style="float: left;"><b><?php echo nbs(1).strtoupper($pensioner->salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></b></div>
				</td>
				<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					<table border="1" cellspacing="2" cellpadding="2" id="inner-table">
						<tr>
							<th width="20%" style="vertical-align: top;">Class of Pension and date of commencement</th>
							<th width="20%" style="vertical-align: top;">Date of Birth</th>
							<th width="20%" style="vertical-align: top;">Religion and Nationality</th>
							<th width="20%" style="vertical-align: top;">Residence showing village pargana</th>
							<th width="20%" style="vertical-align: top;">Amount of monthly pension</th>
						</tr>
						<tr>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $pensioner->religion.", ".$pensioner->nationality;?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo strtoupper($pensioner->salutation." ".$pensioner->name).'<br />'.$pensioner->address_after_retirement; ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%">Rs. <?php echo $pensioner->getAmountofPension(); ?>/-<br/>PM+DR+MA<br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					Date of death of the pension<br/>
					(To be filled in and attested by the Treasury Officer)
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">Pay Scale:</td>
				<td style="vertical-align: top;" colspan="3"><b><?php echo $pensioner->pay_scale; ?></b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;">Designation:</td>
				<td style="vertical-align: top;" colspan="3"><b><?php echo $pensioner->designation; ?></b></td>
			</tr>	
			<tr>
				<td style="vertical-align: top;">Last Pay:</td>
				<td style="vertical-align: top;" colspan="3">
					<b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; text-align:center" colspan="4">
					<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_no."/".$pensioner->ppo_no; ?></strong></td>
				<td style="vertical-align: top;text-align:right;" colspan="2">Date: <b><?php echo date('d.m.Y')?> </b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Sir,</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					<?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name); ?>, Rtd. <?php echo $pensioner->designation; ?></b>, a sum of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-</b> only (less income-tax), being the amount of <b><?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
					The payment should commence from <b><?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
					<?php
						$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
						if(in_array($pensioner->class_of_pension, $array)) {
							echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM+DR+MA</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$pensioner->pension_attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM+DR+MA</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br /><br />';
						}
					?>
		 		</td>
			</tr>
			
 			<?php
				$dob 	= new DateTime($pensioner->dob);
				$dob1	= date_format($dob,"Y-m-d");
				$dob->modify('+80 year');
				$year80	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year85	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year90	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year95	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year100= date_format($dob,"Y-m-d");
			?>
			<tr>
				<td colspan="4" style="border:1px solid#000">
					1.W.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);?> to <?php echo $pensioner->dateTimeToDate($year80); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
					2.W.e.f <?php $year80plus = new DateTime($year80);
					$year80plus->modify('+1 day');
					$year80plus1 = date_format($year80plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year80plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
					3.W.e.f  <?php $year85plus = new DateTime($year85);
					$year85plus->modify('+1 day');
					$year85plus1 = date_format($year85plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year85plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
					4.W.e.f <?php $year90plus = new DateTime($year90);
					$year90plus->modify('+1 day');
					$year90plus1 = date_format($year90plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year90plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year95);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
					5.W.e.f <?php $year95plus = new DateTime($year95);
					$year95plus->modify('+1 day');
					$year95plus1 = date_format($year95plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year95plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
				</td>	
			</tr>
			<tr style="height:20px;"></tr>
			<tr>
				<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2">
					a) Provisional Pension Rs. Not Paid<br/>
					c) Excess pay and Allowances Rs. Not Paid
				</td>
				<td style="vertical-align: top;" colspan="2">
					b) Excess Provisional RG/DCRG Rs. Not Paid<br/>
					d) If any Rs. Not Paid
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
			</tr>
			<tr>
				<td colspan="4" align="right">Signature_________________</td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="2"><b>
					To<br/>
					The Treasury Officer,<br/>
					<!-- Minor Head<br/>
					Dist. Lower Subansiri, Arunachal Pradesh</b> -->
					<?php echo $pensioner->sub_to; ?>
				</td>
				<td colspan="2" align="right">
					Designation_______________
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width:900px; margin: 0px auto; min-height:600px; color:#000000; background-color:#FFFFFF;">
		<table width="100%" cellpadding="3" id="report" border="0">
			<tr>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
				<td style="vertical-align: top;" width="25%"></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="3">
					<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
				        <div style="font-family: initial; margin-left: 200px;">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>PENSIONER'S PORTION</div>
				    </div>
				</td>
				<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="3">
					<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>
				</td>		
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="3">Charged:</td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></b></td>
			</tr>	
		 	<tr>
				<td style="vertical-align: top;" colspan="2">
					<div style="float: left;">Name of Pensioner: </div>
					<div style="float: left;"><b><?php echo nbs(1).strtoupper($pensioner->salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></b></div>
				</td>
				<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					<table border="1" cellspacing="2" cellpadding="2" id="inner-table">
						<tr>
							<th width="20%" style="vertical-align: top;">Class of Pension and date of commencement</th>
							<th width="20%" style="vertical-align: top;">Date of Birth</th>
							<th width="20%" style="vertical-align: top;">Religion and Nationality</th>
							<th width="20%" style="vertical-align: top;">Residence showing village pargana</th>
							<th width="20%" style="vertical-align: top;">Amount of monthly pension</th>
						</tr>
						<tr>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $pensioner->religion.", ".$pensioner->nationality;?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo strtoupper($pensioner->salutation." ".$pensioner->name).'<br />'.$pensioner->address_after_retirement; ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%">Rs. <?php echo $pensioner->getAmountofPension(); ?>/-<br/>PM+DR+MA<br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					Date of death of the pension<br/>
					(To be filled in and attested by the Treasury Officer)
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">Pay Scale:</td>
				<td style="vertical-align: top;" colspan="3"><b><?php echo $pensioner->pay_scale; ?></b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;">Designation:</td>
				<td style="vertical-align: top;" colspan="3"><b><?php echo $pensioner->designation; ?></b></td>
			</tr>	
			<tr>
				<td style="vertical-align: top;">Last Pay:</td>
				<td style="vertical-align: top;" colspan="3">
					<b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; text-align:center" colspan="4">
					<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_no."/".$pensioner->ppo_no; ?></strong></td>
				<td style="vertical-align: top;text-align:right;" colspan="2">Date: <b><?php echo date('d.m.Y')?> </b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Sir,</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					<?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name); ?>, Rtd. <?php echo $pensioner->designation; ?></b>, a sum of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-</b> only (less income-tax), being the amount of <b><?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
					The payment should commence from <b><?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
					<?php
						$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
						if(in_array($pensioner->class_of_pension, $array)) {
							echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM+DR+MA</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$pensioner->pension_attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM+DR+MA</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br /><br />';
						}
					?>
		 		</td>
			</tr>
			
 			<?php
				$dob 	= new DateTime($pensioner->dob);
				$dob1	= date_format($dob,"Y-m-d");
				$dob->modify('+80 year');
				$year80	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year85	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year90	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year95	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year100= date_format($dob,"Y-m-d");
			?>
			<tr>
				<td colspan="4" style="border:1px solid#000">
					1.W.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);?> to <?php echo $pensioner->dateTimeToDate($year80); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
					2.W.e.f <?php $year80plus = new DateTime($year80);
					$year80plus->modify('+1 day');
					$year80plus1 = date_format($year80plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year80plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
					3.W.e.f  <?php $year85plus = new DateTime($year85);
					$year85plus->modify('+1 day');
					$year85plus1 = date_format($year85plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year85plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
					4.W.e.f <?php $year90plus = new DateTime($year90);
					$year90plus->modify('+1 day');
					$year90plus1 = date_format($year90plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year90plus1);
					?> to <?php echo $pensioner->dateTimeToDate($year95);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
					5.W.e.f <?php $year95plus = new DateTime($year95);
					$year95plus->modify('+1 day');
					$year95plus1 = date_format($year95plus,"Y-m-d");
					echo $pensioner->dateTimeToDate($year95plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
				</td>	
			</tr>
			<tr style="height:20px;"></tr>
			<tr>
				<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2">
					a) Provisional Pension Rs. Not Paid<br/>
					c) Excess pay and Allowances Rs. Not Paid
				</td>
				<td style="vertical-align: top;" colspan="2">
					b) Excess Provisional RG/DCRG Rs. Not Paid<br/>
					d) If any Rs. Not Paid
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
			</tr>
			<tr>
				<td colspan="4" align="right">Signature_________________</td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="2"><b>
					To<br/>
					The Treasury Officer<br/>
					<!-- Minor Head<br/>
					Dist. Lower Subansiri, Arunachal Pradesh</b> -->
					<?php echo $pensioner->sub_to; ?>
				</td>
				<td colspan="2" align="right">
					Designation_______________
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">
	function myFunction() {
	    window.print();
	}

	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val=="form1") {
				hideAll();
				$('#form1').show();
			} else if(val=="form2") {
				hideAll();
				$('#form2').show();
			} else {

			}
		});
	});

	function hideAll() {
		$('#form1').hide();
		$('#form2').hide();
	}
</script>