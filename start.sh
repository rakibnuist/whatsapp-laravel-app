#!/bin/bash

# Exit on any error
set -e

echo "=== Starting Laravel WhatsApp Application ==="

# Wait for database to be ready
echo "Waiting for database connection..."
sleep 15

# Generate application key if not exists
echo "Generating application key..."
php artisan key:generate --force

# Clear and cache configuration
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Create storage directories if they don't exist
echo "Creating storage directories..."
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Run migrations (with timeout) - but don't fail if it doesn't work
echo "Running database migrations..."
timeout 60 php artisan migrate --force || echo "Migration timeout or failed, continuing..."

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database connected successfully';" || echo "Database connection test failed, continuing..."

# Start the application
echo "Starting Laravel application on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
