<?php

namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\producto_model;
use App\Models\usuario_model;
use App\Models\ventasCabecera_model;
use App\Models\ventasDetalle_model;

class carrito_controller extends Controller {
    public function __construct()
    {
        helper(['form', 'url', 'cart']);

        $session = session();
        $cart = \Config\Services::cart();
        $cart->contents();
    }
    //agrega al carrito
    public function agregar($id = null) 
    {
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();

        $producto = new producto_model();
        $producto = $producto->where('id_producto', $id)->first();

        $cart->insert(array(
            'id'    => $producto['id_producto'],
            'qty'   => 1,
            'price' => $producto['precio'],
            'name'  => $producto['nombre_prod'],
        ));
        //var_dump( $cart);
        //exit();
        // $cart->destroy();
        session()->setFlashdata('success', 'Producto agregado a tu carrito! Click arriba en el mismo para ver.');
        return redirect()->back()->withInput();

    }


    
    public function sumar_carrito($id = null){
        $cart = \Config\Services::cart();
        $producto = new producto_model();
        $session = session();
        //$cart = \Config\Services::cart();

        //dd($_SESSION['logged_in']);
        //dd($_SESSION['id_usuario']);
        $id_producto = $cart->getItem($id)["id"];
        $producto = $producto->where('id_producto', $id_producto)->first();

        
        //dd($producto);
        $cantidad = $cart->getItem($id)["qty"];
        $cantidadMax = $producto["stock"];
        
        if($cantidad < $cantidadMax){ 
            $cart->update(array(
                "rowid" => $id,
                "qty" => $cantidad+1
            ));
        }
        return redirect()->back()->withInput();
       // return redirect()->route('panel_carrito');
    }

    public function restar_carrito($id = null){
        $cart = \Config\Services::cart();

        $producto = new producto_model();
        $id_producto = $cart->getItem($id)["id"];
        $producto = $producto->where('id_producto', $id_producto)->first();

        
        //dd($producto);
        $cantidad = $cart->getItem($id)["qty"];
        $cantidadMin = $producto["stock_min"];
        //dd($cantidadMin);
        if($cantidad > $cantidadMin){ 
            $cart->update(array(
                "rowid" => $id,
                "qty" => $cantidad-1
            ));
        }
        return redirect()->back()->withInput();
       // return redirect()->route('panel_carrito');
    }

    public function actualizar_carrito() 
    {
        $cart = \Config\Services::Cart();

        $request = \Config\Services::request();

        $cart->update(array(
            'id'    => $request->getPost('id'),
            'qty'   => 1,
            'price' => $request->getPost('precio_vta'),
            'name'  => $request->getPost('nombre_prod'),
        ));

        // $cart->destroy();
         //var_dump("hola");
         //exit();
        return redirect()->back()->withInput();

    }
    
    
    public function ver_carrito() {
        

        $data['titulo'] = 'Carrito';
        $productoModel = new producto_model();
        $data['productos'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();
        
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/carrito');
        echo view('Plantillas/footer');   
     }

        public function catalogo(){
            $productoModel = new producto_model();
        
            // Filtra los productos eliminados y aquellos cuyo stock es mayor que el stock mínimo
            $productosFiltrados = $productoModel->where('eliminado', 'NO')
                                                ->where('stock >', 'stock_min')
                                                ->findAll();
        
            // Paginación manual de los productos filtrados
            $perPage = 6; // Número de productos por página
            $page = (int)($this->request->getVar('page') ?? 1);
            $totalProductos = count($productosFiltrados);
            $totalPages = ceil($totalProductos / $perPage);
            $offset = ($page - 1) * $perPage;
            $productosPaginados = array_slice($productosFiltrados, $offset, $perPage);
        
            // Configurar el objeto `pager`
            $pager = \Config\Services::pager();
            $pager->makeLinks($page, $perPage, $totalProductos);
        
            $data = [
                'productos' => $productosPaginados,
                'pager' => $pager,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];            
        
            $data['titulo'] = 'Todos los Productos';
        
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/catalogo_productos', $data);
            echo view('Plantillas/footer');
        }
        

     public function borrar_carrito()
    {
        $cart = \Config\Services::cart();//para que incluya el $cart
        $cart->destroy();

        return redirect()->back()->withInput();
        //return redirect()->to(base_url('carrito_compra'));

    }

    public function eliminar_carrito(){
        $cart = \Config\Services::cart();
        $session = session();

        $cart->destroy();
        $session->set('cart', 0);

        return redirect()->to(base_url('catalogo'));
    }

    public function remover_producto($rowid) {
   
         $cart = \Config\Services::Cart();
         $request = \Config\Services::request();
        //Si $rowid es "all" destruye el carrito
        if ($rowid==="all")
        {
         $cart->destroy();
        }
        else //Sino destruye sola fila seleccionada
        { 
            $cart->remove($rowid);
        }
        // Redirige a la misma página que se encuentra
        return redirect()->back()->withInput();
    }


    public function guardar_compra()
	{
        /**$datos trae 
         * Para poder guardar correctamente la compra, primero
         * se debe tener el usuario para asociarlo a la cabecera de la compra,
         * luego se requiere un producto para asociarlo a la venta detalle 
         * que sera asociado con la cabecera de la compra
         * 
         */
        $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();

		//$session_data = $this->$session->userdata('logged_in');
		//$data['id'] = $session_data['id'];
        //$productoModel->where('id_producto', $id)->first();
        //dd($_SESSION['logged_in']);
        //dd($_SESSION['id_usuario']);
// Obtener el correo electrónico del usuario desde la sesión
$correo_usuario = $session->get('email');//----------------------------------------------------------
        //$usuario = new Usuarios_model();
        $venta_detalle = new ventasDetalle_model();
        $venta_cabecera = new ventasCabecera_model();
        $producto = new producto_model();

        //trae el producto correspondiente con la id
        //$producto = $producto->where('id_producto', $datos['producto']->id_producto)->first();
        

		$total = 0;
        //calcula el total de la compra elegí esta opción ya que me pareció la mas segura
        //dd($cart);
        foreach ($cart as $item):
            $total += floatval($item['subtotal']);
        endforeach;
       

		$venta = array(
			'fecha' 		=> date('Y-m-d'),
			'email' => $correo_usuario, //-------------------- esto se agrego para que me guarde el mail------------------
			'total_ventas'	=> $total,
		);
		//$venta_id = $this->carrito_model->insert_venta($venta);
        $cabecera_id = $venta_cabecera->insert($venta);

		
			foreach ($cart as $item):
				$v_venta_detalle = array(
					'venta_id' 		=> $cabecera_id,
					'producto_id' 	=> $item['id'],
					'cantidad' 		=> $item['qty'],
					'precio' 		=> $item['price'],
				);

            	$venta_detalle->insert($v_venta_detalle);

            	//Descuenta del stock y lo guarda en la base de datos
                //$stock_actual = $item|['qty'];
            	$producto->sacar_del_stock($item['id'], $item['qty']);
                /*$producto = $producto->where('id_producto', $item['id'])->first();
                dd($producto->where('id_producto', $item['id'])->first());
                $nuevo_stock = $producto['stock'] - $item['qty'];
                $data = [

                    'stock' => $nuevo_stock,

                ];

                $producto->update($item['producto_id'], $data);*/


			endforeach;

        //$data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
		$data = array('titulo' => 'Compra Finalizada',
            'cabecera_id_front' => $cabecera_id,
            'ventas_detalle' => $venta_detalle->where('venta_id', $cabecera_id)->findAll(),
            'productos' => $producto->orderBy('id_producto', 'DESC')->findAll(),
            'total' => $total,
        );

		$data['perfil_id'] = $_SESSION['id_usuario'];
		$data['nombre_apellido'] = $_SESSION['nombre'] . " " . $_SESSION['apellido'];
        $data['cabecera_id'] = $cabecera_id;
        
        echo view('Plantillas/encabezado', $data);
        session()->setFlashdata('success', 'Compra realizada con exito! GRACIAS!');
        echo view('Plantillas/compra_finalizada', $data);
        echo view('Plantillas/footer', $data);
	

		//$final = $this->cart->destroy();
        $this->borrar_carrito();

	}



    

}