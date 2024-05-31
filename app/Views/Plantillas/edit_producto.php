<div class="container-fluid p-4">
    <a class="btn btn-primary" href="<?= base_url('/crud') ?>"><h5>Volver</h5></a>
    <div class="text-center">
        <h4 class="">Editar Producto</h4>
    </div>

    <!-- Validación -->
    <div>
        <?= csrf_field(); ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

    <div class="d-flex justify-content-center">
        <!-- Inicio del formulario -->
        <form method="post" action="<?= base_url('/editar/' . $old['id_producto']); ?>" enctype="multipart/form-data">
            <div class="row g-3 p-4">
                <div class="col-sm-6">
                    <label for="exampleFormControlInput1" class="form-label">Descripción de producto</label>
                    <input minlength="3" name="nombre-prod" type="text" class="form-control" value="<?= $old['nombre_prod']; ?>" placeholder="Modelo, color, materiales, etc...">
                    <?php if ($validation->getError('nombre-prod')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('nombre-prod'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="categoria_id" class="form-label">Código de categoría</label>
                    <select required name="categoria_id" class="form-select">
                        <option value="">Elija una opción...</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $old['categoria_id'] ? 'selected' : ''; ?>>
                                <?= $categoria['id']; ?> (<?= $categoria['categoria']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->getError('cod_categoria')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('cod_categoria'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input name="precio" type="number" step="0.01" class="form-control" value="<?= $old['precio']; ?>" placeholder="$00.0">
                    <?php if ($validation->getError('precio')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="precio-venta" class="form-label">Precio de Venta</label>
                    <input name="precio-venta" type="number" step="0.01" class="form-control" value="<?= $old['precio_vta']; ?>" placeholder="$00.0">
                    <?php if ($validation->getError('precio-venta')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio-venta'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" type="number" step="0.01" class="form-control" value="<?= $old['stock']; ?>" placeholder="Cantidad en stock">
                    <?php if ($validation->getError('stock')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock-min" class="form-label">Stock Mínimo</label>
                    <input name="stock-min" type="number" step="0.01" class="form-control" value="<?= $old['stock_min']; ?>" placeholder="Cantidad mínima en stock">
                    <?php if ($validation->getError('stock-min')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock-min'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-12">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input name="imagen" type="file" class="form-control">
                    <img src="<?= base_url('assets/uploads/' . $old['imagen']); ?>" alt="Imagen del producto" style="max-width: 150px; margin-top: 10px;">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block mt-3">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
