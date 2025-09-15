<?php

namespace App\Http\Controllers;

use App\Models\episodi;
use Illuminate\Http\Request;

class EpisodiController extends Controller
{
    /**
     * Get episodes by serie TV ID
     */
    public function getEpisodiBySerieId(string $serieId)
    {
        $episodi = episodi::where('idSerieTv', $serieId)->get();
        
        if ($episodi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun episodio trovato per questa serie TV'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Episodi trovati per la serie TV',
            'data' => $episodi
        ], 200);
    }
    
    /**
     * Get episodes by season
     */
    public function getEpisodiBySeasonNumber(string $serieId, int $stagione)
    {
        $episodi = episodi::where('idSerieTv', $serieId)
                         ->where('numeroStagione', $stagione)
                         ->orderBy('numeroEpisodio', 'ASC')
                         ->get();
        
        if ($episodi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun episodio trovato per questa stagione'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Episodi trovati per la stagione',
            'data' => $episodi
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episodi = episodi::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista episodi',
            'data' => $episodi
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idSerieTv' => 'required|integer',
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string|max:45',
            'numeroStagione' => 'required|integer|min:1|max:255',
            'numeroEpisodio' => 'required|integer|min:1|max:255',
            'durata' => 'required|integer|min:1|max:255',
            'anno' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'idImmagine' => 'nullable|integer',
            'idFilmato' => 'nullable|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = episodi::max('idEpisodio');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo episodio
        $episodio = new episodi();
        $episodio->idEpisodio = $newId;
        $episodio->idSerieTv = $request->idSerieTv;
        $episodio->titolo = $request->titolo;
        $episodio->descrizione = $request->descrizione;
        $episodio->numeroStagione = $request->numeroStagione;
        $episodio->numeroEpisodio = $request->numeroEpisodio;
        $episodio->durata = $request->durata;
        $episodio->anno = $request->anno;
        $episodio->idImmagine = $request->idImmagine ?? null;
        $episodio->idFilmato = $request->idFilmato ?? null;
        $episodio->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Episodio creato con successo',
            'data' => $episodio
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $episodio = episodi::where('idEpisodio', $id)->first();
        
        if (!$episodio) {
            return response()->json([
                'success' => false,
                'message' => 'Episodio non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio episodio',
            'data' => $episodio
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova l'episodio per ID
        $episodio = episodi::where('idEpisodio', $id)->first();
        
        // Verifica se l'episodio esiste
        if (!$episodio) {
            return response()->json([
                'success' => false,
                'message' => 'Episodio non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idSerieTv' => 'integer',
            'titolo' => 'string|max:255',
            'descrizione' => 'string|max:45',
            'numeroStagione' => 'integer|min:1|max:255',
            'numeroEpisodio' => 'integer|min:1|max:255',
            'durata' => 'integer|min:1|max:255',
            'anno' => 'integer|min:1900|max:' . (date('Y') + 5),
            'idImmagine' => 'nullable|integer',
            'idFilmato' => 'nullable|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        if ($request->has('idSerieTv')) $episodio->idSerieTv = $request->idSerieTv;
        if ($request->has('titolo')) $episodio->titolo = $request->titolo;
        if ($request->has('descrizione')) $episodio->descrizione = $request->descrizione;
        if ($request->has('numeroStagione')) $episodio->numeroStagione = $request->numeroStagione;
        if ($request->has('numeroEpisodio')) $episodio->numeroEpisodio = $request->numeroEpisodio;
        if ($request->has('durata')) $episodio->durata = $request->durata;
        if ($request->has('anno')) $episodio->anno = $request->anno;
        if ($request->has('idImmagine')) $episodio->idImmagine = $request->idImmagine;
        if ($request->has('idFilmato')) $episodio->idFilmato = $request->idFilmato;
        
        $episodio->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Episodio aggiornato con successo',
            'data' => $episodio
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova l'episodio per ID
        $episodio = episodi::where('idEpisodio', $id)->first();
        
        // Verifica se l'episodio esiste
        if (!$episodio) {
            return response()->json([
                'success' => false,
                'message' => 'Episodio non trovato'
            ], 404);
        }
        
        // Elimina l'episodio
        $episodio->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Episodio eliminato con successo'
        ], 200);
    }
}
