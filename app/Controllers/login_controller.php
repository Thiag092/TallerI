<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database; 

class login_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);
    }
    
    public function login() {
        
        $data['titulo'] = 'Inicia Sesion - GalaxyGuitars';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/login');
        echo view('Plantillas/footer');
    }
}
