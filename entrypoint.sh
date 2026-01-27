#!/bin/bash

echo "=== Laravel PostgreSQL Setup on Render ==="

# 1. Create necessary directories
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p bootstrap/cache

# 2. Set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 3. CRITICAL: Clear ALL caches (fixes the "mysql driver" issue)
echo "Clearing all Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# 4. Delete cached config files
rm -f bootstrap/cache/*.php 2>/dev/null || true

# 5. Test database connection
echo "Testing PostgreSQL connection..."
timeout 30 bash -c 'until php artisan tinker --execute="try { DB::connection()->getPdo(); echo \"✓ Database connected\n\"; } catch (\Exception \$e) { echo \"✗ Database error: \" . \$e->getMessage() . \"\n\"; exit(1); }"; do sleep 2; done'

# 6. Create storage link
php artisan storage:link || true

# 7. Run migrations with retry logic
echo "Running migrations..."
MAX_RETRIES=3
for i in $(seq 1 $MAX_RETRIES); do
    echo "Attempt $i of $MAX_RETRIES..."
    php artisan migrate --force --no-interaction
    if [ $? -eq 0 ]; then
        echo "✓ Migrations successful"
        break
    else
        echo "✗ Migration failed, retrying in 5 seconds..."
        sleep 5
    fi
done

# 8. Cache for production (AFTER successful setup)
echo "Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Apache ==="
exec apache2-foreground
