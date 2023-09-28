<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conexione extends Model
{
    use HasFactory;
    protected $fillable = [
    	'ruta_id',
        'ubicacion1',
        'ubicacion2',
        'peso',
    ];
}
