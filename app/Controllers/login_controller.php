<?php
namespace App\Controllers;
use App\Models\usuario_model;
use CodeIgniter\Controller;
use Config\Database; 

class login_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);
    }
    //aca carga el formulario de inicion de sesion (login)
    public function login() {
        
        $data['titulo'] = 'Inicia Sesion - GalaxyGuitars';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/login');
        echo view('Plantillas/footer');
    }

//--------------------------------------------------------------------------------------
//aca se autentica el usuario con este metodo
public function authenticate() {
    $session = session();                   //se obtiene una insancia de sesion
    $model = new usuario_model();            // crea una instancia del modelo usuario_model para poder interactuar con la base de datos

    $email = $this->request->getVar('email');//se obtienen los valores que se enviaron desde el formulario del login (email y pass)
    $password = $this->request->getVar('pass');

    $data = $model->where('email', $email)->first();//segun el mail que se cargo, busca un usuario con ese mismo correo.
    //o sea, especifica una condición para la consulta: busca filas en la tabla usuario donde la columna email coincide con el valor 
    //de la variable $email.
    //En otras palabras, esta parte de la consulta dice "encuentra la fila en la tabla usuario donde el correo electrónico sea igual al 
    //correo electrónico proporcionado por el usuario durante el inicio de sesión".
    //El método first() es otro método de consulta que se utiliza para obtener la primera fila que cumple con las condiciones especificadas.
    //significa que la consulta devolverá la primera fila de la tabla usuario donde el correo electrónico coincide con $email.
    //Si no hay ninguna fila que coincida , first() devolverá null.
    if($data) {
        $pass = $data['pass'];
        $verify_pass = password_verify($password, $pass);
        if($verify_pass) {
            $ses_data = [
                'id'       => $data['id'],
                'nombre'     => $data['nombre'],
                'apellido' => $data['apellido'],
                'email'    => $data['email'],
                'perfil_id' => $data['perfil_id'],
                'logged_in' => TRUE
            ];
            $session->set($ses_data);
            //return redirect()->to('/dashboard'); // Redirige al usuario a una página de dashboard
            $session->setFlashdata('loginExitoso', 'Usario logueado con éxito, BIENVENIDO!');
            return redirect()->to('/principal');
        } else {
            $session->setFlashdata('passIncorrecto', 'Contraseña incorrecta, vuelva a intentar');
            return redirect()->to('/login');
        }
    } else {
        $session->setFlashdata('mailIncorrecto', 'Correo no registrado, vuelva a intentarlo o regístrese');
        return redirect()->to('/login');
    }
}

public function logout() {
    $session = session();
    $session->destroy();
    return redirect()->to('/login');
}
}