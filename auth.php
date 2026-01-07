<?php
// Evita el error de sesión duplicada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión, redirige al login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit; // Detiene la ejecución para evitar bucles
}
