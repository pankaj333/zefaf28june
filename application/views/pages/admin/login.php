 
<!DOCTYPE html>
<html  style=""><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- bootstrap 2.3.0 -->
    <link href="<?php echo base_url();?>css/admin/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/css/bootstrap-responsive-fluid.css" rel="stylesheet">

    <!-- modernizr: create HTML5 elements for older browsers -->
    <script src="<?php echo base_url();?>css/admin/js/modernizr.js"></script>

    <!-- prometheus: template CSS -->
    <link href="<?php echo base_url();?>css/admin/css/prometheus.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/css/menu.css" rel="stylesheet">

    <!-- prometheus: preview CSS -->
    <link href="<?php echo base_url();?>css/admin/css/preview.css" rel="stylesheet">
    <style>
	    body{ padding:0px !important;}
	</style>

</head>
<body class="login_body">


<div class="login_page_head">
<div class="container">
     <div class="login_page_logo"> </div>
     <div class="login_head_img"><img src="<?php echo base_url();?>css/admin/img/top_img.png"></div>
  </div>
</div><!----/.header----->

<div class="container"><br>
<br>
<?php echo form_open('', array('class' => 'mws-form', 'id' => 'login_form', 'name' => 'login_form')) ?>
   <div class="span4 offset4">
      <div class="login_box">
        <div class="login_box_head"> <img src="<?php echo base_url();?>css/admin/img/lock_icon.png"> Login  </div>
        
        <div class="login_box_center">
        	 
                <div class="span4 offset1" style="color:#F00;">
                    <?php if ($this->session->flashdata('result') != ''): 
					echo $this->session->flashdata('result'); 
				endif;
		echo $errors ?> 
               </div>
          
           <div class="span4 offset1">
                <div class="input-prepend ">
                  <span class="add-on"><img src="<?php echo base_url();?>css/admin/img/icon_user.png" ></span>
                   <?php echo form_input(array('name' => 'email','placeholder'=>'Email', 'class' => 'mws-login-user_email login_input required email', 'id' => 'email', 'value' => set_value('user_email'))); ?>
                </div>
           </div>
           
           <div class="span4 offset1">
                <div class="input-prepend ">
                  <span class="add-on"><img src="<?php echo base_url();?>css/admin/img/icon_lock.png" ></span>
                   <?php echo form_password(array('name' => 'password','placeholder'=>'password', 'class' => 'mws-login-password login_input required', 'id' => 'password')); ?>
                </div>
           </div>
           
            
            
            <div class="clearfix"></div>
        </div><!---/.login center box---->
       <?php echo form_submit(array('name' => 'submit', 'value' => 'Login', 'class' => 'button login_box_btn')); ?>
      </div>
   </div>
   </form>
    <div class="clearfix"></div>
<br>
<br>


</div><!----/.login page center----->

<div class="login_page_footer">
      <div class="container">
            <div class="login_footer_img"><img src="<?php echo base_url();?>css/admin/img/bottom.png"></div>
            <div class="login_footer_copy">© 2013 Hamden Academy of Dance & Music. All Rights Reserved. </div>
      </div>
</div><!----/.footer--->


<!----======================== Javascripts =============================----->

<!-- jQuery (latest version) -->
<script src="<?php echo base_url();?>css/admin/js/jquery-latest.js"></script>
<!-- menu -->
<script src="<?php echo base_url();?>css/admin/js/menu.js"></script>
<!-- bootstrap 2.3.0 -->
<script src="<?php echo base_url();?>css/admin/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>js/validation.js" type="text/javascript"></script>
     <script type="text/javascript">
$().ready(function() { $("#login_form").validate({ }); });
</script>

</body></html>