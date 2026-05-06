<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Dynamically determine BASE_URL so the site works under both
// Apache/XAMPP (e.g. /pastimes/) and the PHP built-in server (project root).
// Only use /pastimes/ if SCRIPT_NAME explicitly contains /pastimes/
// (meaning the server is configured to serve via Apache/subfolder).
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/');
$baseUrl = '/';

// If the script is under /pastimes/ in the URL, we're hosted in Apache subfolder
if (strpos($scriptName, '/pastimes/') === 0) {
    $baseUrl = '/pastimes/';
}
define('BASE_URL', $baseUrl);
define('UPLOAD_DIR', __DIR__ . '/../assets/images/uploads/');
define('IMAGE_BASE', BASE_URL . 'assets/images/');

// Text scanning + validation helpers (sanitization middleware)
require_once __DIR__ . '/TextScanner.php';

// NOTE: Global output scanning was causing hyphenated classnames and
// filenames to be rewritten (breaking CSS and image paths). Disable
// the automatic output filter to preserve markup integrity.
// If you need text-only sanitization, call `scanWebsiteText()` on
// specific user-submitted fields instead of buffering all output.
// if (!headers_sent()) {
//     ob_start('scanWebsiteText');
// }

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

function isVerified() {
    return isset($_SESSION['is_verified']) && (int)$_SESSION['is_verified'] === 1;
}

function isSellerRequestPending() {
    return isset($_SESSION['seller_request']) && $_SESSION['seller_request'] === 'pending';
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect(BASE_URL . 'auth/login.php');
    }
}

function requireVerified() {
    requireLogin();
    if (!isVerified()) {
        redirect(BASE_URL . 'auth/login.php?pending=1');
    }
}

function requireSeller() {
    requireLogin();
    if (!isSeller()) {
        redirect(BASE_URL . 'index.php');
    }
    requireVerified();
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

function verificationBadge($isVerified) {
    $class = $isVerified ? 'status-delivered' : 'status-pending';
    $label = $isVerified ? 'Verified' : 'Pending approval';
    return '<span class="status-badge ' . $class . '">' . h($label) . '</span>';
}

function sellerRequestBadge($status) {
    $map = [
        'none'     => 'status-pending',
        'pending'  => 'status-packed',
        'approved' => 'status-delivered',
        'rejected' => 'status-transit',
    ];
    $class = $map[$status] ?? 'status-pending';
    return '<span class="status-badge ' . $class . '">' . h(ucfirst($status)) . '</span>';
}
?>