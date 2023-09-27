<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ubicacion(){
        return $this->hasMany(Ubicacione::class, 'ruta_id');
    }
}
