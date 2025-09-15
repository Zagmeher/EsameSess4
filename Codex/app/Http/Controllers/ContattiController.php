<?php

namespace App\Http\Controllers;

use App\Models\contatti;
use Illuminate\Http\Request;

class ContattiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contatti = contatti::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista contatti',
            'data' => $contatti
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idGruppo' => 'required|integer',
            'idStato' => 'required|integer',
            'nome' => 'required|string|max:45',
            'cognome' => 'required|string|max:45',
            'sesso' => 'required|integer|min:0|max:2',
            'codiceFiscale' => 'required|string|max:45',
            'partitaIva' => 'nullable|string|max:45',
            'cittadinanza' => 'required|string|max:45',
            'idNazioneNascita' => 'required|integer',
            'cittaNascita' => 'required|string|max:45',
            'provinciaNascita' => 'required|string|max:45',
            'dataNascita' => 'required|date'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = contatti::max('idContatto');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo contatto
        $contatto = new contatti();
        $contatto->idContatto = $newId;
        $contatto->idGruppo = $request->idGruppo;
        $contatto->idStato = $request->idStato;
        $contatto->nome = $request->nome;
        $contatto->cognome = $request->cognome;
        $contatto->sesso = $request->sesso;
        $contatto->codiceFiscale = $request->codiceFiscale;
        $contatto->partitaIva = $request->partitaIva ?? '';
        $contatto->cittadinanza = $request->cittadinanza;
        $contatto->idNazioneNascita = $request->idNazioneNascita;
        $contatto->cittaNascita = $request->cittaNascita;
        $contatto->provinciaNascita = $request->provinciaNascita;
        $contatto->dataNascita = $request->dataNascita;
        $contatto->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Contatto creato con successo',
            'data' => $contatto
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contatto = contatti::where('idContatto', $id)->first();
        
        if (!$contatto) {
            return response()->json([
                'success' => false,
                'message' => 'Contatto non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio contatto',
            'data' => $contatto
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova il contatto per ID
        $contatto = contatti::where('idContatto', $id)->first();
        
        // Verifica se il contatto esiste
        if (!$contatto) {
            return response()->json([
                'success' => false,
                'message' => 'Contatto non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idGruppo' => 'integer',
            'idStato' => 'integer',
            'nome' => 'string|max:45',
            'cognome' => 'string|max:45',
            'sesso' => 'integer|min:0|max:2',
            'codiceFiscale' => 'string|max:45',
            'partitaIva' => 'nullable|string|max:45',
            'cittadinanza' => 'string|max:45',
            'idNazioneNascita' => 'integer',
            'cittaNascita' => 'string|max:45',
            'provinciaNascita' => 'string|max:45',
            'dataNascita' => 'date'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        if ($request->has('idGruppo')) $contatto->idGruppo = $request->idGruppo;
        if ($request->has('idStato')) $contatto->idStato = $request->idStato;
        if ($request->has('nome')) $contatto->nome = $request->nome;
        if ($request->has('cognome')) $contatto->cognome = $request->cognome;
        if ($request->has('sesso')) $contatto->sesso = $request->sesso;
        if ($request->has('codiceFiscale')) $contatto->codiceFiscale = $request->codiceFiscale;
        if ($request->has('partitaIva')) $contatto->partitaIva = $request->partitaIva;
        if ($request->has('cittadinanza')) $contatto->cittadinanza = $request->cittadinanza;
        if ($request->has('idNazioneNascita')) $contatto->idNazioneNascita = $request->idNazioneNascita;
        if ($request->has('cittaNascita')) $contatto->cittaNascita = $request->cittaNascita;
        if ($request->has('provinciaNascita')) $contatto->provinciaNascita = $request->provinciaNascita;
        if ($request->has('dataNascita')) $contatto->dataNascita = $request->dataNascita;
        
        $contatto->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Contatto aggiornato con successo',
            'data' => $contatto
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova il contatto per ID
        $contatto = contatti::where('idContatto', $id)->first();
        
        // Verifica se il contatto esiste
        if (!$contatto) {
            return response()->json([
                'success' => false,
                'message' => 'Contatto non trovato'
            ], 404);
        }
        
        // Elimina il contatto
        $contatto->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Contatto eliminato con successo'
        ], 200);
    }
}
