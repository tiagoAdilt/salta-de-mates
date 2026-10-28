<?php
// Inicialización de variables para persistencia y mensajes
$nombre = "";
$email = "";
$telefono = "";
$asunto = "";
$mensaje = "";
$mensaje_estado = "";
$clase_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitización estricta (XSS)
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $asunto = trim($_POST['asunto'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    $nombre_seguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $email_seguro = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $telefono_seguro = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
    $asunto_seguro = htmlspecialchars($asunto, ENT_QUOTES, 'UTF-8');
    $mensaje_seguro = htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');

    // Validación en servidor
    if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
        $mensaje_estado = "⚠️ Por favor, complete todos los campos obligatorios.";
        $clase_alerta = "background:#ffebee; color:#c62828;";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje_estado = "⚠️ El formato del correo electrónico no es válido.";
        $clase_alerta = "background:#ffebee; color:#c62828;";
    } else {
        $mensaje_estado = "✅ ¡Mensaje enviado con éxito! Gracias por contactarnos, " . $nombre_seguro . ".";
        $clase_alerta = "background:#e8f5e9; color:#2e7d32;";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto (POST) – Salta de Mates</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main class="container" style="max-width: 600px; margin: 40px auto; padding: 20px;">
        <h1>Formulario de Contacto (POST)</h1>
       

        <?php if (!empty($mensaje_estado)): ?>
            <div style="padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold; <?php echo $clase_alerta; ?>">
                <?php echo $mensaje_estado; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario POST con Persistencia -->
        <form method="POST" action="" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Nombre completo *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; padding: 8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Correo electrónico *</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; padding: 8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Teléfono</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; padding: 8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Asunto *</label>
                <input type="text" name="asunto" value="<?php echo htmlspecialchars($asunto, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; padding: 8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Mensaje *</label>
                <textarea name="mensaje" rows="4" style="width:100%; padding: 8px; border:1px solid #ccc; border-radius:4px;"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <button type="submit" style="padding: 10px 15px; background: #1e7a3e; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight:bold; width:100%;">Enviar Mensaje (POST)</button>
        </form>

        <p style="margin-top: 20px;"><a href="buscar.php">→ Ir al Buscador (GET)</a> | <a href="../index.php">Volver al inicio</a></p>
    </main>
</body>
</html>