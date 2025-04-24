<?php

use App\Http\Controllers\AuthTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/login', [AuthTestController::class, 'login']);
});