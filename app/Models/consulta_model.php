<?php
namespace App\Models;
use CodeIgniter\Model;

class consulta_model extends Model 
{
    protected $table = 'consulta';
    protected $primaryKey = 'id_mensaje';
    protected $allowedFields = ['nombre', 'email', 'asunto', 'tel', 'mensaje', 'respondido'];
}