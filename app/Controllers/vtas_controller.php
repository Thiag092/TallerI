<?php
namespace App\Controllers;

use App\Models\producto_model;
use App\Models\usuario_model;
use App\Models\ventasCabecera_model;
use App\Models\ventasDetalle_model;

use CodeIgniter\Controller;

class vtas_controller extends Controller {

	public function __construct() {
           helper(['form', 'url']);

	}
  public function ver_ventas() {
        
   $dato['titulo']='Registro'; 

    $v_ventas_cabecera = new ventasCabecera_model();
    
    $dato['v_ventas_cabecera'] = $v_ventas_cabecera->findAll();

    echo view('Plantillas/encabezado', $dato);
    echo view('Plantillas/lista_ventas', $dato);
    echo view('Plantillas/footer');
}
 
  public function ver_venta_detalle($id = null) {
    $venta_cabecera = new ventasCabecera_model();
    $venta_cabecera = $venta_cabecera->where('id_ventas_cabecera', $id)->first();

    $v_usuario = new usuario_model();
    $v_usuario = $v_usuario->where('email', $venta_cabecera['email'])->findAll();

    $venta_detalle = new ventasDetalle_model();
    $producto = new producto_model();

    $data = array(
      'titulo' => 'Compra Finalizada',
      'ventas_detalle' => $venta_detalle->findAll(),
      'productos' => $producto->orderBy('id_producto', 'DESC')->findAll(),
      'total' => $venta_cabecera['total_ventas'],
    );
    //dd();
    $data['perfil_id'] = $v_usuario[0]['id_usuario'];
    $data['nombre_apellido'] = $v_usuario[0]['nombre'] . " " . $v_usuario[0]['apellido'];
    $data['cabecera_id'] = $id;

    echo view('Plantillas/encabezado', $data);
    echo view('Plantillas/ventas_detalle', $data);
    echo view('Plantillas/footer');
}




}

