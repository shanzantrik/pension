
<script type="text/javascript">

    $(document).ready(function(){
        $("#example1").dataTable();
    });
    $(document).ready(function()
    {
        $('#example').dataTable();
    });
       $(document).ready(function()
    {
        $('#example2').dataTable();
    });
    $(document).ready(function()
    {
        $('#example3').dataTable();
    });

           function ajax(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/da_notification/da_confirm').'?file=' ?>"+x,
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
    }      function ajax1(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/da_notification/da_confirm_from_director').'?file=' ?>"+x,
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
	function ajax2(x,y){
	//alert("hello");
        $.ajax({
            url:"<?php echo site_url('administrator/da_notification/da_confirm_from_ips').'?file=' ?>"+x,
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
	/*function validate(){
        if($(document).find('input[type=radio]:checked').length==0){
            alert('You Must Select');
            return false;
        }else{
            return true;
        }
    }*/

	function ajax3(x,y){
        $.ajax({
            url:"<?php echo site_url('administrator/director/pen_confirm_from_jd_fao_superintendent').'?file=' ?>"+x,
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

	
   /*function ajax2(x,y){
           $.ajax({
            url:"<?php echo site_url('administrator/director/ips_confirm_by_director').'?file=' ?>"+x,
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
*/	 $(document).ready(function() {
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
/*	  function ajax2(x,y){
	  alert(okkkkk);
   //alert("okk");
   		$.get('<?php echo site_url('administrator/director/ips_confirm'); ?>', {file: x}, function(data){
			if(data=='ok'){
				$("#"+y).addClass("btn btn-success");
				$("#"+y).attr("disabled","true");
				$("#chk_"+y).show();
			}
		});
    }  */
</script>


<h3>VIEW Receipt File</h3><hr style="margin: 5px 0;"/>
<ul class="nav nav-tabs" id="myTab">
<li onclick="$('#pension').hide();$('#receipt').show();$('#abc').hide()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_10049')?>#receipt" data-toggle="tab" ><b>Pension File</b></a></li>
    <li style="color:" onclick="$('#receipt').hide();$('#pension').show();$('#abc').hide()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>IPS</b></a></li>
       <li style="color:" onclick="$('#receipt').hide();$('#pension').hide();$('#abc').show()"><a href="<?php echo site_url('/administrator/ips/view_pensioner/_1001')?>#pension" data-toggle="tab"><b>GIS</b></a></li>
</ul>
<div class="tab-content" style="overflow: visible;">
  <!-- From Receipt -->
<form method="POST" onsubmit="return validate()" action="<?php echo site_url('administrator/superintendent/save_fwd_to_Pensionda')?>">
<div class="tab-pane-active" id="receipt">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
            <tr>
                <td>#</td>
                <td><b>Token No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
           </tr>    
            </thead>
    <tbody>
        <?php $i=100000; ?>
            <?php foreach($records as $rec):?>
                 <tr>
<td><input class="checkbox1" type="checkbox" name="chk[]"  value="<?php echo $rec->file_No ?>">
    	<input type="hidden" name="fileno[]" value="<?php echo $rec->file_No ?>">
    	</td>                   
                    <td><?php echo $rec->token_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo dateTimeToDate($rec->receipt_date, 'd-m-Y'); ?></td>
                    <td><?php echo dateTimeToDate($rec->allocated_date, 'd-m-Y'); ?></td>
                </tr>
            <?php endforeach?>
    </tbody>
</table>
<?php if(count($records) > 0) : ?>
    <input type="checkbox" id="selecctall"/>Select All
<?php endif; ?>
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
                <select name="member_code" id="member_code" required="true">
                    <option value="">--Please Select--</option>
                    <?php foreach ($da as $b) {
                        echo "<option value=".$b->member_code.">".$b->member_name.'/'.$b->section."</option>";
                    } ?>
                </select>
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <!-- <a href="#" class="btn btn-danger" id="del">Forward</a> -->
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</br>
</div>
</form>

<div class="tab-pane" id="pension">
<form method="POST" action="<?php echo site_url('administrator/superintendent/save_fwd_to_ipsda') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1" width="100%">
    <thead>
        <tr>
                <td>#</td>
                <td><b>Token No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
           </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($records1 as $rec):?>
            <tr>
<td><input class="checkbox1" type="checkbox" name="chk[]"  value="<?php echo $rec->file_No ?>">
    	<input type="hidden" name="fileno[]" value="<?php echo $rec->file_No ?>">
    	</td>                   
                    <td><?php echo $rec->token_no ?></td>
                    
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo dateTimeToDate($rec->receipt_date, 'd-m-Y') ?></td>
                    <td><?php echo dateTimeToDate($rec->allocated_date, 'd-m-Y') ?></td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDel" data-toggle="modal" class="btn btn-primary">Forward</a>
<div id="myDel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files </h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward these files, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>



<div class="tab-pane" id="abc">
<form method="POST" action="<?php echo site_url('administrator/superintendent/save_fwd_to_gisda') ?>">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2" width="100%">
    <thead>
        <tr>
                <td>#</td>
                <td><b>Token No</b></td>
                <td><b>Dept Forwarding No</b></td>
                <td><b>Employee Code</b></td>
                <td><b>Pensionee Name</b></td>
                <td><b>Designation</b></td>
                <td><b>Receipt Date</b></td>
                <td><b>Allocated Date</b></td>
           </tr>
    </thead>
    <tbody>
      <?php $i=100000; ?>
        <?php foreach ($records2 as $rec):?>
            <tr>
<td><input class="checkbox1" type="checkbox" name="chk[]"  value="<?php echo $rec->file_No ?>">
    	<input type="hidden" name="fileno[]" value="<?php echo $rec->file_No ?>">
    	       </td>                   
                    <td><?php echo $rec->token_no ?></td>
                    <td><?php echo $rec->dept_forw_no ?></td>
                    <td><?php echo $rec->emp_code ?></td>
                    <td><?php echo $rec->salutation.'. '.$rec->pensionee_name ?></td>
                    <td><?php echo $rec->designation ?></td>
                    <td><?php echo dateTimeToDate($rec->receipt_date, 'd-m-Y'); ?></td>
                    <td><?php echo dateTimeToDate($rec->allocated_date, 'd-m-Y'); ?></td>
                </tr>
            <?php endforeach ?>
    </tbody>
</table>
<br/>
<a href="#myDel31" data-toggle="modal" class="btn btn-primary">Forward</a>
<div id="myDel31" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you Sure want to Forward these Files </h4>
                <input type="hidden" name="to" value="superintendent_ips">
            </div>
            <div class="modal-body">
                <p class="text-warning">Click Yes, if you are sure to forward these files, otherwise Click No</p>
            </div>
            <div class="modal-footer">
               <a class="btn btn-danger" data-dismiss="modal">No</a>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>

</div>























































