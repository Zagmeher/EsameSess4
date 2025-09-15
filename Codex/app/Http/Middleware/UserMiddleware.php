<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Usa il guard 'api' per JWT
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            // Per il modello contatti, non c'è un campo 'role', quindi accettiamo tutti gli utenti autenticati
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Accesso non autorizzato. È richiesta l\'autenticazione JWT.'
        ], 401);
    }
}
