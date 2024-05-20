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
             //validate es una funcion de codeigniter se usa para validar los datos del formulario de mi registro de usuario
             //antes de seguir con cualquier logica

             //aca validate recibe un array de valores con sus respectivas reglas de validacion cada uno(extension por ej)
        $input = $this->validate([
            'nombre'   => 'required|min_length[3]|max_length[50]',
            'apellido' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuario.email]', //campo unico en la tabla 'usuario' campo 'email'
            'pass'     => 'required|min_length[8]|max_length[20]'
        ],);
        //si al final de las validaciones, todos cumplen con las establecidas, validae retorna "true", y asigna dicho valor a "$input"
        //caso contrario, retorna "false", dando dicho valor a "$input"
        //-------------------------------------------------------------------------

        // Obtener el ID del perfil "Cliente"
        $perfilIdCliente = $this->getPerfilIdCliente();

        $formModel = new usuario_model(); //crea una instancia del modelo


        //--------------------------------------------------------------------------------------------------
        //Aca es donde se ve lo que ocurre, dependiendo de que valor tiene "$input", si "true" o "false"

        if (!$input) { //si la validacion no es exitosa (o sea $input=false)
            $data['titulo'] = 'Registrate - GlaxyGuitars';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/registro', ['validation' => $this->validator]);
            echo view('Plantillas/footer');

        } else { //si la validacion es exitosa ($input=true)
            //guarda los datos en la BD
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido'=> $this->request->getVar('apellido'),
                'email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido. (contraseña encriptada)
                'perfil_id' => $perfilIdCliente
                // 'baja' => 0 // El usuario no está dado de baja inicialmente, (controlar si esta linea debe incluirse)
            ]);  
             
            // Flashdata almacena datos en la sesión que solo persisten durante la siguiente solicitud
            // Establecer un mensaje de éxito utilizando Flashdata
               session()->setFlashdata('success', 'Usuario registrado con exito!');
                return redirect()->to('/registro'); //Redirige al usuario a la página de registro

              // return $this->response->redirect('/registro');
      
        }
    }

    private function getPerfilIdCliente() {
        // Obtener una instancia del servicio Database
        $db = Database::connect();

        // Consultar el ID del perfil "Cliente" en la base de datos
        $perfilCliente = $db->table('perfiles')
                           ->where('descripcion', 'cliente')// para buscar la fila donde descripcion sea 'cliente'
                           ->get() //aca ejecuta la consulta
                           ->getRow(); //obtiene la primera fiera del resulado como un objeto
    
        // Verificar si se encontró el perfil "cliente"
        if ($perfilCliente) {
            return $perfilCliente->id_perfiles; //aca retornaria el id_perfiles, que es 1 o 2, dependiendo si es adm(1) o cliente(2)
        } else {
            // Si no se encuentra el perfil devolvemos null
            return null;
        }
    }
    
}