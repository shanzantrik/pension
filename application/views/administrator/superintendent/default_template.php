<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Optimus Dashboard Bootstrap Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>

	<link href="<?php echo base_url();?>includes/css/bootstrap.css" rel="stylesheet" id="bootstrap-style">
	<link href="<?php echo base_url();?>includes/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>includes/css/style.css" rel="stylesheet" id="base-style">
	<link href="<?php echo base_url();?>includes/css/style-responsive.css" rel="stylesheet" id="base-style-responsive">
	<link href="<?php echo base_url();?>includes/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>includes/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>includes/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">

	<script src="<?php echo base_url();?>includes/js/jquery-1.7.2.min.js"></script>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo site_url('member/dashboard') ?>"><?php echo $title; ?></span></a>
								
				<!-- start: Header Menu -->
				<div class="btn-group pull-right" >
				
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> <?php echo $this->session->userdata('member_name'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('home/logout'); ?>">Logout</a></li>
					</ul>
					<!-- end: User Dropdown -->
				</div>
				<!-- end: Header Menu -->
			</div>
		</div>
	</div>
	<div id="under-header"></div>
	<!-- start: Header -->
	<div class="container-fluid">
		<div class="row-fluid">
			<!-- start: Main Menu -->
			<div class="span2 main-menu-span">
				<div class="accordian nav-collapse sidebar-nav">
					<ul>
						
						<li><i class="icon-file"></i> Token Mgmnt</li>
						<li class="superandant">
							<a href="<?php echo site_url('superandant/superandant'); ?>" style="margin-top: 5px;">Allocate To Dealing Assistant</a>
							<a href="<?php echo site_url('superandant/superandant/allocate'); ?>" style="margin-top: 5px;">Allocated Files</a>
						</li>
						<li><i class="icon-book"></i> Service Book</li>
						<li class="service-book">
							<a href="<?php echo site_url('member/service_book/add'); ?>" style="margin-top: 5px;"> Service Book Entry</a>
							<a href="<?php echo site_url('member/service_book'); ?>"> View Service Book</a>
							<a href="<?php echo site_url('member/pension/file'); ?>"> Pensioner File</a>
						</li>
						<li><i class="icon-user"></i> Privilege</li>
						<li class="privilege">
							<a href="<?php echo site_url('superandant/superandant/add_member'); ?>" style="margin-top: 5px;"> Add Member</a>
							<a href="<?php echo site_url('superandant/superandant/view_member'); ?>"> View Member</a>
						</li>
						


					</ul>
				</div>
			</div><!--/span-->
			<!-- end: Main Menu -->
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<div id="content" class="span10">
				<?php echo $this->session->flashdata('message'); ?>
            	<?php echo $content; ?>
            </div>
		</div><!--/fluid-row-->	
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
		<div class="clearfix"></div>
		<hr>
		<footer>
			<p class="pull-left">&copy; <a href="" target="_blank">Zantrik Technologies</a> 2014</p>
			<p class="pull-right">Powered by: <a href="#">Zantrik</a></p>
		</footer>		
	</div>
	<script src="<?php echo base_url();?>includes/js/jquery.dataTables.min.js" type="text/javascript" language="javascript"></script>
	<script src="<?php echo base_url();?>includes/js/dataTables.bootstrap.js" type="text/javascript" language="javascript"></script>
	<script src="<?php echo base_url();?>includes/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script src="<?php echo base_url();?>includes/js/bootstrap.js"></script>
	<script src="<?php echo base_url();?>includes/js/bootstrap-multiselect.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>includes/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>includes/js/jMenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php $uri = $this->uri->segment(2); ?>
			<?php if($uri == "department" || $uri == "designation" || $uri == "member_type" || $uri == "branch" || $uri == "document" || $uri == "commutation" || $uri == "da") { ?>
				activeTab('.master-entry');
			<?php } elseif ($uri == "member") { ?>
				activeTab('.privilege');
			<?php } elseif ($uri == "service_book" || $uri == "pension") { ?>
				activeTab('.service-book');
			<?php } elseif ($uri == "receipt") { ?>
				activeTab('.receipt');
			<?php } else {} ?>
		});

		function activeTab(activeTabClass) {
			$('.dimension').css('display', 'none');
			$('.even').css('padding-left', '10px');
			$(activeTabClass).css('display', 'list-item').prev('li').css('padding-left', '30px');
		}
	</script>
	</body>
</html>