<?php
/**
 * Header modular para el panel de administración
 * Proyecto: Salta de Mates
 */
if (!isset($titulo_admin)) {
    $titulo_admin = "Panel de Administración - Salta de Mates";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo_admin, ENT_QUOTES, 'UTF-8') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-primario: #1e7a3e;
            --verde-oscuro: #15572c;
            --verde-claro: #edf7f0;
            --verde-borde: #c8ecd4;
        }
        body {
            background-color: var(--verde-claro);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #212529;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-admin {
            background-color: var(--verde-primario);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .navbar-brand {
            font-weight: 700;
            color: #ffffff !important;
            letter-spacing: 0.5px;
        }
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: #ffffff !important;
            text-decoration: underline;
        }
        .btn-verde {
            background-color: var(--verde-primario);
            color: #ffffff;
            border: 1px solid var(--verde-primario);
            font-weight: 600;
        }
        .btn-verde:hover {
            background-color: var(--verde-oscuro);
            color: #ffffff;
            border-color: var(--verde-oscuro);
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
            background: #ffffff;
        }
        .table thead th {
            background-color: #f1f8f3;
            color: var(--verde-oscuro);
            font-weight: 600;
            border-bottom: 2px solid var(--verde-borde);
        }
        .badge-lugar {
            background-color: #e8f5e9;
            color: var(--verde-oscuro);
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid var(--verde-borde);
        }
        .img-thumb-preview {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }
        main.main-content {
            flex: 1 0 auto;
        }
    </style>
</head>
<body>

    <!-- NAVBAR ADMIN -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <span>🧉</span> Salta de Mates <span class="badge bg-light text-success ms-2 fs-6">Admin CRUD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">📋 Listado de Lugares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crear.php">➕ Nuevo Lugar</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="../index.php" class="btn btn-sm btn-outline-light">
                        🌐 Ver Sitio Web Público
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content py-4">
