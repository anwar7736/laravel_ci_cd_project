#!/bin/bash

set -e

cd /home/username/public_html

echo "Git Pull..."
git pull origin main

echo "Composer..."
composer install --no-dev --optimize-autoloader

echo "Migration..."
php artisan migrate --force

echo "Cache..."
php artisan optimize:clear

php artisan optimize

echo "Finished"