<?php
/**
 * Módulo CRUD: Delete (Lógica de Eliminación)
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header('Location: ../login.php?error=acceso_denegado');
    exit;
}

require_once '../config/conexion.php';

// Captura segura del identificador por GET o POST
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

if ($id) {
    try {
        // Consulta Preparada para eliminación segura (Anti SQL Injection)
        $stmt = $pdo->prepare("DELETE FROM lugares WHERE id = :id");
        $stmt->execute([':id' => $id]);

        // Redirección con estado de eliminación
        header('Location: index.php?status=deleted');
        exit;

    } catch (\PDOException $e) {
        header('Location: index.php?error=delete_failed');
        exit;
    }
} else {
    // Si no se proporcionó un ID numérico válido
    header('Location: index.php?error=invalid_id');
    exit;
}
