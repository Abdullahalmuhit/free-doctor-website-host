#!/bin/bash

echo "=== Laravel Setup on Render (Docker) ==="

# 1. Ensure directories exist (safety check)
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p bootstrap/cache

# 2. Set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 3. Clear caches
echo "Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true

# 4. Create storage link
echo "Creating storage link..."
php artisan storage:link || true

# 5. Wait for PostgreSQL (Render specific - database might need time)
echo "Waiting for PostgreSQL to be ready..."
sleep 5

# 6. Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction || echo "Migrations may have failed, continuing..."


# 7. Cache for production file
echo "Caching for production..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "=== Starting Apache ==="
exec apache2-foreground
