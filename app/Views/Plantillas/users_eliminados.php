<div class="container-fluid justify-content-center">

    <div class="text-center mt-5 mb-4">
        <h2>Usuarios eliminados</h2>
    </div>
    
    <div class="text-center p-2">
            <button class="w-22 btn btn-primary btn-sm" onclick="location.href='<?= base_url('crud_usuarios'); ?>'">Volver a la vista de usuarios</button>
        </div>

    <!-- Validación -->
    <div>
        <!--recuperamos datos con la función Flashdata para mostrarlos-->
        <?= csrf_field(); ?>

        <?php if (session()->getFlashdata('success')) {
            echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
        </div>";
        } ?>
    </div>

    <?php $validation = \Config\Services::validation(); ?>


    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-striped ml-3">
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Email</td>
                    <td>Eliminado</td>
                    <td>Restaurar?</td>
                </tr>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <?php if ($usuario['baja'] == "SI"): ?>
                    <td>
                        <?= $usuario['id_usuario'] ?>
                    </td>
                    <td>
                        <?= $usuario['nombre'] ?>
                    </td>
                    <td>
                        <?= $usuario['apellido'] ?>
                    </td>
                    
                    <td>
                        <?= $usuario['email'] ?>
                    </td>
                    <?php foreach ($perfiles as $perfil) : ?>
                        <?php if ($usuario['perfil_id'] == $perfil['id_perfil']) : ?>
                            <td>
                                <?= $perfil['descripcion'] ?>
                            </td>
                        <?php endif ?>
                    <?php endforeach ?>
                    <td>
                        <?= $usuario['baja'] ?>
                    </td>
                    
                    <td>
                        <a href="<?php echo base_url(); ?>restaurar_usuario/<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger">
                        <img class="img-fluid" src="<?= base_url('assets/img/back.png') ?>" class="bi" width="24" height="24">
                        </a>
                    </td>
                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            
            
            
            
            </table>
        </div>
        

    </div>
</div>