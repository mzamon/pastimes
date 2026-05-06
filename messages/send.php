<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id  = intval($_POST['product_id']  ?? 0);
    $receiver_id = intval($_POST['receiver_id'] ?? 0);
    $message     = sanitize($_POST['message']   ?? '');

    if ($product_id > 0 && $receiver_id > 0 && $receiver_id != $_SESSION['user_id'] && !empty($message)) {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO messages (sender_id, receiver_id, product_id, message) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'iiis', $_SESSION['user_id'], $receiver_id, $product_id, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

$pid = intval($_POST['product_id']  ?? 0);
$uid = intval($_POST['receiver_id'] ?? 0);
redirect(BASE_URL . 'messages/chat.php?product_id=' . $pid . '&user_id=' . $uid);
?>
