<?php
/*
|--------------------------------------------------------------------------
| createTable.php
| Purpose: Drop and recreate tblUser and load user data from userData.txt
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/config/DBConn.php';

$conn = getDbConnection();
if (!$conn) {
    echo "Unable to connect to DB. Ensure ClothingStore exists or run loadClothingStore.php first.";
    exit;
}

$schema = 'ClothingStore';
$table = 'tblUser';

echo "<pre>createTable.php - operating on $schema.$table\n";

mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");

echo "Removing tables that depend on tblUser so the reset can run cleanly...\n";
mysqli_query($conn, "DROP TABLE IF EXISTS `order_items`, `tblMessages`, `tblReviews`, `tblOrders`, `tblProducts`, `tblSellerRequests`, `tblUser`");

// Check if table exists
$checkSql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . mysqli_real_escape_string($conn, $schema) . "' AND TABLE_NAME = '" . mysqli_real_escape_string($conn, $table) . "'";
$res = mysqli_query($conn, $checkSql);
if ($res && mysqli_num_rows($res) > 0) {
    echo "Dropping existing table $table...\n";
    if (!mysqli_query($conn, "DROP TABLE `" . $table . "`")) {
        echo "Failed to drop table: " . mysqli_error($conn) . "\n";
        exit;
    }
}

// Create table
$create = "CREATE TABLE `" . $table . "` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('buyer','seller','admin') DEFAULT 'buyer',
    `is_verified` TINYINT(1) DEFAULT 0,
    `seller_request` ENUM('none','pending','approved','rejected') DEFAULT 'none',
    `seller_request_note` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `last_login` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (!mysqli_query($conn, $create)) {
    echo "Failed to create tblUser: " . mysqli_error($conn) . "\n";
    exit;
}
echo "Created table $table.\n";

$dataFile = __DIR__ . DIRECTORY_SEPARATOR . 'userData.txt';
if (!file_exists($dataFile)) {
    echo "Missing userData.txt; create it with 3 columns separated by tabs (name, email, md5hash).\n";
    exit;
}

$lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$inserted = 0;
foreach ($lines as $line) {
    // split by tabs or multiple spaces - expecting: Name\temail\tmd5hash
    $parts = preg_split('/\s+/', trim($line), 3);
    if (count($parts) < 3) continue;
    $name = mysqli_real_escape_string($conn, $parts[0] . (isset($parts[1]) && strpos($parts[1],'@')===false ? ' '. $parts[1] : ''));
    // attempt to find email and hash
    // simpler parse: take last token as hash, token before as email, rest as name
    $tokens = preg_split('/\s+/', trim($line));
    $hash = array_pop($tokens);
    $email = array_pop($tokens);
    $name = implode(' ', $tokens);
    $nameEsc = mysqli_real_escape_string($conn, $name);
    $emailEsc = mysqli_real_escape_string($conn, $email);
    $hashEsc = mysqli_real_escape_string($conn, $hash);

    $ins = "INSERT INTO `" . $table . "` (name, email, password_hash, role, is_verified, seller_request) VALUES ('" . $nameEsc . "','" . $emailEsc . "','" . $hashEsc . "','buyer',0,'none')";
    if (mysqli_query($conn, $ins)) {
        $inserted++;
    } else {
        echo "Failed to insert $emailEsc: " . mysqli_error($conn) . "\n";
    }
}

echo "Inserted $inserted users from userData.txt into $table.\n";
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
echo "</pre>";

?>
