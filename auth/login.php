<?php
$pageTitle = 'Sign In';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isLoggedIn()) redirect(BASE_URL . 'index.php');

$errors = [];
$post = [];

if (isset($_GET['pending'])) {
    $errors[] = 'Your account is pending administrator approval.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = sanitize($_POST['email']    ?? '');
    $password = $_POST['password'] ?? '';
    $post['email'] = $email;

    if (empty($email) || empty($password)) {
        $errors[] = 'Please enter your email and password.';
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, name, email, password_hash, role, is_verified, seller_request FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user   = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user && password_verify($password, $user['password_hash'])) {
            if ((int)$user['is_verified'] !== 1) {
                $errors[] = 'Your account is pending administrator approval.';
            } else {
                session_regenerate_id(true); // prevent session fixation
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['user_name']  = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role']       = $user['role'];
                $_SESSION['is_verified'] = (int)$user['is_verified'];
                $_SESSION['seller_request'] = $user['seller_request'] ?? 'none';

                // Update last login timestamp
                $upd = mysqli_prepare($conn, "UPDATE users SET last_login = NOW() WHERE id = ?");
                mysqli_stmt_bind_param($upd, 'i', $user['id']);
                mysqli_stmt_execute($upd);
                mysqli_stmt_close($upd);

                redirect(BASE_URL . 'index.php');
            }
        } else {
            $errors[] = 'Invalid email or password.';
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Sign In</h1>

<div class="form-wrap">
    <?php foreach ($errors as $e) echo displayError($e); ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" required autofocus value="<?php echo h($post['email'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-full">Sign In</button>
        <p class="mt-1 text-muted" style="font-size:0.9rem; text-align:center;">
            No account? <a href="<?php echo BASE_URL; ?>auth/register.php">Register here</a>
        </p>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
