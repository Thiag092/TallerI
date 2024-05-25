<div class="container-fluid d-flex justify-content-center">
    <div class="p-4">
        <h2 class="text-center">Productos Eliminados</h2>
        <div class="text-center p-2">
            <button class="w-20 btn btn-primary btn-sm" onclick="location.href='<?= base_url('crud'); ?>'">Volver al Menú Anterior</button>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 staff-cards">
                        <?php foreach($productos as $producto ): ?>
                <?php if($producto['eliminado'] == "SI"): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                        <div class="card h-100">
                            <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" class="card-img-top" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text text-center" style="font-size: 20px; font-weight: bold;"><?= $producto['nombre_prod'] ?></p>
                                <p class="card-title">Precio: $<?= $producto['precio'] ?></p>
                                <p class="card-title">Precio de Venta: $<?= $producto['precio_vta'] ?></p>
                                <p class="card-title">Stock: <?= $producto['stock'] ?></p>
                                <p class="card-title">Stock Mínimo: <?= $producto['stock_min'] ?></p>
                                <p class="card-title">Estado: <?= $producto['eliminado'] ?></p>
                                <a href="<?= base_url();?>produ-restaurar/<?= $producto['id_producto'];?>" class="btn btn-success mt-auto">
                                    Restaurar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>                
            <?php endforeach; ?>
        </div>
    </div>
</div>
