<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return response()->json([
            'success' => true,
            'data' => $files
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idRecord' => 'required|integer',
            'tabella' => 'required|string|max:45',
            'nome' => 'required|string|max:45',
            'size' => 'required|integer',
            'ext' => 'required|string|max:6',
            'descrizione' => 'nullable|string',
            'formato' => 'required|string|max:45'
        ]);

        $file = File::create($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $file,
            'message' => 'File creato con successo'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File non trovato'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $file
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File non trovato'
            ], 404);
        }
        
        $request->validate([
            'idRecord' => 'integer',
            'tabella' => 'string|max:45',
            'nome' => 'string|max:45',
            'size' => 'integer',
            'ext' => 'string|max:6',
            'descrizione' => 'nullable|string',
            'formato' => 'string|max:45'
        ]);
        
        $file->update($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $file,
            'message' => 'File aggiornato con successo'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);
        
        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File non trovato'
            ], 404);
        }
        
        $file->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'File eliminato con successo'
        ], 200);
    }
}
