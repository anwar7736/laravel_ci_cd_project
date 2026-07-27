#!/bin/bash

set -e

cd "$(dirname "$0")"

GIT="/usr/local/cpanel/3rdparty/lib/path-bin/git"
PHP="/usr/local/bin/php"
COMPOSER="/home/softitglobal/bin/composer"

echo "Git Pull..."
$GIT pull origin main

echo "Composer..."
$COMPOSER install --no-dev --optimize-autoloader --no-interaction

echo "Migration..."
$PHP artisan migrate --force

echo "Cache..."
$PHP artisan optimize:clear
$PHP artisan optimize

echo "Finished"