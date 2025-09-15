<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auth extends Model
{
    use HasFactory;
    
    /**
     * Il nome della tabella associata al modello.
     *
     * @var string
     */
    protected $table = 'auth';
    
    /**
     * La chiave primaria associata alla tabella.
     *
     * @var string
     */
    protected $primaryKey = 'idAuth';
    
    /**
     * Indica se la chiave primaria è un numero intero auto-incrementante.
     *
     * @var bool
     */
    public $incrementing = true;
    
    /**
     * Gli attributi che sono assegnabili in massa.
     *
     * @var array
     */
    protected $fillable = [
        'idAuth',
        'idContatto',
        'user',
        'sfida',
        'secretJWT',
        'scadenzaSfida',
        'sale'
    ];
    
    /**
     * Ottiene il contatto associato a questa autenticazione.
     */
    public function contatto()
    {
        return $this->belongsTo(contatti::class, 'idContatto', 'idContatto');
    }
}
