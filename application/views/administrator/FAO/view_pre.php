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

       $(document).ready(function()
    {
        $('#example4').dataTable();
    });

       $(document).ready(function(){
        $('#example5').dataTable();
    });
	
   function ajax(x,y){
   //alert("okk");
   		$.get('<?php echo site_url('administrator/FAO/fao_confirm_for_approval'); ?>', {file: x}, function(data){
			if(data=='ok'){
				$("#"+y).addClass("btn btn-success");
				$("#"+y).attr("disabled","true");
				$("#chk_"+y).show();
			}
		});
    }     
	
	function ajax1(x,y){
        $.ajax({
            //url:"<?php echo site_url('administrator/gis_superintendent/gis_superintendent_confirm_after_approval').'?file=' ?>"+x,
			  url:"<?php echo site_url('administrator/FAO/confirm_by_fao_from_ips').'?file=' ?>"+x,
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
     function ajax4(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/gis_superintendent/gis_superintendent_confirm_form_gis_Da_obj').'?file=' ?>"+x,
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

    function ajax3(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/gis_superintendent/gis_superintendent_confirm_after_final').'?file=' ?>"+x,
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
            url:"<?php echo site_url('administrator/FAO/confirm_fao_from_pension_superintendent').'?file=' ?>"+x,
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


<h3>VIEW GIS</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
    <li onclick="$('#pension').hide();$('#abc').hide();$('#obj').hide();$('#def').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From GIS DA </b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#abc').hide();$('#obj').hide();$('#def').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From IPS DA</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#obj').hide();$('#def').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Pension Superintendent</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').hide();$('#obj').hide();$('#def').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Director After Final</b></a></li>
      <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').hide();$('#def').hide();$('#obj').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From GIS DA for Objection</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
  <!-- From Receipt -->
<form method="POST" action="<?php echo site_url('administrator/FAO/save_fwd_by_fao')?>">
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
                <td><?php echo $key->file_no;?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax('<?php echo base64_encode($key->file_no); ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                <td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/FAO/view_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View Checklist</a>
                <a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/FAO/attach_authority/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Authority</a>
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
                <h4 class="modal-title">Are you Sure want to Forward these Files to Joint Director</h4>
            </div>
            <div class="modal-body">
                <input type="radio" id="to" name="to" value="gisda">GIS DA
                <input type="radio" id="to" name="to" value="director">Director
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
<form method="POST" action="<?php echo site_url('administrator/FAO/ips_save_forwrd_by_fao')?>">
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
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>"/></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td>
                    <button onclick="ajax1('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button>
                    <?php $i=$i+1; ?>
                </td>
                <td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/FAO/view_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Report</a></td>
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
                <h4 class="modal-title">Are you Sure want to Forward these Files to GIS DA</h4>
                <input type="radio" id="to" name="to" value="ipsda">IPS DA
                <input type="radio" id="to" name="to" value="director">Director</div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to GIS DA, otherwise Click No</p>
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
<form method="POST" action="<?php echo site_url('administrator/gis_superintendent/save_fwd_to_gisda_obj')?>">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example5" width="100%">
    <thead>
        <tr>
          <th width="2%">#</th>
            <th width="10%">Auto File No</th>
            <th width="10%">File No </th>
            <th width="25%">Name | Designation</th>
            <th width="13%">Department</th>
            <th width="7%">Received</th>
            <th width="30%">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1256; ?>
            <?php foreach ($lists5 as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_obj[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                 <td><?php echo $key->dept_forw_no; ?></td>
                <td>
                    <button onclick="ajax4('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                <td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/view_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View Checklist</a><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/objection_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-danger btn-rad" data-id=""><i class="icon-book"></i>Objection</a></td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#my1" data-toggle="modal" class="btn btn-primary">Forward to GIS DA</a>
<div id="my1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to Joint Director</h4>
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to GIS DA, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success" id="del">Yes</button>
            </div>
        </div>
    </div>
</div>
<br/>
</form>
</div>


<div class="tab-pane" id="abc">
<form method="POST" action="<?php echo site_url('administrator/FAO/pension_save_fwd_by_fao')?>">
    
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="10%">Token No</th>
            <th width="10%">File No </th>
            <th width="13%">Department</th>
            <th width="15%">Name | Designation</th>
            <th width="7%">Received</th>
            <th width="40%">Actions</th>                   
        </tr>
    </thead>
    
   <tbody>
        <?php $i=1256; ?>
            <?php foreach ($lists3 as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
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
<a href="#myD" data-toggle="modal" class="btn btn-primary">Forward  </a>

<div id="myD" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files </h4>
            </div>
            <div class="modal-body">
                   <input type="radio" id="to" name="to" value="pension_da">Pension DA
                <input type="radio" id="to" name="to" value="director">Director
                <p class="text-warning">Click Yes, if you are sure to forward to Joint Director, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success" id="del">Yes</button>
            </div>
        </div>
    </div>
</div>
<br/>

</form>
</div>


<div class="tab-pane" id="def">
<form method="POST" action="<?php echo site_url('administrator/gis_superintendent/save_fwd_to_gisda_after_final')?>">

   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example4" width="100%">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="10%">Auto File No</th>
            <th width="10%">File No </th>
            <th width="25%">Name | Designation</th>
            <th width="13%">Department</th>
            <th width="7%">Received</th>
            <th width="30%">Actions</th>                   
        </tr>
    </thead>
    <tbody>
        <?php $i=1256; ?>
            <?php foreach ($lists4 as $key):?>
                <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk2[]" value="<?php echo $key->file_no; ?>" /></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                 <td><?php echo $key->dept_forw_no; ?></td>
                <td>
                    <button onclick="ajax3('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
<td><a title="Attach Checklist for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/view_checklist/'.base64_encode($key->file_no))?>/Receipt" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>View Checklist</a>
<a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/gis_superintendent/attach_authority/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Authority</a></td>
</tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#my" data-toggle="modal" class="btn btn-primary">Forward to GIS DA after Final </a>

<div id="my" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to Joint Director</h4>
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward to Joint Director, otherwise Click No</p>
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





















































