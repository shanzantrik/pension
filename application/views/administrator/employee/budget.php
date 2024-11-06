<script src="<?php echo base_url('includes/js/jQuery-validate/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.mb.browser.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>includes/js/printElement/jquery.printElement.min.js"></script>

<?php if(!isset($_POST['search'])) { ?>
	<?php if(count($getRetirementforYear) > 0) { ?>
	<div style="display:block; color: #000;" class="alert alert-warning">
		<h4>Retirement on this year</h4><br/>
		<?php foreach ($getRetirementforYear as $value) { ?>
			<?php echo $value['name']." - ".$value['dor']."<br/>"; ?>
		<?php } ?>
	</div>
	<?php } ?>
<?php } ?>

<?php $totalAmount = ''; ?>
<?php $totalAmount+= $totalEmolument; ?>
<div id="main-container">
	<div style="width: 100%">
		<form name="searchBudget" action="<?php echo site_url('administrator/employee/budgetForYear'); ?>" method="post" style="float: left;">
			<select id="bc" required="required" class="form-control" name="branch_code" style="margin-bottom: 0px;">
                <option value="">--Please Select Department--</option>
                <option value="all">All</option>
                <?php foreach (getAllDepartment() as $dept) { ?>
                    <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>
                <?php } ?>
            </select>
			<span>Budget for year </span>
			<input required="required" type="text" name="from" id="from" placeholder="From" style="margin-bottom: 0px;" /> to 
			<input required="required" type="text" name="to" id="to" placeholder="To" style="margin-bottom: 0px;" />
			<input type="submit" name="search" value="Search" class="btn" style="margin: 0 0 0 5px;">
		</form>
		<a href="#" id="add-more-btn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="float: left; margin-left: 5px;">Add More</a>
		<a href="#" class="btn btn-info" style="float: left; margin-left: 5px;" id="printReport">Print</a><br><br>
	</div>
	<div id="print">
		<table class="table table-striped table-bordered">
			<tr>
				<td>#</td>
				<td>
				<?php
					if(isset($_POST['search'])) {
						$p = $_POST['from'];
						$c = $_POST['to'];
					} else {
						$date = new DateTime(date('Y-m-d'));
						if($date->format("m") > 3) {
							$prevY = $date->format("Y");
							$p = $prevY;

							$current = new DateTime(date('Y-m-d'));
							$current->modify("+1 year");
							$currentY = $current->format("Y");
							$c = $currentY;
						} else {
							$date->modify("-1 year");
							$prevY = $date->format("Y");
							$p = $prevY;

							$current = new DateTime(date('Y-m-d'));
							$currentY = $current->format("Y");
							$c = $currentY;
						}
					}
				?>
				Salary for the period from April <?php echo $p; ?> to March <?php echo $c; ?></td>
				<td class="alignRight"><b> Rs.<?php echo $totalEmolument; ?><div class="amount" value="<?php echo $totalEmolument; ?>"></b></td>
			</tr>
			<?php foreach ($getExtraBudget as $value) { ?>
				<tr>
					<?php $arr = explode(" ", getDepartmentName($value['dep'])); ?>
					<?php $s = ''; ?>
					<?php foreach($arr as $a) { $s.=substr($a, 0, 1); } ?>
					<td><a href="#" title="<?php echo getDepartmentName($value['dep']); ?>"><?php echo $s; ?></a></td>
					<td><?php echo $value['description']; ?></td>
					<td class="alignRight"><b> Rs.<?php echo $value['amount']; ?><div class="amount" value="<?php echo $value['amount'];; ?>"></b></td>
				</tr>
				<?php $totalAmount+= $value['amount']; ?>
			<?php } ?>
			<tr>
				<td colspan="2" style="text-align: right;"><b>Total </b></td>
				<td class="alignRight">
					<div id="totalAmount"><b><?php echo "Rs.".$totalAmount.".00"; ?></b></div>
				</td>
			</tr>
		</table>
	</div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="myModalLabel">Add More</h4>
      			</div>
      			<div class="modal-body">
        			<div id="add_more_form" style="display: none; padding: 5px 0 0 15px;">
						<form id="add_form" action="<?php echo site_url('administrator/employee/budgetForYear');?>" method="post">
							<label>For which Department</label>
							<select name="department" id="department" class="form-control">
				                <option value="">--Please Select--</option>
				                <?php foreach (getAllDepartment() as $dept) { ?>
				                    <option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_name']; ?>-<?php echo $dept['dept_short_code'];?></option>
				                <?php } ?>
				            </select>
				            <label>Budget From</label>
				            <input type="text" name="budget_from" id="budget_from" placeholder="From" style="margin-bottom: 0px;" />
				            <label>Budget To</label>
							<input type="text" name="budget_to" id="budget_to" placeholder="To" style="margin-bottom: 0px;" /><div class="msg" style="color: red;"></div>
			               	<label>Description</label>
			               	<textarea rows="4" cols="20" name="description" id="description" class="form-control"></textarea>
			               	<label>Amount</label>
			               	<input type="text" name="amount" id="amount" placeholder="Amount" autocomplete="off" class="form-control"><br />
			               	<input type="submit" name="save" class="btn btn-success">
			           </form>
					</div>
      			</div>
    		</div>
  		</div>
	</div>
</div>

<style type="text/css">
	/*#main-container div:nth-child(2) {width: 70%; float: left; padding: 0 20px 0 0;}*/
	#main-container div:nth-child(2) {width: 93%; float: left; padding: 0 20px 0 0;}
	#main-container div:nth-child(3) {width: 25%; float: left;}
	/*.alignRight {float: right;}*/
</style>

<script type="text/javascript">
	$(document).ready(function() {

		$("#add_form").validate({
            rules: {department: "required", budget_from: "required", budget_to: {required: true, greaterThan: "#budget_from"}, description: "required", amount: {required: true, number: true, minlength: 3}}
        });

		$('#add-more-btn').live('click', function(){
			$('#add_more_form').slideToggle('slow');
		});

		$("#from, #to").datepicker({dateFormat: 'yy', changeMonth: true, changeYear: true, yearRange: '1900:+1'});
		$("#budget_from, #budget_to").datepicker({dateFormat: 'yy', changeMonth: true, changeYear: true, yearRange: '1900:+1'});

		$('#printReport').click(function() {
			$("#print").printElement({
				printMode:'popup',
				overrideElementCSS:[
					'http://localhost:81/projects/codeigniter/pension_ui/includes/css/bootstrap-united.css',
				]
			});
		});

 		jQuery.validator.addMethod("greaterThan", function(value, element, params) {
		    if (!/Invalid|NaN/.test(new Date(value))) {
		        return new Date(value) > new Date($(params).val());
		    }
		    return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val())); 
		},'Must be greater than Budget from.');
		/*var totalAmount = 0;
		$('.amount').each(function() {
			totalAmount+=parseInt($(this).attr('value'));
		});
		$('#totalAmount').html("<b>Rs."+totalAmount+".00</b>");*/
	});
</script>