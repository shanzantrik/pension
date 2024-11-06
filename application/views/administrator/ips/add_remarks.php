

<?php 
$row = $receipt[0]; 
?>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>
<div class="tab-content" style="overflow: visible;">


<?php //if (!empty($records[0])): ?>
<form class="form-horizontal group-border-dashed" action="<?php echo site_url('administrator/ips/add_remarks_controller/'/*.base64_encode($file_no)*/); ?>" method="post" parsley-validate="" novalidate="" autocomplete="off">
     <div class="row-fluid sortable">
        <div class="box span12">  
       <!--  <form> -->
        <table border="0">
        <tr>
        <td width="5%"><br/></td>
        <td></td>
        <td width="3%"></td>
        <td></td>
        </tr>
        <?php 
        //$i=100000;
        //foreach ($lists3 as $key): 
        ?>
        <tr>
            <td></td>
            <td width="20%">              
            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">1.&nbsp;&nbsp;&nbsp;&nbsp;Case No.:</label>
            </td>
            <td></td><!-- $key->file_no; -->
            <td><input name="case_no" id="case_no" type="text" value="<?php echo $row['file_No']; ?>" style="pointer-events: none;"/><?php //echo form_error('case_no', '<div class="error">', '</div>');?>
            </td>
        </tr>
        <?php //endforeach ?>
        <tr>
            <td></td>
            <td width="20%">              
            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">2.&nbsp;&nbsp;&nbsp;&nbsp;Observation by:</label>
            </td>
            <td></td>
            <td width=""><input name="observation_by" id="observation_by" type="text" value="<?php //echo $pensioner->observation_by; ?>"><?php //echo form_error('observation_by', '<div class="error">', '</div>');?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td width="20%">              
            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">3.&nbsp;&nbsp;&nbsp;&nbsp;Observation Date:</label>
            </td>
            <td></td>
            <td width=""><input autocomplete="off" name="observation_date" id="observation_date" type="text" value=""><?php //echo form_error('observation_by', '<div class="error">', '</div>');?>
             <!-- <input autocomplete="off" name="dob" id="dob" type="text" value="<?php echo set_value('dob'); ?>" placeholder="Please Enter Date of Birth"> -->
            </td>
        </tr>
        <tr>
            <td></td>
            <td width="20%">              
            <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">4.&nbsp;&nbsp;&nbsp;&nbsp;Remarks:</label>
            </td>
            <td></td>
            <td width=""><textarea class="ckeditor_standard" id='ckeditor_standard' name="remarks"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <label style="width:auto;font-weight:bold" class="col-sm-3 control-label">5.&nbsp;&nbsp;&nbsp;&nbsp;IPS passed:</label>
            </td>
            <td></td>
            <td>
                <input type="radio" name="ips_pass" id="ips_pass" value="1">Yes
                <input type="radio" name="ips_pass" id="ips_pass" value="0">No
                
            </td>
        
        </tr>
        <tr>
        <td width="5%"><br/></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td><br/></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="submit" value="Save" id="saveServiceBook" class="btn btn-primary" />
        </td>
        </tr>
        <tr>
        <td width="5%"><br/></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </table>
        
        </div>
    </div>
    </form>
    <?php //endif ?>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('textarea.ckeditor_standard').ckeditor({
            height: '150px',
            width:'500px',
            toolbar: [
                {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], // Defines toolbar group without name.
                {name: 'basicstyles', items: ['Bold', 'Italic']}
            ]
        });
         
        $( "#observation_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth:true,
            yearRange:'2000:2050'
        });
    
    });
   
</script>                 
<script src='<?php echo base_url()?>includes/js/scripts.js'></script>




