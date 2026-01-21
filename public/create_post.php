<?php
ob_start(); 
require '../includes/auth.php';
require '../config/db.php';

// Procesamos la lógica antes de cualquier include visual
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, brand, title, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $_POST['brand'],
            $_POST['title'],
            $_POST['content']
        ]);
        
        // Si llegamos aquí, limpiamos el búfer y redirigimos
        ob_end_clean(); 
        header('Location: feed.php');
        exit;
    } catch (Exception $e) {
        // Si hay error de DB, lo mostramos después del header
        $error = "Error al publicar: " . $e->getMessage();
    }
}

// Solo llegamos aquí si NO hubo redirección (es decir, carga inicial de la página)
include '../includes/header.php';
?>

<h2>Publicar nueva pieza</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    <input name="brand" placeholder="Marca" required>
    <input name="title" placeholder="Modelo" required>
    <textarea name="content" placeholder="Detalles..." required></textarea>
    <button type="submit">Publicar</button>
</form>

<?php include '../includes/footer.php'; ?>
