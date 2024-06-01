<div class="container-fluid d justify-content-center">
    
    <div class="text-center mt-5">
        <h2>Listado de categorias eliminadas</h2>
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
                <table class="table table-bordered table-hover table-striped table-striped ml-3">
                    <tr>
                        <td>ID</td>
                        <td>Nombre de categoría</td>
                        <td>Estado</td>
                    </tr>
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr>
                        <?php if ($categoria['categoria_eliminada'] == "SI") : ?>
                            <td><?= $categoria['id'] ?></td>
                            <td><?= $categoria['categoria'] ?></td>
                            
                            <td>
                                 
                                Dado de baja
                            </td>
                        <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                    
                    


                </table>
                <a class="btn btn-primary mt-2" href="<?php echo base_url('/crud_categorias') ?>"><h5>Volver</h5></a>
            </div>
</div>