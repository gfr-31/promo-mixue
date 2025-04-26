<?php

namespace App\Livewire\Auth;

use App\Services\FirebaseService;
use Livewire\Component;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $auth = app(FirebaseAuth::class);
            $signIn = $auth->signInWithEmailAndPassword($this->email, $this->password);

            $firebaseUser = $signIn->firebaseUserId();
            $token = $signIn->idToken();

            session([
                'firebase_token' => $token,
                'firebase_user_id' => $firebaseUser,
            ]);

            if ($this->remember) {
                cookie()->queue(cookie('firebase_token', $token, 43200)); // 30 hari
            }

            return redirect()->route('dashboard');

        } catch (\Throwable $e) {
            session()->flash('error', 'Login gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
