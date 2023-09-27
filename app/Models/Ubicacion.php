<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacione extends Model
{
    use HasFactory;
    protected $fillable=[
        'ruta_id',
        'posX',
        'posY',
        'nombre',
    ];

    public function ruta(){
        return $this->belongsTo(Ruta::class, 'ruta_id');
    }

}
