<?php
namespace App\Models;
use Code Igniter\Model;

class usuario_model extends Model                  /** la clase lleva siempre el mismo nombre que el archivo */
{  
    protected $table = 'usuario';    /**Mismo nombre que la btabla que cree */
    protected $primaryKey = 'id_usuario';
    protected $allowwedFields = ´'nombre', 'apellido', 'email', 'pass', 'perfil_id', 'baja','crated_at';
}