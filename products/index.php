<?php
$pageTitle = 'Browse Products';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
$search      = isset($_GET['search'])   ? sanitize($_GET['search']) : '';

// Categories for filter dropdown
$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
$categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

// Build dynamic query with prepared statement
$sql    = "SELECT p.*, c.name AS category_name, u.name AS seller_name
           FROM tblProducts p
           JOIN categories c ON p.category_id = c.id
           JOIN tblUser u ON p.seller_id = u.id
           WHERE p.status = 'active'";
$params = [];
$types  = '';

if ($category_id > 0) {
    $sql    .= " AND p.category_id = ?";
    $params[] = $category_id;
    $types   .= 'i';
}
if ($search !== '') {
    $like     = '%' . $search . '%';
    $sql     .= " AND (p.title LIKE ? OR p.description LIKE ?)";
    $params[] = $like;
    $params[] = $like;
    $types   .= 'ss';
}
$sql .= " ORDER BY p.created_at DESC";

$stmt = mysqli_prepare($conn, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$products = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Browse Products</h1>

<div class="filter-bar">
    <form method="GET" action="" style="display:contents;">
        <select name="category" class="form-control" onchange="this.form.submit()">
            <option value="0">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo $category_id == $cat['id'] ? 'selected' : ''; ?>>
                    <?php echo h($cat['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="search" class="form-control" placeholder="Search products…"
               value="<?php echo h($search); ?>" style="flex:1; min-width:180px;">
        <button type="submit" class="btn btn-primary">Search</button>
        <?php if ($category_id > 0 || $search !== ''): ?>
            <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-secondary">Clear</a>
        <?php endif; ?>
    </form>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-error">No products found. <a href="<?php echo BASE_URL; ?>products/index.php">Clear filters</a></div>
<?php else: ?>
    <div class="product-grid">
        <?php foreach ($products as $p): ?>
            <div class="card">
                <a href="<?php echo BASE_URL; ?>products/view.php?id=<?php echo $p['id']; ?>">
                    <img src="<?php echo getProductImage($p['image']); ?>"
                         alt="<?php echo h($p['title']); ?>" class="card-img">
                </a>
                <div class="card-body">
                    <p class="card-meta"><?php echo h($p['category_name']); ?> · <?php echo h($p['condition']); ?></p>
                    <div class="card-title"><?php echo h($p['title']); ?></div>
                    <div class="card-price">R <?php echo number_format($p['price'], 2); ?></div>
                    <p class="card-meta">by <?php echo h($p['seller_name']); ?></p>
                    <a href="<?php echo BASE_URL; ?>products/view.php?id=<?php echo $p['id']; ?>" class="btn btn-primary btn-full">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
