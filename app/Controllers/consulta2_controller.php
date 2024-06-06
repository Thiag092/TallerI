<?php
namespace App\Controllers;

use App\Models\consulta2_model;
use CodeIgniter\Controller;

class consulta2_controller extends Controller 
{
    public function __construct() 
    {
        helper(['form', 'url']);
    }

    public function formValidation() 
    {
        $validation = \Config\Services::validation();

        $rules = [
            'asunto' => [
                'label' => 'Asunto',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.'
                ]
            ],
            'mensaje' => [
                'label' => 'Mensaje',
                'rules' => 'required|min_length[3]|max_length[256]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $data['titulo'] = 'Error en consulta';
            session()->setFlashdata('error', 'Hubo un error, por favor vuelva a intentarlo');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            $formModel = new consulta2_model();
            $formModel->save([
                'asunto' => $this->request->getVar('asunto'),
                'mensaje' => $this->request->getVar('mensaje'),
                'respondido' => 'NO'
            ]);

            session()->setFlashdata('success', 'Consulta enviada con éxito, en breve te respondemos. ¡GRACIAS!');
            return redirect()->to('/consulta2');
        }
    }

    // Resto del controlador permanece igual...



    public function ver_consultas()
    {
        $data['titulo'] = 'Consultas2';
        $v_consulta_model = new consulta2_model();
        
        $data['consultas'] = $v_consulta_model->where('respondido', 'NO')->orderBy('id_contacto')->findAll();

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/consultas2_listado', $data);
        echo view('Plantillas/footer');
    }

    public function ver_consultas_respondidas()
    {
        $data['titulo'] = 'Consultas respondidas';
        $v_consulta_model = new consulta2_model();
        $data['consultas'] = $v_consulta_model->where('respondido', 'SI')->orderBy('id_contacto')->findAll();

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/consultas2_respondidas', $data);
        echo view('Plantillas/footer');
    }

    public function responderConsulta($id = null)
    {
        $v_consulta_model = new consulta2_model();
        $data = [
            'respondido' => 'SI'
        ];
        $v_consulta_model->update($id, $data);
        session()->setFlashdata('success', 'Mensaje respondido!');

        return $this->response->redirect(site_url('/consultas2_view'));
    }

    public function restaurarConsulta($id = null)
    {
        $v_consulta_model = new consulta2_model();
        $data = [
            'respondido' => 'NO'
        ];
        $v_consulta_model->update($id, $data);
        session()->setFlashdata('success', 'Mensaje respondido!');

        return $this->response->redirect(site_url('/consultas2_view'));
    }
}
