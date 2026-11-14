<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
      
      <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
          <a href="admin/index.php" style="background: #1e7a3e; color: #fff; font-weight: 600; border-color: #1e7a3e;">⚙️ Panel Admin</a>
        <?php endif; ?>
        <a href="logout.php" style="background: #c62828; color: #fff; border-color: #c62828;" title="Cerrar sesión">🚪 Salir (<?php echo htmlspecialchars(explode(' ', $_SESSION['usuario_nombre'])[0], ENT_QUOTES, 'UTF-8'); ?>)</a>
      <?php else: ?>
        <a href="login.php" style="background: #1e7a3e; color: #fff; font-weight: 600; border-color: #1e7a3e;">🔐 Ingresar</a>
      <?php endif; ?>
    </nav>
  </header>
