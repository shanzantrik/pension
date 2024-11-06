<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<a href="#addPera" style="float:right" id="add" class="open-dialog btn btn-primary" data-id="<?php echo $id ?>" data-toggle="modal"><i class="icon-plus"></i>Add Parameter</a>
<p style=""><i>(To Edit Pay Commission please Click on the record write the update value and hit <span style='color:red'>Enter</span> or You can Manually edit by Clickng on the Edit Button)</i></p>
<?php if ($flag==0): ?>

<?php endif; ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
	<thead>
		<tr>
			<td>Parameter Code</td>
            <td>Parameter Name</td>
			<td>Alias Name</td>
            <td>Sort Order</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($flag==1): ?>
			<?php foreach ($records as $rec): ?>
    			<tr id="<?php echo $rec['id'] ?>">
    				<td><?php echo $rec['id'] ?></td>
    				<td class="edit"><?php echo $rec['name'] ?></td>
                    <td class="edit"><?php echo $rec['alias_name'] ?></td>
                    <td class="edit"><?php echo $rec['sort_order'] ?></td>
    				<td>
    					<a class="open-dialog btn btn-danger" id="del_but" href="#delete" data-toggle="modal" data-idd="<?php echo $rec['id'] ?>"><i class="icon-trash"></i></a>
    				</td>
    			</tr>
    		<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function() {
        /* Init DataTables */
        var oTable=$('#example').dataTable();
        /* Apply the jEditable handlers to the table */
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/paycommission_update_ajax') ?>", {
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

        $("#save").click(function(){
        	var id=$("#id").val();
        	var name=$("#name").val();
            var alias_name=$("#alias_name").val();
            var dearness_allowance=$('#check_dearness_allowance').val();
            var sort_order=$('#sort_order').val();
        	if(name=='' || alias_name==''){
        			$("#success p").html('Please Fill up the form');
                    $('#cls').attr('class', '').addClass('alert alert-danger');
                    $('#img').attr('src', '<?php echo base_url()?>includes/images/error.png ?>');
                    $("#success").show();
        	} else {
        		$.ajax({
            		url:'<?php echo site_url("administrator/master/paycommission_save_pay_comn"); ?>?id='+id+'&name='+name+'&alias_name='+alias_name+'&dearness_allowance='+dearness_allowance+'&sort_order='+sort_order,
            		dataType:'JSON',
            		method:'GET',
            		success:function(data){
            			if(data.message=='success'){
            				 $("#success p").html('Parameter Added Succesfully');
                             $('#cls').attr('class', '').addClass('alert alert-success');
                             $("#success").show();
                             $('#img').attr('src', '<?php echo base_url()?>includes/images/Success.png ?>');
                             $('#example').dataTable().fnAddData( [data.pay_comm_id,data.name,data.alias_name,data.sort_order,data.anchor]);
            			}
            			if(data.message=='PK'){
            				$("#success p").html('Parameter Already Exists');
                            $('#cls').attr('class', '').addClass('alert alert-danger');
                            $('#img').attr('src', '<?php echo base_url()?>includes/images/error.png ?>');
                            $("#success").show();
            			}
            		}
        		});
        	}
        });
	});

    $(document).on("click", "#add", function () {
        var id = $(this).data('id');
        $("#id").val(id);
    });

    $(document).on("click", "#del_but", function () {
        var idd = $(this).data('idd');
        $("#del_confirm").attr("href", "<?php echo site_url()?>/administrator/master/paycommission_delete/" + idd);
    });
</script>

<div id="addPera" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Parameter</h4>
            </div>
            <div class="modal-body">
           	   <input type="hidden" id="id" name="id">
               <label>Parameter Name</label>
               <input type="text" autocomplete="off" placeholder="Please Enter Parameter Name" title="Parameter Name"  name="name" id="name" class="form-control">
               <label>Alias Name</label>
               <input type="text" autocomplete="off" placeholder="Please Enter Alias Name" title="Alias Name"  name="alias_name" id="alias_name" class="form-control">
               <label>Check if field is Dearness Allowance</label>
               <input type="checkbox" name="dearness_allowance" id="check_dearness_allowance" value="no" /><span id="check_value"> No</span>
               <label style='margin-top: 9px;'>Sort Order</label>
               <input autocomplete="off" type="number" name="sort_order" id="sort_order" />
            </div>
            <div class="modal-footer">
                <div id="success" style="display:none">
                   <div id="cls" class="alert alert-success">
                       <img id="img" style="height:20px" width="20" height="40" src="<?php echo base_url()?>includes/images/Success.png ?>">
                       <p>Saved Succesfully</p>
                   </div>
                </div>
                <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" href="#" id="save" class="btn btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="delete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
            <p>Are You Sure Want to Delete</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <a type="submit" href="#" id="del_confirm" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#check_dearness_allowance').click(function() {
            if($(this).is(":checked")) {
                $('#check_dearness_allowance').val('yes');
                $('#check_value').html(' Yes');
            } else {
                $('#check_dearness_allowance').val('no');
                $('#check_value').html(' No');
            }
        });
    });
</script>