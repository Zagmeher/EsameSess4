<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorie = categorie::all();
        return response()->json([
            'success' => true,
            'message' => 'Lista categorie',
            'data' => $categorie
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
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calcola il nuovo ID
        $lastId = categorie::max('idCategoria');
        $newId = $lastId ? $lastId + 1 : 1;
        
        // Crea la nuova categoria
        $categoria = new categorie();
        $categoria->idCategoria = $newId;
        $categoria->nome = $request->nome;
        $categoria->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Categoria creata con successo',
            'data' => $categoria
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = categorie::where('idCategoria', $id)->first();
        
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria non trovata'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio categoria',
            'data' => $categoria
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trova la categoria per ID
        $categoria = categorie::where('idCategoria', $id)->first();
        
        // Verifica se la categoria esiste
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria non trovata'
            ], 404);
        }
        
        // Valida i dati di input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Aggiorna i dati
        $categoria->nome = $request->nome;
        $categoria->save();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Categoria aggiornata con successo',
            'data' => $categoria
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trova la categoria per ID
        $categoria = categorie::where('idCategoria', $id)->first();
        
        // Verifica se la categoria esiste
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria non trovata'
            ], 404);
        }
        
        // Elimina la categoria
        $categoria->delete();
        
        // Restituisci la risposta
        return response()->json([
            'success' => true,
            'message' => 'Categoria eliminata con successo'
        ], 200);
    }
}
