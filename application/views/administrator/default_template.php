<?php $theme= $this->session->userdata('theme');
if(empty($theme)){
	$theme='united';
}
	$cur_url=current_url();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta content="no-cache" />

	<!-- The styles -->
	<link id="bs-css" href="<?php echo base_url()?>includes/css/bootstrap-<?php echo $theme;?>.css" rel="stylesheet">
	<style type="text/css">
	body {
		padding-bottom: 40px;
	}
	.sidebar-nav {
		padding: 9px 0;
	}
	.error{
		color: red;
	}
	.inc-details {
		font-size: 12px;
		color: #191699;
		display: inline;
	}
	</style>
	<link href="<?php echo base_url()?>includes/css/bootstrap-multiselect.css" rel="stylesheet">
	<link href="<?php echo base_url()?>includes/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url()?>includes/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url()?>includes/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo base_url()?>includes/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo base_url()?>includes/css/chosen.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>includes/css/uploadify.css' rel='stylesheet'>
	<link href="<?php echo base_url();?>includes/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
	<link href='<?php echo base_url()?>includes/css/style.css' rel='stylesheet'>
	<link href="<?php echo base_url()?>includes/css/printmedia.css" rel="stylesheet" type="text/css" media="print" >
	<script src="<?php echo base_url()?>includes/js/jquery-1.7.2.min.js"></script>
	<script src='<?php echo base_url()?>includes/js/moment.min.js'></script>
	<script src='<?php echo base_url()?>includes/js/moment-precise-range.js'></script>
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<!-- <link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url();?>includes/images/logo1.png"> -->
	<script type="text/javascript">
	$(document).ready(function() {
	// Create two variable with the names of the months and days in an array
	var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
	var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

	// Create a newDate() object
	var newDate = new Date();
	// Extract the current date from Date object
	newDate.setDate(newDate.getDate());
	// Output the day, date, month and year    
	$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

	setInterval( function() {
	    // Create a newDate() object and extract the seconds of the current time on the visitor's
	    var seconds = new Date().getSeconds();
	    // Add a leading zero to seconds value
	    $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	    },1000);
	    
	setInterval( function() {
	    // Create a newDate() object and extract the minutes of the current time on the visitor's
	    var minutes = new Date().getMinutes();
	    // Add a leading zero to the minutes value
	    $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
	    },1000);
	    
	setInterval( function() {
	    // Create a newDate() object and extract the hours of the current time on the visitor's
	    var hours = new Date().getHours();
	    // Add a leading zero to the hours value
	    $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
	    }, 1000);
	    
	}); 
	</script>
 <script type = "text/javascript" >
function changeHashOnLoad() {
     window.location.href += "#";
     setTimeout("changeHashAgain()", "50"); 
}

function changeHashAgain() {
  window.location.href += "1";
}

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
         window.location.hash = storedHash;
    }
}, 50);


</script> 
</head>
<?php $msg = $this->session->flashdata('message'); ?>
<body <?php if($msg == "Login Successfully.") { ?>onload="changeHashOnLoad();"<?php } ?>>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="<?php echo base_url() ?>index.php/administrator/home"> <img alt="" src="<?php echo base_url();?>includes/images/pension-project-logo.png" /></a> <b>Version Z-1.0</b>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="<?php echo site_url('administrator/home/change_theme/classic').'?path='.$cur_url ?>"><?php if ($theme=='classic'): ?><i class="icon-ok"></i><?php endif ?> Classic</a></li>
						<li><a data-value="cerulean" href="<?php echo site_url('administrator/home/change_theme/cerulean').'?path='.$cur_url ?>"><?php if ($theme=='cerulean'): ?><i class="icon-ok"></i><?php endif ?> Cerulean</a></li>
						<li><a data-value="cyborg" href="<?php echo site_url('administrator/home/change_theme/cyborg').'?path='.$cur_url ?>"><?php if ($theme=='cyborg'): ?><i class="icon-ok"></i><?php endif ?> Cyborg</a></li>
						<li><a data-value="redy" href="<?php echo site_url('administrator/home/change_theme/redy').'?path='.$cur_url ?>"><?php if ($theme=='redy'): ?><i class="icon-ok"></i><?php endif ?> Redy</a></li>
						<li><a data-value="journal" href="<?php echo site_url('administrator/home/change_theme/journal').'?path='.$cur_url ?>"><?php if ($theme=='journal'): ?><i class="icon-ok"></i><?php endif ?> Journal</a></li>
						<li><a data-value="simplex" href="<?php echo site_url('administrator/home/change_theme/simplex').'?path='.$cur_url ?>"><?php if ($theme=='simplex'): ?><i class="icon-ok"></i><?php endif ?> Simplex</a></li>
						<li><a data-value="slate" href="<?php echo site_url('administrator/home/change_theme/slate').'?path='.$cur_url ?>"><?php if ($theme=='slate'): ?><i class="icon-ok"></i><?php endif ?> Slate</a></li>
						<li><a data-value="spacelab" href="<?php echo site_url('administrator/home/change_theme/spacelab').'?path='.$cur_url ?>"><?php if ($theme=='spacelab'): ?><i class="icon-ok"></i><?php endif ?> Spacelab</a></li>
						<li><a data-value="united" href="<?php echo site_url('administrator/home/change_theme/united').'?path='.$cur_url ?>"><?php if ($theme=='united'): ?><i class="icon-ok"></i><?php endif ?> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"><?php echo $this->session->userdata('member_name'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-user"></i>Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('home/logout'); ?>"><i class="icon-off"></i>Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<!-- <ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul> -->
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	 
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
			<?php $this->load->view('administrator/menu/menu') ?>
				<!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">&raquo;</span>
					</li>

					
					<li>
						<a href="#"><b><?php echo $title; ?></b></a>
						&nbsp;&middot;&nbsp;<a title="Refesh Window" href="<?php echo current_url();?>"><i class="icon-refresh"></i> Refresh</a>
					</li>
					<li style="float:right">
						<div class="clock">
						 	<!-- <div style="float:left" id="Date"></div> -->
						    <p  style="float:left" id="hours"> </p>
						    <div  style="float:left" id="point">:</div>
						    <p  style="float:left" id="min"> </p>
						    <div  style="float:left" id="point">:</div>
						    <p  style="float:left" id="sec"> </p>
						</div>
					</li>
				</ul>
			</div>
			<div class="sortable row-fluid" style="min-height:500px">
				<?php echo $this->session->flashdata('message'); ?>
				<?php echo $content ?>
			</div>

			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="#" target="_blank">DAP, Arunachal Pradesh</a> 2014, All Rights Reserved.</p>
			<p class="pull-right">Powered by: <a href="http://www.zantriktechnologies.com" target="_blank">Zantrik Technologies</a></p>
		</footer>
		
	</div><!--/.fluid-container-->
	
	<script src="<?php echo base_url();?>includes/js/bootstrap-multiselect.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>includes/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-alert.js"></script>
	<script src="<?php echo base_url()?>includes/js/print.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo base_url()?>includes/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo base_url()?>includes/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo base_url()?>includes/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo base_url()?>includes/js/jquery.dataTables.min.js'></script>
	
</body>
</html>
