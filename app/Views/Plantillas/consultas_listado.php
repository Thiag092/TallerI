<div class="container-fluid justify-content-center">
    <div class="text-center">
        <h4>Consultas</h4>
    </div>
    <div class="text-center p-2">
        <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?php echo base_url('ver_consultas_respondidas'); ?>'">Ver consultas respondidas</button>
    </div>

    <!-- Validación -->
    <div>
        <?= csrf_field(); ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped ml-3">
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>Numero Telefónico</td>
                    <td>Consulta</td>
                    <td>Responder</td>
                </tr>
                <?php if (isset($consultas) && !empty($consultas)): ?>
                    <?php foreach ($consultas as $consulta): ?>
                        <tr>
                            <td><?= $consulta['id_mensaje'] ?></td>
                            <td><?= $consulta['nombre'] ?></td>
                            <td><?= $consulta['email'] ?></td>
                            <td><?= $consulta['tel'] ?></td>
                            <td><?= $consulta['mensaje'] ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>responder_consulta/<?php echo $consulta['id_mensaje']; ?>" class="btn btn-danger">
                                    Responder
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay consultas pendientes.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
