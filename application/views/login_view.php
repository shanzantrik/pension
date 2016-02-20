<!DOCTYPE html>
<html lang="en">
<meta content="no-cache" />
<head>
    <title>PEN-AP Login</title>
    <script src="<?php echo base_url();?>includes/js/jquery-1.7.2.min.js"></script>
    <link id="bs-css" href="<?php echo base_url();?>includes/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">
    </style>
    <link href="<?php echo base_url();?>includes/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>includes/css/charisma-app.css" rel="stylesheet">
    <link href="<?php echo base_url();?>includes/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href='<?php echo base_url();?>includes/css/chosen.css' rel='stylesheet'>
    <link href='<?php echo base_url();?>includes/css/uniform.default.css' rel='stylesheet'>
<link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url();?>includes/images/logo1.png">
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
<body onload="changeHashOnLoad();">
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="row-fluid">
                <div class="span12 center login-header" style="height:200px">
                   <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>includes/images/logo1.png" alt="" title="" border="0" /></a> 
                    <h2> Directorate of Audit & Pension </h2>
                                    </div>
                                    <br/>
            </div>
            <div class="row-fluid">
              <div class="well span5 center login-box">
                <?php 
                    if($this->session->flashdata('message')){
                        echo $this->session->flashdata('message');
                    }else{
                        echo "<div class='alert alert-success'>Login with your member code & password</div>";
                    }
                 ?>
                <form method="POST" class="form-horizontal" action="<?php echo site_url('home/doLogin'); ?>"> 
                        <fieldset>
                            <div class="input-prepend" title="Username" data-rel="tooltip">
                                <span class="add-on"><i class="icon-user"></i></span><input autofocus autocomplete="off" class="input-large span10" placeholder="Member Code" id="username" type="text" name="username" />
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password" data-rel="tooltip">
                                <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" placeholder="Password" type="password" />
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>

                            <p class="center span5">
                            <button type="submit" class="btn btn-primary">Login</button>
                            </p>
                        </fieldset>
                  </form>
                  <h5 style="text-align:center">&copy; Copyright 2014, All Rights Reserved DAP, Arunachal Pradesh, Powered by: <a href="http://www.zantriktechnologies.in">Zantrik Technologies</a></h5>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
