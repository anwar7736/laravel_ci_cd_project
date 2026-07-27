#!/bin/bash

set -e

# Ensure we are running from the project root
cd "$(dirname "$0")"

echo "===== DEPLOY START ====="
echo "Current directory: $(pwd)"

echo "Pulling latest code..."
git pull origin main

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Running migrations..."
php artisan migrate --force

echo "Clearing and rebuilding cache..."
php artisan optimize:clear
php artisan optimize

echo "===== DEPLOY SUCCESS ====="