<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>WatchYourPost</title>
</head>
<body>
<header>
    <h1>WatchYourPost</h1>
    <nav>
        <a href="feed.php">Explorar</a>
        <a href="profile.php">Mi Perfil</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>
<main>
