<?php
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdmin();

// Stat queries — prepared statements for consistency
function getStat($conn, $sql) {
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_row(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row[0] ?? 0;
}

$total_users    = getStat($conn, "SELECT COUNT(*) FROM users");
$total_products = getStat($conn, "SELECT COUNT(*) FROM products");
$total_orders   = getStat($conn, "SELECT COUNT(*) FROM orders");
$total_messages = getStat($conn, "SELECT COUNT(*) FROM messages");
$pending_users  = getStat($conn, "SELECT COUNT(*) FROM users WHERE is_verified = 0");
$pending_sellers = getStat($conn, "SELECT COUNT(*) FROM users WHERE role = 'seller' AND seller_request = 'pending'");
$total_revenue_row = mysqli_query($conn, "SELECT COALESCE(SUM(total),0) FROM orders WHERE status='Delivered'");
$total_revenue  = mysqli_fetch_row($total_revenue_row)[0] ?? 0;

// Recent users (limit 10)
$ustmt = mysqli_prepare($conn,
    "SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 10");
mysqli_stmt_execute($ustmt);
$recent_users = mysqli_fetch_all(mysqli_stmt_get_result($ustmt), MYSQLI_ASSOC);
mysqli_stmt_close($ustmt);

// Recent orders (limit 10)
$ostmt = mysqli_prepare($conn,
    "SELECT o.id, o.total, o.status, o.created_at, u.name AS buyer_name
     FROM orders o JOIN users u ON o.buyer_id = u.id
     ORDER BY o.created_at DESC LIMIT 10");
mysqli_stmt_execute($ostmt);
$recent_orders = mysqli_fetch_all(mysqli_stmt_get_result($ostmt), MYSQLI_ASSOC);
mysqli_stmt_close($ostmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Admin Dashboard</h1>

<div class="stats-grid">
    <div class="stat-card"><div class="stat-number"><?php echo number_format($total_users); ?></div><div class="stat-label">Users</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo number_format($total_products); ?></div><div class="stat-label">Listings</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo number_format($total_orders); ?></div><div class="stat-label">Orders</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo number_format($total_messages); ?></div><div class="stat-label">Messages</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo number_format($pending_users); ?></div><div class="stat-label">Pending Verifications</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo number_format($pending_sellers); ?></div><div class="stat-label">Seller Requests</div></div>
    <div class="stat-card" style="grid-column: span 2;"><div class="stat-number">R <?php echo number_format($total_revenue, 2); ?></div><div class="stat-label">Revenue (Delivered)</div></div>
</div>

<div class="admin-quick-links">
    <a href="<?php echo BASE_URL; ?>admin/verify_users.php" class="btn btn-secondary">Verify Users</a>
    <a href="<?php echo BASE_URL; ?>admin/users.php" class="btn btn-secondary">Manage Users</a>
    <a href="<?php echo BASE_URL; ?>auth/request_seller.php" class="btn btn-secondary">Seller Requests</a>
</div>

<h2 class="section-title">Recent Users</h2>
<div class="table-wrap mb-2">
    <table class="data-table">
        <thead>
            <tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
        </thead>
        <tbody>
            <?php foreach ($recent_users as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo h($u['name']); ?></td>
                    <td><?php echo h($u['email']); ?></td>
                    <td><span class="status-badge <?php
                        echo $u['role'] === 'admin' ? 'status-transit' : ($u['role'] === 'seller' ? 'status-packed' : 'status-pending');
                    ?>"><?php echo h($u['role']); ?></span></td>
                    <td><?php echo date('d M Y', strtotime($u['created_at'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h2 class="section-title">Recent Orders</h2>
<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr><th>Order #</th><th>Buyer</th><th>Total</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php foreach ($recent_orders as $o): ?>
                <tr>
                    <td>#<?php echo $o['id']; ?></td>
                    <td><?php echo h($o['buyer_name']); ?></td>
                    <td>R <?php echo number_format($o['total'], 2); ?></td>
                    <td><?php echo statusBadge($o['status']); ?></td>
                    <td><?php echo date('d M Y', strtotime($o['created_at'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
