<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.mb.browser.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.printElement.min.js"></script>

<?php //$abc = $values[0]; ?>
<?php $pensioner = $records; ?>
<?php
if($pensioner->dod > $pensioner->dor) :
		$fiveandsix = 'Retirement';
		$expired_statement = '<span style="font-size:12px; color: red;font-weight: bold;"> (Expired on '.$pensioner->dateTimeToDate($pensioner->dod).')</span>';
		$salutation = 'Shri';
		//$sixteen	= 'Retirement Gratuity';
	elseif($pensioner->dod == $pensioner->dor) :
		$fiveandsix = 'Death';
		$expired_statement = '';
		$salutation = 'Late';
		//$sixteen	= 'Death Gratuity';
	endif;
	$total_amount=$pensioner->total_amount;
	$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
	$ac 		= ($pensioner->name_of_accountant_general != '') ? $pensioner->sub_to : $pensioner->treasury_name;
	
	$payable 	= $ac.' '.$pensioner->bank_name.' '.$account_no;
	?>

<?php
$class_of_pension=$pensioner->class_of_pension;
$spouse=explode('-',$pensioner->getNameofSpouse());
$cnt=count($spouse);

if($class_of_pension=="Normal_Family_Pension"){
	$class_of_pension="Family_Pension";
	}
if(count($pensioner->getNameofSpouse())==2) {
	
	
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
	$enhan_upto->modify('+10 year -1 day');
	
	//seven pay
	$enhan_upto_seven= new DateTime($pensioner->dod);
	$enhan_upto_seven->modify('+10 year');
	//seven
	
    $enhance_from_upt=0;//$pensioner->getEnhanceRate_sanjay(false);
	$x_amount=$pensioner->total_amount;
	
    if($cnt=="3"){
    	$return = round($enhance_from_upt*50/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
    	 
    }else if($cnt=="4"){
    	$return = round($enhance_from_upt*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
    }else{

    	// $return = round($enhance_from_upt*100/100);
    	// $enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
        $return = $pensioner->getEnhanceRate();
        $enhance_from_upto="<b>E/R of Rs.".$return;
    }

	
	//seven pay
	if($cnt=="3" && $pensioner->pay_commission==7){
    	$return = round($x_amount*50/100);
		
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }else if($cnt=="4" && $pensioner->pay_commission==7){
    	$return = round($x_amount*34/100);
    	$enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
    }else{

    	// $return = round($x_amount*50/100);
    	// $enhance_from_upto="<b>E/R of Rs.".$return."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto_seven->format('d-m-Y')."</b>";
        $return = $pensioner->getEnhanceRate();
        $enhance_from_upto="<b>E/R of Rs.".$return;
    }
	
	

	
    //$enhance_from_upto="<b>E/R of Rs.".$enhance_from_upt."/- PM".$pensioner->getDRMA()." w.e.f. ".$enhan_from->format('d-m-Y')." to ".$enhan_upto->format('d-m-Y')."</b>";
	
	$ordinary_from=$enhan_upto->modify('+2 day');
	$ordinary_from_upto="<b>from ".$ordinary_from->format('d-m-Y')." until <br/> 
	    (1)gets married or starts earning or attains the age of 25 years.<br/>
		(2)up to the date of marriage or starts earning.<br/>
		(3)up to the date of re-marriage or starts earning.<br/>
		(4)gets re-married or death."."</b>";
	//"<b> ".$ordinary_from->format('d-m-Y')." to until her death or remarriage whichever is earlier"."</b>";
	
	//seven pay
	$ordinary_from_seven=$enhan_upto_seven->modify('+1 day');
	$ordinary_from_upto_seven="<b>from ".$ordinary_from_seven->format('d-m-Y')." until <br/> 
	    (1)gets married or starts earning or attains the age of 25 years.<br/>
		(2)up to the date of marriage or starts earning.<br/>
		(3)up to the date of re-marriage or starts earning.<br/>
		(4)gets re-married or death."."</b>";
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
	$ordinary_from_upto="<b>from ".$ordinary_from->format('d-m-Y')." until <br/> 
	    (1) gets married or starts earning or attains the age of 25 years.<br/>
		(2)up to the date of marriage or starts earning.<br/>
		(3)up to the date of re-marriage or starts earning.<br/>
		(4)gets re-married or death."."</b>";
	// "<b> ".$ordinary_from->format('d-m-Y')." to until her death or remarriage whichever is earlier"."</b>";
	
	//$life_time_from_upto=$val['revised_amount_of_pension']." <b>from ".$from->format('d-m-Y')." upto ".$val['dod']."</b>";

	//seven pay
	$ordinary_from_seven=$enhan_upto_seven->modify('+1 day');
	$ordinary_from_upto_seven="<b>from ".$ordinary_from_seven->format('d-m-Y')." until <br/> 
	    (1)gets married or starts earning or attains the age of 25 years.<br/>
		(2)up to the date of marriage or starts earning.<br/>
		(3)up to the date of re-marriage or starts earning.<br/>
		(4)gets re-married or death."."</b>";
	//seven pay
	
    $commuted_value=$pensioner->getCommutedValue();
	
}
?>
<?php
	$ppo_no = $pensioner->case_no."/".$pensioner->ppo_no;
	$gpo_no = 'Pen/AP/GPO/'.$pensioner->gpo_no;
	//$cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;
	$acname = ($pensioner->treasury_officer!='') ? nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->treasury_name): nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->accountant_general_name);

	if($pensioner->dod > $pensioner->dor || $pensioner->dod == '0000-00-00') :
		$enhance_rate_period = '7';
	elseif($pensioner->dod == $pensioner->dor) :
		$enhance_rate_period = '10';
	endif;

	$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
	$payable = $pensioner->treasury_name.' '.$pensioner->bank_name.' '.$account_no;
	$total_amount=$pensioner->total_amount;
?>


<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1" selected>Working Sheet</option>
	<option value="form2">Forwarding Letter</option>
	<option value="form3">Disburser Portion</option>
	<option value="form4">Pensioner Portion</option>
</select>

<script type="text/javascript">
    /*jQuery(function($) {
		$('#printReport').click(function() {
			$("#print").printElement({
				printMode:'popup'
			});
		});
    });*/
</script>

 <div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"><!-- style="width:900px; margin: 0px auto; min-height:600px; color:#000000; background-color:#FFFFFF;"> -->
      
     <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	      <p align="center"><strong><u>WORKING-CUM-ASSESSMENT SHEET OF</u></strong></p>
        <strong><u>RE-AUTHORIZATION  OF FAMILY PENSION</u></strong></div>
	    <!-- <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.4em"> -->
	    <div style="padding-top:20px">
	        <div style="float:left; padding-left:20px">
	        	<strong>No. <?php //echo $pensioner->case_no; 
				echo $pensioner->case_file_no;
				?></strong>
	        </div>
	      	<div style="float:right;padding-right:20px">
	        	<strong>Date</strong>: <?php echo date('d/m/Y')?>
	        </div>
	  	</div>
        <!-- <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.4em"> -->
		<table width="100%" border="0" cellpadding="2" id="report">
			<tr>
				<td valign="top" width="6%"><div align="right">1.</div></td>
				<td valign="top" width="33%">Name  of the Rtd./Ex. Govt. Servant</td>
			  <td valign="top" width="1%">:</td>
				<td valign="top" width="60%"><b><?php echo $salutation." ".$pensioner->name; ?></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">2.</div></td>
				<td valign="top">Date of <?php echo $fiveandsix;?></td>
			  <td valign="top">:</td>
				<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor).$expired_statement; ?></b></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right">3.</div></td>
				<td valign="top">Date  of Death/ Re-marriage of Spouse</td>
			  <td valign="top">:</td>
				<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->dod_spouse);  ?></b></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right">4.</div></td>
				<td valign="top">Date  of cessation of Family Pension of child</td>
			  <td valign="top">:</td>
				<td valign="top"><b></b></td>
		  </tr>

			<tr>
				<td valign="top"><div align="right">5.</div></td>
				<td valign="top">Ground  of cessation of Family Pension</td>
			  <td valign="top">:</td>
				<td valign="top"><b>Attained 25 yrs. of age/ Married/  started earning  livelihood etc.</b></td>
		  </tr>

			<tr>
				<td valign="top"><div align="right">6.</div></td>
				<td valign="top">Name  of the claimant</td>
			  <td valign="top">:</td>
				<td valign="top"><b><?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?></b></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right">7.</div></td>
				<td valign="top">Date  of birth of the claimant</td>
			  <td valign="top">:</td>
				<td valign="top"><b><?php echo $pensioner->dateTimeToDate($pensioner->claiment_dob); ?></b></td>
		  </tr>
			
			<tr>
				<td valign="top"><div align="right">8.</div></td>
				<td valign="top">In order of the birth of the claimant  (as per record)</td>
				<td valign="top">:</td>
				<td valign="top"><b></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">9.</div></td>
				<td valign="top">Income  of the claimant</td>
				<td valign="top">:</td>
				<td valign="top"><b></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">10.</div></td>
				<td valign="top">Marital  status of the claimant</td>
				<td valign="top">:</td>
				<td valign="top"><b></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">11.</div></td>
				<td valign="top">Name of the Guardian (if Minor, physically/Mentally challenge)</td>
				<td valign="top">:</td>
				<td valign="top"><b><?php //echo $pensioner->getNameOfLegalHeir(); ?></b></td>
			</tr>
			
			<!-- <tr style="height:40px;"> -->
			<tr>
				<td valign="top"><div align="right">12.</div></td>
				<td valign="top">Form  submitted</td>
				<td valign="top">:</td>
				<td valign="top" colspan="3"><b>14,20/21</b></td>
			</tr>
			<!-- <tr style="height:50px;"> -->
			<tr>
				<td valign="top"><div align="right">13.</div></td>
				<td valign="top">Document  submitted</td>
				<td valign="top">:</td>
				<td valign="top"><b>Specimen signature,  Descriptive roll, photograph (both				    Claimant &amp; Guardian), Last Pay Certificate, Death Certificate,  Succession Certificate, Birth Certificate, Income  Certificate, Marriage Certificate, Non-marriage Certificate, Legal  Guardianship Certificate, No Objection Certificate, PPO both halves (in original).</b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">14.</div></td>
				<td valign="top">Remark/  Observations&nbsp; </td>
				<td valign="top">:</td>
				<td valign="top"><b></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">15.</div></td>
				<td valign="top">Last  Pension Payment paid up to @</td>
				<td valign="top">:</td>
				<td valign="top"><b>Rs. <?php 
                    if($pensioner->pay_commission==7)
                    {echo $total_amount;}
                    else
					{echo $pensioner->getLastPay(); }
					?>/- PM</b></td>
			</tr>

			<tr>
				<td valign="top"><div align="right">16.</div></td>
				<td valign="top">Family  Pension</td>
				<td valign="top">:</td>
				<td valign="top"><b>  <p>(i) E/R= Rs. 
				  <?php 
				echo $pensioner->getEnhanceRate(); 
				?> 
				  </p>
			    <p>(ii) O/R= Rs. 
			      <?php 
				//echo $pensioner->getOrdinaryRate();
				 if($pensioner->pay_commission==7){ echo ($total_amount*30/100);} else{echo $pensioner->getOrdinaryRate();}  ?> (<?php echo "<b>from ".$ordinary_from->format('d-m-Y')." until ".$pensioner->benificery_type; ?>)</p></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">17.</div></td>
				<td valign="top">Name  of Treasury</td>
				<td valign="top">:</td>
				<td valign="top"><b><?php echo $payable; ?></b></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">18.</div></td>
				<td valign="top">Address  of the claimant</td>
				<td valign="top">:</td>
				<td valign="top"><b><?php echo $pensioner->address_after_retirement; ?></b></td>
			</tr>
			

		

		    <tr>
				<td valign="top"><div align="right">19.</div></td>
				<td valign="top">Recovery/  Adjustment (if any)</td>
				<td valign="top">:</td>
				<td valign="top"><b></b></td>
			</tr>
			<tr style="height:100px;">
				<td valign="top"></td>
				<td valign="top"></td>
				<td valign="top"></td>
				<td valign="top"></td>
			</tr>
			<tr>
				<!-- <td valign="top"><div align="right"></div></td>
				<td valign="top"><p>&nbsp;</p>
			    <p><strong>DA</strong></p></td>
				<td valign="top"><p>&nbsp;</p>
			    <p><strong>Supdt.(Pen)</strong></p></td>
				<td valign="top"><p>&nbsp;</p>
			    <p><strong><div align="center">DAP</div></strong></p></td> -->
			    <td valign="top"><div align="right"><strong>D.A</strong></div></td>
				<td valign="top"><div align="right"><strong>Supdt.(Pen)</strong></div></td>
				<td valign="top"></td>
				<td valign="top"><div align="center"><strong>DAP</strong></div></td>
			</tr>
		</table>

	</div>
	</div>

<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print2');"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
		
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td width="24%"></td>
					<td width="25%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold;">
					        <div style="font-family: initial; margin-left: 200px;">GOVERNMENT OF ARUNACHAL PRADESH<br/>DIRECTORATE OF AUDIT AND PENSION<br/><u>NAHARLAGUN</u></div>
					    </div>					</td>
					<td></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						No. <?php echo $pensioner->case_file_no; ?><br/>To<br/><b><?php echo $acname; ?></b>					</td>
					<td style="vertical-align: top;">Date - <?php echo date('d/m/Y')?></td>		
				</tr>
			 	<tr>
			 	  <td style="vertical-align: top;" colspan="4"><br/><br/><p>Sub:- Re-authorization of family  pension in respect of <b><?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?> of <?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, <?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b> holder of PPO No. <b><?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?>.</b></p>
			 	               
		 	      </td>
		 	  </tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(13); ?>
					  <p align="justify">I  am to forward herewith the PPO both halves of <b><?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?>, Ex-<?php echo $pensioner->designation;?> </b>for  payment of family pension from your end after observing required formalities.  Authorization made in the PPO both halves. The specimen signature and  descriptive roll of the claimant enclosed.</p>
					  <p align="justify">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entries  of payment may be made in the PPO both halves.</p>
				  <p align="justify">&nbsp;</p></td>
				</tr>	
                <tr>
					<td style="vertical-align: top;" colspan="4"><b>Enclo :- Stated above</b>					</td>
				</tr>
				<tr>
					
					<!--<td style="vertical-align: top; text-align:left;">Yours faithfully,</td>
					<td style="vertical-align: top; text-align:right;">Director/Joint Director</td>-->
				</tr>
				
				<tr>
					<td colspan="3"></td>
					<td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours faithfully,<br/><br/><br/><br/>Joint  Director of Audit & Pension,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Govt.  of Arunachal Pradesh<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Naharlagun.<br/>
				        </p>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3">Memo No - <?php echo $pensioner->case_file_no; ?></td>
					<td style="vertical-align: top;">Date - <?php echo date('d/m/Y')?></td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">
						<div align="justify">
						  <?php $pin = ($pensioner->pin != '') ? '<br />'.nbs(3).'PIN Code - '.$pensioner->pin : ''; ?>
						  
						Copy to:- <br />
						<b>1) <?php //echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?>
						<?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?><br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pensioner->address_after_retirement;

						?>	
						</b>. <br/>
						
					  <b>2) Office copy.</b></div></td>
				</tr>
				<tr>
					<td colspan="3" style="vertical-align: top;"></td>
					<td style="vertical-align: top; padding-top: 0px;"><p>Joint  Director of Audit & Pension,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Govt.  of Arunachal Pradesh<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Naharlagun.<br/>
				        </p></td>
					<td width="1%" style="vertical-align: top;"></td>
				</tr>
			</table>
			
	  </div>
	</div>
</div> 

<div id="form3" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print3')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print3" style="width: 1000px; margin: 0px auto;">
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
						<div style="float: left;"><b>&nbsp;<?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b></div>
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
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->dateTimeToDate($pensioner->claiment_dob);	
								?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->address_after_retirement; ?></b></td>
								<td style="vertical-align: top; text-align: left;" width="20%"><b><?php echo $enhance_from_upto;?> and N/R of Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount*30/100;} else{echo $pensioner->getOrdinaryRate();} ?> (<?php  echo "<b>from ".$ordinary_from->format('d-m-Y')." until ".$pensioner->benificery_type; ?>) <?php //if($pensioner->pay_commission==7){ //echo $ordinary_from_upto_seven;} else{echo $ordinary_from_upto;
									//}?></b></td><!-- /-PM<?php echo $pensioner->getDRMA(); ?> w.e.f-->
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
							$orrate= $pensioner-> getLastPay();
							}
							if(in_array($class_of_pension, $array)) 
							{
								echo nbs(6);echo  'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to '.strtoupper($pensioner->salutation." ".$pensioner->name).' Rtd '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$pensioner->getAmountofPension().'/-</b>PM'.$pensioner->getDRMA().' w.e.f  only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.<br/>&nbsp';
								$attained_age = ($pensioner->designation == "Teacher" || $pensioner->designation == "MTF(group D)") ? '67' : '65';
								echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-';
							}
							else
							{// means family pension

	echo nbs(6);echo 'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.strtoupper($pensioner->claiment_name).' - '.strtoupper($pensioner->son_daughter).' of Late '.$pensioner->name.' Ex- '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate.'/-</b>PM'.$pensioner->getDRMA().' './*str_replace(['E/R', ''], '', $enhance_from_upto).*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.&nbsp';


							}//strtoupper($spouse)
						?>
			 		</td>
				</tr>			
	 					<?php
							$dob 	= new DateTime($pensioner->dateTimeToDate($pensioner->claiment_dob));//dob $pensioner->getDOBofSpouse()
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
<div id="form4" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print4')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print4" style="width: 1000px; margin: 0px auto;">
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
						<div style="float: left;"><b>&nbsp;<?php echo $pensioner->claiment_name;?> - <?php echo $pensioner->son_daughter?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name); ?>, <br /><?php echo nbs(1); ?>Ex. <?php echo $pensioner->designation; ?></b></div>
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
								<td style="vertical-align: top; text-align: center;" width="20%"><b><?php echo str_replace("_", " ", $class_of_pension); ?><br/>w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php //echo $pensioner->getDOBofSpouse(); 
								echo $pensioner->dateTimeToDate($pensioner->claiment_dob);	
								?></b></td>
								<td style="vertical-align: top; text-align: center;" width="0%"><b><?php echo $pensioner->religion.", ".$pensioner->nationality;?></b></td>
								<td style="vertical-align: top; text-align: center;" width="30%"><b><?php echo $pensioner->address_after_retirement; ?></b></td>
								<td style="vertical-align: top; text-align: left;" width="20%"><b><?php echo $enhance_from_upto;?> and N/R of Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount*30/100;} else{echo $pensioner->getOrdinaryRate();} ?> (<?php echo "<b>from ".$ordinary_from->format('d-m-Y')." until ".$pensioner->benificery_type; ?>)<?php //if($pensioner->pay_commission==7){ echo $ordinary_from_upto_seven;} else{echo $ordinary_from_upto;}?></b></td><!-- /-PM<?php echo $pensioner->getDRMA(); ?> w.e.f-->
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
								echo nbs(6);echo  'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to '.strtoupper($pensioner->salutation." ".$pensioner->name).' Rtd '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$pensioner->getAmountofPension().'/-</b>PM'.$pensioner->getDRMA().' w.e.f  only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.<br/>&nbsp';
								$attained_age = ($pensioner->designation == "Teacher" || $pensioner->designation == "MTF(group D)") ? '67' : '65';
								echo '<br/>2.In the event of the death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.$pensioner->getNameofSpouse().'</b>, whose date of birth is <b>'.$pensioner->getDOBofSpouse().' </b>in equal share from the day following the date of death of <b>'.strtoupper($pensioner->salutation." ".$pensioner->name).'</b> for a period of 7 years, or for a period up to the date on which he/she would have attained the age of '.$attained_age.' years, had he/she survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-';
							}
							else
							{// means family pension

	echo nbs(6);echo 'UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <b>'.strtoupper($pensioner->claiment_name).' - '.strtoupper($pensioner->son_daughter).' of Late '.$pensioner->name.' Ex- '.$pensioner->designation.'</b>, a sum of <b>Rs.'.$orrate.'/-</b>PM'.$pensioner->getDRMA().' './*$enhance_from_upto.*/' only (less income-tax), being the amount of <b>'.strtoupper(str_replace("_", " ", $class_of_pension)).'</b>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
	The payment should commence from '.date_format(date_create($pensioner->effect_of_pension), "d-m-Y").'</b>.&nbsp';
							}
						?>
			 		</td>
				</tr>
				
				<?php
							$dob 	= new DateTime($pensioner->dateTimeToDate($pensioner->claiment_dob));//dob
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

<script type="text/javascript">
	function myFunction() {
	    window.print();
	}

	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val=="form1") {
				hideAll();
				$('#form1').show();
			} else if(val=="form2") {
				hideAll();
				$('#form2').show();
			} 
			else if(val=="form3") {
				hideAll();
				$('#form3').show();
			}
			else if(val=="form4") {
				hideAll();
				$('#form4').show();
			}
			else {

			}
		});
	});

	function hideAll() {
		$('#form1').hide();
		$('#form2').hide();
		$('#form3').hide();
		$('#form4').hide();
	}
</script>