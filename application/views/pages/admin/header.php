<!DOCTYPE html>
<html  style=""><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	<script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
	
</head>
<body>

<!-------======================== Header ==========================----->
<header>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">

                <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- logo -->
                <a class="logo" href="<?php echo base_url();?>admin"><img src="<?php echo base_url();?>img/logo.png"></a>
                <!-- breadcrumbs -->
                <ul class="breadcrumb visible-desktop">
                    <li class="home"><a href="#"></a> <span class="divider"></span></li>
                     </ul>

                <!-- profile bar -->
                <ul class="profileBar">
                    <li class="user visible-desktop"><img width="35" height="30" src="<?php echo base_url();?>css/admin/img/user.jpg" title="Harry" alt="Harry"></li>
                    <li class="profile"><a tabindex="-1" href="<?php echo base_url();?>admin/logout">Logout</a></li>
                   
                </ul>
 		  </div>
        </div>
    </div>

</header>