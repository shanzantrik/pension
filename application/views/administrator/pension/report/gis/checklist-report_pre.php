<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Checklist Form</title>
</head>
<body>

<select id="select-form-to-print">
	<option value="0">--Select--</option>
	<option value="form1">Page1</option>
	<option value="form2">Page2</option>
</select>


<?php
	$val=$values[0];
	$claiment=$val['claiment'];
	$claiment_name=$val['claiment_name'];
	$claiment_relation=$val['claiment_relation'];

	$pom_group_d_from=$val['pom_group_d_from'];
	$pom_group_d_to=$val['pom_group_d_to'];
	$pom_group_d_years=$val['pom_group_d_years'];
	$group_d_amt_1sthalf=$val['group_d_amt_1sthalf'];
	$group_d_amt_2ndhalf=$val['group_d_amt_2ndhalf'];



	$pom_group_c_from=$val['pom_group_c_from'];
	$pom_group_c_to=$val['pom_group_c_to'];
	$pom_group_c_years=$val['pom_group_c_years'];
	$group_c_amt_1sthalf=$val['group_c_amt_1sthalf'];
	$group_c_amt_2ndhalf=$val['group_c_amt_2ndhalf'];

	$pom_group_b_from=$val['pom_group_b_from'];
	$pom_group_b_to=$val['pom_group_b_to'];
	$pom_group_b_years=$val['pom_group_b_years'];
	$group_b_amt_1sthalf=$val['group_b_amt_1sthalf'];
	$group_b_amt_2ndhalf=$val['group_b_amt_2ndhalf'];

	$pom_group_a_from=$val['pom_group_a_from'];
	$pom_group_a_to=$val['pom_group_a_to'];
	$pom_group_a_years=$val['pom_group_a_years'];
	$group_a_amt_1sthalf=$val['group_a_amt_1sthalf'];
	$group_a_amt_2ndhalf=$val['group_a_amt_2ndhalf'];

	$form_9=$val['form_9'];
	$form_13=$val['form_13'];

	$savings_fund=$val['savings_fund'];
	$insurance_fund=$val['insurance_fund'];

	$bill_signed_by_claiment=$val['bill_signed_by_claiment'];

	$bill_signed_by_HoO=$val['bill_signed_by_HoO'];

	$savings_amt=$val['savings_amt'];
	$insurance_amt=$val['insurance_amt'];
	$claim_status=$val['claim_status'];


	$cal_sav_amt_group_d_from=$val['cal_sav_amt_group_d_from'];
	$cal_sav_amt_group_d_to=$val['cal_sav_amt_group_d_to'];

	$cal_sav_amt_group_c_from=$val['cal_sav_amt_group_c_from'];
	$cal_sav_amt_group_c_to=$val['cal_sav_amt_group_c_to'];

	$cal_sav_amt_group_b_from=$val['cal_sav_amt_group_b_from'];
	$cal_sav_amt_group_b_to=$val['cal_sav_amt_group_b_to'];

	$cal_sav_amt_group_a_from=$val['cal_sav_amt_group_a_from'];
	$cal_sav_amt_group_a_to=$val['cal_sav_amt_group_a_to'];

	$final_insurance_amt=$val['final_insurance_amt'];


	$dom_group_unserel = unserialize($val['dom_group']);
	$dom_group = ( is_array($dom_group_unserel) ) ? implode(", ", $dom_group_unserel) : $dom_group_unserel;
	$dom_group = ($dom_group != '') ? '(Group Status '.$dom_group.')' : '';

	$doc_group_unserel = unserialize($val['doc_group']);
	$doc_group = ( is_array($doc_group_unserel) ) ? implode(", ", $doc_group_unserel) : $doc_group_unserel;
	$doc_group = ($doc_group != '') ? '(Group Status '.$doc_group.')' : '';
?>

	<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.1em; padding: 0 20px;">

		    <div style="text-align:center; padding:10px 0 20px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
		        <div style="font-weight: bold; text-align: center; line-height: 1.3em; margin-top: 20px;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>

			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="3%">&nbsp;</td>
					<td width="35%">&nbsp;</td>
					<td width="5%">&nbsp;</td>
					<td width="28%">&nbsp;</td>
					<td width="27%">&nbsp;</td>
				</tr>
	     		<tr>
		    		<td valign="top" colspan="5"><div align="right"><strong>Docket No</strong>: <?php echo nbs(30); ?></div></td>
				</tr>
				<tr>
				  	<td valign="top" colspan="5"><div align="left"><em><strong><u>Scrutiny sheet benefit under UTGEGIS (Please give page ref. Of S/Book against item No. 1,3,5,6,7,8.) </u></strong></em></div></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>1.</strong></td>
					<td><div align="left"><strong>Name of employee</strong></div></td>
					<td>:- </td>
					<td colspan="2"><b><?php echo $val['salutation']?><?php echo nbs(2);?><?php echo $val['pensionee_name']?></b></td>
				</tr>
				<tr>
					<td valign="top"><strong>2.</strong></td>
					<td valign="top"><div align="left"><strong>Name of the claimant & his/her relationship with the employee (in case of Death of Govt. Servant)</strong></div></td>
					<td valign="top">:- </td>
					<td valign="top" colspan="2"><b>
						<?php if($claiment=="self") { ?>
		                	Self
						<?php } else {
					    	echo $claiment_name ."(" . $claiment_relation . ")";
						}
						?>
					</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 15px 0;"><strong>3.</strong></td>
					<td valign="top" style="padding: 15px 0;"><div align="left"><strong>Date of entry into service and designation</strong></div></td>
					<td valign="top" style="padding: 15px 0;">:- </td>
					<td valign="top" colspan="2" style="padding: 15px 0;"><b><?php echo $val['doj']?>(<?php echo $val['designation']?>)</b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>4.</strong></td>
					<td valign="top" style="padding: 10px 0;"><div align="left"><strong>Office  in which last served</strong></div></td>
					<td valign="top" style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><b><?php echo $val['office_address']?></b></td>
				</tr>
			    <tr>
			    	<td valign="top" style="padding: 10px 0;"><strong>5.</strong></td>
					<td valign="top" style="padding: 10px 0;"><div align="left"><strong>Date of death/ retirement/ resignation/ absorption to Autonomous Body/PSUs from service & designation</strong></div></td>
					<td valign="top" style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><b><?php echo $val['dor']?></b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>6.</strong></td>
					<td valign="top" style="padding: 10px 0;"><div align="left"><strong>Date of settlement of Pension (Signing date of PPO)</strong></div></td>
					<td valign="top" style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><b><?php echo $val['date_of_settlement']?></b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>7.</strong></td>
					<td valign="top" style="padding: 10px 0;"><div align="left"><strong>Date of membership in the Scheme & Group status</strong></div></td>
					<td valign="top" style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><b><?php echo $val['date_of_membership']?> <?php echo $dom_group; ?></b></td>
				</tr>			
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>8.</strong></td>
					<td valign="top" style="padding: 10px 0;"><div align="left"><strong>Date of cessation from membership & Group status</strong></div></td>
					<td valign="top" style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><b><?php echo $val['date_of_cessation']?> <?php echo $doc_group; ?></b></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>9.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>Group-wise period of membership and rate of subscription:-</strong></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>(a)Group “D” from  rate of subscription<b><?php if(!$pom_group_d_from=="0"){ echo " ".$pom_group_d_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$pom_group_d_to=="0"){echo " ".$pom_group_d_to."  ";} else {echo "-------------------";}?></b>=<b><?php if(!$pom_group_d_years=="0"){ echo " ".$pom_group_d_years."  ";} else{echo "0 ";}?></b>@ Rs <?php echo $group_d_amt_1sthalf."-- Rs ". $group_d_amt_2ndhalf ?></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>(b)Group “C” from  rate of subscription<b><?php if(!$pom_group_c_from=="0"){ echo " ".$pom_group_c_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$pom_group_c_to=="0"){echo " ".$pom_group_c_to."  ";} else {echo "-------------------";}?></b>=<b><?php if(!$pom_group_c_years=="0"){ echo " ".$pom_group_c_years."  ";} else{echo "0 ";}?></b>@ Rs <?php echo $group_c_amt_1sthalf."-- Rs ". $group_c_amt_2ndhalf ?></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>(c)Group “B” from  rate of subscription<b><?php if(!$pom_group_b_from=="0"){ echo " ".$pom_group_b_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$pom_group_b_to=="0"){echo " ".$pom_group_b_to."  ";} else {echo "-------------------";}?></b>=<b><?php if(!$pom_group_b_years=="0"){ echo " ".$pom_group_b_years."  ";} else{echo "0 ";}?></b>@ Rs <?php echo $group_b_amt_1sthalf."-- Rs ". $group_b_amt_2ndhalf ?></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>(d)Group “A” from  rate of subscription<b><?php if(!$pom_group_a_from=="0"){ echo " ".$pom_group_a_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$pom_group_a_to=="0"){echo " ".$pom_group_a_to."  ";} else {echo "-------------------";}?></b>=<b><?php if(!$pom_group_a_years=="0"){ echo " ".$pom_group_a_years."  ";} else{echo "0 ";}?></b>@ Rs <?php echo $group_a_amt_1sthalf."-- Rs ". $group_a_amt_2ndhalf ?></div></td>
	            </tr>                                    
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>10.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>Status of Forms (tick the form furnished) </strong></div></td>
				</tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong><?php echo nbs(10); ?>(i)<?php echo $val['form_status']?></strong></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(10); ?><strong>(ii)Information in Form-9 <?php if($form_9=="0"){?> <img src="<?php echo base_url()?>includes/img/uploadify-cancel.png" alt=""> <?php }else{ ?><img src="<?php echo base_url()?>includes/img/ok.png" alt=""><?php }?>  </strong></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(10); ?><strong>(iii)Information in Form-13 <?php if($form_13=="0"){?> <img src="<?php echo base_url()?>includes/img/uploadify-cancel.png" alt=""> <?php }else{ ?><img src="<?php echo base_url()?>includes/img/ok.png" alt=""><?php }?></strong></div></td>
	            </tr>                                    
				<tr>
					<td><strong>11.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Whether Pre-receipted Bill/ Bills received for </strong></div></td>
				</tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(10); ?><strong>(a)	Savings fund –<?php if($savings_fund=="1"){?>YES<?php } else{?>No<?php }?></strong></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(10); ?><strong>(b)	Insurance fund (in case of deceased employee)- <?php if($insurance_fund=="1"){?>YES<?php } else{?>N/A<?php }?></strong></div></td>
	            </tr>        

				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>12.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Whether Pre-receipted Bill/Bills are signed by the Claimant – <?php if($bill_signed_by_claiment=="yes"){?>YES<?php } else{?>No<?php }?></strong></div></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>13.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Whether Pre-receipted bill/bills are countersigned by the HoO : <?php if($bill_signed_by_claiment=="yes"){?>YES<?php } else{?>No<?php }?></strong></div></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>14.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Sanction from Head of Office exists/does not exist, ( if exists the amount)</strong></div></td>
				</tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="right"><strong>(a)Savings Fund       :-  Rs </strong><?php echo $savings_amt?></div></td>
	            </tr>    
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="right"><strong>(b)Insurance Fund       :-  Rs </strong><?php echo $insurance_amt?></div></td>
	            </tr>                    
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>15.</strong></td>
				  	<td valign="top" style="padding: 10px 0;" colspan="4">
					  	<div align="left"><strong>The claim is <input type="radio" name="a" <?php if($claim_status=="complete"){?>checked<?php }?>> Complete <input type="radio" name="a" <?php if($claim_status=="incomplete"){?>checked<?php }?>> Incomplete</strong></div>
				  	</td>
				</tr>

			</table>
		</div>
	</div>
</div>
	
<div id="form2" style="display: none;">
	<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print2')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print2" style="width: 900px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.3em; padding: 0 20px;">
	    
			<table width="100%" border="0" cellpadding="2" id="report">
				<tr>
					<td width="3%">&nbsp;</td>
					<td width="35%">&nbsp;</td>
					<td width="5%">&nbsp;</td>
					<td width="30%">&nbsp;</td>
					<td width="27%">&nbsp;</td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;"><strong>16.</strong></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>Calculation of amount admissible from Savings and Insurance Fund as per Table</strong></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>(a) SAVINGS FUND</strong></div></td>
				</tr>            
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">Group D from <b><?php if(!$cal_sav_amt_group_d_from=="0"){ echo " ".$cal_sav_amt_group_d_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$cal_sav_amt_group_d_to=="0"){echo " ".$cal_sav_amt_group_d_to."  ";} else {echo "-------------------";}?></b>Rs <b><?php echo $val['cal_sav_amt_group_d']?></b>X 1 unit = Rs <?php echo $val['total_cal_sav_amt_group_d']?></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">Group C from <b><?php if(!$cal_sav_amt_group_c_from=="0"){ echo " ".$cal_sav_amt_group_c_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$cal_sav_amt_group_c_to=="0"){echo " ".$cal_sav_amt_group_c_to."  ";} else {echo "-------------------";}?></b>Rs <b><?php echo $val['cal_sav_amt_group_c']?></b>X 2 unit = Rs <?php echo $val['total_cal_sav_amt_group_c']?></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">Group B from <b><?php if(!$cal_sav_amt_group_b_from=="0"){ echo " ".$cal_sav_amt_group_b_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$cal_sav_amt_group_b_to=="0"){echo " ".$cal_sav_amt_group_b_to."  ";} else {echo "-------------------";}?></b>Rs <b><?php echo $val['cal_sav_amt_group_b']?></b>X 4 unit = Rs <?php echo $val['total_cal_sav_amt_group_b']?></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">Group A from <b><b><?php if(!$cal_sav_amt_group_a_from=="0"){ echo " ".$cal_sav_amt_group_a_from."  ";} else{echo "-------------------";}?></b>to <b><?php if(!$cal_sav_amt_group_a_to=="0"){echo " ".$cal_sav_amt_group_a_to."  ";} else {echo "-------------------";}?></b>Rs <b><?php echo $val['cal_sav_amt_group_a']?></b>X 8 unit = Rs <?php echo $val['total_cal_sav_amt_group_a']?></div></td>
				</tr>  
				<?php if($val['savings_add_from']!="") { ?>
	              	<tr>
	              		<td style="padding: 10px 0;"></td>
	                  	<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">*Refund of unauthorized/excess subscription from <b><?php echo $val['savings_add_from'];?></b><?php echo nbs(2)?> to <?php echo nbs(1)?><b> <?php echo $val['savings_add_to'];?></b><?php echo nbs(2)?>@Rs <?php echo nbs(2)?><b><?php echo $val['savings_add'];?></b>
	              	</tr>
				<?php } ?>
	            <?php if($val['savings_less_from']!="") { ?>
	              	<tr>
	              		<td style="padding: 10px 0;"></td>
	                  	<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left">* Shorts subscription from <b><?php echo $val['savings_less_from'];?></b><?php echo nbs(2)?> to <?php echo nbs(1)?><b> <?php echo $val['savings_less_to'];?></b><?php echo nbs(2)?>@Rs <?php echo nbs(2)?><b><?php echo $val['savings_less'];?></b>
	              	</tr>
				<?php } ?>

	            <?php 
				$total=round($val['total_cal_sav_amt_group_d']+$val['total_cal_sav_amt_group_c']+$val['total_cal_sav_amt_group_b']+$val['total_cal_sav_amt_group_a']+$val['savings_add']-$val['savings_less']);
				?>
				
				<tr>
					<td valign="top" style="padding: 10px 0;" colspan="5"><div align="right"><b>Total</b>= <?php echo $total; ?></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>(b) INSURANCE FUND</strong></div></td>
				</tr>  
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div><?php echo nbs(10); ?>Group ‘A’ <input type="radio" name="b" <?php if($final_insurance_amt=="120000"){?>checked<?php }?>> Rs 1,20,000/-</div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div><?php echo nbs(10); ?>Group ‘B’ <input type="radio" name="b" <?php if($final_insurance_amt=="60000"){?>checked<?php }?>> Rs 60,000/-</div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div><?php echo nbs(10); ?>Group ‘C’ <input type="radio" name="b"  <?php if($final_insurance_amt=="30000"){?>checked<?php }?>> Rs 30,000/-</div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div><?php echo nbs(10); ?>Group ‘D’ <input type="radio" name="b" <?php if($final_insurance_amt=="15000"){?>checked<?php }?>> Rs 15,000/-</div></td>
				</tr>                      
	            <tr>
	            	<td style="padding: 10px 0;">17.</td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><strong>The amount to be passed for payment under:-</strong></div></td>
			   </tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><?php echo nbs(6);?>(a)S/H Savings fund Rs <?php if(!$val['total_cal_sav_amt_group_d']=="0"){ echo round($val['total_cal_sav_amt_group_d']).''."(Rupees ".''.no_to_words(round($val['total_cal_sav_amt_group_d'])).''.")only"; } else { echo ""; } if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']).''."(Rupees ".''.no_to_words(round($val['total_cal_sav_amt_group_c'])).''.")only"; } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_b']=="0"){ echo round($val['total_cal_sav_amt_group_b']).''."(Rupees ".''.no_to_words(round($val['total_cal_sav_amt_group_b'])).''.")only"; } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_a']=="0"){ echo round($val['total_cal_sav_amt_group_a']).''."(Rupees ".''.no_to_words(round($val['total_cal_sav_amt_group_a'])).''.")only"; } else { echo ""; }?></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;"></td>
					<td valign="top" style="padding: 10px 0;" colspan="4"><div align="left"><?php echo nbs(6);?>(b)S/H Insurance fund Rs <b><?php if(!$final_insurance_amt=="0"){ echo " ".$final_insurance_amt."  ".''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";} else{echo $final_insurance_amt.''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";}?></b> </div></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left">(Sig. DA) </div></td>
				</tr>            
				<tr>
					<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>The information and the assessment as above are checked and found correct. The amount/amounts under Sl. 17 above may be passed for payment.</div></td>
				</tr>
				<tr>
					<td valign="top" style="padding: 10px 0;" colspan="5">
						<div style="width: 30%; padding: 10px; float: left; text-align: center;">(Sig. Superintendent) </div>
						<div style="width: 30%; padding: 10px; float: left; text-align: center;">Approved<br /><br /><br />Sig. DAP</div>
						<div style="width: 30%; padding: 10px; float: left; text-align: center;">Recommended<br /><br /><br />Sig. JDAP</div>
					</td>
				</tr>
				<tr>
					<td valign="top"style="padding: 10px 0;">18.</td>
					<td valign="top"style="padding: 10px 0;">The T.O/S.T.O to be authorized for payment </td>
					<td valign="top"style="padding: 10px 0;">:- </td>
					<td valign="top" style="padding: 10px 0;" colspan="2"><div align="left"><strong><?php echo $val['TO']?></strong></div></td>
				</tr>
				<tr>
					<td style="padding: 10px 0;">19.</td>
					<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Address of the employee/ his successor ---</strong></div></td>
			  	</tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>Name-<?php echo $val['pensionee_name']?></div><div align="center"><?php echo nbs(6); ?>Village/Town-<?php echo $val['village_town']?></div></td>
	            </tr>
	            <tr>
	            	<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><?php echo nbs(6); ?>Post Office-<?php echo $val['po']?></div><div align="center"><?php echo nbs(6); ?>District-<?php echo $val['district']?></div><div align="right"><?php echo nbs(6); ?>State-<?php echo $val['state']?></div></td>
	            </tr>
				<tr>
					<td valign="top" style="padding: 10px 0;">20.</td>
					<td valign="top" style="padding: 10px 0;" colspan="5"><div align="left"><strong>Records of Issue Entry</strong></div></td>
			   </tr>

			</table>
		</div>
	</div>
</div>

</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#select-form-to-print').live('change', function(){
			var val = $(this).val();
			if(val=="form1") {
				hideAll();
				$('#form1').show();
			} else if(val=="form2") {
				hideAll();
				$('#form2').show();
			} else if(val=="form3") {
				hideAll();
				$('#form3').show();
			} else if(val=="form4") {
				hideAll();
				$('#form4').show();
			} else {

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

</html>