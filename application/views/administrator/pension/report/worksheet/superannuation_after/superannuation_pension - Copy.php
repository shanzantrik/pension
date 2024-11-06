<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
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
	        Revised calculation sheet of pension/family pension of post 01-01-2016 pensioner's/family pensioners on recommendation of the 7th CPC in terms of OM No. DAP/PEN/27/2016,<br/>
	        Dtd. 16-01-2017
	    </div>
	    <div style="padding-top:20px">
	        <div style="float:left; padding-left:20px">
	        	<strong>No. <?php echo $pensioner->case_file_no; ?></strong>
	        </div>
	      	<div style="float:right;padding-right:20px">
	        	<strong>Date</strong>: <?php echo date('d/m/Y')?>
	        </div>
	  	</div>

		<table width="100%" border="0" cellpadding="2" id="report">
			<tr>
				<td valign="top" width="7%"><div align="right">1.</div></td>
				<td valign="top" width="35%"><b>Name of Pensioner</b></td>
				<td valign="top" width="2%">:</td>
				<td valign="top" width="60%"><?php echo $pensioner->salutation." ".$pensioner->name.'('.$pensioner->designation.')'; ?></td>
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
				<td valign="top"><b>Date of Retirement</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $dorx=$pensioner->dateTimeToDate($pensioner->dor); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">6.</div></td>
				<td valign="top"><b>Age at retirement</b></td>
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
				<td valign="top"><div align="right"></div></td>
				<td valign="top"><b>Net qualifying Service</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->net_qualifying_service(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">8.</div></td>
				<td valign="top"><b>Six monthly period</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->smp; ?></td>
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
					<?php if($pensioner->pay_commission==7){ echo $total_amount;} else{echo $pensioner->getLastPay();} ?>
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
<?php 
 $dr=strtotime($dorx);
 $cd=strtotime('2016-01-01');

 			if($dr>=$cd){?>
 				<tr>
				<td valign="top"><div align="right">14.</div></td>
				<td valign="top"><b>Average Emoluments</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getAverageEmolument(); 
				?></td>
			</tr>
			<?php }?>
			<tr>
				<td valign="top"><div align="right">15.</div></td>
				<td valign="top"><b>Amount of Pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				
				echo $pensioner->getAmountofPension();
				
			?></td>
			</tr>
			<?php
				$bina=substr($pensioner->total_service,0,2);
				//echo $bina;
				$binb=$pensioner->total_amount;
				$biny=substr($pensioner->total_service,9,1);
				$binx=$pensioner->smp;
				$fourdaamount=($binb)+($binb*4/100);
				$anotheramount=$fourdaamount*(0.25)*($pensioner->smp);
				
				if($bina > 33 && $pensioner->dor < '2017-06-30')
				{
					//$binc=$anotheramount;
				 	$binc=round(($binb)*(1/4)*(33*2));
					//$binc=1;
				}
				else if($bina < 33 && $biny < 9 && $pensioner->dor > '2016-06-31')
				{
					//$binc=($binb)*(1/4)*($bina*2)+1;
					//$dacal=($binb)*(2/100);
					$binc=($binb*2/100+$binb)*(1/4)*($bina*2);
					//$binc=$binb;
				}
				else if($pensioner->dor < '2016-06-31')
				{
					//$binc=($binb)*(1/4)*($bina*2);
					$binc=($binb)*(1/4)*($pensioner->smp);
				}
				else if($pensioner->dor > '2016-07-01')
				{
					$binc=($binb*2/100+$binb)*(1/4)*($bina*2);
					
				}
				else
				{
					//$binc=($binb)*(1/4)*($bina*2)+2;
					//$binc=0;
					$binc=($binb*2/100+$binb)*(1/4)*($binx);
				}
				?>
			<tr>
				<td valign="top"><div align="right">16.</div></td>
				<td valign="top"><b>Retirement Gratuity</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				if($pensioner->pay_commission==7)
					{ echo $binc;
					} 
				else
					{echo $pensioner->getDCRG();
					} 

				// if($pensioner->pay_commission==7)
				// 		{ echo $binc2; } 
				// else
				// 		{ echo $pensioner->getDCRG();} 
				?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">17.</div></td>
				<td valign="top"><b>DA</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				if($pensioner->pay_commission==7 && $pensioner->dor < '2016-06-30')
					{ echo 0;} 
				elseif($pensioner->pay_commission==7 && $pensioner->dor < '2016-12-31')
					{ echo 2;}
				elseif($pensioner->pay_commission==7 && $pensioner->dor < '2017-06-30')
					{ echo 4;} 
				
				elseif($pensioner->pay_commission==6)
					{echo 125;}
				// else
				// 	{echo 2;}
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
				if($pensioner->pay_commission==7)
					{ echo (round($total_amount*50/100));
					} 
				else
					{echo $pensioner->getEnhanceRate();} 
				?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right"><b></b></div></td>
				<td valign="top"><b>(b) Ordinary Rate</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				if($pensioner->pay_commission==7)
					{ echo (round(($total_amount*50/100)-($total_amount*50/100*40/100)));
					} 
				else
					{echo $pensioner->getOrdinaryRate();} 
				?></td>
			</tr>
		    <tr>
				<td valign="top"><div align="right">19.</div></td>
				<td valign="top"><b>Commuted Value</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php if($pensioner->pay_commission==7){echo ($total_amount)*50/100*40/100;  } else{echo $pensioner->getCommutedValue();}?></td>
			</tr>

			<?php
				$age_retire=$pensioner->age_retire+1;
				//echo $age_retire;
				$result = mysql_query("SELECT distinct comm_value FROM master_comm_value_tb where Age_Next_Birth='".$age_retire."' LIMIT 1");
				while($row = mysql_fetch_array($result))
				{
				$vivo=$row['comm_value'];
				$bigbazar=round(($total_amount)*50/100*0.4*$vivo*12);
				$visal=($total_amount)*50/100*40/100;
				$sohum=($total_amount)*50/100;
			?>

			<tr>
				<td valign="top"><div align="right">20.</div></td>
				<td valign="top"><b>Commutation of Pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				if($pensioner->pay_commission==7 && $pensioner->com_applied == 0)
					{echo 'N/A';}
				else if($pensioner->pay_commission==7 && $pensioner->com_applied == 1)
					{ echo $bigbazar;
					} 
				else
					{echo $pensioner->getCommutationofPension();
					} 
				?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td valign="top"><div align="right">21.</div></td>
				<td valign="top"><b>Reduced pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php 
				
				if($pensioner->pay_commission==7)
					{ echo (round(($total_amount*50/100)-($total_amount*50/100*40/100)));
						
					} 
				else
					{echo $pensioner->getReducePension();} 
				?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">22.</div></td>
				<td valign="top"><b>Place of Payment (under which Treasury/Bank)</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $payable; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">23.</div></td>
				<td valign="top"><b>Address after Retirement</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->address_after_retirement; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">24.</div></td>
				<td valign="top"><b>Class of Pension</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo str_replace("_", " ", $pensioner->class_of_pension).' ('.$pensioner->pensionRule().')'; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">25.</div></td>
				<td valign="top"><b>Name of Legal Heir</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getNameOfLegalHeir(); ?></td>
			</tr>
			<tr style="height:50px;">
				<td valign="top"><div align="right">26.</div></td>
				<td valign="top"><b>Document</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getSubmittedDocument('doc_name'); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">27.</div></td>
				<td valign="top"><b>Provisional Gratuity Status</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->provisional_gratuity; ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">28.</div></td>
				<td valign="top"><b>Provisional Pension Status</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->provisional_pension; ?></td>
			</tr>
		    
		    <tr>
				<td valign="top"><div align="right">29.</div></td>
				<td valign="top"><b>Earned Leave Encashment</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getEarnMoney(); ?></td>
			</tr>
		    <tr>
				<td valign="top"><div align="right">30.</div></td>
				<td valign="top"><b>Half Leave Encashment</b></td>
				<td valign="top">:</td>
				<td valign="top"><?php echo $pensioner->getHalfMoney(); ?></td>
			</tr>
			<tr>
				<td valign="top"><div align="right">31.</div></td>
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