<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contatti;
use App\Models\auth;

class DebugController extends Controller
{
    /**
     * Mostra tutti i contatti con i loro gruppi (solo per debug)
     */
    public function showContatti()
    {
        $contatti = contatti::with(['auth' => function($query) {
            $query->select('idContatto', 'user');
        }])->select('idContatto', 'nome', 'cognome', 'idGruppo', 'idStato')->get();

        return response()->json([
            'contatti' => $contatti->map(function($contatto) {
                return [
                    'id' => $contatto->idContatto,
                    'nome' => $contatto->nome,
                    'cognome' => $contatto->cognome,
                    'idGruppo' => $contatto->idGruppo,
                    'ruolo' => $contatto->idGruppo == 1 ? 'ADMIN' : 'USER',
                    'stato' => $contatto->idStato == 1 ? 'ATTIVO' : 'DISATTIVO',
                    'email' => $contatto->auth ? $contatto->auth->user : null
                ];
            })
        ]);
    }

    /**
     * Mostra solo gli admin (idGruppo = 1)
     */
    public function showAdmin()
    {
        $admin = contatti::where('idGruppo', 1)
            ->with(['auth' => function($query) {
                $query->select('idContatto', 'user');
            }])
            ->get();

        return response()->json([
            'admin_trovati' => $admin->count(),
            'admin' => $admin->map(function($contatto) {
                return [
                    'id' => $contatto->idContatto,
                    'nome' => $contatto->nome,
                    'cognome' => $contatto->cognome,
                    'idGruppo' => $contatto->idGruppo,
                    'email' => $contatto->auth ? $contatto->auth->user : null,
                    'stato' => $contatto->idStato == 1 ? 'ATTIVO' : 'DISATTIVO'
                ];
            })
        ]);
    }
}