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

    public function vistaEditarProducto($id = null) {
        $productoModel = new producto_model();
        $data['old'] = $productoModel->where('id_producto', $id)->first();
        
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
        $data['categoria_producto'] = $categoriaModel->where('id', $data['old']['categoria_id'])->first();

        $data['titulo'] = 'Editar producto';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_producto', $data);
        echo view('Plantillas/footer');
    }

    public function editarProducto($id = null) {
        helper(['url', 'form', 'html']);

        $rules = [
            'nombre-prod' => 'required|min_length[3]',
            'cod_categoria' => 'required',
            'precio' => 'required|decimal',
            'precio-venta' => 'required|decimal',
            'stock' => 'required|integer',
            'stock-min' => 'required|integer'
        ];

        if ($this->validate($rules)) {
            $productoModel = new producto_model();
            $data = [
                'nombre_prod' => $this->request->getVar('nombre-prod'),
                'categoria_id' => $this->request->getVar('cod_categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min')
            ];

            if (!empty($this->request->getFile('imagen')->getName())) {
                $img = $this->request->getFile('imagen');
                $nombre_aleatorio = $img->getRandomName();
                $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);
                $data['imagen'] = $nombre_aleatorio;
            }

            $productoModel->update($id, $data);
            session()->setFlashdata('success', 'Cambios guardados con ÉXITO!!');
            return redirect()->to('/crud');
        } else {
            $this->vistaEditarProducto($id);
        }
    }

    public function eliminarProducto($id = null) {
        $producto = new producto_model();
        $data = ['eliminado' => "SI"];
        $producto->update($id, $data);

        return redirect()->to('/crud');
    }

    public function vista_productos_eliminados() {
        $productoModel = new producto_model();
        $data['productos'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();
        $data['titulo'] = 'Productos Eliminados';

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/productos_eliminados', $data);
        echo view('Plantillas/footer');
    }

    public function restaurarProducto($id = null) {
        $producto = new producto_model();
        $data = ['eliminado' => "NO"];
        $producto->update($id, $data);

        session()->setFlashdata('success', 'Producto restaurado con éxito!');
        return redirect()->to('/crud');
    }
}
