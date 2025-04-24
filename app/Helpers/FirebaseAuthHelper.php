<?php

namespace App\Helpers;
use App\Services\FirebaseService;

class FirebaseAuthHelper
{
    public static function user()
    {
        $firebaseUserId = session('firebase_user_id');

        if (!$firebaseUserId)
            return null;

        $firebase = app(FirebaseService::class)->getDatabase();
        $reference = $firebase->getReference('users/' . $firebaseUserId);
        $snapshot = $reference->getValue();

        return $snapshot;
    }

    public static function logout()
    {
        session()->forget(['firebase_token', 'firebase_user_id', 'firebase_user']);
    }
}
