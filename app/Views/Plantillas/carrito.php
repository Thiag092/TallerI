<div class="container-fluid justify-content-center">

    <div class="text-center mt-4 mtb-4">
        <div>
            <h2>Aquí divisarás los productos cargados a tu carrito</h2>
        </div>
    
        <div class="text-center">
            <?php 
                   
                   $session=session();
                   $cart = \Config\Services::cart();
                   $cart = $cart->contents();
                  
                // Si el carrito está vació, mostrar el siguiente mensaje
                if (empty($cart)) 
                {
                    echo 'Para agregar productos al carrito, click en "Comprar"';
                }  
                ?>
        </div>
    </div>

    <div class="text-center text-center p-4">
        <table class="table table-bordered table-hover table-striped table-striped ml-3">
            <?php if ($cart == TRUE):?>
                <tr>
                    <td>ID</td>
                    <td>nombre_prod</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                    <td>Añadir o Restar</td>
                    <td>Cancelar Producto</td>
                </tr>
                <?php // Crea un formulario y manda los valores a carrito_controller/actualiza carrito
                echo form_open('carrito_actualiza');//ruta
                $gran_total = 0;
                $i = 1; //
                // foreach ($this->cart->contents() as $items): 
                foreach ($cart as $item):
                  //var_dump($item);
                  //exit();
                  //  echo "<table class='table table-striped'>";
                    echo  form_hidden('cart[' . $item['id'] . '][id]', $item['id']); 
                    echo  form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']); 
                    echo  form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                    echo  form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                    echo  form_hidden('cart[' . $item['id'] .'][qty]', $item['qty']);
    
                ?>
                <tr>
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <?php echo $item['name']; ?>
                            </td>
                            <td>$
                                <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                                <?php echo $item ['qty']; ?>
                            </td>

                            <?php $gran_total = $item['price'] * $item['qty']; ?>

                            <td> $
                                <?php echo number_format($item['subtotal'], 2) ?>
                            </td>

                            <td>
                                <?php foreach ($productos  as $producto) {
                                            if ($producto['id_producto'] == $item['id']) {
                                                $producto_en_carrito = $producto;
                                                break;
                                            }
                                } ;?>
                                <?php if ($item['qty'] < $producto_en_carrito["stock"]) : ?>
                                    <a class="btn btn-primary" href="<?php echo base_url(); ?>sumar_a_carrito/<?php echo $item['rowid']; ?>">
                                                    +
                                     </a>
                                <?php else : ?>
                                    <a class="btn btn-secondary" href="#">
                                                    +
                                     </a>
                                <?php endif ?>
                                <?php if ($item['qty'] > $producto_en_carrito["stock_min"]) : ?>
                                   <a class="btn btn-danger" href="<?php echo base_url();?>restar_a_carrito/<?php echo $item['rowid'];?>">
                                    -
                                    </a>
                                <?php else : ?>
                                    <a class="btn btn-secondary" href="#">
                                                    -
                                    </a>
                                <?php endif ?>
                                
                            </td>
                            <td>

                                <a class="btn btn-danger" href="<?php echo base_url();?>remover_producto/<?php echo $item['rowid'];?>">
                                    Eliminar
                                    <img class="img-fluid" src="<?php echo base_url('assets/img/trash.png')?>"
                                        class="bi" width="24" height="24">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="5">
                            <b>Total: $
                                <?php //Gran Total
                                                echo number_format($gran_total, 2); 
                                                ?>
                            </b>
                        </td>
                        <td colspan="5">
                            <!-- Borrar carrito usa mensaje de confirmacion javascript implementado en head_view -->
                            <!--<input type="button" class='btn btn-danger btn-lg' value="Borrar Carrito" onclick="window.location = 'borrar'">-->
                            <a class="btn btn-danger btn-lg" href="<?php echo base_url('eliminar_carrito')?>">
                                Borrar Carrito
                            </a>
                            <!-- Submit boton. Actualiza los datos en el carrito -->
                            <!--input type="submit" class ='btn btn-primary btn-lg' value="Actualizar"-->
                            <!-- " Confirmar orden envia a carrito_controller/muestra_compra  -->
                            <a class="btn btn-primary btn-lg" href="<?php echo base_url('finalizar_compra')?>">
                                Comprar
                            </a>
                            <!--<input type="button" class='btn btn-primary btn-lg' value="Comprar"
                                onclick="window.location = 'carrito-comprar'">-->
                        </td>
                    </tr>
                    <?php echo form_close();
                    			
            endif; ?>



        </table>

    </div>
</div>