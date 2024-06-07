<div class="container-fluid justify-content-center">

    <div class="text-center mt-4 mtb-4">
    
        <div>
            <h2>Aquí divisarás los productos cargados a tu carrito.</h2>
        </div>
    
        <div class="text-center">
            <?php 
                $session = session();
                $cart = \Config\Services::cart();
                $cart = $cart->contents();
                  
                // Si el carrito está vació, mostrar el siguiente mensaje
                if (empty($cart)) 
                {
                    echo 'Para agregar productos al carrito, visite nuestro catalogo.';
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
                <?php
                echo form_open('carrito_actualiza'); //ruta
                $gran_total = 0; // Inicializa gran_total aquí
                $i = 1;

                foreach ($cart as $item):
                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                    
                    $subtotal = $item['price'] * $item['qty']; // Calcula el subtotal
                    $gran_total += $subtotal; // Acumula el subtotal en gran_total
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td> <!-- Muestra el subtotal -->
                    <td>
                        <?php foreach ($productos as $producto) {
                            if ($producto['id_producto'] == $item['id']) {
                                $producto_en_carrito = $producto;
                                break;
                            }
                        } ?>
                        <?php if ($item['qty'] < $producto_en_carrito["stock"]) : ?>
                            <a class="btn btn-primary" href="<?php echo base_url(); ?>sumar_a_carrito/<?php echo $item['rowid']; ?>">+</a>
                        <?php else : ?>
                            <a class="btn btn-secondary" href="#">+</a>
                        <?php endif ?>
                        <?php if ($item['qty'] > $producto_en_carrito["stock_min"]) : ?>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>restar_a_carrito/<?php echo $item['rowid']; ?>">-</a>
                        <?php else : ?>
                            <a class="btn btn-secondary" href="#">-</a>
                        <?php endif ?>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="<?php echo base_url(); ?>remover_producto/<?php echo $item['rowid']; ?>">Eliminar
                            <img class="img-fluid" src="<?php echo base_url('assets/img/trash.png') ?>" class="bi" width="24" height="24">
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">
                        <b>Total: $<?php echo number_format($gran_total, 2); ?></b> <!-- Muestra el gran_total -->
                    </td>
                    <td colspan="5">
                        <a class="w-20 btn btn-primary btn-l" href="<?php echo base_url('catalogo') ?>">Volver al catálogo</a>
                        <a class="btn btn-danger btn-ll" href="<?php echo base_url('eliminar_carrito') ?>">Borrar Carrito</a>
                        <a class="btn btn-success btn-l" href="<?php echo base_url('finalizar_compra') ?>">COMPRAR</a>
                    </td>
                </tr>
                <?php echo form_close(); ?>
            <?php endif; ?>
        </table>
    </div>
</div>
