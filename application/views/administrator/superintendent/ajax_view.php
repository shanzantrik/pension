<form method="post" action="<?php echo site_url('administrator/superintendent/save_frwd') ?>">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<tr>
		<th>#</th>
        <th>Generated File No</th>
		<th>Token No</th>
        <th>Branch</th>
		<th>File No</th>
		<th>Dept Forwarding No</th>
		<th>Employee Code</th>
		<th>Employee Name</th>
        <th>Receipt Date</th>
	</tr>
</thead>
<tbody>
<?php 
foreach ($records as $rec) {
	?>
    <tr>
    	<td><input class="checkbox1" type="checkbox" name="chk[]"  value="<?php echo $rec->file_No ?>">
    	<input type="hidden" name="fileno[]" value="<?php echo $rec->file_No ?>">
    	</td>
        <th><?php echo $rec->auto_file_no ?></th>
	    <td><?php echo $rec->token_no ?></td>
        <td><?php echo getBranch($rec->bc); ?></td>
	    <td><?php echo $rec->file_No ?></td>
	    <td><?php echo $rec->dept_forw_no ?></td>
	    <td><?php echo $rec->emp_code ?></td>
	    <td><?php echo $rec->pensionee_name ?></td>
        <td><?php echo $rec->receipt_date ?></td>
   </tr>
<?php
}
 ?>
</tbody>
</table>
<?php function getBranch($bc){
    $q=mysql_query("SELECT * from  master_branch where Branch_Code=$bc");
    $row=mysql_fetch_array($q);
    return $row['Branch_Name'];
} ?>
<br/>
<input type="checkbox" id="selecctall"/> Select All<br/>
<br/>
<a href="#forwrd" class="open-dialog btn btn-success btn-rad" data-toggle="modal" data-id="<?php  echo $rec->token_no; ?>"><i class=""></i>Forward</a>
<div id="forwrd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Marking Superintendent </h4>
            </div>
            <div class="modal-body">
                Are You Sure want to forward these files.
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</form>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>