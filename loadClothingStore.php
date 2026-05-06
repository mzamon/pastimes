<?php
/*
|--------------------------------------------------------------------------
| loadClothingStore.php
| Purpose: Create the ClothingStore database, drop/create tables and load
| the SQL from database.sql. Displays progress messages for marking.
|--------------------------------------------------------------------------
*/

ini_set('display_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_OFF);

// credentials same as config/DBConn.php
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ClothingStore';

echo "<pre>Starting loadClothingStore.php\n";

$mysqli = new mysqli($dbHost, $dbUser, $dbPass);
if ($mysqli->connect_error) {
    echo "Connection failed: " . $mysqli->connect_error . "\n";
    exit;
}

// Reset database so repeated runs are safe and deterministic
echo "Dropping database `$dbName` if it exists...\n";
if (!$mysqli->query("DROP DATABASE IF EXISTS `$dbName`")) {
    echo "DB drop error: " . $mysqli->error . "\n";
    exit;
}

echo "Creating database `$dbName`...\n";
$sql = "CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if (!$mysqli->query($sql)) {
    echo "DB create error: " . $mysqli->error . "\n";
    exit;
}

// Select the database
$mysqli->select_db($dbName);

$sqlFile = __DIR__ . DIRECTORY_SEPARATOR . 'database.sql';
if (!file_exists($sqlFile)) {
    echo "Missing database.sql in project root. Please add it and try again.\n";
    exit;
}

echo "Loading SQL from database.sql...\n";
$sqlContents = file_get_contents($sqlFile);

// Execute multi-query (this will run all statements in database.sql)
if ($mysqli->multi_query($sqlContents)) {
    $count = 0;
    do {
        if ($result = $mysqli->store_result()) {
            // optional: free result
            $result->free();
        }
        if ($mysqli->more_results()) {
            $count++;
        }
    } while ($mysqli->next_result());
    echo "SQL executed. (Statements processed: approx. $count)\n";
} else {
    echo "Error executing SQL: " . $mysqli->error . "\n";
    exit;
}

echo "Seeding additional demo records...\n";

$passwordHash = password_hash('password', PASSWORD_DEFAULT);

// Add extra users so the demo has 30 total users
for ($i = 1; $i <= 26; $i++) {
    $role = ($i % 3 === 0) ? 'seller' : 'buyer';
    $name = 'Demo User ' . $i;
    $email = 'demo' . $i . '@pastimes.co.za';
    $verified = 1;
    $sellerRequest = $role === 'seller' ? 'approved' : 'none';
    $note = $role === 'seller' ? 'Demo seller account' : null;
    $stmt = mysqli_prepare($mysqli, "INSERT INTO tblUser (name, email, password_hash, role, is_verified, seller_request, seller_request_note) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssiss', $name, $email, $passwordHash, $role, $verified, $sellerRequest, $note);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$sellerIds = [];
$buyerIds = [];
$userResult = $mysqli->query("SELECT id, role FROM tblUser ORDER BY id");
while ($row = $userResult->fetch_assoc()) {
    if ($row['role'] === 'seller') {
        $sellerIds[] = (int)$row['id'];
    } elseif ($row['role'] === 'buyer') {
        $buyerIds[] = (int)$row['id'];
    }
}

// Add enough products for a strong demo set
// Build a pool of available images from assets/images (exclude placeholder and uploads)
$imagePool = [];
$imgBaseDir = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
foreach (scandir($imgBaseDir) as $entry) {
    if ($entry === '.' || $entry === '..') continue;
    $fullPath = $imgBaseDir . $entry;
    if (!is_dir($fullPath)) continue;
    if (in_array($entry, ['placeholder', 'uploads'])) continue;
    foreach (scandir($fullPath) as $file) {
        if (preg_match('/\.jpe?g$/i', $file)) {
            $imagePool[] = $entry . '/' . $file;
        }
    }
}
if (count($imagePool) === 0) {
    $imagePool[] = 'placeholder/no-image.jpg';
}

for ($i = 1; $i <= 30; $i++) {
    $sellerId = $sellerIds[($i - 1) % max(count($sellerIds), 1)];
    $categoryId = (($i - 1) % 6) + 1;
    $title = 'Demo Product ' . $i;
    $description = 'Demo description for product ' . $i . '.';
    $price = 50 + ($i * 15);
    $condition = ['New', 'Like New', 'Good', 'Fair', 'Poor'][($i - 1) % 5];
    $image = $imagePool[($i - 1) % count($imagePool)];
    $status = 'active';
    $stmt = mysqli_prepare($mysqli, "INSERT INTO tblProducts (seller_id, category_id, title, description, price, `condition`, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iissdsss', $sellerId, $categoryId, $title, $description, $price, $condition, $image, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Add 15 orders and 30 line items
for ($i = 1; $i <= 15; $i++) {
    $buyerId = $buyerIds[($i - 1) % max(count($buyerIds), 1)];
    $total = 100 + ($i * 25);
    $address = $i . ' Demo Street, Cape Town, 800' . $i;
    $status = ['Pending', 'Packed', 'In Transit', 'Delivered'][($i - 1) % 4];
    $tracking = 'TRK' . str_pad((string)$i, 6, '0', STR_PAD_LEFT);
    $payment = ($i % 2 === 0) ? 'Credit Card' : 'Debit Card';
    $stmt = mysqli_prepare($mysqli, "INSERT INTO tblOrders (buyer_id, total, delivery_address, status, tracking_number, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'idssss', $buyerId, $total, $address, $status, $tracking, $payment);
    mysqli_stmt_execute($stmt);
    $orderId = mysqli_insert_id($mysqli);
    mysqli_stmt_close($stmt);

    for ($j = 1; $j <= 2; $j++) {
        $productId = (($i - 1) * 2 + $j);
        $qty = 1;
        $priceAtPurchase = 50 + ($productId * 15);
        $stmt = mysqli_prepare($mysqli, "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'iiid', $orderId, $productId, $qty, $priceAtPurchase);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Add messages and reviews for the demo
for ($i = 1; $i <= 20; $i++) {
    $senderId = $buyerIds[($i - 1) % max(count($buyerIds), 1)];
    $receiverId = $sellerIds[($i - 1) % max(count($sellerIds), 1)];
    $productId = (($i - 1) % 30) + 1;
    $message = 'Demo message ' . $i . ' about product ' . $productId . '.';
    $isRead = $i % 2;
    $stmt = mysqli_prepare($mysqli, "INSERT INTO tblMessages (sender_id, receiver_id, product_id, message, is_read) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iiisi', $senderId, $receiverId, $productId, $message, $isRead);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

for ($i = 1; $i <= 15; $i++) {
    $reviewerId = $buyerIds[($i - 1) % max(count($buyerIds), 1)];
    $productId = (($i - 1) % 30) + 1;
    $rating = ($i % 5) + 1;
    $comment = 'Demo review ' . $i . ' for product ' . $productId . '.';
    $stmt = mysqli_prepare($mysqli, "INSERT INTO tblReviews (reviewer_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iiis', $reviewerId, $productId, $rating, $comment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Sample cart items
for ($i = 1; $i <= 10; $i++) {
    $userId = $buyerIds[($i - 1) % max(count($buyerIds), 1)];
    $productId = (($i - 1) % 30) + 1;
    $qty = 1;
    $stmt = mysqli_prepare($mysqli, "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iii', $userId, $productId, $qty);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "Database load complete. Tables now available in `$dbName`.\n";
echo "Please review the output and run createTable.php if you need to reload tblUser from userData.txt.\n";
echo "</pre>";

$mysqli->close();

?>
