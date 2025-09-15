<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class categorie extends Model
{
    use HasFactory;
    
    protected $table = 'categorie';
    protected $primaryKey = 'idCategoria';
    protected $fillable = ['nome'];
    
    // La tabella ha timestamp (created_at, updated_at) come da migrazione
    public $timestamps = true;
}
