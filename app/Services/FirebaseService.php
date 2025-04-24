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
        $firebaseCredentials = storage_path('app/firebase-credentials.json');
    
        if (!file_exists($firebaseCredentials)) {
            dd("File kredensial tidak ditemukan di: " . $firebaseCredentials);
        }
    
        if (!is_readable($firebaseCredentials)) {
            dd("File kredensial tidak dapat dibaca di: " . $firebaseCredentials);
        }
    
        $this->firebase = (new Factory)
            ->withServiceAccount($firebaseCredentials)
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
