<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add District</a>                            
<p style=""><i>(To Edit a District please Click on the record write the update value and hit <span style='color:red'>Enter</span>)</i></p>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="20%">District Code</th>
            <th width="20%">District Name</th>
            <th width="40%">State</th>
            <th width="20%">Actions</th>                      
        </tr>
    </thead>
    <tbody>
    	<?php foreach (getAllDistrict() as $list) { ?>
    		<tr id="<?php echo $list['district_code'];?>">
	            <td><?php echo $list['district_code']; ?></td>
                <td class="edit"><?php echo $list['district_name']; ?></td>
                <td class="edit"><?php echo $list['state']; ?></td>         
				<td>
	            <a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['district_code']; ?>"><i class="icon-trash"></i>Delete</a></td>                   	                       
	        </tr>
    	<?php } ?>
    </tbody>
</table>
<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure you want to delete this department?</h4>
            </div>
            <div class="modal-body">
                 
                <span style="color:red"><?php echo $list['district_name']; ?></span>
                <p class="text-warning"><small>Click Yes, if you are sure to delete this department, otherwise Click No</small></p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
                <a href="#" class="btn btn-danger" id="del">Yes</a>
            </div>
        </div>
    </div>
</div>

<div id="myAdd" class="modal fade">
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/district_save'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add District</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Name: </label>
                        <div class="col-sm-6" style="margin-left:20px">
                        <input required="true" id="name" name="district_name" type="text" class="form-control parsley-validated" placeholder="Please Enter District Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">State: </label>
                        <div class="col-sm-6" style="margin-left:20px">
                        <input required="true" id="state" name="state" type="text" class="form-control parsley-validated" placeholder="Please Enter State Name" value="Arunachal Pradesh">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save District</button>
              </div>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
	$(document).on("click", ".open-dialog", function () {
	 	var designationId = $(this).data('id');
	 	$("#del").attr("href", "<?php echo site_url()?>/administrator/master/district_del/" + designationId);
	});
    $(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/district_update_ajax') ?>", {
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
    $(document).ready(function() {
        $('#example').dataTable();

        $("#dept_name").blur(function(){
            if($.trim($('#dept_name').val())!=''){
                $("#dept_short_code").prop('disabled',false);
                var str=$('#dept_name').val();
                var arr = str.split(' ');
                var sh='';
                for(var i=0; i<arr.length; i++) {
                    sh=sh+arr[i].charAt(0);
                    $("#dept_short_code").val(sh.toUpperCase());
                }
            } else {
                $("#dept_short_code").prop('disabled',true);
                $("#dept_short_code").val('');
            }
        });
    });
</script>    