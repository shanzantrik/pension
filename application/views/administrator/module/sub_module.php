<!-- EDIT SUB MODULE FUNCTIONALITY PENDING -->
<p style="color:green"><i>(Click on the row to view <b style="color:red">Sub-Modules</b>)</i></p>
<a href="#module_add" id="module" class="open-dialog btn btn-primary" data-toggle="modal"><i class="icon-plus"></i>Add Module</a>
<table class="table table-striped table-bordered" width="100%">
	<tr>
		<td width="10%">Module Code</td>
		<td width="30%">Module Name</td>
		<td width="30%">Alias Name</td>
		<td width="10%">Master Entry</td>
		<td>Menu Index</td>
	</tr>
</table>
<?php foreach ($records as $rec){ ?>
<div class="toggler" id="<?php echo 'div_'.$rec->module_code ?>">
	<table class='table table-striped table-bordered' id='example' width="100%">
		<tr >
			<td width="10%"><?php echo $rec->module_code ?></td>
			<td width="30%"><?php echo $rec->module_name ?></td>
			<td width="30%"><?php echo $rec->alias_name ?></td>
			<td style="color:<?php if($rec->type==1){echo 'green';}else{ echo 'red';} ?>">
				<?php if($rec->type==1){echo "Master";}else{ echo "Non-Master";} ?>
			</td>
			<td width="10%"><?php echo $rec->menu_index ?></td>
		</tr>
	</table>
    <div style="padding-left:10%" id="">
    <a href="#myAdd" style='float:left' id="mybutton"  class="btn btn-primary sm" data-toggle="modal" data-id="<?php echo $rec->module_code; ?>" data-name="<?php echo $rec->module_name; ?>"><i class="icon-plus"></i></a>  
	    <?php 
	    	$rs=mysql_query("Select * from master_sub_module where module_code=$rec->module_code order by sub_module_code asc") or die(mysql_error());
	    	
	    	if(@mysql_num_rows($rs)>0){
	    		echo "<table style='float:right' class='table table-striped table-bordered' id='example'>";
	    		while($row=mysql_fetch_array($rs)){
	    			$smc=$row['sub_module_code'];
	    			$smn=$row['sub_module_name'];
	    			$aname=$row['alias_name'];
	    			$type=$row['type'];
	    			$menu=$row['menu'];
	    			echo '<tr>';
	    				echo "<td width='10%'>".$row['sub_module_code']."</td>";
	    				echo "<td style='color:red' width='30%'>".$row['sub_module_name']."</td>";
	    				echo "<td style='color:green' width='30%'>".$row['alias_name']."</td>";
	    				echo "<td style='color:blue' width=''>".$row['type']."</td>";
	    				echo "<td><a href='#myEdit' id='myEditButton'  class='btn btn-primary sm' data-toggle='modal' data-module_code=$rec->module_code data-module_name=$rec->module_name data-sub_module_code=$smc data-sub_module_name=$smn data-menu=$menu data-alias_name='$aname' data-type='$type' data-id='$rec->module_code'><i class='icon-pencil'></i></a>&nbsp;";
	    				echo "<a href='#myDel' id='myDeleteButton'  class='btn btn-danger sm' data-toggle='modal' data-sub_module_code=$smc  ><i class='icon-remove'></i></a></td>";
	    			echo '</tr>';
	    		}
	    		echo "</table>";
	    	} else {
	    		echo "<p style='color:red;font-weight:bold;padding-left:8px;padding-top:3px'>No Sub Modules Found</p>";
	    	}
	     ?>
     </div>
</div>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
    $('.toggler').click(function() {
        $(this).find('div').slideToggle();
    });
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var oTable=$("#exmaple").dataTable();
	});
	function trigger(x){
		alert(x);
	}
</script>
<script type="text/javascript">
		$(document).on("click", "#mybutton", function () {
            var id = $(this).data('id');
            var name=$(this).data('name');
            //alert(name);
            $("#module_name_add").val(name);
            $("#module_id").val(id);
        });
        $(document).on("click", "#myEditButton", function () {
	        var smc = $(this).data('sub_module_code');
	        var smn=$(this).data('sub_module_name');
	        var aname=$(this).data('alias_name');
	        var type=$(this).data('type');
	        var id=$(this).data('id');
	        var menu=$(this).data('menu');
	        $("#edit_mm").val(id);
	        $("#edit_module_id").val(smc);
	        $("#edit_module").val($(this).data('module_name'));
	        $("#edit_sub_module").val($(this).data('sub_module_name'));
	        $("#edit_alias_name").val($(this).data('alias_name'));
	        $("#edit_type").val(type);
	        if(menu == 'yes') {
	        	$('#edit_yes').attr('checked', 'checked');
	        } else {
	        	$('#edit_no').attr('checked', 'checked');
	        }
        });
        $(document).on("click", "#module", function () {
			$("#success").hide();
			$("#module_name").val('');
			$("#alias_name").val('');
        });
        
        $(document).on("click", "#myDeleteButton", function () {
			var id = $(this).data('sub_module_code');
            $("#delete_but").attr("href", "<?php echo site_url()?>/administrator/module/delete_sub/" + id);
        });
        $(document).ready(function(){
        	$("#s_type").change(function(){
        		var type=$("#s_type").val();
        		$('#bck_sel').empty(); 
        		var module_id=$("#module_id").val();
        		if(type=='background'){
        			$("#bck_mod").show();
        			$.getJSON('get_sub_modules?module_id='+module_id, function(data) {
					    $.each(data,function(){
					    	$("#bck_sel").append('<option value="'+ this.sub_module_code +'">'+ this.alias_name +'</option>');
					    });
					})
        		}
        		else{
        			$("#bck_mod").hide();
        		}
        	})
        });
        $(document).ready(function(){
        	$("#edit_type").change(function(){
        		var type=$("#edit_type").val();
        		$('#edit_bck_sel').empty(); 
        		var module_id=$("#edit_mm").val();
        		if(type=='background'){

        			$("#edit_bck_mod").show();
        			$.getJSON('get_sub_modules?module_id='+module_id, function(data) {
					    $.each(data,function(){
					    	$("#edit_bck_sel").append('<option value="'+ this.sub_module_code +'">'+ this.alias_name +'</option>');
					    });
					})
        		}
        		else{
        			$("#edit_bck_mod").hide();
        		}
        	})
        });
	</script>
<style type="text/css">
	div.toggler {  cursor:pointer; }
	div.toggler div { display:none; }
</style>

<div id="myEdit" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Edit Sub Module</h4>
	            </div>
	            <form method="post" action="<?php echo site_url('administrator/module/update_sub_module')?>">
		            <div class="modal-body">
		            	<label style="color:#000000">Main Module Name</label>
		                <input readonly type="text" id="edit_module" name="edit_module">
		                <input type="hidden" name="edit_module_id" id="edit_module_id">
		                <input type="hidden" name="edit_mm" id="edit_mm">
		                <label style="color:#000000">Sub Module Name</label>
		                <input required="true" type="text" name="edit_sub_module" id="edit_sub_module">
		                <label style="color:#000000">Alias Name</label>
		                <input required="true" type="text" name="edit_alias_name" id="edit_alias_name">
		                <label style="color:#000000">Type</label>
		                <select required name="edit_type" id="edit_type">
		                	<option value="">-Please Select-</option>
		                	<option value="foreground">Foreground</option>
		                	<option value="background">Background</option>
		                </select>
		                <label>Visible on Menu</label>
	                   	<input type="radio" value="yes" name="menu" id="edit_yes">YES
	                   	<input type="radio" value="no" name="menu" id="edit_no">NO
		                <div id="edit_bck_mod" style="display:none">
		                	<label style="color:#000000">Sub Main Module</label>
		                	<select id="edit_bck_sel" name="parent_module">
		                		
		                	</select>
		                </div>
		            </div>
		            <div class="modal-footer">
		               <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
		                <button type="submit" class="btn btn-success" id="del">Save</button>
		            </div>
	            </form>
	        </div>
	    </div>
	</div>
	<div id="module_add" style="margin-top:-90px" class="modal fade">
    <div class="modal-dialog">
    	<form action="<?php echo site_url('administrator/module/add_module_from_sub')?>" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Module</h4>
            </div>
            <div class="modal-body">
               
                   <label>Module Name</label>
                   <input placeholder="Please Enter Module Name" title="Please Enter Module Name" autocomplete="off" required type="text" name="module_name_sb" id="module_name" class="form-control">
                   <label>Alias Name</label>
                   <input placeholder="Please Enter Alias Name" title="Please Enter Alias Name" autocomplete="off" required type="text" name="alias_name_sb" id="alias_name" class="form-control">
               	   <label>Visible on Menu</label>
                   <input type="radio" value="0" name="type" id="type">YES
                   <input type="radio" value="1" name="type" id="type">NO
                   <label>Icon</label>
                   <select name="icon">
                   	<?php foreach ($icons as $icon): ?>
                   		<option value="<?php echo $icon->name ?>"><?php echo $icon->name ?></option>
                   	<?php endforeach ?>
                   </select>
                   <label>Menu Index</label>
                   <input type="number" name="menu_index" titile="" placeholder="Menu Index Order" autocomplete="off" id="menu_index">

            </div>
            <div class="modal-footer">
              <div id="success" style="display:none">
                  
              </div>
               <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
                <button type="submit" id="save" class="btn btn-success" id="del">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="myDel" class="modal fade" style="margin-top:-120px">
	  <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
             	<p>Are You Sure want to Delete</p>
               
            </div>
            <div class="modal-footer">
              <div id="success" style="display:none">
                  
              </div>
               <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <a href="#" id="delete_but" class="btn btn-danger">Delete</a>
            </div>
        </div>
</div>



	    <div id="myAdd" class="modal fade">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Add Sub Module</h4>
	            </div>
	            <form method="post" action="<?php echo site_url('administrator/module/save_sub_module')?>">
	            <input type="hidden" name="module_id" id="module_id">
	            <div class="modal-body">
	            	<label>Main Module Name</label>
	                <input readonly="true" type="text" id="module_name_add" name="module">
	                <label>Sub Module Name</label>
	                	<input reuired="required" placeholder="Sub Module Name" autocomplete="off" title="Sub Module Name" type="text" name="sub_module" id="sub_module" class="form-control">
	                <label style="color:#000000">Alias Name</label>
	                <input placeholder="Alias Name" title="Alias Name" autocomplete="off" required="true" type="text" name="alias_name" id="alias_name">
	                <label style="color:#000000">Type</label>
	                <select required name="s_type" id="s_type">
	                	<option value="">-Please Select-</option>
	                	<option value="foreground">Foreground</option>
	                	<option value="background">Background</option>
	                </select>
	                <label>Visible on Menu</label>
	                <input type="radio" value="yes" name="menu" id="menu" checked="checked">YES
                   	<input type="radio" value="no" name="menu" id="menu">NO
	                <div id="bck_mod" style="display:none">
	                	<label style="color:#000000">Sub Main Module</label>
	                	<select id="bck_sel" name="parent_module">
	                		
	                	</select>
	                </div>
	            </div>
	            <div class="modal-footer">
	               <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
	                <button type="submit" class="btn btn-success" id="del">Save</button>
	            </div>
	            </form>
	        </div>
	        </div>
	    
	