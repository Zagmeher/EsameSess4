<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class recapiti extends Model
{
    use HasFactory;
    
    protected $table = 'recapiti';
    protected $primaryKey = 'idRecapito';
    
    protected $fillable = [
        'idContatto',
        'idTipoRecapito',
        'recapito'
    ];
}
