<?php
// Inicia el sistema de sesiones para guardar los datos del usuario logueado
session_start();
// Carga la conexión a la base de datos
require '../config/db.php';

// Verifica si se ha enviado el formulario mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Busca al usuario en la base de datos comparando el email introducido
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    // Si el usuario existe y la contraseña coincide con el hash guardado
    if ($user && password_verify($_POST['password'], $user['password'])) {
        // Almacena el ID del usuario en la sesión y lo redirige al muro
        $_SESSION['user_id'] = $user['id'];
        header('Location: feed.php');
    }
}
?>
<form method="post">
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <button>Entrar</button>
</form>
