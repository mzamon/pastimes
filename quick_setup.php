<?php
// Quick database setup - run this first
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Setting up Pastimes Database...</h2>";

// Connect without database first
$conn = mysqli_connect('127.0.0.1', 'root', '');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS ClothingStore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (mysqli_query($conn, $sql)) {
    echo "<p>✓ Database created/exists</p>";
} else {
    echo "<p>✗ Database creation failed: " . mysqli_error($conn) . "</p>";
}

// Select database
mysqli_select_db($conn, 'ClothingStore');

// Read and execute SQL file
$sqlFile = __DIR__ . '/database.sql';
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    
    // Remove CREATE DATABASE statement since we already created it
    $sql = preg_replace('/CREATE DATABASE.*?;/s', '', $sql);
    $sql = preg_replace('/USE.*?;/s', '', $sql);
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "<p>✓ Tables created successfully</p>";
        do {
            if ($result = mysqli_store_result($conn)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conn));
    } else {
        echo "<p>✗ Table creation failed: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>✗ database.sql not found</p>";
}

// Add sample data
$hash = password_hash('password', PASSWORD_DEFAULT);

// Add sample users
$users = [
    ["John Doe", "john@pastimes.co.za", $hash, 'buyer', 1, 'none', null],
    ["Jane Smith", "jane@pastimes.co.za", $hash, 'seller', 1, 'approved', 'Sample seller'],
    ["Admin User", "admin@pastimes.co.za", $hash, 'admin', 1, 'none', null]
];

foreach ($users as $user) {
    $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO tblUser (name, email, password_hash, role, is_verified, seller_request, seller_request_note) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssiss', $user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
echo "<p>✓ Sample users added</p>";

// Add sample categories
$categories = ["Men's Clothing", "Women's Clothing", "Streetwear", "Vintage", "Accessories", "Shoes"];
foreach ($categories as $cat) {
    $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO categories (name) VALUES (?)");
    mysqli_stmt_bind_param($stmt, 's', $cat);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
echo "<p>✓ Categories added</p>";

// Add sample products
$products = [
    [2, 1, "Vintage Leather Jacket", "Classic leather jacket in excellent condition", 899.99, "Like New", null, "active"],
    [2, 2, "Designer Dress", "Beautiful evening dress, worn once", 450.00, "New", null, "active"],
    [2, 3, "Streetwear Hoodie", "Trendy streetwear hoodie, size M", 250.00, "Good", null, "active"],
    [2, 4, "Retro Sunglasses", "Vintage 80s sunglasses", 89.99, "Good", null, "active"],
    [2, 5, "Leather Handbag", "Genuine leather handbag", 320.00, "Fair", null, "active"],
    [2, 6, "Nike Sneakers", "Limited edition sneakers", 650.00, "New", null, "active"]
];

foreach ($products as $product) {
    $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO tblProducts (seller_id, category_id, title, description, price, `condition`, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iissdsss', $product[0], $product[1], $product[2], $product[3], $product[4], $product[5], $product[6], $product[7]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
echo "<p>✓ Sample products added</p>";

echo "<h3>Setup Complete!</h3>";
echo "<p><a href='index.php'>Visit your website</a></p>";
echo "<p><strong>Login credentials:</strong></p>";
echo "<ul>";
echo "<li>Buyer: john@pastimes.co.za / password</li>";
echo "<li>Seller: jane@pastimes.co.za / password</li>";
echo "<li>Admin: admin@pastimes.co.za / password</li>";
echo "</ul>";

mysqli_close($conn);
?>
