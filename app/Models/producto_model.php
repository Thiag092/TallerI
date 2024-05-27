<?php

namespace App\Models;

use CodeIgniter\Model;

class producto_model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $allowedFields = ['nombre_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    public function getBuilderProductos(){
        // conect() es un metodo de la clase Database, que nos permite conectar a la base de datos
        $db = \Config\Database::connect();
        // $builder es una instancia de la clase QueryBuilder de CodeIgniter
        $builder = $db->table('productos');
        // hace una consulta a la base de datos 
        $builder->select('*');
        // hago el join de la tabla categoria
        $builder->join('categorias', 'categorias.id = productos.categoria_id');
        // retorna el builder (la consulta)
        return $builder;
    }
         public function getProductoAll(){
         $builder = $this->getBuilderProductos();
        // consulta a la base de datos para recuperar todos los registros por id, descendente
         $builder->select('*', 'id','DESC'); 
         return $this->findAll();
         }
          
        public function getProducto($id = null){
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $query = $builder->get();
        return $query->getRowArray();
     }
      public function updateStock($id = null, $stock_actual = null){
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $builder->set('productos.stock', $stock_actual);
        $builder->update();
    }

      function getventasdetalle($id){
        $this->db->join('productos','productos.id_producto = ventas_detalle.producto_id');
        $query = $this->db->get_where('ventas_detalle', array('venta_id' => $id));
     	if($query->num_rows()>0) {
            return $query;
        } else {
            return FALSE;
        }
    }
    /*function get_ventas_cabecera()
    {
        //$this->db->join('usuarios','usuarios.id_usuario = ventas_cabecera.usuario_id') ;   
        //select * from ventas_cabecera;
       // $query = $this->db->get('ventas_cabecera', 'usuarios.nombre', 'usuarios.apellido');
        $this->db->select('ventas_cabecera.*, usuarios.nombre');
        $this->db->from('ventas_cabecera');
        $this->db->join('usuarios','ventas_cabecera.usuario_id = usuarios.id_usuario');
            
        $query = $this->db->get();
        if($query->num_rows()>0) {
            return $query;
        } else {
            return FALSE;
        }
    }*/



    public function sacar_del_stock($id, $cantidad)
    {
        // Obtiene el producto por su ID
        $producto = $this->find($id);

        if ($producto) {
            // Calcula el nuevo stock
            $nuevo_stock = $producto['stock'] - $cantidad;

            // Asegura que el stock no sea negativo
            if ($nuevo_stock < 0) {
                $nuevo_stock = 0;
            }

            // Actualiza el stock en la base de datos
            $this->update($id, ['stock' => $nuevo_stock]);

            return true;
        }

        return false;
    }

}