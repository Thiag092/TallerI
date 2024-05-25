<?php
namespace App\Models;
use CodeIgniter\Model;

class perfiles_model extends Model
{
    protected $table = 'perfiles';
    protected $primaryKey = 'id_perfiles';
    protected $allowedFields = ['descripcion', 'perfil_eliminado'];

    public function getPerfiles()
    {
        return $this->findAll();
    }
}