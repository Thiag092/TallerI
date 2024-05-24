<div class="container-fluid p-4">
    <div>
        <a class="btn btn-primary" href="<?php echo base_url('/crud') ?>"><h5>Volver</h5></a>
    </div>

    <!-- Validación -->
    <div>
        <!-- Recuperamos datos con la función Flashdata para mostrarlos -->
        <?= csrf_field(); ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

    <div class="d-flex justify-content-center">
        <!-- Inicio del formulario con fondo blanco -->
        <form method="post" action="<?php echo base_url('/enviar-prod') ?>" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">

            <!-- Título dentro del formulario -->
            <div class="text-center mb-4">
                <h4>Altas de Productos</h4>
            </div>

            <div class="row g-3">

                <div class="col-sm-6">
                    <label for="exampleFormControlInput1" class="form-label">Descripción de producto</label>
                    <input name="nombre-prod" type="text" class="form-control" placeholder="Queso La Paulina Cocina" value="<?= set_value('nombre-prod') ?>">
                    <!-- Error -->
                    <?php if ($validation->getError('nombre-prod')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('nombre-prod'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="cod_categoria" class="form-label">Código de categoría</label>
                    <select name="cod_categoria" class="form-select" required>
                        <option value="">Elegir...</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <?php if ($categoria['categoria_eliminada'] == "NO"): ?>
                                <option value="<?= $categoria['id_categoria'] ?>" <?= set_select('cod_categoria', $categoria['id_categoria']) ?>>
                                    <?= $categoria['id_categoria'] ?> - <?= $categoria['nombre_categoria'] ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <!-- Error -->
                    <?php if ($validation->getError('cod_categoria')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('cod_categoria'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input name="precio" type="number" step="0.01" class="form-control" placeholder="100.0" value="<?= set_value('precio') ?>">
                    <!-- Error -->
                    <?php if ($validation->getError('precio')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="precio-venta" class="form-label">Precio de Venta</label>
                    <input name="precio-venta" type="number" step="0.01" class="form-control" placeholder="130.0" value="<?= set_value('precio-venta') ?>">
                    <!-- Error -->
                    <?php if ($validation->getError('precio-venta')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio-venta'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" type="number" class="form-control" placeholder="100" value="<?= set_value('stock') ?>">
                    <!-- Error -->
                    <?php if ($validation->getError('stock')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock-min" class="form-label">Stock Mínimo</label>
                    <input name="stock-min" type="number" class="form-control" placeholder="1" value="<?= set_value('stock-min') ?>">
                    <!-- Error -->
                    <?php if ($validation->getError('stock-min')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock-min'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="file">
                    <label for="formGroupExampleInput">Imagen</label>
                    <input required type="file" name="imagen">
                    <!-- Error -->
                    <?php if ($validation->getError('imagen')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('imagen'); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="text-center">
                <button class="w-25 btn btn-danger btn-sm" type="reset">Restaurar</button>
                <button class="w-25 btn btn-primary btn-sm" type="submit">Guardar</button>
            </div>

        </form>
    </div>
</div>
