#!/bin/bash

# Simple deployment script for Railway
echo "=== Starting Laravel WhatsApp Application ==="

# Check if PORT is set
if [ -z "$PORT" ]; then
    echo "PORT not set, using default 8080"
    export PORT=8080
fi

echo "Using port: $PORT"

# Set basic environment variables if not set
if [ -z "$APP_ENV" ]; then
    export APP_ENV=production
fi

if [ -z "$APP_DEBUG" ]; then
    export APP_DEBUG=false
fi

if [ -z "$APP_URL" ]; then
    export APP_URL=https://whatsapp-laravel-app-production.up.railway.app
fi

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cat > .env << EOF
APP_NAME=WhatsJet
APP_ENV=production
APP_DEBUG=false
APP_URL=https://whatsapp-laravel-app-production.up.railway.app
APP_KEY=

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=local

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@whatsapp-laravel-app-production.up.railway.app"
MAIL_FROM_NAME="WhatsJet"
EOF
fi

# Generate application key
echo "Generating application key..."
php artisan key:generate --force

# Create database file if it doesn't exist
if [ ! -f database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch database/database.sqlite
fi

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

# Run migrations
echo "Running database migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

# Start the application
echo "Starting Laravel server on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
