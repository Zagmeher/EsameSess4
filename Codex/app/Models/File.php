<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    
    /**
     * Il nome della tabella associata al modello.
     *
     * @var string
     */
    protected $table = 'file';
    
    /**
     * La chiave primaria associata alla tabella.
     *
     * @var string
     */
    protected $primaryKey = 'idFile';
    
    /**
     * Gli attributi che sono assegnabili in massa.
     *
     * @var array
     */
    protected $fillable = [
        'idRecord',
        'tabella',
        'nome',
        'size',
        'ext',
        'descrizione',
        'formato'
    ];
}
