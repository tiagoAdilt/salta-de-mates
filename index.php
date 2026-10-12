<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Turismo Salta | Mejores lugares para tomar mate en Salta Argentina</title>
  <meta name="description" content="Descubri los mejores lugares para tomar mate en Salta Argentina. Plazas, parques, miradores y rincones unicos del noroeste argentino." />
  <meta name="keywords" content="turismo salta, lugares para tomar mate en salta, que hacer en salta, salta argentina turismo" />
  <meta name="author" content="Enriquez Tiago" />
  <meta name="robots" content="index, follow" />
  <link rel="stylesheet" href="style.css" />
  <style>
    /* MODO OSCURO */
    .dark-mode {
      background: #1a1a2e !important;
      color: #e0e0e0 !important;
    }
    .dark-mode .site-header { background: #16213e !important; }
    .dark-mode .place-card { background: #16213e !important; color: #e0e0e0 !important; }
    .dark-mode .place-card-footer { color: #e0e0e0 !important; }
    .dark-mode .contacto-box { background: #16213e !important; }
    .dark-mode .site-footer { background: #0f3460 !important; }
    .dark-mode pre.codigo { background: #0f3460 !important; }
    .dark-mode h2.section-title { color: #a8f0c0 !important; }
    .dark-mode p { color: #ccc !important; }

    /* TOGGLE MODO OSCURO */
    .dark-toggle {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #1e7a3e;
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 12px 20px;
      font-size: .9rem;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(0,0,0,.25);
      z-index: 999;
      transition: background .2s;
    }
    .dark-toggle:hover { background: #2e9e52; }

    /* GALERIA */
    .galeria-section {
      background: #fff;
      border-radius: 16px;
      padding: 24px;
      margin-top: 30px;
      box-shadow: 0 4px 18px rgba(0,0,0,.08);
    }
    .dark-mode .galeria-section { background: #16213e !important; }
    .galeria-section h2 { color: #1e7a3e; margin-bottom: 16px; }

    .galeria-contenedor {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      max-height: 340px;
    }

    .galeria-img {
      width: 100%;
      height: 340px;
      object-fit: cover;
      border-radius: 12px;
      display: none;
      transition: opacity .3s;
    }
    .galeria-img.activa { display: block; }

    .galeria-caption {
      text-align: center;
      font-weight: 600;
      color: #1e7a3e;
      margin: 12px 0 8px;
      font-size: 1rem;
    }

    .galeria-controles {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 16px;
      margin-top: 10px;
    }

    .btn-galeria {
      background: #1e7a3e;
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 10px 24px;
      font-size: .92rem;
      font-weight: 700;
      cursor: pointer;
      transition: background .2s;
    }
    .btn-galeria:hover { background: #2e9e52; }

    .galeria-contador {
      font-size: .88rem;
      color: #555;
      font-weight: 600;
    }
    .dark-mode .galeria-contador { color: #ccc !important; }

    /* RELOJ */
    .reloj-bar {
      background: #1e7a3e;
      color: #fff;
      text-align: center;
      padding: 8px;
      font-size: .88rem;
      font-weight: 600;
    }

    .place-card-img {
      height: 180px;
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: flex-end;
      border-radius: 14px 14px 0 0;
      overflow: hidden;
    }
  </style>
</head>
<body id="body-root">

  <!-- RELOJ EN TIEMPO REAL Punto 3 -->
  <div class="reloj-bar" id="reloj-bar"></div>

  <header class="site-header">
    <div>Salta de Mates</div>
    <nav aria-label="Navegacion principal">
      <a href="index.html">Lugares</a>
      <a href="curso.html">Curso</a>
      <a href="blog.html">Blog</a>
      <a href="cv.html">CV</a>
      <a href="faq.html">FAQ</a>
      <a href="quienes-somos.html">Quienes Somos</a>
      <a href="contacto.html">Contacto</a>
    </nav>
  </header>

  <section class="hero" aria-label="Presentacion del sitio Salta de Mates">
    <p class="hero-eyebrow">Turismo en Salta</p>
    <h1>Descubri los mejores lugares para compartir unos mates en Salta</h1>
    <p>Paisajes unicos, rincones tranquilos y experiencias inolvidables en Salta Argentina.</p>
  </section>

  <main class="container">

    <h2 class="section-title">Lugares para tomar mate en Salta</h2>

    <p>
      Explora los mejores rincones de Salta para tomar unos mates con amigos o
      en familia. Hace clic en cualquier tarjeta para conocer su historia,
      comentarios y ubicacion.
    </p>
    <br>
    <p>
      Cada lugar fue seleccionado por su paisaje, tranquilidad y ambiente unico.
      Encontra tu proximo rincon favorito en Salta Argentina!
    </p>

    <pre class="codigo" aria-label="Datos utiles sobre Salta">
Ciudad          : Salta Capital, Argentina
Clima promedio  : 18 C
Mejor epoca     : Abril - Octubre
    </pre>

    <div class="places-grid" role="list" aria-label="Lista de lugares turisticos">

      <div class="place-card" role="listitem" onclick="abrirModal(1)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(1)" aria-label="Ver detalles del Monumento Guemes">
        <img src="guemes.jpg" alt="Monumento al General Martin Miguel de Guemes en Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Monumento Guemes <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(2)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(2)" aria-label="Ver detalles del Mirador del Portezuelo">
        <img src="portezuelo.jpg" alt="Vista panoramica desde el Mirador del Portezuelo en Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Mirador del Portezuelo <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(3)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(3)" aria-label="Ver detalles de la Plaza 9 de Julio">
        <img src="plaza9dejulio.jpg" alt="Plaza 9 de Julio con la Catedral de Salta al fondo" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Plaza 9 de Julio <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(4)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(4)" aria-label="Ver detalles de la Quebrada de San Lorenzo">
        <img src="sanlorenzo.jpg" alt="Sendero natural en la Quebrada de San Lorenzo, Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Quebrada de San Lorenzo <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(5)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(5)" aria-label="Ver detalles del Cerro San Bernardo">
        <img src="cerro.jpg" alt="Vista del Cerro San Bernardo con la ciudad de Salta al fondo" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Cerro San Bernardo <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(6)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(6)" aria-label="Ver detalles de la Plaza de la Legislatura">
        <img src="legislatura.jpg" alt="Plaza frente a la Legislatura de Salta con arboles y jardines" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Plaza de la Legislatura <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(7)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(7)" aria-label="Ver detalles de la Plaza España">
        <img src="plaza.jpg" alt="Fuente central y jardines de la Plaza España en Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Plaza España <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(8)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(8)" aria-label="Ver detalles de la Plaza de la Paludica">
        <img src="paludica.png" alt="Plaza de la Paludica, rincon tranquilo del barrio en Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Plaza de la Paludica <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(9)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(9)" aria-label="Ver detalles del Parque Bicentenario">
        <img src="bicentenario.jpg" alt="Lago artificial y areas verdes del Parque Bicentenario de Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Parque Bicentenario <span aria-hidden="true">→</span></div>
      </div>

      <div class="place-card" role="listitem" onclick="abrirModal(10)" tabindex="0" onkeypress="if(event.key==='Enter') abrirModal(10)" aria-label="Ver detalles del Parque Sur">
        <img src="parquesur.jpg" alt="Senderos arbolados y zonas verdes del Parque Sur en Salta" style="object-fit:cover;width:100%;height:180px;border-radius:14px 14px 0 0;" />
        <div class="place-card-footer">Parque Sur <span aria-hidden="true">→</span></div>
      </div>

    </div>

    <!-- GALERIA Punto 5 -->
    <div class="galeria-section">
      <h2>Galeria de Lugares</h2>
      <div class="galeria-contenedor">
        <img src="guemes.jpg"       alt="Monumento Guemes"           class="galeria-img activa" />
        <img src="portezuelo.jpg"   alt="Mirador del Portezuelo"     class="galeria-img" />
        <img src="plaza9dejulio.jpg" alt="Plaza 9 de Julio"          class="galeria-img" />
        <img src="sanlorenzo.jpg"   alt="Quebrada de San Lorenzo"    class="galeria-img" />
        <img src="cerro.jpg"        alt="Cerro San Bernardo"         class="galeria-img" />
        <img src="legislatura.jpg"  alt="Plaza de la Legislatura"    class="galeria-img" />
        <img src="plaza.jpg"        alt="Plaza España"               class="galeria-img" />
        <img src="paludica.png"     alt="Plaza de la Paludica"       class="galeria-img" />
        <img src="bicentenario.jpg" alt="Parque Bicentenario"        class="galeria-img" />
        <img src="parquesur.jpg"    alt="Parque Sur"                 class="galeria-img" />
      </div>
      <div class="galeria-caption" id="galeria-caption">Monumento Guemes</div>
      <div class="galeria-controles">
        <button class="btn-galeria" onclick="galeriaAnterior()">← Anterior</button>
        <span class="galeria-contador" id="galeria-contador">1 / 10</span>
        <button class="btn-galeria" onclick="galeriaSiguiente()">Siguiente →</button>
      </div>
    </div>

    <div class="contacto-box">
      <h3>Contacto</h3>
      <p>
        Numero de telefono: (0387) 421-0000<br>
        Email: hola@saltademates.com
      </p>
    </div>

  </main>

  <hr class="footer-line" />
  <footer class="site-footer">
    <p>2025 Salta de Mates - Enriquez Tiago - 4 3 TM CS</p>
    <nav aria-label="Navegacion del pie de pagina">
      <a href="faq.html">Preguntas Frecuentes</a> |
      <a href="quienes-somos.html">Quienes Somos</a> |
      <a href="blog.html">Blog</a>
    </nav>
  </footer>

  <!-- BOTON MODO OSCURO Punto 6 -->
  <button class="dark-toggle" id="dark-toggle" onclick="toggleDarkMode()">Modo Oscuro</button>

  <!-- MODAL -->
  <div class="modal-overlay" id="modal" onclick="cerrarModalFuera(event)" role="dialog" aria-modal="true" aria-labelledby="modal-titulo">
    <div class="modal">
      <div class="modal-topbar">
        <h3 id="modal-titulo">Lugar</h3>
        <button class="btn-cerrar" onclick="cerrarModal()" aria-label="Cerrar modal">Cerrar</button>
      </div>
      <div class="modal-body">
        <div class="modal-img" id="modal-img" role="img" aria-label="Imagen del lugar seleccionado"></div>
        <div class="modal-content">
          <div class="modal-tabs" role="tablist">
            <button class="tab-btn active" onclick="cambiarTab(this,'historia')" role="tab" aria-selected="true">Historia</button>
            <button class="tab-btn" onclick="cambiarTab(this,'comentarios')" role="tab" aria-selected="false">Comentarios</button>
            <button class="tab-btn" onclick="cambiarTab(this,'ubicacion')" role="tab" aria-selected="false">Ubicacion</button>
          </div>
          <div class="tab-panel active" id="tab-historia" role="tabpanel"><p id="txt-historia"></p></div>
          <div class="tab-panel" id="tab-comentarios" role="tabpanel"><p id="txt-comentarios"></p></div>
          <div class="tab-panel" id="tab-ubicacion" role="tabpanel">
            <p id="txt-ubicacion"></p>
            <a id="link-maps" href="#" target="_blank" aria-label="Ver ubicacion en Google Maps" style="display:inline-block;margin-top:10px;background:#2a9148;color:#fff;padding:7px 16px;border-radius:20px;text-decoration:none;font-size:.85rem;font-weight:600;">Ver en Google Maps</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // PUNTO 1 - Saludo al cargar la pagina
    window.onload = function() {
      var hora = new Date().getHours();
      var saludo;
      if (hora >= 6 && hora < 12) saludo = 'Buenos dias';
      else if (hora >= 12 && hora < 19) saludo = 'Buenas tardes';
      else saludo = 'Buenas noches';
      alert(saludo + '! Bienvenido a Salta de Mates. Descubri los mejores lugares para tomar mate en Salta.');
    };

    // PUNTO 3 - Reloj en tiempo real
    function actualizarReloj() {
      var ahora = new Date();
      var fecha = ahora.toLocaleDateString('es-AR', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
      var hora = ahora.toLocaleTimeString('es-AR');
      document.getElementById('reloj-bar').textContent = 'Fecha: ' + fecha + '  |  Hora: ' + hora;
    }
    actualizarReloj();
    setInterval(actualizarReloj, 1000);

    // PUNTO 5 - Galeria de imagenes
    var galeriaIndex = 0;
    var nombres = ['Monumento Guemes','Mirador del Portezuelo','Plaza 9 de Julio','Quebrada de San Lorenzo','Cerro San Bernardo','Plaza de la Legislatura','Plaza España','Plaza de la Paludica','Parque Bicentenario','Parque Sur'];

    function actualizarGaleria() {
      var imgs = document.querySelectorAll('.galeria-img');
      imgs.forEach(function(img, i) {
        img.classList.toggle('activa', i === galeriaIndex);
      });
      document.getElementById('galeria-caption').textContent = nombres[galeriaIndex];
      document.getElementById('galeria-contador').textContent = (galeriaIndex + 1) + ' / ' + imgs.length;
    }

    function galeriaSiguiente() {
      var total = document.querySelectorAll('.galeria-img').length;
      galeriaIndex = (galeriaIndex + 1) % total;
      actualizarGaleria();
    }

    function galeriaAnterior() {
      var total = document.querySelectorAll('.galeria-img').length;
      galeriaIndex = (galeriaIndex - 1 + total) % total;
      actualizarGaleria();
    }

    // PUNTO 6 - Modo oscuro
    function toggleDarkMode() {
      var body = document.getElementById('body-root');
      var btn = document.getElementById('dark-toggle');
      body.classList.toggle('dark-mode');
      if (body.classList.contains('dark-mode')) {
        btn.textContent = 'Modo Claro';
      } else {
        btn.textContent = 'Modo Oscuro';
      }
    }

    // DATOS DE LUGARES
    var datos = [
      { nombre:'Monumento Guemes', img:'guemes.jpg', historia:'El Monumento al Gral. Martin Miguel de Guemes es uno de los simbolos mas importantes de Salta. Inaugurado en 1931, rinde homenaje al heroe gaucho defensor de la patria.', comentarios:'5 estrellas - Un lugar emblematico, ideal para conocer la historia saltenia. - Martina R.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/search/monumento+guemes+/@-24.7867766,-65.4027947,17z' },
      { nombre:'Mirador del Portezuelo', img:'portezuelo.jpg', historia:'El Mirador del Portezuelo ofrece una de las vistas mas espectaculares de la ciudad de Salta desde las alturas.', comentarios:'5 estrellas - La mejor vista de Salta, imperdible. - Diego F.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Salta-Mirador/@-24.798651,-65.390097,17z' },
      { nombre:'Plaza 9 de Julio', img:'plaza9dejulio.jpg', historia:'La Plaza 9 de Julio es el corazon de Salta. Fundada en 1582, esta rodeada por la Catedral, el Cabildo y edificios coloniales.', comentarios:'5 estrellas - El alma de Salta. Siempre hay vida aca. - Romina L.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Plaza+9+de+Julio/@-24.7892135,-65.4128588,17z' },
      { nombre:'Quebrada de San Lorenzo', img:'sanlorenzo.jpg', historia:'La Quebrada de San Lorenzo es una reserva natural a pocos kilometros de la ciudad.', comentarios:'5 estrellas - Naturaleza pura, el silencio es increible. - Camila T.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Quebrada+de+San+Lorenzo/@-24.7226759,-65.5073255,17z' },
      { nombre:'Cerro San Bernardo', img:'cerro.jpg', historia:'El Cerro San Bernardo domina el horizonte de Salta con sus 1.454 metros. Se puede subir en teleferico o por la escalinata de 1.070 escalones.', comentarios:'5 estrellas - La vista desde arriba es increible. - Florencia N.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Cerro+San+Bernardo/@-24.7892723,-65.4059871,15z' },
      { nombre:'Plaza de la Legislatura', img:'legislatura.jpg', historia:'La Plaza frente a la Legislatura de Salta es un espacio verde tranquilo en pleno centro.', comentarios:'4 estrellas - Muy tranquila, perfecta para leer y tomar mates. - Maria G.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Feria+de+artesanos+de+la+Plaza+de+la+Legislatura/@-24.783012,-65.4166082,17z' },
      { nombre:'Plaza España', img:'plaza.jpg', historia:'La Plaza España cuenta con una fuente central, bancos a la sombra y arquitectura de influencia española.', comentarios:'5 estrellas - La fuente y los arboles la hacen muy especial. - Claudia M.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Plaza+Espa%C3%B1a,+Salta/@-24.7790652,-65.4341038,17z' },
      { nombre:'Plaza de la Paludica', img:'paludica.png', historia:'La Plaza de la Paludica es un rincon tranquilo y pintoresco de Salta.', comentarios:'5 estrellas - Un lugar tranquilo y muy agradable, poco conocido. - Paula B.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Paludica/@-24.7877388,-65.407873,17z' },
      { nombre:'Parque Bicentenario', img:'bicentenario.jpg', historia:'El Parque Bicentenario fue inaugurado en 2010 con lago artificial, anfiteatro y extensas areas verdes.', comentarios:'5 estrellas - El lago artificial es hermoso. - Silvia R.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/search/Parque+Bicentenario/@-24.7322382,-65.4250266,16.5z' },
      { nombre:'Parque Sur', img:'parquesur.jpg', historia:'El Parque Sur es uno de los pulmones verdes de Salta, con senderos arbolados y areas de juego.', comentarios:'5 estrellas - Perfecto para ir con familia. - Paula B.', ubicacion:'Hace clic en el boton para ver la ubicacion exacta en Google Maps.', maps:'https://www.google.com/maps/place/Parque+SUR/@-24.8482788,-65.4409653,17z' }
    ];

    function abrirModal(n) {
      var d = datos[n-1];
      document.getElementById('modal-titulo').textContent = d.nombre;
      var modalImg = document.getElementById('modal-img');
      modalImg.style.backgroundImage = "url('" + d.img + "')";
      modalImg.style.backgroundSize = 'cover';
      modalImg.style.backgroundPosition = 'center';
      modalImg.setAttribute('aria-label', 'Imagen de ' + d.nombre);
      document.getElementById('txt-historia').textContent = d.historia;
      document.getElementById('txt-comentarios').textContent = d.comentarios;
      document.getElementById('txt-ubicacion').textContent = d.ubicacion;
      document.getElementById('link-maps').href = d.maps;
      document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); b.setAttribute('aria-selected','false'); });
      document.querySelectorAll('.tab-panel').forEach(function(p) { p.classList.remove('active'); });
      document.querySelectorAll('.tab-btn')[0].classList.add('active');
      document.querySelectorAll('.tab-btn')[0].setAttribute('aria-selected','true');
      document.getElementById('tab-historia').classList.add('active');
      document.getElementById('modal').classList.add('open');
    }

    function cerrarModal() { document.getElementById('modal').classList.remove('open'); }
    function cerrarModalFuera(e) { if(e.target.id==='modal') cerrarModal(); }

    function cambiarTab(btn, id) {
      document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); b.setAttribute('aria-selected','false'); });
      document.querySelectorAll('.tab-panel').forEach(function(p) { p.classList.remove('active'); });
      btn.classList.add('active');
      btn.setAttribute('aria-selected','true');
      document.getElementById('tab-'+id).classList.add('active');
    }

    document.addEventListener('keydown', function(e) {
      if(e.key === 'Escape') cerrarModal();
    });
  </script>

</body>
</html>