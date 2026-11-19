<?php
/**
 * Módulo CRUD: Create (Formulario + Inserción)
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

require_once '../config/conexion.php';

$titulo_admin = "Agregar Nuevo Lugar - Salta de Mates";

$errores = [];
$nombre      = "";
$ubicacion   = "";
$descripcion = "";
$historia    = "";
$imagen      = "cerro.jpg";

// Lista de imágenes locales disponibles en la carpeta img/
$imagenes_disponibles = [
    'cerro.jpg'         => 'Cerro San Bernardo (cerro.jpg)',
    'plaza9dejulio.jpg' => 'Plaza 9 de Julio (plaza9dejulio.jpg)',
    'parquesur.jpg'     => 'Parque Bicentenario (parquesur.jpg)',
    'sanlorenzo.jpg'    => 'Quebrada de San Lorenzo (sanlorenzo.jpg)',
    'guemes.jpg'        => 'Plaza Güemes (guemes.jpg)',
    'legislatura.jpg'   => 'Paseo de los Poetas / Legislatura (legislatura.jpg)',
    'paludica.png'      => 'Palacio Zorrilla / Palúdica (paludica.png)',
    'portezuelo.jpg'    => 'Mirador del Portezuelo (portezuelo.jpg)',
    'plaza.jpg'         => 'Plaza Alvarado (plaza.jpg)',
    'bicentenario.jpg'  => 'Parque Sur (bicentenario.jpg)',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Captura y saneamiento inicial
    $nombre      = trim($_POST['nombre'] ?? '');
    $ubicacion   = trim($_POST['ubicacion'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $historia    = trim($_POST['historia'] ?? '');
    $imagen      = trim($_POST['imagen'] ?? 'cerro.jpg');

    // 2. Validación de campos obligatorios en el servidor
    if (empty($nombre)) {
        $errores[] = "El nombre del lugar es obligatorio.";
    } elseif (mb_strlen($nombre) > 150) {
        $errores[] = "El nombre no puede exceder los 150 caracteres.";
    }

    if (empty($ubicacion)) {
        $errores[] = "La ubicación es obligatoria.";
    }

    if (empty($descripcion)) {
        $errores[] = "La descripción del lugar es obligatoria.";
    }

    // 3. Inserción con Consultas Preparadas (Anti SQL Injection)
    if (empty($errores)) {
        try {
            $usuario_id = $_SESSION['usuario_id'] ?? 1;

            $sql = "INSERT INTO lugares (usuario_id, nombre, ubicacion, descripcion, historia, imagen) 
                    VALUES (:usuario_id, :nombre, :ubicacion, :descripcion, :historia, :imagen)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':usuario_id'  => $usuario_id,
                ':nombre'      => $nombre,
                ':ubicacion'   => $ubicacion,
                ':descripcion' => $descripcion,
                ':historia'    => $historia,
                ':imagen'      => !empty($imagen) ? $imagen : 'cerro.jpg'
            ]);

            // Redirección con estado de éxito
            header('Location: index.php?status=created');
            exit;

        } catch (\PDOException $e) {
            error_log('crear.php PDOException: ' . $e->getMessage());
            $errores[] = "No se pudo guardar el lugar. Intenta nuevamente.";
        }
    }
}

require_once 'header.php';
?>

<div class="container" style="max-width: 750px;">
    <!-- NAVEGACIÓN SECUNDARIA -->
    <div class="mb-3">
        <a href="index.php" class="text-decoration-none text-muted small">
            ← Volver al listado de lugares
        </a>
    </div>

    <!-- TARJETA DEL FORMULARIO -->
    <div class="card card-custom p-4">
        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
            <span class="fs-4">➕</span>
            <div>
                <h2 class="h4 mb-0 fw-bold" style="color: var(--verde-primario);">Registrar Nuevo Lugar</h2>
                <small class="text-muted">Completa los datos para dar de alta un nuevo rincón matero en la base de datos.</small>
            </div>
        </div>

        <!-- LISTA DE ERRORES SI LOS HUBIERA -->
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger shadow-sm">
                <h6 class="fw-bold mb-1">Por favor corrige los siguientes errores:</h6>
                <ul class="mb-0 ps-3">
                    <?php foreach ($errores as $err): ?>
                        <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- FORMULARIO -->
        <form method="POST" action="crear.php" novalidate>
            <!-- NOMBRE -->
            <div class="mb-3">
                <label for="nombre" class="form-label fw-semibold">Nombre del Lugar <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Ej.: Dique Campo Alegre" 
                    value="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>

            <!-- UBICACIÓN -->
            <div class="mb-3">
                <label for="ubicacion" class="form-label fw-semibold">Ubicación <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="ubicacion" 
                    name="ubicacion" 
                    placeholder="Ej.: La Caldera, Salta" 
                    value="<?= htmlspecialchars($ubicacion, ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>

            <!-- DESCRIPCIÓN -->
            <div class="mb-3">
                <label for="descripcion" class="form-label fw-semibold">Descripción del Lugar <span class="text-danger">*</span></label>
                <textarea 
                    class="form-control" 
                    id="descripcion" 
                    name="descripcion" 
                    rows="3" 
                    placeholder="Describe por qué es ideal para tomar mate, vistas, tranquilidad..."
                    required
                ><?= htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <!-- HISTORIA / DETALLE ADICIONAL -->
            <div class="mb-3">
                <label for="historia" class="form-label fw-semibold">Historia / Datos de Interés (Opcional)</label>
                <textarea 
                    class="form-control" 
                    id="historia" 
                    name="historia" 
                    rows="2" 
                    placeholder="Breve reseña histórica, cómo llegar o consejos útiles..."
                ><?= htmlspecialchars($historia, ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <!-- IMAGEN -->
            <div class="mb-4">
                <label for="imagen" class="form-label fw-semibold">Fotografía del Lugar</label>
                <select class="form-select mb-2" id="imagen" name="imagen" onchange="actualizarVistaPrevia(this.value)">
                    <?php foreach ($imagenes_disponibles as $archivo => $etiqueta): ?>
                        <option value="<?= htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') ?>" <?= ($imagen === $archivo) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($etiqueta, ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted d-block mb-2">Imágenes locales alojadas en la carpeta <code>/img</code> de Salta de Mates.</small>
                
                <div class="d-flex align-items-center gap-3 p-2 border rounded bg-light">
                    <img id="img-preview" src="../img/<?= htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') ?>" alt="Vista previa" style="width: 100px; height: 65px; object-fit: cover; border-radius: 6px;">
                    <span class="small text-secondary">Vista previa de la fotografía seleccionada.</span>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-verde px-4">💾 Guardar Lugar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function actualizarVistaPrevia(archivo) {
        document.getElementById('img-preview').src = '../img/' + archivo;
    }
</script>

<?php require_once 'footer.php'; ?>
