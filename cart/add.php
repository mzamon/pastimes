<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) redirect(BASE_URL . 'products/index.php');

// Fetch active product
$stmt = mysqli_prepare($conn, "SELECT id, title, price, seller_id, image FROM products WHERE id = ? AND status = 'active'");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$p = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$p) redirect(BASE_URL . 'products/index.php');

// Prevent seller adding own item
if ($p['seller_id'] == $_SESSION['user_id']) {
    redirect(BASE_URL . 'products/view.php?id=' . $id);
}

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity']++;
} else {
    $_SESSION['cart'][$id] = [
        'id'        => $p['id'],
        'title'     => $p['title'],
        'price'     => $p['price'],
        'quantity'  => 1,
        'seller_id' => $p['seller_id'],
        'image'     => $p['image'],
    ];
}

redirect(BASE_URL . 'cart/index.php');
?>
