<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
$stmt->execute([
$_SESSION['user_id'],
$_POST['title'],
$_POST['content']
]);
header('Location: feed.php');
}
?>
<h2>Nuevo post</h2>
<form method="post">
<input name="title" placeholder="Título" required>
<textarea name="content" placeholder="Contenido" required></textarea>
<button>Publicar</button>
</form>
<?php include '../includes/footer.php'; ?>