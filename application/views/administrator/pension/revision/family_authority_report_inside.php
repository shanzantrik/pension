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

   // print_r($spouse);


     $spouse_salutation=explode(' ',$spouse);
     $spouse=str_replace("mrs","Smti",$spouse);
     //print_r($spouse);
   

}else{

$spouse=getNameOfLegalHeir($val['family_info']);
$spouse_type="";
}
//print_r($val);
$address_after_retirement=str_replace(",", ",<br/>", $pensioner_details->address_after_retirement);

$office_address=str_replace(",",",</br>",$pensioner_details->office_address);
$ac_withoutstr=($val['treasury_officer']!='') ?$val['treasury_officer']:getNameOfAccountantGeneral($val['name_of_accountant_general']);
//$ac_withstr = ($val['treasury_officer']!='') ? str_replace(", ", ",<br />", $val['treasury_officer']): str_replace(", ", ",<br />",getNameOfAccountantGeneral($val['name_of_accountant_general']));
$ac_withstr = ($val['treasury_officer']!='') ? str_replace(", ", ",<br />",getTreasury($val['treasury_officer'])): str_replace(", ", ",<br />",getNameOfAccountantGeneral($val['name_of_accountant_general']));


//print_r($ac);
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

    $enhance_from_upto="<b>".$enhan_from->format('Y-m-d')." upto ".$enhan_upto->format('Y-m-d')."</b>";
    $ordinary_from=$enhan_upto->modify('+1 day');
    $ordinary_from_upto="<b> ".$ordinary_from->format('Y-m-d')." to untill her Death or remarriage whichever is earlier"."</b>";
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
    
?>

<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
    <div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
        <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:18px;line-height: 26px;">
            <u><strong>OFFICE OF THE</strong></br>
                <strong>DIRECTOR OF AUDIT AND PENSION </strong></br>
                <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
                <strong>NAHARLAGUN</strong>
            </u>
        </div>
        <table width="100%" border="0" align="center" cellpadding="2" id="report">
            <tr>
                <td colspan="2" align="justify"><div align="left">No.<?php echo $val['case_no'];?></div></td>
                
                <td><div align="right"><b>Dated Naharlagun the <?php echo date('d/m/Y'); ?></b></div></td>
            </tr>
            <tr>
                <td colspan="3"><div align="left">To,</div></td>
            </tr>
            <tr style="height:40px;">
                
                <td colspan="3"><div align="left" style="padding-left:40px"><b><?php echo $ac_withstr;?></b><br></div></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3"></div></td>
            </tr>
            <tr>
                <td colspan="3">Sub-<?php echo nbs(5);?>Revised authority of Family Pension of <b><?php echo nbs(1);?><?php echo $spouse.'('.$spouse_type; ?>)</b><?php echo nbs(2);?>holder of P.P.O No.<?php echo nbs(2)?><b><?php echo $ppo_no;?></b></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
           
            <tr>
                <td colspan="3"><div align="left">Sir,</div></td>
            </tr>
            <tr></tr>
            <tr style="height:40px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(10);?>It is to state that the P.P.O NO.<b><?php echo nbs(2)?><?php echo $ppo_no;?></b>  issued in favour of <b><?php echo nbs(1);?><?php echo $spouse.'('.$spouse_type;?>)</b><?php echo nbs(1);?>of W/o <b>Late<?php echo nbs(1).''. $val['name'];?></b><?php echo nbs(2);?>was forwarded to you vide this office letter No.<b>Pen/AP/<?php echo $val['pension_enhanced'];?> dated <?php echo date('d/m/Y'); ?></b> Consequent on revision of pay of 6th CPC,the pensionery benefit in respect of<b><?php echo nbs(1);?><?php echo $spouse.'('.$spouse_type; ?>)</b> is now worked out as under:-</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;">i)<?php echo nbs(5);?>Revised enhanced rate of family pension  at the rate of Rs.<b><?php echo $val['revised_enhance_rate'];?>/-(Rupees <?php echo no_to_words($val['revised_enhance_rate']);?>only)</b> w.e.f <b><?php echo $enhance_from_upto;?></b> and therafter normal rate of family pension Rs.<b><?php echo $val['revised_ordinary_rate'];?>/-(Rupees <?php echo no_to_words($val['revised_ordinary_rate']);?>only)</b>w.e.f.<b><?php echo nbs(1)?><?php echo $ordinary_from_upto;?></b></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;" style="line-height: 1.7em;">ii)<?php echo nbs(6);?>Revised death gratuity of Rs.<b><?php echo $val['revised_dcrg'];?>/-(Rupees <?php echo no_to_words($val['revised_dcrg']);?>only)</b>.Death Gratuity already drawn Rs.<b><?php echo $val['prerevised_dcrg'];?>/-(Rupees <?php echo no_to_words($val['prerevised_dcrg']);?>only)</b> under GPO No.<b><?php echo nbs(1);?><?php echo $gpo_no;?></b> Hence the balance amount of Rs.<b><?php echo $val['total_payable'];?>/-(Rupees <?php echo no_to_words($val['total_payable']);?>only)</b> may be paid now.</td>
            </tr>
            <tr style="height:10px;">
                <td colspan="3" align="justify"></td>
            </tr>

            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
             <tr style="height:20px;">
                <td colspan="3" align="justify">The quantum of pension/Family pension available to the old pensioner/Family pensioner shall be increased as follows:-</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>
                <?php
               if ($val['dod']!=="0000-00-00"){
                $dob=getDOBofSpouse($val['family_info']);
                $dob    = new DateTime($dob);
               }else{
                $dob    = new DateTime($val['dob']);
               }
                //$dob  = new DateTime($val['dob']);
                $dob1   = date_format($dob,"Y-m-d");
                $dob->modify('+80 year');
                $year80 = date_format($dob,"Y-m-d");
                $dob->modify('+5 year -1 day');
                $year85 = date_format($dob,"Y-m-d");
                $dob->modify('+5 year');
                $year90 = date_format($dob,"Y-m-d");
                $dob->modify('+5 year');
                $year95 = date_format($dob,"Y-m-d");
                $dob->modify('+5 year');
                $year100    = date_format($dob,"Y-m-d");
                $dob->modify('+5 year');
                //$year100= date_format($dob,"Y-m-d");
            ?>
            <?php 
            $pension_amount=$val['revised_amount_of_pension'];
            ?>

            <tr>
        
                <td colspan="3" style="border:1px solid#000">
                    1.W.e.f <?php echo nbs(2).''.$year80;?> to <?php  echo nbs(2).''. $year85; ?>(80 yrs.) 20% increase on  Rs. <?php echo $pension_amount;?>= <?php echo  round((20*$pension_amount)/100)+$pension_amount;?>  <br />
                    2.W.e.f <?php $year85plus = new DateTime($year85);
                    $year85plus->modify('+1 day');
                    $year85plus1 = date_format($year85plus,"Y-m-d");
                    echo nbs(2).''.$year85plus1;
                    ?> to <?php echo nbs(2).''. $year90; ?>(85 yrs.) 30% increase on  Rs. <?php echo $pension_amount;?>=<?php echo round((30*$pension_amount)/100)+$pension_amount;?><br />
                    3.W.e.f  <?php $year90plus = new DateTime($year90);
                    $year90plus->modify('+1 day');
                    $year90plus1 = date_format($year90plus,"Y-m-d");
                    echo nbs(2).''.$year90plus1;
                    ?> to <?php echo nbs(2).''. $year95; ?>(90 yrs.) 40% increase on  Rs. <?php echo $pension_amount;?>= <?php echo round((40*$pension_amount)/100)+$pension_amount;?><br />
                    4.W.e.f <?php $year95plus = new DateTime($year95);
                    $year95plus->modify('+1 day');
                    $year95plus1 = date_format($year95plus,"Y-m-d");
                    echo nbs(2).''.$year95plus1;
                    ?> to <?php echo nbs(2).''. $year100;?>(95 yrs.) 50% increase on  Rs. <?php echo $pension_amount; ?>= <?php echo round((50*$pension_amount)/100)+$pension_amount; ?><br />
                    5.W.e.f <?php $year100plus = new DateTime($year100);
                    $year100plus->modify('+1 day');
                    $year100plus1 = date_format($year100plus,"Y-m-d");
                    echo nbs(2).''. $year100plus1;?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pension_amount; ?>= <?php echo round((100*$pension_amount)/100)+$pension_amount; ?><br />
        </tr>
         <tr style="height:20px;">
                <td colspan="3"></td>
         </tr>
          <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>In view of the above,I am directed to authorise you for making payment of revised family pension,revised gratuity of<b><?php echo nbs(1);?><?php echo $spouse.'('.$spouse_type; ?>)</b><?php echo nbs(1);?> after keeping a note to this effect in both halves of P.P.O No.<b><?php echo nbs(2)?><?php echo $ppo_no;?></b> under proper attestation and after adjusting all the payments already made.</td>
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
            <!-- <tr>
                <td colspan="3"><div align="right" style="padding-right:40px;">Yours faithfully,</div></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
           
            <tr>
                <td colspan="3">
                    <div style="text-align:right; padding-right:15px; font:Arial, Helvetica, sans-serif; font-size:12px">
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

            <!-- <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2" align="justify"><div align="left">Memo No.<?php echo $val['case_no'];?></div></td>
                
                <td><div align="right"><b>Dated Naharlagun the......</b></div></td>
            </tr>
 -->            <tr style="height:20px;">
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
                <td colspan="3">1.<b><?php echo $spouse;?></b></td>
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
                <td colspan="3">The Service Book of <b>Late<?php echo nbs(1);?><?php echo $val['name'];?></b></br>is sent here with for your record.</td>
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