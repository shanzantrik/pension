<h3>VIEW IPS</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
    <li onclick="$('#pension').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1004')?>#receipt" data-toggle="tab" ><b>From Receipt</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Pension</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
    <!-- From Receipt -->
    <form method="POST" action="<?php echo site_url('administrator/Ips/save_fwd')?>">
        <div class="tab-pane-active" id="receipt">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
                <thead>
                    <tr>
                        <th width="10%">Auto File No</th>
                        <th width="20%">File No</th>
                        <th width="25%">Name</th> 
                        <th width="25%">Designation</th>   
                        <th width="25%">Actions</th>                 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists as $list){?>
                    <tr>
                        <td><?php echo  $list->status;?></td>
                        <td><?php echo  $list->file_no; ?></td>
                        <td><?php echo  $list->name;?></td>
                        <td><?php echo  $list->designation;?></td>
                        <?php  
                            $status=$list->status;
                            if($status=="Forwarded to IPS" ||$status=="Forwarded to IPS From Receipt") { ?>
                                <td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/edit_ips/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Edit</a></td>
                            <?php } else { ?>
                                <td><a title="Attach IPS for this claimant from receipt branch" href="" class="btn btn-warning" data-id=""><i class="icon-book"></i>Forwarded</a></td>
                            <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table><br/>
        </div>
    </form>

    <div class="tab-pane" id="pension">
        <form method="POST" action="<?php echo site_url('administrator/Ips/save_forwrd_dynamic') ?>">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
                <thead>
                    <tr>
                        <th width="10%">Auto File No</th>
                        <th width="20%">File No</th>
                        <th width="25%">Name</th> 
                        <th width="25%">Designation</th>   
                        <th width="25%">Actions</th>                 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists1 as $list){?>
                    <tr>
                        <td><?php echo  $list->status;?></td>
                        <td><?php echo  $list->file_no; ?></td>
                        <td><?php echo  $list->name; ?></td>
                        <td><?php echo  $list->designation;?></td>
                        <?php  
                            $status=$list->status;
                            if($status=="Forwarded to IPS" ||$status=="Forwarded to IPS From Receipt") { ?>
                                <td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/edit_ips/'.base64_encode($list->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Edit</a></td>
                            <?php } else { ?>
                                <td><a title="Attach IPS for this claimant from receipt branch" href="" class="btn btn-warning" data-id=""><i class="icon-book"></i>Forwarded</a></td>
                            <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table><br/>
        </form>
    </div>
</div>
<style type="text/css">
    .dataTables_wrapper {margin-top: 10px;}
    .link {float: left; margin-right: 3px;}
    .multiselect-container {margin-left: 0px!important;}
    .action-list {float: left;width: 150px;}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#example1").dataTable();
        $('#example').dataTable();
    });
</script>