<?php
// Carga la conexión a la base de datos
require '../config/db.php';

// Verifica si los datos han sido enviados a través del formulario (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge el nombre de usuario y el email del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Encripta la contraseña usando un algoritmo de hash seguro antes de guardarla
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepara la consulta SQL para insertar el nuevo usuario de forma segura
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    // Ejecuta la inserción pasando los datos procesados
    $stmt->execute([$username, $email, $password]);

    // Redirige al usuario a la página de inicio de sesión tras el registro con éxito
    header('Location: login.php');
}
?>

<form method="post">
    <input name="username" placeholder="Usuario" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <button>Registrarse</button>
</form>
