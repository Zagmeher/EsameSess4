<?php

namespace App\Http\Controllers;

use App\Models\recapiti;
use Illuminate\Http\Request;

class RecapitiController extends Controller
{
    /**
     * Prende i contatti per ID contatto
     */
    public function getRecapitiByContatto(string $idContatto)
    {
        $recapiti = recapiti::where('idContatto', $idContatto)->get();
        
        if ($recapiti->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun recapito trovato per questo contatto'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Recapiti trovati per il contatto',
            'data' => $recapiti
        ], 200);
    }
    
    /**
     * Prende i contatti per ID tipo
     */
    public function getRecapitiByTipo(string $idTipoRecapito)
    {
        $recapiti = recapiti::where('idTipoRecapito', $idTipoRecapito)->get();
        
        if ($recapiti->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun recapito trovato per questo tipo'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Recapiti trovati per il tipo specificato',
            'data' => $recapiti
        ], 200);
    }
    
    /**
     * Mostra una lista della risorsa.
     */
    public function index()
    {
        $recapiti = recapiti::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista recapiti',
            'data' => $recapiti
        ], 200);
    }

    /**
     * immagazzina una nuova risorsa nel database.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idContatto' => 'required|integer',
            'idTipoRecapito' => 'required|integer',
            'recapito' => 'required|string|max:255'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = recapiti::max('idRecapito');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo recapito
        $recapito = new recapiti();
        $recapito->idRecapito = $newId;
        $recapito->idContatto = $request->idContatto;
        $recapito->idTipoRecapito = $request->idTipoRecapito;
        $recapito->recapito = $request->recapito;
        $recapito->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Recapito creato con successo',
            'data' => $recapito
        ], 201);
    }

    /**
     * mostra la risorsa specificata.
     */
    public function show(string $id)
    {
        $recapito = recapiti::where('idRecapito', $id)->first();
        
        if (!$recapito) {
            return response()->json([
                'success' => false,
                'message' => 'Recapito non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio recapito',
            'data' => $recapito
        ], 200);
    }

    /**
     * aggiorna la risorsa specificata nel database.
     */
    public function update(Request $request, string $id)
    {
        // Trova il recapito per ID
        $recapito = recapiti::where('idRecapito', $id)->first();
        
        // Verifica se il recapito esiste
        if (!$recapito) {
            return response()->json([
                'success' => false,
                'message' => 'Recapito non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idContatto' => 'integer',
            'idTipoRecapito' => 'integer',
            'recapito' => 'string|max:255'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        if ($request->has('idContatto')) $recapito->idContatto = $request->idContatto;
        if ($request->has('idTipoRecapito')) $recapito->idTipoRecapito = $request->idTipoRecapito;
        if ($request->has('recapito')) $recapito->recapito = $request->recapito;
        
        $recapito->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Recapito aggiornato con successo',
            'data' => $recapito
        ], 200);
    }

    /**
     * Rimuove la risorsa specificata dal database.
     */
    public function destroy(string $id)
    {
        // Trova il recapito per ID
        $recapito = recapiti::where('idRecapito', $id)->first();
        
        // Verifica se il recapito esiste
        if (!$recapito) {
            return response()->json([
                'success' => false,
                'message' => 'Recapito non trovato'
            ], 404);
        }
        
        // Elimina il recapito
        $recapito->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Recapito eliminato con successo'
        ], 200);
    }
}
