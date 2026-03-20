<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

// PENTING: Pindahkan semua path yang butuh akses 'write' ke /tmp
if (env('VERCEL_JOB_ID')) {
    $app->useStoragePath('/tmp/storage');
    
    // Pastikan folder-folder ini ada secara runtime
    if (!is_dir('/tmp/storage/framework/views')) {
        mkdir('/tmp/storage/framework/views', 0755, true);
    }
}

return $app;