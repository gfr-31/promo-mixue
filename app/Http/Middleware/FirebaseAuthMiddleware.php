<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('firebase_user_id')) {
            // Coba ambil dari cookie jika remember me aktif
            if ($request->hasCookie('remember_token')) {
                session([
                    'firebase_token' => $request->cookie('remember_token'),
                    'firebase_user_id' => 'some_user_id' // Ambil dari token (opsional: decode token)
                ]);
            } else {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
