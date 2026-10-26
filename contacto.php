
<?php
$titulo_pagina = "Contacto – Salta de Mates";

require_once 'includes/header.php';
?>

  <div class="form-hero">
    <h1>Contacto</h1>
    <p>¿Tenés alguna consulta, sugerencia o querés recomendar un lugar? ¡Escribinos!</p>
  </div>

  <div class="container">
    <div class="form-card">

      <form id="form-contacto" novalidate>

        <div class="form-section-title">Datos personales</div>

        <div class="form-group">
          <label for="nombre">Nombre completo *</label>
          <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan Perez" />
          <div class="error-msg" id="err-nombre">El nombre es obligatorio (minimo 3 caracteres).</div>
        </div>

        <div class="form-group">
          <label for="email">Correo electronico *</label>
          <input type="email" id="email" name="email" placeholder="Ej: juan@email.com" />
          <div class="error-msg" id="err-email">Ingresa un correo electronico valido (ej: usuario@dominio.com).</div>
        </div>

        <div class="form-group">
          <label for="telefono">Telefono</label>
          <input type="number" id="telefono" name="telefono" placeholder="Ej: 3875000000" />
          <p class="hint">Solo numeros, sin espacios ni guiones.</p>
        </div>

        <div class="form-group">
          <label for="fecha">Fecha de nacimiento</label>
          <input type="date" id="fecha" name="fecha" max="2015-12-31" />
        </div>

        <div class="form-group">
          <label for="pais">Pais *</label>
          <select id="pais" name="pais">
            <option value="">-- Selecciona tu pais --</option>
            <option value="Argentina">Argentina</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Chile">Chile</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Brasil">Brasil</option>
            <option value="Otro">Otro</option>
          </select>
          <div class="error-msg" id="err-pais">Selecciona tu pais.</div>
        </div>

        <div class="form-section-title">Tu consulta</div>

        <div class="form-group">
          <label>Como nos conociste? *</label>
          <div class="radio-group">
            <label><input type="radio" name="origen" value="Redes sociales" /> Redes sociales</label>
            <label><input type="radio" name="origen" value="Un amigo" /> Un amigo</label>
            <label><input type="radio" name="origen" value="Google" /> Google</label>
            <label><input type="radio" name="origen" value="La escuela" /> La escuela</label>
            <label><input type="radio" name="origen" value="Otro" /> Otro</label>
          </div>
          <div class="error-msg" id="err-origen">Selecciona como nos conociste.</div>
        </div>

        <div class="form-group">
          <label for="asunto">Asunto *</label>
          <input type="text" id="asunto" name="asunto" placeholder="Ej: Consulta sobre un lugar" />
          <div class="error-msg" id="err-asunto">El asunto es obligatorio (minimo 5 caracteres).</div>
        </div>

        <div class="form-group">
          <label for="mensaje">Mensaje *</label>
          <textarea id="mensaje" name="mensaje" placeholder="Escribi tu mensaje aca..."></textarea>
          <div class="error-msg" id="err-mensaje">El mensaje es obligatorio (minimo 10 caracteres).</div>
        </div>

        <div class="form-group">
          <label for="foto">Adjuntar foto del lugar (opcional)</label>
          <input type="file" id="foto" name="foto" accept="image/*" />
          <p class="hint">Solo imagenes: JPG, PNG, WEBP.</p>
        </div>

        <input type="hidden" name="sitio" value="salta-de-mates" />

        <div class="form-group">
          <div class="check-group">
            <label>
              <input type="checkbox" id="terminos" name="terminos" />
              Acepto los terminos y condiciones del sitio *
            </label>
          </div>
          <div class="error-msg" id="err-terminos">Debes aceptar los terminos para continuar.</div>
        </div>

        <div class="btn-group">
          <button type="submit" class="btn-enviar">Ver resumen</button>
          <button type="reset" class="btn-limpiar" onclick="limpiarForm()">Limpiar</button>
        </div>

      </form>

      <!-- RESUMEN Punto 7 -->
      <div class="resumen-box" id="resumen-box">
        <h3>Resumen de tu mensaje</h3>
        <div class="resumen-item"><strong>Nombre:</strong> <span id="res-nombre"></span></div>
        <div class="resumen-item"><strong>Email:</strong> <span id="res-email"></span></div>
        <div class="resumen-item"><strong>Pais:</strong> <span id="res-pais"></span></div>
        <div class="resumen-item"><strong>Origen:</strong> <span id="res-origen"></span></div>
        <div class="resumen-item"><strong>Asunto:</strong> <span id="res-asunto"></span></div>
        <div class="resumen-item"><strong>Mensaje:</strong> <span id="res-mensaje"></span></div>
        <button class="btn-confirmar" onclick="enviarForm()">Confirmar y enviar</button>
        <button class="btn-editar" onclick="editarForm()">Editar</button>
      </div>

      <div class="success-msg" id="success-msg">
        Mensaje enviado con exito! Te respondemos a la brevedad.
      </div>

    </div>
  </div>

  <script>
    // Validación de formulario
    function validarEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function mostrarError(id, inputId) {
      document.getElementById(id).style.display = 'block';
      if (inputId) document.getElementById(inputId).classList.add('input-error');
    }

    function ocultarError(id, inputId) {
      document.getElementById(id).style.display = 'none';
      if (inputId) document.getElementById(inputId).classList.remove('input-error');
    }

    function validarForm() {
      var valido = true;

      var nombre = document.getElementById('nombre').value.trim();
      if (nombre.length < 3) { mostrarError('err-nombre','nombre'); valido = false; }
      else ocultarError('err-nombre','nombre');

      var email = document.getElementById('email').value.trim();
      if (!validarEmail(email)) { mostrarError('err-email','email'); valido = false; }
      else ocultarError('err-email','email');

      var pais = document.getElementById('pais').value;
      if (!pais) { mostrarError('err-pais','pais'); valido = false; }
      else ocultarError('err-pais','pais');

      var origen = document.querySelector('input[name="origen"]:checked');
      if (!origen) { mostrarError('err-origen', null); valido = false; }
      else ocultarError('err-origen', null);

      var asunto = document.getElementById('asunto').value.trim();
      if (asunto.length < 5) { mostrarError('err-asunto','asunto'); valido = false; }
      else ocultarError('err-asunto','asunto');

      var mensaje = document.getElementById('mensaje').value.trim();
      if (mensaje.length < 10) { mostrarError('err-mensaje','mensaje'); valido = false; }
      else ocultarError('err-mensaje','mensaje');

      var terminos = document.getElementById('terminos').checked;
      if (!terminos) { mostrarError('err-terminos', null); valido = false; }
      else ocultarError('err-terminos', null);

      return valido;
    }

    // Resumen antes de enviar
    document.getElementById('form-contacto').addEventListener('submit', function(e) {
      e.preventDefault();
      if (!validarForm()) return;

      var origen = document.querySelector('input[name="origen"]:checked');

      document.getElementById('res-nombre').textContent  = document.getElementById('nombre').value;
      document.getElementById('res-email').textContent   = document.getElementById('email').value;
      document.getElementById('res-pais').textContent    = document.getElementById('pais').value;
      document.getElementById('res-origen').textContent  = origen ? origen.value : '-';
      document.getElementById('res-asunto').textContent  = document.getElementById('asunto').value;
      document.getElementById('res-mensaje').textContent = document.getElementById('mensaje').value;

      document.getElementById('form-contacto').style.display = 'none';
      document.getElementById('resumen-box').style.display = 'block';
    });

    function enviarForm() {
      document.getElementById('resumen-box').style.display = 'none';
      document.getElementById('success-msg').style.display = 'block';
    }

    function editarForm() {
      document.getElementById('resumen-box').style.display = 'none';
      document.getElementById('form-contacto').style.display = 'block';
    }

    function limpiarForm() {
      document.querySelectorAll('.error-msg').forEach(function(e) { e.style.display = 'none'; });
      document.querySelectorAll('.input-error').forEach(function(e) { e.classList.remove('input-error'); });
    }
  </script>

<?php require_once 'includes/footer.php'; ?>