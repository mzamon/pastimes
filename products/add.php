<?php
$pageTitle = 'Sell Item';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

requireSeller();

$errors = [];
$post   = [];

// Get categories
$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
$categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['title']       = sanitize($_POST['title']       ?? '');
    $post['description'] = sanitize($_POST['description'] ?? '');
    $post['price']       = floatval($_POST['price']        ?? 0);
    $post['category_id'] = intval($_POST['category_id']     ?? 0);
    $post['condition']   = sanitize($_POST['condition']    ?? 'Good');

    // Validation
    if (empty($post['title']))        $errors[] = 'Title is required.';
    if (empty($post['description']))   $errors[] = 'Description is required.';
    if ($post['price'] <= 0)          $errors[] = 'Price must be greater than zero.';
    if ($post['category_id'] <= 0)    $errors[] = 'Please select a category.';
    if (!in_array($post['condition'], ['New','Like New','Good','Fair','Poor'])) {
        $errors[] = 'Please select a valid condition.';
    }

    // Image upload
    $image_path = '';
    if (!empty($_FILES['image']['tmp_name'])) {
        $allowed = ['jpg','jpeg','png','gif','webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $errors[] = 'Invalid image format. Allowed: jpg, jpeg, png, gif, webp';
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
            "INSERT INTO tblProducts (seller_id, category_id, title, description, price, `condition`, image)
             VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'iissdss',
            $_SESSION['user_id'],
            $post['category_id'],
            $post['title'],
            $post['description'],
            $post['price'],
            $post['condition'],
            $image_path
        );
        if (mysqli_stmt_execute($stmt)) {
            redirect(BASE_URL . 'products/index.php');
        } else {
            $errors[] = 'Failed to create listing. Please try again.';
        }
        mysqli_stmt_close($stmt);
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">List an Item for Sale</h1>

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
                        <option value="<?php echo $cond; ?>" <?php echo ($post['condition'] ?? 'Good') === $cond ? 'selected' : ''; ?>>
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
            <label for="image">Product Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Max 2MB. JPG, PNG, GIF, WebP accepted.</small>
        </div>
        <button type="submit" class="btn btn-primary btn-full">List Item</button>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
