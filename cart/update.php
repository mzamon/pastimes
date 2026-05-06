<?php
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id  = intval($_POST['id']       ?? 0);
    $qty = intval($_POST['quantity'] ?? 0);

    if ($id > 0) {
        if ($qty < 1) {
            unset($_SESSION['cart'][$id]);
        } elseif (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
}

redirect(BASE_URL . 'cart/index.php');
?>
