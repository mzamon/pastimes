<?php
// Check and attempt to fix product image paths by matching existing files.
ini_set('display_errors',1); error_reporting(E_ALL);
$dbHost = '127.0.0.1'; $dbUser = 'root'; $dbPass = ''; $dbName = 'ClothingStore';
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_error) { echo "DB connect failed: " . $mysqli->connect_error . "\n"; exit(1); }

$baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

$res = $mysqli->query("SELECT id, title, image FROM tblProducts");
if (!$res) { echo "Query failed: " . $mysqli->error . "\n"; exit(1); }

function scanAllImages($baseDir) {
    $list = [];
    foreach (scandir($baseDir) as $entry) {
        if ($entry === '.' || $entry === '..') continue;
        $p = $baseDir . $entry;
        if (!is_dir($p)) continue;
        foreach (scandir($p) as $f) {
            if (preg_match('/\.jpe?g$/i', $f)) {
                $list[] = $entry . '/' . $f;
            }
        }
    }
    return $list;
}

$allImages = scanAllImages($baseDir);
echo "Found " . count($allImages) . " images in assets/images/\n";

while ($row = $res->fetch_assoc()) {
    $id = $row['id'];
    $img = $row['image'];
    if (empty($img)) {
        echo "Product $id ('" . $row['title'] . "') has no image set. Setting placeholder.\n";
        $mysqli->query("UPDATE tblProducts SET image='placeholder/no-image.jpg' WHERE id={$id}");
        continue;
    }
    $full = $baseDir . $img;
    if (file_exists($full)) {
        // good
        continue;
    }
    echo "Missing file for product $id ('" . $row['title'] . "'): $img\n";
    // Try to find best candidate by filename similarity
    $best = null; $bestScore = PHP_INT_MAX;
    $normTarget = preg_replace('/[^a-z0-9]/', '', strtolower($img));
    foreach ($allImages as $candidate) {
        $norm = preg_replace('/[^a-z0-9]/', '', strtolower($candidate));
        $dist = levenshtein($normTarget, $norm);
        if ($dist < $bestScore) { $bestScore = $dist; $best = $candidate; }
    }
    if ($best !== null && $bestScore <= 4) {
        echo " -> Auto-fixing to candidate: $best (lev=$bestScore)\n";
        $safe = $mysqli->real_escape_string($best);
        $mysqli->query("UPDATE tblProducts SET image='{$safe}' WHERE id={$id}");
        continue;
    }
    // No good candidate — set placeholder
    echo " -> No close match found, setting placeholder.\n";
    $mysqli->query("UPDATE tblProducts SET image='placeholder/no-image.jpg' WHERE id={$id}");
}

echo "Done.\n";
$mysqli->close();

?>
