<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $firebase;
    protected $auth;
    protected $database;

    public function __construct()
    {
        $base64Credentials = env('FIREBASE_CREDENTIALS');

        if (!$base64Credentials) {
            dd("FIREBASE_CREDENTIALS env tidak ditemukan.");
        }

        $credentialsArray = json_decode(base64_decode($base64Credentials), true);

        if (!$credentialsArray) {
            dd("Gagal decode credentials. Pastikan format base64 benar.");
        }

        $this->firebase = (new Factory)
            ->withServiceAccount($credentialsArray)
            ->withDatabaseUri('https://promo-mixue-default-rtdb.asia-southeast1.firebasedatabase.app');

        $this->auth = $this->firebase->createAuth();
        $this->database = $this->firebase->createDatabase();
    }

    public function getAuth(): Auth
    {
        return $this->auth;
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function storeUserIfNotExists(string $uid, array $userData)
    {
        $userRef = $this->database->getReference("users/{$uid}");
        $snapshot = $userRef->getValue();

        if (!$snapshot) {
            $userData['created_at'] = Carbon::now()->toIso8601String();
            $userRef->set($userData);
        }
    }
}
