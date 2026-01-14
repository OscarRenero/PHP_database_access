<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Lógica de inserción al recibir el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insertamos marca (brand), título y contenido
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, brand, title, content) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['brand'],
        $_POST['title'],
        $_POST['content']
    ]);
    header('Location: feed.php');
}
?>

<h2>Publicar nueva pieza</h2>
<form method="post">
    <input name="brand" placeholder="Marca (Rolex, Seiko, etc.)" required>
    <input name="title" placeholder="Modelo o Referencia" required>
    <textarea name="content" placeholder="Escribe los detalles técnicos..." required></textarea>
    <button type="submit">Publicar en WatchYourPost</button>
</form>

<?php include '../includes/footer.php'; ?>
