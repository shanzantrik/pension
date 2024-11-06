<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php
	$val = $getDetails_revision[0];
	//print_r($val);
    $dor = $val['dor'];
    if(count(getNameOfLegalHeir($val['family_info']))==1){

    	///in service book entry there is mrs thts y it is replace to Smti.it should be correct in service book entry form
    $spouse=explode('-',getNameOfLegalHeir($val['family_info']));
    $spouse2ndpart=$spouse[1];
    $spouse_type=explode('(',$spouse2ndpart);
    $spouse_type=$spouse_type[0];
   // print($spouse_type);
    $spouse=$spouse[0];



     $spouse_salutation=explode(' ',$spouse);
     $spouse=str_replace("mrs","Smti",$spouse);
   

}else{

$spouse=getNameOfLegalHeir($val['family_info']);
$spouse_type="";
}




	$ppo_no = $val['case_no']."/".$val['ppo_no'];
    $gpo_no = "Pen/AP/GPO/".$val['gpo_no'];
    $cpo_no = "Pen/AP/COM/".$val['cpo_no'];

	$life_time_arrear=$val['revised_amount_of_pension'];
	$from = new DateTime($val['dor']);
	$from->modify('+1 day');
	$life_time_from_upto= " <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";


    if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){
    $enhan_from= new DateTime($val['dod']);
	$enhan_from->modify('+1 day');
    
	$enhan_upto= new DateTime($val['dod']);
	$enhan_upto->modify('+7 year');
    //print_r("death b4 retirement");
    $enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
    //print_r($enhance_from_upto);
	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to 31-03-2005"."</b>";
	$ae="N/A";
	$fifty_of_ae="N/A";
	$life_time_from_upto="N/A";
	$revised_amount_of_pension="N/A";
    }else if($val['dor']!="0000-00-00" && $val['dod']=="0000-00-00"){
    //print_r("only retirement");
    $enhance_from_upto="";
    $ordinary_from="";
    $ordinary_from_upto="";
    $ae=$val['average_emolument'];
	$fifty_of_ae=$val['fifty_of_ae'];
	$life_time_from_upto="N/A";
	$revised_amount_of_pension=$val['revised_amount_of_pension'];

    }else if($val['dor']!="0000-00-00" && $val['dod']!="0000-00-00"){
    print_r("death after retirement");
    $enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage"."</b>";
	$ae=$val['average_emolument'];
	$fifty_of_ae=$val['fifty_of_ae'];
	$life_time_from_upto=$val['revised_amount_of_pension']." <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";
    $revised_amount_of_pension=$val['revised_amount_of_pension'];

    }
	
	

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




	/*$consolidated_amount = '';
	if($val['dor'] <= '2005-03-31') :
		$consolidated_amount = getConsolidatedPension('bp_without_dp', $dp);
	elseif($dor >= '2005-04-01' && $dor <= '2005-12-31') :
		$consolidated_amount = getConsolidatedPension('bp_with_dp', $dp);
	endif;

	echo $consolidated_amount;*/




?>

<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
        <u><strong>Calculation of Revision of 
        <?php echo nbs(2); if($val['dod']=="0000-00-00"){echo "Pension";}else{echo "Family Pension";} ?>
        Post 1-1-96
        <?php
       // if($val['dor']=="0000-00-00"){
          //if('01-03-2009'>$val['dod'] && $val['dod']>'1-1-2006'){echo "Post 1-1-2006";}else{echo "";}
         //}else{
         	//if('01-03-2009'>$val['dor'] && $val['dor']>'1-1-2006'){echo "Post 1-1-2006";}else{echo "";}
         //} 
        	/*$dor = explode("-", dateTimeToDate($val['dor']));
        	if($dor[0] >= '1996' && $dor[0] <= '2005') :
				echo '1-1-1996';
			else :
				echo '1-1-2006';
	    	endif;
*/	    ?>
        <br>
         <!--On upgradation of--> <?php //if($val['revision_type']=='acp'){echo "ACP";}else if($val['revision_type']=='macp'){echo "MACP";}else if($val['revision_type']=='Additional_increament'){echo "Additional Increament";}else if($val['revision_type']=='refixation_of_pay'){echo "Refixation of pay";}?>
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
		<td width="50%"><b>Name of Pensioner</b></td>
		<td width="1%">:</td>
		<td width="50%"><?php if($val['dod']=="0000-00-00"){echo "Shri";}else{echo "Late";}?>
       <?php echo $val['name'];?></td>
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
		<td><?php echo dateTimeToDate($val['doe']);?></td>
	</tr>
	<tr>
		<td><div align="right">4.</div></td>
		<td><b>Date of <?php if($val['dor']=="0000-00-00" || $val['dor']== ''){ echo "Death";}else{echo "Retirement";}?></b></td>
		<td>:</td>
		<td>
		 <?php //print_r($val['dod']) ?>
			<?php if($val['dor']!="0000-00-00"){?>
			<?php
		    echo dateTimeToDate($val['dor']);
			if($val['dod'] != "0000-00-00" && $val['dod'] !='') {
		    echo "<span style='font-size:12px; color: red;font-weight: bold;'>(On expired ".$val['dod'].")</span>";
				}
			}else{
				echo $val['dod'];
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
		<td><b>Age at <?php if($val['dor']=="0000-00-00" || $val['dor']== ''){ echo "Death";}else{echo "Retirement";}?></b></td>
		<td>:</td>
		<td><?php echo "57 years 7 month 4 days";
		//if($val['dor']=="0000-00-00"){echo calculateDateDifference($val['dob'], $val['dod'],true);}else{echo calculateDateDifference($val['dob'], $val['dor'],true);} ?></td>
		
	</tr>
		<tr>
		<td ><div align="right">6.</div></td>
		<td><b>Net qualifying Service</b></td>
		<td>:</td>
		<td><?php //echo $val['net_qualifying_service'];?>
			<?php list($year, $month, $day) = explode("-", $val['net_qualifying_service']); ?>
			<?php echo $year." years ".$month." months ".$day." days"; ?>
			<?php //echo calculateDateDifference($val['doj'], $val['dod'],true);?>
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
		<td><b>Revised Scale of Pay w.e.f 1-1-1996</b></td>
		<td>:</td>
		<td><?php $pay_scale_details=getPayScale(array('id'=>$val['revised_scale_pay']));
		       $psd = $pay_scale_details[0];
		       echo $psd['grade']."-".$psd['pay_scale'];
		?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">9.</div></td>
		<td><b>Last pay</b></td>
		<td>:</td>
		<td><?php echo $val['last_pay']+$val['grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">10.</div></td>
		<td><b>Average emouluments</b></td>
		<td>:</td>
		<td><?php echo $ae;
		//if($val['dod']=="0000-00-00"){echo $val['average_emolument'];}else{echo "N/A";}?>
		</td>
	</tr>
	<tr>
		<td valign="top"><div align="right">11.</div></td>
		<td><b>Amount of  <?php if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){ echo "Family Pension "; }else{ echo "Pension ";} ?> Sanctioned<br>
		     in pre-revised scale of pay.
		</b></td>
		<td>:</td>
		<td><?php echo $val['amount_of_pension_pre_revised'];?>
		</td>
	</tr>
	
	<tr>
		<td ><div align="right">12.</div></td>
		<td><b>Life Time Arrear Pension<br></b></td>
		<td>:</td>
		<td><?php echo $life_time_from_upto;//if($val['dod']==0){echo "N/A";}else{echo $life_time_arrear.'--'.$life_time_from_upto;}?>
		</td>
	</tr>
	<tr>
		<td valign="top"><div align="right">13.</div></td>
		<td><b>Amount of <?php if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){ echo "Family Pension "; }else{ echo "Pension ";} ?> to be <br>
		 revised(min 50% of Rs.1,275)</b></td>
		<td>:</td>
		<td><?php echo $revised_amount_of_pension;?>
		</td>
	</tr>
	<!-- <tr>
		<td ><div align="right">17.</div></td>
		<td><b>Amount of pre-revised-Amount of revised D.C.R.G</b></td>
		<td>:</td>
		<?php //$total=$val['revised_dcrg']-$val['prerevised_dcrg'];?>
		<td><?php echo $val['revised_dcrg'];?>-<?php echo $val['prerevised_dcrg'];?>=<?php echo $val['total_payable'];?>
		</td>
	</tr> -->
	<tr>
		<td ><div align="right">14.</div></td>
		<td><b> i) Amount of revised D.C.R.G</b></td>
		<td>:</td>
		<td><?php echo $val['revised_dcrg'];?></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td style="border-bottom: 2px dotted;"><b> ii)Gratuity already drawn</b></td>
		<td>:</td>
		<td><b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 4px;"><?php echo $val['prerevised_dcrg'];?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td align="center"><b> To be Paid</b></td>
		<td>:</td>
		<td><?php echo $val['total_payable'];?></td>
	</tr>
	<tr>
		<td valign="top"><div align="right">15.</div></td>
		<td><b>Amount of Revised Family Pension<br>
		  a) Enhanced rate of Family Pension<br>
		  b) Ordinary rate of Family Pension<br>
		   &nbsp;&nbsp;&nbsp;&nbsp;(30% of last pay)</b></td>
		<td>:</td>

		<td><br><?php echo "N/A";
		//echo $val['revised_enhance_rate'];if($val['dod']=="0000-00-00"){echo "";}else{echo "&nbsp;".$enhance_from_upto;}?><br><?php echo $val['revised_ordinary_rate'];if($val['dod']=="0000-00-00"){echo "";}else{echo "&nbsp;".$ordinary_from_upto;}
		?>

		</td>
	</tr>
		<?php //if(($val['dod']=="0000-00-00" && $val['dor']!="0000-00-00") || ($val['dor']!="0000-00-00" && $val['dod']>$val['dor'])){
       if($val['dod']=="0000-00-00" && $val['dor']!="0000-00-00"){
	 if($val['re_com_applied']=="1" && $val['com_applied']=="1"){?>
    <tr>
		<td ><div align="right">16.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php echo $val['revised_cop'];?>
		</td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td style="border-bottom: 2px dotted;"><b> ii)Commutation already drawn</b></td>
		<td>:</td>
		<td><b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 4px;"><?php echo $val['pre_revised_cop'];?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td align="center"><b> To be Paid</b></td>
		<td>:</td>
		<td><?php echo $val['revised_cop']-$val['pre_revised_cop'];?></td>
	</tr>

	<?php }else if($val['re_com_applied']=="0" && $val['com_applied']=="1"){//Commutation not applied in revision?>
		 <tr>
		<td ><div align="right">16.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php echo "Not Applied";?>
		</td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td style="border-bottom: 2px dotted;"><b> ii)Commutation already drawn</b></td>
		<td>:</td>
		<td><b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 4px;"><?php echo $val['pre_revised_cop'];?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td align="center"><b> To be Paid</b></td>
		<td>:</td>
		<td><?php echo "0";?></td>
	</tr>	<?php }else if($val['re_com_applied']=="0" && $val['com_applied']=="0"){?>
		<tr>
		<td ><div align="right">19.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php echo "N/A";?>
		</td>
	</tr>


	<?php }
	}else{ ?>
	 <tr>
		<td ><div align="right">16.</div></td>
		<td><b>Revised Commutation of Pension</b></td>
		<td>:</td>
		<td><?php echo "N/A";?>
		</td>
	</tr>
<?php }?>
	
	<tr>
		<td ><div align="right">20.</div></td>
		<td><b>Reduced Pension after Commutation</b></td>
		<td>:</td>
		<td><?php if($val['dod']=="0000-00-00" && $val['dor']!="0000-00-00"){

			if($val['re_com_applied']=="1" && $val['com_applied']=="1"){
			echo $val['revised_reduced_pension'];
            }else if($val['re_com_applied']=="0" && $val['com_applied']=="0"){
             echo "N/A";
            }else  if($val['re_com_applied']=="0" && $val['com_applied']=="1"){
            echo $val['revised_reduced_pension'];
            }
		}else{
				echo "N/A";}
		//if(($val['dod']=="0000-00-00" && $val['dor']!="0000-00-00") || ($val['dor']!="0000-00-00" && $val['dod']>$val['dor']) ){echo $val['revised_reduced_pension'];}else{echo "N/A";}?>
		</td>
	</tr>
	
	<tr>
		<td ><div align="right">19.</div></td>
		<td><b>i) 50% of DP is admissable w.e.f 01-04-05 to 31-12-05</b></td>
		<td>:</td>
			<?php 
		   if ($val['dod']!=="0000-00-00"){
	         $amtofpnsion=$val['revised_ordinary_rate']; 
		     $halfofpension=($amtofpnsion*50)/100;
		     $dp=round($amtofpnsion+$halfofpension);
	           }else{
	         $amtofpnsion=$val['revised_amount_of_pension'];
		     $halfofpension=($amtofpnsion*50)/100;
		     $dp=round($amtofpnsion+$halfofpension);
	           }
		     
		?>
		<td><?php echo $dp; ?></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td style="border-bottom: 2px dotted;"><b>ii) Consolidated Revised <?php if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){ echo "Family Pension "; }else{ echo "Pension ";} ?>w.e.f 01-01-2006 </b></td>
		<td>:</td>
		<?php

			$consolidated_amount = '';
			if($val['dor'] <= '2005-03-31') :
				$consolidated_amount = getConsolidatedPension('bp_without_dp',$dp);
			elseif($val['dor'] >= '2005-04-01' && $val['dor'] <= '2005-12-31') :
				$consolidated_amount = getConsolidatedPension('bp_with_dp', $dp);
			endif;
		?>
		<td><b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 4px;"><?php echo $consolidated_amount  .''." untill her death or remarriage";?></b></td>
	</tr>

	<tr>
		<td ><div align="right">20.</div></td>
		<td><b>Name of Family Pensioner</b></td>
		<td>:</td>
		<td>
			<?php echo $spouse.''.$spouse_type;
			//getNameOfLegalHeir($val['family_info']);?>
			<?php echo getDOBofSpouse($val['family_info']); ?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">21.</div></td>
		<td><b>Name of Treasury/Sub-Treasury</b></td>
		<td>:</td>
		<td><?php echo $val['treasury'];?></td>
	</tr>
	<tr>
		<td ><div align="right">22.</div></td>
		<td><b>Pension be enhanced as attaining the age of ..</b></td>
		<td>:</td>
		<td><?php echo ""//echo $val['pension_enhanced'];?></td>
	</tr>

	<?php
	           if ($val['dod']!=="0000-00-00"){
	           	$dob=getDOBofSpouse($val['family_info']);
	           	$dob 	= new DateTime($dob);
	           }else{
	           	$dob 	= new DateTime($val['dob']);
	           }
				//$dob 	= new DateTime($val['dob']);
				$dob1	= date_format($dob,"Y-m-d");
				$dob->modify('+80 year');
				$year80	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year -1 day');
				$year85	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year90	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year95	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				$year100	= date_format($dob,"Y-m-d");
				$dob->modify('+5 year');
				//$year100= date_format($dob,"Y-m-d");
			?>
			<tr>
		<td ><div align="right"></div></td>
				<td colspan="4" style="border:1px solid#000">
					1.W.e.f <?php echo nbs(2).''.$year80;?> to <?php  echo nbs(2).''. $year85; ?>(80 yrs.) 20% increase on  Rs. <?php echo $consolidated_amount;?>= <?php echo  round((20*$consolidated_amount)/100)+$consolidated_amount;?>  <br />
					2.W.e.f <?php $year85plus = new DateTime($year85);
					$year85plus->modify('+1 day');
					$year85plus1 = date_format($year85plus,"Y-m-d");
					echo nbs(2).''.$year85plus1;
					?> to <?php echo nbs(2).''. $year90; ?>(85 yrs.) 30% increase on  Rs. <?php echo $consolidated_amount;?>=<?php echo round((30*$consolidated_amount)/100)+$consolidated_amount;?><br />
					3.W.e.f  <?php $year90plus = new DateTime($year90);
					$year90plus->modify('+1 day');
					$year90plus1 = date_format($year90plus,"Y-m-d");
					echo nbs(2).''.$year90plus1;
					?> to <?php echo nbs(2).''. $year95; ?>(90 yrs.) 40% increase on  Rs. <?php echo $consolidated_amount;?>= <?php echo round((40*$consolidated_amount)/100)+$consolidated_amount;?><br />
                    4.W.e.f <?php $year95plus = new DateTime($year95);
					$year95plus->modify('+1 day');
					$year95plus1 = date_format($year95plus,"Y-m-d");
					echo nbs(2).''.$year95plus1;
					?> to <?php echo nbs(2).''. $year100;?>(95 yrs.) 50% increase on  Rs. <?php echo $consolidated_amount; ?>= <?php echo round((50*$consolidated_amount)/100)+$consolidated_amount; ?><br />
                    5.W.e.f <?php $year100plus = new DateTime($year100);
					$year100plus->modify('+1 day');
					$year100plus1 = date_format($year100plus,"Y-m-d");
					echo nbs(2).''. $year100plus1;?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $consolidated_amount; ?>= <?php echo round((100*$consolidated_amount)/100)+$consolidated_amount; ?><br />
		</tr>
		<tr>
		<td ><div align="right">24.</div></td>
		<td><b>Recovery:-</b></td>
		
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






































































