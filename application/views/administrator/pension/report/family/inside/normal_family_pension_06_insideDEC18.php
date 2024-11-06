<?php $pensioner = $values;
//print_r($pensioner);
//print_r("inside");
$class_of_pension=$pensioner->class_of_pension;
$spouse=explode('-',$pensioner->getNameofSpouse());
$cnt=count($spouse);

if($class_of_pension=="Normal_Family_Pension"){
	$class_of_pension="Family_Pension";
	}
if(count($pensioner->getNameofSpouse())==1) {
	
	
	$spouse=explode('-',$pensioner->getNameofSpouse());
	
	$spouse2ndpart=$spouse[1];
    $spouse_type=explode('(',$spouse2ndpart);
    $spouse_type=$spouse_type[0];
	$spouse=$spouse[0];
	

	 
} else {
	$spouse=$pensioner->getNameofSpouse();
	
	$spouse_type="";
}
//print_r($pensioner->dor.''.$pensioner->dod);
////if($pensioner->dor=="0000-00-00" && $pensioner->dod!="0000-00-00"){
if($pensioner->dor==$pensioner->dod){
	//print_r("death before retirement");
    $enhan_from= new DateTime($pensioner->dod);
	$enhan_from->modify('+1 day');
    
	$enhan_upto= new DateTime($pensioner->dod);
	$enhan_upto->modify('+10 year -2 day');
	
	//seven pay
	$enhan_upto_seven= new DateTime($pensioner->dod);
	$enhan_upto_seven->modify('+10 year');
	//seven
	
    $enhance_from_upt=$pensioner->getEnhanceRate_sanjay(false);
	$x_amount=$pensioner->total_amount;
	
	$date = new DateTime($pensioner->childDOB);
	$now = new DateTime();
	$age = new DateTime();
	$age = $date->diff($now)->format("%y");
	$currentYear=$now->format("Y");
	
    if($cnt=="3"){
    	$return = round($enhance_from_upt*50/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
    }elseif($cnt=="4"){
    	$return = round($enhance_from_upt*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
    }else{

    	$return = round($enhance_from_upt*100/100);
    	//if($age==$currentYear || $age==0)
		if($age>=2018 || $age==0)
		{
			//$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to 31-12-2015</b>";
		}
		elseif($age<25)
		{
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." thereafter no family pension</b>";
		}
		elseif($age>=25)
		{
			//$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." thereafter no family pension</b>";
		}
    }

	
	//seven pay
	if($cnt=="3" && $pensioner->pay_commission==7){
    	$return = round($x_amount*50/100);
		
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }elseif($cnt=="4" && $pensioner->pay_commission==7){
    	$return = round($x_amount*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }elseif($pensioner->pay_commission==7){

    	//$return = round($x_amount*100/100);
		$return = round($x_amount*50/100);
    	
				
		//if($age==$currentYear || $age==0)
		if($age>=2018 || $age==0)
		{
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
		}
		elseif($age<25)
		{
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." thereafter no family pension</b>";
		}
		elseif($age>=25)
		{
			//$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." thereafter no family pension</b>";
		}
    
    }
	
	

	
    //$enhance_from_upto="<b>E/R of Rs.".$enhance_from_upt."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
	
	$ordinary_from=$enhan_upto->modify('+2 day');
	$ordinary_from_upto="<b> ".$ordinary_from->format('d-m-Y')." until his/her remarriage or death"."</b>";
	
	//seven pay
	$ordinary_from_seven=$enhan_upto_seven->modify('+1 day');
	$ordinary_from_upto_seven="<b> ".$ordinary_from_seven->format('d-m-Y')." until his/her remarriage or death"."</b>";
	$ordinary_from_upto_seven_above25="<b> ".$ordinary_from_seven->format('d-m-Y')." until earns livelihood or gets married"."</b>";
	$ordinary_from_upto_seven_below25="<b> ".$ordinary_from_seven->format('d-m-Y')." until he/she attains 25 years or earns livelihood or gets married"."</b>";
	//seven pay
	
	$amount_pension='N/A';
	$total_amount_pension='N/A';
    $cpo_no="N/A";
	$salutation="Late";
	$commuted_value="N/A";
	$life_time_from_upto="";
}else if($pensioner->dor!="0000-00-00" && $pensioner->dod!="0000-00-00"){
    //print_r("death after retirement");
    $enhan_from= new DateTime($pensioner->dod);
	$enhan_from->modify('+1 day');
    
	$enhan_upto= new DateTime($pensioner->dod);
	$enhan_upto->modify('+7 year');
    $cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;
    $amount_pension="<b>Rs.</b>".$pensioner->getAmountofPension()."/-PM".$pensioner->getDRMA();
	$total_amount_pension=$pensioner->total_amount*50/100;
    $salutation=$pensioner->salutation;
    //$enhance_from_upto="<b>from ".$enhan_from->format('d-m-Y')." upto ".$enhan_upto->format('d-m-Y')."</b>";

    $enhan_from= new DateTime($pensioner->dod);
	$enhan_from->modify('+1 day');

	//work on it
	//$enhan_upto= new DateTime($pensioner->dod);
	$enhan_upto= new DateTime($pensioner->dor);
	$enhan_upto->modify('+7 year');
	$enhan_upto->modify('last day of this month');
	$sanjay_enhance=$enhan_upto->format('d-m-Y');

	$dor = new DateTime($pensioner->dor);
	$dor->modify('+1 day');

    $enhance_from_upto="Life time arrear pension Rs ".$pensioner->getEnhanceRate_sanjay(false)."<b> w.e.f. ".$dor->format('d-m-Y')." to ".$pensioner->dod."<b> and thereafter E/R of Rs.".$pensioner->getEnhanceRate_sanjay(false)."/- PM".$pensioner->getDRMA()." w.e.f ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";

	$ordinary_from=$enhan_upto->modify('+1 day');
	$ordinary_from_upto="<b> ".$ordinary_from->format('d-m-Y')." until his/her remarriage or death"."</b>";
	//$life_time_from_upto=$val['revised_amount_of_pension']." <b>from ".$from->format('d-m-Y')." upto ".$val['dod']."</b>";

	//seven pay
	$ordinary_from_seven=$enhan_upto_seven->modify('+1 day');
	$ordinary_from_upto_seven="<b> ".$ordinary_from_seven->format('d-m-Y')." until his/her remarriage or death"."</b>";
	$ordinary_from_upto_seven_above25="<b> ".$ordinary_from_seven->format('d-m-Y')." until earns livelihood or gets married"."</b>";
	$ordinary_from_upto_seven_below25="<b> ".$ordinary_from_seven->format('d-m-Y')." until he/she attains 25 years or earns livelihood or gets married"."</b>";
	//seven pay
	
    $commuted_value=$pensioner->getCommutedValue();
	
}
?>
<?php
	$ppo_no = $pensioner->case_file_no."/".$pensioner->ppo_no;
	$gpo_no = 'Pen/AP/GPO/'.$pensioner->gpo_no;
	//$cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;
	$ac = ($pensioner->treasury_officer!='') ? nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->treasury_name): nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->accountant_general_name);

	if($pensioner->dod > $pensioner->dor || $pensioner->dod == '0000-00-00') :
		$enhance_rate_period = '7';
	elseif($pensioner->dod == $pensioner->dor) :
		$enhance_rate_period = '10';
	endif;

	$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
	$payable = $pensioner->treasury_name.' '.$pensioner->bank_name.' '.$account_no;
	$total_amount=$pensioner->total_amount;

	// $other_info = $pensioner->family_info;
	// if(empty($other_info['spouse_dod'])) {
	// 			if($detail) :
	// 				if(count($other_info) == 1) :
	// 					$return.=$value['spouse_dob']->format('d-m-Y');//." of ".ucfirst($value['relation'])."";
	// 				else :
	// 					$return.=$value['spouse_dob']->format('d-m-Y');//." of ".ucfirst($value['relation'])." (".ordSuffix($main_key)." ".$value['relation'].")";
	// 				endif;
	// 			else :
	// 				array_push($return, $value['spouse_dob']->format('d-m-Y'));
	// 			endif;
	// 		}
	
	$date = new DateTime($pensioner->childDOB);
	$now = new DateTime();
	$age = new DateTime();
	$age = $date->diff($now)->format("%y");
	$currentYear=$now->format("Y");
	
	$Entrydate = new DateTime($pensioner->doj);
	$EntryYear = $Entrydate->format("Y");
?>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1" selected>Report 1(Forwading Letter)</option>
	<option value="form2">GPO</option>
	<?php if($pensioner->com_applied == 1) : ?>
		<option value="form3">CPO</option>
	<?php endif; ?>
	<option value="form4">Audit Enfacement</option>
	<?php if($account_enfacement == "true") : ?>
	    <option value="form5">Account Enfacement</option>
	<?php endif; ?>
    <option value="disburser_disburser_portion">Disburser Portion</option>
	<option value="disburser_pensioner_portion">Pensioner Portion</option>
	<option value="id_card">ID Card</option>
</select>
<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
					<td width="25%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-weight: bold;font-family: initial; margin-left: 200px;">GOVERNMENT OF ARUNACHAL PRADESH<br/>DIRECTORATE OF AUDIT & PENSION<br/><u>NAHARLAGUN</u>.</div>
					    </div>
					</td>
					<td>
						
					</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						No. <?php echo $pensioner->case_file_no; ?><br/>To<br/><b><?php echo $ac; ?></b>
					</td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top; text-align: justify;" colspan="4" align="left"><?php echo nbs(13); ?>The pension payment orders/GPO whose details are given below in favour of &nbsp;<b><?php 
					//echo $spouse.'('.$spouse_type.') ';
					echo $pensioner->getNameOfLegalHeir();
					?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b>&nbsp;are forwarded herewith for payment from your end.</td>
				</tr>	
			 	<tr>
					<td style="vertical-align: top;" colspan="4">
						<pre style="padding: 0px;margin: 0px 0 0 0;font-family: 'Ubuntu', Tahoma, sans-serif; font-size: 1.0em; line-height: 1.5em;background-color: #fff!important;border: none;-webkit-border-radius: none;-moz-border-radius: none;border-radius: none;">
		1. Pension Payment Order No.				:- <b><?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></b>
		2. Category of Pension 						:- <span><?php echo str_replace("_", " ", $class_of_pension); ?></span>
		3.  (a) Adhoc/Temporary increase
		    (b) Amount of basic pension 				:-<b>Rs.<?php if($pensioner->pay_commission==7){ echo  $total_amount*50/100;} else{echo $amount_pension;}?></b>
		    (c) Relief on pension 						:- As per PPO
		    (d) Family Pension in case of death of the Pensioner 	:-<b><?php if($pensioner->pay_commission==7){ echo  $total_amount*50/100;} else{echo $amount_pension;}?></b>
			  i) Enhanced rate 	:- <b>Rs. <?php	//echo $pensioner->getEnhanceRate(); 
						//if($age==$currentYear || $age==0)
						if($age>=2018 || $age==0)
						{
							echo $pensioner->getEnhanceRate(); 
						}
						elseif($age<25)
						{
							echo $pensioner->getEnhanceRate_ForLessThan25Child(); 
						}
						elseif($age>=25)
						{
							//echo $pensioner->getEnhanceRate(); 
							echo 'N/A';
						}
			  ?><!-- <?php if($pensioner->pay_commission==7){ echo ($total_amount*50/100);} else{echo $pensioner->getEnhanceRate_sanjay(false);} ?> from <?php echo $enhan_from->format('d-m-Y')?> upto <?php echo $enhan_upto->format('d-m-Y');//echo $sanjay_enhance;//$enhan_upto->format('d-m-Y');?> -->
			  
			  </b>
						</pre>
					</td>
				</tr>
				<tr>
				<td style="vertical-align: top;" colspan="4" style="text-align:left;"><?php echo nbs(11); ?>For a period of <?php echo $enhance_rate_period; ?> years or upto the date on which the deceased would have attained the age of <?php echo $pensioner->pension_attained_age; ?> years had <?php //echo $pensioner->pensioner_pronoun; ?>he/she survived whichever is less.	
				</td>
				</tr>
				<tr>	
					<td style="vertical-align: top;" colspan="4" style="text-align:left;"><?php echo nbs(11); ?>ii) Ordinary rate :- <b>Rs. <?php 
				
					if($EntryYear>='2008')
					{ echo 'N/A';
					}
					elseif($EntryYear<'2008')
					{
						
					//if($age==$currentYear || $age==0)
					if($age>=2018 || $age==0)
					{
						echo $pensioner->getOrdinaryRate();
							
						?> <b>from</b> <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}
					}
					elseif($age>=25 && $pensioner->consolidated==1)
					{
						echo 'N/A';
					}
					elseif($age>=25 && $pensioner->consolidated==0)
					{
						/*echo $pensioner->getOrdinaryRate();?> <b>from</b> <?php echo $ordinary_from_upto_seven_above25;*/
						echo 'N/A';
					}
					elseif($age<25)
					{
						/*echo $pensioner->getOrdinaryRate();?> <b>from</b> <?php echo $ordinary_from_upto_seven_below25;*/
						echo 'N/A';
					}
					}
			 ?>
					<!-- <?php if($pensioner->pay_commission==7){ echo ($total_amount*30/100);} else{echo $pensioner->getOrdinaryRate();} ?> /- PM<?php echo $pensioner->getDRMA(); ?> (<?php echo trim($ordinary_from_upto); ?>) --></b></td>
				</tr>
				<tr>
					<?php if($pensioner->dod > $pensioner->dor) : ?>
						<td style="vertical-align: top;" colspan="4"><?php echo nbs(5); ?>e) Family pension (in case of death of the Govt. employee)<br/><?php echo nbs(11); ?>i) &nbsp;Enhance rate for a period of <?php echo no_to_words($enhance_rate_period); ?> years<br/><?php echo nbs(11); ?>ii)	Normal rate(on completion of <?php echo no_to_words($enhance_rate_period); ?> years)<br/><br /><?php echo nbs(14); ?>Date of commencement of pension :- <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
					<?php elseif($pensioner->dod == $pensioner->dor) : ?>
						<td style="vertical-align: top;" colspan="4"><?php echo nbs(14); ?>Date of commencement of pension :- <b><?php 
						//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
						//if($age==$currentYear || $age==0)
						if($age>=2018 || $age==0)
						{
							//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);
							echo $pensioner->getPensionCommencementDate(); 
						}
						elseif($age<25)
						{
							echo $pensioner->getPensionCommencementDate(); 
						}
						elseif($age>=25 && $pensioner->consolidated==1)
						{
							echo $pensioner->getPensionCommencementDate(); 
						}
						elseif($age>=25 && $pensioner->consolidated==0)
						{
							echo $pensioner->getPensionCommencementDate(); 
						}
						?></b></td>
					<?php endif; ?>
				</tr>
				
				<?php
				$bina=substr($pensioner->total_service,0,2);
				//echo $bina;
				$binb=$pensioner->total_amount;
				$biny=substr($pensioner->total_service,9,1);
				$binx=$pensioner->smp;
				//echo $biny;
				if($bina > 33)
				{
				 $binc=($binb)*(1/4)*(33*2);
					//$binc=1;
				}
				else if($bina < 33 && $biny < 9)
				{
					//$binc=2;
					$binc=($binb*1/2)*($binx);
					
				}
				else
				{
					
					//$binc=0;
					$binc=($binb*2/100+$binb)*(1/4)*($binx);
				}
				?>
				
				<tr>
					<td style="vertical-align: top;" colspan="4">
					4. No. <?php echo $gpo_no; ?> and amount of Retirement/Death gratuity :- <b>Rs. <?php //if($pensioner->pay_commission==7){ echo $binc;} else{ echo $pensioner->getDCRG();} 
					echo $pensioner->getDCRG();
					?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					5. Name of Treasury/Bank where payable 	:- <b><?php echo $payable; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					6. Provisional pension :- <b>Rs. <?php echo $pensioner->provisional_pension; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					7. Provisional Retirement/Death Gratuity :- <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
					8. Conditions attached to pension payment may be made subject to the conditions specified in the PPO as well as the C.C.S. Pension Rules and Treasury Rules.
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><b>Enclo :-
						<ol>
							<li>
								PPO (Pensioner's and Disburser's Portion)
							</li>
							<li>
								GPO
							</li>
							<li>
								Specimen signature slips
							</li>
							<li>
								Photograph
							</li>
						</ol></b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3"></td>
					<td style="vertical-align: top; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours faithfully,</td>
					<td></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3"></td>
					<td><div style="margin-top: 85px; text-align:left">Director/Joint Director</div></td>
					<td></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">Memo No - <?php //echo $pensioner->case_no; 
					echo $pensioner->case_file_no;
					?></td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						Copy forwarded to:- <br /><!-- echo $spouse; -->
						<b>1) <?php //echo $spouse.'('.$spouse_type.') ';
						echo $pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation.',<br />'.$pensioner->address_after_retirement; ?></b><br /><br />
						<b>2) <?php echo str_replace(",", ",<br />".nbs(5), $pensioner->office_address); ?></b> for information with reference to letter No. <b><?php echo $pensioner->dept_forw_no; ?></b>. The enclosures which are no longer required are returned herewith.<br />
						<b>3) The Accountant General (A&E) Arunachal Pradesh, Itanagar.</b>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3"></td>
					<td><div style="margin-top: 50px; text-align:left">Director/Joint Director</div></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width: 1000px; margin: 0px auto;">
		             
<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
		<!-- <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.1em; color:#000000; background-color:#FFFFFF; line-height: 2em"> -->
			<br />
			<!-- <div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px"> -->
			<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
			
			    <div style="font-weight: bold;font-family: initial; "><!--margin-left: 200px;-->
			    <!-- <div style="font-weight: bold; text-align: center; line-height: 1.4em;"> -->
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	     		<tr>
					<td colspan="3"><div align="left">No - <strong><?php echo $gpo_no; ?></strong></div></td>
		    		<td><div><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td  colspan="4"><div align="left">To</div></td>
				</tr>
				<tr>
					<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac;?></b></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				
				<?php
				$binas=substr($pensioner->total_service,0,2);
				//echo $bina;
				$binbs=$pensioner->total_amount;
				$binys=substr($pensioner->total_service,9,1);
				$binxs=$pensioner->smp;
				//echo $biny;
				if($binas > 33)
				{
				 $bincs=($binbs)*(1/4)*(33*2);
					//$binc=1;
				}
				else if($binas < 33 && $binys < 9)
				{
					//$binc=2;
					$bincs=($binbs*1/2)*($binxs);
					
				}
				else
				{
					
					//$binc=0;
					$bincs=($binbs*2/100+$binbs)*(1/4)*($binxs);
				}
				?>
				
				
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?> I am to request that you will be so good as to arrange for payment a sum of <b>Rs. <?php //if($pensioner->pay_commission==7){ echo $bincs;} else{ echo $pensioner->getDCRG();} 
				    echo $pensioner->getDCRG();
					?>/- (Rupees <?php //if($pensioner->pay_commission==7){ echo no_to_words($bincs);} else{echo no_to_words($pensioner->getDCRG());} 
					echo no_to_words($pensioner->getDCRG());
					?>)</b> only in lump to <b><?php //echo $spouse.'('.trim($spouse_type).') ';
					echo $pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b> being the amount of retirement/death gratuity sanctioned to him/her in letter no. <b><?php echo $gpo_no; ?></b> from the Director of Audit & Pension, debitable to 2071 Pension & ORB etc.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">2.<?php echo nbs(4); ?>The particulars regarding his/her identification is/are enclosed<?php 
					$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ }
					elseif($age>='25')
					{ }
					else
					{
					?> along with PPO No. <b><?php echo $ppo_no; } ?></b>. </div></td>
				</tr>
				<tr>
					<td colspan="4"><b>Below Rs.<?php //if($pensioner->pay_commission==7){ echo $bincs+1;} else{echo $pensioner->getDCRG()+1;} 
				    echo $pensioner->getDCRG()+1;
					?>/- (Rupees <?php //if($pensioner->pay_commission==7){ echo no_to_words($bincs+1);} else{echo no_to_words($pensioner->getDCRG()+1);}
					echo no_to_words($pensioner->getDCRG()+1);
					?>).</b></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">N.B: The date of payment may please be intimated to this office as soon as the gratuity is debitable to local fund is paid.</b></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">3. The acquittance of gratuitant unless he/she is exempted by rule of special order of Government from personal appearance should be taken on the reverse of this order with necessary Revenue stamp.</div></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">4. The gratuitant is being informed of the issue of this order.</div></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
			    <tr>
					<td colspan="4"><div align="left" style="text-align: justify;">5. The gratuitant should be directed to appear before the Treasury/Sub-Treasury to receive payment of gratuity amount.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">6. The expenditure is debitable to Head of Account “2071” Pension & ORB.</div></td>
				</tr>
			   	<tr>
					<td colspan="4" style="padding-top: 10px;"><b>RECOVERIES:-</b></td>
				</tr>
				<tr>
					<td colspan="2"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b></div></td>
					<td colspan="1"></td>
					<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours faithfully,</td>
				</tr>
				<tr>
					<td colspan="4">
						<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
							<div align="left">Excess Gratuity Paid : <?php //if($pensioner->pay_commission==7){ echo 0;} else{echo $pensioner->provisional_gratuity - $pensioner->getDCRG();} 

							if($pensioner->provisional_gratuity>$pensioner->getDCRG())
						{$pg=$pensioner->provisional_gratuity;
						 $g=$pensioner->getDCRG();
						 $r=$pg-$g;
						echo $r;}
						else
							{echo '0';}
							?> - which may be recovered from the arrear pension.</div>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
						<td style="padding-top: 28px;text-align: left;"><br/><br/>Director/Joint Director</td>
					<?php else : ?>
						<td style="padding-top: 28px;text-align: left;"><br/><br/>Director/Joint Director</td>
					<?php endif; ?>
					<td></td>
				</tr>
				<tr>
					<td colspan="3"><div align="left">Memo No- <b><?php echo $gpo_no; ?></b></div></td>
					<td><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td colspan="4">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;">i. <b><?php //echo $spouse.'('.$spouse_type.') ';
					echo $pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>, <?php 
					$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ echo $pensioner->address_after_retirement;
					?>, <?php
					}
					elseif($age>='25')
					{ echo $pensioner->address_after_retirement;
					?>, <?php
					}
					?></b> Arunachal Pradesh Government pensioner. He/She should appear before the Treasury Officer /Sub Treasury Officer/Bank, <b><?php echo $pensioner->sub_to; ?></b>, to receive payment. If however his/her wished to be exempted from appearing in person to receive his/her pension through an Authorised Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the later case, the Pension Payment order will be sent to his/her through Agent.</div></td>
			    </tr>
			   	<tr>
					<td colspan="4" width="25%"><div style="float: left;">ii.</div><div style="float: left;margin-left: 5px;"><b><?php echo $pensioner->office_address; ?></b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">iii.</div><div style="float: left;margin-left: 5px;"><b>The Accountant General (A&E), Arunachal Pradesh, Itanagar.</b></div></td>
				</tr>
			    <tr>
			    	<td colspan="3"></td>
					<!-- <td style="padding-top: 65px;text-align: center;">Director/Joint Director</td> -->
					<td style="padding-top: 28px;text-align: left;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="form3" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print3')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print3" style="width: 1000px; margin: 0px auto;">
		<!-- <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 2em"> -->
		<div style="width:1000px; min-height:600px; font-size:1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
			<br />
			<!-- <div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px;"> -->
			<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
			
	        	<!-- <div style="font-weight: bold; text-align: center; line-height: 1.4em;"> -->
	        	<div style="font-weight: bold;font-family: initial; ">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
	    	</div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	 			<tr>
					<td style="vertical-align: top;" colspan="3">No. - <strong><?php echo $cpo_no; ?></strong></td>
	    			<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">To</div></td>
				</tr>
	 			<tr>
					<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>I am to request you to make necessary arrangement for payment of <b>Rs.<?php echo $pensioner->getCommutationOfPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutationOfPension());?>)</b> being the commuted value of <b>Rs. <?php echo $pensioner->getCommutedValue(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutedValue());?>)</b> out of pension of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>)</b> per month granted to <b><?php echo $pensioner->getNameOfLegalHeir() ?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", ".$pensioner->designation; ?></b>, holder of PPO No: - <b><?php echo $ppo_no; ?>.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>Consequent on commutation, the reduced rate of pension in respect of <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name); ?></b>, <b><?php echo $pensioner->designation; ?></b> should be <b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/- (Rupees <?php echo no_to_words($pensioner->getOrdinaryRate());?>)</b> per month. The reduction in the amount of pension shall become operative from the date of receipt of the commuted value of pension by <b><?php echo $pensioner->getNameOfLegalHeir(); ?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", ".$pensioner->designation; ?></b> or three months after the issue of authority by you asking him/her to collect the commuted value of pension whichever is earlier. Necessary instructions regarding the date from which the pension is to be reduced may also kindly be issued to the Treasury Officer <b><?php echo $pensioner->sub_to; ?></b>. from which the pensioner is drawing the pension</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The expenditure is debitable to Government of Arunachal Pradesh under the Head of Account  ‘2071’ pension & ORB.</div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The receipt of authority may please be acknowledged.</div></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 20px 0 25px 0;"><!--<b>RECOVERY</b>: - Over payment, if any,<br/> due to non-payment of reduced pension<br/> of Rs.__________ per month should be<br/> adjusted at the time of payment.--></td>
					<td><div style="text-align: center;">Yours faithfully,</div></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: center;"><br/><br/><br/>Director/Joint Director</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 0;"><div align="left">Memo No- <b><?php echo $cpo_no; ?></b></div></td>
					<td style="padding: 10px 0;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;"><div align="left">i. <b><?php echo $pensioner->getNameOfLegalHeir(); ?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", Retd. ".$pensioner->designation;?></b></div></td>
			    </tr>
			   	<tr>
					<td colspan="4" style="padding: 5px 0;">ii. <b><?php echo $pensioner->office_address; ?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">iii. The Accountant General (A&E), Arunachal Pradesh, Itanagar.</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="form4" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print4')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print4" style="width: 1000px; margin: 0px auto;">
		<!-- <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 2em"> -->
		<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
			<br /><br />
			
			<!-- <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px"> -->
			<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">

	        	<!-- <div style="font-weight: bold; text-align: center; line-height: 1.4em; margin-bottom: 30px;"> -->
	        	<div style="font-weight: bold;font-family: initial; ">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
	    	</div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">Audit Enfacement No-<strong><?php echo $pensioner->case_file_no; ?></strong></div></td>
	    			<td colspan="2" valign="top" style="padding: 10px 0;"><div align="right"><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">Name and designation of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php //echo $spouse.'('.$spouse_type.')';
					echo $pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">1. Total period of qualifying service which has been accepted for Pension /gratuity, with reasons for disallowance if any.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b><?php echo $pensioner->net_qualifying_service(); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<div align="left"> 2. Amount of Superannuation/Retiring /Invalid and Compensation Pension , Terminal/Death/Retirement gratuity has been admitted And the date from which pension is admissible.</div>
					</td>
					
					<?php
				$binaz=substr($pensioner->total_service,0,2);
				//echo $bina;
				$binbz=$pensioner->total_amount;
				$binyz=substr($pensioner->total_service,9,1);
				$binxz=$pensioner->smp;
				//echo $biny;
				if($binaz > 33)
				{
				 $bincz=($binbz)*(1/4)*(33*2);
					//$binc=1;
				}
				else if($binaz < 33 && $binyz < 9)
				{
					//$binc=2;
					$bincz=($binbz*1/2)*($binxz);
					
				}
				else
				{
					
					//$binc=0;
					$bincz=($binbz*2/100+$binbz)*(1/4)*($binxz);
				}
				?>
				<?php
					$age_retires=$pensioner->age_retire+1;
					//echo $age_retire;
					$result = mysql_query("SELECT distinct comm_value FROM master_comm_value_tb where Age_Next_Birth='".$age_retires."' LIMIT 1");
					while($row = mysql_fetch_array($result))
					{
						$vivos=$row['comm_value'];
						$bigbazars=ceil(($total_amount)*50/100*0.4*$vivos*12);
						$visals=($total_amount)*50/100*40/100;
						$sohums=($total_amount)*50/100;
					?>
					
					<td colspan="2" valign="top" style="padding: 10px 0;">
					
						<b>PENSION RS. <?php if($pensioner->pay_commission==7){ echo $total_amount_pension ;} else{echo $amount_pension;}?>/-</b></br>
		                <b>GRATUTIY RS. <?php //if($pensioner->pay_commission==7){ echo $bincz;} else{echo $pensioner->getDCRG(); }
		                echo $pensioner->getDCRG();
		                ?>/-</b></br>
		                <b>COMMUTATION RS. <?php if($pensioner->pay_commission==7 && $pensioner->dor==$pensioner->dod){ echo 'N/A';}elseif($pensioner->pay_commission==7){ echo $bigbazars;} else{echo $pensioner->getCommutationOfPension();} ?>/-</b></br>
		                <b><?php //echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
						//if($age==$currentYear || $age==0)
						if($age>=2018 || $age==0)
						{
							//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);
							echo $pensioner->getPensionCommencementDate(); 
						}
						elseif($age<=25)
						{
							echo $pensioner->getPensionCommencementDate(); 
						}
						/*else
						{
							echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
						}*/
						?></b><br/>
	    			</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">3. FAMILY PENSION </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"><b></b></div></td>
				</tr>
		      	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (a) Amount admitted and the period of payment</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>Rs. <?php 
					//echo $pensioner->getEnhanceRate();
										
					$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ echo 'N/A';
					}
					elseif($EntryYear<'2008')
					{
						//if($age==$currentYear || $age==0)
						if($age>=2018 || $age==0)
						{
							echo $pensioner->getEnhanceRate(); 
						}
						elseif($age<25)
						{
							echo $pensioner->getEnhanceRate_ForLessThan25Child(); 
						}
						elseif($age>=25)
						{
							//echo $pensioner->getEnhanceRate(); 
							echo 'N/A';
						}
					}
					?> (Enhanced Rate)</b></br><b>Rs. <?php 
				
										
					$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ echo 'N/A';
					}
					elseif($EntryYear<'2008')
					{
						
					//if($age==$currentYear || $age==0)
					if($age>=2018 || $age==0)
					{
						echo $pensioner->getOrdinaryRate();
							
						?> <b>from</b> <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}
					}
					elseif($age>=25 && $pensioner->consolidated==1)
					{
						echo 'N/A';
					}
					elseif($age>=25 && $pensioner->consolidated==0)
					{
						/*echo $pensioner->getOrdinaryRate();?> <b>from</b> <?php echo $ordinary_from_upto_seven_above25;*/
						echo 'N/A';
					}
					elseif($age<25)
					{
						/*echo $pensioner->getOrdinaryRate();?> <b>from</b> <?php echo $ordinary_from_upto_seven_below25;*/
						echo 'N/A';
					}
					}
			 ?>
			 <!-- <?php if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000 ){echo '9000';} else{echo $pensioner->getOrdinaryRate();} ?> --> (Ordinary Rate)</b></td>
				</tr>
			 	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (b) To whom admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php //echo $pensioner->getNameofSpouse(); 
					echo $pensioner->getNameOfLegalHeir();?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (c) D.R admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 0;"><b>As per order from time to time</b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 4. Heads of Accounts wo which the pension / gratuity is chargeable</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>2071 pension and ORB(Arunachal Pradesh)</b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 5. Amount to be recovered</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>_______________________________</b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 6. Anticipatory provisional pension and Anticipatory-Death /Retirements gratuity, already to be adjusted out of the final payments.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<?php echo $pensioner->getAllGratuityStatus(); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 7.	P.P.O/G.P.O/C.P.O. issued in favour of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>1) PPO No. <?php echo $pensioner->ppo_no; ?></b></br>
					    <b>2) GPO No. <?php echo $pensioner->gpo_no; ?></b></br>
					    <b>3) CPO No. <?php //echo $cpo_no;
						if($pensioner->com_applied == 1)
						{echo $cpo_no; }
						else
						{echo 'N/A';}
					    ?></b></br>
					</td>
				</tr>
				<tr>
					<td colspan="4" valign="top" style="padding: 0 0 10px 0;"><div align="left">To</div></td>
				</tr>
				<tr>
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">1. <?php echo $pensioner->office_address; ?></div></td>
				</tr>
	    		<tr>
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">2.The Accountant General (A& E), Arunachal Pradesh, Itanagar</div></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td valign="top" style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="form5" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print5')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print5" style="width: 1000px; margin: 0px auto;">
		<!-- <div id="print" style="width:1000px; min-height:600px; padding: 0 20px; color:#000000; background-color:#FFFFFF; line-height: 2em"> -->
		<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">

			<br /><br />
			<!-- <div style="font-size: 18px; font-weight: bold; text-align: center;font:Arial, Helvetica, sans-serif;"> -->
			<div style="font-size: 18px; font-weight: bold; text-align: center;font:Arial, Helvetica, sans-serif;">
			<div style="font-weight: bold;font-family: initial; ">
			FORM 7 (Part-II)
			</div>
			</div><br /><br />

			<table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
				<tr>
					<td valign="top" width="50%">1.Name of Government Servant</td>
					<td valign="top" width="2%">:-</td>
					<td valign="top" width="48%"><b><?php //echo $spouse.'('.$spouse_type.') ';
					echo $pensioner->getNameOfLegalHeir();
					?> of <?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b></td>
				</tr>
				<tr>
					<td valign="top">2. Date of receipt of pension papers by the <br /><?php echo nbs(4); ?>Accounts Officer from Head of Office</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->cash_received); ?></b></td>
				</tr>
				<tr>
					<td colspan="3">3. <u>Entitlements admitted</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(3); ?>A. Length of qualifying service</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->net_qualifying_service(); ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>B. Pension</u></td>
			    </tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Class of pension</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Amount of monthly pension</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $amount_pension;?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Date of Commencement</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>C. Commutation of pension</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Commuted value of portion of<br /><?php echo nbs(11); ?>pension commuted, if any</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php //echo $commuted_value;
					if($pensioner->com_applied == 1)
						{echo $commuted_value; }
						else
						{echo 'N/A';}	
					?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6);?>(ii) Residuary pension after commutation</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Date from which reduced pension is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>From the date of payment of commuted value of pension</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iv) Date of restoration of commuted portion of<br /><?php echo nbs(13); ?>pension subject to the pensioner continuing to live</td>
					<td valign="top">:-</td>
					<td valign="top"><b>On completion of 15 years from the date of payment of commuted value of pension</b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>D. Retirement/ Death Gratuity</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) Total amount payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Amount to be adjusted towards Government dues</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->provisional_gratuity; ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Amount to be withheld for adjustment of unassessed<br /><?php echo nbs(13); ?>dues</td>
					<td valign="top">:-</td>
					<td valign="top"></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iv) Excess Provisional Gratuity</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php //echo $pensioner->excess_pay_and_allowances; 
					if($pensioner->provisional_gratuity>$pensioner->getDCRG())
						{$pg=$pensioner->provisional_gratuity;
						 $g=$pensioner->getDCRG();
						 $r=$pg-$g;
						echo $r;}
						else
							{echo '0';}
					?></b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(v) Net amount to be released immediately</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG()-$pensioner->provisional_gratuity; ?>/-</b></td>
				</tr>
				<tr>
					<td colspan="3"><?php echo nbs(3); ?><u>E. Family Pension</u></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(i) At enhanced rate</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate_sanjay();?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Period for which Family Pension at enhanced rate<br /><?php echo nbs(12); ?>is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php echo $enhance_from_upto;?></b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) At normal rate</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(3); ?>4. Head of Account to which the amount of Pension<br /><?php echo nbs(8); ?>Retirement/DeathGratuity and Family Pension to<br /><?php echo nbs(8); ?>be debited.</td>
					<td valign="top">:-</td>
					<td valign="top"><b>2071 - Pension and ORB</b></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center"><div style="margin-top: 70px;">Accounts Officer</div></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="disburser_disburser_portion" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print6')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print6" style="width: 1000px; margin: 0px auto;">
		<!-- <div id="print" style="width:1000px; min-height:600px; font-size: 15px; padding: 0 20px; color:#000000; background-color:#FFFFFF; line-height: 1.5em"> -->
		<div style="width:1000px; min-height:600px; font-size: 1em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"><!--font-size: 1em;-->
		
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:5px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-weight:bold; font-family: initial; margin-left: 200px;">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>DISBURSER'S PORTION</div>
					    </div>
					</td>
					<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>
					</td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">Charged:</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
				</tr>	
			 	<tr>
					<td style="vertical-align: top;" colspan="2">
						<div style="float: left;">Name of Pensioner:</div>
						<div style="float: left;"><b><!--<?php //echo nbs(2).''. $spouse.'('.$spouse_type.') ';
						echo nbs(1).$pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>-->
						<?php echo nbs(1).$pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>
						</b></div>
					</td>
					<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b></b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						<table border="1" cellspacing="2" cellpadding="2" width="100%" id="inner-table">
							<tr>
								<td width="20%" style="vertical-align: top; text-align: center;">Class of Pension and date of commencement</td>
								<td width="0%" style="vertical-align: top; text-align: center;">Date of Birth</td>
								<td width="0%" style="vertical-align: top; text-align: center;">Religion and Nationality</td>
								<td width="30%" style="vertical-align: top; text-align: center;">Residence showing village pargana</td>
								<td width="20%" style="vertical-align: top; text-align: center;">Amount of monthly pension</td>
							</tr>
							<tr>
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php 
								//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{
									//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);
									echo $pensioner->getPensionCommencementDate(); 
								}
								elseif($age<=25)
								{
									echo $pensioner->getPensionCommencementDate(); 
								}
								/*else
								{
									echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								}*/
								?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->getDOBOfLegalHeir();?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->address_after_retirement; ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $enhance_from_upto; 
								//echo $pensioner->getEnhanceRate(); ?><?php 
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{ }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ ?>, thereafter consolidated revised pension of Rs. <?php echo $pensioner->getEnhanceRateConsolidated_PPOreport(); } ?> <?php 
								
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{ echo '& thereafter ordinary rate of Rs.'; }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ }
								elseif($age>=25 && $pensioner->consolidated==0)
								{ //echo '& thereafter ordinary rate of Rs.'; 
								}
								elseif($age<25 && $pensioner->consolidated==0)
								{
									//echo 'N/A';
									// echo '& thereafter ordinary rate of Rs.';
								}
							    //else
							    //{ echo '& thereafter ordinary rate'; }
								?> <?php 
				
										
					//if($age==$currentYear || $age==0)
					if($age>=2018 || $age==0)
					{ 
						/*if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000)
						{ echo 'Rs. 9000';} 
						else
						{*/
							// //echo $pensioner->getOrdinaryRate();
							// if($pensioner->more_wives==1 && $pensioner->no_of_wives>=2)
							// {
							// 	echo 'Rs. '.$pensioner->getOrdinaryRate()/$pensioner->no_of_wives.' (for each wife)';
							// }
							// else
							//{
								echo 'Rs. '.$pensioner->getOrdinaryRate();//}
						//} 
						echo '/- PM'.$pensioner->getDRMA(); ?> w.e.f <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}
					}
					elseif($age>=25 && $pensioner->consolidated==1)
					{
						//echo 'N/A';
					}
					elseif($age>=25 && $pensioner->consolidated==0)
					{
						//echo $pensioner->getOrdinaryRate()."/- PM".$pensioner->getDRMA()." w.e.f. ".$ordinary_from_upto_seven_above25;
					}
					elseif($age<25 && $pensioner->consolidated==0)
					{
						//echo 'N/A';
						/*echo 'Rs. '.$pensioner->getOrdinaryRate();
						
						echo '/- PM'.$pensioner->getDRMA(); ?> w.e.f <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven_below25;} 
						else
						{echo $ordinary_from_upto;
						}*/
					}
					//else
					//{	
						/*if ($pensioner->class_of_pension = 7 && $pensioner->getOrdinaryRate() < 9000 ){
							echo '9000';
						}else
						{
							
								echo $pensioner->getOrdinaryRate();
						}*/			

						/*if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000)
						{ echo 'Rs. 9000';} 
						else
						{
							// //echo $pensioner->getOrdinaryRate();
							// if($pensioner->more_wives==1 && $pensioner->no_of_wives>=2)
							// {
							// 	echo 'Rs. '.$pensioner->getOrdinaryRate()/$pensioner->no_of_wives.' (for each wife)';
							// }
							// else
							{echo 'Rs. '.$pensioner->getOrdinaryRate();}
						} 
						?>/- PM<?php echo $pensioner->getDRMA(); ?> w.e.f <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}
				 
				 
					}*/
			 ?>
								<!-- <?php 
								if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000)
								{ echo '9000';} 
							else{echo $pensioner->getOrdinaryRate();} 
								?>/-PM<?php echo $pensioner->getDRMA(); ?> w.e.f <?php if($pensioner->pay_commission==7){ echo $ordinary_from_upto_seven;} else{echo $ordinary_from_upto;}?> --> 
								</b></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						Date of death of the pension<br/>
						(To be filled in and attested by the Treasury Officer)
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<table border="0" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td width="20%">Pay Scale</td>
								<td width="3%">:</td>
								<td width="77%"><b><?php echo $pensioner->pay_scale; ?>(<?php echo $pensioner->pay_scale_grade; ?>)</b></td>
							</tr>
							<tr>
								<td width="20%">Designation</td>
								<td width="3%">:</td>
								<td width="77%"><b>Ex-<?php echo $pensioner->designation; ?></b></td>
							</tr>
							<tr>
								<td width="20%">Last Pay</td>
								<td width="3%">:</td>
								<td width="77%"><b>Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>/-</b></td>
							</tr>
						</table>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td style="vertical-align: top; text-align:center" colspan="4">
						<div style="font-size: 15px; margin-top: 0px;">OFFICE OF THE DIRECTOR OF AUDIT AND PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"><strong>No. <?php //echo $pensioner->case_no."/".$pensioner->ppo_no; 
					echo $pensioner->case_file_no."/".$pensioner->ppo_no;
					?></strong></td>
					<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
					<tr>
					<td style="vertical-align: top; text-align: justify;" colspan="4">
						<?php
							$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
							if($pensioner->pay_commission==7){
							$orrate= $total_amount*50/100;
							}
							else{
							$orrate= $pensioner->getEnhanceRate_sanjay(false);
							}
							if(in_array($class_of_pension, $array)) 
							{
								echo nbs(6);echo  'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).' Rtd '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$pensioner->getAmountofPension().'/-</b>PM'.$pensioner->getDRMA().' w.e.f  only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.<br/>&nbsp';
								$attained_age = ($pensioner->designation == "Teacher" || $pensioner->designation == "MTF(group D)") ? '67' : '65';
								echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-';
							}
							else
							{// means family pension
							
							//if($age==$currentYear || $age==0)
							if($age>=2018 || $age==0)
							{							
								//$pensionDate=$pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								$pensionDate= $pensioner->getPensionCommencementDate(); 
							}							
							elseif($age<=25)
							{
								$pensionDate=$pensioner->getPensionCommencementDate(); 
							}
							/*else
							{
								$pensionDate=$pensioner->dateTimeToDate($pensioner->effect_of_pension); 
							}*/
							
	echo nbs(6);echo 'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.$pensioner->getNameOfLegalHeir().' of '.strtoupper($salutation." ".$pensioner->name).' Ex .'.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate.'/-</b>PM'.$pensioner->getDRMA().' './*str_replace(['E/R', ''], '', $enhance_from_upto).*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from './*date_format(date_create($pensioner->effect_of_pension), "d-m-Y")*/$pensionDate.'</b>.&nbsp';//$pensioner->getNameOfLegalHeir()/*strtoupper($spouse).'('.strtoupper($spouse_type).')'*/.' of Late '.$pensioner->name.' Ex-'.$pensioner->designation


							}
						?>
			 		</td>
				</tr>			
	 					<?php
							$dob 	= new DateTime($pensioner->getDOBofSpouse());//dob
							$dob1	= date_format($dob,"d-m-Y");
							$dob->modify('+80 year');
							$year80	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year85	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year90	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year95	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year100= date_format($dob,"d-m-Y");
						?>
						<tr>
							<!-- <td colspan="4" style="border:1px solid#000">
								1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo  round((20*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?>  <br />
								2.W.e.f <?php $year85plus = new DateTime($year85);
								$year85plus->modify('+1 day');
								$year85plus1 = date_format($year85plus,"d-m-Y");
								echo $pensioner->dateTimeToDate($year85plus1);
								?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo round((30*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
								3.W.e.f  <?php $year90plus = new DateTime($year90);
								$year90plus->modify('+1 day');
								$year90plus1 = date_format($year90plus,"d-m-Y");
								echo $pensioner->dateTimeToDate($year90plus1);
								?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo round((40*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
								4.W.e.f <?php $year95plus = new DateTime($year95);
								$year95plus->modify('+1 day');
								$year95plus1 = date_format($year95plus,"d-m-Y");
								echo $pensioner->dateTimeToDate($year95plus1);
								?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((50*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
								5.W.e.f <?php $year100plus = new DateTime($year100);
								$year100plus->modify('+1 day');
								$year100plus1 = date_format($year100plus,"d-m-Y");
								echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((100*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
							</td> -->  	
							<td colspan="4" ><!-- style="border:1px solid#000" -->
						   <div style="width:100%;  border:1px solid#000">
						  <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); //getAmountofPension();?>= 
							<?php  echo round((20*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();//getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((30*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getOrdinaryRate(); ?>
							= <?php echo round((40*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((50*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((100*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
						    </strong></div></td>
						</tr>
				<tr style="height:0px;"></tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2">
						a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br/>
						c) Excess Provisional RG/DG Rs. <?php 
						// if($pensioner->pay_commission==7)
						// 	{ echo 0;} 
						// else
						// 	{//echo ($pensioner->provisional_gratuity>$pensioner->getDCRG()) ? $pensioner->provisional_gratuity-$pensioner->getDCRG() : 'N/A'; 

						// 	}
						
						if($pensioner->provisional_gratuity>$pensioner->getDCRG())
						{$pg=$pensioner->provisional_gratuity;
						 $g=$pensioner->getDCRG();
						 $r=$pg-$g;
						echo $r;}
						else
							{echo '0';}
						?></br>
						e) Others if any Rs. <?php echo $pensioner->others; ?>
					</td>
					<td style="vertical-align: top;" colspan="2">
						b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br/>
						d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Signature_________________</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3"><b>
						To<br/>
						<?php echo $pensioner->treasury_name; ?></b>
					</td>
					<td align="right">
						Designation_______________
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div id="disburser_pensioner_portion" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print7')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print7" style="width: 1000px; margin: 0px auto;">
		<!-- <div id="print" style="width:1000px; min-height:600px; font-size: 15px; padding: 0 20px; color:#000000; background-color:#FFFFFF; line-height: 1.5em"> -->
		<div style="width:1000px; min-height:600px; font-size: 1em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"><!--font-size: 1em;-->

			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
					<td style="vertical-align: top;" width="25%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:5px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-weight: bold; font-family: initial; margin-left: 200px;">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>PENSIONER'S PORTION</div>
					    </div>
					</td>
					<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>
					</td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">Charged:</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Class of Pension: <b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
				</tr>	
			 	<tr>
					<td style="vertical-align: top;" colspan="2">
						<div style="float: left;">Name of Pensioner: </div>
						<div style="float: left;"><b><!--<?php //echo nbs(2).''. $spouse.'('.$spouse_type.') ';
						echo nbs(1).$pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>-->
						<?php echo nbs(1).$pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>
						</b></div>
					</td>
					<td style="vertical-align: top;" colspan="2" style="text-align:left;">Place for signature of pensioner to be<br/> taken at the time of first payment</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Name of his wife / her husband: <b></b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						<table border="1" cellspacing="2" cellpadding="2" id="inner-table">
							<tr>
								<td width="20%" style="vertical-align: top; text-align: center;">Class of Pension and date of commencement</td>
								<td width="0%" style="vertical-align: top; text-align: center;">Date of Birth</td>
								<td width="0%" style="vertical-align: top; text-align: center;">Religion and Nationality</td>
								<td width="30%" style="vertical-align: top; text-align: center;">Residence showing village pargana</td>
								<td width="20%" style="vertical-align: top; text-align: center;">Amount of monthly pension</td>
							</tr>
							<tr>
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php 
								//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{
									//echo $pensioner->dateTimeToDate($pensioner->effect_of_pension);
									echo $pensioner->getPensionCommencementDate(); 
								}
								elseif($age<=25)
								{
									echo $pensioner->getPensionCommencementDate(); 
								}
								/*else
								{
									echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								}*/
								?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->getDOBOfLegalHeir();?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->address_after_retirement; ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo $enhance_from_upto; 
								//echo $pensioner->getEnhanceRate(); ?><?php 
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{ }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ ?>, thereafter consolidated revised pension of Rs. <?php echo $pensioner->getEnhanceRateConsolidated_PPOreport(); } ?> <?php 
								
								//if($age==$currentYear || $age==0)
								if($age>=2018 || $age==0)
								{ echo '& thereafter ordinary rate of Rs.'; }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ }
								elseif($age>=25 && $pensioner->consolidated==0)
								{ echo '& thereafter ordinary rate of Rs.'; }
								elseif($age<25 && $pensioner->consolidated==0)
								{
									//echo 'N/A';
									 //echo '& thereafter ordinary rate of Rs.';
								}
							    //else
							    //{ echo '& thereafter ordinary rate'; }
								?> <?php 
				
										
					//if($age==$currentYear || $age==0)
					if($age>=2018 || $age==0)
					{ 
						/*if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000)
						{ echo 'Rs. 9000';} 
						else
						{*/
							// //echo $pensioner->getOrdinaryRate();
							// if($pensioner->more_wives==1 && $pensioner->no_of_wives>=2)
							// {
							// 	echo 'Rs. '.$pensioner->getOrdinaryRate()/$pensioner->no_of_wives.' (for each wife)';
							// }
							// else
							//{
								echo 'Rs. '.$pensioner->getOrdinaryRate();//}
						//} 
						echo '/- PM'.$pensioner->getDRMA(); ?> w.e.f <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}
					}
					elseif($age>=25 && $pensioner->consolidated==1)
					{
						//echo 'N/A';
					}
					elseif($age>=25 && $pensioner->consolidated==0)
					{
						echo $pensioner->getOrdinaryRate()."/- PM".$pensioner->getDRMA()." w.e.f. ".$ordinary_from_upto_seven_above25;
					}
					elseif($age<25 && $pensioner->consolidated==0)
					{
						//echo 'N/A';
						/*echo 'Rs. '.$pensioner->getOrdinaryRate();
						
						echo '/- PM'.$pensioner->getDRMA(); ?> w.e.f <?php 
						
						if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven_below25;} 
						else
						{echo $ordinary_from_upto;
						}*/
					}
					
			 ?>
								<!-- <?php 
								if($pensioner->pay_commission==7 && $pensioner->getOrdinaryRate()<9000)
								{ echo '9000';} 
								else{echo $pensioner->getOrdinaryRate();} ?>
								/-PM<?php echo $pensioner->getDRMA(); ?> w.e.f <?php if($pensioner->pay_commission==7){ echo $ordinary_from_upto_seven;} else{echo $ordinary_from_upto;}?> -->
								
								</b></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						Date of death of the pension<br/>
						(To be filled in and attested by the Treasury Officer)
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<table border="0" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td width="20%">Pay Scale</td>
								<td width="3%">:</td>
								<td width="77%"><b><?php echo $pensioner->pay_scale; ?>(<?php echo $pensioner->pay_scale_grade; ?>)</b></td>
							</tr>
							<tr>
								<td width="20%">Designation</td>
								<td width="3%">:</td>
								<td width="77%"><b>Ex-<?php echo $pensioner->designation; ?></b></td>
							</tr>
							<tr>
								<td width="20%">Last Pay</td>
								<td width="3%">:</td>
								<td width="77%"><b>Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>/-</b></td>
							</tr>
						</table>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td style="vertical-align: top; text-align:center" colspan="4">
						<div style="font-size: 15px; margin-top: 0px;">OFFICE OF THE DIRECTOR OF AUDIT AND PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"><strong>No. <?php //echo $pensioner->case_no."/".$pensioner->ppo_no; 
					echo $pensioner->case_file_no."/".$pensioner->ppo_no;
					?></strong></td>
					<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
				<tr>
					<td style="vertical-align: top; text-align: justify;" colspan="4">
						<?php
							$array = array('Superannuation_Pension', 'Compulsory_Retirement_Pension', 'Voluntary_Retirement_Pension', 'Invalid_Retirement_Pension', 'Absorption_in_autonomous_body_pension', 'Disability_Pension');
							if(in_array($class_of_pension, $array)) 
							{
								echo nbs(6);echo  'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).' Rtd '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$pensioner->getAmountofPension().'/-</b>PM'.$pensioner->getDRMA().' w.e.f  only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.<br/>&nbsp';
								$attained_age = ($pensioner->designation == "Teacher" || $pensioner->designation == "MTF(group D)") ? '67' : '65';
								echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-';
							}
							else
							{// means family pension
							
							//if($age==$currentYear || $age==0)
							if($age>=2018 || $age==0)
							{							
								//$pensionDate=$pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								$pensionDate= $pensioner->getPensionCommencementDate(); 
							}							
							elseif($age<=25)
							{
								$pensionDate=$pensioner->getPensionCommencementDate(); 
							}
							/*else
							{
								$pensionDate=$pensioner->dateTimeToDate($pensioner->effect_of_pension); 
							}*/
							
	echo nbs(6);echo 'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.$pensioner->getNameOfLegalHeir().' of '.strtoupper($salutation." ".$pensioner->name).' Ex .'.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate.'/-</b>PM'.$pensioner->getDRMA().' './*$enhance_from_upto.*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from './*date_format(date_create($pensioner->effect_of_pension), "d-m-Y")*/$pensionDate.'</b>.&nbsp';//$pensioner->getNameOfLegalHeir()/*strtoupper($spouse).'('.strtoupper($spouse_type).')'*/.' of Late '.$pensioner->name.' Ex-'.$pensioner->designation
							}
						?>
			 		</td>
				</tr>
				
				<?php
							$dob 	= new DateTime($pensioner->getDOBofSpouse());//dob
							$dob1	= date_format($dob,"d-m-Y");
							$dob->modify('+80 year');
							$year80	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year85	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year90	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year95	= date_format($dob,"d-m-Y");
							$dob->modify('+5 year');
							$year100= date_format($dob,"d-m-Y");

				?>
				<tr>
					<!--<td colspan="4" style="border:1px solid#000">
						1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo  round((20*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?>  <br />
						2.W.e.f <?php $year85plus = new DateTime($year85);
						$year85plus->modify('+1 day');
						$year85plus1 = date_format($year85plus,"d-m-Y");
						echo $pensioner->dateTimeToDate($year85plus1);
						?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo round((30*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
						3.W.e.f  <?php $year90plus = new DateTime($year90);
						$year90plus->modify('+1 day');
						$year90plus1 = date_format($year90plus,"d-m-Y");
						echo $pensioner->dateTimeToDate($year90plus1);
						?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getOrdinaryRate();?>= <?php echo round((40*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
						4.W.e.f <?php $year95plus = new DateTime($year95);
						$year95plus->modify('+1 day');
						$year95plus1 = date_format($year95plus,"d-m-Y");
						echo $pensioner->dateTimeToDate($year95plus1);
						?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((50*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
						5.W.e.f <?php $year100plus = new DateTime($year100);
						$year100plus->modify('+1 day');
						$year100plus1 = date_format($year100plus,"d-m-Y");
						echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((100*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
					</td>-->
					<td colspan="4" ><!-- style="border:1px solid#000" -->
						   <div style="width:100%;  border:1px solid#000">
						  <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); //getAmountofPension();?>= 
							<?php  echo round((20*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();//getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((30*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getOrdinaryRate(); ?>
							= <?php echo round((40*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"d-m-Y");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((50*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"d-m-Y");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getOrdinaryRate(); ?>= <?php echo round((100*$pensioner->getOrdinaryRate())/100)+$pensioner->getOrdinaryRate(); ?><br />
						    </strong></div></td>
				</tr>
				<tr style="height:0px;"></tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2">
						a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br/>
						c) Excess Provisional RG/DG Rs. <?php //if($pensioner->pay_commission==7){ echo 0;} else{echo ($pensioner->provisional_gratuity>$pensioner->getDCRG()) ? $pensioner->provisional_gratuity-$pensioner->getDCRG() : 'N/A';} 

						if($pensioner->provisional_gratuity>$pensioner->getDCRG()) 
						  {echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); }
						  else
						  {echo "0";}
						?></br>
						e) Others if any Rs. <?php echo $pensioner->others; ?>
					</td>
					<td style="vertical-align: top;" colspan="2">
						b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br/>
						d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Signature_________________</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						<b>
						To<br/>
						<?php echo $pensioner->treasury_name; ?></b>
					</td>
					<td align="right">
						Designation_______________
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php
if($pensioner->dod > $pensioner->dor) :
		$fiveandsix = 'Retirement';
		$expired_statement = '<span style="font-size:12px; color: red;font-weight: bold;"> (Expired on '.$pensioner->dateTimeToDate($pensioner->dod).')</span>';
		$salutation = 'Shri';
		$sixteen	= 'Retirement Gratuity';
	elseif($pensioner->dod == $pensioner->dor) :
		$fiveandsix = 'Death';
		$expired_statement = '';
		$salutation = 'Late';
		$sixteen	= 'Death Gratuity';
	endif;
	?>

<div id="id_card" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print8')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print8" style="width: 1000px; margin: 0px auto;">
		<!-- <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"> -->

			<table width="100%" cellpadding="3" id="report" border="0"> 
				<tr>
					<td style="font-size:15px;">
					<table width="70%" height="265px" id="report" border="1" style="background-image:url('http://10.0.0.4/pension_ui/id_card_logo/idcard_front.jpg');background-repeat:no-repeat;background-size:cover;"> <!--class="table1">-->
						<tr>
							<td>
					<table width="100%" id="report" border="0">
						<tr>
							<td><center>
							<table width="100%" id="report" border="0">
							<tr>
								<td><center>
								<?php echo '<img src="'.base_url('id_card_logo/logo.png').'" height="48">'; ?>
								</center>
								</td>
                                <td></td>
							</tr>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<tr>
							<td><center>
								<table width="100px" height="110px" id="report" border="1">
							    <tr>
								<td>
								</td>
								</tr>
								</table></center>
								</td>
                            <td></td>
                            </tr></table></center>
							</td>
							<td>
								<table width="330px" id="report" border="0">
								<tr>
									<td style="color:#0410b6;"><center>
									<b>GOVERNMENT OF ARUNACHAL PRADESH</b><br/>
									DIRECTORATE OF AUDIT & PENSION<br/>
									NAHARLAGUN<br/>
									</center>
									</td></tr>
									<tr><td style="color:#ef018a;"><center>
									PENSIONER'S IDENTITY CARD<br/>
									</center></td>
									</tr>
									<tr><td><center>
									No: <b><?php echo $pensioner->idcard_serial_no; ?></b><br/><br/>
									</center></td>
								</tr>
								<tr>
								<td height="100px">
									Name: <b><?php echo $pensioner->getNameOfLegalHeir();?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b><br/>
									Address: <b><?php echo $pensioner->address_after_retirement;

						?></b><br/>
									
									
								</td>
								</tr>
								</table>
							</td>
							</tr>
							<tr>
								<td><br/></td>
								<td></td>
							</tr>
							<tr>
								<td ><center>Signature of Pensioner</center></td>
								<td >
								<table width="330px" id="report" border="0">
								<tr>
								<td width="55%">Tel. No.: <?php echo $pensioner->phone_no; ?></td>
								<td>Director/Jt. Director</td>
								</tr>
								</table>
								</td>
								<!--<td >&nbsp;&nbsp;Tel. No.: <?php //echo $pensioner->phone_no; ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Director/Jt. Director</td>-->
							</tr>
							</table>
							</td>
							</tr></table>
					</td>
					<!-- </tr>
					<tr> -->
					<td>
					<table width="450px" id="report" border="1" style="background-image:url('http://10.0.0.4/pension_ui/id_card_logo/idcard_back.jpg');background-repeat:no-repeat;background-size:cover;">
						<tr>
							<td>
						<table style="font-size:16px;" width="100%" height="275px" id="report" border="0">
						<tr>
							<td width="2%"></td>
							<td width="37%">Blood Group</td>
							<td width="2%">:</td>
							<td><b><?php echo $pensioner->blood_group; ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Date of Birth</td>
							<td>:</td>
							<td><b><?php //echo $pensioner->getDOBofSpouse(); 
							echo $pensioner->getDOBOfLegalHeir();?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Post Held</td>
							<td>:</td>
							<td><b>Ex. <?php echo $pensioner->designation; ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Date of <?php echo $fiveandsix; ?></td>
							<td>:</td>
							<td><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Pay Scale</td>
							<td>:</td>
							<td><b><?php echo $pensioner->pay_scale; ?>(<?php echo $pensioner->pay_scale_grade; ?>)</b></td>
						</tr>
						<tr>
							<td></td>
							<td>Last Pay</td>
							<td>:</td>
							<td><b>Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>/-</b></td>
						</tr>
						<tr>
							<td></td>
							<td>Deptt. in which served</td>
							<td>:</td>
							<td><b><?php echo $pensioner->office_address; ?></b></td><!-- echo str_replace(",", ",<br />".nbs(5), $pensioner->office_address); -->
						</tr>
						<tr>
							<td></td>
							<td>Amount of Pension</td>
							<td>:</td>
							<td><b><?php 
							if($pensioner->pay_commission==7)
								{ echo "Rs. ".$total_amount*50/100;} 
							else
								{
									if($amount_pension=="N/A")
									{echo "N/A";}
									else
									{echo "Rs. ".$amount_pension;}
								}
									?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>P.P.O No.</td>
							<td>:</td>
							<td><b><?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></b></td>
						</tr>
							</table>
							</td>
							</tr>
							</table>
					</td>
				</tr>
				</table>

		<!-- </div> -->
		</div>
		</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hideAll();
				$('#'+val).show();
			}
		});
	});

	function hideAll() {
		$('#form1, #form2, #form3, #form4, #form5, #disburser_disburser_portion, #disburser_pensioner_portion').hide();
	}
</script>