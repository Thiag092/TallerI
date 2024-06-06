<?php
namespace App\Controllers;

use App\Models\consulta_model;
use CodeIgniter\Controller;

class consulta_controller extends Controller 
{
    public function __construct() 
    {
        helper(['form', 'url']);
    }

    public function formValidation() 
    {
        $validation = \Config\Services::validation();

        $input = $this->validate([
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.'
                ]
            ],
            'email' => [
                'label' => 'correo electrónico',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'valid_email' => 'El {field} debe contener un correo electrónico válido.'
                ]
            ],
            'asunto' => [
                'label' => 'asunto',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.'
                ]
            ],
            'tel' => [
                'label' => 'teléfono',
                'rules' => 'required|min_length[3]|max_length[15]|numeric',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                    'numeric' => 'El {field} debe contener solo números.'
                ]
            ],
            'mensaje' => [
                'label' => 'mensaje',
                'rules' => 'required|min_length[3]|max_length[256]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.'
                ]
            ],
        ]);

        $formModel = new consulta_model();

        if (!$input) {
            $data['titulo'] = 'Error en consulta';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/contacto', ['validation' => $this->validator]);
            echo view('Plantillas/footer');

            session()->setFlashdata('success', 'Hubo un error, por favor vuelva a intentarlo');
            return $this->response->redirect(base_url('/contacto')); // Ajustar redirección si es necesario
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'email' => $this->request->getVar('email'),
                'asunto' => $this->request->getVar('asunto'), // Guardar asunto
                'tel' => $this->request->getVar('tel'),
                'mensaje' => $this->request->getVar('mensaje'),
                'respondido' => 'NO' // Establecer el valor por defecto para el campo respondido
            ]);

            session()->setFlashdata('success', 'Mensaje de contacto enviado con éxito, en breve te respondemos. ¡GRACIAS!');
            return $this->response->redirect(base_url('/contacto')); // Ajustar redirección si es necesario
        }
    }

    public function ver_consultas()
    {
        $data['titulo'] = 'Consultas';
        $v_consulta_model = new consulta_model();
        $data['consultas'] = $v_consulta_model->where('respondido', 'NO')->orderBy('id_mensaje')->findAll();

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/consultas_listado', $data);
        echo view('Plantillas/footer');
    }

    public function ver_consultas_respondidas()
    {
        $data['titulo'] = 'Consultas respondidas';
        $v_consulta_model = new consulta_model();
        $data['consultas'] = $v_consulta_model->where('respondido', 'SI')->orderBy('id_mensaje')->findAll();

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/consultas_respondidas', $data);
        echo view('Plantillas/footer');
    }

    public function responderConsulta($id = null)
    {
        $v_consulta_model = new consulta_model();
        $data = [
            'respondido' => 'SI'
        ];
        $v_consulta_model->update($id, $data);
        session()->setFlashdata('success', 'Mensaje respondido!');

        return $this->response->redirect(site_url('/consultas_view'));
    }

    public function restaurarConsulta($id = null)
    {
        $v_consulta_model = new consulta_model();
        $data = [
            'respondido' => 'NO'
        ];
        $v_consulta_model->update($id, $data);
        session()->setFlashdata('success', 'Mensaje respondido!');

        return $this->response->redirect(site_url('/consultas_view'));
    }
}
