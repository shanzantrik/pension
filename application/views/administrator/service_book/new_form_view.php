<h1>Service Book</h1><hr style="margin: 5px 0;"/>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="10%">File No</th>
            <th width="20%">Pensioner Name</th>
            <th width="30%">Class of Pension</th>   
            <th width="20%">Employee Type</th>
            <th width="20%">Actions</th>                 
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr>
	            <td><?php echo $list['case_no']; ?></td>
	            <td><?php echo $list['name']; ?></td>
	            <td><?php echo str_replace("_", " ", $list['cop_id']); ?></td>
	            <td><?php echo str_replace("_", " ", $list['sex']); ?></td>   
				<td><a href="<?php echo site_url('/administrator/service_book/edit/'.$list['service_no'])?>" class="open-dialog-edit btn btn-default btn-rad" data-id="<?php echo $list['service_no']; ?>"><i class="icon-pencil"></i> Edit</a><?php echo nbs(3); ?><a href="<?php echo site_url('/administrator/pension/'.strtolower($list['class_of_pension']).'/'.$list['File_No'])?>" class="btn btn-default btn-rad" data-id="<?php echo $list['service_no']; ?>"><i class="icon-eye-open"></i> View</a></td>
	        </tr>
    	<?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
    });
</script>