<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\auth as AuthModel;
use App\Models\contatti as Contatto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccediController extends Controller
{
    /**
     * Metodo di test login (statico) secondo lo schema del professore.
     * Accetta hashUtente (SHA-512 dell'email normalizzata) e hashPassword (SHA-512 della password in chiaro).
     */
    public static function testLogin(string $hashUtente, string $hashPassword)
    {
        // Verifica dati in ingresso
        if (empty($hashUtente) || empty($hashPassword)) {
            return response()->json(['error' => 'Parametri mancanti: hashUtente, hashPassword'], 400);
        }

        // Verifica esistenza utente
        $auth = AuthModel::esisteUtenteValidoPerLogin($hashUtente);
        if (!$auth) {
            return response()->json(['ok' => false, 'message' => 'Utente non trovato'], 404);
        }

        // Aggiorna secretJWT e inizioSfida
        $auth->secretJWT = AppHelper::generaSecretJWT();
        $auth->inizioSfida = Carbon::now();
        $auth->save();

        // Esegue il controllo della password secondo lo schema definito
        $controlloPassword = self::controlloPassword($hashUtente, $hashPassword);

        return response()->json([
            'ok' => true,
            'controlloPassword' => $controlloPassword,
        ]);
    }

    /**
     * Controllo della password: confronta la sfida salvata con l'hash calcolato (SHA-512(pwdHash + sale)).
     */
    public static function controlloPassword(string $hashUtente, string $hashPassword): bool
    {
        $auth = AuthModel::where('user', $hashUtente)->first();
        if (!$auth) {
            return false;
        }

        $hashSfida = AppHelper::nascondiPassword($hashPassword, $auth->sale);
        return hash_equals((string) $auth->sfida, (string) $hashSfida);
    }
}
