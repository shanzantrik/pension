<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>

<?php $type = ($this->input->post('type') != '') ? $this->input->post('type') : ''; ?>
<?php $type_array = array('all'=>'All', 'inside'=>'Inside', 'outside'=>'Outside'); ?>

<form method="POST" action="<?php echo site_url('administrator/transfer/index'); ?>" accept-charset="UTF-8" class="form-horizontal">   
    <div style="width: 100%; text-align: center;">
	    <div class="form-group">
	        <!-- <label for="name_of_pensionser" class="control-label">Case of</label> -->
	        <select name="type" class="form-control">
	        	<?php foreach($type_array as $key=>$value) : ?>
	        		<?php if($key == $type) : ?>
	        			<option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
	        		<?php else : ?>
	        			<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
	        		<?php endif; ?>
	        	<?php endforeach; ?>
	        </select>
			<input type="submit" name="search" value="Search" class="form-control btn btn-success" id="Search" style="margin: 0px;" />
	    </div>
    </div>
</form>

<?php
$ag = array();
$treasury = array();
foreach(getAllAccountantGeneral() as $value) :
    $ag[$value['id']] = $value['name'];
endforeach;
foreach (getAllTreasury() as $value) :
    $treasury[$value['id']] = $value['title'];
endforeach;
?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%" style="margin-top: 20px!important;">
    <thead>
        <tr>
            <th width="10%">Name</th>
            <th width="10%">File No.</th>
            <th width="25%">Recieved From</th>
            <th width="25%">Sent to</th>
            <th width="20%">PPO No.</th>
			<th width="10%">Action</th>    
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($files as $file) { ?>
    		<?php
                if($file['type'] == 'inside') :
                    $recieved_from 	= str_replace(", ", ",<br />", $treasury[$file['irf']]);
                	$sent_to 		= str_replace(", ", ",<br />", $ag[$file['ist']]);
                	$ppo 			= $file['case_no']."/".$file['ppo'];
                	$url 			= 'administrator/transfer/inside';
                elseif($file['type'] == 'outside') :
                    $recieved_from 	= str_replace(", ", ",<br />", $ag[$file['orf']]);
                	$sent_to 		= str_replace(", ", ",<br />", $treasury[$file['ost']]);
                	$ppo 			= $file['ppo'];
                	$url 			= 'administrator/transfer/outside';
                endif;
            ?>
    		<tr>
	            <td><?php echo $file['name']; ?></td>
	            <td><?php echo $file['case_no']; ?></td>
	            <td><?php echo $recieved_from; ?></td>
	            <td><?php echo $sent_to; ?></td>
	            <td><?php echo $ppo; ?></td>
				<td>
					<form method="POST" action="<?php echo site_url($url); ?>" accept-charset="UTF-8">
						<input name="file_no" type="hidden" value="<?php echo $file['case_no']; ?>" />
						<input type="submit" name="search" value="View" class="form-control btn btn-default btn-rad link" style="margin: 0px;" />
					</form>
	            </td>
	        </tr>
    	<?php } ?>
    </tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
        $('#example').dataTable();
    });
</script>
<style type="text/css">
	.dataTables_wrapper {
	  margin-top: 10px;
	}
</style>