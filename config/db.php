<?php
require_once __DIR__ . '/DBConn.php';

if (!isset($conn) || !$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
?>