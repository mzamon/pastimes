<?php
$pageTitle = 'Messages';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();
$uid = $_SESSION['user_id'];

// Get the most recent message per conversation (product + pair of users)
$stmt = mysqli_prepare($conn,
    "SELECT m.*, p.title AS product_title,
            us.name AS sender_name, ur.name AS receiver_name
    FROM tblMessages m
    JOIN tblProducts p ON m.product_id = p.id
    JOIN tblUser us ON m.sender_id = us.id
    JOIN tblUser ur ON m.receiver_id = ur.id
     WHERE m.sender_id = ? OR m.receiver_id = ?
     ORDER BY m.sent_at DESC");
mysqli_stmt_bind_param($stmt, 'ii', $uid, $uid);
mysqli_stmt_execute($stmt);
$all = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

// Deduplicate into conversations keyed by product + user pair
$conversations = [];
foreach ($all as $msg) {
    $other = ($msg['sender_id'] == $uid) ? $msg['receiver_id'] : $msg['sender_id'];
    $key   = $msg['product_id'] . '_' . min($uid, $other) . '_' . max($uid, $other);
    if (!isset($conversations[$key])) {
        $conversations[$key] = $msg;
        $conversations[$key]['other_user_id']   = $other;
        $conversations[$key]['other_user_name']  = ($msg['sender_id'] == $uid)
            ? $msg['receiver_name'] : $msg['sender_name'];
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Messages</h1>

<?php if (empty($conversations)): ?>
    <div class="alert alert-error">No messages yet. Browse a listing and message a seller to get started.</div>
<?php else: ?>
    <?php foreach ($conversations as $c): ?>
        <div class="conv-card">
            <div class="conv-info">
                <h3><?php echo h($c['product_title']); ?></h3>
                <p class="text-muted" style="font-size:0.85rem; margin-bottom:0.25rem;">
                    With <strong><?php echo h($c['other_user_name']); ?></strong>
                </p>
                <p class="conv-preview"><?php echo h(mb_strimwidth($c['message'], 0, 90, '…')); ?></p>
                <small class="text-muted"><?php echo date('d M Y H:i', strtotime($c['sent_at'])); ?></small>
            </div>
            <a href="<?php echo BASE_URL; ?>messages/chat.php?product_id=<?php echo $c['product_id']; ?>&user_id=<?php echo $c['other_user_id']; ?>"
               class="btn btn-primary btn-sm">Open Chat</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
