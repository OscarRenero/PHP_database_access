<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
// Obtenemos el avatar de la sesión o el 1 por defecto
$current_avatar = $_SESSION['user_avatar'] ?? 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css?v=1.1">
    <title>WatchYourPost - Comunidad de Relojería</title>
</head>
<body>
<header>
    <h1>WatchYourPost</h1>
    <nav>
        <div class="user-menu" style="display:inline-flex; align-items:center;">
            <img src="../assets/avatars/avatar<?= $current_avatar ?>.png" 
                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 1px solid #d4af37; margin-right: 10px;">
            
        </div>
        <a href="feed.php">Explorar</a>
        <a href="profile.php">Mi Perfil</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>
<main>

