<?php

namespace App\Http\Controllers;

use App\Models\password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passwords = password::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista credenziali',
            'data' => $passwords
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idContatto' => 'required|integer',
            'user' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'secretJWT' => 'nullable|string|max:255'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Genera un hash della password
        $sfida = bcrypt($request->password);
        
        // Genera un secretJWT casuale se non fornito
        $secretJWT = $request->secretJWT ?? \Illuminate\Support\Str::random(32);
        
        // Calcola la scadenza della sfida (es: 90 giorni)
        $scadenzaSfida = time() + (90 * 24 * 60 * 60);
        
        // Calcola il nuovo ID
        $lastId = password::max('idAuth');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea la nuova password
        $password = new password();
        $password->idAuth = $newId;
        $password->idContatto = $request->idContatto;
        $password->user = $request->user;
        $password->sfida = $sfida;
        $password->secretJWT = $secretJWT;
        $password->scadenzaSfida = $scadenzaSfida;
        $password->save();
        
        // Restituisci la risposta (senza mostrare la password)
        return response()->json([
            'success' => true,
            'message' => 'Credenziali create con successo',
            'data' => [
                'idAuth' => $password->idAuth,
                'idContatto' => $password->idContatto,
                'user' => $password->user,
                'secretJWT' => $password->secretJWT,
                'scadenzaSfida' => $password->scadenzaSfida,
                'created_at' => $password->created_at,
                'updated_at' => $password->updated_at
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $password = password::where('idAuth', $id)->first();
        
        if (!$password) {
            return response()->json([
                'success' => false,
                'message' => 'Credenziali non trovate'
            ], 404);
        }
        
        // Restituisci la risposta (senza mostrare la password/sfida)
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio credenziali',
            'data' => [
                'idAuth' => $password->idAuth,
                'idContatto' => $password->idContatto,
                'user' => $password->user,
                'secretJWT' => $password->secretJWT,
                'scadenzaSfida' => $password->scadenzaSfida,
                'created_at' => $password->created_at,
                'updated_at' => $password->updated_at
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova la password per ID
        $password = password::where('idAuth', $id)->first();
        
        // Verifica se la password esiste
        if (!$password) {
            return response()->json([
                'success' => false,
                'message' => 'Credenziali non trovate'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'user' => 'string|max:255',
            'password' => 'string|min:8',
            'secretJWT' => 'nullable|string|max:255',
            'scadenzaSfida' => 'integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        if ($request->has('user')) $password->user = $request->user;
        
        // Se è stata fornita una nuova password, aggiorna sfida e scadenza
        if ($request->has('password')) {
            $password->sfida = bcrypt($request->password);
            // Resetta la scadenza (es: 90 giorni da ora)
            $password->scadenzaSfida = time() + (90 * 24 * 60 * 60);
        } else if ($request->has('scadenzaSfida')) {
            $password->scadenzaSfida = $request->scadenzaSfida;
        }
        
        if ($request->has('secretJWT')) $password->secretJWT = $request->secretJWT;
        
        $password->save();
        
        // Restituisci la risposta (senza mostrare la password)
        return response()->json([
            'success' => true,
            'message' => 'Credenziali aggiornate con successo',
            'data' => [
                'idAuth' => $password->idAuth,
                'idContatto' => $password->idContatto,
                'user' => $password->user,
                'secretJWT' => $password->secretJWT,
                'scadenzaSfida' => $password->scadenzaSfida,
                'created_at' => $password->created_at,
                'updated_at' => $password->updated_at
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova la password per ID
        $password = password::where('idAuth', $id)->first();
        
        // Verifica se la password esiste
        if (!$password) {
            return response()->json([
                'success' => false,
                'message' => 'Credenziali non trovate'
            ], 404);
        }
        
        // Elimina la password
        $password->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Credenziali eliminate con successo'
        ], 200);
    }
}
