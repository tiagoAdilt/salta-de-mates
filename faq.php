<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Preguntas Frecuentes – Salta de Mates</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .acordeon-item {
      background: #fff;
      border-radius: 12px;
      margin-bottom: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,.08);
      overflow: hidden;
    }
    .acordeon-btn {
      width: 100%;
      background: none;
      border: none;
      padding: 18px 22px;
      text-align: left;
      font-size: 1rem;
      font-weight: 700;
      color: #1e7a3e;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background .2s;
    }
    .acordeon-btn:hover { background: #edf7f0; }
    .acordeon-btn .icono { font-size: 1.2rem; transition: transform .3s; }
    .acordeon-btn.abierto .icono { transform: rotate(180deg); }
    .acordeon-contenido {
      display: none;
      padding: 0 22px 18px;
      font-size: .92rem;
      color: #555;
      line-height: 1.7;
    }
    .acordeon-contenido.abierto { display: block; }
    .reloj-bar {
      background: #1e7a3e;
      color: #fff;
      text-align: center;
      padding: 8px;
      font-size: .88rem;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="reloj-bar" id="reloj-bar"></div>

  <header class="site-header">
    <div>Salta de Mates</div>
    <nav aria-label="Navegación principal">
      <a href="index.html">Lugares</a>
      <a href="curso.html">Curso</a>
      <a href="blog.html">Blog</a>
      <a href="cv.html">CV</a>
      <a href="faq.html">FAQ</a>
      <a href="quienes-somos.html">Quiénes Somos</a>
      <a href="contacto.html">Contacto</a>
    </nav>
  </header>

  <div class="page-hero">
    <h1>❓ Preguntas Frecuentes</h1>
    <p>Las dudas más comunes de los mateadores viajeros.</p>
  </div>

  <main class="container">

    <h1>Preguntas Frecuentes</h1>
    <p>Si no encontrás tu respuesta acá, escribinos a <strong>hola@saltademates.com</strong>.</p>

    <h2>Sobre los lugares</h2>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Los lugares son de acceso gratuito?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        La mayoría de los spots que recomendamos son gratuitos (plazas, parques, miradores). Algunos como el teleférico del Cerro San Bernardo tienen un costo de entrada.
      </div>
    </div>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Puedo ir solo o es mejor ir en grupo?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Podés ir de las dos formas. Solo: ideal para spots tranquilos como la costanera o el MAC. En grupo: la plaza Güemes y las reservas naturales son mejores con compañía.
      </div>
    </div>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Cuál es la mejor época para visitar los lugares?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Otoño (marzo–mayo) e invierno (junio–agosto) son las mejores estaciones. El clima es fresco, perfecto para el mate, y hay menos turistas.
      </div>
    </div>

    <h2>Sobre el mate</h2>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Qué yerba recomiendan para llevar de viaje?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Las yerbas serranas de Salta como la de muña muña o cedrón son las más populares. Conseguilas en el Mercado Artesanal de Balcarce.
      </div>
    </div>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Puedo tomar mate en todos los lugares públicos?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Sí, en Salta el mate en espacios públicos es completamente normal y aceptado. En algunos museos y sitios culturales cerrados puede estar restringido.
      </div>
    </div>

    <h2>Sobre el sitio</h2>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Quién desarrolló este sitio?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Salta de Mates fue creado por Enriquez Tiago como parte del Trabajo Práctico de la materia Adaptación al Ambiente del Trabajo, 4°3° TM CS.
      </div>
    </div>

    <div class="acordeon-item">
      <button class="acordeon-btn" onclick="toggleAcordeon(this)">
        ¿Cómo puedo sugerir un lugar nuevo?
        <span class="icono">▼</span>
      </button>
      <div class="acordeon-contenido">
        Escribinos a hola@saltademates.com con el nombre del lugar, su dirección y una breve descripción. ¡Lo evaluamos y lo sumamos al mapa!
      </div>
    </div>

  </main>

  <hr class="footer-line" />
  <footer class="site-footer">
    <p>© 2025 Salta de Mates · Enriquez Tiago · 4°3° TM CS</p>
    <nav aria-label="Navegación del pie de página">
      <a href="index.html">Inicio</a> |
      <a href="quienes-somos.html">Quiénes Somos</a> |
      <a href="blog.html">Blog</a>
    </nav>
  </footer>

  <script>
    // PUNTO 4 — Acordeón
    function toggleAcordeon(btn) {
      const contenido = btn.nextElementSibling;
      const estaAbierto = contenido.classList.contains('abierto');
      document.querySelectorAll('.acordeon-contenido').forEach(c => c.classList.remove('abierto'));
      document.querySelectorAll('.acordeon-btn').forEach(b => b.classList.remove('abierto'));
      if (!estaAbierto) {
        contenido.classList.add('abierto');
        btn.classList.add('abierto');
      }
    }

    // PUNTO 3 — Reloj
    function actualizarReloj() {
      const ahora = new Date();
      const fecha = ahora.toLocaleDateString('es-AR', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
      const hora = ahora.toLocaleTimeString('es-AR');
      document.getElementById('reloj-bar').textContent = '📅 ' + fecha + '  |  🕐 ' + hora;
    }
    actualizarReloj();
    setInterval(actualizarReloj, 1000);
  </script>

</body>
</html>