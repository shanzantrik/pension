<label class="control-label" for="appendedInputButton">All Pension Files: &nbsp;<a href="<?php echo site_url('administrator/Export/index')?>"" class="btn">Export To Excel</a></label>

<?php if (empty($result)): ?>
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
	foreach ($result as $res) {
		?>

	    <tr>
	    	<td><?php echo $i;?></td>
		    <td><?php echo $res->file_no ?></td>
		    <td><?php echo $res->branch ?></td>
		    <td><?php echo $res->file_status ?></td>
		    <td><?php echo $res->entry_time ?></td>
		    <td><?php echo @$this->model_tracking->get_name('pen_members','member_code',$res->member_code,'member_name') ?></td>
	   </tr>
	<?php
	$i=$i+1;
	}
	 ?>
	</tbody>
	</table>
<?php endif ?>	
