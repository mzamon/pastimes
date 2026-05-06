<?php
$pageTitle = 'Manage Orders';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireSeller();

// Handle status update (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id   = intval($_POST['order_id'] ?? 0);
    $new_status = sanitize($_POST['status']          ?? '');
    $tracking   = sanitize($_POST['tracking_number'] ?? '');
    $allowed    = ['Pending','Packed','In Transit','Delivered'];

    if ($order_id > 0 && in_array($new_status, $allowed)) {
        // Verify this seller has a product in the order
        $chk = mysqli_prepare($conn,
            "SELECT o.id FROM orders o
             JOIN order_items oi ON o.id = oi.order_id
             JOIN products p ON oi.product_id = p.id
             WHERE o.id = ? AND p.seller_id = ?
             LIMIT 1");
        mysqli_stmt_bind_param($chk, 'ii', $order_id, $_SESSION['user_id']);
        mysqli_stmt_execute($chk);
        mysqli_stmt_store_result($chk);
        if (mysqli_stmt_num_rows($chk) > 0) {
            $upd = mysqli_prepare($conn, "UPDATE orders SET status=?, tracking_number=? WHERE id=?");
            mysqli_stmt_bind_param($upd, 'ssi', $new_status, $tracking, $order_id);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);
        }
        mysqli_stmt_close($chk);
    }
    redirect(BASE_URL . 'orders/manage.php');
}

// Fetch orders containing this seller's products
$stmt = mysqli_prepare($conn,
    "SELECT DISTINCT o.*, u.name AS buyer_name,
            GROUP_CONCAT(p.title SEPARATOR ', ') AS product_titles
     FROM orders o
     JOIN order_items oi ON o.id = oi.order_id
     JOIN products p ON oi.product_id = p.id
     JOIN users u ON o.buyer_id = u.id
     WHERE p.seller_id = ?
     GROUP BY o.id
     ORDER BY o.created_at DESC");
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$orders = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Manage Orders</h1>

<?php if (empty($orders)): ?>
    <div class="alert alert-error">No orders for your products yet.</div>
<?php else: ?>
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Buyer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tracking #</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                    <tr>
                        <td>#<?php echo $o['id']; ?><br>
                            <small class="text-muted"><?php echo date('d M Y', strtotime($o['created_at'])); ?></small>
                        </td>
                        <td><?php echo h($o['buyer_name']); ?></td>
                        <td style="max-width:180px; font-size:0.85rem;"><?php echo h($o['product_titles']); ?></td>
                        <td>R <?php echo number_format($o['total'], 2); ?></td>
                        <td><?php echo statusBadge($o['status']); ?></td>
                        <td>
                            <?php if (!empty($o['tracking_number'])): ?>
                                <code style="font-size:0.8rem;"><?php echo h($o['tracking_number']); ?></code>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Each row has its own self-contained form -->
                            <form method="POST" action="" style="display:flex; flex-direction:column; gap:0.4rem; min-width:170px;">
                                <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                <select name="status" class="form-control" style="width:100%;">
                                    <?php foreach (['Pending','Packed','In Transit','Delivered'] as $s): ?>
                                        <option value="<?php echo $s; ?>" <?php echo $o['status'] === $s ? 'selected' : ''; ?>>
                                            <?php echo $s; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" name="tracking_number" class="form-control"
                                       placeholder="Tracking #"
                                       value="<?php echo h($o['tracking_number'] ?? ''); ?>">
                                <button type="submit" name="update_status" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
