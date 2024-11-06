<?php 
$val = $getDetails_revision[0];
//print_r("death_but_not_retire");
$address_after_retirement=str_replace(",", ",<br/>", $pensioner_details->address_after_retirement);

$office_address=str_replace(",",",</br>",$pensioner_details->office_address);
$ac_withoutstr=($val['treasury_officer']!='') ?getTreasury($val['treasury_officer']):getNameOfAccountantGeneral($val['name_of_accountant_general']);
$ac_withstr = ($val['treasury_officer']!='') ? str_replace(", ", ",<br />",getTreasury($val['treasury_officer'])): str_replace(", ", ",<br />",getNameOfAccountantGeneral($val['name_of_accountant_general']));
$sub_to=($val['treasury_officer']!='')?$val['treasury_officer']:$val['sub_to'];
//print_r($ac);
$ppo_no = $val['case_no']."/".$val['ppo_no'];
$gpo_no = "Pen/AP/GPO/".$val['gpo_no'];
$cpo_no = "Pen/AP/COM/".$val['cpo_no'];

$wef = new DateTime($val['dor']);
$wef->modify('+1 day');

$commuted_value_revised=($val['revised_amount_of_pension']*40)/100;
$commuted_value_prerevised=($val['amount_of_pension_pre_revised']*40)/100;
$commutation_differ=$val['revised_cop']-$val['pre_revised_cop'];
if(!$val['name_of_accountant_general']==''){
$name_ag=getNameOfAccountantGeneral($val['name_of_accountant_general']);
}


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
//$wef->format('Y-m-d');
?>

<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
    <div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
        <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px">
            <u><strong>OFFICE OF THE</strong></br>
                <strong>DIRECTOR OF AUDIT AND PENSION </strong></br>
                <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
                <strong>NAHARLAGUN</strong>
            </u>
        </div>
        <table width="95%" border="0" align="center" cellpadding="2" id="report">
            <tr>
                <td colspan="2" align="justify"><div align="left">No.<?php echo $val['case_no'];?></div></td>
                
                <td><div align="right"><b>Dated Naharlagun the<?php echo date('y/m/d')?></b></div></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3"><div align="left">To,</div></td>
            </tr>
            <tr style="height:40px;">
                
                <td colspan="3"><div align="left" style="padding-left:40px"><?php echo $ac_withstr;?><br></div></td>
            </tr>
            <tr style="height:30px;">
                <td colspan="3"></div></td>
            </tr>
            <tr>
                <td colspan="3">Sub-<?php echo nbs(5);?>Revised authority on pension of <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b><?php echo nbs(2);?>holder of P.P.O No.<?php echo nbs(2)?><?php echo $ppo_no;?></b></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
           
            <tr>
                <td colspan="3"><div align="left">Sir,</div></td>
            </tr>
            <tr></tr>
            <tr style="height:40px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(10);?>It is to state that the P.P.O NO.<b><?php echo nbs(2)?><?php echo $ppo_no;?></b> issued in favour of <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b><?php echo nbs(1);?>Authorizing Superannuation Pension/Retiring pension w.e.f <b><?php echo $wef->format('Y-m-d');?></b><?php echo nbs(2);?>was forwarded to you vide this office letter No.<b>Pen/AP/<?php echo $val['pension_enhanced'];?> dated <?php echo date('d/m/Y'); ?></b> Consequent on revision of pay of 6th CPC,the pensionery benefit in respect of <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b> is now worked out as under:-</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
            <tr style="height:40px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;">i)<?php echo nbs(5);?>Revised Superannuation/Retiring pension at the rate of Rs.<b><?php echo $val['revised_amount_of_pension'];?>/-(Rupees  <?php echo no_to_words($val['revised_amount_of_pension']);?>only)</b> P.M plus D.R & MA w.e.f <b><?php echo $wef->format('Y-m-d');?></b> after adjusting the Pension,Dearness pension,DR and MA already paid vide P.P.O No.<b><?php echo nbs(2)?><?php echo $ppo_no;?></b></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>
            <tr style="height:20px;">
                <?php $attained_age = ($val['designation'] == "Teacher" || $val['designation'] == "MTF(group D)") ? '67' : '65';?>
                <td colspan="3" align="justify" style="line-height: 1.7em;" style="line-height: 1.7em;">ii)<?php echo nbs(6);?>In the event of death of the pensioner,revised family pension at enhance rate of Rs.<b><?php echo $val['revised_enhance_rate'];?>/-(Rupees  <?php echo no_to_words($val['revised_enhance_rate']);?>only)</b> PM plus DR & MA for a period of 7 years or till the pensioner would have attained the age of <?php echo $attained_age;?> yrs,had he been survived whichever is earlier,and thereafter family pension at the rate of Rs.<b><?php echo $val['revised_ordinary_rate'];?>/-(Rupees  <?php echo no_to_words($val['revised_ordinary_rate']);?>only)</b> at normal rate is admissible to <b><?php echo $spouse.' ('.$spouse_type;?>).</b></td>
            </tr>
            <tr style="height:10px;">
                <td colspan="3" align="justify"></td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;">iii) <?php echo nbs(2);?>Revised gratuity RS.<b><?php echo $val['revised_dcrg'];?>/-(Rupees  <?php echo no_to_words($val['revised_dcrg']);?>only)</b> only is sanctioned now.The gratuity already drawn is Rs.<b><?php echo $val['prerevised_dcrg'];?>/-(Rupees  <?php echo no_to_words($val['prerevised_dcrg']);?>only)</b> only under GPO No.<b><?php echo $gpo_no;?></b>.Hence net amount of Rs.<b><?php echo $val['total_payable'];?>/-(Rupees <?php echo no_to_words($val['total_payable']);?>only) may be paid now.</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3"></td>
            </tr>
             <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;">iv)<?php echo nbs(2);?>Revised commutation of pension of Rs.<b><?php echo $val['revised_cop'];?>/-(Rupees  <?php echo no_to_words($val['revised_cop']);?>only)</b> being revised commuted value of Rs.<b><?php echo $commuted_value_revised; ?>/-(Rupees  <?php echo no_to_words($commuted_value_revised);?>only)</b> out of his revised pension of Rs.<b><?php echo $val['revised_amount_of_pension'];?>/-(Rupees  <?php echo no_to_words($val['revised_amount_of_pension']);?>only)</b> is sanctioned now.The commuted value of pension of Rs.<b><?php echo $commuted_value_prerevised;?>/-(Rupees <?php echo no_to_words($commuted_value_prerevised);?>only)</b> already authorization earlier vide No.<b><?php echo $cpo_no;?></b> and hence difference of commutation of pension of Rs.<b><?php echo $commutation_differ;?>/-(Rupees <?php echo no_to_words($commutation_differ);?>only)</b> is now authorized for payment .Consequent on revised commutation,the reduce pension of Rs.<b><?php echo $val['revised_reduced_pension'];?>/-(Rupees <?php echo no_to_words($val['revised_reduced_pension']);?>only)</b> PM plus D.R & M.A may be paid to <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b>.</td>
            </tr>
            <tr style="height:300px;">
                <td colspan="3"></td>
            </tr>

            <tr>
                <td colspan="2" align="justify"><div align="left"></div></td>
                
                <td><div align="right"><b>Cont Page 2</b></div></td>
            </tr>
            <tr style="height:200px;">
                <td colspan="3"></td>
            </tr>

            <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>In view of the above,I am to request you to advice the Treasury  Officer <?php echo $sub_to;?> for making payment of revised pension,revised gratuity and revised commutation of pension to <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b> after keeping a note to this effect in both halves of P.P.O No.<b><?php echo nbs(2)?><?php echo $ppo_no;?></b> under proper attestation and after adjusting all the payments already made.</td>
            </tr>
            <tr style="height:20px;">
                <td colspan="3" align="justify"></td>
            </tr>
             <tr style="height:20px;">
                <td colspan="3" align="justify" style="line-height: 1.7em;"><?php echo nbs(15);?>The amount is debitable to the Head of Accounts "2071"-pension & ORB.</td>
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
            </tr> -->
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
                <td colspan="3">1.<b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b></td>
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
                <td colspan="3">The Service Book of <b><?php echo $val['salutation'];?><?php echo nbs(1);?><?php echo $val['name'];?></b></br>is sent here with for your record.</td>
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