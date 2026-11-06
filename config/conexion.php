<?php
/**
 * Configuración de Conexión a la Base de Datos mediante PDO
 * Proyecto: Salta de Mates
 * Autor: Enriquez Tiago
 */

$host    = 'localhost';
$db      = 'salta_de_mates';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage() . "<br><br><strong>Tip:</strong> Asegúrate de que el servicio MySQL esté iniciado en el panel de XAMPP y de haber importado el archivo <code>database/salta_de_mates.sql</code> en phpMyAdmin.");
}
