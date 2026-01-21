<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Obtiene el ID del post desde la URL
$id = $_GET['id'];

// Consulta para obtener el post, incluyendo la marca y el autor
$post = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$post->execute([$id]);
$post = $post->fetch();

// Consulta para obtener los comentarios
$comments = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ?");
$comments->execute([$id]);

// Guardar nuevo comentario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$id, $_SESSION['user_id'], $_POST['content']]);
    header("Location: post.php?id=$id");
    exit;
}
?>

<article class="watch-card">
    <span class="badge"><?= htmlspecialchars($post['brand']) ?></span>
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <small>Publicado por: <?= htmlspecialchars($post['username']) ?></small>
</article>

<hr style="border: 1px solid #444;">

<h3>Comentarios de la comunidad</h3>
<?php foreach ($comments as $comment): ?>
    <div style="margin-bottom: 10px; border-bottom: 1px solid #333; padding-bottom: 5px;">
        <strong><?= htmlspecialchars($comment['username']) ?>:</strong> 
        <?= htmlspecialchars($comment['content']) ?>
    </div>
<?php endforeach; ?>

<form method="post" style="margin-top: 20px;">
    <textarea name="content" placeholder="Escribe tu opinión técnica..." required style="width: 100%; height: 80px;"></textarea>
    <button type="submit">Enviar Comentario</button>
</form>

<?php include '../includes/footer.php'; ?>
