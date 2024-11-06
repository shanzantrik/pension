<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
<?php 
    foreach ($values as $val) {
     // var_dump($val);
        $fno=$val->file_no; 
        $name=$val->name; 
          $designation=$val->designation; 
        $title=$val->title;
        $remarks=$val->remarks;
        $remark2=$val->remark2;
        $remark3=$val->remark3;
        $remark4=$val->remark4;
        $remark5=$val->remark5;
        $remarks6=$val->remarks6;
        $remarks7=$val->remarks7;
        $remark8=$val->remarks8;
        $remark9=$val->remarks9;
$remark10=$val->remarks10;
$remark11=$val->remarks11;
$remark12=$val->remarks12;
$remark13=$val->remarks13;
$remark14=$val->remarks14;
$remark15=$val->remarks15;
$remark16=$val->remarks16;
$remark17=$val->remarks17;
$remark18=$val->remarks18;
$remark19=$val->remarks19;
$remark20=$val->remarks20;
$remark21=$val->remarks21;
$remark22=$val->remarks22;
$remark23=$val->remarks23;

       
        
    }
       
       
?>


<?php //var_dump($values) ?>
<div id="print" style="width:1000px; min-height:600px; color:#000000; background-color:#FFFFFF">

    <div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px">
    <u> <strong>OFFICE OF THE</strong></br>
       <strong>DIRECTOR OF AUDIT & PENSION </strong></br>
       <strong>GOVERNMENT OF ARUNACHAL PRADESH</strong></br>
       <strong>NAHARLAGUN</strong>
    </u>
    </div>
   
   <table width="60%" border="0" align="center" cellpadding="2" id="report">
   <tr>
    <td width="10%"><div align="left">No:<?php echo $fno;?></div></td>
    <td width="10%"></td>
    <td><div align="right"><b>Dated Naharlagun the......</b></div></td>
  </tr>
    <tr>
      <td colspan="3"><div align="left">To,</div></td>
    </tr>

    <tr style="height:40px;">
    <td></td>
    <td colspan="2"><div align="left">The<br><br><br>
    
   </div></td>   
  </tr>


         <tr>
      <td colspan="3"></div></td>
    </tr>

       <tr>
      <td ><div align="left"><b>Sub-</b></div></td>
      <td colspan="2"><b><?php echo $title;?></b></td>
    </tr>

      <tr>
      <td colspan="3"></td>
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
            
    
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $name;?>--<?php echo $designation;?></b></td>
        </tr>
        <tr>
           <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remarks;?></b></td>
        </tr>
            <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remark2;?></b></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remark3;?></b></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remark4;?></b></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark5;?></td>
        </tr><tr>
        <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remarks6;?></b></td>
        </tr>
      <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><b><?php echo $remarks7;?></b></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark8;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark9;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark10;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark11;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark12;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark13;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark14;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark15;?></td>
        </tr>
        <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark16;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark17;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark18;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark19;?></td>
        </tr>
        <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark20;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark21;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark22;?></td>
        </tr>
         <tr>
      <td><div align="left"></div></td>
      <td colspan="2"><?php echo $remark23;?></td>
        </tr>
       


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
       <div style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px"><strong>Assst,Audit Officer,</strong></br>
       <strong>for Director of Audit and  Pension</strong></br>
       <strong>Govt. of Arunachal Pradesh</strong></br>
       <div style="padding-right:30px"><strong>Naharlagun</strong></div>
</div></td>
          </tr>
</table>
</div>  