<div class="container-fluid justify-content-center">

    <div class="text-center">
        <h4>CRUD de Usuarios</h4>
    </div>
    <div class="text-center p-2">

        <button class="w-25 btn btn-primary btn-sm"
            onclick="location.href='<?php echo base_url('registro'); ?>'">Agregar
            nueva Usuario</button>
        <button class="w-25 btn btn-primary btn-sm"
            onclick="location.href='<?php echo base_url('ver_usuarios_eliminados'); ?>'">Ver Usuario eliminados</button>

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
                    <td>Inactivo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <?php if ($usuario['baja'] == "NO"): ?>
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
                        <?php if ($usuario['id_perfiles'] == $perfil['id_perfiles']) : ?>
                            <td>
                                <?= $perfil['descripcion'] ?>
                            </td>
                        <?php endif ?>
                    <?php endforeach ?>
                    <td>
                        <?= $usuario['baja'] ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url(); ?>ver_editar_usuario/<?php echo $usuario['id_usuario']; ?>"
                            class="btn btn-primary">
                            <img class="img-fluid" src="<?= base_url('assets/img/edit.png') ?>" class="bi" width="24" height="24">
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url(); ?>eliminar_usuario/<?php echo $usuario['id_usuario']; ?>"
                            class="btn btn-danger">
                            <img class="img-fluid" src="<?= base_url('assets/img/trash.png') ?>" class="bi" width="24" height="24">
                        </a>
                    </td>
                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            
            
            
            
            </table>
        </div>
        

    </div>
</div>