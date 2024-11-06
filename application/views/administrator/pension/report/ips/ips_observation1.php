<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
<?php $val=$values[0];?>
<?php $rec=$records;?>
<?php $record=$rec;?>





<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">

    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px">
    <u> <strong>OFFICE OF THE</strong></br>
       <strong> DIRECTOR OF AUDIT & PENSION </strong></br>
       <strong> GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
       <strong> NAHARLAGUN</strong>
    </u>
    </div>
   
   <table width="60%" border="0" align="center" cellpadding="2" id="report">
	 <tr>
		<td width="10%"><div align="left">No:<?php echo $val['file_no'];?></div></td>
		<td width="10%"></td>
		<td><div align="right"><b>Dated Naharlagun the....</b></div></td>
	</tr>
		<tr>
			<td colspan="3"><div align="left">To,</div></td>
		</tr>

    <tr style="height:40px;">
    <td></td>
    </div></td>   
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>


      <tr>
			<td colspan="3"></div></td>
		</tr>

	     <tr>
			<td ><div align="left"><b>Sub-</b></div></td>
			<td colspan="2"><b>Checking of IPS under revised pay scales 1986/1997/2008</b></td>
		</tr>

		  <tr>
			<td colspan="3"></td>
		  </tr>

		    <tr>
			<td><div align="left"><b>Ref-</b></div></td>
			<td colspan="2"><b>Your letter No.........................dtd<?php echo $val['receipt_date'];?></b></td>
		    </tr>

		    <tr>
			<td colspan="3"><div align="left">Sir,</div></td>
            </tr>
            <tr></tr>
            <tr>
            <td><div align="left"></div></td>
            <td colspan="2">Please refer your letter No.quoted above,the IPS along with Service Book of the officials has/have duly been checked and is/are returned for the following reasons.</td>
		    </tr>
  
            <tr>
			<td><div align="left"></div></td>
			<td colspan="2"><b>Name & Designation</b></td>
		    </tr>
        <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b>Name:<?php echo $val['name'];?>,<?php echo $val['designation'];?></b></td>
        </tr>
          <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b>Observation:-</b></td>
        </tr><?php
        
        
    //$r1=$rec['earlier'];
        /*$r2=$rec['observation'];
       
        $r17=$rec['remarks'];*/
       if (!empty($_POST['eariler'])) {

      $r1= $rec['eariler'];  
      if(!$r1=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r1</div></td>";
      echo"</tr>";
      }
    } 
    if (!empty($_POST['observation'])) {

      $r2= $rec['observation'];  
      if(!$r2=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r2</div></td>";
      echo"</tr>";
      }
    } 
     if (!empty($_POST['additional'])) {

      $r3= $rec['additional'];  
      if(!$r3=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r3</div></td>";
      echo"</tr>";
      }
    } 
     if (!empty($_POST['higher'])) {

      $r4= $rec['higher'];  
      if(!$r4=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r4</div></td>";
      echo"</tr>";
      }
    } 
     if (!empty($_POST['identical'])) {

      $r5= $rec['identical'];  
      if(!$r5=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r5</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['pay_fixed'])) {

      $r6= $rec['pay_fixed'];  
      if(!$r6=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r6</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['stepping'])) {

      $r7= $rec['stepping'];  
      if(!$r7=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r7</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['time_bound'])) {

      $r8= $rec['time_bound'];  
      if(!$r8=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r8</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['upgradation'])) {

      $r9= $rec['upgradation'];  
      if(!$r9=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r9</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['acps'])) {

      $r10= $rec['acps'];  
      if(!$r10=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r10</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['macps'])) {

      $r11= $rec['macps'];  
      if(!$r11=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r11</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['family'])) {

      $r12= $rec['family'];  
      if(!$r12=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r12</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['suspension'])) {

      $r13= $rec['suspension'];  
      if(!$r13=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r13</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['break'])) {

      $r14= $rec['break'];  
      if(!$r14=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r14</div></td>";
      echo"</tr>";
      }
    } 
    if (!empty($_POST['dies_non'])) {

      $r15= $rec['dies_non'];  
      if(!$r15=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r15</div></td>";
      echo"</tr>";
      }
    } 
    
if (!empty($_POST['break'])) {

      $r16= $rec['withholding'];  
      if(!$r16=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r16</div></td>";
      echo"</tr>";
      }
    } 
    if (!empty($_POST['eol'])) {

      $r17= $rec['eol'];  
      if(!$r17=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r17</div></td>";
      echo"</tr>";
      }
    } 
if (!empty($_POST['increments'])) {

      $r18= $rec['increments'];  
      if(!$r18=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r18</div></td>";
      echo"</tr>";
      }
    } 
    if (!empty($_POST['last_pay'])) {

      $r19= $rec['last_pay'];  
      if(!$r19=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r19</div></td>";
      echo"</tr>";
      }
    } 
     if (!empty($_POST['remarks'])) {

      $r20= $rec['last_pay'];  
      if(!$r20=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r20</div></td>";
      echo"</tr>";
      }
    } 
?>
    
    

    <tr style="height:40px;">
    <td colspan="4"></td>   
  </tr>
            
          
<?php 
$i=1;
foreach ($values as $val)
{



?>
            <tr>
            <td><div align="left"></div></td>
            <td colspan="2"><b></b></td>
		        </tr>
            <tr>
            <td><div align="left"></div></td>
            <td colspan="2"></td>
		        </tr>
<?php
$i++;
}
?>

		 <!--  <tr>
          <td colspan="3" >
          <div align="left">
          		<h4>Remark1: </h4>
				<?php //echo $r1; ?><br/>
                <h4>Remark2: </h4>
                <?php //echo $r2;?><br/>
                <h4>Remark3: </h4>
                <?php //echo $r3;;?><br/>
                <h4>Remark4: </h4>
                <?php //echo $r4;;?><br/>
          </div></td>
		  </tr> -->
		    <?php
/*	  $r1=$val['remark1'];
	  $r2=$val['remark2'];
	  $r3=$val['remark3'];
	  $r4=$val['remark4'];

      if(!$r1=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>i)$r1</div></td>";
      echo"</tr>";
      }

       if(!$r2=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>ii)$r2</div></td>";
      echo"</tr>";
      }
      if(!$r3=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>ii)$r3</div></td>";
      echo"</tr>";
      }
       if(!$r4=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>iv)$r4</div></td>";
      echo"</tr>";
      }
	  ?>
*/         
?>

		   <tr style="height:40px;">
           <td colspan="3"></td>
	       </tr>
	       <tr>
 
			<td colspan="3"><div align="right">Yours faithfully</div></td>
		  </tr>


		    <tr>
            <td colspan="3">Enclose :- As stated</td>
	        </tr>

	        <tr>
            
	        <td colspan="3">
            <div style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px"><strong>Asstt,Audit Officer/Asstt.Auditor,</strong></br>
       <strong>for Director of Audit and  Pension</strong></br>
       <strong>Govt. of Arunachal Pradesh</strong></br>
       <div style="padding-right:30px"><strong>Naharlagun</strong></div>
</div></td>
	        </tr>
</table>
</div>  