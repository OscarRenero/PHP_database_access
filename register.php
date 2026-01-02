<?php
require '../config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $password]);


header('Location: login.php');
}
?>
<form method="post">
<input name="username" placeholder="Usuario" required>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Contraseña" required>
<button>Registrarse</button>
</form>