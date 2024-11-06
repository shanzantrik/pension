<h3 style="width: 70%; float: left;">Members Legend &raquo; <small style="color:darkgrey;">Use the below panel to view list of members operating on the system</small></h3><div style="float: left; text-align: right; width: 30%;"><a href="<?php echo site_url('administrator/master/member_index'); ?>" class="btn btn-info">Add New</a></div><div style="clear: both;"></div>
<hr style="margin:5px 0;"/>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%" style="font-size:12px">
    <thead>
        <tr>
            <th width="10%">Member Code</th>
            <th width="15%">Name</th>
            <th width="10%">Contact Info</th>
            <th width="10%">Branch</th>
            <th width="10%">Member Type</th>
            <th width="14%">Designation</th>
            <th width="5%">Status</th>
            <th width="15%">Actions</th>                         
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lists as $list) { ?>
            <tr>
                <td><?php echo $list['member_code']; ?></td>
                <td><?php echo $list['member_name']; ?>
                    <?php if($list['logged_in']=='yes') { ?>
                        <li style="list-style:none; font-size:11px">Status &raquo; <span style="font-size:11px; color:green; font-weight:bold">Available </span></li>
                    <?php } ?>
                    <?php if($list['logged_in']=='no'){?>
                        <li style="list-style:none;font-size:11px">Status &raquo; <span style="font-size:11px; color:red; font-weight:bold">Offline </span></li>
                    <?php } ?>
                </td>
                <td width="30%">
                    <li style="list-style:none"><span style="font-size:11px">Correspondence Address: <?php echo $list['cor_address']; ?> </span></li>
                    <li style="list-style:none"> <span style="font-size:11px">Permanent Address: <?php echo $list['per_address']; ?> </span></li>
                    <li style="list-style:none"><span style="font-size:11px">Land Phone: <?php if($list['mobile_no1']=='' || $list['mobile_no1']=="NULL" || empty($list['mobile_no1']) || $list['mobile_no1']==NULL){ echo "N/A";} else {echo $list['mobile_no1']; }?></span></li>
                    <li style="list-style:none"><span style="font-size:11px">Mobile Phone: <?php echo $list['mobile_no2']; ?></span></li>
                    <li style="list-style:none"><span style="font-size:11px">Email: <?php if($list['email']=='' || $list['email']=="NULL" || empty($list['email']) || $list['email']==NULL){ echo "N/A";} else {echo $list['email']; }?></span></li>
                 </td> 
                <td><?php echo getBranchName($list['Branch_Code']); ?></td>
                <td width="11%">
                    <?php
                        echo getMemberType($list['member_type_code']); 
                        if(@$list['section']!="No" && @$list['section']!="NULL" ) {
                            echo "<br/><strong>Section &raquo;".$list['section']."</strong>";
                        }
                    ?>
                </td>
                <td><?php echo getDesignation($list['desg_code']); ?></td>
                <?php if($list['member_status']=='active'){ ?>
                    <td style="color:green; font-weight:bold"><?php echo ucwords($list['member_status']); ?></td>    
                <?php } elseif($list['member_status']=='inactive') { ?>
                    <td style="color:red; font-weight:bold"><?php echo ucwords($list['member_status']); ?></td>    
                <?php } elseif($list['member_status']=='block') { ?>
                    <td style="color:orange; font-weight:bold"><?php echo ucwords($list['member_status']); ?>ed</td>
                <?php } ?>
                <?php if($list['member_status']=='inactive' || $list['member_status']=='block'){?>           
                <td><a title="Edit" href="<?php echo site_url('/administrator/master/member_edit/'.$list['member_code'])?>" class="open-dialog-edit" data-id="<?php echo $list['member_code']; ?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp; 
                <a title="Delete" href="#myDelete" class="open-dialog" data-toggle="modal" data-id="<?php echo $list['member_code']; ?>"><i class="icon-trash"></i></a></td>
                <?php }  elseif($list['member_status']=='active' && $list['logged_in']=='no') { ?>
                <td><a title="Edit this member" href="<?php echo site_url('/administrator/master/member_edit/'.$list['member_code'])?>" class="open-dialog-edit" data-id="<?php echo $list['member_code']; ?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp; 
                <a title="Delete" href="#myDelete" class="open-dialog" data-toggle="modal" data-id="<?php echo $list['member_code']; ?>"><i class="icon-trash"></i></a></td>                   
                <?php } elseif($list['member_status']=='active' && $list['logged_in']=='yes') {?>
                <td><a title="Edit this member" href="<?php echo site_url('/administrator/master/member_edit/'.$list['member_code'])?>" class="open-dialog-edit" data-id="<?php echo $list['member_code']; ?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp; 
                    <a title="You cannot delete this member as it is currently online" disabled><i class="icon-trash"></i></a></td>
                <?php }   ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation <p class="text-warning"><small>Please note that record once deleted cannot be rolled back.</small></p>
            </h4>
            </div>
            <div class="modal-body">
                <p style="font-size:12px; text-align:left">Are you sure you want to <b>remove</b> this <?php echo $this->uri->segment(2); ?> from records permanently?</p><br/>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" data-dismiss="modal">Not Now</a>
                <a href="#" class="btn btn-danger" id="del">Yes</a><br/>
                <small style="color:darkgrey; text-align:left">If you are not sure on this or want to learn more, contact software provider.</small>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).on("click", ".open-dialog", function () {
        var departmentId = $(this).data('id');
        $("#del").attr("href", "<?php echo site_url()?>/administrator/master/member_del/" + departmentId);
    });

    $(document).ready(function() {
        var oTable = $('#example').dataTable({ "aLengthMenu": [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        "iDisplayLength" : 25 });
        oTable.fnSort( [ [0,'asc'] ] );
    });
</script>
<style type="text/css">
    .dataTables_wrapper {margin-top: 10px;}
</style>