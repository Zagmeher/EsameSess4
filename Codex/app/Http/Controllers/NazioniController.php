<?php

namespace App\Http\Controllers;

use App\Models\nazioni;
use Illuminate\Http\Request;

class NazioniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nazioni = nazioni::all();
        return response()->json([
            'success' => true,
            'data' => $nazioni
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'required|string|max:45',
            'continente' => 'required|string|size:2',
            'iso' => 'required|string|size:2',
            'iso3' => 'required|string|size:3',
            'prefissoTelefonico' => 'required|string|max:10',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = nazioni::max('idNazione');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea la nuova nazione
        $nazione = new nazioni();
        $nazione->idNazione = $newId;
        $nazione->nome = $request->nome;
        $nazione->continente = $request->continente;
        $nazione->iso = $request->iso;
        $nazione->iso3 = $request->iso3;
        $nazione->prefissoTelefonico = $request->prefissoTelefonico;
        $nazione->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Nazione creata con successo',
            'data' => $nazione
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nazione = nazioni::find($id);
        
        if (!$nazione) {
            return response()->json([
                'success' => false,
                'message' => 'Nazione non trovata'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $nazione
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova la nazione per ID
        $nazione = nazioni::find($id);
        
        // Verifica se la nazione esiste
        if (!$nazione) {
            return response()->json([
                'success' => false,
                'message' => 'Nazione non trovata'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'sometimes|string|max:45',
            'continente' => 'sometimes|string|size:2',
            'iso' => 'sometimes|string|size:2',
            'iso3' => 'sometimes|string|size:3',
            'prefissoTelefonico' => 'sometimes|string|max:10',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna solo i campi forniti nella richiesta
        if ($request->has('nome')) {
            $nazione->nome = $request->nome;
        }
        
        if ($request->has('continente')) {
            $nazione->continente = $request->continente;
        }
        
        if ($request->has('iso')) {
            $nazione->iso = $request->iso;
        }
        
        if ($request->has('iso3')) {
            $nazione->iso3 = $request->iso3;
        }
        
        if ($request->has('prefissoTelefonico')) {
            $nazione->prefissoTelefonico = $request->prefissoTelefonico;
        }
        
        // Salva le modifiche
        $nazione->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Nazione aggiornata con successo',
            'data' => $nazione
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova la nazione per ID
        $nazione = nazioni::find($id);
        
        // Verifica se la nazione esiste
        if (!$nazione) {
            return response()->json([
                'success' => false,
                'message' => 'Nazione non trovata'
            ], 404);
        }
        
        // Elimina la nazione
        $nazione->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Nazione eliminata con successo'
        ], 200);
    }
}
