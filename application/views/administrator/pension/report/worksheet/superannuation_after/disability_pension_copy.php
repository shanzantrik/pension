<h4>Pension -> Disability pension</h4>


<?php $val = $values[0];?>
  	<?php $death_date=$val['dod'];?>
    <?php $dor=$val['dor'];?>
    <?php $age_at_retire=$val['age_at_retirement'];?>
    <?php $total_service=$val['Total_service'];?>
    <?php $category=$val['pension_category'];?>
    <?php $disability=$val['disability'];
	echo $disability;
	?>

    
<div class="header">							
    <h3>Working Sheet </h3>
</div>

   


<?php 
$age_at_retire_plus_1=$age_at_retire+1;
$comm_value=check_age_at_next_birth($age_at_retire_plus_1);

?>



    
    <table align="center" border="1" class="table table-striped table-bordered table-condensed">
	<tr>
		<td width="20%"><b>File No</b></td>
		<td width="30%"><?php echo $val['File_No']; ?></td>
		<td width="20%"><b>Name of Pensioner</b></td>
		<td width="30%"><?php echo $val['pensioner_name']; ?></td>
	</tr>
    
    <tr>
		<td colspan="4"></td>
		
        
	</tr>
	<tr>
		<td><b>Date Of Birth</b></td>
		<td><?php echo $val['dob']; ?></td>
		<td><b></b></td>
		<td></td>
	</tr>
    
	<tr>
    <td><b>Date of Joining</b></td>
	<td><?php echo $val['doj']; ?></td>
    <td><b>Age at Joining</b></td>
	<td><?php echo $val['age_at_joining'];?></td>
    </tr>
    


 <?php 
$dor = $val['dor'];
$aDate = explode("-", $dor);
$dor_y = $aDate[0];
$dor_m = $aDate[1];
$dor_d = $aDate[2];
$joindor = join('-', $aDate);
$joindor = nl2br($joindor);

$death_date = $val['dod'];
$aDate = explode("-", $death_date);
$death_date_y = $aDate[0];
$death_date_m = $aDate[1];
$death_date_d = $aDate[2];

$last_inc_date = $val['last_increament_date'];
$aDate = explode("-", $last_inc_date);
$last_inc_y = $aDate[0];
$last_inc_m = $aDate[1];
$last_inc_d = $aDate[2];
echo($last_inc_m);
?>
<tr>
      <?php if($dor!=0)
	       { 
		echo"<td><b>Date of Retirement</b></td>";
		echo "<td>$dor</td>";
		echo"<td><b>Age at retirement</b></td>";
		echo"<td>$age_at_retire</td>";
            }
	     ?>
	</tr>
     <tr>
    <?php if($death_date!=0)
	{	
         echo "<td><b>Death_date:</b></</td>";
		 echo "<td>$death_date</</td>";
    }
	?>
	    <td><b>Total Service;</b></</td>;
		 <td><?php echo $total_service;?></td>
         </tr>
	

	<tr>
		<td><b>Less non qualifying service</b></td>
		<td><?php echo $val['less_non_qaulifing_service']; ?></td>
		<td><b>Net qualifying Service</b></td>
		<td><?php echo $val['net_qualifing_service']; ?></td>
	</tr>
	<tr>
		<td><b>Service Verification</b></td>
		<td><input type="checkbox" name="file_no" /></td>
		<td><b>Regularization of Adhoc Service</b></td>
		<td><?php echo $val['Regularization_AdHoc_Service']; ?></td>
	</tr>
    
      <tr>
		<td><b>Last Pay</b></td>
		<td><b>BP</b>=<?php echo $val['Basic_salary']; ?></td>
		<td><b>GP</b>=<?php echo $val['gross_pay']; ?></td>
		<td><b>NPA</b>=<?php echo $val['NPA']; ?></td>
	 </tr>
	<tr>
		<td><b>Last Incremented Pay:</td>
		<td><b>BP</b>=<?php echo $val['increament_bp']; ?></td>
		<td><b>GP</b>=<?php echo $val['increament_gp']; ?></td>
		<td><b>NPA</b>=<?php echo $val['increament_npa']; ?></td>
	</tr>
    <?php 
	//for july_inc//
	$inc_last_pay=getLastPay($val['Basic_salary'], $val['gross_pay'], '', $val['NPA'],$dor_y,$dor_m,$val['increament_bp'],$val['increament_gp'], $val['increament_npa'],$last_inc_m);
	//$ae = getAverageEmolument($lp, $ip, $val['dor'], $pay_info[2]['last_increament_date']);
	$ae = '';
	
	$pension_amt=getPension_Amount($inc_last_pay,$ae);
	    
	?>
    <tr>
    <td style="text-align:center" colspan="4"><b>Pension Calculation:</b></td>
    </tr>
    
    <tr>
		<td><b>Average Emoulments</b></td>
		<td><?php echo $ae ?></td>
		<td><b>Amount of Pension</b></td>
		<td><?php echo $pension_amt;?></td>
	</tr>
    
      <tr>
		<td><b>Dearness Allowance(DA)</b></td>
		<td><?php echo $val['DA_on_dor'];  ?></td>
		<td><b>Dearness Pay(DP)</b></td>
		<td><?php echo getPension_Amount($inc_last_pay,$ae);?></td>
	</tr>
 <?php 
$net_service= $val['net_qualifing_service'];
$aDate = explode(" ", $net_service);
$net_service_y = $aDate[0];
$net_service_m= $aDate[2];
echo($net_service_y);
echo($net_service_m);

?>
<?php 
$year_of_service=getServiceYear($net_service_y,$net_service_m);
echo $year_of_service;
$enhanrate_upto=getEnhan_Rate_upto($dor,$death_date,$dor_y,$death_date_y);
//$disability_pension=getDisability_Pension($val['increament_bp'],$category,$disability);
$disability_pension='';
?>
<?php echo $dor;?>
<?php echo $death_date;?>
<?php echo $dor_y;?>
<?php echo $death_date_y;?>

       <tr>
		<td><b>Gratuity:</b></td>
		<td><?php echo getGratuity($inc_last_pay,$val['DA_on_dor'],$year_of_service);?></td>
		<td><b>Dearness Pay(DP)</b></td>
		<td><?php echo getPension_Amount($inc_last_pay,$ae);?></td>
	</tr>
    
       <tr>
		<td><b>Commutation Pension:</b></td>
		<td><?php echo getCommutation($pension_amt,$comm_value);?></td>
		<td><b>Reduced Penson:</b></td>
		<td><?php echo getReduced_Pension($inc_last_pay);?></td>
	</tr>
   
     <?php $enhan_rate=getEnhanced_Rate($inc_last_pay);
	       $ord_rate=getOrdinary_Rate($inc_last_pay);
		
			
	 ?>
       <?php 
	   if($death_date!=0)
        {       
	
	     echo"<tr>";
		 echo"<td colspan=4 style=text-align:center><b>Family Pension:</b></td>";
	     echo"</tr>";
		 echo"<tr>";
         echo "<td><b>Enhanced Rate:</b></</td>";
		 //death b4 retirement
		 if($death_date_y==$dor_y)
		 {
		 echo "<td>$enhan_rate From $death_date upto $enhanrate_upto-$dor_m-$dor_d</td>";
		 }
		 else//death after retirement
		 {
			  echo "<td>$enhan_rate From $death_date upto $enhanrate_upto-$death_date_m-$death_date_d</td>";
		 }
		 echo "<td><b>Ordinary Rate;</b></</td>";
	     echo "<td>$ord_rate</</td>";
         echo" </tr>";

       }
	?>
     <tr>
		<td><b>Disability Pension</b></td>
		<td><?php echo $disability_pension?></td>
		<td></td>
		<td></td>
	</tr>
    
	<tr>
		<td><b>Place of Payment (under which Treasury/Bank)</b></td>
		<td><?php echo $val['place_of_payment']; ?></td>
		<td><b>Address after Retirement</b></td>
		<td><?php echo $val['Address_at_retirement']; ?></td>
	</tr>
<tr>
		<td><b>Class of Pension</b></td>
		<td><?php echo str_replace("_", " ", $val['class_of_pension']); ?></td>
		<td><b>Name of Legal Heir</b></td>
		<td><?php echo $val['name_of_legal_heir']; ?></td>
	</tr>
	<tr>
		<td><b>Form Submitted</b></td>
		<?php
			$form_Submit = '';
			if(!empty($val['submitted_form'])) {
				if(is_array(unserialize($val['submitted_form']))) {
					$form_Submit .= "<a href='#'>".implode("</a>, <a href='#'>", unserialize($val['submitted_form']))."</a>";
				} else {
					$form_Submit .= unserialize($val['submitted_form']);
				}
			} else {

			}
		?>
		<td><?php echo $form_Submit; ?></td>
		<td><b>Document</b></td>
		<?php
			$document_Submit = '';
			if(!empty($val['submitted_document'])) {
				if(is_array(unserialize($val['submitted_document']))) {
					$document_Submit .= implode(", ", array_map('getDocumentName', unserialize($val['submitted_document'])));
				} else {
					$document_Submit .= unserialize($val['submitted_document']);
				}
			} else {

			}
		?>
		<td><?php echo $document_Submit; ?></td>
	</tr>
	<tr>
		<td><b>Provisional Gratuity Status</b></td>
		<td><?php echo $val['provisional_gratuity']; ?></td>
		<td><b>Provisional Pension Status</b></td>
		<td><?php echo $val['provisional_pension']; ?></td>
	</tr>
    
    <tr>
		<td ><div align="right">29.</div></td>
		<td><b>Earn Leave Encashment</b></td>
		<td>:</td>
		<td><?php echo round($earn); ?></td>
	</tr>
    <tr>
		<td ><div align="right">30.</div></td>
		<td><b>Half Leave Encashment</b></td>
		<td>:</td>
		<td><?php echo round($half_pay); ?></td>
	</tr>
</table>