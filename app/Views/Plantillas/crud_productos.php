<div class="container-fluid justify-content-center">
    <div class="p-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <h2 class="text-center">CRUD de productos</h2>
        <div class="text-center p-2">
            <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?= base_url('produ-form'); ?>'">Agregar nuevo producto</button>
            <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?= base_url('produ-eliminados'); ?>'">Ver productos eliminados</button>
        </div>

        <div class="row p-2">
            <table class="table table-bordered table-hover table-striped table-striped ml-3">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Precio de Venta</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Stock Mínimo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $producto): ?>
                        <?php if($producto['eliminado'] == "NO"): ?>
                            <tr>
                                <td><?= $producto['nombre_prod'] ?></td>
                                <td>$<?= $producto['precio'] ?></td>
                                <td>$<?= $producto['precio_vta'] ?></td>
                                <td><?= $producto['stock'] ?></td>
                                <td><?= $producto['stock_min'] ?></td>
                                <td>
                                    <a href="<?= base_url('vista_editar/' . $producto['id_producto']); ?>" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                    <a href="<?= base_url('produ-eliminar/' . $producto['id_producto']); ?>" class="btn btn-danger btn-sm">
                                        Eliminar
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
