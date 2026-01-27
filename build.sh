#!/usr/bin/env bash
set -o errexit

echo "=== Installing system dependencies ==="
apt-get update
apt-get install -y php-pgsql

echo "=== Installing PHP dependencies ==="
composer install --no-dev --optimize-autoloader --no-interaction

echo "=== Building frontend ==="
npm install --silent
npm run build --silent

echo "=== Build completed ==="
