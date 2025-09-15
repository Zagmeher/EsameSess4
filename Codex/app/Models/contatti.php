<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class contatti extends Authenticatable implements JWTSubject
{
    use HasFactory;
    
    protected $table = 'contatti';
    protected $primaryKey = 'idContatto';
    
    protected $fillable = [
        'idGruppo',
        'idStato',
        'nome',
        'cognome',
        'sesso',
        'codiceFiscale',
        'partitaIva',
        'cittadinanza',
        'idNazioneNascita',
        'cittaNascita',
        'provinciaNascita',
        'dataNascita'
    ];

    /**
     * Ottieni la relazione con il record di autenticazione.
     */
    public function authRecord()
    {
        return $this->hasOne(auth::class, 'idContatto', 'idContatto');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->nome . ' ' . $this->cognome,
            'email' => $this->authRecord ? $this->authRecord->user : null
        ];
    }

    /**
     * Relazione con la tabella auth
     */
    public function auth()
    {
        return $this->hasOne(auth::class, 'idContatto', 'idContatto');
    }
}
