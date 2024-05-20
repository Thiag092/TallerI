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
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');

$routes->get('/quienes_somos', 'Home::quienes_somos');

$routes->get('/terminos_y_usos', 'Home::terminos_y_usos');

$routes->get('/contacto', 'Home::contacto');

$routes->get('/comercializacion', 'Home::comercializacion');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * 
 * 
 * 
 /**
 * Rutas del Registro de Usuarios
 */
$routes->get('registro', 'usuario_controller::create');
$routes->post('procesar-registro', 'usuario_controller::formValidation'); 

