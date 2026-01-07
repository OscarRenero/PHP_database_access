<?php
// Carga de seguridad (validación de sesión), base de datos y cabecera
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Obtiene los datos del usuario actual (nombre y email) usando el ID guardado en la sesión
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Procesa el cambio de contraseña si se envía el formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Genera un hash seguro para la nueva contraseña antes de guardarla
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Actualiza la contraseña en la base de datos para el usuario actual
    $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update->execute([$newPassword, $_SESSION['user_id']]);
    // Muestra un mensaje de confirmación al usuario
    echo '<p>Contraseña actualizada correctamente</p>';
}
?>

<h2>Mi perfil</h2>
<p><strong>Usuario:</strong> <?= htmlspecialchars($user['username']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

<h3>Cambiar contraseña</h3>
<form method="post">
    <input type="password" name="password" placeholder="Nueva contraseña" required>
    <button>Cambiar contraseña</button>
</form>

<?php 
// Carga el pie de página
include '../includes/footer.php'; 
?>
