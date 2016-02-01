<script type="text/javascript">

    $(document).ready(function(){
        $('#example, #example1, #example2, #example3').dataTable();
    });
          function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/Gis/gis_confirm').'?file=' ?>"+x,
            dataType:'json',
            type:'GET',
            success:function(data){
                if(data.msg=='ok'){
                    $("#"+y).addClass("btn btn-success");
                    $("#"+y).attr("disabled","true");
                    $("#chk_"+y).show();
                }

            }
        });
    }
      function ajax1(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/Gis/gis_confirm_after_approval').'?file=' ?>"+x,
            dataType:'json',
            type:'GET',
            success:function(data){
                if(data.msg=='ok'){
                    $("#"+y).addClass("btn btn-success");
                    $("#"+y).attr("disabled","true");
                    $("#chk_"+y).show();
                }

            }
        });
        
    }
    function ajax2(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/Gis/gis_confirm_after_final').'?file=' ?>"+x,
            dataType:'json',
            type:'GET',
            success:function(data){
                if(data.msg=='ok'){
                    $("#"+y).addClass("btn btn-success");
                    $("#"+y).attr("disabled","true");
                    $("#chk_"+y).show();
                }

            }
        });
        
    }
</script>


<h3>VIEW GIS &nbsp;
    <select name="department" id="department" class="multiselect">
                <option value="0">Select Department</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                <?php } ?>
       </select>
</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
    <li onclick="$('#pension').hide();$('#abc').hide();$('#obj').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From Receipt</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#abc').hide();$('#obj').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Director/FAO/Joint Director</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#obj').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Pension</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').hide();$('#obj').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Superintendent For Objection</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
  <!-- From Receipt -->
<form method="POST" action="<?php echo site_url('administrator/Gis/save_fwd')?>">
<div class="tab-pane-active" id="receipt">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="10%">Dept No</th>
            <th width="10%">Token No</th>
            <th width="20%">File No</th>
            <th width="20%">Name | Designation</th>
            <th width="10%">Received</th>
            <th width="15%">Actions</th>                   
        </tr>            
        </thead>
    <tbody>
        <?php $i=1256;?>
<?php 
$my_values = array();
$my_array=array();
?>
<?php $old=$file_no;

/*foreach ($file_no as $value){
  array_push($old,$value);
}*/
?>
            <?php foreach ($lists as $key): ?>
                <tr>
                <td><input id="chk_<?php echo $i ?>"<?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation;?></td>
                <td>
                    <button onclick="ajax('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1;?>
                </td>
                <td>
                    <?php if(in_array($key->file_no, $old)) { ?>
                        <a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/attach_checklist/'.base64_encode($key->file_no))?>/Receipt" class="btn btn-warning"  data-id=""><i class="icon-book"></i>Attached</a>
                    <?php } else { ?>
                        <a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/attach_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Attach Checklist</a>
                    <?php }?>
                </td>
</tr>
    <?php endforeach ?>
    
    </tbody>
</table>
<br/>
<a href="#myDelete" data-toggle="modal" class="btn btn-primary">Forward to GIS Superintendent</a>
<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to GIS Superintendent</h4>
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to GIS Superintendent, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success" id="del">Yes</button>
            </div>
        </div>
    </div>
</div>
<br/>
</div>
</form>

<div class="tab-pane" id="pension">
<form method="POST" action="<?php echo site_url('administrator/Gis/save_fwd_after_approval') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1" width="100%">
    <thead>
       <tr>
            <th width="2%">#</th>
            <th width="10%">Dept No</th>
            <th width="10%">Token No</th>
            <th width="20%">File No</th>
            <th width="20%">Name | Designation</th>
            <th width="10%">Received</th>
            <th width="15%">Actions</th>                   
        </tr>            
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($lists2 as $key): ?>
            <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax1('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                <td>
                <?php if($key->claim_status=="incomplete")
                {
                ?>
<a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/view_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View Checklist</a><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/objection_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-danger btn-rad" data-id=""><i class="icon-book"></i>Objection</a>
                <?php
                }else{//complete
                ?>
                <a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/view_checklist/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Checklist</a><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/attach_authority/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Authority</a>
               <?php 
                }
                ?>
                </td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<script type="text/javascript">
    // $(document).ready(function(){
    //     $(".dataTable").dataTable();
    // });
</script>
<br/>
<a href="#myDel" data-toggle="modal" class="btn btn-primary">Forward to Issue</a>
<div id="myDel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to Issue</h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to Issue, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>

<div class="tab-pane" id="obj">
<form method="POST" action="<?php echo site_url('administrator/Gis/save_fwd_after_approval') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3" width="100%">
    <thead>
       <tr>
            <th width="10%">Auto File No</th>
            <th width="20%">File No </th>
            <th width="15%">Designation</th>
            <th width="15%">Department</th>
            <th width="40%">View</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($lists4 as $key): ?>
            <tr>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td><?php echo $key->dept_forw_no; ?></td>

<td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/print_checklist/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-warning btn-rad" data-id=""><i class="icon-book"></i>Checklist</a><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/objection_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-danger btn-rad" data-id=""><i class="icon-book"></i>Objection</a></td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<script type="text/javascript">
    // $(document).ready(function(){
    //     $(".dataTable").dataTable();
    // });
</script>
<br/>
<a href="#myDel" data-toggle="modal" class="btn btn-primary">Forward to GIS Superintendent</a>
<div id="myDel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to Pension Superintendent</h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to Pension Superintendent, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>


<div class="tab-pane" id="abc">
<form method="POST" action="<?php echo site_url('administrator/Gis/save_fwd') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2" width="100%">
    <thead>
       <tr>
            <th width="2%">#</th>
            <th width="20%">Auto File No</th>
            <th width="20%">File No </th>
            <th width="40%">Designation</th>                   
            <th width="20%">Received</th>
            <th width="20%">ADD</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($lists3 as $key): ?>
            <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>

                <td>
                    <?php if(in_array($key->file_no, $old)) { ?>
                        <a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/view_checklist/'.base64_encode($key->file_no))?>" class="btn btn-warning"  data-id=""><i class="icon-book"></i>Attached</a>
                    <?php } else { ?>
                        <a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/Gis/attach_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Attach Checklist</a>
                    <?php }?>
                </td>

                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<script type="text/javascript">
    // $(document).ready(function(){
    //     $(".dataTable").dataTable();
    // });
  
</script>
<br/>
<a href="#myDel12" data-toggle="modal" class="btn btn-primary">Forward to GIS Superintendent</a>
<div id="myDel12" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to GIS Superintendent</h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to GIS Superintendent, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- script in text document myscript;-->

</form>
</div>




</div>


<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to Delete the Data?</p><?php echo $this->uri->segment(2); ?>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
                <a href="#" class="btn btn-danger" id="del">Yes</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
        
        $("#department").change(function(){
            var x=$("#department").val();
            $.ajax({
                url:'<?php echo site_url("administrator/gis/index?id="); ?>'+x,
                dataType:'html',
                method:'GET',
                success:function(data){
                    $("#content").html(data);
                }

            });
        });
    });
    
</script>
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>





















































