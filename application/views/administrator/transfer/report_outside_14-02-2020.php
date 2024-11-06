<?php
    $ag = array();
    $treasury = array();
    foreach(getAllAccountantGeneral() as $value) :
        $ag[$value['id']]['name'] = $value['name'];
    	$ag[$value['id']]['state'] = $value['state'];
    endforeach;
    foreach (getAllTreasury() as $value) :
        $treasury[$value['id']] = $value['title'];
    endforeach;
?>

<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:900px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em;margin: 0px auto;">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td width="33%"></td>
					<td width="33%"></td>
					<td width="33%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-family: initial;">GOVERNMENT OF ARUNACHAL PRADESH<br/>DIRECTORATE OF AUDIT & PENSION<br/><u>NAHARLAGUN</u>.</div>
					    </div>
					</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="2">
						No. <?php echo $result->memo_no; ?>
					</td>
					<td style="vertical-align: top;font-size: 14px;">Dated Naharlagun, the <div style="display: inline-block; min-width: 80px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo date('d/m/Y')?></div></td>		
				</tr>
				<tr>
					<td colspan="3">To,</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<?php echo nbs(25); ?>
						<?php echo "<b>".str_replace(", ", ",<br />".nbs(26), $treasury[$result->ost])."</b>"; ?>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;" colspan="3">Sub: <?php echo nbs(17); ?>Forwarding of P.P.O. both halves of <?php echo $result->salutation." ".$result->name.", Retd. ".$result->designation; ?></td></tr>
			 	<tr>
				<tr>
					<td style="vertical-align: middle;" colspan="2">Ref: <?php echo nbs(17); ?><?php echo $result->case_no; ?> Dated <?php echo $result->case_dated; ?></td>
				</tr>
				<tr style="height: 12px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top; line-height: 1.7em; text-align: justify" colspan="3"><?php echo nbs(19); ?>Enclosed find herewith the P.P.O. both halves No. <b><?php echo $result->ppo; ?></b> of <b><?php echo $result->salutation." ".$result->name.", (Retd.) ".$result->designation; ?></b> received from <b><?php echo $ag[$result->orf]['name']; ?></b> for drawal of pensionery benefits from your end vide its special seal authority No. <b><?php echo $result->case_no; ?></b> dated <b><?php echo $result->case_dated; ?></b> and C.P.O No <b><?php echo $result->cpo; ?></b> Dated <b><?php echo $result->cpo_dated; ?></b>. The details are given below.</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top; padding-left: 50px;" colspan="3">
						<table width="100%" style="margin: 20px 0;">
							<tr style="height: 20px;">
								<td width="3%">1.</td>
								<td width="37%">Commencement of Pension</td>
								<td width="3%">-</td>
								<td width="57%"><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;"><?php echo $result->comm_of_pension; ?></div></td>
							</tr>
							<tr style="height: 20px;">
								<td>2.</td>
								<td>Basic pension</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->basic_pension); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>3.</td>
								<td>Enhance rate of family pension</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->enhance_rate); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>4.</td>
								<td>Normal Rate of family pension</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->ordinary_rate); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>5.</td>
								<td>Amount Of Gratuity</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->amount_of_gratuity); ?>/-</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>6.</td>
								<td>Commuted value of pension</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->commuted_value_of_pension); ?>/-</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>7.</td>
								<td>Amount of pension commuted</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->amount_of_pension_commuted); ?>/-</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>8.</td>
								<td>Reduced pension</td>
								<td>-</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->reduced_pension); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>9.</td>
								<td colspan="3">Pension may be reduced from the date of payment of commuted value.</td>
							</tr>
						</table>
					</td>
				</tr>
		        <tr>
					<td style="vertical-align: top; text-align: justify;" colspan="3"><?php echo nbs(33); ?>The pension may be paid as per the P.P.O. after observing the required formalities</td>
				</tr>
				<tr style="height: 12px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
				<tr>
					<?php $dd = ($result->amount_of_gratuity != '' && $result->amount_of_gratuity != 0) ? '/GPO' : ''; ?>
					<td style="vertical-align: top; text-align: justify;" colspan="3"><?php echo nbs(30); ?>The P.P.O/C.P.O<?php echo $dd; ?> are enclosed herewith for payment of pensionery benefits and the expenditure is debitable to Head of Account "8793" Inter State Suspense Account, Adjustment to <?php echo $ag[$result->orf]['state']; ?> State (Pension).</td>
				</tr>
				<tr style="height: 25px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top; text-align:center">Yours faithfully,</td>
				</tr>
				<tr style="height: 15px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">Enclo:- As stated</td>
				</tr>
				<tr style="height: 25px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top;text-align:center;font-size: 14px;" width="50%">Director/Joint Director<br />Govt. of Arunchal Pradesh,<br />Naharlagun</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2" width="50%">Memo No - <?php echo $result->memo_no; ?></td>
					<td style="vertical-align: top;text-align:center;font-size: 14px;" width="50%">Naharlagun, the <div style="display: inline-block; min-width: 80px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo date('d/m/Y')?></div></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Copy To:- <br />
						 <b></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<table width="100%">
							<tr>
								<td width="10%" align="center" style="vertical-align: top;">1.</td>
								<td width="90%" style="vertical-align: top;">
									<?php echo $result->salutation." ".$result->name.", Retd. ".$result->designation; ?>,<br />
									<?php echo str_replace(",", ",<br />", $result->address); ?>
								</td>
							</tr>
							<tr>
								<td align="center" style="vertical-align: top;">2.</td>
								<td style="vertical-align: top;"><?php echo $ag[$result->orf]['name']; ?> for information.</td>
							</tr>
							<tr>
								<td align="center" style="vertical-align: top;">3.</td>
								<td style="vertical-align: top;">Office Copy.</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top;text-align:center;font-size: 14px;" width="50%">Director/Joint Director<br />Govt. of Arunchal Pradesh,<br />Naharlagun</td>
				</tr>
			</table>
		</div>
	</div>
</div>