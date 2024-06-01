<div class="container-fluid p-4">
    <a class="btn btn-primary" href="<?php echo base_url('/crud') ?>"><h5>Volver</h5></a>
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
        <form method="post" action="<?php echo base_url('/editar/' . $old['id_producto']);?>" enctype="multipart/form-data">
            <div class="row g-3 p-4">
                <div class="col-sm-6">
                    <label for="exampleFormControlInput1" class="form-label">Descripción de producto</label>
                    <input minlength="3" name="nombre-prod" type="text" class="form-control" value="<?php echo $old['nombre_prod'];?>" placeholder="Modelo, color, materiales, etc...">
                    <?php if ($validation->getError('nombre-prod')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('nombre-prod'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="cod_categoria" class="form-label">Código de categoría</label>
                    <select required name="cod_categoria" class="form-select">
                        <option value="">Elija una opción...</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <?php if ($categoria['categoria_eliminada'] == "NO"): ?>
                                <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $old['categoria_id'] ? 'selected' : '' ?>>
                                    <?= $categoria['id'] ?>-<?= $categoria['categoria'] ?>
                                </option>
                            <?php endif; ?>
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
                    <input name="precio" type="number" step="0.01" class="form-control" value="<?php echo $old['precio'];?>" placeholder="$00.0">
                    <?php if ($validation->getError('precio')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="precio-venta" class="form-label">Precio de Venta</label>
                    <input name="precio-venta" type="number" step="0.01" class="form-control" value="<?php echo $old['precio_vta'];?>" placeholder="$00.0">
                    <?php if ($validation->getError('precio-venta')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('precio-venta'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" type="number" step="0.01" class="form-control" value="<?php echo $old['stock'];?>" placeholder="100">
                    <?php if ($validation->getError('stock')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <label for="stock-min" class="form-label">Stock Mínimo</label>
                    <input name="stock-min" type="number" step="0.01" class="form-control" value="<?php echo $old['stock_min'];?>" placeholder="1">
                    <?php if ($validation->getError('stock-min')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('stock-min'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-12 col-sm-3">
                    <h5>Imagen del producto original</h5>
                    <img class="img-fluid" style="object-fit: contain;" src="<?php echo base_url()?>assets/uploads/<?=$old['imagen'];?>" >
                </div>

                <div class="col-12">
                    <h5>Opcionalmente puede cambiarla:</h5>
                    <div class="file">
                        <label for="formGroupExampleInput">Imagen</label>
                        <input type="file" name="imagen">
                        <?php if ($validation->getError('imagen')): ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('imagen'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="text-center row-12">
                <button class="w-25 btn btn-danger btn-sm" type="reset">Reiniciar</button>
                <button class="w-25 btn btn-primary btn-sm" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
