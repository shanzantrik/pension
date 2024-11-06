<script src="<?php echo base_url()?>includes/high_chart/js/highcharts.js"></script>
<script src="<?php echo base_url()?>includes/high_chart/js/modules/exporting.js"></script>
<script src="<?php echo base_url()?>includes/weather/weather.js"></script>
<script src="<?php echo base_url()?>includes/calc/calculator.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>includes/calc/css/calculator.css">
<script src="<?php echo base_url()?>includes/js/excanvas.js"></script>
<script src="<?php echo base_url()?>includes/js/jquery.flot.min.js"></script>
<script src="<?php echo base_url()?>includes/js/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url()?>includes/js/jquery.flot.stack.js"></script>
<script src="<?php echo base_url()?>includes/js/jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->
<!-- select or dropdown enhancer -->
<script src="<?php echo base_url()?>includes/js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="<?php echo base_url()?>includes/js/jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo base_url()?>includes/js/jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="<?php echo base_url()?>includes/js/jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="<?php echo base_url()?>includes/js/jquery.noty.js"></script>
<!-- file manager library -->
<script src="<?php echo base_url()?>includes/js/jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo base_url()?>includes/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url()?>includes/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url()?>includes/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url()?>includes/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url()?>includes/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->

<!-- DIgi -->
<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Department of Audit & Pension Recent Statistics'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                <?php 
                	$res=mysql_query("SELECT DISTINCT (class_of_pension) FROM pensioner_personal_details");
                	while($row=mysql_fetch_array($res)){
                		$name=$row['class_of_pension'];
                		$sql="SELECT count(*) as cnt FROM `pensioner_personal_details` WHERE class_of_pension='$name'";
                		$res2=mysql_query($sql);
                		$row2=mysql_fetch_array($res2);
                		$val=$row2['cnt'];
                		echo "["."'".str_replace("_", " ", $name).' - ['.$val."]',".$val."],";
                	}
                 ?>
            ]
        }]
    });
});
	</script>
</head>

<script type="text/javascript">
$(document).ready(function(){
    var connected=<?php echo $this->model_home->is_connected(); ?>;
    if(connected==1){
        get_weather();
    }else{
       $("#weather").html('<div style="margin-top:85px"><b>'+'No Internet Connectivity available'+'</b></div>');
    }
});
 function get_weather(){
    $.simpleWeather({
        zipcode: '',
        woeid: '<?php echo $woid; ?>',
        location: '',
        unit: 'c',
        success: function(weather) {
          html = '<h2>'+weather.temp+'&deg;'+weather.units.temp+'</h2>';
          html += '<div><b>'+weather.city+', '+weather.region+'</b></div>';
          html += '<div><b>'+weather.currently+'</b></div>';
          if(weather.currently=='Haze'){
           // alert('SS');
          }
          img = '<img style="max-width:500%;margin-left:-35px;margin-top:-27px;float:left" src="'+weather.image+'"'+'/>';
          /*html += '<li>'+weather.tempAlt+'&deg;C</li></ul>';*/
          $("#img").html(img);
          $("#weather").html(html);
        },
        error: function(error) {
          $("#weather").html('<p>'+error+'</p>');
        }
      });
 }

</script>
<?php if ($this->session->userdata('member_type_code')==1001): ?>
    <!-- ###################################  SUPEIENDANT OF PENSION   ################################### -->
   <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#from_receipt" data-toggle="tab"><b>From Concern Dealing Assistant</b></a></li>
                        <li><a href="#from_director" data-toggle="tab"><b>From Director of Audit & Pension</b></a></li> 
                        <li><a href="#ppo_generation" data-toggle="tab"><b>Form DA After PPO Generation</b></a></li> 
                        <li><a href="#from_ips" data-toggle="tab"><b>From IPS</b></a></li>
                        <li><a href="#from_ndc" data-toggle="tab"><b>From NDC</b></a></li>
                    </ul>
                    <!-- FROM Marking Superandant -->
                    <div class="tab-content" style="overflow: visible;">
                       <div class="tab-pane active" id="from_receipt"> 
                            <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $member_code=$this->session->userdata('member_code');
                            //$sql="SELECT count(id) as cnt from file_status where  status='Forwarded to Superandant of Pension' and file_no in (SELECT file_no from concern_superintendent where superandant=$member_code)";
							//$sql="SELECT count(id) as cnt from file_status where  status='Forwarded to Superintendent of Pension' and file_no in (SELECT file_no from concern_superintendent where superandant=$member_code)";
							$sql="SELECT count(id) as cnt from file_status where  status='Forwarded to Superintendent of Pension'";
							//Forwarded to Superintendent of Pension
                            $res=mysql_query($sql);
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                            <td><b>Dealing Assistant</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //$sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Superandant of Pension' and a.file_no=b.file_No and a.file_no in (SELECT file_no from concern_superintendent where superandant=$member_code) LIMIT 0,5";
											$sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Superintendent of Pension' and a.file_no=b.file_No  LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/notification/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>
                       </div> 
                         <!-- ###FROM DIRECTOR ####### -->
                        <div class="tab-pane" id="from_director">
                            <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to Superintendent of Pension from Director'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $member_code=$this->session->userdata('member_code');
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Superintendent of Pension from Director' and a.file_no=b.file_No and a.member_code=$member_code LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/notification/from_director') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>    
                        </div>

                        <!-- #####  FROM IPS ##### -->
                        <div class="tab-pane" id="from_ips">
                            <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $mm=$this->session->userdata('member_code');
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to Superandant From IPS' and member_code=$mm");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $member_code=$this->session->userdata('member_code');
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Superandant From IPS' and a.file_no=b.file_No and a.member_code=$member_code and a.member_code=$mm LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/notification/index2') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>    
                        </div>
                        <!-- #####  FROM NDC ##### -->
                        <div class="tab-pane" id="from_ndc">
                            <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $mm=$this->session->userdata('member_code');
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to Superandant From NDC' and member_code=$mm");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $member_code=$this->session->userdata('member_code');
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Superandant From NDC' and a.file_no=b.file_No and a.member_code=$member_code and a.member_code=$mm LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/notification/index_ndc') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications </div>
                                <?php endif ?>    
                        </div>
                        <!-- ### After PPO ####### -->
                        <div class="tab-pane" id="ppo_generation">
                            <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $member_code=$this->session->userdata('member_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where member_code=$member_code and status='Forwarded to Superintendent of Pension from concern Dealing Assistant'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                            <td><b>Dealing Assistant</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $member_code=$this->session->userdata('member_code');
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.member_code=$member_code and a.status='Forwarded to Superintendent of Pension from concern Dealing Assistant' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/notification/to_director_files') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>    
                        </div>
                       
                     </div> 
                    </div>
        </div>
</div> 
<!-- ###################################  DEALING ASSISTANT OF PENSION   ################################### -->
<?php elseif($this->session->userdata('member_type_code')==1004): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i>Notification</h2>
                    </div>
        </div>
        <div class="box-content">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#fms" data-toggle="tab"><b>From Receipt</b></a></li>
                            <li><a href="#fsp" data-toggle="tab"><b>From Director/Joint Director/FAO</b></a></li>
                            <li><a href="#ddd" data-toggle="tab"><b>From IPS</b></a></li>
                        </ul>
                        <!-- FROM Marking Superandant -->
                        <div class="tab-content" style="overflow: visible;">
                           <div class="tab-pane active" id="fms">
                                <?php
                                $bc=$this->session->userdata('branch_code'); 
                                $member_code=$this->session->userdata('member_code');
                                //$res=mysql_query("SELECT count(id) as cnt from file_status where  status='To DA' and member_code=$member_code");
								$res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Concern Dealing Assistant' and member_code=$member_code");
								
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                    ?>
                                    <?php if ($cnt>0): ?>
                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <td><b>Auto Gen File No</b></td>
                                                <td><b>Registration Number</b></td>
                                                <td><b>File No</b></td>
                                                <td><b>Dept Forwarding No</b></td>
                                                <td><b>Employee Code</b></td>
                                                <td><b>Pensionee Name</b></td>
                                                <td><b>Designation</b></td>
                                                <td><b>Superintendent</b></td>
                                                <td width="10%"><b>Allocated Date</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                               // $sql="SELECT * from file_status a,pension_receipt_file_master b,registration c where  a.status='To DA' and a.file_no=b.file_No and a.member_code=$member_code and a.file_no=c.file_no and b.file_no=c.file_no LIMIT 0,5";
												$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Concern Dealing Assistant' and a.file_no=b.file_No and a.member_code=$member_code  order by a.allocated_date desc LIMIT 0,5";
                                                //echo $sql;
                                                $result=mysql_query($sql);
                                                while ($row=mysql_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['auto_file_no'] ?></td>
                                                <td><?php echo $row['registration_no'] ?></td>
                                                <td><?php echo $row['file_no'] ?></td>
                                                <td><?php echo $row['dept_forw_no'] ?></td>
                                                <td><?php echo $row['emp_code'] ?></td>
                                                <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                                <td><?php echo $row['designation'] ?></td>
                                                <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                                <td><?php echo $row['allocated_date'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php 

                                         ?>
                                    </table>
                        <a href="<?php echo site_url('administrator/pension/view_file') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id='fsp'>
                               <?php
                                $bc=$this->session->userdata('branch_code'); 
                                $member_code=$this->session->userdata('member_code');
                                //$res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Dealing Assistant of Pension from Superintendent' and member_code=$member_code");
								$res=mysql_query("SELECT count(id) as cnt from file_status where  status='pension_Forwarded to Pension DA'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                    ?>
                                    <?php if ($cnt>0): ?>
                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <td><b>Auto Gen File No</b></td>
                                                <td><b>File No</b></td>
                                                <td><b>Dept Forwarding No</b></td>
                                                <td><b>Employee Code</b></td>
                                                <td><b>Pensionee Name</b></td>
                                                <td><b>Designation</b></td>
                                                <td><b>Superintendent</b></td>
                                                <td><b>Allocated Date</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                //$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Dealing Assistant of Pension from Superintendent' and a.file_no=b.file_No and a.member_code=$member_code LIMIT 0,5";
												$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='pension_Forwarded to Pension DA' and a.file_no=b.file_No and a.member_code=$member_code LIMIT 0,5";
												
                                                $result=mysql_query($sql);
                                                while ($row=mysql_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['auto_file_no'] ?></td>
                                                <td><?php echo $row['file_no'] ?></td>
                                                <td><?php echo $row['dept_forw_no'] ?></td>
                                                <td><?php echo $row['emp_code'] ?></td>
                                                <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                                <td><?php echo $row['designation'] ?></td>
                                                <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                                <td><?php echo $row['allocated_date'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php 

                                         ?>
                                    </table>
                                
                   <a href="<?php echo site_url('administrator/da_notification/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id='ddd'>
                               <?php
                                $bc=$this->session->userdata('branch_code'); 
                                $member_code=$this->session->userdata('member_code');
                                //$res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Dealing Assistant of Pension from Superintendent' and member_code=$member_code");
								$res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Pension DA by IPS DA'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                    ?>
                                    <?php if ($cnt>0): ?>
                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <td><b>Auto Gen File No</b></td>
                                                <td><b>File No</b></td>
                                                <td><b>Dept Forwarding No</b></td>
                                                <td><b>Employee Code</b></td>
                                                <td><b>Pensionee Name</b></td>
                                                <td><b>Designation</b></td>
                                                <td><b>Superintendent</b></td>
                                                <td><b>Allocated Date</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                //$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Dealing Assistant of Pension from Superintendent' and a.file_no=b.file_No and a.member_code=$member_code LIMIT 0,5";
												$sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Pension DA by IPS DA' and a.file_no=b.file_No LIMIT 0,5";
                                                $result=mysql_query($sql);
                                                while ($row=mysql_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['auto_file_no'] ?></td>
                                                <td><?php echo $row['file_no'] ?></td>
                                                <td><?php echo $row['dept_forw_no'] ?></td>
                                                <td><?php echo $row['emp_code'] ?></td>
                                                <td><?php echo $row['salutation'].'. '.$row['pensionee_name']?></td>
                                                <td><?php echo $row['designation'] ?></td>
                                                <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                                <td><?php echo $row['allocated_date'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php 

                                         ?>
                                    </table>
                     
                     <a href="<?php echo site_url('administrator/da_notification/index') ?>" class="btn" style="float:right">view all</a>

                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant</div>
                                <?php endif ?>
                           </div>
                        </div>
                        
                  
                    </div>
    </div> 
 
<!-- ###################################  DIRECTO OF AUDIT PENSION   ################################### -->
<?php elseif($this->session->userdata('member_type_code')==1006): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#fms" data-toggle="tab"><b>From Superintendent for Approval</b></a></li>
                            <li><a href="#fsp" data-toggle="tab"><b>From Superintendent for Signature</b></a></li> 
                        </ul>
                        <div class="tab-content" style="overflow: visible;">
                           <div class="tab-pane active" id="fms">
                               <?php
                            $res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Director of Audit & Pension'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Director of Audit & Pension' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/director_notification/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant of Pension</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id="fsp">
                               <?php
                                $member_code=$this->session->userdata('member_code');
                                $res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to Director of Audit & Pension for Signature'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to Director of Audit & Pension for Signature' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/director_notification/for_signature') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant of Pension</div>
                                <?php endif ?>
                           </div>
                        </div>
                  
                    </div>
        </div>
    </div> 
    <!-- ###################################  PPO SUPERANDANT   ################################### -->
<?php elseif($this->session->userdata('member_type_code')==1005): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        
                    </div>
                    <div class="box-content">
                       <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where branch_code=$bc and status='Forwarded to Superintendent of PPO'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.branch_code=$bc and a.status='Forwarded to Superintendent of PPO' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/ppo_notification/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>
                  
                    </div>
        </div>
    </div> 
<?php elseif($this->session->userdata('member_type_code')==1008): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <small style="color:red;float:right">[Files Received From Receipt]</small>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                       <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to Marking Superintendent'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Marking Superintendent' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/marking_notification/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Receipt</div>
                                <?php endif ?>
                  
                    </div>
        </div>
    </div> 
<!-- ################## ISSUE BRABCH ####################### -->
<?php elseif($this->session->userdata('member_type_code')==1009): ?>
<div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#fms" data-toggle="tab"><b>From Pension</b></a></li>
                            <li><a href="#fsp" data-toggle="tab"><b>From IPS</b></a></li> 
                        </ul>
                        <div class="tab-content" style="overflow: visible;">
                           <div class="tab-pane active" id="fms">
                               <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='To Issue'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='To Issue' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/issue/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Pension</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id="fsp">
                               <?php
                                $member_code=$this->session->userdata('member_code');
                                $res=mysql_query("SELECT count(id) as cnt from file_status where  status='To Issue from IPS'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='To Issue from IPS' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/issue/from_ips') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From IPS</div>
                                <?php endif ?>
                           </div>
                        </div>
                    </div>
        </div>
    </div> 
    <!---############# Joint Director ###########-->
    <?php elseif($this->session->userdata('member_type_code')==1016): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <div class="box-icon">
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#fms" data-toggle="tab"><b>From GIS Superintendent for Approval</b></a></li>
                            <li><a href="#fsp" data-toggle="tab"><b>From GIS Superintendent for Final</b></a></li> 
                        </ul>
                        <div class="tab-content" style="overflow: visible;">
                           <div class="tab-pane active" id="fms">
                               <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to joint Director'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                     $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to joint Director' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/joint_director/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From GIS Superintendent For Approval</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id="fsp">
                               <?php
                                $member_code=$this->session->userdata('member_code');
                                //$res=mysql_query("SELECT count(id) as cnt from file_status where  status='To Issue from IPS'");
								$res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to JDAP By GIS Superintendent for Final'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to JDAP By GIS Superintendent for Final' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/joint_director/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From GIS Superintendent For Final</div>
                                <?php endif ?>
                           </div>
                        </div>
                    </div>
        </div>
    </div> 
<!-- ################## NDC ####################### -->
<?php elseif($this->session->userdata('member_type_code')==1011): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <!-- <small style="color:red;float:right">[Files Received From Receipt]</small> -->
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                       <?php
                            $bc=$this->session->userdata('branch_code'); 
                            $res=mysql_query("SELECT count(id) as cnt from file_status where status='Forwarded to NDC'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to NDC' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="<?php echo site_url('administrator/Ndc/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications</div>
                                <?php endif ?>
                  
                    </div>
        </div>
    </div> 
        <!-- ################## IPS BRABCH ####################### -->
<?php elseif($this->session->userdata('member_type_code')==1010): ?>
    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Notification</h2>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#fms" data-toggle="tab"><b>From Receipt</b></a></li>
                            <li><a href="#fsp" data-toggle="tab"><b>From Pension</b></a></li> 
                        </ul>
                        <div class="tab-content" style="overflow: visible;">
                           <div class="tab-pane active" id="fms">
                               <?php
                            $res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to IPS From Receipt'");
                            $row=mysql_fetch_array($res);
                            $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to IPS From Receipt' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/Ips/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant of Pension</div>
                                <?php endif ?>
                           </div>
                           <div class="tab-pane" id="fsp">
                               <?php
                                $member_code=$this->session->userdata('member_code');
                                $res=mysql_query("SELECT count(id) as cnt from file_status where  status='Forwarded to IPS'");
                                $row=mysql_fetch_array($res);
                                $cnt=$row['cnt'];
                                ?>
                                <?php if ($cnt>0): ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <td><b>Auto Gen File No</b></td>
                                            <td><b>File No</b></td>
                                            <td><b>Dept Forwarding No</b></td>
                                            <td><b>Employee Code</b></td>
                                            <td><b>Pensionee Name</b></td>
                                            <td><b>Designation</b></td>
                                            <td><b>Superintendent</b></td>
                                            <td><b>Allocated Date</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql="SELECT * from file_status a,pension_receipt_file_master b where a.status='Forwarded to IPS' and a.file_no=b.file_No LIMIT 0,5";
                                            $result=mysql_query($sql);
                                            while ($row=mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['auto_file_no'] ?></td>
                                            <td><?php echo $row['file_no'] ?></td>
                                            <td><?php echo $row['dept_forw_no'] ?></td>
                                            <td><?php echo $row['emp_code'] ?></td>
                                            <td><?php echo $row['salutation'].'. '.$row['pensionee_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td><?php $x=$this->model_notification->get_last_member($row['file_no']); print_r($x[1]) ?></td>
                                            <td><?php echo $row['allocated_date'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php 

                                     ?>
                                </table>
                                <a href="<?php echo site_url('administrator/ips/index') ?>" class="btn" style="float:right">view all</a>
                                <?php else: ?>
                                    <div class="alert alert-success">No New File Notifications From Superiendantant of Pension</div>
                                <?php endif ?>
                           </div>
                        </div>
                  
                    </div>
        </div>
    </div> 
<?php endif ?>
<script type="text/javascript">
    $(function(){
        $('#calc').calculator();
    })
</script>
<div class="row-fluid sortable ui-sortable">
                 <div class="box span3" style="">
                    <div class="box-header well">
                        <h2><i class="icon-th"></i> Weather</h2>
                        <div class="box-icon">
                            <a href="#mySettings" class="btn btn-setting btn-round" data-toggle="modal"><i class="icon-cog"></i></a>
                        </div>
                    </div>
                    <div class="box-content" style="" >
                         <div >
                            <!-- <div id="img" style="width:92px;height:67px"></div> -->
                            <div id="img" style="width:92px;height:67px"></div>
                            <div id="weather" style="float: right;margin-top: -156px;"></div>
                         </div>
                    </div>

                    <div class="box-header well" style="margin-top:3px">
                        
                        <div class="box-icon">
                            
                        </div>
                    </div>
                    <div class="box-content" style="height:110px" >
                         <div style="text-align:center" class="alert alert-block">
                            <h4><?php echo date('d').' '.date('M').' '.date('Y') ?></h4>
                         </div>
                         <div style="text-align:center">
                            <h4><?php echo getDay(date('D')); ?></h4>
                         </div>
                    </div>
                     
                </div> 
                <?php 
                    function getDay($sort_day){
                        switch ($sort_day) {
                            case 'Sun':
                                $day='Sunday';                                
                                break;
                            case 'Mon':
                                $day='Monday';                                
                                break;
                            case 'Tue':
                                $day='Tuesday';                                
                                break;
                            case 'Wed':
                                $day='Wednesday';                                
                                break;
                            case 'Thu':
                                $day='Thursday';                                
                                break;
                            case 'Fri':
                                $day='Friday';                                
                                break;
                            case 'Sat':
                                $day='Saturday';                                
                                break;
                            default:
                                # code...
                                break;
                        }
                        return $day;
                    }
                ?>
                <div class="box span9" style="height:300px">
                    <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>Notice for <?php echo date('Y-m-d'); ?></h2>
                        <div class="box-icon">
                              
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="alert alert-success" style="color:red">
                            <?php 
                            $dt=date('Y-m-d');
                            $branch=$this->session->userdata('branch_code');
                            $sql="SELECT * from notice where from_date <='$dt' and to_date>='$dt' and id in (SELECT id from notice where member_group='All' or member_group='$branch')";
                            //echo $sql
                            $rxx=mysql_query($sql);
                            $notice='';
                            while ($rw=mysql_fetch_array($rxx)) {
                                if(!$rw['notice']==''){
                                    $notice=$notice.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$rw['notice'];
                                }
                            }
                            ?>
                            <marquee direction="left"><?php echo $notice; ?></marquee>     
                            

                        </div>
                        <img src="">
                    </div>
                </div>
                <hr>
<div class="row-fluid sortable ui-sortable">
                    <div class="box span3">
                    <div class="box-header well">
                        <h2><i class="icon-th"></i></h2>
                       
                    </div>

                    <div class="box-content">
                         
                            <div id="calc" style="z-index:1!important"></div>
                         
                    </div>
                </div>                
                <div class="box span9">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="icon-list-alt"></i> Statistics</h2>
                        <div class="box-icon">
                           
                        </div>
                    </div>
                    <div class="box-content">
                        <div id="container" style="height: auto; width: auto;"></div>
                    </div>
                </div>
                
</div>

</div>
<div id="mySettings" class="modal fade">
<form method="post" action="<?php echo site_url('administrator/home/save_weather') ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Change Weather Place</h4>
            </div>
            <div class="modal-body">
            
                <select id="woid" name="woid">
                    <option value="">-Please Select-</option>
                    <?php foreach ($records as $rec): ?>
                        <option value="<?php echo $rec['id'] ; ?>"><?php echo $rec['name'] ; ?></option>
                    <?php endforeach ?>
                </select>
            
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-danger" id="del">Save</button>
            </div>
        </div>
    </div>
    </form>
</div>
<?php 
function get_last_member($file_no){
        /*$sql="Select * from file_tracking_details where file_no='$file_no' order by serial_no desc";
        $result=mysql_query($sql);
        $row=mysql_fetch_array($result);
        $member_code= $row['member_code'];
        $x=mysql_query("SELECT member_code,member_name from pen_members where member_code=$member_code");
        $y=mysql_fetch_array($x);
        return $y;*/
    }
?>
