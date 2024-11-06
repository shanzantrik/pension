<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<p style=""><i>(To Edit a Document please Click on the record write the update value and hit <span style='color:red'>Enter</span> or You can Manually edit by Clickng on the Edit Button)</i></p>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Document</a>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="15%">Document Code</th>
            <th width="20%">Document Name</th>
            <th width="20%">Description</th>
            <th width="20%">Document For</th>
            <th width="25%">Actions</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['doc_no']; ?>">
	            <td><?php echo $list['doc_no']; ?></td>
	            <td class="edit"><?php echo $list['doc_name']; ?></td>
	            <td class="edit"><?php echo $list['descrp']; ?></td>
                <td><?php echo ($list['status'] == 0) ? 'Death Case' : 'Alive Case'; ?></td>
	            <td>
                    <!-- <a href="<?php echo site_url('/administrator/master/document_edit/'.$list['doc_no'])?>" class="open-dialog-edit btn btn-success btn-rad" data-id="<?php echo $list['doc_no']; ?>"><i class="icon-pencil"></i>Edit</a> -->
    	            <a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['doc_no']; ?>"><i class="icon-trash"></i>Delete</a>
                </td>                   	                             
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
    <div class="modal-dialog">
    <form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/document_index'); ?>" method="post">                       
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Document</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>Name</b></label>
                    <div class="col-sm-6">
                        <input required title="Document Name" name="document_name" type="text" class="form-control"  placeholder="Please Enter Document Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>Description</b></label>
                    <div class="col-sm-6">
                        <textarea name="description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"><?php echo set_value('description'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>For</b></label>
                    <div class="col-sm-6">
                        <input required type="radio" name="document_for" value="0" /> Death Case
                        <input required type="radio" name="document_for" value="1" /> Alive Case
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Document</button>
            </div>
        </div>
        </form>
    </div>
</div>
<style type="text/css">
    .form-horizontal .control-label {padding-top: 0px; padding-right: 5px;}
</style>
<script>
	$(document).on("click", ".open-dialog", function () {
 		var documentId = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/administrator/master/document_del/" + documentId);
	});
    $(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/document_update_ajax') ?>", {
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