<div class="container-fluid justify-content-center">

    <div class="text-center mt-5 mb-4">
        <h2>CRUD DE USUARIOS ACTIVOS</h2>
    </div>
    <div class="text-center p-2">
        <button class="w-25 btn btn-primary btn-sm"
            onclick="location.href='<?= base_url('ver_usuarios_eliminados'); ?>'">Ver listado de usuarios dados de baja</button>
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

    <div class="text-center p-2">
        <!-- Formulario de búsqueda -->
        <form method="GET" action="<?= base_url('crud_usuarios'); ?>" class="d-inline-block">
            <input type="text" name="search" placeholder="Buscar usuario" class="form-control w-50 d-inline">
            <button type="submit" class="btn btn-primary">Buscar</button>

            <!-- Botón para recargar la página -->
            <button class="btn btn-success btn-sm" onclick="location.href='<?= base_url('crud'); ?>'">
                <img src="<?= base_url('assets/img/back.png'); ?>" alt="Recargar" width="24" height="24">
            </button>
        </form>
        
    </div>

    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-striped ml-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Nombre único de usuario</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <?php if ($usuario['baja'] == "NO"): ?>
                            <tr>
                                <td><?= $usuario['id_usuario'] ?></td>
                                <td><?= $usuario['nombre'] ?></td>
                                <td><?= $usuario['apellido'] ?></td>
                                <td><?= $usuario['email'] ?></td>
                                <td><?= $usuario['nombre_usuario'] ?></td>
                                <td>
                                    <a href="<?= base_url('eliminar_usuario/' . $usuario['id_usuario']); ?>" class="btn btn-danger">
                                        <img class="img-fluid" src="<?= base_url('assets/img/trash.png') ?>" class="bi" width="24" height="24">
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
