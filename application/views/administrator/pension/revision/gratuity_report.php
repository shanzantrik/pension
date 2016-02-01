<?php 
//echo "OUTSIDE";


/*if(count($pensioner->getNameofSpouse())==1){
    $spouse=explode('-',$pensioner->getNameofSpouse());
    $spouse2ndpart=$spouse[1];
    $spouse_type=explode('(',$spouse2ndpart);
    $spouse_type=$spouse_type[0];
    $spouse=$spouse[0];
}else
{   

    $spouse=$pensioner->getNameofSpouse();
    $spouse_type="";
}
*/
$val = $getDetails_revision[0];
//print_r($val);
////$spouse=getNameOfLegalHeir($val['family_info']);
if(count(getNameOfLegalHeir($val['family_info']))==1){
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
//print_r($val);
$address_after_retirement=str_replace(",", ",<br/>", $pensioner_details->address_after_retirement);

$office_address=str_replace(",",",</br>",$pensioner_details->office_address);
$ac_withoutstr=($val['treasury_officer']!='') ?$val['treasury_officer']:getNameOfAccountantGeneral($val['name_of_accountant_general']);
$ac_withstr = ($val['treasury_officer']!='') ? str_replace(", ", ",<br />", $val['treasury_officer']): str_replace(", ", ",<br />",getNameOfAccountantGeneral($val['name_of_accountant_general']));
$sub_to=($val['treasury_officer']!='')?$val['treasury_officer']:$val['sub_to'];

//print_r($sub_to);
$ppo_no = $val['case_no']."/".$val['ppo_no'];
$gpo_no = "Pen/AP/GPO/".$val['gpo_no'];
$cpo_no = "Pen/AP/COM/".$val['cpo_no'];

$wef = new DateTime($val['dor']);
$wef->modify('+1 day');

$commuted_value_revised=($val['revised_amount_of_pension']*40)/100;
$commuted_value_prerevised=($val['amount_of_pension_pre_revised']*40)/100;
$commutation_differ=$val['revised_cop']-$val['pre_revised_cop'];
$name_ag=getNameOfAccountantGeneral($val['name_of_accountant_general']);

if($val['dor']=="0000-00-00" && $val['dod']!="0000-00-00"){
    //print_r("death b4 retirement");

    $enhan_from= new DateTime($val['dod']);
    $enhan_from->modify('+1 day');
        
    $enhan_upto= new DateTime($val['dod']);
    $enhan_upto->modify('+10 year');

    $enhance_from_upto="<b>from ".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
    $ordinary_from=$enhan_upto->modify('+1 day');
    $ordinary_from_upto="<b>from ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage whichever is earlier"."</b>";
    $ae="N/A";
    $fifty_of_ae="N/A";
    $life_time_from_upto="N/A";
}else if($val['dor']!="0000-00-00" && $val['dod']!="0000-00-00"){
    //death after retirement
    $life_time_arrear=$val['revised_amount_of_pension'];
    $from = new DateTime($val['dor']);
    $from->modify('+1 day');
    //$life_time_from_upto= " <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";

    $enhan_from= new DateTime($val['dod']);
    $enhan_from->modify('+1 day');
        
    $enhan_upto= new DateTime($val['dor']);
    $enhan_upto->modify('+7 year');


    $enhance_from_upto="<b>".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
    $ordinary_from=$enhan_upto->modify('+1 day');
    $ordinary_from_upto="<b>".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage whichever is earlier."."</b>";
    //$ae=$val['average_emolument'];
    $fifty_of_ae=$val['fifty_of_ae'];
    //$life_time_from_upto=$val['revised_amount_of_pension']." <b>from ".$from->format('Y-m-d')." upto ".$val['dod']."</b>";
    $life_time_from_upto="N/A";

}

///only for prerevised_dcrg value
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

<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
    <div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF; padding: 20px;">
        <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:18px; line-height: 26px; margin: 50px 0 30px 0;">
            <u><strong>OFFICE OF THE</strong></br>
                <strong>DIRECTOR OF AUDIT AND PENSION </strong></br>
                <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
                <strong>NAHARLAGUN</strong>
            </u>
        </div>
        <table width="100%" border="0" align="center" cellpadding="2" id="report">
            <tr>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
                <td style="width: 33%"></td>
            </tr>
            <tr>
                <td colspan="2" align="justify"><div align="left">No.<?php echo $val['case_no'];?></div></td>
                <td><div align="right"><b>Dated Naharlagun the <?php echo date('d/m/Y'); ?></b></div></td>
            </tr>

            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>

            <tr>
                <td colspan="3"><div align="left">To,</div></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3"><div align="left" style="padding-left:40px; font-weight: bold;"><?php echo $ac_withstr;?><br></div></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3"></div></td>
            </tr>
            <tr>
                <td colspan="3">Sub-<?php echo nbs(5);?>Revised gratuity in respect of <b><?php echo nbs(1);?><?php echo $val['salutation'].' '.$val['name']; ?></b><?php echo nbs(2);?>holder of P.P.O No.<?php echo nbs(2)?><b><?php echo $ppo_no;?></b></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3"><div align="left">Sir,</div></td>
            </tr>
            <tr></tr>
            <tr style="height:40px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(10);?>It is to inform you that an amount of Rs.<b><?php echo $val['prerevised_dcrg'];?>/-(Rupees <?php echo no_to_words($val['prerevised_dcrg']);?>only) </b>had been sanctioned being <?php if($val['salutation']=="Late"){ echo "death ";}else{echo "retirement ";}?>gratuity to <b><?php echo $val['salutation'].' '.$val['name'];?></b> vide G.P.O No<b><?php echo nbs(1).''. $gpo_no;?> Dated <?php echo dateTimeToDate($val['ppd_created_at']); ?></b> Consequent upon increase of D.A from <b><?php echo $da_incr;?>% to <?php echo $val['revision_da'];?>%</b> revised gratuity come to Rs.<b><?php echo $val['revised_dcrg'];?>/-(Rupees <?php echo no_to_words($val['revised_dcrg']);?>only)</b> .<?php echo nbs(1);?>Hence an amount of Rs.<b><?php echo $val['total_payable'];?>/-(Rupees <?php echo no_to_words($val['total_payable']);?>only)</b> only being residual balance is to be paid now.</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
           
            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>
        <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>In view of above,You are requested to advise the Treasury Officer/Sub Treasury Officer <?php echo $sub_to;?> for making the payment of residual amount of gratuity to <b><?php echo $val['salutation'].' '.$val['name'];?></b>,after keeping a note in this regard in both halves of P.P.O.</td>
         </tr>
         <tr style="height:20px;">
                <td colspan="3"></td>
         </tr>
         <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>The amount is debitable to  the Head of Accounts"2071"-Pension & ORB".</td>
         </tr>
         <tr style="height:20px;">
                <td colspan="3"></td>
         </tr>
          <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>This letter may please be treated as authority.</td>
         </tr>            
         <!-- <tr>
                <td colspan="3"><div align="center" style="padding-right:40px;">Yours faithfully,</div></td>
            </tr>
            <tr style="height:30px;">
                <td colspan="3"></td>
            </tr>
           
            <tr>
                <td colspan="3">
                    <div style="text-align:right; padding-right:15px; font:Arial, Helvetica, sans-serif; font-size:13px">
                        <strong>Director/Joint Director</strong></br>
                        
                    </div>
                </td>
            </tr> -->
            <tr>
                <td colspan="2">&nbsp;</td>
                <td><div align="center">Yours faithfully,</div></td>
            </tr>
            <tr style="height:30px;">
                <td colspan="3"></td>
            </tr>
           
            <tr>
                <td colspan="2">&nbsp;</td>
                <td>
                    <div style="text-align: center; font:Arial, Helvetica, sans-serif; font-size:13px">
                        <strong>Director/Joint Director</strong></br>
                        
                    </div>
                </td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2" align="justify"><div align="left">Memo No.<?php echo $val['case_no'];?></div></td>
                <td><div align="center"><b>Dated Naharlagun the <?php echo date('d/m/Y'); ?></b></div></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3">Copy to:-</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3">1.<b><?php echo $val['salutation'].' '.$val['name'];?></b></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"><b><?php echo $address_after_retirement;?></b></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3">2.<b><?php echo $office_address;?></b></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3">The Service Book of <b><?php echo $val['salutation'].' '.$val['name'];?></b></br>is sent here with for your record.</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <div style="text-align:center; font:Arial, Helvetica, sans-serif; font-size:12px">
                        <strong>Director/Joint Director</strong></br>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>