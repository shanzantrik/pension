<h3>View Checklist &raquo; <small style="color:darkgrey;">Use the below panel to view list of Checklist For Different Employees</small></h3><hr style="margin:5px 0;"/>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%" style="font-size:12px">
    <thead>
        <tr>
           <th width="20%">Auto File No</th>
           <th width="20%">File No </th>
           <th width="20%">Name|Designation </th>
           <th width="10%">Department</th>
           <th width="30%">Action</th>                   
       </tr>
    </thead>
    <tbody>
        <?php foreach ($lists as $list) {
            $claim_status=$list->claim_status;
        ?>
            <tr>
                <td><?php echo  $list->auto_file_no; ?></td>
                <td><?php echo  $list->file_no; ?></td>
                <td><?php echo  $list->pensionee_name."->".$list->designation; ?></td>
                <td><?php echo  $list->dept_forw_no;?></td>
                  <?php  
                        $status=$list->status;
                        $objection=$list->objection;
                       if(($status=="Forwarded to GIS From Receipt")&& ($claim_status=="incomplete")||($status=="Forwarded to GIS DA By Pension DA")&&($claim_status=="incomplete")) { ?>
                      <td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/edit_checklist/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Edit</a>&nbsp;<a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/print_checklist/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-warning btn-rad" data-id=""><i class="icon-book"></i>Checklist</a>&nbsp;<a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/objection_report/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-danger btn-rad" data-id=""><i class="icon-book"></i>Objection</a></td>
                        
                    <?php } else if(($status=="Forwarded to GIS From Receipt") || ($status=="Forwarded to GIS DA By Pension DA")){?>
                        <td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/edit_checklist/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Edit</a>&nbsp;<a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/print_checklist/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-info btn-rad" data-id=""><i class="icon-book"></i>Checklist</a></td>
                     <?php }else{?>
                        <td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/edit_checklist/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Edit</a>&nbsp;<a title="Attach Checklist for this claimant from receipt branch" href="" class="btn btn-warning" data-id=""><i class="icon-book"></i>Forwarded</a></td>
                         <?php }?>

              </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                    var oTable=$('#example').dataTable({ "aLengthMenu": [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
    "iDisplayLength" : 25 });

  oTable.fnSort( [ [0,'asc'] ] );
            } );
        </script>
<style type="text/css">
    .dataTables_wrapper {margin-top: 10px;}
</style>