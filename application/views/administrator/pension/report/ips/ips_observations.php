


<?php 
$re = $resu[0];
?>
<button style="float:right;" class="btn btn-info" onClick="javascript:printReport('print1');"><i class="icon-white icon-print"></i>Print</button>
<!-- <div id="letter"> -->
<div id="print1" style="width: 1000px; margin: 0px auto;">
    <div style="width:1000px; min-height:600px; font-size: 1.3em; color:#000000; background-color:#FFFFFF; line-height: 1.5em">

<!-- <div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF"> -->
 <table width="100%" border="0" align="center" cellpadding="3" id="report">
 <tr>
      <td colspan="3">
        <div align="left">
          <div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold;">
          <div style="font-family: initial; margin-left: 0px;">
          GOVERNMENT OF ARUNACHAL PRADESH</br>
          DIRECTORATE OF AUDIT & PENSION</br>
          NAHARLAGUN.
          </div>
          </div>
        </div>
      </td>
    </tr>

  <!--  <table width="100%" border="0" align="center" cellpadding="3" id="report"> -->
	 <tr>
		<td colspan="2" width="50%"><div align="left">No: DAP/IPS/1/97-99/<?php //echo $val['file_no'];?></div></td>
		<td><div align="right"><b>Dated Naharlagun the <?php echo date('d-m-Y')?></b></div></td>
	</tr>
   <tr style="height:40px;">
      <td colspan="3"></td>
    </tr>
		 <tr>
      <td colspan="3"><div align="left" style="margin-left:50px;">To,</div></td>
    </tr>

    <tr style="height:40px;">
    
    <td colspan="2">
    <table border="0" width="100%">
    <tr>
    <td width="20%"></td>
    <td>
    <div align="left">The<br/>
     <?php echo str_replace(",", ",<br />", $re->address_department); ?><br />
     <?php //echo $dept_addr;?>
     
   </div>
   </td>
   </tr>
   </table>
   </td>   
  
   <td></td>
   </tr>

    <tr style="height:40px;">
    <td colspan="3"></td>
    
    </tr>

    <!-- <tr></tr>
    <tr></tr>
    <tr></tr> -->


      <tr>
			<td colspan="3"></div></td>
		</tr>

	     <tr>
			<td width="10%" align="right" style="margin-left:50px;"><b>Sub:</b></div></td>
			<td colspan="2"><b>Checking of IPS under revised pay scales 1986/1997/2008/2016</b></td>
      
		</tr>

		  <tr>
			<td colspan="3"></td>
		  </tr>

		    <tr>
			<td><div align="right" style="margin-left:50px;"><b>Ref:</b></div></td>
			<td colspan="2"><b>Your letter No <?php echo $re->dept_forw_no; ?> dated <?php echo date('d-m-Y',strtotime($re->receipt_date)); ?></b></td>
		    </tr>
        <tr>
        <td><br/><br/></td>
        </tr>
		    <tr>
			<td colspan="3"><div align="left" style="margin-left:50px;">Sir,</div></td>
            </tr>
            <tr></tr>
            
            <tr>
            <td><div align="left"></div></td>
            <td colspan="3">Please refer your letter No. quoted above, the IPS along with Service Book of the officials has/have duly been checked and is/are returned for the following reasons.</td>
		    </tr>
  
            <tr>
			<td><div align="left"></div></td>
			<td colspan="2"><b>Name & Designation</b></td>
		    </tr>
        <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $re->pensionee_name;?>, Ex-<?php echo $re->designation;?></b></td>
        </tr>
          <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b>Observation:</b>
        <?php
        
        echo $re->remarks;
       ?>
   </td></tr> 
    

    <tr style="height:40px;">
    <td colspan="4"></td>   
  </tr>
            
      
		    

		   <tr style="height:40px;">
           <td colspan="3"></td>
	       </tr>
	       <tr>
 
			<td colspan="3"><div align="right" style=" margin-right:100px;">Yours faithfully</div></td>
		  </tr>


		    <tr>
            <td colspan="3">Enclose :- As stated</td>
	        </tr>

	        <tr>
           <tr>
            <td colspan="3"><br/></td>
          </tr>

          <tr>
	        <td colspan="3">
          <table border="0" width="100%">
          <tr>
          <td ></td>
          <td ></td>
          <td width="35%">
          <center>
          <!-- <td style="vertical-align: top; padding-top: 30px;"> -->
            <!-- <div style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px"> -->
            <!-- <div align=""> -->
            <strong>Asstt. Auditor</strong></br>
       <strong>for Director of Audit and Pension</strong></br>
       <strong>Govt. of Arunachal Pradesh,</strong></br>
       <div style="padding-right:30px"><strong>Naharlagun</strong><!-- </div> -->
        </div>
        </center>
        </td>
        </tr>
        </table>
        </td>
	        </tr>
</table>
</div>
</div>  