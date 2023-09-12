<?php 
$uriArr = segments_array(current_url(true));
$segmentArr = [
	0=>$uriArr[0],
	1=>$uriArr[1],
	2=>!empty($uriArr[2]) ? $uriArr[2] : '',
	3=>!empty($uriArr[3]) ? $uriArr[3] : '',
];
//_p($segmentArr);
?>
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
						  <li>Date/Time: 24/10/2018/14:55</li>
						  <!-- <li>TIME: 14:55</li> -->
						  <li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
							<ul class="dropdown-menu id-list">
							  <li><a href="javascript:void(0)" title="Logout">Logout</a></li>
							</ul>
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
				  <li><a href="<?php echo base_url(); ?>user/add-user" class="list-link">User</a></li>
				  <li><a href="currency.php" class="list-link">Currency</a></li>
				  <li><a href="company.php" class="list-link">Company</a></li>
				  <li><a href="style.php" class="list-link">Style</a></li>
				  <!-- <li><a href="javascript:void(0)" class="list-link">System Setup</a></li> -->
				  <li><a href="javascript:void(0)" class="list-link link-arrow">Master Data</a>
					<ul class="list-unstyled list-hidden">
					  <li><a href="general-codes.php" class="list-link">General Codes</a></li>
					  <li><a href="javascript:void(0)" class="list-link link-arrow">Order</a>
						<ul class="list-unstyled list-hidden">
						  <li><a href="customer.php" class="list-link">Customer</a></li>
						  <li><a href="product-category.php" class="list-link">Product Category</a></li>
						  <li><a href="product-type.php" class="list-link">Product Type</a></li>
						</ul>
					  </li>
					</ul>
				  </li>
				  <li><a href="item-group.php" class="list-link">Item Group</a></li>
				  <li><a href="item-type.php" class="list-link">Item Type</a></li>
				  <li><a href="item-code.php" class="list-link">Item Code</a></li>
				  <li><a href="item-warehouse.php" class="list-link">Item Warehouse</a></li>
				  <li><a href="ratio-groups.php" class="list-link">Ratio Groups</a></li>
				  <li><a href="supplier.php" class="list-link">Supplier</a></li>
				  <li><a href="costing.php" class="list-link">Costing</a></li>
				  <li><a href="coc.php" class="list-link">COC</a></li>
				  <li><a href="employee.php" class="list-link">Employee</a></li>
				  <li><a href="<?php echo base_url(); ?>user/logout" class="list-link">Logout</a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		</nav>
	</div>
	<?php 
	$this->renderSection('content'); 
	
	if($segmentArr[2] !== 'dashboard') {
	?>
    <footer>
		<div class="container-fluid">
			<div class="row mt-1 mb-1">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<div class="footer-left">
						| Created By: Ankur | Created On: 10-05-2023 | Modified By: Siraj | Modified On: 15-05-2023 |
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php } ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.min-2.1.1.js"></script><!-- Jquery file -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/lib/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap bundle js file -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/plugins.js"></script><!-- Plugins file -->
	<script src="<?php echo base_url(); ?>public/assets/js/vendor/sidebarmenu.js"></script><!-- script js -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/main.js"></script><!-- Custom js file -->
	
	<?php $this->renderSection('js'); ?>
   
  </body>
</html>