#!/bin/bash

# Exit on any error
set -e

# Wait for database to be ready
echo "Waiting for database connection..."
sleep 10

# Generate application key if not exists
php artisan key:generate --force

# Clear and cache configuration
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run migrations (with timeout)
timeout 60 php artisan migrate --force || echo "Migration timeout or failed, continuing..."

# Start the application
echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=$PORT
