#!/bin/sh

# Optimizing Laravel for production
echo "Caching config, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically
echo "Running database migrations..."
php artisan migrate --force

# Start Apache in the foreground (required by Docker)
echo "Starting Apache..."
exec apache2-foreground
