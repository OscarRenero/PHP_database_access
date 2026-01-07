<?php
session_start(); // Inicia o reanuda la sesión del usuario

// Verifica si el usuario está autenticado; de lo contrario, redirige al login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
