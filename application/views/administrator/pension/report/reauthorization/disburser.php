<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.mb.browser.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.printElement.min.js"></script>

<?php $abc = $values[0]; ?>
<?php $pensioner = $records; ?>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1" selected>Disburser Portion</option>
	<option value="form2">Pensioner Portion</option>
</select>

<script type="text/javascript">
    /*jQuery(function($) {
		$('#printReport').click(function() {
			$("#print").printElement({
				printMode:'popup'
			});
		});
    });*/
</script>

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
				<td style="vertical-align: top;" colspan="4">Class of Pension: <b>Family Pension <?php //echo str_replace("_", " ", $pensioner->class_of_pension); ?></b></td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="2">
					<div style="float: left;">Name of Pensioner: </div>
					<div style="float: left;"><b><?php if($sal=="mr"){?><?php echo "Mr"?><?php }else{?><?php echo"Miss"?><?php }?><?php echo nbs(1);?><?php echo $abc['claiment_name'];echo nbs(1);?><?php if($sal=="mr"){?><?php echo "(Son)"?><?php }else{?><?php echo"(Daughter)"?><?php }?><?php echo "of Late"; echo nbs(1).$abc['name']; ?>,<br />Ex.<?php echo $abc['designation'];?></b></div>
				</td>
				<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment </td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php //echo $pensioner->getNameofSpouse();?></b></td>
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
							<td style="vertical-align: top; text-align: center;" width="20%">Family Pension<br/>w.e.f <?php if($abc['ordrate_from']=="0000-00-00"){echo $abc['enhanrate_from'];}else{?><?php echo $abc['ordrate_from'];?><?php }?><?php //echo $pensioner->effect_of_pension; ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $abc['claiment_dob'];?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php  echo $pensioner->religion.", ".$pensioner->nationality;?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"></td>
							<td style="vertical-align: top; text-align: center;" width="20%">
								<?php if($abc['enhanrate_from']=="0000-00-00"){?> N/R <?php echo $pensioner->getOrdinaryRateReautho(); ?>from<?php echo $abc['ordrate_from']?><?php echo nbs(1);?>To<?php echo nbs(1);?><?php echo $abc['age_25']?><?php }else if($abc['ordrate_from']=="0000-00-00"){?>E/R OF <?php echo nbs(1);?><?php echo $pensioner->getEnhanceRateReautho(); ?><?php echo nbs(1);?>/-w.e.f<?php echo nbs(1);?><?php echo $abc['enhanrate_from'];?><?php echo nbs(1);?>TO<?php echo nbs(1);?><?php echo $abc['enhanrate_upto_for_child'];?> <?php }else{?>
								E/R OF <?php echo nbs(1);?><?php echo $pensioner->getEnhanceRateReautho(); ?><?php echo nbs(1);?> <?php //echo //$pensioner->getAmountOfPenion(); ?>/-<br/>w.e.f<?php echo nbs(1);?><?php echo $abc['enhanrate_from'];?><?php echo nbs(1);?>TO<?php echo nbs(1);?><?php echo $abc['enhanrate_upto_for_child'];?><?php echo nbs(1);?>N/R <?php echo getOrdinaryRateReautho();?><?php echo nbs(1);?>from <?php echo nbs(1);?><?php echo $abc['ordrate_from']?><?php echo nbs(1);?>To<?php echo nbs(1);?><?php echo $abc['age_25']?><?php }?>
							</td>
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
					<b>Rs. <?php echo $pensioner->getLastPay(); ?>/-</b>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; text-align:center" colspan="4">
					<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2"><strong>No.Pen/AP/<?php //echo $pensioner->case_no; ?></strong></td>
				<td style="vertical-align: top;text-align:right;" colspan="2">Date: <b><?php //echo date('d.m.Y')?> </b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Sir,</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php if($sal=="mr"){?><?php echo "Mr"?><?php }else{?><?php echo"Miss"?><?php }?><?php echo nbs(1);?><?php echo $abc['claiment_name'];echo nbs(1);?><?php if($sal=="mr"){?><?php echo "(Son) "?><?php }else{?><?php echo"(Daughter) "?><?php }?><?php echo "of Late"; echo nbs(1).$abc['name']; ?>,<?php //echo nbs(1);?>Ex.<?php echo $abc['designation'];?></b><?php //echo $pensioner->name; ?> <?php //echo $pensioner->designation; ?></b>, a sum of <b>Rs.<?php if($abc['enhanrate_from']=="0000-00-00"){?><?php echo getOrdinaryRateReautho();?> <?php }else{?><?php echo $pensioner->getEnhanceRateReautho();?><?php }?><?php //echo $pensioner->getAmountOfPenion(); ?>/-</b> only (less income-tax), being the amount of FAMILY PENSION <b><?php //echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
					The payment should commence from <b><?php if($abc['ordrate_from']=="0000-00-00"){echo $abc['enhanrate_from'];}else{?><?php echo $abc['ordrate_from'];?><?php }?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
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
					a) Provisional Pension <?php if($pensioner->provisional_pension=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->provisional_pension.''."/-" ;?><?php }?><br/>
					c) Excess pay and Allowances <?php if($pensioner->excess_pay_and_allowances=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->excess_pay_and_allowances.''."/-" ;?><?php }?>
				</td>
				<td style="vertical-align: top;" colspan="2">
					b) Excess Provisional RG/DCR NIL <?php if($pensioner->provisional_gratuity=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->provisional_gratuity.''."/-" ;?><?php }?><br/>
					d) If any <?php if($pensioner->others=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->others.''."/-" ;?><?php }?>
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
				<td style="vertical-align: top;" colspan="4">Class of Pension: <b>Family Pension <?php //echo str_replace("_", " ", $pensioner->class_of_pension); ?></b></td>
			</tr>
		 	<tr>
				<td style="vertical-align: top;" colspan="2">
					<div style="float: left;">Name of Pensioner: </div>
					<div style="float: left;"><b><?php if($sal=="mr"){?><?php echo "Mr"?><?php }else{?><?php echo"Miss"?><?php }?><?php echo nbs(1);?><?php echo $abc['claiment_name'];echo nbs(1);?><?php if($sal=="mr"){?><?php echo "(Son)"?><?php }else{?><?php echo"(Daughter)"?><?php }?><?php echo "of Late"; echo nbs(1).$abc['name']; ?>,<br />Ex.<?php echo $abc['designation'];?></b></div>
				</td>
				<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment </td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php //echo $pensioner->getNameofSpouse();?></b></td>
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
							<td style="vertical-align: top; text-align: center;" width="20%">Family Pension<br/>w.e.f <?php if($abc['ordrate_from']=="0000-00-00"){echo $abc['enhanrate_from'];}else{?><?php echo $abc['ordrate_from'];?><?php }?><?php //echo $pensioner->effect_of_pension; ?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php echo $abc['claiment_dob'];?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"><?php  echo $pensioner->religion.", ".$pensioner->nationality;?></td>
							<td style="vertical-align: top; text-align: center;" width="20%"></td>
							<td style="vertical-align: top; text-align: center;" width="20%">
								<?php if($abc['enhanrate_from']=="0000-00-00"){?> N/R <?php echo $pensioner->getOrdinaryRateReautho(); ?>from<?php echo $abc['ordrate_from']?><?php echo nbs(1);?>To<?php echo nbs(1);?><?php echo $abc['age_25']?><?php }else if($abc['ordrate_from']=="0000-00-00"){?>E/R OF <?php echo nbs(1);?><?php echo $pensioner->getEnhanceRateReautho(); ?><?php echo nbs(1);?>/-w.e.f<?php echo nbs(1);?><?php echo $abc['enhanrate_from'];?><?php echo nbs(1);?>TO<?php echo nbs(1);?><?php echo $abc['enhanrate_upto_for_child'];?> <?php }else{?>
								E/R OF <?php echo nbs(1);?><?php echo $pensioner->getEnhanceRateReautho(); ?><?php echo nbs(1);?> <?php //echo //$pensioner->getAmountOfPenion(); ?>/-<br/>w.e.f<?php echo nbs(1);?><?php echo $abc['enhanrate_from'];?><?php echo nbs(1);?>TO<?php echo nbs(1);?><?php echo $abc['enhanrate_upto_for_child'];?><?php echo nbs(1);?>N/R <?php echo getOrdinaryRateReautho();?><?php echo nbs(1);?>from <?php echo nbs(1);?><?php echo $abc['ordrate_from']?><?php echo nbs(1);?>To<?php echo nbs(1);?><?php echo $abc['age_25']?><?php }?>
							</td>
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
					<b>Rs. <?php echo $pensioner->getLastPay(); ?>/-</b>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; text-align:center" colspan="4">
					<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2"><strong>No.Pen/AP/<?php //echo $pensioner->case_no; ?></strong></td>
				<td style="vertical-align: top;text-align:right;" colspan="2">Date: <b><?php //echo date('d.m.Y')?> </b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">Sir,</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="4">
					UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php if($sal=="mr"){?><?php echo "Mr"?><?php }else{?><?php echo"Miss"?><?php }?><?php echo nbs(1);?><?php echo $abc['claiment_name'];echo nbs(1);?><?php if($sal=="mr"){?><?php echo "(Son)"?><?php }else{?><?php echo"(Daughter)"?><?php }?><?php echo "of Late"; echo nbs(1).$abc['name']; ?>,<?php //echo nbs(1);?>Ex.<?php echo $abc['designation'];?></b><?php //echo $pensioner->name; ?> <?php //echo $pensioner->designation; ?></b>, a sum of <b>Rs.<?php if($abc['enhanrate_from']=="0000-00-00"){?><?php echo getOrdinaryRateReautho();?> <?php }else{?><?php echo $pensioner->getEnhanceRateReautho();?><?php }?><?php //echo $pensioner->getAmountOfPenion(); ?>/-</b> only (less income-tax), being the amount of FAMILY PENSION <b><?php //echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
					The payment should commence from <b><?php if($abc['ordrate_from']=="0000-00-00"){echo $abc['enhanrate_from'];}else{?><?php echo $abc['ordrate_from'];?><?php }?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
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
					a) Provisional Pension <?php if($pensioner->provisional_pension=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->provisional_pension.''."/-" ;?><?php }?><br/>
					c) Excess pay and Allowances <?php if($pensioner->excess_pay_and_allowances=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->excess_pay_and_allowances.''."/-" ;?><?php }?>
				</td>
				<td style="vertical-align: top;" colspan="2">
					b) Excess Provisional RG/DCR NIL <?php if($pensioner->provisional_gratuity=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->provisional_gratuity.''."/-" ;?><?php }?><br/>
					d) If any <?php if($pensioner->others=="0"){?><?php echo "Rs. Not Paid/-" ?><?php }else{?><?php echo "Rs.".''.$pensioner->others.''."/-" ;?><?php }?>
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