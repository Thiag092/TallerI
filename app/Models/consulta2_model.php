<?php
namespace App\Models;
use CodeIgniter\Model;

class consulta2_model extends Model 
{
    protected $table = 'contacto';
    protected $primaryKey = 'id_contacto';
    protected $allowedFields = ['asunto', 'mensaje', 'respondido'];
}