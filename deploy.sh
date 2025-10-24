#!/bin/bash

# Simple deployment script for Railway
echo "Starting Laravel application deployment..."

# Generate application key
php artisan key:generate --force

# Clear caches
php artisan config:clear
php artisan cache:clear

# Create storage directories
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Start the application
echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=$PORT
