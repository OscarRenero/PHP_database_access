<?php
// Evita el error "session already active" comprobando el estado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión iniciada, redirige al login y corta la ejecución
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
