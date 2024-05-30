<?php
namespace App\Models;
use CodeIgniter\Model;

class usuario_model extends Model                  /** la clase lleva siempre el mismo nombre que el archivo */
{  
    protected $table = 'usuario';    /**Mismo nombre que la btabla que cree */
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'apellido','nombre_usuario', 'email', 'pass', 'perfil_id', 'baja', 'created_at'];
}

//se agrega nombre_usuario para poder asi tener nombre individual de cada uno. 30/05/24------------