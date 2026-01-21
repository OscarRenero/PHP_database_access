<?php
// Usamos getenv para leer las variables que inyecta Podman/Docker
$host = getenv('DB_HOST') ?: 'db'; 
$db   = getenv('DB_NAME') ?: 'WatchYourPost';
$user = getenv('DB_USER') ?: 'admin';
$pass = getenv('DB_PASS') ?: 'admin123';
$port = getenv('DB_PORT') ?: '3306';

try {
    // IMPORTANTE: host=$host (donde $host es 'db') fuerza la conexión por red TCP
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
