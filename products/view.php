<?php
$pageTitle = 'Product Details';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) redirect(BASE_URL . 'products/index.php');

// Fetch product with seller info
$stmt = mysqli_prepare($conn,
    "SELECT p.*, c.name AS category_name, u.name AS seller_name, u.email AS seller_email
     FROM products p
     JOIN categories c ON p.category_id = c.id
     JOIN users u ON p.seller_id = u.id
     WHERE p.id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$product) redirect(BASE_URL . 'products/index.php');

$pageTitle = h($product['title']);

// Check if current user is the seller
$isOwner = isLoggedIn() && $_SESSION['user_id'] == $product['seller_id'];

// Fetch reviews
$rst = mysqli_prepare($conn,
    "SELECT r.*, u.name AS reviewer_name
     FROM reviews r
     JOIN users u ON r.reviewer_id = u.id
     WHERE r.product_id = ?
     ORDER BY r.created_at DESC");
mysqli_stmt_bind_param($rst, 'i', $id);
mysqli_stmt_execute($rst);
$reviews = mysqli_fetch_all(mysqli_stmt_get_result($rst), MYSQLI_ASSOC);
mysqli_stmt_close($rst);

require_once __DIR__ . '/../includes/header.php';
?>

<div class="product-detail">
    <div>
        <img src="<?php echo getProductImage($product['image']); ?>"
             alt="<?php echo h($product['title']); ?>" class="product-detail-img">
    </div>
    <div class="product-info">
        <p class="product-meta"><?php echo h($product['category_name']); ?> · <?php echo h($product['condition']); ?></p>
        <h1><?php echo h($product['title']); ?></h1>
        <div class="product-price">R <?php echo number_format($product['price'], 2); ?></div>
        <p><?php echo nl2br(h($product['description'])); ?></p>

        <div class="product-actions">
            <?php if ($product['status'] === 'sold'): ?>
                <span class="btn btn-secondary" style="cursor:default;">Sold</span>
            <?php elseif ($isOwner): ?>
                <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary">Edit Listing</a>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>cart/add.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-lg">Add to Cart</a>
                <a href="<?php echo BASE_URL; ?>messages/chat.php?product_id=<?php echo $product['id']; ?>&user_id=<?php echo $product['seller_id']; ?>" class="btn btn-secondary">Message Seller</a>
            <?php endif; ?>
        </div>

        <p class="text-muted" style="margin-top:1rem;">
            Sold by <strong><?php echo h($product['seller_name']); ?></strong>
        </p>
    </div>
</div>

<!-- Reviews -->
<h2 class="section-title" style="margin-top:2.5rem;">Reviews</h2>
<?php if (empty($reviews)): ?>
    <p class="text-muted">No reviews yet.</p>
<?php else: ?>
    <?php foreach ($reviews as $r): ?>
        <div class="review-card">
            <div class="review-stars"><?php echo str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']); ?></div>
            <div class="review-body"><?php echo h($r['comment']); ?></div>
            <div class="review-meta">— <?php echo h($r['reviewer_name']); ?>, <?php echo date('d M Y', strtotime($r['created_at'])); ?></div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
