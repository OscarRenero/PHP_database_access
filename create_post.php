<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Si el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insertamos la marca, el título y el contenido
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, brand, title, content) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['brand'],
        $_POST['title'],
        $_POST['content']
    ]);
    // Volvemos al feed para ver el resultado
    header('Location: feed.php');
}
?>

<h2>Añadir pieza a WatchYourPost</h2>
<form method="post">
    <input name="brand" placeholder="Marca (ej. Rolex, Omega, Seiko)" required>
    <input name="title" placeholder="Modelo o Referencia" required>
    <textarea name="content" placeholder="Escribe los detalles técnicos o la historia de este reloj..." required></textarea>
    <button type="submit">Publicar en la comunidad</button>
</form>

<?php include '../includes/footer.php'; ?>
