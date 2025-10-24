<?php
// Debug endpoint to check Laravel status
header('Content-Type: application/json');

try {
    // Check if Laravel can be loaded
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // Check if .env exists
    $envExists = file_exists(__DIR__ . '/../.env');
    
    // Check if database exists
    $dbExists = file_exists(__DIR__ . '/../database/database.sqlite');
    
    // Check storage permissions
    $storageWritable = is_writable(__DIR__ . '/../storage');
    
    // Check bootstrap cache
    $bootstrapWritable = is_writable(__DIR__ . '/../bootstrap/cache');
    
    echo json_encode([
        'status' => 'debug',
        'laravel_loaded' => true,
        'env_exists' => $envExists,
        'database_exists' => $dbExists,
        'storage_writable' => $storageWritable,
        'bootstrap_writable' => $bootstrapWritable,
        'php_version' => phpversion(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
exit;
?>
