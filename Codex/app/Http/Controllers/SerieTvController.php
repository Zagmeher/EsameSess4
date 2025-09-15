<?php

namespace App\Http\Controllers;

use App\Models\serieTv;
use Illuminate\Http\Request;

class SerieTvController extends Controller
{
    /**
     * Versione pubblica dell'indice delle serie TV (con dati limitati)
     */
    public function publicIndex()
    {
        $series = serieTv::select('id', 'titolo', 'anno', 'idCategoria', 'locandina')
                         ->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Lista serie TV (versione pubblica)',
            'data' => $series
        ], 200);
    }
    
    /**
     * Versione pubblica dei dettagli di una serie TV (con dati limitati)
     */
    public function publicShow(string $id)
    {
        $serie = serieTv::select('id', 'titolo', 'anno', 'idCategoria', 'locandina')
                         ->where('id', $id)
                         ->first();
        
        if (!$serie) {
            return response()->json([
                'success' => false,
                'message' => 'Serie TV non trovata'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Dettaglio serie TV (versione pubblica)',
            'data' => $serie
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(serieTv $serieTv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, serieTv $serieTv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(serieTv $serieTv)
    {
        //
    }
}
