
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


<div class="container-fluid justify-content-center">
    <div class="text-center mt-4 mb-4">
        <h2>Listado de consultas de CLIENTES pendientes.</h2>
    </div>
    <div class="text-center p-2">
        <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?php echo base_url('ver_consultas2_respondidas'); ?>'">Ver consultas respondidas</button>
    </div>


    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped ml-3">
            <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Consulta</th>
                        <th scope="col">Responder</th>
                    </tr>
                    </thead>
                <?php if (isset($consultas) && !empty($consultas)): ?>
                    <?php foreach ($consultas as $consulta): ?>
                        <?php if ($consulta['respondido'] == "NO"): ?>
                            <tr>
                                <td><?= $consulta['id_contacto'] ?></td>

                                <td><?= $consulta['asunto'] ?></td>

                                
                              
                                <td><?= $consulta['mensaje'] ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>responder_consulta2/<?php echo $consulta['id_contacto']; ?>" class="btn btn-success">
                                    <img class="img-fluid" src="<?= base_url('assets/img/reply.png') ?>" class="bi" width="24" height="24">
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
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
