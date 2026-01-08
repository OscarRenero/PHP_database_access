<?php
require '../includes/auth.php';
require '../config/db.php';
include '../includes/header.php';

// 1. Recoger valores del formulario de filtro (si existen)
$brand_filter = $_GET['brand'] ?? '';
$user_filter  = $_GET['username'] ?? '';
$date_filter  = $_GET['date'] ?? '';

// 2. Construir la consulta base
$query = "SELECT posts.*, users.username 
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          WHERE 1=1"; // El 1=1 es un truco para añadir "AND" fácilmente

$params = [];

// 3. Añadir condiciones según los filtros rellenos
if (!empty($brand_filter)) {
    $query .= " AND posts.brand LIKE ?";
    $params[] = "%$brand_filter%";
}

if (!empty($user_filter)) {
    $query .= " AND users.username LIKE ?";
    $params[] = "%$user_filter%";
}

if (!empty($date_filter)) {
    $query .= " AND DATE(posts.created_at) = ?";
    $params[] = $date_filter;
}

$query .= " ORDER BY posts.created_at DESC";

// 4. Ejecutar consulta preparada
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$posts = $stmt->fetchAll();
?>

<section class="filters">
    <form method="GET" action="feed.php" class="filter-form">
        <input type="text" name="brand" placeholder="Marca (Rolex, Seiko...)" value="<?= htmlspecialchars($brand_filter) ?>">
        <input type="text" name="username" placeholder="Usuario" value="<?= htmlspecialchars($user_filter) ?>">
        <input type="date" name="date" value="<?= htmlspecialchars($date_filter) ?>">
        <button type="submit">Filtrar</button>
        <a href="feed.php" class="btn-clean">Limpiar</a>
    </form>
</section>

<hr style="border: 0.5px solid #444; margin: 20px 0;">

<div class="container">
    <a href="create_post.php" class="btn-new">Compartir un reloj</a>

    <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
        <article class="watch-card">
            <h2>
                <span class="badge"><?= htmlspecialchars($post['brand']) ?></span> 
                <a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
            </h2>
            <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
            <small>Publicado por: <strong><?= htmlspecialchars($post['username']) ?></strong> el <?= date('d/m/Y', strtotime($post['created_at'])) ?></small>
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron relojes con esos filtros.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
