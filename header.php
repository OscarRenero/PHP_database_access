<?php 
// Inicia la sesión para controlar el acceso en todo el foro
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <link rel="stylesheet" href="../assets/style.css"> <title>WatchYourPost - Comunidad de Relojería</title> </head>
<body>
<header>
    <h1>WatchYourPost</h1> <nav>
        <a href="feed.php">Explorar Relojes</a>
        <a href="profile.php">Mi Colección</a>
        <a href="logout.php">Cerrar Sesión</a>
    </nav>
</header>
<main> ```

### 3. Muro Principal (`feed.php`)
```php
<?php
// Carga de seguridad y conexión
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Consulta para obtener los relojes, sus marcas y quién los publicó
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
    
    <small>Publicado por: <strong><?= $post['username'] ?></strong></small>
</article>
<?php endforeach; ?>

<?php 
// Carga el pie de página común
include '../includes/footer.php'; 
?>
