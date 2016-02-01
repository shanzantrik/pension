<div id="form1" style="display: block;">
	<button style="float:right;" class="btn btn-info" onclick="javascript:printReport('print1')"><i class="icon-white icon-print"></i>Print</button>
	<div id="print1" style="width: 1000px; margin: 0px auto;">
		<div style="width:1000px; min-height:600px; font-size: 1.0em; color:#000000; background-color:#FFFFFF; line-height: 1.4em">
			<table width="100%" cellpadding="3" id="report" border="0">
				<tr>
					<td style="vertical-align: top;" colspan="3">
						<div id="heading" style="text-align:center; padding:10px; font:Arial, Helvetica, sans-serif; font-size:16px">
					        <div style="font-family: initial; margin-left: 200px;">GOVERNMENT OF ARUNACHAL PRADESH<br/>DIRECTORATE OF AUDIT & PENSION<br/><u>NAHARLAGUN</u>.</div>
					    </div>
					</td>
					<td></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">
						No. <br/>To<br/><b></b>
					</td>
					<td style="vertical-align: top;" colspan="3">Dated <?php echo date('d/m/Y')?> </td>		
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="3"><?php echo nbs(15); ?> The
						
					</td>
						
				</tr>
				<tr>
					<td style="vertical-align: middle;" colspan="2"><?php echo nbs(20); ?>Sub:                   Transfer of pension documents.</td></tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="3">Sir,</td>
					<td style="vertical-align: top;" colspan="3"></td>
				</tr>
			 	<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(30); ?>I am to forward herewith the PPO No. Pen/AP/ ...........................................................................................&nbsp;</td>

				</tr>
				<tr>
				<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(30); ?>both halves with the enclosures in respect of Shri/Smti................................................................................. &nbsp;</td>
				</tr>
				<tr>
				<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(30); ?>........................................................................................... to draw his/her monthly pension/family pension</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(30); ?>From................................................................................................................................................................ &nbsp;

				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(50); ?>The pensioner has been paid up to .....................................................................................at the&nbsp;</td>

				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(30); ?>following rate by the Treasury/Sub-Treasury ...............................................................arunachal Pradesh&nbsp;</td>

				</tr>	
					
			 	<tr>
					<td style="vertical-align: top;" colspan="2">
					<pre style="padding: 0px;margin: 10px 0 0 0;font-family: 'Ubuntu', Tahoma, sans-serif; font-size: 1.0em; line-height: 1.4em;background-color: #fff!important;border: none;-webkit-border-radius: none;-moz-border-radius: none;border-radius: none;">
		            1.Basic pension     				@ Rs.................... <b></b>
		            2. Reduced pension 		        @ Rs.................... <b></b>
		            3. Dearness Relief    		        @ Rs.................... <b></b>
		            4. Medical Allowance 		        @ Rs.................... <b></b>
		            5. Family Pension 	
		                   a. Normal Rate    		        @ Rs.................... <b></b>
		                   b. Enhance Rate 		        @ Rs.................... <b></b>	       
		
						</pre>
					</td>
					<td style="vertical-align: top;" colspan="3" style="text-align:left;"></td>
				</tr>
		        <tr>
					<td style="vertical-align: top;" colspan="4" align="left"><?php echo nbs(18); ?>You are requested to take further necessary action from your end at early dote.</td>

				</tr>
				<tr>
					<td style="vertical-align: top; "></td>
					<td style="vertical-align: top; text-align:center" colspan="3">Yours faithfully,</td>
				</tr>	
				<tr>
					<td></td>
					
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="1">Memo No - </td>
					<td style="vertical-align: top;text-align:center;" colspan="3">Dated <?php echo date('d/m/Y')?> </td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">1.	The Treasury Officer/Sub-Treasury...................... <br />
						 <b></b><br /><br />
						
						With reference to his letter No.......
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" colspan="4">2.	Shri/Smti.................. <br />
						 <b></b><br />
						Vill	<br/>
                        Dist.:- <br/>

                        State:- <br />
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php
function nbs($multiplier)
{
	return str_repeat("&nbsp;", $multiplier);
}