<?php
$pageTitle = 'Order Confirmed';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) redirect(BASE_URL . 'index.php');

$stmt = mysqli_prepare($conn, "SELECT * FROM tblOrders WHERE id = ? AND buyer_id = ?");
mysqli_stmt_bind_param($stmt, 'ii', $id, $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$order) redirect(BASE_URL . 'index.php');

require_once __DIR__ . '/../includes/header.php';
?>

<div class="confirm-box">
    <div class="confirm-icon">&#10003;</div>
    <h1 style="font-size:1.5rem; margin-bottom:0.5rem;">Order Placed!</h1>
    <p class="text-muted" style="margin-bottom:1.5rem;">Thank you for your purchase.</p>
    <div style="text-align:left; border-top:1px solid var(--border); padding-top:1rem;">
        <p style="margin-bottom:0.5rem;"><strong>Order #<?php echo $order['id']; ?></strong></p>
        <p style="margin-bottom:0.5rem;">Total: <strong>R <?php echo number_format($order['total'], 2); ?></strong></p>
        <p style="margin-bottom:0.5rem;">Status: <?php echo statusBadge($order['status']); ?></p>
        <p style="margin-bottom:0.5rem;" class="text-muted">Deliver to: <?php echo h($order['delivery_address']); ?></p>
    </div>
    <div style="display:flex; flex-direction:column; gap:0.6rem; margin-top:1.5rem;">
        <a href="<?php echo BASE_URL; ?>orders/track.php" class="btn btn-primary">Track My Orders</a>
        <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-secondary">Continue Shopping</a>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
