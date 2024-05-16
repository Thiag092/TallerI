<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px; mt-5">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inicio de sesión</p>

                <form class="mx-1 mx-md-4 needs-validation" novalidate>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Correo</label>
                      <input type="text" id="form3Example1c" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa tu correo electronico (ej. tuMail@gmail.com).
                      </div>
                    </div>
                  </div>




                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Contraseña</label>
                      <input type="password" id="form3Example4c" class="form-control" required />
                      <div class="invalid-feedback">
                        Por favor, ingresa tu contraseña.
                      </div>
                    </div>
                  </div>

                  

                 

              <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 mt-4">
                      <button type="submit" class="btn btn-primary btn-lg btn-custom">Iniciar sesión</button>
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


<script>          //--------------- Ver por que no funciona del todo la validacion del formulario ---------------------
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
