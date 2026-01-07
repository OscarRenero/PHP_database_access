<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Verifica si se envió el formulario de nuevo reloj
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inserta la marca, título y descripción vinculados al usuario actual
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, brand, title, content) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['brand'],
        $_POST['title'],
        $_POST['content']
    ]);
    // Redirige al feed para ver la nueva publicación
    header('Location: feed.php');
}
?>

<h2>Añadir pieza a WatchYourPost</h2>
<form method="post">
    <input name="brand" placeholder="Marca del reloj" required>
    <input name="title" placeholder="Modelo o Referencia" required>
    <textarea name="content" placeholder="Describe los detalles, calibre, historia..." required></textarea>
    <button type="submit">Publicar Reloj</button>
</form>

<?php include '../includes/footer.php'; ?>
