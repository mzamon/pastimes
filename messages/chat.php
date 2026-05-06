<?php
$pageTitle = 'Chat';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

$product_id    = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$other_user_id = isset($_GET['user_id'])    ? intval($_GET['user_id'])    : 0;
$current_uid   = $_SESSION['user_id'];

if ($product_id <= 0 || $other_user_id <= 0) redirect(BASE_URL . 'messages/inbox.php');

// Fetch product title
$pst = mysqli_prepare($conn, "SELECT title FROM products WHERE id = ?");
mysqli_stmt_bind_param($pst, 'i', $product_id);
mysqli_stmt_execute($pst);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($pst));
mysqli_stmt_close($pst);
if (!$product) redirect(BASE_URL . 'messages/inbox.php');

// Fetch other user name
$ust = mysqli_prepare($conn, "SELECT name FROM users WHERE id = ?");
mysqli_stmt_bind_param($ust, 'i', $other_user_id);
mysqli_stmt_execute($ust);
$other_user = mysqli_fetch_assoc(mysqli_stmt_get_result($ust));
mysqli_stmt_close($ust);
if (!$other_user) redirect(BASE_URL . 'messages/inbox.php');

// Fetch thread
$mst = mysqli_prepare($conn,
    "SELECT m.*, u.name AS sender_name
     FROM messages m JOIN users u ON m.sender_id = u.id
     WHERE m.product_id = ?
       AND ((m.sender_id = ? AND m.receiver_id = ?)
         OR (m.sender_id = ? AND m.receiver_id = ?))
     ORDER BY m.sent_at ASC");
mysqli_stmt_bind_param($mst, 'iiiii', $product_id, $current_uid, $other_user_id, $other_user_id, $current_uid);
mysqli_stmt_execute($mst);
$thread = mysqli_fetch_all(mysqli_stmt_get_result($mst), MYSQLI_ASSOC);
mysqli_stmt_close($mst);

// Mark received messages as read
$read = mysqli_prepare($conn,
    "UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ? AND product_id = ?");
mysqli_stmt_bind_param($read, 'iii', $current_uid, $other_user_id, $product_id);
mysqli_stmt_execute($read);
mysqli_stmt_close($read);

$pageTitle = 'Chat — ' . $product['title'];
require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Chat: <?php echo h($product['title']); ?></h1>
<p class="text-muted mb-1">Chatting with <strong><?php echo h($other_user['name']); ?></strong></p>

<div class="message-thread">
    <?php if (empty($thread)): ?>
        <p class="text-muted" style="text-align:center; padding:1rem;">No messages yet — send the first one!</p>
    <?php else: ?>
        <?php foreach ($thread as $msg): ?>
            <div class="message-bubble <?php echo $msg['sender_id'] == $current_uid ? 'message-sent' : 'message-received'; ?>">
                <p style="margin:0;"><?php echo h($msg['message']); ?></p>
                <p class="message-meta"><?php echo date('H:i, d M Y', strtotime($msg['sent_at'])); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<form method="POST" action="send.php" class="message-form">
    <input type="hidden" name="product_id"  value="<?php echo $product_id; ?>">
    <input type="hidden" name="receiver_id" value="<?php echo $other_user_id; ?>">
    <input type="text" name="message" class="form-control" placeholder="Type a message…" required autocomplete="off" maxlength="1000">
    <button type="submit" class="btn btn-primary">Send</button>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
