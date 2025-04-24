<?php

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\FirebaseAuthMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\Promo;
use App\Livewire\Dashboard\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');

Route::middleware(FirebaseAuthMiddleware::class)->group(function () {
    Route::get('/dashboard', Promo::class)->name('dashboard');
    Route::get('/dashboard/user', User::class)->name('user')->middleware(RoleMiddleware::class);
});

Route::get('/register', function () {
    dd('register');
})->name('register');
