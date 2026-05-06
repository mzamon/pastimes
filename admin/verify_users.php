<?php
$pageTitle = 'Verify Users';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id'] ?? 0);
    $action = sanitize($_POST['action'] ?? '');

    if ($user_id > 0 && in_array($action, ['approve', 'reject'])) {
        if ($action === 'approve') {
            $role = sanitize($_POST['role'] ?? 'buyer');
            if (!in_array($role, ['buyer', 'seller', 'admin'])) {
                $role = 'buyer';
            }
            $upd = mysqli_prepare($conn, "UPDATE tblUser SET is_verified = 1, seller_request = 'approved', role = ? WHERE id = ?");
            mysqli_stmt_bind_param($upd, 'si', $role, $user_id);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);

            $req = mysqli_prepare($conn, "INSERT INTO tblSellerRequests (user_id, status) VALUES (?, 'approved') ON DUPLICATE KEY UPDATE status = 'approved', updated_at = CURRENT_TIMESTAMP");
            mysqli_stmt_bind_param($req, 'i', $user_id);
            mysqli_stmt_execute($req);
            mysqli_stmt_close($req);
        } else {
            $upd = mysqli_prepare($conn, "UPDATE tblUser SET is_verified = 0, seller_request = 'rejected', role = 'buyer' WHERE id = ?");
            mysqli_stmt_bind_param($upd, 'i', $user_id);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);

            $req = mysqli_prepare($conn, "INSERT INTO tblSellerRequests (user_id, status) VALUES (?, 'rejected') ON DUPLICATE KEY UPDATE status = 'rejected', updated_at = CURRENT_TIMESTAMP");
            mysqli_stmt_bind_param($req, 'i', $user_id);
            mysqli_stmt_execute($req);
            mysqli_stmt_close($req);
        }
    }

    redirect(BASE_URL . 'admin/verify_users.php');
}

$stmt = mysqli_prepare($conn,
    "SELECT u.id, u.name, u.email, u.role, u.is_verified,
            COALESCE(r.status, u.seller_request) AS seller_request,
            COALESCE(r.motivation, u.seller_request_note) AS seller_request_note,
            u.created_at
    FROM tblUser u
     LEFT JOIN tblSellerRequests r ON r.user_id = u.id
     WHERE u.is_verified = 0 OR COALESCE(r.status, u.seller_request) = 'pending'
     ORDER BY u.created_at DESC");
mysqli_stmt_execute($stmt);
$pending_users = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Verify Users</h1>

<?php if (empty($pending_users)): ?>
    <div class="alert alert-success">There are no pending users or seller requests.</div>
<?php else: ?>
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Request</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_users as $user): ?>
                    <tr>
                        <td><?php echo h($user['name']); ?></td>
                        <td><?php echo h($user['email']); ?></td>
                        <td><?php echo h($user['role']); ?></td>
                        <td><?php echo verificationBadge($user['is_verified']); ?></td>
                        <td style="max-width:260px;">
                            <strong><?php echo sellerRequestBadge($user['seller_request']); ?></strong><br>
                            <span class="text-muted"><?php echo h($user['seller_request_note'] ?? 'No note provided'); ?></span>
                        </td>
                        <td>
                            <form method="POST" action="" style="display:flex; flex-direction:column; gap:0.5rem; min-width:190px;">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <select name="role" class="form-control">
                                    <option value="buyer" <?php echo $user['role'] === 'buyer' ? 'selected' : ''; ?>>Buyer</option>
                                    <option value="seller" <?php echo $user['role'] === 'seller' ? 'selected' : ''; ?>>Seller</option>
                                    <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <div style="display:flex; gap:0.5rem;">
                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
