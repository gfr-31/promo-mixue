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
                Log::error('firebase-credentials.json tidak ditemukan. Membuat dari env.');

                // Coba buat dari env
                $base64Credentials = env('FIREBASE_CREDENTIALS_BASE64');

                if (!$base64Credentials) {
                    Log::error('Env FIREBASE_CREDENTIALS_BASE64 tidak ada.');
                    throw new \Exception('Firebase credentials missing.');
                }

                $decodedCredentials = base64_decode($base64Credentials);

                if ($decodedCredentials === false) {
                    Log::error('Gagal mendecode FIREBASE_CREDENTIALS_BASE64.');
                    throw new \Exception('Failed to decode Firebase credentials.');
                }

                Storage::disk('local')->put('firebase-credentials.json', $decodedCredentials);
                Log::info('firebase-credentials.json berhasil dibuat di storage/app.');

                $path = storage_path('app/firebase-credentials.json');

                // Validasi file berhasil dibuat
                if (!file_exists($path) || filesize($path) === 0) {
                    Log::error('File firebase-credentials.json kosong setelah dibuat.');
                    throw new \Exception('Firebase credentials file is empty after creation.');
                }

                $content = file_get_contents($path);
                if (json_decode($content) === null) {
                    Log::error('File firebase-credentials.json hasil decode bukan JSON valid.');
                    throw new \Exception('Firebase credentials file is not valid JSON.');
                }
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
