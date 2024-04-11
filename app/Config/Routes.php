<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->get('/', 'Store::products');
$routes->get('store', 'Store::products');
$routes->get('store/(:num)', 'Store::products/$1');
$routes->get('store/product/(:num)', 'Store::single/$1');
$routes->get('cart', 'StoreCart::index');
$routes->post('store/cart/add', 'StoreCart::add_item');
$routes->post('store/cart/update', 'StoreCart::update_item');
$routes->get('store/cart/remove/(:num)', 'StoreCart::remove_item/$1');
$routes->get('store/cart/empty', 'StoreCart::empty_cart');
$routes->get('cart/checkout', 'StoreCart::checkout');
$routes->get('cart/checkout/order', 'StoreCart::place_order');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/login', 'Auth::index');
$routes->get('auth/signout', 'Auth::logout');
$routes->get('auth/register', 'Auth::register_g');
$routes->post('auth/register', 'Auth::register');
$routes->get('admin', 'Admin::index');
$routes->get('admin/customers', 'Admin::customers');
$routes->get('admin/products', 'Admin::products');
$routes->get('admin/orders', 'Admin::orders');
$routes->get('admin/customers/(:num)', 'Admin::customers/$1');
$routes->get('admin/products/(:num)', 'Admin::products/$1');
$routes->get('admin/orders/(:num)', 'Admin::orders/$1');
$routes->get('admin/order/details/(:num)', 'Admin::order_details/$1');
// $routes->get('admin/products/(:num)', 'Admin::index');
$routes->get('admin/add/products', 'Admin::upload');
$routes->get('admin/delete/products/(:num)', 'Admin::delete_product');

$routes->post('product/upload', 'Admin::upload');
