<?php
$termino_busqueda = "";
$resultado_html = "";

if (isset($_GET['q'])) {
    $termino_busqueda = trim($_GET['q']);
    $termino_seguro = htmlspecialchars($termino_busqueda, ENT_QUOTES, 'UTF-8');

    if (!empty($termino_seguro)) {
        $resultado_html = "<div style='background:#e3f2fd; color:#0d47a1; padding:15px; border-radius:5px; margin-top:20px;'>🔍 Mostrando resultados para la búsqueda: <strong>" . $termino_seguro . "</strong></div>";
    } else {
        $resultado_html = "<div style='background:#fff3e0; color:#e65100; padding:15px; border-radius:5px; margin-top:20px;'>⚠️ Por favor, ingrese un término válido para buscar.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador – Salta de Mates (Clase 5)</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main class="container" style="max-width: 600px; margin: 40px auto; padding: 20px;">
        <h1>Módulo de Búsqueda (GET)</h1>
        <p>Práctica de consultas rápidas por URL con sanitización estricta.</p>

        <form method="GET" action="" style="display: flex; gap: 10px; margin-top: 20px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <input type="text" name="q" placeholder="Buscar lugares, cursos..." value="<?php echo htmlspecialchars($termino_busqueda, ENT_QUOTES, 'UTF-8'); ?>" style="flex: 1; padding: 8px; border:1px solid #ccc; border-radius:4px;">
            <button type="submit" style="padding: 10px 15px; background: #1e7a3e; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight:bold;">Buscar (GET)</button>
        </form>

        <?php echo $resultado_html; ?>

        <p style="margin-top: 20px;"><a href="contacto.php">← Ir al Formulario POST</a> | <a href="../index.php">Volver al inicio</a></p>
    </main>
</body>
</html>