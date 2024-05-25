<div class="container-fluid d-flex justify-content-center">
    <div class="p-4">
        <h2 class="text-center">CRUD de productos</h2>
        <div class="text-center p-2">
            <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?= base_url('produ-form'); ?>'">Agregar nuevo producto</button>
            <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?= base_url('produ-eliminados'); ?>'">Ver productos eliminados</button>
        </div>

        <div class="row p-2">
            <?php foreach($productos as $producto): ?>
                <?php if($producto['eliminado'] == "NO"): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                    <div class="card h-100">
                        <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <!-- Aplicamos estilos CSS para el texto -->
                            <p class="card-text text-center" style="font-size: 20px; font-weight: bold;"><?= $producto['nombre_prod'] ?></p>
                            <p class="card-title">Precio: $<?= $producto['precio'] ?></p>
                            <p class="card-title">Precio de venta: $<?= $producto['precio_vta'] ?></p>
                            <p class="card-title">Stock: <?= $producto['stock'] ?></p>
                            <p class="card-title">Stock mínimo: <?= $producto['stock_min'] ?></p>
                            <p class="card-title">Eliminado: <?= $producto['eliminado'] ?></p>
                            <a href="<?= base_url('vista_editar/' . $producto['id_producto']); ?>" class="btn btn-primary">
                                <img class="img-fluid" src="<?= base_url('assets/img/edit.png') ?>" class="bi" width="24" height="24">
                            </a>
                            <a href="<?= base_url('produ-eliminar/' . $producto['id_producto']); ?>" class="btn btn-danger">
                                <img class="img-fluid" src="<?= base_url('assets/img/trash.png') ?>" class="bi" width="24" height="24">
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>                
            <?php endforeach; ?>
        </div>
    </div>
</div>
