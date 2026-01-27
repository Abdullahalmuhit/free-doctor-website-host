#!/usr/bin/env bash
# Exit on error
set -o errexit

composer install --no-dev --optimize-autoloader

# Install and build frontend assets (Vite)
npm install
npm run build

# Run database migrations (optional: only if your DB is ready)
# php artisan migrate --force
