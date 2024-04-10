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
