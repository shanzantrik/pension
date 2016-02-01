<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authority Form Group A</title>
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
				<td colspan="4"><div align="left">File No. <b><?php echo $val['file_no']?></b><strong></strong></div></td>
	    		<td><div align="right"> <strong>Date</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>
			<tr>
				<td width="7%"><div align="left">To</div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Sub:- Authorization of payment due against UT Government <br/><?php echo nbs(6); ?>Employees Group Insurance Scheme, 1984</div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Ref: - Government of India, Ministry of Home Affairs No. U-14046/2/1UTs of 24th April 1986</div></td>
			</tr>            
			<tr>
				<td><div align="left">Sir/Madam, </div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6); ?>The following receipted bill/bills in respect of Shri<?php echo nbs(2)?><b><?php echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?><?php echo nbs(2)?>,Rtd</b> Itanagar, is/are sent herewith after having duly passed for payment as under:-</div></td>
			</tr>
			<tr>
				<td colspan="5">
					<?php $total = round($val['total_cal_sav_amt_group_d']+$val['total_cal_sav_amt_group_c']+$val['total_cal_sav_amt_group_b']+$val['total_cal_sav_amt_group_a']); ?>
					(i)	Savings Fund Rs <b><?php echo $total; ?> /-(Rupees <?php echo no_to_words($total); ?>)</b> only. The expenditure is debit able the Head of Account ‘8658’ suspense finally adjustable under Major Head 8011 Insurance & Pension Fund.
					<!-- (i)	Savings Fund Rs <b><?php if(!$val['total_cal_sav_amt_group_d']=="0"){ echo round($val['total_cal_sav_amt_group_d']); } else { echo ""; } if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_c']=="0"){ echo round($val['total_cal_sav_amt_group_c']); } else { echo ""; }?><?php if(!$val['total_cal_sav_amt_group_a']=="0"){ echo round($val['total_cal_sav_amt_group_a']); } else { echo ""; }?></b> /-(Rupees __________________________) only. The expenditure is debit able the Head of Account ‘8658’ suspense finally adjustable under Major Head 8011 Insurance & Pension Fund. -->
				</td>
			</tr>
			<tr>
				<td colspan="5">(ii) Insurance Rs <b><?php if($final_insurance_amt!="0"){ echo " ".$final_insurance_amt."  "."(Rupess".no_to_words($final_insurance_amt).")";} else{echo "----------------";}?></b> only. The expenditure is debitable the Head of Account ‘8658’ suspense finally adjustable under Major Head-8011, Insurance & Pension Fund.</td>
			</tr>  
			<tr>
				<td colspan="5">(iii) You are Authorised to pay the amount after observing the usual formalities and on production of revised sanction order/orders wherever necessary.</td>
			</tr>
			<tr>
				<td colspan="5"><div align="right">Yours Faithfully<br/>Joint Director<br/>Directorate of Audit & Pension<br/>Government of Arunachal Pradesh<br/>Naharlagun </div></td>
			</tr>                                   
     	
			<tr>
				<td width="30%"><div align="left">Memo No. <b><?php echo $val['file_no']?></b><strong></strong></div></td>
	    		<td colspan="4"><div align="right"> <strong>Dated</strong>: <?php echo date('d/m/Y')?>    </div></td>
			</tr>

			<tr>
			<td colspan="5"><div align="left">1.<?php echo nbs(2)?><b><?php echo $val['office_address']?></b> with the reference to his letter No. ______ dated _____ 
 Together with the service book of Shri <?php echo nbs(2)?><b><?php echo $val['pensionee_name']?></b>,<?php echo nbs(2)?><b><?php echo $val['designation']?><?php echo nbs(2)?>,Rtd</b> . A note of authority for payment has been made in the service books under our seal and signature. Revised sanction order/orders may be issued for corrected amount, if any, before drawing. The amount may be drawn from <b>Treasury Officer,Itanagar</b>, Expenditure may be Booked under <b>Head of Accounts"8658"</b>in the usual manner and disburse to the Government servant/Nominee/legal heir as the case may be, He is further requested to claim reimbursement from the PAO-(Forest) Ministry of Environment & Forest, Govt. India, Parya Varan Bhawan , CGO- complex,  Lodhi Road, New Delhi 110003 through the A.G. Arunachal Pradesh, Itanagar.
            </div>
            </td>

			</tr>
			<tr>
			  <td colspan="5"><div align="left">2.The Pay & Accounts Officer, (Forest) Ministry of Environment & Forest, Govt. India. Parya Varan Bhawan, CGO-complex, Lodhi Road, New Delhi 110003.</div></td>
			</tr>            
			<tr>
			  <td colspan="5"><div align="left">3.The Accountant General Govt. Of Arunachal Pradesh, Itanagar for information. Kindly arrange recoupment from Govt. Of India by reimbursement claims to clear the suspense.</div></td>
			</tr> 
			<tr>
			  <td colspan="5"><div align="left">4.<b>Name :-<?php echo $val['pensionee_name']?></b></br><?php echo nbs(3)?><b>Vill/Town :-<?php echo $val['village_town']?></b></br><?php echo nbs(3)?><b>Post Office :-<?php echo $val['po']?></b></br><?php echo nbs(3)?><b>District :-<?php echo $val['district']?></b></br><?php echo nbs(3)?><b>State:-<?php echo $val['state']?></b></td>
			</tr>
			<tr>
			  <td colspan="5"></td>
			</tr> 
			<tr>
			  <td colspan="5"><div align="left"><b>Enclo:-Service Book</b></td>
			</tr>
		</table>
	</div>
</div>


</body>
</html>
