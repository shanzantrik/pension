<style type="text/css">
<!--
.style1 {
	font-size: 14px;
}
.style2 {font-size: 14px}
.style3 {font-size: 14px; }
-->
</style>
<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button> 

<button style="float:right;" class="btn btn-warning" id='btt'>Show Label</button> 
<?php $pensioner = $values; ?>

<?php
	$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
	$ac 		= ($pensioner->name_of_accountant_general != '') ? $pensioner->sub_to : $pensioner->treasury_name;
	$payable 	= $ac.' '.$pensioner->bank_name.' '.$account_no;
	$total_amount=$pensioner->total_amount;
?>

<div id="print" style="width: 1000px; margin: 0px auto;">
	<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 2em">
	    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	        <u><strong>Working Sheet</strong></u><br/>
	        	
	       <div class="style1" id='lblx' name='lblx'> Revised calculation sheet of pension/family pension of post 01-01-2016 pensioner's/family pensioners on recommendation of the 7th CPC in terms of OM No. DAP/PEN/27/2016, Dated. 16-01-2017 </div>
      </div>
<div style="padding-top:20px">
	        <div style="float:left; padding-left:20px">
	        	<strong>No. <?php echo $pensioner->case_file_no;?> </strong>
	        </div>
	      	<div style="float:right;padding-right:20px">
	        	<strong>Date</strong>: <?php echo date('d/m/Y')?>
	        </div>
	  	</div>

		<table width="100%" border="0" cellpadding="2" id="report">
			<tr>
				<td valign="top" width="7%"><div align="right" class="style3">1.</div></td>
			  <td valign="top" width="35%"><span class="style3"><b>Name of Pensioner</b></span></td>
			  <td valign="top" width="2%"><span class="style3">:</span></td>
			  <td valign="top" width="60%"><span class="style3"><?php echo $pensioner->salutation." ".$pensioner->name.'('.$pensioner->designation.')'; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">2.</div></td>
			  <td valign="top"><span class="style3"><b>Date Of Birth</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">3.</div></td>
			  <td valign="top"><span class="style3"><b>Date of Joining</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">4.</div></td>
			  <td valign="top"><span class="style3"><b>Age at Joining</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->age_at_joining(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">5.</div></td>
			  <td valign="top"><span class="style3"><b>Date of Retirement</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $dorx=$pensioner->dateTimeToDate($pensioner->dor); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">6.</div></td>
			  <td valign="top"><span class="style3"><b>Age at retirement</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->age_at_retirement(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">7.</div></td>
			  <td valign="top"><span class="style3"><b>Total Service</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->total_service; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><div class="style3" style="border-bottom: 1px solid #000; font-weight: bold; width: 60%;"><p style="margin: 0px; margin-left: 10px; padding: 0px;">Less</p></div></td>
			  <td valign="top"></td>
			  <td valign="top"></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(i) Service before attaining age of 18 years</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">0 year 0 month 0 day</span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(ii) Less non qualifying service</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->non_qualifying_service(); ?></span></td>
		  </tr>
		  <tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(iii) Add Weightage</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->Weightage(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>Net qualifying Service</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->net_qualifying_service(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">8.</div></td>
			  <td valign="top"><span class="style3"><b>Six monthly period</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->smp; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">9.</div></td>
			  <td valign="top"><span class="style3"><b>Service Verification</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo ($pensioner->service_verification==0) ? "Not Verified" : 'Verified'; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">10.</div></td>
			  <td valign="top"><span class="style3"><b>Regularization of Adhoc Service</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->probation_period; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">11.</div></td>
			  <td valign="top"><span class="style3"><b>Leave Account(No of Days):</b></span></td>
			  <td valign="top"></td>
			  <td valign="top"></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(a) Earn leave</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->earn_leave; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><b><span class="style2"><span class="style3"></span></span></b></div></td>
				<td valign="top"><span class="style3"><b>(b) Half pay leave</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->half_leave; ?></span></td>
		  </tr>
			<!-- <tr style="height:40px;"> -->
			<tr>
				<td valign="top"><div align="right" class="style3">12.</div></td>
			  <td valign="top"><span class="style3"><b>Last Pay (as per LPC)</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
<td valign="top" colspan="3">
					<span class="style3">
					<?php if($pensioner->pay_commission==7){ echo $total_amount;} else{ echo $pensioner->getLastPay();} ?>
				</span>				</td>
		  </tr>
			<!-- <tr style="height:50px;"> -->
			<tr>
				<td valign="top"><div align="right" class="style3">13.</div></td>
			  <td valign="top"><span class="style3"><b>Last Incremented Pay</span></td>
			  <td valign="top"><span class="style3">:</span></td>
<td valign="top">
					<span class="style3"><?php echo $pensioner->getLastIncreamentPay(); ?></span>				</td>
		  </tr>
<?php 
 $dr=strtotime($dorx);
 $cd=strtotime('2016-01-01');

 			if($dr>=$cd){?>
 				<tr>
				<td valign="top"><div align="right" class="style3">14.</div></td>
				<td valign="top"><span class="style3"><b>Average Emoluments</b></span></td>
				<td valign="top"><span class="style3">:</span></td>
				<td valign="top"><span class="style3"><?php 
				echo $pensioner->getAverageEmolumentNew();
				//echo $pensioner->getAverageEmolument(); 
				?></span></td>
		  </tr>
			<?php }?>
			<tr>
				<td valign="top"><div align="right" class="style3">15.</div></td>
			  <td valign="top"><span class="style3"><b>Amount of Pension</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
				
				echo $pensioner->getAmountofPension();
				
			?>
			  </span></td>
		  </tr>
			
<tr>
				<td valign="top"><div align="right" class="style3">16.</div></td>
		<td valign="top"><span class="style3"><b>Retirement Gratuity</b></span></td>
		<td valign="top"><span class="style3">:</span></td>
		<td valign="top"><span class="style3">
		  <?php 
					echo $pensioner->getDCRG();?>
		</span></td>
		  </tr><?php  if($pensioner->pay_commission==6) {?>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>Gratuity authorised vide 6th pay commission</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
				echo $pensioner->getDCRGSIX();
								?>
			  </span></td>
		  </tr>
			<?php } if($pensioner->pay_commission==7) {?>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>Revised Gratuity Admissable:</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><div class="style3" id='dcrgx'><?php 
				echo ($pensioner->getDCRG())-($pensioner->provisional_gratuity);
								?></div></td>
		  </tr>
			<?php }?>
			<tr>
				<td valign="top"><div align="right" class="style3">17.</div></td>
			  <td valign="top"><span class="style3"><b>DA</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
				echo $pensioner->da_percentage();
								?>
			  </span></td>
		  </tr>

			<tr>
				<td valign="top"><div align="right" class="style3">18.</div></td>
			  <td valign="top"><span class="style3"><b>Family Pension:</b></span></td>
			  <td valign="top"></td>
			  <td valign="top"></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(a) Enhanced Rate</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
					echo $pensioner->getEnhanceRate(); 
				?>
			  </span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"><b><span class="style2"><span class="style3"></span></span></b></div></td>
				<td valign="top"><span class="style3"><b>(b) Ordinary Rate</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
				echo $pensioner->getOrdinaryRate(); 
				?>
			  </span></td>
		  </tr>
		    <tr>
				<td valign="top"><div align="right" class="style3">19.</div></td>
			  <td valign="top"><span class="style3"><b>Commuted Value</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->getCommutedValue();?></span></td>
		  </tr>

			

			<tr>
				<td valign="top"><div align="right" class="style3">20.</div></td>
			  <td valign="top"><span class="style3"><b>Commutation of Pension</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3">
		      <?php 
				echo $pensioner->getCommutationofPension();
				?>
			  </span></td>
		  </tr>

<tr>
				<td valign="top"><div align="right" class="style3">21.</div></td>
		<td valign="top"><span class="style3"><b>Reduced pension</b></span></td>
		<td valign="top"><span class="style3">:</span></td>
		<td valign="top"><span class="style3">
		  <?php 
				echo $pensioner->getReducePension();
				?>
		</span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">22.</div></td>
			  <td valign="top"><span class="style3"><b>Place of Payment (under which Treasury/Bank)</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $payable; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">23.</div></td>
			  <td valign="top"><span class="style3"><b>Address after Retirement</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->address_after_retirement; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">24.</div></td>
			  <td valign="top"><span class="style3"><b>Class of Pension</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo str_replace("_", " ", $pensioner->class_of_pension).' ('.$pensioner->pensionRule().')'; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">25.</div></td>
			  <td valign="top"><span class="style3"><b>Name of Legal Heir</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php 
			  if($pensioner->WifeDODCondition()>'0')
			  {echo 'N/A';}
			  else
			  {echo $pensioner->getNameOfLegalHeir(); }
		 
			  ?></span></td>
		  </tr>
			<tr style="height:50px;">
				<td valign="top"><div align="right" class="style3">26.</div></td>
			  <td valign="top"><span class="style3"><b>Document</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->getSubmittedDocument('doc_name'); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">27.</div></td>
			  <td valign="top"><span class="style3"><b>Provisional Gratuity Status</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->provisional_gratuity; ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">28.</div></td>
			  <td valign="top"><span class="style3"><b>Provisional Pension Status</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->provisional_pension; ?></span></td>
		  </tr>
		   
		    <tr>
				<td valign="top"><div align="right" class="style3">29.</div></td>
			  <td valign="top"><span class="style3"><b>Earned Leave Encashment</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->getEarnMoney(); ?></span></td>
		  </tr>
		    <tr>
				<td valign="top"><div align="right" class="style3">30.</div></td>
			  <td valign="top"><span class="style3"><b>Half Leave Encashment</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->getHalfMoney(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right" class="style3">31.</div></td>
			  <td valign="top"><span class="style3"><b>Total Leave Encashment</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->getTotalLeaveEncashment(); ?></span></td>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("#lblx").hide();
        $("#dcrgx").hide();

        });

        $("#btt").click(function(){
$("#lblx").show();
$("#dcrgx").show();
        });


    </script>