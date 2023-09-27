<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Ubicacion extends Model
{
    use HasFactory;

    $fillable = [
        
    ]
=======
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

>>>>>>> origin/dev2
}
