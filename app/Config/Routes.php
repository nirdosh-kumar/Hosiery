<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->add('/', 'Home::index', ['filter'=>'loginfilter']);
$routes->match(['get','post'], 'login', 'Userlogin::index');

$routes->add('dashboard', 'Home::index', ['filter'=>'loginfilter']);

$routes->group('user', ['filter'=>'loginfilter'], function ($routes) {
    $routes->add('logout', 'User::signout');
	$routes->add('list-user', 'User::index');
	$routes->add('add-user', 'User::user_add');
	$routes->add('edit-user/(:num)', 'User::user_edit/$1');
	$routes->add('delete-user/(:num)', 'User::user_delete/$1');
	
	$routes->add('permission/(:num)', 'User::user_permission/$1');
});