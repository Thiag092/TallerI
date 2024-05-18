<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')): ?>
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <?= session()->getFlashdata('success') ?>
  </div>
  <?php endif; ?>
</div>

<!--obtiene una instancia del servicio de validación de CodeIgniter y la asigna a la variable $validation-->
<?php $validation = \Config\Services::validation(); ?>

<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-9">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-8 col-xl-6 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrate</p>

                <!--Envio de datos a la ruta 'procesar-registro'-->
                <form class="mx-1 mx-md-4 needs-validation" action="<?php echo base_url('procesar-registro'); ?>" method="post" novalidate>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i> Nombre</label>
                      <input name="nombre" type="text" class="form-control" value="<?php echo set_value('nombre')?>" id="nombre" placeholder="ej: Juan" required>
                      <div class="invalid-feedback">
                        Por favor, ingrese su nombre.
                      </div>
                      <?php if($validation->getError('nombre')): ?>
                          <div class='alert alert-danger mt-2'>
                              <?= $validation->getError('nombre'); ?>
                          </div>
                      <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-4">
                      <label for="apellido" class="form-label"><i class="fa-solid fa-user"></i> Apellido</label>
                      <input name="apellido" type="text" class="form-control" value="<?php echo set_value('apellido')?>" id="apellido" placeholder="ej: Gomez" required>
                      <div class="invalid-feedback">
                        Por favor, ingrese su apellido.
                      </div>
                      <?php if($validation->getError('apellido')): ?>
                          <div class='alert alert-danger mt-2'>
                              <?= $validation->getError('apellido'); ?>
                          </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> E-mail</label>
                    <input name="email" type="email" class="form-control" value="<?php echo set_value('email')?>" id="email" placeholder="tuMail@ejemplo.com" required>
                    <div class="invalid-feedback">
                      Por favor, ingrese un correo electrónico válido.
                    </div>
                    <?php if($validation->getError('email')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('email'); ?>
                        </div>
                    <?php endif; ?>
                  </div>

                  <div class="mb-4">
                    <label for="inputPassword5" class="form-label"><i class="fa-solid fa-lock"></i> Contraseña</label>
                    <input name="pass" type="password" id="inputPassword5" class="form-control" value="<?php echo set_value('pass')?>" aria-describedby="passwordHelpBlock" placeholder="" required>
                    <div class="invalid-feedback">
                      Por favor, ingrese una contraseña.
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                      Entre 8 y 20 caracteres. Sin espacios ni caracteres especiales.
                    </div>
                    <?php if($validation->getError('pass')): ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $validation->getError('pass'); ?>
                        </div>
                    <?php endif; ?>
                  </div>

                  <div class="mb-4">
                    <label for="pass2" class="form-label">Vuelve a escribir tu contraseña</label>
                    <input type="password" id="pass2" class="form-control" required />
                    <div class="invalid-feedback">
                        Las contraseñas no coinciden.
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                    <label class="form-check-label" for="gridCheck">
                      Acepto los términos y condiciones.
                    </label>
                    <div class="invalid-feedback">
                      Debes aceptar los términos y condiciones.
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-custom">Registrarse</button>
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
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          var password = form.querySelector('#inputPassword5');
          var confirmPassword = form.querySelector('#pass2');
          var checkbox = form.querySelector('#gridCheck');

          if (form.checkValidity() === false || password.value !== confirmPassword.value || !checkbox.checked) {
            event.preventDefault();
            event.stopPropagation();

            if (password.value !== confirmPassword.value) {
              confirmPassword.setCustomValidity("Las contraseñas no coinciden.");
              confirmPassword.classList.add('is-invalid');
            } else {
              confirmPassword.setCustomValidity("");
              confirmPassword.classList.remove('is-invalid');
            }

            if (!checkbox.checked) {
              checkbox.classList.add('is-invalid');
            } else {
              checkbox.classList.remove('is-invalid');
            }
          } else {
            confirmPassword.setCustomValidity("");
            confirmPassword.classList.remove('is-invalid');
            checkbox.classList.remove('is-invalid');
          }

          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
