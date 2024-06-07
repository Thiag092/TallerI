<div class="container-fluid justify-content-center">

    <div class="text-center p-4 mt-4">
        <h2>Listado de ventas realizadas</h2>
    </div>

    <!-- Validación -->
    <div>
        <!--recuperamos datos con la función Flashdata para mostrarlos-->
        <?= csrf_field(); ?>

        <div class="container-fluid d-flex justify-content-center">
            <!--recuperamos datos con la función Flashdata para mostrarlos-->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class='text-center w-50 alert alert-success alert-dismissible fade show' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif ?>
  
        </div>
    </div>

    <?php $validation = \Config\Services::validation(); ?>


    <div class="text-center p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-striped ml-3">
            <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Correo del cliente</th>
                        <th scope="col">Total de la venta</th>
                        <th scope="col">Detalles de laventa</th>
                    </tr>



                
                <?php foreach ($v_ventas_cabecera as $venta_cabecera): ?>
                    <tr>
                            <td>
                                <?= $venta_cabecera['id_ventas_cabecera'] ?>
                            </td>
                            <td>
                                <?= $venta_cabecera['fecha'] ?>
                            </td>
                            <td>
                                <?= $venta_cabecera['email'] ?>
                            </td>
                           
                            <td>
                            <?= '$' . $venta_cabecera['total_ventas'] ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url(); ?>ver_venta_detalle/<?php echo $venta_cabecera['id_ventas_cabecera']; ?>"
                                    class="btn btn-primary">
                                    Ver detalle
                                </a>
                            </td>
                    </tr>
                <?php endforeach ?>




            </table>
        </div>


    </div>
</div>