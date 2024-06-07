<div class="container-fluid justify-content-center">
    <div class="p-4">
        <h2 class="text-center">Productos dados de baja.</h2>
        <div class="text-center p-2">
            <button class="w-20 btn btn-primary btn-sm" onclick="location.href='<?= base_url('crud'); ?>'">Volver a CRUD productos</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre del Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Precio de Venta</th>
                       
                        
                        <th scope="col">Restaurar?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $producto): ?>
                        <?php if($producto['eliminado'] == "SI"): ?>
                            <tr>
                                <td><?= $producto['nombre_prod'] ?></td>
                                <td>$<?= $producto['precio'] ?></td>
                                <td>$<?= $producto['precio_vta'] ?></td>
                               
                                <td>
                                    <a href="<?= base_url();?>produ-restaurar/<?= $producto['id_producto'];?>" class="btn btn-success">
                                    <img class="img-fluid" src="<?= base_url('assets/img/back.png') ?>" class="bi" width="24" height="24">
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>                
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
