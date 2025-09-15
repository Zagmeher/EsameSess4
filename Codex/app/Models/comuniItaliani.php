<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comuniItaliani extends Model
{
    use HasFactory;
    
    /**
     * Il nome della tabella associata al modello.
     *
     * @var string
     */
    protected $table = 'comuni_italiani';
    
    /**
     * La chiave primaria associata alla tabella.
     *
     * @var string
     */
    protected $primaryKey = 'idComuneItaliano';
    
    /**
     * Indica se la chiave primaria è un numero intero auto-incrementante.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * Gli attributi che sono assegnabili in massa.
     *
     * @var array
     */
    protected $fillable = [
        'idComuneItaliano',
        'nome',
        'regione',
        'provincia',
        'siglaProvincia',
        'codiceCatastale',
        'CAP',
    ];
}
