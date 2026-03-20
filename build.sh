#!/bin/bash
set -e

echo "🚀 Running Production Build..."

# 1. Install PHP Dependencies
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# 2. Install Node Dependencies & Build Assets (Vite)
npm install
npm run build

# 3. Cleanup & Directory Setup
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/cache
php artisan config:clear
php artisan view:clear

echo "✅ Build Finished!"