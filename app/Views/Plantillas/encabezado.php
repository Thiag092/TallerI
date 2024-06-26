<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" integrity="" crossorigin="">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('assets/css/miestilo.css') ?>">
    <title>Galaxy - Guitarras de otro mundo</title>
</head>
<body>

<!-- aca toma el tipo de sesion con el que se inicio -->
<?php
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');
$uri = service('uri');
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url('principal'); ?>">
            <img class="icono" src="<?= base_url('assets/img/logo_alien.png') ?>" alt="probando logo') ?>" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color: white;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <!-- Navbar para usuarios no autenticados -->
            <?php if (!$perfil) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'principal') ? 'active' : '' ?>" aria-current="page" href="<?php echo base_url('principal'); ?>">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'quienes_somos') ? 'active' : '' ?>" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'comercializacion') ? 'active' : '' ?>" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'contacto') ? 'active' : '' ?>" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'terminos_y_usos') ? 'active' : '' ?>" href="<?php echo base_url('terminos_y_usos'); ?>">Terminos y Condiciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'catalogo') ? 'active' : '' ?>" href="<?php echo base_url('catalogo'); ?>">Nuestro catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'login') ? 'active' : '' ?>" href="<?php echo base_url('login'); ?>">Ingreso</a>
                </li>
            <?php endif; ?>

            <!-- Navbar para clientes -->
            <?php if ($perfil == "2") : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'principal') ? 'active' : '' ?>" aria-current="page" href="<?php echo base_url('principal'); ?>">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'quienes_somos') ? 'active' : '' ?>" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'comercializacion') ? 'active' : '' ?>" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'consulta2') ? 'active' : '' ?>" href="<?php echo base_url('consulta2'); ?>">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'terminos_y_usos') ? 'active' : '' ?>" href="<?php echo base_url('terminos_y_usos'); ?>">Terminos y Condiciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'catalogo') ? 'active' : '' ?>" href="<?php echo base_url('catalogo'); ?>">
                        Nuestro catálogo
                    </a>
                </li>
                <li class="nav-item p-1">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('/carrito'); ?>"><img
                            src="<?php echo base_url('assets/img/carrito.png'); ?>" class="img-fluid"
                            style="width: 30px; height: 30px; object-fit: contain;"></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="<?php echo base_url('cerrar-inicio'); ?>">
                        Cerrar sesión
                    </a>
                </li>
            <?php endif; ?>

            <!-- Navbar para administradores -->
            <?php if ($perfil == "1") : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'crud_usuarios') ? 'active' : '' ?>" href="<?php echo base_url('crud_usuarios'); ?>">
                        CRUD Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'crud') ? 'active' : '' ?>" href="<?php echo base_url('/crud'); ?>">
                        CRUD Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'crud_categorias') ? 'active' : '' ?>" href="<?php echo base_url('/crud_categorias'); ?>">
                        CRUD Categorías
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'consultas_view') ? 'active' : '' ?>" href="<?php echo base_url('/consultas_view'); ?>">
                        Ver Contacto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'consultas2_view') ? 'active' : '' ?>" href="<?php echo base_url('/consultas2_view'); ?>">
                        Ver Consultas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($uri->getSegment(1) == 'listar_ventas') ? 'active' : '' ?>" href="<?php echo base_url('/listar_ventas'); ?>">
                        Mostrar Ventas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="<?php echo base_url('cerrar-inicio'); ?>">
                        Cerrar sesión
                    </a>
                </li>
            <?php endif; ?>

            </ul>
            <img class="Marca" src="<?= base_url('assets/img/slogan.png'); ?>" alt="">
        </div>
    </div>
</nav>

</body>
</html>
