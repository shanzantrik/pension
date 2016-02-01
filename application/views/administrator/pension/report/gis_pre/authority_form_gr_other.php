<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authority Group Other Group</title>
</head>

<body>
<?php $val=$values[0];
 $final_insurance_amt=$val['final_insurance_amt'];
?>

	<div id="print1" style="width: 900px; margin: 0px auto;">
		<div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	    	<div style="font-weight: bold; text-align: center;">
	    		<p>DIRECTORATE OF AUDIT & PENSION </p>
	    		<p>GOVERNMENT OF ARUNACHAL PRADESH</p>
	    		<p> NAHARLAGUN </p>
	    	</div>
	    </div>
		<table width="100%" border="0" cellpadding="2" id="report">
     		<tr>
				<td colspan="3"><div align="left">No. DA/GIS/86/<strong></strong></div></td>
	    		<td><div align="right"> <strong>Date</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
			<tr>
				<td width="7%"><div align="left">To</div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Sub:- <u>Authorization of payment due against UT Government</u></div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Ref: - Government of India, Ministry of Home Affairs No. U-14046/2/1-UTs of 24th April 1986</div></td>
			</tr>            
			<tr>
				<td><div align="left">Sir/Madam, </div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6); ?>The Receipted bill/bills on account of UTGEGIS in favour of Smti/Shri/Late<?php echo nbs(2)?><b><?php echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?><?php echo nbs(2)?>,Rtd</b><?php echo nbs(2)?>office of the<?php echo nbs(2)?><b><?php echo $val['office_address']?></b><?php echo nbs(2)?>is/are sent herewith after affixing pass orders for payment as under-
            </div></td>
            
			</tr>
			<tr>
				<td colspan="5">(i) Rs <?php if(!$val['total_cal_sav_amt_group_d']=="0"){ echo round($val['total_cal_sav_amt_group_d']); } else { echo ""; } if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_a']=="0"){ echo round($val['total_cal_sav_amt_group_a']); } else { echo ""; }?> (Rupees ______) only under Sub-head-Saving Fund Under Major head of Account-8011 Insurance and Pension Fund of Union Territory Government Employees Group Insurance Scheme.</td>
			</tr>
			<tr>
				<td colspan="5">(ii) Rs <b><?php if(!$final_insurance_amt=="0"){ echo " ".$final_insurance_amt."  ";} else{echo "----------------";}?></b> (Rupees _________________) only under Sub-head-Insurance Fund Under Major head of Account-8011 Insurance and Pension Fund of Union Territory Government Employees Group Insurance Scheme.</td>
			</tr>  
			<tr>
				<td colspan="5">2. You are authorized to make payment after observing usual formalities and obtaining the revised sanction, wherever necessary, from the Head of the office concerned.</td>
			</tr>
			<tr>
				<td colspan="5">3. This has the approval of the Director of Audit & Pension.</td>
			</tr>            
			<tr>
				<td colspan="5"><div align="right">Yours Faithfully,<br/>Joint Director<br/>Directorate of Audit & Pension<br/>Government of Arunachal Pradesh<br/><u>Naharlagun</u></div></td>
			</tr>                                   
     		<tr>
				<td colspan="3"><div align="left">Memo No. DA/GIS/86/<strong></strong></div></td>
	    		<td><div align="right"> <strong>Dated Naharlagun</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
     		<tr>
				<td colspan="3"><div align="left">Copy to:-</div></td>	    		
			</tr>            
			<tr>
			  <td colspan="5"><div align="left">1.	The <?php echo nbs(2)?><b><?php echo $val['office_address']?></b><?php echo nbs(2)?>with the reference to his letter No. ______ dated _____ ,together with the service book of Shri/Smti<?php echo nbs(2)?><b><?php echo $val['pensionee_name']?><?php echo nbs(2)?><?php echo $val['designation']?><?php echo nbs(2)?>Rtd.<?php echo nbs(2)?></b>  . A note of authority for payment has been made in the service book under our Seal and signature. Revised sanction order/orders may be issued for corrected amount, if any, before drawing. The amount may be drawn from Treasury in the usual manner and disburse to the Government servant/Nominee/legal heir as the case may be obtaining proper receipt.</div></td>
			</tr>
			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Name-</div></td><td><?php echo nbs(2);?><?php echo $val['pensionee_name']?></td>
            </tr>
			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Vill/Town-</div></td><td><?php echo nbs(2);?><?php echo $val['village_town']?></td><td ><div align="left"><?php echo nbs(6); ?>P.O-</div></td><td><?php echo nbs(2);?><?php echo $val['po']?></td>
            </tr>
            	<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>District-</div></td><td><?php echo nbs(2);?><?php echo $val['district']?></td><td ><div align="left"><?php echo nbs(6); ?>State-</div></td><td><?php echo nbs(2);?><?php echo $val['state']?></td>
            </tr>
                       

			<tr>
				<td colspan="5"><div align="right">Joint Director<br/>Directorate of Audit & Pension<br/>Government of Arunachal Pradesh<br/><u>Naharlagun </u></div></td>
			</tr>            
		</table>
	</div>
</div>


</body>

</html>
