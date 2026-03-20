<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot()
{
    // Cek apakah aplikasi jalan di Vercel
    if (config('app.env') === 'production') {
        // Pindahkan folder view terkompilasi ke /tmp yang bisa ditulis
        config(['view.compiled' => '/tmp/storage/framework/views']);
        
        // Pindahkan session dan cache juga ke /tmp kalau perlu
        config(['session.files' => '/tmp/storage/framework/sessions']);
    }
}
}
