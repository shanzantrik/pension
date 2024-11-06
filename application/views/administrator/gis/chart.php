<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>includes/media/dt/jquery.jeditable.js"></script>
<script src="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.js"></script>
<link href="<?php echo base_url(); ?>includes/js/handsontable/jquery.handsontable.full.css" data-jsfiddle="common" rel="stylesheet" media="screen">

<div id="main-container">
	<div>
		<p class="user-message"><i>(To add new gis chart click on <span style="color:red">Add Gis Chart</span> Button)</i></p>
		<a href="#" class="open-dialog btn btn-primary add-gis-chart" style="float:right"><i class="icon-plus"></i>Add Gis Chart</a>

		<br /><br />
		<div id="add-gis-chart-form" style="display: none;">
			<div id="add-gis-chart-list-table"></div>
			<br />
			<input type="button" id="gis-chart-table-save-btn" name="gis-chart-table-save-btn" value="Save" disabled class="btn btn-primary" />
		</div>
	</div>

	<div>
		<legend style="font-size:15px; color:#3b5999; font-weight:700; margin-bottom: 0px;">Gis Chart</legend>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="gis-chart-table" width="100%">
		    <thead>
		        <tr>
		            <th width="8%">For Year</th>
		            <th width="8%">Entry</th>
		            <th width="7%">Jan</th>
		            <th width="7%">Feb</th>
		            <th width="7%">Mar</th>
		            <th width="7%">Apr</th>
		            <th width="7%">May</th>
		            <th width="7%">Jun</th>
		            <th width="7%">Jul</th>
		            <th width="7%">Aug</th>
		            <th width="7%">Sep</th>
		            <th width="7%">Oct</th>
		            <th width="7%">Nov</th>
		            <th width="7%">Dec</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($chart as $list) { ?>
		    		<tr id="<?php echo $list['id'];?>">
			            <td><?php echo $list['for_year']; ?></td>
			            <td><?php echo $list['year_of_entry']; ?></td>
			            <td class="edit"><?php echo $list['jan']; ?></td>
			            <td class="edit"><?php echo $list['feb']; ?></td>
			            <td class="edit"><?php echo $list['mar']; ?></td>
			            <td class="edit"><?php echo $list['apr']; ?></td>
			            <td class="edit"><?php echo $list['may']; ?></td>
			            <td class="edit"><?php echo $list['jun']; ?></td>
			            <td class="edit"><?php echo $list['jul']; ?></td>
			            <td class="edit"><?php echo $list['aug']; ?></td>
			            <td class="edit"><?php echo $list['sep']; ?></td>
			            <td class="edit"><?php echo $list['oct']; ?></td>
			            <td class="edit"><?php echo $list['nov']; ?></td>
			            <td class="edit"><?php echo $list['dec']; ?></td> 
			        </tr>
		    	<?php } ?>
		    </tbody>
		</table>
	</div>

	<div class="clear"></div>
</div>

<script type="text/javascript">
	var data = [];
	var $container = $("#add-gis-chart-list-table");
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
					$('#gis-chart-table-save-btn').attr('disabled', 'true');
				} else {
					$('#gis-chart-table-save-btn').removeAttr('disabled');
				}
			}
			if(source === "edit") {
				if($('.htCore td').hasClass('htInvalid')) {
					$('#gis-chart-table-save-btn').attr('disabled', 'true');
				} else {
					$('#gis-chart-table-save-btn').removeAttr('disabled');
				}
			}
		},
		colHeaders: ['For Year', 'Entry', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		columns: [
	        { data: 'for_year', type: 'numeric' },
	        { data: 'entry', type: 'numeric' },
	        { data: 'jan', type: 'numeric', format: '0, 0.0' },
	        { data: 'feb', type: 'numeric', format: '0, 0.0' },
	        { data: 'mar', type: 'numeric', format: '0, 0.0' },
	        { data: 'apr', type: 'numeric', format: '0, 0.0' },
	        { data: 'may', type: 'numeric', format: '0, 0.0' },
	        { data: 'jun', type: 'numeric', format: '0, 0.0' },
	        { data: 'jul', type: 'numeric', format: '0, 0.0' },
	        { data: 'aug', type: 'numeric', format: '0, 0.0' },
	        { data: 'sep', type: 'numeric', format: '0, 0.0' },
	        { data: 'oct', type: 'numeric', format: '0, 0.0' },
	        { data: 'nov', type: 'numeric', format: '0, 0.0' },
	        { data: 'dec', type: 'numeric', format: '0, 0.0' },
	    ]
	});


	var handsontable = $container.data('handsontable');
	$(document).ready(function() {
		var oTable = $('#gis-chart-table').dataTable();
		$('#gis-chart-table_filter input').keyup(function() { oTable.fnFilter(this.value, 0); });

		oTable.$('.edit').editable("<?php echo site_url('administrator/master/gis_chart_update') ?>", {
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
        });

		$('.add-gis-chart').on('click', function(){
			$('#add-gis-chart-form').slideToggle();
			$('.htCore').width($('#add-gis-chart-list-table').width());
		});

		$('#gis-chart-table-save-btn').click(function() {
			$.post("<?php echo site_url('administrator/master/gis_chart_save'); ?>", {data: handsontable.getData()}, function(result) {
				alert(result);
				console.log(result);
			});
		});
	});

</script>

<style type="text/css">
	#main-container {width: 100%;}
	#main-container .left {float: left; width: 63%; padding: 5px 10px 0px 0px;}
	#main-container .right {float: left; width: 36%; padding-top: 4px;}
	#main-container .right td {vertical-align: top;}
	.clear {clear: both;}
	.dataTables_wrapper {margin-top: 13px!important;}
</style>