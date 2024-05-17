<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px; mt-5">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrate</p>

                <form class="mx-1 mx-md-4 needs-validation" novalidate>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="nombre">Nombre</label>
                      <input type="text" id="apellido" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa tu nombre.
                      </div>
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="apellido">Apellido</label>
                      <input type="text" id="apellido" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa tu nombre apellido.
                      </div>
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="mail">Correo electronico</label>
                      <input type="email" id="mail" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido. (Ej. tuMail@gmail.com").
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="contraseña">Contraseña</label>
                      <input type="password" id="contraseña" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa una contraseña.
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="contraseña2">Vuelve a escribir tu contraseña</label>
                      <input type="password" id="contraseña2" class="form-control" required />
                      <div class="invalid-feedback">
                        Las contraseñas no coinciden.
                      </div>
                    </div>
                  </div>

                  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="gridCheck" required>
    <input class="form-check-input" type="checkbox" id="gridCheck" required>
    <label class="form-check-label" for="gridCheck" >
      Acepto los términos y condiciones.
    </label>
    <div class="invalid-feedback">
      (Debes aceptar los términos y condiciones.)
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
          var checkbox = form.querySelector('#gridCheck');

          if (form.checkValidity() === false || !checkbox.checked) {
            event.preventDefault();
            event.stopPropagation();

            if (!checkbox.checked) {
              checkbox.classList.add('is-invalid');
            } else {
              checkbox.classList.remove('is-invalid');
            }
          } else {
            checkbox.classList.remove('is-invalid');
          }

          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
