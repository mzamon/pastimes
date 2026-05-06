<?php
$pageTitle = 'Seller Request';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

$errors = [];
$success = '';
$post = [];

$stmt = mysqli_prepare($conn, "SELECT u.seller_request, u.seller_request_note, COALESCE(r.status, u.seller_request) AS request_status, COALESCE(r.motivation, u.seller_request_note) AS request_note FROM tblUser u LEFT JOIN tblSellerRequests r ON r.user_id = u.id WHERE u.id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$current = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['reason'] = sanitize($_POST['reason'] ?? '');
    if (empty($post['reason'])) {
        $errors[] = 'Please explain what you want to sell.';
    }

    if (empty($errors)) {
        $upd = mysqli_prepare($conn, "UPDATE tblUser SET seller_request = 'pending', seller_request_note = ? WHERE id = ?");
        mysqli_stmt_bind_param($upd, 'si', $post['reason'], $_SESSION['user_id']);
        $okUser = mysqli_stmt_execute($upd);
        mysqli_stmt_close($upd);

        $req = mysqli_prepare($conn, "INSERT INTO tblSellerRequests (user_id, motivation, status) VALUES (?, ?, 'pending') ON DUPLICATE KEY UPDATE motivation = VALUES(motivation), status = 'pending', updated_at = CURRENT_TIMESTAMP");
        mysqli_stmt_bind_param($req, 'is', $_SESSION['user_id'], $post['reason']);
        $okReq = mysqli_stmt_execute($req);
        mysqli_stmt_close($req);

        if ($okUser && $okReq) {
            $_SESSION['seller_request'] = 'pending';
            $success = 'Your seller request has been submitted for review.';
        } else {
            $errors[] = 'Unable to submit request right now.';
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Seller Request</h1>

<div class="form-wrap">
    <div style="margin-bottom:1rem;">
        <?php echo sellerRequestBadge($current['request_status'] ?? 'none'); ?>
    </div>

    <?php foreach ($errors as $e) echo displayError($e); ?>
    <?php if ($success) echo displaySuccess($success); ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="reason">What would you like to sell?</label>
            <textarea id="reason" name="reason" class="form-control" rows="4" required><?php echo h($post['reason'] ?? ($current['request_note'] ?? '')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-full">Submit Seller Request</button>
        <p class="mt-1 text-muted" style="font-size:0.9rem; text-align:center;">
            Your request will remain pending until an administrator approves it.
        </p>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
