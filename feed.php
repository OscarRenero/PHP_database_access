<?php
require '../includes/auth.php'; // Protección activa
require '../config/db.php';
include '../includes/header.php';

// Consulta de los relojes publicados
$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<div class="container">
    <a href="create_post.php" class="btn-new">Compartir un reloj</a>

    <?php foreach ($posts as $post): ?>
    <article class="watch-card">
        <h2>
            <span class="badge"><?php echo htmlspecialchars($post['brand']); ?></span> 
            <a href="post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a>
        </h2>
        <p><?php echo substr(htmlspecialchars($post['content']), 0, 100); ?>...</p>
        <small>Publicado por: <strong><?php echo htmlspecialchars($post['username']); ?></strong></small>
    </article>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
