<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class episodi extends Model
{
    use HasFactory;
    
    protected $table = 'episodi';
    protected $primaryKey = 'idEpisodio';
    
    protected $fillable = [
        'idSerieTv',
        'titolo',
        'descrizione',
        'numeroStagione',
        'numeroEpisodio',
        'durata',
        'anno',
        'idImmagine',
        'idFilmato'
    ];
}
