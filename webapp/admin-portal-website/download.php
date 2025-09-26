<?php
session_start();

// 1️⃣ Check if user is logged in
if (empty($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

// 2️⃣ Folder containing files (absolute path)
$filesDir = '/var/www/hint/public_html/files/'; // Adjust to your actual folder

// 3️⃣ Check if 'file' parameter exists
if (!isset($_GET['file'])) {
    die("No file specified.");
}

// 4️⃣ Sanitize filename to prevent traversal attacks
$filename = basename($_GET['file']);
$filepath = $filesDir . $filename;

// 5️⃣ Check if file exists
if (!file_exists($filepath)) {
    die("File not found at: $filepath");
}

// 6️⃣ Serve the file for download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));

readfile($filepath);
exit;

