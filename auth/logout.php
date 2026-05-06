<?php
require_once __DIR__ . '/../includes/functions.php';

// 1. Wipe all session variables
$_SESSION = [];

// 2. Expire the session cookie on the client
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// 3. Destroy server-side session data
session_destroy();

redirect(BASE_URL . 'index.php');
?>
