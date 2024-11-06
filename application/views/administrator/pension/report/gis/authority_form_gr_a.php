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
				<?php echo $val['TO'];?>, District <?php echo $offict_district;?><br>Arunachal Pradesh.</div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left">Sub:- Authorization of payment due against UT Government Employees Group 

Insurance Scheme, 1984</div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left">Ref: - Government of India, Ministry of Home Affairs No. U-14046/2/1UTs of 24th April 1986</div></td>
			</tr
			<tr height="20px";><td colspan="5"></td></tr>
           
			<tr>
				<td colspan="5"><div align="left">Sir/Madam, </div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6); ?>The following receipted bill/bills in respect of<b><?php echo $val['salutation'];?><?php echo nbs(2)?><?php 

echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?><?php echo nbs(2)?>,Rtd</b> Itanagar, is/are sent herewith after having duly 

passed for payment as under:-</div></td>
			</tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5">
					<?php $total = round($val['total_cal_sav_amt_group_d']+$val['total_cal_sav_amt_group_c']+$val['total_cal_sav_amt_group_b']+

$val['total_cal_sav_amt_group_a']); ?>
					(i)	Savings Fund Rs <b><?php echo $total; ?> /-(Rupees <?php echo no_to_words($total); ?>)</b> only. The expenditure is 

debit able the Head of Account ‘8658’ suspense finally adjustable under Major Head 8011 Insurance & Pension Fund.
				
				</td>
			</tr>
			<tr>
				<td colspan="5">(ii) Insurance Rs <b><?php if(!$final_insurance_amt=="0"){ echo " ".$final_insurance_amt."  ".''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";} else{echo $final_insurance_amt.''."(Rupees ".''.no_to_words($final_insurance_amt).''.")only";}?></b>. The expenditure is debitable the Head of Account ‘8658’ suspense finally adjustable under Major 

Head-8011, Insurance & Pension Fund.</td>
			</tr>  
			<tr>
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
				<td colspan="5">(iii) You are Authorised to pay the amount after observing the usual formalities and on production of revised sanction 

order/orders wherever necessary.</td>
			</tr>
			<tr>			<tr>
				<td colspan="5">3. This has the approval of the Director of Audit & Pension.</td>
			</tr>            
			<tr height="20px";><td colspan="5"></td></tr>

			<tr>
			 <td style="vertical-align: top;" colspan="2"></td>
			<td style="vertical-align: top; padding: 0 100px; text-align:right;" colspan="3">Yours Faithfully,</td>
			</tr>
			<tr height="60px"><td colspan="5"></td></tr>
			<tr>
			<td style="vertical-align: top; padding: 0 80px; text-align:right;" colspan="5">Director/Joint Director</td>
			</tr>    
			<tr height="20px"><td colspan="5"></td></tr>                          
     		<tr>
				<td colspan="3"><div align="left">Memo No. <b><?php echo $val['file_no']?></b></div></td>
	    		<td><div align="right"> <strong>Dated Naharlagun</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
		    <tr height="20px"><td colspan="5"></td></tr>                          

     		<tr>
				<td colspan="5"><div align="left">Copy to:-</div></td>	    		
			</tr> 
		    <tr height="20px"><td colspan="5"></td></tr>                          
           
			<tr>
			<td colspan="5"><div align="justify">1.<?php echo nbs(2)?><b><?php echo $val['office_address']?></b> with the reference to his letter No.<b>Pen/Gis/<?php echo $val['letter_no'];?></b> 
dated  <b><?php echo $val['letter_date'];?></b>
 Together with the service book of <?php echo $val['salutation'];?> <?php echo nbs(2)?><b><?php echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?><?php echo 

nbs(2)?>,Rtd</b> . A note of authority for payment has been made in the service books under our seal and signature. Revised sanction order/orders may be issued for 

corrected amount, if any, before drawing. The amount may be drawn from <b>Treasury Officer,Itanagar</b>, Expenditure may be Booked under <b>Head of 

Accounts"8658"</b>in the usual manner and disburse to the Government servant/Nominee/legal heir as the case may be, He is further requested to claim reimbursement from 

the PAO-(Forest) Ministry of Environment & Forest, Govt. India, Parya Varan Bhawan , CGO- complex,  Lodhi Road, New Delhi 110003 through the A.G. Arunachal Pradesh, 

Itanagar.
            </div>
            </td>
			</tr>

			<tr>
			  <td colspan="5"><div align="left">2.The Pay & Accounts Officer, (Forest) Ministry of Environment & Forest, Govt. India. Parya Varan Bhawan, 

CGO-complex, Lodhi Road, New Delhi 110003.</div></td>
			</tr>

			<tr>
			  <td colspan="5"><div align="left">3.The Accountant General Govt. Of Arunachal Pradesh, Itanagar for information. Kindly arrange recoupment 

from Govt. Of India by reimbursement claims to clear the suspense.</div></td>
			</tr>

			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Name-</div></td><td><?php echo $val['salutation'];?><?php echo nbs(2);?><?php echo $val['pensionee_name']?></td>
            </tr>
			<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>Vill/Town-</div></td><td><?php echo nbs(2);?><?php echo $val['village_town']?></td><td ><div 

align="left"><?php echo nbs(6); ?>P.O-</div></td><td><?php echo nbs(2);?><?php echo $val['po']?></td>
            </tr>
            	<tr>
            	<td ><div align="left"><?php echo nbs(6); ?>District-</div></td><td><?php echo nbs(2);?><?php echo $val['district']?></td><td ><div align="left"><?php 

echo nbs(6); ?>State-</div></td><td><?php echo nbs(2);?><?php echo $val['state']?></td>
            </tr>
                       
            <tr height="90px";><td colspan="5"></td></tr>

			<tr>
			 <td style="vertical-align: top;" colspan="2">Enclo:-Service Book</td>
			<td style="vertical-align: top; padding: 0 100px; text-align:right;" colspan="3">Director/Joint Director</td>
			</tr>
		</table>
	</div>
</div>


</body>

</html>
