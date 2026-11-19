<?php
/**
 * Módulo de Registro de Usuarios
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

require_once 'includes/header.php';

// Si ya tiene sesión iniciada, redirigir
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$errores = [];
$nombre   = "";
$usuario  = "";
$email    = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/conexion.php';

    $nombre           = trim($_POST['nombre'] ?? '');
    $usuario          = trim($_POST['usuario'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');

    // 1. Validaciones
    if (empty($nombre) || empty($usuario) || empty($email) || empty($password)) {
        $errores[] = "Por favor, completa todos los campos obligatorios.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no tiene un formato válido.";
    }

    if (strlen($password) < 4) {
        $errores[] = "La contraseña debe tener al menos 4 caracteres.";
    }

    if ($password !== $password_confirm) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    // 2. Verificar que el usuario o email no existan previamente
    if (empty($errores)) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :u OR email = :e LIMIT 1");
        $stmt->execute([':u' => $usuario, ':e' => $email]);
        if ($stmt->fetch()) {
            $errores[] = "El nombre de usuario o correo electrónico ya está registrado.";
        }
    }

    // 3. Crear el nuevo usuario con contraseña encriptada (Bcrypt)
    if (empty($errores)) {
        try {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $rol = 'estudiante'; // Rol por defecto

            $sql = "INSERT INTO usuarios (nombre, usuario, email, password, rol) 
                    VALUES (:nombre, :usuario, :email, :password, :rol)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre'   => $nombre,
                ':usuario'  => $usuario,
                ':email'    => $email,
                ':password' => $password_hash,
                ':rol'      => $rol
            ]);

            // Iniciar sesión automáticamente
            $nuevo_id = $pdo->lastInsertId();
            $_SESSION['usuario_id']     = $nuevo_id;
            $_SESSION['usuario_nombre'] = $nombre;
            $_SESSION['usuario_login']  = $usuario;
            $_SESSION['usuario_rol']    = $rol;
            $_SESSION['rol']            = $rol; // clave exigida por el TP8
            session_regenerate_id(true);

            header('Location: index.php?status=bienvenido');
            exit;

        } catch (\PDOException $e) {
            $errores[] = "Error al registrar el usuario: " . $e->getMessage();
        }
    }
}

$titulo_pagina = "Crear Cuenta – Salta de Mates";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($titulo_pagina, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .registro-card {
      background: #ffffff;
      width: 90%;
      max-width: 440px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      text-align: center;
    }
    .registro-card h1 {
      color: #1e7a3e;
      font-size: 1.7rem;
      margin-bottom: 8px;
    }
    .registro-card input {
      width: 100%;
      padding: 11px 14px;
      margin-bottom: 12px;
      border: 1.5px solid #dcdcdc;
      border-radius: 8px;
      font-size: 0.95rem;
      box-sizing: border-box;
    }
    .registro-card input:focus {
      border-color: #1e7a3e;
      outline: none;
    }
    .registro-card button {
      width: 100%;
      padding: 12px;
      background: #1e7a3e;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 5px;
      transition: background 0.2s;
    }
    .registro-card button:hover {
      background: #15572c;
    }
    .alert-error {
      background: #ffebee;
      color: #c62828;
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 0.88rem;
      text-align: left;
      border: 1px solid #ffcdd2;
    }
  </style>
</head>
<body class="login-bg">

  <div class="registro-card">
    <h1>🧉 Salta de Mates</h1>
    <p style="color: #666; font-size: 0.9rem; margin-bottom: 20px;">Crea tu propia cuenta con tu contraseña personal</p>

    <?php if (!empty($errores)): ?>
      <div class="alert-error">
        <strong>⚠️ Atención:</strong>
        <ul style="margin: 5px 0 0 15px; padding: 0;">
          <?php foreach ($errores as $err): ?>
            <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="registro.php">
      <input 
        type="text" 
        name="nombre" 
        placeholder="Nombre completo (ej: Juan Pérez)" 
        value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>" 
        required 
      />
      <input 
        type="text" 
        name="usuario" 
        placeholder="Nombre de usuario (ej: juanp)" 
        value="<?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?>" 
        required 
        autocomplete="username"
      />
      <input 
        type="email" 
        name="email" 
        placeholder="Correo electrónico (ej: juan@email.com)" 
        value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" 
        required 
        autocomplete="email"
      />
      <input 
        type="password" 
        name="password" 
        placeholder="Tu contraseña personal" 
        required 
        autocomplete="new-password"
      />
      <input 
        type="password" 
        name="password_confirm" 
        placeholder="Repetir tu contraseña" 
        required 
        autocomplete="new-password"
      />
      <button type="submit">Crear Mi Cuenta</button>
    </form>

    <p style="margin-top: 20px; font-size: 0.88rem; color: #555;">
      ¿Ya tienes una cuenta? <a href="login.php" style="color: #1e7a3e; font-weight: 600; text-decoration: none;">Inicia sesión aquí</a>
    </p>
  </div>

</body>
</html>
