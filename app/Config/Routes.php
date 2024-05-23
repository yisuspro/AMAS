<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UsersController::index');

//---LOGIN
$routes->post('/users/login', 'UsersController::login');
$routes->post('/users/logout', 'UsersController::logout');
$routes->get('/users/menu', 'UsersController::cargarMenu');
$routes->get('/users/UpdatePasswordUserView/(:num)', 'UsersController::UpdatePasswordUserView/$1');
$routes->post('/users/UpdatePasswordUser', 'UsersController::UpdatePasswordUser');


//----USUARIOS
$routes->get('/users/profileUser', 'UsersController::profileUser');
$routes->get('/users/createUserView', 'UsersController::createUserView');
$routes->get('/users/listUsersView', 'UsersController::listUsersView');
$routes->get('/users/listUser', 'UsersController::listUser');
$routes->post('/users/register', 'UsersController::register');
$routes->get('/users/updatetUserView/(:num)', 'UsersController::updatetUserView/$1');
$routes->post('/users/updateUsers', 'UsersController::updateUsers');
$routes->post('/users/updateStateUsers/(:num)', 'UsersController::updateStateUsers/$1');
$routes->post('/users/updatePasswordUsers', 'UsersController::updatePasswordUsers');
$routes->get('/users/addRolesUsersView/(:num)', 'UsersController::addRolesUsersView/$1');
$routes->get('/users/listUsersRoles/(:num)', 'UsersController::listUsersRoles/$1');
$routes->post('/users/addRolesUsers/(:num)/(:num)', 'UsersController::addRolesUsers/$1/$2');
$routes->get('/users/getPermissionsUsers', 'UsersController::getPermissionsUsers');
$routes->get('/users/prueba', 'UsersController::prueba');


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