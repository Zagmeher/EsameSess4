<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\auth;
use App\Models\contatti;
use App\Helpers\AppHelper;
use Carbon\Carbon;

class AuthAdminController extends Controller
{
    /**
     * Login per amministratori
     */
    public function login(Request $request)
    {
        // Validazione input
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Trova le credenziali di autenticazione
    $userRaw = strtolower(trim($request->user));
    $userHash = AppHelper::hashUtente($userRaw);
    $authRecord = auth::where('user', $userRaw)->orWhere('user', $userHash)->first();
        
        if (!$authRecord) {
            return response()->json(['error' => 'Credenziali non valide'], 401);
        }

        // Verifica la password con sale
        $pwdSha = hash('sha512', $request->password);
        $sfidaSha = AppHelper::nascondiPassword($pwdSha, $authRecord->sale);
        $passwordOk = hash_equals($authRecord->sfida, $sfidaSha);
        // b) Fallback: Hash::check(password + sale, sfida)
        if (!$passwordOk && Hash::check($request->password . $authRecord->sale, $authRecord->sfida)) {
            $passwordOk = true;
        }
        if (!$passwordOk) {
            return response()->json(['error' => 'Credenziali non valide'], 401);
        }

        // Ottieni il contatto associato
        $contatto = $authRecord->contatto;
        
        // Verifica che sia un amministratore (idGruppo = 1)
        if ($contatto->idGruppo !== 1) {
            return response()->json(['error' => 'Accesso negato. Solo amministratori.'], 403);
        }

        // Verifica che il contatto sia attivo (idStato = 1)
        if ($contatto->idStato !== 1) {
            return response()->json(['error' => 'Account disabilitato'], 403);
        }

    // Aggiorna secret e inizioSfida
    $authRecord->secretJWT = AppHelper::generaSecretJWT();
    $authRecord->inizioSfida = Carbon::now();
    $authRecord->save();

    // Genera token JWT
        $token = JWTAuth::fromSubject($contatto);

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => (int) config('jwt.ttl') * 60,
            'admin' => [
                'id' => $contatto->idContatto,
                'name' => $contatto->nome,
                'surname' => $contatto->cognome,
                'email' => $authRecord->user,
                'group' => $contatto->idGruppo, // 1 = admin
            ]
        ]);
    }

    /**
     * Logout per amministratori
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout effettuato con successo']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore durante il logout'], 500);
        }
    }

    /**
     * Refresh token per amministratori
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json([
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => (int) config('jwt.ttl') * 60
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token non valido'], 401);
        }
    }

    /**
     * Ottieni i dettagli dell'amministratore autenticato
     */
    public function me()
    {
        try {
            $contatto = JWTAuth::parseToken()->authenticate();
            
            // Verifica che sia ancora un amministratore
            if ($contatto->idGruppo !== 1) {
                return response()->json(['error' => 'Accesso negato'], 403);
            }

            $authRecord = auth::where('idContatto', $contatto->idContatto)->first();

            return response()->json([
                'admin' => [
                    'id' => $contatto->idContatto,
                    'name' => $contatto->nome,
                    'surname' => $contatto->cognome,
                    'email' => $authRecord ? $authRecord->user : null,
                    'group' => $contatto->idGruppo,
                    'status' => $contatto->idStato
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token non valido'], 401);
        }
    }
}