<div class="container-fluid p-4 ">

    <a class="btn btn-primary" href="<?php echo base_url('/crud') ?>"><h5>Volver</h5></a>
    <div class="text-center">
        <h4 class="">Editar Producto</h4>
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

    <div class="d-flex justify-content-center">
        <!-- Inicio del formulario -->
        <form id="editForm" method="post" action="<?php echo base_url('/editar/' . $old['id_producto']);?>" enctype="multipart/form-data">
            <div class="row g-3 p-4 ">
                <div class="col-sm-6">
                    <label for="nombre-prod" class="form-label">Descripción de producto</label>
                    <input id="nombre-prod" name="nombre-prod" type="text" class="form-control" value="<?php echo $old['descripcion_prod'];?>" placeholder="Modelo, color, materiales, etc...">
                    <div class='alert alert-danger mt-2 d-none' id="nombre-prod-error">Este campo debe tener al menos 3 caracteres.</div>
                </div>

                <div class="col-md-6">
                    <label for="cod_categoria" class="form-label">Código de categoría</label>
                    <select id="cod_categoria" name="cod_categoria" class="form-select">
                        <option value="">Elija una opción...</option>
                        <option value="1">1 (Stratocaster)</option>
                        <option value="2">2 (Les Paul)</option>
                        <option value="3">3 (Ediciones especiales)</option>
                        <option value="<?= $categoria_producto['id'] ?>"><?= $categoria_producto['id'] ?>-<?= $categoria_producto['nombre_categoria'] ?></option>
                        <?php foreach ($categorias as $categoria): ?>
                            <?php if ($categoria['categoria_eliminada'] == "NO"): ?>
                                <option value="<?= $categoria['id'] ?>"><?= $categoria['id'] ?>-<?= $categoria['nombre_categoria'] ?></option>    
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <div class='alert alert-danger mt-2 d-none' id="cod_categoria-error">Seleccione un código válido.</div>
                </div>

                <div class="col-sm-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input id="precio" name="precio" type="number" step="0.01" class="form-control" value="<?php echo $old['precio'];?>" placeholder="$00.0">
                    <div class='alert alert-danger mt-2 d-none' id="precio-error">Este campo es requerido.</div>
                </div>

                <div class="col-sm-6">
                    <label for="precio-venta" class="form-label">Precio de Venta</label>
                    <input id="precio-venta" name="precio-venta" type="number" step="0.01" class="form-control" value="<?php echo $old['precio_venta'];?>" placeholder="$00.0">
                    <div class='alert alert-danger mt-2 d-none' id="precio-venta-error">Este campo es requerido.</div>
                </div>

                <div class="col-sm-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input id="stock" name="stock" type="number" step="0.01" class="form-control" value="<?php echo $old['stock'];?>" placeholder="100">
                    <div class='alert alert-danger mt-2 d-none' id="stock-error">Este campo es requerido.</div>
                </div>

                <div class="col-sm-6">
                    <label for="stock-min" class="form-label">Stock Mínimo</label>
                    <input id="stock-min" name="stock-min" type="number" step="0.01" class="form-control" value="<?php echo $old['stock_min'];?>" placeholder="1">
                    <div class='alert alert-danger mt-2 d-none' id="stock-min-error">Este campo es requerido.</div>
                </div>

                <div class="col-12 col-sm-3">
                    <h5>Imagen del producto original</h5>
                    <img class="img-fluid" style="object-fit: contain;" src="<?php echo base_url()?>assets/uploads/<?=$old['imagen'];?>">
                </div>

                <h5>Opcionalmente puede cambiarla:</h5>

                <div class="file">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" type="file" name="imagen">
                </div>
            </div>

            <div class="text-center row-12">
                <button class="w-25 btn btn-danger btn-sm" type="reset">Reiniciar</button>
                <button class="w-25 btn btn-primary btn-sm" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('editForm').addEventListener('submit', function(event) {
    let valid = true;

    const nombreProd = document.getElementById('nombre-prod');
    const codCategoria = document.getElementById('cod_categoria');
    const precio = document.getElementById('precio');
    const precioVenta = document.getElementById('precio-venta');
    const stock = document.getElementById('stock');
    const stockMin = document.getElementById('stock-min');

    if (nombreProd.value.length < 3) {
        valid = false;
        document.getElementById('nombre-prod-error').classList.remove('d-none');
    } else {
        document.getElementById('nombre-prod-error').classList.add('d-none');
    }

    if (codCategoria.value === "") {
        valid = false;
        document.getElementById('cod_categoria-error').classList.remove('d-none');
    } else {
        document.getElementById('cod_categoria-error').classList.add('d-none');
    }

    if (precio.value === "") {
        valid = false;
        document.getElementById('precio-error').classList.remove('d-none');
    } else {
        document.getElementById('precio-error').classList.add('d-none');
    }

    if (precioVenta.value === "") {
        valid = false;
        document.getElementById('precio-venta-error').classList.remove('d-none');
    } else {
        document.getElementById('precio-venta-error').classList.add('d-none');
    }

    if (stock.value === "") {
        valid = false;
        document.getElementById('stock-error').classList.remove('d-none');
    } else {
        document.getElementById('stock-error').classList.add('d-none');
    }

    if (stockMin.value === "") {
        valid = false;
        document.getElementById('stock-min-error').classList.remove('d-none');
    } else {
        document.getElementById('stock-min-error').classList.add('d-none');
    }

    if (!valid) {
        event.preventDefault();
    }
});
</script>
