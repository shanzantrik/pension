<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	font-size: 14px
}
-->
</style>
<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
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
        <p class="style1">OFFICE OF THE DIRECTORATE OF AUDIT &amp; PENSION<br>
        GOVERNMENT OF ARUNACHAL PRADESH<br>
        NAHARLAGUN</p>
        <hr>
        <table width="100%" border="0">
          <tr>
            <td><div align="left"><span class="style2">No. <?php echo $ppo_no;?></span></div></td>
            <td><div align="right" class="style2">Date: <?php echo date('d/m/Y');?></div></td>
          </tr>
        </table>
        <p align="center">&nbsp;</p>
        <p align="center">Calculation Sheet of revised gratuity on increase rate of DA <?php echo $da_incr;?> %<br>
        to <?php echo $val['revision_da'];?>% w.e.f        </p>
        <p align="center">&nbsp;</p>
    </div>
    

<table width="100%" border="0" cellpadding="2" id="report">
	<tr>
		<td width="7%"><div align="right">1.</div></td>
		<td width="45%"><b>Name and Designation of Pensioner</b></td>
		<td width="1%">:</td>
		<td width="50%"><?php if($val['dod']=="0000-00-00"){echo "Shri";}else{echo "Late";}?>
       <?php echo $val['name'];?>, <?php echo $val['designation'];?></td>
	</tr>
	<tr>
		<td ><div align="right">2.</div></td>
		<td><b>Date Of Appointment</b></td>
		<td>:</td>
		<td><?php echo dateTimeToDate($val['doj']); ?></td>
	</tr>
	<tr>
		<td><div align="right">3.</div></td>
		<td><b>Date of Retirement</b></td>
		<td>:</td>
		<td>
		<?php echo $val['dor'];?></td>
	</tr>
		<tr>
		<td ><div align="right">4.</div></td>
		<td><b>Total qualifying Service</b></td>
		<td>:</td>
		<td>
			<?php list($year, $month, $day) = explode("-", $val['net_qualifying_service']); ?>
			<?php echo $year." years ".$month." months ".$day." days"; ?>
			<?php //echo calculateDateDifference($val['doj'], $val['dod'],true);?>		</td>
	</tr>
	<tr>
	  <td colspan="4"><div align="center">
	    <p>&nbsp;</p>
	    <p><strong>REVISED GRATUITY<br>
	      EMOULMENTS</strong></p>
	    <p>&nbsp;</p>
	  </div></td>
	  </tr>
	<tr>
	  <td>a) i)</td>
	  <td align="left" colspan="3">Last Pay Matrix and Level :</td>
	  </tr>
	<tr>
	  <td><div align="center">ii)</div></td>
	  <td align="left" colspan="3">Last Pay : <?php echo $val['last_pay'];?> </td>
	  </tr>
	<tr>
	  <td><div align="center">iii)</div></td>
	  <td align="left" colspan="3">Gratuity Admissible (with calculation @<b><?php echo $val['revision_da'];?></b> %): <?php echo $val['revised_dcrg'];?></td>
	  </tr>
	<tr>
	  <td>b) </td>
	  <td align="left" colspan="3">Gratuity already authorized vide no<b><?php echo $gpo_no.''.nbs(2); ?></b> (-) Rs.<b style="border-bottom: 2px dotted; font-weight: normal; padding-bottom: 27px;"><?php echo $val['prerevised_dcrg'];?></b></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td align="left" colspan="3">Net Payable: <?php echo $val['total_payable'];?></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td align="left" colspan="3">Residual balance amount of revised gratuity is admissible Rs.<?php echo $val['total_payable'];?>/-(Rupees <?php echo no_to_words($val['total_payable']);?>only)</td>
	  </tr>
	<tr>
	  <td height="166">c)</td>
	  <td align="left" colspan="3">Name of the Treasury :</td>
	  </tr>
	<tr>
	  <td colspan="4"><table width="100%" border="0">
        <tr>
          <td width="35%" height="109">Signature of DA</td>
          <td width="40%">Signature of Supdt.</td>
          <td width="25%">DAP/JDAP</td>
        </tr>
      </table></td>
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

