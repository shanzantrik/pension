<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php $val = $values[0]; ?>
<?php
	$pay_info = unserialize($val['pay_info']);
	$lp = array();
	foreach ($pay_info[0] as $key => $value) {
		$lp[$key] = $value;
	}
	$ip = array();
	foreach ($pay_info[1] as $key => $value) {
		$ip[$key] = $value;
	}
	$lastPay = getPay($lp);
?>
<style type="text/css">
	/*#print {width:900px; margin: 0px auto; min-height:600px; color:#000000; background-color:#FFFFFF;}
	#heading {text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px}
	#heading div {font-family: initial; margin-left: 200px; }
	#report tr td{vertical-align: top;}
	#photograph {width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;}
	#photograph p{text-align: center; margin-top: 50px; font-weight: bold;}
	#inner-table tr td{text-align: center;}*/
</style>
<div id="print" style="width:900px; margin: 0px auto; min-height:600px; color:#000000; background-color:#FFFFFF;">
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
			<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $val['class_of_pension']); ?></b></td>
		</tr>	
	 	<tr>
			<td style="vertical-align: top;" colspan="2">
				<div style="float: left;">Name of Pensioner: </div>
				<div style="float: left;"><b><?php echo nbs(1).$val['name']; ?>, <br /><?php echo nbs(1); ?>Rtd. <?php echo $val['designation']; ?></b></div>
			</td>
			<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
		</tr>
		<tr>
			<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php echo getNameofSpouse($val['family_info']); ?></b></td>
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
						<td style="vertical-align: top; text-align: center;" width="20%"><?php echo str_replace("_", " ", $val['class_of_pension']); ?><br/>w.e.f <?php echo $val['effect_of_pension']; ?></td>
						<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $val['dob']; ?></td>
						<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $val['religion'].", ".$val['nationality'];?></td>
						<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $val['address_after_retirement']; ?></td>
						<td style="vertical-align: top; text-align: center;" width="20%"><input type="hidden" value="<?php echo $amountOfPension; ?>">Rs. <?php echo $amountOfPension; ?>/-<br/>PM+DR+MA<br/>w.e.f <?php echo $val['effect_of_pension']; ?></td>
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
			<td style="vertical-align: top;" colspan="3"><b><?php echo $val['pay_scale']; ?></b></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Designation:</td>
			<td style="vertical-align: top;" colspan="3"><b><?php echo $val['designation']; ?></b></td>
		</tr>	
		<tr>
			<td style="vertical-align: top;">Last Pay:</td>
			<td style="vertical-align: top;" colspan="3">
				<input type="hidden" value="<?php echo $lastPay; ?>" />
				<input type="hidden" value="<?php echo $lastPay; ?>" />
				<b>Rs. <?php echo $lastPay; ?>/-</b>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; text-align:center" colspan="4">
				<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
			</td>
		</tr>

		<tr>
			<td style="vertical-align: top;" colspan="2"><strong>No.Pen/AP/<?php echo $val['case_no']; ?></strong></td>
			<td style="vertical-align: top;text-align:right;" colspan="2">Date: <b><?php echo date('d.m.Y')?> </b></td>
		</tr>
		<tr>
			<td style="vertical-align: top;" colspan="4">Sir,</td>
		</tr>
		<tr>
			<td style="vertical-align: top;" colspan="4">
				<?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php echo $val['name']; ?>, Rtd. <?php echo $val['designation']; ?></b>, a sum of <b>Rs. <?php echo $amountOfPension; ?>/-</b> only (less income-tax), being the amount of <b><?php echo strtoupper(str_replace("_", " ", $val['class_of_pension'])); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
				The payment should commence from <b><?php echo $val['effect_of_pension']; ?></b>.<br/>&nbsp;
				<?php
					$array = array('Superannuation_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
					if(in_array($val['class_of_pension'], $array)) {
						$oradinaryRate = $lastPay*30/100;
						echo '<br/>2.In the event of the death of <b>Shri '.$val['name'].'</b>, Family Pension of <b>Rs. '.$amountOfPension.'/- PM+DR+MA</b>, may be paid to <b>'.getNameofSpouse($val['family_info']).'</b>,whose date of birth is <b>01.11.1962 </b>from the day following the date of death of <b>Shri '.$val['name'].'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of 65/67 years, had he/ she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$oradinaryRate.'/- PM+DR+MA</b>, till the date of her/his remarriage or death whichever is earlier(on receipt of death certificate and Form of application from window/widower). Further, The quantum of pension/Family pension shall be increased as follows:-<br /><br />';
					}
				?>
	 		</td>
		</tr>
		<tr>
			<td style="vertical-align: top;border: 1px solid #000; padding: 5px 0 5px 10px;" colspan="2">
				Age of pensioner/Family Pensioner<br/>
				From 80 years to less than 85 years<br/>
				From 85 years to less than 90 years<br/>                                               
				From 90 years to less than 95 years<br/>                                       
				From 95 years to less than 100 years<br/>                                   
				100 years or more.                                  
			</td>
			<td style="vertical-align: top;border: 1px solid #000; padding: 5px 0 5px 10px;" colspan="2">
				Additional quantum of pension<br/>
				20% of revised basic pension /family pension<br/>
				30% of revised basic pension /family pension<br/>
				40% of revised basic pension /family pension<br/>
				50% of revised basic pension /family pension<br/>
				100% of revised basic pension /family pension
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
		</tr>
		<tr>
			<td style="vertical-align: top;" colspan="2">
				a) Provisional Pension Rs. Not Paid<br/>
				c) Excess pay and Allowances NIL
			</td>
			<td style="vertical-align: top;" colspan="2">
				b) Excess Provisional RG/DCR NIL<br/>
				d) If any NIL
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
				Minor Head<br/>
				Dist. Lower Subansiri, Arunachal Pradesh</b>
			</td>
			<td colspan="2" align="right">
				Designation_______________
			</td>
		</tr>
	</table>
</div>

<script>
function myFunction() {
    window.print();
}
</script>