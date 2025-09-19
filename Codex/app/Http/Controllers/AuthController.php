<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\contatti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\AppHelper;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Non possiamo usare $this->middleware qui, verrà gestito tramite le rotte
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Step 1: Validazione input
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Errore di validazione',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Step 2: Cerca nella tabella auth (sia raw email sia hash utente)
            $emailRaw = strtolower(trim($request->email));
            $emailHash = AppHelper::hashUtente($emailRaw);
            $authRecord = auth::where('user', $emailRaw)
                ->orWhere('user', $emailHash)
                ->first();
            
            if (!$authRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenziali non valide'
                ], 401);
            }

            // Step 3: Verifica la password
            $passwordOk = false;
            // a) Schema professore: sfida = sha512( sha512(password) + sale )
            $pwdSha = hash('sha512', $request->password);
            $sfidaSha = AppHelper::nascondiPassword($pwdSha, $authRecord->sale);
            if (hash_equals($authRecord->sfida, $sfidaSha)) {
                $passwordOk = true;
            }
            // b) Fallback: Hash::check(password + sale, sfida)
            if (!$passwordOk && Hash::check($request->password . $authRecord->sale, $authRecord->sfida)) {
                $passwordOk = true;
            }

            if (!$passwordOk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password non valida'
                ], 401);
            }

            // Step 4: Ottieni il contatto associato
            $contatto = $authRecord->contatto;
            
            if (!$contatto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contatto non trovato'
                ], 404);
            }

            // Aggiorna secret e inizioSfida ad ogni login
            $authRecord->secretJWT = AppHelper::generaSecretJWT();
            $authRecord->inizioSfida = Carbon::now();
            $authRecord->save();

            // Step 5: Genera il token JWT direttamente dal modello contatti
            $token = JWTAuth::fromSubject($contatto);
            
            // Prepara i dati utente per la risposta
            $userData = [
                'id' => $contatto->idContatto,
                'name' => $contatto->nome . ' ' . $contatto->cognome,
                'email' => $authRecord->user,
                'role' => 'user'
            ];
            
            return $this->respondWithToken($token, $userData, $contatto);

        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore JWT: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore step 5: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|between:2,100',
            'cognome' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }

    // Verifica se l'email è già in uso nella tabella auth (sia raw sia hash)
    $emailRaw = strtolower(trim($request->email));
    $emailHash = AppHelper::hashUtente($emailRaw);
    $existingAuth = auth::where('user', $emailRaw)->orWhere('user', $emailHash)->first();
        if ($existingAuth) {
            return response()->json([
                'success' => false,
                'message' => 'Email già in uso',
            ], 422);
        }

        // Crea un nuovo contatto
        $contatto = contatti::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'idGruppo' => 2, // Utente normale di default
            'idStato' => 1, // Valore predefinito
            'sesso' => $request->sesso ?? 0,
            'codiceFiscale' => $request->codiceFiscale ?? '',
            'partitaIva' => $request->partitaIva ?? '',
            'cittadinanza' => $request->cittadinanza ?? 'Italiana',
            'idNazioneNascita' => $request->idNazioneNascita ?? 1,
            'cittaNascita' => $request->cittaNascita ?? '',
            'provinciaNascita' => $request->provinciaNascita ?? '',
            'dataNascita' => $request->dataNascita ?? now(),
        ]);
        
        // Genera un sale e calcola le credenziali secondo lo schema richiesto
        $sale = \App\Helpers\AppHelper::generaSale();
        $pwdSha = hash('sha512', $request->password);
        $sfida = \App\Helpers\AppHelper::nascondiPassword($pwdSha, $sale);
        $secret = \App\Helpers\AppHelper::generaSecretJWT();
        
        // Crea un record di autenticazione
        $auth = auth::create([
            'idContatto' => $contatto->idContatto,
            'user' => $emailHash, // memorizziamo l'hash dell'utente
            'sfida' => $sfida,
            'secretJWT' => $secret,
            'scadenzaSfida' => now()->addDays(30)->timestamp,
            'sale' => $sale
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Utente registrato con successo',
            'contatto' => $contatto
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            // Otteniamo il token JWT e decodifichiamo il payload
            $token = JWTAuth::getToken();
            $payload = JWTAuth::getPayload($token)->toArray();
            
            if (isset($payload['sub'])) {
                // Se abbiamo un idContatto nel payload, recuperiamo il contatto
                $contatto = contatti::find($payload['sub']);
                
                if (!$contatto) {
                    return response()->json(['success' => false, 'message' => 'Contatto non trovato'], 404);
                }
                
                // Cerca anche i dati di autenticazione
                $authRecord = auth::where('idContatto', $contatto->idContatto)->first();
                
                $userData = [
                    'id' => $contatto->idContatto,
                    'nome' => $contatto->nome,
                    'cognome' => $contatto->cognome,
                    'email' => $authRecord ? $authRecord->user : null,
                    'role' => isset($payload['role']) ? $payload['role'] : 'user'
                ];
                
                return response()->json([
                    'success' => true,
                    'user' => $userData,
                    'contatto' => $contatto
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Utente non trovato nel token'], 404);
            }
            
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['success' => false, 'message' => 'Token scaduto'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['success' => false, 'message' => 'Token non valido'], 401);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Token non fornito'], 401);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            
            return response()->json([
                'success' => true,
                'message' => 'Logout effettuato con successo'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Impossibile eseguire il logout'
            ], 500);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            // Otteniamo il token corrente
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token non fornito'
                ], 401);
            }
            
            // Otteniamo il payload dal token
            $payload = JWTAuth::getPayload($token)->toArray();
            
            // Rinfreschiamo il token
            $newToken = JWTAuth::refresh($token);
            
            // Recuperiamo il contatto dal payload
            $contatto = null;
            $userData = [];
            
            if (isset($payload['sub'])) {
                $contatto = contatti::find($payload['sub']);
                if ($contatto) {
                    $authRecord = auth::where('idContatto', $contatto->idContatto)->first();
                    $userData = [
                        'id' => $contatto->idContatto,
                        'nome' => $contatto->nome,
                        'cognome' => $contatto->cognome,
                        'email' => $authRecord ? $authRecord->user : null,
                        'role' => $payload['role'] ?? 'user'
                    ];
                }
            }
            
            return $this->respondWithToken($newToken, $userData, $contatto);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Impossibile aggiornare il token: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  mixed $user
     * @param  \App\Models\contatti|null $contatto
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user, $contatto = null)
    {
        // Consente sia array che oggetto per $user
        $get = function ($key, $default = null) use ($user) {
            if (is_array($user)) {
                return $user[$key] ?? $default;
            }
            if (is_object($user)) {
                return $user->{$key} ?? $default;
            }
            return $default;
        };

        $userData = [
            'id' => $get('id', ($contatto ? $contatto->idContatto : null)),
            'name' => $get('name', ($contatto ? $contatto->nome . ' ' . $contatto->cognome : null)),
            'email' => $get('email', ($contatto && $contatto->authRecord ? $contatto->authRecord->user : null)),
            'role' => $get('role', 'user'),
        ];
        
        if ($contatto) {
            $userData['idContatto'] = $contatto->idContatto;
            $userData['nome'] = $contatto->nome;
            $userData['cognome'] = $contatto->cognome;
            // Aggiungi altri campi del contatto che potrebbero essere utili
        }
        
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => (int) config('jwt.ttl') * 60, // Durata in secondi
            'user' => $userData
        ]);
    }

    /**
     * Cambio password per l'utente autenticato
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|different:current_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Recupera l'utente dal token
            $contatto = JWTAuth::parseToken()->authenticate();
            if (!$contatto) {
                return response()->json(['success' => false, 'message' => 'Utente non autenticato'], 401);
            }

            $authRecord = auth::where('idContatto', $contatto->idContatto)->first();
            if (!$authRecord) {
                return response()->json(['success' => false, 'message' => 'Record di autenticazione non trovato'], 404);
            }

            // Verifica della password attuale con entrambi gli schemi
            $pwdShaCurrent = hash('sha512', $request->input('current_password'));
            $sfidaShaCurrent = AppHelper::nascondiPassword($pwdShaCurrent, $authRecord->sale);
            $passwordOk = hash_equals($authRecord->sfida, $sfidaShaCurrent)
                || Hash::check($request->input('current_password') . $authRecord->sale, $authRecord->sfida);

            if (!$passwordOk) {
                return response()->json(['success' => false, 'message' => 'Password attuale errata'], 401);
            }

            // Genera nuovo sale e nuova sfida usando lo schema del professore
            $nuovoSale = AppHelper::generaSale();
            $pwdShaNew = hash('sha512', $request->input('new_password'));
            $nuovaSfida = AppHelper::nascondiPassword($pwdShaNew, $nuovoSale);

            // Aggiorna credenziali
            $authRecord->sale = $nuovoSale;
            $authRecord->sfida = $nuovaSfida;
            $authRecord->secretJWT = AppHelper::generaSecretJWT(); // ruota il secret
            $authRecord->inizioSfida = Carbon::now();
            $authRecord->scadenzaSfida = now()->addDays(30)->timestamp;
            $authRecord->save();

            // Invalida il token corrente e restituisci nuovo token
            JWTAuth::invalidate(JWTAuth::getToken());
            $nuovoToken = JWTAuth::fromSubject($contatto);

            return response()->json([
                'success' => true,
                'message' => 'Password aggiornata con successo',
                'access_token' => $nuovoToken,
                'token_type' => 'bearer',
                'expires_in' => (int) config('jwt.ttl') * 60,
            ]);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Token non valido'], 401);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Errore: ' . $e->getMessage()], 500);
        }
    }
}
