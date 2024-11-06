<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('letter')"><i class="icon-white icon-print"></i>Print</button>
<div id="letter">
<?php 
    foreach ($values as $val) {
        $dept=$val->dept_name; 
        $dept_addr=$val->address;
        $dept_file_no=$val->file_no;
        $dept_frwrd_no=$val->dept_forw_no;
        $receipt_date=$val->receipt_date;
        
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
    <td width="10%"><div align="left">No:<?php echo $dept_file_no;?></div></td>
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
      <td colspan="2"><b>Checking of IPS under revised pay scales 1986/1997/2008</b></td>
    </tr>

      <tr>
      <td colspan="3"></td>
      </tr>

        <tr>
      <td><div align="left"><b>Ref-</b></div></td>
      <td colspan="2"><b>Your letter No <?php echo $dept_frwrd_no;?> dtd.<?php echo $receipt_date;?></b></td>
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
            
      
<?php
      $i=0; 
      $j=1;
     
     // $r2= $_POST['name']; 
      foreach ($values as $val)
{
$remark3 = $val->remark3;
$name = $val->name;
$designation = $val->designation;
$remark2=$val->remark2;
$remark4=$val->remark4;
$remark5=$val->remark5;
$remark6=$val->remarks6;
$remark7=$val->remarks7;
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


         if(!$name=='')
          {
            echo"<tr>";
            echo"<td width=16%></td>";
            echo"<td colspan=3><div align=left>$j. $name/$designation</div></td>";
            echo"</tr>";
          }

        if (!empty($_POST['earlier'][$i])) { 
         $r1= $_POST['earlier'][$i];
      /*  var_dump($r1);
        exit();*/
         
           if($r1==$remark2)
             
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r1</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['observation'][$i])) { 
        $r5= $_POST['observation'][$i];
        
         
           if($r5==$remark3)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r5</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['additional'][$i])) { 
         $r6= $_POST['additional'][$i];
        
         
           if($r6=$remark4)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r6</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['ips'][$i])) { 
         $r7= $_POST['ips'][$i];
        
         
           if($r7=$remark5)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r7</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['higher'][$i])) { 
         $r8= $_POST['higher'][$i];
        
         
           if($r8=$remark6)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r8</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['identical'][$i])) { 
         $r9= $_POST['identical'][$i];
        
         
           if($r9=$remark7)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r9</div></td>";
               echo"</tr>";
             }
          }

         if (!empty($_POST['pay_fixed'][$i])) { 
         $r10= $_POST['pay_fixed'][$i];
        
         
           if($r10=$remark8)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r10</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['stepping'][$i])) { 
         $r11= $_POST['stepping'][$i];
        
         
           if($r11=$remark9)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r11</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['time_bound'][$i])) { 
         $r12= $_POST['stepping'][$i];
        
         
           if($r12=$remark10)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r12</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['upgradation'][$i])) { 
         $r13= $_POST['upgradation'][$i];
        
         
           if($r13=$remark11)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r13</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['acps'][$i])) { 
         $r14= $_POST['acps'][$i];
        
         
           if($r14=$remark12)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r14</div></td>";
               echo"</tr>";
             }
          }
        
         if (!empty($_POST['macps'][$i])) { 
         $r15= $_POST['macps'][$i];
        
         
           if($r15=$remark13)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r15</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['family'][$i])) { 
         $r16= $_POST['family'][$i];
        
         
           if($r16=$remark14)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r16</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['suspension'][$i])) { 
         $r17= $_POST['suspension'][$i];
        
         
           if($r16=$remark15)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r17</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['break'][$i])) { 
         $r18= $_POST['break'][$i];
        
         
           if($r18=$remark16)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r18</div></td>";
               echo"</tr>";
             }
          }

         if (!empty($_POST['dies_non'][$i])) { 
         $r19= $_POST['dies_non'][$i];
        
         
           if($r19=$remark17)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r19</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['withholding'][$i])) { 
         $r20= $_POST['withholding'][$i];
        
         
           if($r20=$remark18)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r20</div></td>";
               echo"</tr>";
             }
          }

         if (!empty($_POST['eol'][$i])) { 
         $r21= $_POST['eol'][$i];
        
         
           if($r21=$remark19)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r21</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['increments'][$i])) { 
         $r22= $_POST['increments'][$i];
        
         
           if($r22=$remark20)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r22</div></td>";
               echo"</tr>";
             }
          }

        if (!empty($_POST['information'][$i])) { 
         $r23= $_POST['information'][$i];
        
         
           if($r23=$remark21)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r23</div></td>";
               echo"</tr>";
             }
          }

      if (!empty($_POST['last_pay'][$i])) { 
         $r24= $_POST['last_pay'][$i];
        
         
           if($r24=$remark22)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r24</div></td>";
               echo"</tr>";
             }
          }

      if (!empty($_POST['remarks'][$i])) { 
         $r25= $_POST['remarks'][$i];
        
         
           if($r25=$remark23)
             {
               echo"<tr>";
               echo"<td width=16%></td>";
               echo"<td colspan=3><div align=left> $r25</div></td>";
               echo"</tr>";
             }
          }
      
         $i++; 
        $j++;
        }
 
 
   

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
       <div style="text-align:right; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:12px"><strong>Assst,Audit Officer,</strong></br>
       <strong>for Director of Audit and  Pension</strong></br>
       <strong>Govt. of Arunachal Pradesh</strong></br>
       <div style="padding-right:30px"><strong>Naharlagun</strong></div>
</div></td>
          </tr>
</table>
</div>  