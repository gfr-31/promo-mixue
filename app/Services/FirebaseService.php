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
        $base64Credentials = env('FIREBASE_CREDENTIALS_BASE64');

        if (!$base64Credentials) {
            throw new \Exception('FIREBASE_CREDENTIALS_BASE64 env tidak ditemukan.');
        }

        $decodedJson = base64_decode($base64Credentials);

        if (!$decodedJson) {
            throw new \Exception('Gagal decode FIREBASE_CREDENTIALS_BASE64.');
        }

        $credentialsArray = json_decode($decodedJson, true);

        if (!$credentialsArray) {
            throw new \Exception('JSON dari kredensial Firebase tidak valid.');
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
