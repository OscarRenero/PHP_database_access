<?php
// Inicia la sesión para verificar el estado del usuario
session_start();
// Si el usuario ya está logueado, lo redirige automáticamente al muro (feed)
if (isset($_SESSION['user_id'])) {
header('Location: feed.php');
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
<h2 style="color: #d4af37;">El tiempo es oro.</h2>
</header>
<main>
<p>Bienvenido al foro. Regístrate o inicia sesión para participar.</p>
<a href="register.php">Registrarse</a> | <a href="login.php">Iniciar sesión</a>
</main>
</body>

</html>


