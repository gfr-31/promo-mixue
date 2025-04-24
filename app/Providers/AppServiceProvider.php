<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Auth::class, function ($app) {
            $firebaseCredentials = storage_path('app/firebase-credentials.json');
            
            if (!file_exists($firebaseCredentials)) {
                Log::error('File kredensial Firebase tidak ditemukan di: ' . $firebaseCredentials);
                throw new \Exception('File kredensial Firebase tidak ditemukan.');
            }
    
            if (!is_readable($firebaseCredentials)) {
                Log::error('File kredensial Firebase tidak dapat dibaca di: ' . $firebaseCredentials);
                throw new \Exception('File kredensial Firebase tidak dapat dibaca.');
            }
    
            return (new Factory)
                ->withServiceAccount($firebaseCredentials)
                ->createAuth();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
