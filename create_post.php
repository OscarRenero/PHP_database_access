<?php
// Carga de dependencias: autenticación, conexión a base de datos y cabecera visual
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Procesar el formulario cuando se envía mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preparar e insertar el nuevo post vinculado al usuario actual
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['title'],
        $_POST['content']
    ]);
    
    // Redirigir al muro principal tras publicar con éxito
    header('Location: feed.php');
}
?>

<h2>Nuevo post</h2>
<form method="post">
    <input name="title" placeholder="Título" required>
    <textarea name="content" placeholder="Contenido" required></textarea>
    <button>Publicar</button>
</form>

<?php 
// Carga el pie de página
include '../includes/footer.php'; 
?>
