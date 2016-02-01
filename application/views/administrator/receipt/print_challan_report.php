<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print')"><i class="icon-white icon-print"></i>Print</button>
<?php 
//$val=$values[0];
//$token_no=$values['token_no'];
$dept=$values1[0]['dept_forw_no'];
$today=date('d/m/Y');
?>
<div id="print" align="center">
<table border="1">
<tr><td>

<table>
<tr><td><b>Dept::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $dept;?></td></tr>
</br>
<tr><td><b>Token::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $token_no;?></td></tr>
</br>
<tr><td><b>Date::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $today;?></td></tr>
</br>
</table>

</td><td>

<table>
<tr><td><b>Dept::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $dept;?></td></tr>
</br>
<tr><td><b>Token::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $token_no;?></td></tr>
</br>
<tr><td><b>Date::</b></td><td>&nbsp;&nbsp;</td><td><?php echo $today;?></td></tr>
</br>
</table>

</td></tr>


</table>

</div>
