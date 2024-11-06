<?php
	session_start();
	$_SESSION['username'] = $this->session->userdata('member_code'); // Must be already set
    $_SESSION['chatname'] =$this->session->userdata('member_name'); 
?>
<?php //$this->load->view('header'); ?>
<script type="text/javascript">
	var baseUrl = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url()?>includes/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/chat/js/chat.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>includes/chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>includes/chat/css/screen.css" />
<h3 style="color:orange">DAP-Arunachal Pradesh | Employee Chat Panel &raquo; <small style="color:darkgrey; font-size:12px;font-weight:bold">Use this panel to send instant messages IMs to various employees of the department</small></h3>
 
<div id="users" style="width: 40%; height: 300px; overflow-y: scroll;">
	<?php
		if(isset($listOfUsers))
	    {
	    	foreach($listOfUsers->result() as $res)
		 	{
	    		if($this->session->userdata('member_code')!=$res->member_code) { ?>
					<li style="font-size:14px; padding:8px; list-style:none; cursor:pointer; font-weight:bold"> <a title="Chat with <?php echo $res->member_name;?> (<?php echo $res->member_code;?>) " href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->member_code;?>','<?php echo $res->member_name;?>');">
						<?php echo $res->member_name;?></a>  
						<?php if($res->logged_in=='yes') { ?> <img title="<?php echo $res->member_name;?> is online" width="3%" src="<?php echo base_url();?>includes/images/act.ico"> <?php } ?>
						<br/><small style="color:darkgrey; font-size:12px; font-weight:bold"><?php echo  getDesignation($res->desg_code);?>
						&raquo; <small title="Employee Code" style="color:#3b5999;font-size:12px;"><?php echo $res->member_code;?></small>
					</li>		
                <?php }	
			}
		}
	?>
</div>
					 