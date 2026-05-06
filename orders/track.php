<?php
$pageTitle = 'My Orders';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin(); // Any logged-in user can view their own orders

$stmt = mysqli_prepare($conn,
    "SELECT o.*, GROUP_CONCAT(p.title SEPARATOR ', ') AS items_summary
    FROM tblOrders o
     LEFT JOIN order_items oi ON o.id = oi.order_id
    LEFT JOIN tblProducts p ON oi.product_id = p.id
     WHERE o.buyer_id = ?
     GROUP BY o.id
     ORDER BY o.created_at DESC");
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$orders = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">My Orders</h1>

<?php if (empty($orders)): ?>
    <div class="alert alert-error">
        You have not placed any orders yet. <a href="<?php echo BASE_URL; ?>products/index.php">Start shopping</a>
    </div>
<?php else: ?>
    <?php foreach ($orders as $o): ?>
        <div class="order-card">
            <div class="order-header">
                <div>
                    <p class="order-id">Order #<?php echo $o['id']; ?></p>
                    <p class="order-meta">
                        <?php echo date('d M Y H:i', strtotime($o['created_at'])); ?>
                        &nbsp;·&nbsp; R <?php echo number_format($o['total'], 2); ?>
                        &nbsp;·&nbsp; <?php echo h($o['payment_method'] ?? 'N/A'); ?>
                    </p>
                </div>
                <?php echo statusBadge($o['status']); ?>
            </div>
            <p class="text-muted" style="font-size:0.88rem; margin-bottom:0.4rem;">
                <strong>Items:</strong> <?php echo h($o['items_summary'] ?? 'N/A'); ?>
            </p>
            <p class="text-muted" style="font-size:0.88rem; margin-bottom:0.4rem;">
                <strong>Deliver to:</strong> <?php echo h($o['delivery_address']); ?>
            </p>
            <?php if (!empty($o['tracking_number'])): ?>
                <p class="text-muted" style="font-size:0.88rem;">
                    <strong>Tracking #:</strong> <?php echo h($o['tracking_number']); ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
