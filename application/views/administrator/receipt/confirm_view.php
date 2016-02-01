<?php 
foreach ($records as $key) {
	$dfno=$key->dfno;
	$dept=$key->branch_name;
	$receipt_date=$key->receipt_date;
	$subject=$key->subject;
	$address=$key->address_department;
	$district=$key->district;
}
?>
<button style="float:right" class="btn btn-success" onclick="print_div()"><i class="icon-white icon-print"></i>Print Acknowledgement Report</button>
<button style="float:left" class="btn btn-primary" onclick="print2()"><i class="icon-white icon-print"></i>Print Department Clearance</button>
<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
  <tbody role="alert" aria-live="polite" aria-relevant="all">
    <tr>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Dept Forwarding No.</label></td>
      <td><?php echo $dfno; ?></td>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Department</label></td>
      <td><?php echo $dept; ?></td>                                        
    </tr>
    <tr>
        <td><label style="font-weight:bold" class="col-sm-3 control-label">Receipt Date</label></td>
        <td style=""><?php echo $receipt_date; ?></td>
        <td><label style="font-weight:bold" class="col-sm-3 control-label">District</label></td>
    	<td><?php echo getDistrictById($district); ?></td>
    </tr>
    <tr>
    	<td><label style="font-weight:bold" class="col-sm-3 control-label">Address of the Department</label></td>
    	<td><?php echo $address; ?></td>
    	<td><label style="font-weight:bold" class="col-sm-3 control-label">Subject</label></td>
        <td><?php echo $subject; ?></td>
    </tr>
  </tbody>
</table>

<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
<thead>
	<tr>
		<th>Srl No</th>
		<!-- <th>Generated File No</th> -->
        <th>Token No.</th>
		<th>Employee Code</th>
        <th>Forwarded To</th>
		<th>Designation</th>
		<th>Employee Name</th>
        <th>View Documents</th>
        <th>Print</th>
	</tr>
</thead>
<tbody>
<?php 
$file22=$file;
foreach ($file as $rec) { ?>
    <tr>
    	<td><?php echo $rec->srl_No ?></td>
	    <!-- <td><?php echo $rec->auto_file_no ?></td> -->
        <td>
            <?php
                $tn = $this->model_receipt->getTokenNo($rec->file_No);
                echo $tn[0]->token_no;
            ?>
        </td>
	    <td><?php echo $rec->emp_code ?></td>
        <td><?php echo getBranchName($rec->branch_code); ?></td>
	    <td><?php echo $rec->designation ?></td>
	    <td><?php echo $rec->salutation.'. ';echo $rec->pensionee_name; ?></td>
	    <td>
        <?php 
         // $x=explode('/',$rec->file_No); 
		  $x=$rec->file_No;
         // $file=$x[0].'-'.$x[1];
        ?>
        <a href="<?php echo site_url('administrator/receipt/file_view').'/'.base64_encode($x);?>" target="_blank" class="btn btn-success"><i class="icon-file"></i></a>
      </td>
      <td><a href="<?php echo site_url('administrator/receipt/print_challan').'/'.base64_encode($x);?>" target="_blank" class="btn btn-success"><i class="icon-file"></i></a></td>
   </tr>
<?php
}
 ?>
</tbody>
</table>
<script type="text/javascript">
   $(document).ready(function() {
        var oTable=$('#dataTable').dataTable();
      });
</script>
<script>
	function print_div() {
		var printContents = document.getElementById('print').innerHTML;     
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;      
		window.print();      
		document.body.innerHTML = originalContents;
   }
   function print2() {
    var printContents = document.getElementById('print2').innerHTML;     
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;      
    window.print();      
    document.body.innerHTML = originalContents;
   }
</script>
<!-- ################## PRINT DIV ################################# -->
<div id="print" style="display:none">
<div align="" style="width:800px; height:900px;color:#000000">
<table width="100%">
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="57%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong><h4>GOVERNMENT OF ARUNACHAL PRADESH</h4></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong>DIRECTORATE OF AUDIT &amp; PENSION</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong>NAHARLAGUN</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td>
  		<hr>
  	</td>
  	<td>
  		<hr>
  	</td>
  	<td>
  		<hr>
  	</td>

  </tr>
</table>
<table width="100%" >
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="54%">No. <?php echo $dfno ?></td>
    <td width="12%">Date:</td>
    <td width="25%"><?php  echo date('d/m/Y'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Place:</td>
    <td>Naharlagun,Arunachal Pradesh</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>To,</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" height="113">
      <tr>
        <td>
        <div style="width:100%; height:113px"><?php echo $address ?></div>
        </td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><b>Sub:-</b> <?php echo $subject ?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><b>Ref:-</b> <?php echo $dfno." "."Dated ".date('d-M/Y')  ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Sir,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">
    	<p>
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to above Audit Report, I am to request you to furnish para wise reply to those Directorate, for early settlement.
        </p>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please acknowledge receipt of this letter.</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="42%">&nbsp;</td>
    <td width="49%" align="center">Your faithfully</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">(T.Tatung)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Finance &amp; Accounts Officer</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">For Director of Audit &amp; Pension</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Government of Arunachal Pradesh</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Naharlagun</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Memo No: <?php echo $dfno ?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Copy to:-</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">1. The Deputy Comissioner,<?php echo $district ?>. District.<?php echo $district ?> for Information</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">2. The Director of Rural Development, Govt. of Arunachal Pradesh Itanagar for Information</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">3. The AAO/AA O/o the Deputy Commissioner,<?php echo $district ?>  for Information</td> 
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">4. Office Copy.</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="33%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
    <td width="49%" align="center">(T.Tatung)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Finance &amp; Accounts Officer</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">For Director of Audit &amp; Pension</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Government of Arunachal Pradesh</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Naharlagun</td>
  </tr>
</table>



</div>
</div>
<div id="print2" style="display:none">
<div align="" style="width:800px; height:900px;color:#000000">
<table width="100%">
  <tr>
    <td width="23%">&nbsp;</td>
    <td width="57%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong><h4>GOVERNMENT OF ARUNACHAL PRADESH</h4></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong>DIRECTORATE OF AUDIT &amp; PENSION</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong>NAHARLAGUN</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">Department Clearance Report</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <hr>
    </td>
    <td>
      <hr>
    </td>
    <td>
      <hr>
    </td>

  </tr>
</table>
<table width="100%" >
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="54%"></td>
    <td width="12%">Date:</td>
    <td width="25%"><?php  echo date('d/m/Y'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Place:</td>
    <td>Naharlagun,Arunachal Pradesh</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" height="113">
      <tr>
        <td>
          <div style="width:100%; height:113px">
      <table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
  <tbody role="alert" aria-live="polite" aria-relevant="all">
    <tr>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Dept Forwarding No.</label></td>
      <td><?php echo $dfno; ?></td>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Department</label></td>
      <td><?php echo $dept; ?></td>                                        
    </tr>
    <tr>
        <td><label style="font-weight:bold" class="col-sm-3 control-label">Receipt Date</label></td>
        <td style=""><?php echo $receipt_date; ?></td>
        <td><label style="font-weight:bold" class="col-sm-3 control-label">District</label></td>
      <td><?php echo getDistrictById($district); ?></td>
    </tr>
    <tr>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Address of the Department</label></td>
      <td><?php echo $address; ?></td>
      <td><label style="font-weight:bold" class="col-sm-3 control-label">Subject</label></td>
        <td><?php echo $subject; ?></td>
    </tr>
  </tbody>
</table>
          </div>
          </td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4">
            <table style="color:#000;margin-top:30px" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
            <thead>
              <tr>
                
                <th>Srl No</th>
                <!-- <th>Generated File No</th> -->
                <th>Token No.</th>
                <th>Employee Code</th>
                <!-- <th>File No</th> -->
                <th>Designation</th>
                <th>Employee Name</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($file22 as $rec) { ?>
                    <tr>
                        <td><?php echo $rec->srl_No ?></td>
                        <!-- <td><?php echo $rec->auto_file_no ?></td> -->
                        <td>
                            <?php
                                $tn = $this->model_receipt->getTokenNo($rec->file_No);
                                echo $tn[0]->token_no;
                            ?>
                        </td>
                        <td><?php echo $rec->emp_code ?></td>
                        <!-- <td><?php echo $rec->file_No ?></td> -->
                        <td><?php echo $rec->designation ?></td>
                        <td><?php echo $rec->salutation.'. ';echo $rec->pensionee_name; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
    </td>
  </tr>
  </table>
<table width="100%" border="0">
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="42%">&nbsp;</td>
    <td width="49%" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">&nbsp;</td> 
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:60px">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td width="33%">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</div>
</div>