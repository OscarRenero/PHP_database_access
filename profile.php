<?php
// Carga de seguridad (valida sesión), base de datos y cabecera
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Obtiene los datos del usuario actual (nombre y email) usando el ID de la sesión
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Procesa el cambio de contraseña si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Genera un hash seguro para la nueva contraseña
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Actualiza en la base de datos
    $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update->execute([$newPassword, $_SESSION['user_id']]);
    echo '<p style="color: #d4af37;">Contraseña actualizada correctamente</p>';
}
?>

<h2>Mi Perfil de Entusiasta</h2>
<div class="watch-card">
    <p><strong>Usuario:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
</div>

<h3>Seguridad de la cuenta</h3>
<form method="post">
    <input type="password" name="password" placeholder="Nueva contraseña" required>
    <button type="submit">Actualizar Contraseña</button>
</form>

<?php 
// Carga el pie de página
include '../includes/footer.php'; 
?>
