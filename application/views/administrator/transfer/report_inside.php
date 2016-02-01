<?php
    $ag = array();
    $treasury = array();
    foreach(getAllAccountantGeneral() as $value) :
        $ag[$value['id']] = $value['name'];
    endforeach;
    foreach (getAllTreasury() as $value) :
        $treasury[$value['id']] = $value['title'];
    endforeach;
    $ppo = $result->case_no."/".$result->ppo;
    if($result->type == 'inside') :
		$da_percent = $pensioner->da_percentage();
	else :
		$da_percent = $result->dearness_relief;
	endif;
?>

<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:900px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em;margin: 0px auto;">
			<table width="100%" cellpadding="3" id="report" border="0" align="center">
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
						<?php
                            if($result->send_to == 'inside') :
                                echo str_replace(", ", ",<br />".nbs(26), $treasury[$result->istti]);
                            elseif($result->send_to == 'outside') :
                                echo str_replace(", ", ",<br />".nbs(26), $ag[$result->ist]);
                            endif;
                        ?>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;" colspan="3">Sub: <?php echo nbs(17); ?><b>Transfer of pension documents.</b></td></tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top; line-height: 1.7em; text-align: justify;" colspan="3" align="left"><?php echo nbs(22); ?>I am to forward herewith the PPO No. <div style="display: inline-block; min-width: 250px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo $ppo; ?></div> both halves with the enclosures in respect of <?php echo ($pensioner->pensioner_pronoun == 'he') ? 'Shri' : 'Smti'; ?> <div style="display: inline-block; min-width: 350px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo $result->name; ?> Retd. <?php echo $pensioner->designation; ?></div> to draw <?php echo ($pensioner->pensioner_pronoun == 'he') ? 'his' : 'her'; ?> monthly pension/family pension from <div style="display: inline-block; min-width: 250px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo $result->draw_from; ?></div>.</td>
				</tr>
				<tr>
					<td style="vertical-align: top; line-height: 1.7em; text-align: justify;" colspan="3" align="left"><?php echo nbs(24); ?>The pensioner has been paid up to <div style="display: inline-block; min-width: 150px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo date('F y', strtotime($result->paid_upto)); ?></div> at the following rate by the Treasury/Sub-Treasury <div style="display: inline-block; min-width: 350px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;">
						<?php
							if($result->type == 'inside') :
								echo $treasury[$result->irf];
							elseif($result->type == 'outside') :
								echo $ag[$result->orf];
							endif;
						?>
					</div>.</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						<table width="100%" style="margin-top: 20px;">
							<tr style="height: 20px;">
								<td width="3%">1.</td>
								<td width="37%">Basic pension</td>
								<td width="3%">@</td>
								<td width="57%"><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->basic_pension); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>2.</td>
								<td>Reduced pension</td>
								<td>@</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->reduced_pension); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>3.</td>
								<td>Dearness Relief <?php echo nbs(15); ?><div style="color: red;display: inline-block;">@ <?php echo $da_percent; ?></div></td>
								<td>@</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->basic_pension*$da_percent/100); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>4.</td>
								<td>Medical Allowance</td>
								<td>@</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->medical_allowance); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td>5.</td>
								<td>Family pension</td>
								<td></td>
								<td></td>
							</tr>
							<tr style="height: 20px;">
								<td></td>
								<td>(a) Enhance Rate</td>
								<td>@</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->enhance_rate); ?>/- pm</div></td>
							</tr>
							<tr style="height: 20px;">
								<td></td>
								<td>(b) Normal Rate</td>
								<td>@</td>
								<td><div style="width: 100%; font-weight: bold; border-bottom: 1px solid #000;">Rs. <?php echo round($result->ordinary_rate); ?>/- pm</div></td>
							</tr>
						</table>
					</td>
				</tr>
		        <tr>
					<td style="vertical-align: top;" colspan="3" align="left"><?php echo nbs(8); ?>You are requested to take further necessary action from your end at early date.</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"></td>
					<td style="vertical-align: top; text-align:center">Yours faithfully,</td>
				</tr>
				<tr style="height: 50px;">
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2" width="50%">Memo No - <?php echo $result->memo_no; ?></td>
					<!-- <td style="vertical-align: top;text-align:center;font-size: 14px;" width="50%">Dated Naharlagun, the <div style="display: inline-block; min-width: 80px; text-align: center; font-weight: bold; border-bottom: 1px solid #000;"><?php echo date('d/m/Y')?></div></td> -->
					<td style="vertical-align: top;text-align:center;font-size: 14px;" width="50%">Director/Joint Director<br />Govt. of Arunchal Pradesh,<br />Naharlagun</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						1.	The Treasury Officer/Sub-Treasury
						<div style="border-bottom: 1px solid #000; font-weight: bold; margin: 5px 0 10px 15px;width: 60%;">
							<?php
								if($result->type == 'inside') :
									echo $treasury[$result->irf];
								elseif($result->type == 'outside') :
									echo $ag[$result->orf];
								endif;
							?>
						</div>
						<?php echo nbs(5); ?>With reference to his letter No
						<div style="border-bottom: 1px solid #000; font-weight: bold; margin: 5px 0 10px 15px;width: 60%;"><?php echo $result->letter_no.nbs(15); ?> Dtd. <?php echo $result->letter_date; ?></div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">2.	<?php echo ($pensioner->pensioner_pronoun == 'he') ? 'Shri' : 'Smti'; ?> <?php echo $result->name; ?><br />
						<?php
							echo nbs(4);
							echo str_replace(",", ",<br />".nbs(3), $pensioner->address_after_retirement);
						?>
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