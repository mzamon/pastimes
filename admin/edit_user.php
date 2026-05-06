<?php
$pageTitle = 'Edit User';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdmin();

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) redirect(BASE_URL . 'admin/users.php');

$stmt = mysqli_prepare($conn, "SELECT * FROM tblUser WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$user) redirect(BASE_URL . 'admin/users.php');

$errors = [];
$post = $user;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['name'] = sanitize($_POST['name'] ?? '');
    $post['email'] = sanitize($_POST['email'] ?? '');
    $post['role'] = sanitize($_POST['role'] ?? 'buyer');
    $post['is_verified'] = intval($_POST['is_verified'] ?? 0);
    $post['seller_request'] = sanitize($_POST['seller_request'] ?? 'none');
    $post['seller_request_note'] = sanitize($_POST['seller_request_note'] ?? '');

    if (empty($post['name'])) $errors[] = 'Name is required.';
    if (empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (!in_array($post['role'], ['buyer','seller','admin'])) $errors[] = 'Invalid role.';
    if (!in_array($post['seller_request'], ['none','pending','approved','rejected'])) $errors[] = 'Invalid seller request state.';

    if (empty($errors)) {
        $upd = mysqli_prepare($conn,
            "UPDATE tblUser SET name = ?, email = ?, role = ?, is_verified = ?, seller_request = ?, seller_request_note = ? WHERE id = ?");
        mysqli_stmt_bind_param($upd, 'sssissi', $post['name'], $post['email'], $post['role'], $post['is_verified'], $post['seller_request'], $post['seller_request_note'], $id);
        if (mysqli_stmt_execute($upd)) {
            $req = mysqli_prepare($conn,
                "INSERT INTO tblSellerRequests (user_id, motivation, status) VALUES (?, ?, ?) 
                 ON DUPLICATE KEY UPDATE motivation = VALUES(motivation), status = VALUES(status), updated_at = CURRENT_TIMESTAMP");
            mysqli_stmt_bind_param($req, 'iss', $id, $post['seller_request_note'], $post['seller_request']);
            mysqli_stmt_execute($req);
            mysqli_stmt_close($req);

            redirect(BASE_URL . 'admin/users.php');
        } else {
            $errors[] = 'Unable to update user.';
        }
        mysqli_stmt_close($upd);
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Edit User</h1>

<div class="form-wrap">
    <?php foreach ($errors as $e) echo displayError($e); ?>
    <form method="POST" action="">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo h($post['name']); ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo h($post['email']); ?>">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="buyer" <?php echo $post['role'] === 'buyer' ? 'selected' : ''; ?>>Buyer</option>
                <option value="seller" <?php echo $post['role'] === 'seller' ? 'selected' : ''; ?>>Seller</option>
                <option value="admin" <?php echo $post['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label>Verified</label>
            <select name="is_verified" class="form-control">
                <option value="0" <?php echo (int)$post['is_verified'] === 0 ? 'selected' : ''; ?>>No</option>
                <option value="1" <?php echo (int)$post['is_verified'] === 1 ? 'selected' : ''; ?>>Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label>Seller Request</label>
            <select name="seller_request" class="form-control">
                <?php foreach (['none','pending','approved','rejected'] as $state): ?>
                    <option value="<?php echo $state; ?>" <?php echo $post['seller_request'] === $state ? 'selected' : ''; ?>><?php echo ucfirst($state); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Seller Request Note</label>
            <textarea name="seller_request_note" class="form-control"><?php echo h($post['seller_request_note'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-full">Save User</button>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
