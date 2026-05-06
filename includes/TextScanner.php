<?php
/*
|--------------------------------------------------------------------------
| TextScanner.php
| WEDE6021 POE Part 2 - Database Integrity Protection
| Purpose: Provide sanitization and validation helpers used across the app
|--------------------------------------------------------------------------
*/

// Remove dashes between words, strip dangerous chars, convert entities
function sanitizeAndScanText($inputText) {
    if (!is_string($inputText)) return $inputText;

    // Step 1: Replace dashes between words with space (keep single hyphens between numbers)
    $cleaned = preg_replace('/(\w)-(\w)/u', '$1 $2', $inputText);

    // Step 2: Remove multiple whitespace created by replacements
    $cleaned = preg_replace('/\s+/', ' ', $cleaned);

    // Step 3: Trim
    $cleaned = trim($cleaned);

    // Step 4: Remove any remaining unwanted special characters but keep punctuation
    $cleaned = preg_replace('/[^\p{L}\p{N}\s\.,!?;:\-\(\)\'\"@_]/u', '', $cleaned);

    // Step 5: Convert HTML entities to prevent XSS on storage/output
    $cleaned = htmlspecialchars($cleaned, ENT_QUOTES, 'UTF-8');

    return $cleaned;
}

// Ensure array -> variables -> DB flow; returns cleaned associative array
function validateBeforeDatabase(array $rawData) {
    $tempArray = [];
    foreach ($rawData as $key => $value) {
        // For non-string values (numbers) cast to string first
        if (is_array($value)) {
            // Recursively sanitize arrays
            $tempArray[$key] = validateBeforeDatabase($value);
            continue;
        }
        $tempArray[$key] = sanitizeAndScanText((string)$value);
    }

    // Move to final variables for checks
    $finalVariable = [];
    foreach ($tempArray as $key => $sanitizedValue) {
        if (is_array($sanitizedValue)) {
            $finalVariable[$key] = $sanitizedValue;
            continue;
        }
        $val = trim($sanitizedValue);
        if ($val === '') {
            $finalVariable[$key] = null;
        } else {
            $finalVariable[$key] = $val;
        }
    }

    return $finalVariable;
}

// Global output filter to clean text displayed on site (call via ob_start)
function scanWebsiteText($content) {
    // Replace word-word patterns with a space
    $content = preg_replace('/(\w+)-(\w+)/u', '$1 $2', $content);
    // Collapse whitespace
    $content = preg_replace('/\s+/', ' ', $content);
    // Trim leading/trailing spaces on each line
    $content = preg_replace('/^\s+|\s+$/m', '', $content);
    return $content;
}

?>
