<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Store::products');
$routes->get('store', 'Store::products');
$routes->get('store/(:num)', 'Store::single/$1');
$routes->get('cart', 'StoreCart::index');
$routes->post('store/cart/add', 'StoreCart::add_item');
$routes->post('store/cart/update', 'StoreCart::update_item');
$routes->post('store/cart/remove', 'StoreCart::remove_item');
$routes->post('store/cart/empty', 'StoreCart::empty_cart');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/login', 'Auth::index');
$routes->get('auth/signout', 'Auth::logout');
$routes->get('admin', 'Admin::index');
$routes->get('admin/users', 'Admin::users');
$routes->get('admin/products', 'Admin::products');
// $routes->get('admin/products/(:num)', 'Admin::index');
$routes->get('admin/add/products', 'Admin::new_products');
$routes->get('admin/delete/products/(:num)', 'Admin::delete_product');

