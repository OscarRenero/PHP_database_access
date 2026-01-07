<?php 
// Comprobamos la sesión para evitar errores de duplicidad
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
        <a href="feed.php">Explorar Relojes</a>
        <a href="profile.php">Mi Perfil</a>
        <a href="logout.php">Salir</a>
    </nav>
</header>
<main> ```

### 3. `views/feed.php` (El Muro de Relojes)
Muestra la lista de relojes publicados por todos los usuarios.

```php
<?php
require '../includes/auth.php'; // Protege la página
require '../config/db.php';     // Conexión a la base de datos
include '../includes/header.php'; // Cabecera visual

// Consulta que une posts y usuarios para saber quién publicó cada reloj
$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<a href="create_post.php" class="btn-new">Compartir un nuevo reloj</a>

<?php foreach ($posts as $post): ?>
<article class="watch-card">
    <h2>
        <span class="badge"><?= htmlspecialchars($post['brand']) ?></span> 
        <a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
    </h2>
    
    <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
    
    <small>Publicado por: <strong><?= htmlspecialchars($post['username']) ?></strong></small>
</article>
<?php endforeach; ?>

<?php include '../includes/footer.php'; // Cierre de etiquetas HTML ?>
