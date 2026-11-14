<?php
/**
 * Módulo de Autenticación / Inicio de Sesión
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

session_start();

// Si ya tiene una sesión iniciada, redirigir al panel admin
if (isset($_SESSION['usuario_id'])) {
    header('Location: admin/index.php');
    exit;
}

$error = "";
$usuario_input = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/conexion.php';

    $usuario_input = trim($_POST['usuario'] ?? '');
    $password      = trim($_POST['password'] ?? '');

    if (empty($usuario_input) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        // Consulta Preparada para buscar el usuario por nombre de usuario o por email
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :user OR email = :user LIMIT 1");
        $stmt->execute([':user' => $usuario_input]);
        $usuario = $stmt->fetch();

        // Verificación segura de contraseña hasheada
        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id']     = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_login']  = $usuario['usuario'];
            $_SESSION['usuario_rol']    = $usuario['rol'];

            header('Location: admin/index.php');
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}

$titulo_pagina = "Salta de Mates – Iniciar Sesión";
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
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 0.88rem;
      border: 1px solid #ffcdd2;
    }
    .credenciales-demo {
      margin-top: 15px;
      background: #edf7f0;
      color: #1e7a3e;
      padding: 10px;
      border-radius: 8px;
      font-size: 0.82rem;
      line-height: 1.4;
      text-align: left;
      border: 1px solid #c8ecd4;
    }
  </style>
</head>
<body class="login-bg">

  <div class="login-card">
    <h1>🧉 Salta de Mates</h1>
    <p style="color: #666; font-size: 0.9rem; margin-bottom: 20px;">Acceso al Panel de Administración</p>

    <?php if (!empty($error)): ?>
      <div class="login-error">
        ⚠️ <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
      </div>
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
      <button type="submit">Ingresar al Panel</button>
    </form>

    <div class="credenciales-demo">
      <strong>🔑 Datos de acceso para la demo:</strong><br>
      • Usuario: <code>tiago</code> o <code>admin</code><br>
      • Contraseña: <code>admin123</code>
    </div>

    <p style="margin-top: 20px; font-size: 0.88rem; color: #555;">
      ¿No tienes cuenta? <a href="registro.php" style="color: #1e7a3e; font-weight: 600; text-decoration: none;">Regístrate aquí</a>
    </p>

    <p style="margin-top: 10px; font-size: 0.85rem;">
      <a href="index.php" style="color: #888; text-decoration: none;">← Volver al sitio público</a>
    </p>
  </div>

</body>
</html>
