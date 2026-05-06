<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_URL', '/pastimes/');
define('UPLOAD_DIR', __DIR__ . '/../assets/images/uploads/');
define('IMAGE_BASE', BASE_URL . 'assets/images/');

// ------------------------------------------------------------------
// SANITIZE — trim input only. DO NOT htmlspecialchars before DB.
// Use h() on OUTPUT. Prepared statements handle SQL injection.
// ------------------------------------------------------------------
function sanitize($data) {
    return trim(stripslashes($data));
}

// ------------------------------------------------------------------
// h() — HTML-safe output. Always use this when echoing user data.
// ------------------------------------------------------------------
function h($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

// ------------------------------------------------------------------
// getProductImage() — Returns full URL to product image or placeholder
// ------------------------------------------------------------------
function getProductImage($image) {
    if (empty($image)) {
        return IMAGE_BASE . 'placeholder/no-image.jpg';
    }
    $full_path = __DIR__ . '/../assets/images/' . $image;
    if (file_exists($full_path)) {
        return IMAGE_BASE . $image;
    }
    return IMAGE_BASE . 'placeholder/no-image.jpg';
}

// ------------------------------------------------------------------
// Redirect helper
// ------------------------------------------------------------------
function redirect($url) {
    header('Location: ' . $url);
    exit();
}

// ------------------------------------------------------------------
// Auth helpers
// ------------------------------------------------------------------
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isSeller() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'seller';
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isBuyer() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'buyer';
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect(BASE_URL . 'auth/login.php');
    }
}

function requireSeller() {
    requireLogin();
    if (!isSeller()) {
        redirect(BASE_URL . 'index.php');
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        redirect(BASE_URL . 'index.php');
    }
}

// ------------------------------------------------------------------
// Cart helpers
// ------------------------------------------------------------------
function getCartCount() {
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return array_sum(array_column($_SESSION['cart'], 'quantity'));
    }
    return 0;
}

// ------------------------------------------------------------------
// Alert helpers
// ------------------------------------------------------------------
function displayError($msg) {
    return '<div class="alert alert-error">' . h($msg) . '</div>';
}

function displaySuccess($msg) {
    return '<div class="alert alert-success">' . h($msg) . '</div>';
}

// ------------------------------------------------------------------
// Order status badge helper
// ------------------------------------------------------------------
function statusBadge($status) {
    $map = [
        'Pending'    => 'status-pending',
        'Packed'     => 'status-packed',
        'In Transit' => 'status-transit',
        'Delivered'  => 'status-delivered',
    ];
    $class = $map[$status] ?? 'status-pending';
    return '<span class="status-badge ' . $class . '">' . h($status) . '</span>';
}
?>