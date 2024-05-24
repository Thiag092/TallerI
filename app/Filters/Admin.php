<?php namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {   
        //dd($_SESSION['logged_in'] = session()->get('logged_in'));
        //Si el usuario no esta inicio sesión 
        $session = \Config\Services::session();
        //dd(!$_SESSION['perfil_id'] == "1");
        if(!$session->get('logged_in')) {
            //entonces redirectiona la pagina de iniciar sesión
            $session->setFlashdata('success', 'Debes iniciar sesión.');
            return redirect()->to('ingreso');
        }
        if ($_SESSION['perfil_id'] != "1") {
            $session->setFlashdata('success', 'No tienes los permisos.');
            return redirect()->to('');
        }
    }
    //-----------------------------------------
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //Hacer algo
    }
}
    