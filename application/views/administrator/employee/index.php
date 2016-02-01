<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/js/jquery.dataTables.js"></script>
<script data-jsfiddle="common" src="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.js" data-jsfiddle="common"></script>
<link href="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.css" data-jsfiddle="common" rel="stylesheet" media="screen">

<p class="user-message"><i>(To Edit a Employee please Click on the <span style="color:red">Edit</span> Button)</i></p>
<!-- <a href="<?php echo site_url('administrator/employee/add');?>" class="open-dialog btn btn-primary" style="float:right"><i class="icon-plus"></i>Add Employee</a> -->
<a href="#" class="open-dialog btn btn-primary add-employee" style="float:right"><i class="icon-plus"></i>Add Employee</a>

<br /><br />
<div id="add-employee-form" style="display: none;">
	<div id="add-employee-list-table"></div>
	<br />
	<input type="button" id="save" name="save" value="Save" disabled class="btn btn-primary" />
</div>

<script data-jsfiddle="example">
	var data = [];

	var $container = $("#add-employee-list-table");

	$container.handsontable({
		data: data,
		minSpareRows: 1,
		contextMenu: true,
		afterChange: function(changes, source) {
			if(source === "loadData") {
				return;
			}
			if(source === "paste") {
				if($('.htCore td').hasClass('htInvalid')) {
					$('#save').attr('disabled', 'true');
				} else {
					$('#save').removeAttr('disabled');
				}
			}
			if(source === "edit") {
				if($('.htCore td').hasClass('htInvalid')) {
					$('#save').attr('disabled', 'true');
				} else {
					$('#save').removeAttr('disabled');
				}
			}
		},
		colHeaders: ['Name', 'Father Name', 'Designation', 'Date of Birth', 'Date of Joining', 'Date of Retirement', 'Sex', 'Category', 'Appoint As', 'Pay Band', 'Grade Pay', 'Increament amount', 'Total pay', 'SCA', 'Other allowance', 'DA', 'Total allowance', 'Total emolument', 'Account No', 'Bank Name', 'Branch', 'DDO address'],
		columns: [
			/*{ data: 'id' },*/
	        { data: 'name' },
	        { data: 'fhname' },
	        { data: 'designation' },
	        { data: 'dob' },
	        { data: 'doj' },
	        { data: 'dor' },
	        { data: 'sex' },
	        { data: 'category' },
	        { data: 'appoint_as' },
	        { data: 'pay_band', type: 'numeric', format: '0, 0.0' },
	        { data: 'grade_pay', type: 'numeric', format: '0, 0.0' },
	        { data: 'increament_amount', type: 'numeric', format: '0, 0.0' },
	        { data: 'total_pay', type: 'numeric', format: '0, 0.0' },
	        { data: 'sca', type: 'numeric', format: '0, 0.0' },
	        { data: 'other_allowance', type: 'numeric', format: '0, 0.0' },
	        { data: 'da', type: 'numeric', format: '0, 0.0' },
	        { data: 'total_allowance', type: 'numeric', format: '0, 0.0' },
	        { data: 'total_emolument', type: 'numeric', format: '0, 0.0' },
	        { data: 'account_no', type: 'numeric' },
	        { data: 'bank_name' },
	        { data: 'branch' },
	        { data: 'ddo_address' }
	    ]
	});

	var handsontable = $container.data('handsontable');
	$(document).ready(function(){
		//loadEmployee();
		$('#save').click(function() {
			$.post("<?php echo site_url('administrator/employee/saveEmployee'); ?>", {data: handsontable.getData()}, function(result) {
				alert(result);
			});
		});
	});

	/*var loadEmployee = function(){
		$.ajax({
		    url: "<?php echo site_url('administrator/employee/getAllEmployee'); ?>",
		    dataType: 'json',
		    type: 'GET',
		    success: function (res) {
		      	handsontable.loadData(res.data);
		    }
		});
	}*/

	$(document).ready(function(){
		//$('#add-employee-form').show();
		$('.add-employee').on('click', function(){
			$('#add-employee-form').slideToggle();
			$('.htCore').width($('#add-employee-list-table').width());
		});
	});
</script>



<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="employee-list-table" width="100%">
    <thead>
        <tr>
            <th width="12%">Name</th>
            <th width="10%">Designation</th>
            <th width="13%">Date of Joining</th>
            <th width="15%">Date of Retirement</th>
            <th width="10%">Total Pay</th>
			<th width="10%">Account No</th>
			<th width="10%">Photo</th>
			<th width="20%">Actions</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($lists as $list) { ?>
    		<tr id="<?php echo $list['id']; ?>">
	            <td><?php echo $list['name']; ?></td>
	            <td><?php echo $list['designation']; ?></td>
	            <td><?php echo dateTimeToDate($list['doj']); ?></td>
	            <td><?php echo dateTimeToDate($list['dor']); ?></td>
	            <td><?php echo $list['total_pay']; ?></td>  
	            <td><?php echo $list['account_no']; ?></td>
	            <td><?php echo ($list["photograph"]!="") ? '<img src="'.base_url('uploads/employee/'.$list["photograph"]).'" height="68">' : ''; ?></td>
				<td>
					<a href="<?php echo site_url('administrator/employee/view/'.$list['id']); ?>" id="view" class="btn"><i class="icon-eye-open"></i> View Profile</a>
					<a href="<?php echo site_url('administrator/employee/edit/'.$list['id']); ?>" id="edit" class="btn btn-success btn-rad"><i class="icon-pencil"></i> Edit</a>
	            </td>                   	            
	        </tr>
    	<?php } ?>
    </tbody>
</table>

<script type="text/javascript">
	$(document).ready(function() {
		$('#employee-list-table').dataTable();
	});
</script>
<style type="text/css">
	img{-webkit-border-radius: 5px 5px;-moz-border-radius: 5px / 5px;border-radius: 5px / 5px;}
</style>