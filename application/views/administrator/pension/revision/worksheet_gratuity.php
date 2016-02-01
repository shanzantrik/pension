<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php
	$val = $getDetails_revision[0];
	//print_r($val);
    //print_r($val['com_applied']);
    if(count(getNameOfLegalHeir($val['family_info']))==1){

    	///in service book entry there is mrs thts y it is replace to Smti.it should be correct in service book entry form
    $spouse=explode('-',getNameOfLegalHeir($val['family_info']));
    $spouse2ndpart=$spouse[1];
    //print_r($spouse2ndpart);
    $spouse_type=explode('(',$spouse2ndpart);
    $spouse_type=$spouse_type[0];
   // print($spouse_type);
    $spouse=$spouse[0];
    //print_r($spouse[1]);



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

	$enhan_from= new DateTime($val['dod']);
	$enhan_from->modify('+1 day');
        
	$enhan_upto= new DateTime($val['dor']);
	$enhan_upto->modify('+7 year');

    if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){
    //print_r("death b4 retirement");
    $enhan_from= new DateTime($val['dod']);
	$enhan_from->modify('+1 day');
        
	$enhan_upto= new DateTime($val['dod']);
	$enhan_upto->modify('+10 year');

    $enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage"."</b>";
	$ae="N/A";
	$fifty_of_ae="N/A";
	$life_time_from_upto="N/A";
    }else if($val['dor']!="0000-00-00" && $val['dod']=="0000-00-00"){
    //print_r("only retirement");
    $enhance_from_upto="";
    $ordinary_from="";
    $ordinary_from_upto="";
    $ae=$val['average_emolument'];
	$fifty_of_ae=$val['fifty_of_ae'];
	$life_time_from_upto="N/A";

    }else if($val['dor']!="0000-00-00" && $val['dod']!="0000-00-00"){
   // print_r("death after retirement");
    $enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage"."</b>";
	$ae=$val['average_emolument'];
	$fifty_of_ae=$val['fifty_of_ae'];
	//$life_time_from_upto=$val['revised_amount_of_pension']." <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";
    $life_time_from_upto="N/A";
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
?>

<div id="print" style="width:1000px; margin:0px auto;">
	<div style="width: 1000px; min-height: 600px; font-size: 1.2em; color:#000000; background-color: #FFFFFF; line-height: 1.5em">
    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size: 1.3em">
        <u><strong>Revised gratuity on increase rate of DA from <?php echo $da_incr;?>% to <?php echo $val['revision_da'];?>%
        
	    
        <br>
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
		<td width="45%"><b>Name of Pensioner</b></td>
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
		<td><?php echo "58 years 0 month 0 day";
		//if($val['dor']=="0000-00-00"){echo calculateDateDifference($val['dob'], $val['dod'],true);}else{echo calculateDateDifference($val['dob'], $val['dor'],true);} ?></td>
		
	</tr>
		<tr>
		<td ><div align="right">6.</div></td>
		<td><b>Net qualifying Service</b></td>
		<td>:</td>
		<td>
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
		<td><?php echo $val['last_pay'].'+'.$val['grade_pay'];?>=<?php echo $val['last_pay']+$val['grade_pay'];?>
		</td>
	</tr>
	<tr>
		<td ><div align="right">10.</div></td>
		<td><b> a) Revised Gratuity(included <?php echo $val['revision_da'];?>% DA)</b></td>
		<td>:</td>
		<td><?php echo $val['revised_dcrg'];?></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td style="border-bottom: 2px dotted;"><b> b)Gratuity already drawn vide GPO NO.<?php echo $gpo_no.''.nbs(2); ?></br>inclusive <b><?php echo $da_incr;?></b>% DA</b></td>
		<td>:</td>
		<td><b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 27px;"><?php echo $val['prerevised_dcrg'];?></b></td>
	</tr>
	<tr>
		<td><div align="right"></div></td>
		<td align="left"><b>Residual balance amount of gratuity</b></td>
		<td>:</td>
		<td><?php echo $val['total_payable'];?></td>
	</tr>
	<tr>
		<td height="20px"><div align="right"></div></td>
		<td align="left" colspan="3"></td>
		
	</tr>	
	<tr>
		<td><div align="right"></div></td>
		<td align="left" colspan="3"><b>Residual balance amount of revised gratuity is admissible Rs.<?php echo $val['total_payable'];?>/-(Rupees <?php echo no_to_words($val['total_payable']);?>only)</b></td>
		
	</tr>
	
	</table>
</div>
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






































































