<?php
ob_start();
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// 1. Obtener datos actuales del usuario
$stmt = $pdo->prepare("SELECT username, email, avatar FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$mensaje = "";

// 2. Procesar los formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Lógica para guardar el AVATAR
    if (isset($_POST['save_avatar'])) {
        $avatar_id = $_POST['avatar_id'];
        $upd = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $upd->execute([$avatar_id, $_SESSION['user_id']]);
        $_SESSION['user_avatar'] = $avatar_id; // Actualizamos la sesión para el header
        header("Location: profile.php?updated=1");
        exit;
    }

    // Lógica para cambiar la CONTRASEÑA
    if (isset($_POST['change_pass'])) {
        $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $upd = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $upd->execute([$new_pass, $_SESSION['user_id']]);
        $mensaje = "Contraseña actualizada correctamente.";
    }
}
?>

<h2>Mi Perfil</h2>

<?php if ($mensaje): ?>
    <p style="background: #d4af37; color: black; padding: 10px; font-weight: bold;"><?= $mensaje ?></p>
<?php endif; ?>

<div class="profile-info" style="margin-bottom: 30px; border: 1px solid #444; padding: 15px;">
    <p><strong>Usuario:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
</div>

<h3>Elige tu Imagen de Perfil</h3>
<form method="post">
    <div class="avatar-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; margin-bottom: 20px;">
        <?php for($i = 1; $i <= 10; $i++): ?>
            <label class="avatar-item" style="cursor: pointer; text-align: center;">
                <input type="radio" name="avatar_id" value="<?= $i ?>" <?= ($user['avatar'] == $i) ? 'checked' : '' ?> style="display:none;">
                <img src="../assets/avatars/avatar<?= $i ?>.png" 
                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid <?= ($user['avatar'] == $i) ? '#d4af37' : '#444' ?>; transition: 0.3s;">
            </label>
        <?php endfor; ?>
    </div>
    <button type="submit" name="save_avatar" class="btn-new">Guardar Avatar</button>
</form>

<hr style="border: 0.5px solid #444; margin: 40px 0;">

<h3>Seguridad: Cambiar Contraseña</h3>
<form method="post">
    <div style="margin-bottom: 15px;">
        <input type="password" name="password" placeholder="Escribe tu nueva contraseña" required 
               style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: white;">
    </div>
    <button type="submit" name="change_pass" class="btn-new" style="background: #444; color: white;">Actualizar Contraseña</button>
</form>

<?php include '../includes/footer.php'; ?>

