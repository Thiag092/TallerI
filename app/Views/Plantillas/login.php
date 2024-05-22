<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos si el login NO FUE EXITOSO por tener contraseña incorrecta-->
  <?php if (session()->getFlashdata('passIncorrecto')): ?>
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <?= session()->getFlashdata('passIncorrecto') ?>
  </div>
  <?php endif; ?>
</div>

<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos si el login NO FUE EXITOSO, por no estar el mail registrado-->
  <?php if (session()->getFlashdata('mailIncorrecto')): ?>
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <?= session()->getFlashdata('mailIncorrecto') ?>
  </div>
  <?php endif; ?>
</div>


<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos una vez que el usuario FINALIZO LA SESION-->
  <?php if (session()->getFlashdata('vuelvaIniciar')): ?>
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <?= session()->getFlashdata('vuelvaIniciar') ?>
  </div>
  <?php endif; ?>
</div>




<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos si el login es exitoso-->
  <?php if (session()->getFlashdata('success')): ?>
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <?= session()->getFlashdata('success') ?>
  </div>
  <?php endif; ?>
</div>

<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px; ">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inicio de sesión</p>

                <form class="mx-1 mx-md-4 needs-validation" action="<?php echo base_url('login'); ?>" method="post" novalidate>
  <div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
    <div class="form-outline flex-fill mb-0">
      <label class="form-label" for="email">Correo</label>
      <input type="text" id="email" name="email" class="form-control" placeholder="tuCorreo@Ejemplo.com" required />
      <div class="invalid-feedback">
        Por favor, ingresa tu correo electronico (ej. tuMail@gmail.com).
      </div>
    </div>
  </div>

  <div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
    <div class="form-outline flex-fill mb-0">
      <label class="form-label" for="password">Contraseña</label>
      <input type="password" id="pass" name="pass" class="form-control" placeholder="*******" required />
      <div class="invalid-feedback">
        Por favor, ingresa tu contraseña.
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 mt-4">
    <button type="submit" class="btn btn-primary btn-lg btn-custom">Iniciar sesión</button>
  </div>
  <div class="RedireccionRegistro text-center">
    <p> Todavía no te registraste? <a href="<?= base_url('registro') ?>" class="registro-link">Hacelo acá.</a></p>
  </div>
</form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('needs-validation');

      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
