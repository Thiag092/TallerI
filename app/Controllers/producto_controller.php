<?php
namespace App\Controllers;

use App\Models\producto_model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class producto_controller extends Controller {
    public function __construct()
    {
        helper(['url', 'form', 'html']);
    }

    public function index()
    {
        $productoModel = new producto_model();
        $data['productos'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();

        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();

        $data['titulo'] = 'Crud_productos';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/crud_productos', $data);
        echo view('Plantillas/footer');
    }

    public function crearproducto()
{
    $categoriaModel = new categoria_model();
    $data['categorias'] = $categoriaModel->where('categoria_eliminada', 'NO')->orderBy('id', 'DESC')->findAll();
    $data['titulo'] = 'Alta producto';
    echo view('Plantillas/encabezado', $data);
    echo view('Plantillas/alta_producto_view', $data);
    echo view('Plantillas/footer');
}



public function vistaEditarProducto($id = null) {

    $productoModel = new producto_model();

    $data['titulo'] = 'Editar producto';
    $categoriaModel = new categoria_model();

    $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
    //$id= $this->request->getPostGet('id');
    //$data['producto'] = $productoModel->where('id', $id)->first();
    $data['old'] = $productoModel->where('id_producto', $id)->first();
    //dd($data['old']['cod_categoria']);
    $data['categoria_producto'] = $categoriaModel->where('id', $data['old']['categoria_id'])->first();
    //dd($data);
    echo view('Plantillas/encabezado', $data);
    echo view('Plantillas/edit_producto', $data);
    echo view('Plantillas/footer');
}



public function alta_producto()
{
    $rules = [
        'nombre-prod' => 'required|min_length[3]',
        'cod_categoria' => 'required',
        'precio' => 'required|decimal',
        'precio-venta' => 'required|decimal',
        'stock' => 'required|integer',
        'stock-min' => 'required|integer',
        'imagen' => 'uploaded[imagen]|mime_in[imagen,image/gif,image/png,image/jpeg]'
    ];

    if ($this->validate($rules)) {
        $img = $this->request->getFile('imagen');
        $nombre_aleatorio = $img->getRandomName();
        $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

        $productoModel = new producto_model();
        $data = [
            'nombre_prod' => $this->request->getVar('nombre-prod'),
            'imagen' => $nombre_aleatorio,
            'categoria_id' => $this->request->getVar('cod_categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio-venta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock-min'),
        ];

        $productoModel->insert($data);
       // return redirect()->to('/produ-form')->with('success', 'Producto creado correctamente');
       session()->setFlashdata('success', 'Producto registrado con exito!');
       return redirect()->to('/produ-form');

    } else {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
        $data['titulo'] = 'Error en Alta de producto';
        $data['validation'] = $this->validator;
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/alta_producto_view', $data);
        echo view('Plantillas/footer');
    }
}

public function editarProducto($id = null) {
    /**Si tiene un nombre quiere decir que se debe agregar la regla para la imagen también */
     helper(['url', 'form', 'html']);

        $rules = [
        'nombre-prod' => [
            'rules'  => 'required|min_length[3]',
            'errors' => [
                'required' => 'A {field} debes colocar una descripción de al menos 3 letras.',
            ],
        ],

        'precio'=> [
            'rules'  => 'required',
            'errors' => [
                'required' => 'A {field} debes colocar un precio.',
            ],
        ],
        'precio-venta'       => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'A {field} debes colocar un precio de venta.',
            ],
        ],
        'stock' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'A {field} debes colocar el stock.',
            ],
        ],
        'stock-min' =>
        [
            'rules'  => 'required',
            'errors' => [
                'required' => 'A {field} debes colocar el stock mínimo.',
            ],
        ],

    ];


    /*Error de validación de codeIgniter Visto por el profesor Ivan Sambrana
        https://forum.codeigniter.com/showthread.php?tid=86535&page=2
        image/gif, image/png, image/jpeg
        mime_in[field_name,image/png,image/jpeg]
        'imagen' => [
            'rules'  => 'is_image[imagen]',
            'errors' => [
                'required' => 'A {field} debes subir una imagen.',
                'is_image[imagen]' => 'A {field} debe ser una imagen.',
            ]
        ],
        */

   if (!($this->request->getFile('imagen')->getName() === "")) { 
        $rules['imagen'] = [
            'rules' => 'required|mime_in[imagen, image/gif,image/png,image/jpeg]',
            'errors' => [
                'required' => 'A {field} debes subir una imagen.',
            ],
        ];
    }

    $producto = new producto_model();
    //var_dump($rules);
    $this->validate($rules);

    //exit();
    if ($this->validate($rules)) {

        //Si no se subió una imagen se asume que no actualizara imagen


        if (!($this->request->getFile('imagen')->getName() === "")) {      
            //var_dump($rules);
            //exit();       
            //se está verificando si se ha cargado una nueva imagen para el producto. Si se ha cargado una nueva imagen 
            //(es decir, el nombre del archivo no está vacío), entonces se procede a manejar la actualización de la imagen
            // en el primer bloque, se actualizan explícitamente todos los campos, mientras que en el segundo bloque, 
            //se actualizan los campos sin hacer ninguna distinción.


            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre-prod'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
                //'eliminado' => NO
            ];

            $producto->update($id, $data);
            session()->setFlashdata('success', 'Cambios guardados con ÉXITO!!');
            return $this->response->redirect(site_url('/crud'));

        } else {
            $data  = [
                'nombre_prod' => $this->request->getVar('nombre-prod'),
                'categoria_id' => $this->request->getVar('cod_categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
                //'eliminado' => NO
            ];

            $producto->update($id, $data);
            session()->setFlashdata('success', 'Cambios guardados con ÉXITO!!');
            return $this->response->redirect(site_url('/crud'));

        }



    } else {
        /***Se muestran los errores */

        //$producto = new Producto_model();
        //$dato['validation'] = $this->validator;
        $data['old'] = $producto->where('id_producto', $id)->first();
        $categoriaModel = new Categoria_model();
        //$data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
        $data['categoria_producto'] = $categoriaModel->where('id', $data['old']['categoria_id'])->first();
        //dd($data['categoria_producto']);
        $data['validation'] = $this->validator;
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
        $data['categoria_producto'] = $categoriaModel->where('id', $data['old']['categoria_id'])->first();
        $dato['titulo'] = 'Editar producto';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_producto', $data);
        echo view('Plantillas/footer');
        /*[
            'validation' => $this->validator,
            'old' => $producto->where('id_producto', $id)->first(),
            'categorias' => $categoriaModel->orderBy('id_categoria', 'DESC')->findAll(),
            'categoria_producto' => $categoriaModel->where('id_categoria', $data['old']['cod_categoria'])->first(),
        ]*/


        /*if ($this->request->getVar('imagen') == NULL) {
            echo '<script language="javascript">alert("No se cargo la imagen");</script>'; # code...
        }*/
    }



}

public function eliminarProducto($id = null) {
    $producto = new producto_model();
    $data = [
                'eliminado' => "SI"
            ];
    $producto->update($id, $data);

    return $this->response->redirect(site_url('/crud'));
}

public function vista_productos_eliminados() {
$productoModel = new producto_model();
$data['productos'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();
//$categoriaModel = new Categoria_model();
//$data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
$data['titulo'] = 'Productos Eliminados';

echo view('Plantillas/encabezado', $data);
echo view('Plantillas/productos_eliminados', $data);
echo view('Plantillas/footer');
}

public function restaurarProducto($id = null) {
$producto = new producto_model();
$data = [
            'eliminado' => "NO"
        ];
$producto->update($id, $data);
session()->setFlashdata('success', 'Cambios guardados con ÉXITO!!');
return $this->response->redirect(site_url('/crud'));
}


}