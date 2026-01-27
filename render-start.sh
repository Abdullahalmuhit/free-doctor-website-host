#!/bin/bash

# Exit on error
set -e

echo "=== Setting up Laravel on Render ==="

# Create directories
echo "Creating directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p bootstrap/cache

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache

# Clear any existing caches
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Create storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Cache for production
echo "Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Apache Server ==="
exec apache2-foreground
