<?php
// Configuración de los parámetros de acceso a la base de datos
$host = 'localhost';
$db = 'foro_php';
$user = 'root';
$pass = '';

try {
    // Intenta establecer la conexión usando la extensión PDO con soporte UTF-8
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // Configura PDO para que lance excepciones en caso de errores SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la conexión falla, detiene la ejecución y muestra el mensaje de error
    die("Error de conexión: " . $e->getMessage());
}
