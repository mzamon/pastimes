<?php
/*
|--------------------------------------------------------------------------
| setup_database.php - Web-based database setup
|--------------------------------------------------------------------------
*/

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<!DOCTYPE html><html><head><title>Database Setup</title></head><body>";
echo "<h1>Pastimes Database Setup</h1>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setup'])) {
    echo "<pre>";
    
    // Include the load script
    include_once __DIR__ . '/loadClothingStore.php';
    
    echo "</pre>";
    echo "<p><a href='index.php'>Go to Homepage</a></p>";
} else {
    echo "<p>This will create the ClothingStore database and populate it with sample data.</p>";
    echo "<form method='post'><input type='submit' name='setup' value='Setup Database'></form>";
    echo "<p><a href='index.php'>Back to Homepage</a></p>";
}

echo "</body></html>";
?>
