<h1 class="display-4 text-center">Registrarse</h1>
<?php echo form_open(' ') ?>
<div class="form-group">
<label for="nombre">Ingrese su nombre</label>
<?php echo form_input(['name' => 'nombre', 'id' => 'nombre', 'class' => 'form
control','placeholder' => 'Ingrese nombre']); ?>
</div>
<div class="form-group">
<label for="apellido">Ingrese su apellido</label>
<?php echo form_input(['name' => 'apellido', 'id' => 'apellido', 'class' => 'form
control','placeholder' => 'Ingrese apellido']); ?>
</div>
<!-- Completar con otros controles -->
<div class="form-group">
<label for="contrasenia">Ingrese contraseña</label>
<?php echo form_password(['name' => 'pass', 'id' => 'pass', 'class' => 'form
control','placeholder' => 'Ingrese contraseña']); ?>
</div>
<div class="form-group">
<label for="contrasenia">Repetir contraseña</label>
<?php echo form_password(['name' => 'repass', 'id' => 'repass', 'class' => 'form
control','placeholder' => 'Repetir contraseña']); ?>
</div>
<?php echo form_submit('Registrarme', 'Registrarme', "class='btn btn-success' "); ?> <?php echo form_close();?>