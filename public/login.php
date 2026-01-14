<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/db.php';

// Si el usuario ya está logueado, lo mandamos al feed directamente
if (isset($_SESSION['user_id'])) {
    header('Location: feed.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    // Verificamos contraseña
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: feed.php');
        exit;
    } else {
        $error = "Email o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Login - WatchYourPost</title>
</head>
<body>
    <header><h1>WatchYourPost</h1></header>
    <main>
        <form method="post">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <input name="email" type="email" placeholder="Correo electrónico" required>
            <input name="password" type="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="register.php">¿No tienes cuenta? Regístrate aquí</a></p>
    </main>
</body>
</html>
