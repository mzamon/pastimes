<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "ClothingStore");
if ($mysqli->connect_error) {
    echo "DB Error: " . $mysqli->connect_error;
    exit(1);
}

echo "=== DATABASE STATE ===\n\n";

// Check tblUser
$res = $mysqli->query("SELECT COUNT(*) as cnt FROM tblUser");
$row = $res->fetch_assoc();
echo "Total tblUser records: " . $row['cnt'] . "\n";

// Role breakdown
$roleRes = $mysqli->query("SELECT role, COUNT(*) as cnt FROM tblUser GROUP BY role ORDER BY role");
echo "\nRole breakdown:\n";
while ($rrow = $roleRes->fetch_assoc()) {
    echo "  " . $rrow['role'] . ": " . $rrow['cnt'] . "\n";
}

// Admin user
$adminRes = $mysqli->query("SELECT id, name, email, role, is_verified FROM tblUser WHERE role='admin' LIMIT 1");
if ($admin = $adminRes->fetch_assoc()) {
    echo "\nAdmin User Found:\n";
    echo "  Name: " . $admin['name'] . "\n";
    echo "  Email: " . $admin['email'] . "\n";
    echo "  Verified: " . ($admin['is_verified'] ? 'Yes' : 'No') . "\n";
} else {
    echo "\nNo admin user found.\n";
}

// Product count
$prodRes = $mysqli->query("SELECT COUNT(*) as cnt FROM tblProducts");
$prod = $prodRes->fetch_assoc();
echo "\nTotal tblProducts: " . $prod['cnt'] . "\n";

// Order count
$ordRes = $mysqli->query("SELECT COUNT(*) as cnt FROM tblOrders");
$ord = $ordRes->fetch_assoc();
echo "Total tblOrders: " . $ord['cnt'] . "\n";

echo "\n=== END ===\n";
$mysqli->close();
?>
