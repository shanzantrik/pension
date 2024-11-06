<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>

<p class="user-message"><i>(To Edit a Employee please Click on the <span style="color:red">Edit</span> Button)</i></p>
<a href="<?php echo site_url('administrator/employee/add');?>" class="open-dialog btn btn-primary" style="float:right"><i class="icon-plus"></i>Add Employee</a>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="employee-list-table" width="100%">
    <thead>
        <tr>
            <th width="10%">Name</th>
            <th width="10%">Designation</th>
            <th width="15">Date of Joining</th>
            <th width="15">Date of Retirement</th>
            <th width="10%">Total Pay</th>
			<th width="12%">Account No</th>
			<th width="10%">Photo</th>
			<th width="20%">Actions</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['id']; ?>">
	            <td><?php echo $list['name']; ?></td>
	            <td><?php echo getDesignation($list['designation']); ?></td>
	            <td><?php echo dateTimeToDate($list['doj']); ?></td>
	            <td><?php echo dateTimeToDate($list['dor']); ?></td>
	            <td><?php echo $list['total_pay']; ?></td>  
	            <td><?php echo $list['account_no']; ?></td>
	            <td><?php echo ($list["photograph"]!="") ? '<img src="'.base_url('uploads/employee/'.$list["photograph"]).'" height="68">' : ''; ?></td>
				<td>
					<a href="<?php echo site_url('administrator/employee/view/'.$list['id']); ?>" id="view" class="btn"><i class="icon-eye-open"></i> View Profile</a>
					<a href="<?php echo site_url('administrator/employee/edit/'.$list['id']); ?>" id="edit" class="btn btn-success btn-rad"><i class="icon-pencil"></i> Edit</a>
	            </td>                   	            
	        </tr>
    	<?php } ?>
    </tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		$('#employee-list-table').dataTable();
	});
</script>
<style type="text/css">
	img{-webkit-border-radius: 5px 5px;-moz-border-radius: 5px / 5px;border-radius: 5px / 5px;}
</style>