<?php $pensioner = $values;

$class_of_pension=$pensioner->class_of_pension;
if($class_of_pension=="Voluntary_Retirement_Pension"){
	$class_of_pension="Retiring_Pension";
}

$pensionername=explode(".",$pensioner->name);
if($pensionername[0]=="Dr"){$name= $pensioner->name;}else{$name=$pensioner->salutation." ".$pensioner->name;}
?>

<?php
	$apex_designation = ['The Principal Chief Conservator of Forests & Secretary (Enr & Forest)', 'The Principal Chief Conservator of Forest', 'Chief Residence Commissioner', 'The Principal Chief Conservator of Forests (WL & BD), C.W.L.W', 'The Addl. Chief Conservator of Forests', 'The Chief Conservator of Forest', 'The Conservator of Forest', 'AIS','IAS','IFS','IPS','Secratery','Secratary'];
	$ppo_no = $pensioner->case_file_no."/".$pensioner->ppo_no;
	$gpo_no = 'Pen/AP/GPO/'.$pensioner->gpo_no;
	$cpo_no = 'Pen/AP/COM/'.$pensioner->cpo_no;
    $ac = ($pensioner->treasury_officer!='') ? nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->treasury_name): nbs(10).str_replace(", ", ",<br />".nbs(10), $pensioner->accountant_general_name) ;

    if($pensioner->dod > $pensioner->dor or $pensioner->dod == '0000-00-00') :
		$enhance_rate_period = '7';
	elseif($pensioner->dod == $pensioner->dor) :
		$enhance_rate_period = '10';
	endif;

	$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
	$bank_name	= ($pensioner->bank_name != '') ? ', '.$pensioner->bank_name : '';
	$payable = $pensioner->sub_to.', '.$bank_name.' '.$account_no;
	$total_amount=$pensioner->total_amount;
	//echo $total_amount;
?>

<script type="text/javascript" >
$(function() {
$(".submit").click(function() {
var savegr = $("#savegr").val();
var srno=$("#srno").val();

var dataString = 'savegr='+ savegr + '&srno=' + srno ;

if(savegr=='')
{
$('.success').fadeOut(200).hide();
$('.error').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: '<?php echo site_url("administrator/service_book/SaveGraturity/"); ?>',
data: dataString,
success: function(){
$('.success').fadeIn(200).show();
$('.error').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
		<?php  if($pensioner->pay_commission==7) {?><option value="form7">Revised Authuority</option><?php }?>
	<?php if(in_array($pensioner->designation,$apex_designation)){ ?>
	<!-- <option value="form22">Assessment Sheet</option> -->
	<option value="form39">Forwarding Letter AIS</option>
	<option value="form6">GPO AIS</option>
	<?php } else{ ?>
	<option value="form1" selected>Report 1 (Forwading Letter)</option>
	<option value="form2">GPO</option>
	<?php }?>

	<?php if($pensioner->com_applied == 1) : ?>
		<option value="form3">CPO</option>
	<?php endif; ?>


	<option value="form4">Audit Enfacement</option>
    <option value="form5">Account Enfacement</option>
    <option value="disburser_disburser_portion">Disburser Portion</option>
	<option value="disburser_pensioner_portion">Pensioner Portion</option>
	<option value="id_card">ID Card</option>
</select>

<style type="text/css">
<!--
.style5 {font-size: 1.2px}
.style6 {font-size: 1.2em}
-->
</style>
<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print1');"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.3em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
		<?php if($class_of_pension=='Liberalised_Pension'){?>
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
						No. <?php echo $pensioner->case_file_no; ?><br/>To<br/><b><?php echo $ac; ?></b>
					</td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(13); ?>
					  <p align="justify">I am to forward herewith <b>P.P.O. No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no;?></b> in favour of <b><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b> and to request that the pensioner’s portion of the PPO may be made over to him/her after obtaining his/her signature on the disburser’s portion after you have satisfied yourself of his/her identity and payments noted in both the portion as they are made. The slip bearing the left/right hand thumb impressions of the pensioners is also enclosed.</p>
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
							C.P.O.
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
					
					<!--<td style="vertical-align: top; text-align:left;">Yours faithfully,</td>
					<td style="vertical-align: top; text-align:right;">Director/Joint Director</td>-->
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
						<b>1) <?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?></b>. He/She should appear before the <b><?php echo $pensioner->treasuryOfficer(); ?></b> to receive payment. If however his/her wish to be exempted from appearing in person to receive his/her pension through an Authorized Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the latter case, the Pension Payment Order will be sent to him/her through Agent.<br/>
						
						<b>2) <?php //echo str_replace(",", ",<br />".nbs(4), $pensioner->office_address); 
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
			<?php }
			else{
			?>

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
						No. <?php echo $pensioner->case_file_no; ?><br/>To<br/><b><?php echo $ac; ?></b>
					</td>
					<td style="vertical-align: top;"><strong>Date - <?php echo date('d/m/Y')?></strong></td>		
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4">Sir,</td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(13); ?>
					  <p align="justify">I am to forward herewith <b>P.P.O. No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no;?></b> in favour of <b><?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b> and to request that the pensioner’s portion of the PPO may be made over to him/her after obtaining his/her signature on the disburser’s portion after you have satisfied yourself of his/her identity and payments noted in both the portion as they are made. The slip bearing the left/right hand thumb impressions of the pensioners is also enclosed.</p>
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
							C.P.O.
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
					
					<!--<td style="vertical-align: top; text-align:left;">Yours faithfully,</td>
					<td style="vertical-align: top; text-align:right;">Director/Joint Director</td>-->
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
						<b>1) <?php echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?></b>. He/She should appear before the <b><?php echo $pensioner->treasuryOfficer(); ?></b> to receive payment. If however his/her wish to be exempted from appearing in person to receive his/her pension through an Authorized Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the latter case, the Pension Payment Order will be sent to him/her through Agent.<br/>
						
						<b>2) <?php //echo str_replace(",", ",<br />".nbs(4), $pensioner->office_address); 
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

			<?php }?>
		</div>
	</div>
</div>
<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
			<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
		        <div style="font-weight: bold; text-align: center; line-height: 1.4em;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>
		    <?php if($class_of_pension=='Liberalised_Pension'){?>
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
					<?php if(!in_array($pensioner->designation,$apex_designation)) : ?>
						<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
					<?php else : ?>
                       <?php $a=str_replace(",", ",<br />", $pensioner->office_address);?>
                       <td colspan="4" style="line-height: 1.5em"><b><?php echo $a; ?></b></td>
					<?php endif;?>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				
				
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?> I am to  request that you will be so good as to arrange for payment from the Treasury <b><?php echo $pensioner->sub_to; ?></b> a sum of <b>Rs.<?php echo $x=$pensioner->getDCRG();?>/- (Rupees <?php 
					echo no_to_words($x);?>)</b> only in lump-sum to <b><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name).", Rtd.".$pensioner->designation; ?></b> being the amount of retirement/death gratuity sanctioned to him/her in letter no. <b><?php echo $gpo_no; ?></b> from the Director of Audit & Pension, debitable to 2071 Pension & ORB etc.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">2.<?php echo nbs(4); ?>The particulars regarding his/her identification are/were enclosed along with PPO No. <b><?php 
					echo $pensioner->ppo_no;
		           
					?></b>. </div></td>
				</tr>
				<tr>
					<td colspan="4"><b>Below Rs. <?php echo $x=$pensioner->getDCRG()+1; ?>/- (Rupees <?php echo no_to_words($pensioner->getDCRG()+1); ?>).</b></td>
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
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">6. The expenditure is debitable to Head of Account <?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi.";}?></div></td>
				</tr>
			   	<tr>
					<td colspan="4" style="padding-top: 10px;"><b>RECOVERIES:-</b></td>
				</tr>
				
				<tr>
					<td colspan="3"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b></div></td>
					<td style="">Yours faithfully,</td>
					<td></td>
				</tr>
				
				<tr style="display:none;">
					<td colspan="4">
						<?php if($pensioner->provisional_gratuity > $binc && $pensioner->pay_commission==7 ) : ?>
							<div align="left">Excess Gratuity Paid : <?php echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); ?> - which<br />may be recovered from the arrear pension.</div>
						<?php endif; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan="3"></td>
					<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
						<td style="padding-top: 32px;">Director/Joint Director</td>
					<?php else : ?>
						<td style="padding-top: 85px;">Director/Joint Director</td>
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
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><b>i. <?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name); ?></b>, Arunachal Pradesh Government pensioner. He/She should appear before the Treasury Officer /Sub Treasury Officer/Bank, <b><?php echo $pensioner->sub_to; ?></b>, to receive payment. If however his/her wished to be exempted from appearing in person to receive his/her pension through an Authorised Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the later case, the Pension Payment order will be sent to his/her through Agent.</div></td>
			    </tr>
			   	<tr>
					<td colspan="4" width="25%"><div style="float: left;"><b>ii.</div><div style="float: left;margin-left: 5px;"><?php echo $pensioner->office_address; ?></b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;"><b>iii.</div><div style="float: left;margin-left: 5px;">The Accountant General (A&E), Arunachal Pradesh, Itanagar.</b></div></td>
				</tr>
				<?php if(in_array($pensioner->designation, $apex_designation)) : ?>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">iv.</div><div style="float: left;margin-left: 5px;"><b>Treasury Officer, Itanagar, for information<br/>with a request to entertained the gratuity payment bill on<br/> production from PCCF, AP,Itanagar.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">NB:-</div><div style="float: left;margin-left: 5px;">Kindly arrange to pay the differential amount of <b>Rs.<?php echo $diff;?>/-</b><br/>being retirement gratuity to <b><?php echo strtoupper($name);?> </b>payable<br/> on <?php echo $pensioner->bank_name;?>in his SBI A/C <?php echo $pensioner->account_no;?>.</div></td>
				</tr>
			<?php endif;?>
			    <tr>
			    	<td colspan="3"></td>
					<td style="padding-top: 65px;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
			<?php }
			else{
			?>

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
					<?php if(!in_array($pensioner->designation,$apex_designation)) : ?>
						<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
					<?php else : ?>
                       <?php $a=str_replace(",", ",<br />", $pensioner->office_address);?>
                       <td colspan="4" style="line-height: 1.5em"><b><?php echo $a; ?></b></td>
					<?php endif;?>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				
				
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?> I am to  request that you will be so good as to arrange for payment from the Treasury <b><?php echo $pensioner->sub_to; ?></b> a sum of <b>Rs.<?php echo $x=$pensioner->getDCRG();?>/- (Rupees <?php 
					echo no_to_words($x);?>)</b> only in lump-sum to <b><?php echo strtoupper($name).", Rtd.".$pensioner->designation; ?></b> being the amount of retirement/death gratuity sanctioned to him/her in letter no. <b><?php echo $gpo_no; ?></b> from the Director of Audit & Pension, debitable to 2071 Pension & ORB etc.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">2.<?php echo nbs(4); ?>The particulars regarding his/her identification are/were enclosed along with PPO No. <b><?php 
					echo $pensioner->ppo_no;
		           
					?></b>. </div></td>
				</tr>
				<tr>
					<td colspan="4"><b>Below Rs. <?php echo $x=$pensioner->getDCRG()+1; ?>/- (Rupees <?php echo no_to_words($pensioner->getDCRG()+1); ?>).</b></td>
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
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">6. The expenditure is debitable to Head of Account <?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi.";}?></div></td>
				</tr>
			   	<tr>
					<td colspan="4" style="padding-top: 10px;"><b>RECOVERIES:-</b></td>
				</tr>
				
				<tr>
					<td colspan="3"><div align="left">Provisional Gratuity paid : <b>Rs. <?php echo $pensioner->provisional_gratuity; ?></b></div></td>
					<td style="">Yours faithfully,</td>
					<td></td>
				</tr>
				
				<tr style="display:none;">
					<td colspan="4">
						<?php if($pensioner->provisional_gratuity > $binc && $pensioner->pay_commission==7 ) : ?>
							<div align="left">Excess Gratuity Paid : <?php echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); ?> - which<br />may be recovered from the arrear pension.</div>
						<?php endif; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan="3"></td>
					<?php if($pensioner->provisional_gratuity > $pensioner->getDCRG()) : ?>
						<td style="padding-top: 32px;">Director/Joint Director</td>
					<?php else : ?>
						<td style="padding-top: 85px;">Director/Joint Director</td>
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
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><b>i. <?php echo strtoupper($name); ?></b>, Arunachal Pradesh Government pensioner. He/She should appear before the Treasury Officer /Sub Treasury Officer/Bank, <b><?php echo $pensioner->sub_to; ?></b>, to receive payment. If however his/her wished to be exempted from appearing in person to receive his/her pension through an Authorised Agent, he/she should apply to that effect to the Treasury Officer through the Agent who would have executed a bond of indemnity to refund over-payments. In the later case, the Pension Payment order will be sent to his/her through Agent.</div></td>
			    </tr>
			   	<tr>
					<td colspan="4" width="25%"><div style="float: left;"><b>ii.</div><div style="float: left;margin-left: 5px;"><?php echo $pensioner->office_address; ?></b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;"><b>iii.</div><div style="float: left;margin-left: 5px;">The Accountant General (A&E), Arunachal Pradesh, Itanagar.</b></div></td>
				</tr>
				<?php if(in_array($pensioner->designation, $apex_designation)) : ?>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">iv.</div><div style="float: left;margin-left: 5px;"><b>Treasury Officer, Itanagar, for information<br/>with a request to entertained the gratuity payment bill on<br/> production from PCCF, AP,Itanagar.</b></div></td>
				</tr>
				<tr>
					<td colspan="4" width="25%"><div style="float: left;">NB:-</div><div style="float: left;margin-left: 5px;">Kindly arrange to pay the differential amount of <b>Rs.<?php echo $diff;?>/-</b><br/>being retirement gratuity to <b><?php echo strtoupper($name);?> </b>payable<br/> on <?php echo $pensioner->bank_name;?>in his SBI A/C <?php echo $pensioner->account_no;?>.</div></td>
				</tr>
			<?php endif;?>
			    <tr>
			    	<td colspan="3"></td>
					<td style="padding-top: 65px;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>

			<?php }?>
		</div>
	</div>
</div>
<div id="form3" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print3')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print3" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.3em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
			<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px;">
	        	<div style="font-weight: bold; text-align: center; line-height: 1.4em;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
	    	</div>
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	 			<tr>
					<td colspan="3">No. - <strong><?php echo $cpo_no; ?></strong></td>
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
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>I am to request you to make necessary arrangement for payment of <b>Rs.<?php echo $pensioner->getCommutationOfPension(); ?>/- (Rupees <?php  echo no_to_words($pensioner->getCommutationOfPension()); ?>)</b> 
						being the commuted value of <b>Rs. <?php  echo $pensioner->getCommutedValue(); ?>/- (Rupees <?php  echo no_to_words($pensioner->getCommutedValue());?>)</b>
						 out of pension of <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>)</b> per month granted to <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b>, holder of PPO No: - <b><?php 
					echo $ppo_no; 
					?>.</b></div></td>
				</tr>
				
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>Consequent on commutation, the reduced rate of pension in respect of <b><?php echo strtoupper($name); ?></b>, <b><?php echo $pensioner->designation; ?></b> should be <b>Rs. <?php 
					//echo $pensioner->getOrdinaryRate();
                          echo $pensioner->getReducePension();
					?>/- (Rupees <?php  echo no_to_words($pensioner->getReducePension());?>)</b> per month. The reduction in the amount of pension shall become operative from the date of receipt of the commuted value of pension by <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b> or three months after the issue of authority by you asking him/her to collect the commuted value of pension whichever is earlier. Necessary instructions regarding the date from which the pension is to be reduced may also kindly be issued to the Treasury Officer <b><?php echo $pensioner->sub_to; ?></b>. from which the pensioner is drawing the pension</b></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The expenditure is debitable to Government of Arunachal Pradesh under the Head of Account <?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi";}?></div></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?>The receipt of authority may please be acknowledged.</div></td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 20px 0 25px 0;"><!--<b>RECOVERY</b>: - Over payment, if any,<br/> due to non-payment of reduced pension<br/> of<strong> Rs. <?php echo $pensioner->getReducePension();?></strong> per month should be<br/> adjusted at the time of payment.--></td>
					<td><div style="">Yours faithfully,</div></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td style=""><br/><br/><br/>Director/Joint Director</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 0;"><div align="left">Memo No- <b><?php echo $cpo_no; ?></b></div></td>
					<td style="padding: 10px 0;">Date-<b><?php echo date('d.m.Y'); ?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;"><div align="left">i.<b><?php echo strtoupper($name).", Retd. ".$pensioner->designation;?></b></div></td>
			    </tr>
			   	<tr>
					<td colspan="4" style="padding: 5px 0;">ii. <b><?php echo $pensioner->office_address; ?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 5px 0;">iii. The Accountant General (A&E), Arunachal Pradesh, Itanagar.</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td style="padding-top: 45px;">Director/Joint Director</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="form4" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print4')"><i class="icon-white icon-print"></i>Print</button>
	<form method="post" name="form">
	<div id="print4" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.3em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			
		  <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	        	<div style="text-align: center; line-height: 1.4em; margin-bottom: 30px; font-size:20px; font-weight:bold">
	    		  OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN		    	</div>
    	  </div>
    	  <?php if($class_of_pension=='Liberalised_Pension'){?>
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
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name).", Retd. ".$pensioner->designation; ?></b></td>
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
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>PENSION Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></br>
		                <b>GRATUITY Rs. <?php echo $pensioner->getDCRG();?>/-</b></br>
		                <b>COMMUTATION Rs. <?php echo $pensioner->getCommutationOfPension();?>/-</b></br>
	    			</td>
				</tr>
				<input type="hidden" name="savegr" id="savegr" value="echo $pensioner->getDCRG(); ?>">
				<input type="hidden" name="srno" id="srno" value="<?php echo $pensioner->serial_no; ?>">
				<tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">3. FAMILY PENSION </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"><b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></div></td>
				</tr>
		      	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (a) Amount admitted</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></td>
				</tr>
			 	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (b) To whom admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (c) D.R admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 0;"><b>As per order from time to time</b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 4. Heads of Accounts to which the pension / gratuity is <?php echo nbs(5); ?>chargeable</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php if(!in_array($pensioner->designation,$apex_designation)) {echo "2071 Pension & ORB(Arunachal Pradesh)"; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi";}?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 5. Amount to be recovered</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->excess_pay_and_allowances;?></b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 6. Anticipatory provisional pension and Anticipatory-Death /Retirements gratuity, already paid to be adjusted out of the final payments.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<?php echo $pensioner->getAllGratuityStatus(); 
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 7.	P.P.O/G.P.O/C.P.O. issued in favour of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>1) PPO No. <?php echo $pensioner->ppo_no; ?></b></br>
					    <b>2) GPO No. <?php echo $pensioner->gpo_no; ?></b></br>
					    <b>3) CPO No. <?php 
						if($pensioner->com_applied == 1)
						{echo $pensioner->cpo_no; }
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
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">2. The Accountant General (A& E), Arunachal Pradesh, Itanagar</div></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td valign="top" style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
				</tr>
			</table>
			<?php }
			else{
			?>

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
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo strtoupper($name).", Retd. ".$pensioner->designation; ?></b></td>
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
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>PENSION Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></br>
		                <b>GRATUITY Rs. <?php echo $pensioner->getDCRG();?>/-</b></br>
		                <b>COMMUTATION Rs. <?php echo $pensioner->getCommutationOfPension();?>/-</b></br>
	    			</td>
				</tr>
				<input type="hidden" name="savegr" id="savegr" value="echo $pensioner->getDCRG(); ?>">
				<input type="hidden" name="srno" id="srno" value="<?php echo $pensioner->serial_no; ?>">
				<tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left">3. FAMILY PENSION </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"><b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></div></td>
				</tr>
		      	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (a) Amount admitted and the period of payment</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b>Rs.<?php 
			   	echo $pensioner->getEnhanceRate(); ?>/- (Enhanced Rate)</b></br><b>Rs.<?php echo $pensioner->getOrdinaryRate(); ?>/- (Ordinary Rate)</b></td>
				</tr>
			 	<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (b) To whom admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->getNameofSpouse(); ?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 20px;"><div align="left"> (c) D.R admissible </div></td>
					<td colspan="2" valign="top" style="padding: 10px 0 20px 0;"><b>As per order from time to time</b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 4. Heads of Accounts to which the pension / gratuity is <?php echo nbs(5); ?>chargeable</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php if(!in_array($pensioner->designation,$apex_designation)) {echo "2071 Pension & ORB(Arunachal Pradesh)"; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi";}?></b></td>
				</tr>
	 			<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 5. Amount to be recovered</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;"><b><?php echo $pensioner->excess_pay_and_allowances;?></b></td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 6. Anticipatory provisional pension and Anticipatory-Death /Retirements gratuity, already paid to be adjusted out of the final payments.</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<?php echo $pensioner->getAllGratuityStatus(); 
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" style="padding: 10px 0;"><div align="left"> 7.	P.P.O/G.P.O/C.P.O. issued in favour of the pensioner</div></td>
					<td colspan="2" valign="top" style="padding: 10px 0;">
						<b>1) PPO No. <?php echo $pensioner->ppo_no; ?></b></br>
					    <b>2) GPO No. <?php echo $pensioner->gpo_no; ?></b></br>
					    <b>3) CPO No. <?php 
						if($pensioner->com_applied == 1)
						{echo $pensioner->cpo_no; }
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
					<td colspan="4" valign="top" style="padding: 10px 0;"><div align="left">2. The Accountant General (A& E), Arunachal Pradesh, Itanagar</div></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td valign="top" style="padding-top: 45px; text-align: center;">Director/Joint Director</td>
				</tr>
			</table>


			<?php }?>
		</div>
	</div>
	</form>
</div>
<div id="form5" style="display: none;" >
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print5')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print5" style="width: 1000px; margin: 0px auto;">
		<div id="print" style="width:1000px; min-height:600px; padding: 0 20px; color:#000000; background-color:#FFFFFF; line-height: 2em">
			
			<div style="font-size: 20px; font-weight: bold; text-align: center;">FORM 7 (Part-II)</div><br /><br />
            <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
            <?php if($class_of_pension=='Liberalised_Pension'){?>
			<table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
				<tr>
					<td valign="top" width="50%">1. Name of Government Servant</td>
					<td valign="top" width="2%">:-</td>
					<td valign="top" width="48%"><b><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b></td>
				</tr>
				<tr>
					<td valign="top">2. Date of receipt of pension papers by the <br /><?php echo nbs(4); ?>Accounts Officer from Head of Office</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php 
                    //echo $pensioner->dateTimeToDate($pensioner->receipt_date);
					echo $pensioner->dateTimeToDate($pensioner->cash_received); ?></b></td>
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
					<td valign="top"><b>Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></td>
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
					<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue();?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Residuary pension after commutation</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) Date from which reduced pension is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. N/A/-</b></td>
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
					<td valign="top"><b>0</b></td>
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
					<td valign="top"><b>Rs. N/A/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Period for which Family Pension at enhanced rate<br /><?php echo nbs(12); ?>is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>For a period of 7/10 years</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(iii) At normal rate</td>
					<td valign="top">:-</td>
					<td valign="top"><b>Rs. N/A/-</b></td>
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
			<?php }
			else{
			?>

			<table width="100%" border="0" cellspacing="3" cellpadding="3" align="center">
				<tr>
					<td valign="top" width="50%">1. Name of Government Servant</td>
					<td valign="top" width="2%">:-</td>
					<td valign="top" width="48%"><b><?php echo strtoupper($name); ?>, Retd. <?php echo $pensioner->designation;?></b></td>
				</tr>
				<tr>
					<td valign="top">2. Date of receipt of pension papers by the <br /><?php echo nbs(4); ?>Accounts Officer from Head of Office</td>
					<td valign="top">:-</td>
					<td valign="top"><b><?php 
                    //echo $pensioner->dateTimeToDate($pensioner->receipt_date);
					echo $pensioner->dateTimeToDate($pensioner->cash_received); ?></b></td>
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
					<td valign="top"><b>Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></td>
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
					<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue();?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Residuary pension after commutation</td>
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
					<td valign="top"><b>0</b></td>
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
					<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate(); ?>/-</b></td>
				</tr>
				<tr>
					<td valign="top"><?php echo nbs(6); ?>(ii) Period for which Family Pension at enhanced rate<br /><?php echo nbs(12); ?>is payable</td>
					<td valign="top">:-</td>
					<td valign="top"><b>For a period of 7/10 years</b></td>
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

			<?php }?>
			</div>
		</div>
	</div>
</div>


<!-- gpo ais-->
<div id="form6" style="display:none; ">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print66')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print66" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.1em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
			<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
		        <div style="font-weight: bold; text-align: center; margin-top:-50px;line-height: 1.4em;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>
			<table width="100%"  cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	     		<tr>
					<td colspan="3"><div align="left">No - <strong><?php echo $pensioner->case_file_no; ?></strong></div></td>
		    		<td><div><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td  colspan="4"><div align="left">To</div></td>
				</tr>
				<tr>
					<?php if(!in_array($pensioner->designation,$apex_designation)) : ?>
						<td colspan="4" style="line-height: 1.5em"><b><?php echo $ac; ?></b></td>
					<?php else : ?>
                       <?php $a=str_replace(",", ",<br />", $pensioner->office_address);?>
                       <td colspan="4" style="line-height: 1.5em"><b><?php echo $a; ?></b></td>
					<?php endif;?>
				</tr>
				<tr>
				    <td  colspan="4"><div align="left"><table>
				    <td><div align="left">Sub: </div></td> 
				    <td ><div align="left" style="text-align: justify;">
				    	Revised gratuity in respect of <strong><?php echo strtoupper($name); ?>&nbsp;,<?php echo $pensioner->designation; ?>&nbsp;,<?php echo $pensioner->sub_designation; ?></strong>, holder of P.P.O No. <strong><?php echo $ppo_no;?></strong>.
				    </div></td>
				    </table></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php echo nbs(6); ?> It is to inform that an amount of <b>Rs.<?php echo $pensioner->getDCRG(); ?>/- (Rupees <?php echo no_to_words($pensioner->getDCRG());?>)</b>
					 only had been sanctioned being retirement gratuity to  <b><?php echo strtoupper($name) ;?>&nbsp;<?php echo $pensioner->designation; ?>&nbsp;<?php echo $pensioner->sub_designation; ?></b> vide G.P.O. No. <b><?php echo $gpo_no; ?></b>. Consequent upon implementation of 7th CPC in terms of GOI's O.M. No.F.No.38/37/2016 - P & W (A) (ii), Dated 4th August 2016 on recommendation of the 7th Central Pay Commission, the revised gratuity comes to Rs. <strong><?php echo $pensioner->getDCRG();?></strong> (Rupees <?php echo no_to_words($pensioner->getDCRG());?>). Hence an amount of Rs. <strong><?php echo ($diff=$pensioner->getDCRG())-($pensioner->provisional_pension) ?>/-
					  (Rupees <?php echo no_to_words($diff);?>)
					  	</strong> only being residual balance is to be paid now.</div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">&nbsp;&nbsp;In view of the above you are requested to draw the differential amount of Rs.<strong> <?php echo $diff; ?>/- (Rupees <?php echo no_to_words($diff);?>) </strong>being revised gratuity of <strong><?php  echo strtoupper($name); ?>, &nbsp;<?php echo $pensioner->designation;  ?></strong>&nbsp;and pay the same through re-imbursement of the same from CPAO New Delhi through A.G. (A&E), Itanagar.</div></td>
					
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;"><?php if(!in_array($pensioner->designation,$apex_designation)) {echo "“2071” Pension & ORB."; }else{ echo  "8658-101 suspense account adjustable by the CPAO,New Delhi.";}?></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left" style="text-align: justify;">This letter may please be treated as authority.</div></td>
				</tr>
				
				<tr>
					<td colspan="2"></td>
					<td style="text-align: left;" colspan="2">Yours faithfully,<br/><br/>
					Joint Director of Audit & Pension<br/>
					Directorate of Audit & pension<br/>
					Naharlagun<br/>
					</td>
				</tr>
				<tr>
					<td>
						Memo No. <?php echo $pensioner->case_file_no; ?>
					</td>
					<td align="right" colspan="4">Dated naharlagun, the....................</td>

				</tr>
				
				<tr>
					<td colspan="4">Copy to:-</td>
				</tr>
				<tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;">1. <b> 
					<?php $pin = ($pensioner->pin != '') ? '<br />'.nbs(5).'PIN Code - '.$pensioner->pin : ''; ?>
						Copy forwarded to:- <br />
						 <b><?php echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?></b><br />
						 <b><?php echo str_replace(",", ",<br />".nbs(4), $pensioner->office_address); ?></b><br />
					</b></div></td>
			    </tr>
			   
			    <tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;">2. <b> 
					The Pay and Accounts Officer,<br/>
                    Central Pension Accounting Office,<br/>
                    Trikoot-II Bhikaji Cama Place,<br/>
                    New Delhi-110 006.<br/>
					</b></div></td>
			    </tr>
			     <tr>
					<td colspan="4" style="padding: 10px 0;"><div align="left" style="text-align: justify;">3. <b> 
					The Treasury Officer, Itanagar, for information<br/>
                    with a request to entertained the revised gratuity<br/>
                    payment bill on production from Secy. (Personnel)<br/>
                    Itanagar.<br/>
					</b></div>

					<div align="right">Joint Director of Audit & Pension<br/>
                    Directorate of Audit & Pension<br/>
                    Naharlagun.</div>
					</td>
			    </tr>
			   
			    <tr>
			    	<td colspan="2"></td>
					<td style="margin-top: -52px;text-align: center;">
					
					</td>
					<td></td>
				</tr> 
			</table>
		</div>
	</div>
</div>
<!-- gpo ais -->

<!-- revise-->
<div id="form7" style=" display:none">
  <button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print77')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print77" style="width: 1000px; margin: 0px auto;">
	  <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.1em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			<br />
		<div style="text-align:center; padding:10px 0 35px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
          <div style="font-weight: bold; text-align: center; font-size:20px; line-height: 1.4em; margin-top:-50px;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN    	  </div>
	    </div>
<table width="100%"  cellpadding="2" id="report">
				<tr>
					<td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td>
				</tr>
	     		<tr>
					<td colspan="3"><div align="left">No - <strong><?php echo $pensioner->case_file_no; ?></strong></div></td>
		    		<td><div><strong>Date - <?php echo date('d/m/Y')?></strong></div></td>
				</tr>
				<tr>
					<td  colspan="4"><div align="left">To</div></td>
				</tr>
				<tr>
					<?php if(!in_array($pensioner->designation,$apex_designation)) : ?>
						<td colspan="4" style="line-height: 1.5em"><b><?php echo $pensioner->accountant_general_name; ?></b></td>
					<?php else : ?>
                       <?php $a=str_replace(",", ",<br />", $pensioner->accountant_general_name);?>
                       <td colspan="4" style="line-height: 1.5em"><b><?php echo $a; ?></b></td>
					<?php endif;?>
				</tr>
				<tr>
				    <td  colspan="4"><div align="left"><table>
				    <td><div align="left"> </div></td> 
				    <td ><div align="left" style="text-align: justify;">
				    	<strong>Sub:&nbsp;</strong>Revised authority on pension of  <strong><?php echo strtoupper($name); ?>,&nbsp;<?php echo $pensioner->designation; ?>,&nbsp;<?php echo $pensioner->sub_designation; ?></strong>, holder of P.P.O No. <strong><?php echo $pensioner->ppo_no;?><strong></strong>.
				    </div></td>
				    </table></div></td>
				</tr>
				<tr>
					<td colspan="4"><div align="left">Sir,</div></td>
				</tr>
				
		</table>
				<p align="justify">
					It is to state that the P.P.O. No.<strong><?php echo $pensioner->ppo_no;?></strong> issued in favour of <strong><?php echo strtoupper($name); ?>,&nbsp;<?php echo $pensioner->designation; ?>,&nbsp;<?php echo $pensioner->sub_designation; ?></strong>  Authorizing Superannuation Pension/Retiring pension w.e.f. <strong><?php echo $pensioner->dor;?></strong> was forwarded to you vide this office letter No. <strong><?php echo $pensioner->case_file_no; ?></strong>  <strong>dated  04-07-2016.</strong> Consequent on revision of pay in terms of OM No. DAP/PEN/27/2016, dated 04-07-2016 (7th CPC), the pensionery benefit in respect of <strong><?php echo strtoupper($name); ?>,<?php echo $pensioner->designation; ?> </strong> is now worked out as under:-<br/>
			  </p>
			  <p align="justify">i)	Revised Superannuation/ Retiring pension at the rate of <strong>Rs. <?php echo $x=$pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($x) ?> )</strong> only P.M. plus D.R. &amp; MA w.e.f. <strong><?php echo $pensioner->created_at;?></strong>. after adjusting the Pension, DR and MA already paid vide P.P.O. No.  <strong><?php echo $ppo_no; ?></strong></p>
				<br/>
<p align="justify">
					ii)	In the event of death of the pensioner, revised family pension at enhance rate of <strong>Rs. <?php echo $x=$pensioner->getAmountofPension(); ?>/- (Rupees <?php echo no_to_words($x) ?> )</strong> p. m. plus DR &amp; MA for a period of 7 years or till the pensioner would have attained the age of 65 yrs/67 yrs, had he been survived whichever is earlier, and thereafter family pension at the rate of <strong>Rs.<?php 
				echo $x=$pensioner->getOrdinaryRate(); 
				?>/- (Rupees <?php echo no_to_words($x) ?> )</strong> only at normal rate is admissible to <strong><?php echo $pensioner->getNameofSpouse(); ?> D.O.B. <?php echo $pensioner->getDOBofSpouse();?></strong>			  </p>
				<div align="justify"><br/>
								iii)	Revised gratuity <strong>Rs.<?php echo $rg= $pensioner->getDCRG(); ?>/- (Rupees <?php echo no_to_words($rg); ?>) </strong>only is sanctioned now. The gratuity already drawn is <strong>Rs.<?php echo $rgd=$pensioner->provisional_gratuity; ?>/- (Rupees <?php echo no_to_words($rgd);?>)</strong> only under GPO No. <strong><?php echo $gpo_no;?></strong>. Hence net amount of <strong>Rs.<?php echo $bl=$rg-$rgd;?>/- (Rupees <?php echo no_to_words($bl);?> )</strong> only may be paid now.
		                  </p>


				</div>
				<p align="justify">
					iv)	Revised commutation of pension of <strong> Rs.<?php echo $cp=$pensioner->getCommutationofPension();?>- (Rupees <?php echo no_to_words($cp);?> )</strong> only being revised commuted value of <strong>Rs.<?php if($cp!='N/A'){echo  $gpa= $pensioner->getCommutedValue();}else{echo $gpa='N/A';}?>/- (Rupees <?php echo no_to_words($gpa); ?> ) </strong>only out of his revised pension of <strong>Rs.<?php if($cp!='N/A'){echo  $gpa= $pensioner->getAmountofPension();}else{echo $gpa='N/A';}?>/- (Rupees <?php echo no_to_words($gpa); ?> ) </strong> only is sanctioned now. The commuted value of pension of <strong>Rs.<?php if($cp!='N/A'){echo  $gpa6= $pensioner->getCommutedValue();}else{echo $gpa6='N/A';}?>/- (Rupees <?php echo no_to_words($gpa); ?> ) </strong> only already authorization earlier vide No. <strong><?php echo $cpo_no; ?></strong> and hence difference of commutation of pension of <strong>Rs.<?php if($cp!='N/A'){echo $dcp=$gpa-$gpa6;} else{ echo $dcp='N/A';}?>/- (Rupees <?php echo no_to_words($dcp); ?> ) </strong>only is now authorized for payment. Consequent on revised commutation, the reduced pension of <strong>Rs.<?php 
				echo $rp=$pensioner->getReducePension();
				?>/- (Rupees  <?php echo no_to_words($rp); ?>)</strong> only p.m. plus D.R. & M.A. may be paid to <strong><?php echo $pensioner->salutation." ".$pensioner->name.' Rtd. ('.$pensioner->designation.')'; ?></strong> .				</p>
			
				<p align="justify">
					In view of the above, I am to request you to advise the Treasury Officer <strong><?php echo $pensioner->treasuryOfficer();?></strong> for making payment of revised pension, revised gratuity and revised  commutation of pension to <strong><?php echo $pensioner->salutation." ".$pensioner->name.' Rtd. ('.$pensioner->designation.')'; ?></strong>  after keeping a note to this effect in both halves of P.P.O. No. <strong><?php echo $ppo_no;?></strong> under proper attestation and after adjusting all the payments already made.				</p>
				<p>
			<?php
						$dob 	= new DateTime($pensioner->dob);
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
<table width="681" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#333333">
<tr>
  <td width="336"><strong>Age of Pensioner/Family Pensioner</strong></td>
  <td width="319"><strong>Additional Quantum of Pension</strong></td>
</tr>
<tr>
					<td>
					From 80 years to less than 85 years</td>
					<td>20% increase on  Rs.
                        <?php if($pensioner->pay_commission==7){echo round($total_amount*50/100);} else{echo $pensioner->getAmountofPension();} ?>
                        =
                        <?php  if($pensioner->pay_commission==7){echo round(((20*$total_amount*50/100)/100)+ $total_amount*50/100) ;} else{echo round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();}?>
					</td>
		</tr>
<tr>
  <td>From 85 years to less than 90 years</td>
  <td>30% increase on  Rs.
      <?php if($pensioner->pay_commission==7){echo round($total_amount*50/100);} else{echo $pensioner->getAmountofPension();} ?>
      =
      <?php if($pensioner->pay_commission==7){echo round(((30*$total_amount*50/100)/100)+ $total_amount*50/100) ;} else{echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();}?>
  </td>
</tr>
<tr>
  <td> From 90 years to less than 95 years</td>
  <td>40% increase on  Rs.
      <?php if($pensioner->pay_commission==7){echo round($total_amount*50/100);} else{echo $pensioner->getAmountofPension();} ?>
      =
      <?php if($pensioner->pay_commission==7){echo round(((40*$total_amount*50/100)/100)+ $total_amount*50/100) ;} else{echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();}?>
 </td>
</tr>
<tr>
  <td>From 95 years to less than 100 years</td>
  <td>50% increase on  Rs.
      <?php if($pensioner->pay_commission==7){echo round($total_amount*50/100);} else{echo $pensioner->getAmountofPension();} ?>
      =
      <?php if($pensioner->pay_commission==7){echo round(((50*$total_amount*50/100)/100)+ $total_amount*50/100) ;} else{echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();} ?>
 </td>
</tr>
<tr>
  <td>100 years or more. </td>
  <td>100% increase on  Rs.
      <?php if($pensioner->pay_commission==7){echo round($total_amount*50/100);} else{echo $pensioner->getAmountofPension();} ?>
      =
      <?php if($pensioner->pay_commission==7){echo round(((100*$total_amount*50/100)/100)+ $total_amount*50/100) ;} else{echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();} ?>
  </td>
</tr>

				</table>
<br></p>
<table width="100%">
  <tbody>
    <tr>
      <td height="126" colspan="3">&nbsp;</td>
      <td width="27%" valign="top"> <p align="center">Yours faithfully,        				                                     </p>
        <p align="center"><br>
          Joint Director of Audit &amp; Pension<br>
          Directorate of Audit &amp; Pension <br>
      Naharlagun. </p></td>
    </tr>
    <tr>
      <td colspan="3"> Memo No. <?php echo $ppo_no;?>			                              </td>
      <td><div align="center">Dated Naharlagun, the ……………… </div></td>
    </tr>
    <tr>
      <td colspan="4"><strong>Copy to:-</strong></td>
    </tr>
    <tr>
      <td colspan="4"><div align="left"><strong><?php $pin = ($pensioner->pin != '') ? '<br />'.nbs(5).'PIN Code - '.$pensioner->pin : ''; ?>
						Copy forwarded to:- <br />
						 <b>1. <?php echo strtoupper($name).',<br />'.nbs(5).str_replace(",", ",<br />".nbs(4), $pensioner->address_after_retirement).$pin; ?></b><br /><br>
						 2. <?php echo str_replace(",", ",<br />".nbs(4), $pensioner->office_address); ?></strong><br>
      </div></td>
    </tr>
    <tr>
      <td colspan="4"><div>NB:-</div>
          <div>Kindly arrange to pay the differential amount of <strong>Rs. <?php echo $bl;?>/-</strong><br>
            being retirement gratuity to <strong><?php echo strtoupper($name);?> </strong>payable<br>
            on in his <strong><?php echo $pensioner->bank_name;?></strong> AC no <strong><?php echo $pensioner->account_no;?></strong></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="left">2. <strong> The Pay and Accounts Officer,<br>
        Central Pension Accounting Office,<br>
        Trikoot-II Bhikaji Cama Place,<br>
        New Delhi-110 006.<br>
      </strong></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="left">3. <strong> The Treasury Officer, Itanagar, for information<br>
        with a request to entertained the revised gratuity<br>
        payment bill on production from Secy. (Personnel)<br>
        Itanagar.<br>
      </strong></div></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
      <td>Joint Director of Audit &amp; Pension<br>
Directorate of Audit &amp; Pension<br>
Naharlagun. </td>
    </tr>
  </tbody>
</table>
				

				
	  </div>
	</div>
</div>

<!-- revise-->



<!-- assessment-->
<div id="form22" style="display:none; ">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print99')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print99" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.4em; color:#000000; background-color:#FFFFFF; line-height: 2em">
			
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif"><U><B>ASSESMENT
SHEET</B></U></FONT></FONT></P>
<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif"><U>Revised
Calculation Sheet of Post 01-01-2006 Pension/ Family Pension</U></FONT></FONT></P>
<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">
<div style="text-align:left;float:left;">
NO:
<?php echo $pensioner->case_file_no;  ?>
</div>	                                               
<div style="float:right;">Dated Naharlagun, the<?php echo date('d/m/Y');?></div></FONT></FONT></P>
<br/><br/>
<P STYLE="margin-left: 1.5in; text-indent: -1.49in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">1.  
Name of Pensioner/Family pensioner					<span style="margin-left:175px;">: - <?php echo strtoupper($name); ?>,&nbsp;<?php echo $pensioner->designation; ?>,&nbsp;<?php echo $pensioner->sub_designation; ?></span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">2.  
Date of birth										<span style="margin-left:355px;">: <?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">3.  
Date of retirement/death							<span style="margin-left:271px;">: <?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">4.	Age
of retirement/Death									<span style="margin-left:271px;">: <?php echo $pensioner->age_at_retirement(); ?></span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">5.  
Net qualifying service 				<span style="margin-left:288px;">: <?php echo $pensioner->net_qualifying_service(); ?></span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">6.  
Six monthly period					<span style="margin-left:310px;">: <?php echo $pensioner->smp; ?></span></FONT></FONT></P>

<?php 
$sql=mysql_query("select * from master_pay_scale where id=".$pensioner->six_pay_band."");
while($row = mysql_fetch_array($sql))
{

?>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">7.  
Pay band and grade pay at which the<br/> employee retired/died	<span style="margin-left:288px;">	:Rs. <?php echo $row['grade'] ;?>-<?php echo $row['pay_scale']; ?>/-</span></FONT></FONT></P>
<?php
}?>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">8.	Basic pay(pai in PB+GP) drawn at<br/> the time of retirement/death		<span style="margin-left:249px;">:Rs. <?php echo $pensioner->getLastPay(); ?>/-</span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">9.	Amount of pension/family pension<br/> authorised/sanction under<br/> pre-revised scale				<span style="margin-left:331px;">:Rs.<?php echo $pensioner->getAmountofPension(); ?>/-</span> </FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">10.	Pay matrix & pay level at which revised <br/>pay is fixed under the 7th CPC			<span style="margin-left:233px;">:Rs.  <?php echo $pensioner->pay_scale;?>-<?php echo $pensioner->pay_scale_grade;?>/- PM</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">11.	Amount of pension(in case of retirement)<br/> admissible under revised scale			<span style="margin-left:238px;">	: Rs.<?php echo $total_amount*50/100; ?>/-</span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">12.	Amount of family pension(in case of death)<br/> admissible under revised scale 		<span style="margin-left:240px;">: - NA</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">13.	Life time arrear pension,if any		<span style="margin-left:237px;">: NA</span></FONT></FONT></P>

<p><strong>FAMILY PENSION</strong></p>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">14.a) Enhanced rate of revised family pension	<span style="margin-left:157px;">:Rs <?php echo $total_amount*50/100; ?>/- PM</span>
</FONT></FONT>
</P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">b).	Ordinary rate of revised family pension				<span style="margin-left:182px;">:Rs.- <?php echo $total_amount*30/100; ?>/- PM</span></FONT></FONT>
</P>

<p><strong>REVISED GRATURITY</strong></p>


<?php
$binax=substr($pensioner->total_service,0,2);
//echo $bina;
$binbx=$pensioner->total_amount;
$binyx=substr($pensioner->total_service,9,1);
//echo $biny;
if($binax > 33)
{
 $bincx=($binbx)*(1/4)*(33*2);
}
else if($binax < 33 && $binyx < 9)
{
	$bincx=($binbx)*(1/4)*($binax*2)+1;
}
else
{
	$bincx=($binbx)*(1/4)*($binax*2)+2;
}
?>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">15.a)Revised graturity admissible <span style="margin-left:253px;">:Rs.<?php if($bincx > 2000000) { echo 2000000;} else{ echo $bincx;} ?></span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">b).	Graturity already authorised			<span style="margin-left:270px;">:Rs.<?php echo $pensioner->sixgratu; ?></span></FONT></FONT></P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">c).Residual balance of graturity			<span style="margin-left:271px;">:Rs. <?php if($bincx > 2000000) { echo 2000000-$pensioner->sixgratu;} else{ echo $bincx;} ?> /-</span></FONT></FONT></P>

<p><strong>COMMUTATION(ON SPECIFIC OPTION)</strong></p>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">16.a)	Revised commutation<br/>(40% of basic pension)<span style="margin-left:310px;">:-</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">.b)	Commutation already authorised<br/> vide CPO No AIS/COM/026 <span style="margin-left:275px;">:-</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">.c)	Additional amount payable<span style="margin-left:295px;">:-</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">17.	Reduced pension after commutation<span style="margin-left:227px;">:Rs.<?php  echo ($total_amount*50/100-$pensioner->getAmountofPension()*40/100);   ?>/-</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">18.	Name of spouse with date of birth<span style="margin-left:243px;">:-<?php echo $pensioner->getNameofSpouse(); ?>&nbsp;<?php echo $pensioner->getDOBofSpouse(); ?></span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">19.	Name of Bank/Treasury<span style="margin-left:316px;">:-<?php echo $pensioner->bank_name;?>&nbsp;A/C:<?php echo $pensioner->account_no; ?></span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">20.	Pension/family pension to be enhanced on<span style="margin-left:186px;">:-</span></FONT></FONT></P>

<p><strong>RECOVERY</strong></p>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">21.i)	PPO NO<span style="margin-left:7px;">:-<?php echo $ppo_no; ?></span><span style="margin-left:102px;">:-Date....</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">.ii)	GPO NO<span style="margin-left:7px;">:-AIS/GPO/029</span><span style="margin-left:310px;">:-Date....</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 100%">
<FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">.iii)	CPO NO<span style="margin-left:7px;">:-AIS/COM/026</span><span style="margin-left:300px;">:-Date.....</span></FONT></FONT></P>

<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<BR>
</P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<BR>
</P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<BR>
</P>
<P STYLE="margin-left: 0.25in; text-indent: -0.25in; margin-bottom: 0in; line-height: 150%">
<BR>
</P>
<TABLE WIDTH=720 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=240>
	<COL WIDTH=224>
	<COL WIDTH=214>
	<TR>
		<TD WIDTH=240 STYLE="border: none; padding: 0in">
			<P ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">	Dealing
			Assistant,</FONT></FONT></P>
			
		</TD>
		<TD WIDTH=224 STYLE="border: none; padding: 0in">
			<P ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">Superintendent,</FONT></FONT></P>
			
		</TD>
		<TD WIDTH=214 STYLE="border-top: none;  border-left: none; border-right: none; padding: 0in">
			<P ALIGN=CENTER STYLE=""><FONT FACE="Calibri, serif"><FONT FACE="Times New Roman, serif">Director/Joint Director
			</FONT></FONT></P>
			
		</TD>
	</TR>
</TABLE>
			
		</div>
	</div>
</div>

<!-- assessment-->


<div id="form39" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print39')"><i class="icon-white icon-print"></i>Print</button>
	<!-- <form method="post" name="form"> -->
	<!-- <button class="submit">Save Graturity For 6Pay</button> -->
	<div id="print39" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; padding: 0px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
		
			<br /><br />

<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><B>OFFICE
OF THE</B></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><B>DIRECTOR
OF AUDIT AND PENSION</B></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><B>GOVERNMENT
OF ARUNACHAL PRADESH</B></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><B>NAHARLAGUN</B></FONT></P>
<P ALIGN=CENTER STYLE="margin-bottom: 0.14in"><!-- <BR><BR> -->
</P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">No. <?php echo $pensioner->case_file_no; ?></FONT>
<FONT FACE="" style="margin-left:550px;">Date <?php echo date('d/m/Y')?></FONT>
</P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">To,</FONT></P>
<!-- <P STYLE="margin-bottom: 0.14in"> --><FONT FACE=""><b>	<?php echo $ac; ?></b></FONT></br><!-- </P> -->

<P STYLE="margin-bottom: 0.14in"><!--<BR> <BR> -->
</P>
<P STYLE="margin-bottom: 0.14in" ><FONT FACE=""><B>Sub:-
 Revision of pension of Shri/Smti &nbsp;<b><?php echo strtoupper($name); ?>,  <?php echo $pensioner->designation;?>,<?php echo $pensioner->sub_designation;  ?></b>&nbsp; holder
of P.P.O. No. <b><?php if(in_array($pensioner->designation,$apex_designation)){ echo $pensioner->ppo_no;} else { echo $pensioner->case_file_no."/".$pensioner->ppo_no;}?></b></B></FONT></P>
<P STYLE="margin-bottom: 0.14in"><BR><!-- <BR> -->
</P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">Sir,</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I
request you to make arrangement for carrying out the modification in
both the halves of the said PPO as detailed below:</FONT></P>
<TABLE WIDTH=507 CELLPADDING=7 CELLSPACING=0 style="margin-left:200px;">
	<COL WIDTH=154>
	<COL WIDTH=155>
	<COL WIDTH=154>
	<TR VALIGN=TOP>
		<TD WIDTH=154 HEIGHT=3 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE=""><B>Level</B></FONT></P>
		</TD>
		<TD WIDTH=155 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE=""><B>Index/Cell</B></FONT></P>
		</TD>
		<TD WIDTH=154 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE=""><B>Last pay
			drawn</B></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=154 HEIGHT=4 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P align=center><b><?php echo $pensioner->pay_scale_grade; ?></b><!-- <BR> -->
			</P>
		</TD>
		<TD WIDTH=155 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P align=center><b>  </b><!-- <BR> -->
			</P>
		</TD>
		<TD WIDTH=154 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P align=center><b><?php echo $pensioner->total_amount; ?></b>
			</P>
		</TD>
	</TR>
</TABLE>
<P STYLE="margin-bottom: 0.14in"><!-- <BR><BR> -->
</P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE=""><B>1</B></FONT><FONT FACE="">.(a)
 Revised pension <b>Rs. <?php if($pensioner->pay_commission==7){ echo $total_amount*50/100;} else{echo $pensioner->getAmountofPension();} ?>/- (Rupees <?php 
 
 if($pensioner->pay_commission==7)
 	{ echo no_to_words($total_amount*50/100);} 
 else
 	{echo no_to_words($pensioner->getAmountofPension());}
 ?>)</b>
effective from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b></FONT></P>

<?php
				$bina=substr($pensioner->total_service,0,2);
				//echo $bina;
				$binb=$pensioner->total_amount;
				$biny=substr($pensioner->total_service,9,1);
				//echo $biny;
				if($bina > 33)
				{
				 $binc=($binb)*(1/4)*(33*2);
				}
				else if($bina < 33 && $biny < 9)
				{
					$binc=($binb)*(1/4)*($bina*2)+1;
				}
				else
				{
					$binc=($binb)*(1/4)*($bina*2)+2;
				}
				?>
<P STYLE="margin-bottom: 0.14in">   <FONT FACE="">&nbsp;&nbsp;&nbsp;(b)
 Revised pension commuted <b><?php 
 if($pensioner->pay_commission==7 && $pensioner->com_applied==0)
 { echo "NA"; } 
 else if($pensioner->pay_commission==7)
 {?>Rs.
 <?php echo $binc;
 ?>/-
 <?php
 } 
 else
 {?>Rs.
 <?php echo $pensioner->getDCRG(); ?>/-
 <?php 
 } 
 ?>

<?php
 if($pensioner->pay_commission==7 && $pensioner->com_applied==0)
 	{ echo ""; } 
 else if($pensioner->pay_commission==7)
 {?>
 (Rupees
 <?php
  	 echo no_to_words($binc);
 ?>)
<?php }else { ?>
(Rupees
<?php
 	 echo no_to_words($pensioner->getDCRG()); 
 ?>) 
 <?php } ?>

</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">   <FONT FACE="">&nbsp;&nbsp;&nbsp;(c)
 Revised Reduced Pension after commutation <b>Rs. <?php  
 echo ($total_amount*50/100-$pensioner->getAmountofPension()*40/100);   
 ?>/- (Rupees&nbsp;<?php echo no_to_words($total_amount*50/100-$pensioner->getAmountofPension()*40/100); ?> )</b> effective from
</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE=""><B>2</B></FONT><FONT FACE="">.(a)
 Differential commuted value paid or being arranged through Pay and
Accounts office <b>Rs…………………..../- (Rupees………………………………)</b></FONT></P>
<P STYLE="margin-left: 0.1in; margin-bottom: 0.14in"><FONT FACE="">&nbsp;(b)
 Differential commuted value of pension payable by the bank
<b>Rs………………………/-      (Rupees…………………………..)</b></FONT></P>
<P STYLE="margin-left: 0.36in; margin-bottom: 0.14in"><FONT FACE="">((a)
or (b) whichever is applicable should be filled up. The other column
should be prominently   marked as ‘Not applicable’).</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE=""><B>3</B></FONT><FONT FACE="">.
      Additional amount of Death/Retirement Gratuity payable by the
bank due to revision (this column is to be prominently marked as ‘not
applicable’ if additional amount of gratuity is arranged through
Pay and Accounts Officer concerned or no Death/Retirement Gratuity is
payable as a result of revision)
<b>Rs……………………………….(Rupees………………………………………)</b></FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">*</FONT><FONT FACE=""><B>4</B></FONT><FONT FACE="">.
  Revised Family Pension.</FONT></P>
<P STYLE="margin-bottom: 0.14in">     <FONT FACE="">(a)
 At enhanced Rate <b>Rs. <?php if($pensioner->pay_commission==7){ echo ($total_amount*50/100);} else { echo $pensioner->getEnhanceRate();
 	} ?>/- (Rupees <?php 
 
 if($pensioner->pay_commission==7)
 	{ echo no_to_words($total_amount*50/100);} 
 else
 	{echo no_to_words($pensioner->getEnhanceRate());}
 ?>)
 	</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">     <FONT FACE="">(b)
 At normal Rate w.e.f <b>Rs. <?php if($pensioner->pay_commission==7){ echo ($total_amount*50/100-$total_amount*50/100*40/100);} else {echo $pensioner->getOrdinaryRate();} ?> /- <!-- PM<?php echo $pensioner->getDRMA(); ?>/- -->(Rupees <?php 
 
 if($pensioner->pay_commission==7)
 	{ echo no_to_words($total_amount*50/100-$total_amount*50/100*40/100);} 
 else
 	{echo no_to_words($pensioner->getOrdinaryRate());}
 ?>)
</b></FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE=""><B>5.
    </B></FONT><FONT FACE="">Details</FONT><FONT FACE=""><B>
</B></FONT><FONT FACE="">of Disbursing Bank.</FONT></P>
<P STYLE="margin-bottom: 0.14in">      <FONT FACE="">i.
 Name of Bank <b>……………………………………………</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">     <FONT FACE="">ii.
 Branch and Code No. (if any) <b>………………………………………………………</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">    <FONT FACE="">iii.
 Account No <b>………………………………………………</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">    <FONT FACE="">iv.
 Deptt. <b>……………………………………………………</b></FONT></P>
<P STYLE="margin-bottom: 0.14in">    <FONT FACE="">v.
  State <b>………………………………………………………</b></FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE=""><B>6</B></FONT><FONT FACE="">.
  The quantum of pension/Family pension available to the old
pensioners/Family pensioner shall be increased as follows:-</FONT></P>
<TABLE WIDTH=750 CELLPADDING=0 CELLSPACING=0 >
	<COL WIDTH=307>
	<COL WIDTH=307>
	<TR VALIGN=TOP>
		<TD WIDTH=307 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE=""><B>Age of
			pensioner/Family pensioner</B></FONT></P>
		</TD>
		<TD WIDTH=307 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P ALIGN=CENTER><FONT FACE=""><B>Additional
			quantum of pension</B></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=0 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P STYLE="margin-bottom: 0in"><FONT FACE="">From
			80 years to less than 85 years</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">From
			85 years to less than 90 years</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">From
			90 years to less than 95 years</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">From
			95 years to less than 100 years</FONT></P>
			<P><FONT FACE="">100 years or more.</FONT></P>
		</TD>
		<TD WIDTH=0 STYLE="border: 1px solid #000001; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
			<P STYLE="margin-bottom: 0in"><FONT FACE="">20%
			of revised basic pension/family pension</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">30%
			of revised basic pension/family pension</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">40%
			of revised basic pension/family pension</FONT></P>
			<P STYLE="margin-bottom: 0in"><FONT FACE="">50%
			of revised basic pension/family pension</FONT></P>
			<P><FONT FACE="">100% of revised basic
			pension/family pension</FONT></P>
		</TD>
	</TR>
</TABLE>
<P STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P STYLE="margin-bottom: 0.14in"><!-- <BR><BR> -->
</P>
<P STYLE="margin-bottom: 0.14in">                                    
                                                                     
<FONT FACE="" style="margin-left:700px;">Yours faithfully,</FONT></P>
</BR></BR></br>
<!--<P STYLE="margin-bottom: 0.14in">
</P>
 <P STYLE="margin-bottom: 0.14in"></P> -->
<P STYLE="margin-bottom: 0.14in;">                                    
<FONT FACE="" style="margin-left:640px;">Joint Director of Audit & Pension</FONT></br>
<FONT FACE="" style="margin-left:650px;">Directorate of Audit & Pension</FONT></br>
<FONT FACE="" style="margin-left:720px;">Naharlagun</FONT></P></br>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">Memo
No…………………………….</FONT>                                 
<FONT FACE="" style="margin-left:420px;">Dated Naharlagun, the……………………</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">Copy:-</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">1.</FONT></P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">2.</FONT></P>
<P STYLE="margin-bottom: 0.14in"><!-- <BR><BR> -->
</P>
<P STYLE="margin-bottom: 0.14in"><FONT FACE="">*In
case the family pension does not undergo any change as a result of
revision of pension, the words “No change” should be inserted in
column No. 4. In case family pension is not admissible, the words
‘Not applicable’ should be inserted in this column.</FONT></P>

			</div>
			</div>
			<!-- </form> -->
			</div>


<?php 
//print_r($apex_designation);
//print_r($pensioner);
if(!in_array($pensioner->designation, $apex_designation)) : ?>

	

<div id="disburser_disburser_portion" style="display:none" >
  <button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print6')"><i class="icon-white icon-print"></i>Print</button>
		<div id="print6" style="width: 1000px; margin: 0px auto;">
		  <div style="width:1000px; min-height:600px; padding: 0 10px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em;">
			   
            <?php if($class_of_pension=='Liberalised_Pension'){?>
			<table width="95%" cellpadding="3" id="report" border="0">
					<tr>
						<td style="vertical-align: top;" width="20%"></td>
						<td style="vertical-align: top;" width="42%"></td>
						<td style="vertical-align: top;" width="9%"></td>
					  <td style="vertical-align: top;" width="29%"></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="3">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial; margin-left: 250px;margin-top:-25px; font-weight:bold">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>DISBURSER'S PORTION</div>
						    </div>						</td>
						<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3">
							<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>						</td>		
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3"><strong>Charged:</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Class of Pension: <?php echo str_replace("_", " ", $class_of_pension); ?></strong></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;"><strong>Name of Pensioner: </strong></div>
							<div style="float: left;"><strong><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <br /><?php echo nbs(1).strtoupper($name); ?>, <?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></strong></div>						</td>
						<td colspan="2" style="text-align:left;"><strong>Place for signature of pensioner to be<br/> 
					    taken at the time of first payment</strong></td>
					</tr>
					
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="0" cellpadding="0" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Class of Pension and date of commencement</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Date of Birth</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Religion and Nationality</strong></td>
									<td width="30%" style="vertical-align: top; text-align: center;"><strong>Residence showing village pargana</strong></td>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Amount of monthly pension</strong></td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong><?php echo str_replace("_", " ", $class_of_pension); ?><br/>
								    w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php $hd=$pensioner->getDOBOfLegalHeir();
											echo date('d-m-Y',strtotime($hd)); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->religion.", ".$pensioner->nationality;?></strong></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="30%"><strong><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong>Rs. 
						            <?php 

		    
		    echo $pensioner->getAmountofPension(); 

		    ?> 
								    PM
								    <?php 
		    echo $pensioner->getDRMA(); 
		    ?>
	                                <br/>
	                                w.e.f 
	                                <?php 
		    echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
		    ?> until re-marriage or death.
								    </strong></td>
								</tr>
							</table>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<strong>Date of death of the pensioner:<br/>
							(To be filled in and attested by the Treasury Officer)						</strong></td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%"><strong>Pay Scale</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->pay_scale; ?>/<?php echo $pensioner->pay_scale_grade; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Designation</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->designation; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Last Pay</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong>Rs. 
						            <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>
								    /-</strong></td>
								</tr>
							</table>						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 0px;font-weight:bold;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
					  <td style="vertical-align: top;" colspan="4"><strong>Sir,</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<strong><?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?>, a sum of Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?> only (less income-tax), being the amount of <?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?>
							<?php //echo $pensioner->effect_of_pension; ?>
							.<br/>
							&nbsp;
							<?php
								
									echo 'Further, the quantum of pension/Family pension shall be increased as follows:-<br />';	
															?>				 		
							</strong></td>
					</tr>
					
		 			<?php
						$dob 	= new DateTime($pensioner->getDOBOfLegalHeir());
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" ><!-- style="border:1px solid#000" -->
						<div style="width:100%;  border:1px solid#000">
						    <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= 
							<?php  echo round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getAmountofPension(); ?>
							= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							</strong></div></td>	
					</tr>
					<tr style="height:0px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />

							
						  c) Excess Gratuity Paid <?php 
						  //echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); 
						  if($pensioner->provisional_gratuity>$pensioner->getDCRG()) 
						  {echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); }
						  else
						  {echo "Rs. 0";}
						  ?> <br/>
							
							
						  e) Others if any Rs. <?php echo $pensioner->others; ?>						</strong></td>
						<td style="vertical-align: top;" colspan="2"><strong>
						  b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
						  d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />						
						  </strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><div align="left"><strong>
						To<br/>
						<!--The Treasury Officer<br/>-->
				      </strong></div></td>
					    <td align="right"><strong>Signature_________________</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  <?php echo $pensioner->treasuryOfficer(); ?>						</strong></td>
						<td colspan="2" align="right"><strong>
						  Designation_______________						</strong></td>
					</tr>
			</table>
			<?php }
			else{
			?>

			<table width="95%" cellpadding="3" id="report" border="0">
					<tr>
						<td style="vertical-align: top;" width="20%"></td>
						<td style="vertical-align: top;" width="42%"></td>
						<td style="vertical-align: top;" width="9%"></td>
					  <td style="vertical-align: top;" width="29%"></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="3">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial; margin-left: 250px;margin-top:-25px; font-weight:bold">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>DISBURSER'S PORTION</div>
						    </div>						</td>
						<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3">
							<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>						</td>		
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3"><strong>Charged:</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Class of Pension: <?php echo str_replace("_", " ", $class_of_pension); ?></strong></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;"><strong>Name of Pensioner: </strong></div>
							<div style="float: left;"><strong><?php echo nbs(1).strtoupper($name); ?>, <br />
					        <?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></strong></div>						</td>
						<td colspan="2" style="text-align:left;"><strong>Place for signature of pensioner to be<br/> 
					    taken at the time of first payment</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Name of his wife / her husband: <?php 
						 if($pensioner->WifeDODCondition()>'0')
						  {echo 'N/A';}
						  else
						  {echo $pensioner->getNameofSpouse(); }
						 
						?></strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="0" cellpadding="0" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Class of Pension and date of commencement</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Date of Birth</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Religion and Nationality</strong></td>
									<td width="30%" style="vertical-align: top; text-align: center;"><strong>Residence showing village pargana</strong></td>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Amount of monthly pension</strong></td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong><?php echo str_replace("_", " ", $class_of_pension); ?><br/>
								    w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->religion.", ".$pensioner->nationality;?></strong></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="30%"><strong><?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong>Rs. 
						            <?php 

		    
		    echo $pensioner->getAmountofPension(); 

		    ?> 
								    PM
								    <?php 
		    echo $pensioner->getDRMA(); 
		    ?>
	                                <br/>
	                                w.e.f 
	                                <?php 
		    echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
		    ?>
								    </strong></td>
								</tr>
							</table>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<strong>Date of death of the pensioner:<br/>
							(To be filled in and attested by the Treasury Officer)						</strong></td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%"><strong>Pay Scale</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->pay_scale; ?>/<?php echo $pensioner->pay_scale_grade; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Designation</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->designation; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Last Pay</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong>Rs. 
						            <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>
								    /-</strong></td>
								</tr>
							</table>						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 0px;font-weight:bold;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
					  <td style="vertical-align: top;" colspan="4"><strong>Sir,</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<strong><?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?>, a sum of Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?> only (less income-tax), being the amount of <?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?>
							<?php //echo $pensioner->effect_of_pension; ?>
							.<br/>
							&nbsp;
		
							<?php
								
									echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.In the event of the death of <b>'.strtoupper($name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.($pensioner->WifeDODCondition()>'0'?'N/A':'$pensioner->getNameofSpouse()').'</b>, whose date of birth is <b>'.($pensioner->WifeDODCondition()>'0'?'N/A':'$pensioner->getDOBofSpouse()').' </b> from the day following the date of death of <b>'.strtoupper($name).'</b> for a period of 7 years, or for a period up to the date on which '.$pensioner->pensioner_pronoun.' would have attained the age of '.$pensioner->pension_attained_age.' years, had '.$pensioner->pensioner_pronoun.' survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br />';	
															?>				 		
							</strong></td>
					</tr>
					
		 			<?php
						$dob 	= new DateTime($pensioner->dob);
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" ><!-- style="border:1px solid#000" -->
						<div style="width:100%;  border:1px solid#000">
						    <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= 
							<?php  echo round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getAmountofPension(); ?>
							= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							</strong></div></td>	
					</tr>
					<tr style="height:0px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />

							
						  c) Excess Gratuity Paid <?php 
						  //echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); 
						  if($pensioner->provisional_gratuity>$pensioner->getDCRG()) 
						  {echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); }
						  else
						  {echo "Rs. 0";}
						  ?> <br/>
							
							
						  e) Others if any Rs. <?php echo $pensioner->others; ?>						</strong></td>
						<td style="vertical-align: top;" colspan="2"><strong>
						  b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
						  d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />						
						  </strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><div align="left"><strong>
						To<br/>
						<!--The Treasury Officer<br/>-->
				      </strong></div></td>
					    <td align="right"><strong>Signature_________________</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  <?php echo $pensioner->treasuryOfficer(); ?>						</strong></td>
						<td colspan="2" align="right"><strong>
						  Designation_______________						</strong></td>
					</tr>
			</table>

			<?php }?>

		  </div>
		</div>
	</div>

	<div id="disburser_pensioner_portion" style="display:none">
  <button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print7')"><i class="icon-white icon-print"></i>Print</button>
		<div id="print7" style="width: 1000px; margin: 0px auto;">
		  <div style="width:1000px; min-height:600px; padding: 0 10px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
		  <?php if($class_of_pension=='Liberalised_Pension'){?>
			<table width="95%" cellpadding="3" id="report" border="0">
					<tr>
						<td style="vertical-align: top;" width="20%"></td>
						<td style="vertical-align: top;" width="42%"></td>
						<td style="vertical-align: top;" width="9%"></td>
					  <td style="vertical-align: top;" width="29%"></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="3">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial; margin-left: 250px;margin-top:-25px; font-weight:bold">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>PENSIONER'S PORTION</div>
						    </div>						</td>
						<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3">
							<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>						</td>		
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3"><strong>Charged:</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Class of Pension: <?php echo str_replace("_", " ", $class_of_pension); ?></strong></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;"><strong>Name of Pensioner: </strong></div>
							<div style="float: left;"><strong><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <br /><?php echo nbs(1).strtoupper($name); ?>, <?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></strong></div>						</td>
						<td colspan="2" style="text-align:left;"><strong>Place for signature of pensioner to be<br/> 
					    taken at the time of first payment</strong></td>
					</tr>
					
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="0" cellpadding="0" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Class of Pension and date of commencement</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Date of Birth</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Religion and Nationality</strong></td>
									<td width="30%" style="vertical-align: top; text-align: center;"><strong>Residence showing village pargana</strong></td>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Amount of monthly pension</strong></td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong><?php echo str_replace("_", " ", $class_of_pension); ?><br/>
								    w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php $hd=$pensioner->getDOBOfLegalHeir();
											echo date('d-m-Y',strtotime($hd)); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->religion.", ".$pensioner->nationality;?></strong></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="30%"><strong><?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong>Rs. 
						            <?php 

		    
		    echo $pensioner->getAmountofPension(); 

		    ?> 
								    PM
								    <?php 
		    echo $pensioner->getDRMA(); 
		    ?>
	                                <br/>
	                                w.e.f 
	                                <?php 
		    echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
		    ?> until re-marriage or death.
								    </strong></td>
								</tr>
							</table>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<strong>Date of death of the pensioner:<br/>
							(To be filled in and attested by the Treasury Officer)						</strong></td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%"><strong>Pay Scale</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->pay_scale; ?>/<?php echo $pensioner->pay_scale_grade; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Designation</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->designation; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Last Pay</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong>Rs. 
						            <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>
								    /-</strong></td>
								</tr>
							</table>						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 0px;font-weight:bold;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
					  <td style="vertical-align: top;" colspan="4"><strong>Sir,</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<strong><?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <?php echo $pensioner->getNameOfLegalHeir(); ?><?php echo nbs(1); ?>of <?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?>, a sum of Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?> only (less income-tax), being the amount of <?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?>
							<?php //echo $pensioner->effect_of_pension; ?>
							.<br/>
							&nbsp;
							<?php
								
									echo 'Further, the quantum of pension/Family pension shall be increased as follows:-<br />';	
															?>				 		
							</strong></td>
					</tr>
					
		 			<?php
						$dob 	= new DateTime($pensioner->getDOBOfLegalHeir());
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" ><!-- style="border:1px solid#000" -->
						<div style="width:100%;  border:1px solid#000">
						    <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= 
							<?php  echo round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getAmountofPension(); ?>
							= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							</strong></div></td>	
					</tr>
					<tr style="height:0px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />

							
						  c) Excess Gratuity Paid <?php 
						  //echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); 
						  if($pensioner->provisional_gratuity>$pensioner->getDCRG()) 
						  {echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); }
						  else
						  {echo "Rs. 0";}
						  ?> <br/>
							
							
						  e) Others if any Rs. <?php echo $pensioner->others; ?>						</strong></td>
						<td style="vertical-align: top;" colspan="2"><strong>
						  b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
						  d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />						
						  </strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><div align="left"><strong>
						To<br/>
						<!--The Treasury Officer<br/>-->
				      </strong></div></td>
					    <td align="right"><strong>Signature_________________</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  <?php echo $pensioner->treasuryOfficer(); ?>						</strong></td>
						<td colspan="2" align="right"><strong>
						  Designation_______________						</strong></td>
					</tr>
			</table>
			<?php }
			else{
			?>

			<table width="95%" cellpadding="3" id="report" border="0">
					<tr>
						<td style="vertical-align: top;" width="20%"></td>
						<td style="vertical-align: top;" width="42%"></td>
						<td style="vertical-align: top;" width="9%"></td>
					  <td style="vertical-align: top;" width="29%"></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="3">
							<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
						        <div style="font-family: initial; margin-left: 250px;margin-top:-25px; font-weight:bold">FORM-43<br/>(See paragraph 306)<br/>PENSION PAYMENT ORDER<br/>PENSIONER'S PORTION</div>
						    </div>						</td>
						<td style="vertical-align: top;" align="right" rowspan="3"><div id="photograph" style="width: 150px; height: 128px; border: 1px solid #bababa; border-radius: 3px; -moz-border-radius: 3px; margin-top: 63px;"><p style="text-align: center; margin-top: 50px; font-weight: bold;">Photograph</p></div></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3">
							<b>Debitable to Arunachal Pradesh Government<br/>Head of Account – 2071 Pension & ORB<br/>Minor Head<br/><u>Voted</u></b>						</td>		
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="3"><strong>Charged:</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Class of Pension: <?php echo str_replace("_", " ", $class_of_pension); ?></strong></td>
					</tr>	
				 	<tr>
						<td style="vertical-align: top;" colspan="2">
							<div style="float: left;"><strong>Name of Pensioner: </strong></div>
							<div style="float: left;"><strong><?php echo nbs(1).strtoupper($name); ?>, <br />
					        <?php echo nbs(1); ?>Rtd. <?php echo $pensioner->designation; ?></strong></div>						</td>
						<td colspan="2" style="text-align:left;"><strong>Place for signature of pensioner to be<br/> 
					    taken at the time of first payment</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><strong>Name of his wife / her husband: <?php 
						 if($pensioner->WifeDODCondition()>'0')
						  {echo 'N/A';}
						  else
						  {echo $pensioner->getNameofSpouse(); }
						 
						?></strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<table border="1" cellspacing="0" cellpadding="0" width="100%" id="inner-table">
								<tr>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Class of Pension and date of commencement</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Date of Birth</strong></td>
									<td width="0%" style="vertical-align: top; text-align: center;"><strong>Religion and Nationality</strong></td>
									<td width="30%" style="vertical-align: top; text-align: center;"><strong>Residence showing village pargana</strong></td>
									<td width="20%" style="vertical-align: top; text-align: center;"><strong>Amount of monthly pension</strong></td>
								</tr>
								<tr>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong><?php echo str_replace("_", " ", $class_of_pension); ?><br/>
								    w.e.f <?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="0%"><strong><?php echo $pensioner->religion.", ".$pensioner->nationality;?></strong></td>
									<td style="vertical-align: top; text-align: center;font-size: 12px;" width="30%"><strong><?php echo strtoupper($name).'<br />'.$pensioner->address_after_retirement; ?></strong></td>
									<td style="vertical-align: top; text-align: center;" width="20%"><strong>Rs. 
						            <?php 

		    
		    echo $pensioner->getAmountofPension(); 

		    ?> 
								    PM
								    <?php 
		    echo $pensioner->getDRMA(); 
		    ?>
	                                <br/>
	                                w.e.f 
	                                <?php 
		    echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); 
		    ?>
								    </strong></td>
								</tr>
							</table>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4">
							<strong>Date of death of the pensioner:<br/>
							(To be filled in and attested by the Treasury Officer)						</strong></td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="0" cellspacing="2" cellpadding="2" width="100%">
								<tr>
									<td width="20%"><strong>Pay Scale</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->pay_scale; ?>/<?php echo $pensioner->pay_scale_grade; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Designation</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong><?php echo $pensioner->designation; ?></strong></td>
								</tr>
								<tr>
									<td width="20%"><strong>Last Pay</strong></td>
									<td width="3%"><strong>:</strong></td>
									<td width="77%"><strong>Rs. 
						            <?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay(false);} ?>
								    /-</strong></td>
								</tr>
							</table>						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<td style="vertical-align: top; text-align:center" colspan="4">
							<div style="font-size: 15px; margin-top: 0px;font-weight:bold;">OFFICE OF THE DIRECTOR OF AUDIT & PENSION<br/>GOVERNMENT OF ARUNACHAL PRADESH, NAHARLAGUN</div>						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>No. <?php echo $pensioner->case_file_no."/".$pensioner->ppo_no; ?></strong></td>
						<td style="vertical-align: top;text-align:right;" colspan="2"><strong>Date - <?php echo date('d/m/Y')?></strong></td>
					</tr>
					<tr>
					  <td style="vertical-align: top;" colspan="4"><strong>Sir,</strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top; text-align: justify;" colspan="4">
							<strong><?php echo nbs(6); ?>UNTIL FURTHER NOTICE and on the expiration of every month, be pleased to pay to <?php echo strtoupper($name); ?>, Rtd. <?php echo $pensioner->designation; ?>, a sum of Rs. <?php echo $pensioner->getAmountofPension(); ?>/- PM<?php echo $pensioner->getDRMA(); ?> only (less income-tax), being the amount of <?php echo strtoupper(str_replace("_", " ", $pensioner->class_of_pension)); ?>, as Arunachal Pradesh Government Pensioner upon the production of this Order and a receipt according to usual form.<br/>
							The payment should commence from <?php echo date_format(date_create($pensioner->effect_of_pension), "d-m-Y"); ?>
							<?php //echo $pensioner->effect_of_pension; ?>
							.<br/>
							&nbsp;
							<?php
								
									echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.In the event of the death of <b>'.strtoupper($name).'</b>, Family Pension of <b>Rs. '.$pensioner->getAmountofPension().'/- PM'.$pensioner->getDRMA().'</b>, may be paid to <b>'.($pensioner->WifeDODCondition()>'0'?'N/A':'$pensioner->getNameofSpouse()').'</b>, whose date of birth is <b>'.($pensioner->WifeDODCondition()>'0'?'N/A':'$pensioner->getDOBofSpouse()').' </b> from the day following the date of death of <b>'.strtoupper($name).'</b> for a period of 7 years, or for a period up to the date on which '.$pensioner->pensioner_pronoun.' would have attained the age of '.$pensioner->pension_attained_age.' years, had '.$pensioner->pensioner_pronoun.' survived, whichever is less; thereafter normal rate of Family pension of <b>Rs. '.$pensioner->getOrdinaryRate().'/- PM'.$pensioner->getDRMA().'</b>, till the date of her/his remarriage or death whichever is earlier (on receipt of death certificate and Form of application from widow/widower). Further, the quantum of pension/Family pension shall be increased as follows:-<br />';	
															?>				 		
							</strong></td>
					</tr>
					
		 			<?php
						$dob 	= new DateTime($pensioner->dob);
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" ><!-- style="border:1px solid#000" -->
						<div style="width:100%;  border:1px solid#000">
						    <strong>Quantum of Additional Pension/Family Pension<br/>
							1.Age W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php //echo $pensioner->dateTimeToDate($year85); 
							$year85plus = new DateTime($year85);
							$year85plus->modify('-1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= 
							<?php  echo round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  
							<br />
							2.Age W.e.f 
							<?php //$year85plus = new DateTime($year85);
							// $year85plus->modify('+1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							echo $pensioner->dateTimeToDate($year85);

							// $year85plus = new DateTime($year85);
							// $year85plus->modify('-1 day');
							// $year85plus1 = date_format($year85plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year85plus1);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year90); 
							$year90plus = new DateTime($year90);
							$year90plus->modify('-1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);

							?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.Age W.e.f  
							<?php //$year90plus = new DateTime($year90);
							// $year90plus->modify('+1 day');
							// $year90plus1 = date_format($year90plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year90plus1);
							echo $pensioner->dateTimeToDate($year90);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year95); 
							$year95plus = new DateTime($year95);
							$year95plus->modify('-1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);

							?>(90 yrs.) 40% increase on  Rs. 
							<?php  echo $pensioner->getAmountofPension(); ?>
							= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.Age W.e.f 
							<?php //$year95plus = new DateTime($year95);
							// $year95plus->modify('+1 day');
							// $year95plus1 = date_format($year95plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year95plus1);
							echo $pensioner->dateTimeToDate($year95);
							?> 
							to <?php //echo $pensioner->dateTimeToDate($year100);
							$year100plus = new DateTime($year100);
							$year100plus->modify('-1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);

							?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							5.Age W.e.f 
							<?php //$year100plus = new DateTime($year100);
							// $year100plus->modify('+1 day');
							// $year100plus1 = date_format($year100plus,"Y-m-d");
							// echo $pensioner->dateTimeToDate($year100plus1);
							echo $pensioner->dateTimeToDate($year100);
							?> 
							to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							</strong></div></td>	
					</tr>
					<tr style="height:0px;"></tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b>RECOVERIES</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  a) Provisional Pension Rs. <?php echo $pensioner->provisional_pension; ?><br />

							
						  c) Excess Gratuity Paid <?php 
						  //echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); 
						  if($pensioner->provisional_gratuity>$pensioner->getDCRG()) 
						  {echo $pensioner->provisional_gratuity - $pensioner->getDCRG(); }
						  else
						  {echo "Rs. 0";}
						  ?> <br/>
							
							
						  e) Others if any Rs. <?php echo $pensioner->others; ?>						</strong></td>
						<td style="vertical-align: top;" colspan="2"><strong>
						  b) Provisional RG/DG Rs. <?php echo $pensioner->provisional_gratuity; ?><br />
						  d) Excess pay and Allowances Rs. <?php echo $pensioner->excess_pay_and_allowances; ?><br />						
						  </strong></td>
					</tr>
					<tr>
						<td style="vertical-align: top;" colspan="4"><b><u>N.B.:- The Specimen Signature/Descriptive Roll/Identification Mark are enclosed.</u></b></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><div align="left"><strong>
						To<br/>
						<!--The Treasury Officer<br/>-->
				      </strong></div></td>
					    <td align="right"><strong>Signature_________________</strong></td>
					</tr>
				 	<tr>
						<td style="vertical-align: top;" colspan="2"><strong>
						  <?php echo $pensioner->treasuryOfficer(); ?>						</strong></td>
						<td colspan="2" align="right"><strong>
						  Designation_______________						</strong></td>
					</tr>
			</table>

			<?php }?>
		  </div>
		</div>
	</div>

<?php else : ?>

	<!-- Report for apex pay scale for IFS, IAS, IPS Officer -->
	<div id="disburser_disburser_portion" style="display: none;">
		<select id="select-disburser-to-print">
			<option value="0">--Select--</option>
			<option value="disburser_ppo1" selected>PPO Report 1</option>
			<option value="disburser_ppo2">PPO Report 2</option>
			<option value="disburser_ppo3">PPO Report 3</option>
			<option value="disburser_ppo4">PPO Report 4</option>
			<option value="disburser_ppo5">PPO Report 5</option>
			<option value="disburser_ppo6">PPO Report 6</option>
		</select>

		<div id="disburser_ppo1" style="display:block;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo1')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo1" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							


							<tr>
								<td align="center" style="vertical-align: top; padding: 200px 0 30px 0;" colspan="4">
								<table width="40%" border="1">
								<tr>
									<td>
										<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 24px;">PENSION PAYMENT ORDER<br>DISBURSER'S PORTION</div>
								    </div>
									</td>
								</tr>
								</table>
									

								</td>
							</tr>

						 <?php  $pensionername=explode(".",$pensioner->name);

						 ?>

							<tr>
								<td colspan="3" style="padding-top:40%" height="600px">
									<table width="100%" border="1" height="300px">
										<tr height="30px;">
											<td><b><h2>1</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">NAME OF THE PENSIONER</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;" width="40%"><?php if($pensionername[0]=="Dr"){echo $pensioner->name;}else{ echo $name;}?></td>
										</tr>
										<tr>
											<td><b><h2>2</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DESIGNATION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->designation; ?></td>
										</tr>
										<tr>
											<td><b><h2>3</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>SERVICE TO WHICH BELONG</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php if(!in_array($pensioner->designation, $apex_designation)) {echo ""; }else{ echo "IFS";}?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>4</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>BATCH</h2></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"></td>
										</tr>
										<tr>
											<td><b><h2>5</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>DATE OF RETIREMENT</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php echo $pensioner->dor;?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>6</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DATE OF COMMENCEMENT OF PENSION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->effect_of_pension; ?></td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<div id="disburser_ppo2" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo2')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo2" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 30px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr><td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td></tr>
							<tr>
								<td style="vertical-align: top;" colspan="4">
									<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial;">FORM CAM-52<br>(Para 7.3.2)<br><br>PENSION PAYMENT ORDER<br>(DISBURSER'S PORTION)</div>
								    </div>
								</td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;">P.P.O. No.</td>
								<td colspan="2" style="vertical-align: top; padding: 7px;">
									<b><?php echo $ppo_no; ?></b>
								</td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">
									Debitable to Union Government
								</td>
								<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">Date <u><?php echo nbs(5); ?><?php echo date('d-m-Y'); ?><?php echo nbs(5); ?></u></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4">
									<?php echo nbs(28); ?><u>Head of Account</u>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head</td>		
								<td style="vertical-align: top; padding: 7px;" colspan="2">2071 Pension &amp; ORB </td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head<br /><?php echo nbs(30); ?>Voted/Charged</td>
								<td style="vertical-align: top; padding: 7px;" colspan="2">04 Ordinary Pension (AIS)</td>
							</tr>
							<tr>
								<td height="40px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="left">Sir,</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">
									<?php echo nbs(30); ?>UNTIL FURTHER NOTICE, and on the expiration of every month be pleased to pay <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b> the pension as set out in Part II of this order/Family pension as set out in Para-III of this order* plus the amount of dearness relief as admissible from time to time thereon after due identification of the prisioner/family pension. The payment should commence from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b>. The Income tax, where deductible, should be deducted at source.
								</td>
							</tr>
							<tr>
								<td height="20px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">2.<?php echo nbs(27); ?>Arrears of pension/family pension at <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-(Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>only)</b></b> only per month from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b> plus the admissible dearness relief thereon may also be paid to <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b></td>
							</tr>
							<tr>
								<td colspan="4">
									<div style="border: 1px solid #000; margin-top: 20px;"></div>
								</td>
							</tr>
					        <tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">[*Inapplicable clause to be deleted]</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 55px 0 10px 0; text-align:center">Signature</td>
							</tr>
							
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 20px 0 10px 0; text-align:center">Designation</td>
							</tr>
							<tr>
								<td colspan="4" style="vertical-align: top; padding: 7px; text-align:center">(Special Seal Of the Pension Payment Order Issuing Authority)</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4"> To,</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2">
									(1) <b>The Pay &amp; Accounts Officer,</b>
								</td>
								<td style="vertical-align: top; padding: 7px; text-align: center;" colspan="2"><b>Central Pension Accounting Office<br />Trikoot - II Bhikaji Cama Place<br />New Delhi - 110006</b></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2">(2) Name of Paying Branch</td>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(20).str_replace(",", ",<br />".nbs(19), $pensioner->bank_name)."<br />".nbs(20)."A/C No. - ".$pensioner->account_no."<br />".nbs(20)."Code No. - ".$pensioner->code_no;?></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2" style="vertical-align: top; padding: 7px; text-align: center;"></td>
							</tr>

							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 140px 30px 10px 0; text-align:center">Signature</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo3" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo3')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo3" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table width="100%" cellpadding="3" id="report" border="0">
						<tr>
							<td style="vertical-align: top; padding-bottom: 20px;" colspan="2">
								<div>
									Part 1 :- Particulars of service of the pensioner/deceased Government Servant* <br />
									<p style="margin: 0px;text-align: right;">(*strike out whichever is not admissible)</p>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								1.	Name of the Government Servant. <b><?php echo strtoupper($name); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								2.	Post/Grade/Rank last held. <b>Retd. <?php echo $pensioner->designation;?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								3.	Name of the Ministry/Deptt./Office from which he/she retired under the Govt. of India/State.
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<b><?php echo str_replace(",", ",<br />", $pensioner->office_address); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								4.	Scale of Pay/Pay Band & Grade Pay at the time of retirement (Mandatory): <b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?></b>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">4(a)	Pay last drawn :- </td>
							<td style="padding: 7px;"><b>Rs. <?php echo array_sum($pensioner->lp); ?>/-</b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">5. Date of Birth :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">6. Date of entry into Governement service :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">7. Date of ending service (Last day of Service) :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">8. Details of weight age in service allowed, if any :-</td>
							<td style="padding: 7px;"><b>NIL</b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">9. Period of service not qualifying for pension :-</td>
							<td style="padding: 7px;"><b>NIL</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 20px 0 30px 0;">
								<table width="100%" border="1">
									<tr>
										<th>From</th>
										<th>To</th>
										<th colspan="3">Period</th>
										<th>Reasons</th>
									</tr>
									<tr>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center">Y</td>
										<td align="center">M</td>
										<td align="center">D</td>
										<td align="center"></td>
									</tr>
									<tr>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">10. Total length of qualifying service<br /><?php echo nbs(7); ?>[Col.(7-6)+8+9]</td>
							<td valign="top" style="padding: 7px;">
								<?php $lists = explode(" ", $pensioner->total_service); ?>
								<ul style="list-style: none;">
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Years</b><br/><?php echo $lists[0]; ?></li>
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Months</b><br/><?php echo $lists[2]; ?></li>
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Days</b><br/><?php echo $lists[4]; ?></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								11.	EMOLUMENTS DRWAN DURING 10 MONTHS PERIOD AND THOSE RECKONED FOR CALCULATION OF EVERAGE EMOLUMENTS.
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px 0;">
								<table width="100%" cellpadding="3" cellspacing="3" border="1">
									<tr>
										<td>From</td>
										<td>To</td>
										<td colspan="3">Emoluments drawn</td>
										<td colspan="3">Emoluments reckoned for Average emoluments</td>
										<td>Remarks</td>
									</tr>
									<tr>
										<td width="11%" valign="top"></td>
										<td width="11%" valign="top"></td>
										<td width="11%" valign="top">Pay & Grade Pay</td>
										<td width="11%" valign="top">Other Items with details viz. personal pay Spl. Pay. Deputation Allowance DA etc.</td>
										<td width="11%" valign="top">Total</td>
										<td width="11%" valign="top">Pay & Grade Pay</td>
										<td width="11%" valign="top">Other items reckoned with details</td>
										<td width="11%" valign="top">Total</td>
										<td width="11%" valign="top"></td>
									</tr>
									<tr>
										<td align="center">1</td>
										<td align="center">2</td>
										<td align="center">3</td>
										<td align="center">4</td>
										<td align="center">5</td>
										<td align="center">6</td>
										<td align="center">7</td>
										<td align="center">8</td>
										<td align="center">9</td>
									</tr>
									<tr>
										<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
										<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/-</b></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/-</b></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->getAverageEmolument(); ?>/-</b></td>
										<td align="center"></td>
									</tr>
								</table>
							</td>
						</tr>
						<?php 
						//$ae=($pensioner->pay_info[1]['increament_GP']=='0')?"NIL":$pensioner->getAverageEmolument();?>

						<tr>
							<td colspan="2" style="padding: 60px 0;">12. Average Emoluments <b>Rs. <?php echo $pensioner->getAverageEmolument(); ?></b></td>
						</tr>
						
							<tr>
								<td colspan="2" style="text-align:right;padding:0px 140px;">Signature</td>
							</tr>
					 	
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo4" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo4')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo4" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table width="100%" cellpadding="3" id="report" border="0">
						<tr>
							<td valign="top" width="70%" style="padding: 7px;">13. Emoluments for family pension</td>
							<td valign="top" width="30%"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">14. Emoluments for Retirement Gratuity/Death Gratuity</td>
							<td valign="top"><b>Rs. 80000/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">15. Amount of Retirement Gratuity/Death Gratuity allowed</td>
							<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG(); ?>/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">16. Grant of Medical allowance to be paid by Bank</td>
							<td valign="top"><b>Rs. 500/- p.m</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">17. Constable Attendant allowance<br /><?php echo nbs(7); ?>(No Dearness Relief is payable on Sl. NO. 6 & 17)</td>
							<td valign="top"><b>Rs.</b></td>
						</tr>
						<tr>
							<td colspan="2" align="center" style="padding: 7px;">
								<b>Part - II<br />(Applicable on Pensioner)</b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;"><b><u>Section 1 - Particulars of Pensioner</u></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">1. Joint photograph with the spouse</td>
							<td rowspan="3" align="right">
								<div style="width: 135px; height: 125px; border: 1px solid #bababa;">
									&nbsp;
								</div>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">2. Name of the retiring Govt. Servant :- <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">
								3.	Permanent Address :-<br />
									<b><?php echo nbs(5).str_replace(",", ",<br/>".nbs(4), $pensioner->address_after_retirement); ?></b>							
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">4. Personal Marks of identification :- <b>Enclosed</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">5. Signature or the left hand Thumb impression of the pensioner (To be otained at the time of first payment of pension) :- <b>Enclosed</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;"><b><u>Section 2 - Details of pension.</u></b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="8%" align="center" valign="top">Sl. No.</td>
										<td width="30%" align="center" valign="top"></td>
										<td width="20%" align="center" valign="top">Original pension</td>
										<td width="20%" align="center" valign="top">Revised pension<br />(1)</td>
										<td width="22%" align="center" valign="top">Revised pension<br />(2)</td>
									</tr>
									<tr>
										<td valign="top">1</td>
										<td valign="top">Amount of monthly Pension before commutation</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">2</td>
										<td valign="top">Class of Pension</td>
										<td colspan="3" align="center" valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
									</tr>
									<tr>
										<td valign="top">3</td>
										<td valign="top">Rules under which sanctioned</td>
										<td valign="top" colspan="3"><b>Rule <?php if($class_of_pension="Voluntary_Retirement_Pension"){echo "48(A)";}elseif($class_of_pension="Superannuation_Pension") {echo "35";}elseif ($class_of_pension=" Normal_Family_Pension") {echo "54";}?> of CCS (P) Rule 1972</b></td>
									</tr>
									<tr>
										<td valign="top">4</td>
										<td valign="top">Date of commencement of pension</td>
										<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">5</td>
										<td valign="top">Fraction/amount of pension commuted, if any</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue(); ?></b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">6</td>
										<td valign="top">Commuted value and the date of its payment</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getCommutationofPension(); ?></b></td>
										<td valign="top">(Not yet paid)</td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">7</td>
										<td valign="top">Reduced monthly pension after commutation</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">8</td>
										<td valign="top">Date of commencement of reduced pension</td>
										<td valign="top" colspan="3"><b>From the date of payment of commuted value</b></td>
									</tr>
									<tr>
										<td valign="top">9</td>
										<td valign="top">Date (in words) from which commuted portion shall stand restored (subject to pensioner being alive on that date)</td>
										<td valign="top" colspan="3"><b>On completion of 15 years from the date of payment of commuted value</b></td>
									</tr>
									<tr>
										<td valign="top">10</td>
										<td valign="top">Whether the pensioner/family pensioner is in receipt of any ither pernsion. If so, its particulars and source from which being drawn.</td>
										<td valign="top" colspan="3"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 20px 0 0 0;">
								<b>
									Note :- Recoveries :- 1. Provisional Gratuity of Rs. <?php echo $pensioner->provisional_gratuity; ?>/- has been paid<br />
									<?php echo nbs(40); ?>2. Commutation of pension not paid<br />
									<?php echo nbs(40); ?>3. <?php if($pensioner->provisional_pension=='0'){echo "No Provisional Pension paid";}else{echo $pensioner->provisional_pension;}?>
								</b>
							</td>
						</tr>
						<tr>
								<td colspan="2" style="text-align:right;padding: 80px 190px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo5" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo5')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo5" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table width="100%" cellpadding="3" border="0">
						<tr>
							<td colspan="2" style="padding: 20px 0;"><b><u>Section 3 - Details of family pension payable on the death of the pensioner.</u></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">1. Rules under which family pension is admissable Rule 54 of CCS (P) Rule 1972.</td>
						</tr>
						<tr>
							<td style="padding: 7px;">2. Details of family members eligible for family pension in the event of the death of pensioner.</td>
						</tr>
						<tr>
							<td style="padding: 30px 0;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="8%" valign="top">Sl. No.</td>
										<td width="20%" valign="top">Name</td>
										<td width="11%" valign="top">Marital status in case of children @</td>
										<td width="11%" valign="top">Relationship with the Govt. Servant</td>
										<td width="15%" valign="top">Date of Birth (of all)</td>
										<td width="20%" valign="top">Present address</td>
										<td width="15%" valign="top">Whether child is physically handicapped/mentally retarded</td>
									</tr>
									<?php $nameofspouse=explode(" ",$pensioner->getNameofSpouse());
									       if($nameofspouse[1]="Dr"){
                                            $a=$nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];
                                            //print_r(implode(" ", $a));
                                           // print_r(str_split("hello",3));
                                            
                                                   }else{

                                                   }


                                           //$nameofchild=explode(" ",$pensioner->getNameofChild());
                                           //print_r($nameofspouse[0]);


									?>
									<tr>
										<td valign="top"><b>1.<br />2.<br/>3.<br/>4</b></td>
										<td valign="top"><b><?php if($nameofspouse[1]="Dr"){echo $nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];}?><br><?php echo $pensioner->getNameofChild();?><b></td>
										<td valign="top"><b></b></td>
										<td valign="top"><b>Wife<br><?php echo $pensioner->getRelationofChild();?></b></td>
										<td valign="top"><b><?php echo $pensioner->getDOBofSpouse();?><br><?php echo $pensioner->dobofChild(); ?></b></td>
										<td valign="top"><b><?php echo str_replace(",", ",<br />", $pensioner->address_after_retirement); ?></b></td>
										<td valign="top"><b></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;"><b>Note:-</b>Above particulars may be given in the order of eligibility of the family members @ whether married/unmarried/widow/widower/divorcee.</td>
						</tr>
						<tr>
							<td style="padding: 20px 0;">3. Amount of family pension (Payable in the event of death of the pensioner).</td>
						</tr>
						<tr>
							<td style="padding: 7px;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="25%" valign="top"></td>
										<td width="25%" valign="top">Amount Rs.</td>
										<td width="25%" valign="top">From</td>
										<td width="25%" valign="top">To</td>
									</tr>
									<tr>
										<td valign="top">(i) At Enhanced Rate</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate(false); ?>/-</b></td>
										<td valign="top">The day following the date of the death of the pesioner</td>
										<td valign="top">Till the age of 67 years of the Govt. Servant/7 years had he been survived whichever is earlier.</td>
									</tr>
									<tr>
										<td valign="top">(ii) At Ordinary Rate</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
								</table>
							</td>
						</tr>

						     <tr>
								<td style="text-align:right; padding: 80px 140px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="disburser_ppo6" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('dis_ppo6')"><i class="icon-white icon-print"></i>Print</button>
			<div id="dis_ppo6" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr>
								<td style="vertical-align: top; padding: 50px 0 30px 0;" colspan="4">
									<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 18px;">IMORTANT INSTRUCTIONS<br>(To Appear on inside cover of the PPO booklet)</div>
								    </div>
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									1.	 No pension shall be liable to seizure,attachment of sequestration by process of any court in india in the instance of creditor for any demand against the pensioner(section II,ACT XXIII of 1871)
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									2.	Payment under this order is to be made only pensioner in person,with the following exceptions.
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									a. To persons specially exempted by Government.
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">b. To females unaccustomed to appear in public and to persons unable to appear on account of  illness or bodily infirmity.(payment in both cased (a) and (b) is made on production of life certified signed by a responsible Officer of govt. or other known and trustworthy persion).</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">c. To any person sending a Life Certificate signed by  some person excercising the powers of a Magistrate under the Criminal procedure code or by any Registrar of  or Sub-Registrar appointed under the indian registration act,1908 or by any pensioned officer who,before retriment exercised the powers of Magistrate or any Gazetted officer,or by a Munsiff or by a police officer  not below the rank of sub-inspector in charge of a ploice station or by Post Master,a Departmental Sub-Post  master or an inspector of post officers,or by officer of the reserve bank of india and public sector bank or by head of village panchayat,gaon panchyat or gram panchyat or by the  head of an executive committee of a village or by a bank included in the second schedule to the reserve bank of india act 1934,in respect of person  drawing pension through that bank</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">d. In all cased referred to in clauses (a),(b) & (c) the Disbursing officer must at least once a year require proof independent of that furnished by the life certificate of the continued existence of the pensioner.The pensioner shall not be paid on account of period more  than a year after the date of life certificate last received and the disbursing officer must be on the watch for authentic information  of the decease of any such pensioner and on receipt thereof,shall promptly stop further payments.</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0 40px 0; text-align: justify;" colspan="4" align="left">3. The Quantum of pension available to the old pensioner/family pensioner will be as follows:</td>
							</tr>
							
						<?php
						$dob 	= new DateTime($pensioner->dob);
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" style="border:1px solid#000">
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
							<tr>
								<td colspan="2" style="text-align:right;padding: 80px 140px;">Signature</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>









	<!-- pensioner portion -->
	<div id="disburser_pensioner_portion" style="display: none;">
		<select id="select-pensioner-to-print">
			<option value="0">--Select--</option>
			<option value="pensioner_ppo1" selected>PPO Report 1</option>
			<option value="pensioner_ppo2">PPO Report 2</option>
			<option value="pensioner_ppo3">PPO Report 3</option>
			<option value="pensioner_ppo4">PPO Report 4</option>
			<option value="pensioner_ppo5">PPO Report 5</option>
			<option value="pensioner_ppo6">PPO Report 6</option>
		</select>


        <div id="pensioner_ppo1" style="display:block;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint1')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint1" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							


							<tr>
								<td align="center" style="vertical-align: top; padding: 200px 0 30px 0;" colspan="4">
								<table width="40%" border="1">
								<tr>
									<td>
										<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 24px;">PENSION PAYMENT ORDER<br>PENSIONER'S PORTION</div>
								    </div>
									</td>
								</tr>
								</table>
									

								</td>
							</tr>

						 

							<tr>
								<td colspan="3" style="padding-top:40%" height="600px">
									<table width="100%" border="1" height="300px">
										<tr height="30px;">
											<td><b><h2>1</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">NAME OF THE PENSIONER</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;" width="40%"><?php if($pensionername[0]=="Dr"){echo $pensioner->name;}else{ echo $name;}?></td>
										</tr>
										<tr>
											<td><b><h2>2</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DESIGNATION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->designation; ?></td>
										</tr>
										<tr>
											<td><b><h2>3</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>SERVICE TO WHICH BELONG</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php if(!in_array($pensioner->designation, $apex_designation)) {echo ""; }else{ echo "IFS";}?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>4</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>BATCH</h2></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"></td>
										</tr>
										<tr>
											<td><b><h2>5</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;"><h2>DATE OF RETIREMENT</h2></td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><b><h2><?php echo $pensioner->dor;?></h2></b></td>
										</tr>
										<tr>
											<td><b><h2>6</h2></b></td>
											<td style="font-family: initial; font-weight: bold; font-size: 24px;">DATE OF COMMENCEMENT OF PENSION</td>
											<td style="padding-left:20px; font-family: initial; font-weight: bold; font-size: 24px;"><?php echo $pensioner->effect_of_pension; ?></td>
										</tr>
										
										

									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>





		<div id="pensioner_ppo2" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint2')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint2" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr><td width="25%"></td><td width="25%"></td><td width="25%"></td><td width="25%"></td></tr>
							<tr>
								<td style="vertical-align: top;" colspan="4">
									<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial;">FORM CAM-52<br>(Para 7.3.2)<br><br>PENSION PAYMENT ORDER<br>(PENSIONER'S PORTION)</div>
								    </div>
								</td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;">P.P.O. No.</td>
								<td colspan="2" style="vertical-align: top; padding: 7px;">
									<b><?php echo $ppo_no; ?></b>
								</td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">
									Debitable to Union Government
								</td>
								<td style="vertical-align: top; padding: 20px 0 20px 10px;" colspan="3">Date <u><?php echo nbs(5); ?><?php echo date('d-m-Y'); ?><?php echo nbs(5); ?></u></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4">
									<?php echo nbs(28); ?><u>Head of Account</u>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head</td>		
								<td style="vertical-align: top; padding: 7px;" colspan="2">2071 Pension &amp; ORB </td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(30); ?>Major Head<br /><?php echo nbs(30); ?>Voted/Charged</td>
								<td style="vertical-align: top; padding: 7px;" colspan="2">04 Ordinary Pension (AIS)</td>
							</tr>
							<tr>
								<td height="40px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="left">Sir,</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">
								<?php echo nbs(30); ?>UNTIL FURTHER NOTICE, and on the expiration of every month be pleased to pay <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b> the pension as set out in Part II of this order/Family pension as set out in Para-III of this order* plus the amount of dearness relief as admissible from time to time thereon after due identification of the prisioner/family pension. The payment should commence from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b>. The Income tax, where deductible, should be deducted at source.
								</td>
							</tr>
							<tr>
								<td height="20px;"></td>
							</tr>
						 	<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">2.<?php echo nbs(27); ?>Arrears of pension/family pension at <b>Rs. <?php echo $pensioner->getAmountofPension(); ?>/-(Rupees <?php echo no_to_words($pensioner->getAmountofPension());?>only)</b></b> only per month from <b><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></b> plus the admissible dearness relief thereon may also be paid to <b><?php echo $name." Rtd. ".$pensioner->designation; ?></b></td>
							</tr>
							<tr>
								<td colspan="4">
									<div style="border: 1px solid #000; margin-top: 20px;"></div>
								</td>
							</tr>
					        <tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4" align="justify">[*Inapplicable clause to be deleted]</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 55px 0 10px 0; text-align:center">Signature</td>
							</tr>
							
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 20px 0 10px 0; text-align:center">Designation</td>
							</tr>
							<tr>
								<td colspan="4" style="vertical-align: top; padding: 7px; text-align:center">(Special Seal Of the Pension Payment Order Issuing Authority)</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="4"> To,</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2">
									(1) <b>The Pay &amp; Accounts Officer,</b>
								</td>
								<td style="vertical-align: top; padding: 7px; text-align: center;" colspan="2"><b>Central Pension Accounting Office<br />Trikoot - II Bhikaji Cama Place<br />New Delhi - 110006</b></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 7px;" colspan="2">(2) Name of Paying Branch</td>
								<td style="vertical-align: top; padding: 7px;" colspan="2"><?php echo nbs(20).str_replace(",", ",<br />".nbs(19), $pensioner->bank_name)."<br />".nbs(20)."A/C No. - ".$pensioner->account_no."<br />".nbs(20)."Code No. - ".$pensioner->code_no;?></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2" style="vertical-align: top; padding: 7px; text-align: center;"></td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 20px 0 10px 0;" colspan="3"></td>
								<td style="vertical-align: top; padding: 140px 0 10px 0; text-align:center">Signature</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo3" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint3')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint3" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table width="100%" cellpadding="3" id="report" border="0">
						<tr>
							<td style="vertical-align: top; padding-bottom: 20px;" colspan="2">
								<div>
									Part 1 :- Particulars of service of the pensioner/deceased Government Servant* <br />
									<p style="margin: 0px;text-align: right;">(*strike out whichever is not admissible)</p>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								1.	Name of the Government Servant. <b><?php echo strtoupper($name); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								2.	Post/Grade/Rank last held. <b>Retd. <?php echo $pensioner->designation;?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								3.	Name of the Ministry/Deptt./Office from which he/she retired under the Govt. of India/State.
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<b><?php echo str_replace(",", ",<br />", $pensioner->office_address); ?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								4.	Scale of Pay/Pay Band & Grade Pay at the time of retirement (Mandatory): <b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?></b>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">4(a)	Pay last drawn :- </td>
							<td style="padding: 7px;"><b>Rs. <?php echo array_sum($pensioner->lp); ?>/-</b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">5. Date of Birth :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">6. Date of entry into Governement service :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">7. Date of ending service (Last day of Service) :-</td>
							<td style="padding: 7px;"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">8. Details of weight age in service allowed, if any :-</td>
							<td style="padding: 7px;"><b>NIL</b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">9. Period of service not qualifying for pension :-</td>
							<td style="padding: 7px;"><b>NIL</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 20px 0 30px 0;">
								<table width="100%" border="1">
									<tr>
										<th>From</th>
										<th>To</th>
										<th colspan="3">Period</th>
										<th>Reasons</th>
									</tr>
									<tr>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center">Y</td>
										<td align="center">M</td>
										<td align="center">D</td>
										<td align="center"></td>
									</tr>
									<tr>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
										<td align="center">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">10. Total length of qualifying service<br /><?php echo nbs(7); ?>[Col.(7-6)+8+9]</td>
							<td valign="top" style="padding: 7px;">
								<?php $lists = explode(" ", $pensioner->total_service); ?>
								<ul style="list-style: none;">
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Years</b><br/><?php echo $lists[0]; ?></li>
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Months</b><br/><?php echo $lists[2]; ?></li>
									<li style="display: inline-block;padding: 0 15px;text-align: center;"><b>Days</b><br/><?php echo $lists[4]; ?></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								11.	EMOLUMENTS DRWAN DURING 10 MONTHS PERIOD AND THOSE RECKONED FOR CALCULATION OF EVERAGE EMOLUMENTS.
							</td>

						</tr>
						<tr>
							<td colspan="2" style="padding: 7px 0;">
								<table width="100%" cellpadding="3" cellspacing="3" border="1">
									<tr>
										<td>From</td>
										<td>To</td>
										<td colspan="3">Emoluments drawn</td>
										<td colspan="3">Emoluments reckoned for Average emoluments</td>
										<td>Remarks</td>
									</tr>
									<tr>
										<td width="11%" valign="top"></td>
										<td width="11%" valign="top"></td>
										<td width="11%" valign="top">Pay & Grade Pay</td>
										<td width="11%" valign="top">Other Items with details viz. personal pay Spl. Pay. Deputation Allowance DA etc.</td>
										<td width="11%" valign="top">Total</td>
										<td width="11%" valign="top">Pay & Grade Pay</td>
										<td width="11%" valign="top">Other items reckoned with details</td>
										<td width="11%" valign="top">Total</td>
										<td width="11%" valign="top"></td>
									</tr>
									<tr>
										<td align="center">1</td>
										<td align="center">2</td>
										<td align="center">3</td>
										<td align="center">4</td>
										<td align="center">5</td>
										<td align="center">6</td>
										<td align="center">7</td>
										<td align="center">8</td>
										<td align="center">9</td>
									</tr>
									<tr>
										<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></b></td>
										<td align="center"><b><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></b></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/- (Apex Pay)</b></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->pay_scale_grade.'-'.$pensioner->pay_scale; ?>/- (Apex Pay)</b></td>
										<td align="center"></td>
										<td align="center"><b><?php echo $pensioner->getAverageEmolument(); ?>/-</b></td>

										<td align="center"></td>
									</tr>
								</table>
							</td>
						</tr>
						
						<?php 
						//$ae=($pensioner->pay_info[1]['increament_GP']=='0')?"NIL":$pensioner->getAverageEmolument();?>
						
						<tr>
							<td colspan="2" style="padding: 60px 0;">12. Average Emoluments <b>Rs. <?php echo $pensioner->getAverageEmolument(); ?></b></td>
						</tr>
					 	<tr>
								<td colspan="2" style="text-align:right;padding:0px 140px;">Signature</td>
							</tr>
					 	
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo4" style="display:none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint4')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint4" style="width: 1000px; margin: 0px auto;">
			    <div style="width:1000px; min-height:600px; padding: 0 20px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
					<table width="100%" cellpadding="3" id="report" border="0">
						<tr>
							<td valign="top" width="70%" style="padding: 7px;">13. Emoluments for family pension</td>
							<td valign="top" width="30%"><b>Rs. <?php echo $pensioner->getLastPay(false); ?>/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">14. Emoluments for Retirement Gratuity/Death Gratuity</td>
							<td valign="top"><b>Rs. 80000/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">15. Amount of Retirement Gratuity/Death Gratuity allowed</td>
							<td valign="top"><b>Rs. <?php echo $pensioner->getDCRG(); ?>/-</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">16. Grant of Medical allowance to be paid by Bank</td>
							<td valign="top"><b>Rs. 500/- p.m</b></td>
						</tr>
						<tr>
							<td valign="top" style="padding: 7px;">17. Constable Attendant allowance<br /><?php echo nbs(7); ?>(No Dearness Relief is payable on Sl. NO. 6 & 17)</td>
							<td valign="top"><b>Rs.</b></td>
						</tr>
						<tr>
							<td colspan="2" align="center" style="padding: 7px;">
								<b>Part - II<br />(Applicable on Pensioner)</b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;"><b><u>Section 1 - Particulars of Pensioner</u></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">1. Joint photograph with the spouse</td>
							<td rowspan="3" align="right">
								<div style="width: 135px; height: 125px; border: 1px solid #bababa;">
									&nbsp;
								</div>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;">2. Name of the retiring Govt. Servant :- <b><?php echo strtoupper($name).", ".$pensioner->designation; ?></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">
								3.	Permanent Address :-<br />
									<b><?php echo nbs(5).str_replace(",", ",<br/>".nbs(4), $pensioner->address_after_retirement); ?></b>							
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">4. Personal Marks of identification :- <b>Enclosed</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">5. Signature or the left hand Thumb impression of the pensioner (To be otained at the time of first payment of pension) :- <b>Enclosed</b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;"><b><u>Section 2 - Details of pension.</u></b></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 7px;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="8%" align="center" valign="top">Sl. No.</td>
										<td width="30%" align="center" valign="top"></td>
										<td width="20%" align="center" valign="top">Original pension</td>
										<td width="20%" align="center" valign="top">Revised pension<br />(1)</td>
										<td width="22%" align="center" valign="top">Revised pension<br />(2)</td>
									</tr>
									<tr>
										<td valign="top">1</td>
										<td valign="top">Amount of monthly Pension before commutation</td>
										<td valign="top"><b>Rs.<?php echo $pensioner->getAmountofPension();?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">2</td>
										<td valign="top">Class of Pension</td>
										<td colspan="3" align="center" valign="top"><b><?php echo str_replace("_", " ", $class_of_pension); ?></b></td>
									</tr>
									<tr>
										<td valign="top">3</td>
										<td valign="top">Rules under which sanctioned</td>
										<td valign="top" colspan="3"><b>Rule <?php if($class_of_pension="Voluntary_Retirement_Pension"){echo "48(A)";}elseif($class_of_pension="Superannuation_Pension") {echo "35";}elseif ($class_of_pension=" Normal_Family_Pension") {echo "54";}?> of CCS (P) Rule 1972</b></td>
									</tr>
									<tr>
										<td valign="top">4</td>
										<td valign="top">Date of commencement of pension</td>
										<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->effect_of_pension); ?></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">5</td>
										<td valign="top">Fraction/amount of pension commuted, if any</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getCommutedValue(); ?></b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">6</td>
										<td valign="top">Commuted value and the date of its payment</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getCommutationofPension(); ?></b></td>
										<td valign="top">(Not yet paid)</td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">7</td>
										<td valign="top">Reduced monthly pension after commutation</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getReducePension(); ?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
									<tr>
										<td valign="top">8</td>
										<td valign="top">Date of commencement of reduced pension</td>
										<td valign="top" colspan="3"><b>From the date of payment of commuted value</b></td>
									</tr>
									<tr>
										<td valign="top">9</td>
										<td valign="top">Date (in words) from which commuted portion shall stand restored (subject to pensioner being alive on that date)</td>
										<td valign="top" colspan="3"><b>On completion of 15 years from the date of payment of commuted value</b></td>
									</tr>
									<tr>
										<td valign="top">10</td>
										<td valign="top">Whether the pensioner/family pensioner is in receipt of any ither pernsion. If so, its particulars and source from which being drawn.</td>
										<td valign="top" colspan="3"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 20px 0 0 0;">
								<b>
									Note :-Recoveries :- 1. Provisional Gratuity of Rs. <?php echo $pensioner->provisional_gratuity; ?>/- has been paid<br />
									<?php echo nbs(40); ?>2. Commutation of pension not paid<br />
									<?php echo nbs(40); ?>3. <?php if($pensioner->provisional_pension=='0'){echo "No Provisional Pension paid";}else{echo $pensioner->provisional_pension;}?>
								</b>
							</td>
						</tr>
						<tr>
								<td colspan="2" style="text-align:right;padding: 80px 190px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>

		<div id="pensioner_ppo5" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint5')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint5" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table width="100%" cellpadding="3" border="0">
						<tr>
							<td colspan="2" style="padding: 20px 0;"><b><u>Section 3 - Details of family pension payable on the death of the pensioner.</u></b></td>
						</tr>
						<tr>
							<td style="padding: 7px;">1. Rules under which family pension is admissable Rule 54 of CCS (P) Rule 1972.</td>
						</tr>
						<tr>
							<td style="padding: 7px;">2. Details of family members eligible for family pension in the event of the death of pensioner.</td>
						</tr>
						<tr>
							<td style="padding: 30px 0;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="8%" valign="top">Sl. No.</td>
										<td width="20%" valign="top">Name</td>
										<td width="11%" valign="top">Marital status in case of children @</td>
										<td width="11%" valign="top">Relationship with the Govt. Servant</td>
										<td width="15%" valign="top">Date of Birth (of all)</td>
										<td width="20%" valign="top">Present address</td>
										<td width="15%" valign="top">Whether child is physically handicapped/mentally retarded</td>
									</tr>
									<?php $nameofspouse=explode(" ",$pensioner->getNameofSpouse());
									       if($nameofspouse[1]="Dr"){
                                            $a=$nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];
                                            //print_r(implode(" ", $a));
                                           // print_r(str_split("hello",3));
                                            
                                                   }else{

                                                   }


                                           //$nameofchild=explode(" ",$pensioner->getNameofChild());
                                           //print_r($nameofspouse[0]);


									?>
									<tr>
										<td valign="top"><b>1.<br />2.<br/>3.<br/>4</b></td>
										<td valign="top"><b><?php if($nameofspouse[1]="Dr"){echo $nameofspouse[1].' '.$nameofspouse[2].' '.$nameofspouse[3];}?><br><?php echo $pensioner->getNameofChild();?><b></td>
										<td valign="top"><b></b></td>
										<td valign="top"><b>Wife<br><?php echo $pensioner->getRelationofChild();?></b></td>
										<td valign="top"><b><?php echo $pensioner->getDOBofSpouse();?><br><?php echo $pensioner->dobofChild(); ?></b></td>
										<td valign="top"><b><?php echo str_replace(",", ",<br />", $pensioner->address_after_retirement); ?></b></td>
										<td valign="top"><b></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding: 7px;"><b>Note:-</b>Above particulars may be given in the order of eligibility of the family members @ whether married/unmarried/widow/widower/divorcee.</td>
						</tr>
						<tr>
							<td style="padding: 20px 0;">3. Amount of family pension (Payable in the event of death of the pensioner).</td>
						</tr>
						<tr>
							<td style="padding: 7px;">
								<table width="100%" cellspacing="3" cellpadding="3" border="1">
									<tr>
										<td width="25%" valign="top"></td>
										<td width="25%" valign="top">Amount Rs.</td>
										<td width="25%" valign="top">From</td>
										<td width="25%" valign="top">To</td>
									</tr>
									<tr>
										<td valign="top">(i) At Enhanced Rate</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getEnhanceRate(false); ?>/-</b></td>
										<td valign="top">The day following the date of the death of the pesioner</td>
										<td valign="top">Till the age of 67 years of the Govt. Servant/7 years had he been survived whichever is earlier.</td>
									</tr>
									<tr>
										<td valign="top">(ii) At Ordinary Rate</td>
										<td valign="top"><b>Rs. <?php echo $pensioner->getOrdinaryRate(); ?>/-</b></td>
										<td valign="top"></td>
										<td valign="top"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
								<td style="text-align:right; padding: 80px 140px;">Signature</td>
							</tr>
					</table>
				</div>
			</div>
		</div>


		<div id="pensioner_ppo6" style="display: none;">
			<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('ppoprint6')"><i class="icon-white icon-print"></i>Print</button>
			<div id="ppoprint6" style="width: 1000px; margin: 0px auto;">
				<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 2em">
					<table id="report" border="0" cellpadding="3" width="100%">
						<tbody>
							<tr>
								<td style="vertical-align: top; padding: 50px 0 30px 0;" colspan="4">
									<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
								        <div style="font-family: initial; font-weight: bold; font-size: 18px;">IMORTANT INSTRUCTIONS<br>(To Appear on inside cover of the PPO booklet)</div>
								    </div>
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									1.	 No pension shall be liable to seizure,attachment of sequestration by process of any court in india in the instance of creditor for any demand against the pensioner(section II,ACT XXIII of 1871)
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									2.	Payment under this order is to be made only pensioner in person,with the following exceptions.
								</td>
							</tr>
						  	<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">
									a. To persons specially exempted by Government.
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">b. To females unaccustomed to appear in public and to persons unable to appear on account of  illness or bodily infirmity.(payment in both cased (a) and (b) is made on production of life certified signed by a responsible Officer of govt. or other known and trustworthy persion).</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">c. To any person sending a Life Certificate signed by  some person excercising the powers of a Magistrate under the Criminal procedure code or by any Registrar of  or Sub-Registrar appointed under the indian registration act,1908 or by any pensioned officer who,before retriment exercised the powers of Magistrate or any Gazetted officer,or by a Munsiff or by a police officer  not below the rank of sub-inspector in charge of a ploice station or by Post Master,a Departmental Sub-Post  master or an inspector of post officers,or by officer of the reserve bank of india and public sector bank or by head of village panchayat,gaon panchyat or gram panchyat or by the  head of an executive committee of a village or by a bank included in the second schedule to the reserve bank of india act 1934,in respect of person  drawing pension through that bank</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0; text-align: justify;" colspan="4" align="left">d. In all cased referred to in clauses (a),(b) & (c) the Disbursing officer must at least once a year require proof independent of that furnished by the life certificate of the continued existence of the pensioner.The pensioner shall not be paid on account of period more  than a year after the date of life certificate last received and the disbursing officer must be on the watch for authentic information  of the decease of any such pensioner and on receipt thereof,shall promptly stop further payments.</td>
							</tr>
							<tr>
								<td style="vertical-align: top; padding: 10px 0 40px 0; text-align: justify;" colspan="4" align="left">3. The Quantum of pension available to the old pensioner/family pensioner will be as follows:</td>
							</tr>
							<?php
						$dob 	= new DateTime($pensioner->dob);
						$dob1	= date_format($dob,"Y-m-d");
						$dob->modify('+80 year');
						$year80	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year85	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year90	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year95	= date_format($dob,"Y-m-d");
						$dob->modify('+5 year');
						$year100= date_format($dob,"Y-m-d");
					?>
					<tr>
						<td colspan="4" style="border:1px solid#000">
							1.W.e.f <?php echo $pensioner->dateTimeToDate($year80);?> to <?php echo $pensioner->dateTimeToDate($year85); ?>(80 yrs.) 20% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo  round((20*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?>  <br />
							2.W.e.f <?php $year85plus = new DateTime($year85);
							$year85plus->modify('+1 day');
							$year85plus1 = date_format($year85plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year85plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year90); ?>(85 yrs.) 30% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((30*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							3.W.e.f  <?php $year90plus = new DateTime($year90);
							$year90plus->modify('+1 day');
							$year90plus1 = date_format($year90plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year90plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year95); ?>(90 yrs.) 40% increase on  Rs. <?php echo $pensioner->getAmountofPension();?>= <?php echo round((40*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension();?><br />
							4.W.e.f <?php $year95plus = new DateTime($year95);
							$year95plus->modify('+1 day');
							$year95plus1 = date_format($year95plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year95plus1);
							?> to <?php echo $pensioner->dateTimeToDate($year100);?>(95 yrs.) 50% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((50*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
							5.W.e.f <?php $year100plus = new DateTime($year100);
							$year100plus->modify('+1 day');
							$year100plus1 = date_format($year100plus,"Y-m-d");
							echo $pensioner->dateTimeToDate($year100plus1);?> to (100 yrs.) onwards 100% increase on  Rs. <?php echo $pensioner->getAmountofPension(); ?>= <?php echo round((100*$pensioner->getAmountofPension())/100)+$pensioner->getAmountofPension(); ?><br />
						</td>	
					</tr>
							

							<tr>
								<td colspan="2" style="text-align:right;padding: 80px 140px;">Signature</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>


<?php
$salutation = '';
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

	if($pensioner->dor==$pensioner->dod){
		$amount_pension='N/A';
		}else if($pensioner->dor!="0000-00-00" && $pensioner->dod!="0000-00-00"){
			$amount_pension="<b>Rs.</b>".$pensioner->getAmountofPension()."/-PM".$pensioner->getDRMA();}
	?>

<div id="id_card" style="display: none;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print8')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print8" style="width: 1000px; margin: 0px auto;">
		<!-- <div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em"> -->
       <?php if($class_of_pension=='Liberalised_Pension'){?>
			<table width="100%" cellpadding="3" id="report" border="0"> 
				<tr>
					<td style="font-size:15px;">
					<table width="70%" height="265px" id="report" border="1" style="background-image:url('http://localhost/pension_ui/id_card_logo/idcard_front.jpg');background-repeat:no-repeat;background-size:cover;"> <!--class="table1">-->
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
									Name: <b><?php echo $pensioner->getNameOfLegalHeir();
					?>&nbsp;of<?php echo nbs(1).strtoupper($salutation." ".$pensioner->name);?></b><br/>
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
					<table width="450px" id="report" border="1" style="background-image:url('http://localhost/pension_ui/id_card_logo/idcard_back.jpg');background-repeat:no-repeat;background-size:cover;">
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
							<td><b><?php echo $pensioner->getDOBofSpouse(); ?></b></td>
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

		
		<?php }
			else{
		?>
		
		<table width="100%" cellpadding="3" id="report" border="0"> 
				<tr>
					<td style="font-size:15px;">
					<table width="70%" height="265px" id="report" border="1" style="background-image:url('http://localhost/pension_ui/id_card_logo/idcard_front.jpg');background-repeat:no-repeat;background-size:cover;"> <!--class="table1">-->
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
									Name: <b><?php echo strtoupper($name);//echo strtoupper($salutation." ".$pensioner->name);?></b><br/>
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
					<table width="450px" id="report" border="1" style="background-image:url('http://localhost/pension_ui/id_card_logo/idcard_back.jpg');background-repeat:no-repeat;background-size:cover;">
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
							<td><b><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Post Held</td>
							<td>:</td>
							<td><b>Ex. <?php echo $pensioner->designation; ?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>Date of Retirement</td>
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
							<td><b>Rs. <?php echo $pensioner->getAmountofPension();?>/-</b></td>
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

		
        <?php }?>
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

			<?php if(in_array($pensioner->designation, $apex_designation)) : ?>
				if(val == 'disburser_disburser_portion') {
					hidePPOAll();
					$('#disburser_ppo1').show();
				} else if(val == 'disburser_pensioner_portion') {
					hidePPOAll();
					$('#pensioner_ppo1').show();
				} else {}
			<?php endif; ?>
		});

		$('#select-disburser-to-print, #select-pensioner-to-print').live('change', function(){
			var val = $(this).val();
			if(val!='0') {
				hidePPOAll();
				$('#'+val).show();
			}
		});

		
	});



	function hideAll()
	{
		$('#form1, #form2, #form3, #form4,#form7,#form22, #form39, #form5, #disburser_disburser_portion, #disburser_pensioner_portion, #ppo1, #ppo2, #ppo3, #ppo4, #ppo5').hide();
	}

	function hidePPOAll()
	{
		$('#pensioner_ppo1, #pensioner_ppo2, #pensioner_ppo3, #pensioner_ppo4, #pensioner_ppo5,#pensioner_ppo6, #disburser_ppo1, #disburser_ppo2, #disburser_ppo3, #disburser_ppo4, #disburser_ppo5,#disburser_ppo6').hide();
	}
</script>