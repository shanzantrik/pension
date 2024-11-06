<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<p style=""><i>(To Edit a DA please Click on the record write the update value and hit <span style='color:red'>Enter</span> or You can Manually edit by Clickng on the Edit Button)</i></p>
<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Da</a>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="30%">From</th>
            <th width="50%">Percentage</th> 
            <th width="20%">Actions</th>           
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['serial_no']; ?>">
	            <td class="edit" width="30%"><?php echo $list['from']; ?></td>
	            <td class="edit" width="50%"><?php echo $list['percentage']; ?></td>             
				<td width="20%">
	            <a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $list['serial_no']; ?>"><i class="icon-trash"></i>Delete</a></td>                   	            
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
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/master/da_index'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Percentage</h4>
            </div>
            <div class="modal-body">
                <div id="alert" style="display:none" class="alert alert-danger">
                    <p align="center">Percantage Must be less then 100</p>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>From Date</b></label>
                    <div class="col-sm-6">
                        <input name="from" id="from" type="text" title="From Date" autocomplete="off" required="true" class="form-control" placeholder="Please Enter From Date" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><b>Percentage</b></label>
                    <div class="col-sm-6">
                        <input id="per" name="percentage" type="number" title="Percantage" autocomplete="off" required="true" class="form-control" placeholder="Please Enter Percentage" />
                    </div>
                </div>         
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" id="but" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save DA</button>
            </div>
        </div>
    </div>
     </form>
</div>
<style type="text/css">
    .form-horizontal .control-label {padding-top: 0px; padding-right: 5px;}
</style>
<script type="text/javascript">
	$(document).on("click", ".open-dialog", function () {
 		var srl = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/administrator/master/da_del/" + srl);
	});
	$(function() {
  		$("#from").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
  	});
    $(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/master/da_update_ajax') ?>", {
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

        /*$("#per").blur(function(){
            var val=$("#per").val();
            if(val>100){
                $("#alert").fadeIn('slow');
                $("#but").hide();
            } else {
                $("#but").show();
                $("#alert").fadeOut('slow');
            }
        });*/

        $("#from").change(function(){
            var dateFields =($("#from").val()).split('-');
            //var date = Date(dateFields[2],dateFields[1]-1, dateFields[0]);
            var d = new Date();
            var month = d.getMonth();
            var date = d.getDate();
            var year = d.getFullYear();
            if(dateFields[0]>year){
                $("#alert").fadeIn('slow');
                $("#alert p").html('Please Enter a date before today.');
                $("#but").hide();
            } else {
                $("#alert").fadeOut('slow');
                $("#but").show();
            }
        });
    });
</script>