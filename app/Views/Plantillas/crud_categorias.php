<div class="container-fluid justify-content-center">

    <div class="text-center mt-4">
        <h2>CRUD DE CATEGORÍAS</h2>
    </div>
    <div class="text-center p-2">
    
        <button class="w-25 btn btn-primary btn-sm" onclick="location.href='<?php echo base_url('categoria_form'); ?>'">Agregar
            nueva categoría</button>
        <button class="w-25 btn btn-primary btn-sm"
            onclick="location.href='<?php echo base_url('categoria_eliminados'); ?>'">Ver categorías eliminadas</button>
    
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
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Nombre categoria</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr>
                        <?php if ($categoria['categoria_eliminada'] == "NO") : ?>
                            <td><?= $categoria['id'] ?></td>
                            <td><?= $categoria['categoria'] ?></td>
                            <td>
                                    <a href="<?php echo base_url();?>vista_editar_categoria/<?php echo $categoria['id'];?>" class="btn btn-primary">
                                    <img class="img-fluid" src="<?= base_url('assets/img/edit.png') ?>" class="bi" width="24" height="24">
                                    </a>
                            </td>
                            <td>
                                 <a href="<?php echo base_url();?>eliminar_categoria/<?php echo $categoria['id'];?>" class="btn btn-danger">
                                 <img class="img-fluid" src="<?= base_url('assets/img/trash.png') ?>" class="bi" width="24" height="24">
                                </a>                               
                            </td>
                        <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                    
                    


                </table>

            </div>
</div>