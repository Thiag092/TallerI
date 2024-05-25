<?php
namespace App\Models;
use CodeIgniter\Model;

class categoria_model extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['categoria'];

    public function getCategorias()
    {
        return $this->findAll();
    }
}