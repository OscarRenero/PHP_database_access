<?php
// Inicia sesión para poder destruirla correctamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpia las variables y destruye la sesión en el servidor
session_unset();
session_destroy();

// Redirige a la página principal de bienvenida
header('Location: index.php');
exit;
