<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Store::products');
$routes->get('store', 'Store::products');
$routes->get('store/(:num)', 'Store::single/$1');
