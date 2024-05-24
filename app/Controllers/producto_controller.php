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
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
        $data['titulo'] = 'Alta producto';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/alta_producto_view', $data);
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
            return redirect()->to('/crud')->with('success', 'Producto creado correctamente');
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
}
