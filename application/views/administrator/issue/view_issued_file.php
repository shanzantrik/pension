<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>

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
            url:"<?php echo site_url('administrator/Ips/ips_confirm').'?file=' ?>"+x,
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
	$(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/issue/update_ajax') ?>", {
		
                    "callback": function( sValue, y ) {
                        var aPos = oTable.fnGetPosition( this );
                        oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                    },

                    "submitdata":function(value,settings) {
                        return {
                            "row_id": this.parentNode.getAttribute('id'),
                            "column": oTable.fnGetPosition(this)[2]
                        };
                    },
			
                    "height": "14px",
                    "width": "100%",
                    "onblur": "submit"
               });
    });
	
	
	/*$(document).ready(function() {
	$(".edit").editable("http://www.example.com/save.php", {
    type : "datepicker"
    indicator :  "Saving...",
    tooltip : "Click to edit...",
    datepicker : {
        maxyear : 100,
        minyear : 10
    }
});
});
*/</script>


<h3>VIEW ISSUED FILE</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
    <li onclick="$('#pension').hide();$('#abc').hide();$('#receipt').show();"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>From Receipt</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1004')?>#pension" data-toggle="tab"><b>From Pension</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#abc').hide();$('#pension').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>From Director/Joint Director/FAO</b></a></li>
</ul>
<div class="tab-content" style="overflow:visible;">
  <!-- From Receipt -->
<form method="POST" action="<?php echo site_url('administrator/Ips/save_fwd')?>">
<div class="tab-pane-active" id="receipt">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
       <tr>
            <th width="10%">Dept No</th>
            <th width="10%">Token No</th>
            <th width="20%">File No</th>
            <th width="20%">Name | Designation</th>
            <th width="15%">Registration No</th> 
            <th width="15%">Reg Date</th>                  
        </tr>
    </thead>
    <tbody>
       
          <?php $i=1256; ?>
            <?php foreach ($lists as $key): ?>
                <tr id="<?php echo $key->file_no;?>">
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation; ?></td>
                <td  class="edit"><?php echo $key->reg_no; ?></td>
                <td  class="edit" id="reg_dt"><?php echo $key->reg_dt; ?></td>
  
                </tr>
            <?php endforeach?>
    </tbody>
</table>
<br/>
<div id="myDelete_" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files to ISSUE</h4>
            </div>
            <div class="modal-body">
            <input type="text" name="reg"/>
             <input type="text" name="reg" value="<?php echo $key->file_no;?>" />
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
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk[]" value="<?php echo $key->file_no;?>"/></td>
                <td><?php echo $key->dept_forw_no; ?></td>
                <td><?php echo $key->token_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation;?></td>
               
                <td>
                    <button onclick="ajax('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button>
                    <?php $i=$i+1; ?>
                </td>
                 <td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/ips/view_report/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Report</a>
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
            <th width="2%">#</th>
            <th width="10%">Auto File No</th>
            <th width="20%">File No </th>
            <th width="40%">Designation</th>
            <th width="18%">Attach IPS</th>                   
            <th width="10%">Received</th>
        </tr>    
        </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($lists3 as $key): ?>
        <tr>
                <td><input id="chk_<?php echo $i ?>" <?php if($key->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" name="chk_receipt[]" value="<?php echo $key->file_no;?>"/></td>
                <td><?php echo $key->auto_file_no; ?></td>
                <td><?php echo $key->file_no; ?></td>
                <td><?php echo $key->pensionee_name."->".$key->designation;?></td>
                <td><a title="Attach IPS for this claimant from receipt branch" href="<?php echo site_url('/administrator/Ips/edit/'.base64_encode($key->file_no))?>/Pension" class="open-dialog-edit btn btn-success btn-rad" data-id=""><i class="icon-book"></i>Attach IPS</a>
                <td>
                    <button onclick="ajax1('<?php echo $key->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($key->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                    <?php $i=$i+1; ?>
                </td>
                </tr>
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





















































