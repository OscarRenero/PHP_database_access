<?php 
// Verifica si la sesión ya existe para evitar errores de duplicidad al cargar la cabecera
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <link rel="stylesheet" href="../assets/style.css"> <title>WatchYourPost - Comunidad de Relojería</title> </head>
<body>
<header>
    <h1>WatchYourPost</h1> <nav>
        <a href="feed.php">Explorar</a>
        <a href="profile.php">Mi Perfil</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>
<main> ```

---

### 📁 Archivo: `public/index.php` (ACTUALIZADO)
Cambié el nombre del foro a **WatchYourPost** y actualicé los comentarios.

```php
<?php
// Inicia la sesión para verificar si el usuario ya ha entrado
session_start();

// Si el usuario ya está logueado, lo enviamos directamente al feed de relojes
if (isset($_SESSION['user_id'])) {
    header('Location: feed.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>WatchYourPost - Bienvenido</title>
</head>
<body>
<header>
    <h1>WatchYourPost</h1> </header>
<main>
    <p>Bienvenido al foro. Regístrate o inicia sesión para participar en la comunidad de relojes.</p>
    <a href="register.php">Registrarse</a> | <a href="login.php">Iniciar sesión</a>
</main>
</body>
</html>
