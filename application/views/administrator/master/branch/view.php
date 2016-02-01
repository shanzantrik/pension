<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<p style=""><i>(To Edit a Designation please Click on the record write the update value and hit <span style='color:red'>Enter</span> or You can Manually edit by Clickng on the Edit Button)</i></p>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Branch</a>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="10%">Branch Code</th>
            <th width="15%">Branch Name</th>
            <th width="30%">Description</th>
			<th width="10%">Action</th>      
			             
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['Branch_Code']; ?>">
	            <td><?php echo $list['Branch_Code']; ?></td>
	            <td class="edit"><?php echo $list['Branch_Name']; ?></td>
	            <td class="edit"><?php echo $list['Description']; ?></td>  
				<td>
				    <!-- <a href="<?php echo site_url('/administrator/master/branch_edit/'.$list['Branch_Code'])?>" class="open-dialog-edit btn btn-success btn-rad" data-id="<?php echo $list['Branch_Code']; ?>"><i class="icon-pencil"></i>Edit</a>  -->
                    <a href="#myDelete" id="delete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['Branch_Code']; ?>"><i class="icon-trash"></i>Delete</a>
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
    <form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/branch_index'); ?>" method="post">						
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Branch</h4>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label"><b>Branch Name</b></label>
					<div class="col-sm-6">
						<input autocomplete="off" required name="branch_name" type="text" value="<?php echo set_value('branch_name'); ?>" class="form-control parsley-validated" placeholder="Please Enter Branch Name"><?php echo form_error('branch_name', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><b>Description</b></label>
					<div class="col-sm-6">
						<textarea name="description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"></textarea>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Branch</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div id="myEdit" class="modal fade">
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/branch_edit'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Branch</h4>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">Branch Name</label>
					<div class="col-sm-6">
						<input type="hidden" name="branch_code" id="e_branch_code" />
						<input autocomplete="off" required name="branch_name" id="e_branch_name" type="text"  class="form-control parsley-validated" placeholder="Please Enter Branch Name">
					</div>
				</div><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label">Description</label>
					<div class="col-sm-6">
						<textarea name="description" id="e_description" placeholder="Please Enter Desciption if you want" class="form-control parsley-validated"></textarea>
					</div>
				</div><br/>
				<div class="form-group">
					<label class="col-sm-3 control-label">Department</label>
					<div class="col-sm-6">
						<select required class="form-control" name="department_code" id="e_department_code">
							<option value="">--Please Select--</option>
							<?php foreach (getAllDepartment() as $dept) { ?>
								<option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Branch</button>
            </div>
        </div>
        </form>
    </div>    
</div>
<style type="text/css">
    .form-horizontal .control-label {padding-top: 0px; padding-right: 5px;}
</style>
<script>
	$(document).on("click", "#delete", function () {
 		var Branch_CodeId = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/administrator/master/branch_del/" + Branch_CodeId);
	});
	$(document).on("click", "#edit", function () {
 		var id = $(this).data('id');
 		var name=$(this).data('name');
 		var description=$(this).data('description');
 		var deptcode=$(this).data('deptcode');
 		$("#e_branch_code").val(id);
 		$("#e_branch_name").val(name);
 		$("#e_description").val(description);
 		$("#e_department_code").val(deptcode);
	});

	$(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/branch_update_ajax') ?>", {
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