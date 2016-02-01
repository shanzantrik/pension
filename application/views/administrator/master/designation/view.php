<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Designation</a>                            
<p style=""><i>(To Edit a Designation please Click on the record write the update value and hit <span style='color:red'>Enter</span>)</i></p>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="15%">Designation Code</th>
            <th width="20%">Designation Name</th>
            <th width="35%">Description</th> 
            <th width="30%">Actions</th>                    
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['desg_code'];?>">
	            <td ><?php echo $list['desg_code']; ?></td>
	            <td class="edit"><?php echo $list['desg_name']; ?></td>
	            <td class="edit"><?php echo $list['description']; ?></td>        
				<td>
	            <a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['desg_code']; ?>"><i class="icon-trash"></i>Delete</a></td>                   	                       
	        </tr>
    	<?php } ?>
    </tbody>
</table>

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

<div id="myAdd" class="modal fade">
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/designation_index'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Designation</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Designation Name</label>
                    <div class="col-sm-6">
                        <input autocomplete="off" required="required" title="Please Enter Designation Name" name="designation_name" type="text"  class="form-control parsley-validated" placeholder="Please Enter Designation Name">
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-6">
                        <textarea name="description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"><?php echo set_value('description'); ?></textarea><?php echo form_error('description', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <br/>
            </div>
            <div class="modal-footer">
               <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Designation</button>
              </div>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
	$(document).on("click", ".open-dialog", function () {
	 	var designationId = $(this).data('id');
	 	$("#del").attr("href", "<?php echo site_url()?>/administrator/master/designation_del/" + designationId);
	});
    $(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/designation_update_ajax') ?>", {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ){
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },
            "height": "14px",
            "width": "100%",
            "onblur": "submit"
        });
    });
</script>