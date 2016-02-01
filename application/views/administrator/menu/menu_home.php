<div class="accordion-group">

			<?php 
				$q=mysql_query("SELECT * 
					FROM content_manager
					ORDER BY  `content_manager`.`index` ASC ");
				while($row=mysql_fetch_array($q)){
					$page=str_replace(' ', '_', $row['page_title']);
			?>
	        <div class="accordion-heading">
	            <a style="text-decoration: none;" href="<?php echo site_url('home/view').'/'.$page ?>" data-parent="" data-toggle="" class="accordion-toggle"><i class="<?php echo $row['icon'] ?>"></i></i>&nbsp;&nbsp;<b><?php echo $row['page_title'] ?></b></a>
	        </div>

	        <?php } ?>

        	
</div>