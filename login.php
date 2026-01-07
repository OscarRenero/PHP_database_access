<?php
// Iniciamos sesión solo si no está activa para evitar el aviso de PHP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Conexión a la base de datos subiendo un nivel
require '../config/db.php';

// Procesamos el intento de entrada al recibir el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buscamos al usuario por su correo electrónico
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    // Validamos la contraseña usando el hash de seguridad
    if ($user && password_verify($_POST['password'], $user['password'])) {
        // Guardamos el ID en la sesión y redirigimos al feed
        $_SESSION['user_id'] = $user['id'];
        header('Location: feed.php');
        exit;
    }
}
?>
<form method="post">
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>
