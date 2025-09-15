<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nazioni extends Model
{
    use HasFactory;
    
    /**
     * Il nome della tabella associata al modello.
     *
     * @var string
     */
    protected $table = 'nazioni';
    
    /**
     * La chiave primaria associata alla tabella.
     *
     * @var string
     */
    protected $primaryKey = 'idNazione';
    
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
        'idNazione',
        'nome',
        'continente',
        'iso',
        'iso3',
        'prefissoTelefonico',
    ];
}
