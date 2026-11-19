<?php
/**
 * Módulo CRUD: Read (Listado Principal)
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

require_once '../config/conexion.php';

$titulo_admin = "Gestión de Lugares - Salta de Mates";


$busqueda = trim($_GET['q'] ?? '');

if (!empty($busqueda)) {
    // Consulta Preparada con marcadores con nombre (Anti SQL Injection).
    // Con ATTR_EMULATE_PREPARES=false cada marcador debe ser unico, por eso :q1, :q2 y :q3.
    $stmt = $pdo->prepare("SELECT * FROM lugares WHERE nombre LIKE :q1 OR ubicacion LIKE :q2 OR descripcion LIKE :q3 ORDER BY id DESC");
    $like = "%" . $busqueda . "%";
    $stmt->execute([':q1' => $like, ':q2' => $like, ':q3' => $like]);
} else {
    // Consulta directa segura sin parámetros externos
    $stmt = $pdo->query("SELECT * FROM lugares ORDER BY id DESC");
}

$lugares = $stmt->fetchAll();
$total_registros = count($lugares);

// Notificaciones según parámetro GET 'status' o 'error'
$mensaje_alerta = "";
$tipo_alerta    = "";

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'created':
            $mensaje_alerta = "✅ ¡Nuevo lugar registrado exitosamente en la base de datos!";
            $tipo_alerta    = "success";
            break;
        case 'updated':
            $mensaje_alerta = "✏️ ¡Información del lugar actualizada correctamente!";
            $tipo_alerta    = "info";
            break;
        case 'deleted':
            $mensaje_alerta = "🗑️ ¡El lugar ha sido eliminado satisfactoriamente!";
            $tipo_alerta    = "warning";
            break;
    }
} elseif (isset($_GET['error'])) {
    $mensaje_alerta = "⚠️ Error: No se pudo completar la operación solicitada.";
    $tipo_alerta    = "danger";
}

require_once 'header.php';
?>

<div class="container">
    <!-- ENCABEZADO Y ACCIONES -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: var(--verde-primario);">📍 Gestión de Lugares Materos</h1>
            <p class="text-muted mb-0">Administración de los spots turísticos y rincones materos de Salta.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="crear.php" class="btn btn-verde d-inline-flex align-items-center gap-1 shadow-sm">
                <span>➕</span> Agregar Nuevo Lugar
            </a>
        </div>
    </div>

    <!-- ALERTAS DE ESTADO -->
    <?php if (!empty($mensaje_alerta)): ?>
        <div class="alert alert-<?= $tipo_alerta ?> alert-dismissible fade show shadow-sm" role="alert">
            <?= htmlspecialchars($mensaje_alerta, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <!-- TARJETA PRINCIPAL CON TABLA -->
    <div class="card card-custom p-3 p-md-4 mb-4">
        <!-- BARRA DE BÚSQUEDA Y CONTADOR -->
        <div class="row align-items-center mb-3 g-2">
            <div class="col-12 col-md-6">
                <form method="GET" action="index.php" class="d-flex gap-2">
                    <input 
                        type="text" 
                        name="q" 
                        class="form-control" 
                        placeholder="Buscar por nombre, ubicación o descripción..." 
                        value="<?= htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8') ?>"
                    >
                    <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                    <?php if (!empty($busqueda)): ?>
                        <a href="index.php" class="btn btn-link text-muted text-decoration-none">Limpiar</a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-12 col-md-6 text-md-end text-muted small">
                Total de registros: <strong><?= $total_registros ?></strong>
            </div>
        </div>

        <!-- TABLA RESPONSIVE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th style="width: 90px;">Imagen</th>
                        <th>Nombre del Lugar</th>
                        <th>Ubicación</th>
                        <th>Descripción</th>
                        <th>Fecha de Alta</th>
                        <th class="text-center" style="width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($lugares)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <em>No se encontraron registros de lugares en la base de datos.</em>
                                <br>
                                <a href="crear.php" class="btn btn-sm btn-verde mt-2">Agregar el primer lugar</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($lugares as $item): ?>
                            <?php 
                                // Determinar ruta de imagen local o por defecto
                                $img_archivo = !empty($item['imagen']) ? $item['imagen'] : 'cerro.jpg';
                                $img_src = (strpos($img_archivo, 'http') === 0) ? $img_archivo : '../img/' . $img_archivo;
                            ?>
                            <tr>
                                <td class="fw-bold text-muted"><?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <img 
                                        src="<?= htmlspecialchars($img_src, ENT_QUOTES, 'UTF-8') ?>" 
                                        alt="<?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?>" 
                                        class="img-thumb-preview"
                                        onerror="this.src='../img/cerro.jpg';"
                                    >
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?></strong>
                                </td>
                                <td>
                                    <span class="badge-lugar">
                                        📍 <?= htmlspecialchars($item['ubicacion'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-secondary">
                                        <?= htmlspecialchars(mb_strimwidth($item['descripcion'], 0, 90, '...'), ENT_QUOTES, 'UTF-8') ?>
                                    </small>
                                </td>
                                <td class="text-muted small">
                                    <?= htmlspecialchars(date('d/m/Y', strtotime($item['creado_en'] ?? 'now')), ENT_QUOTES, 'UTF-8') ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a 
                                            href="editar.php?id=<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>" 
                                            class="btn btn-warning" 
                                            title="Editar información"
                                        >
                                            ✏️ Editar
                                        </a>
                                        <a 
                                            href="eliminar.php?id=<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('¿Confirma que desea eliminar el lugar \'<?= htmlspecialchars(addslashes($item['nombre']), ENT_QUOTES, 'UTF-8') ?>\'? Esta acción no se puede deshacer.');" 
                                            title="Eliminar registro"
                                        >
                                            🗑️ Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
