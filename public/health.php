<?php
// Simple healthcheck endpoint
header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'uptime' => time()
]);
exit;
?>
