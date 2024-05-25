<?php
namespace App\Controllers;
use App\Models\consulta_model;
use CodeIgniter\Controller;

class consulta_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
    }

    public function formValidation() {
        $validation = \Config\Services::validation();

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'asunto'   => 'required|min_length[3]|max_length[100]', // Añadir asunto en la validación
            'tel'      => 'required|min_length[3]|max_length[15]',
            'mensaje'  => 'required|min_length[3]|max_length[256]',
        ]);

        $formModel = new consulta_model();

        if (!$input) {
            $data['titulo'] = 'Error en consulta';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/contacto', ['validation' => $this->validator]);
            echo view('Plantillas/footer');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'email'=> $this->request->getVar('email'),
                'asunto'=> $this->request->getVar('asunto'), // Guardar asunto
                'tel'=> $this->request->getVar('tel'),
                'mensaje'=> $this->request->getVar('mensaje'),
            ]);

            session()->setFlashdata('success', 'Consulta enviada con éxito, en breve te respondemos. ¡GRACIAS!');
            return $this->response->redirect(base_url('/contacto')); // Ajustar redirección si es necesario
        }
    }
    public function ver_consultas($id = null)
    {
        $data['titulo'] = 'consulta';
        $v_consulta_model = new consulta_model();
        $data['consultas'] = $v_consulta_model->orderBy('id_mensaje')->findAll(); // Cambia 'consulta' por 'consultas'
    
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/consultas_listado', $data);
        echo view('Plantillas/footer');
    }
    

  public function ver_consultas_respondidas($id = null)
  {

    $data['titulo'] = 'Consultas respondidas';
    $v_consulta_model = new Consulta_model();
    $data['consultas'] = $v_consulta_model->orderBy('id_mensaje')->findAll();

    echo view('front\head_view', $data);
    echo view('front\nav_view');
    echo view('back\consultas\consultas_respondidas_view', $data);
    echo view('front\footer_view.php');
  }


  public function responderConsulta($id = null)
  {
    $v_consulta_model = new Consulta_model();
    $data = [
      'respondido' => "SI"
    ];
    $v_consulta_model->update($id, $data);

    return $this->response->redirect(site_url('/consultas_view'));
  }
  public function restaurarConsulta($id = null)
  {
    $v_consulta_model = new Consulta_model();
    $data = [
      'respondido' => "NO"
    ];
    $v_consulta_model->update($id, $data);

    return $this->response->redirect(site_url('/consultas_view'));
  }



}

