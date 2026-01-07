<?php
// Cargamos seguridad, base de datos y cabecera visual
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Consulta SQL que obtiene los relojes y los nombres de sus dueños
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

<?php 
// Cargamos el pie de página
include '../includes/footer.php'; 
?>
