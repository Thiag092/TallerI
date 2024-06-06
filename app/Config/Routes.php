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

$routes->get('consulta2', 'Home::consulta2');


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





/**
 * Rutas de la seccion "RESPONDER CONSULTAS" de la barra de nav----------------------------------------------------------
 */
//la carga se encarga $routes->get('contacto', 'Home::f_contacto');

$routes->get('consultas_view', 'consulta_controller::ver_consultas', ['filter' => 'admin']);
$routes->get('ver_consultas_respondidas', 'consulta_controller::ver_consultas_respondidas', ['filter' => 'admin']);

$routes->post('enviar_consulta', 'consulta_controller::formValidation');//No admin ni logueado

$routes->get('/responder_consulta/(:num)', 'consulta_controller::responderConsulta/$1', ['filter' => 'admin']);

$routes->get('/restaurar_consulta/(:num)', 'consulta_controller::restaurarConsulta/$1', ['filter' => 'admin']);








/**
 * Rutas de la seccion "RESPONDER CONSULTAS 2222222222222222" de la barra de nav----------------------------------------------------------
 */
//la carga se encarga $routes->get('contacto', 'Home::f_contacto');

$routes->get('consultas2_view', 'consulta2_controller::ver_consultas', ['filter' => 'admin']);
$routes->get('ver_consultas2_respondidas', 'consulta2_controller::ver_consultas_respondidas', ['filter' => 'admin']);

$routes->post('enviar_consulta2', 'consulta2_controller::formValidation');//No admin ni logueado

$routes->get('/responder_consulta2/(:num)', 'consulta2_controller::responderConsulta/$1', ['filter' => 'admin']);

$routes->get('/restaurar_consulta2/(:num)', 'consulta2_controller::restaurarConsulta/$1', ['filter' => 'admin']);




/**Admin
 * Rutas de "MOSTRAR VENTAS"" --------------------------------------------------------------------------------------
 */
$routes->get('listar_ventas', 'vtas_controller::ver_ventas', ['filter' => 'admin']);
$routes->get('/ver_venta_detalle/(:num)', 'vtas_controller::ver_venta_detalle/$1', ['filter' => 'admin']);




/**
 * Rutas del carrito--------------------------------------------------------------------------------------------------
 */
$routes->get('/carrito', 'carrito_controller::ver_carrito', ['filter' => 'auth']);
$routes->get('catalogo', 'carrito_controller::catalogo');
$routes->post('carrito_agregar/(:num)', 'carrito_controller::agregar/$1', ['filter' => 'auth']);
//$routes->post('carrito_agregar', 'carrito_controller::agregar',['filter' => 'auth']);
$routes->get('sumar_a_carrito/(:any)', 'carrito_controller::sumar_carrito/$1', ['filter' => 'auth']);
$routes->get('restar_a_carrito/(:any)', 'carrito_controller::restar_carrito/$1', ['filter' => 'auth']);
$routes->get('remover_producto/(:any)', 'carrito_controller::remover_producto/$1', ['filter' => 'auth']);

$routes->get('finalizar_compra', 'carrito_controller::guardar_compra', ['filter' => 'auth']);

$routes->get('eliminar_carrito', 'carrito_controller::eliminar_carrito', ['filter' => 'auth']);




/**Admin
 * Rutas de las ventas ----------------------------------------------------------------------------------------------
 */
$routes->get('listar_ventas', 'vtas_controller::ver_ventas', ['filter' => 'admin']);
$routes->get('/ver_venta_detalle/(:num)', 'vtas_controller::ver_venta_detalle/$1', ['filter' => 'admin']);



/**RUTAS DE CRUD DE CATEGORIAS--------------------------------------- */
$routes->get('crud_categorias', 'categoria_controller::index', ['filter' => 'admin']);

$routes->get('/categoria_form', 'categoria_controller::crearcategoria', ['filter' => 'admin']);

$routes->post('/enviar_categoria', 'categoria_controller::alta_categoria', ['filter' => 'admin']);

$routes->get('/vista_editar_categoria/(:num)', 'categoria_controller::vistaEditarCategoria/$1', ['filter' => 'admin']);

$routes->get('/categoria_eliminados', 'categoria_controller::vista_categoria_eliminados', ['filter' => 'admin']);

$routes->post('/editar_categoria/(:num)', 'categoria_controller::editarCategoria/$1', ['filter' => 'admin']);

$routes->get('/eliminar_categoria/(:num)', 'categoria_controller::eliminarCategoria/$1', ['filter' => 'admin']);

$routes->get('/restaurar_categoria/(:num)', 'categoria_controller::restaurarCategoria/$1', ['filter' => 'admin']);