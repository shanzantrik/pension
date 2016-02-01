<script src="<?php echo base_url()?>includes/high_chart/js/highcharts.js"></script>

<form method="POST" action="<?php echo site_url('administrator/searchpanel/index'); ?>" accept-charset="UTF-8">   
    <div class="form-group" style="float: left; width: 60%">
        <label for="name_of_pensionser" class="control-label">Search By</label>
        <select name="by" id="by" class="form-control" style="margin-left: 5px;">
        	<?php $array = array('no_of_pensioner'=>'No. of pensioner', 'no_of_family_pensioner'=>'No. of family pensioner', 'total_basic_pension_of_pensioner'=>'Total basic pension of pensioner', 'total_basic_pension_of_family_pensioner'=>'Total basic pension of family pensioner', 'gratuity_commutation'=>'Gratuity commutation', 'leave_encashment'=>'Leave Encashment', 'no_of_pensioner_state_wise'=>'No. of pensioner state wise', 'no_of_pension_receive_from_other_state'=>'No. of pension receive from other state'); ?>
        	<option value="">--Select--</option>
        	<?php foreach($array as $key=>$value) : ?>
	        	<?php if($this->input->post('by') == $key) : ?>
	        		<option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
	        	<?php else : ?>
	        		<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
	        	<?php endif; ?>
	        <?php endforeach; ?>
        </select>
        <input class="form-control datepicker search-box" id="search_input" name="search_input" value="<?php echo ($this->input->post('search_input') != '') ? $this->input->post('search_input') : ''; ?>" autocomplete="off" type="text" placeholder="Year" style="margin-left: 0px; <?php echo ($this->input->post('search_input') == '') ? '' : ''; ?>" />
        <input type="submit" name="search_btn" value="Search" class="btn btn-success" style="margin: 0px;" />
    </div>
</form>

<?php if(isset($_POST['search_btn'])): ?>
	<?php 
		$search_by = $this->input->post('by');
		$search_input = ($this->input->post('search_input') != '') ? $this->input->post('search_input') : '';
		$family_tag = array('no_of_family_pensioner', 'total_basic_pension_of_family_pensioner');
	?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
	    	<?php if($search_by == 'no_of_pensioner' || $search_by == 'no_of_family_pensioner') : ?>
	    		<div style="float: left; width: 75%;">
		            <div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Statistics</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div id="container" style="height: auto; width: auto;"></div>
		            </div>
	            </div>
	            <div style="float: left; width: 25%;">
	            	<div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Total</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div style="height: auto; width: auto;">
		                	<table cellpadding="3" cellspacing="3">
	                		<?php
	                			$count = $result->count();
    							$group = $result->groupBy('class_of_pension');

			    				if($count > 0) :
				    				foreach($group->get() as $d) : ?>
			                		<tr>
			                			<td valign="top"><?php echo str_replace("_", " ", $d->class_of_pension); ?></td>
			                			<td valign="top">-</td>
			                			<td valign="top">
			                				<?php
			                					$p = PPERSONALD::classOfPension($d->class_of_pension);
			                					if($search_input != '') :
													$p->whereYear('created_at', '=', $search_input);
												endif;
			                					echo $p->count();
			                				?>
			                			</td>
			                		</tr>
			                		<?php endforeach; ?>
			                		<tr>
			                			<td align="right" style="padding-right: 10px;"><b>Total</b></td>
			                			<td></td>
			                			<td align="left"><b><?php echo $count; ?></b></td>
			                		</tr>
			                	<?php endif; ?>
		                	</table>
		                </div>
		            </div>
	            </div>
	        <?php elseif($search_by == 'total_basic_pension_of_pensioner' || $search_by == 'total_basic_pension_of_family_pensioner') : ?>
	        	<div style="float: left; width: 75%;">
		            <div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Statistics</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div id="container" style="height: auto; width: auto;"></div>
		            </div>
	            </div>
	            <div style="float: left; width: 25%;">
	            	<div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Total</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div style="height: auto; width: auto;">
		                	<table cellpadding="3" cellspacing="3">
	                		<?php
	                			$count = $result->count();
    							$group = $result->groupBy('class_of_pension');
    							$total = array();
    							if($count > 0) :
				    				foreach($group->get() as $d) : ?>
			                		<tr>
			                			<td valign="top" width="65%"><?php echo str_replace("_", " ", $d->class_of_pension); ?></td>
			                			<td valign="top" width="2%">-</td>
			                			<td valign="top" align="right" width="33%">
			                				<?php
			                					$p = PPERSONALD::with('pensioner_pay_details')->classOfPension($d->class_of_pension);
			                					if($search_input != '') :
													$p->whereYear('created_at', '=', $search_input);
												endif;
			                					
			                					if($p->count()) :
			                						$sub_total = array();
			                						foreach ($p->get() as $p) :
			                							$lp = array();
			                							$pay_info = unserialize($p->pensioner_pay_details->pay_info);
			                							foreach($pay_info[0] as $key => $value) :
			                								if($key != 'post_DA') :
																$lp[$key] = $value;
															endif;
			                							endforeach;
			                							array_push($sub_total, array_sum($lp));
			                						endforeach;
			                						array_push($total, array_sum($sub_total));
			                						echo "Rs. ".array_sum($sub_total);
			                					endif;
			                				?>
			                			</td>
			                		</tr>
			                		<?php endforeach; ?>
			                		<tr>
			                			<td align="right" style="padding-right: 10px;"><b>Total</b></td>
			                			<td></td>
			                			<td align="right"><b><?php echo "Rs. ".array_sum($total); ?></b></td>
			                		</tr>
			                	<?php endif; ?>
		                	</table>
		                </div>
		            </div>
	            </div>



	        <?php elseif($search_by == 'gratuity_commutation' || $search_by == 'leave_encashment') : ?>
	        	<div style="float: left; width: 75%;">
		            <div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Statistics</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div id="container" style="height: auto; width: auto;"></div>
		            </div>
	            </div>
	            <div style="float: left; width: 25%;">
	            	<div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Total</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div style="height: auto; width: auto;">
		                	<table cellpadding="3" cellspacing="3">
	                		<?php
	                			$count = $result->count();
    							$group = $result->groupBy('class_of_pension');
    							$total = array();
    							if($count > 0) :
				    				foreach($group->get() as $d) : ?>
			                		<tr>
			                			<td valign="top" width="60%"><?php echo str_replace("_", " ", $d->class_of_pension); ?></td>
			                			<td valign="top" width="2%">-</td>
			                			<td valign="top" align="right" width="38%">
			                				<?php
			                					$p = PPERSONALD::with('pensioner_details')->classOfPension($d->class_of_pension);
			                					if($search_input != '') :
													$p->whereYear('created_at', '=', $search_input);
												endif;

												$total = [];
			                					foreach($p->get() as $p) :
			                						if($p->pensioner_details()->count()) :
			                							if($search_by == 'gratuity_commutation') :
					                						array_push($total, $p->pensioner_details->gratuity);
					                					else :
					                						array_push($total, $p->pensioner_details->leave_encashment);
					                					endif;
				                					endif;
			                					endforeach;
			                					echo "Rs. ".array_sum($total);
			                				?>
			                			</td>
			                		</tr>
			                		<?php endforeach; ?>
			                		<tr>
			                			<td align="right" style="padding-right: 10px;"><b>Total</b></td>
			                			<td></td>
			                			<td align="right">
			                				<b>
			                					<?php
			                						$q = PPERSONALD::with('pensioner_details');
		                							if($search_input != '') :
														$q->whereYear('created_at', '=', $search_input);
													endif;
		                							
		                							$total = [];
		                							foreach($q->get() as $row):
		                								if($row->pensioner_details()->count()) :
			                								if($search_by == 'gratuity_commutation') :
					                							array_push($total, $row->pensioner_details->gratuity);
					                						else :
					                							array_push($total, $row->pensioner_details->leave_encashment);
					                						endif;
			                							endif;
		                							endforeach;
			                						echo "Rs. ".array_sum($total);
			                					?>
			                				</b>
			                			</td>
			                		</tr>
			                	<?php endif; ?>
		                	</table>
		                </div>
		            </div>
	            </div>


	        <?php elseif($search_by == 'no_of_pensioner_state_wise' || $search_by == 'no_of_pension_receive_from_other_state') : ?>
	        	<div style="float: left; width: 75%;">
		            <div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Statistics</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div id="container" style="height: auto; width: auto;"></div>
		            </div>
	            </div>
	            <div style="float: left; width: 25%;">
	            	<div class="box-header well" data-original-title="">
		                <h2><i class="icon-list-alt"></i> Total</h2>
		                <div class="box-icon">
		                   
		                </div>
		            </div>
		            <div class="box-content">
		                <div style="height: auto; width: auto;">
		                	<table cellpadding="3" cellspacing="3">
	                		<?php
	                			$count = $result->count();
    							if($search_by == 'no_of_pensioner_state_wise') :
	    							$group = $result->groupBy('ist');
	    						elseif($search_by == 'no_of_pension_receive_from_other_state') :
	    							$group = $result->groupBy('orf');
	    						endif;
    							$total = array();
    							if($count > 0) :
				    				foreach($group->get() as $d) : ?>
			                		<tr>
			                			<td valign="top" width="65%">
			                				<?php 
				                				if($search_by == 'no_of_pensioner_state_wise') :
				                					echo $d->insideSendTo->state;
				                				elseif($search_by == 'no_of_pension_receive_from_other_state') :
				                					echo $d->outsideReceiveFrom->state;
				                				endif;
			                				?>
			                			</td>
			                			<td valign="top" width="2%">-</td>
			                			<td valign="top" align="right" width="33%">
			                				<?php
			                				if($search_by == 'no_of_pensioner_state_wise') :
			                					$q = PTransfer::Ist($d->ist);
				                				if($search_input != '') :
													$q->whereYear('created_at', '=', $search_input);
												endif;
			                				elseif($search_by == 'no_of_pension_receive_from_other_state') :
			                					$q = PTransfer::Orf($d->orf);
			                					if($search_input != '') :
													$q->whereYear('created_at', '=', $search_input);
												endif;
			                				endif;
			                				echo $q->count();
			                				?>
			                			</td>
			                		</tr>
			                		<?php endforeach; ?>
			                		<tr>
			                			<td align="right" style="padding-right: 10px;"><b>Total</b></td>
			                			<td></td>
			                			<td align="right"><b><?php echo $count; ?></b></td>
			                		</tr>
			                	<?php endif; ?>
		                	</table>
		                </div>
		            </div>
	            </div>
            <?php endif; ?>
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
		$(".datepicker").datepicker({dateFormat: 'yy', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
		$('#by').change(function() {
			me = $(this);
			switch(me.val()) {
				case 'no_of_pensioner':
				case 'no_of_family_pensioner':
				case 'total_basic_pension_of_pensioner':
				case 'total_basic_pension_of_family_pensioner':
				case 'gratuity_commutation':
				case 'leave_encashment':
					$('#search_input').val('').attr('placeholder', 'Year wise').addClass('datepicker').show();
					$('.datepicker').datepicker({dateFormat: 'yy', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
					break;
				case 'no_of_pensioner_state_wise':
				case 'no_of_pension_receive_from_other_state':
					$('#search_input').val('').removeClass('datepicker').show();
					break;
					break;
				default :
					$('#search_input').hide();
					break;
			}
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		<?php if(count($result) > 0) : ?>
			<?php if($search_by == 'no_of_pensioner' || $search_by == 'no_of_family_pensioner') : ?>
			    $('#container').highcharts({
			        chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false},
			        title: {text: ''},
			        tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
			        plotOptions: {
			            pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: {
			                    enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
			                }
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Percentage',
			            data: [
			                <?php
								$res = '';
								$data = $result->groupBy('class_of_pension')->get();
								foreach($data as $d) :
									$p = PPERSONALD::classOfPension($d->class_of_pension);
		        					if($search_input != '') :
										$p->whereYear('created_at', '=', $search_input);
									endif;
		        					$count = $p->count();
		        					$res.= "['".str_replace("_", " ", $d->class_of_pension)." - [".$count."]', ".$count."],";
		        				endforeach;
								echo $res;
				    		?>
			            ]
			        }]
			    });
			<?php elseif($search_by == 'total_basic_pension_of_pensioner' || $search_by == 'total_basic_pension_of_family_pensioner') : ?>
				$('#container').highcharts({
			        chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false},
			        title: {text: ''},
			        tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
			        plotOptions: {
			            pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: {
			                    enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
			                }
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Percentage',
			            data: [
			                <?php
			                	$res = '';
								$count = $result->count();
    							$group = $result->groupBy('class_of_pension');
    							$total = array();
    							if($count > 0) :
				    				foreach($group->get() as $d) :
	                					$p = PPERSONALD::with('pensioner_pay_details')->classOfPension($d->class_of_pension);
	                					if($search_input != '') :
											$p->whereYear('created_at', '=', $search_input);
										endif;
	                					
	                					if($p->count()) :
	                						$sub_total = array();
	                						foreach ($p->get() as $p) :
	                							$lp = array();
	                							$pay_info = unserialize($p->pensioner_pay_details->pay_info);
	                							foreach($pay_info[0] as $key => $value) :
	                								if($key != 'post_DA') :
														$lp[$key] = $value;
													endif;
	                							endforeach;
	                							array_push($sub_total, array_sum($lp));
	                						endforeach;
	                						array_push($total, array_sum($sub_total));
	                						$count = array_sum($sub_total);
	                					endif;
		        						$res.= "['".str_replace("_", " ", $d->class_of_pension)." - [".$count."]', ".$count."],";
		        					endforeach;
		        					echo $res;
		        				endif;
		        			?>
			            ]
			        }]
			    });


			<?php elseif($search_by == 'gratuity_commutation' || $search_by == 'leave_encashment') : ?>

				$('#container').highcharts({
			        chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false},
			        title: {text: ''},
			        tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
			        plotOptions: {
			            pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: {
			                    enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
			                }
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Percentage',
			            data: [
			                <?php
			                	$res = '';
								$count = $result->count();
    							$group = $result->groupBy('class_of_pension');
    							if($count > 0) :
				    				foreach($group->get() as $d) :
	                					$p = PPERSONALD::with('pensioner_details')->classOfPension($d->class_of_pension);
	                					if($search_input != '') :
											$p->whereYear('created_at', '=', $search_input);
										endif;

										$total = [];
	                					foreach($p->get() as $p) :
	                						if($p->pensioner_details()->count()) :
	                							if($search_by == 'gratuity_commutation') :
		                							array_push($total, $p->pensioner_details->gratuity);
		                						else :
		                							array_push($total, $p->pensioner_details->leave_encashment);
		                						endif;
		                					endif;
	                					endforeach;
		        						$res.= "['".str_replace("_", " ", $d->class_of_pension)." - [".array_sum($total)."]', ".array_sum($total)."],";
		        					endforeach;
		        					echo $res;
		        				endif;
		        			?>
			            ]
			        }]
			    });

			<?php elseif($search_by == 'no_of_pensioner_state_wise' || $search_by == 'no_of_pension_receive_from_other_state') : ?>

				$('#container').highcharts({
			        chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false},
			        title: {text: ''},
			        tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
			        plotOptions: {
			            pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: {
			                    enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
			                }
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Percentage',
			            data: [
			                <?php
			                	$res = '';
								$count = $result->count();
    							if($search_by == 'no_of_pensioner_state_wise') :
	    							$group = $result->groupBy('ist');
	    						elseif($search_by == 'no_of_pension_receive_from_other_state') :
	    							$group = $result->groupBy('orf');
	    						endif;
    							$total = array();
    							if($count > 0) :
				    				foreach($group->get() as $d) :
	                					if($search_by == 'no_of_pensioner_state_wise') :
		                					$state = $d->insideSendTo->state;
		                					$state_total = PTransfer::Ist($d->ist);
		                					if($search_input != '') :
												$state_total->whereYear('created_at', '=', $search_input);
											endif;
											$count = $state_total->count();
		                				elseif($search_by == 'no_of_pension_receive_from_other_state') :
		                					$state = $d->outsideReceiveFrom->state;
		                					$state_total = PTransfer::Orf($d->orf);
		                					if($search_input != '') :
												$state_total->whereYear('created_at', '=', $search_input);
											endif;
											$count = $state_total->count();
		                				endif;
		        						$res.= "['".$state." - [".$count."]', ".$count."],";
		        					endforeach;
		        					echo $res;
		        				endif;
		        			?>
			            ]
			        }]
			    });

			<?php endif; ?>
		<?php endif; ?>
	});
</script>