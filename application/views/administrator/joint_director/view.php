<script type="text/javascript">
    $(document).ready(function(){
         $('#example').dataTable();
        $("#example1").dataTable();
        $('#example2').dataTable();
    });
    
    function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/joint_director/joint_director_confirm_for_approval').'?file=' ?>"+x,
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
            url:"<?php echo site_url('administrator/joint_director/joint_director_confirm_for_pension').'?file=' ?>"+x,
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
            url:"<?php echo site_url('administrator/joint_director/jd_confirm_from_ips').'?file=' ?>"+x,
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
    <li onclick="$('#pension').hide();$('#pension_sup').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From GIS Superintendent</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension_sup').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From IPS DA</b></a></li>
 <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#pension_sup').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1002')?>#pension_sup" data-toggle="tab"><b>From Pension</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
  <!-- From Receipt -->
<form method="POST" action="<?php echo site_url('administrator/joint_director/save_fwd_to_gis_superintendent_after_approval')?>">
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
            <th width="25%">Actions</th>                   
        </tr>            
    </thead>
    <tbody>
       
        <?php $i=1256; ?>
            <?php foreach ($lists as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
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
               <a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/joint_director/view_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Checklist</a><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/joint_director/attach_authority/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Authority</a>
               <?php 
                }
                ?>
                </td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDelete" data-toggle="modal" class="btn btn-primary">Forward</a>
<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files </h4>
            </div>
            <div class="modal-body">
                 <input type="radio" id="to" name="to" value="director">Director
                 <input type="radio" id="to" name="to" value="gisda">GIS DA
                <p class="text-warning">Click Yes, if you are sure to forward these files, otherwise Click No</p>
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
<form method="POST" action="<?php echo site_url('administrator/joint_director/save_fwd_by_jd_from_ips') ?>">
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
         <?php foreach ($lists2 as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax1('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button>
                    <?php $i=$i+1; ?>
                </td>
                <td>
                <a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/FAO/view_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Report</a>
                </td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDel" data-toggle="modal" class="btn btn-primary">Forward</a> 
<div id="myDel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to Pension Superintendent</h4>
                 <input type="radio" id="to" name="to" value="ipsda">IPS DA
                <input type="radio" id="to" name="to" value="director">Director
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

<div class="tab-pane" id="pension_sup">
<form method="POST" action="<?php echo site_url('administrator/joint_director/pension_save_fwd_by_jd') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="20">Token No</th>
            <th width="10%">File No</th>
            <th width="20%">Name | Designation</th>
            <th width="20%">Dept. f.No.</th>
            <th width="10%">Received</th>
            <th width="18%">Actions</th>  
        </tr>

        </thead>
    <tbody>
      <?php $i=100000; ?>
         <?php foreach ($lists3 as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                 <td><?php echo $key->dept_forw_no; ?></td>
                <td>
                    <button onclick="ajax2('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                <td>
                <a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/report/'.strtolower($key->class_of_pension).'/'.$key->serial_no)?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View</a>
                </td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDel1" data-toggle="modal" class="btn btn-success">Forward</a>
<a href="#send_back1" data-toggle="modal" class="btn btn-success">Send Back</a>
<div id="myDel1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files</h4>
                 <input type="radio" id="to" name="to" value="pension_da">Pension DA
                <input type="radio" id="to" name="to" value="director">Director
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>
<div id="send_back1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Send back</h4>
                <input type="radio" id="send_back" name="send_back" value="superintendent">Superintendent
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to send back, otherwise Click No</p>
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
                url:'<?php echo site_url("administrator/joint_director/index?id="); ?>'+x,
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





















































