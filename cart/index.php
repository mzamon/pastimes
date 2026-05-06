<?php
$pageTitle = 'Shopping Cart';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$cart     = $_SESSION['cart'] ?? [];
$subtotal = 0;

require_once __DIR__ . '/../includes/header.php';
?>

<h1 class="page-title">Shopping Cart</h1>

<?php if (empty($cart)): ?>
    <div class="alert alert-error">
        Your cart is empty. <a href="<?php echo BASE_URL; ?>products/index.php">Continue shopping</a>
    </div>
<?php else: ?>
    <div class="cart-layout">

        <div class="cart-actions-bar">
            <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-secondary">Continue Shopping</a>
        </div>

        <!-- Cart items -->
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $pid => $item):
                        $line_total = $item['price'] * $item['quantity'];
                        $subtotal  += $line_total;
                    ?>
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:0.75rem;">
                                    <img src="<?php echo getProductImage($item['image'] ?? ''); ?>"
                                         alt="<?php echo h($item['title']); ?>"
                                         style="width:54px; height:54px; object-fit:cover; border-radius:6px;">
                                    <span><?php echo h($item['title']); ?></span>
                                </div>
                            </td>
                            <td>R <?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form method="POST" action="update.php" style="display:inline-flex; gap:0.4rem; align-items:center;">
                                    <input type="hidden" name="id" value="<?php echo $pid; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>"
                                           min="1" class="form-control cart-qty qty-input">
                                    <button type="submit" class="btn btn-secondary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>R <?php echo number_format($line_total, 2); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>cart/remove.php?id=<?php echo $pid; ?>" class="btn btn-danger btn-sm"
                                   data-confirm="Remove this item from your cart?">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="cart-summary">
            <h3>Order Summary</h3>
            <div class="summary-row"><span>Subtotal</span><span>R <?php echo number_format($subtotal, 2); ?></span></div>
            <div class="summary-row"><span>Delivery</span><span>R 50.00</span></div>
            <div class="summary-total"><span>Total</span><span>R <?php echo number_format($subtotal + 50, 2); ?></span></div>
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo BASE_URL; ?>orders/checkout.php" class="btn btn-primary btn-full mt-1">Proceed to Checkout</a>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>auth/login.php" class="btn btn-primary btn-full mt-1">Login to Checkout</a>
            <?php endif; ?>
            <a href="<?php echo BASE_URL; ?>products/index.php" class="btn btn-secondary btn-full mt-1">Continue Shopping</a>
        </div>

    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
