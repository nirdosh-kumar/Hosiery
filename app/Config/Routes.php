<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->add('/', 'Home::index', ['filter'=>'loginfilter']);
$routes->match(['get','post'], 'login', 'Userlogin::index');

$routes->add('dashboard', 'Home::index', ['filter'=>'loginfilter']);
$routes->add('user/logout', 'User::signout');

$routes->group('user', ['filter'=>'loginfilter'], function ($routes) {
	/******--user--*****/
	$routes->add('list-user', 'User::index');
	$routes->add('add-user', 'User::user_add');
	$routes->add('edit-user/(:num)', 'User::user_edit/$1');
	$routes->add('delete-user/(:num)', 'User::user_delete/$1');
	$routes->add('permission/(:num)', 'User::user_permission/$1');
	/******--Group--*****/
	$routes->add('list-group', 'User::group_list');
	$routes->add('add-group', 'User::group_add');
	$routes->add('edit-group/(:num)', 'User::group_edit/$1');
	$routes->add('delete-group/(:num)', 'User::group_delete/$1');
	$routes->add('right-group/(:num)', 'User::group_right/$1');
});
$routes->group('general-code', ['filter'=>'loginfilter'], function ($routes) {
	/******--General code type--*****/
	$routes->add('list-type', 'Master::index');
	$routes->add('add-type', 'Master::type_add');
	$routes->add('edit-type/(:num)', 'Master::type_edit/$1');
	$routes->add('delete-type/(:num)', 'Master::type_delete/$1');
	/******--General code--*****/
	$routes->add('list-general-code', 'Master::general_list');
	$routes->add('add-general-code', 'Master::general_add');
	$routes->add('edit-general-code/(:num)', 'Master::general_edit/$1');
	$routes->add('delete-general-code/(:num)', 'Master::general_delete/$1');
});
$routes->group('master', ['filter'=>'loginfilter'], function ($routes) {
	/******--currency--*****/
	$routes->add('list-currency', 'Master::currency_list');
	$routes->add('add-currency', 'Master::currency_add');
	$routes->add('edit-currency/(:num)', 'Master::currency_edit/$1');
	$routes->add('delete-currency/(:num)', 'Master::currency_delete/$1');
	/******--company--*****/
	$routes->add('list-company', 'Master::company_list');
	$routes->add('add-company', 'Master::company_add');
	$routes->add('edit-company/(:num)', 'Master::company_edit/$1');
	$routes->add('delete-company/(:num)', 'Master::company_delete/$1');
	
	$routes->add('select2-generalcode/(:num)', 'Master::select2_generalcode/$1');
	$routes->add('select2-currency', 'Master::select2_currency');
	
	/******--supplier--*****/
	$routes->add('list-supplier', 'Master::supplier_list');
	$routes->add('add-supplier', 'Master::supplier_add');
	$routes->add('edit-supplier/(:num)', 'Master::supplier_edit/$1');
	$routes->add('delete-supplier/(:num)', 'Master::supplier_delete/$1');
	/******--customer--*****/
	$routes->add('list-customer', 'Master::customer_list');
	$routes->add('add-customer', 'Master::customer_add');
	$routes->add('edit-customer/(:num)', 'Master::customer_edit/$1');
	$routes->add('delete-customer/(:num)', 'Master::customer_delete/$1');
	/******--size set--*****/
	$routes->add('list-sizeset', 'Master::sizeset_list');
	$routes->add('add-sizeset', 'Master::sizeset_add');
	$routes->add('edit-sizeset/(:num)', 'Master::sizeset_edit/$1');
	$routes->add('delete-sizeset/(:num)', 'Master::sizeset_delete/$1');
});
$routes->group('product', ['filter'=>'loginfilter'], function ($routes) {
	/******--product category--*****/
	$routes->add('list-category', 'Product::index');
	$routes->add('add-category', 'Product::category_add');
	$routes->add('edit-category/(:num)', 'Product::category_edit/$1');
	$routes->add('delete-category/(:num)', 'Product::category_delete/$1');
	/******--product type--*****/
	$routes->add('list-type', 'Product::type_list');
	$routes->add('add-type', 'Product::type_add');
	$routes->add('edit-type/(:num)', 'Product::type_edit/$1');
	$routes->add('delete-type/(:num)', 'Product::type_delete/$1');
});