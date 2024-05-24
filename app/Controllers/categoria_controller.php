<?php
namespace App\Controllers;

use App\Models\producto_model;
Use App\Models\psuarios_model;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class categoria_controller extends Controller {

    public function __construct()
    {
        helper(['url', 'form', 'html']);
        //$db = \Config\Database::connect();
    }
//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------
//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------

//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------

//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------

//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------

//-------------------------------------------------------------- HAY QUE REVISAR TODO---------------------------------------------

    //mostrar los productos en lista
    public function index()
    {
        
        $categoriaModel = new Categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();

        $data['titulo'] = 'CRUD Categorías';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\categorias_view', $data);
        echo view('front\footer_view.php');
    }

    public function vistaEditarCategoria($id = null) {

        $data['titulo'] = 'Editar categoría';
        $categoriaModel = new Categoria_model();
        $data['categoria'] = $categoriaModel->where('id_categoria', $id)->first();
     

        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\editar_categoria_view', $data);
        echo view('front\footer_view.php');
    }

    public function editarCategoria($id = null) {
        $rules = [
            'nombre-categoria' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'A {field} debes colocar una descripción de al menos 3 letras.',
                ],
            ],
        ];
        $categoriaModel = new Categoria_model();

        if ($this->validate($rules)) {
            $data = [
                'nombre_categoria' => $this->request->getVar('nombre-categoria'),
            ];

            $categoriaModel->update($id, $data);

            return $this->response->redirect(site_url('/crud_categorias'));
        } else {

            $data['titulo'] = 'Error en editar categoría';
            
            $data['categoria'] = $categoriaModel->where('id_categoria', $id)->first();
        

            echo view('front\head_view', $data);
            echo view('front\nav_view');
            echo view('back\categorias\editar_categoria_view',[
                'validation' => $this->validator,
                'categoria' => $categoriaModel->where('id_categoria', $id)->first(),
            ]);
            echo view('front\footer_view.php');
        }
    }

    public function eliminarCategoria($id = null) {
        $categoriaModel = new Categoria_model();
        $data = [
                    'categoria_eliminada' => "SI"
                ];
        $categoriaModel->update($id, $data);

        return $this->response->redirect(site_url('/crud_categorias'));
    }
    public function restaurarCategoria($id = null) {
        $categoriaModel = new Categoria_model();
        $data = [
                    'categoria_eliminada' => "NO"
                ];
        $categoriaModel->update($id, $data);

        return $this->response->redirect(site_url('/crud_categorias'));
    }
    
    public function crearcategoria() {
        $data['titulo'] = 'Crear categoría';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\crear_categoria_view');
        echo view('front\footer_view.php');
    }

    public function alta_categoria() {
        $rules = [
            'nombre-categoria' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'A {field} debes colocar una descripción de al menos 3 letras.',
                ],
            ],
        ];
        $categoriaModel = new Categoria_model();

        if ($this->validate($rules)) {
            $data = [
                'nombre_categoria' => $this->request->getVar('nombre-categoria'),
            ];

            $categoriaModel->insert($data);

            return $this->response->redirect(site_url('/crud_categorias'));
        } else {

            $data['titulo'] = 'Error en crear categoría';
            


            echo view('front\head_view', $data);
            echo view('front\nav_view');
            echo view('back\categorias\crear_categoria_view',[
                'validation' => $this->validator,
        
            ]);
            echo view('front\footer_view.php');
        }
    }

    public function vista_categoria_eliminados() {
        $categoriaModel = new Categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();

        $data['titulo'] = 'Categorías eliminadas';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\categorias_eliminadas_view', $data);
        echo view('front\footer_view.php');
    }

}