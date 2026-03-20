#!/bin/bash
set -e

# Install deps
composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist

# Asset build
npm install
npm run build

# HAPUS SEMUA CACHE LOKAL (PENTING!)
# Ini untuk memastikan tidak ada file cache yang terbawa dari laptop
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*.php

# JANGAN jalankan config:cache atau route:cache!
# Cukup jalankan clear saja
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "✅ Build complete!"