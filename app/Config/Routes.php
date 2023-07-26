<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/register', 'Auth::register');
$routes->post('/registration', 'Auth::registration');
$routes->get('/', 'Auth::login');
$routes->post('/logon', 'Auth::logon');
$routes->get('/logout', 'Auth::logout');

$routes->post('/karyawan', 'Admin::karyawan');
$routes->get('/formkaryawan', 'Admin::form');
$routes->get('/karyawan/delete/(:num)', 'Admin::delete_karyawan/$1');
$routes->get('/karyawan/edit/(:num)', 'Admin::edit_karyawan/$1');
$routes->post('/karyawan/update/(:num)', 'Admin::update_karyawan/$1');
$routes->post('/jabatan', 'Admin::jabatan');
$routes->get('/jabatan/delete/(:num)', 'Admin::delete_jabatan/$1');
$routes->get('/dashboard', 'Admin::dashboard');
$routes->get('/laporangajikaryawan', 'Admin::laporangaji');
$routes->post('/laporangajikaryawan/export', 'Admin::export');
// app/Config/Routes.php

$routes->get('/slipgajikaryawan/export', 'LaporanGaji::exportToPdf');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
