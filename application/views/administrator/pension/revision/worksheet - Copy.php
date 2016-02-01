<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php
	$val = $getDetails_revision[0];

	$ppo_no = $val['case_no']."/".$val['ppo_no'];
    $gpo_no = "Pen/AP/GPO/".$val['gpo_no'];
    $cpo_no = "Pen/AP/COM/".$val['cpo_no'];

	$life_time_arrear=$val['revised_amount_of_pension'];
	$from = new DateTime($val['dor']);
	$from->modify('+1 day');
	$return= " <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";
?>

<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
        <u><strong>Revised Calculation sheet of post 1-1-2006 pension/Family Pension <br />On upgradation of <?php if($val['revision_type']=='acp'){echo "ACP";}else if($val['revision_type']=='macp'){echo "MACP";}else if($val['revision_type']=='Additional_increament'){echo "Additional Increament";}else if($val['revision_type']=='refixation_of_pay'){echo "Refixation of pay";}?></strong></u>
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
		<td width="60%"><?php echo $val['name']; ?></td>
	</tr>
	<tr>
		<td><div align="right">2.</div></td>
		<td><b>Date Of Birth</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['dob']); ?></td>
	</tr>
	<tr>
		<td><div align="right">3.</div></td>
		<td><b>Date of Joining</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['doe']); ?></td>
	</tr>
	<tr>
		<td><div align="right">4.</div></td>
		<td><b>Date of Retirement</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['dor']); ?></td>
	</tr>
	<tr>
		<td><div align="right">5.</div></td>
		<td><b>Date of Death</b></td>
		<td>:</td>
		<td><?php echo $val['dod'];?></td>
	</tr>
	<tr>
		<td><div align="right">6.</div></td>
		<td><b>Age at retirement</b></td>
		<td>:</td>
		<td><?php echo calculateDateDifference($val['dob'], $val['dor']); ?></td>
	</tr>
		<tr>
		<td><div align="right">7.</div></td>
		<td><b>Net qualifying Service</b></td>
		<td>:</td>
		<td>
			<?php list($year, $month, $day) = explode("-", $val['net_qualifying_service']); ?>
			<?php echo $year." years ".$month." months ".$day." days"; ?>
		</td>
	</tr>
	<tr>
		<td><div align="right">8.</div></td>
		<td><b>Six monthly period (SMP)</b></td>
		<td>:</td>
		<td><?php echo $val['smp'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">9.</div></td>
		<td><b>Revised Scale of Pay w.e.f 1-1-2006</b></td>
		<td>:</td>
		<td><?php $pay_scale_details=getPayScale(array('id'=>$val['revised_scale_pay']));
		       $psd = $pay_scale_details[0];
		       echo $psd['grade']."-".$psd['pay_scale'];
		?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">10.</div></td>
		<td><b>Last pay in Pay Band+Gd.Pay</b></td>
		<td>:</td>
		<td><?php echo $val['last_pay'].'+'.$val['grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">11.</div></td>
		<td><b>Average emouluments</b></td>
		<td>:</td>
		<td><?php echo $val['average_emolument'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">12.</div></td>
		<td><b>Amount of Pension/Family Pension<br>
		    Sanctioned in pre-revised scale f pay
		</b></td>
		<td>:</td>
		<td><?php echo $val['amount_of_pension_pre_revised'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">13.</div></td>
		<td><b>50% of AE in Revised Pay</b></td>
		<td>:</td>
		<td><?php echo $val['fifty_of_ae'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">14.</div></td>
		<td><b>50% of Last Pay</b></td>
		<td>:</td>
		<td><?php echo $val['fifty_of_last_pay'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right">15.</div></td>
		<td><b>50% of minimum of pay in pay Band<br>
		plus Grade Pay</b></td>
		<td>:</td>
		<td><?php echo $val['fifty_of_pay_band_plus_grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right">16.</div></td>
		<td><b>Life Time Arrear Pension<br></b></td>
		<td>:</td>
		<td><?php if($val['dod']==0){echo "N/A";}else{echo $life_time_arrear.'--'.$return;} ?>
		</td>
	</tr>
	<tr>
		<td><div align="right">17.</div></td>
		<td><b>Amount of pension/family pension<br>
		 	sanctioned(Whichever is highest at 12,13 & 14</b>
		</td>
		<td>:</td>
		<td><?php echo $val['revised_amount_of_pension'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right">18.</div></td>
		<td><b>Amount of revised D.C.R.G</b></td>
		<td>:</td>
		<td><?php echo $val['revised_dcrg'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right">19.</div></td>
		<td><b>Amount of Revised Family Pension<br>
		  a)Enhanced rate of Family Pension<br>
		  b)Ordinary rate of Family Pension<br>
		   (30% of last pay in PB+Grade Pay)</b></td>
		<td></td>
		<td><?php echo '<br>'.$val['revised_enhance_rate'].'<br>'.$val['revised_ordinary_rate']?>
		</td>
	</tr>
    <tr>
		<td><div align="right">20.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php echo ($val['revised_cop']==0)? "N/A" :$val['revised_cop'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right">21.</div></td>
		<td><b>Reduced Pension after Commutation</b></td>
		<td>:</td>
		<td><?php echo $val['revised_reduced_pension'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">22.</div></td>
		<td><b>Name of Family Pensioner</b></td>
		<td>:</td>
		<td>
			<?php echo getNameOfLegalHeir($val['family_info']); ?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">23.</div></td>
		<td><b>Name of Treasury/Sub-Treasury</b></td>
		<td>:</td>
		<td><?php echo $val['treasury'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">24.</div></td>
		<td><b>Pension be enhanced</b></td>
		<td>:</td>
		<td><?php echo $val['treasury'];?>
		</td>
	</tr>
		<tr>
		<td ><div align="right">25.</div></td>
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






































































