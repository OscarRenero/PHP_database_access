<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// Filtros
$brand = $_GET['brand'] ?? '';
$user = $_GET['username'] ?? '';
$date = $_GET['date'] ?? '';

$sql = "SELECT posts.*, users.username, users.avatar 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE 1=1";
$params = [];

if ($brand) { $sql .= " AND posts.brand LIKE ?"; $params[] = "%$brand%"; }
if ($user)  { $sql .= " AND users.username LIKE ?"; $params[] = "%$user%"; }
if ($date)  { $sql .= " AND DATE(posts.created_at) = ?"; $params[] = $date; }

$sql .= " ORDER BY posts.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$posts = $stmt->fetchAll();
?>

<section class="filters">
    <form method="GET">
        <input type="text" name="brand" placeholder="Marca..." value="<?= htmlspecialchars($brand) ?>">
        <input type="text" name="username" placeholder="Usuario..." value="<?= htmlspecialchars($user) ?>">
        <input type="date" name="date" value="<?= htmlspecialchars($date) ?>">
        <button type="submit">Filtrar</button>
        <a href="feed.php" class="btn-clean">Limpiar</a>
    </form>
</section>

<div class="container">
    <a href="create_post.php" class="btn-new">Compartir un reloj</a>

    <?php foreach ($posts as $post): ?>
    <article class="watch-card">
        <div class="post-meta">
            <img src="../assets/avatars/avatar<?= $post['avatar'] ?>.png" class="mini-avatar">
            <strong><?= htmlspecialchars($post['username']) ?></strong>
        </div>
        <h2>
            <span class="badge"><?= htmlspecialchars($post['brand']) ?></span> 
            <a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
        </h2>
        <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
    </article>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
