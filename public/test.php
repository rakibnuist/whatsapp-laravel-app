<?php
// Simple test endpoint
header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'message' => 'Laravel WhatsApp App is running!',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'
]);
exit;
?>
