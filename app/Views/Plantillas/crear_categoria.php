<div class="container-fluid p-4">
    <div class="text-center">
        <h2 class="">CREAR CATEGORIA NUEVA</h2>
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

    <div class="d-flex justify-content-center mt-4">
        <!-- Nuevo contenedor con fondo blanco usando clases de Bootstrap -->
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?php echo base_url('enviar_categoria');?>" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">Nombre de la categoría</label>
                            <input required name="categoria" type="text" class="form-control" placeholder="Ej: Jackson">
                            <!-- Error -->
                            <?php if ($validation->getError('categoria')): ?>
                                <div class='alert alert-danger mt-2'>
                                    <?= $validation->getError('categoria'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3">
        <a class="btn btn-primary" href="<?php echo base_url('/crud_categorias') ?>"><h5>Volver</h5></a>
    </div>
</div>
