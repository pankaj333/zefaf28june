<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $pagetitle; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/app.css" />
<script src="<?php echo base_url(); ?>js/vendor/modernizr.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
var APP_PATH='<?php echo base_url();?>';
</script>
</head>
<body class="home">
<!--CONTAINER-->
<div id="Container"> 
  <!--HEADER-->
  <div id="header">
    <div class="row">
      <div class="small-2 columns logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>img/logo.png"></a></div>
      <div class="small-10 columns navigation">
        <ul class="social-media top-nav">
        <li style="float: left;"><form method="post" action="<?php echo base_url();?>store/searchstore" class="search"><input type="text" placeholder="search" id="storename" name="storename">
                  <input type="submit" value="submit">
                </form></li>
         <?php if($this->session->userdata('user_id')) {?>
         <li class="register"><a href="javascript:">Welcome </a> <?=$this->session->userdata('name')?></li>
		 <li class="register"><a href="<?php echo base_url();?>logout">Logout</a></li>
         <?php if($this->session->userdata('authlevel')===TRUE) { ?>
         <li class="register"><a href="<?php echo base_url();?>home/updateinfo">My Info</a></li>
         <?php }}else{?>
         <li class="login"><a href="<?php echo base_url();?>login">Login</a></li>
          <li class="register"><a href="<?php echo base_url();?>signup">Register</a></li>
            <?php }?>
			
			<?php if(!$this->session->userdata('user_id')){?>
          <li class="or">or</li>
           
          <li class="fb"><a href="<?=base_url().'home/fblogin'?>"><img src="<?php echo base_url();?>img/fb.jpg"></a></li>
  <li class="tweet"><a href="<?=base_url().'home/twitterlogin'?>"><img src="<?php echo base_url();?>img/tweet.jpg"></a></li>
   <li class="g-plus"><a href="<?=base_url().'home/glogin'?>"><img src="<?php echo base_url();?>img/g-plus.jpg"></a></li> 
          <?php } ?>
        </ul>
        <!--NAVIGATION-->
        <div class="clearfix"></div>
        <ul class="custom-side-nav main-nav">
          <li class="active"><a href="<?php echo base_url();?>">home</a></li>
          <li><a href="<?php echo base_url();?>store/addstore">add store</a></li>
          <li><a href="<?php echo base_url();?>taskspane">tasks pane</a></li>
          <li><a href="<?php echo base_url();?>contact">contact us</a></li>
          <li><a href="<?php echo base_url();?>about">about us</a></li>
        </ul>
        
        <!--NAVIGATION END--> 
      </div>
    </div>
  </div>
 </head>
 <body>