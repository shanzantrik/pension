<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authority Group Other Group</title>
</head>

<body>
<?php $val=$values[0];
//print_r($val);
$offict_district=getDistrictById($district_id);
//print_r($offict_district);
$final_insurance_amt=$val['final_insurance_amt'];
?>    




	    <div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.2em; color:#000000; background-color:#FFFFFF; line-height: 1.6em; padding: 0 20px;">

		    <div style="text-align:center; padding:10px 0 20px 0; font:Arial, Helvetica, sans-serif; font-size:16px">
		        <div style="font-weight: bold; text-align: center; line-height: 1.3em; margin-top: 20px;">
		    		OFFICE OF THE </br>DIRECTOR OF AUDIT & PENSION </br>GOVERNMENT OF ARUNACHAL PRADESH </br>NAHARLAGUN
		    	</div>
		    </div>
		<table width="100%" border="0" cellpadding="2" id="report">
     		<tr>
				<td colspan="3"><div align="left">No. <?php echo $val['file_no']?><strong></strong></div></td>
	    		<td><div align="right"> <strong>Date</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">To,</div><br><div align="left" style="padding-left:40px;">The Treasury/Sub-Treasury Officer,<br>
				<?php echo $val['TO'];?>, District:- <?php echo $offict_district;?><br>Arunachal Pradesh.</div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left">Sub:- <u>Authorization of payment due against UTGEGIS, 1984</u></div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left">Ref: - Government of India, Ministry of Home Affairs No. U-14046/2/81-UTs of 24th April 

1986</div></td>
			</tr> 
			<tr height="20px";><td colspan="5"></td></tr>
           
			<tr>
				<td colspan="5"><div align="left">Sir/Madam, </div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6); ?>The Receipted bill/bills on account of UTGEGIS in favour of <b><?php echo $val['salutation'];?><?php 

echo nbs(2)?><?php echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?>, Rtd.</b><?php echo nbs(2)?>office of 

the<?php echo nbs(2)?><b><?php echo $val['office_address']?></b><?php echo nbs(2)?>is/are sent herewith after affixing pass orders for payment as under-
            </div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<?php $total = round($val['total_cal_sav_amt_group_d']+$val['total_cal_sav_amt_group_c']+$val['total_cal_sav_amt_group_b']+$val

['total_cal_sav_amt_group_a']); ?>
				<td colspan="5">
					<!-- (i) Rs <?php if(!$val['total_cal_sav_amt_group_d']=="0"){ echo round($val['total_cal_sav_amt_group_d']); } else { echo ""; 

} if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_c']=="0"){ 

echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_a']=="0"){ echo round($val['total_cal_sav_amt_group_a']); } 

else { echo ""; }?> (Rupees ______) only under Sub-head-Saving Fund Under Major head of Account-8011 Insurance and Pension Fund of Union Territory Government Employees 

Group Insurance Scheme. -->
					1.(i) Rs <b><?php echo $total; ?> /- (Rupees <?php echo no_to_words($total); ?>)</b> only under Sub-head-Saving Fund Under Major 

head of Account-8011 Insurance and Pension Fund of Union Territory Government Employees Group Insurance Scheme.
				</td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>
			<tr>
				<td colspan="5">(ii) Rs <b><?php if(!$final_insurance_amt=="0"){ echo " ".$final_insurance_amt."  ".''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";} else{echo $final_insurance_amt.''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";}?></b> under Sub-head-Insurance Fund Under Major head of Account-8011 Insurance and Pension Fund of 

Union Territory Government Employees Group Insurance Scheme.</td>
			</tr>  
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5">2. You are authorized to make payment after observing usual formalities and obtaining the revised sanction order, wherever 

necessary, from the Head of the office concerned.</td>
			</tr>
			<tr>
				<td colspan="5">3. This has the approval of the Director of Audit & Pension.</td>
			</tr>            
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
			 <td style="vertical-align: top;" colspan="2">Enclosed:- As above</td>
			<td style="vertical-align: top; padding: 0 100px; text-align:right;" colspan="3">Yours Faithfully,</td>
			</tr>
			<tr height="60px"><td colspan="5"></td></tr>
			<tr>
			<td style="vertical-align: top; padding: 0 80px; text-align:right;" colspan="5">Director/Joint Director</td>
			</tr>    
			<tr height="20px"><td colspan="5"></td></tr>                          
     		<tr>
				<td colspan="3"><div align="left">Memo No. <b><?php echo $val['file_no']?></b></div></td>
	    		<td><div align="right" style="padding-right:40px;"> <strong>Dated Naharlagun</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
		    <tr height="20px"><td colspan="5"></td></tr>                          

     		<tr>
				<td colspan="5"><div align="left">Copy to:-</div></td>	    		
			</tr> 
		    <tr height="20px"><td colspan="5"></td></tr>                          
           
			<tr>
			  <td colspan="5"><div align="left">1.	The <?php echo nbs(2)?><b><?php echo $val['office_address']?></b><?php echo nbs(2)?>with the reference 

to his letter No.<b>Pen/Gis/<?php echo $val['letter_no'];?></b> dated <b><?php echo $val['letter_date'];?></b>, together with the service book of <b><?php echo $val['salutation']?><?php echo nbs(2)?><?php echo $val['pensionee_name']?>, <?php echo 

$val['designation']?>, Rtd.<?php echo nbs(2)?></b>. A note of authority for payment has been made in the service book under our Seal and Signature. 

Revised sanction order/orders may be issued for corrected amount, if any, before drawing. The amount may be drawn from Treasury in the usual manner and disburse to the 

Government Servant/Nominee/Legal heir as the case may be obtaining proper receipt.</div></td>
			</tr>
			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Name:- </div></td><td><?php echo $val['salutation'];?><?php echo nbs(2);?><?php echo $val['pensionee_name']?></td>
            </tr>
			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Vill/Town:- </div></td><td><?php echo nbs(2);?><?php echo $val['village_town']?></td><td ><div 

align="left"><?php echo nbs(6); ?>PO:- </div></td><td><?php echo nbs(2);?><?php echo $val['po']?></td>
            </tr>
            	<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>District:- </div></td><td><?php echo nbs(2);?><?php echo $val['district']?></td><td ><div align="left"><?php 

echo nbs(6); ?>State:- </div></td><td><?php echo nbs(2);?><?php echo $val['state']?></td>
            </tr>
            <tr height="90px";><td colspan="5"></td></tr>

			<tr>
			 <td style="vertical-align: top;" colspan="2">Enclo:- Service book of the incumbent</td>
			<td style="vertical-align: top; padding: 0 100px; text-align:right;" colspan="3">Director/Joint Director</td>
			</tr>
		</table>
	</div>
</div>


</body>

</html>
