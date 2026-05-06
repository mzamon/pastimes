<?php
/*
|--------------------------------------------------------------------------
| Pastimes / ClothingStore DB Connection
| WEDE6021 POE
| File: config/DBConn.php
| Purpose: Create a mysqli connection and expose $conn for includes
|--------------------------------------------------------------------------
*/

// DB credentials - update if your XAMPP/MySQL differs
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ClothingStore');

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    // In some scripts we may connect before the DB exists; keep errors quiet
    // Use error_log so moderator can view logs if needed
    error_log('DBConn: Connection attempted, DB may be missing: ' . mysqli_connect_error());
}

function getDbConnection()
{
    global $conn;
    if (!$conn) {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$conn) {
            error_log('getDbConnection: ' . mysqli_connect_error());
        }
    }
    return $conn;
}

?>
