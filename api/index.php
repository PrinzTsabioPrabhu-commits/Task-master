<?php

/**
 * Vercel PHP Entry Point for Laravel
 *
 * This file serves as the serverless function entry point.
 * It bootstraps the Laravel application by delegating to public/index.php.
 */

// Define the base path (one level up from /api)
$basePath = dirname(__DIR__);

// Point Laravel's public path to our /public directory
$_SERVER['DOCUMENT_ROOT'] = $basePath . '/public';

// Set the script name and request URI properly
if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = '/';
}

// Change working directory to public so relative paths work
chdir($basePath . '/public');

// Bootstrap Laravel
require $basePath . '/public/index.php';
