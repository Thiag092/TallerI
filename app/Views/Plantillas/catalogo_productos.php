<?php
    // Número de productos que se mostrarán por página
    $productos_por_pagina = 7;

    // Número total de productos
    $total_productos = count($productos);

    // Número total de páginas
    $total_paginas = ceil($total_productos / $productos_por_pagina);

    // Página actual (por defecto será la primera)
    $pagina_actual = isset($_GET['page']) ? $_GET['page'] : 1;

    // Índice del primer producto en la página actual
    $indice_inicio = ($pagina_actual - 1) * $productos_por_pagina;

    // Índice del último producto en la página actual
    $indice_fin = min($indice_inicio + $productos_por_pagina - 1, $total_productos - 1);

    // Array de productos a mostrar en la página actual
    $productos_paginados = array_slice($productos, $indice_inicio, $productos_por_pagina);
?>

<div class="container-fluid d-flex justify-content-center">
    <div class="p-4">

    
    <div class="card bg-white mb-3"> <!-- Agregar una tarjeta separada para el encabezado -->
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
            
            <?php foreach($productos_paginados as $producto ):?>
                <?php if($producto['eliminado'] == "NO" && $producto['stock'] > $producto['stock_min']):?>
                    <div class="col-xs-12 col-m-6 col-lg-4 p-2">
                        <form action="<?php echo base_url();?>carrito_agregar/<?php echo $producto['id_producto'];?>" method="post" >
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
                <?php endif;?>                
            <?php endforeach;?>
        </div>
        
        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center text-center"> <!-- Añadir la clase "text-center" para centrar el índice de páginas -->
                <?php for($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php echo ($i == $pagina_actual) ? 'active' : ''; ?>" style="display: inline-block;">
                        <a class="page-link" href="<?php echo base_url('catalogo').'?page='.$i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>