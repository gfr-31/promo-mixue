<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
            $firebaseCredentialsPath = storage_path('app/firebase-credentials.json');

            // Cek apakah file sudah ada
            if (!file_exists($firebaseCredentialsPath)) {
                // Coba buat dari environment variable
                $base64Credentials = env('FIREBASE_CREDENTIALS_BASE64');

                if (!$base64Credentials) {
                    Log::error('File kredensial Firebase tidak ditemukan dan tidak ada env FIREBASE_CREDENTIALS_BASE64.');
                    throw new \Exception('Firebase credentials missing.');
                }

                // Decode dan buat file
                $decodedCredentials = base64_decode($base64Credentials);

                if ($decodedCredentials === false) {
                    Log::error('Gagal mendecode FIREBASE_CREDENTIALS_BASE64.');
                    throw new \Exception('Failed to decode Firebase credentials.');
                }

                Storage::disk('local')->put('firebase-credentials.json', $decodedCredentials);
            }

            // Pastikan file bisa dibaca
            if (!is_readable($firebaseCredentialsPath)) {
                Log::error('File kredensial Firebase tidak dapat dibaca di: ' . $firebaseCredentialsPath);
                throw new \Exception('Firebase credentials file is not readable.');
            }

            return (new Factory)
                ->withServiceAccount($firebaseCredentialsPath)
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
