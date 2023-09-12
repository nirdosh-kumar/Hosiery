<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
	<title>XEL ERP</title>
	<meta name="description" content="XEL ERP" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- <base href="https://hobsxel.in/xel-erp/"/> -->
	<link rel="icon" href="<?php echo base_url(); ?>public/assets/img/favicon.png" type="image/gif" sizes="32x32" /><!-- Favicon file -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/lib/font-awesome-4.7.0/css/font-awesome.min.css"><!-- Bootstrap file -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/lib/fontawesome-free-6.1.1/css/all.min.css"><!-- Bootstrap file -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/lib/bootstrap-5.2.2-dist/css/bootstrap.min.css"><!-- Bootstrap file -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/vendor/topsidebarmenu.css"><!-- Sidebar Menu css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/vendor/sidebar.css"><!-- Sidebar css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/main.css" /><!-- Custom css file -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/responsive.css" /><!-- Responsive css file -->
  </head>
  <body id="top">
    <div class="page_loader"></div>
    <div class="login-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-section">
                        <div class="form-inner">
                            <a href="login-5.html" class="logo">
                                <img src="<?php echo base_url(); ?>public/assets/img/xel-erp-logo.png" alt="logo">
                            </a>
                            <h3>Sign Into Your Account</h3>
<?php if(!empty(session('error'))) { ?> 
	<div class='alert alert-danger' role='alert'><strong>Oops! </strong><?php print_r(session('error')); ?></div>
	<?php  } if(!empty(session('success'))) { ?>
	<div class='alert alert-success' role='alert'><strong>Success! </strong><?php print_r(session('success')); ?></div>
	<?php } ?>								
<?php echo form_open('', ['id'=>'loginForm']); ?>
	<form action="#" method="GET">
		<div class="form-group form-box clearfix">
			<input type="email" class="form-control" placeholder="Email Address" aria-label="Email Address" name="email" id="email"/>
			<img src="<?php echo base_url(); ?>public/assets/img/icons/email-icon.png" alt="Email" />
		</div>
		<div class="form-group form-box clearfix">
			<input type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" name="password" id="password"/>
			<img src="<?php echo base_url(); ?>public/assets/img/icons/password-icon.png" alt="Password" />
		</div>
		<div class="form-group">
			<button type="submit" name="loginbtn" class="btn btn-primary btn-lg btn-theme"><span>Login</span></button>
		</div>
	<?php echo form_close(); ?>
                        </div>

                        <div class="login-copyright">@ Copyright XEL ERP. License Version B0.1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.min-2.1.1.js"></script><!-- Jquery file -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/lib/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap bundle js file -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/plugins.js"></script><!-- Plugins file -->
<script src="<?php echo base_url(); ?>public/assets/js/vendor/sidebarmenu.js"></script><!-- script js -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/main.js"></script><!-- Custom js file -->
  </body>
</html>