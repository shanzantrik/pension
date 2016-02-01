<?php $pensioner = $values;

$class_of_pension=$pensioner->class_of_pension;
if($class_of_pension=="Voluntary_Retirement_Pension"){
	$class_of_pension="Retiring_Pension";
}

$pensionername=explode(".",$pensioner->name);
if($pensionername[0]=="Dr"){$name= $pensioner->name;}else{$name=$pensioner->salutation." ".$pensioner->name;}
?>

<?php
	$apex_designation = ['The Principal Chief Conservator of Forests & Secretary (Enr & Forest)', 'The Principal Chief Conservator of Forest', 'Chief Residence Commissioner', 'The Principal Chief Conservator of Forests (WL & BD), C.W.L.W', 'The Addl. Chief Conservator of Forests', 'The Chief Conservator of Forest', 'The Conservator of Forest'];
	$ppo_no = $pensioner->case_no."/".$pensioner->ppo_no;
	$gpo_no = 'Pen/AP/GPO/'.$pensioner->gpo_no;
	$cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;

    $ac = ($pensioner->treasury_officer!='') ? nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->treasury_name): nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->accountant_general_name);

    if($pensioner->dod > $pensioner->dor || $pensioner->dod == '0000-00-00') :
		$enhance_rate_period = '7';
	elseif($pensioner->dod == $pensioner->dor) :
		$enhance_rate_period = '10';
	endif;

	$account_no = ($pensioner->account_no != '') ? ', ('.$pensioner->account_no.')' : '';
	$bank_name	= ($pensioner->bank_name != '') ? ', '.$pensioner->bank_name : '';
	$payable = $pensioner->treasury_name.', '.$bank_name.' '.$account_no;
?>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1" selected>Report 1 (Forwading Letter)</option>
	<option value="form2">GPO</option>
	<?php if($pensioner->com_applied == 1) : ?>
		<option value="form3">CPO</option>
	<?php endif; ?>
	<option value="form4">Audit Enfacement</option>
   
    <option value="disburser_disburser_portion">Disburser Portion</option>
	<option value="disburser_pensioner_portion">Pensioner Portion</option>
</select>

<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-family: initial; margin-left: 200px;">GOVERNMENT OF ARUNACHAL PRADESH<br/>DIRECTORATE OF AUDIT & PENSION<br/><u>NAHARLAGUN</u>.</div>
					    </div>
					</td>
					<td></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						No. <?php echo $pensioner->case_no; ?><br/>To<br/><b><?php echo $ac; ?></b>
					</td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top; text-align: justify;" colspan="4" align="left"><?php echo nbs(13); ?>The pension payment orders/GPO/CPO whose details are given below in favour of &nbsp;<b><?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b>&nbsp;are forwarded herewith for payment from your end.</td>
				</tr>	
			 	<tr>
					<td style="vertical-align: top;" colspan="4">
						<pre style="padding: 0px;margin: 10px 0 0 0;font-family: 'Ubuntu', Tahoma, sans-serif; font-size: 1.0em; line-height: 1.5em;background-color: #fff!important;border: none;-webkit-border-radius: none;-moz-border-radius: none;border-radius: none;">
		1. Pension Payment Order No.				:- <b><?php echo $ppo_no; ?></b>
		2. Category of Pension 						:- <span><?php echo str_replace("_", " ", $class_of_pension); ?></span>
		3. (a) Adhoc/Temporary increase
		    (b) Amount of basic pension 				:- <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?></b>
		    (c) Relief on pension 						:- As per PPO
		    (d) Family Pension in case of death of the Pensioner 	:- <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?></b>
			  i) Enhanced rate 						:- <b>Rs. <?php echo $pensioner->getEnhanceRate(); ?></b>
						</pre>
					</td>
				</tr>
				<tr>
				<td style="vertical-align: top;" colspan="4" style="text-align:left;"><?php echo nbs(11); ?>For a period of <?php echo $enhance_rate_period; ?> years or upto the date on which the deceased would have attained the age of <?php echo $pensioner->pension_attained_age; ?> years had <?php echo $pensioner->pensioner_pronoun; ?> survived whichever is less.	
				</td>
				</tr>
				<tr>	
					<td style="vertical-align: top;" colspan="4" style="text-align:left;"><?php echo nbs(11); ?>ii) Ordinary rate :- <b>Rs.<?php echo $pensioner->getOrdinaryRate(); ?> /- PM<?php echo $pensioner->getDRMA(); ?></b> (Until his/her remarriage or death)</td>
					<!-- <td style="vertical-align: top;" colspan="2" style="text-align:right;">(for remaining period)</td> -->
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><?php echo nbs(5); ?>e) Family pension (in case of death of the Govt. employee)<br/><?php echo nbs(11); ?>i) &nbsp;Enhance rate for a period of <?php echo no_to_words($enhance_rate_period); ?> years<br/><?php echo nbs(11); ?>ii)	Normal rate(on completion of <?php if($pensioner->class_of_pension=="Voluntary_Retirement_Pension" || $pensioner->class_of_pension=="Superannuation_Pension" || $pensioner->class_of_pension=="Invalid_Retirement_Pension" || $pensioner->class_of_pension=="Absorption_in_autonomous_body_pension" || $pensioner->class_of_pension=="Compulsory_Retirement_Pension" || $pensioner->class_of_pension=="Disability_Pension"){echo "seven";}else{echo "ten";}?> years)<br/><br /><?php echo nbs(14); ?>Date of commencement of pension :- <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					4. No. <?php echo $gpo_no; ?> and amount of Retirement/Death gratuity :- <b>Rs. <?php echo $pensioner->getDCRG(); ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					5. No.<?php echo $cpo_no; ?> and amount of <b>Rs. <?php  echo $pensioner->getCommutationOfPension(); ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					6. Name of Treasury/Bank where payable 	:- <b><?php echo $payable; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					7. Provisional pension :- <b>Rs. <?php echo $pensioner->provisional_pension; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					8. Provisional Retirement/Death Gratuity :- <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					9. Conditions attached to pension payment may be made subject to the conditions specified in the PPO as well as the C.C.S. Pension Rules and Treasury Rules.
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Enclo :-
					<ol>
						<li>
							PPO (Pensioner's and Disburser's Portion)
						</li>
						<li>
							GPO
						</li>
						<li>
							CPO
						</li>
						<li>
							Specimen signature slips
						</li>
						<li>
							Photograph
						</li>
						
					</ol>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top; text-align:center;">Yours faithfully,</td>
					<td></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td><div style="margin-top: 85px; text-align:center">Director/Joint Director</div></td>
					<td></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">Memo No - <?php echo $pensioner->case_no; ?></td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						<?php $pin = ($pensioner->pin != '') ? '<br />'.nbs(5).'PIN Code - '.$pensioner->pin : ''; ?>
						Copy forwarded to:- <br />
						1) <b><?php echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?></b><br /><br />
						2) <b><?php echo str_replace(",", ",<br />".nbs(4), $pensioner->office_address); ?></b><br />
						3) The Accountant General (A&E) Arunachal Pradesh, Itanagar.
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top; padding-top: 65px; text-align:center">Director/Joint Director</td>
					<td style="vertical-align: top;"></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
			<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
		        <div style="font-weight: bold; text-align: center; line-height: 1.4em;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	     		<tr>
					<td colspan="3"><div align="left">No - <strong><?php echo $gpo_no; ?></strong></div></td>
		    		<td><div><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td  colspan="4"><div align="left">To</div></td>
				</tr>
				<tr>
					<?php if(!in_array($pensioner->designation, $apex_designation)) : ?>
						<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
					<?php else : ?>
	                    <?php $a=str_replace(",", ",<br />", $pensioner->office_address);?>
	                    <td colspan="4" style="line-height: 1.5em"><b><?php echo $a; ?></b></td>
					<?php endif;?>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?> I am to request that you will be so good as to arrange for payment from the Treasury <b><?php echo $pensioner->sub_to; ?></b> a sum of <b>Rs.<?php echo $pensioner->getDCRG(); ?>/- (Rupees <?php echo no_to_words($pensioner->getDCRG());?>)</b> only in lump-sum to <b><?php echo strtoupper($name).", Rtd.".$pensioner->designation; ?></b> being the amount of retirement/death gratuity sanctioned to him/her in letter no. <b><?php echo $gpo_no; ?></b> from the Director of Audit & Pension, debitable to 2071 Pension & ORB etc.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">2.<?php echo nbs(4); ?>The particulars regarding his/her identification are/were enclosed along with PPO No. <b><?php echo $ppo_no; ?></b>. </div></td>
				</tr>
				<tr>
					<td colspan="4"><b>Below Rs. <?php echo $pensioner->getDCRG()+1; ?>/- (Rupees <?php echo no_to_words($pensioner->getDCRG()+1);?>).</b></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">N.B: The date of payment may please be intimated to this office as soon as the gratuity is debitable to local fund is paid.</b></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">3. The acquittance of gratuitant unless he/she is exempted by rule of special order of Government from personal appearance should be taken on the reverse of this order with necessary Revenue stamp.</div></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">4. The gratuitant is being informed of the issue of this order.</div></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
			    <tr>
					<td colspan="4"><div align="left" style="text-align: justify;">5. The gratuitant should be directed to appear before the Treasury/Sub-Treasury to receive payment of gratuity amount.</div></td>
				</tr>
			   <tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">6. The expenditure is debitable to Head of Account <?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi.";}?></div></td>
				</tr>
			   	<tr>
					<td colspan="4" style="padding-top: 10px;"><b>RECOVERIES:-</b></td>
				</tr>
				<?php //$diff=$pensioner->getDCRG()-$pensioner->provisional_gratuity;?>
				<!-- <tr>
					<?php if(!in_array($pensioner->designation, $apex_designation)) : ?>
						<td colspan="2"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity; ?> (Rupees <?php echo trim(no_to_words($pensioner->provisional_gratuity));?>)</b></div></td>
					<?php else : ?>
						<td colspan="2"><div align="left">Note:- Provisional Gratuity: <b>Rs. <?php echo $pensioner->provisional_gratuity; ?>/-(Rupees <?php echo trim(no_to_words($pensioner->provisional_gratuity));?>)</b><?php if($pensioner->provisional_gratuity=="0"){ echo "";}else{echo "only has already been paid against<br/> authorized sanctioned gratuity for an amount of <b>Rs.".$pensioner->getDCRG()."/-.</b>Hence the differential amount<br/> of <b>Rs. ".$diff."/-.</b> may be authorized from your end.";}?></div></td>
                    <?php endif;?>
					<td style="text-align: center;">Yours faithfully,</td>
					<td></td>
				</tr> -->
				<tr>
					<td colspan="2"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b></div></td>
					<td style="text-align: center;">Yours faithfully,</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">
						<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
							<div align="left">Excess Gratuity Paid : <?php echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); ?> - which<br />may be recovered from the arrear pension.</div>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
						<td style="padding-top: 28px;text-align: center;">Director/Joint Director</td>
					<?php else : ?>
						<td style="padding-top: 85px;text-align: center;">Director/Joint Director</td>
					<?php endif; ?>
					<td></td>
				</tr>
				<tr>
					<td colspan="3"><div align="left">Memo No- <b><?php echo $gpo_no; ?></b></div></td>
					<td><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td colspan="4">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;">i. <b><?php echo strtoupper($name); ?></b>, Arunachal Pradesh Government pensioner. He/She should appear before the Treasury Officer /Sub Treasury Officer/Bank, <b><?php echo $pensioner->sub_to; ?></b>, to receive payment. If however his/her wished to be exempted from appearing in person to receive his/her pension through an Authorised Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the later case, the Pension Payment order will be sent to his/her through Agent.</div></td>
			    </tr>
			   	<tr>
					<td colspan="4" width="25%"><div style="float: left;">ii.</div><div style="float: left;margin-left: 5px;"><b><?php echo $pensioner->office_address; ?></b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">iii.</div><div style="float: left;margin-left: 5px;"><b>The Accountant General (A&E), Arunachal Pradesh, Itanagar.</b></div></td>
				</tr>
				<?php if(in_array($pensioner->designation, $apex_designation)) : ?>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">iv.</div><div style="float: left;margin-left: 5px;"><b>Treasury Officer, Itanagar, for information<br/>with a request to entertained the gratuity payment bill on<br/> production from PCCF, AP,Itanagar.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">NB:-</div><div style="float: left;margin-left: 5px;">Kindly arrange to pay the differential amount of <b>Rs.<?php echo $diff;?>/-</b><br/>being retirement gratuity to <b><?php echo strtoupper($name);?> </b>payable<br/> on <?php echo $pensioner->bank_name;?>in his SBI A/C <?php echo $pensioner->account_no;?>.</div></td>
				</tr>
			<?php endif;?>
			    <tr>
			    	<td colspan="2"></td>
					<td style="padding-top: 65px;text-align: center;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div id="form3" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print3')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print3" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
			<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px;">
	        	<div style="font-weight: bold; text-align: center; line-height: 1.4em;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
	    	</div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	 			<tr>
					<td colspan="3">No. - <strong><?php echo $cpo_no; ?></strong></td>
	    			<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">To</div></td>
				</tr>
	 			<tr>
					<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>I am to request you to make necessary arrangement for payment of <b>Rs.<?php echo $pensioner->getCommutationOfPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutationOfPension());?>)</b> being the commuted value of <b>Rs. <?php echo $pensioner->getCommutedValue(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutedValue());?>)</b> out of pension of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>)</b> per month granted to <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b>, holder of PPO No: - <b><?php echo $ppo_no; ?>.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>Consequent on commutation, the reduced rate of pension in respect of <b><?php echo strtoupper($name); ?></b>, <b><?php echo $pensioner->designation; ?></b> should be <b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/- (Rupees <?php echo no_to_words($pensioner->getOrdinaryRate());?>)</b> per month. The reduction in the amount of pension shall become operative from the date of receipt of the commuted value of pension by <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b> or three months after the issue of authority by you asking him/her to collect the commuted value of pension whichever is earlier. Necessary instructions regarding the date from which the pension is to be reduced may also kindly be issued to the Treasury Officer <b><?php echo $pensioner->sub_to; ?></b>. from which the pensioner is drawing the pension</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The expenditure is debitable to Government of Arunachal Pradesh under the Head of Account <?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi";}?></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The receipt of authority may please be acknowledged.</div></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 20px 0 25px 0;"><b>RECOVERY</b>: - Over payment, if any,<br/> due to non-payment of reduced pension<br/> of Rs.__________ per month should be<br/> adjusted at the time of payment.</td>
					<td><div style="text-align: center;">Yours faithfully,</div></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: center;">Director/Joint Director</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 0;"><div align="left">Memo No- <b><?php echo $cpo_no; ?></b></div></td>
					<td style="padding: 10px 0;">Date-<b><?php echo date('d.m.Y'); ?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;"><div align="left">i.<b><?php echo strtoupper($name).", Retd. ".$pensioner->designation;?></b></div></td>
			    </tr>
			   	<tr>
					<td colspan="4" style="padding: 5px 0;">ii. <b><?php echo $pensioner->office_address; ?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">iii.The Accountant General (A&E), Arunachal Pradesh, Itanagar.</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div id="form4" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print4')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print4" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br /><br />
			<div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	        	<div style="font-weight: bold; text-align: center; line-height: 1.4em; margin-bottom: 30px;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
	    	</div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">Audit Enfacement No-<strong><?php echo $pensioner->case_no; ?></strong></div></td>
	    			<td colspan="2" valign="top" style="padding: 10px 0;"><div align="right"><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">Name and designation of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo strtoupper($name).", Retd. ".$pensioner->designation; ?></b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">1. Total period of qualifying service which has been accepted for Pension /gratuity, with reasons for disallowance if any.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b><?php echo $pensioner->net_qualifying_service(); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<div align="left"> 2. Amount of Superannuation/Retiring /Invalid and Compensation Pension , Terminal/Death/Retirement gratuity has been admitted And the date from which pension is admissible.</div>
					</td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>PENSION RS. <?php echo $pensioner->getAmountofPension(); ?>/-</b></br>
		                <b>GRATUTIY RS. <?php echo $pensioner->getDCRG(); ?>/-</b></br>
		                <b>COMMUTATION RS. <?php echo $pensioner->getCommutationOfPension(); ?>/-</b></br>
	    			</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">3. FAMILY PENSION </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"><b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></div></td>
				</tr>
		      	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (a) Amount admitted and the period of payment</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>Rs.<?php echo $pensioner->getEnhanceRate(); ?>/- (Enhanced Rate)</b></br><b>Rs.<?php echo $pensioner->getOrdinaryRate(); ?>/- (Ordinary Rate)</b></td>
				</tr>
			 	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (b) To whom admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (c) D.R admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 0;"><b>As per order from time to time</b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 4. Heads of Accounts to which the pension / gratuity is <?php echo nbs(5); ?>chargeable</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php if(!in_array($pensioner->designation, $apex_designation)) {echo "2071 Pension & ORB(Arunachal Pradesh)"; }else{ echo  "8658-101 suspense account adjustable by the CPAO, New Delhi";}?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 5. Amount to be recovered</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>_______________________________</b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 6. Anticipatory provisional pension and Anticipatory-Death /Retirements gratuity, already paid to be adjusted out of the final payments.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<?php echo $pensioner->getAllGratuityStatus(); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 7.	P.P.O/G.P.O/C.P.O. issued in favour of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>1) PPO No. <?php echo $pensioner->ppo_no; ?></b></br>
					    <b>2) GPO No. <?php echo $pensioner->gpo_no; ?></b></br>
					    <b>3) CPO No. <?php echo $pensioner->cpo_no; ?></b></br>
					</td>
				</tr>
				<tr>
					<td colspan="4" valign="top" style="padding: 0 0 10px 0;"><div align="left">To</div></td>
				</tr>
				<tr>
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">1. <?php echo $pensioner->office_address; ?></div></td>
				</tr>
	    		<tr>
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">2.The Accountant General (A& E), Arunachal Pradesh, Itanagar</div></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td valign="top" style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div id="form5" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print5')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print5" style="width: 1000px; margin: 0px auto;">
		<div id="print" style="width:1000px; min-height:600px; padding: 0 20px; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br /><br />
			<div style="font-size: 18px; font-weight: bold; text-align: center;">FORM 7 (Part-II)</div><br /><br />

			<table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
				<tr>
					<td valign="top" width="50%">1. Name of Government Servant</td>
					<td valign="top" width="2%">:-</td>
					<td valign="top" width="48%"><b><?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b></td>
				</tr>
				<tr>
					<td valign="top">2. Date of receipt of pension papers by the <br /><?php echo nbs(4); ?>Accounts Officer from Head of Office</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->cash_received); ?></b></td>
				</tr>
				<tr>
					<td colspan="3">3. <u>Entitlements admitted</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(3); ?>A. Length of qualifying service</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->net_qualifying_service(); ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>B. Pension</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Class of pension</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Amount of monthly pension</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Date of Commencement</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>C. Commutation of pension</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Commuted value of portion of<br /><?php echo nbs(11); ?>pension commuted, if any</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Residuary pension after commutation</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Date from which reduced pension is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>From the date of payment of commuted value of pension</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iv) Date of restoration of commuted portion of<br /><?php echo nbs(13); ?>pension subject to the pensioner continuing to live</td>
					<td valign="top">:-</td>
					<td valign="top"><b>On completion of 15 years from the date of payment of commuted value of pension</b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>D. Retirement/ Death Gratuity</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Total amount payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Amount to be adjusted towards Government dues</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->provisional_gratuity; ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Amount to be withheld for adjustment of unassessed<br /><?php echo nbs(13); ?>dues</td>
					<td valign="top">:-</td>
					<td valign="top"></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iv) Excess Provisional Gratuity</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->excess_pay_and_allowances; ?></b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(v) Net amount to be released immediately</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG()-$pensioner->provisional_gratuity; ?>/-</b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>E. Family Pension</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) At enhanced rate</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Period for which Family Pension at enhanced rate<br /><?php echo nbs(12); ?>is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>For a period of 7/10 years</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) At normal rate</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(3); ?>4. Head of Account to which the amount of Pension<br /><?php echo nbs(8); ?>Retirement/DeathGratuity and Family Pension to<br /><?php echo nbs(8); ?>be debited.</td>
					<td valign="top">:-</td>
					<td valign="top"><b>2071 - Pension and ORB</b></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center"><div style="margin-top: 70px;">Accounts Officer</div></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php 
//print_r($apex_designation);
if(!in_array($pensioner->designation, $apex_designation)) : ?>

	<div id="disburser_disburser_portion" style="display: none;">
		<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print6')"><i class="icon-white icon-print"></i>Print</button>
		<div id="print6" style="width: 1000px; margin: 0px auto;">
			<div style="width:1000px; min-height:600px; padding: 0 10px; font-size: 0.9em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
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
						<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;">Name of Pensioner: </div>
							<div style="float: left;"><b><?php echo nbs(1).strtoupper($name); ?>, <br /><?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></b></div>
						</td>
						<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="2" cellpadding="2" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;">Class of Pension and date of commencement</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Date of Birth</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Religion and Nationality</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Residence showing village pargana</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Amount of monthly pension</td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="20%"><b><?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-<br/>PM<?php echo $pensioner->getDRMA(); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
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
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%">Pay Scale</td>
									<td width="3%">:</td>
									<td width="77%"><b><?php echo $pensioner->pay_scale; ?></b></td>
								</tr>
								<tr>
									<td width="20%">Designation</td>
									<td width="3%">:</td>
									<td width="77%"><b><?php echo $pensioner->designation; ?></b></td>
								</tr>
								<tr>
									<td width="20%">Last Pay</td>
									<td width="3%">:</td>
									<td width="77%"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b></td>
								</tr>
							</table>
						</td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">Sir,</td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?></b>, a sum of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?></b> only (less income-tax), being the amount of <b><?php echo strtoupper(str_replace("_", " ", $class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <b><?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
							<?php
								$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Retiring_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
								if(in_array($class_of_pension, $array)) {
									echo '<br/>2.In the event of the death of <b>'.strtoupper($name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b> from the day following the date of death of <b>'.strtoupper($name).'</b> for a period of 7 years, or for a period up to the date on which '.$pensioner->pensioner_pronoun.' would have attained the age of '.$pensioner->pension_attained_age.' years, had '.$pensioner->pensioner_pronoun.' survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br /><br />';
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
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2">
							a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />
							c) Excess Provisional RG/DG Rs. <?php echo ($pensioner->provisional_gratuity>$pensioner->getDCRG()) ? $pensioner->provisional_gratuity-$pensioner->getDCRG() : 'N/A'; ?><br />
							e) Others if any Rs. <?php echo $pensioner->others; ?>
						</td>
						<td style="vertical-align: top;" colspan="2">
							b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
							d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />
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
							<?php echo $pensioner->treasuryOfficer(); ?>
						</td>
						<td colspan="2" align="right">
							Designation_______________
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div id="disburser_pensioner_portion" style="display: none;">
		<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print7')"><i class="icon-white icon-print"></i>Print</button>
		<div id="print7" style="width: 1000px; margin: 0px auto;">
			<div style="width:1000px; min-height:600px; padding: 0 10px; font-size: 0.9em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
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
						<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;">Name of Pensioner: </div>
							<div style="float: left;"><b><?php echo nbs(1).strtoupper($name); ?>, <br /><?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></b></div>
						</td>
						<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="2" cellpadding="2" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;">Class of Pension and date of commencement</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Date of Birth</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Religion and Nationality</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Residence showing village pargana</td>
									<td width="20%" style="vertical-align: top; text-align: center;">Amount of monthly pension</td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="20%"><b><?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></b></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-<br/>PM<?php echo $pensioner->getDRMA(); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
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
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%">Pay Scale</td>
									<td width="3%">:</td>
									<td width="77%"><b><?php echo $pensioner->pay_scale; ?></b></td>
								</tr>
								<tr>
									<td width="20%">Designation</td>
									<td width="3%">:</td>
									<td width="77%"><b><?php echo $pensioner->designation; ?></b></td>
								</tr>
								<tr>
									<td width="20%">Last Pay</td>
									<td width="3%">:</td>
									<td width="77%"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b></td>
								</tr>
							</table>
						</td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 10px;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">Sir,</td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?></b>, a sum of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?></b> only (less income-tax), being the amount of <b><?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?></b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <b><?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?><?php //echo $pensioner->effect_of_pension; ?></b>.<br/>&nbsp;
							<?php
								$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
								if(in_array($pensioner->class_of_pension, $array)) {
									echo '<br/>2.In the event of the death of <b>'.strtoupper($name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>from the day following the date of death of <b>'.strtoupper($name).'</b> for a period of 7 years, or for a period up to the date on which '.$pensioner->pensioner_pronoun.' would have attained the age of '.$pensioner->pension_attained_age.' years, had '.$pensioner->pensioner_pronoun.' survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br /><br />';
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
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2">
							a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />
							c) Excess Provisional RG/DG Rs. <?php echo ($pensioner->provisional_gratuity>$pensioner->getDCRG()) ? $pensioner->provisional_gratuity-$pensioner->getDCRG() : 'N/A'; ?><br />
							e) Others if any Rs. <?php echo $pensioner->others; ?>
						</td>
						<td style="vertical-align: top;" colspan="2">
							b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
							d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />
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
							<?php echo $pensioner->treasuryOfficer(); ?>
						</td>
						<td colspan="2" align="right">
							Designation_______________
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

<?php else : ?>

	<!-- Report for apex pay scale for IFS, IAS, IPS Officer -->
	<div id="disburser_disburser_portion" style="display: none;">
		<select id="select-disburser-to-print">
			<option value="0">--Select--</option>
			<option value="disburser_ppo1" selected>PPO Report 1</option>
			<option value="disburser_ppo2">PPO Report 2</option>
			<option value="disburser_ppo3">PPO Report 3</option>
			<option value="disburser_ppo4">PPO Report 4</option>
			<option value="disburser_ppo5">PPO Report 5</option>
			<option value="disburser_ppo6">PPO Report 6</option>
		</select>

		<div id="disburser_ppo1" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo1')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo1" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr>
								<td align="center" style="vertical-align: top; padding: 200px 0 30px 0;" colspan="4">
								<table width="40%" border="1">
								<tr>
									<td>
										<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 24px;">PENSION PAYMENT ORDER<br>DISBURSER'S PORTION</div>
								    </div>
									</td>
								</tr>
								</table>
								</td>
							</tr>

						 <?php $pensionername=explode(".",$pensioner->name);

						 ?>

							<tr>
								<td colspan="3" style="padding-top:40%" height="600px">
									<table width="100%" border="1" height="300px">
										<tr height="30px;">
											<td><b><h2>1</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">NAME OF THE PENSIONER</td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;" width="40%"><?php if($pensionername[0]=="Dr"){echo $pensioner->name;}else{ echo $name;}?></td>
										</tr>
										<tr>
											<td><b><h2>2</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DESIGNATION</td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->designation; ?></td>
										</tr>
										<tr>
											<td><b><h2>3</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>SERVICE TO WHICH BELONG</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php if(!in_array($pensioner->designation, $apex_designation)) {echo ""; }else{ echo "IFS";}?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>4</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>BATCH</h2></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"></td>
										</tr>
										<tr>
											<td><b><h2>5</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>DATE OF RETIREMENT</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php echo $pensioner->dor;?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>6</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DATE OF COMMENCEMENT OF PENSION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->effect_of_pension; ?></td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo2" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo2')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo2" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 30px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr><td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td></tr>
							<tr>
								<td style="vertical-align: top;" colspan="4">
									<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial;">FORM CAM-52<br>(Para 7.3.2)<br><br>PENSION PAYMENT ORDER<br>(DISBURSER'S PORTION)</div>
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
								<td height="40px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="left">Sir,</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">
									<?php echo nbs(30); ?>UNTIL FURTHER NOTICE, and on the expiration of every month be pleased to pay <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b> the pension as set out in Part II of this order/Family pension as set out in Para-III of this order* plus the amount of dearness relief as admissible from time to time thereon after due identification of the prisioner/family pension. The payment should commence from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b>. The Income tax, where deductible, should be deducted at source.
								</td>
							</tr>
							<tr>
								<td height="20px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">2.<?php echo nbs(27); ?>Arrears of pension/family pension at <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-(Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>only)</b></b> only per month from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b> plus the admissible dearness relief thereon may also be paid to <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b></td>
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
								<td style="vertical-align: top; padding: 55px 0 10px 0; text-align:center">Signature</td>
							</tr>
							
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 20px 0 10px 0; text-align:center">Designation</td>
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
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(20).str_replace(",", ",<br />".nbs(19), $pensioner->bank_name)."<br />".nbs(20)."A/C No. - ".$pensioner->account_no."<br />".nbs(20)."Code No. - ".$pensioner->code_no;?></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2" style="vertical-align: top; padding: 7px; text-align: center;"></td>
							</tr>

							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 140px 30px 10px 0; text-align:center">Signature</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo3" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo3')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo3" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
								1.	Name of the Government Servant. <b><?php echo strtoupper($name); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								2.	Post/Grade/Rank last held. <b>Retd. <?php echo $pensioner->designation;?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								3.	Name of the Ministry/Deptt./Office from which he/she retired under the Govt. of India/State.
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<b><?php echo str_replace(",", ",<br />", $pensioner->office_address); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								4.	Scale of Pay/Pay Band & Grade Pay at the time of retirement (Mandatory): <b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?></b>
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
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/-</b></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/-</b></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->getAverageEmolument(); ?>/-</b></td>
										<td align="center"></td>
									</tr>
								</table>
							</td>
						</tr>
						<?php 
						//$ae=($pensioner->pay_info[1]['increament_GP']=='0')?"NIL":$pensioner->getAverageEmolument();?>

						<tr>
							<td colspan="2" style="padding: 60px 0;">12. Average Emoluments <b>Rs. <?php echo $pensioner->getAverageEmolument(); ?></b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;padding:0px 140px;">Signature</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo4" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo4')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo4" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
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
							<td valign="top"><b>Rs. 500/- p.m</b></td>
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
							<td style="padding: 7px;">2. Name of the retiring Govt. Servant :- <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b></td>
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
										<td colspan="3" align="center" valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
									</tr>
									<tr>
										<td valign="top">3</td>
										<td valign="top">Rules under which sanctioned</td>
										<td valign="top" colspan="3"><b>Rule <?php if($class_of_pension="Voluntary_Retirement_Pension"){echo "48(A)";}elseif($class_of_pension="Superannuation_Pension") {echo "35";}elseif ($class_of_pension=" Normal_Family_Pension") {echo "54";}?> of CCS (P) Rule 1972</b></td>
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
									<?php echo nbs(40); ?>3. <?php if($pensioner->provisional_pension=='0'){echo "No Provisional Pension paid";}else{echo $pensioner->provisional_pension;}?>
								</b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;padding: 80px 190px;">Signature</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo5" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo5')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo5" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
									<?php $nameofspouse=explode(" ",$pensioner->getNameofSpouse());
									       if($nameofspouse[1]="Dr"){
                                            $a=$nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];
                                            //print_r(implode(" ", $a));
                                           // print_r(str_split("hello",3));
                                            
                                                   }else{

                                                   }


                                           //$nameofchild=explode(" ",$pensioner->getNameofChild());
                                           //print_r($nameofspouse[0]);


									?>
									<tr>
										<td valign="top"><b>1.<br />2.<br/>3.<br/>4</b></td>
										<td valign="top"><b><?php if($nameofspouse[1]="Dr"){echo $nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];}?><br><?php echo $pensioner->getNameofChild();?><b></td>
										<td valign="top"><b></b></td>
										<td valign="top"><b>Wife<br><?php echo $pensioner->getRelationofChild();?></b></td>
										<td valign="top"><b><?php echo $pensioner->getDOBofSpouse();?><br><?php echo $pensioner->dobofChild(); ?></b></td>
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
						     <tr>
								<td style="text-align:right; padding: 80px 140px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>





		<div id="disburser_ppo6" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo6')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo6" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">c. To any person sending a Life Certificate signed by  some person excercising the powers of a Magistrate under the Criminal procedure code or by any Registrar of  or Sub-Registrar appointed under the indian registration act,1908 or by any pensioned officer who,before retriment exercised the powers of Magistrate or any Gazetted officer,or by a Munsiff or by a police officer  not below the rank of sub-inspector in charge of a ploice station or by Post Master,a Departmental Sub-Post  master or an inspector of post officers,or by officer of the reserve bank of india and public sector bank or by head of village panchayat,gaon panchyat or gram panchyat or by the  head of an executive committee of a village or by a bank included in the second schedule to the reserve bank of india act 1934,in respect of person  drawing pension through that bank</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">d. In all cased referred to in clauses (a),(b) & (c) the Disbursing officer must at least once a year require proof independent of that furnished by the life certificate of the continued existence of the pensioner.The pensioner shall not be paid on account of period more  than a year after the date of life certificate last received and the disbursing officer must be on the watch for authentic information  of the decease of any such pensioner and on receipt thereof,shall promptly stop further payments.</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0 40px 0; text-align: justify;" colspan="4" align="left">3. The Quantum of pension available to the old pensioner/family pensioner will be as follows:</td>
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
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
							<tr>
								<td colspan="2" style="text-align:right;padding: 80px 140px;">Signature</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>









	<!-- pensioner portion -->
	<div id="disburser_pensioner_portion" style="display: none;">
		<select id="select-pensioner-to-print">
			<option value="0">--Select--</option>
			<option value="pensioner_ppo1" selected>PPO Report 1</option>
			<option value="pensioner_ppo2">PPO Report 2</option>
			<option value="pensioner_ppo3">PPO Report 3</option>
			<option value="pensioner_ppo4">PPO Report 4</option>
			<option value="pensioner_ppo5">PPO Report 5</option>
			<option value="pensioner_ppo6">PPO Report 6</option>
		</select>


        <div id="pensioner_ppo1" style="display:block;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint1')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint1" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							


							<tr>
								<td align="center" style="vertical-align: top; padding: 200px 0 30px 0;" colspan="4">
								<table width="40%" border="1">
								<tr>
									<td>
										<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 24px;">PENSION PAYMENT ORDER<br>PENSIONER'S PORTION</div>
								    </div>
									</td>
								</tr>
								</table>
									

								</td>
							</tr>

						 

							<tr>
								<td colspan="3" style="padding-top:40%" height="600px">
									<table width="100%" border="1" height="300px">
										<tr height="30px;">
											<td><b><h2>1</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">NAME OF THE PENSIONER</td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;" width="40%"><?php if($pensionername[0]=="Dr"){echo $pensioner->name;}else{ echo $name;}?></td>
										</tr>
										<tr>
											<td><b><h2>2</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DESIGNATION</td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->designation; ?></td>
										</tr>
										<tr>
											<td><b><h2>3</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>SERVICE TO WHICH BELONG</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php if(!in_array($pensioner->designation, $apex_designation)) {echo ""; }else{ echo "IFS";}?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>4</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>BATCH</h2></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"></td>
										</tr>
										<tr>
											<td><b><h2>5</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>DATE OF RETIREMENT</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php echo $pensioner->dor;?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>6</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DATE OF COMMENCEMENT OF PENSION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->effect_of_pension; ?></td>
										</tr>
										
										

									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>





		<div id="pensioner_ppo2" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint2')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint2" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
								<td height="40px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="left">Sir,</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">
								<?php echo nbs(30); ?>UNTIL FURTHER NOTICE, and on the expiration of every month be pleased to pay <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b> the pension as set out in Part II of this order/Family pension as set out in Para-III of this order* plus the amount of dearness relief as admissible from time to time thereon after due identification of the prisioner/family pension. The payment should commence from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b>. The Income tax, where deductible, should be deducted at source.
								</td>
							</tr>
							<tr>
								<td height="20px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">2.<?php echo nbs(27); ?>Arrears of pension/family pension at <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-(Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>only)</b></b> only per month from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b> plus the admissible dearness relief thereon may also be paid to <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b></td>
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
								<td style="vertical-align: top; padding: 55px 0 10px 0; text-align:center">Signature</td>
							</tr>
							
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 20px 0 10px 0; text-align:center">Designation</td>
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
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(20).str_replace(",", ",<br />".nbs(19), $pensioner->bank_name)."<br />".nbs(20)."A/C No. - ".$pensioner->account_no."<br />".nbs(20)."Code No. - ".$pensioner->code_no;?></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2" style="vertical-align: top; padding: 7px; text-align: center;"></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 140px 0 10px 0; text-align:center">Signature</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo3" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint3')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint3" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
								1.	Name of the Government Servant. <b><?php echo strtoupper($name); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								2.	Post/Grade/Rank last held. <b>Retd. <?php echo $pensioner->designation;?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								3.	Name of the Ministry/Deptt./Office from which he/she retired under the Govt. of India/State.
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<b><?php echo str_replace(",", ",<br />", $pensioner->office_address); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								4.	Scale of Pay/Pay Band & Grade Pay at the time of retirement (Mandatory): <b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?></b>
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
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/- (Apex Pay)</b></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/- (Apex Pay)</b></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->getAverageEmolument(); ?>/-</b></td>

										<td align="center"></td>
									</tr>
								</table>
							</td>
						</tr>
						
						<?php 
						//$ae=($pensioner->pay_info[1]['increament_GP']=='0')?"NIL":$pensioner->getAverageEmolument();?>
						
						<tr>
							<td colspan="2" style="padding: 60px 0;">12. Average Emoluments <b>Rs. <?php echo $pensioner->getAverageEmolument(); ?></b></td>
						</tr>
					 	<tr>
								<td colspan="2" style="text-align:right;padding:0px 140px;">Signature</td>
							</tr>
					 	
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo4" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint4')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint4" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
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
							<td valign="top"><b>Rs. 500/- p.m</b></td>
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
							<td style="padding: 7px;">2. Name of the retiring Govt. Servant :- <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b></td>
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
										<td valign="top"><b>Rs.<?php echo $pensioner->getAmountofPension();?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">2</td>
										<td valign="top">Class of Pension</td>
										<td colspan="3" align="center" valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
									</tr>
									<tr>
										<td valign="top">3</td>
										<td valign="top">Rules under which sanctioned</td>
										<td valign="top" colspan="3"><b>Rule <?php if($class_of_pension="Voluntary_Retirement_Pension"){echo "48(A)";}elseif($class_of_pension="Superannuation_Pension") {echo "35";}elseif ($class_of_pension=" Normal_Family_Pension") {echo "54";}?> of CCS (P) Rule 1972</b></td>
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
									Note :-Recoveries :- 1. Provisional Gratuity of Rs. <?php echo $pensioner->provisional_gratuity; ?>/- has been paid<br />
									<?php echo nbs(40); ?>2. Commutation of pension not paid<br />
									<?php echo nbs(40); ?>3. <?php if($pensioner->provisional_pension=='0'){echo "No Provisional Pension paid";}else{echo $pensioner->provisional_pension;}?>
								</b>
							</td>
						</tr>
						<tr>
								<td colspan="2" style="text-align:right;padding: 80px 190px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo5" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint5')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint5" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
									<?php $nameofspouse=explode(" ",$pensioner->getNameofSpouse());
									       if($nameofspouse[1]="Dr"){
                                            $a=$nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];
                                            //print_r(implode(" ", $a));
                                           // print_r(str_split("hello",3));
                                            
                                                   }else{

                                                   }


                                           //$nameofchild=explode(" ",$pensioner->getNameofChild());
                                           //print_r($nameofspouse[0]);


									?>
									<tr>
										<td valign="top"><b>1.<br />2.<br/>3.<br/>4</b></td>
										<td valign="top"><b><?php if($nameofspouse[1]="Dr"){echo $nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];}?><br><?php echo $pensioner->getNameofChild();?><b></td>
										<td valign="top"><b></b></td>
										<td valign="top"><b>Wife<br><?php echo $pensioner->getRelationofChild();?></b></td>
										<td valign="top"><b><?php echo $pensioner->getDOBofSpouse();?><br><?php echo $pensioner->dobofChild(); ?></b></td>
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
						<tr>
								<td style="text-align:right; padding: 80px 140px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>


		<div id="pensioner_ppo6" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint6')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint6" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
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
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">c. To any person sending a Life Certificate signed by  some person excercising the powers of a Magistrate under the Criminal procedure code or by any Registrar of  or Sub-Registrar appointed under the indian registration act,1908 or by any pensioned officer who,before retriment exercised the powers of Magistrate or any Gazetted officer,or by a Munsiff or by a police officer  not below the rank of sub-inspector in charge of a ploice station or by Post Master,a Departmental Sub-Post  master or an inspector of post officers,or by officer of the reserve bank of india and public sector bank or by head of village panchayat,gaon panchyat or gram panchyat or by the  head of an executive committee of a village or by a bank included in the second schedule to the reserve bank of india act 1934,in respect of person  drawing pension through that bank</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">d. In all cased referred to in clauses (a),(b) & (c) the Disbursing officer must at least once a year require proof independent of that furnished by the life certificate of the continued existence of the pensioner.The pensioner shall not be paid on account of period more  than a year after the date of life certificate last received and the disbursing officer must be on the watch for authentic information  of the decease of any such pensioner and on receipt thereof,shall promptly stop further payments.</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0 40px 0; text-align: justify;" colspan="4" align="left">3. The Quantum of pension available to the old pensioner/family pensioner will be as follows:</td>
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
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
							

							<tr>
								<td colspan="2" style="text-align:right;padding: 80px 140px;">Signature</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>


<script type="text/javascript">
	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hideAll();
				$('#'+val).show();
			}

			<?php if(in_array($pensioner->designation, $apex_designation)) : ?>
				if(val == 'disburser_disburser_portion') {
					hidePPOAll();
					$('#disburser_ppo1').show();
				} else if(val == 'disburser_pensioner_portion') {
					hidePPOAll();
					$('#pensioner_ppo1').show();
				} else {}
			<?php endif; ?>
		});

		$('#select-disburser-to-print, #select-pensioner-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hidePPOAll();
				$('#'+val).show();
			}
		});
	});



	function hideAll() {
		$('#form1, #form2, #form3, #form4, #form5, #disburser_disburser_portion, #disburser_pensioner_portion, #ppo1, #ppo2, #ppo3, #ppo4, #ppo5').hide();
	}

	function hidePPOAll()
	{
		$('#pensioner_ppo1, #pensioner_ppo2, #pensioner_ppo3, #pensioner_ppo4, #pensioner_ppo5,#pensioner_ppo6, #disburser_ppo1, #disburser_ppo2, #disburser_ppo3, #disburser_ppo4, #disburser_ppo5,#disburser_ppo6').hide();
	}
</script>