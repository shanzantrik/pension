
<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>

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
    <td><div align="left">The.........................<br>
                        ............................
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

	<!-- 	  <tr>
          <td colspan="3" >
          <div align="left">
          		<h4>Remark1: </h4>
				<?php $val['remark1'];?><br/>
                <h4>Remark2: </h4>
                <?php $val['remark2'];?><br/>
                <h4>Remark3: </h4>
                <?php $val['remark3'];?><br/>
                <h4>Remark4: </h4>
                <?php $val['remark4'];?><br/>
          </div></td>
		  </tr>
 -->         
           <?php
	  $r1=$val['remark1'];
	  $r2=$val['remark2'];
	  $r3=$val['remark3'];
	  $r4=$val['remark4'];
	  echo $r1;
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


    








