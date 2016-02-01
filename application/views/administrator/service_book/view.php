<style type="text/css">
    .dataTables_wrapper {margin-top: 10px;}
    .link {float: left; margin-right: 3px;}
    .multiselect-container {margin-left: 0px!important;}
    .action-list {float: left;width: 150px;}
</style>
<h3>Service Book</h3><hr style="margin: 5px 0;"/>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="20%">File No</th>
            <th width="20%">Pensioner Name</th>
            <th width="30%">Class of Pension</th>
            <th width="30%">Actions</th>                 
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr>
	            <td><?php echo $list['case_no'];?></td>
	            <td><?php echo $list['name'];?></td>
	            <td><?php echo str_replace("_", " ", $list['class_of_pension']);?></td>
				<td>
                    <a href="<?php echo site_url('/administrator/pension/'.strtolower($list['class_of_pension']).'/'.$list['serial_no'])?>" class="btn btn-default btn-rad link" data-id="<?php echo $list['serial_no']; ?>"><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                    <a href="<?php echo site_url('/administrator/service_book/edit/'.$list['serial_no']); ?>" class="btn btn-default btn-rad link" data-id="<?php echo $list['serial_no']; ?>"><i class="icon-pencil"></i> Edit</a><?php echo nbs(3); ?>
                    <select class="action-list">
                        <option value="0">--Select Report--</option>
                        <option value="<?php echo site_url('/administrator/report/'.strtolower($list['class_of_pension']).'/'.$list['serial_no'])?>">Worksheet</option>
                        <!-- <option value="<?php echo site_url('/administrator/disburser/'.strtolower($list['class_of_pension']).'/'.$list['serial_no']); ?>">Disburser</option> -->
                        <option value="<?php echo site_url('/administrator/service_book/reportIO/'.strtolower($list['class_of_pension']).'/'.$list['serial_no']); ?>">Report</option>
                    </select>
                </td>
	        </tr>
    	<?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
        $('.multiselect').multiselect();

        $('.action-list').live('change', function(){
            var url = $(this).val();
            if(url!=0) window.location.href=url;
        });
    });
</script>
