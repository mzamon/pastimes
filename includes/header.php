<?php
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? h($pageTitle) . ' | Pastimes' : 'Pastimes'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/main.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo BASE_URL; ?>index.php" class="logo">PASTIMES</a>
        <button class="mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>products/index.php">Browse</a></li>

                <?php if (isLoggedIn()): ?>

                    <?php if (isSeller()): ?>
                        <li><a href="<?php echo BASE_URL; ?>products/add.php">Sell Item</a></li>
                        <li><a href="<?php echo BASE_URL; ?>orders/manage.php">Manage Orders</a></li>
                    <?php endif; ?>

                    <?php if (isAdmin()): ?>
                        <li><a href="<?php echo BASE_URL; ?>admin/dashboard.php">Admin</a></li>
                    <?php endif; ?>

                    <li><a href="<?php echo BASE_URL; ?>orders/track.php">My Orders</a></li>
                    <li><a href="<?php echo BASE_URL; ?>messages/inbox.php">Messages</a></li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>cart/index.php" class="cart-link">
                            Cart
                            <?php $cc = getCartCount(); if ($cc > 0): ?>
                                <span class="cart-badge"><?php echo $cc; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-user">Hi, <?php echo h($_SESSION['user_name'] ?? 'User'); ?></li>
                    <li><a href="<?php echo BASE_URL; ?>auth/logout.php" class="btn btn-outline-sm">Logout</a></li>

                <?php else: ?>
                    <li><a href="<?php echo BASE_URL; ?>auth/login.php">Login</a></li>
                    <li><a href="<?php echo BASE_URL; ?>auth/register.php" class="btn btn-primary-sm">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<main class="container main-content">