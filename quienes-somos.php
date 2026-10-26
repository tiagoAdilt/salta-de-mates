<?php
$titulo_pagina = "Quiénes Somos – Salta de Mates";
require_once 'includes/header.php';
?>

  <div class="page-hero">
    <h1>🧉 Quiénes Somos</h1>
    <p>Un proyecto que une el mate, el viaje y la identidad salteña.</p>
  </div>

  <main class="container">

    <h1>Quiénes Somos</h1>
    <p>
      Salta de Mates nació de la idea de compartir los mejores rincones de Salta
      para disfrutar de un buen mate. Somos un proyecto estudiantil que celebra
      la cultura mateira del noroeste argentino.
    </p>

    <div class="card-blanco">
      <h2>Nuestra misión</h2>
      <p>
        Mostrar los lugares más tranquilos, hermosos y accesibles de Salta
        para que locales y turistas puedan disfrutar el ritual del mate en
        entornos únicos.
      </p>
    </div>

    <div class="card-blanco">
      <h2>Nuestra visión</h2>
      <p>
        Ser el mapa de referencia digital para los mateadores viajeros que
        visitan el noroeste argentino, destacando la identidad cultural y los
        paisajes locales.
      </p>
    </div>

    <div class="card-blanco">
      <h2>Nuestros valores</h2>
      <h3>Autenticidad</h3>
      <p>Solo recomendamos lugares que conocemos y en los que realmente tomaríamos unos mates.</p>
      <h3>Comunidad</h3>
      <p>Apoyamos los espacios públicos y culturales que construyen identidad colectiva.</p>
      <h3>Simplicidad</h3>
      <p>El mate es simple. Nuestro sitio también: fácil de usar, claro y directo.</p>
    </div>

    <div class="card-blanco">
      <h2>El equipo</h2>
      <p>Este proyecto fue desarrollado por:</p>

      <div class="team-grid">
        <div class="team-card">
          <div class="av">🧑‍💻</div>
          <h3>Enriquez Tiago</h3>
          <p>Diseñador y desarrollador web. Estudiante de 4°3° TM CS.</p>
        </div>
        <div class="team-card">
          <div class="av">🏫</div>
          <h3>E.E.T N° 3139</h3>
          <p>Gral. M.M. de Güemes, Salta Capital.</p>
        </div>
        <div class="team-card">
          <div class="av">📚</div>
          <h3>TP4 — Adaptación al Ambiente</h3>
          <p>Desarrollo web dinámico con PHP y Apache.</p>
        </div>
      </div>
    </div>

    <div class="card-blanco">
      <h2>Historia del proyecto</h2>
      <h3>TP1 — Wireframes</h3>
      <p>Bocetos en papel con la estructura inicial del sitio: login, home con grilla de lugares y modal de detalle.</p>
      <h3>TP2 — Mockups en Figma</h3>
      <p>Diseño de alta fidelidad con la paleta verde, tipografía y componentes interactivos. Se definieron las 10 tarjetas de lugares con sus tabs de Historia, Comentarios y Ubicación.</p>
      <h3>TP3 — Desarrollo en HTML y CSS</h3>
      <p>Implementación del sitio completo respetando el diseño de Figma, con las secciones del trabajo práctico: encabezados, curso en línea, blog, CV, FAQ y Quiénes Somos.</p>
      <h3>TP4 — Migración a PHP y SSI</h3>
      <p>Modularización con Server-Side Includes en Apache/XAMPP, configuración de entorno `.env` y control de versiones con Git.</p>

      <h3>Contacto</h3>
      <p>
        📧 hola@saltademates.com<br>
        📍 Salta, Argentina<br>
        🕐 Lunes a Viernes, 09:00–18:00 hs.
      </p>
    </div>

  </main>

<?php require_once 'includes/footer.php'; ?>