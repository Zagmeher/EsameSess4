<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AppHelper
{
    /**
     * Restituisce l'hash SHA-512 dell'utente (email) normalizzato.
     */
    public static function hashUtente(string $email): string
    {
        return hash('sha512', strtolower(trim($email)));
    }

    /**
     * Offusca la password già pre-hashata con SHA-512 applicando il sale e rieseguendo SHA-512.
     * $pwdHash deve essere una stringa (preferibilmente esadecimale) derivante da hash('sha512', password).
     */
    public static function nascondiPassword(string $pwdHash, string $salt): string
    {
        return hash('sha512', trim($pwdHash . $salt));
    }

    /**
     * Genera un sale robusto (128 char hex).
     */
    public static function generaSale(): string
    {
        return bin2hex(random_bytes(64));
    }

    /**
     * Genera un secretJWT robusto conforme all'indicazione del professore.
     */
    public static function generaSecretJWT(): string
    {
        return hash('sha512', trim(Str::random(200)));
    }
}
