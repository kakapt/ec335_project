<?php

$info = $_GET['info'];

$base_directory = './info/';

$filepath = $base_directory . $info;

if (file_exists($filepath)) {
    // Set headers for download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    // Using basename here helps with the downloaded filename, but doesn't protect the server
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath); // Reading the file content from the potentially manipulated path
    exit;
} else {
    http_response_code(404); // File not found
    echo "Product specification not found.";
}
?>
