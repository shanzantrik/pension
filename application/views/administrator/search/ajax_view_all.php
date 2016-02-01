<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
  <thead>
  <tr>
      <th width="2%">#</th>
      <th width="5%">File No</th>
       <th width="5%">Dept</th>
      <th width="5%">Emp Code</th>
      <th width="10%">Name</th>
      <th width="10%">File Status</th>  
  </tr>
  </thead>
  <tbody>
   <?php $i=1;
   //print_r($records);
   //exit();?>
  <?php foreach($records as $key):?>
    <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $key->file_No;?></td>
    <td><?php echo $key->dept_forw_no;?></td>
    <td><?php echo $key->emp_code;?></td>
    <td><?php echo $key->pensionee_name.'=>'.$key->designation;?></td>
     <td><?php echo $key->file_status;?></td>

    </tr>
    <?php $i=$i+1;?>
  <?php endforeach ?>
  </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataTable').dataTable();
    });
</script>