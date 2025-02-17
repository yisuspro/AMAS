<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Amas\UsersController::index');
$routes->addRedirect('/amas/users', '/');
$routes->get('/users', 'Amas\UsersController::index');

//---LOGIN
$routes->post('/users/login', 'Amas\UsersController::login');
$routes->post('/users/logout', 'Amas\UsersController::logout');
$routes->get('/users/menu', 'Amas\UsersController::cargarMenu');
$routes->get('/users/UpdatePasswordUserView/(:num)', 'Amas\UsersController::UpdatePasswordUserView/$1');
$routes->post('/users/UpdatePasswordUser', 'Amas\UsersController::UpdatePasswordUser');


//----USUARIOS
$routes->group('users', function($routes) {
    $routes->get('profileUser', 'Amas\UsersController::profileUser');
    $routes->get('createUserView', 'Amas\UsersController::createUserView');
    $routes->get('listUsersView', 'Amas\UsersController::listUsersView');
    $routes->get('listUser', 'Amas\UsersController::listUser');
    $routes->post('register', 'Amas\UsersController::register');
    $routes->get('updatetUserView/(:num)', 'Amas\UsersController::updatetUserView/$1');
    $routes->post('updateUsers', 'Amas\UsersController::updateUsers');
    $routes->post('updateStateUsers/(:num)', 'Amas\UsersController::updateStateUsers/$1');
    $routes->post('updatePasswordUsers', 'Amas\UsersController::updatePasswordUsers');
    $routes->get('addRolesUsersView/(:num)', 'Amas\UsersController::addRolesUsersView/$1');
    $routes->get('listUsersRoles/(:num)', 'Amas\UsersController::listUsersRoles/$1');
    $routes->post('addRolesUsers/(:num)/(:num)', 'Amas\UsersController::addRolesUsers/$1/$2');
    $routes->get('getPermissionsUsers', 'Amas\UsersController::getPermissionsUsers');
    $routes->get('resultConsultarUsersApps', 'Amas\UsersController::resultConsultarUsersApps');
    $routes->get('prueba', 'Amas\UsersController::prueba');
});

//--PERSONAS
$routes->group('persons', function($routes) {
    $routes->get('consultarUsersAppsView', 'Amas\PersonsController::consultarUsersAppsView');
    $routes->get('personsAdminView', 'Amas\PersonsController::index');
    $routes->post('createPerson', 'Amas\PersonsController::createPerson');
    $routes->post('searchPersonWithUsers', 'Amas\PersonsController::searchPersonWithUsers');
});

//--PERMISOS
$routes->group('permissions', function($routes) {
    $routes->get('listPermissionsView', 'Amas\PermissionsController::index');
    $routes->get('listPermissions', 'Amas\PermissionsController::listPermissions');
    $routes->post('createPermissions', 'Amas\PermissionsController::createPermissions');
    $routes->get('updatePermissionsView/(:num)', 'Amas\PermissionsController::updatePermissionsView/$1');
    $routes->post('updatePermissions', 'Amas\PermissionsController::updatePermissions');
    $routes->post('updateStatePermissions/(:num)', 'Amas\PermissionsController::updateStatePermissions/$1');
});

//--ROLES
$routes->group('roles', function($routes) {
    $routes->get('listRolesView', 'Amas\RolesController::index');
    $routes->get('listRoles', 'Amas\RolesController::listRoles');
    $routes->post('createRoles', 'Amas\RolesController::createRoles');
    $routes->get('updateRolesView/(:num)', 'Amas\RolesController::updateRolesView/$1');
    $routes->post('updateRoles', 'Amas\RolesController::updateRoles');
    $routes->post('updateStateRoles/(:num)', 'Amas\RolesController::updateStateRoles/$1');
    $routes->get('addPermissionsRolesViews/(:num)', 'Amas\RolesController::addPermissionsRolesViews/$1');
    $routes->post('addPermissionsRoles/(:num)/(:num)', 'Amas\RolesController::addPermissionsRoles/$1/$2');
    $routes->get('listRolesPermissions/(:num)', 'Amas\RolesController::listRolesPermissions/$1');
});
//----AUDITORIA------

$routes->group('audit', function($routes) {
    $routes->get('listMyCaseView', 'Amas\AuditoryController::listMyCaseView');
    $routes->get('listMyCase', 'Amas\AuditoryController::listMyCase');
    $routes->post('createMyCases', 'Amas\AuditoryController::createMyCases');
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
    $routes->get('loadingFileCensoIntView', 'Vivanto\RegistroPoblacionalController::loadingFileCensoIntView');
    $routes->post('loadingFileCensoInt', 'Vivanto\RegistroPoblacionalController::loadingFileCensoInt');
});


