<?php 
// Asegura que la sesión esté disponible para el menú de navegación
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>WatchYourPost - Comunidad de Relojería</title>
</head>
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

### 4. `public/feed.php`
```php
<?php
// Carga de dependencias subiendo un nivel
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Consulta que une posts y usuarios para obtener marca, modelo y autor
$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<a href="create_post.php" class="btn-new">Compartir un reloj</a>

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

<?php include '../includes/footer.php'; ?>
