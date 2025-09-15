<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica che l'utente sia autenticato tramite JWT
        if (!Auth::guard('api')->check()) {
            return response()->json(['error' => 'Token JWT mancante o non valido'], 401);
        }

        // Ottieni l'utente autenticato
        $contatto = Auth::guard('api')->user();

        // Verifica che sia un amministratore (idGruppo = 1)
        if ($contatto->idGruppo !== 1) {
            return response()->json(['error' => 'Accesso negato. Solo amministratori.'], 403);
        }

        // Verifica che l'account sia attivo (idStato = 1)
        if ($contatto->idStato !== 1) {
            return response()->json(['error' => 'Account amministratore disabilitato'], 403);
        }

        return $next($request);
    }
}
