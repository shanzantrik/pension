<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php
	$val = $getDetails_revision[0];

	$ppo_no = $val['case_no']."/".$val['ppo_no'];
    $gpo_no = "Pen/AP/GPO/".$val['gpo_no'];
    $cpo_no = "Pen/AP/COM/".$val['cpo_no'];

	$life_time_arrear=$val['revised_amount_of_pension'];
	$from = new DateTime($val['dor']);
	$from->modify('+1 day');
	$life_time_from_upto= " <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";

	if($val['dod']>$val['dor']){
		$enhan_from= new DateTime($val['dod']);
		$enhan_from->modify('+1 day');

		$enhan_upto= new DateTime($val['dod']);
		$enhan_upto->modify('+7 year');
	}else{
		$enhan_from= new DateTime($val['dod']);
		$enhan_from->modify('+1 day');

		$enhan_upto= new DateTime($val['dod']);
		$enhan_upto->modify('+10 year');
	}
	$enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage"."</b>";

  	$pay_info = unserialize($val['pay_info']);
    $lp = array();
    foreach ($pay_info[0] as $key => $value){
        if($key != 'post_DA') :
            $lp[$key] = $value;
        endif;
    }
    $ip = array();
    foreach ($pay_info[1] as $key => $value) {
        if($key != 'increament_DA') :
            $ip[$key] = $value;
        endif;
    }
    $da_post=$pay_info[0]['post_DA'];
    $da_incr=$pay_info[1]['increament_DA'];

    $lastPay = getPay($lp,$da_post);
    $latestDaAmount = get_pecentage_of_da($lastPay,getLatestDaPercent());
    $year_of_service = year_of_service($val['net_qualifying_service']);
    $getRG= getDCRG($lastPay, $latestDaAmount, $year_of_service);
 ?>

<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
        <u><strong>Revised Calculation sheet of post
        <?php
        	$dor = explode("-", dateTimeToDate($val['dor']));
        	if($dor[0] >= '1996' && $dor[0] <= '2005') :
				echo '1-1-1996';
			else :
				echo '1-1-2006';
	    	endif;
	    ?>
        <?php echo nbs(2); if($val['dod']=="0000-00-00"){echo "Pension";}else{echo "Family Pension";} ?><br>
         On upgradation of <?php if($val['revision_type']=='acp'){echo "ACP";}else if($val['revision_type']=='macp'){echo "MACP";}else if($val['revision_type']=='Additional_increament'){echo "Additional Increament";}else if($val['revision_type']=='refixation_of_pay'){echo "Refixation of pay";}?>
           </strong></u>
    </div>
    <div style="padding-top:20px">
        <div style="float:left; padding-left:20px">
        	<strong>No.<?php echo $val['case_no']; ?></strong>
        </div>
      	<div style="float:right;padding-right:20px">
        	<strong>Date</strong>: <?php echo date('d/m/Y')?>
        </div>
  	</div>

<table width="100%" border="0" cellpadding="2" id="report">
	<tr>
		<td width="7%"><div align="right">1.</div></td>
		<td width="35%"><b>Name of Pensioner</b></td>
		<td width="2%">:</td>
		<td width="60%"><?php if($val['dod']=="0000-00-00"){echo "";}else{echo "Late";}?>
       <?php echo $val['name']; ?></td>
	</tr>
	<tr>
		<td ><div align="right">2.</div></td>
		<td><b>Date Of Birth</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['dob']); ?></td>
		
	</tr>
	<tr>
		<td ><div align="right">3.</div></td>
		<td><b>Date of Joining</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['doe']); ?></td>
	</tr>
	

	<tr>
		<td ><div align="right">4.</div></td>
		<td><b>Date of Retirement</b></td>
		<td>:</td>
		<td>
			<?php echo dateTimeToDate($val['dor']); ?>
			<?php
				if($val['dod'] != "0000-00-00" && $val['dod'] != '') {
					echo " <span style='font-size:12px; color: red;font-weight: bold;'>(On expired ".$val['dod'].")</span>";
				}
			?>
		</td>
	</tr>

	<!-- <tr>
		<td ><div align="right">4.</div></td>
		<td><b><?php if($val['dod']=="0000-00-00"){echo "Date of Retirement";}else{echo "Date of Death";} ?></b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00"){echo dateTimeToDate($val['dor']);}else{echo dateTimeToDate($val['dod']); } ?></td>
	</tr> -->
	<tr>
		<td ><div align="right">5.</div></td>
		<td><b>Age at retirement</b></td>
		<td>:</td>
		<td><?php echo calculateDateDifference($val['dob'], $val['dor'], true); ?></td>
		
	</tr>
		<tr>
		<td ><div align="right">6.</div></td>
		<td><b>Net qualifying Service</b></td>
		<td>:</td>
		<td>
			<?php list($year, $month, $day) = explode("-", $val['net_qualifying_service']); ?>
			<?php echo $year." years ".$month." months ".$day." days"; ?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">7.</div></td>
		<td><b>Six monthly period (SMP)</b></td>
		<td>:</td>
		<td><?php echo $val['smp'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">8.</div></td>
		<td><b>Revised Scale of Pay w.e.f 1-1-2006</b></td>
		<td>:</td>
		<td><?php $pay_scale_details=getPayScale(array('id'=>$val['revised_scale_pay']));
		       $psd = $pay_scale_details[0];
		       echo $psd['grade']."-".$psd['pay_scale'];
		?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">9.</div></td>
		<td><b>Last pay in Pay Band+Gd.Pay</b></td>
		<td>:</td>
		<td><?php echo $val['last_pay'].'+'.$val['grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">10.</div></td>
		<td><b>Average emouluments</b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00"){echo $val['average_emolument'];}else{echo "N/A";}?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">11.</div></td>
		<td><b>Amount of Pension/Family Pension<br>
		    Sanctioned in pre-revised scale of pay
		</b></td>
		<td>:</td>
		<td><?php echo $val['amount_of_pension_pre_revised'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">12.</div></td>
		<td><b>50% of AE in Revised Pay</b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00"){echo $val['fifty_of_ae'];}else{echo "N/A";}?>

		</td>
	</tr>
	<tr>
		<td ><div align="right">13.</div></td>
		<td><b>50% of Last Pay</b></td>
		<td>:</td>
		<td><?php echo $val['fifty_of_last_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">14.</div></td>
		<td><b>50% of minimum of pay in pay Band<br>
		plus Grade Pay</b></td>
		<td>:</td>
		<td><?php echo $val['fifty_of_pay_band_plus_grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">15.</div></td>
		<td><b>Life Time Arrear Pension<br></b></td>
		<td>:</td>
		<td><?php echo "N/A"//if($val['dod']==0){echo "N/A";}else{echo $life_time_arrear.'--'.$life_time_from_upto;}?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">16.</div></td>
		<td><b>Amount of pension/family pension<br>
		 sanctioned(Whichever is highest at 12,13 & 14</b></td>
		<td>:</td>
		<td><?php echo $val['revised_amount_of_pension'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">17.</div></td>
		<td><b>Amount of pre-revised-Amount of revised D.C.R.G</b></td>
		<td>:</td>
		<?php //$total=$val['revised_dcrg']-$val['prerevised_dcrg'];?>
		<td><?php echo $val['revised_dcrg'];?>-<?php echo $val['prerevised_dcrg'];?>=<?php echo $val['total_payable'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">18.</div></td>
		<td><b>Amount of Revised Family Pension<br>
		  a) Enhanced rate of Family Pension<br>
		  b) Ordinary rate of Family Pension<br>
		   &nbsp;&nbsp;&nbsp;&nbsp;(30% of last pay in PB+Grade Pay)</b></td>
		<td>:</td>

		<td><br><?php echo $val['revised_enhance_rate'];if($val['dod']=="0000-00-00"){echo "";}else{echo "&nbsp;".$enhance_from_upto;}?><br><?php echo $val['revised_ordinary_rate'];if($val['dod']=="0000-00-00"){echo "";}else{echo "&nbsp;".$ordinary_from_upto;}?>

		</td>
	</tr>
    <tr>
		<td ><div align="right">19.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00"){echo ($val['revised_cop']==0)? "N/A" :$val['revised_cop'];}else{echo "N/A" ;}?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">20.</div></td>
		<td><b>Reduced Pension after Commutation</b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00"){echo $val['revised_reduced_pension'];}else{echo "N/A";}?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">21.</div></td>
		<td><b>Name of Family Pensioner</b></td>
		<td>:</td>
		<td>
			<?php echo getNameOfLegalHeir($val['family_info']); ?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">22.</div></td>
		<td><b>Name of Treasury/Sub-Treasury</b></td>
		<td>:</td>
		<td><?php echo $val['treasury'];?></td>
	</tr>
	<tr>
		<td ><div align="right">23.</div></td>
		<td><b>Pension be enhanced as attaining the age of ..</b></td>
		<td>:</td>
		<td><?php echo $val['pension_enhanced'];?></td>
	</tr>
		<tr>
		<td ><div align="right">24.</div></td>
		<td><b>Recovery:-</b></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td colspan="3"><b>As per PPO No<?php echo nbs(2)?><?php echo $ppo_no; ?><?php echo nbs(2)?>Dated<?php echo nbs(2)?><?php echo dateTimeToDate($val['ppd_created_at']); ?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td colspan="3"><b>As per GPO No<?php echo nbs(2)?><?php echo $gpo_no; ?><?php echo nbs(2)?>Dated<?php echo nbs(2)?><?php echo dateTimeToDate($val['ppd_created_at']); ?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td colspan="3"><b>As per CPO No<?php echo nbs(2)?><?php echo $cpo_no; ?><?php echo nbs(2)?>Dated<?php echo nbs(2)?><?php echo dateTimeToDate($val['ppd_created_at']); ?></b></td>
	</tr>
</table>
</div>
<style type="text/css">
	.table td {padding: 10px;}
	.da{font-size: 12px;}
	.inc-details {font-size: 12px;color: #191699;display: inline;}
	#report td {
		vertical-align: top;
		margin: 5px;
	}
</style>

<script>
function myFunction() {
    window.print();
}
</script>






































































