<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class password extends Model
{
    use HasFactory;
    
    protected $table = 'auth';
    protected $primaryKey = 'idAuth';
    
    protected $fillable = [
        'idContatto',
        'user',
        'sfida',
        'secretJWT',
        'scadenzaSfida'
    ];
    
    // Relazione con il modello contatti
    public function contatto()
    {
        return $this->belongsTo(contatti::class, 'idContatto', 'idContatto');
    }
}
