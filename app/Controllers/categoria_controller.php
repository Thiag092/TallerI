<?php
namespace App\Controllers;

use App\Models\categoria_model;
use CodeIgniter\Controller;

class categoria_controller extends Controller {

    public function __construct()
    {
        helper(['url', 'form', 'html']);
    }

    public function index()
    {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id', 'DESC')->findAll();
        $data['titulo'] = 'CRUD Categorías';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/crud_categorias', $data);
        echo view('Plantillas/footer');   
    }

    public function vistaEditarCategoria($id = null) {
        $data['titulo'] = 'Editar categoría';
        $categoriaModel = new categoria_model();
        $data['categoria'] = $categoriaModel->where('id', $id)->first();
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_categoria', $data);
        echo view('Plantillas/footer');
    }

    public function editarCategoria($id = null) {
        $rules = [
            'categoria' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El nombre de la categoría es obligatorio.',
                    'min_length' => 'El nombre de la categoría debe tener al menos 3 caracteres.'
                ],
            ],
        ];

        $categoriaModel = new categoria_model();

        if ($this->validate($rules)) {
            $data = [
                'categoria' => $this->request->getVar('categoria'),
            ];
            $categoriaModel->update($id, $data);
            return $this->response->redirect(site_url('/crud_categorias'));
        } else {
            $data['titulo'] = 'Error en editar categoría';
            $data['categoria'] = $categoriaModel->where('id', $id)->first();
            $data['validation'] = $this->validator;
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/edit_categoria', $data);
            echo view('Plantillas/footer');
        }
    }

    public function eliminarCategoria($id = null) {
        $categoriaModel = new categoria_model();
        $data = ['categoria_eliminada' => "SI"];
        $categoriaModel->update($id, $data);
        return $this->response->redirect(site_url('/crud_categorias'));
    }

    public function restaurarCategoria($id = null) {
        $categoriaModel = new categoria_model();
        $data = ['categoria_eliminada' => "NO"];
        $categoriaModel->update($id, $data);
        return $this->response->redirect(site_url('/crud_categorias'));
    }
    
    public function crearcategoria() {
        $data['titulo'] = 'Crear categoría';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/crear_categoria');  
        echo view('Plantillas/footer');  
    }

    public function alta_categoria() {
        $rules = [
            'categoria' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El nombre de la categoría es obligatorio.',
                    'min_length' => 'El nombre de la categoría debe tener al menos 3 caracteres.'
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $categoriaModel = new categoria_model();
            $data = [
                'categoria' => $this->request->getVar('categoria'),
            ];
            $categoriaModel->insert($data);
            return $this->response->redirect(site_url('/crud_categorias'));
        } else {
            $data['titulo'] = 'Error en crear categoría';
            $data['validation'] = $this->validator;
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/crear_categoria', $data);
            echo view('Plantillas/footer');  
        }
    }

    public function vista_categoria_eliminados() {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->where('categoria_eliminada', "SI")->orderBy('id', 'DESC')->findAll();
        $data['titulo'] = 'Categorías eliminadas';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/categorias_eliminadas', $data);
        echo view('Plantillas/footer');
    }
}
