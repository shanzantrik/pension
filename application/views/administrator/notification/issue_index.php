<script type="text/javascript">
    $(document).ready(function(){
        $("#example1").dataTable();
    });
    $(document).ready(function()
    {
        $('#example').dataTable();
    });
	$(document).ready(function()
    {
        $('#example3').dataTable();
    });
	
	function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/issue/confirm_issue').'?file=' ?>"+x,
            dataType:'json',
            type:'GET',
            success:function(data){
                if(data.msg=='ok'){
                    $("#confirm_"+y).attr("disabled","true");
                    $("#confirm_"+y).addClass("btn btn-success");
                    $("#dispatch_"+y).show();
                    
                }

            }
        });
        
    }
	function ajax1(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/Ips/ips_confirm_from_pension').'?file=' ?>"+x,
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
<h3>VIEW All &nbsp;
        <select name="department" id="department" class="multiselect">
                <option value="0">Select Department</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                <?php } ?>
        </select>
</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
<li onclick="$('#pension').hide();$('#abc').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From IPS</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1004')?>#pension" data-toggle="tab"><b>From Pension</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#abc').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From GIS</b></a></li>
</ul>
<div class="tab-content" style="overflow:visible;">
  <!-- From Receipt -->
<form method="POST" action="<?php echo site_url('administrator/issue/dispatch') ?>">
<div class="tab-pane-active" id="receipt">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
       <tr>
                <td><b>Auto Gen File No</b></td>
                <td><b>File No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
                <td><b>Received</b>[<small style="color:red; font-size: 10px;">Mark as Received</small>]</td>
                <td></td>
       </tr>
          </thead>
    <tbody>
<tbody>
        <?php $i=100000; ?>
            <?php foreach ($records as $rec): ?>
                <tr>
                    <td><?php echo $rec->auto_file_no ?></td>
                    <td><?php echo $rec->file_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo $rec->receipt_date ?></td>
                    <td><?php echo $rec->allocated_date ?></td>
                    <!--<td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/view_report/'.base64_encode($rec->file_no))?>" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View</a></td>-->

                    <td>
                        <button id="confirm_<?php echo $i; ?>" onclick="ajax('<?php echo $rec->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($rec->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    </td>
                    <td>
                        <a class="btn btn-info" id="dispatch_<?php echo $i; ?>" href="<?php echo site_url('administrator/issue/dispatch_pre').'/'.base64_encode($rec->file_no); ?>" <?php if($rec->notification=='pending'){echo "style='display:none'";}else{echo "style='display:show'";} ?>>Dispatch</a>
                    </td>
                </tr>
                <?php $i=$i+1; ?>
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
                <h4 class="modal-title">Are you Sure want to Forward these Files to ISSUE</h4>
            </div>
            <div class="modal-body">
             <input type="radio" id="to" name="to" value="fao">FAO
              <input type="radio" id="to" name="to" value="jd">Joint Director
                <input type="radio" id="to" name="to" value="director">Director
                <p class="text-warning">Click Yes, if you are sure to forward to ISSUE, otherwise Click No</p>
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
<form method="POST" action="<?php echo site_url('administrator/Ips/save_forwrd_to') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1" width="100%">
    <thead>
               <tr>
                <td><b>Auto Gen File No</b></td>
                <td><b>Registration Number</b></td>
                <td><b>File No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
                <td><b>Received</b>[<small style="color:red; font-size: 10px;">Mark as Received</small>]</td>
                <td></td>
       </tr>
    
        </thead>
    <tbody>
      <?php $i=100000; ?>
            <?php foreach ($records1 as $rec): ?>
                <tr>
                    <td><?php echo $rec->auto_file_no ?></td>
                    <td><?php echo $rec->registration_no ?></td>
                    <td><?php echo $rec->file_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo $rec->receipt_date ?></td>
                    <td><?php echo $rec->allocated_date ?></td>
                    <!--<td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/view_report/'.base64_encode($rec->file_no))?>" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View</a></td>-->

                    <td>
                        <button id="confirm_<?php echo $i; ?>" onclick="ajax('<?php echo $rec->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($rec->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    </td>
                    <td>
                        <a class="btn btn-info" id="dispatch_<?php echo $i; ?>" href="<?php echo site_url('administrator/issue/dispatch_pre').'/'.base64_encode($rec->file_no); ?>" <?php if($rec->notification=='pending'){echo "style='display:none'";}else{echo "style='display:show'";} ?>>Dispatch</a>
                    </td>
                </tr>
                <?php $i=$i+1; ?>
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
                <h4 class="modal-title">Are you Sure want to Forward these Files</h4>
            </div>
            <div class="modal-body">
             <input type="radio" id="to" name="to" value="issue">Issue
              <input type="radio" id="to" name="to" value="pensionda">Pension DA
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
<form method="POST" action="<?php echo site_url('administrator/Ips/save_fwd') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3" width="100%">
    <thead>
         <tr>
                <td><b>Auto Gen File No</b></td>
                <td><b>File No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
                <td><b>Received</b>[<small style="color:red; font-size: 10px;">Mark as Received</small>]</td>
                <td></td>
       </tr>
    
        </thead>
    <tbody>
     <?php $i=100000; ?>
            <?php foreach ($records2 as $rec): ?>
                <tr>
                    <td><?php echo $rec->auto_file_no ?></td>
                    <td><?php echo $rec->file_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo $rec->receipt_date ?></td>
                    <td><?php echo $rec->allocated_date ?></td>
                    <!--<td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/view_report/'.base64_encode($rec->file_no))?>" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View</a></td>-->

                    <td>
                        <button id="confirm_<?php echo $i; ?>" onclick="ajax('<?php echo $rec->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($rec->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    </td>
                    <td>
                        <a class="btn btn-info" id="dispatch_<?php echo $i; ?>" href="<?php echo site_url('administrator/issue/dispatch_pre').'/'.base64_encode($rec->file_no); ?>" <?php if($rec->notification=='pending'){echo "style='display:none'";}else{echo "style='display:show'";} ?>>Dispatch</a>
                    </td>
                </tr>
                <?php $i=$i+1; ?>
            <?php endforeach ?>

    </tbody>
</table>

    <br/>
<a href="#myDel12" data-toggle="modal" class="btn btn-primary">Forward</a>
<div id="myDel12" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to ISSUE</h4>
            </div>
            <div class="modal-body">
             <input type="radio" id="to" name="to" value="fao">FAO
              <input type="radio" id="to" name="to" value="jd">Joint Director
                <input type="radio" id="to" name="to" value="director">Director
                <p class="text-warning">Click Yes, if you are sure to forward to ISSUE, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success" id="del">Yes</button>
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
                url:'<?php echo site_url("administrator/issue/index?id="); ?>'+x,
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





















































