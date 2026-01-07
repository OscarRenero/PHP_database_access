<?php
// Carga de seguridad, base de datos y diseño de cabecera
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Obtiene todas las publicaciones junto con el nombre de su autor mediante un JOIN, ordenadas por fecha
$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<a href="create_post.php">Nuevo post</a>

<?php foreach ($posts as $post): ?>
<article>
    <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
    
    <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
    
    <small>Por <?= $post['username'] ?></small>
</article>
<?php endforeach; ?>

<?php 
// Carga el pie de página
include '../includes/footer.php'; 
?>
