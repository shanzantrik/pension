<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
<thead>
  <tr>
    <th>File No</th>
    <th>Branch</th>
    <th>Member Name</th>
    <th>File Status</th>
    <th>File Received on</th>
  </tr>
</thead>
<tbody>
    <?php foreach ($records as $rec): ?>
        <tr>
            <td><?php echo $rec->file_no ?></td>
            <td><?php echo $rec->branch ?></td>
            <td><?php echo $rec->member_name ?></td>
            <td><?php echo $rec->file_status ?></td>
            <td><?php echo $rec->entry_time ?></td>
        </tr>
    <?php endforeach ?>
</tbody>
</table>
<script type="text/javascript">
  $(document).ready(function(){
      $("#example").dataTable();
  })
</script>
