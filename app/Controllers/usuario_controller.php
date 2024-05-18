<?php
namespace App\Controllers;
Use App\Models\usuario_model;
use CodeIgniter\Controller;
use Config\Database; 

class usuario_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);
    }
    
    public function create() {
        
        $data['titulo'] = 'Registrate - GalaxyGuitars';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/registro');
        echo view('Plantillas/footer');
    }
 
    public function formValidation() {
             
        $input = $this->validate([
            'nombre'   => 'required|min_length[3]|max_length[50]',
            'apellido' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuario.email]', //campo unico en la tabla 'usuario' campo 'email'
            'pass'     => 'required|min_length[8]|max_length[20]'
        ],);

        // Obtener el ID del perfil "Cliente"
        $perfilIdCliente = $this->getPerfilIdCliente();

        $formModel = new usuario_model(); //crea una instancia del modelo

        if (!$input) { //si la validacion no es exitosa 
            $data['titulo'] = 'Registrate - GlaxyGuitars';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/registro', ['validation' => $this->validator]);
            echo view('Plantillas/footer');

        } else { //si la validacion es exitosa
            //guarda los datos en la BD
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido'=> $this->request->getVar('apellido'),
                'email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido. (contraseña encriptada)
                'perfil_id' => $perfilIdCliente
            ]);  
             
            // Flashdata almacena datos en la sesión que solo persisten durante la siguiente solicitud
               session()->setFlashdata('success', 'Usuario registrado con exito!');
                return redirect()->to('/principal'); //Redirige al usuario a la página de registro

              // return $this->response->redirect('/registro');
      
        }
    }

    private function getPerfilIdCliente() {
        // Obtener una instancia del servicio Database
        $db = Database::connect();

        // Consultar el ID del perfil "Cliente" en la base de datos
        $perfilCliente = $db->table('perfiles')
                           ->where('descripcion', 'cliente')
                           ->get()
                           ->getRow();
    
        // Verificar si se encontró el perfil "Cliente"
        if ($perfilCliente) {
            return $perfilCliente->id_perfiles;
        } else {
            // Si no se encuentra el perfil devolvemos null
            return null;
        }
    }
    
}