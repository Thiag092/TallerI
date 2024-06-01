<div class="container-fluid p-4">
    <a class="btn btn-primary" href="<?php echo base_url('/crud_categorias') ?>"><h5>Volver</h5></a>
    <div class="text-center">
        <h4 class="">Crear Categoría</h4>
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
        <form method="post" action="<?php echo base_url('enviar_categoria');?>" enctype="multipart/form-data">
            <div class="row g-3 p-4">
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
                    <input required name="categoria" type="text" class="form-control" placeholder="Ej: Jackson">
                    <!-- Error -->
                    <?php if ($validation->getError('categoria')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('categoria'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-center row-12">
                <button class="w-25 btn btn-danger btn-sm" type="reset">Reiniciar</button>
                <button class="w-25 btn btn-primary btn-sm" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
