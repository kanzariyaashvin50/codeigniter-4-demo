<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('LoginController');
$routes->setDefaultController('admin/Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'admin/LoginController::index');

// Admin Routes
$routes->group("admin", function ($routes) {
    # Login Router
    $routes->get('login','admin/LoginController::index');
    $routes->post('login','admin/LoginController::login');
    $routes->get('logout','admin/LoginController::logout');

    # DashBoard Routes
    $routes->get('dashboard','admin/DashboardController::index',['filter' => 'authGuard']);

    # Admin Profile
    $routes->get('profile','admin/ProfileController::index',['filter' => 'authGuard']);    
    $routes->post('profile','admin/ProfileController::updateProfile',['filter' => 'authGuard']);    

    # Users Routes
    $routes->get('users','Admin/UsersController::index',['filter' => 'authGuard']);
    $routes->get('users/(:num)/edit','Admin/UsersController::edit',['filter' => 'authGuard']);
    $routes->put('users/(:num)','Admin/UsersController::update',['filter' => 'authGuard']);
    $routes->post('users/(:num)', 'Admin/UsersController::delete',['filter' => 'authGuard']);
    $routes->get('users/(:num)', 'Admin/UsersController::show',['filter' => 'authGuard']);

});



$routes->group("api", function ($routes) {
    $routes->post('create-users','ApiController::create');
    $routes->post('login-users','ApiController::login');
    $routes->get('get-users','ApiController::getUser');
});

$routes->group('api', ['filter' => 'basicauth'], function ($routes) {
    $routes->get('user','UserController::index');
    $routes->put('user/(:num)','UserController::update');
    $routes->delete('user/(:num)','UserController::delete/$1');
});
 
  

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
