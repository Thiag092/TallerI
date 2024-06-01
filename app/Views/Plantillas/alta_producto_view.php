<div class="container-fluid p-4">
    <div class="card p-4 bg-white">
        <div>
            <a class="btn btn-primary" href="<?php echo base_url('/crud') ?>"><h5>Volver</h5></a>
        </div>
        <div class="text-center mb-4">
            <h4>Altas de Productos</h4>
        </div>

        <!-- Validación -->
        <div>
            <!--recuperamos datos con la función Flashdata para mostrarlos-->
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
            <!-- Inicio del formulario -->
            <form method="post" action="<?php echo base_url('/enviar-prod') ?>" enctype="multipart/form-data">
                <div class="row g-3 p-4">
                    <div class="col-sm-6">
                        <label for="exampleFormControlInput1" class="form-label">Descripción de producto</label>
                        <input name="nombre-prod" type="text" class="form-control" placeholder="Ingrese nombre, caracteristicas, etc..">
                        <!-- Error -->
                        <?php if ($validation->getError('nombre-prod')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('nombre-prod'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
    <label for="cod_categoria" class="form-label">Código de categoría</label>
    <select name="cod_categoria" class="form-select" required>
        <option value="">Elija una opción...</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>"><?= $categoria['id'] ?> (<?= $categoria['categoria'] ?>)</option>
        <?php endforeach; ?>
    </select>
    <!-- Error -->
    <?php if ($validation->getError('cod_categoria')): ?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('cod_categoria'); ?>
        </div>
    <?php endif; ?>
    <div class="invalid-feedback">
        Seleccione un código válido.
    </div>
</div>


                    <div class="col-sm-6">
                        <label for="precio" class="form-label">Precio</label>
                        <input name="precio" type="number" step="0.01" class="form-control" placeholder="00.00">
                        <!-- Error -->
                        <?php if ($validation->getError('precio')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('precio'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="precio-venta" class="form-label">Precio de Venta</label>
                        <input name="precio-venta" type="number" step="0.01" class="form-control" placeholder="00.00">
                        <!-- Error -->
                        <?php if ($validation->getError('precio-venta')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('precio-venta'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="stock" class="form-label">Stock</label>
                        <input name="stock" type="number" step="0.01" class="form-control" placeholder="">
                        <!-- Error -->
                        <?php if ($validation->getError('stock')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('stock'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6">
                        <label for="stock-min" class="form-label">Stock Mínimo</label>
                        <input name="stock-min" type="number" step="0.01" class="form-control" placeholder="">
                        <!-- Error -->
                        <?php if ($validation->getError('stock-min')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('stock-min'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form method="post" action="<?php echo base_url('/enviar-prod') ?>" enctype="multipart/form-data">
    <div class="row g-3 p-4">
        <!-- Otros campos del formulario -->
        
        <div class="col-sm-6">
            <label for="imagen" class="form-label">Carga de imagen:</label>
            <input type="file" name="imagen" class="form-control" required>
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
</div>
