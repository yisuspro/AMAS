<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UsersController::index');

//rutas de login
$routes->post('/users/login', 'UsersController::login');
$routes->post('/users/logout', 'UsersController::logout');
$routes->get('/users/menu', 'UsersController::cargarMenu');
// rutas users
$routes->get('/users/profileUser', 'UsersController::profileUser');
$routes->get('/users/createUserView', 'UsersController::createUserView');
$routes->get('/users/listUsersView', 'UsersController::listUsersView');
$routes->get('/users/listUser', 'UsersController::listUser');
$routes->post('/users/register', 'UsersController::register');

//--PERMISOS
$routes->get('/permissions/listPermissionsView', 'PermissionsController::index');
$routes->get('/permissions/listPermissions', 'PermissionsController::listPermissions');