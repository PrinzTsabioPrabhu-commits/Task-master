#!/bin/bash
set -e

echo "🚀 HARD RESET BUILD..."

# Install dependencies
composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist

# Asset build
npm install
npm run build

# HAPUS SEMUA FILE CACHE YANG TERBAWA DARI GIT/LOCAL
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php

# SETUP FOLDER DI /tmp
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/framework/cache

# CLEAR SEMUA CACHE RUNTIME
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "✅ Hard build complete!" 