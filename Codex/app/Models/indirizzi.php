<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class indirizzi extends Model
{
    use HasFactory;
    
    protected $table = 'indirizzi';
    protected $primaryKey = 'idIndirizzo';
    
    protected $fillable = [
        'idTipoIndirizzo',
        'idContatto',
        'idNazione',
        'idComuneItaliano',
        'cap',
        'indirizzo',
        'civico',
        'localita',
        'altro_1',
        'altro_2'
    ];
}
