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


/**
 * rutas para el login
 */

$routes->get('login', 'login_controller::login'); //Muestra el formulario de inicio de sesión.
$routes->post('login', 'login_controller::authenticate'); //Procesa los datos de inicio de sesión enviados - Verifica las credenciales del usuario - Inicia la sesión si las credenciales son correctas.
$routes->get('cerrar-inicio', 'login_controller::logout', ['filter' => 'auth']); //Cierra la sesión del usuario autenticado y redirige a la pagina principal

/**
 * rutas para CRUD de productos ---------------------------------------------------------------------------------------
 */

 $routes->get('/crud', 'producto_controller::index', ['filter' => 'admin']);
 $routes->get('/produ-form', 'producto_controller::crearproducto', ['filter' => 'admin']);
 $routes->post('/enviar-prod', 'producto_controller::alta_producto', ['filter' => 'admin']);

$routes->get('/vista_editar/(:num)', 'producto_controller::vistaEditarProducto/$1', ['filter' => 'admin']);

$routes->post('/editar/(:num)', 'producto_controller::editarProducto/$1', ['filter' => 'admin']);

$routes->get('/produ-eliminados', 'producto_controller::vista_productos_eliminados', ['filter' => 'admin']);

$routes->get('/produ-eliminar/(:num)', 'producto_controller::eliminarProducto/$1', ['filter' => 'admin']);

$routes->get('/produ-restaurar/(:num)', 'producto_controller::restaurarProducto/$1', ['filter' => 'admin']);


/**
 * Rutas del crud de usuarios -------------------------------------------------------------------------------------------
 */
$routes->get('crud_usuarios', 'usuario_controller::cargar_crud', ['filter' => 'admin']);
$routes->get('ver_usuarios_eliminados', 'usuario_controller::ver_eliminados', ['filter' => 'admin']);

$routes->get('/ver_editar_usuario/(:num)', 'usuario_controller::ver_editarUsuario/$1', ['filter' => 'admin']);

$routes->post('/editar_usuario/(:num)', 'usuario_controller::editarUsuario/$1', ['filter' => 'admin']);

$routes->get('/eliminar_usuario/(:num)', 'usuario_controller::eliminarUsuario/$1', ['filter' => 'admin']);

$routes->get('/restaurar_usuario/(:num)', 'usuario_controller::restaurarUsuario/$1', ['filter' => 'admin']);