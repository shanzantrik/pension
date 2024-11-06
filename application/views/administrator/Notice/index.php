<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>

<script type="text/javascript">
     $('body').on('focus',"#from_date", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
       $('body').on('focus',"#to_date", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

    $('body').on('focus',"#edit_from_date", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
       $('body').on('focus',"#edit_to_date", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

   

</script>

<a href="#myAdd" style="float:right" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Notice</a>                            
<?php if (!empty($rec)): ?>
    
<?php else: ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="ss" width="100%">
    <thead>
        <tr>
            <th>From Date</th>
            <th>To Date</th>
            <th>Notification For</th>
            <th>Notice</th>                      
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($records) > 0 && $records != '') : ?>
        	<?php foreach ($records as $rec): ?>
                <tr id="">
                    <td><?php echo $rec->from_date; ?></td>
                    <td><?php echo $rec->to_date; ?></td>
                    <td><?php echo getBranchName($rec->member_group); ?></td>
                    <td><?php echo $rec->notice; ?></td>
                    <td>
                       <a href="#myDelete" class="open-dialog btn btn-danger btn-rad" data-toggle="modal" data-id="<?php echo $rec->id; ?>"><i class="icon-trash"></i></a>
                       <a href="#myEdit" id="edit_but" class="open-dialog btn btn-warning btn-rad" data-toggle="modal" data-id="<?php echo $rec->id ?>" data-fdts="<?php echo $rec->from_date ?>" data-tdt="<?php echo $rec->to_date ?>" data-notice="<?php echo $rec->notice ?>"><i class="icon-pencil"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif; ?>
    </tbody>
</table>

    <?php echo $links ?> 

<?php endif ?>
<div id="myDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure you want to delete this Notice?</h4>
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to delete this Notice, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
                <a href="#" class="btn btn-danger" id="del">Yes</a>
            </div>
        </div>
    </div>
</div>

<div id="myAdd" class="modal fade">
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/notice/'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Notice</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">From: </label>
                    
                        <div class="col-sm-6" style="margin-left:20px">
<!--                         <input required="true" id="name" name="from_date" type="text" class="form-control parsley-validated" placeholder="Please Enter District Name">
 --><input name="from_date" id="from_date" type="text" class="form-control parsley-validated" title="Provide DOB" placeholder="From Date"><?php echo form_error('dob', '<div class="error">', '</div>'); ?></td>

                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label">To: </label>
                    
                        <div class="col-sm-6" style="margin-left:20px">
<!-- <input required="true" id="name" name="to_date" type="text" class="form-control parsley-validated" placeholder="Please Enter District Name">
 --><input name="to_date" id="to_date" type="text" class="form-control parsley-validated" title="Provide DOB" placeholder="To Date"><?php echo form_error('dob', '<div class="error">', '</div>'); ?></td>
               
                    </div>
                </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Notification For: </label>
                    
<div class="col-sm-6" style="margin-left:20px">
 <select title="Choose Department" class="form-control parsley-validated parsley-success" name="branch">
                       
                         <option value="All">--All--</option>        
                          
                            <?php foreach ($branches as $branch){ ?>
                      
                              <option value="<?php echo $branch['Branch_Code'];?>"><?php echo $branch['Branch_Name']; ?></option>
                     

                      <?php } ?>
                    
                       </select>
<!-- <input required="true" id="name" name="notification_for" type="text" class="form-control parsley-validated" placeholder="Please Enter District Name">
 -->                    
                    </div>
                </div>
                 

                  <div class="form-group">
                        <div class="col-sm-6" style="margin-left:20px">
                        <textarea class="ckeditor_standard"   name="notice" placeholder="Please Enter Notice" class="form-control parsley-validated"><?php echo set_value('cor_address'); ?>Please Write Down Your Notification</textarea>
               
                    </div>
                </div>

               
            </div>
            <div class="modal-footer">
               <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Save Notice</button>
              </div>
            </div>
        </div>
    </div>
    </form>
</div>
<div id="myEdit" class="modal fade">
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/notice/update'); ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Notice</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">From: </label>
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="col-sm-6" style="margin-left:20px">
                        <input required="true" name="from_date" id="edit_from_date" type="text" class="form-control parsley-validated" title="Provide DOB" placeholder="From Date"></td>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label">To: </label>
                    
                        <div class="col-sm-6" style="margin-left:20px">
                        <input required="true" name="to_date" id="edit_to_date" type="text" class="form-control parsley-validated" title="Provide DOB" placeholder="To Date"></td>
                    </div>
                </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Notification For: </label>
                    
                <div class="col-sm-6" style="margin-left:20px">
                        <select title="Choose Department" class="form-control parsley-validated parsley-success" id="edit_branch" name="branch">
                       
                            <option value="All">--All--</option>        
                            <?php foreach ($branches as $branch){ ?>
                              <option value="<?php echo $branch['Branch_Code'];?>"><?php echo $branch['Branch_Name']; ?></option>
                             <?php } ?>
                       </select>
<!-- <input required="true" id="name" name="notification_for" type="text" class="form-control parsley-validated" placeholder="Please Enter District Name">
 -->                    
                    </div>
                </div>
                 

                  <div class="form-group">
                        <div class="col-sm-6" style="margin-left:20px">
                        <textarea required="true" id="edit_notice" class="ckeditor_standard"   name="notice" placeholder="Please Enter Notice" class="form-control parsley-validated">Please Write Down Your Notification</textarea>
               
                    </div>
                </div>

               
            </div>
            <div class="modal-footer">
               <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-save"></i>Update Notice</button>
              </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
	$(document).on("click", ".open-dialog", function () {
	 	var id = $(this).data('id');
	 	$("#del").attr("href", "<?php echo site_url()?>/administrator/notice/del/" +id );
	});
    $(document).on("click", "#edit_but", function () {
        var id = $(this).data('id');
        $("#edit_from_date").val($(this).data('fdts'));
        $("#edit_to_date").val($(this).data('tdt'));
        $("#edit_branch").val($(this).data('branch'));
        $("#edit_notice").val($(this).data('notice'));
        $("#edit_id").val(id);
        
        /*var to_date=$(this).data('to_date');
        var branch=$(this).data('branch');
        var notice=$(this).data('botice');*/
        
    });
    $(document).ready(function() {

    });



</script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>
<script type="text/javascript">
        $(document).ready(function() {
                // CKEditor Standard
                $('textarea.ckeditor_standard').ckeditor({
                    height: '150px',
                    width:'500px',
                    toolbar: [
                        {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                        {name: 'basicstyles', items: ['Bold', 'Italic']}
                    ]
                });
                 });

      
</script>



    <!-- application script for Charisma demo -->
    