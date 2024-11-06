<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php 
if(isset($status) != 1) :?>
<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print Letter</button>
<?php endif; ?>

<?php $val=$values[0];
 $dept_code=$val['department'];
 $dept_name=getDepartmentName($dept_code);
 //$r1=$val['remark1'];
?>
<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">
    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px">
    <u><strong><OFFICE OF THE</strong></br>
       <strong>DIRECTOR OF AUDIT & PENSION </strong></br>
       <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
       <strong>NAHARLAGUN</strong>
    </u>
    </div>
    <table width="100%" border="0" cellpadding="2" id="report">
   	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">1.Name</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $val['name'];?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">2.Designation</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $val['designation'];?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">3.Department</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $dept_name;?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">4.Date of birth</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $val['dob'];?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">5.Date of retirement on superannuation/<br>Voluntary/death</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $val['dor'];?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
	<tr><td width="16%"></td><td colspan="3">6.Scale of</td></tr>
	 <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">&nbsp;&nbsp;i)Pre-revised</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo getPayScaleById($val['pre_revised']);?></b></td>
	</tr>
	<tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">&nbsp;&nbsp;i)Revised</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo getPayScaleById($val['revised']);?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
      <tr>
        <td width="16%"></td>
		<td width="26%"><div align="left">7.Existing Basic pay on 1st january 2006</div></td>
		<td width="33%"></td>
		<td><b> :-<?php echo $val['exist_bp'];?></b></td>
	</tr>
	<tr><td colspan="4"></td></tr>
      <tr>
        <td width="16%"></td>
		<td colspan="3"><div align="left">8.Pay fixed of <b>Rs.<?php echo $val['pay_fixed'];?></b> with effect from&nbsp;&nbsp;<b><?php echo $val['effect_from'];?></b>&nbsp;&nbsp;with DNI on&nbsp;&nbsp;<b><?php echo $val['dni_on'];?></b></div></td>
	 </tr>
	 <tr><td colspan="4"></td></tr>
	 

       <?php
    
    $r5=$val['remark5'];
   
      
      
        if(!$r5=='')
      {
      echo"<tr>";
      echo"<td width=16%></td>";
      echo"<td colspan=3><div align=left>* $r5</div></td>";
      echo"</tr>";
      }
     
    ?>
    

    <tr style="height:40px;">
    <td colspan="4"></td>   
	</tr>
	
	<tr>
     
	<td colspan="2"><div align="left" style="font-size:10px"><b>Assistant Audit Officer/Assistant Auditor</b></div></td>
     <td colspan="2">
     <div style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:10px">
    <u> <strong>Finance and Accounts Officer </strong></br>
        <strong>For Directorate of Audit & Pension</strong></br>
       <strong>Government Of Arunachal Pradesh</strong></br>
       <div style="padding-right:10%"><strong>Naharlagun</strong></div>
    </u>
    </div>

      </td>   
	</tr>
</table>
   </div>

<div style="display:none" id="letter">
<?php $val=$values[0];
 $dept_code=$val['department'];
 $dept_name=getDepartmentName($dept_code);
 //$r1=$val['remark1'];
?>


<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">

    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px">
    <u> <strong>OFFICE OF THE</strong></br>
       <strong>DIRECTOR OF AUDIT & PENSION </strong></br>
       <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
       <strong>NAHARLAGUN</strong>
    </u>
    </div>
   
   <table width="80%" border="0" align="center" cellpadding="2" id="report">
	 <tr>
		<td width="10%"><div align="left">No</div></td>
		<td width="40%"></td>
		<td><div align="right"><b>Dated Naharlagun the......</b></div></td>
	</tr>
		<tr>
			<td ><div align="left">To,</div></td>
		</tr>

    <tr style="height:40px;">
    <td></td>
    <td><div align="left">The<br>
     <?php echo $dept_name;?>
   </div></td>   
	</tr>


         <tr>
			<td colspan="3"></div></td>
		</tr>

	     <tr>
			<td ><div align="left">Sub-</div></td>
			<td colspan="2">Refixation and regulation of pay on granting Financial Up-gradations
			under ACP's/MACPs</td>
		</tr>

		  <tr>
			<td colspan="3"></td>
		  </tr>

		    <tr>
			<td ><div align="left">Ref-</div></td>
			<td colspan="2">Your letter No..................................................................Dated.........</td>
		    </tr>

		    <tr>
			<td colspan=""><div align="left">Sir,</div></td>
		    </tr>

		 <!--  <tr>
          <td colspan="3" >
          <div align="left">
          		<h4>Remark1: </h4>
				<?php echo $r1; ?><br/>
                <h4>Remark2: </h4>
                <?php echo $r2;?><br/>
                <h4>Remark3: </h4>
                <?php echo $r3;;?><br/>
                <h4>Remark4: </h4>
                <?php echo $r4;;?><br/>
          </div></td>
		  </tr> -->
		    <?php
	  $r1=$val['remark1'];
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
         


		   <tr style="height:40px;">
           <td colspan="3"></td>
	       </tr>
	       <tr>
			<td colspan="3"><div align="right">Yours faithfully</div></td>
		  </tr>


		    <tr style="height:40px;">
            <td colspan="3"></td>
	        </tr>

	        <tr>
	        <td colspan="3"><div   style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px"><strong>Assst,Audit Officer,</strong></br>
       <strong>For Director of Audit and  Pension</strong></br>
       <strong>Govt. of Arunachal Pradesh</strong></br>
       <strong>Naharlagun</strong>
</div></td>
	        </tr>


    <tr>
		<td width="10%"><div align="left">Memo No</div></td>
		<td width="40%"></td>
		<td><div align="right"><b>Dated Naharlagun......</b></div></td>
	</tr>

	 <tr>
		<td width="10%"><div align="left">Copy To</div></td>
			</tr>

		<tr>
		<td colspan="3"><div align="left">1.Person Concerned with Shri/Smti...........................................for information</div></td>
		</tr>


		<tr>
		<td colspan="3"><div align="left">2.Officer copy</div></td>
		</tr>

	







  

</table>
</div>

</div>

    








