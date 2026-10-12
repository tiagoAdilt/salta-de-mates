<?php
$titulo_pagina = "Salta de Mates – Lugares";

$extra_styles = '
  <style>
    /* MODO OSCURO */
    .dark-mode { background: #1a1a2e !important; color: #e0e0e0 !important; }
    .dark-mode .site-header { background: #16213e !important; color: #e0e0e0 !important; }
    .dark-mode .place-card { background: #16213e !important; color: #e0e0e0 !important; }
    .dark-mode .place-card-footer { color: #e0e0e0 !important; }
    .dark-mode .contacto-box { background: #16213e !important; }
    .dark-mode .site-footer { background: #16213e !important; }
    .dark-mode pre.codigo { background: #0f3460 !important; }
    .dark-mode h2.section-title { color: #a8f0c0 !important; }
    .dark-mode p { color: #ccc !important; }
  </style>
';

require_once 'includes/header.php';
?>

  <div class="page-hero">
    <h1>🧉 Salta de Mates</h1>
    <p>Los mejores rincones de la provincia de Salta para disfrutar de un buen mate al aire libre.</p>
  </div>

  <main class="container">

    <!-- BOTÓN MODO OSCURO -->
    <div style="text-align: right; margin-bottom: 15px;">
      <button id="dark-toggle" onclick="toggleDarkMode()" style="background:#1e7a3e; color:#fff; border:none; padding:8px 16px; border-radius:20px; cursor:pointer; font-weight:600;">
        🌙 Modo Oscuro
      </button>
    </div>

    <h2 class="section-title">📍 Lugares Destacados</h2>
    <p>Explorá nuestra selección de los 10 mejores spots mateadores en Salta.</p>

    <div class="grid-lugares">

      <!-- LUGAR 1 -->
      <article class="place-card">
        <img src="img/cerro.jpg" alt="Cerro San Bernardo" />
        <div class="place-card-body">
          <h3>1. Cerro San Bernardo</h3>
          <p>Ubicación: Salta Capital</p>
          <p>Vista panorámica de toda la ciudad desde la cima. Ideal para ir al atardecer.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-1')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-1')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-1')">Ubicación</button>
            </div>
            <div id="tab-historia-1" class="tab-panel active">
              <p>El cerro tutelar de la ciudad, con su viacrucis y vegetación autóctona.</p>
            </div>
            <div id="tab-comentarios-1" class="tab-panel">
              <p><em>"Un clásico salteño, la vista al atardecer no falla jamás." — María G.</em></p>
            </div>
            <div id="tab-ubicacion-1" class="tab-panel">
              <p>Acceso por escalinatas o teleférico desde el Parque San Martín.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 2 -->
      <article class="place-card">
        <img src="img/plaza9dejulio.jpg" alt="Plaza 9 de Julio" />
        <div class="place-card-body">
          <h3>2. Plaza 9 de Julio</h3>
          <p>Ubicación: Centro Histórico, Salta Capital</p>
          <p>Rodeada de recovas coloniales, la Catedral y el Cabildo. Corazón de la ciudad.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-2')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-2')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-2')">Ubicación</button>
            </div>
            <div id="tab-historia-2" class="tab-panel active">
              <p>Fundada en 1582, testigo de los principales hechos históricos de la provincia.</p>
            </div>
            <div id="tab-comentarios-2" class="tab-panel">
              <p><em>"Hermosa plaza para sentarse bajo la sombra de las tipas." — Juan P.</em></p>
            </div>
            <div id="tab-ubicacion-2" class="tab-panel">
              <p>Entre calles Caseros, España, Zuviría y Mitre.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 3 -->
      <article class="place-card">
        <img src="img/parquesur.jpg" alt="Parque Bicentenario" />
        <div class="place-card-body">
          <h3>3. Parque Bicentenario</h3>
          <p>Ubicación: Zona Norte, Salta Capital</p>
          <p>Gran espacio verde con laguna artificial, caminerías y zonas de césped para reposeras.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-3')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-3')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-3')">Ubicación</button>
            </div>
            <div id="tab-historia-3" class="tab-panel active">
              <p>Inaugurado en 2015 como el pulmón verde más grande de la zona norte.</p>
            </div>
            <div id="tab-comentarios-3" class="tab-panel">
              <p><em>"Súper espacioso, ideal para ir en familia a tomar unos mates." — Sofía L.</em></p>
            </div>
            <div id="tab-ubicacion-3" class="tab-panel">
              <p>Av. Bolivia S/N, frente a la Universidad Nacional de Salta.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 4 -->
      <article class="place-card">
        <img src="img/sanlorenzo.jpg" alt="Quebrada de San Lorenzo" />
        <div class="place-card-body">
          <h3>4. Quebrada de San Lorenzo</h3>
          <p>Ubicación: San Lorenzo (a 12 km de la Capital)</p>
          <p>Reserva natural con arroyo de montaña y vegetación de yunga salteña.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-4')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-4')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-4')">Ubicación</button>
            </div>
            <div id="tab-historia-4" class="tab-panel active">
              <p>Tradicional villa veraniega salteña con microclima fresco todo el año.</p>
            </div>
            <div id="tab-comentarios-4" class="tab-panel">
              <p><em>"El sonido del arroyo mientras tomás mate es único." — Lucas R.</em></p>
            </div>
            <div id="tab-ubicacion-4" class="tab-panel">
              <p>Al final de la Av. San Martín en la villa de San Lorenzo.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 5 -->
      <article class="place-card">
        <img src="img/guemes.jpg" alt="Plaza Güemes" />
        <div class="place-card-body">
          <h3>5. Plaza Güemes</h3>
          <p>Ubicación: Salta Capital</p>
          <p>Ubicada frente a la Legislatura, rodeada de cafés y ferias artesanales los fines de semana.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-5')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-5')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-5')">Ubicación</button>
            </div>
            <div id="tab-historia-5" class="tab-panel active">
              <p>Homenaje al héroe nacional General Martín Miguel de Güemes.</p>
            </div>
            <div id="tab-comentarios-5" class="tab-panel">
              <p><em>"Mucha sombra y tranquilidad en pleno centro." — Camila M.</em></p>
            </div>
            <div id="tab-ubicacion-5" class="tab-panel">
              <p>Entre calles Rivadavia, Leguizamón, Balcarce y Mitre.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 6 -->
      <article class="place-card">
        <img src="img/legislatura.jpg" alt="Paseo de los Poetas" />
        <div class="place-card-body">
          <h3>6. Paseo de los Poetas</h3>
          <p>Ubicación: Salta Capital</p>
          <p>Canal con puente peatonal, murales y esculturas dedicadas a poetas salteños.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-6')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-6')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-6')">Ubicación</button>
            </div>
            <div id="tab-historia-6" class="tab-panel active">
              <p>Espacio bohemio recuperado en honor al folclore y la poesía local.</p>
            </div>
            <div id="tab-comentarios-6" class="tab-panel">
              <p><em>"Muy lindo rincón para pasar la tarde escuchando folclore de fondo." — Mateo S.</em></p>
            </div>
            <div id="tab-ubicacion-6" class="tab-panel">
              <p>Calle Esteco entre Alvarado y San Martín.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 7 -->
      <article class="place-card">
        <img src="img/paludica.png" alt="Palacio Zorrilla" />
        <div class="place-card-body">
          <h3>7. Centro Cultural Palacio Zorrilla</h3>
          <p>Ubicación: Salta Capital</p>
          <p>Patio interior colonial con vegetación y sombra permanente en pleno casco histórico.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-7')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-7')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-7')">Ubicación</button>
            </div>
            <div id="tab-historia-7" class="tab-panel active">
              <p>Antigua casona del siglo XIX sede de actividades culturales de la UNSa.</p>
            </div>
            <div id="tab-comentarios-7" class="tab-panel">
              <p><em>"Silencioso y fresco, perfecto si buscás tranquilidad." — Andrea P.</em></p>
            </div>
            <div id="tab-ubicacion-7" class="tab-panel">
              <p>Calle Buenos Aires 177.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 8 -->
      <article class="place-card">
        <img src="img/portezuelo.jpg" alt="Mirador del Portezuelo" />
        <div class="place-card-body">
          <h3>8. Mirador del Portezuelo</h3>
          <p>Ubicación: Acceso Este, Salta Capital</p>
          <p>Punto de bienvenida a la ciudad con vista panorámica a los valles y cerros.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-8')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-8')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-8')">Ubicación</button>
            </div>
            <div id="tab-historia-8" class="tab-panel active">
              <p>Historico acceso vial por la ruta nacional 9.</p>
            </div>
            <div id="tab-comentarios-8" class="tab-panel">
              <p><em>"Excelente para parar al entrar o salir de la ciudad." — Gonzalo K.</em></p>
            </div>
            <div id="tab-ubicacion-8" class="tab-panel">
              <p>Ruta Nacional 9, Portezuelo de Salta.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 9 -->
      <article class="place-card">
        <img src="img/plaza.jpg" alt="Plaza Alvarado" />
        <div class="place-card-body">
          <h3>9. Plaza Alvarado</h3>
          <p>Ubicación: Barrio Macrocentro, Salta Capital</p>
          <p>Plaza barrial muy concurrida por vecinos, con arboleda frondosa y juegos.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-9')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-9')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-9')">Ubicación</button>
            </div>
            <div id="tab-historia-9" class="tab-panel active">
              <p>Corazón del tradicional barrio Alvarado.</p>
            </div>
            <div id="tab-comentarios-9" class="tab-panel">
              <p><em>"Muy familiar, siempre hay puestos de churros y bizcochitos." — Florencia T.</em></p>
            </div>
            <div id="tab-ubicacion-9" class="tab-panel">
              <p>Entre calles Ayacucho, Caseros, Moldes y Alvarado.</p>
            </div>
          </div>
        </div>
      </article>

      <!-- LUGAR 10 -->
      <article class="place-card">
        <img src="img/bicentenario.jpg" alt="Parque Sur" />
        <div class="place-card-body">
          <h3>10. Parque Sur</h3>
          <p>Ubicación: Zona Sur, Salta Capital</p>

          <p>Nuevo parque urbano con anfiteatro, pistas de salud y amplios sectores de pasto.</p>

          <div class="tabs-container">
            <div class="tab-buttons">
              <button class="tab-btn active" onclick="cambiarTab(this, 'historia-10')">Historia</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'comentarios-10')">Comentarios</button>
              <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-10')">Ubicación</button>
            </div>
            <div id="tab-historia-10" class="tab-panel active">
              <p>Construido sobre los predios del ex aeropuerto para beneficio del sector sur.</p>
            </div>
            <div id="tab-comentarios-10" class="tab-panel">
              <p><em>"Enorme y re lindo para llevar a los chicos y tomar mates tranqui." — Esteban N.</em></p>
            </div>
            <div id="tab-ubicacion-10" class="tab-panel">
              <p>Av. Ex Combatientes de Malvinas.</p>
            </div>
          </div>
        </div>
      </article>

    </div>

  </main>

  <script>
    // Cambio de pestañas en tarjetas
    function cambiarTab(btn, id) {
      const cardBody = btn.closest('.place-card-body');
      cardBody.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      cardBody.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      cardBody.querySelector('#tab-' + id).classList.add('active');
    }

    // Toggle Modo Oscuro
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
    }
  </script>

<?php require_once 'includes/footer.php'; ?>