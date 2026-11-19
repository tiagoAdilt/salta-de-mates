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

// Carga dinámica de lugares desde MySQL (Persistencia Hito 2)
$lugares_db = [];
$origen_datos = "estatico";

if (file_exists(__DIR__ . '/config/conexion.php')) {
    try {
        require_once __DIR__ . '/config/conexion.php';
        $stmt = $pdo->query("SELECT * FROM lugares ORDER BY id ASC");
        $lugares_db = $stmt->fetchAll();
        if (!empty($lugares_db)) {
            $origen_datos = "mysql";
        }
    } catch (\Exception $e) {
        $lugares_db = [];
    }
}

require_once 'includes/header.php';
?>

  <div class="page-hero">
    <h1>🧉 Salta de Mates</h1>
    <p>Los mejores rincones de la provincia de Salta para disfrutar de un buen mate al aire libre.</p>
  </div>

  <main class="container">

    <!-- BARRA SUPERIOR: MODO OSCURO Y ACCESO A ADMIN -->
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px; gap: 10px;">
      <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
        <a href="admin/index.php" style="background: #1e7a3e; color: #fff; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
          ⚙️ Administrar Lugares (CRUD)
        </a>
      <?php endif; ?>
      <button id="dark-toggle" onclick="toggleDarkMode()" style="background:#333; color:#fff; border:none; padding:8px 16px; border-radius:20px; cursor:pointer; font-weight:600;">
        🌙 Modo Oscuro
      </button>
    </div>

    <h2 class="section-title">📍 Lugares Destacados</h2>
    <p>Explorá nuestra selección de los mejores spots mateadores en Salta.</p>

    <div class="grid-lugares">

      <?php if (!empty($lugares_db)): ?>
        <!-- RENDER DINÁMICO DESDE BASE DE DATOS MYSQL -->
        <?php foreach ($lugares_db as $indice => $item): ?>
          <?php 
            $img_archivo = !empty($item['imagen']) ? $item['imagen'] : 'cerro.jpg';
            $img_src = (strpos($img_archivo, 'http') === 0) ? $img_archivo : 'img/' . $img_archivo;
            // Generar URL de Google Maps a partir de la ubicación
            $maps_query = urlencode($item['nombre'] . ', ' . $item['ubicacion'] . ', Salta, Argentina');
            $maps_url = 'https://www.google.com/maps/search/?api=1&query=' . $maps_query;
            $card_id = 'card-' . $item['id'];
          ?>
          <article class="place-card">
            <!-- CABECERA CLICKEABLE PARA DESPLEGAR -->
            <div class="place-card-header" onclick="toggleCard('<?= $card_id ?>')" style="cursor:pointer; position:relative;">
              <img src="<?= htmlspecialchars($img_src, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?>" onerror="this.src='img/cerro.jpg';" />
              <div class="place-card-title-bar" style="display:flex; justify-content:space-between; align-items:center; padding: 12px 16px; background:#fff;">
                <h3 style="margin:0; font-size:1rem;"><?= ($indice + 1) ?>. <?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></h3>
                <span class="toggle-icon" id="icon-<?= $card_id ?>" style="font-size:1.2rem; transition: transform 0.3s;">▼</span>
              </div>
            </div>

            <!-- CONTENIDO DESPLEGABLE -->
            <div class="place-card-body" id="<?= $card_id ?>" style="display:none; overflow:hidden; transition: all 0.3s ease;">
              <p><strong>📍 Ubicación:</strong> <?= htmlspecialchars($item['ubicacion'], ENT_QUOTES, 'UTF-8') ?></p>
              <p><?= htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8') ?></p>

              <div class="tabs-container">
                <div class="tab-buttons">
                  <button class="tab-btn active" onclick="cambiarTab(this, 'historia-<?= $item['id'] ?>')">Historia</button>
                  <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-<?= $item['id'] ?>')">Ubicación</button>
                </div>
                <div id="tab-historia-<?= $item['id'] ?>" class="tab-panel active">
                  <p><?= htmlspecialchars(!empty($item['historia']) ? $item['historia'] : 'Sin información histórica adicional registrada.', ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div id="tab-ubicacion-<?= $item['id'] ?>" class="tab-panel">
                  <p><?= htmlspecialchars($item['ubicacion'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
              </div>

              <!-- BOTÓN GOOGLE MAPS -->
              <a href="<?= htmlspecialchars($maps_url, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"
                 style="display:inline-flex; align-items:center; gap:8px; margin-top:14px; background:#1e7a3e; color:#fff; padding:9px 18px; border-radius:20px; text-decoration:none; font-weight:600; font-size:0.88rem;">
                🗺️ Ver en Google Maps
              </a>
            </div>
          </article>
        <?php endforeach; ?>

      <?php else: ?>
        <!-- FALLBACK ESTÁTICO (SI AÚN NO SE HA INICIADO MYSQL) -->

        <!-- LUGAR 1 -->
        <article class="place-card">
          <img src="img/cerro.jpg" alt="Cerro San Bernardo" />
          <div class="place-card-body">
            <h3>1. Cerro San Bernardo</h3>
            <p><strong>Ubicación:</strong> Salta Capital</p>
            <p>Vista panorámica de toda la ciudad desde la cima. Ideal para ir al atardecer.</p>
            <div class="tabs-container">
              <div class="tab-buttons">
                <button class="tab-btn active" onclick="cambiarTab(this, 'historia-1')">Historia</button>
                <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-1')">Ubicación</button>
              </div>
              <div id="tab-historia-1" class="tab-panel active">
                <p>El cerro tutelar de la ciudad, con su viacrucis y vegetación autóctona.</p>
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
            <p><strong>Ubicación:</strong> Centro Histórico, Salta Capital</p>
            <p>Rodeada de recovas coloniales, la Catedral y el Cabildo. Corazón de la ciudad.</p>
            <div class="tabs-container">
              <div class="tab-buttons">
                <button class="tab-btn active" onclick="cambiarTab(this, 'historia-2')">Historia</button>
                <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-2')">Ubicación</button>
              </div>
              <div id="tab-historia-2" class="tab-panel active">
                <p>Fundada en 1582, testigo de los principales hechos históricos de la provincia.</p>
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
            <p><strong>Ubicación:</strong> Zona Norte, Salta Capital</p>
            <p>Gran espacio verde con laguna artificial, caminerías y zonas de césped para reposeras.</p>
            <div class="tabs-container">
              <div class="tab-buttons">
                <button class="tab-btn active" onclick="cambiarTab(this, 'historia-3')">Historia</button>
                <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-3')">Ubicación</button>
              </div>
              <div id="tab-historia-3" class="tab-panel active">
                <p>Inaugurado en 2015 como el pulmón verde más grande de la zona norte.</p>
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
            <p><strong>Ubicación:</strong> San Lorenzo (a 12 km de la Capital)</p>
            <p>Reserva natural con arroyo de montaña y vegetación de yunga salteña.</p>
            <div class="tabs-container">
              <div class="tab-buttons">
                <button class="tab-btn active" onclick="cambiarTab(this, 'historia-4')">Historia</button>
                <button class="tab-btn" onclick="cambiarTab(this, 'ubicacion-4')">Ubicación</button>
              </div>
              <div id="tab-historia-4" class="tab-panel active">
                <p>Tradicional villa veraniega salteña con microclima fresco todo el año.</p>
              </div>
              <div id="tab-ubicacion-4" class="tab-panel">
                <p>Al final de la Av. San Martín en la villa de San Lorenzo.</p>
              </div>
            </div>
          </div>
        </article>

      <?php endif; ?>

    </div>

  </main>

  <script>
    // Toggle despliegue de tarjeta
    function toggleCard(id) {
      const body = document.getElementById(id);
      const icon = document.getElementById('icon-' + id);
      if (body.style.display === 'none' || body.style.display === '') {
        body.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
      } else {
        body.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
      }
    }

    // Cambio de pestañas en tarjetas
    function cambiarTab(btn, id) {
      const cardBody = btn.closest('.place-card-body');
      cardBody.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      cardBody.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      const targetPanel = cardBody.querySelector('#tab-' + id);
      if (targetPanel) {
        targetPanel.classList.add('active');
      }
    }

    // Toggle Modo Oscuro
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
    }
  </script>

<?php require_once 'includes/footer.php'; ?>
