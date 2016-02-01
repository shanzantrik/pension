<form method="post" action="<?php echo site_url('administrator/Ndc/save_forwrd_dynamic') ?>">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
        <thead>
            <tr>
                <td>#</td>
                <td><b>Auto Gen File No</b></td>
                <td><b>Registration Number</b></td>
                <td><b>File No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
                <td><b>Received</b>[<small style="color:red; font-size: 10px;">Mark as Received</small>]</td>
            </tr>
        </thead>
        <tbody>
        <?php $i=100000; ?>
            <?php foreach ($records as $rec): ?>
                <tr>
                    <td><input class="checkbox1" <?php if($rec->notification=='pending'){echo "style='display:none'";}else{echo "class='btn btn-success'"; echo "style='display:show'";} ?> type="checkbox" id="chk_<?php echo $i ?>" name="chk[]"  value="<?php echo $rec->file_no ?>"></td>
                    <td><?php echo $rec->auto_file_no ?></td>
                    <td><?php echo $rec->registration_no ?></td>
                    <td><?php echo $rec->file_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo $rec->receipt_date ?></td>
                    <td><?php echo $rec->allocated_date ?></td>
                    <td>
                        <button onclick="ajax('<?php echo $rec->file_no ?>','<?php echo $i ?>')" id="<?php echo $i ?>" type="button" <?php if($rec->notification=='pending'){echo "class='btn'";}else{echo "class='btn btn-success'"; echo "disabled='true'";} ?>><i class="icon-ok"></i></button></td>
                        <?php $i=$i+1; ?>
                    </td>
                </tr>
            <?php endforeach ?>
            
        </tbody>
</table>
<br/>
<input type="checkbox" id="selecctall"/> Select All<br/>
<br/>
<a href="#forwrd" class="open-dialog btn btn-success btn-rad" data-toggle="modal"><i class=""></i>Forward</a>
<div id="forwrd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forward To</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="to" value="nda">
                Are You Sure Want To Foroward to The Superintendent of Pension
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <!-- <a href="#" class="btn btn-danger" id="del">Forward</a> -->
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $(".dataTable").dataTable();
    });
    function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/Ndc/ndc_confirm').'?file=' ?>"+x,
            dataType:'json',
            type:'GET',
            success:function(data){
                if(data.msg=='ok'){
                    $("#"+y).addClass("btn btn-success");
                    $("#"+y).attr("disabled","true");
                    $("#chk_"+y).show();
                }

            }
        });
        
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>