<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Return Form</title>
</head>
<body>
 

	<div id="print1" style="width: 900px; margin: 0px auto;">
		<div style="text-align:center; padding-top:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
	    	<div style="font-weight: bold; text-align: center;">
	    		<p>GOVERNMENT OF ARUNACHAL PRADESH</p>            
	    		<p>DIRECTORATE OF AUDIT & PENSION </p>
	    		<p> NAHARLAGUN </p>
	    	</div>
	    </div>
		<table width="100%" border="0" cellpadding="2" id="report">
     		<tr>
				<td colspan="3"><div align="left">No. DA/GIS/86/<strong></strong></div></td>
	    		<td><div align="right"> <strong>Dated Naharlagun</strong>: <?php echo date('d/m/Y')?></div></td>
			</tr>
			<tr>
				<td width="7%"><div align="left">To,</div></td>
			</tr>
            <tr>
				<td width="7%"><div align="left">The</div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Sub:- <u>Claims under UTGEGIS ‘84’ –Returning of.</u></div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left">Ref:-  Your Letter No ______________________</div></td>
			</tr>            
			<tr>
				<td><div align="left">Sir, </div></td>
			</tr>
			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6); ?>The Service Book along with UTGEGIS ‘84’ claims in respect of Sri/Smti/___ is returned herewith for want of the information/documents (tick marked) as per the Government of India Ministry of Home Affairs, New Delhi’s letter No. U 14046/2/81/UTS dated 24-04-08 as amended from time to time.
            </div></td>
			</tr>
			                <?php $old=array(); 
                             $val=$values[0];
                             $objection=unserialize($val['objection']);
                             ?>
                             
                        <?php foreach ($obj as $value){
                        $old[$value['s_no']] = $value['desc'];
                        }
                        ?>

                            <?php
                                $new = array();
                                for($i=0; $i<count($objection); $i++) {
                                    array_push($new, $objection[$i]['objection']);
                                }
                               //print_r($new);
                               //exit();
                            ?>
                               <?php $i=1;
                               foreach ($old as $key => $value) { ?>
                                    <?php if(in_array($key, $new)) { ?>
                                        <tr><td colspan="5"><?php echo $i.".". $value;?></tr></td>
                                       <?php } $i++;}
                                       ?>
			<tr>
				<td colspan="5"><div align="left"><?php echo nbs(6);?>11.Miscellaneous:-<br/>
Kindly attend to the shortcomings in the claim as listed above and resubmit for early settlement.

</div></td>
			</tr>            
            
			<tr>
				<td colspan="5"><div align="right">Yours Faithfully,<br/><br/>Jt. Director of Audit & Pension<br/>Government of Arunachal Pradesh<br/>Naharlagun</div></td>
			</tr>                                   

     		<tr>
				<td colspan="3"><div align="left">Copy to:-</div></td>	    		
			</tr>            
			<tr>
			  <td colspan="5"><div align="left">Shri/Smti ________________ . </div></td>
			</tr>
			<tr>
			  <td colspan="5"><div align="left">for  information.</div></td>
			</tr>            
			<tr>
				<td colspan="5"><div align="right">Joint Director of Audit & Pension<br/>Government of Arunachal Pradesh<br/>Naharlagun</div></td>
			</tr>            
		</table>
	</div>
</div>


</body>

</html>
