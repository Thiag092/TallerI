<div class="container-fluid">
  <!-- Mensaje de éxito -->
  <?php if(session()->getFlashdata('success')): ?>
    <div class=" mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible mt-4" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Resto del contenido de la vista -->

  <div class="card mt-4">
    <section class="page-header" data-store="page-title">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <h1 class="text-center h2 h1-md text-md-left mt-4 mt-5" style="text-decoration: underline">CONTACTO</h1>
          </div>
        </div>
      </div>
    </section>

    <div class="row text-center text-md-left mt-4" style="margin-left: 3px">
      <div class="col-s-12 col-md-12 col-lg-6 col-xl-4">
        <ul class="contact-info">
          <li class="contact-item">
            <img class="iconos" src="<?= base_url('assets/img/icono_reloj.png') ?>" alt="">
            <p>Horario de atención: Lun a Vie. 8.30hs a 12.30hs y 17hs a 20hs. - Sab 8.30hs a 12.30hs.</p>
          </li>
          <li class="contact-item">
            <img class="iconos" src="<?= base_url('assets/img/icono_mapa.png') ?>" alt="">
            <p>Domicilio legal: Junin 123, Corrientes - Argentina</p>
          </li>
          <li class="contact-item">
            <img class="iconos" src="<?= base_url('assets/img/icono_telefono_negro.png') ?>">
            <p>TEL: 379-4123456</p>
          </li>
          <li class="contact-item">
            <img class="iconos" src="<?= base_url('assets/img/icono_correo_negro.png') ?>">
            <p>GalaxyGuitars@gmail.com</p>
          </li>
          <li class="contact-item">
            <img class="iconos" src="<?= base_url('assets/img/icono_empresa.png') ?>">
            <p>Razón Social: GalaxyGuitars S.A.</p>
          </li>
        </ul>
        <iframe class="mapagoogle" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.0846241391505!2d-58.848994100000006!3d-27.466624699999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456cb9cc467387%3A0xfd86378b067f3c7!2sJunin%20123%2C%20W3400AVF%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713386829041!5m2!1ses-419!2sar" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="col-s-12 col-md-12 col-lg-6 col-xl-8">
        <form class="row g-3 needs-validation" action="<?= base_url('enviar_consulta') ?>" method="post" novalidate>
          <div class="col-md-6">
            <label for="inputName" class="form-label" style="font-weight: bold;">Nombre completo:</label>
            <input type="text" name="nombre" class="form-control" id="inputName" required>
            <div class="invalid-feedback">
              Por favor, ingresa tu nombre completo.
            </div>
          </div>
          <div class="col-md-6">
            <label for="inputEmail" class="form-label" style="font-weight: bold;">Correo:</label>
            <input type="email" name="email" class="form-control" id="inputEmail" required>
            <div class="invalid-feedback">
              Por favor, ingresa un correo electrónico válido (Ej. tuMail@gmail.com).
            </div>
          </div>
          <div class="col-6">
            <label for="inputSubject" class="form-label" style="font-weight: bold;">Asunto:</label>
            <input type="text" name="asunto" class="form-control" id="inputSubject" required>
            <div class="invalid-feedback">
              Por favor, ingresa el asunto de tu mensaje.
            </div>
          </div>
          <div class="col-6">
            <label for="inputPhone" class="form-label" style="font-weight: bold;">Teléfono:</label>
            <input type="text" name="tel" class="form-control" id="inputPhone" required>
            <div class="invalid-feedback">
              Este campo debe ser completado.
            </div>
          </div>
          <div class="mb-3">
            <label for="inputMessage" class="form-label" style="font-weight: bold;">Déjanos tu mensaje y nos comunicamos con vos!</label>
            <textarea class="form-control" name="mensaje" id="inputMessage" rows="12" required placeholder="Escribí aquí:"></textarea>
            <div class="invalid-feedback">
              Por favor, ingresa tu mensaje.
            </div>
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" required>
              <label class="form-check-label" for="gridCheck">
                Acepto los términos y condiciones.
              </label>
              <div class="invalid-feedback">
                Debes aceptar los términos y condiciones.
              </div>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      Array.prototype.filter.call(forms, function(form) {
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
