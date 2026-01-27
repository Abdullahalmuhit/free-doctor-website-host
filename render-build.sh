#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status
set -e

echo "--- Optimizing Laravel ---"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "--- Running Migrations ---"
# The --force flag is required for production
php artisan migrate --force

echo "--- Starting Apache ---"
exec apache2-foreground
