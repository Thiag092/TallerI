<div class="container-fluid d-flex justify-content-center">
    <div class="p-4">
    
        <div class="card bg-white mb-3">
            <div class="card-body">
                <h2 class="text-center">Nuestros productos pensados para ustedes...</h2>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) { ?>
            <div class="mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php } ?>

        <div class="text-center p-2"></div>
        
        <div class="row p-2">
            <?php if(!empty($productos)): ?>
                <?php foreach($productos as $producto ):?>
                    <div class="col-xs-12 col-m-6 col-lg-4 p-2">
                        <form action="<?= base_url('carrito_agregar/'.$producto['id_producto']);?>" method="post">
                            <div class="card h-100">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" class="card-img-top img-fluid" style="height: 400px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text text-center" style="font-size: 20px; font-weight: bold;"><?= $producto['nombre_prod'] ?></p>
                                    <p class="card-title">Precio: $<?= $producto['precio'] ?></p>
                                    <p class="card-title">Stock: <?= $producto['stock'] ?></p>
                                    <button type="submit" class="btn btn-primary">
                                        Agregar al carrito 
                                        <img class="img-fluid" src="<?= base_url('assets/img/carrito.png') ?>" class="bi" width="24" height="24">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No hay productos disponibles.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Paginación -->
        <nav aria-label="Page navigation example" id="pagina">
            <ul class="pagination">
                <?= $pager->links(); ?>
            </ul>
        </nav>
    </div>
    
</div>
