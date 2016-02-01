<?php
	$member_type_code=$this->session->userdata('member_type_code'); 
	$uri = $this->uri->segment(2);
?>
<div id="myAccordion" class="accordion" style="">
<?php
  	$sq="Select * from privilege_module a,master_module b where member_type_code=$member_type_code and a.module_code=b.module_code and b.type=0 order by b.menu_index";
	$result=mysql_query($sq);

	if(is_resource($result)) :
		$id=0;
		while($row=mysql_fetch_array($result)){ ?>
		  	<div class="accordion-group">

		  		<?php if($row['alias_name'] == "Dashboard") { ?>
		  			<div class="accordion-heading">
		            	<a style="text-decoration: none;" href="<?php echo site_url('administrator/home'); ?>" class="accordion-toggle"><i class="<?php echo $row['icon'] ?>"></i>&nbsp;&nbsp;<b><?php echo $row['alias_name'] ?></b></a>
		        	</div>
				<?php } else { ?>
					<div class="accordion-heading">
			            <a style="text-decoration: none;" href="#<?php echo $id;?>" data-parent="#myAccordion" data-toggle="collapse" class="accordion-toggle"><i class="<?php echo $row['icon'] ?>"></i>&nbsp;&nbsp;<b><?php echo $row['alias_name'] ?></b></a>
			        </div>
				<?php } ?>
		        <div class="accordion-body collapse <?php if($uri==$row['module_name']){echo ' in';} ?>" id="<?php echo $id;?>">
		        <?php 
		        	$main_mod=$row['module_code'];	
					$sql= "SELECT a.*,c.*,
							b.sub_module_name as sub_module_name,b.alias_name as al_name
							 from privilege_sub_module a,master_sub_module b,master_module c
							 where 
							 a.module_code=b.sub_module_code 
							 and a.member_type_code=$member_type_code 
							 and a.main_module_code=c.module_code 
							 and b.type='foreground' 
							 and b.menu='yes' 
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
				            	<a href="<?php echo $url ?>"><?php echo $alias_name;?></a>
				            </div>
		            <?php } } ?>
		        </div>
		    </div>
		    <?php
		    $id=$id+1;
		}
	else :
		redirect(site_url());
	endif; ?>
</div>