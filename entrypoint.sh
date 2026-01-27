#!/bin/bash

echo "=== Laravel PostgreSQL Setup on Render ==="

# 1. Create necessary directories
echo "Creating cache directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p bootstrap/cache

# 2. Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 3. Clear caches
echo "Clearing old caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 4. Create storage link
php artisan storage:link

# 5. Test database connection
echo "Testing database connection..."
php artisan db:show --json 2>/dev/null || echo "Database not connected yet"

# 6. Run migrations WITH retry logic (PostgreSQL might take time to start)
echo "Running migrations..."
MAX_RETRIES=5
RETRY_COUNT=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    php artisan migrate --force --no-interaction
    if [ $? -eq 0 ]; then
        echo "Migrations completed successfully!"
        break
    else
        RETRY_COUNT=$((RETRY_COUNT+1))
        echo "Migration attempt $RETRY_COUNT failed. Retrying in 5 seconds..."
        sleep 5
    fi
done

if [ $RETRY_COUNT -eq $MAX_RETRIES ]; then
    echo "WARNING: Migrations failed after $MAX_RETRIES attempts. Continuing anyway..."
fi

# 7. Cache for production
echo "Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Apache ==="
exec apache2-foreground
