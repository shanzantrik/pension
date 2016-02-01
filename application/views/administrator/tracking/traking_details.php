<?php if (empty($records)): ?>
	<div class="alert alert-warning">File Not Found</div>
<?php else: ?>		
	<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
	<thead>
		<tr>
			
			<th>#</th>
			<th> File No</th>
			<th>Branch</th>
			<th>File Status</th>
			<th>Date & Time</th>
			<th>Member Name</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach ($records as $rec) {
		?>

	    <tr>
	    	<td><?php echo $i;?></td>
		    <td><?php echo $rec->file_no ?></td>
		    <td><?php echo $rec->branch ?></td>
		    <td><?php echo $rec->file_status ?></td>
		    <td><?php echo $rec->entry_time ?></td>
		    <td><?php echo @$this->model_tracking->get_name('pen_members','member_code',$rec->member_code,'member_name') ?></td>
	   </tr>
	<?php
	$i=$i+1;
	}
	 ?>
	</tbody>
	</table>
    
    
    <?php if (empty($reg)): ?>
	<div class="alert alert-warning">Not Generated Registration Number yet</div>
<?php else: 
//print_r($reg[0]->reg_no);
?>

    <table align="center">
    <tr><td>Registration  No</td>&nbsp;&nbsp;<td>Registration  Date</td></tr>
    <tr><td><?php echo $reg[0]->reg_no?></td><td><?php echo $reg[0]->reg_dt?></td></tr>
    </table>
    <?php endif ?>	
<?php endif ?>	
