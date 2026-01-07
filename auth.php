<?php
// Verifica si la sesión no ha sido iniciada previamente para evitar el error de sesión duplicada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Control de acceso: si no existe el ID del usuario, redirigir al login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
