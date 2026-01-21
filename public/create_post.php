<?php
ob_start();
require '../includes/auth.php';
require '../config/db.php';

// 1. PRIMERO LA LÓGICA (Sin salida de texto)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insertamos marca (brand), título y contenido
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, brand, title, content) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['brand'],
        $_POST['title'],
        $_POST['content']
    ]);
    
    // Al estar aquí, la redirección funciona porque aún no hemos hecho "include" del header
    header('Location: feed.php');
    exit; // Es buena práctica poner exit tras una redirección
}

// 2. DESPUÉS EL DISEÑO (Solo se carga si NO hubo redirección)
include '../includes/header.php';
?>

<h2>Publicar nueva pieza</h2>
<form method="post">
    <input name="brand" placeholder="Marca (Rolex, Seiko, etc.)" required>
    <input name="title" placeholder="Modelo o Referencia" required>
    <textarea name="content" placeholder="Escribe los detalles técnicos..." required></textarea>
    <button type="submit">Publicar en WatchYourPost</button>
</form>

<?php include '../includes/footer.php'; ?>

