<?php $pensioner = $values;
/*Two or more wives */
$lap_text=NULL;
	$NumberOfWives=$pensioner->getNumberOfWives();

	if($NumberOfWives==0){
            $NumberOfWives=1;
        }

	/*End */
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
	//$enhan_upto->modify('+10 year -1 day');
	$enhan_upto->modify('+10 year -2 day');
	
	//seven pay
	$enhan_upto_seven= new DateTime($pensioner->dod);
	$enhan_upto_seven->modify('+10 year');
	//seven
	
    $enhance_from_upt=$pensioner->getEnhanceRate_sanjay(false);
	$x_amount=$pensioner->total_amount;
	
   // new DateTime();
	/*$now = Date("Y-m-d");
	$age = new DateTime();*/
	/*$child_dob=array();
	foreach ($pensioner->family_info[0]["child"] as $child_info) {
		$child_dob[]=abs(Date("Y-m-d")-$child_info["dob"]);
		
	}
print_r($child_dob);
die();*/
	$date = new DateTime($pensioner->childDOB);
	$now = new DateTime();
	$age = new DateTime();
	$age = $date->diff($now)->format("%y");

	 $age = $date->diff($now)->format("%y");
	 //$age=date_diff($now,$date);
/**/
	//$currentYear=$now->format("Y");

	if($cnt=="3"){
    	$return = round($enhance_from_upt*50/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";    	
    }else if($cnt=="4"){
    	$return = round($enhance_from_upt*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
    }else{

    	$return = round($enhance_from_upt*100/100);


    	
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
    	$return = round($x_amount*50/100)/$NumberOfWives;
		
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }else if($cnt=="4" && $pensioner->pay_commission==7){
    	$return = round($x_amount*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }elseif($pensioner->pay_commission==7){

    	//$return = round($x_amount*100/100);
		$return = round($x_amount*50/100);
		
				
		if($age>=2018 || $age==0)
		{
			$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
		}
		elseif($age<25)
		{
			//$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." thereafter no family pension</b>";
							$from = new DateTime($pensioner->dor);
							$from->modify('+1 day');
							//$from->format("%y");
							$upto = new DateTime($pensioner->childDOB);
							$upto->modify('+25 years -1 days');
							//$upto->format("%y");
							$differ = $from->diff($upto)->format("%y");

		           			if($differ==10)
		           			{//$enhance_from_upto="<b>N/A</b>";
		           			}
		           			elseif($differ<10)
		           			{
		           				//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')." therefore no family pension</b>";
		           				$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$pensioner->getPensionEndDate()." until earns livelihood or gets married</b>";//therefore no family pension
		           			}
		           			elseif($differ>10)
		           			{
		           				$uptonew = new DateTime($pensioner->dor);
		           				$uptonew->modify('+10 years');
		           				
		           				//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$uptonew->format('d-m-Y')."</b>";
		           				$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$from->format('d-m-Y')." to ".$uptonew->format('d-m-Y')."</b>";
		           			}
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

<?php 

	for ($i=0; $i < $NumberOfWives; $i++) { ?>

	<option value="form1<?php echo $i+1 ?>">Report 1(Forwading Letter)</option>
	<option value="form2<?php echo $i+1; ?>">GPO</option>
	<?php if($pensioner->com_applied == 1) : ?>
		<option value="form3<?php echo $i+1; ?>">CPO</option>
	<?php endif; ?>
	<option value="form4<?php echo $i+1; ?>">Audit Enfacement</option>
	<?php if($account_enfacement == "true") : ?>
	    <option value="form5<?php echo $i+1; ?>">Account Enfacement</option>
	<?php endif; ?>
    <option value="disburser_disburser_portion<?php echo $i+1; ?>">Disburser Portion</option>
	<option value="disburser_pensioner_portion<?php echo $i+1; ?>">Pensioner Portion</option>
	<option value="id_card<?php echo $i+1; ?>">ID Card</option>


<?php } ?>

</select>


<?php 

for ($i=0; $i < $NumberOfWives; $i++) { ?>

<div id="form1<?php echo $i+1 ?>" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold;">
					        <div style="font-family: initial; margin-left: 200px;">OFFICE OF THE<br>DIRECTOR OF AUDIT AND PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH<br/>NAHARLAGUN</div>
					    </div>
					</td>
					<td></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						No. <?php echo $pensioner->case_file_no; ?><br/>To<br/><b><?php 

						//if($NumberOfWives>1){
						    echo $ac=str_replace(", ", ",<br />", $pensioner->getAG($i)).str_replace(", ", ",<br />", $pensioner->getTg($i));

						/*}else
						{ 
							echo $ac; 
						}*/

						 ?></b>
					</td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(13); ?>
					  <p align="justify">I am to forward herewith <b>P.P.O. No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no;

					  if($NumberOfWives!=1){
					   
					  		$alpha=range("A", "J");

					  		echo "(".$alpha[$i].")";

						}

					  ?></b> in favour of <b><?php 
								if($NumberOfWives==1){
								echo $pensioner->getNameOfLegalHeir();	
							}else{
								echo $pensioner->getNameOfLegalHeirX($i+1);
							}?>
							<?php echo nbs(1); ?>of <?php echo strtoupper($pensioner->salutation.' '.$pensioner->name); ?>, Ex. <?php echo $pensioner->designation;?></b> and to request that the pensioner’s portion of the PPO may be made over to him/her after obtaining his/her signature on the disburser’s portion after you have satisfied yourself of his/her identity and payments noted in both the portion as they are made. The slip bearing the left/right hand thumb impressions of the pensioners is also enclosed.</p>
					  <p align="justify">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the pensioner wished to draw his/her pension through an authorized agent, the pensioner's portion of the Pension Payment Order may, on the application by the Pensioner, be sent to the authorized Agent through registered post provided the latter has executed a bond of indemnity to refund over payments. A written acknowledgement of the receipt of the pensioner's portion of the Pension Payment Order should, however, be obtained from the Pensioner through the Agent for record.<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please acknowledge receipt.</p></td>
				</tr>	
                <tr>
					<td style="vertical-align: top;" colspan="4"><b>Enclosed :-
					<ol>
						<li>
							P.P.O. Pensioner's and Disburser's Portion
						</li>
						<li>
							G.P.O.
						</li>
						<li>
							Specimen Signature Slips
						</li>
						<li>
							Photograph
						</li>
						
					</ol></b>
					</td>
				</tr>
				<tr>
					
				</tr>
				
				<tr>
					<td colspan="3"><div style="margin-left:300px;"></div></td>
					<td><div style="margin-top: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours faithfully,<br/><br/><br/>Director/Joint Director</div></td>
					
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">Memo No - <?php echo $pensioner->case_file_no; ?></td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						<div align="justify">
						  <?php $pin = ($pensioner->pin != '') ? '<br />'.nbs(3).'PIN Code - '.$pensioner->pin : ''; ?>
						  
						Copy to:- <br />
						<b>1) 
								<?php 
								if($NumberOfWives==1){
									echo $pensioner->getNameOfLegalHeir();	
								}else{
									echo $pensioner->getNameOfLegalHeirX($i+1);
								}?>

							<?php echo nbs(1); ?>of <?php echo strtoupper($pensioner->salutation.' '.$pensioner->name).',<br />'.nbs(5); echo $pensioner->getAddressAfterRetirement($i).$pin; ?></b>.<br/> He/She should appear before the <b><?php echo $pensioner->treasuryOfficer(); ?></b> to receive payment. If however his/her wish to be exempted from appearing in person to receive his/her pension through an Authorized Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the latter case, the Pension Payment Order will be sent to him/her through Agent.<br/>
						
						<b>2) <?php 
						echo $pensioner->office_address;
						?></b> for information with reference to letter No. <b><?php echo $pensioner->dept_forw_no; ?></b>. The enclosures which are no longer required are returned herewith.<br/>
					<b>3) The Accountant General (A&E), Arunachal Pradesh, Itanagar.</b> </div></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3"></td>
					<td style="vertical-align: top; padding-top: 30px;">Director/Joint Director</td>
					<td style="vertical-align: top;"></td>
				</tr>
			</table>

		</div>
	</div>
</div>



<div id="form2<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print2<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
		             
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
				    echo $pensioner->getDCRG()/$NumberOfWives;
					?>/- (Rupees <?php //if($pensioner->pay_commission==7){ echo no_to_words($bincs);} else{echo no_to_words($pensioner->getDCRG());} 
					echo no_to_words($pensioner->getDCRG()/$NumberOfWives);
					?>)</b> only in lump to <b><?php //echo $spouse.'('.trim($spouse_type).') ';
					if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b> <?php  ?> being the amount of retirement/death gratuity sanctioned to him/her in letter no. <b><?php echo $gpo_no; ?></b> from the Director of Audit & Pension, debitable to 2071 Pension & ORB etc.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">2.<?php echo nbs(4); ?>The particulars regarding his/her identification are/were enclosed along with PPO No. <b><?php echo $ppo_no;

					if($NumberOfWives!=1){
					   
					  		$alpha=range("A", "J");

					  		echo "(".$alpha[$i].")";

						}

					  ?></b>. </div></td>
				</tr>
				<tr>
					<td colspan="4"><b>Below Rs.<?php //if($pensioner->pay_commission==7){ echo $bincs+1;} else{echo $pensioner->getDCRG()+1;} 
				    echo $pensioner->getDCRG()/$NumberOfWives+1;
					?>/- (Rupees <?php //if($pensioner->pay_commission==7){ echo no_to_words($bincs+1);} else{echo no_to_words($pensioner->getDCRG()+1);}
					echo no_to_words($pensioner->getDCRG()/$NumberOfWives+1);
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
					<td colspan="2"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity/$NumberOfWives; ?></b></div></td>
					<td colspan="1"></td>
					<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours faithfully,</td>
					<!-- <td></td> -->
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
						<td style="padding-top: 28px;text-align: left;">Director/Joint Director</td>
					<?php else : ?>
						<td style="padding-top: 28px;text-align: left;">Director/Joint Director</td>
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
					if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>  <?php 
					$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ echo $pensioner->getAddressAfterRetirement($i);
					?>, <?php
					}
					elseif($age>='25')
					{ echo $pensioner->getAddressAfterRetirement($i);
					?>, <?php
					}
					?></b>, Arunachal Pradesh Government pensioner. He/She should appear before the Treasury Officer /Sub Treasury Officer/Bank, <b><?php 

					if($NumberOfWives>1)
						{
						    echo $pensioner->getAG($i).$pensioner->getTg($i);

						}else
						{ 
							echo $pensioner->sub_to; 
						}

					?></b>, to receive payment. If however his/her wished to be exempted from appearing in person to receive his/her pension through an Authorised Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the later case, the Pension Payment order will be sent to his/her through Agent.</div></td>
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



<div id="form3<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print3<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print3<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>I am to request you to make necessary arrangement for payment of <b>Rs.<?php echo $pensioner->getCommutationOfPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutationOfPension());?>)</b> being the commuted value of <b>Rs. <?php echo $pensioner->getCommutedValue(); ?>/- (Rupees <?php echo no_to_words($pensioner->getCommutedValue());?>)</b> out of pension of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>)</b> per month granted to <b> <?php 
								if($NumberOfWives==1){
									echo $pensioner->getNameOfLegalHeir();	
								}else{
									echo $pensioner->getNameOfLegalHeirX($i+1);
								}?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", ".$pensioner->designation; ?></b>, holder of PPO No: - <b><?php echo $ppo_no; ?>.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>Consequent on commutation, the reduced rate of pension in respect of <b><?php echo strtoupper($pensioner->salutation." ".$pensioner->name); ?></b>, <b><?php echo $pensioner->designation; ?></b> should be <b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/- (Rupees <?php echo no_to_words($pensioner->getOrdinaryRate());?>)</b> per month. The reduction in the amount of pension shall become operative from the date of receipt of the commuted value of pension by <b><?php if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					} ?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", ".$pensioner->designation; ?></b> or three months after the issue of authority by you asking him/her to collect the commuted value of pension whichever is earlier. Necessary instructions regarding the date from which the pension is to be reduced may also kindly be issued to the Treasury Officer <b><?php echo $pensioner->sub_to; ?></b>. from which the pensioner is drawing the pension</b></div></td>
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
					<td colspan="4" style="padding: 5px 0;"><div align="left">i. <b><?php if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					} ?> of <?php echo strtoupper($pensioner->salutation." ".$pensioner->name).", Ex. ".$pensioner->designation;?></b></div></td>
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


<div id="form4<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print4<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print4<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
					if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b> <?php  ?></td>
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
		                echo $pensioner->getDCRG()/$NumberOfWives;
		                ?>/-</b></br>
		                <b>COMMUTATION RS. <?php if($pensioner->pay_commission==7 && $pensioner->dor==$pensioner->dod){ echo 'N/A';}elseif($pensioner->pay_commission==7){ echo $bigbazars;} else{echo $pensioner->getCommutationOfPension();} ?>/-</b></br>
		                <b><?php //echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
												
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
										
					
						if($age>=2018 || $age==0)
						{
							if($NumberOfWives==1){
								echo $pensioner->getEnhanceRate(); 	
							}else{
								echo $pensioner->getEnhanceRateX($NumberOfWives);
							}
							//echo $pensioner->getEnhanceRate()/$NumberOfWives; 
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
					
					?> (Enhanced Rate)</b></br><b>Rs. <?php 
									
					
						
					if($age>=2018 || $age==0)
					{
						echo $pensioner->getOrdinaryRate()/$NumberOfWives;

						
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
						//echo 'N/A';
							$from = new DateTime($pensioner->dor);
							$from->modify('+1 day');
							$from->format("%y");
							$upto = new DateTime($pensioner->childDOB);
							$upto->modify('+25 years -1 days');
							$upto->format("%y");
		           			$differ = $from->diff($upto)->format("%y");

		           			if($differ==10)
		           			{echo 'N/A';}
		           			elseif($differ<10)
		           			{
		           				//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')." therefore no family pension</b>";
		           				echo 'N/A';
		           			}
		           			elseif($differ>10)
		           			{
		           				$fromnew = new DateTime($pensioner->dor);
		           				$fromnew->modify('+10 years +1 day');
		           				
		           				echo $pensioner->getOrdinaryRate()." <b>from ".$fromnew->format('d-m-Y')." upto ".$upto->format('d-m-Y')." therefore no family pension</b>";
		           			}
					}
									
			 ?>
					<!-- <?php if($pensioner->pay_commission==7){echo $total_amount*30/100;} else{echo $pensioner->getOrdinaryRate();} ?> --> (Ordinary Rate)</b></td>
				</tr>
			 	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (b) To whom admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php //echo $pensioner->getNameofSpouse(); 
					if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}?></b></td>
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
						<?php

						if($NumberOfWives>1)
						{
							echo $pensioner->getAllGratuityStatusX($NumberOfWives);
						}
						else
						{
							echo $pensioner->getAllGratuityStatus();
						}
						 

						  ?>
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

<div id="form5<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print5<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print5<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
					if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}
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


<div id="disburser_disburser_portion<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print6<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print6<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
						<div style="float: left;"><b><?php if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					} ?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation;  ?>
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
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->getDOBOfLegalHeirX($i+1);?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->getAddressAfterRetirement($i); ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="20%"><b>
								<?php 
							$temp_result=getRecordsByTableID('pensioner_personal_details','case_no',$pensioner->case_file_no);
							if($temp_result[0]["lap_amount"]!="" || $temp_result[0]["lap_amount"]!=NULL){
								$lap_text= "N.B.- Life time arrear pension w-e-f: ".$temp_result[0]["lap_from"]." to ".$temp_result[0]["lap_to"]." amount of Rs.".$temp_result[0]["lap_amount"]."</br>";
							}
							?>

									<?php echo $enhance_from_upto;  //echo 'Age:'.$age."";
								//echo $pensioner->getEnhanceRate(); ?><?php 
								if($age>=2018 || $age==0)
								{ }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ ?>, thereafter consolidated revised pension of Rs. <?php echo $pensioner->getEnhanceRateConsolidated_PPOreport(); } ?> <?php 
								
								if($age>=2018 || $age==0)
								{ echo '& thereafter ordinary rate of Rs.'; }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ }
								elseif($age>=25 && $pensioner->consolidated==0)
								{ //echo '& thereafter ordinary rate of Rs.'; 
									//echo 'N/A';
								}
								elseif($age<25)
								{
									//echo 'N/A';
									 //echo '& thereafter ordinary rate of Rs.';
									$from = new DateTime($pensioner->dor);
									$from->modify('+1 day');
									$from->format("%y");
									$upto = new DateTime($pensioner->childDOB);
									$upto->modify('+25 years -1 days');
									$upto->format("%y");
									$differ = $from->diff($upto)->format("%y");

									if($differ==10)
									{//echo 'N/A';
									}
									elseif($differ<10)
									{
										//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')." therefore no family pension</b>";
										//echo 'N/A';
									}
									elseif($differ>10)
									{
										$fromnew = new DateTime($pensioner->dor);
										$fromnew->modify('+10 years +1 day');
										
										echo "& thereafter ordinary rate of Rs. ".$pensioner->getOrdinaryRate()."<b>/- PM".$pensioner->getDRMA()." w.e.f. ".$fromnew->format('d-m-Y')." to ".$upto->format('d-m-Y')." therefore no family pension</b>";
									} 
								}
							    //else
							    //{ echo '& thereafter ordinary rate'; }
								?> <?php 
				
										
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
								echo 'Rs. '.$pensioner->getOrdinaryRate()/$NumberOfWives;//}
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
								?>/-PM<?php echo $pensioner->getDRMA(); ?> w.e.f <?php if($pensioner->pay_commission==7){ echo $ordinary_from_upto_seven;} else{echo $ordinary_from_upto;}?> --> </b></td>
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
					<td > &nbsp;</td>
					<td ><strong><?php echo $lap_text;?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top; text-align:center" colspan="4">
						<div style="font-size: 15px; margin-top: 0px;">OFFICE OF THE DIRECTOR OF AUDIT AND PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"><strong>No. <?php //echo $pensioner->case_no."/".$pensioner->ppo_no; 
					echo $pensioner->case_file_no."/".$pensioner->ppo_no;
					if($NumberOfWives!=1){
					   
					  		$alpha=range("A", "J");

					  		echo "(".$alpha[$i].")";

						}
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
							
														
							if($age>=2018 || $age==0)
							{							
								//$pensionDate=$pensioner->dateTimeToDate($pensioner->effect_of_pension); 
								$pensionDate= $pensioner->getPensionCommencementDate(); 
							}							
							elseif($age<25)
							{
								$pensionDate=$pensioner->getPensionCommencementDate(); 
							}
							elseif($age>=25 && $pensioner->consolidated==1)
							{
								$pensionDate=$pensioner->getPensionCommencementDate(); 
							}
							elseif($age>=25 && $pensioner->consolidated==0)
							{
								$pensionDate=$pensioner->getPensionCommencementDate(); 
							}
							
	echo nbs(6);?> UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b> <?php if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}
					 ?>  of <?php echo strtoupper($salutation." ".$pensioner->name).' Ex .'.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate/$NumberOfWives.'/-</b>PM'.$pensioner->getDRMA().' './*str_replace(['E/R', ''], '', $enhance_from_upto).*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from './*date_format(date_create($pensioner->effect_of_pension), "d-m-Y")*/$pensionDate.'</b>.&nbsp';//strtoupper($spouse).'('.strtoupper($spouse_type).')'.' of Late '.$pensioner->name.' Ex-'.$pensioner->designation


							}
						?>
			 		</td>
				</tr>			
	 					<?php
	 						
	 						$temp_date=explode(",", $pensioner->getDOBofSpouse());
	 						$dob 	= new DateTime($temp_date[sizeof($temp_date)-1]);//$pensioner->getDOBofSpouse());//dob
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
						b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity/$NumberOfWives; ?><br/>
						d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances/$NumberOfWives; ?><br />
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

						<?php /*if($NumberOfWives>1){

							echo $pensioner->getAG($i).$pensioner->getTg($i).' '.$pensioner->bank_name.' '.$account_no;;
						}else{
							echo $pensioner->treasury_name;

						}*/
						echo $ac=str_replace(", ", ",<br />", $pensioner->getAG($i)).str_replace(", ", ",<br />", $pensioner->getTg($i));
						 ?></b>
					</td>
					<td align="right">
						Designation_______________
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>


<div id="disburser_pensioner_portion<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print7<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print7<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
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
						<div style="float: left;"><b><!-- <?php echo nbs(2).''. $spouse;?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?> -->
						<!--<?php echo nbs(2).''. $spouse.'('.$spouse_type.') ';?>of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?>	-->
						<?php if($NumberOfWives==1){
								echo $pensioner->getNameOfLegalHeir();	
							}else{
								echo $pensioner->getNameOfLegalHeirX($i+1);
							}

							?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation;  ?>
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
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->getDOBOfLegalHeirX($i+1);?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->getAddressAfterRetirement($i); ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="20%"><b>
							<?php 
							$temp_result=getRecordsByTableID('pensioner_personal_details','case_no',$pensioner->case_file_no);
							if($temp_result[0]["lap_amount"]!="" || $temp_result[0]["lap_amount"]!=NULL){
								$lap_text= "N.B.-Life time arrear pension w-e-f: ".$temp_result[0]["lap_from"]." to ".$temp_result[0]["lap_to"]." amount of Rs. ".$temp_result[0]["lap_amount"]."</br>";
							}
							?>
									<?php echo $enhance_from_upto; 
								//echo $pensioner->getEnhanceRate(); ?><?php 
								if($age>=2018 || $age==0)
								{ }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ ?>, thereafter consolidated revised pension of Rs. <?php echo $pensioner->getEnhanceRateConsolidated_PPOreport(); } ?> <?php 
								
								if($age>=2018 || $age==0)
								{ echo '& thereafter ordinary rate of Rs.'; }
								elseif($age>=25 && $pensioner->consolidated==1)
								{ }
								elseif($age>=25 && $pensioner->consolidated==0)
								{ //echo '& thereafter ordinary rate of Rs.'; 
								}
								elseif($age<25)
								{
									//echo 'N/A';
									 //echo '& thereafter ordinary rate of Rs.';
									$from = new DateTime($pensioner->dor);
									$from->modify('+1 day');
									$from->format("%y");
									$upto = new DateTime($pensioner->childDOB);
									$upto->modify('+25 years -1 days');
									$upto->format("%y");
									$differ = $from->diff($upto)->format("%y");

									if($differ==10)
									{//echo 'N/A';
									}
									elseif($differ<10)
									{
										//$return.= " <b>from ".$from->format('d-m-Y')." upto ".$upto->format('d-m-Y')." therefore no family pension</b>";
										//echo 'N/A';
									}
									elseif($differ>10)
									{
										$fromnew = new DateTime($pensioner->dor);
										$fromnew->modify('+10 years +1 day');
										
										echo "& thereafter ordinary rate of Rs. ".$pensioner->getOrdinaryRate()."<b>/- PM".$pensioner->getDRMA()." w.e.f. ".$fromnew->format('d-m-Y')." to ".$upto->format('d-m-Y')." therefore no family pension</b>";
									}
								}
							    //else
							    //{ echo '& thereafter ordinary rate'; }
								?> <?php 
				
										
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
								echo 'Rs. '.$pensioner->getOrdinaryRate()/$NumberOfWives;//}
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
					elseif($age<25)
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
					<td></td>
					<td><strong><?php echo $lap_text;?></strong></td>
				</tr>
				<tr>
					<td style="vertical-align: top; text-align:center" colspan="4">
						<div style="font-size: 15px; margin-top: 0px;">OFFICE OF THE DIRECTOR OF AUDIT AND PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="2"><strong>No. <?php //echo $pensioner->case_no."/".$pensioner->ppo_no; 
					echo $pensioner->case_file_no."/".$pensioner->ppo_no;
					if($NumberOfWives!=1){
					   
					  		$alpha=range("A", "J");

					  		echo "(".$alpha[$i].")";

						}
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
							
	echo nbs(6); ?> UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b><?php  if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					} ?> of <?php echo strtoupper($salutation." ".$pensioner->name).' Ex .'.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate/$NumberOfWives.'/-</b>PM'.$pensioner->getDRMA().' './*$enhance_from_upto.*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from './*date_format(date_create($pensioner->effect_of_pension), "d-m-Y")*/$pensionDate.'</b>.&nbsp';//strtoupper($spouse).'('.strtoupper($spouse_type).')'.' of Late '.$pensioner->name.' Ex-'.$pensioner->designation
							}
						?>
			 		</td>
				</tr>
				
				<?php
							$temp_date=explode(",", $pensioner->getDOBofSpouse());
							$dob 	= new DateTime($temp_date[sizeof($temp_date)-1]);

							//$dob 	= new DateTime($pensioner->getDOBofSpouse());//dob
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
						b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity/$NumberOfWives; ?><br/>
						d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances/$NumberOfWives; ?><br />
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
						
						<?php /*if($NumberOfWives>1){

							echo $pensioner->getAG($i).$pensioner->getTg($i).' '.$pensioner->bank_name.' '.$account_no;;
						}else{
							echo $pensioner->treasury_name;

						}*/
						echo $ac=str_replace(", ", ",<br />", $pensioner->getAG($i)).str_replace(", ", ",<br />", $pensioner->getTg($i));

						 ?></b>
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

<div id="id_card<?php echo $i+1; ?>" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print8<?php echo $i+1 ?>')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print8<?php echo $i+1 ?>" style="width: 1000px; margin: 0px auto;">
		<!-- <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"> -->

			<table width="100%" cellpadding="3" id="report" border="0"> 
				<tr>
					<td style="font-size:15px;">
					<table width="70%" height="265px" id="report" border="1" style="background-image:url('http://10.0.0.4/pension_uiold/id_card_logo/idcard_front.jpg');background-repeat:no-repeat;background-size:cover;"> <!--class="table1">-->
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
									Name: <b><?php if($NumberOfWives==1){
						echo $pensioner->getNameOfLegalHeir();	
					}else{
						echo $pensioner->getNameOfLegalHeirX($i+1);
					}?> of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>,<?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b><br/>
									Address: <b><?php echo $pensioner->getAddressAfterRetirement($i);

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
					<table width="450px" id="report" border="1" style="background-image:url('http://10.0.0.4/pension_uiold/id_card_logo/idcard_back.jpg');background-repeat:no-repeat;background-size:cover;">
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
							echo $pensioner->getDOBOfLegalHeirX($i+1);?></b></td>
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
							<td><b>N/A<!-- <?php 
							if($pensioner->pay_commission==7)
								{ echo "Rs. ".($total_amount*50/100)/$NumberOfWives;} 
							else
								{
									if($amount_pension=="N/A")
									{echo "N/A";}
									else
									{echo "Rs. ".$amount_pension/$NumberOfWives;}
								}
									?> --></b></td>
						</tr>
						<tr>
							<td></td>
							<td>P.P.O No.</td>
							<td>:</td>
							<td><b><?php echo $pensioner->case_file_no."/".$pensioner->ppo_no;
							if($NumberOfWives!=1){
					   
					  		$alpha=range("A", "J");

					  		echo "(".$alpha[$i].")";

						}
							; ?></b></td>
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

<?php }  ?>



<script type="text/javascript">
	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hideAll();
				$('#'+val).show();
			}
		});

		$("#select-form-to-print").val("form11").change();
	});

	function hideAll() {
		<?php 

	for ($i=0; $i < $NumberOfWives; $i++) { ?>

		$('#form1<?php echo $i+1; ?>, #form2<?php echo $i+1; ?>, #form3<?php echo $i+1; ?>, #form4<?php echo $i+1; ?>, #form5<?php echo $i+1; ?>, #disburser_disburser_portion<?php echo $i+1; ?>, #disburser_pensioner_portion<?php echo $i+1; ?>, #id_card<?php echo $i+1; ?>').hide();

	<?php } ?>

	}
</script>