<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>WatchYourPost - Registro</title>
</head>
<body>
<header><h1>WatchYourPost</h1></header>
<main>
    <h2>Únete a la comunidad</h2>
    <form method="post">
        <input name="username" placeholder="Nombre de usuario" required>
        <input name="email" type="email" placeholder="Correo electrónico" required>
        <input name="password" type="password" placeholder="Contraseña" required>
        <button type="submit">Crear Cuenta</button>
    </form>
    <p><a href="login.php" style="color: #d4af37;">¿Ya tienes cuenta? Inicia sesión</a></p>
</main>
</body>
</html>
