<?php
if (!($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout']))) {
    require_once 'config/session.php';
}

$titulo_pagina  = "Salta de Mates – Iniciar Sesión";
$error          = "";
$mensaje_info   = "";
$usuario_input  = "";

// Si ya tiene sesión iniciada, redirigir según su rol (salvo cuando viene por rol_insuficiente para mostrar el aviso)
if (isset($_SESSION['usuario_id']) && ($_GET['error'] ?? '') !== 'rol_insuficiente') {
    if (($_SESSION['usuario_rol'] ?? '') === 'admin') {
        header('Location: admin/index.php');
    } else {
        header('Location: index.php');
    }
    exit;
}

if (isset($_GET['error']) && $_GET['error'] === 'acceso_denegado') {
    $error = "Acceso restringido: Debes iniciar sesión para acceder a esa sección.";
} elseif (isset($_GET['error']) && $_GET['error'] === 'rol_insuficiente') {
    $error = "No tienes permisos de administrador para acceder a esa sección.";
} elseif (isset($_GET['logout'])) {
    $mensaje_info = "Has cerrado sesión correctamente.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/conexion.php';

    $usuario_input = trim($_POST['usuario'] ?? '');
    $password      = trim($_POST['password'] ?? '');

    if (empty($usuario_input) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :u1 OR email = :u2 LIMIT 1");
            $stmt->execute([':u1' => $usuario_input, ':u2' => $usuario_input]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($password, $usuario['password'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id']     = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_login']  = $usuario['usuario'];
                $_SESSION['usuario_rol']    = $usuario['rol'];
                $_SESSION['rol']            = $usuario['rol']; // clave exigida por el TP8

                if ($usuario['rol'] === 'admin') {
                    header('Location: admin/index.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } catch (\PDOException $e) {
            error_log('Login PDOException: ' . $e->getMessage());
            $error = "Error al procesar la autenticación. Intenta nuevamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($titulo_pagina, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .login-error {
      background: #ffebee;
      color: #c62828;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 0.88rem;
      border: 1px solid #ffcdd2;
      text-align: left;
    }
    .login-info {
      background: #e8f5e9;
      color: #2e7d32;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 0.88rem;
      border: 1px solid #c8ecd4;
      text-align: left;
    }
  </style>
</head>
<body class="login-bg">

  <div class="login-card">
    <h1>🧉 Salta de Mates</h1>
    <p style="color: #666; font-size: 0.9rem; margin-bottom: 20px;">Iniciar Sesión</p>

    <?php if (!empty($error)): ?>
      <div class="login-error">⚠️ <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php if (!empty($mensaje_info)): ?>
      <div class="login-info">👋 <?php echo htmlspecialchars($mensaje_info, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <input
        type="text"
        name="usuario"
        placeholder="Usuario o Email"
        value="<?php echo htmlspecialchars($usuario_input, ENT_QUOTES, 'UTF-8'); ?>"
        required
        autocomplete="username"
      />
      <input
        type="password"
        name="password"
        placeholder="Contraseña"
        required
        autocomplete="current-password"
      />
      <button type="submit">Ingresar</button>
    </form>

    <p style="margin-top: 20px; font-size: 0.88rem; color: #555;">
      ¿No tienes cuenta? <a href="registro.php" style="color: #1e7a3e; font-weight: 600; text-decoration: none;">Regístrate aquí</a>
    </p>
  </div>

</body>
</html>
