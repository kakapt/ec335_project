<?php

$info = $_GET['info'];
$base_directory = './info/';

// Ensure the base directory path ends with a slash for consistent checking
$base_directory = realpath($base_directory) . '/'; // Resolve real path of base directory

// --- PATCH ---
// Construct the potential file path by combining the base directory and user input.
// We still combine them initially so realpath can correctly resolve the full path.
$potential_filepath = $base_directory . $info;

// Resolve the real, canonicalized path of the potential file.
// This handles ../, symlinks, etc.
$real_filepath = realpath($potential_filepath);

// CRITICAL CHECK: Verify that the resolved real path starts with the resolved base directory path.
// This confirms that the file is genuinely located within the intended directory.
if ($real_filepath !== false && strpos($real_filepath, $base_directory) === 0) {
    // The resolved path is within the allowed directory. Now check if the file exists.
    if (file_exists($real_filepath)) {
        // Set headers for download using the SAFE real_filepath
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($info) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($real_filepath));
        readfile($real_filepath); // Read the file content from the SAFE real_filepath
        exit;
    } else {
        http_response_code(404); // File not found
        echo "Product specification not found.";
    }
} else {
    // The resolved path is outside the base directory or the initial path was invalid.
    http_response_code(400); // Bad Request
    echo "Invalid product specification request.";
}
?>
