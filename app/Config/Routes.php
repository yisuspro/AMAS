<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UsersController::index');
$routes->get('/users/insert', 'UsersController::insert');
//rutas de login
$routes->post('/users/login', 'UsersController::login');


// rutas users
$routes->get('/users/profileUser', 'UsersController::profileUser');