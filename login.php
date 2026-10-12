<?php
$titulo_pagina = "Salta de Mates – Ingresar";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $titulo_pagina; ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="login-bg">

  <div class="login-card">
    <h1>Salta de Mates</h1>
    <input type="text" placeholder="Usuario" />
    <input type="password" placeholder="Contraseña" />
    <button onclick="window.location='index.php'">Ingresar</button>
  </div>

</body>
</html>