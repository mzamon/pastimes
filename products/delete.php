<?php
$pageTitle = 'Delete Listing';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireSeller();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) redirect(BASE_URL . 'products/index.php');

// Verify ownership
$chk = mysqli_prepare($conn, "SELECT seller_id FROM tblProducts WHERE id = ?");
mysqli_stmt_bind_param($chk, 'i', $id);
mysqli_stmt_execute($chk);
mysqli_stmt_store_result($chk);
mysqli_stmt_bind_result($chk, $seller_id);
mysqli_stmt_fetch($chk);
mysqli_stmt_close($chk);

if ($seller_id != $_SESSION['user_id']) {
    redirect(BASE_URL . 'products/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM tblProducts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    redirect(BASE_URL . 'products/index.php');
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="confirm-box">
    <div class="confirm-icon">&#9888;</div>
    <h1 style="font-size:1.5rem; margin-bottom:0.5rem;">Delete Listing?</h1>
    <p class="text-muted" style="margin-bottom:1.5rem;">
        This action cannot be undone. The listing will be permanently removed.
    </p>
    <form method="POST" action="">
        <div style="display:flex; justify-content:center; gap:0.75rem;">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
            <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
