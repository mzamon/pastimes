<?php
$pageTitle = 'Manage Users';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdmin();

$stmt = mysqli_prepare($conn,
    "SELECT id, name, email, role, is_verified, seller_request, created_at, last_login
    FROM tblUser
     ORDER BY created_at DESC");
mysqli_stmt_execute($stmt);
$users = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Manage Users</h1>

<div style="margin-bottom:1rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
    <a href="<?php echo BASE_URL; ?>admin/verify_users.php" class="btn btn-secondary">Verification Queue</a>
    <a href="<?php echo BASE_URL; ?>admin/dashboard.php" class="btn btn-secondary">Dashboard</a>
</div>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Verified</th>
                <th>Seller Request</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo h($user['name']); ?></td>
                    <td><?php echo h($user['email']); ?></td>
                    <td><?php echo h($user['role']); ?></td>
                    <td><?php echo verificationBadge($user['is_verified']); ?></td>
                    <td><?php echo sellerRequestBadge($user['seller_request']); ?></td>
                    <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                    <td style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <a href="<?php echo BASE_URL; ?>admin/edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="delete_user.php" onsubmit="return confirm('Delete this user?');">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
