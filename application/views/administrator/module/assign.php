<?php 
	$display=base64_decode(@$_GET['display']);
	if(empty($display)){
		$display='none';
	}
	$alert=base64_decode(@$_GET['alert']);
	$msg=base64_decode(@$_GET['msg']);
 ?>
<div style="display:<?php echo $display ?>" class="alert alert-<?php echo $alert?>">
	<?php echo $msg; ?>
</div>
<div style="width: 55%; float: left;">
	<div class="form-group" style="float:left;width:52%">
		<label><b>Member Type</b></label>
		<select name="member_type" id="member_type">
		<?php foreach ($records as $rec): ?>
			<option value="<?php echo $rec->member_type_code ?>"><?php echo $rec->member_type_name; ?></option>
		<?php endforeach ?>
		</select>
	</div>
	<div class="form-group" style="float:left; margin-left: 4px;width:46%">
		<label><b>Module</b></label>
		<select name="modules" id="modules">
			<option value="">-Please Select-</option>
			<?php foreach ($modules as $mod): ?>
				<option value="<?php echo $mod->module_code ?>"><?php echo $mod->alias_name ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div style="width:100%">
		<div id="sub_mod_values" style="float:left">
			
		</div>
		<div id="btn-group" style="float:left;margin-left:10px;padding-top:60px">
			
		</div>
		<div id="sub_mod_values_saved" style="float:left">
			
		</div>
	</div>
</div>
<!-- <div style="float: left; width: 44%;">
	<?php $member_type_code=$this->session->userdata('member_type_code'); ?>
	<div id="assignMyAccordion" class="accordion" style="">
	<?php
	  	$sq="Select * from privilege_module a,master_module b where member_type_code=$member_type_code and a.module_code=b.module_code and b.type=0 order by b.menu_index";
		$result=mysql_query($sq);
		$id=0;
		while($row=mysql_fetch_array($result)){ ?>
	        <div class="accordion-group">
				<div class="accordion-heading">
		            <a style="text-decoration: none;" href="#<?php echo "assign-".$id;?>" data-parent="#assignMyAccordion" data-toggle="collapse" class="accordion-toggle">&nbsp;&nbsp;<b><?php echo $row['alias_name'] ?></b></a>
		        </div>
		        <div class="accordion-body collapse" id="<?php echo $id;?>">
		        <?php 
		        	$main_mod=$row['module_code'];	
					$sql= "SELECT a.*,c.*,
							b.sub_module_name as sub_module_name,b.alias_name as al_name
							 from privilege_sub_module a,master_sub_module b,master_module c
							 where 
							 a.module_code=b.sub_module_code 
							 and a.member_type_code=$member_type_code 
							 and a.main_module_code=c.module_code 
							 and a.main_module_code=$main_mod";
					$regx=mysql_query($sql);
					while($rowx=mysql_fetch_array($regx)) {			
						$sub_mod_name=$rowx['sub_module_name'];
						$main_module_name=$rowx['module_name'];
						$alias_name=$rowx['al_name'];
						$url=site_url('administrator').'/'.$main_module_name.'/'.$sub_mod_name; ?>
						<?php if($alias_name == "Dashboard") { ?>
			            
			            <?php } else { ?>
			            	<div class="accordion-inner" style="padding-left:40px">
			            		<?php echo $alias_name;?>
			            	</div>
		            <?php } } ?>
		       	</div>
		    </div>
		    <?php
		    $id=$id+1;
		} ?>
	</div>
</div> -->
<style type="text/css">
	.table {margin-bottom: 0px;}
	.marginBottom {margin-bottom: 10px;}
</style>
<script>
	$(document).ready(function(){
		$("#btn-group").hide();
		$("#modules").change(function(){
			var mcode=$("#modules").val();
			var mt=$("#member_type").val();
			$.ajax({
				url:'get_mod?mcode='+mcode+'&member_type_code='+mt,
				type: 'GET',
                dataType: 'html',
                success:function(data){
                	$("#btn-group").show();
                	$("#sub_mod_values").html(data);
                }
			});
		});
		$("#member_type").change(function(){
			var member_type=$("#member_type").val();
			$.ajax({
				url:'get_modules?member_type='+member_type,
				type:'GET',
				dataType:'html',
				success:function(data){
					$("#modules").val(data);
				}
			});
		});
	});
</script>