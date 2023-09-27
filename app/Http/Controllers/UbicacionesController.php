<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ubicacione;
use App\Models\Conexione;

class UbicacionesController extends Controller
{
    public function modificarUbicaciones(Request $request, Ubicacion $ubicacion){
        
    }

    public function cargarUbicaciones(){

        $ubicacion = Ubicacione::get();
        $data = [
            'estado' => true,
            'ubicacion' => $ubicacion
        ];

        return response()->json($data);
    }

    public function cargarConexiones(){
        $conexion = Conexione::get();
        $data = [
            'estado' => true,
            'conexion' => $conexion 
        ];

        return response()->json($data);
    }
}
