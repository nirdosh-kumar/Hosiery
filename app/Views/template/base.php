<?php 
$uriArr = segments_array(current_url(true));
$segmentArr = [
	0=>$uriArr[0],
	1=>$uriArr[1],
	2=>!empty($uriArr[2]) ? $uriArr[2] : '',
	3=>!empty($uriArr[3]) ? $uriArr[3] : '',
];
$title = !empty($uriArr[3]) ? $uriArr[3] : $uriArr[2];
$title = str_replace('-', ' ', $title);

$createdBy = !empty($editRow['userName']) ? $editRow['userName'] : '';
$createdOn = !empty($editRow['created_on']) ? $editRow['created_on'] : '';
$modifiBy = !empty($editRow['modifiby']) ? $editRow['modifiby'] : '';
$modifiOn = !empty($editRow['modified_on']) ? $editRow['modified_on'] : '';
//_p($segmentArr);
?>
<!DOCTYPE html>
<html class="no-js js" lang="en">
  <head>
    <meta charset="utf-8">
	<title><?php echo strtoupper($title); ?></title>
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
	
	<?php $this->renderSection('css'); ?>
	
  </head>
  <body <?php if($segmentArr[2] !== 'dashboard') { echo "class='page-bg'"; } ?>>
    <div class="sticky-top">
		<header class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-3">
					<div class="header-logo">
						<a href="javascript:void(0)" onclick="openNav()" class="me-1"><img src="<?php echo base_url(); ?>public/assets/img/icons/bar.png" alt="Bar" /></a>
						<a href="<?php echo base_url(); ?>dashboard"><img src="<?php echo base_url(); ?>public/assets/img/xel-erp-logo-white.png" align="XEL ERP" /></a>
					</div>
				</div>

				<div class="col-12 col-sm-12 col-md-9">
					<div class="header-right-links">
						<ul>
						  <li class="active">License No.: 123456</li>
						  <!-- <li>IP ADDRESS: 124.122.25.14</li> -->
						  <li>Date/Time: <?php echo addedOn(); ?></li>
						  <!-- <li>TIME: 14:55</li> -->
						  <li>
							<div class="dropdown">
							  <button class="dropdown-toggle dropdown-logout" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php //echo App\Controllers\BaseController::user_info()['username']; 
								echo session('login_name');
								?>
							  </button>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>user/logout">Logout</a></li>
							  </ul>
							</div>
						  </li>
						</ul>
					</div>
				</div>
			</div>
		</header>
	</div>
    <div id="mySidenav" class="sidenav">
		<h2>Navigation</h2>
		<div class="nav-close">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		</div>
		<!-- sidebar -->
		<nav role="navigation" class="sidebar sidebar-light rounded-0">
		  <!-- sidebar menu -->
		  <div class="sidebar-menu">
			<!-- menu -->
<ul class="list list-bg-white list-icon-red list-unstyled list-scrollbar">
<!-- multi-level dropdown menu -->
<li class="list-item">
<!-- list items, first level -->
<ul class="list-unstyled">
  <!-- <li><a href="company1.php" class="list-link">Company 1</a></li>
  <li><a href="company2.php" class="list-link">Company 2</a></li> -->
  <?php if(user_right('user/add-group') == true){ ?>
  <li><a href="<?php echo base_url(); ?>user/add-group" class="list-link">Group</a></li>
  <?php } if(user_right('user/add-user') == true){ ?>
  <li><a href="<?php echo base_url(); ?>user/add-user" class="list-link">User</a></li>
  <?php } 
  if(user_right('master/add-currency') == true || user_right('master/list-currency') == true){ ?>
  <li><a href="<?php echo base_url(); ?>master/add-currency" class="list-link">Currency</a></li>
  <?php } 
  if(user_right('master/add-company') == true || user_right('master/list-company') == true){ ?>
  <li><a href="<?php echo base_url(); ?>master/add-company" class="list-link">Company</a></li>
  <?php } if(user_right('master/add-sizeset') == true){ ?>
  <li><a href="<?php echo base_url(); ?>master/add-sizeset" class="list-link">Size Set</a></li>
  <?php } ?>
  <li><a href="style.php" class="list-link">Style</a></li>
<?php if(user_right('general-code/add-type') == true || user_right('general-code/add-general-code') == true){ ?>
<li><a href="javascript:void(0)" class="list-link link-arrow">Master Data</a>
<ul class="list-unstyled list-hidden">
	<?php if(user_right('general-code/add-type') == true){ ?>
	<li><a href="<?php echo base_url(); ?>general-code/add-type" class="list-link">General Codes Type</a></li>
	<?php } if(user_right('general-code/add-general-code') == true){ ?>
  <li><a href="<?php echo base_url(); ?>general-code/add-general-code" class="list-link">General Codes</a></li>
	<?php } ?>
  <li><a href="javascript:void(0)" class="list-link link-arrow">Order</a>
	<ul class="list-unstyled list-hidden">
	<?php if(user_right('master/add-customer') == true || user_right('master/list-customer') == true){ ?>
	  <li><a href="<?php echo base_url(); ?>master/add-customer" class="list-link">Customer</a></li>
	<?php } if(user_right('product/add-category') == true || user_right('product/list-category') == true){ ?>
	  <li><a href="<?php echo base_url(); ?>product/add-category" class="list-link">Product Category</a></li>
	<?php } if(user_right('product/add-type') == true || user_right('product/list-type') == true){ ?>
	  <li><a href="<?php echo base_url(); ?>product/add-type" class="list-link">Product Type</a></li>
	<?php } ?>
	</ul>
  </li>
</ul>
</li>
<?php } ?>
  <?php /* <li><a href="item-group.php" class="list-link">Item Group</a></li>
  <li><a href="item-type.php" class="list-link">Item Type</a></li>
  <li><a href="item-code.php" class="list-link">Item Code</a></li>
  <li><a href="item-warehouse.php" class="list-link">Item Warehouse</a></li>
  <li><a href="ratio-groups.php" class="list-link">Ratio Groups</a></li> */ ?>
  <?php if(user_right('master/add-supplier') == true || user_right('master/list-supplier') == true){ ?>
  <li><a href="<?php echo base_url(); ?>master/add-supplier" class="list-link">Supplier</a></li>
  <?php } ?>
 <?php /*  <li><a href="costing.php" class="list-link">Costing</a></li>
  <li><a href="coc.php" class="list-link">COC</a></li>
  <li><a href="employee.php" class="list-link">Employee</a></li> */ ?>
</ul>
			  </li>
			</ul>
		  </div>
		</nav>
	</div>
	<?php 
	$this->renderSection('content'); 
	
	//if($segmentArr[2] !== 'dashboard') {
	?>
    <footer>
		<div class="container-fluid">
			<div class="row mt-1 mb-1">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<div class="footer-left">
						| Created By: <?php echo $createdBy; ?> | Created On: <?php echo $createdOn; ?> | Modified By: <?php echo $modifiBy; ?> | Modified On: <?php echo $modifiOn; ?> |
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php //} ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.min-2.1.1.js"></script><!-- Jquery file -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/lib/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap bundle js file -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/plugins.js"></script><!-- Plugins file -->
	<script src="<?php echo base_url(); ?>public/assets/js/vendor/sidebarmenu.js"></script><!-- script js -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/main.js"></script><!-- Custom js file -->
	
	<?php $this->renderSection('js'); ?>
   
  </body>
</html>