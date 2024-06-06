<div class="container-fluid">

   <
   
   

    <div class=" p-2">
        <a class="w-20 btn btn-primary btn-sm" href="<?php echo base_url('listar_ventas') ?>">
            Volver
        </a>
        <div class="text-center p-4">
        <h2>DETALLES DE LA VENTA</h2>
    </div>
        </div>
        

    <div class="row">
        <div class="col-md-6 offset-md-3 card p-4">
            <h2 class="text-center">Factura</h2>
            <hr>
            <h5>Numero de factura: <?php echo $cabecera_id?></h5>
            <div class="row">
                <div class="col-md-6">
                    <h5>Emisor:</h5>
                    <p>GalaxyGuitars S.A.</p>
                    <p>Dirección:  Junin 123, Ctes. Cap - Arg.</p>
                </div>
                <div class="col-md-6">
                    <h5>Cliente:</h5>
                    <p>Nombre y Apellido: <?php echo $nombre_apellido?></p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas_detalle as $item) : ?>
                            <?php if ($item['venta_id'] == $cabecera_id) : ?>
                                <tr>
                                    <?php foreach ($productos as $producto) : ?>
                                        <?php if ($producto['id_producto'] == $item['producto_id']) : ?>
                                            <td><?php echo $producto['nombre_prod'] ?></td>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                        <td><?php echo  $item['cantidad'] ?></td>
                                        <td><?php echo "$" . $item['precio'] ?></td>
                                        <td><?php echo "$" . $item['cantidad']  * $item['precio']?></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                            
                        
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">Total:</td>
                            <td><?php echo "$" . $total ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            
            
        </div>
    </div>
    
</div>