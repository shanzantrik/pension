<script type="text/javascript">

    $(document).ready(function(){
        $('#example, #example1, #example2, #example3').dataTable();
    });
    
    function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/da_notification/da_confirm').'?file=' ?>"+x,
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
            url:"<?php echo site_url('administrator/da_notification/da_confirm_from_director').'?file=' ?>"+x,
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
            url:"<?php echo site_url('administrator/da_notification/da_confirm_from_ips').'?file=' ?>"+x,
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
	function validate(){
        if($(document).find('input[type=radio]:checked').length==0){
            alert('You Must Select');
            return false;
        }else{
            return true;
        }
    }

	function ajax3(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/director/pen_confirm_from_jd_fao_superintendent').'?file=' ?>"+x,
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

    $(document).ready(function() {
    $('#selecctall').click(function(event) {  
        if(this.checked) { 
            $('.checkbox1').each(function() { 
                this.checked = true;                 
            });
        }else{
            $('.checkbox1').each(function() { 
                this.checked = false;                   
            });         
        }
    });
    
});

</script>

<h3>VIEW ALL <small style="font-size:12px"> On received the button will turn green.</small>
       <select name="department" id="department" class="multiselect">
                <option value="0">Select Department</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                        <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
                <?php } ?>
       </select>
</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
    <li onclick="$('#pension').hide();$('#receipt').show();$('#abc').hide()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From Receipt</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').show();$('#abc').hide()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Director/Joint Director/FAO</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From IPS</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
  <!-- From Receipt -->
<form method="POST" onsubmit="return validate()" action="<?php echo site_url('administrator/da_notification/save_forwrd_dynamic')?>">
<div class="tab-pane-active" id="receipt">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <thead>
            <tr>
                <td>#</td>
                <td><b>Token No</b></td>
                <td><b>File No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
                <td><b>Received</b>[<small style="color:red; font-size: 10px;">Mark as Received</small>]</td>
                <td><b>Action</b></td>
            </tr>
        </thead>
        <tbody>
        <?php $i=100000; ?>
            <?php foreach($records as $rec):?>
                <tr>
                    <td><input class="checkbox1" <?php if($rec->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" id="chk_<?php echo $i ?>" name="chk[]"  value="<?php echo $rec->file_no ?>"></td>
                    <td><?php echo $rec->token_no ?></td>
                    <td><?php echo $rec->file_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo $rec->receipt_date ?></td>
                    <td><?php echo $rec->allocated_date ?></td>
                    <td>
                        <button onclick="ajax('<?php echo $rec->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($rec->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                        <?php $i=$i+1; ?>
                    </td>
                    <td>
<?php if(in_array($rec->file_no, $file_no)) { ?>
    <a title="Attach service detail for Pensioner" href="#<?php //echo site_url('/administrator/service_book/add/'.base64_encode($rec->file_no))?>" class="btn btn-warning" data-id="">Attached</a>
<?php } else { ?>
    <a title="Attach service detail for Pensioner" href="<?php echo site_url('/administrator/service_book/add/'.base64_encode($rec->file_no))?>" class="btn btn-success" data-id="">Pending</a>
<?php }?>
                    </td>
           
        </tr>
        <?php endforeach?>
    </tbody>
</table>
<input type="checkbox" id="selecctall"/>Select All
<br/>
<a href="#forwrd" class="open-dialog btn btn-success btn-rad" data-toggle="modal"><i class=""></i>Forward</a>
<a href="#send_back" class="open-dialog btn btn-success btn-rad" data-toggle="modal"><i class=""></i>Send Back</a>
<div id="forwrd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forward To</h4>
            </div>
            <div class="modal-body">
                <input type="radio" id="to" name="to" value="ips">IPS Section
                <input type="radio" id="to" name="to" value="super">To Superintendent of Pension
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
<div id="send_back" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Send Back To</h4>
            </div>
            <div class="modal-body">
                <input type="radio" id="send_back" name="send_back" value="receipt">Receipt Section
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</br>
</div>
</form>

<div class="tab-pane" id="pension">
<form method="POST" action="<?php echo site_url('administrator/da_notification/save_fwd_to_gisda_bypension_da') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="20%">Token No</th>
            <th width="40%">Dept f.No.</th>
            <th width="20%">File No</th>
            <th width="20%">Name|Designation</th>                   
            <th width="10%">Received</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($records1 as $key):?>
            <tr>
                <td><input id="chk_<?php echo $i?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation;?></td>
                <td>
                    <button onclick="ajax1('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button>
                    <?php $i=$i+1;?>
                </td>
                <td>
                </td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>

<a href="#myDel" class="open-dialog btn btn-success btn-rad" data-toggle="modal"><i class=""></i>Forward</a>
<div id="myDel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forward To</h4>
            </div>
            <div class="modal-body">
                <input type="radio" id="to" name="to" value="gis">Gis
                <input type="radio" id="to" name="to" value="issue">To ISsue
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</br>
</div>
</form>

<div class="tab-pane" id="abc">
<form method="POST" action="<?php echo site_url('administrator/da_notification/save_fwd_to_pen_superintendent') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="20%">Auto File No</th>
            <th width="20%">File No </th>
            <th width="40%">Designation</th>
            <th width="20%">Received</th>                   
            <th width="10%">Report</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($records2 as $key):?>
            <tr>
                <td><input id="chk_<?php echo $i?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation;?></td>
                <td>
                    <button onclick="ajax2('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                <td>
               <a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/print_ips/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Print</a>
<a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/print_ips_all/'.base64_encode($key->dept_forw_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Print All</a>
</td></tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDel31" data-toggle="modal" class="btn btn-primary">Forward</a>
<div id="myDel31" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files </h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward these files, otherwise Click No</p>
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
<script type="text/javascript">
$(document).ready(function(){
        
        $("#department").change(function(){
            var x=$("#department").val();
            $.ajax({
                url:'<?php echo site_url("administrator/pension/view_file?id="); ?>'+x,
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