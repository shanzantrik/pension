<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<p style=""><i>(To Edit Commutation please Click on the record write the update value and hit <span style='color:red'>Enter</span> or You can Manually edit by Clickng on the Edit Button)</i></p>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Commutation</a>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="30%">Age at Next Birth</th>
            <th width="50%">Comm Value</th> 
            <th width="20%">Actions</th>           
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['srl']; ?>">
	            <td class="edit"><?php echo $list['Age_Next_Birth']; ?></td>
	            <td class="edit"><?php echo $list['comm_value']; ?></td>             
				<td><a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['srl']; ?>"><i class="icon-trash"></i>Delete</a></td>                   	            
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
                <p>Do you want to Delete the Data?</p><?php //echo $this->uri->segment(2); ?>
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
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/commutation_index'); ?>" method="post"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Commutation</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>Age at Next Birth</b></label>
                    <div class="col-sm-6">
                        <input required="true" name="age_next" type="number" class="form-control" autocomplete="off" title="Age at Next Birth" placeholder="Please Enter Age at next birth range(10-100)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>Commutation Value</b></label>
                    <div class="col-sm-6">
                        <input required="true" name="col_value" type="number" step="any" class="form-control" autocomplete="off" title="Commutation value"  placeholder="Please Enter Commutation Value">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">Cancel</a>
               <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Commutation</button>
            </div>
        </div>
    </div>
     </form>
</div>
<style type="text/css">
    .form-horizontal .control-label {padding-top: 0px; padding-right: 5px;}
</style>
<script>
	$(document).on("click", ".open-dialog", function () {
 		var srl = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/administrator/master/commutation_del/" + srl);
	});
    $(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/commutation_update_ajax') ?>", {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
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