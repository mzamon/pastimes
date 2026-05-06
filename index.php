<?php
$pageTitle = 'Home';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

// Featured products (latest 8 active)
$stmt = mysqli_prepare($conn,
    "SELECT p.*, c.name AS category_name, u.name AS seller_name
    FROM tblProducts p
     JOIN categories c ON p.category_id = c.id
    JOIN tblUser u ON p.seller_id = u.id
     WHERE p.status = 'active'
     ORDER BY p.created_at DESC
     LIMIT 8");
mysqli_stmt_execute($stmt);
$featured = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

// All categories
$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
$categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero -->
<section class="hero">
    <h1>Buy &amp; Sell Pre-Loved clothes &amp; co.</h1>
    <p>Pre-loved clothes — and the rest.</p>
    <div class="hero-ctas">
        <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-primary btn-lg">Browse Items</a>
        <?php if (!isLoggedIn()): ?>
            <a href="<?php echo BASE_URL; ?>auth/register.php" class="btn btn-secondary btn-lg">Get Started</a>
        <?php elseif (isSeller()): ?>
            <a href="<?php echo BASE_URL; ?>products/add.php" class="btn btn-secondary btn-lg">List an Item</a>
        <?php endif; ?>
    </div>
</section>

<!-- Categories -->
<div class="category-chips">
    <?php foreach ($categories as $cat): ?>
        <a href="<?php echo BASE_URL; ?>products/index.php?category=<?php echo $cat['id']; ?>" class="category-chip">
            <?php echo h($cat['name']); ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Featured listings -->
<h2 class="section-title">Featured Listings</h2>

<?php if (empty($featured)): ?>
    <p class="text-muted">No products available yet.</p>
<?php else: ?>
    <div class="product-grid">
        <?php foreach ($featured as $p): ?>
            <div class="card">
                <a href="<?php echo BASE_URL; ?>products/view.php?id=<?php echo $p['id']; ?>">
                    <img src="<?php echo getProductImage($p['image']); ?>"
                         alt="<?php echo h($p['title']); ?>" class="card-img">
                </a>
                <div class="card-body">
                    <p class="card-meta"><?php echo h($p['category_name']); ?> · <?php echo h($p['condition']); ?></p>
                    <div class="card-title"><?php echo h($p['title']); ?></div>
                    <div class="card-price">R <?php echo number_format($p['price'], 2); ?></div>
                    <a href="<?php echo BASE_URL; ?>products/view.php?id=<?php echo $p['id']; ?>"
                       class="btn btn-primary btn-full">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
