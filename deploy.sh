#!/bin/bash

# Simple deployment script for Railway
echo "=== Starting Laravel WhatsApp Application ==="

# Check if PORT is set
if [ -z "$PORT" ]; then
    echo "PORT not set, using default 8080"
    export PORT=8080
fi

echo "Using port: $PORT"

# Generate application key
echo "Generating application key..."
php artisan key:generate --force

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Create storage directories
echo "Creating storage directories..."
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Test if we can start the server
echo "Testing Laravel server startup..."
php artisan serve --host=0.0.0.0 --port=$PORT &
SERVER_PID=$!

# Wait a moment for server to start
sleep 5

# Check if server is running
if ps -p $SERVER_PID > /dev/null; then
    echo "Laravel server started successfully on port $PORT"
    wait $SERVER_PID
else
    echo "Failed to start Laravel server"
    exit 1
fi
