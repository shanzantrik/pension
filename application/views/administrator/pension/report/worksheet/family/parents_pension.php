<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php $pensioner = $values; ?>

<?php
$account_no = ($pensioner->account_no != '') ? '('.$pensioner->account_no.')' : '';
$ac 		= ($pensioner->name_of_accountant_general != '') ? $pensioner->sub_to : $pensioner->treasury_name;
$payable 	= $ac.' '.$pensioner->bank_name.' '.$account_no;

$class_of_pension=$pensioner->class_of_pension;
if($class_of_pension=="Voluntary_Retirement_Pension"){
	$class_of_pension="Retiring_Pension";
}
$total_amount=$pensioner->total_amount;
?>
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

		$enhan_upto_seven= new DateTime($pensioner->dod);
		$enhan_from_seven=$enhan_upto_seven->modify('+1 day');
		$enhan_from_seven=$enhan_upto_seven->format('d-m-Y');
		$enhan_upto_seven->modify('+10 year');
		$ordinary_from_seven=$enhan_upto_seven->modify('+1 day');
		$ordinary_from_upto_seven="<b>".$enhan_from_seven."</b><b> to ".$ordinary_from_seven->format('d-m-Y')." until his/her remarriage or death"."</b>";
		$ordinary_from_upto_seven_above25="<b> ".$ordinary_from_seven->format('d-m-Y')." until earns livelihood or gets married"."</b>";
		$ordinary_from_upto_seven_below25="<b> ".$ordinary_from_seven->format('d-m-Y')." until he/she attains 25 years or earns livelihood or gets married"."</b>";
		
		$enhan_upto= new DateTime($pensioner->dod);
		$enhan_upto->modify('-1 day');
		$ordinary_from=$enhan_upto->modify('+2 day');
		$ordinary_from_upto="<b> ".$ordinary_from->format('d-m-Y')." until earn livelihood or death"."</b>";
	endif;
	?>

<div id="print" style="width: 1000px; margin: 0px auto;">
	<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">
	
		<div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	        <u><strong>Working Sheet</strong></u>
	    </div>

	    <div style="padding-top:20px">
	        <div style="float:left; padding-left:20px">
	        	<strong>No. <?php echo $pensioner->case_no; ?></strong>
	        </div>
	      	<div style="float:right;padding-right:20px">
	        	<strong>Date</strong>: <?php echo date('d/m/Y')?>
	        </div>
	  	</div>

		<table width="100%" border="0" cellpadding="2">
			<tr>
				<td valign="top" width="7%"><div align="right">1.</div></td>
				<td valign="top" width="35%"><b>Name of Pensioner</b></td>
				<td valign="top" width="2%">:</td>
				<td valign="top" width="60%"><?php echo $pensioner->salutation." ".$pensioner->name; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">2.</div></td>
				<td valign="top"><b>Date Of Birth</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->dob); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">3.</div></td>
				<td valign="top"><b>Date of Joining</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->doj); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">4.</div></td>
				<td valign="top"><b>Age at Joining</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->age_at_joining(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">5.</div></td>
				<td valign="top"><b>Date of Death</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->dateTimeToDate($pensioner->dor); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">6.</div></td>
				<td valign="top"><b>Age at Death</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->age_at_retirement(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">7.</div></td>
				<td valign="top"><b>Total Service</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->total_service; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><div style="border-bottom: 1px solid #000; font-weight: bold; width: 60%;"><p style="margin: 0px; margin-left: 10px; padding: 0px;">Less</p></div></td>
				<td valign="top"></td>
				<td valign="top"></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>(i) Service before attaining age of 18 years</b></td>
				<td valign="top">:</td>
				<td valign="top">0 year 0 month 0 day</td>
			</tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>(ii) Less non qualifying service</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->non_qualifying_service(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"><span class="style2"><span class="style3"></span></span></div></td>
				<td valign="top"><span class="style3"><b>(iii) Add Weightage</b></span></td>
			  <td valign="top"><span class="style3">:</span></td>
			  <td valign="top"><span class="style3"><?php echo $pensioner->Weightage(); ?></span></td>
		  </tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>Net qualifying Service</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->net_qualifying_service(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">8.</div></td>
				<td valign="top"><b>Six monthly period</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo 'N/A';//$pensioner->smp; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">9.</div></td>
				<td valign="top"><b>Service Verification</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo ($pensioner->service_verification==0) ? "Not Verified" : 'Verified'; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">10.</div></td>
				<td valign="top"><b>Regularization of Adhoc Service</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->probation_period; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">11.</div></td>
				<td valign="top"><b>Leave Account(No of Days):</b></td>
				<td valign="top"></td>
				<td valign="top"></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>(a) Earn leave</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->earn_leave; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"><b></b></div></td>
				<td valign="top"><b>(b) Half pay leave</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->half_leave; ?></td>
			</tr>
			<!-- <tr style="height:40px;"> -->
			<tr>
				<td valign="top"><div align="right">12.</div></td>
				<td valign="top"><b>Last Pay (as per LPC)</b></td>
				<td valign="top">:</td>
				<td valign="top" colspan="3">
					<?php 
					//echo $pensioner->getLastPay(); 
                    if($pensioner->pay_commission==7)
                    { echo $total_amount;} 
                    else
                    {echo $pensioner->getLastPay(false);} 
					?>/-
				</td>
			</tr>
			<!-- <tr style="height:50px;"> -->
			<tr>
				<td valign="top"><div align="right">13.</div></td>
				<td valign="top"><b>Last Incremented Pay</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php echo $pensioner->getLastIncreamentPay(); ?>
				</td>
			</tr>
			<tr>
				<td valign="top"><div align="right">14.</div></td>
				<td valign="top"><b>Average Emoluments</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getAverageEmolument(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">15.</div></td>
				<td valign="top"><b>Amount of Pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 

		     echo 'N/A';//$pensioner->getAmountofPension(); 

		    ?>
					
				</td>
			</tr>

			<tr>
				<td valign="top"><div align="right">16.</div></td>
				<td valign="top"><b>Amount of  Death Gratuity</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 

		     echo $pensioner->getDCRG(); 
			 
		    ?>
					
				</td>
			</tr>
			
							
				</td>
			</tr>
			<tr>
				<td valign="top"><div align="right">17.</div></td>
				<td valign="top"><b>DA</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				
				echo $pensioner->da_percentage();
				
				?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">18.</div></td>
				<td valign="top"><b>Family Pension:</b></td>
				<td valign="top"></td>
				<td valign="top"></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>(a) Enhanced Rate</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				
				echo 'N/A';//$pensioner->getEnhanceRate();
			  					?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"><b></b></div></td>
				<td valign="top"><b>(b) Ordinary Rate</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				
				//echo $pensioner->getOrdinaryRate();  
				/*$date = new DateTime($pensioner->childDOB);
					$now = new DateTime();
					$age = new DateTime();
					$age = $date->diff($now)->format("%y");
					$currentYear=$now->format("Y");*/
							
					/*$Entrydate = new DateTime($pensioner->doj);
					$EntryYear = $Entrydate->format("Y");
					if($EntryYear>='2008')
					{ echo 'N/A';
					}
					elseif($EntryYear<'2008')*/
					//{
						
					//if($age==$currentYear || $age==0)
					//{
						echo $pensioner->getOrdinaryRate();
							
						?> <b>from</b> <?php 
						
						/*if($pensioner->pay_commission==7)
						{ echo $ordinary_from_upto_seven;} 
						else
						{echo $ordinary_from_upto;
						}*/
						echo $ordinary_from_upto;
					//}
					
					//}
			 ?>
					
				</td>
			</tr>

			
			
		    <tr>
				<td valign="top"><div align="right">19.</div></td>
				<td valign="top"><b>Commuted Value</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				//echo $pensioner->getCommutedValue();
               echo $pensioner->getCommutationOfPension();
				?></td>
			</tr>
			
			<tr>
				<td valign="top"><div align="right">20.</div></td>
				<td valign="top"><b>Place of Payment (under which Treasury/Bank)</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $payable; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">21.</div></td>
				<td valign="top"><b>Address after Retirement</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->address_after_retirement; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">22.</div></td>
				<td valign="top"><b>Class of Pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo str_replace("_", " ", $pensioner->class_of_pension).' ('.$pensioner->pensionRule().')'; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">23.</div></td>
				<td valign="top"><b>Name of Legal Heir</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getNameOfLegalHeir(); ?></td>
			</tr>
			<tr style="height:50px;">
				<td valign="top"><div align="right">24.</div></td>
				<td valign="top"><b>Document</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getSubmittedDocument('doc_name'); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">25.</div></td>
				<td valign="top"><b>Provisional Gratuity Status</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->provisional_gratuity; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">26.</div></td>
				<td valign="top"><b>Provisional Pension Status</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->provisional_pension; ?></td>
			</tr>
		    
		    <tr>
				<td valign="top"><div align="right">27.</div></td>
				<td valign="top"><b>Earned Leave Encashment</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getEarnMoney(); ?></td>
			</tr>
		    <tr>
				<td valign="top"><div align="right">28.</div></td>
				<td valign="top"><b>Half Leave Encashment</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getHalfMoney(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">29.</div></td>
				<td valign="top"><b>Total Leave Encashment</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getTotalLeaveEncashment(); ?></td>
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