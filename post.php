<?php
// Carga de seguridad, conexión a base de datos y cabecera visual
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Obtiene el ID del post desde la URL
$id = $_GET['id'];

// Consulta para obtener los datos del post y el nombre del autor mediante un JOIN
$post = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$post->execute([$id]);
$post = $post->fetch();

// Consulta para obtener todos los comentarios asociados a este post y sus autores
$comments = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ?");
$comments->execute([$id]);

// Procesa el envío de un nuevo comentario mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inserta el comentario vinculado al post, al usuario en sesión y el contenido del formulario
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$id, $_SESSION['user_id'], $_POST['content']]);
    // Recarga la página para mostrar el nuevo comentario publicado
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

<?php 
// Carga el cierre de página (footer)
include '../includes/footer.php'; 
?>
