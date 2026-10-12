<?php
if (!isset($titulo_pagina)) {
    $titulo_pagina = "Salta de Mates | Turismo y Mate en Salta";
}
?>
<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $titulo_pagina; ?></title>
  <meta name="description" content="Descubri los mejores lugares para tomar mate en Salta Argentina." />
  <meta name="keywords" content="turismo salta, lugares para tomar mate en salta, salta argentina" />
  <meta name="author" content="Enriquez Tiago" />
  <meta name="robots" content="index, follow" />
  <link rel="stylesheet" href="style.css" />
  <?php if (isset($extra_styles)) { echo $extra_styles; } ?>
</head>
<body id="body-root">

  <!-- RELOJ EN TIEMPO REAL -->
  <div class="reloj-bar" id="reloj-bar"></div>

  <header class="site-header">
    <div>Salta de Mates</div>
    <nav aria-label="Navegacion principal">
      <a href="index.php">Lugares</a>
      <a href="curso.php">Curso</a>
      <a href="blog.php">Blog</a>
      <a href="cv.php">CV</a>
      <a href="faq.php">FAQ</a>
      <a href="quienes-somos.php">Quienes Somos</a>
      <a href="contacto.php">Contacto</a>
    </nav>
  </header>