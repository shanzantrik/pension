<form method="POST" autocomplete="off" action="<?php echo site_url('administrator/searchpanel/searchReportByDA'); ?>" accept-charset="UTF-8">   
	<table width="100%">
	<tr>
	<td>
		<div class="form-group">
        <label class="col-md-12 control-label">From: </label>
        <div class="col-md-12">
        <input class="form-control" id="search_input_from" name="search_input_from" placeholder="yyyy-mm-dd" />
    	</div>
    	</div>
	</td>
	<td>
		<div class="form-group">
        <label class="col-md-12 control-label">To: </label>
        <div class="col-md-12">
        <input class="form-control" id="search_input_to" name="search_input_to" placeholder="yyyy-mm-dd" />
    	</div>
    	</div>
	</td>
	<td>
		<div class="form-group">
        <label for="name_of_pensionser" class="col-md-12 control-label">DA (%): </label>
        <div class="col-md-12">
        <Select class="form-control" id="search_input_da" name="search_input_da">
        	<option value="">-Select-</option>
        	<?php 
        	foreach ($result as $data) {
        		echo "<option value='".$data->da."'>".$data->da."</option>";
        	}
        	?>
        </Select>
    	</div>
    	</div>
	</td>
	<td>
		<input type="submit" name="search_btn" value="Search" class="btn btn-success" style="margin: 0px;" />
	</td>
</tr>
</table>
</form>

<?php if(isset($_POST['search_btn'])): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
	    	<h3>&nbsp;</h3>
	    	<table class="table table-sm table-bordered" id="tblSearchDa">
	    		<thead>
	    			<tr>
	    				<th>File No</th>
	    				<th>Pensioner Name</th>
	    				<th>Class of Pension</th>
	    				<th>DA %</th>
	    				<th>Actions</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<?php
	    			foreach ($datas as $data) {
        			
        			if($search_input_das!=''){
        				$pay_info = unserialize($data->pay_info);
        				if($search_input_das==$pay_info[0]["post_DA"]){
        			?>
						<tr>
	    				<td><?php echo $data->case_no; ?></td>
	    				<td><?php echo $data->name; ?></td>
	    				<td><?php echo str_replace("_", " ", $data->class_of_pension);?></td>
	    				<td><?php echo $search_input_das; ?></td>
	    				<td><a href="<?php echo site_url('/administrator/pension/'.strtolower($data->class_of_pension).'/'.$data->serial_no)?>" class="btn btn-default btn-rad link" data-id="<?php echo $data->serial_no; ?>"><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
	                    <a href="<?php echo site_url('/administrator/service_book/edit/'.$data->serial_no); ?>" class="btn btn-default btn-rad link" data-id="<?php echo $data->serial_no; ?>"><i class="icon-pencil"></i> Edit</a><?php echo nbs(3); ?>
	                    <select class="action-list">
	                        <option value="0">--Select Report--</option>
	                        <option value="<?php echo site_url('/administrator/report/'.strtolower($data->class_of_pension).'/'.$data->serial_no)?>">Worksheet</option>
	                        <!-- <option value="<?php echo site_url('/administrator/disburser/'.strtolower($data->class_of_pension).'/'.$data->serial_no); ?>">Disburser</option> -->
	                        <option value="<?php echo site_url('/administrator/service_book/reportIO/'.strtolower($data->class_of_pension).'/'.$data->serial_no); ?>">Report</option>
	                    </select></td>
		    			</tr>
        			<?php
	    				}
        			}else{
	    			
	    			?>
					<tr>
	    				<td><?php echo $data->case_no; ?></td>
	    				<td><?php echo $data->name; ?></td>
	    				<td><?php echo str_replace("_", " ", $data->class_of_pension);?></td>
	    				<td></td>
	    				<td><a href="<?php echo site_url('/administrator/pension/'.strtolower($data->class_of_pension).'/'.$data->serial_no)?>" class="btn btn-default btn-rad link" data-id="<?php echo $data->serial_no; ?>"><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                    <a href="<?php echo site_url('/administrator/service_book/edit/'.$data->serial_no); ?>" class="btn btn-default btn-rad link" data-id="<?php echo $data->serial_no; ?>"><i class="icon-pencil"></i> Edit</a><?php echo nbs(3); ?>
                    <select class="action-list">
                        <option value="0">--Select Report--</option>
                        <option value="<?php echo site_url('/administrator/report/'.strtolower($data->class_of_pension).'/'.$data->serial_no)?>">Worksheet</option>
                        <!-- <option value="<?php echo site_url('/administrator/disburser/'.strtolower($data->class_of_pension).'/'.$data->serial_no); ?>">Disburser</option> -->
                        <option value="<?php echo site_url('/administrator/service_book/reportIO/'.strtolower($data->class_of_pension).'/'.$data->serial_no); ?>">Report</option>
                    </select></td>
	    			</tr>
	    			<?php } } ?>
	    		</tbody>
	    	</table>
	    </div>
    </div>
<?php endif; ?>


















<style type="text/css">
	form {margin-bottom: 3px;}
	hr {margin: 0px;}
    .form-group {}
    .form-group label {font-weight: bold; float: left; margin-top: 15px;}
    .form-group input {margin-left: 10px;  margin-top: 10px;}
    .btn {padding: 6px;}
    .action-list {width: 150px;  margin: 0px;}
    .form-group .input, .form-group select {margin-top: 10px;}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$("#tblSearchDa").dataTable();

		$("#search_input_from").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
		$("#search_input_to").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
	});
</script>