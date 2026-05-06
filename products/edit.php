<?php
$pageTitle = 'Edit Listing';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireSeller();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) redirect(BASE_URL . 'products/index.php');

// Verify ownership
$chk = mysqli_prepare($conn, "SELECT seller_id, image FROM tblProducts WHERE id = ?");
mysqli_stmt_bind_param($chk, 'i', $id);
mysqli_stmt_execute($chk);
$chk_result = mysqli_stmt_get_result($chk);
$product = mysqli_fetch_assoc($chk_result);
mysqli_stmt_close($chk);

if (!$product || $product['seller_id'] != $_SESSION['user_id']) {
    redirect(BASE_URL . 'products/index.php');
}

// Get categories
$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
$categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = sanitize($_POST['title']       ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $price       = floatval($_POST['price']        ?? 0);
    $category_id = intval($_POST['category_id']     ?? 0);
    $condition   = sanitize($_POST['condition']    ?? 'Good');

    // Validation
    if (empty($title))        $errors[] = 'Title is required.';
    if (empty($description))   $errors[] = 'Description is required.';
    if ($price <= 0)          $errors[] = 'Price must be greater than zero.';
    if ($category_id <= 0)    $errors[] = 'Please select a category.';

    $image_path = $product['image'];

    // New image upload
    if (!empty($_FILES['image']['tmp_name'])) {
        $allowed = ['jpg','jpeg','png','gif','webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $errors[] = 'Invalid image format.';
        } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Image too large. Max 2MB.';
        } else {
            $filename = uniqid() . '.' . $ext;
            $dest = UPLOAD_DIR . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $image_path = 'uploads/' . $filename;
            } else {
                $errors[] = 'Failed to upload image.';
            }
        }
    }

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn,
            "UPDATE tblProducts SET category_id=?, title=?, description=?, price=?, `condition`=?, image=?, updated_at=NOW()
             WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'issdssi', $category_id, $title, $description, $price, $condition, $image_path, $id);
        if (mysqli_stmt_execute($stmt)) {
            redirect(BASE_URL . 'products/view.php?id=' . $id);
        } else {
            $errors[] = 'Failed to update listing.';
        }
        mysqli_stmt_close($stmt);
    }
} else {
    // Fetch current values
    $stmt = mysqli_prepare($conn, "SELECT * FROM tblProducts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $post = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Edit Listing</h1>

<div class="form-wrap">
    <?php foreach ($errors as $e) echo displayError($e); ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required
                   value="<?php echo h($post['title'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">Select category…</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo ($post['category_id'] ?? 0) == $cat['id'] ? 'selected' : ''; ?>>
                        <?php echo h($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row cols-2">
            <div class="form-group">
                <label for="price">Price (R)</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" min="0.01" required
                       value="<?php echo h($post['price'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="condition">Condition</label>
                <select id="condition" name="condition" class="form-control" required>
                    <?php foreach (['New','Like New','Good','Fair','Poor'] as $cond): ?>
                        <option value="<?php echo $cond; ?>" <?php echo ($post['condition'] ?? '') === $cond ? 'selected' : ''; ?>>
                            <?php echo $cond; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required><?php echo h($post['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Change Product Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Leave empty to keep current image. Max 2MB.</small>
        </div>
        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary" style="flex:1;">Save Changes</button>
            <a href="<?php echo BASE_URL; ?>products/view.php?id=<?php echo $id; ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
