<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'WhatsJet' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 600px;
            width: 90%;
        }
        .logo {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .logo .whats {
            color: #25D366;
        }
        .logo .jet {
            color: #128C7E;
        }
        .status {
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        .info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: left;
        }
        .info h3 {
            margin-top: 0;
            color: #333;
        }
        .info p {
            margin: 10px 0;
            color: #666;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .feature {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #25D366;
        }
        .feature h4 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .feature p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        .btn {
            background: #25D366;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            font-weight: bold;
        }
        .btn:hover {
            background: #128C7E;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <span class="whats">Whats</span><span class="jet">Jet</span>
        </div>
        
        <div class="status">✅ Application is Running!</div>
        
        <div class="info">
            <h3>🚀 Deployment Status</h3>
            <p><strong>Status:</strong> Successfully Deployed</p>
            <p><strong>Platform:</strong> Railway</p>
            <p><strong>Environment:</strong> Production</p>
            <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
            <p><strong>Laravel Version:</strong> {{ app()->version() }}</p>
            <p><strong>Timestamp:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>

        <div class="features">
            <div class="feature">
                <h4>📱 WhatsApp Integration</h4>
                <p>Send and receive WhatsApp messages through the Business API</p>
            </div>
            <div class="feature">
                <h4>🤖 Bot Automation</h4>
                <p>Create automated responses and chatbot flows</p>
            </div>
            <div class="feature">
                <h4>📊 Analytics</h4>
                <p>Track message delivery and engagement metrics</p>
            </div>
        </div>

        <p>{{ $message ?? 'Your Laravel WhatsApp application is successfully deployed on Railway!' }}</p>
        
        <div>
            <a href="/status" class="btn">Check Status</a>
            <a href="/health" class="btn">Health Check</a>
        </div>
    </div>
</body>
</html>