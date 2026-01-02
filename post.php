<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';


$id = $_GET['id'];
$post = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$post->execute([$id]);
$post = $post->fetch();


$comments = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ?");
$comments->execute([$id]);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
$stmt->execute([$id, $_SESSION['user_id'], $_POST['content']]);
header("Location: post.php?id=$id");
}
?>
<h2><?= htmlspecialchars($post['title']) ?></h2>
<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>


<h3>Comentarios</h3>
<?php foreach ($comments as $comment): ?>
<p><strong><?= $comment['username'] ?>:</strong> <?= htmlspecialchars($comment['content']) ?></p>
<?php endforeach; ?>


<form method="post">
<textarea name="content" required></textarea>
<button>Comentar</button>
</form>
<?php include '../includes/footer.php'; ?>