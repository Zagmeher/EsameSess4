<?php

namespace App\Http\Controllers;

use App\Models\film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Versione pubblica dell'indice dei film (con dati limitati)
     */
    public function publicIndex()
    {
        $films = film::select('idFilm', 'titolo', 'anno', 'idCategoria', 'locandina')
                      ->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista film (versione pubblica)',
            'data' => $films
        ], 200);
    }
    
    /**
     * Versione pubblica dei dettagli di un film (con dati limitati)
     */
    public function publicShow(string $id)
    {
        $film = film::select('idFilm', 'titolo', 'anno', 'idCategoria', 'locandina')
                     ->where('idFilm', $id)
                     ->first();
        
        if (!$film) {
            return response()->json([
                'success' => false,
                'message' => 'Film non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio film (versione pubblica)',
            'data' => $film
        ], 200);
    }
    /**
     * Get films by category
     */
    public function getFilmByCategoria(string $idCategoria)
    {
        $films = film::where('idCategoria', $idCategoria)->get();
        
        if ($films->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun film trovato per questa categoria'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Film trovati per la categoria',
            'data' => $films
        ], 200);
    }
    
    /**
     * Get films by year
     */
    public function getFilmByAnno(int $anno)
    {
        $films = film::where('anno', $anno)->get();
        
        if ($films->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun film trovato per questo anno'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Film trovati per l\'anno ' . $anno,
            'data' => $films
        ], 200);
    }
    
    /**
     * Search films by title
     */
    public function searchFilm(Request $request)
    {
        $query = $request->query('q');
        
        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Parametro di ricerca mancante'
            ], 400);
        }
        
        $films = film::where('titolo', 'LIKE', '%' . $query . '%')
                     ->orWhere('descrizione', 'LIKE', '%' . $query . '%')
                     ->orWhere('regista', 'LIKE', '%' . $query . '%')
                     ->orWhere('attori', 'LIKE', '%' . $query . '%')
                     ->get();
        
        if ($films->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun film trovato per la ricerca: ' . $query
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Risultati della ricerca per: ' . $query,
            'data' => $films
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = film::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista film',
            'data' => $films
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idCategoria' => 'required|integer',
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string|max:255',
            'durata' => 'required|integer|min:1',
            'regista' => 'required|string|max:45',
            'attori' => 'required|string|max:45',
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
        $lastId = film::max('idFilm');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea il nuovo film
        $film = new film();
        $film->idFilm = $newId;
        $film->idCategoria = $request->idCategoria;
        $film->titolo = $request->titolo;
        $film->descrizione = $request->descrizione;
        $film->durata = $request->durata;
        $film->regista = $request->regista;
        $film->attori = $request->attori;
        $film->anno = $request->anno;
        $film->idImmagine = $request->idImmagine ?? null;
        $film->idFilmato = $request->idFilmato ?? null;
        $film->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Film creato con successo',
            'data' => $film
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = film::where('idFilm', $id)->first();
        
        if (!$film) {
            return response()->json([
                'success' => false,
                'message' => 'Film non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio film',
            'data' => $film
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova il film per ID
        $film = film::where('idFilm', $id)->first();
        
        // Verifica se il film esiste
        if (!$film) {
            return response()->json([
                'success' => false,
                'message' => 'Film non trovato'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'idCategoria' => 'integer',
            'titolo' => 'string|max:255',
            'descrizione' => 'string|max:255',
            'durata' => 'integer|min:1',
            'regista' => 'string|max:45',
            'attori' => 'string|max:45',
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
        if ($request->has('idCategoria')) $film->idCategoria = $request->idCategoria;
        if ($request->has('titolo')) $film->titolo = $request->titolo;
        if ($request->has('descrizione')) $film->descrizione = $request->descrizione;
        if ($request->has('durata')) $film->durata = $request->durata;
        if ($request->has('regista')) $film->regista = $request->regista;
        if ($request->has('attori')) $film->attori = $request->attori;
        if ($request->has('anno')) $film->anno = $request->anno;
        if ($request->has('idImmagine')) $film->idImmagine = $request->idImmagine;
        if ($request->has('idFilmato')) $film->idFilmato = $request->idFilmato;
        
        $film->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Film aggiornato con successo',
            'data' => $film
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova il film per ID
        $film = film::where('idFilm', $id)->first();
        
        // Verifica se il film esiste
        if (!$film) {
            return response()->json([
                'success' => false,
                'message' => 'Film non trovato'
            ], 404);
        }
        
        // Elimina il film
        $film->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Film eliminato con successo'
        ], 200);
    }
}
