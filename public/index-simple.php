<?php
// Simplified index file for debugging
header('Content-Type: text/html; charset=utf-8');

try {
    // Basic Laravel bootstrap
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // Create a simple response
    echo '<!DOCTYPE html>
<html>
<head>
    <title>WhatsJet - WhatsApp Laravel App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .logo { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .status { color: #28a745; font-weight: bold; }
        .info { background: #e9ecef; padding: 15px; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">WhatsJet</div>
        <div class="status">✅ Application is running!</div>
        <div class="info">
            <h3>Application Status</h3>
            <p><strong>Status:</strong> Running</p>
            <p><strong>Environment:</strong> ' . (getenv('APP_ENV') ?: 'production') . '</p>
            <p><strong>PHP Version:</strong> ' . phpversion() . '</p>
            <p><strong>Timestamp:</strong> ' . date('Y-m-d H:i:s') . '</p>
        </div>
        <p>Your Laravel WhatsApp application is successfully deployed on Railway!</p>
    </div>
</body>
</html>';

} catch (Exception $e) {
    echo '<!DOCTYPE html>
<html>
<head>
    <title>WhatsJet - Error</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .error { color: #dc3545; font-weight: bold; }
        .info { background: #f8d7da; padding: 15px; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="error">❌ Application Error</div>
        <div class="info">
            <h3>Error Details</h3>
            <p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>
            <p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . '</p>
            <p><strong>Line:</strong> ' . $e->getLine() . '</p>
        </div>
    </div>
</body>
</html>';
}
exit;
?>
