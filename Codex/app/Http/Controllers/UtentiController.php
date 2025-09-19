<?php

namespace App\Http\Controllers;

use App\Models\utenti;
use Illuminate\Http\Request;

class UtentiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return utenti::all();
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
    public function show(utenti $utenti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, utenti $utenti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(utenti $utenti)
    {
        //
    }
}
