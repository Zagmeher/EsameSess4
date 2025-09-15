<?php

namespace App\Http\Controllers;

use App\Models\indirizzi;
use Illuminate\Http\Request;

class IndirizziController extends Controller
{
    /**
     * Get addresses by contact
     */
    public function getIndirizziByContatto(string $idContatto)
    {
        $indirizzi = indirizzi::where('idContatto', $idContatto)->get();
        
        if ($indirizzi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun indirizzo trovato per questo contatto'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Indirizzi trovati per il contatto',
            'data' => $indirizzi
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indirizzi = indirizzi::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista indirizzi',
            'data' => $indirizzi
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idTipoIndirizzo' => 'required|integer',
            'idContatto' => 'required|integer',
            'idNazione' => 'required|integer',
            'idComuneItaliano' => 'nullable|integer',
            'cap' => 'required|string|max:10',
            'indirizzo' => 'required|string|max:45',
            'civico' => 'required|string|max:10',
            'localita' => 'required|string|max:45',
            'altro_1' => 'nullable|string|max:100',
            'altro_2' => 'nullable|string|max:100'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = indirizzi::max('idIndirizzo');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo indirizzo
        $indirizzo = new indirizzi();
        $indirizzo->idIndirizzo = $newId;
        $indirizzo->idTipoIndirizzo = $request->idTipoIndirizzo;
        $indirizzo->idContatto = $request->idContatto;
        $indirizzo->idNazione = $request->idNazione;
        $indirizzo->idComuneItaliano = $request->idComuneItaliano;
        $indirizzo->cap = $request->cap;
        $indirizzo->indirizzo = $request->indirizzo;
        $indirizzo->civico = $request->civico;
        $indirizzo->localita = $request->localita;
        $indirizzo->altro_1 = $request->altro_1;
        $indirizzo->altro_2 = $request->altro_2;
        $indirizzo->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Indirizzo creato con successo',
            'data' => $indirizzo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $indirizzo = indirizzi::where('idIndirizzo', $id)->first();
        
        if (!$indirizzo) {
            return response()->json([
                'success' => false,
                'message' => 'Indirizzo non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio indirizzo',
            'data' => $indirizzo
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova l'indirizzo per ID
        $indirizzo = indirizzi::where('idIndirizzo', $id)->first();
        
        // Verifica se l'indirizzo esiste
        if (!$indirizzo) {
            return response()->json([
                'success' => false,
                'message' => 'Indirizzo non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idTipoIndirizzo' => 'integer',
            'idContatto' => 'integer',
            'idNazione' => 'integer',
            'idComuneItaliano' => 'nullable|integer',
            'cap' => 'string|max:10',
            'indirizzo' => 'string|max:45',
            'civico' => 'string|max:10',
            'localita' => 'string|max:45',
            'altro_1' => 'nullable|string|max:100',
            'altro_2' => 'nullable|string|max:100'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        if ($request->has('idTipoIndirizzo')) $indirizzo->idTipoIndirizzo = $request->idTipoIndirizzo;
        if ($request->has('idContatto')) $indirizzo->idContatto = $request->idContatto;
        if ($request->has('idNazione')) $indirizzo->idNazione = $request->idNazione;
        if ($request->has('idComuneItaliano')) $indirizzo->idComuneItaliano = $request->idComuneItaliano;
        if ($request->has('cap')) $indirizzo->cap = $request->cap;
        if ($request->has('indirizzo')) $indirizzo->indirizzo = $request->indirizzo;
        if ($request->has('civico')) $indirizzo->civico = $request->civico;
        if ($request->has('localita')) $indirizzo->localita = $request->localita;
        if ($request->has('altro_1')) $indirizzo->altro_1 = $request->altro_1;
        if ($request->has('altro_2')) $indirizzo->altro_2 = $request->altro_2;
        
        $indirizzo->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Indirizzo aggiornato con successo',
            'data' => $indirizzo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova l'indirizzo per ID
        $indirizzo = indirizzi::where('idIndirizzo', $id)->first();
        
        // Verifica se l'indirizzo esiste
        if (!$indirizzo) {
            return response()->json([
                'success' => false,
                'message' => 'Indirizzo non trovato'
            ], 404);
        }
        
        // Elimina l'indirizzo
        $indirizzo->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Indirizzo eliminato con successo'
        ], 200);
    }
}
