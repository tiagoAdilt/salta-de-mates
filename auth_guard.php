<?php
require_once __DIR__.'/config/session.php';

/**
 * auth_guard.php — Guardián de Rutas (TP8 - Control de Acceso)
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 *
 * Uso básico (proteger cualquier página autenticada):
 *   require_once 'auth_guard.php';
 *
 * Uso con restricción de rol de administrador:
 *   $requiredRole = 'admin';
 *   require_once 'auth_guard.php';
 */

// Ruta a login.php según la carpeta del script que incluye el guard.
// Se usa dirname(realpath()) para que funcione igual con "/" o "\" (Windows/XAMPP).
$__scriptDir = basename(dirname(realpath($_SERVER['SCRIPT_FILENAME'])));
$__loginUrl  = ($__scriptDir === 'admin') ? '../login.php' : 'login.php';

// 1. Verificar que la sesión esté iniciada y el usuario autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . $__loginUrl . '?error=acceso_denegado');
    exit;
}

// 2. Verificar rol si se definió $requiredRole antes de incluir este archivo
if (isset($requiredRole) && ($_SESSION['rol'] ?? $_SESSION['usuario_rol'] ?? '') !== $requiredRole) {
    header('Location: ' . $__loginUrl . '?error=rol_insuficiente');
    exit;
}
