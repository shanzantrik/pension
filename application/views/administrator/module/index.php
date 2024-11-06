<style type="text/css">
	.body_white{width:100%;min-height:500px;border-radius:5px;padding-top: 20px;padding-left: 10px}
    #example{}
</style>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<div style="">
        
        <a href="#module_add" id="module" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Module</a>
    </div>
<div class="body_white">
    <p style="color:green"><i>(To edit module click on the row, edit the value and press <b style="color:red">ENTER</b>)</i></p>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="">Module Code</th>
            <th width="">Module Name</th>
            <th width="">Alias Name</th>
            <th>Visible on Menu <small style="color:#FFF;fontweight:bold;background-color:black">[0-YES /1-NO]</small> </th>
            <th>Menu Index</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $rec) { ?>
            <tr id="<?php echo $rec->module_code ?>">
                <td style="color:black"><?php echo $rec->module_code ?></td>
                <td class="edit" style="color:green" ><?php echo $rec->module_name ?></td>
                <td class="edit" style="color:blue" ><?php echo $rec->alias_name?></td>
                <td class="edit" style="color:red" ><?php echo $rec->type; ?></td>
                <td style="color:red" <?php if($rec->type==0){echo "class='edit'";} ?>><?php echo $rec->menu_index; ?></td>
                 <td style=""><a href="#myDelete" id="mybutton" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $rec->module_code; ?>"><i class="icon-trash"></i>Delete</a></td> 
            </tr>
        <?php } ?>
    </tbody>
</table>
<small style="color:red">Please Click on the Row to edit the record</small>
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
<script type="text/javascript" charset="utf-8">

            $(document).ready(function() {
                /* Init DataTables */
                
                var oTable=$('#example').dataTable();
                /* Apply the jEditable handlers to the table */
                oTable.$('.edit').editable("<?php echo site_url('administrator/module/update_ajax') ?>", {
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
                } );
            } );
            $(document).on("click", "#module", function () {
                     $("#success").hide();
                     $("#module_name").val('');
                     $("#alias_name").val('');
            });

            $(document).ready(function(){
            $("#save").click(function(){
                var uri=$("#url").val();
                var module_name=$("#module_name").val();
                var alias_name=$("#alias_name").val();
                var type=$("#type").val();
                var menu_index=$("#menu_index").val();
                var icon=$("#icon").val();
               $.ajax({
                    url:uri+'?module_name='+module_name+'&alias_name='+alias_name+'&type='+type+'&menu_index='+menu_index+'&icon='+icon,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend:function(){

                    },
                    success:function(data){
                        if(data.message=='true'){
                             $("#success p").html('Module Saved Successfully');
                             $('#cls').attr('class', '').addClass('alert alert-success');
                             $("#success").show();
                             $('#img').attr('src', '<?php echo base_url()?>includes/images/Success.png ?>');
                             $('#example').dataTable().fnAddData( [data.module_code,data.module_name,data.alias_name,data.type,data.menu_index,data.anchor]);
                             
                        }
                        if(data.message=='PK'){
                            $("#success p").html('Module Already Exists');
                            $('#cls').attr('class', '').addClass('alert alert-danger');
                            $('#img').attr('src', '<?php echo base_url()?>includes/images/error.png ?>');
                            $("#success").show();
                        }
                        if(data.message=='empty'){
                            $("#success p").html('Please Fill up the form');
                            $('#cls').attr('class', '').addClass('alert alert-danger');
                            $('#img').attr('src', '<?php echo base_url()?>includes/images/error.png ?>');
                            $("#success").show();
                        }      
                    }
               });
            })
        });

        $(document).on("click", "#mybutton", function () {
            var id = $(this).data('id');
            $("#del").attr("href", "<?php echo site_url()?>/administrator/module/delete/" + id);
        });
</script>

<input type="hidden" value="<?php echo site_url('administrator/module/add_module')?>" id="url" >

<div id="module_add" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Module</h4>
            </div>
            <div class="modal-body">
               <form>
                   <label>Module Name</label>
                   <input type="text" name="module_name" autofocus="true" titile="Module Name" placeholder="Module Name" autocomplete="off" id="module_name" class="form-control">
                   <label>Alias Name</label>
                   <input type="text" name="alias_name" titile="Alias Name" placeholder="Alias Name" autocomplete="off" id="alias_name" class="form-control">
                   <label>Visible on Menu</label>
                   <input type="radio" value="0" name="type" id="type">YES
                   <input type="radio" value="1" name="type" id="type">NO
                   <label>Icon</label>
                   <select name="icon" id="icon">
                    <?php foreach ($icons as $icon): ?>
                        <option value="<?php echo $icon->name ?>"><?php echo $icon->name ?></option>
                    <?php endforeach ?>
                   </select>
                   <label>Menu Index</label>
                   <input type="number" name="menu_index" titile="" placeholder="Menu Index Order" autocomplete="off" id="menu_index">
               </form>
            </div>
            <div class="modal-footer">
              <div id="success" style="display:none">
                   <div id="cls" class="alert alert-success">

                       <img id="img" width="20" height="20" src="<?php echo base_url()?>includes/images/Success.png ?>">
                       <p>Saved Succesfully</p>
                   </div>
                  
              </div>
               <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <a href="#" id="save" class="btn btn-danger" id="del">Save</a>
            </div>
        </div>
    </div>
</div>