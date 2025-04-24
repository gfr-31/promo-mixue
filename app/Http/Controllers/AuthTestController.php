<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class AuthTestController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebase = $firebaseService->getAuth();
    }

    public function login(Request $request)
    {
        try {
            $signInResult = $this->firebase->signInWithEmailAndPassword(
                $request->email,
                $request->password
            );

            return response()->json([
                'status' => 'success',
                'userId' => $signInResult->firebaseUserId(),
                'idToken' => $signInResult->idToken(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
