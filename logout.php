<?php
// Iniciamos sesión para poder destruirla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Borramos todas las variables y destruimos la sesión del servidor
session_unset();
session_destroy();

// Redirigimos a la página principal (index.php)
header('Location: index.php');
exit;
