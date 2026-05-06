<?php
$pageTitle = 'Admin Sign In';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isAdmin()) redirect(BASE_URL . 'admin/dashboard.php');

$errors = [];
$post = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $post['email'] = $email;

    if (empty($email) || empty($password)) {
        $errors[] = 'Please enter your admin email and password.';
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, name, email, password_hash, role, is_verified FROM tblUser WHERE email = ? AND role = 'admin' LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        $storedHash = $user['password_hash'] ?? '';
        $passwordOk = $user && (
            password_verify($password, $storedHash) ||
            hash_equals(md5($password), (string)$storedHash)
        );

        if ($passwordOk) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['is_verified'] = (int)$user['is_verified'];
            $_SESSION['seller_request'] = 'none';

            $upd = mysqli_prepare($conn, "UPDATE tblUser SET last_login = NOW() WHERE id = ?");
            mysqli_stmt_bind_param($upd, 'i', $user['id']);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);

            redirect(BASE_URL . 'admin/dashboard.php');
        } else {
            $errors[] = 'Invalid admin credentials.';
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Admin Sign In</h1>

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
        <button type="submit" class="btn btn-primary btn-full">Sign In as Admin</button>
        <p class="mt-1 text-muted" style="font-size:0.9rem; text-align:center;">
            Back to user login? <a href="<?php echo BASE_URL; ?>auth/login.php">Sign in here</a>
        </p>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>