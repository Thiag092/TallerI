<div class="container-fluid justify-content-center">

    <div class="text-center p-4 mt-4">
        <h2>LISTADO DE VENTAS REALIZADAS</h2>
    </div>

    <!-- Validación -->
    <div>
        <?= csrf_field(); ?>

        <div class="container-fluid d-flex justify-content-center">
            <?php if (session()->getFlashdata('success')): ?>
                <div class='text-center w-50 alert alert-success alert-dismissible fade show' role='alert'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php $validation = \Config\Services::validation(); ?>

    <div class="text-center p-2">
   
        <!-- Formulario de filtro de fechas -->
        <form method="GET" action="<?= base_url('listar_ventas'); ?>" class="d-inline-block">
        <h4>Buscar por fecha:</h4>
            <label for="start_date" style="font-weight: bold;">Fecha de inicio:</label>
            <input type="date" name="start_date" id="start_date" class="form-control d-inline w-auto" value="<?= set_value('start_date'); ?>">
            <label for="end_date" style="font-weight: bold;">Fecha de fin:</label>
            <input type="date" name="end_date" id="end_date" class="form-control d-inline w-auto" value="<?= set_value('end_date'); ?>">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button class="btn btn-success btn-sm" onclick="location.href='<?= base_url('crud'); ?>'">
                <img src="<?= base_url('assets/img/back.png'); ?>" alt="Recargar" width="24" height="24">
            </button>
        </form>
    </div>

    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped ml-3">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Correo del cliente</th>
                    <th scope="col">Total de la venta</th>
                    <th scope="col">Detalles de la venta</th>
                </tr>
                <?php foreach ($v_ventas_cabecera as $venta_cabecera): ?>
                    <tr>
                        <td><?= $venta_cabecera['id_ventas_cabecera'] ?></td>
                        <td><?= $venta_cabecera['fecha'] ?></td>
                        <td><?= $venta_cabecera['email'] ?></td>
                        <td><?= '$' . $venta_cabecera['total_ventas'] ?></td>
                        <td>
                            <a href="<?= base_url('ver_venta_detalle/' . $venta_cabecera['id_ventas_cabecera']); ?>" class="btn btn-primary">
                                Ver detalle
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
