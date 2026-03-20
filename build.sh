#!/bin/bash

set -e

echo "🚀 Starting Vercel build for Laravel..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist

# Install Node dependencies and build assets
echo "🎨 Installing Node dependencies and building assets..."
npm ci
npm run build

# Create required directories that might not exist on serverless
echo "📁 Setting up directories..."
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chmod -R 775 storage bootstrap/cache

# Clear and optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "✅ Build complete!"
