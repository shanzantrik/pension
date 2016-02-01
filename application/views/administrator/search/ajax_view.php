<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
  <thead>
  <tr>
      <th width="2%">#</th>
      <!-- <th width="20%">File No</th> -->
      <th width="12%">Employee Code</th>
      <th width="13%">Department Forwarding No</th>
      <th width="25%">Name</th>
      <th width="15%">Designation</th>
      <th width="33%" style="padding:0px">
      	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="inside-table">
        	<tr><th colspan="2">File Status</th></tr>
            <tr><th width="50%">Received</th><th width="50%">Forwarded</th></tr>
        </table>
      </th>
  </tr>
  </thead>
  <tbody>
  <?php $i=1; ?>
  <?php foreach ($records[0] as $key): ?>
    <tr>
      <td><?php echo $i; ?></td>
      <!-- <td><?php echo $key->file_no; ?></td> -->
      <td><?php echo $key->emp_code; ?></td>
      <?php 
          //if($key->registration_no=='NULL'){
            //echo "<span style='color:red'>Not Generated Yet!</span>";
          //}
          //else{
           // echo $key->registration_no;
         // }
          ?>
      
      <td><?php echo $key->dept_forw_no ?></td>
      <td><?php echo $key->salutation.' '.$key->pensionee_name ?></td>
      <td><?php echo $key->designation ?></td>
      <!--<td><?php //echo $key->entry_time ?></td>
      <td><?php 
          /*$x=explode(' ',$key->stt);
          if($x[0]=='Received'){
            echo "<span style='color:red;font-weight:bold'>Received</span>";
          }else{
            echo "<span style='color:green;font-weight:bold'>Forwarded</span>";
          }*/
         ?></td>-->
         <?php
		 $userdata = $this->session->userdata;
		 $member_code=$userdata['member_code'];
		 $file_no = $key->file_no;
		 $entryTimes = getEntryTimeFromFTD($file_no, 'Receipt', $member_code);
		 ?>
       <td style="padding: 0px;">
       		<?php if(count($entryTimes) > 0) { ?>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="inside-table">
                    <tr>
                    	<th width="50%"><?php echo isset($entryTimes[0]['entry_time']) ? $entryTimes[0]['entry_time']: ''; ?></th>
                        <th width="50%"><?php echo isset($entryTimes[1]['entry_time']) ? $entryTimes[1]['entry_time']: ''; ?></th>
                    </tr>
                </table>
            <?php } ?>
       </td>
    </tr>
    <?php $i=$i+1; ?>
  <?php endforeach ?>
  </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').dataTable();
    });
</script>
<style type="text/css">
	.inside-table th {text-align: center;}
</style>