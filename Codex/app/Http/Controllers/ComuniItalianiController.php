<?php

namespace App\Http\Controllers;

use App\Models\comuniItaliani;
use Illuminate\Http\Request;

class ComuniItalianiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comuni = comuniItaliani::all();
        return response()->json([
            'success' => true,
            'data' => $comuni
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'regione' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'sigla' => 'required|string|size:2',
            'codiceIstat' => 'required|string',
            'cap' => 'required|string',
            'prefisso' => 'required|string',
            'popolazione' => 'required|integer',
            'idNazione' => 'required|integer|exists:nazioni,idNazione'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = comuniItaliani::max('idComune');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo comune
        $comune = new comuniItaliani();
        $comune->idComune = $newId;
        $comune->nome = $request->nome;
        $comune->regione = $request->regione;
        $comune->provincia = $request->provincia;
        $comune->sigla = $request->sigla;
        $comune->codiceIstat = $request->codiceIstat;
        $comune->cap = $request->cap;
        $comune->prefisso = $request->prefisso;
        $comune->popolazione = $request->popolazione;
        $comune->idNazione = $request->idNazione;
        $comune->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Comune creato con successo',
            'data' => $comune
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comune = comuniItaliani::find($id);
        
        if (!$comune) {
            return response()->json([
                'success' => false,
                'message' => 'Comune non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $comune
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova il comune per ID
        $comune = comuniItaliani::find($id);
        
        // Verifica se il comune esiste
        if (!$comune) {
            return response()->json([
                'success' => false,
                'message' => 'Comune non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'sometimes|string|max:255',
            'regione' => 'sometimes|string|max:255',
            'provincia' => 'sometimes|string|max:255',
            'sigla' => 'sometimes|string|size:2',
            'codiceIstat' => 'sometimes|string',
            'cap' => 'sometimes|string',
            'prefisso' => 'sometimes|string',
            'popolazione' => 'sometimes|integer',
            'idNazione' => 'sometimes|integer|exists:nazioni,idNazione'
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
            $comune->nome = $request->nome;
        }
        
        if ($request->has('regione')) {
            $comune->regione = $request->regione;
        }
        
        if ($request->has('provincia')) {
            $comune->provincia = $request->provincia;
        }
        
        if ($request->has('sigla')) {
            $comune->sigla = $request->sigla;
        }
        
        if ($request->has('codiceIstat')) {
            $comune->codiceIstat = $request->codiceIstat;
        }
        
        if ($request->has('cap')) {
            $comune->cap = $request->cap;
        }
        
        if ($request->has('prefisso')) {
            $comune->prefisso = $request->prefisso;
        }
        
        if ($request->has('popolazione')) {
            $comune->popolazione = $request->popolazione;
        }
        
        if ($request->has('idNazione')) {
            $comune->idNazione = $request->idNazione;
        }
        
        // Salva le modifiche
        $comune->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Comune aggiornato con successo',
            'data' => $comune
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova il comune per ID
        $comune = comuniItaliani::find($id);
        
        // Verifica se il comune esiste
        if (!$comune) {
            return response()->json([
                'success' => false,
                'message' => 'Comune non trovato'
            ], 404);
        }
        
        // Elimina il comune
        $comune->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Comune eliminato con successo'
        ], 200);
    }
}
