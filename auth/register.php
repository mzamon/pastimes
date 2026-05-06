<?php
$pageTitle = 'Register';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isLoggedIn()) redirect(BASE_URL . 'index.php');

$errors  = [];
$success = '';
$post    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['name']  = sanitize($_POST['name']  ?? '');
    $post['email'] = sanitize($_POST['email'] ?? '');
    $post['role']  = sanitize($_POST['role']  ?? 'buyer');
    $password  = $_POST['password']         ?? '';
    $password2 = $_POST['confirm_password'] ?? '';
    $post['seller_reason'] = sanitize($_POST['seller_reason'] ?? '');

    // Validation
    if (empty($post['name']))                         $errors[] = 'Full name is required.';
    if (empty($post['email']))                        $errors[] = 'Email address is required.';
    elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 6)                        $errors[] = 'Password must be at least 6 characters.';
    if ($password !== $password2)                     $errors[] = 'Passwords do not match.';
    if (!in_array($post['role'], ['buyer','seller']))  $errors[] = 'Please select a valid role.';
    if ($post['role'] === 'seller' && empty($post['seller_reason'])) {
        $errors[] = 'Please tell us what you want to sell.';
    }

    // Duplicate email check
    if (empty($errors)) {
        $chk = mysqli_prepare($conn, "SELECT id FROM tblUser WHERE email = ?");
        mysqli_stmt_bind_param($chk, 's', $post['email']);
        mysqli_stmt_execute($chk);
        mysqli_stmt_store_result($chk);
        if (mysqli_stmt_num_rows($chk) > 0) $errors[] = 'An account with this email already exists.';
        mysqli_stmt_close($chk);
    }

    // Insert
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $seller_request = $post['role'] === 'seller' ? 'pending' : 'none';
        $is_verified = 0;
        $seller_note = $post['role'] === 'seller' ? $post['seller_reason'] : null;
        $ins  = mysqli_prepare($conn, "INSERT INTO tblUser (name, email, password_hash, role, is_verified, seller_request, seller_request_note) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($ins, 'ssssiss', $post['name'], $post['email'], $hash, $post['role'], $is_verified, $seller_request, $seller_note);
        if (mysqli_stmt_execute($ins)) {
            $newUserId = mysqli_insert_id($conn);
            if ($post['role'] === 'seller') {
                $req = mysqli_prepare($conn, "INSERT INTO tblSellerRequests (user_id, motivation, status) VALUES (?, ?, 'pending')");
                mysqli_stmt_bind_param($req, 'is', $newUserId, $seller_note);
                mysqli_stmt_execute($req);
                mysqli_stmt_close($req);
            }
            $success = 'Account created! Your profile is pending administrator approval.';
            $post    = [];
        } else {
            $errors[] = 'Registration failed. Please try again.';
        }
        mysqli_stmt_close($ins);
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Create Account</h1>

<div class="form-wrap">
    <?php foreach ($errors as $e) echo displayError($e); ?>
    <?php if ($success) echo displaySuccess($success); ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" required
                   value="<?php echo h($post['name'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" required
                   value="<?php echo h($post['email'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">I want to</label>
            <select id="role" name="role" class="form-control">
                <option value="buyer"  <?php echo ($post['role'] ?? '') === 'buyer'  ? 'selected' : ''; ?>>Buy items</option>
                <option value="seller" <?php echo ($post['role'] ?? '') === 'seller' ? 'selected' : ''; ?>>Sell items</option>
            </select>
        </div>
        <div class="form-group">
            <label for="seller_reason">If selling, what do you plan to sell?</label>
            <textarea id="seller_reason" name="seller_reason" class="form-control" placeholder="e.g. vintage clothing, sneakers, books"><?php echo h($post['seller_reason'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-full">Create Account</button>
        <p class="mt-1 text-muted" style="font-size:0.9rem; text-align:center;">
            Already have an account? <a href="<?php echo BASE_URL; ?>auth/login.php">Sign in</a>
        </p>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
