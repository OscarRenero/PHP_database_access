<?php
session_start();
require '../config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();


if ($user && password_verify($_POST['password'], $user['password'])) {
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