<div class="container-fluid justify-content-center">

<div class="text-center mt-4 mb-4">
        <h2>Listado de consultas respondidas.</h2>
    </div>
    <div class="text-center p-2">

        <button class="w-20 btn btn-primary btn-sm" onclick="location.href='<?php echo base_url('consultas_view'); ?>'">Volver a la consultas pendientes</button>

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
            <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Número telefónico</th>
                        <th scope="col">Consulta</th>
                    </tr>
                    </thead>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <?php if ($consulta['respondido'] == "SI"): ?>
                            <td>
                                <?= $consulta['id_mensaje'] ?>
                            </td>
                            <td>
                                <?= $consulta['nombre'] ?>
                            </td>
                           
                            <td>
                                <?= $consulta['email'] ?>
                            </td>
                            <td>
                                <?= $consulta['tel'] ?>
                            </td>
                            <td>
                                <?= $consulta['mensaje'] ?>
                            </td>
                            
                            
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>




            </table>
        </div>


    </div>
</div>