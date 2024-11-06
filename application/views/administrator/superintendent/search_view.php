<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
<thead>
	<tr>
		<th>Auto Generated File No.</th>
		<th>Token No</th>
		<!-- <th>File No</th> -->
		<th>Dept Forwarding No</th>
		<th>Employee Code</th>
		<th>Employee Name</th>
        <th>Receipt Date</th>
		<th>Status</th>
	</tr>
</thead>
<tbody>
<?php foreach ($records as $rec) { ?>
    <tr>
        <td><?php echo $rec->auto_file_no; ?></td>
	    <td><?php echo $rec->token_no; ?></td>
	    <!-- <td><?php echo $rec->file_No; ?></td> -->
	    <td><?php echo $rec->dept_forw_no; ?></td>
	    <td><?php echo $rec->emp_code; ?></td>
	    <td><?php echo $rec->pensionee_name; ?></td>
	    <td><?php echo dateTimeToDate($rec->receipt_date, 'd-m-Y'); ?></td>
        <td>
            <?php 
                if ($this->model_superandant->is_terminated($rec->file_No)=='terminated') {
                    echo "<span style='background-color:#EEE;color:green;font-weight:bold'>Process Completed</span>";
                }else{
                    echo "<span style='background-color:#EEE;color:red;font-weight:bold'>On Process</span>";
                }
            ?>
        </td>
   </tr>
<?php
}
 ?>
</tbody>
</table>
<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forward To Dealing Assistant </h4>
            </div>
            <div class="modal-body">
            <label>Dealing Assistance</label>
                <select name="da">
                	<?php foreach ($da as $d) {
                		echo "<option value=".$d->member_code.">".$d->member_name."</option>";
                	} ?>
                </select>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <!-- <a href="#" class="btn btn-danger" id="del">Forward</a> -->
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
<script>
	$(document).on("click", ".open-dialog", function () {
 		var member_typeId = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/member/member_type/del/" + member_typeId);
	});
    $(document).ready(function() {
        $('#example').dataTable();
    });
</script>