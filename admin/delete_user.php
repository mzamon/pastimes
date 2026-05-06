<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdmin();

$id = intval($_POST['id'] ?? 0);
if ($id > 0 && $id !== (int)($_SESSION['user_id'] ?? 0)) {
    $req = mysqli_prepare($conn, "DELETE FROM tblSellerRequests WHERE user_id = ?");
    mysqli_stmt_bind_param($req, 'i', $id);
    mysqli_stmt_execute($req);
    mysqli_stmt_close($req);

    $del = mysqli_prepare($conn, "DELETE FROM tblUser WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($del, 'i', $id);
    mysqli_stmt_execute($del);
    mysqli_stmt_close($del);
}

redirect(BASE_URL . 'admin/users.php');
