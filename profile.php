<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';


$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
$update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$update->execute([$newPassword, $_SESSION['user_id']]);
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
<?php include '../includes/footer.php'; ?>