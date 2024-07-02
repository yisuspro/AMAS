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
$routes->group('users', function($routes) {
    $routes->get('profileUser', 'UsersController::profileUser');
    $routes->get('createUserView', 'UsersController::createUserView');
    $routes->get('listUsersView', 'UsersController::listUsersView');
    $routes->get('listUser', 'UsersController::listUser');
    $routes->post('register', 'UsersController::register');
    $routes->get('updatetUserView/(:num)', 'UsersController::updatetUserView/$1');
    $routes->post('updateUsers', 'UsersController::updateUsers');
    $routes->post('updateStateUsers/(:num)', 'UsersController::updateStateUsers/$1');
    $routes->post('updatePasswordUsers', 'UsersController::updatePasswordUsers');
    $routes->get('addRolesUsersView/(:num)', 'UsersController::addRolesUsersView/$1');
    $routes->get('listUsersRoles/(:num)', 'UsersController::listUsersRoles/$1');
    $routes->post('addRolesUsers/(:num)/(:num)', 'UsersController::addRolesUsers/$1/$2');
    $routes->get('getPermissionsUsers', 'UsersController::getPermissionsUsers');
    $routes->get('consultarUsersAppsView', 'UsersController::consultarUsersAppsView');
    $routes->get('resultConsultarUsersAppsView/(:num)/(:segment)', 'UsersController::resultConsultarUsersAppsView/$1/$2');
    $routes->get('resultConsultarUsersApps', 'UsersController::resultConsultarUsersApps');
    $routes->get('prueba', 'UsersController::prueba');
});



//--PERMISOS
$routes->group('permissions', function($routes) {
    $routes->get('listPermissionsView', 'PermissionsController::index');
    $routes->get('listPermissions', 'PermissionsController::listPermissions');
    $routes->post('createPermissions', 'PermissionsController::createPermissions');
    $routes->get('updatePermissionsView/(:num)', 'PermissionsController::updatePermissionsView/$1');
    $routes->post('updatePermissions', 'PermissionsController::updatePermissions');
    $routes->post('updateStatePermissions/(:num)', 'PermissionsController::updateStatePermissions/$1');
});

//--ROLES
$routes->group('roles', function($routes) {
    $routes->get('listRolesView', 'RolesController::index');
    $routes->get('listRoles', 'RolesController::listRoles');
    $routes->post('createRoles', 'RolesController::createRoles');
    $routes->get('updateRolesView/(:num)', 'RolesController::updateRolesView/$1');
    $routes->post('updateRoles', 'RolesController::updateRoles');
    $routes->post('updateStateRoles/(:num)', 'RolesController::updateStateRoles/$1');
    $routes->get('addPermissionsRolesViews/(:num)', 'RolesController::addPermissionsRolesViews/$1');
    $routes->post('addPermissionsRoles/(:num)/(:num)', 'RolesController::addPermissionsRoles/$1/$2');
    $routes->get('listRolesPermissions/(:num)', 'RolesController::listRolesPermissions/$1');
});

//-----RUV-------
$routes->group('Ruv', function($routes) {

    $routes->get('listUser/(:num)/(:segment)', 'Ruv\UsersRuvController::listUser/$1/$2');
});

//-----SIRAV-------
$routes->group('Sirav', function($routes) {

    $routes->get('listUser/(:num)/(:segment)', 'Sirav\UsersSiravController::listUser/$1/$2');
});

//-----SIPOD-------
$routes->group('Sipod', function($routes) {

    $routes->get('listUser/(:num)/(:segment)', 'Sipod\UsersSipodController::listUser/$1/$2');
});


//-----VIVANTO-------
$routes->group('Vivanto', function($routes) {
    $routes->get('/', 'Vivanto\RegistroPoblacionalController::index');

    $routes->get('loadingFileCensoView', 'Vivanto\RegistroPoblacionalController::loadingFileCensoView');
    $routes->post('loadingFileCenso', 'Vivanto\RegistroPoblacionalController::loadingFileCenso');
    $routes->get('loadingFileCensoUbicaView', 'Vivanto\RegistroPoblacionalController::loadingFileCensoUbicaView');
    $routes->post('loadingFileCensoUbica', 'Vivanto\RegistroPoblacionalController::loadingFileCensoUbica');
});


