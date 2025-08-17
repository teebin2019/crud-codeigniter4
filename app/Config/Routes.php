<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// User
$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
$routes->get('/users/(:num)', 'UserController::show/$1');
$routes->get('/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('/users/update', 'UserController::update');
$routes->get('/users/delete/(:num)', 'UserController::delete/$1');

// Items
$routes->get('/items', 'ItemController::index');
$routes->post('/items', 'ItemController::create');
$routes->get('/items/(:num)', 'ItemController::show/$1');
$routes->post('/items', 'ItemController::update');
$routes->get('/items/(:num)', 'ItemController::delete/$1');
