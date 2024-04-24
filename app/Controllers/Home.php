<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
    $data['titulo']="GalaxyGuitars";
        return view('Plantillas/encabezado',$data).view('Plantillas/principal').view('Plantillas/footer');
    }
    public function quienes_somos()
    {
        $data['titulo']="Quienes somos";
        return view('Plantillas/encabezado',$data).view('Plantillas/quienes_somos').view('Plantillas/footer');
    }

    public function terminos_y_usos()
    {
        $data['titulo']="Terminos y Usos";
        return view('Plantillas/encabezado',$data).view('Plantillas/terminos_y_usos').view('Plantillas/footer');
    }

    public function contacto()
    {
        $data['titulo']="Contacto";
        return view('Plantillas/encabezado',$data).view('Plantillas/contacto').view('Plantillas/footer');
    }

    public function comercializacion()
    {
        $data['titulo']="comercializacion";
        return view('Plantillas/encabezado',$data).view('Plantillas/comercializacion').view('Plantillas/footer');
    }
     
}
