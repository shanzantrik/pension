<h4>Pension -> Family -> Superannuation pension</h4>
<?php 
	$val = $values[0];
	$serial_no=$val['serial_no'];
    $family_info=unserialize($val['family_info']);
	if(!empty($check_file_no)) {
		$reautho=$reautho_details[0];
    	if(count($reautho)>0) {
			//if(!empty($reautho)){
			$file_no = $reautho['file_no'];
			$file_id = $reautho['id'];
			$claiment_name=$reautho['claiment_name'];
			/*$child_dob=$reautho['claiment_dob'];
			$pensioner_dod=$reautho['pensioner_dod'];
			$pensioner_husbandwife_dod=$reautho['pensioner_husbandwife_dod'];
			$enhanrate_from=$reautho['enhanrate_from'];
			$age_25=$reautho['age_25'];
			$enhanrate_upto=$reautho['enhanrate_upto'];
		    $enhanrate_upto_for_child=$reautho['enhanrate_upto_for_child'];
			$ordrate_from=$reautho['ordrate_from'];*/
			$arrname=array($claiment_name);
		} else {
			$claiment_name='';
			$arrname=array();
		}
	}
?>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
    <thead>
        <tr>
            <th width="10%">Salutation</th>
            <th width="10%">Child Name</th>
            <th width="15%">Date of birth</th>
            <th width="15%">action</th> 
            <th width="15%">print</th>  
			             
        </tr>
    </thead>
    <tbody>
        <?php
        	foreach ($family_info as $key => $value) {  
		   		if(isset($value['child'])){
					$child_info = $value['child'];
					///if(!empty($value['child']))  {
					foreach ($child_info as $key => $ci) { ?>
					<tr>
                		<?php
                			$name=mysql_real_escape_string(trim($ci['name']));
                      		$salutation=$ci['salutation'];
                		?>
		                <td><?php echo $salutation;?></td>
		                <td><?php echo $name;?></td>
		                <td><?php echo $ci['dob'];?></td>
                		<td><a href="<?php echo site_url('/administrator/Reauthorization/open_reautho_form/'.$serial_no).'/'.$ci['dob'].'/'.$name.'/'.$salutation;?>" class="open-dialog-edit btn btn-success btn-rad" data-id="<?php //echo $list['Branch_Code']; ?>"><i class="icon-pencil"></i>Reauthorize</a></td>
                		<?php
			  				if(!empty($check_file_no)) {
			 					if(in_array($name,$arrname)) { ?>
	                		<td>
								<?php foreach($reautho_details as $rd): ?>
	                        		<a href="<?php echo site_url('/administrator/Reauthorization/get_report/'.$serial_no).'/'.base64_encode($rd['id']).'/'.$salutation; ?>" target="_blank" class="open-dialog-edit btn btn-warning data-id=""><i class="icon-pencil"></i>Print</a>
	                    		<?php endforeach; ?>
	                		</td>
                				<?php } 
							} else { ?>
								<td>Not Reauthorized</td>
            			<?php }
					}
	  			}
			} ?>
	  	</tr>
    </tbody>
</table>

<script>
	$(document).on("click", "#delete", function () {
 		var Branch_CodeId = $(this).data('id');
 		$("#del").attr("href", "<?php echo site_url()?>/administrator/branch/del/" + Branch_CodeId);
	});
	$(document).on("click", "#edit", function () {
 		var id = $(this).data('id');
 		var name=$(this).data('name');
 		var description=$(this).data('description');
 		var deptcode=$(this).data('deptcode');
 		$("#e_branch_code").val(id);
 		$("#e_branch_name").val(name);
 		$("#e_description").val(description);
 		$("#e_department_code").val(deptcode);
	});

	$(document).ready(function() {
        var oTable=$('#example').dataTable();
        oTable.$('.edit').editable("<?php echo site_url('administrator/branch/update_ajax') ?>", {
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
    });
</script>