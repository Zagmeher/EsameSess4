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

            // Step 2: Cerca nella tabella auth
            $authRecord = auth::where('user', $request->email)->first();
            
            if (!$authRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenziali non valide'
                ], 401);
            }

            // Step 3: Verifica la password
            if (!Hash::check($request->password . $authRecord->sale, $authRecord->sfida)) {
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

        // Verifica se l'email è già in uso nella tabella auth
        $existingAuth = auth::where('user', $request->email)->first();
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
            'idGruppo' => 1, // Valore predefinito
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
        
        // Genera un salt casuale
        $sale = Str::random(32);
        
        // Crea un record di autenticazione
        $auth = auth::create([
            'idContatto' => $contatto->idContatto,
            'user' => $request->email,
            'sfida' => Hash::make($request->password . $sale),
            'secretJWT' => Str::random(32),
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
        $userData = [
            'id' => $user->id ?? ($contatto ? $contatto->idContatto : null),
            'name' => $user->name ?? ($contatto ? $contatto->nome . ' ' . $contatto->cognome : null),
            'email' => $user->email ?? ($contatto ? $contatto->user : null),
            'role' => $user->role ?? 'user'
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
            'expires_in' => config('jwt.ttl') * 1, // Durata in secondi
            'user' => $userData
        ]);
    }
}
