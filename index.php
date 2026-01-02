<?php
session_start();
if (isset($_SESSION['user_id'])) {
header('Location: feed.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../assets/style.css">
<title>Foro PHP</title>
</head>
<body>
<header>
<h1>Foro PHP</h1>
</header>
<main>
<p>Bienvenido al foro. Regístrate o inicia sesión para participar.</p>
<a href="register.php">Registrarse</a> | <a href="login.php">Iniciar sesión</a>
</main>
</body>
</html>