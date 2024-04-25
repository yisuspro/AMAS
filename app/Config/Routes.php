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
$routes->post('/permissions/createPermissions', 'PermissionsController::createPermissions');
$routes->get('/permissions/updatePermissionsView/(:num)', 'PermissionsController::updatePermissionsView/$1');
$routes->post('/permissions/updatePermissions', 'PermissionsController::updatePermissions');
$routes->post('/permissions/updateStatePermissions/(:num)', 'PermissionsController::updateStatePermissions/$1');

//--ROLES
$routes->get('/roles/listRolesView', 'RolesController::index');
$routes->get('/roles/listRoles', 'RolesController::listRoles');
$routes->post('/roles/createRoles', 'RolesController::createRoles');
$routes->get('/roles/updateRolesView/(:num)', 'RolesController::updateRolesView/$1');
$routes->post('/roles/updateRoles', 'RolesController::updateRoles');
$routes->post('/roles/updateStateRoles/(:num)', 'RolesController::updateStateRoles/$1');
$routes->get('/roles/addPermissionsRolesViews/(:num)', 'RolesController::addPermissionsRolesViews/$1');
$routes->post('/roles/addPermissionsRoles/(:num)/(:num)', 'RolesController::addPermissionsRoles/$1/$2');
$routes->get('/roles/listRolesPermissions/(:num)', 'RolesController::listRolesPermissions/$1');