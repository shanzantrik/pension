<?php $pensioner = $values; ?>

<?php
	$ppo_no = $pensioner->case_no."/".$pensioner->ppo_no;
	$gpo_no = 'Pen/AP/GPO/'.$pensioner->gpo_no;
	$cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;
	$ac = ($pensioner->treasury_officer!='') ? str_replace(", ", ",<br />", $pensioner->treasury_name): str_replace(", ", ",<br />", $pensioner->accountant_general_name) ;
?>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="ppo1" selected>PPO Report 1</option>
	<option value="ppo2">PPO Report 2</option>
	<option value="ppo3">PPO Report 3</option>
	<option value="ppo4">PPO Report 4</option>
	<option value="ppo5">PPO Report 5</option>
</select>

<div id="ppo1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="ppoprint1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table id="report" border="0" cellpadding="3" width="100%">
				<tbody>
					<tr><td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial;">FORM CAM-52<br>(Para 7.3.2)<br><br>PENSION PAYMENT ORDER<br>(PENSIONER'S PORTION)</div>
						    </div>
						</td>
					</tr>
				 	<tr>
						<td style="vertical-align: top; padding: 7px;">P.P.O. No.</td>
						<td colspan="2" style="vertical-align: top; padding: 7px;">
							<b><?php echo $ppo_no; ?></b>
						</td>
						<td></td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">
							Debitable to Union Government
						</td>
						<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">Date <u><?php echo nbs(5); ?><?php echo date('d-m-Y'); ?><?php echo nbs(5); ?></u></td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4">
							<?php echo nbs(28); ?><u>Head of Account</u>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head</td>		
						<td style="vertical-align: top; padding: 7px;" colspan="2">2071 Pension &amp; ORB </td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head<br /><?php echo nbs(30); ?>Voted/Charged</td>
						<td style="vertical-align: top; padding: 7px;" colspan="2">04 Ordinary Pension (AIS)</td>
					</tr>
				 	<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4" align="left">Sir,</td>
					</tr>
				  	<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">
							<?php echo nbs(30); ?>UNTIL FURTHER NOTICE, and on the expiration of every month be pleased to pay <b><?php echo $pensioner->salutation." ".$pensioner->name." Rtd. ".$pensioner->designation; ?></b> the pension as set out in Part II of this order/Family pension as set out in Para-III of this order* plus the amount of dearness relief as admissible from time to time thereon after due identification of the prisioner/family pension. The payment should commence from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b>. The Income tax, where deductible, should be deducted at source.
						</td>
					</tr>
				 	<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">2.<?php echo nbs(27); ?>Arrears of pension/family pension at <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- (Rupees)</b> only per month from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b> plus the admissible dearness relief thereon may also be paid to <b><?php echo $pensioner->salutation." ".$pensioner->name." Rtd. ".$pensioner->designation; ?></b></td>
					</tr>
					<tr>
						<td colspan="4">
							<div style="border: 1px solid #000; margin-top: 20px;"></div>
						</td>
					</tr>
			        <tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">[*Inapplicable clause to be deleted]</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
						<td style="vertical-align: top; padding: 55px 0 10px 0; text-align:center">Signature<br />Designation</td>
					</tr>
					<tr>
						<td colspan="4" style="vertical-align: top; padding: 7px; text-align:center">(Special Seal Of the Pension Payment Order Issuing Authority)</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="4"> To,</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="2">
							(1) <b>The Pay &amp; Accounts Officer,</b>
						</td>
						<td style="vertical-align: top; padding: 7px; text-align: center;" colspan="2"><b>Central Pension Accounting Office<br />Trikoot - II Bhikaji Cama Place<br />New Delhi - 110006</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 7px;" colspan="2">(2) Name of Paying Branch</td>
						<td style="vertical-align: top; padding: 7px;" colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td colspan="2" style="vertical-align: top; padding: 7px; text-align: center;">( Acount No.................... )</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="ppo2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="ppoprint2" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td style="vertical-align: top; padding-bottom: 20px;" colspan="2">
						<div>
							Part 1 :- Particulars of service of the pensioner/deceased Government Servant* <br />
							<p style="margin: 0px;text-align: right;">(*strike out whichever is not admissible)</p>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						1.	Name of the Government Servant. <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						2.	Post/Grade/Rank last held. <b>Retd. <?php echo $pensioner->designation;?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						3.	Name of the Ministry/Deptt./Office from which he/she retired under the Govt. of India.
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						<b><?php echo str_replace(",", ",<br />", $pensioner->office_address); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						4.	Scale of Pay/Pay Band & Grade Pay at the time of retirement (Mandatory) <b>Rs. <?php echo array_sum($pensioner->lp); ?>/-</b>
					</td>
				</tr>
				<tr>
					<td style="padding: 7px;">4(a)	Pay last drawn :- </td>
					<td style="padding: 7px;"><b>Rs. <?php echo array_sum($pensioner->lp); ?>/-</b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">5. Date of Birth :-</td>
					<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">6. Date of entry into Governement service :-</td>
					<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">7. Date of ending service (Last day of Service) :-</td>
					<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">8. Details of weight age in service allowed, if any :-</td>
					<td style="padding: 7px;"><b>NIL</b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">9. Period of service not qualifying for pension :-</td>
					<td style="padding: 7px;"><b>NIL</b></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 20px 0 30px 0;">
						<table width="100%" border="1">
							<tr>
								<th>From</th>
								<th>To</th>
								<th colspan="3">Period</th>
								<th>Reasons</th>
							</tr>
							<tr>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center">Y</td>
								<td align="center">M</td>
								<td align="center">D</td>
								<td align="center"></td>
							</tr>
							<tr>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding: 7px;">10. Total length of qualifying service<br /><?php echo nbs(7); ?>[Col.(7-6)+8+9]</td>
					<td valign="top" style="padding: 7px;">
						<?php $lists = explode(" ", $pensioner->total_service); ?>
						<ul style="list-style: none;">
							<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Years</b><br/><?php echo $lists[0]; ?></li>
							<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Months</b><br/><?php echo $lists[2]; ?></li>
							<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Days</b><br/><?php echo $lists[4]; ?></li>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						11.	EMOLUMENTS DRWAN DURING 10 MONTHS PERIOD AND THOSE RECKONED FOR CALCULATION OF EVERAGE EMOLUMENTS.
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px 0;">
						<table width="100%" cellpadding="3" cellspacing="3" border="1">
							<tr>
								<td>From</td>
								<td>To</td>
								<td colspan="3">Emoluments drawn</td>
								<td colspan="3">Emoluments reckoned for Average emoluments</td>
								<td>Remarks</td>
							</tr>
							<tr>
								<td width="11%" valign="top"></td>
								<td width="11%" valign="top"></td>
								<td width="11%" valign="top">Pay & Grade Pay</td>
								<td width="11%" valign="top">Other Items with details viz. personal pay Spl. Pay. Deputation Allowance DA etc.</td>
								<td width="11%" valign="top">Total</td>
								<td width="11%" valign="top">Pay & Grade Pay</td>
								<td width="11%" valign="top">Other items reckoned with details</td>
								<td width="11%" valign="top">Total</td>
								<td width="11%" valign="top"></td>
							</tr>
							<tr>
								<td align="center">1</td>
								<td align="center">2</td>
								<td align="center">3</td>
								<td align="center">4</td>
								<td align="center">5</td>
								<td align="center">6</td>
								<td align="center">7</td>
								<td align="center">8</td>
								<td align="center">9</td>
							</tr>
							<tr>
								<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
								<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
								<td align="center"><b><?php echo $pensioner->getLastPay(false); ?>/- (Apex Pay)</b></td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/- (Apex Pay)</b></td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 60px 0;">12. Average Emoluments <b>Rs. <?php echo $pensioner->getAverageEmolument(); ?></b></td>
				</tr>
			 	
			</table>
		</div>
	</div>
</div>

<div id="ppo3" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint3')"><i class="icon-white icon-print"></i>Print</button>
	<div id="ppoprint3" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td valign="top" width="70%" style="padding: 7px;">13. Emoluments for family pension</td>
					<td valign="top" width="30%"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 7px;">14. Emoluments for Retirement Gratuity/Death Gratuity</td>
					<td valign="top"><b>Rs. 80000/-</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 7px;">15. Amount of Retirement Gratuity/Death Gratuity allowed</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 7px;">16. Grant of Medical allowance to be paid by Bank</td>
					<td valign="top"><b>Rs. 300/- p.m</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 7px;">17. Constable Attendant allowance<br /><?php echo nbs(7); ?>(No Dearness Relief is payable on Sl. NO. 6 & 17)</td>
					<td valign="top"><b>Rs.</b></td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding: 7px;">
						<b>Part - II<br />(Applicable on Pensioner)</b>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;"><b><u>Section 1 - Particulars of Pensioner</u></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">1. Joint photograph with the spouse</td>
					<td rowspan="3" align="right">
						<div style="width: 135px; height: 125px; border: 1px solid #bababa;">
							&nbsp;
						</div>
					</td>
				</tr>
				<tr>
					<td style="padding: 7px;">2. Name of the retiring Govt. Servant :- <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", ".$pensioner->designation; ?></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">
						3.	Permanent Address :-<br />
							<b><?php echo nbs(5).str_replace(",", ",<br/>".nbs(4), $pensioner->address_after_retirement); ?></b>							
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">4. Personal Marks of identification :- <b>Enclosed</b></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">5. Signature or the left hand Thumb impression of the pensioner (To be otained at the time of first payment of pension) :- <b>Enclosed</b></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;"><b><u>Section 2 - Details of pension.</u></b></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 7px;">
						<table width="100%" cellspacing="3" cellpadding="3" border="1">
							<tr>
								<td width="8%" align="center" valign="top">Sl. No.</td>
								<td width="30%" align="center" valign="top"></td>
								<td width="20%" align="center" valign="top">Original pension</td>
								<td width="20%" align="center" valign="top">Revised pension<br />(1)</td>
								<td width="22%" align="center" valign="top">Revised pension<br />(2)</td>
							</tr>
							<tr>
								<td valign="top">1</td>
								<td valign="top">Amount of monthly Pension before commutation</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-</b></td>
								<td valign="top"></td>
								<td valign="top"></td>
							</tr>
							<tr>
								<td valign="top">2</td>
								<td valign="top">Class of Pension</td>
								<td colspan="3" align="center" valign="top"><b><?php echo str_replace("_", " ", $pensioner->class_of_pension); ?></b></td>
							</tr>
							<tr>
								<td valign="top">3</td>
								<td valign="top">Rules under which sanctioned</td>
								<td valign="top" colspan="3"><b>Rule 35 of CCS (P) Rule 1972</b></td>
							</tr>
							<tr>
								<td valign="top">4</td>
								<td valign="top">Date of commencement of pension</td>
								<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
								<td valign="top"></td>
								<td valign="top"></td>
							</tr>
							<tr>
								<td valign="top">5</td>
								<td valign="top">Fraction/amount of pension commuted, if any</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue(); ?></b></td>
								<td valign="top"></td>
								<td valign="top"></td>
							</tr>
							<tr>
								<td valign="top">6</td>
								<td valign="top">Commuted value and the date of its payment</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getCommutationofPension(); ?></b></td>
								<td valign="top">(Not yet paid)</td>
								<td valign="top"></td>
							</tr>
							<tr>
								<td valign="top">7</td>
								<td valign="top">Reduced monthly pension after commutation</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
								<td valign="top"></td>
								<td valign="top"></td>
							</tr>
							<tr>
								<td valign="top">8</td>
								<td valign="top">Date of commencement of reduced pension</td>
								<td valign="top" colspan="3"><b>From the date of payment of commuted value</b></td>
							</tr>
							<tr>
								<td valign="top">9</td>
								<td valign="top">Date (in words) from which commuted portion shall stand restored (subject to pensioner being alive on that date)</td>
								<td valign="top" colspan="3"><b>On completion of 15 years from the date of payment of commuted value</b></td>
							</tr>
							<tr>
								<td valign="top">10</td>
								<td valign="top">Whether the pensioner/family pensioner is in receipt of any ither pernsion. If so, its particulars and source from which being drawn.</td>
								<td valign="top" colspan="3"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 20px 0 0 0;">
						<b>
							Note :- Recoveries :- 1. Provisional Gratuity of Rs. <?php echo $pensioner->provisional_gratuity; ?>/- has been paid<br />
							<?php echo nbs(40); ?>2. Commutation of pension not paid<br />
							<?php echo nbs(40); ?>3. No Provisional Pension paid
						</b>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="ppo4" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint4')"><i class="icon-white icon-print"></i>Print</button>
	<div id="ppoprint4" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table width="100%" cellpadding="3" border="0">
				<tr>
					<td colspan="2" style="padding: 20px 0;"><b><u>Section 3 - Details of family pension payable on the death of the pensioner.</u></b></td>
				</tr>
				<tr>
					<td style="padding: 7px;">1. Rules under which family pension is admissable Rule 54 of CCS (P) Rule 1972.</td>
				</tr>
				<tr>
					<td style="padding: 7px;">2. Details of family members eligible for family pension in the event of the death of pensioner.</td>
				</tr>
				<tr>
					<td style="padding: 30px 0;">
						<table width="100%" cellspacing="3" cellpadding="3" border="1">
							<tr>
								<td width="8%" valign="top">Sl. No.</td>
								<td width="20%" valign="top">Name</td>
								<td width="11%" valign="top">Marital status in case of children @</td>
								<td width="11%" valign="top">Relationship with the Govt. Servant</td>
								<td width="15%" valign="top">Date of Birth (of all)</td>
								<td width="20%" valign="top">Present address</td>
								<td width="15%" valign="top">Whether child is physically handicapped/mentally retarded</td>
							</tr>
							<tr>
								<td valign="top"><b>1.<br />2.</b></td>
								<td valign="top"><b><?php echo $pensioner->getNameOfLegalHeir(); ?></b></td>
								<td valign="top"><b></b></td>
								<td valign="top"><b>Wife</b></td>
								<td valign="top"><b><?php echo $pensioner->getDOBofSpouse(); ?></b></td>
								<td valign="top"><b><?php echo str_replace(",", ",<br />", $pensioner->address_after_retirement); ?></b></td>
								<td valign="top"><b></b></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding: 7px;"><b>Note:-</b>Above particulars may be given in the order of eligibility of the family members @ whether married/unmarried/widow/widower/divorcee.</td>
				</tr>
				<tr>
					<td style="padding: 20px 0;">3. Amount of family pension (Payable in the event of death of the pensioner).</td>
				</tr>
				<tr>
					<td style="padding: 7px;">
						<table width="100%" cellspacing="3" cellpadding="3" border="1">
							<tr>
								<td width="25%" valign="top"></td>
								<td width="25%" valign="top">Amount Rs.</td>
								<td width="25%" valign="top">From</td>
								<td width="25%" valign="top">To</td>
							</tr>
							<tr>
								<td valign="top">(i) At Enhanced Rate</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate(false); ?>/-</b></td>
								<td valign="top">The day following the date of the death of the pesioner</td>
								<td valign="top">Till the age of 67 years of the Govt. Servant/7 years had he been survived whichever is earlier.</td>
							</tr>
							<tr>
								<td valign="top">(ii) At Ordinary Rate</td>
								<td valign="top"><b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/-</b></td>
								<td valign="top"></td>
								<td valign="top"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>


<div id="ppo5" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint5')"><i class="icon-white icon-print"></i>Print</button>
	<div id="ppoprint5" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table id="report" border="0" cellpadding="3" width="100%">
				<tbody>
					<tr>
						<td style="vertical-align: top; padding: 50px 0 30px 0;" colspan="4">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial; font-weight: bold; font-size: 18px;">IMORTANT INSTRUCTIONS<br>(To Appear on inside cover of the PPO booklet)</div>
						    </div>
						</td>
					</tr>
				  	<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
							1.	 No pension shall be liable to seizure,attachment of sequestration by process of any court in india in the instance of creditor for any demand against the pensioner(section II,ACT XXIII of 1871)
						</td>
					</tr>
				  	<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
							2.	Payment under this order is to be made only pensioner in person,with the following exceptions.
						</td>
					</tr>
				  	<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
							a. To persons specially exempted by Government.
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">b. To females unaccustomed to appear in public and to persons unable to appear on account of  illness or bodily infirmity.(payment in both cased (a) and (b) is made on production of life certified signed by a responsible Officer of govt. or other known and trustworthy persion).</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">c. To any person sending a Lifr Certificate signed by  some person excercising the powers of a Magistrate under the Criminal procedure code or by any Registrar of  or Sub-Registrar appointed under the indian registration act,1908 or by any pensioned officer who,before retriment exercised the powers of Magistrate or any Gazetted officer,or by a Munsiff or by a police officer  not below the rank of sub-inspector in charge of a ploice station or by Post Master,a Departmental Sub-Post  master or an inspector of post officers,or by officer of the reserve bank of india and public sector bank or by head of village panchayat,gaon panchyat or gram panchyat or by the  head of an executive committee of a village or by a bank included in the second schedule to the reserve bank of india act 1934,in respect of person  drawing pension through that bank</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">d. In all cased referred to in clauses (a),(b) & (c) the Disbursing officer must at least once a year require proof independent of that furnished by the life certificate of the continued existence of the pensioner.The pensioner shall not be paid on account of period more  than a year after the date of life certificate last received and the disbursing officer must be on the watch for authentic information  of the decease of any such pensioner and on receipt thereof,shall promptly stop further payments.</td>
					</tr>
					<tr>
						<td style="vertical-align: top; padding: 10px 0 40px 0; text-align: justify;" colspan="4" align="left">3. The Quantum of pension available to the old pensioner/family pensioner will be as follows:</td>
					</tr>
					<tr>
						<td colspan="4">
							<table width="100%" border="1" cellpadding="3" cellspacing="3">
								<tr>
									<td>Age of pensioner/Family Pensioner</td>
									<td>Additional Quantam Of pensioner</td>
								</tr>
								<tr>
									<td>From 80 years to less than 85 years</td>
									<td>20% of revised basic pension/family pension</td>
								</tr>
								<tr>
									<td>From 85 years to less than 90 years</td>
									<td>30% of revised basic pension/family pension</td>
								</tr>
								<tr>
									<td>From 90 years to less than 95 years</td>
									<td>40% of revised basic pension/family pension</td>
								</tr>
								<tr>
									<td>From 95 years to less than 100 years</td>
									<td>50% of revised basic pension/family pension</td>
								</tr>
								<tr>
									<td>100 years or more</td>
									<td>100% of revised basic pension/family pension</td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hideAll();
				$('#'+val).show();
			}
		});
	});

	function hideAll() {
		$('#form1, #ppo1, #ppo2, #ppo3, #ppo4, #ppo5, #form2, #form3, #form4, #disburser_disburser_portion, #disburser_pensioner_portion').hide();
	}
</script>