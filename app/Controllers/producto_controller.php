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
        'precio-venta' => [
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
        'stock-min' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'A {field} debes colocar el stock mínimo.',
            ],
        ],
    ];

    // Comprobamos si se subió una nueva imagen
    if (!($this->request->getFile('imagen')->getName() === "")) {
        $rules['imagen'] = [
            'rules' => 'mime_in[imagen,image/gif,image/png,image/jpeg]',
            'errors' => [
                'mime_in' => 'A {field} debes subir una imagen válida.',
            ],
        ];
    }

    $producto = new producto_model();

    if ($this->validate($rules)) {
        if (!($this->request->getFile('imagen')->getName() === "")) {
            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre-prod'),
                'imagen' => $nombre_aleatorio,
                'categoria_id' => $this->request->getVar('cod_categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
            ];
        } else {
            $data = [
                'nombre_prod' => $this->request->getVar('nombre-prod'),
                'categoria_id' => $this->request->getVar('cod_categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
            ];
        }

        $producto->update($id, $data);
        session()->setFlashdata('success', 'Cambios guardados con ÉXITO!!');
        return $this->response->redirect(site_url('/crud'));

    } else {
        $data['old'] = $producto->where('id_producto', $id)->first();
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
        $data['categoria_producto'] = $categoriaModel->where('id', $data['old']['categoria_id'])->first();
        $data['validation'] = $this->validator;
        $data['titulo'] = 'Editar producto';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_producto', $data);
        echo view('Plantillas/footer');
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