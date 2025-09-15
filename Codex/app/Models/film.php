<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class film extends Model
{
    use HasFactory;
    
    protected $table = 'film';
    protected $primaryKey = 'idFilm';
    
    protected $fillable = [
        'idCategoria',
        'titolo',
        'descrizione',
        'durata',
        'regista',
        'attori',
        'anno',
        'idImmagine',
        'idFilmato'
    ];
}
