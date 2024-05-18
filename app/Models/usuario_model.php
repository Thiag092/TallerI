<?php
namespace App\Models;
use CodeIgniter\Model;

class usuario_model extends Model                  /** la clase lleva siempre el mismo nombre que el archivo */
{  
    protected $table = 'usuario';    /**Mismo nombre que la btabla que cree */
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'pass', 'perfil_id', 'baja', 'created_at'];
}